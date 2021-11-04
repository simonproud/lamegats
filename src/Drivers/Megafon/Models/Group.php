<?php

namespace SimonProud\Lamegats\Drivers\Megafon\Models;

class Group
{
    private mixed $id;
    private mixed $realName;

    public function __construct(array $fields)
    {
        $this->id = $fields['id'];
        $this->realName = $fields['realName'];
    }

    /**
     * @return mixed
     */
    public function getRealName(): mixed
    {
        return $this->realName;
    }

    /**
     * @param mixed $realName
     */
    public function setRealName(mixed $realName): void
    {
        $this->realName = $realName;
    }

    /**
     * @return mixed
     */
    public function getId(): mixed
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId(mixed $id): void
    {
        $this->id = $id;
    }
}