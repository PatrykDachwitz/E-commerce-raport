<?php

namespace App\Http\Controllers\Api\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComparisonController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $structureWithValueAndArt = [
            'value' => 122,
            'art' => 122,
        ];

        $response = [
            'resultsFromBeginnerMonthCurrentYear' => $structureWithValueAndArt,
            'resultsFromBeginnerMonthPreviousYear' => $structureWithValueAndArt,
            'resultsFromBeginnerMonthComparisonYear' => $structureWithValueAndArt,
            'avgResultMonthCurrentYear' => $structureWithValueAndArt,
            'avgResultMonthPreviousYear' => $structureWithValueAndArt,
            'avgResultMonthComparisonYear' => $structureWithValueAndArt,
            'resultsFromBeginnerPreviousMonthCurrentYear' => $structureWithValueAndArt,
            'resultsFromBeginnerComparisonMont' => $structureWithValueAndArt,
        ];

        return response([
            'data' => $response
        ]);
    }
}
