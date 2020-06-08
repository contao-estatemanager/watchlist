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

use Contao\Config;
use Contao\Environment;
use ContaoEstateManager\EstateManager;

class AddonManager
{
    /**
     * Addon name
     * @var string
     */
    public static $name = 'Watchlist';

    /**
     * Addon config key
     * @var string
     */
    public static $key  = 'addon_watchlist_license';

    /**
     * Is initialized
     * @var boolean
     */
    public static $initialized  = false;

    /**
     * Is valid
     * @var boolean
     */
    public static $valid  = false;

    /**
     * Licenses
     * @var array
     */
    private static $licenses = [
        '6b16efda67787a7a3b7371973fa367ff',
        'b607f2e28a5086db64e19a83aee6510f',
        '2ae967db8a74543002779dbdcb374209',
        'aed3a54c6f2e65d5be69c244ba38920a',
        '2ab752ec85960ad7432b4b11de974cc3',
        '78506e247110f8ac64f2117e01605aa6',
        '92927d243f542e03e777cb2df7eceb1a',
        '6b078316238d6762836bd5aa6a31b021',
        '427ecb192ad712af750aebafa18c34d0',
        '81c26fc1e1282e5948abf210e89da638',
        '34f0031be1fbe3d720ffee46a8d53da6',
        'cdc70944a4b0bc251b88b49ac924da71',
        '578a860393629f846cf035fc7b18a6e8',
        'c7467dd49f7d7d98dd1ccea0aa80b2ca',
        '71c195be1c40c6d1ed6007e7b179552b',
        'c3d2d3c6dae9e189c32ea6e8315a3184',
        'f540d07e3f24e29bb611acafe1d988a2',
        'dcc30d67f6d23860d7c1663638c88123',
        '800f4903c12c3dcaf43a3e378117ecd5',
        'c2291329d4be30812d06e13aafb6915a',
        '86f3a32c50d03460e0cd924a9c18339c',
        '07eaad4094091a0a61b7c7e752273444',
        '226e9119013b4455c5e78d600a36843f',
        '77fe800b300c355d6514ba66f95c7001',
        'b91713265bf8411805092945feee6046',
        '9cecd324d03cbfd9dea1049ac78099e0',
        '9b775b0bcb32b6b09f29a4ad16c02b2a',
        '5af3041c4233249a3b11618c12523ff3',
        '5171721d0a7337b93ff6c8c766f92c5b',
        'f9e1ee415b73832c9dbfe8dfb9f9c7da',
        '71d4fb4487e99cc58393fe882287685e',
        'a0528263e170f19fde9ba986cccbffce',
        '5b2b3f8b935707eef9943b6a0cc25327',
        'a352f0a15db87fb305b5fb39dea6585f',
        'cf2be8c46c5f9dc55824142c7fd701cc',
        'df30f114572c10e1860c1053e323ac98',
        '02cfb4c2488e121816411fd645b021ac',
        '0bb68d003fef131226c6758d681fe19d',
        'f1962937ec4f4776dfda60bc027be20e',
        '5a930bfedfea5a422082fbf6a9384f62',
        '898340cf0ae28cfe6a0c3644e3f57f97',
        'abfa8f7d9ae760207fff47105ba07b4c',
        'b8fab6aa9906e5589da8e3dd15ecc5d4',
        '61eaa043afb42ec6adca8e901e0a4ff8',
        '030a83a8ccf3f92b1757464c747ec2a6',
        '78220fbb00d0a1ffe1bd386c46469d0f',
        '7b631e904b38a924a0e5da35c2ae8a9d',
        '337bd97df425143fb7c226f00c3f518c',
        '39376065c99d9f26b7b7244d5f4381e8',
        'dce44bdf2f84d0d365302002deefceff'
    ];

    public static function getLicenses()
    {
        return static::$licenses;
    }

    public static function valid()
    {
        if(strpos(Environment::get('requestUri'), '/contao/install') !== false)
        {
            return true;
        }

        if (static::$initialized === false)
        {
            static::$valid = EstateManager::checkLicenses(Config::get(static::$key), static::$licenses, static::$key);
            static::$initialized = true;
        }

        return static::$valid;
    }

}
