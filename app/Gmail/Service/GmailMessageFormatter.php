<?php

namespace App\Gmail\Service;

use App\Models\User;

class GmailMessageFormatter
{
    public function format(User $user, array $message): string
    {
        $currentEmail = $user->gmail ?? $user->email;
        $text = '';

        if (!str_contains($message['from'], $currentEmail)) {
            $text .= "from: {$message['from']}\n";
        }
        if (!str_contains($message['to'], $currentEmail)) {
            $text .= "to: {$message['to']}\n";
        }

        $text .= "subject: {$message['subject']}\n";
        $text .= "date: {$message['date']}\n";

        return $text;
    }
}
