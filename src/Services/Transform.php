<?php 
namespace App\Services;

interface Transform
{
    public function transform(string $value): string;
}

