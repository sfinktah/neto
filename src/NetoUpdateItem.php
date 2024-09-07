<?php

namespace Sfinktah\Neto;

/**
 * https://developers.maropost.com/documentation/engineers/api-documentation/products/updateitem/
 */
class NetoUpdateItem extends NetoItem
{
    public static string $netoAction = 'UpdateItem';
    public static array $availableDataItems = [
                [
                    "SKU" => "String",
                    "RestockQty" => "Integer",
                    "ReorderQty" => "Integer",
                    "RestockWarningLevel" => "Integer",
                    "InventoryID" => "Integer",
                    "ParentSKU" => "String",
                    "AccountingCode" => "String",
                    "Virtual" => "Boolean",
                    "Brand" => "String",
                    "Name" => "String",
                    "Model" => "String",
                    "SortOrder1" => "Integer",
                    "SortOrder2" => "Integer",
                    "RRP" => "Decimal",
                    "DefaultPrice" => "Decimal",
                    "DefaultPurchasePrice" => "Decimal",
                    "PromotionPrice" => "Decimal",
                    "PromotionStartDate" => "DateTime",
                    "PromotionExpiryDate" => "DateTime",
                    "DateArrival" => "Date",
                    "CostPrice" => "Decimal",
                    "UnitOfMeasure" => "String",
                    "BaseUnitOfMeasure" => "String",
                    "BaseUnitPerQuantity" => "Decimal",
                    "BuyUnitQuantity" => "Integer",
                    "SellUnitQuantity" => "Integer",
                    "PreOrderQuantity" => "Integer",
                    "PickPriority" => "Enumeration",
                    "PickZone" => "String",
                    "RestrictedToUserGroup" => "String",
                    "Approved" => "Boolean",
                    "ApprovedForPOS" => "Boolean",
                    "ApprovedForMobileStore" => "Boolean",
                    "IsActive" => "Boolean",
                    "Active" => "Boolean",
                    "Visible" => "Boolean",
                    "TaxCategory" => "String",
                    "TaxFreeItem" => "Boolean",
                    "TaxInclusive" => "Boolean",
                    "AuGstExempt" => "Boolean",
                    "NzGstExempt" => "Boolean",
                    "SearchKeywords" => "String",
                    "ShortDescription" => "String",
                    "Description" => "String",
                    "TermsAndConditions" => "String",
                    "Features" => "String",
                    "Specifications" => "String",
                    "Warranty" => "String",
                    "ArtistOrAuthor" => "String",
                    "Format" => "String",
                    "ModelNumber" => "String",
                    "Subtitle" => "String",
                    "AvailabilityDescription" => "String",
                    "ImageURL" => "String",
                    "Images" => [
                        "Image" => [
                            [
                                "Name" => "String",
                                "URL" => "String",
                                "Base64" => "String",
                                "Delete" => "Boolean"
                            ]
                        ]
                    ],
                    "BrochureURL" => "String",
                    "ProductURL" => "String",
                    "UPC" => "String",
                    "UPC1" => "String",
                    "UPC2" => "String",
                    "UPC3" => "String",
                    "Type" => "String",
                    "Subtype" => "String",
                    "NumbersOfLabelsToPrint" => "Integer",
                    "ReferenceNumber" => "Integer",
                    "InternalNotes" => "String",
                    "BarcodeHeight" => "Integer",
                    "IsInventoried" => "Boolean",
                    "IsBought" => "Boolean",
                    "IsSold" => "Boolean",
                    "ExpenseAccount" => "String",
                    "PurchaseTaxCode" => "String",
                    "CostOfSalesAccount" => "String",
                    "IncomeAccount" => "String",
                    "AssetAccount" => "String",
                    "ItemHeight" => "Decimal",
                    "ItemLength" => "Decimal",
                    "ItemWidth" => "Decimal",
                    "ShippingHeight" => "Decimal",
                    "ShippingLength" => "Decimal",
                    "ShippingWidth" => "Decimal",
                    "ShippingWeight" => "Decimal",
                    "CubicWeight" => "Decimal",
                    "HandlingTime" => "Integer",
                    "SupplierItemCode" => "String",
                    "SplitForWarehousePicking" => "Boolean",
                    "eBayDescription" => "String",
                    "PrimarySupplier" => "String",
                    "DisplayTemplate" => "String",
                    "EditableKitBundle" => "Boolean",
                    "RequiresPackaging" => "Boolean",
                    "ItemURL" => "String",
                    "CustomContent" => "String",
                    "CustomNonDelivery" => "String",
                    "SEOPageTitle" => "String",
                    "SEOMetaKeywords" => "String",
                    "SEOPageHeading" => "String",
                    "SEOMetaDescription" => "String",
                    "SEOCanonicalURL" => "String",
                    "AutomaticURL" => "Boolean",
                    "IsAsset" => "Boolean",
                    "IsServiceItem" => "Boolean",
                    "WhenToRepeatOnStandingOrders" => "Enumeration",
                    "SerialTracking" => "Boolean",
                    "Group" => "String",
                    "ShippingCategory" => "String",
                    "HSTariffNumber" => "String",
                    "Job" => "String",
                    "Misc01" => "String",
                    "Misc02" => "String",
                    "Misc03" => "String",
                    "Misc04" => "String",
                    "Misc05" => "String",
                    "Misc06" => "String",
                    "Misc07" => "String",
                    "Misc08" => "String",
                    "Misc09" => "String",
                    "Misc10" => "String",
                    "Misc11" => "String",
                    "Misc12" => "String",
                    "Misc13" => "String",
                    "Misc14" => "String",
                    "Misc15" => "String",
                    "Misc16" => "String",
                    "Misc17" => "String",
                    "Misc18" => "String",
                    "Misc19" => "String",
                    "Misc20" => "String",
                    "Misc21" => "String",
                    "Misc22" => "String",
                    "Misc23" => "String",
                    "Misc24" => "String",
                    "Misc25" => "String",
                    "Misc26" => "String",
                    "Misc27" => "String",
                    "Misc28" => "String",
                    "Misc29" => "String",
                    "Misc30" => "String",
                    "Misc31" => "String",
                    "Misc32" => "String",
                    "Misc33" => "String",
                    "Misc34" => "String",
                    "Misc35" => "String",
                    "Misc36" => "String",
                    "Misc37" => "String",
                    "Misc38" => "String",
                    "Misc39" => "String",
                    "Misc40" => "String",
                    "Misc41" => "String",
                    "Misc42" => "String",
                    "Misc43" => "String",
                    "Misc44" => "String",
                    "Misc45" => "String",
                    "Misc46" => "String",
                    "Misc47" => "String",
                    "Misc48" => "String",
                    "Misc49" => "String",
                    "Misc50" => "String",
                    "Misc51" => "String",
                    "Misc52" => "String",
                    "MonthlySpendRequirement" => "Decimal",
                    "FreeGifts" => [
                        "FreeGift" => [
                            [
                                "SKU" => "String",
                                "Delete" => "Boolean"
                            ]
                        ]
                    ],
                    "CrossSellProducts" => [
                        "CrossSellProduct" => [
                            [
                                "SKU" => "String",
                                "Delete" => "Boolean"
                            ]
                        ]
                    ],
                    "UpsellProducts" => [
                        "UpsellProduct" => [
                            [
                                "SKU" => "String",
                                "Delete" => "Boolean"
                            ]
                        ]
                    ],
                    "KitComponents" => [
                        "KitComponent" => [
                            [
                                "ComponentSKU" => "String",
                                "ComponentValue" => "String",
                                "AssembleQuantity" => "Integer",
                                "MinimumQuantity" => "Integer",
                                "MaximumQuantity" => "Integer",
                                "SortOrder" => "Integer",
                                "Delete" => "Boolean"
                            ]
                        ]
                    ],
                    "PriceGroups" => [
                        "PriceGroup" => [
                            [
                                "Group" => "String",
                                "Price" => "Decimal",
                                "PromotionPrice" => "Decimal",
                                "MinimumQuantity" => "Integer",
                                "MaximumQuantity" => "Integer",
                                "Multiple" => "Integer",
                                "MultipleStartQuantity" => "Integer",
                                "Delete" => "Boolean"
                            ]
                        ]
                    ],
                    "Categories" => [
                        "Category" => [
                            [
                                "CategoryID" => "Integer",
                                "Priority" => "Integer",
                                "Delete" => "Boolean"
                            ]
                        ]
                    ],
                    "RelatedContents" => [
                        "RelatedContent" => [
                            [
                                "ContentTypeID" => "Integer",
                                "ContentID" => "Integer",
                                "Priority" => "Integer",
                                "Delete" => "Boolean"
                            ]
                        ]
                    ],
                    "ItemSpecifics" => [
                        "ItemSpecific" => [
                            [
                                "Name" => "String",
                                "Value" => "String",
                                "SpecificValue" => "String",
                                "SpecificValueID" => "Integer",
                                "SortOrder" => "Integer"
                            ]
                        ]
                    ],
                    "StoreQuantity" => [
                        "Quantity" => "Integer",
                        "Action" => "Enumeration"
                    ],
                    "WarehouseQuantity" => [
                        "WarehouseID" => "Integer",
                        "Quantity" => "Integer",
                        "Action" => "Enumeration"
                    ],
                    "SalesChannels" => [
                        "SalesChannel" => [
                            [
                                "SalesChannelID" => "Integer",
                                "IsApproved" => "Boolean"
                            ]
                        ]
                    ],
                    "WarehouseLocations" => [
                        "WarehouseLocation" => [
                            [
                                "WarehouseID" => "Integer",
                                "LocationID" => "String",
                                "WarehouseName" => "String",
                                "WarehouseReference" => "String",
                                "Type" => "Enumeration",
                                "Priority" => "Integer",
                                "Delete" => "Boolean"
                            ]
                        ]
                    ],
                    "eBayItems" => [
                        "eBayItem" => [
                            [
                                "ListingTemplateID" => "String",
                                "DesignTemplateID" => "String",
                                "eBayCategory1" => "String",
                                "eBayCategory2" => "String",
                                "eBayStoreCategory1" => "String",
                                "eBayStoreCategory2" => "String"
                            ]
                        ]
                    ],
                    "eBayProductIDs" => [
                        "eBayProductID" => [
                            [
                                "eBaySiteFullName" => "String",
                                "eBayProductIDValue" => "String"
                            ]
                        ]
                    ]
                ]
        ];

