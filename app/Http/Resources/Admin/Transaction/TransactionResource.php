<?php

namespace App\Http\Resources\Admin\Transaction;

use App\Models\Transaction\Transaction;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var Transaction $data */
        $data = $this->resource;
        $user = $data->user->detail;
        $faculty = $data->faculty;
        $studyProgram = $data->studyProgram;
        $files = $data->attachments;
        $data->unsetRelations();
        return array_merge($data->toArray(), [
            'user' => $user,
            'faculty' => $faculty,
            'study_program' => $studyProgram,
            'files' => $files
        ]);
    }
}
