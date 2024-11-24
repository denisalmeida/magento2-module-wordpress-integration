<?php

/**
 * @category  Ambienz
 * @package   Ambienz_MageWP
 * @copyright Copyright © 2024 Denis Almeida | Ambienz
 * @author    Denis Almeida <https://www.ambienz.com.br>
 */

namespace Ambienz\MageWP\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Ambienz\MageWP\Api\BlogRepositoryInterface;
use Ambienz\MageWP\Helper\Data as DataHelper;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class ListPost
 * Block class for displaying post list
 */
class ListPost extends Template
{
    /**
     * @param Context $context
     * @param BlogRepositoryInterface $blogRepository
     * @param DataHelper $dataHelper
     * @param StoreManagerInterface $storeManager
     * @param array $data
     */
    public function __construct(
        Context $context,
        protected BlogRepositoryInterface $blogRepository,
        protected DataHelper $dataHelper,
        protected StoreManagerInterface $storeManager,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Retrieve latest posts
     *
     * @return array
     */
    public function getPostList(): array
    {
        return $this->blogRepository->getAllPosts();
    }

    /**
     * Get post image by media ID
     *
     * @param int $mediaId
     * @return string
     */
    public function getPostImage($mediaId): string
    {
        return $this->blogRepository->getMediaById($mediaId) ?? '';
    }

    /**
     * Check if the API is configured and the module is enabled
     *
     * @return bool
     * @throws NoSuchEntityException
     */
    public function isApiConfigured(): bool
    {
        $storeId = $this->storeManager->getStore()->getId();
        return $this->dataHelper->isModuleActive($storeId) && $this->dataHelper->getApiUrl($storeId);
    }

    /**
     * Format the date using the helper.
     *
     * @param string $dateString
     * @return string
     */
    public function formatPostDate($dateString): string
    {
        return $this->dataHelper->formatDate($dateString);
    }
}
