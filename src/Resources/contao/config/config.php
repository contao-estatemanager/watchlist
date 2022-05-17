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
    $GLOBALS['CEM_FE_EXPOSE_MOD']['miscellaneous']['watchlist'] = ExposeModuleWatchlist::class;

    // Add front end modules
    $GLOBALS['FE_MOD']['estatemanager']['watchlistRedirector'] = ModuleWatchlistRedirector::class;

    // Hooks
    $GLOBALS['TL_HOOKS']['postLogin'][] = [Watchlist::class, 'postLogin'];

    $GLOBALS['CEM_HOOKS']['generateRealEstateList'][] = [Watchlist::class, 'initializeWatchlistSession'];
    $GLOBALS['CEM_HOOKS']['compileRealEstateExpose'][] = [Watchlist::class, 'initializeWatchlistSession'];
    $GLOBALS['CEM_HOOKS']['generateRealEstateResultList'][] = [Watchlist::class, 'initializeWatchlistSession'];
    $GLOBALS['CEM_HOOKS']['generateRealEstateProjectList'][] = [Watchlist::class, 'initializeWatchlistSession'];

    $GLOBALS['CEM_HOOKS']['countItemsRealEstateList'][] = [Watchlist::class, 'countItems'];
    $GLOBALS['CEM_HOOKS']['fetchItemsRealEstateList'][] = [Watchlist::class, 'fetchItems'];

    $GLOBALS['CEM_HOOKS']['parseRealEstate'][] = [Watchlist::class, 'parseRealEstate'];
}
