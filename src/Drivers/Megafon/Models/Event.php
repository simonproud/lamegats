<?php

namespace SimonProud\Lamegats\Drivers\Megafon\Models;

class Event
{
    private string|null $type;
    private string|null $phone;
    private string|null $diversion;
    private string|null $groupRealName;
    private string|null $ext;
    private string|null $telnum;
    private string|null $callid;
    private string|null $user;

    public function __construct(array $fields)
    {
        $this->type = $fields['type'] ?? null;
        $this->phone = $fields['phone'] ?? null;
        $this->diversion = $fields['diversion'] ?? null;
        $this->groupRealName = $fields['groupRealName'] ?? null;
        $this->telnum = $fields['telnum'] ?? null;
        $this->callid = $fields['callid'] ?? null;
        $this->user = $fields['user'] ?? null;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getDiversion(): string
    {
        return $this->diversion;
    }

    /**
     * @param string $diversion
     */
    public function setDiversion(string $diversion): void
    {
        $this->diversion = $diversion;
    }

    /**
     * @return string
     */
    public function getGroupRealName(): string
    {
        return $this->groupRealName;
    }

    /**
     * @param string $groupRealName
     */
    public function setGroupRealName(string $groupRealName): void
    {
        $this->groupRealName = $groupRealName;
    }

    /**
     * @return string
     */
    public function getExt(): string
    {
        return $this->ext;
    }

    /**
     * @param string $ext
     */
    public function setExt(string $ext): void
    {
        $this->ext = $ext;
    }

    /**
     * @return string
     */
    public function getTelnum(): string
    {
        return $this->telnum;
    }

    /**
     * @param string $telnum
     */
    public function setTelnum(string $telnum): void
    {
        $this->telnum = $telnum;
    }

    /**
     * @return string
     */
    public function getCallid(): string
    {
        return $this->callid;
    }

    /**
     * @param string $callid
     */
    public function setCallid(string $callid): void
    {
        $this->callid = $callid;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @param string $user
     */
    public function setUser(string $user): void
    {
        $this->user = $user;
    }

}