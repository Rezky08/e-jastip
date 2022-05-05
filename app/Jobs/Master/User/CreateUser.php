<?php

namespace App\Jobs\Master\User;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CreateUser
{
    use Dispatchable, SerializesModels;

    public User $user;
    public array $attributes;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($attributes = [])
    {
        $this->attributes = Validator::make($attributes, [
            'name' => ['required', 'filled'],
            'email' => ['required', 'filled', 'email'],
            'password' => ['required', 'filled','confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ])->validate();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
     $this->user = new User($this->attributes);
     $this->user->save();
    }
}
