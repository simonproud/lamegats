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

    public function client(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'client_type', 'client_id');
    }

    public static function callsByPhone(string $phone){
        return self::where('phone', '=', $phone);
    }
}