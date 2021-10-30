<?php

namespace SimonProud\Lamegats\Maps;

class ResponseMap
{
    private $map;
    public function __construct()
    {
       $this->map = [];
    }

    /**
     * @return array
     */
    public function getMap(): array
    {
        return $this->map;
    }

    /**
     * @param array $map
     */
    public function setMap(array $map): void
    {
        $this->map = collect($map);
    }


}