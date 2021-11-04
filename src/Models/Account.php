<?php

namespace SimonProud\Lamegats\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SimonProud\Lamegats\Facades\Lamegats;

/**
 * @property string $driver
 * @property string $token
 * @property int $id
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
        $accounts = [];
        $accountsResponse = $lamegate->getToAts()->accounts(['token' => $vatsSystem->auth_token]);
        foreach ($accountsResponse as $item){
            $accounts[] = Account::firstOrCreate(['vats_systems_id' => $vatsSystem->id, 'identifier' => $item->getIdentifier()]);
        }
        return $accounts;
    }

    public static function findByVatsIdentifier(VatsSystem $vatsSystem, string $identifier):self
    {
       return Account::where([['vats_systems_id', '=', $vatsSystem->id],[ 'identifier','=', $identifier ]])->first();
    }
}