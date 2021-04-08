<?php

use App\Item;
use App\GildedRose;
use App\ItemFactory;
use App\Stockable;
use App\StockItem;

describe('Gilded Rose', function () {
    describe('next day', function () {
        context('normal Items', function () {
            it('updates normal items before sell date', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_NORMAL, 10, 5)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(9);
                expect($gr->getItem(0)->sellIn)->toBe(4);
            });
            it('updates normal items on the sell date', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_NORMAL, 10, 0)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(8);
                expect($gr->getItem(0)->sellIn)->toBe(-1);
            });
            it('updates normal items after the sell date', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_NORMAL, 10, -5)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(8);
                expect($gr->getItem(0)->sellIn)->toBe(-6);
            });
            it('updates normal items with a quality of 0', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_NORMAL, 0, 5)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(0);
                expect($gr->getItem(0)->sellIn)->toBe(4);
            });
        });
        context('Brie Items', function () {
            it('updates Brie items before the sell date', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_AGED_BRIE, 10, 5)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(11);
                expect($gr->getItem(0)->sellIn)->toBe(4);
            });
            it('updates Brie items before the sell date with maximum quality', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_AGED_BRIE, 50, 5)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(50);
                expect($gr->getItem(0)->sellIn)->toBe(4);
            });
            it('updates Brie items on the sell date', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_AGED_BRIE, 10, 0)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(12);
                expect($gr->getItem(0)->sellIn)->toBe(-1);
            });
            it('updates Brie items on the sell date, near maximum quality', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_AGED_BRIE, 49, 0)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(50);
                expect($gr->getItem(0)->sellIn)->toBe(-1);
            });
            it('updates Brie items on the sell date with maximum quality', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_AGED_BRIE, 50, 0)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(50);
                expect($gr->getItem(0)->sellIn)->toBe(-1);
            });
            it('updates Brie items after the sell date', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_AGED_BRIE, 10, -10)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(12);
                expect($gr->getItem(0)->sellIn)->toBe(-11);
            });
            it('updates Brie items after the sell date with maximum quality', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_AGED_BRIE, 50, -10)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(50);
                expect($gr->getItem(0)->sellIn)->toBe(-11);
            });
        });
        context('Sulfuras Items', function () {
            it('updates Sulfuras items before the sell date', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_SULFURAS, 10, 5)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(10);
                expect($gr->getItem(0)->sellIn)->toBe(5);
            });
            it('updates Sulfuras items on the sell date', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_SULFURAS, 10, 5)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(10);
                expect($gr->getItem(0)->sellIn)->toBe(5);
            });
            it('updates Sulfuras items after the sell date', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_SULFURAS, 10, -1)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(10);
                expect($gr->getItem(0)->sellIn)->toBe(-1);
            });
        });
        context('Backstage Passes', function () {
            it('updates Backstage pass items long before the sell date', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_BACKSTAGE_PASS,10, 11)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(11);
                expect($gr->getItem(0)->sellIn)->toBe(10);
            });
            it('updates Backstage pass items close to the sell date', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_BACKSTAGE_PASS, 10, 10)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(12);
                expect($gr->getItem(0)->sellIn)->toBe(9);
            });
            it('updates Backstage pass items close to the sell data, at max quality', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_BACKSTAGE_PASS, 50, 10)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(50);
                expect($gr->getItem(0)->sellIn)->toBe(9);
            });
            it('updates Backstage pass items very close to the sell date', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_BACKSTAGE_PASS, 10, 5)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(13); // goes up by 3
                expect($gr->getItem(0)->sellIn)->toBe(4);
            });
            it('updates Backstage pass items very close to the sell date, at max quality', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_BACKSTAGE_PASS, 50, 5)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(50);
                expect($gr->getItem(0)->sellIn)->toBe(4);
            });
            it('updates Backstage pass items with one day left to sell', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_BACKSTAGE_PASS, 10, 1)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(13);
                expect($gr->getItem(0)->sellIn)->toBe(0);
            });
            it('updates Backstage pass items with one day left to sell, at max quality', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_BACKSTAGE_PASS, 50, 1)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(50);
                expect($gr->getItem(0)->sellIn)->toBe(0);
            });
            it('updates Backstage pass items on the sell date', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_BACKSTAGE_PASS, 10, 0)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(0);
                expect($gr->getItem(0)->sellIn)->toBe(-1);
            });
            it('updates Backstage pass items after the sell date', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_BACKSTAGE_PASS, 10, -1)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(0);
                expect($gr->getItem(0)->sellIn)->toBe(-2);
            });
        });
        context("Conjured Items", function () {
            it('updates Conjured items before the sell date', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_MANA_CAKE, 10, 10)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(8);
                expect($gr->getItem(0)->sellIn)->toBe(9);
            });
            it('updates Conjured items at zero quality', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_MANA_CAKE, 0, 10)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(0);
                expect($gr->getItem(0)->sellIn)->toBe(9);
            });
            it('updates Conjured items on the sell date', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_MANA_CAKE, 10, 0)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(6);
                expect($gr->getItem(0)->sellIn)->toBe(-1);
            });
            it('updates Conjured items on the sell date at 0 quality', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_MANA_CAKE, 0, 0)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(0);
                expect($gr->getItem(0)->sellIn)->toBe(-1);
            });
            it('updates Conjured items after the sell date', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_MANA_CAKE, 10, -10)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(6);
                expect($gr->getItem(0)->sellIn)->toBe(-11);
            });
            it('updates Conjured items after the sell date at zero quality', function () {
                $gr = new GildedRose([ItemFactory::create(Stockable::ITEM_MANA_CAKE, 0, -10)]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(0);
                expect($gr->getItem(0)->sellIn)->toBe(-11);
            });
        });
    });
});
