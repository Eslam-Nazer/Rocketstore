<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function sanitizeInputs(array $inputs): array
    {
        return collect($inputs)->map(function ($value) {
            return e(strip_tags(trim($value)));
        })->all();
    }
}