    /**
     * @param array $item = array_merge(static::$availableDataItems, [[
     *     "PickPriority" => ["FIFO", "FEFO", "LIFO"][$any],
     *     "WhenToRepeatOnStandingOrders" => ["once", "always"][$any],
     *     "StoreQuantity" => ["Action" => ["increment", "decrement", "set"][$any]],
     *     "WarehouseQuantity" => ["Action" => ["increment", "decrement", "set"][$any]],
     *     "WarehouseLocation" => ["Type" => ["Pick", "Bulk"][$any]],
     * ]])
     */
    public function withItem(array $item): static {
        return parent::withItem($item);
    }

    /**
     * @return array = [
     *       'Item' => [
     *           'SKU' => '0001SHIF-A-00000TEST',
     *           // will be an array of results if multiple updates occur:
     *           [
     *               'SKU' => '0001SHIF-A-00000TEST'
     *           ],
     *           [
     *               'SKU' => '0001SHIF-A-00000TEST'
     *           ]
     *       ],
     *       'CurrentTime' => '2024-08-30 10:22:21',
     *       'Ack' => ['Success', 'Warning', 'Error'],
     *       'Messages' => [
     *           'Error' => [
     *               'Message' => 'JSON Error',
     *               'SeverityCode' => 'Error',
     *               'Description' => 'String'
     *           ],
     *           'Warning' => [
     *               'Message' => 'Cannot find Item 0001SHIF-A-00000TEST',
     *               'SeverityCode' => 'Warning',
     *               // will be an array of results if multiple warnings occur:
     *               [
     *                    'Message' => 'Cannot find Item 0001SHIF-A-00000TEST',
     *                    'SeverityCode' => 'Warning',
     *                ],
     *                [
     *                    'Message' => 'Cannot find Item 0001SHIF-A-00000TEST',
     *                    'SeverityCode' => 'Warning',
     *                ]
     *           ]
     *       ]
     *   ]
     */
    public function responseData() : array {
        return $this->responseData;
    }
}
