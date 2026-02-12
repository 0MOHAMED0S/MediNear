<?php

namespace App\Services\Pharmacy;

use App\Repositories\Interfaces\PharmacyApplicationRepositoryInterface;
use Exception;

class PharmacyApplicationService
{
    protected PharmacyApplicationRepositoryInterface $repository;

    public function __construct(PharmacyApplicationRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     *  Get applications for authenticated user only
     */
    public function getUserApplications(int $userId)
    {
        return $this->repository->getByUser($userId);
    }

    /**
     *  Create new pharmacy application (Always Pending)
     */
    public function createApplication(array $data, int $userId)
    {
        //  منع تكرار طلب Pending
        if ($this->repository->hasPendingApplication($userId)) {
            throw new Exception('You already have a pending application.');
        }

        return $this->repository->create([
            ...$data,
            'user_id' => $userId,
            'status' => 'pending', // إجبار الحالة
        ]);
    }

    /**
     *  Get specific application for user only
     */
    public function getUserApplication(int $id, int $userId)
    {
        return $this->repository->findUserApplication($id, $userId);
    }

    /**
     *  Delete application (User can delete his own only)
     */
    public function deleteApplication(int $id, int $userId)
    {
        $application = $this->repository->findUserApplication($id, $userId);

        if (!$application) {
            return false;
        }

        $application->delete();
        return true;
    }

    /**
     *  Admin: Get all applications
     */
    public function getAllApplications()
    {
        return $this->repository->getAll();
    }

    /**
     *  Admin: Find by id
     */
    public function findById(int $id)
    {
        return $this->repository->findById($id);
    }

    /**
     *  Admin: Delete any application
     */
    public function deleteByAdmin(int $id)
    {
        $application = $this->repository->findById($id);

        if (!$application) {
            return false;
        }

        $application->delete();
        return true;
    }
}