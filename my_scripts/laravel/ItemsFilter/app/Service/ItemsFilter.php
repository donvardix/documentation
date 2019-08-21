<?php


namespace App\Service;


class ItemsFilter extends QueryFilter
{
    public function game($value)
    {
        $this->query->where('game', $value);
    }

    public function type($value)
    {
        $this->query->where('type', $value);
    }

    public function rarity($value)
    {
        $this->query->where('rarity', $value);
    }
}
