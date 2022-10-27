<?php

declare(strict_types=1);

/*
 * This file is part of Contao EstateManager.
 *
 * @see        https://www.contao-estatemanager.com/
 * @source     https://github.com/contao-estatemanager/watchlist
 * @copyright  Copyright (c) 2021 Oveleon GbR (https://www.oveleon.de)
 * @license    https://www.contao-estatemanager.com/lizenzbedingungen.html
 */

use Contao\Controller;
use Contao\CoreBundle\DataContainer\PaletteManipulator;
use ContaoEstateManager\Watchlist\AddonManager;

if (AddonManager::valid())
{
    // Add palettes
    $GLOBALS['TL_DCA']['tl_module']['palettes']['watchlistRedirector'] = '{title_legend},name,headline,type;{config_legend},jumpTo,addWatchlistCount;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID';

    // Extend immo manager listMode field options
    $GLOBALS['TL_DCA']['tl_module']['fields']['listMode']['options'][] = 'watchlist';

    // Add fields
    $GLOBALS['TL_DCA']['tl_module']['fields']['addWatchlist'] = [
        'label' => &$GLOBALS['TL_LANG']['tl_module']['addWatchlist'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['tl_class' => 'w50 m12'],
        'sql' => "char(1) NOT NULL default '0'",
    ];

    $GLOBALS['TL_DCA']['tl_module']['fields']['addWatchlistCount'] = [
        'label' => &$GLOBALS['TL_LANG']['tl_module']['addWatchlistCount'],
        'exclude' => true,
        'inputType' => 'checkbox',
        'eval' => ['tl_class' => 'w50 m12'],
        'sql' => "char(1) NOT NULL default '0'",
    ];

    $GLOBALS['TL_DCA']['tl_module']['fields']['realEstateWatchlistTemplate'] = [
        'label' => &$GLOBALS['TL_LANG']['tl_module']['realEstateWatchlistTemplate'],
        'exclude' => true,
        'inputType' => 'select',
        'options_callback' => static fn () => Controller::getTemplateGroup('real_estate_itemext_watchlist_'),
        'eval' => ['tl_class' => 'w50'],
        'sql' => "varchar(64) NOT NULL default ''",
    ];

    // Extend the default palettes
    PaletteManipulator::create()
        ->addField(['addWatchlist'], 'item_extension_legend', PaletteManipulator::POSITION_APPEND)
        ->addField(['realEstateWatchlistTemplate'], 'template_legend', PaletteManipulator::POSITION_APPEND)
        ->applyToPalette('realEstateList', 'tl_module')
        ->applyToPalette('realEstateResultList', 'tl_module')
    ;
}
