<?php
/**
 * Factory for various top-level VuFind services.
 *
 * PHP version 5
 *
 * Copyright (C) Villanova University 2014.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License version 2,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * @category VuFind2
 * @package  Service
 * @author   Demian Katz <demian.katz@villanova.edu>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     http://vufind.org/wiki/vufind2:developer_manual Wiki
 */
namespace Debug\Service;
use Zend\ServiceManager\ServiceManager;

/**
 * Factory for various top-level VuFind services.
 *
 * @category VuFind2
 * @package  Service
 * @author   Demian Katz <demian.katz@villanova.edu>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     http://vufind.org/wiki/vufind2:developer_manual Wiki
 */
class Factory
{
    /**
     * Construct the translator.
     *
     * @param ServiceManager $sm Service manager.
     *
     * @return \Zend\I18n\Translator\Translator
     */
    public static function getTranslator(ServiceManager $sm)
    {
        $translator = Translator::factory(array());

        // Set up the ExtendedIni plugin:
        $config = $sm->get('VuFind\Config')->get('config');
        $pathStack = array(
            APPLICATION_PATH  . '/languages',
            LOCAL_OVERRIDE_DIR . '/languages'
        );
        $translator->getPluginManager()->setService(
                'extendedini',
                new \VuFind\I18n\Translator\Loader\ExtendedIni(
                        $pathStack, $config->Site->language
                )
        );

        
        return $translator;
    }



}