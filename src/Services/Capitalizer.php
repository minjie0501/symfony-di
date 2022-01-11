<?php
namespace App\Services;

class Capitalizer implements Transform
{
    public function transform(string $value): string
    {
        $newValue = "";
        for ($x = 0; $x < strlen($value); $x++) {
            if ($x % 2 !== 0) $newValue .= strtoupper($value[$x]);
            else $newValue .= strtolower($value[$x]);
        }
        return $newValue;
    }
}