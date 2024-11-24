<?php

/**
 * @category  Ambienz
 * @package   Ambienz_MageWP
 * @copyright Copyright © 2024 Denis Almeida | Ambienz
 * @author    Denis Almeida <https://www.ambienz.com.br>
 */

namespace Ambienz\MageWP\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Store\Model\StoreManagerInterface;
use Ambienz\MageWP\Api\BlogRepositoryInterface;
use Ambienz\MageWP\Api\BlogInterface;
use Ambienz\MageWP\Helper\EndpointBuilder;

/**
 * Class BlogRepository
 * Get posts from WordPress API
 */
class BlogRepository extends AbstractModel implements BlogRepositoryInterface
{
    /**
     * Constructor.
     *
     * @param StoreManagerInterface $storeManager
     * @param BlogInterface $blogInterface
     * @param EndpointBuilder $endpointBuilder
     */
    public function __construct(
        protected StoreManagerInterface $storeManager,
        protected BlogInterface $blogInterface,
        protected EndpointBuilder $endpointBuilder
    ) {
        $this->storeId = $this->storeManager->getStore()->getId();
    }

    /**
     * Fetch posts from API
     *
     * @return array
     */
    public function getAllPosts(): array
    {
        $url = $this->endpointBuilder->buildPostsUrl($this->storeId);
        $posts = $this->blogInterface->get($url);

        return $posts ?? [];
    }

    /**
     * Fetch media from API
     *
     * @param int $mediaId
     * @return string|null
     */
    public function getMediaById(int $mediaId): ?string
    {
        $url = $this->endpointBuilder->buildMediaUrl($this->storeId, $mediaId);
        $media = $this->blogInterface->get($url);

        return $media['source_url'] ?? null;
    }
}
