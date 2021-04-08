<?php


namespace App;


class BackstagePass extends StockItem
{
    /**
     * Override age function for complex Backstage Pass
     */
    public function age()
    {
        if($this->sellIn <= 0)
        {
            $this->setQuality(0);
        }
        else if($this->sellIn <= 5)
        {
            $this->setAgeRate(3);
        }
        else if($this->sellIn <= 10)
        {
            $this->setAgeRate(2);
        }
        parent::age();
    }
}