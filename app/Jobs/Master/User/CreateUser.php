<?php

namespace App\Jobs\Master\User;

use App\Events\Master\User\UserCreated;
use App\Models\Master\Faculty;
use App\Models\Master\User\User;
use Illuminate\Foundation\Bus\Dispatchable;
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
        $socialLoginValidator = [];
        foreach (User::getAvailableSocialLoginDrivers() as $key) {
            $socialLoginValidator[$key] = ['filled', 'unique:' . User::getTableName() . ',' . $key];
        }

        $validator = [
            'name' => ['required', 'filled'],
            'email' => ['required', 'filled', 'email', 'unique:' . User::getTableName() . ',email'],
            'password' => ['required', 'filled', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ];
        $validator = array_merge($validator, $socialLoginValidator);
        $this->attributes = Validator::make($attributes, $validator)->validate();
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
        if ($this->user->exists) {
            event(new UserCreated($this->user));
        }
        return $this->user->exists;
    }
}
