<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PharmacyApplicationRequest;
use App\Models\PharmacyApplication;
use Illuminate\Http\JsonResponse;

class PharmacyApplicationController extends Controller
{
    public function store(PharmacyApplicationRequest $request): JsonResponse
    {
        $application = PharmacyApplication::create([
            'user_id' => auth()->id(),
            'status' => 'pending',
            ...$request->validated()
        ]);

        return response()->json([
            'message' => 'Data submitted successfully',
            'data' => $application
        ], 201);
    }

    public function show(): JsonResponse
    {
        $application = PharmacyApplication::where('user_id', auth()->id())->first();

        if (!$application) {
            return response()->json([
                'message' => 'No application found for this user'
            ], 404);
        }

        return response()->json([
            'data' => $application,
            'is_open_now' => $application->is_open_now
        ]);
    }
}