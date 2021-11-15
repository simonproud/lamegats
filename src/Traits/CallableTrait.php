<?php

namespace SimonProud\Lamegats\Traits;

use SimonProud\Lamegats\Models\Call;

trait CallableTrait
{
    public function calls(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Call::class, 'client');
    }


    public function lastCall(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->calls()->latest('created_at');
    }


}