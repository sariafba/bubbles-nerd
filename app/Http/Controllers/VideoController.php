<?php

namespace App\Http\Controllers;

use App\Http\Requests\video\StoreVideoRequest;
use App\Http\Requests\video\UpdateVideoRequest;
use App\Services\VideoService;

class VideoController extends Controller
{
    protected videoService $videoService;


    public function __construct(videoService $videoService)
    {
        $this->videoService = $videoService;
        $this->middleware(['auth:api'])->only('create');

    }


    public function index()
    {
        return $this->videoService->index();
    }


    public function getById(int $id)
    {
        return $this->videoService->getById($id);
    }

    public function getByUser(int $userId)
    {
        return $this->videoService->getByUser($userId);
    }

    public function create(StorevideoRequest $data)
    {
        return $this->videoService->create($data->safe()->all());
    }


    public function update(UpdatevideoRequest $data, $id)
    {
        return $this->videoService->update($data->safe()->all(), $id);
    }


    public function delete(int $id)
    {
        return $this->videoService->delete($id);
    }

    public function searchForVideo($name)
    {
        return $this->videoService->searchForVideo($name);
    }

}
