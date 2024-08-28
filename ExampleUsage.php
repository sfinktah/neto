<?php

use Sfinktah\Neto\NetoAddItem;
use Sfinktah\Neto\NetoDateTime;
use Sfinktah\Neto\NetoGetItem;
use Sfinktah\Neto\NetoGetOrder;
use Sfinktah\Neto\NetoUpdateOrder;

function test($sku = '0001SHIF-A', $orderId = 'SFX0001727') {

    // ********************
    // ** GetOrder by OrderID
    // ********************
    $request = NetoGetOrder::make()
        ->withFilter([
            'OrderID' => $orderId,
        ])
        ->withOutputSelectors(['OrderStatus', 'Username', 'Email', 'ShipAddress', 'ShippingOption']);

    // ********************
    // ** GetOrder by DateRange
    // ********************
    $request = NetoGetOrder::make([
        'DatePlacedFrom' => NetoDateTime::make('-1 week'),
        'DatePlacedTo' => NetoDateTime::make('now'),
    ])
        ->withOutputSelectors(['OrderStatus', 'Username', 'Email', 'ShipAddress', 'ShippingOption']);

    $request->post();
    $orderData = $request->responseData();
    foreach ($orderData as $key => $orders) {
        if (is_array($orders)) {
            foreach ($orders as $order) {
                print_r(["Order" => [
                    $order['OrderStatus'],
                    $order['Username'],
                    $order['Email'],
                    $order['ShipCountry'],
                    $order['ShippingOption'],
                    // ...
                    // use autocomplete in klesun/deep-assoc-completion PhpStorm plugin for a complete list
                ]]);
            }
        }
        else {
            printf("%s: %s\n", $key, print_r($orders, 1));
        }
    }

    // ********************
    // ** UpdateOrder
    // ********************
    $request = NetoUpdateOrder::make([
        "Order" => [
            "OrderID" => "N1000",
            "OrderStatus" => "Dispatched",
            "SendOrderEmail" => "tracking",
            "OrderLine" => [
                [
                    "SKU" => "ABC-123",
                    "TrackingDetails" => [
                        "ShippingMethod" => "Australia Post eParcel",
                        "TrackingNumber" => "C123345767765",
                        "DateShipped" => "2014-01-03 02:40:10"
                    ]
                ],
                [
                    "SKU" => "HYS-97462",
                    "TrackingDetails" => [
                        "ShippingMethod" => "Australia Post eParcel",
                        "TrackingNumber" => "C123345767765",
                        "DateShipped" => "2014-01-03 02:40:10"
                    ]
                ]
            ]
        ]
    ]);
    $request->post();
    var_export($request->responseData());


    // ********************
    // ** GetItem by SKU
    // ********************
    $request = NetoGetItem::make(['SKU' => $sku])
        ->withOutputSelectors(['Name', 'Brand', 'Model']);
    $request->post();
    $itemData = $request->responseData();
    printf("GetItem Error: %s\n", $itemData['Messages']['Error'] ?? 'None');
    printf("GetItem Warning: %s\n", $itemData['Messages']['Warning'] ?? 'None');
    foreach ($itemData['Item'] as $item) {
        print_r(["Item" => [
            $item['Name'],
            $item['Brand'],
            $item['Model']
        ]]);
    }

    // ********************
    // ** AddItem
    // ********************
    $request = NetoAddItem::make([
        'Item' => [
            [
                'Name' => 'blah',
                'RestockQty' => 12,
                'SKU' => $sku,
                'Images' => [
                    'Image' => [
                        ['Name' => 'Hello Kitty', 'URL' => 'https://www.hellokitty.com'],
                    ]
                ],
            ]
        ]]);
    $request->post();
    // Documentation suggests this will return
    //    {
    //        "Item": [
    //            {
    //                "SKU": "String"
    //            }
    //        ],
    //        "Messages": {
    //            "Error": [
    //                {
    //                    "Message": "String",
    //                    "SeverityCode": "String",
    //                    "Description": "String"
    //                }
    //            ],
    //            "Warning": [
    //                {
    //                    "Message": "String",
    //                    "SeverityCode": "String"
    //                }
    //            ]
    //        }
    //    }
    var_export($request->responseData());

    // ********************
    // ** UpdateItem
    // ********************
    // This is going to be the same as AddItem (as far as I can tell)
    // https://developers.maropost.com/documentation/engineers/api-documentation/products/updateitem/
}

test();
