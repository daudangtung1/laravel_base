<?php

namespace App\Repositories;

use App\Repositories\CrudRepository;
use App\Models\Post;

class PostRepository extends CrudRepository
{
    public function getModel()
    {
        return Post::class;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getPostHost()
    {
        return $this->model->where('id', 1)->get();
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    public function store(array $attr)
    {
        return $this->model->create($attr);
    }

    public function update(array $attr, $id)
    {
        $data = $this->show($id);
        if ($data) return $data->update($attr);
        return false;
    }

    public function delete($id)
    {
        $data = $this->show($id);
        if ($data) return $data->delete();
    }
}
