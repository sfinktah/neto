<?php

namespace Sfinktah\Neto;

use Exception;
use GuzzleHttp\Client;

function config($key = null, $default = null)
{
    static $config = null;

    if ($config === null) {
        $config_path = dirname(__DIR__) . '/config/neto.php';
        // printf("config_path: %s\n", $config_path);
        try {
            if (!file_exists($config_path)) {
                printf("Config file does not exist: %s\n", $config_path);
            }
            $config = include($config_path);
            // printf("\$config: %s\n", print_r($config, 1));
        } catch (Exception $exception) {
            // printf("EXCEPTION WITH DIR %s\n", $config_path);
        }
    }

    $rv = $key !== null ? ($config[$key] ?? $default) : $config;
    // printf("key: '%s' rv: '%s'\n", print_r($key, 1), print_r($rv, 1));
    return $rv;
}

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
    public static array $availableDataItems = [];

    public array $outputSelectors = [];
    public array $data = [];

    /**
     * @param array|null $data
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Sfinktah\Neto\InvalidOutputSelector
     */
    public function post(array|null $data = null): array {
        $httpClient = new Client();

        if (is_array($data)) {
            $data = array_unique(array_merge_recursive($this->data, $data));
        } else {
            $data = $this->data;
        }

        // Define request data
        //     -- https://developers.maropost.com/documentation/engineers/api-documentation/products/getitem
        $postData = [
            "Data" => $data,
        ];

        $postData['Data']['OutputSelector'] = array_values(array_unique(array_merge($this->outputSelectors, $data['OutputSelector'] ?? [])));

        if (count(static::$availableOutputSelectors) && array_key_exists('OutputSelector', $data)) {
            // print_r($data);
            $this->validateOutputSelectors($data);
        }

        // printf("postData: %s\n", print_r(json_encode($postData, JSON_PRETTY_PRINT), true));

        $headers = [
            'NETOAPI_ACTION' => static::$netoAction,
            'NETOAPI_USERNAME' => 'api_access',
            'NETOAPI_KEY' => config('API_KEY'),
            'Accept' => 'application/json',
        ];

        $response = $httpClient->post(config('API_ENDPOINT'), [
            'headers' => $headers,
            'json' => $postData,
            'connect_timeout' => 650
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @throws \Sfinktah\Neto\InvalidOutputSelector
     */
    public function validateOutputSelectors(array $data): void {
        $valid = array_reduce($data['OutputSelector'], function ($carry, $item) {
            return $carry && in_array($item, static::$availableOutputSelectors);
        }, true);
        // printf("validateOutputSelectors: %s\n", implode(", ", $data['OutputSelector']));
        if (!$valid) {
            throw new InvalidOutputSelector("Invalid item found in OutputSelector");
        }
    }

    /** @param array $outputSelectors = [static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], ] */
    public function withOutputSelectors(array $outputSelectors): static {
        $this->outputSelectors = array_unique(array_merge($this->outputSelectors, $outputSelectors));
        // printf("withOutputSelectors: ");
        // print_r($this->outputSelectors);
        return $this;
    }

    /**
     * @param array $data = static::$availableDataItems
     */
    public function withData(array $data): static {
        $this->data = array_unique(array_merge($this->data, $data));
        // printf("withData: ");
        // print_r($this->data);
        return $this;
    }

    /**
     * @param array|null $data = static::$availableDataItems
     */
    public function __construct(array|null $data = null) {
        if (is_array($data)) {
            $this->withData($data);
        }
    }

    /**
     * @param array|null $data = static::$availableDataItems
     */
    public static function make(array|null $data = null): static {
        return new static($data);
    }
}
