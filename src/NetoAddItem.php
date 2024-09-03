<?php

namespace Sfinktah\Neto;

/**
 * https://developers.maropost.com/documentation/engineers/api-documentation/products/additem/
 */
class NetoAddItem extends NetoUpdateItem
{
    public static string $netoAction = 'AddItem';

    // (these appear to be the same as for UpdateItem)
    // public static array $availableDataItems


    /**
     * @return array = [
     *     'Item' => [
     *         'InventoryID' => '48738163',
     *         'SKU' => '0001SHIF-A-00000TEST'
     *     ],
     *     'CurrentTime' => '2024-08-30 10:22:21',
     *     'Ack' => ['Success', 'Error'][$any]
     *     'Messages' => [
     *         'Error' => [
     *             'Message' => 'JSON Error',
     *             'SeverityCode' => 'Error',
     *             'Description' => 'String'
     *     ]
     * ]
     */
    public function responseData() : array {
        return $this->responseData;
    }
}
