<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use App\Score;

class ScoreTest extends TestCase
{
    const SCORES = [
        0 => [
            'Player' => 'Sam',
            'Score' => 7,
        ],
        1 => [
            'Player' => 'Jane',
            'Score' => 9,
        ],
        2 => [
            'Player' => 'Bill',
            'Score' => 4,
        ],
        3 => [
            'Player' => 'Ted',
            'Score' => 1,
        ],
    ];

    public function testShowHighestScores()
    {
        $score = new Score(json_encode($this::SCORES));

        self::assertEquals($score->getHighestCount(1), '["Count: 3"]');
    }

    public function testUpdate()
    {
        $score = new Score(json_encode($this::SCORES));

        $newScore = [
            'Player' => 'Sam',
            'Score' => 12,
        ];

        $newScore = json_encode($newScore);

        $expectedScores = [
            0 => [
                'Player' => 'Sam',
                'Score' => 12,
            ],
            1 => [
                'Player' => 'Jane',
                'Score' => 9,
            ],
            2 => [
                'Player' => 'Bill',
                'Score' => 4,
            ],
            3 => [
                'Player' => 'Ted',
                'Score' => 1,
            ],
        ];

        $expectedScores = json_encode($expectedScores);

        self::assertEquals($expectedScores, $score->patch($newScore));
    }
}
