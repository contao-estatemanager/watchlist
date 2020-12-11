<?php
/**
 * This file is part of Contao EstateManager.
 *
 * @link      https://www.contao-estatemanager.com/
 * @source    https://github.com/contao-estatemanager/watchlist
 * @copyright Copyright (c) 2019  Oveleon GbR (https://www.oveleon.de)
 * @license   https://www.contao-estatemanager.com/lizenzbedingungen.html
 */

namespace ContaoEstateManager\Watchlist;

use Contao\FrontendTemplate;
use Contao\FrontendUser;
use Contao\Input;
use Contao\MemberModel;
use Contao\StringUtil;
use Contao\System;
use ContaoEstateManager\Translator;
use ContaoEstateManager\RealEstateModel;

class Watchlist extends System
{
    /**
     * Watchlist initialized indicator
     * @var boolean
     */
    public static $watchListInitialized = false;

    /**
     * Set stored user watchlist
     *
     * @param FrontendUser $objUser
     */
    public function postLogin($objUser): void
    {
        if (!$objUser instanceof FrontendUser)
        {
            return;
        }

        $objMember = MemberModel::findByPk($objUser->id);
        $watchlist = StringUtil::deserialize($objMember->watchlist, true);

        $sWatchlist = $_SESSION['WATCHLIST'];

        if (is_array($sWatchlist))
        {
            foreach ($sWatchlist as $realEstateId)
            {
                if (($key = \array_search($realEstateId, $watchlist)) === false)
                {
                    $watchlist[] = $realEstateId;
                }
            }
        }

        $_SESSION['WATCHLIST'] = $watchlist;

        $objMember->watchlist = serialize($watchlist);
        $objMember->save();
    }

    /**
     * Count watchlist objects
     *
     * @param $intCount
     * @param $context
     */
    public function countItems(&$intCount, $context): void
    {
        if($context->listMode !== 'watchlist')
        {
            return;
        }

        $intCount = count($_SESSION['WATCHLIST']);
    }

    /**
     * Fetch watchlist objects
     *
     * @param $objRealEstate
     * @param $arrOptions
     * @param $context
     */
    public function fetchItems(&$objRealEstate, $arrOptions, $context): void
    {
        if($context->listMode !== 'watchlist')
        {
            return;
        }

        $strOrder = 'FIELD(tl_real_estate.id,' . implode(',', $_SESSION['WATCHLIST']) . ')';

        if (array_key_exists('order', $arrOptions))
        {
            $arrOptions['order'] .= ', ' . $strOrder;
        }
        else
        {
            $arrOptions['order'] = $strOrder;
        }

        $objRealEstate = RealEstateModel::findPublishedByIds($_SESSION['WATCHLIST'], $arrOptions);
    }

    /**
     * Parse real estate template and add watchlist extension
     *
     * @param $objTemplate
     * @param $realEstate
     * @param $context
     */
    public function parseRealEstate(&$objTemplate, $realEstate, $context): void
    {
        if (!!$context->addWatchlist)
        {
            $objWatchlistTemplate = new FrontendTemplate($context->realEstateWatchlistTemplate);

            $objWatchlistTemplate->active = $_SESSION['WATCHLIST'] && \in_array($realEstate->objRealEstate->id, $_SESSION['WATCHLIST']);
            $objWatchlistTemplate->label = Translator::translateLabel('button_watchlist');
            $objWatchlistTemplate->realEstate = $realEstate;

            $objTemplate->arrExtensions = array_merge($objTemplate->arrExtensions, [$objWatchlistTemplate->parse()]);
        }
    }

    /**
     * Initialize the watchlist in the current session
     */
    public function initializeWatchlistSession(): void
    {
        $_SESSION['WATCHLIST'] = \is_array($_SESSION['WATCHLIST']) ? $_SESSION['WATCHLIST'] : array();

        if (Input::post('FORM_SUBMIT') !== 'watchlist' || !Input::post('REAL_ESTATE_ID') || static::$watchListInitialized)
        {
            return;
        }

        $realEstateId = Input::post('REAL_ESTATE_ID');

        if (($key = \array_search($realEstateId, $_SESSION['WATCHLIST'])) !== false)
        {
            unset($_SESSION['WATCHLIST'][$key]);
        }
        else
        {
            $_SESSION['WATCHLIST'][] = $realEstateId;
        }

        if (FE_USER_LOGGED_IN)
        {
            $this->import('FrontendUser', 'User');
            $this->import('Database');

            $this->Database->prepare("UPDATE tl_member SET watchlist=? WHERE id=?")
                ->execute(serialize($_SESSION['WATCHLIST']), $this->User->id);
        }

        static::$watchListInitialized = true;
    }
}
