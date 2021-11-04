<?php

namespace SimonProud\Lamegats\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $driver
 * @property string $token
 */
class Event extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function getTable()
    {
        return config('vats.table_names.events', parent::getTable());
    }


}