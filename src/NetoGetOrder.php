<?php

namespace Sfinktah\Neto;

/**
 * https://developers.maropost.com/documentation/engineers/api-documentation/orders-invoices/getorder
 */
class NetoGetOrder extends NetoPost
{
    public array $withItemSelectors = [];
    public static string $netoAction = 'GetOrder';
    public static array $availableOutputSelectors = [
        "ID", "ShippingOption", "DeliveryInstruction", "RelatedOrderID", "Username", "Email", "ShipAddress",
        "BillAddress", "PurchaseOrderNumber", "SalesPerson", "CustomerRef1", "CustomerRef2", "CustomerRef3",
        "CustomerRef4", "CustomerRef5", "CustomerRef6", "CustomerRef7", "CustomerRef8", "CustomerRef9", "CustomerRef10",
        "SalesChannel", "GrandTotal", "TaxInclusive", "OrderTax", "SurchargeTotal", "SurchargeTaxable",
        "ProductSubtotal", "ShippingTotal", "ShippingTax", "ClientIPAddress", "CouponCode", "CouponDiscount",
        "ShippingDiscount", "OrderType", "OnHoldType", "OrderStatus", "OrderPayment", "DefaultPaymentType",
        "OrderPayment.PaymentType", "DateUpdated", "DatePlaced", "DateRequired", "DateInvoiced", "DatePaid",
        "DateCompleted", "DateCompletedUTC", "DatePaymentDue", "PaymentTerms", "OrderLine", "OrderLine.ProductName",
        "OrderLine.ItemNotes", "OrderLine.SerialNumber", "OrderLine.PickQuantity", "OrderLine.BackorderQuantity",
        "OrderLine.UnitPrice", "OrderLine.Tax", "OrderLine.TaxCode", "OrderLine.WarehouseID", "OrderLine.WarehouseName",
        "OrderLine.WarehouseReference", "OrderLine.Quantity", "OrderLine.PercentDiscount", "OrderLine.ProductDiscount",
        "OrderLine.CouponDiscount", "OrderLine.CostPrice", "OrderLine.ShippingMethod", "OrderLine.ShippingServiceID",
        "OrderLine.ShippingServiceName", "OrderLine.ShippingTracking", "OrderLine.ShippingCarrierCode",
        "OrderLine.ShippingCarrierName", "OrderLine.ShippingTrackingUrl", "OrderLine.Weight", "OrderLine.Cubic",
        "OrderLine.Extra", "OrderLine.ExtraOptions", "OrderLine.BinLoc", "OrderLine.QuantityShipped",
        "OrderLine.ExternalSystemIdentifier", "OrderLine.ExternalOrderReference",
        "OrderLine.ExternalOrderLineReference", "ShippingSignature", "RealtimeConfirmation", "InternalOrderNotes",
        "OrderLine.eBay.eBayUsername", "OrderLine.eBay.eBayStoreName", "OrderLine.eBay.eBayTransactionID",
        "OrderLine.eBay.eBayAuctionID", "OrderLine.eBay.ListingType", "OrderLine.eBay.DateCreated", "CompleteStatus",
        "OrderLine.eBay.DatePaid", "UserGroup", "StickyNotes"
    ];

