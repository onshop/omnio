<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Score;

class ScoreController extends Controller
{

    /**
     * @param int $minScore
     * @return string
     */
    public function getHighestCount(int $minScore): string
    {
        $contents = Storage::get('json/scores.json');

        $scoreModel = new Score($contents);

        return $scoreModel->getHighestCount($minScore);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function patch(Request $request): string
    {
        $newScore = $request->getContent();

        $contents = Storage::get('json/scores.json');

        $scoreModel = new Score($contents);

        $newScores = $scoreModel->patch($newScore);

        Storage::disk('local')->put('json/scores.json', $newScores);

        return response()->json(
            [
                'message' => 'score updated'
            ],
            200
        );
    }

}
