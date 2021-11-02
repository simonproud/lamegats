<?php

namespace SimonProud\Lamegats\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SimonProud\Lamegats\Facades\Lamegats;

/**
 * @property string $driver
 * @property string $token
 */
class Account extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function getTable()
    {
        return config('vats.table_names.accounts', parent::getTable());
    }

    public static function reload(VatsSystem $vatsSystem){
        $lamegate = Lamegats::make($vatsSystem);
        $accounts = json_decode($lamegate->getToAts()->accounts(['token' => $vatsSystem->auth_token])->getBody(), true);

        foreach ($accounts as $account){
            Account::updateOrCreate([
                'vats_systems_id' => $vatsSystem->id,
                'identifier' => $account['name']
            ]);
        }

    }
}