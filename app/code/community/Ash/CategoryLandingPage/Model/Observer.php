<?php
/**
 * Simple module for extending the Mage_Catalog display of
 * category landing pages to offer displaying subcategories
 * in a thumbnail grid instead of a sidebar.
 *
 * @category    Ash
 * @package     Ash_CategoryLandingPage
 * @copyright   Copyright (c) 2015 August Ash, Inc. (http://www.augustash.com)
 * @author      Josh Johnson (August Ash)
 */
class Ash_CategoryLandingPage_Model_Observer
{
    /**
     * Dynamically change page layout based on Category's display mode
     *
     * @param Varien_Event_Observer $observer
     */
    public function addCustomHandles(Varien_Event_Observer $observer)
    {
        $update = Mage::getSingleton('core/layout')->getUpdate();

        if ($category = Mage::registry('current_category')) {
            $displayMode = $category->getDisplayMode();

            if ($displayMode == Ash_CategoryLandingPage_Helper_Data::DM_SUBCATEGORIES
                || $displayMode == Ash_CategoryLandingPage_Helper_Data::DM_SUBCATEGORIES_MIXED) {

                // Add our custom layout update to remove the category sidebar
                // navigation and change the root template to page/1column.phtml
                $update->addHandle('catalog_category_custom_subcategories_only');
            }
        } else {
            return;
        }
    }
}
