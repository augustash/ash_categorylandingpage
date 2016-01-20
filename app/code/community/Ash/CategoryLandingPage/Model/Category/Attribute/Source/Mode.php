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
class Ash_CategoryLandingPage_Model_Category_Attribute_Source_Mode extends Mage_Catalog_Model_Category_Attribute_Source_Mode
{
    public function getAllOptions()
    {
        $options = parent::getAllOptions();

        $options[] = array(
            'value' => Ash_CategoryLandingPage_Block_Catalog_Category_View::DM_SUBCATEGORIES,
            'label' => Mage::helper('catalog')->__('Subcategories only'),
        );

        return $options;
    }
}
