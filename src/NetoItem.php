<?php

namespace Sfinktah\Neto;

/**
 * https://developers.maropost.com/documentation/engineers/api-documentation/products/updateitem/
 */
class NetoItem extends NetoPost
{
    public static string $postKey = 'Item';

    /**
     * @param array $item = static::$availableDataItems
     */
    public function withItem(array $item): static {
        $this->data = array_merge($this->data, $item);
        return $this;
    }

}
