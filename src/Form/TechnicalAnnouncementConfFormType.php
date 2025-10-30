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

namespace Prestashop\Module\TechnicalAnnouncement\Form;

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShopBundle\Form\Admin\Type\SwitchType;
use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use PrestaShopBundle\Form\Admin\Type\TranslatableType;

class TechnicalAnnouncementConfFormType extends TranslatorAwareType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('message', TranslatableType::class, [
                'label' => $this->trans('Message', 'Modules.Technicalannouncement.Admin'),
                'help' => $this->trans('This message will be displayed in the very top part of every page. Make it concise.', 'Modules.Technicalannouncement.Admin'),
                'required' => true,
            ])
            ->add('isactive', SwitchType::class, [
                'label' => $this->trans('Display', 'Modules.Technicalannouncement.Admin'),
                'help' => $this->trans('Turn on or off the rendering of your message on your shop.', 'Modules.Technicalannouncement.Admin'),
                'empty_data' => false,
                'required' => false,
            ]);
    }
}
