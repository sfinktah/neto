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
    public static array $outputSelectors = [];

    /**
     * @param array $filter = ['SKU' => '0001SHIF-A', 'OutputSelector' => ['ParentSKU', 'ID', 'Brand', 'Model', 'Virtual', 'Name', 'PrimarySupplier', ...]]
     * @throws \GuzzleHttp\Exception\GuzzleException|\Sfinktah\Neto\InvalidOutputSelector
     */
    public function post(array $filter) {
        $httpClient = new Client();

        // Define request data
        //     -- https://developers.maropost.com/documentation/engineers/api-documentation/products/getitem
        $postData = [
            "Filter" => [
                $filter,
            ]
        ];

        if (count(static::$outputSelectors) && is_array($filter['OutputSelector'])) {
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

        return $response->getBody()->getContents();
    }

    /**
     * @throws \Sfinktah\Neto\InvalidOutputSelector
     */
    public function validateOutputSelectors(array $filter): void {
        $valid = array_reduce($filter['OutputSelector'], function ($carry, $item) {
            return $carry && in_array($item, static::$outputSelectors);
        }, true);
        if (!$valid) {
            throw new InvalidOutputSelector("Invalid item found in OutputSelector");
        }
    }

}
