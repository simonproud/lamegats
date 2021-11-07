<?php

namespace SimonProud\Lamegats\Drivers\Megafon\Models;

class Call
{
    private string|null $uuid;
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
    public function getUuid(): string|null
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
    public function getType(): string|null
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
    public function getUser(): string|null
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
    public function getExt(): string|null
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
    public function getGroupRealName(): string|null
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
    public function getTelnum(): string|null
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
    public function getPhone(): string|null
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
    public function getDiversion(): string|null
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
    public function getStart(): string|null
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
    public function getDuration(): string|null
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
    public function getCallid(): string|null
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
    public function getLink(): string|null
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
    public function getStatus(): string|null
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