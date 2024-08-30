<?php /** @noinspection DuplicatedCode */

use Sfinktah\Neto\NetoAddItem;
use Sfinktah\Neto\NetoDateTime;
use Sfinktah\Neto\NetoGetItem;
use Sfinktah\Neto\NetoGetOrder;
use Sfinktah\Neto\NetoUpdateOrder;


$directory = __DIR__;
$bootstrapFilePath = '';
while ($directory !== DIRECTORY_SEPARATOR) {
    $potentialPath = $directory . DIRECTORY_SEPARATOR . 'bootstrap.php';
    if (file_exists($potentialPath)) {
        $bootstrapFilePath = $potentialPath;
        break;
    }
    $directory = dirname($directory);
}

if ($bootstrapFilePath) {
    require_once $bootstrapFilePath;
} else {
    echo "Error: Unable to locate 'bootstrap.php' in the current directory or any parent directories. This may be fatal.\n";
}

function getOrderDetailsByDateRange($dateFrom, $dateTo)
{
    $request = NetoGetOrder::make([
        'DatePlacedFrom' => $dateFrom,
        'DatePlacedTo' => $dateTo,
        'OrderStatus' => [
            'New', 'New Backorder', 'Backorder Approved', 'Pick', 'Pack', 'Pending Pickup', 'Pending
            Dispatch', 'Dispatched', 'Cancelled', 'Uncommitted', 'On Hold'
        ],
    ])
    ->withOutputSelectors([
        'OrderID',
        'ShippingOption',
        'DeliveryInstruction',
        'Username',
        'Email',
        'ShipAddress',
        'BillAddress',
        'CustomerRef1',
        'CustomerRef2',
        'CustomerRef3',
        'CustomerRef4',
        'SalesChannel',
        'GrandTotal',
        'ShippingTotal',
        'ShippingDiscount',
        'OrderType',
        'OrderStatus',
        'OrderPayment',
        'OrderPayment.DatePaid',
        'OrderPayment.PaymentType',
        'SurchargeTotal', // Fetching surcharge total
        'CurrencyCode', // Fetching currency code, use a default if not available
        'InternalOrderNotes', // Fetching internal notes
        'StickyNotes', // Fetching sticky notes
        'DatePlaced',
        'DateRequired',
        'DateInvoiced',
        'DatePaid',
        'DateCompletedUTC',
        'OrderLine',
        'OrderLine.ProductName',
        'OrderLine.PickQuantity',
        'OrderLine.BackorderQuantity',
        'OrderLine.UnitPrice',
        'OrderLine.WarehouseID',
        'OrderLine.WarehouseName',
        'OrderLine.WarehouseReference',
        'OrderLine.Quantity',
        'OrderLine.PercentDiscount',
        'OrderLine.ProductDiscount',
        'OrderLine.CostPrice',
        'OrderLine.ShippingMethod',
        'OrderLine.ShippingTracking',
        'ShippingSignature',
        'eBay.eBayUsername',
        'eBay.eBayStoreName',
        'OrderLine.eBay.eBayTransactionID',
        'OrderLine.eBay.eBayAuctionID',
        'OrderLine.eBay.ListingType',
        'OrderLine.eBay.DateCreated',
        'OrderLine.eBay.DatePaid',
        'OrderLine.DateShipped', // Fetching the date shipped
    ]);

    $request->post();
    return $request->responseData();
}
function test($sku = '0001SHIF-A', $orderId = 'SFX0004973') {

    // ********************
    // ** GetOrder by DateRange
    // ********************
    $request = NetoGetOrder::make([
        'DatePlacedFrom' => NetoDateTime::make('-1 week'),
        'DatePlacedTo' => NetoDateTime::make('now'),
    ])
        ->withOutputSelectors(['OrderStatus', 'Username', 'Email', 'ShipAddress', 'ShippingOption', 'DateCompleted']);

    $request->post();
    $orderData = $request->responseData();
    foreach ($orderData as $key => $orders) {
        if (is_array($orders)) {
            foreach ($orders as $order) {
                $isCancelled = $order['OrderStatus'] === 'Cancelled';
                print_r(["Order" => [
                    'isCancelled' => $isCancelled ? 'Cancelled' : 'Not Cancelled',
                    $order['OrderStatus'],
                    $order['Username'],
                    $order['Email'],
                    $order['ShipCountry'],
                    $order['ShippingOption'],

                    //...
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

function testUpdateOrder($sku = 'amp74830-01A', string $orderId = 'SFX0004973'): NetoUpdateOrder {
    // ********************
    // ** UpdateOrder
    // ********************
    $request = NetoUpdateOrder::make()
        ->withData([
                "OrderID" => $orderId,
                "StickyNoteTitle" => "Test Title",
                "StickyNote" => "Test Note",
                "OrderStatus" => "Dispatched",
                // "SendOrderEmail" => "tracking",
                // "OrderLine" => [
                //     [
                //         "SKU" => $sku,
                //         "TrackingDetails" => [
                //             "ShippingMethod" => "Australia Post eParcel",
                //             "TrackingNumber" => "C123345767765",
                //             "DateShipped" => "2014-01-03 02:40:10"
                //         ]
                //     ],
                //     [
                //         "SKU" => $sku,
                //         "TrackingDetails" => [
                //             "ShippingMethod" => "Australia Post eParcel",
                //             "TrackingNumber" => "C123345767765",
                //             "DateShipped" => "2014-01-03 02:40:10"
                //         ]
                //     ]
                // ]
        ]);
    $request->post();
    var_export($request->responseData());
    return $request;
}

/**
 * @param mixed $orderId
 * @return \Sfinktah\Neto\NetoGetOrder
 */
function testGetOrder(mixed $orderId = 'SFX0004973'): NetoGetOrder {
    // ********************
    // ** GetOrder by OrderID
    // ********************
    $request = NetoGetOrder::make(['OrderID' => $orderId])
        ->withOutputSelectors(['OrderStatus', 'StickyNotes', 'Username', 'Email', 'ShipAddress', 'ShippingOption', 'OrderLine', 'OrderLine.ShippingTracking', 'OrderLine.ShippingMethod', 'OrderLine.ShippingTrackingUrl']);
    $request->post();
    var_export($request->responseData());
    return $request;
}

/**
 * @param array|string $orderId
 * @return \Sfinktah\Neto\NetoUpdateOrder
 * @throws \GuzzleHttp\Exception\GuzzleException
 * @throws \Sfinktah\Neto\InvalidOutputSelector
 */
// change order status to Dispatched
$request = testUpdateOrder();
// get updated order
$request = testGetOrder();
