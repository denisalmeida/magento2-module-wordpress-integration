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
use Ambienz\MageWP\Helper\Data as DataHelper;

/**
 * Class EndpointBuilder
 * Helper class for building URLs
 */
class EndpointBuilder extends AbstractHelper
{
    /**
     * Constructor
     *
     * @param Context $context
     * @param DataHelper $dataHelper
     */
    public function __construct(
        Context $context,
        protected DataHelper $dataHelper
    ) {
        parent::__construct($context);
    }

    /**
     * Build URL for fetching posts endpoint from WordPress API
     *
     * @param int $storeId
     * @return string
     */
    public function buildPostsUrl(int $storeId): string
    {
        $apiUrl = $this->dataHelper->getApiUrl($storeId);
        $postLimit = $this->dataHelper->getPostLimit($storeId) ?: 10;

        return "{$apiUrl}posts/?per_page={$postLimit}&status=publish";
    }

    /**
     * Build URL for fetching media endpoint by ID from WordPress API
     *
     * @param int $storeId
     * @param int $mediaId
     * @return string
     */
    public function buildMediaUrl(int $storeId, int $mediaId): string
    {
        $apiUrl = $this->dataHelper->getApiUrl($storeId);
        return "{$apiUrl}media/{$mediaId}";
    }
}
