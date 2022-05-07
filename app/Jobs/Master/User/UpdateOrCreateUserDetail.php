<?php

namespace App\Jobs\Master\User;

use App\Models\Master\User\Detail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Validator;

class UpdateOrCreateUserDetail
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $attributes;
    public Detail|null $userDetail;

    /**
     * Create a new job instance.
     *
     * @param array $attributes
     * @param null $userDetail
     * @throws \Illuminate\Validation\ValidationException
     */
    public function __construct($attributes = [], $userDetail = null)
    {

        $this->attributes = Validator::make($attributes, [
            'name' => ['required', 'filled'],
            'student_id' => ['filled'],
            'faculty_id' => ['filled', 'exists:m_faculties,id'],
            'study_program_id' => ['filled', 'exists:m_study_programs,id'],
            'phone' => ['filled']
        ])->validate();
        $this->userDetail = $userDetail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->userDetail instanceof Detail) {
            // TODO : update user detail
            $this->userDetail->update($this->attributes);
        } else {
            // TODO : create user detail
            $this->userDetail = new Detail($this->attributes);
            $this->userDetail->save();
        }

    }
}
