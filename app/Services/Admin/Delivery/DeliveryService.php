<?php
namespace App\Services\admin\Delivery;
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

    //image upload
    public function create(array $data)
    {
        if (isset($data['image'])) {
            $image = $data['image'];
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/delivery'), $imageName);
            $data['image'] = 'images/delivery/' . $imageName;
        }
        return $this->deliveryRepository->create($data);
    }

    //update with image upload
    public function update($id, array $data)
    {
        if (isset($data['image'])) {
            $image = $data['image'];
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/delivery'), $imageName);
            $data['image'] = 'images/delivery/' . $imageName;
        }
        return $this->deliveryRepository->update($id, $data);
    }

    public function find($id)
    {
        return $this->deliveryRepository->find($id);
    }   
    public function delete($id)
    {
        return $this->deliveryRepository->delete($id);
    }
}