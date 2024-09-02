<?php /** @noinspection DuplicatedCode */

use Brick\VarExporter\VarExporter;
use Illuminate\Support\Str;
use Sfinktah\Neto\NetoAddItem;
use Sfinktah\Neto\NetoDateTime;
use Sfinktah\Neto\NetoGetItem;
use Sfinktah\Neto\NetoGetOrder;
use Sfinktah\Neto\NetoUpdateItem;
use Sfinktah\Neto\NetoUpdateOrder;


$directory = realpath(__DIR__);
$bootstrapFilePath = '';
while ($directory !== DIRECTORY_SEPARATOR) {
    $potentialPath = $directory . DIRECTORY_SEPARATOR . 'bootstrap.php';
    if (file_exists($potentialPath)) {
        $bootstrapFilePath = $potentialPath;
        break;
    }
    $directory = dirname($directory);
}

if (!function_exists('dump')) {
    if ($bootstrapFilePath) {
        require_once $bootstrapFilePath;
    } else {
        echo "Error: Unable to locate 'bootstrap.php' in the current directory or any parent directories. This may be fatal.\n";
    }
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
         // 'StickyNotes', // Fetching sticky notes
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

}

/**
 * @param mixed $sku
 * @return \Sfinktah\Neto\NetoAddItem
 * @throws \Brick\VarExporter\ExportException
 * @throws \GuzzleHttp\Exception\GuzzleException
 * @throws \Sfinktah\Neto\InvalidOutputSelector
 */
function addHelloKittyItem(mixed $sku): NetoAddItem {
    // ********************
    // ** AddItem
    // ********************
    $request = NetoAddItem::make()
        ->withData(
            [[
                'Name' => 'blah',
                'RestockQty' => 12,
                'WarehouseQuantity' => ['WarehouseID' => 16, 'Quantity' => 99, 'Action' => 'set'],
                'SKU' => $sku,
            ]]);
    echo VarExporter::export($request->post()) . "\n";
    return $request;

    // ********************
    // ** UpdateItem
    // ********************
    // This is going to be the same as AddItem (as far as I can tell)
    // https://developers.maropost.com/documentation/engineers/api-documentation/products/updateitem/
}

/**
 * @param mixed $sku
 * @return \Sfinktah\Neto\NetoUpdateItem
 * @throws \Brick\VarExporter\ExportException
 * @throws \GuzzleHttp\Exception\GuzzleException
 * @throws \Sfinktah\Neto\InvalidOutputSelector
 */
function updateHelloKittyItem(mixed $sku): NetoUpdateItem {
    // ********************
    // ** UpdateItem
    // ********************
    // This is going to be the same as AddItem (as far as I can tell)
    // https://developers.maropost.com/documentation/engineers/api-documentation/products/updateitem/
    $request = NetoUpdateItem::make()
        ->withData(
            [
                [
                    'Name' => 'A really pretty Hello Kitty for your hizzy',
                    'RestockQty' => 8,
                    'WarehouseQuantity' => ['WarehouseID' => 16, 'Quantity' => 1, 'Action' => 'decrement'],
                    'SKU' => $sku,
                ],
                [
                    'Name' => 'A really pretty Hello Kitty for your hizzy',
                    'RestockQty' => 8,
                    'WarehouseQuantity' => ['WarehouseID' => 16, 'Quantity' => 1, 'Action' => 'decrement'],
                    'SKU' => $sku,
                ],
            ]);
    $request->post();
    $responseData = $request->responseData();


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
    //
    // We may elect not to modify the response, and have an additional method ::updatedSkus() or smth, but let's
    // just manually perform it here for this example until we decide.
    if (is_array($responseData['Item']) && count($responseData['Item'])) {
        $responseData['Item'] = ['SKU' => collect($responseData['Item'])->flatten()->toArray()];
    }

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

    // We can flatten and extract the Item to produce a keyed array in all cases (except when there are no Warnings)
    if (is_array($responseData['Messages']['Warning'] ?? null) && count($responseData['Messages']['Warning'])) {
        $responseData['Messages']['Warning'] = collect($responseData['Messages']['Warning'])
            ->flatten()
            ->filter(fn($v, $k) => $v !== 'Warning')
            ->values()
            ->mapWithKeys(fn($v, $k) => [Str::afterLast($v, 'Item ') => Str::beforeLast($v, ' Item ')])
            ->toArray();
    }

    $exampleResult = [
        'Item' => '',
        'CurrentTime' => '2024-09-02 08:17:20',
        'Ack' => 'Warning',
        'Messages' => [
            'Warning' => [
                '0001SHIF-A-00000TESTxx' => 'Cannot find',
                '0001SHIF-A-00000TESTx' => 'Cannot find'
            ]
        ]
    ];

    echo VarExporter::export($responseData) . "\n";
    return $request;
}


