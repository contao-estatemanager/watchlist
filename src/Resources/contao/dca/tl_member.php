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