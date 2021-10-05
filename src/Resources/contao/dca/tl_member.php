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

use ContaoEstateManager\Watchlist\AddonManager;

if (AddonManager::valid())
{
    // Add fields
    $GLOBALS['TL_DCA']['tl_member']['fields']['watchlist'] = [
        'label' => &$GLOBALS['TL_LANG']['tl_module']['watchlist'],
        'sql' => 'blob NULL',
    ];
}
