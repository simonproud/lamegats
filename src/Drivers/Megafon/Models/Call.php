<?php

namespace SimonProud\Lamegats\Drivers\Megafon\Models;

class Call
{
    private string $uuid;
    private string|null $type;
    private string|null $user;
    private string|null $ext;
    private string|null $groupRealName;
    private string|null $telnum;
    private string|null $phone;
    private string|null $diversion;
    private string|null $start;
    private string|null $duration;
    private string|null $callid;
    private string|null $link;
    private string|null $status;

    public function __construct($fields)
    {
        $this->type = $fields['type'] ?? null;
        $this->user = $fields['user'] ?? null;
        $this->ext = $fields['ext'] ?? null;
        $this->groupRealName = $fields['groupRealName'] ?? null;
        $this->telnum = $fields['telnum'] ?? null;
        $this->phone = $fields['phone'] ?? null;
        $this->diversion = $fields['diversion'] ?? null;
        $this->start = $fields['start'] ?? null;
        $this->duration = $fields['duration'] ?? null;
        $this->callid = $fields['callid'] ?? null;
        $this->link = $fields['link'] ?? null;
        $this->status = $fields['status'] ?? null;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
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
    public function getStart(): string
    {
        return $this->start;
    }

    /**
     * @param string $start
     */
    public function setStart(string $start): void
    {
        $this->start = $start;
    }

    /**
     * @return string
     */
    public function getDuration(): string
    {
        return $this->duration;
    }

    /**
     * @param string $duration
     */
    public function setDuration(string $duration): void
    {
        $this->duration = $duration;
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
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

}