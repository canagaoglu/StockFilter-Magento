<?php

class Canagaoglu_Stockfilter_Model_Observer {
    /**
     * Before loading a collection filter out of stock items if necessary (based on the instockonly URL param).
     *
     * @param Varien_Event_Observer $observer
     * @return void
     */
    public function catalogProductCollectionLoadBefore(Varien_Event_Observer $observer) {        
        
        $collection = $observer->getCollection();

        if (Mage::getStoreConfigFlag(Mage_CatalogInventory_Helper_Data::XML_PATH_SHOW_OUT_OF_STOCK, Mage::app()->getStore()->getId()) == 0) {    
            //only do this if it hasn't already been done.
            //check if the query string contains the alias 'bestviewed'
            if(!strpos((string)$collection->getSelect(), 'inventory_in_stock') > 0) {
                Mage::getSingleton('cataloginventory/stock')->addInStockFilterToCollection($collection);
            }
            
        }/*else{
            Mage::getSingleton('cataloginventory/stock')->addInStockFilterToCollection($collection);
            $collection->getSelect()->where('at_inventory_in_stock.is_in_stock in (?)', $this->getStatuses());
        }
        */
    }

     /**
     * get available statuses
     * @return array
     */
    public function getStatuses() {
        return array(
            Mage_CatalogInventory_Model_Stock::STOCK_IN_STOCK,
            Mage_CatalogInventory_Model_Stock::STOCK_OUT_OF_STOCK
        );
    }
}