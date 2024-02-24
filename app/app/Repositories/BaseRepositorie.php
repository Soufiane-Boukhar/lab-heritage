<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositorieInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepositorie implements RepositorieInterface
{

    protected $model;

    public function __construct(Model $model){
        $this->model = $model;
    }

    public function paginate($perPage = 3, $type = null){
        $query = $this->model->query();
        
        if ($type !== null) {
            $query->where('type', $type);
        }
    
        return $query->paginate($perPage);
    }
    
    

    public function find($id){
        return $this->model->find($id);
    }

    public function create(array $data){
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $record = $this->model->find($id);

        if (!$record) {
            return false;
        }

        return $record->update($data);
    }

    public function delete($id){
        $record = $this->model->find($id);
        return $record->delete();
    }
}