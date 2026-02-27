<?php

namespace App\Http\Controllers\Api\Admin\Medicines;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Medicines\StoreMedicineRequest;
use App\Http\Requests\Api\Admin\Medicines\UpdateMedicineRequest;
use App\Services\Admin\Medicines\MedicineService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    protected MedicineService $medicineService;

    public function __construct(MedicineService $medicineService)
    {
        $this->medicineService = $medicineService;
    }

    public function index(Request $request): JsonResponse
    {
        try {
            $perPage = $request->get('per_page', 10);
            $page = $request->get('page', 1);

            $medicines = $this->medicineService->getAll(
                (int) $perPage,
                (int) $page
            );

            return response()->json([
                'status' => true,
                'message' => 'Medicines fetched successfully',
                'data' => $medicines
            ]);
        } catch (Throwable $e) {
            Log::error('Medicine Index Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong.'
            ], 500);
        }
    }

    public function store(StoreMedicineRequest $request): JsonResponse
    {
        try {
            $medicine = $this->medicineService->create($request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Medicine created successfully',
                'data' => $medicine
            ], 201);
        } catch (Throwable $e) {
            Log::error('Medicine Store Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong while creating medicine.'
            ], 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $medicine = $this->medicineService->find($id);

            return response()->json([
                'status' => true,
                'message' => 'Medicine found successfully',
                'data' => $medicine
            ], 200);
        } catch (Throwable $e) {
            Log::error('Medicine Show Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Medicine not found.'
            ], 404);
        }
    }

    public function update(UpdateMedicineRequest $request, int $id): JsonResponse
{
    try {
        $medicine = $this->medicineService->find($id);
        $updated = $this->medicineService->update($medicine, $request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Medicine updated successfully',
            'data' => $updated
        ]);
    } catch (\Exception $e) {
        $isNotFound = $e->getMessage() === 'Medicine not found';

        return response()->json([
            'status' => false,
            'message' => $isNotFound ? $e->getMessage() : 'An unexpected error occurred.'
        ], $isNotFound ? 404 : 500);
    }
}

    public function destroy(int $id): JsonResponse
    {
        try {
            $medicine = $this->medicineService->find($id);
            $this->medicineService->delete($medicine);

            return response()->json([
                'status' => true,
                'message' => 'Medicine deleted successfully'
            ], 200);
        } catch (Throwable $e) {
            Log::error('Medicine Delete Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => $e->getMessage() === 'Medicine not found'
                    ? 'Medicine not found'
                    : 'Something went wrong while deleting medicine.'
            ], $e->getMessage() === 'Medicine not found' ? 404 : 500);
        }
    }
}
