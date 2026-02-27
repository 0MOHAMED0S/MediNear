<?php

namespace App\Http\Controllers\Api\DataAnalysis;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PharmacyApplication;
use App\Models\Medicine;
use App\Models\Category;
use Illuminate\Http\Request;

class DataAnalysisController extends Controller
{
    /**
     * Users Dataset
     */
    public function users()
    {
        try {
            $users = User::select([
                    'users.id',
                    'users.name',
                    'users.email',
                    'users.provider',
                    'users.is_active',
                    'users.created_at',
                    'roles.name as role'
                ])
                ->leftJoin('model_has_roles', function ($join) {
                    $join->on('users.id', '=', 'model_has_roles.model_id')
                        ->where('model_has_roles.model_type', User::class);
                })
                ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'Users dataset fetched successfully',
                'data' => $users
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch users dataset: ' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    }

    /**
     * Pharmacies Dataset (Approved Only)
     */
    public function pharmacies(Request $request)
    {
        try {
            $query = PharmacyApplication::select([
                    'id',
                    'user_id',
                    'pharmacy_name',
                    'status',
                    'is_24_hours',
                    'is_delivery',
                    'latitude',
                    'longitude',
                    'created_at'
                ])
                ->where('status', 'approved');

            if ($request->filled('from') && $request->filled('to')) {
                $query->whereBetween('created_at', [
                    $request->from,
                    $request->to
                ]);
            }

            $pharmacies = $query->get();

            return response()->json([
                'status' => true,
                'message' => 'Approved pharmacies dataset fetched successfully',
                'data' => $pharmacies
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch pharmacies dataset: ' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    }

    /**
     * Medicines Dataset
     */
    public function medicines(Request $request)
    {
        try {
            $query = Medicine::select([
                    'id',
                    'name',
                    'category_id',
                    'manufacturer',
                    'status',
                    'created_at'
                ]);

            if ($request->filled('category_id')) {
                $query->where('category_id', $request->category_id);
            }

            if ($request->filled('from') && $request->filled('to')) {
                $query->whereBetween('created_at', [
                    $request->from,
                    $request->to
                ]);
            }

            $medicines = $query->get();

            return response()->json([
                'status' => true,
                'message' => 'Medicines dataset fetched successfully',
                'data' => $medicines
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch medicines dataset: ' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    }

    /**
     * Categories Dataset
     */
    public function categories()
    {
        try {
            $categories = Category::select([
                    'id',
                    'name',
                    'is_active',
                    'created_at'
                ])
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'Categories dataset fetched successfully',
                'data' => $categories
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch categories dataset: ' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    }
}
