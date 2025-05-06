<?php

namespace App\Gemini;

use Gemini\Enums\ModelType;
use Gemini\Laravel\Facades\Gemini;
use JsonException;

readonly class GeminiJobDetectorService
{
    public function __construct(private string $prompt)
    {
    }

    /**
     * @throws JsonException
     */
    public function getJob(string $text): ?array
    {
        sleep(random_int(4, 6));

        $result = Gemini::generativeModel(ModelType::GEMINI_FLASH)
            ->generateContent(
                sprintf($this->prompt, $text)
            )->text();

        $result = trim(str_replace(['```json', '```', '\n'], '', $result));

        if ($result === 'null') {
            return null;
        }

        return json_decode($result, true, 512, JSON_THROW_ON_ERROR);
    }
}
