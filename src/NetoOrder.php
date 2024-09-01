<?php

namespace Sfinktah\Neto;

/**
 * https://developers.maropost.com/documentation/engineers/api-documentation/products/updateitem/
 */
class NetoOrder extends NetoPost
{
    public static string $postKey = 'Order';

    /**
     * @param array $order = static::$availableDataItems
     */
    public function withOrder(array $order): static {
        $this->data = array_merge($this->data, $order);
        return $this;
    }

}
