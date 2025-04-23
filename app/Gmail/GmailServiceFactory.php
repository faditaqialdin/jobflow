<?php

namespace App\Gmail;

use App\Models\GoogleToken;
use Google_Service_Gmail as GoogleServiceGmail;

class GmailServiceFactory
{
    public function make(GoogleToken $token): GmailService
    {
        $client = app(GmailClientFactory::class)->create($token);
        $service = new GoogleServiceGmail($client);

        return new GmailService(
            new GmailFetcher($service),
            new GmailParser()
        );
    }
}
