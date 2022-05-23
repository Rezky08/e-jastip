<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Http\Resources\Master\StudyProgramOptionResource;
use App\Http\Resources\Master\UniversityOptionResource;
use App\Models\Master\StudyProgram;
use App\Models\Master\University;
use App\Traits\DataSearchResourceable;
use App\Traits\usePagination;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    use usePagination, DataSearchResourceable;

    public function index(Request $request): \Rezky\LaravelResponseFormatter\Http\Response|\Illuminate\Http\JsonResponse
    {
        return $this->search($request, University::class, ['name' => 'search'],['id'],UniversityOptionResource::class);
    }
}
