<?php

namespace SimonProud\Lamegats\Console;

use Illuminate\Console\Command;
use SimonProud\Lamegats\Models\Account;
use SimonProud\Lamegats\Models\VatsSystem;

class AccountReload extends Command
{
    protected $signature = 'vats:account-reload';

    protected $description = 'Reload accounts of all vats';

    public function handle()
    {
        $this->info('Reload starts...');


        $vatses = VatsSystem::all();
        foreach ($vatses as $vats){

            $this->info('Vats #'.$vats->id);
            Account::reload($vats);
        }
        $this->info('Accounts reloaded');
    }


}