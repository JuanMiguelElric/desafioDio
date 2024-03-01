<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

interface AllService
{
    public function findById(string $id): Model|bool;
    public function add(array $data): Model|bool;
}
