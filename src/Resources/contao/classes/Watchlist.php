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

use ContaoEstateManager\Translator;
use ContaoEstateManager\RealEstateModel;

class Watchlist extends \System
{

    /**
     * Watchlist initialized indicaotr
     * @var boolean
     */
    public static $watchListInitialized = false;

    /**
     * Set stored user watchlist
     *
     * @param \User $objUser
     */
    public function postLogin($objUser)
    {
        if (!($objUser instanceof \FrontendUser) || !isset($_SESSION['WATCHLIST']) || !is_array($_SESSION['WATCHLIST']))
        {
            return;
        }

        $objMember = \MemberModel::findByPk($objUser->id);

        $watchlist = array_merge(\StringUtil::deserialize($objMember->watchlist, true), $_SESSION['WATCHLIST']);

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
    public function countItems(&$intCount, $context)
    {
        if($context->listMode !== 'watchlist'){
            return;
        }

        $intCount = count($_SESSION['WATCHLIST']);
    }

    /**
     * Fetch watchlist objects
     *
     * @param $objRealEstate
     * @param $limit
     * @param $offset
     * @param $context
     */
    public function fetchItems(&$objRealEstate, $limit, $offset, $context)
    {
        if($context->listMode !== 'watchlist'){
            return;
        }

        $arrOptions = array(
            'limit' => $limit,
            'offset' => $offset
        );

        $objRealEstate = RealEstateModel::findMultipleByIds($_SESSION['WATCHLIST'], $arrOptions);
    }

    /**
     * Parse real estate template and add watchlist extension
     *
     * @param $objTemplate
     * @param $realEstate
     * @param $context
     */
    public function parseRealEstate(&$objTemplate, $realEstate, $context)
    {
        if (!!$context->addWatchlist)
        {
            $objWatchlistTemplate = new \FrontendTemplate($context->realEstateWatchlistTemplate);

            $objWatchlistTemplate->realEstateId = $realEstate->objRealEstate->id;
            $objWatchlistTemplate->active = \in_array($realEstate->objRealEstate->id, $_SESSION['WATCHLIST']) ? ' active' : '';
            $objWatchlistTemplate->label = Translator::translateLabel('button_watchlist');

            $objTemplate->arrExtensions = array_merge($objTemplate->arrExtensions, [$objWatchlistTemplate->parse()]);
        }
    }

    /**
     * Initialize the watchlist in the current session
     */
    public function initializeWatchlistSession()
    {
        $_SESSION['WATCHLIST'] = \is_array($_SESSION['WATCHLIST']) ? $_SESSION['WATCHLIST'] : array();

        if (\Input::post('FORM_SUBMIT') != 'watchlist' || !\Input::post('REAL_ESTATE_ID') || static::$watchListInitialized)
        {
            return;
        }

        $realEstateId = \Input::post('REAL_ESTATE_ID');

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