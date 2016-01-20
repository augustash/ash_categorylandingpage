<?php
/**
 * Provides a custom SOAP client to enable communication with Streicher's
 * Microsoft Dynamics Navision (NAV) ERP system via web services (SOAP/XMLRPC)
 *
 * @category    Spe
 * @package     Spe_NavisionConnector
 * @copyright   Copyright (c) 2015 August Ash, Inc. (http://www.augustash.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/** @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

// Begin transaction
$installer->startSetup();

$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$entityTypeId     = $setup->getEntityTypeId('catalog_category');
$attributeSetId   = $setup->getDefaultAttributeSetId($entityTypeId);
$attributeGroupId = $setup->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);

$setup->addAttribute('catalog_category', 'thumbnail', array(
    'type'              => 'varchar',
    'input'             => 'image',
    'backend'           => 'catalog/category_attribute_backend_image',
    'group'             => 'General Information',
    'label'             => 'Thumbnail',
    'visible'           => 1,
    'required'          => 0,
    'user_defined'      => 1,
    'frontend_input'    => '',
    'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible_on_front'  => 1,
));

$setup->addAttributeToGroup(
    $entityTypeId,
    $attributeSetId,
    $attributeGroupId,
    'thumbnail',
    '5'  //sort_order
);


// End transaction
$installer->endSetup();
