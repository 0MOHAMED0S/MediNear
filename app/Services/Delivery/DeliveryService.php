<?php
namespace App\Services\Delivery;
use App\Repositories\Interfaces\DeliveryRepositoryInterface;

class DeliveryService
{
    protected DeliveryRepositoryInterface $deliveryRepository;

    public function __construct(DeliveryRepositoryInterface $deliveryRepository)
    {
        $this->deliveryRepository = $deliveryRepository;
    }

    public function all()
    {
        return $this->deliveryRepository->all();
    }

    public function create(array $data)
    {
        return $this->deliveryRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->deliveryRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->deliveryRepository->delete($id);
    }
}