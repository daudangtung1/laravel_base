<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function getAll();

    public function find($id);

    public function show($id);

    public function store(array $attr);

    public function updateById(array $attr, $id);

    public function delete($id);
}
