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
class Ash_CategoryLandingPage_Block_Catalog_Navigation extends Mage_Catalog_Block_Navigation
{
    /**
     * class constructor
     */
    protected function _construct()
    {
        parent::_construct();
    }

    /**
     * Retrieve child categories of current category
     *
     * Changes: Use `thumbnail` instead of `image`
     *
     *      $collection->addAttributeToSelect('thumbnail');
     *
     * @return Varien_Data_Tree_Node_Collection
     */
    public function getCurrentChildCategories()
    {

        $layer = Mage::getSingleton('catalog/layer');
        $category   = $layer->getCurrentCategory();
        /* @var $category Mage_Catalog_Model_Category */
        $collection = Mage::getModel('catalog/category')->getCollection();
        /* @var $collection Mage_Catalog_Model_Resource_Eav_Mysql4_Category_Collection */
        $collection->addAttributeToSelect('url_key')
            ->addAttributeToSelect('name')
            ->addAttributeToSelect('is_anchor')
            ->addAttributeToSelect('thumbnail')
            ->addAttributeToFilter('is_active', 1)
            ->addIdFilter($category->getChildren())
            ->setOrder('position', 'ASC')
            ->addUrlRewriteToResult()
            ->load();

        $productCollection = Mage::getResourceModel('catalog/product_collection');
        $layer->prepareProductCollection($productCollection);
        $productCollection->addCountToCategories($collection);
        return $collection;
    }

}
