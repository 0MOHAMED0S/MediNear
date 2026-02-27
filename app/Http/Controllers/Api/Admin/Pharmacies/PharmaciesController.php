<?php

namespace App\Http\Controllers\Api\Admin\Pharmacies;

use App\Http\Controllers\Controller;
use App\Http\Requests\PharmaciesRequest;
use App\Models\Pharmacy;
use App\Models\PharmacyApplication;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;

class PharmaciesController extends Controller
{

    //crud(approve, create, cancel)database transaction(for approved requests) && try and catch for error handling

    public function index()
    {
        $applications = PharmacyApplication::latest()->get();
        return response()->json([
            'data' => $applications
        ]);
    }

    //     public function approve($id)
    //     {
    //         DB::beginTransaction();

    //     //show single pharmacy application
    //     public function show(string $id)
    //     {
    //         try {
    //             $application = PharmacyApplication::findOrFail($id);
    //             return response()->json([
    //                 'data' => $application
    //             ]);
    //         } catch (\Exception $e) {
    //             return response()->json([
    //                 'message' => 'Error fetching pharmacy application',
    //                 'error' => $e->getMessage()
    //             ], 500);
    //         }
    //     }




    public function approve($id)
    {
        DB::beginTransaction();

        try {
            $application = PharmacyApplication::findOrFail($id);

            if ($application->status !== 'pending') {
                return response()->json([
                    'message' => 'This application has already been processed'
                ], 400);
            }

            // 1️⃣ إنشاء Pharmacy
            Pharmacy::create([
                'pharmacy_application_id' => $application->id,
                'pharmacy_name' => $application->pharmacy_name,
                'owner_name' => $application->owner_name,
                'phone_number' => $application->phone_number,
                'address' => $application->address,
                'latitude' => $application->latitude,
                'longitude' => $application->longitude,
                'license_number' => $application->license_number,
                'license_image' => $application->license_image,
                'commercial_number' => $application->commercial_number,
                'national_id_number' => $application->national_id_number,
                'expiration_date' => $application->expiration_date,
                'opening_time' => $application->opening_time,
                'closing_time' => $application->closing_time,
                'is_24_hours' => $application->is_24_hours,
                'is_delivery' => $application->is_delivery,
                'is_active' => true,
            ]);

            // 2️⃣ تحديث حالة الطلب
            $application->update([
                'status' => 'approved'
            ]);

            // 3️⃣ تحديث دور المستخدم إلى pharmacy
            $user = $application->user; // Assuming relation exists
            if ($user) {
                // إزالة أي أدوار سابقة (اختياري)
                $user->syncRoles(['pharmacy']);
            }

            DB::commit();

            return response()->json([
                'message' => 'The application has been approved successfully'
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function reject($id)
    {
        try {
            $application = PharmacyApplication::findOrFail($id);
            if ($application->status !== 'pending') {
                return response()->json([
                    'message' => 'This application has already been processed'
                ], 400);
            }

            // Update the application status
            $application->update(['status' => 'rejected']);

            return response()->json([
                'message' => 'The application has been rejected successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
