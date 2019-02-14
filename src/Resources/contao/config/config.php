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

$GLOBALS['TL_HOOKS']['generateList'][] = array('\\Oveleon\\ContaoImmoManagerWatchlistBundle\\Watchlist', 'initializeWatchlistSession');
$GLOBALS['TL_HOOKS']['generateExpose'][] = array('\\Oveleon\\ContaoImmoManagerWatchlistBundle\\Watchlist', 'initializeWatchlistSession');
$GLOBALS['TL_HOOKS']['generateResultList'][] = array('\\Oveleon\\ContaoImmoManagerWatchlistBundle\\Watchlist', 'initializeWatchlistSession');

$GLOBALS['TL_HOOKS']['realEstateListCountItems'][] = array('Oveleon\\ContaoImmoManagerWatchlistBundle\\Watchlist', 'countItems');
$GLOBALS['TL_HOOKS']['realEstateListFetchItems'][] = array('Oveleon\\ContaoImmoManagerWatchlistBundle\\Watchlist', 'fetchItems');

$GLOBALS['TL_HOOKS']['parseRealEstate'][] = array('Oveleon\\ContaoImmoManagerWatchlistBundle\\Watchlist', 'parseRealEstate');