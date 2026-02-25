<?php

namespace App\Http\Controllers\Api\Admin\Delivery;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeliveryRequest;
use App\Services\Delivery\DeliveryService;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    protected $deliveryService;

    public function __construct(DeliveryService $deliveryService)
    {
        $this->deliveryService = $deliveryService;
    }

    // GET ALL
    public function index()
    {
        try {
            $deliveries = $this->deliveryService->all();

            return response()->json([
                'data' => $deliveries
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching deliveries',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // CREATE
    public function store(DeliveryRequest $request)
    {
        try {
            $delivery = $this->deliveryService->create($request->validated());

            return response()->json([
                'message' => 'Delivery created successfully',
                'data' => $delivery
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating delivery',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // UPDATE
    public function update(DeliveryRequest $request, string $id)
    {
        try {
            $delivery = $this->deliveryService->update($id, $request->validated());

            if (!$delivery) {
                return response()->json([
                    'message' => 'Delivery not found'
                ], 404);
            }

            return response()->json([
                'message' => 'Delivery updated successfully',
                'data' => $delivery
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating delivery',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // DELETE
    public function destroy(string $id)
    {
        try {
            $deleted = $this->deliveryService->delete($id);

            if (!$deleted) {
                return response()->json([
                    'message' => 'Delivery not found'
                ], 404);
            }

            return response()->json([
                'message' => 'Delivery deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting delivery',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}