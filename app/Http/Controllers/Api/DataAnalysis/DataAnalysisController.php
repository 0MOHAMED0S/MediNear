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
    return User::select([
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
}

    /**
     * Pharmacies Dataset
     */
    public function pharmacies(Request $request)
    {
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
        ]);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('created_at', [
                $request->from,
                $request->to
            ]);
        }

        return response()->json($query->get());
    }

    /**
     * Medicines Dataset
     */
    public function medicines(Request $request)
    {
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

        return response()->json($query->get());
    }

    /**
     * Categories Dataset
     */
    public function categories(Request $request)
    {
        $query = Category::select([
            'id',
            'name',
            'is_active',
            'created_at'
        ]);

        return response()->json($query->get());
    }
}
