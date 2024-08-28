<?php

namespace Sfinktah\Neto;

/**
 * https://developers.maropost.com/documentation/engineers/api-documentation/orders-invoices/updateorder
 */
class NetoUpdateOrder extends NetoPost
{
    public static string $netoAction = 'UpdateOrder';
    public static array $availableOutputSelectors = [];

    public static array $availableDataItems = [
        "Order" => [
            [
                "OrderID" => "String",
                "PurchaseOrderNumber" => "String",
                "OnHoldType" => "Enumeration",
                "Email" => "String",
                "BillFirstName" => "String",
                "BillLastName" => "String",
                "BillCompany" => "String",
                "BillStreet1" => "String",
                "BillStreet2" => "String",
                "BillCity" => "String",
                "BillState" => "String",
                "BillPostCode" => "String",
                "BillContactPhone" => "String",
                "BillCountry" => "String",
                "ShipFirstName" => "String",
                "ShipLastName" => "String",
                "ShipCompany" => "String",
                "ShipStreet1" => "String",
                "ShipStreet2" => "String",
                "ShipCity" => "String",
                "ShipState" => "String",
                "ShipPostCode" => "String",
                "ShipContactPhone" => "String",
                "ShipCountry" => "String",
                "EnableAddressValidation" => "Boolean",
                "DeduceWarehouse" => "Boolean",
                "Operator" => "String",
                "OperatorDateUpdated" => "DateTime",
                "DateRequired" => "DateTime",
                "DateRequiredUTC" => "DateTime",
                "SalesPerson" => "String",
                "CustomerRef1" => "String",
                "CustomerRef2" => "String",
                "CustomerRef3" => "String",
                "CustomerRef4" => "String",
                "CustomerRef5" => "String",
                "CustomerRef6" => "String",
                "CustomerRef7" => "String",
                "CustomerRef8" => "String",
                "CustomerRef9" => "String",
                "CustomerRef10" => "String",
                "SalesChannel" => "String",
                "ShipInstructions" => "String",
                "InternalOrderNotes" => "String",
                "OrderStatus" => "Enumeration", // "Quote", "New", "New Backorder", "Backorder Approved", "Pick", "Pack", "Pending Pickup", "Pending Dispatch", "Dispatched", "Cancelled", "Uncommitted", "On Hold",
                "OrderApproval" => "Boolean",
                "PickStatus" => "Enumeration",
                "ExportStatus" => "Enumeration",
                "ExportedToWMS" => "Enumeration",
                "SendOrderEmail" => "String",
                "StickyNoteTitle" => "String",
                "StickyNote" => "String",
                "StickyNotes" => [
                    "StickyNote" => [
                        [
                            "StickyNoteID" => "Integer",
                            "Title" => "String",
                            "Description" => "String"
                        ]
                    ]
                ],
                "OrderLine" => [
                    [
                        "OrderLineID" => "Integer",
                        "OrderLineNumber" => "Integer",
                        "WarehouseID" => "Integer",
                        "QuantityShipped" => "Integer",
                        "WarehouseName" => "String",
                        "WarehouseReference" => "String",
                        "ExternalSystemIdentifier" => "String",
                        "ExternalOrderReference" => "String",
                        "ExternalOrderLineReference" => "String",
                        "SKU" => "String",
                        "ItemNotes" => "String",
                        "ItemDescription" => "String",
                        "ItemSerialNumber" => "String",
                        "TrackingDetails" => [
                            "ShippingMethod" => "String",
                            "TrackingNumber" => "String",
                            "DateShipped" => "DateTime"
                        ]
                    ]
                ],
                "OrderRounding" => "Decimal"
            ]
        ]
    ];
}
