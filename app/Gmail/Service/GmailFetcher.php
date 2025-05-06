<?php

namespace App\Gmail\Service;

use Google;
use Google_Service_Gmail as GoogleServiceGmail;
use Google_Service_Gmail_Message as GoogleServiceGmailMessage;
use Random\RandomException;

readonly class GmailFetcher
{
    public function __construct(private GoogleServiceGmail $service)
    {
    }

    /**
     * @throws Google\Service\Exception
     * @throws RandomException
     */
    public function fetchMessages(string $query): array
    {
        $messages = [];
        $pageToken = null;

        do {
            $optParams = ['q' => $query, 'maxResults' => 100];
            if ($pageToken) {
                $optParams['pageToken'] = $pageToken;
            }

            $response = $this->service->users_messages->listUsersMessages('me', $optParams);

            foreach ($response->getMessages() ?? [] as $msg) {
                $messages[] = $msg;
            }

            $pageToken = $response->getNextPageToken();
        } while ($pageToken);

        return $messages;
    }

    /**
     * @throws Google\Service\Exception
     */
    public function fetchMessageById(string $id): GoogleServiceGmailMessage
    {
        return $this->service->users_messages->get('me', $id, ['format' => 'full']);
    }
}
