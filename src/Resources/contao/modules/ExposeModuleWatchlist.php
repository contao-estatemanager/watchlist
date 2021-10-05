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
use ContaoEstateManager\ExposeModule;
use ContaoEstateManager\Translator;
use Patchwork\Utf8;

/**
 * Expose module "watchlist".
 *
 * @author Daniele Sciannimanica <daniele@oveleon.de>
 */
class ExposeModuleWatchlist extends ExposeModule
{
    /**
     * Template.
     *
     * @var string
     */
    protected $strTemplate = 'expose_mod_watchlist';

    /**
     * Do not display the module if there are no real etates.
     *
     * @return string
     */
    public function generate()
    {
        if (TL_MODE === 'BE')
        {
            $objTemplate = new BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### '.Utf8::strtoupper($GLOBALS['TL_LANG']['FMD']['watchlist'][0]).' ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=expose_module&amp;act=edit&amp;id='.$this->id;

            return $objTemplate->parse();
        }

        return parent::generate();
    }

    /**
     * Generate the module.
     */
    protected function compile(): void
    {
        $this->Template->active = \in_array($this->realEstate->id, $_SESSION['WATCHLIST'], true);
        $this->Template->label = Translator::translateExpose('button_watchlist');
    }
}
