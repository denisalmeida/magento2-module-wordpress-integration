<?php

/**
 * @category  Ambienz
 * @package   Ambienz_MageWP
 * @copyright Copyright © 2024 Denis Almeida | Ambienz
 * @author    Denis Almeida <https://www.ambienz.com.br>
 */

namespace Ambienz\MageWP\Api;

/**
 * Interface BlogInterface
 * Defines contract for blog client.
 */
interface BlogInterface
{
    /**
     * Execute a GET request to API.
     *
     * @param string $url
     * @return array|null
     */
    public function get(string $url): ?array;
}
