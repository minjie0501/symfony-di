<?php 
namespace App\Services;

class DashConverter implements Transform
{
    public function transform(string $value): string
    {
        return str_replace(' ', '-', $value);
    }
}
