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

namespace PrestaShop\Module\TechnicalAnnouncement\Form;

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\PrestaShop\Core\Configuration\DataConfigurationInterface;
use PrestaShop\PrestaShop\Core\Form\FormDataProviderInterface;

/**
 * Provider is responsible for providing form data, in this case, it is returned from the configuration component.
 *
 * Class TechnicalAnnouncementDataProvider
 */
class TechnicalAnnouncementDataProvider implements FormDataProviderInterface
{
    /**
     * @var DataConfigurationInterface
     */
    private $TechnicalAnnouncementDataConfiguration;

    public function __construct(DataConfigurationInterface $technicalAnnouncementDataConfiguration)
    {
        $this->TechnicalAnnouncementDataConfiguration = $technicalAnnouncementDataConfiguration;
    }

    public function getData(): array
    {
        return $this->TechnicalAnnouncementDataConfiguration->getConfiguration();
    }

    public function setData(array $data): array
    {
        return $this->TechnicalAnnouncementDataConfiguration->updateConfiguration($data);
    }
}
