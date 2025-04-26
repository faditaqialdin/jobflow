<?php

namespace App\Gmail\Service;

use Google;
use Illuminate\Support\Collection;
use Throwable;

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
                sleep(random_int(4, 6));
                $raw = $this->fetcher->fetchMessageById($msgRef->getId());
                $result[] = $this->parser->parse($raw);
            } catch (Throwable $throwable) {
                report($throwable);
            }
        }

        return collect($result);
    }
}

