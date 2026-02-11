<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PharmacyApplicationRequest;
use App\Repositories\Interfaces\PharmacyApplicationRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PharmacyApplicationController extends Controller implements HasMiddleware
{
    protected PharmacyApplicationRepositoryInterface $repository;

    public function __construct(PharmacyApplicationRepositoryInterface $repository)
    {
        $this->repository = $repository;
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
        $applications = auth()->user()
            ->pharmacyApplications()
            ->latest()
            ->get();

        return response()->json([
            'data' => $applications
        ]);
    }

    /**
     * Create a new pharmacy application for the authenticated user
     */
    public function store(PharmacyApplicationRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['status'] = 'pending';

        $application = $this->repository->create($data);

        return response()->json([
            'message' => 'The application has been created successfully',
            'data' => $application
        ], 201);
    }

    /**
     * Show a specific pharmacy application of the authenticated user
     */
    public function show($id): JsonResponse
    {
        $application = $this->repository
            ->findUserApplication($id, auth()->id());

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
    public function destroy($id): JsonResponse
    {
        $application = $this->repository
            ->findUserApplication($id, auth()->id());

        if (!$application) {
            return response()->json([
                'message' => 'Application not found'
            ], 404);
        }

        $application->delete();

        return response()->json([
            'message' => 'The application has been deleted successfully'
        ]);
    }
}