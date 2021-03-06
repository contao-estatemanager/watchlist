<?php
/**
 * This file is part of Contao EstateManager.
 *
 * @link      https://www.contao-estatemanager.com/
 * @source    https://github.com/contao-estatemanager/watchlist
 * @copyright Copyright (c) 2019  Oveleon GbR (https://www.oveleon.de)
 * @license   https://www.contao-estatemanager.com/lizenzbedingungen.html
 */

// ESTATEMANAGER
$GLOBALS['TL_ESTATEMANAGER_ADDONS'][] = array('ContaoEstateManager\\Watchlist', 'AddonManager');

if(ContaoEstateManager\Watchlist\AddonManager::valid()) {
    // Add expose module
    $GLOBALS['FE_EXPOSE_MOD']['miscellaneous']['watchlist'] = '\\ContaoEstateManager\\Watchlist\\ExposeModuleWatchlist';

    // Add front end modules
    $GLOBALS['FE_MOD']['estatemanager']['watchlistRedirector'] = '\\ContaoEstateManager\\Watchlist\\ModuleWatchlistRedirector';

    // Hooks
    $GLOBALS['TL_HOOKS']['postLogin'][] = array('\\ContaoEstateManager\\Watchlist\\Watchlist', 'postLogin');

    $GLOBALS['TL_HOOKS']['generateRealEstateList'][] = array('\\ContaoEstateManager\\Watchlist\\Watchlist', 'initializeWatchlistSession');
    $GLOBALS['TL_HOOKS']['compileRealEstateExpose'][] = array('\\ContaoEstateManager\\Watchlist\\Watchlist', 'initializeWatchlistSession');
    $GLOBALS['TL_HOOKS']['generateRealEstateResultList'][] = array('\\ContaoEstateManager\\Watchlist\\Watchlist', 'initializeWatchlistSession');
    $GLOBALS['TL_HOOKS']['generateRealEstateProjectList'][] = array('\\ContaoEstateManager\\Watchlist\\Watchlist', 'initializeWatchlistSession');

    $GLOBALS['TL_HOOKS']['countItemsRealEstateList'][] = array('ContaoEstateManager\\Watchlist\\Watchlist', 'countItems');
    $GLOBALS['TL_HOOKS']['fetchItemsRealEstateList'][] = array('ContaoEstateManager\\Watchlist\\Watchlist', 'fetchItems');

    $GLOBALS['TL_HOOKS']['parseRealEstate'][] = array('ContaoEstateManager\\Watchlist\\Watchlist', 'parseRealEstate');
}
