<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ContactResource;
use App\Http\Resources\v1\GeneralInfoResource;
use App\Http\Resources\v1\LinkResource;
use App\Http\Resources\v1\SocialNetworkResource;
use App\Http\Response\ResponseApi;
use App\Models\GeneralInfo;
use App\Models\Link;
use App\Models\SocialNetwork;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __invoke(Request $request)
    {
        $infos = GeneralInfoResource::make(GeneralInfo::first())->toArray($request);

        return ResponseApi::builder("Contact information retrieved successfully.")
            ->setDataResource(ContactResource::make([
                'infos' => $infos,
                'links' => LinkResource::collection(Link::all()),
                'social-networks' => SocialNetworkResource::collection(SocialNetwork::all()),
            ]))
            ->response();
    }
}
