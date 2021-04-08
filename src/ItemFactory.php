<?php

namespace App;

class ItemFactory
{
    /**
     * Factory to create stick items
     *
     * @param string $name name of item
     * @param int $quality shelf life
     * @param int $sellIn best before
     * @return Stockable
     */
    public static function create(string $name, int $quality, int $sellIn): Stockable
    {
        switch ($name) {
            case Stockable::ITEM_AGED_BRIE:
                return new StockItem(Stockable::ITEM_AGED_BRIE, $quality, $sellIn, 1);
                break;
            case Stockable::ITEM_MANA_CAKE:
                return new StockItem(Stockable::ITEM_MANA_CAKE, $quality, $sellIn, -2);
                break;
            case Stockable::ITEM_BACKSTAGE_PASS:
                return new BackstagePass(Stockable::ITEM_BACKSTAGE_PASS, $quality, $sellIn, 1);
                break;
            case Stockable::ITEM_SULFURAS:
                return new StockItem(Stockable::ITEM_SULFURAS, $quality, $sellIn, 0);
                break;
            default:
                return new StockItem(Stockable::ITEM_NORMAL, $quality, $sellIn);
        }
    }
}