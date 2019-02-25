<?php
/**
 * This file is part of Oveleon ImmoManager.
 *
 * @link      https://github.com/oveleon/contao-immo-manager-bundle
 * @copyright Copyright (c) 2018-2019  Oveleon GbR (https://www.oveleon.de)
 * @license   https://github.com/oveleon/contao-immo-manager-bundle/blob/master/LICENSE
 */

namespace Oveleon\ContaoImmoManagerWatchlistBundle;

use Oveleon\ContaoImmoManagerBundle\Translator;
use Oveleon\ContaoImmoManagerBundle\ExposeModule;

/**
 * Expose module "watchlist".
 *
 * @author Daniele Sciannimanica <daniele@oveleon.de>
 */
class ExposeModuleWatchlist extends ExposeModule
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'expose_mod_watchlist';

    /**
     * Do not display the module if there are no real etates
     *
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $objTemplate = new \BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### ' . Utf8::strtoupper($GLOBALS['TL_LANG']['FMD']['watchlist'][0]) . ' ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=expose_module&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }

        return parent::generate();
    }

    /**
     * Generate the module
     */
    protected function compile()
    {
        $this->Template->realEstateId = $this->realEstate->objRealEstate->id;
        $this->Template->active = \in_array($this->realEstate->objRealEstate->id, $_SESSION['WATCHLIST']) ? ' active' : '';
        $this->Template->label = Translator::translateExpose('button_watchlist');
    }
}