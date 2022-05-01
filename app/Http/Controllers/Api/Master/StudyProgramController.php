<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Http\Resources\Master\StudyProgramOptionResource;
use App\Models\Master\Faculty;
use App\Models\Master\StudyProgram;
use App\Traits\OptionResourceable;
use App\Traits\usePagination;
use Illuminate\Http\Request;

class StudyProgramController extends Controller
{
    use usePagination, OptionResourceable;

    public function index(Request $request): \Rezky\LaravelResponseFormatter\Http\Response|\Illuminate\Http\JsonResponse
    {
        return $this->search($request, StudyProgram::class, ['name,code' => 'search'],['id','faculty_id'=>'chainValue'],StudyProgramOptionResource::class);
    }
}
