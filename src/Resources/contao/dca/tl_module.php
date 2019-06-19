<?php
/**
 * This file is part of Contao EstateManager.
 *
 * @link      https://www.contao-estatemanager.com/
 * @source    https://github.com/contao-estatemanager/watchlist
 * @copyright Copyright (c) 2019  Oveleon GbR (https://www.oveleon.de)
 * @license   https://www.contao-estatemanager.com/lizenzbedingungen.html
 */

if(ContaoEstateManager\Watchlist\AddonManager::valid()){
    // Extend immo manager listMode field options
    array_insert($GLOBALS['TL_DCA']['tl_module']['fields']['listMode']['options'], -1, array('watchlist'));

    // Add field
    array_insert($GLOBALS['TL_DCA']['tl_module']['fields'], -1, array(
        'addWatchlist'  => array
        (
            'label'                     => &$GLOBALS['TL_LANG']['tl_module']['addWatchlist'],
            'inputType'                 => 'checkbox',
            'eval'                      => array('tl_class' => 'w50 m12'),
            'sql'                       => "char(1) NOT NULL default '0'",
        ),
        'realEstateWatchlistTemplate' => array(
            'label'                   => &$GLOBALS['TL_LANG']['tl_module']['realEstateWatchlistTemplate'],
            'default'                 => 'real_estate_itemext_watchlist_default',
            'exclude'                 => true,
            'inputType'               => 'select',
            'options_callback'        => array('tl_module_estate_manager', 'getRealEstateExtensionTemplates'),
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "varchar(64) NOT NULL default ''"
        )
    ));

    // Extend the default palettes
    Contao\CoreBundle\DataContainer\PaletteManipulator::create()
        ->addField(array('addWatchlist'), 'item_extension_legend', Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
        ->addField(array('realEstateWatchlistTemplate'), 'template_legend', Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
        ->applyToPalette('realEstateList', 'tl_module')
        ->applyToPalette('realEstateResultList', 'tl_module')
    ;
}