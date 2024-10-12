<?php
namespace App\Interfaces;
interface RepositoryInterface
{
    public function find(int $id);
    public function all();
}
