<?php

namespace App\Jobs\Master\Admin;

use App\Events\Master\Admin\AdminCreated;
use App\Models\Master\Admin;
use App\Models\Master\Faculty;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CreateAdmin
{
    use Dispatchable, SerializesModels;

    public array $attributes;
    public Admin $admin;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($attributes = [])
    {
        $this->attributes = Validator::make($attributes, [
            'name' => ['required', 'filled'],
            'email' => ['required', 'filled', 'email', 'unique:' . Admin::getTableName() . ',email'],
            'faculty_id' => ['filled', 'exists:' . Faculty::getTableName() . ',id'],
            'password' => ['required', 'filled', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ])->validate();
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        $this->admin = new Admin($this->attributes);
        $this->admin->save();
        if ($this->admin->exists) {
            event(new AdminCreated($this->admin));
        }
        return $this->admin->exists;
    }
}
