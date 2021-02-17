<?php

namespace App;

/**
 * Class Score
 * @package App
 */
class Score
{
    /** @var array $scores */
    private $scores;

    /**
     * Score constructor.
     * @param array $scores
     */
    public function __construct(string $scores)
    {
        $this->scores = json_decode($scores, true);
    }

    /**
     * @param int $minScore
     * @return string
     */
    public function getHighestCount(int $minScore): string
    {
        $higherScores = 0;

        foreach ($this->scores as $score) {
            if ($score['Score'] > $minScore) {
                $higherScores++;
            }
        }

        return json_encode(['Count: ' . $higherScores]);
    }

    /**
     * @param string $newScore
     * @return string
     */
    public function patch(string $newScore): string
    {
        $newScore = json_decode($newScore, true);

        $targetName = $newScore['Player'];
        $targetScore = $newScore['Score'];

        foreach ($this->scores as &$score) {
            if ($score['Player'] === $targetName) {
                $score['Score'] = $targetScore;
            }
        }

        return json_encode($this->scores);
    }
}
