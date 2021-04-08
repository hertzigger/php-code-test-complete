<?php


namespace App;


interface Stockable
{
    const ITEM_NORMAL = 'normal';
    const ITEM_AGED_BRIE = 'Aged Brie';
    const ITEM_SULFURAS = 'Sulfuras, Hand of Ragnaros';
    const ITEM_BACKSTAGE_PASS = 'Backstage passes to a TAFKAL80ETC concert';
    const ITEM_MANA_CAKE = 'Conjured Mana Cake';
    const MAX_QUALITY = 50;
    const MIN_QUALITY = 0;

    /**
     * @param string $sellIn
     * @return Stockable
     */
    public function setSellIn(string $sellIn): Stockable;

    /**
     * @param int $quality
     * @return StockItem
     */
    public function setQuality(int $quality): Stockable;

    /**
     * @param string $name
     * @return Stockable
     */
    public function setName(string $name): Stockable;

    /**
     * @return int
     */
    public function getSellIn(): int;

    /**
     * @return int
     */
    public function getQuality(): int;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * Age item appropriately base on product
     */
    public function age();
}