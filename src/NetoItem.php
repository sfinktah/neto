<?php

namespace Sfinktah\Neto;

use Illuminate\Support\Str;

/**
 * https://developers.maropost.com/documentation/engineers/api-documentation/products/updateitem/
 */
class NetoItem extends NetoPost
{
    public static string $postKey = 'Item';
    protected bool $itemsNormalised = false;
    protected bool $warningsNormalised = false;


    /**
     * @param array $item = static::$availableDataItems
     */
    public function withItem(array $item): static {
        $this->data = array_merge($this->data, $item);
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

    public function normaliseWarnings(): static {
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
                $this->responseData['Messages']['Warning'] = collect($this->responseData()['Messages']['Warning'])
                    ->flatten()
                    ->filter(fn($v, $k) => $v !== 'Warning')
                    ->values()
                    ->map(fn($v, $k) => ['SKU' => Str::afterLast($v, 'Item '), 'Message' => $v])
                    ->toArray();
            }
            $this->warningsNormalised = true;
        }
        return $this;
    }
}