    public static array $availableDataItems = [
        "OrderID" => ["String"/*, ...*/],
        "Username" => ["String"/*, ...*/],
        "SKU" => ["String"/*, ...*/],
        "Supplier" => ["String"/*, ...*/],
        "OrderStatus" => ["Enumeration"/*, ...*/],
        "OrderType" => ["Enumeration"/*, ...*/],
        "OnHoldType" => ["Enumeration"/*, ...*/],
        "CompleteStatus" => ["Enumeration"/*, ...*/],
        "PaymentStatus" => ["Enumeration"/*, ...*/],
        "ExportStatus" => ["Enumeration"/*, ...*/],
        "WarehouseID" => ["Integer"/*, ...*/],
        "ExportedToWMS" => ["Enumeration"/*, ...*/],
        "ShippingMethod" => ["String"/*, ...*/],
        "SalesChannel" => ["String"/*, ...*/],
        "DatePaidFrom" => "DateTime",
        "DatePaidTo" => "DateTime",
        "DateRequiredFrom" => "DateTime",
        "DateRequiredTo" => "DateTime",
        "DateInvoicedFrom" => "DateTime",
        "DateInvoicedTo" => "DateTime",
        "DatePlacedFrom" => "DateTime",
        "DatePlacedTo" => "DateTime",
        "DateUpdatedFrom" => "DateTime",
        "DateUpdatedTo" => "DateTime",
        "DateCompletedFrom" => "DateTime",
        "DateCompletedTo" => "DateTime",
        "WarehouseQuantityUpdatedFrom" => "DateTime",
        "WarehouseQuantityUpdatedTo" => "DateTime",
        "SplitKitComponents" => "Boolean",
        "ExternalSystemIdentifier" => ["String"/*, ...*/],
        "ExternalOrderReference" => "String",
        "ExternalOrderLineReference" => "String",
        "Page" => "Integer",
        "Limit" => "Integer",
        "OutputSelector" => ["Enumeration"/*, ...*/],
        "UpdateResults" =>  [
            "ExportStatus" => "Enumeration",
            "ExportedToWMS" => "Boolean" 
        ]
    ];

    /**
     * @return array = [
     *     'New', 'New Backorder', 'Backorder Approved', 'Pick', 'Pack', 'Pending Pickup', 'Pending Dispatch', 'Dispatched', 'Cancelled', 'Uncommitted', 'On Hold'
     * ][$any]
     */
    public static function orderStatusEnumeration() { return []; }

    /**
     * @param array $filter = array_merge(static::$availableDataItems, [
     *     "OrderStatus" => ["New", "New Backorder", "Backorder Approved", "Pick", "Pack", "Pending Pickup", "Pending Dispatch", "Dispatched", "Cancelled", "Uncommitted", "On Hold"][$any],
     *     "OrderType" => ["sales", "dropshipping"][$any],
     *     "OnHoldType" => ["On Hold", "Layby"][$any],
     *     "CompleteStatus" => ["Approved", "Incomplete"][$any],
     *     "PaymentStatus" => ["FullyPaid", "PartialPaid", "Pending"][$any],
     *     "ExportStatus" => ["Pending", "Exported"][$any],
     *     "ExportedToWMS" => ["Pending", "Exported"][$any],
     *     "UpdateResults" => ["ExportStatus" => "Pending", "Exported"][$any]
     * ])
     */
    public function withFilter(array $filter): static {
        return parent::withFilter($filter);
    }

    /** @param array $outputSelectors = [static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], static::$availableOutputSelectors[$any], ] */
    public function withOutputSelectors(array $outputSelectors): static {
        return parent::withOutputSelectors($outputSelectors);
    }

