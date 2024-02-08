<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\TaskSummaryResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SummaryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $tasks = $request->user()->tasksSummary();

        // 分成完成的和還沒完成的
        return $tasks->mapToGroups(function ($item, $key) {
            return [
                ($item->is_completed ? 'completed' : 'uncompleted') => TaskSummaryResource::make($item)
            ];
        });
    }
}
