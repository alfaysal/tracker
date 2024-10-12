<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VaccineCenterCollection extends ResourceCollection
{
    public static $wrap = null;

    public function toArray(Request $request): array
    {
        return [
            'vaccine_centers' => $this->collection,
            'message' => 'Vaccine center successfully fetched.',
        ];
    }
}
