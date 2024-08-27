<?php

namespace Sfinktah\Neto;

class NetoGetOrder extends NetoPost
{
    public static string $netoAction = 'GetOrder';
    public static array $availableOutputSelectors = [
        "ShippingOption", "DeliveryInstruction", "Username", "Email", "ShipAddress", "BillAddress", "CustomerRef1",
        "CustomerRef2", "CustomerRef3", "CustomerRef4", "SalesChannel", "GrandTotal", "ShippingTotal",
        "ShippingDiscount", "OrderType", "OrderStatus", "OrderPayment", "OrderPayment.DatePaid", "DatePlaced",
        "DateRequired", "DateInvoiced", "DatePaid", "OrderLine", "OrderLine.ProductName", "OrderLine.PickQuantity",
        "OrderLine.BackorderQuantity", "OrderLine.UnitPrice", "OrderLine.WarehouseID", "OrderLine.WarehouseName",
        "OrderLine.WarehouseReference", "OrderLine.Quantity", "OrderLine.PercentDiscount", "OrderLine.ProductDiscount",
        "OrderLine.CostPrice", "OrderLine.ShippingMethod", "OrderLine.ShippingTracking", "ShippingSignature",
        "eBay.eBayUsername", "eBay.eBayStoreName", "OrderLine.eBay.eBayTransactionID", "OrderLine.eBay.eBayAuctionID",
        "OrderLine.eBay.ListingType", "OrderLine.eBay.DateCreated", "OrderLine.eBay.DatePaid"
    ];
}