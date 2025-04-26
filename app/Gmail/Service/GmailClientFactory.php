<?php

namespace App\Gmail\Service;

use App\Models\GoogleToken;
use Google\Exception;
use Google_Client as GoogleClient;

readonly class GmailClientFactory
{
    public function __construct(private string $clientId, private string $clientSecret)
    {
    }

    /**
     * @throws Exception
     */
    public function create(GoogleToken $token): GoogleClient
    {
        $client = new GoogleClient();

        $client->setAuthConfig([
            'client_id' => $this->clientId, config('services.google.client_id'),
            'client_secret' => $this->clientSecret,
        ]);

        $client->setAccessToken([
            'access_token' => $token->access_token,
            'refresh_token' => $token->refresh_token,
            'expires_in' => $token->expires_at->diffInSeconds(now()),
        ]);

        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            $token->update([
                'access_token' => $client->getAccessToken()['access_token'],
                'expires_at' => now()->addSeconds($client->getAccessToken()['expires_in']),
            ]);
        }

        return $client;
    }
}

