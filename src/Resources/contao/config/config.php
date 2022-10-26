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
$GLOBALS['TL_ESTATEMANAGER_ADDONS'][] = ['ContaoEstateManager\Watchlist', 'AddonManager'];

use ContaoEstateManager\Watchlist\AddonManager;
use ContaoEstateManager\Watchlist\Watchlist;
use ContaoEstateManager\Watchlist\ModuleWatchlistRedirector;
use ContaoEstateManager\Watchlist\ExposeModuleWatchlist;

if (AddonManager::valid())
{
    // Add expose module
    $GLOBALS['FE_EXPOSE_MOD']['miscellaneous']['watchlist'] = ExposeModuleWatchlist::class;

    // Add front end modules
    $GLOBALS['FE_MOD']['estatemanager']['watchlistRedirector'] = ModuleWatchlistRedirector::class;

    // Hooks
    $GLOBALS['TL_HOOKS']['postLogin'][] = [Watchlist::class, 'postLogin'];

    $GLOBALS['TL_HOOKS']['generateRealEstateList'][] = [Watchlist::class, 'initializeWatchlistSession'];
    $GLOBALS['TL_HOOKS']['compileRealEstateExpose'][] = [Watchlist::class, 'initializeWatchlistSession'];
    $GLOBALS['TL_HOOKS']['generateRealEstateResultList'][] = [Watchlist::class, 'initializeWatchlistSession'];
    $GLOBALS['TL_HOOKS']['generateRealEstateProjectList'][] = [Watchlist::class, 'initializeWatchlistSession'];

    $GLOBALS['TL_HOOKS']['countItemsRealEstateList'][] = [Watchlist::class, 'countItems'];
    $GLOBALS['TL_HOOKS']['fetchItemsRealEstateList'][] = [Watchlist::class, 'fetchItems'];

    $GLOBALS['TL_HOOKS']['parseRealEstate'][] = [Watchlist::class, 'parseRealEstate'];
}
