<?php

namespace SimonProud\Lamegats\Facades;

use SimonProud\Lamegats\Drivers\Megafon\Services\CrmToAts;
use SimonProud\Lamegats\Interfaces\IDriver;
use SimonProud\Lamegats\Interfaces\IFromCrm;
use SimonProud\Lamegats\Interfaces\IToCrm;
use SimonProud\Lamegats\Models\VatsSystem;

class Lamegats
{
    private VatsSystem $vats;
    private IFromCrm $toAts;
    private IToCrm $toCrm;
    private IDriver $driver;
    private string $token;
    private string $authToken;

    public static function make(VatsSystem $vats):self
    {
        $lamegats = new self();
        $lamegats->setVats($vats);
        $lamegats->setToken($vats->token);
        $lamegats->setAuthToken($vats->auth_token);

        $driverClass = $vats->driver;
        $driver = new $driverClass($lamegats->getVats());
        if($driver instanceof IDriver){
            $lamegats->setDriver($driver);
            $lamegats->setToAts($driver->getCrmToAts());
            $lamegats->setToCrm($driver->getAtsToCrm());
        }else{
            throw new \Exception('vats driver except');
        }
        return $lamegats;
    }

    protected static function getFacadeAccessor()
    {
        return 'lamegats';
    }

    /**
     * @return IFromCrm
     */
    public function getToAts(): IFromCrm
    {
        return $this->toAts;
    }

    /**
     * @param IFromCrm $toAts
     */
    public function setToAts(IFromCrm $toAts): void
    {
        $this->toAts = $toAts;
    }

    /**
     * @return IToCrm
     */
    public function getToCrm(): IToCrm
    {
        return $this->toCrm;
    }

    /**
     * @param IToCrm $toCrm
     */
    public function setToCrm(IToCrm $toCrm): void
    {
        $this->toCrm = $toCrm;
    }

    /**
     * @return VatsSystem
     */
    public function getVats(): VatsSystem
    {
        return $this->vats;
    }

    /**
     * @param VatsSystem $vats
     */
    public function setVats(VatsSystem $vats): void
    {
        $this->vats = $vats;
    }

    /**
     * @return IDriver
     */
    public function getDriver(): IDriver
    {
        return $this->driver;
    }

    /**
     * @param IDriver $driver
     */
    public function setDriver(IDriver $driver): void
    {
        $this->driver = $driver;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getAuthToken(): string
    {
        return $this->authToken;
    }

    /**
     * @param string $authToken
     */
    public function setAuthToken(string $authToken): void
    {
        $this->authToken = $authToken;
    }


}