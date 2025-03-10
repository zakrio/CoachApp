<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Coach;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class CoachController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $search = $request->string('search');

        $coaches = Coach::query()
            ->when($search, function (Builder $query) use ($search): void {
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(20);

        return response()->json([
            'user' => $user,
            'coaches' => $coaches,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Coach $coach): JsonResponse
    {
        $cycle = $coach->cycles()->get();

        return response()->json([
            'user' => $request->user(),
            'coach' => $coach,
            'cycle' => $cycle,
        ]);
    }
}
