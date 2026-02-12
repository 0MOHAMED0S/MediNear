<?php

namespace App\Http\Controllers\Api\Pharmacy;

use App\Http\Controllers\Controller;
use App\Http\Requests\PharmacyApplicationRequest;
use App\Services\Pharmacy\PharmacyApplicationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PharmacyApplicationController extends Controller implements HasMiddleware
{
    protected PharmacyApplicationService $service;

    public function __construct(PharmacyApplicationService $service)
    {
        $this->service = $service;
    }

    /**
     * Register middleware for the controller (Laravel 11+)
     */
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum'),
        ];
    }

    /**
     * Display a listing of the authenticated user's pharmacy applications
     */
    public function index(): JsonResponse
    {
        $applications = $this->service
            ->getUserApplications(auth()->id());

        return response()->json([
            'data' => $applications
        ]);
    }

    /**
     * Create a new pharmacy application for the authenticated user
     */
    public function store(PharmacyApplicationRequest $request): JsonResponse
    {
        try {
            $application = $this->service->createApplication(
                $request->validated(),
                auth()->id()
            );
    
            return response()->json([
                'message' => 'The application has been created successfully',
                'data' => $application
            ], 201);
    
        } catch (\Exception $e) {
    
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Show a specific pharmacy application of the authenticated user
     */
    public function show(int $id): JsonResponse
    {
        $application = $this->service
            ->getUserApplication($id, auth()->id());

        if (!$application) {
            return response()->json([
                'message' => 'Application not found'
            ], 404);
        }

        return response()->json([
            'data' => $application
        ]);
    }

    /**
     * Delete a pharmacy application
     */
    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->service
            ->deleteApplication($id, auth()->id());

        if (!$deleted) {
            return response()->json([
                'message' => 'Application not found'
            ], 404);
        }

        return response()->json([
            'message' => 'The application has been deleted successfully'
        ]);
    }
}