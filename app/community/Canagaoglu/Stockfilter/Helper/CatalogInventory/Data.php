<?php
class Canagaoglu_Stockfilter_Helper_CatalogInventory_Data extends Mage_CatalogInventory_Helper_Data
{
	/**
     * Display out of stock products option
     *
     * @return bool
     */
    public function isShowOutOfStock()
    {
        return true;
    }
}