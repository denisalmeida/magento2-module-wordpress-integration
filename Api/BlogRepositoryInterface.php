<?php

/**
 * @category  Ambienz
 * @package   Ambienz_MageWP
 * @copyright Copyright © 2024 Denis Almeida | Ambienz
 * @author    Denis Almeida <https://www.ambienz.com.br>
 */

namespace Ambienz\MageWP\Api;

/**
 * Interface BlogRepositoryInterface
 * Defines contract for blog repository.
 */
interface BlogRepositoryInterface
{
    /**
     * Get All posts.
     *
     * @return array
     */
    public function getAllPosts(): array;

    /**
     * Get media by ID.
     *
     * @param int $mediaId
     * @return string|null
     */
    public function getMediaById(int $mediaId): ?string;
}
