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

// ESTATEMANAGER
$GLOBALS['TL_ESTATEMANAGER_ADDONS'][] = ['ContaoEstateManager\\Watchlist', 'AddonManager'];

use ContaoEstateManager\Watchlist\AddonManager;

if (AddonManager::valid())
{
    // Add expose module
    $GLOBALS['FE_EXPOSE_MOD']['miscellaneous']['watchlist'] = '\\ContaoEstateManager\\Watchlist\\ExposeModuleWatchlist';

    // Add front end modules
    $GLOBALS['FE_MOD']['estatemanager']['watchlistRedirector'] = '\\ContaoEstateManager\\Watchlist\\ModuleWatchlistRedirector';

    // Hooks
    $GLOBALS['TL_HOOKS']['postLogin'][] = ['\\ContaoEstateManager\\Watchlist\\Watchlist', 'postLogin'];

    $GLOBALS['TL_HOOKS']['generateRealEstateList'][] = ['\\ContaoEstateManager\\Watchlist\\Watchlist', 'initializeWatchlistSession'];
    $GLOBALS['TL_HOOKS']['compileRealEstateExpose'][] = ['\\ContaoEstateManager\\Watchlist\\Watchlist', 'initializeWatchlistSession'];
    $GLOBALS['TL_HOOKS']['generateRealEstateResultList'][] = ['\\ContaoEstateManager\\Watchlist\\Watchlist', 'initializeWatchlistSession'];
    $GLOBALS['TL_HOOKS']['generateRealEstateProjectList'][] = ['\\ContaoEstateManager\\Watchlist\\Watchlist', 'initializeWatchlistSession'];

    $GLOBALS['TL_HOOKS']['countItemsRealEstateList'][] = ['ContaoEstateManager\\Watchlist\\Watchlist', 'countItems'];
    $GLOBALS['TL_HOOKS']['fetchItemsRealEstateList'][] = ['ContaoEstateManager\\Watchlist\\Watchlist', 'fetchItems'];

    $GLOBALS['TL_HOOKS']['parseRealEstate'][] = ['ContaoEstateManager\\Watchlist\\Watchlist', 'parseRealEstate'];
}