/**
 * @param mixed $sku
 * @return \Sfinktah\Neto\NetoGetItem
 * @throws \GuzzleHttp\Exception\GuzzleException
 * @throws \Sfinktah\Neto\InvalidOutputSelector
 */
function getItemBySku(mixed $sku): NetoGetItem {
    // ********************
    // ** GetItem by SKU
    // ********************
    $request = NetoGetItem::make(['SKU' => $sku])
        ->withOutputSelectors(['Name', 'Brand', 'Model', 'WarehouseQuantity']);
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
    return $request;
}

function testUpdateOrder($sku = 'amp74830-01A', string $orderId = 'SFX0004973'): NetoUpdateOrder {
    // ********************
    // ** UpdateOrder
    // ********************
    $request = new NetoUpdateOrder;
    $request
        ->withData([
                "OrderID" => $orderId,
                "StickyNoteTitle" => "Test Title 2",
                "StickyNote" => "Test Note 2",
                // "OrderStatus" => "Dispatched",
                "OrderStatus" => "Cancelled",
                // "SendOrderEmail" => "tracking",
                "OrderLine" => [
                    [
                        "SKU" => $sku,
                        "TrackingDetails" => [
                            "ShippingMethod" => "Australia Post eParcel",
                            "TrackingNumber" => "C123345767765",
                            "DateShipped" => "2014-01-03 02:40:10",
                        ]
                    ],
                ]
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

    $response = $request->responseData();

    // var_export($request->responseData());
    // dump($request->responseData());
    // echo VarExporter::export($request->responseData()) . "\n";
    // s($request->responseData());
    if ($response['Ack'] == 'Error' && $response['Messages']['Error']['Message'] == 'JSON Error') {
        // VarExporter::export($request->postData);
        ssd($request->postData);
    }

    // var_export($request->responseData());
    echo VarExporter::export($response) . "\n";
    return $request;
}

/**
 * @param mixed $orderId
 * @return \Sfinktah\Neto\NetoGetOrder
 * @throws \GuzzleHttp\Exception\GuzzleException
 * @throws \Sfinktah\Neto\InvalidOutputSelector|\Brick\VarExporter\ExportException
 */
function testGetOrder(mixed $orderId = 'SFX0004973'): NetoGetOrder {
    // ********************
    // ** GetOrder by OrderID
    // ********************
    $request = NetoGetOrder::make(['OrderID' => $orderId])
        ->withOutputSelectors(['OrderStatus', 'Username', 'Email', 'ShipAddress', 'ShippingOption',
        'OrderLine', 'OrderLine.ShippingTracking', 'OrderLine.ShippingMethod', 'OrderLine.ShippingTrackingUrl',
        'DatePlaced']); // 'StickyNotes',
    $request->post();
    // var_export($request->responseData());
    echo VarExporter::export($request->responseData()) . "\n";

    return $request;
}

function debugGetOrder(mixed $orderId = 'SFX0004973') {
    sd(NetoGetOrder::make(['OrderID' => $orderId])
        ->withOutputSelectors(NetoGetOrder::$availableOutputSelectors)
        ->post());
}

function debugGetItem(mixed $sku = '0001SHIF-A') {
    echo VarExporter::export('') . "\n";
    $request = NetoGetItem::make(['SKU' => $sku])
        ->withOutputSelectors(NetoGetItem::$availableOutputSelectors);
    $res2 = $request->post();
    $response = $request->responseData();
}

$sku = '0001SHIF-A';
$orderId = 'SFX0004973';
$helloKittySku = $sku . "-00000TEST";

// debugGetItem();

/** @noinspection PhpUnhandledExceptionInspection */
// $request = addHelloKittyItem($helloKittySku);

/** @noinspection PhpUnhandledExceptionInspection */
$request = updateHelloKittyItem($helloKittySku);
die();
/** @noinspection PhpUnhandledExceptionInspection */
// $request = getItemBySku($helloKittySku);

// sd($request->responseData());

// change order status to 'Dispatched'
/** @noinspection PhpUnhandledExceptionInspection */
$request = testUpdateOrder();

// get updated order
/** @noinspection PhpUnhandledExceptionInspection */
$request = testGetOrder();

/** @noinspection PhpUnhandledExceptionInspection */
$request = getItemBySku($sku);
s(getOrderDetailsByDateRange('2024-08-29 02:36:54', '2024-08-29 02:36:56'));
s(
    collect(getOrderDetailsByDateRange('2024-08-29', '2024-08-30')['Order'])
        ->filter(
            /**
             * @param $order = getOrderDetailsByDateRange()['Order'][]
             */
            fn($order) => $order['OrderStatus'] === 'Cancelled')
);