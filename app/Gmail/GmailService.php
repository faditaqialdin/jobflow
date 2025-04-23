<?php

namespace App\Gmail;

use Exception;
use Google;
use Illuminate\Support\Collection;

readonly class GmailService
{
    public function __construct(
        private GmailFetcher $fetcher,
        private GmailParser  $parser,
    )
    {
    }

    /**
     * @throws Google\Service\Exception
     */
    public function getMessages(string $query): Collection
    {
        $result = [];

        foreach ($this->fetcher->fetchMessages($query) as $msgRef) {
            try {
                $raw = $this->fetcher->fetchMessageById($msgRef->getId());
                $result[] = $this->parser->parse($raw);
            } catch (Exception $e) {
                report($e);
            }
        }

        return collect($result);
    }
}

