<?php
/**
 * This file is part of Oveleon ImmoManager.
 *
 * @link      https://github.com/oveleon/contao-immo-manager-bundle
 * @copyright Copyright (c) 2018-2019  Oveleon GbR (https://www.oveleon.de)
 * @license   https://github.com/oveleon/contao-immo-manager-bundle/blob/master/LICENSE
 */

// HOOKS
$GLOBALS['TL_HOOKS']['postLogin'][] = array('\\Oveleon\\ContaoImmoManagerWatchlistBundle\\Watchlist', 'postLogin');

$GLOBALS['TL_HOOKS']['generateRealEstateList'][] = array('\\Oveleon\\ContaoImmoManagerWatchlistBundle\\Watchlist', 'initializeWatchlistSession');
$GLOBALS['TL_HOOKS']['generateRealEstateExpose'][] = array('\\Oveleon\\ContaoImmoManagerWatchlistBundle\\Watchlist', 'initializeWatchlistSession');
$GLOBALS['TL_HOOKS']['generateRealEstateResultList'][] = array('\\Oveleon\\ContaoImmoManagerWatchlistBundle\\Watchlist', 'initializeWatchlistSession');

$GLOBALS['TL_HOOKS']['countItemsRealEstateList'][] = array('Oveleon\\ContaoImmoManagerWatchlistBundle\\Watchlist', 'countItems');
$GLOBALS['TL_HOOKS']['fetchItemsRealEstateList'][] = array('Oveleon\\ContaoImmoManagerWatchlistBundle\\Watchlist', 'fetchItems');

$GLOBALS['TL_HOOKS']['parseRealEstate'][] = array('Oveleon\\ContaoImmoManagerWatchlistBundle\\Watchlist', 'parseRealEstate');