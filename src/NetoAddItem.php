<?php

namespace Sfinktah\Neto;

/**
 * https://developers.maropost.com/documentation/engineers/api-documentation/products/additem/
 */
class NetoAddItem extends NetoUpdateItem
{
    public static string $netoAction = 'AddItem';
    public static string $postKey = 'Item';

    // (these appear to be the same as for UpdateItem)
    // public static array $availableDataItems
}
