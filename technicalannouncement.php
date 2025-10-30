<?php
/**
 * Copyright since 2025 Jeremy Dobberman
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade to newer
 * versions in the future. If you wish to customize it for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    Jeremy Dobberman <yellowyankee@proton.me>
 * @copyright Since 2025 Jeremy Dobberman
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

declare(strict_types=1);

if (!defined('_PS_VERSION_')) {
    exit;
}

class TechnicalAnnouncement extends Module
{
    public function __construct()
    {
        $this->name = 'technicalannouncement';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Jeremy Dobberman';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '9.0.0',
            'max' => '9.99.99',
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->trans('Technical announcement', [], 'Modules.Technicalannouncement.Admin');
        $this->description = $this->trans('Display a warning in the very top part of your shop about the next scheduled maintenance.', [], 'Modules.Technicalannouncement.Admin');

        $this->confirmUninstall = $this->trans('Are you sure you want to uninstall?', [], 'Modules.Technicalannouncement.Admin');

        if (!Configuration::get('TECHNICALANNOUNCEMENT_NAME')) {
            $this->warning = $this->trans('No name provided.', [], 'Modules.Technicalannouncement.Admin');
        }
    }

    public function isUsingNewTranslationSystem(): bool
    {
        return true;
    }

    public function install()
    {
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }

        return
            parent::install()
            && $this->registerHook('displayBanner')
            && Configuration::updateValue('TECHNICALANNOUNCEMENT_NAME', 'Technical announcement');
    }

    public function uninstall()
    {
        return
            parent::uninstall()
            && $this->unregisterHook('displayBanner')
            && Configuration::deleteByName('TECHNICALANNOUNCEMENT_NAME');
    }

    public function getContent()
    {
        $route = $this->get('router')->generate('technicalannouncement_conf_form');
        Tools::redirectAdmin($route);
    }

    public function hookDisplayBanner()
    {
        $json_message = Configuration::get('TECHNICALANNOUNCEMENT_MESSAGE');
        $message = json_decode($json_message, true);

        $this->context->smarty->assign([
            'technicalannouncement_isactive' => Configuration::get('TECHNICALANNOUNCEMENT_ISACTIVE'),
            'technicalannouncement_message' => $message[(int) $this->context->language->id],
        ]);

        return $this->display(__FILE__, 'technicalannouncement.tpl');
    }
}
