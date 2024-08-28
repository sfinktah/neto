<?php

namespace Sfinktah\Neto;

/**
 * https://developers.maropost.com/documentation/engineers/api-documentation/orders-invoices/getorder
 */
class NetoGetOrder extends NetoPost
{
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
}
