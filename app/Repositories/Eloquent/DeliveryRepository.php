<?php
namespace App\Repositories\Eloquent;
use App\Models\Delivery;
use App\Repositories\Interfaces\DeliveryRepositoryInterface;
class DeliveryRepository implements DeliveryRepositoryInterface
{
    protected Delivery $model;

    public function __construct(Delivery $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->latest()->get();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $delivery = $this->find($id);
        if ($delivery) {
            $delivery->update($data);
            return $delivery;
        }
        return null;
    }

    public function delete($id)
    {
        $delivery = $this->find($id);
        if ($delivery) {
            return $delivery->delete();
        }
        return false;
    }
}