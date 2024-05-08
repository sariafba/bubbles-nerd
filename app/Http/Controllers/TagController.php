<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Services\TagService;

class TagController extends Controller
{

    protected TagService $TagService;


    public function __construct(TagService $TagService)
    {
        $this->TagService = $TagService;
        $this->middleware(['auth:api'])->only('create');

    }


    public function index()
    {
        return $this->TagService->index();
    }


    public function getById(int $id)
    {
        return $this->TagService->getById($id);
    }

    public function delete(int $id)
    {
        return $this->TagService->delete($id);
    }
}
