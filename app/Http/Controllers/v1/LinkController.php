<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Helper\FilledRequest;
use App\Http\Requests\v1\StoreLinkRequest;
use App\Http\Requests\v1\UpdateLinkRequest;
use App\Http\Resources\v1\LinkResource;
use App\Http\Response\ResponseApi;
use App\Models\Link;

class LinkController extends Controller
{
    public function index()
    {
        return ResponseApi::builder("Links information retrieved successfully.")
            ->setDataResource(LinkResource::collection(Link::all()))
            ->response();
    }

    public function store(StoreLinkRequest $request)
    {
        $link = Link::create($request->only('name', 'url'));

        return ResponseApi::builder("Link created successfully.")
            ->setDataResource(LinkResource::make($link))
            ->setCode(201)
            ->response();
    }

    public function show(Link $link)
    {
        return ResponseApi::builder("Link showed successfully.")
            ->setDataResource(LinkResource::make($link))
            ->response();
    }

    public function update(UpdateLinkRequest $request, Link $link)
    {
        $data = FilledRequest::filter($request->only('name', 'url'));

        $link->update($data);

        return ResponseApi::builder("Link updated successfully.")
            ->setDataResource(LinkResource::make($link))
            ->response();
    }

    public function destroy(Link $link)
    {
        $link->delete();

        return ResponseApi::builder("Link deleted successfully.")
            ->setDataResource(LinkResource::make($link))
            ->response();
    }
}
