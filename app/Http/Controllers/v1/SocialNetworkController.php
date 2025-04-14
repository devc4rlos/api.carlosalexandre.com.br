<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Helper\FilledRequest;
use App\Http\Requests\UpdateSocialNetworkRequest;
use App\Http\Requests\v1\StoreSocialNetworkRequest;
use App\Http\Resources\v1\SocialNetworkResource;
use App\Http\Response\ResponseApi;
use App\Models\SocialNetwork;

class SocialNetworkController extends Controller
{
    public function index()
    {
        return ResponseApi::builder("Social networks information retrieved successfully.")
            ->setDataResource(SocialNetworkResource::collection(SocialNetwork::all()))
            ->response();
    }

    public function store(StoreSocialNetworkRequest $request)
    {
        $socialNetwork = SocialNetwork::create($request->only('name', 'url', 'icon', 'text'));

        return ResponseApi::builder("Social network created successfully.")
            ->setDataResource(SocialNetworkResource::make($socialNetwork))
            ->setCode(201)
            ->response();
    }

    public function show(SocialNetwork $socialNetwork)
    {
        return ResponseApi::builder("Social network showed successfully.")
            ->setDataResource(SocialNetworkResource::make($socialNetwork))
            ->response();
    }

    public function update(UpdateSocialNetworkRequest $request, SocialNetwork $socialNetwork)
    {
        $data = FilledRequest::filter($request->only('name', 'url', 'icon', 'text'));

        $socialNetwork->update($data);

        return ResponseApi::builder("Social network updated successfully.")
            ->setDataResource(SocialNetworkResource::make($socialNetwork))
            ->response();
    }

    public function destroy(SocialNetwork $socialNetwork)
    {
        $socialNetwork->delete();

        return ResponseApi::builder("Social network deleted successfully.")
            ->setDataResource(SocialNetworkResource::make($socialNetwork))
            ->response();
    }
}
