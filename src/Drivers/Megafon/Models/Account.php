<?php

namespace SimonProud\Lamegats\Drivers\Megafon\Models;

class Account
{
    private string $identifier;
    private string $name;
    private string $realName;
    private string $telnum;
    private string $email;
    private string $ext;

    public function __construct(array $fields)
    {
        $this->identifier = $fields[config('vats.response_keys.megafon.identifier')] ?? null;
        $this->name = $fields['name'] ?? null;
        $this->realName = $fields['realName'] ?? null;
        $this->telnum = $fields['telnum'] ?? null;
        $this->email = $fields['email'] ?? null;
        $this->ext = $fields['ext'] ?? null;
    }

    /**
     * @return string
     */
    public function getRealName(): string
    {
        return $this->realName;
    }

    /**
     * @param string $realName
     */
    public function setRealName(string $realName): void
    {
        $this->realName = $realName;
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
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed|string|null
     */
    public function getIdentifier(): mixed
    {
        return $this->identifier;
    }

    /**
     * @param mixed|string|null $identifier
     */
    public function setIdentifier(mixed $identifier): void
    {
        $this->identifier = $identifier;
    }
}