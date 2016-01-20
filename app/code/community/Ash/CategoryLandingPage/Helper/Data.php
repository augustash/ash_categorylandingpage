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
class Ash_CategoryLandingPage_Helper_Data extends Mage_Catalog_Helper_Data
{
    /**
     * linktoCategoryThumbnail
     *
     * wraps the category thumbnail with a link to the category
     *
     * @param  Mage_Catalog_Model_Category  $category
     * @param  string                       $linkCss     # CSS classes
     * @param  integer|string               $width       # thumbnail width
     * @param  integer|string               $height      # thumbnail height
     * @return string
     */
    public function linktoCategoryThumbnail(Mage_Catalog_Model_Category $category, $linkCss = '', $width = 168, $height = 168)
    {
        $link = '';
        if ($category->getIsActive()) {
            $catUrl         = $category->getUrl();
            $catName        = $this->htmlEscape($category->getName());
            $catThumbnail   = self::displayCategoryThumbnail($category, $width, $height);
            $link = "
                <a class='{$linkCss}' href='{$catUrl}' title='{$catName}'>
                    {$catThumbnail}
                    <span class='category-name'>{$catName}</span>
                </a>
            ";
        }

        return $link;
    }

    /**
     * == displayCategoryThumbnail
     *
     * returns either the category's thumbnail image if it exists
     * or default to the placeholder image
     *
     * @param  Mage_Catalog_Model_Category  $category
     * @param  integer|string               $width    # width of the thumbnail
     * @param  integer|string               $height   # height of the thumbnail
     * @return string
     */
    public function displayCategoryThumbnail(Mage_Catalog_Model_Category $category, $width = 168, $height = 168)
    {
        /**
         * check if the category's thumbnail exists in the file structure;
         * if it doesn't then return a placeholder image
         */
        try {
            $catThumb = $category->getThumbnail();
            $filename = $this->getCategoryBaseDir() . $catThumb;

            if (!empty($catThumb) && file_exists($filename)) {
                $imgUrl = $this->getCategoryBaseUrl() . $catThumb;
            } else {
                $imgUrl = $this->getDefaultCategoryThumbnail($width, $height);
            }
        } catch (Exception $e) {
            Mage::log($e->getMessage());
            $imgUrl = $this->getDefaultCategoryThumbnail($width, $height);
        }

        $catName = $this->htmlEscape($category->getName());

        return $thumb = "<img src='{$imgUrl}' height='{$height}px' width='{$width}px' alt='{$catName}' />";
    }

    /**
     * == getDefaultCategoryThumbnail
     *
     * returns the URL path to the default placeholder image
     *
     * @param  integer|string $width
     * @param  integer|string $height
     * @return string
     */
    public function getDefaultCategoryThumbnail($width = 168, $height = 168)
    {
        $baseUrl = $this->getCategoryBaseUrl();
        return $baseUrl . "cat_placeholder_{$width}x{$height}.jpg";
    }

    /**
     * == getCategoryBaseUrl
     *
     * returns the base url for the media/catalog/category directory
     * (with a trailing slash!)
     *
     * @param  string $categoryDir # relative path to the `category` diretory
     * @return string
     */
    public function getCategoryBaseUrl($categoryDir = '/catalog/category/')
    {
        return Mage::getBaseUrl('media') . $categoryDir;
    }

    /**
     * == getCategoryBaseDir
     *
     * returns the base directory for the <FILEPATH_TO>/media/catalog/category directory
     * (with a trailing slash!)
     *
     * @param  string $categoryDir # relative path to the `category` diretory
     * @return string
     */
    public function getCategoryBaseDir($categoryDir = '/catalog/category/')
    {
        return Mage::getBaseDir('media') . $categoryDir;
    }

}
