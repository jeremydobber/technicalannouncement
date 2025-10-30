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
use PrestaShop\PrestaShop\Core\ConfigurationInterface;

final class TechnicalAnnouncementConfiguration implements DataConfigurationInterface
{
    /** @var ConfigurationInterface */
    private $configuration;

    public const TECHNICALANNOUNCEMENT_ISACTIVE = 'TECHNICALANNOUNCEMENT_ISACTIVE';
    public const TECHNICALANNOUNCEMENT_MESSAGE = 'TECHNICALANNOUNCEMENT_MESSAGE';

    public function __construct(ConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getConfiguration()
    {
        $return = [];

        $return['isactive'] = $this->configuration->get(static::TECHNICALANNOUNCEMENT_ISACTIVE);
        $string_message = $this->configuration->get(static::TECHNICALANNOUNCEMENT_MESSAGE);
        $return['message'] = json_decode($string_message, true);
        
        return $return;
    }

    public function updateConfiguration(array $configuration)
    {
        $errors = [];

        if ($this->validateConfiguration($configuration)) {
            $this->configuration->set(static::TECHNICALANNOUNCEMENT_ISACTIVE, $configuration['isactive']);
            $this->configuration->set(static::TECHNICALANNOUNCEMENT_MESSAGE, json_encode($configuration['message']));
        }

        return $errors;
    }

    public function validateConfiguration(array $configuration)
    {
        return true;
    }
}
