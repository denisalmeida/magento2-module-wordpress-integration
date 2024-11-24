<?php

/**
 * @category  Ambienz
 * @package   Ambienz_MageWP
 * @copyright Copyright © 2024 Denis Almeida | Ambienz
 * @author    Denis Almeida <https://www.ambienz.com.br>
 */

namespace Ambienz\MageWP\Model;

use Ambienz\MageWP\Api\BlogInterface;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Blog
 * Client for WordPress API
 */
class Blog implements BlogInterface
{
    /**
     * @param Curl $curl
     */
    public function __construct(
        protected Curl $curl
    ) {
    }

    /**
     * Make a GET request to the WordPress API.
     *
     * @param string $url
     * @return array|null
     * @throws LocalizedException
     */
    public function get(string $url): ?array
    {
        try {
            $this->curl->get($url);
            return $this->doRequest();
        } catch (\Exception $e) {
            throw new LocalizedException(__('Failed to retrieve data from WordPress API: %1', $e->getMessage()));
        }
    }

    /**
     * Handle the response from API.
     *
     * @return array|null
     */
    private function doRequest(): ?array
    {
        $response = $this->curl->getBody();
        $data = json_decode($response, true);

        if (!is_array($data) || isset($data['code'])) {
            return null;
        }

        return $data;
    }
}
