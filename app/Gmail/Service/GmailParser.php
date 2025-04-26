<?php

namespace App\Gmail\Service;

use Google\Service\Gmail\MessagePart;
use Google_Service_Gmail_Message as GoogleServiceGmailMessage;

class GmailParser
{
    public function parse(GoogleServiceGmailMessage $msg): array
    {
        $payload = $msg->getPayload();

        return [
            ...$this->extractHeaders($payload->getHeaders()),
            'body' => $this->extractBody($payload),
        ];
    }

    private function extractHeaders(array $headers): array
    {
        $extractedHeaders = [
            'from' => null,
            'to' => null,
            'subject' => null,
            'date' => null,
        ];
        foreach ($headers as $header) {
            switch (strtolower($header->getName())) {
                case 'from':
                    $extractedHeaders['from'] = $header->getValue();
                    break;
                case 'to':
                    $extractedHeaders['to'] = $header->getValue();
                    break;
                case 'subject':
                    $extractedHeaders['subject'] = $header->getValue();
                    break;
                case 'date':
                    $extractedHeaders['date'] = $header->getValue();
                    break;
            }
        }
        return $extractedHeaders;
    }

    private function extractBody(MessagePart $payload): string
    {
        $parts = $payload->getParts();
        $bodyData = $payload->getBody()->getData();
        $extractedBody = '';

        if ($bodyData) {
            $extractedBody = $this->base64urlDecode($bodyData);
        } elseif (!empty($parts)) {
            foreach ($parts as $part) {
                $mimeType = $part->getMimeType();
                if ($mimeType === 'text/plain' || $mimeType === 'text/html') {
                    $extractedBody .= $this->base64urlDecode($part->getBody()->getData()) . "\n";
                }
                $extractedBody .= $this->extractBody($part);
            }
        }
        return $extractedBody;
    }

    private function base64urlDecode($data): string
    {
        return base64_decode(strtr($data, '-_', '+/'));
    }
}
