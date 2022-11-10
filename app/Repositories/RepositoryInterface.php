<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function getAll();

    public function getPostHost();

    public function getById($id);

    public function show($id);

    public function store(array $attr);

    public function update(array $attr, $id);

    public function delete($id);
}
