<?php
/**
 * This file is part of Oveleon ImmoManager.
 *
 * @link      https://github.com/oveleon/contao-immo-manager-bundle
 * @copyright Copyright (c) 2018-2019  Oveleon GbR (https://www.oveleon.de)
 * @license   https://github.com/oveleon/contao-immo-manager-bundle/blob/master/LICENSE
 */

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
        'default'                 => 'real_estate_watchlist_default',
        'exclude'                 => true,
        'inputType'               => 'select',
        'options_callback'        => array('tl_module_immo_manager_watchlist', 'getRealEstateWatchlistTemplates'),
        'eval'                    => array('tl_class'=>'w50'),
        'sql'                     => "varchar(64) NOT NULL default ''"
    )
));

// Extend the default palettes
Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('watchlist_legend', 'template_legend', Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_BEFORE)
    ->addField(array('addWatchlist'), 'watchlist_legend', Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->addField(array('realEstateWatchlistTemplate'), 'template_legend', Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('realEstateList', 'tl_module')
;

/**
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @author Daniele Sciannimanica <daniele@oveleon.de>
 */
class tl_module_immo_manager_watchlist extends Backend
{

    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }

    /**
     * Return all real estate list templates as array
     *
     * @return array
     */
    public function getRealEstateWatchlistTemplates()
    {
        return $this->getTemplateGroup('real_estate_watchlist_');
    }
}