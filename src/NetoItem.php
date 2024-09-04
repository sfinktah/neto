<?php

namespace Sfinktah\Neto;

use http\Exception\InvalidArgumentException;
use Illuminate\Support\Str;

/**
 * https://developers.maropost.com/documentation/engineers/api-documentation/products/updateitem/
 */
class NetoItem extends NetoPost
{
    public static string $postKey = 'Item';
    protected bool $itemsNormalised = false;


    /**
     * @param array $item = static::$availableDataItems
     */
    public function withItem(array $item): static {
        if (!is_array($item[0] ?? null) || !count($item[0])) {
            throw new \InvalidArgumentException("withItem requires an array of 1 or more items");
        }

        foreach ($item as $object) {
            array_push($this->data, $object);
        }
        // $this->data = array_merge_recursive($this->data, $item);
        return $this;
    }


    public function skusProcessed() : array {
        if (!$this->itemsNormalised) {
            $this->normaliseItems();
        }
        return data_get($this->responseData(), 'Item.SKU') ?? [];
    }

    public function skusFailed() : array {
        if (!$this->warningsNormalised) {
            $this->normaliseWarnings();
        }
        return data_get($this->responseData(), 'Messages.Warning.*.SKU') ?? [];
    }

    // ** THIS IS WHAT WE GET FROM NETO
    // Single update:
    // [
    //     'Item' => [
    //         '0001SHIF-A-00000TEST'
    //     ],
    //     'CurrentTime' => '2024-09-01 13:45:20',
    //     'Ack' => 'Success'
    // ]

    // ** THIS IS WHAT WE GET FROM NETO
    // Multiple updates:
    // [
    //     'Item' => [
    //         [
    //             'SKU' => '0001SHIF-A-00000TEST'
    //         ],
    //         [
    //             'SKU' => '0001SHIF-A-00000TEST'
    //         ]
    //     ],
    //     'CurrentTime' => '2024-09-01 13:43:58',
    //     'Ack' => 'Success'
    // ]


    // To normalise this somewhat, we could produce an output such as follows, using an array of SKUs even when
    // only 1 SKU is present. Though if no SKUs are present, the result would be undefined:
    // [
    //     'Item' => [
    //         'SKU' => [
    //             '0001SHIF-A-00000TEST',
    //             '0001SHIF-A-00000TEST'
    //         ]
    //     ],
    //     'CurrentTime' => '2024-09-01 13:51:42',
    //     'Ack' => 'Success'
    // ]
    public function normaliseItems(): static {
        // [
        //     'Item' => [
        //         'SKU' => [
        //             '0001SHIF-A-00000TEST',
        //             '0001SHIF-A-00000TEST'
        //         ]
        //     ],
        //     'CurrentTime' => '2024-09-02 09:02:13',
        if (!$this->itemsNormalised) {
            if (is_array($this->responseData()['Item']) && count($this->responseData()['Item'])) {
                $this->responseData['Item'] = ['SKU' => collect($this->responseData()['Item'])->flatten()->toArray()];
            }
            $this->itemsNormalised = true;
        }
        return $this;
    }

}
