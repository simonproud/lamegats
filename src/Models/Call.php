<?php

namespace SimonProud\Lamegats\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $driver
 * @property string $token
 */
class Call extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function getTable()
    {
        return config('vats.table_names.calls', parent::getTable());
    }
}