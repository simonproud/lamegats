<?php

namespace SimonProud\Lamegats\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $driver
 * @property string $token
 */
class VatsSystem extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function findByTokenAndName(string $token, string $driver): VatsSystem
    {
        return static::where([['driver', '=', $driver], ['token', '=', $token]])->firstOrFail();
    }

    public function getTable()
    {
        return config('vats.table_names.vats_systems', parent::getTable());
    }
}