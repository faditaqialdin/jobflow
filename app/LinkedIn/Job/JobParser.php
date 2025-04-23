<?php

namespace App\LinkedIn\Job;

use Symfony\Component\DomCrawler\Crawler;

class JobParser
{
    public function parseJobDescription(string $html): string
    {
        $crawler = new Crawler($html);
        $container = $crawler->filter('.show-more-less-html__markup');
        return $this->extractTextPreservingFormatting($container);
    }

    private function extractTextPreservingFormatting(Crawler $crawler): string
    {
        $newlineTags = ['p', 'br', 'div', 'ul', 'li', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'];
        $text = '';

        foreach ($crawler as $node) {
            foreach ($node->childNodes as $child) {
                if ($child->nodeType === XML_TEXT_NODE) {
                    $textContent = trim($child->textContent);
                    if (!empty($textContent)) {
                        $text .= $textContent . ' ';
                    }
                } elseif ($child->nodeType === XML_ELEMENT_NODE) {
                    $text .= $this->extractTextPreservingFormatting(new Crawler($child));
                    if (in_array(strtolower($child->nodeName), $newlineTags)) {
                        $text .= "\n";
                    }
                }
            }
        }

        return trim($text);
    }
}
