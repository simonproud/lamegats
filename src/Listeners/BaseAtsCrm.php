<?php

namespace SimonProud\Lamegats\Listeners;

use Illuminate\Support\Facades\Config;
use SimonProud\Lamegats\Events\AtsCrm;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use SimonProud\Lamegats\Exception\HandlerNotFound;

/**
 * Base Class AtsCrmEventsListener
 * @package Lamegats\Listeners
 */
class BaseAtsCrm implements IBaseAtsCrm
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param AtsCrm $event
     * @return bool
     * @throws HandlerNotFound
     */
    public function handle(AtsCrm $event)
    {
        $method = 'on' . ucfirst($event->cmd);

        // Проверим токен, если его нету, прекратим пробрасывать событие вниз.
        // Stop propagation if no token.
        if ($event->data['crm_token'] !== Config::get('megafon.sign')) {
            return false;
        }

        if (method_exists($this, $method)) {
            $this->{$method}($event);
        } else {
            throw new HandlerNotFound('Handler to ' . $event->cmd . ' not found');
        }
    }
}
