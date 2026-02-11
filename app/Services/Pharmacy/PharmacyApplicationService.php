<?php

namespace App\Services\Pharmacy;

use App\Repositories\Interfaces\PharmacyApplicationRepositoryInterface;

class PharmacyApplicationService
{
    protected PharmacyApplicationRepositoryInterface $repository;

    public function __construct(PharmacyApplicationRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all applications for authenticated user
     */
    public function getUserApplications($userId)
    {
        return $this->repository->getByUser($userId);
    }

    /**
     * Create new pharmacy application
     */
    public function createApplication(array $data, $userId)
    {
        $data['user_id'] = $userId;
        $data['status'] = 'pending';

        return $this->repository->create($data);
    }

    /**
     * Get specific application
     */
    public function getUserApplication($id, $userId)
    {
        return $this->repository->findUserApplication($id, $userId);
    }

    /**
     * Delete application
     */
    public function deleteApplication($id, $userId)
    {
        $application = $this->repository->findUserApplication($id, $userId);

        if (!$application) {
            return null;
        }

        $application->delete();

        return true;
    }
}