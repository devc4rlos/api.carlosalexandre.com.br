<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\GeneralInfoResource;
use App\Models\GeneralInfo;

class ContactController extends Controller
{
    public function __invoke()
    {
        return response()->api(new GeneralInfoResource(GeneralInfo::first()));
    }
}
