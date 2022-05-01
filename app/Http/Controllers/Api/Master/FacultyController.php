<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Http\Resources\Master\StudyProgramOptionResource;
use App\Models\Master\Faculty;
use App\Traits\OptionResourceable;
use App\Traits\usePagination;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    use usePagination, OptionResourceable;

    public function index(Request $request): \Rezky\LaravelResponseFormatter\Http\Response|\Illuminate\Http\JsonResponse
    {
        return $this->search($request, Faculty::class, ['name,code' => 'search'],['id'],StudyProgramOptionResource::class);
    }
}
