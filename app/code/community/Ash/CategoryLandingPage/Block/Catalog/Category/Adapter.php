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

/**
 * For compatibility with Mirasvit_SeoFilter or other modules
 *
 * @copyright   Copyright (c) 2015 August Ash, Inc. (http://www.augustash.com)
 * @author      Josh Johnson (August Ash)
 */
if (Mage::helper('core')->isModuleEnabled('Mirasvit_SeoFilter')) {
    class Ash_CategoryLandingPage_Block_Catalog_Category_Adapter extends Mirasvit_SeoFilter_Block_Category_View {}
} else {
    class Ash_CategoryLandingPage_Block_Catalog_Category_Adapter extends Mage_Catalog_Block_Category_View {}
}
