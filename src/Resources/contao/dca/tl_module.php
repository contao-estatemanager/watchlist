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
    // Add palettes
    $GLOBALS['TL_DCA']['tl_module']['palettes']['watchlistRedirector'] = '{title_legend},name,headline,type;{config_legend},jumpTo,addWatchlistCount;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID';

    // Extend immo manager listMode field options
    $GLOBALS['TL_DCA']['tl_module']['fields']['listMode']['options'][] = 'watchlist';

    // Add fields
    $GLOBALS['TL_DCA']['tl_module']['fields']['addWatchlist'] = array(
        'label'                     => &$GLOBALS['TL_LANG']['tl_module']['addWatchlist'],
        'exclude'                   => true,
        'inputType'                 => 'checkbox',
        'eval'                      => array('tl_class' => 'w50 m12'),
        'sql'                       => "char(1) NOT NULL default '0'",
    );

    $GLOBALS['TL_DCA']['tl_module']['fields']['addWatchlistCount'] = array(
        'label'                     => &$GLOBALS['TL_LANG']['tl_module']['addWatchlistCount'],
        'exclude'                   => true,
        'inputType'                 => 'checkbox',
        'eval'                      => array('tl_class' => 'w50 m12'),
        'sql'                       => "char(1) NOT NULL default '0'",
    );

    $GLOBALS['TL_DCA']['tl_module']['fields']['realEstateWatchlistTemplate'] = array(
        'label'                   => &$GLOBALS['TL_LANG']['tl_module']['realEstateWatchlistTemplate'],
        'exclude'                   => true,
        'exclude'                 => true,
        'inputType'               => 'select',
        'options_callback'        => function (){
            return Contao\Controller::getTemplateGroup('real_estate_itemext_watchlist_');
        },
        'eval'                    => array('tl_class'=>'w50'),
        'sql'                     => "varchar(64) NOT NULL default ''"
    );

    // Extend the default palettes
    Contao\CoreBundle\DataContainer\PaletteManipulator::create()
        ->addField(array('addWatchlist'), 'item_extension_legend', Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
        ->addField(array('realEstateWatchlistTemplate'), 'template_legend', Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
        ->applyToPalette('realEstateList', 'tl_module')
        ->applyToPalette('realEstateResultList', 'tl_module')
    ;
}
