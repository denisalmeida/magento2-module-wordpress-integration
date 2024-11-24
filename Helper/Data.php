<?php

/**
 * @category  Ambienz
 * @package   Ambienz_MageWP
 * @copyright Copyright © 2024 Denis Almeida | Ambienz
 * @author    Denis Almeida <https://www.ambienz.com.br>
 */

namespace Ambienz\MageWP\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Ambienz\MageWP\Model\Config;

/**
 * Class Data
 * Helper class for module
 */
class Data extends AbstractHelper
{
    /**
     * @param Context $context
     * @param Config $config
     */
    public function __construct(
        Context $context,
        protected Config $config
    ) {
        parent::__construct($context);
    }

    /**
     * Check if module enabled.
     *
     * @param ?int $storeId
     * @return mixed
     */
    public function isModuleActive($storeId = null): mixed
    {
        return $this->config->getConfigEnable($storeId);
    }

    /**
     * Get API URL from configuration.
     *
     * @param ?int $storeId
     * @return mixed
     */
    public function getApiUrl($storeId = null): mixed
    {
        return $this->config->getConfigApiUrl($storeId);
    }

    /**
     * Get the limit of posts to fetch.
     *
     * @param ?int $storeId
     * @return mixed
     */
    public function getPostLimit($storeId = null): mixed
    {
        return $this->config->getConfigPostLimit($storeId);
    }

    /**
     * Formats the date to the desired format.
     *
     * @param string $dateString Date in string format.
     * @return string Formatted date.
     */
    public function formatDate($dateString): string
    {
        $date = new \DateTime($dateString);
        $formatter = new \IntlDateFormatter(
            'en_US',
            \IntlDateFormatter::LONG,
            \IntlDateFormatter::NONE
        );

        return $formatter->format($date);
    }
}
