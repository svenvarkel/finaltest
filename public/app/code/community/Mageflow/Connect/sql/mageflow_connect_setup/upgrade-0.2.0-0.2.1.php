<?php
/**
 * MageFlow
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@mageflow.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * If you wish to use the MageFlow Connect extension as part of a paid
 * service please contact licence@mageflow.com for information about
 * obtaining an appropriate licence.
 */

/**
 * upgrade-0.2.0-0.2.1.php
 *
 * PHP version 5
 *
 * @category   MFX
 * @package    Mageflow_Connect
 * @subpackage Sql Install & Upgrade
 * @author     MageFlow OÜ, Estonia <info@mageflow.com>
 * @copyright  Copyright (C) 2014 MageFlow OÜ, Estonia (http://mageflow.com) 
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link       http://mageflow.com/
 */

/* @var $installer Mageflow_Connect_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$tableName = $installer->getTable('core/config_data');
if (!$installer->getConnection()->tableColumnExists($tableName, 'created_at')) {
    $installer->getConnection()->addColumn(
        $tableName,
        'created_at',
        'DATETIME NOT NULL'
    );
}
if (!$installer->getConnection()->tableColumnExists($tableName, 'updated_at')) {
    $installer->getConnection()->addColumn(
        $tableName,
        'updated_at',
        'DATETIME NOT NULL'
    );
}

$indexFields = array('created_at', 'updated_at');
$indexName = $installer->getConnection()->getIndexName(
    $tableName,
    $indexFields
);
if (!in_array(
    $idxName,
    $installer->getConnection()->getIndexList($tableName)
)
) {
    $installer->getConnection()->addIndex($tableName, $indexName, $indexFields);
}
$installer->endSetup();