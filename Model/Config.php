<?php

/**
 * @category  Ambienz
 * @package   Ambienz_MageWP
 * @copyright Copyright © 2024 Denis Almeida | Ambienz
 * @author    Denis Almeida <https://www.ambienz.com.br>
 */

namespace Ambienz\MageWP\Model;

use Exception;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class Config
 * Get module configurations
 */
class Config
{
    /**
     * @param StoreManagerInterface $storeManager
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        protected StoreManagerInterface $storeManager,
        protected ScopeConfigInterface $scopeConfig
    ) {
    }

    /**
     * Get module enabled configuration
     *
     * @param ?int $storeId
     * @return mixed
     */
    public function getConfigEnable($storeId = null): mixed
    {
        return $this->getConfig('wordpress/general/enable', $storeId);
    }

    /**
     * Get WordPress API URL from configuration
     *
     * @param ?int $storeId
     * @return string
     */
    public function getConfigApiUrl($storeId = null): string
    {
        return $this->getConfig('wordpress/general/api_url', $storeId) ?? '';
    }

    /**
     * Get the limit of posts to fetch from the WordPress API
     *
     * @param ?int $storeId
     * @return mixed
     */
    public function getConfigPostLimit($storeId = null): mixed
    {
        return $this->getConfig('wordpress/general/post_limit', $storeId);
    }

    /**
     * Get configuration value
     *
     * @param string $config
     * @param int|null $storeId
     * @return mixed
     */
    private function getConfig(string $config, int $storeId = null): mixed
    {
        if (!$storeId) {
            $storeId = $this->getStoreId();
        }

        return $this->scopeConfig->getValue(
            $config,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Get store ID
     *
     * @return int
     */
    private function getStoreId(): int
    {
        try {
            return $this->storeManager->getStore()->getId();
        } catch (Exception $e) {
            return 0;
        }
    }
}
