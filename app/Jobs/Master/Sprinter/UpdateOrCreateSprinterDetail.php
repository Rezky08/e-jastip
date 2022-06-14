<?php

namespace App\Jobs\Master\Sprinter;

use App\Events\Master\Sprinter\SprinterDetailCreated;
use App\Events\Master\Sprinter\SprinterDetailUpdated;
use App\Models\Master\Sprinter\Detail;
use App\Models\Master\Sprinter\Sprinter;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Validator;

class UpdateOrCreateSprinterDetail
{
    use Dispatchable, SerializesModels;

    protected array $attributes;
    public Detail|null $sprinterDetail;
    public Sprinter|null $sprinter;

    /**
     * Create a new job instance.
     *
     * @param array $attributes
     * @param null $userDetail
     * @throws \Illuminate\Validation\ValidationException
     */
    public function __construct(array $attributes = [], $sprinter = null)
    {
        $this->sprinter = $sprinter;
        $this->sprinterDetail = $this->sprinter?->detail;

        $this->attributes = Validator::make($attributes, [
            'name' => ['required', 'filled'],
            'phone' => ['filled', 'phone:AUTO,ID']
        ])->validate();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->sprinter->name = $this->attributes['name'] ?? $this->sprinter->name;
        $this->sprinter->save();

        if ($this->sprinterDetail instanceof Detail) {
            // TODO : update user detail
            $this->sprinterDetail->update($this->attributes);
            event(new SprinterDetailUpdated($this->sprinterDetail));

        } else {
            // TODO : create user detail
            $this->sprinterDetail = new Detail($this->attributes);
            $this->sprinter->detail()->save($this->sprinterDetail);
            event(new SprinterDetailCreated($this->sprinterDetail));
        }

    }
}