    /**
     * @return array = [
     *     'Order' =>
     *         [
     *                 [
     *                     'DateInvoiced' => '2023-11-26',
     *                     'CustomerRef10' => '',
     *                     'OrderType' => 'sales',
     *                     'PurchaseOrderNumber' => '',
     *                     'ShipPhone' => '0407839905',
     *                     'ShippingSignature' => 'False',
     *                     'ShippingOption' => 'Economy Mail',
     *                     'BillLastName' => 'Russell',
     *                     'ShipState' => 'SA',
     *                     'SalesChannel' => 'Website',
     *                     'InternalOrderNotes' => '',
     *                     'SurchargeTaxable' => '0.00',
     *                     'CouponCode' => '',
     *                     'CustomerRef7' => '',
     *                     'DefaultPaymentType' => 'PayPal Checkout',
     *                     'DateCompleted' => '2023-11-27',
     *                     'BillState' => 'SA',
     *                     'BillPostCode' => '5233',
     *                     'ShipLastName' => 'Russell',
     *                     'PaymentTerms' => 'Net',
     *                     'CustomerRef2' => '',
     *                     'OnHoldType' => 'On Hold',
     *                     'CustomerRef5' => '',
     *                     'CustomerRef8' => '',
     *                     'UserGroup' => '1',
     *                     'BillFirstName' => 'Shae',
     *                     'CustomerRef4' => '',
     *                     'ShippingTax' => '0.00',
     *                     'BillPhone' => '0407839905',
     *                     'ShipCountry' => 'AU',
     *                     'CustomerRef6' => '',
     *                     'CustomerRef3' => '',
     *                     'ShippingTotal' => '0.00',
     *                     'CustomerRef1' => '',
     *                     'RelatedOrderID' => '',
     *                     'DateUpdated' => '2023-12-11 23:26:40',
     *                     'ShipPostCode' => '5233',
     *                     'StickyNotes' =>
     *                         [
     *                             'StickyNoteID' => '518',
     *                             'Description' => 'https://auspost.com.au/parcels-mail/track.html#/track?id=Letter Mail',
     *                             'Title' => 'Tracking url',
     *                         ],
     *                     'DatePaid' => '2023-11-26 00:48:47',
     *                     'Username' => 'shaerussell4748',
     *                     'DeliveryInstruction' => '',
     *                     'Email' => 'shae.russell@hotmail.com',
     *                     'DateCompletedUTC' => '2023-11-27 00:15:54',
     *                     'ShipStreetLine1' => 'P.O Box 146 Gumeracha',
     *                     'ShipCity' => 'GUMERACHA',
     *                     'OrderPayment' =>
     *                         [
     *                                 [
     *                                     'PaymentType' => 'PayPal Checkout',
     *                                     'Amount' => '7.00',
     *                                     'Id' => '1653',
     *                                     'DatePaid' => '2023-11-26 00:48:47',
     *                                 ],
     *                         ],
     *                     'ShippingDiscount' => '0.00',
     *                     'DatePlaced' => '2023-11-26 00:48:47',
     *                     'ClientIPAddress' => '125.168.66.131',
     *                     'GrandTotal' => '7.00',
     *                     'OrderTax' => '0.64',
     *                     'DateRequired' => '',
     *                     'RealtimeConfirmation' => 'FULLY PAID',
     *                     'OrderStatus' => static::orderStatusEnumeration(),
     *                     'ID' => 'SFX0001727',
     *                     'CompleteStatus' => 'Approved',
     *                     'BillStreetLine1' => 'P.O Box 146 Gumeracha',
     *                     'BillCountry' => 'AU',
     *                     'OrderID' => 'SFX0001727',
     *                     'CustomerRef9' => '',
     *                     'ShipFirstName' => 'Shae',
     *                     'OrderLine' =>
     *                         [
     *                                 [
     *                                     'Extra' => '',
     *                                     'ExternalOrderReference' => '',
     *                                     'ExtraOptions' =>
     *                                         [
     *                                             'ExtraOption' => '',
     *                                         ],
     *                                     'ShippingTracking' => 'Letter Mail',
     *                                     'Cubic' => '0.000121000',
     *                                     'ShippingTrackingUrl' => '',
     *                                     'WarehouseID' => '2',
     *                                     'Quantity' => '1',
     *                                     'ItemNotes' => '',
     *                                     'OrderLineID' => 'SFX0001727-0',
     *                                     'SerialNumber' => '',
     *                                     'UnitPrice' => '3.50000000',
     *                                     'ExternalOrderLineReference' => '',
     *                                     'BackorderQuantity' => '0',
     *                                     'PercentDiscount' => '0.00',
     *                                     'ShippingServiceID' => '0',
     *                                     'ShippingMethod' => 'Australia Post',
     *                                     'BinLoc' => '',
     *                                     'WarehouseName' => 'SFX BRISBANE',
     *                                     'CouponDiscount' => '0.00',
     *                                     'CostPrice' => '3.50000000',
     *                                     'Weight' => '0.0100',
     *                                     'TaxCode' => 'GST',
     *                                     'ProductDiscount' => '0.00',
     *                                     'Tax' => '0.32',
     *                                     'ShippingServiceName' => 'Australia Post',
     *                                     'ExternalSystemIdentifier' => '',
     *                                     'WarehouseReference' => 'SFXBRIS',
     *                                     'ProductName' => '180SX GearShift H-Pattern - 5 Speed - R Bottom Right',
     *                                     'QuantityShipped' => '1',
     *                                     'SKU' => '0001SHIF-A',
     *                                     'PickQuantity' => '1',
     *                                 ],
     *                                 [
     *                                     'Extra' => '',
     *                                     'ExternalOrderReference' => '',
     *                                     'ExtraOptions' =>
     *                                         [
     *                                             'ExtraOption' => '',
     *                                         ],
     *                                     'ShippingTracking' => 'Letter Mail',
     *                                     'Cubic' => '0.000121000',
     *                                     'ShippingTrackingUrl' => '',
     *                                     'WarehouseID' => '2',
     *                                     'Quantity' => '1',
     *                                     'ItemNotes' => '',
     *                                     'OrderLineID' => 'SFX0001727-1',
     *                                     'SerialNumber' => '',
     *                                     'UnitPrice' => '3.50000000',
     *                                     'ExternalOrderLineReference' => '',
     *                                     'BackorderQuantity' => '0',
     *                                     'PercentDiscount' => '0.00',
     *                                     'ShippingServiceID' => '0',
     *                                     'ShippingMethod' => 'Australia Post',
     *                                     'BinLoc' => '',
     *                                     'WarehouseName' => 'SFX BRISBANE',
     *                                     'CouponDiscount' => '0.00',
     *                                     'CostPrice' => '3.50000000',
     *                                     'Weight' => '0.0100',
     *                                     'TaxCode' => 'GST',
     *                                     'ProductDiscount' => '0.00',
     *                                     'Tax' => '0.32',
     *                                     'ShippingServiceName' => 'Australia Post',
     *                                     'ExternalSystemIdentifier' => '',
     *                                     'WarehouseReference' => 'SFXBRIS',
     *                                     'ProductName' => 'SILVIA S13 GearShift H-Pattern  - 5 Speed - R Bottom Right',
     *                                     'QuantityShipped' => '1',
     *                                     'SKU' => '0018SHIF-A',
     *                                     'PickQuantity' => '1',
     *                                 ],
     *                         ],
     *                     'ProductSubtotal' => '7.00',
     *                     'BillCity' => 'GUMERACHA',
     *                     'DatePaymentDue' => '2023-11-25 13:00:00',
     *                     'TaxInclusive' => 'True',
     *                     'CouponDiscount' => '0.00',
     *                     'SurchargeTotal' => '0.00',
     *                     'SalesPerson' => '',
     *                 ],
     *         ],
     *     'CurrentTime' => '2024-08-28 11:12:31',
     *     'Ack' => ['Success', 'Warning', 'Error'][$any],
     *     'Messages' => [
     *         'Error' => [
     *             'Message' => 'JSON Error',
     *             'SeverityCode' => 'Error',
     *             'Description' => 'String'
     *         ],
     *         'Warning' => [
     *             'Message' => 'Warning Message',
     *             'SeverityCode' => 'Warning'
     *         ]
     *     ]
     * ]
     */
    public static function returnDataExample(): array {
        return [];
    }

    public function withItemSelectors(array $withItemSelectors): static {
        $this->withItemSelectors = array_unique(array_merge($this->withItemSelectors, $withItemSelectors));
        return $this;
    }

    /**
     * Get response decoded as array/object
     * @return array = static::returnDataExample()
     */
    public function responseData() : array {
        return $this->responseData;
    }
}
