<?php

namespace MarkovPHP;

class WordChain
{
    /** @var  string Content to use as base */
    protected $sample;

    /** @var  int Number of words to chain */
    protected $chain;

    /** @var array Words from sample */
    protected $words;

    /**
     * @param string $sample
     * @param int $chain
     */
    public function __construct($sample, $chain = 2)
    {
        $this->sample = $sample;
        $this->words = $this->splitText($sample, $chain);
    }

    /**
     * @param int $blocks
     * @return string
     */
    public function generate($blocks = 10, $theme = null)
    {
        $startingPoint = null;

        if ($theme !== null) {
            $startingPoint = $this->getThemedLink($theme);
        }

        if (!$startingPoint) {
            $startingPoint = $this->getRandomLink();
        }

        return $this->makeChain($startingPoint, $blocks);
    }

    /**
     * Gets a random chain link
     * @return string
     */
    public function getRandomLink()
    {
        $startIndex = array_rand($this->words);

        return $this->words[$startIndex];
    }

    /**
     * Gets a chain link based on a string search
     * @param $string
     */
    public function getThemedLink($string)
    {
        $search = preg_grep('/\b' . preg_quote($string, '/') . '\b/', $this->words);
        return $search[array_rand($search)];
    }

    /**
     * @param string $sentence
     * @param int $blocks
     * @return string
     */
    public function makeChain($sentence, $blocks = 10)
    {
        $lastCouple = $sentence;

        for ($i=1; $i<=$blocks; $i++) {

            $complement = $this->findMatch($lastCouple);

            if (!$complement) {
                $complement = $this->getRandomLink();
            }

            $sentence .= ' ' . $complement;
            $lastCouple = $complement;
        }

        return $sentence;
    }

    /**
     * @param $string
     * @return string|null
     */
    public function findMatch($string)
    {
        $search = array_keys($this->words, $string);
        if (count($search)) {
            $index = $search[array_rand($search)] + 1;

            return $this->words[$index];
        }

        return null;
    }

    /**
     * @param string $text
     * @param int $chain number of words to chain
     * @return array
     */
    public function splitText($text, $chain)
    {
        $words = preg_split("/\s+/", $text);

        if ($chain == 1) {
            return $words;
        }

        $chunks = array_chunk($words, $chain);
        $split = [];

        foreach ($chunks as $chunk) {
            $split[] = implode(' ', $chunk);
        }

        return $split;
    }
}
