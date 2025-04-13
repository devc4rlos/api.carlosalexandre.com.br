<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\GeneralInfoResource;
use App\Http\Response\ResponseApi;
use App\Models\GeneralInfo;

class ContactController extends Controller
{
    public function __invoke()
    {
        return ResponseApi::builder("Contact information retrieved successfully.")
            ->setDataResource(new GeneralInfoResource(GeneralInfo::first()))
            ->response();
    }
}
