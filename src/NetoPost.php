<?php

namespace Sfinktah\Neto;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Str;


class NetoPost
{
    public static string $netoAction = '';
    public static array $availableOutputSelectors = [];
    public static array $availableDataItems = ['__Base__' => '__IgnoreMe__'];
    public static string $postKey = 'Filter';

    public array $outputSelectors = [];
    public array $data = [];
    protected array $responseData = [];
    public string|false|null $jsonEncodedPostData = null;
    protected bool $warningsNormalised = false;
    /**
     * @var array[]
     */
    protected array $postData = [];
    protected bool $hasPerformedPost = false;

    // ** THIS IS WHAT WE GET FROM NETO
    // Multiple errors:
    //     'Ack' => 'Warning',
    //     'Messages' => [
    //         'Warning' => [
    //             [
    //                 'Message' => 'Cannot find Item 0001SHIF-A-00000TESTx',
    //                 'SeverityCode' => 'Warning'
    //             ],
    //             [
    //                 'Message' => 'Cannot find Item 0001SHIF-A-00000TESTx',
    //                 'SeverityCode' => 'Warning'
    //             ]
    //         ]
    //     ]

    // ** THIS IS WHAT WE GET FROM NETO
    // Single error:
    // [
    //     'CurrentTime' => '2024-09-02 07:30:10',
    //     'Ack' => 'Warning',
    //     'Messages' => [
    //         'Warning' => [
    //             'Message' => 'Cannot find Item 0001SHIF-A-00000TESTx',
    //             'SeverityCode' => 'Warning'
    //         ]
    //     ]
    // ]

    // We can mess with this a little and hopefully not lose any important data:
    public function normaliseWarnings(): static {
        // Result after calling:
        // [   ...,
        //     'Ack' => 'Warning',
        //     'Messages' => [
        //         'Warning' => [
        //             [
        //                 'SKU' => '0001SHIF-A-00000TEST-X',
        //                 'Message' => 'Cannot find Item 0001SHIF-A-00000TEST-X'
        //             ],
        //             [
        //                 'SKU' => '0001SHIF-A-00000TEST-XX',
        //                 'Message' => 'Cannot find Item 0001SHIF-A-00000TEST-XX'
        //             ]
        //         ]
        //     ]
        // ];
        if (!$this->warningsNormalised) {
            if (is_array($this->responseData()['Messages']['Warning'] ?? null) && count($this->responseData()['Messages']['Warning'])) {
                // NOTE: this will only operate correctly for warnings that contain " Item <SKU>$", but it is unknown
                // what other warning messages may be encountered.
                $this->responseData['Messages']['Warning'] = collect($this->responseData()['Messages']['Warning'])
                    ->flatten()
                    ->filter(fn($v, $k) => $v !== 'Warning')
                    ->values()
                    ->map(function ($v, $k) {
                        if (!Str::contains($v, 'Item ')) {
                            trigger_error("Neto returned a warning that didn't contain an Item reference: $v", E_USER_WARNING);
                        }
                        return ['SKU' => Str::afterLast($v, 'Item '), 'Message' => $v];
                    })
                    ->toArray();
            }
            $this->warningsNormalised = true;
        }
        return $this;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Sfinktah\Neto\InvalidOutputSelector
     */
    public function post(array|null $data = null): static {
        $httpClient = new Client();

        if (is_array($data)) {
            $data = array_unique(array_merge_recursive($this->data, $data));
        } else {
            $data = $this->data;
        }

        // Define request data
        //     -- https://developers.maropost.com/documentation/engineers/api-documentation/products/getitem
        $this->postData = $postData = [
            static::$postKey => $data,
        ];

        if (!empty($this->outputSelectors) || !empty($data['OutputSelector'] ?? [])) {
            $postData[static::$postKey]['OutputSelector'] = array_values(array_unique(array_merge($this->outputSelectors, $data['OutputSelector'] ?? [])));
            if (count(static::$availableOutputSelectors) && array_key_exists('OutputSelector', $data)) {
                // print_r($data);
                $this->validateOutputSelectors($data);
            }
        }

        // printf("postData: %s\n", print_r(json_encode($postData, JSON_PRETTY_PRINT), true));
        $this->jsonEncodedPostData = json_encode($postData, JSON_PRETTY_PRINT);

        $headers = [
            'NETOAPI_ACTION' => static::$netoAction,
            'NETOAPI_USERNAME' => 'api_access',
            'NETOAPI_KEY' => static::config('API_KEY'),
            'Accept' => 'application/json',
        ];

        $response = $httpClient->post(static::config('API_ENDPOINT'), [
            'headers' => $headers,
            'json' => $postData,
            'connect_timeout' => 650
        ]);

        $this->responseData = $responseData = json_decode($response->getBody()->getContents(), true);

        if ($responseData['Ack'] == 'Error' && $responseData['Messages']['Error']['Message'] == 'JSON Error') {
            trigger_error('Neto reported JSON Error, JSON dump follows', E_USER_WARNING);
            \Sage::dump($this->jsonEncodedPostData);
        }

        return $this;
    }

    /**
     * @throws \Sfinktah\Neto\InvalidOutputSelector
     */
    protected function validateOutputSelectors(array $data): void {
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
     * @deprecated Use withFilter, withItem, withOrder, etc.
     */
    public function withData(array $data): static {
        trigger_error('Neto*::withData is deprecated in favour of withItem, withOrder, etc', E_USER_WARNING);
        return $this->withFilter($data);
    }

    /**
     * @param array $filter = static::$availableDataItems
     */
    public function withFilter(array $filter): static {
        $this->data = array_merge($this->data, $filter);
        return $this;
    }

    /**
     * @param array|null $data = static::$availableDataItems
     */
    public function __construct(array|null $data = null) {
        if (is_array($data)) {
            $this->withFilter($data);
        }
    }

    /**
     * @param array|null $data = static::$availableDataItems
     */
    public static function make(array|null $data = null): static {
        return new static($data);
    }

    public function responseData() : array {
        if (!$this->hasPerformedPost) {
            $this->post();
        }
        return $this->responseData;
    }

    public static function config($key = null, $default = null)
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

        return $key !== null ? ($config[$key] ?? $default) : $config;
    }

    public function getPostData(): array {
        return $this->postData;
    }
}


/*
 * How to extract Enumeration values from Neto documentation with JavaScript:
var array = $('a:contains(Enumeration)').map(function() {
    var $this = $(this);
    var $parent = $this.parent();
    var $lastPrev = $parent.prevAll().last();

    var match = function(text, pattern) {
        var matched = text.match(pattern);
        return matched ? matched[1] : "";
    };

    return {
        enumOptions: match($parent.text(), /\((.*?)\)/),
        enumName: $lastPrev.text(),
        enumParent: match($lastPrev.parentsUntil('table').parent().prev().text(), /<(.*?)>/)
    };
}).get();
 */