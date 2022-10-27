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

namespace ContaoEstateManager\Watchlist;

use Contao\BackendTemplate;
use Contao\PageModel;
use Contao\System;
use ContaoEstateManager\ModuleRealEstate;
use ContaoEstateManager\Translator;

/**
 * Front end module "watchlist redirector".
 *
 * @author Daniele Sciannimanica <daniele@oveleon.de>
 */
class ModuleWatchlistRedirector extends ModuleRealEstate
{
    /**
     * Template.
     *
     * @var string
     */
    protected $strTemplate = 'mod_watchlistRedirector';

    /**
     * Do not display the module if there are no real estates.
     *
     * @return string
     */
    public function generate()
    {
        if (TL_MODE === 'BE')
        {
            $objTemplate = new BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### '.mb_strtoupper($GLOBALS['TL_LANG']['FMD']['watchlistRedirector'][0], 'UTF-8').' ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id='.$this->id;

            return $objTemplate->parse();
        }

        return parent::generate();
    }

    /**
     * Generate the module.
     */
    protected function compile(): void
    {
        $link = false;

        if ($this->jumpTo)
        {
            $objPage = PageModel::findByPk($this->jumpTo);

            if ($objPage instanceof PageModel)
            {
                $link = ampersand($objPage->getFrontendUrl());
            }
        }

        // Load translations
        System::loadLanguageFile('tl_real_estate_label');

        $this->Template->addCount = (bool) $this->addWatchlistCount;
        $this->Template->count = $_SESSION['WATCHLIST'] ? \count($_SESSION['WATCHLIST']) : 0;
        $this->Template->link = $link;
        $this->Template->label = Translator::translateLabel('button_watchlist_redirector');
    }
}
