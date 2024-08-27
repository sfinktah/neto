<?php

namespace Sfinktah\Neto;

use GuzzleHttp\Client;

class InvalidOutputSelector extends \Exception
{
    public function __construct($message = "Invalid item found in OutputSelector", $code = 0, \Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function __toString(): string {
        return __CLASS__ . ": [$this->code]: $this->message\n";
    }
}

class NetoPost
{
    public static string $netoAction = '';
    public static array $availableOutputSelectors = [];
    public static array $availableFilters = [];

    public array $outputSelectors = [];
    public array $filter = [];

    /**
     * @param array|null $filter
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Sfinktah\Neto\InvalidOutputSelector
     */
    public function post(array|null $filter = null): array {
        $httpClient = new Client();

        $filter = array_merge_recursive($this->filter ?? [], $filter ?? []);

        // Define request data
        //     -- https://developers.maropost.com/documentation/engineers/api-documentation/products/getitem
        $postData = [
            "Filter" => [
                $filter,
            ]
        ];

        if (array_key_exists('OutputSelector', $filter) && is_array($filter['OutputSelector'])) {
            $filter['OutputSelector'] = array_unique(array_merge($this->outputSelectors, $filter['OutputSelector']));
        }

        if (count(static::$availableOutputSelectors) && array_key_exists('OutputSelector', $filter)) {
            print_r($filter);
            $this->validateOutputSelectors($filter);
        }

        $headers = [
            'NETOAPI_ACTION' => static::$netoAction,
            'NETOAPI_USERNAME' => 'api_access',
            'NETOAPI_KEY' => config('neto.API_KEY'),
            'Accept' => 'application/json',
        ];

        $response = $httpClient->post(config('neto.API_ENDPOINT'), [
            'headers' => $headers,
            'json' => $postData,
            'connect_timeout' => 650
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @throws \Sfinktah\Neto\InvalidOutputSelector
     */
    public function validateOutputSelectors(array $filter): void {
        $valid = array_reduce($filter['OutputSelector'], function ($carry, $item) {
            return $carry && in_array($item, static::$availableOutputSelectors);
        }, true);
        if (!$valid) {
            throw new InvalidOutputSelector("Invalid item found in OutputSelector");
        }
    }

    /** @param array $outputSelectors = [static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], ] */
    public function withOutputSelectors(array $outputSelectors): static {
        $this->outputSelectors = array_unique(array_merge($this->outputSelectors, $outputSelectors));
        return $this;
    }

    /**
     * @param array|null $filter = static::$availableFilters
     */
    public function __construct(array|null $filter = null) {
        if (is_array($filter)) {
            $this->filter = array_merge_recursive($this->filter, $filter);
        }
    }

    /**
     * @param array|null $filter = static::$availableFilters
     */
    public static function make(array|null $filter = null): static {
        return new static($filter);
    }


}
