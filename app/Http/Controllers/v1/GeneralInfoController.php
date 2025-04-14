<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Helper\FilledRequest;
use App\Http\Requests\v1\UpdateGeneralInfoRequest;
use App\Http\Resources\v1\GeneralInfoResource;
use App\Http\Response\ResponseApi;
use App\Models\GeneralInfo;

class GeneralInfoController extends Controller
{
    public function update(UpdateGeneralInfoRequest $request)
    {
        $info = GeneralInfo::first();
        $data = FilledRequest::filter($request->only([
            'name',
            'email',
            'phone',
            'title',
            'bio',
            'location',
            'timezone',
            'experience_years',
            'freelance_available'
        ]));

        $info->update($data);

        return ResponseApi::builder("General information updated successfully.")
            ->setDataResource(GeneralInfoResource::make($info))
            ->setCode(200)
            ->response();
    }
}
