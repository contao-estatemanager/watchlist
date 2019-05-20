<?php
/**
 * This file is part of Oveleon ImmoManager.
 *
 * @link      https://github.com/oveleon/contao-immo-manager-bundle
 * @copyright Copyright (c) 2018-2019  Oveleon GbR (https://www.oveleon.de)
 * @license   https://github.com/oveleon/contao-immo-manager-bundle/blob/master/LICENSE
 */

if(Oveleon\ContaoImmoManagerWatchlistBundle\AddonManager::valid()){
    // Add fields
    array_insert($GLOBALS['TL_DCA']['tl_member']['fields'], 1, array
    (
        'watchlist' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_module']['watchlist'],
            'sql'                     => "blob NULL"
        )
    ));
}