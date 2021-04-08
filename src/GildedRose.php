<?php

namespace App;

class GildedRose
{
    /**
     * @var Stockable[]
     */
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Fetch all items or specific item
     *
     * @param null $which
     * @return Stockable|Stockable[]|array|mixed
     */
    public function getItem($which = null)
    {
        return ($which === null
            ? $this->items
            : $this->items[$which]
        );
    }

    /**
     * Update all items for the start of a new day
     */
    public function nextDay()
    {
        foreach ($this->items as $item) {
            $item->age();
        }
    }
}
