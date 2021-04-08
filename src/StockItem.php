<?php


namespace App;


class StockItem extends Item implements Stockable
{
    /**
     * @var int
     */
    private $ageRate;

    /**
     * StockItem constructor.
     * @param string $name
     * @param int $quality
     * @param int $sellIn
     * @param int $ageRate
     */
    public function __construct(string $name, int $quality, int $sellIn, int $ageRate = -1)
    {
        parent::__construct($name, $quality, $sellIn);
        $this->ageRate = $ageRate;
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
     * @return Stockable
     */
    public function setName(string $name): Stockable
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getSellIn(): int
    {
        return $this->sellIn;
    }

    /**
     * @param string $sellIn
     * @return Stockable
     */
    public function setSellIn(string $sellIn): Stockable
    {
        $this->sellIn = $sellIn;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuality(): int
    {
        return $this->quality;
    }

    /**
     * @param int $quality
     * @return StockItem
     */
    public function setQuality(int $quality): Stockable
    {
        $this->quality = $quality;
        return $this;
    }

    /**
     * @param int $ageRate
     * @return Stockable
     */
    protected function setAgeRate(int $ageRate): Stockable
    {
        $this->ageRate = $ageRate;
        return $this;
    }

    /**
     * Age item appropriately base on product
     */
    public function age()
    {
        if($this->ageRate === 0)
            return;

        if($this->quality > 0 && $this->quality < 50) {
            if($this->sellIn > 0){
                $this->quality += $this->ageRate;
            } else {
                $this->quality += $this->ageRate * 2;
            }
        }

        if($this->quality > Stockable::MAX_QUALITY)
            $this->quality = Stockable::MAX_QUALITY;

        if($this->quality < Stockable::MIN_QUALITY)
            $this->quality = Stockable::MIN_QUALITY;

        $this->sellIn--;
    }
}