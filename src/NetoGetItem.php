<?php

namespace Sfinktah\Neto;

/**
 * https://developers.maropost.com/documentation/engineers/api-documentation/products/getitem
 */
class NetoGetItem extends NetoPost
{
    public static string $netoAction = 'GetItem';
    public static array $availableOutputSelectors = [
        "ParentSKU", "ID", "Brand", "Model", "Virtual", "Name", "PrimarySupplier", "Approved", "IsActive",
        "IsNetoUtility", "AuGstExempt", "NzGstExempt", "IsGiftVoucher", "FreeGifts", "CrossSellProducts",
        "UpsellProducts", "PriceGroups", "PriceGroups.MultilevelBands", "ItemLength", "ItemWidth", "ItemHeight",
        "ShippingLength", "ShippingWidth", "ShippingHeight", "ShippingWeight", "CubicWeight", "HandlingTime",
        "WarehouseQuantity", "WarehouseLocations", "CommittedQuantity", "AvailableSellQuantity", "ItemSpecifics",
        "Categories", "AccountingCode", "SortOrder1", "SortOrder2", "RRP", "DefaultPrice", "DefaultPurchasePrice",
        "PromotionPrice", "PromotionStartDate", "PromotionStartDateLocal", "PromotionStartDateUTC",
        "PromotionExpiryDate", "PromotionExpiryDateLocal", "PromotionExpiryDateUTC", "DateArrival", "DateArrivalUTC",
        "CostPrice", "UnitOfMeasure", "BaseUnitOfMeasure", "BaseUnitPerQuantity", "QuantityPerScan", "BuyUnitQuantity",
        "SellUnitQuantity", "PreOrderQuantity", "PickPriority", "PickZone", "eBayProductIDs", "TaxCategory",
        "TaxFreeItem", "TaxInclusive", "SearchKeywords", "ShortDescription", "Description", "Features",
        "Specifications", "Warranty", "eBayDescription", "TermsAndConditions", "ArtistOrAuthor", "Format",
        "ModelNumber", "Subtitle", "AvailabilityDescription", "Images", "ImageURL", "BrochureURL", "ProductURL",
        "DateAdded", "DateAddedLocal", "DateAddedUTC", "DateCreatedLocal", "DateCreatedUTC", "DateUpdated",
        "DateUpdatedLocal", "DateUpdatedUTC", "UPC", "UPC1", "UPC2", "UPC3", "Type", "SubType",
        "NumbersOfLabelsToPrint", "ReferenceNumber", "InternalNote*s", "BarcodeHeight", "SupplierItemCode",
        "SplitForWarehousePicking", "DisplayTemplate", "EditableKitBundle", "RequiresPackaging", "IsAsset",
        "IsServiceItem", "WhenToRepeatOnStandingOrders", "SerialTracking", "Group", "ShippingCategory",
        "MonthlySpendRequirement", "RestrictedToUserGroup", "IsInventoried", "IsBought", "IsSold", "ExpenseAccount",
        "PurchaseTaxCode", "CostOfSalesAccount", "IncomeAccount", "AssetAccount", "KitComponents", "SEOPageTitle",
        "SEOMetaKeywords", "SEOPageHeading", "SEOMetaDescription", "SEOCanonicalURL", "ItemURL", "CustomContent",
        "CustomNonDelivery", "AutomaticURL", "Job", "RelatedContents", "SalesChannels", "VariantInventoryIDs",
        "IsVariant", "HSTariffNumber", "Misc01", "Misc02", "Misc03", "Misc04", "Misc05", "Misc06", "Misc07", "Misc08",
        "Misc09", "Misc10", "Misc11", "Misc12", "Misc13", "Misc14", "Misc15", "Misc16", "Misc17", "Misc18", "Misc19",
        "Misc20", "Misc21", "Misc22", "Misc23", "Misc24", "Misc25", "Misc26", "Misc27", "Misc28", "Misc29", "Misc30",
        "Misc31", "Misc32", "Misc33", "Misc34", "Misc35", "Misc36", "Misc37", "Misc38", "Misc39", "Misc40", "Misc41",
        "Misc42", "Misc43", "Misc44", "Misc45", "Misc46", "Misc47", "Misc48", "Misc49", "Misc50", "Misc51", "Misc52",
        "eBayItems", "eBayActiveItems"
    ];

    public static array $availableDataItems = [
        "SKU" => ["String"/*, ...*/],
        "RestockQty" => "Integer",
        "ReorderQty" => "Integer",
        "RestockWarningLevel" => "Integer",
        "AccountingCode" => ["String"/*, ...*/],
        "InventoryID" => ["Integer"/*, ...*/],
        "ParentSKU" => "String",
        "Brand" => ["String"/*, ...*/],
        "Model" => ["String"/*, ...*/],
        "Name" => ["String"/*, ...*/],
        "PrimarySupplier" => ["String"/*, ...*/],
        "Approved" => ["Boolean"/*, ...*/],
        "ApprovedForPOS" => ["Boolean"/*, ...*/],
        "ApprovedForMobileStore" => ["Boolean"/*, ...*/],
        "SalesChannels" => [
            "SalesChannel" => [[
                "SalesChannelID" => "Integer",
                "IsApproved" => "Boolean"
            ]]
        ], "Visible" => ["Boolean"/*, ...*/],
        "IsActive" => ["Boolean"/*, ...*/],
        "IsNetoUtility" => ["Boolean"/*, ...*/],
        "IsGiftVoucher" => "Boolean",
        "EditableKitBundle" => "Boolean",
        "AuGstExempt" => ["Boolean"/*, ...*/],
        "NzGstExempt" => ["Boolean"/*, ...*/],
        "DateAddedFrom" => "DateTime",
        "DateAddedTo" => "DateTime",
        "DateCreatedFrom" => "DateTime",
        "DateCreatedTo" => "DateTime",
        "DateUpdatedFrom" => "DateTime",
        "DateUpdatedTo" => "DateTime",
        "CategoryID" => ["Integer"/*, ...*/],
        "Priority" => "Integer",
        "Page" => "Integer",
        "Limit" => "Integer",
        "OrderBy" => "Enumeration",
        "OrderDirection" => "Enumeration",
        "OutputSelector" => ["Enumeration"/*, ...*/]
    ];

    /**
     * @param array|null $filter = ['SKU' => '0001SHIF-A']
     * @return array = [
     *      "Item" => [[
     *           "ID" => "Integer",
     *           "SKU" => "String",
     *           "InventoryID" => "Integer",
     *           "ParentSKU" => "String",
     *           "AccountingCode" => "String",
     *           "Virtual" => "Boolean",
     *           "Brand" => "String",
     *           "Name" => "String",
     *           "Model" => "String",
     *           "SortOrder1" => "Integer",
     *           "SortOrder2" => "Integer",
     *           "RRP" => "Decimal",
     *           "DefaultPrice" => "Decimal",
     *           "PromotionPrice" => "Decimal",
     *           "PromotionStartDate" => "DateTime",
     *           "PromotionStartDateLocal" => "DateTime",
     *           "PromotionStartDateUTC" => "DateTime",
     *           "PromotionExpiryDate" => "DateTime",
     *           "PromotionExpiryDateLocal" => "DateTime",
     *           "PromotionExpiryDateUTC" => "DateTime",
     *           "DateArrival" => "Date",
     *           "DateArrivalUTC" => "Date",
     *           "CostPrice" => "Decimal",
     *           "UnitOfMeasure" => "String",
     *           "BaseUnitOfMeasure" => "String",
     *           "BaseUnitPerQuantity" => "Decimal",
     *           "BuyUnitQuantity" => "Integer",
     *           "QuantityPerScan" => "Integer",
     *           "SellUnitQuantity" => "Integer",
     *           "PreOrderQuantity" => "Integer",
     *           "PickPriority" => "String",
     *           "PickZone" => "String",
     *           "Approved" => "Boolean",
     *           "IsActive" => "Boolean",
     *           "IsNetoUtility" => "Boolean",
     *           "IsGiftVoucher" => "Boolean",
     *           "Visible" => "Boolean",
     *           "TaxFreeItem" => "Boolean",
     *           "TaxInclusive" => "Boolean",
     *           "ApprovedForPOS" => "Boolean",
     *           "ApprovedForMobileStore" => "Boolean",
     *           "SearchKeywords" => "String",
     *           "ShortDescription" => "String",
     *           "Description" => "String",
     *           "TermsAndConditions" => "String",
     *           "Features" => "String",
     *           "Specifications" => "String",
     *           "Warranty" => "String",
     *           "ArtistOrAuthor" => "String",
     *           "Format" => "String",
     *           "ModelNumber" => "String",
     *           "Subtitle" => "String",
     *           "AvailabilityDescription" => "String",
     *           "SalesChannels" => [
     *             "SalesChannel" => [
     *               [
     *                 "SalesChannelID" => "Integer",
     *                 "SalesChannelName" => "String",
     *                 "IsApproved" => "Boolean",
     *               ],
     *             ],
     *           ],
     *           "Images" => [
     *             "Image" => [
     *               [
     *                 "Name" => "String",
     *                 "URL" => "String",
     *                 "ThumbURL" => "String",
     *                 "MediumThumbURL" => "String",
     *                 "Timestamp" => "DateTime",
     *               ],
     *             ],
     *           ],
     *           "ImageURL" => "String",
     *           "BrochureURL" => "String",
     *           "ProductURL" => "String",
     *           "DateAdded" => "DateTime",
     *           "DateAddedLocal" => "DateTime",
     *           "DateAddedUTC" => "DateTime",
     *           "DateUpdated" => "DateTime",
     *           "DateUpdatedLocal" => "DateTime",
     *           "DateUpdatedUTC" => "DateTime",
     *           "UPC" => "String",
     *           "UPC1" => "String",
     *           "UPC2" => "String",
     *           "UPC3" => "String",
     *           "Type" => "String",
     *           "SubType" => "String",
     *           "NumbersOfLabelsToPrint" => "Integer",
     *           "ReferenceNumber" => "Integer",
     *           "InternalNotes" => "String",
     *           "BarcodeHeight" => "Integer",
     *           "IsInventoried" => "String",
     *           "IsBought" => "String",
     *           "IsSold" => "String",
     *           "ExpenseAccount" => "String",
     *           "PurchaseTaxCode" => "String",
     *           "CostOfSalesAccount" => "String",
     *           "IncomeAccount" => "String",
     *           "AssetAccount" => "String",
     *           "ItemHeight" => "Decimal",
     *           "ItemLength" => "Decimal",
     *           "ItemWidth" => "Decimal",
     *           "ShippingHeight" => "Decimal",
     *           "ShippingLength" => "Decimal",
     *           "ShippingWidth" => "Decimal",
     *           "ShippingWeight" => "Decimal",
     *           "CubicWeight" => "Decimal",
     *           "HandlingTime" => "Integer",
     *           "SupplierItemCode" => "String",
     *           "SplitForWarehousePicking" => "String",
     *           "eBayDescription" => "String",
     *           "PrimarySupplier" => "String",
     *           "DisplayTemplate" => "String",
     *           "EditableKitBundle" => "Boolean",
     *           "RequiresPackaging" => "Boolean",
     *           "SEOPageTitle" => "String",
     *           "SEOMetaKeywords" => "String",
     *           "SEOPageHeading" => "String",
     *           "SEOMetaDescription" => "String",
     *           "SEOCanonicalURL" => "String",
     *           "IsAsset" => "Boolean",
     *           "WhenToRepeatOnStandingOrders" => "String",
     *           "SerialTracking" => "Boolean",
     *           "Group" => "String",
     *           "ShippingCategory" => "String",
     *           "Job" => "String",
     *           "MonthlySpendRequirement" => "Decimal",
     *           "RestrictedToUserGroup" => "String",
     *           "ItemURL" => "String",
     *           "AutomaticURL" => "Boolean",
     *           "CommittedQuantity" => "Integer",
     *           "AvailableSellQuantity" => "Integer",
     *           "HSTariffNumber" => "String",
     *           "Misc01" => "String",
     *           "Misc02" => "String",
     *           "Misc03" => "String",
     *           "Misc04" => "String",
     *           "Misc05" => "String",
     *           "Misc06" => "String",
     *           "Misc07" => "String",
     *           "Misc08" => "String",
     *           "Misc09" => "String",
     *           "Misc10" => "String",
     *           "Misc11" => "String",
     *           "Misc12" => "String",
     *           "Misc13" => "String",
     *           "Misc14" => "String",
     *           "Misc15" => "String",
     *           "Misc16" => "String",
     *           "Misc17" => "String",
     *           "Misc18" => "String",
     *           "Misc19" => "String",
     *           "Misc20" => "String",
     *           "Misc21" => "String",
     *           "Misc22" => "String",
     *           "Misc23" => "String",
     *           "Misc24" => "String",
     *           "Misc25" => "String",
     *           "Misc26" => "String",
     *           "Misc27" => "String",
     *           "Misc28" => "String",
     *           "Misc29" => "String",
     *           "Misc30" => "String",
     *           "Misc31" => "String",
     *           "Misc32" => "String",
     *           "Misc33" => "String",
     *           "Misc34" => "String",
     *           "Misc35" => "String",
     *           "Misc36" => "String",
     *           "Misc37" => "String",
     *           "Misc38" => "String",
     *           "Misc39" => "String",
     *           "Misc40" => "String",
     *           "Misc41" => "String",
     *           "Misc42" => "String",
     *           "Misc43" => "String",
     *           "Misc44" => "String",
     *           "Misc45" => "String",
     *           "Misc46" => "String",
     *           "Misc47" => "String",
     *           "Misc48" => "String",
     *           "Misc49" => "String",
     *           "Misc50" => "String",
     *           "Misc51" => "String",
     *           "Misc52" => "String",
     *           "FreeGifts" => [
     *             "FreeGift" => [
     *               [
     *                 "SKU" => "String",
     *               ],
     *             ],
     *           ],
     *           "CrossSellProducts" => [
     *             "CrossSellProduct" => [
     *               [
     *                 "SKU" => "String",
     *               ],
     *             ],
     *           ],
     *           "UpsellProducts" => [
     *             "UpsellProduct" => [
     *               [
     *                 "SKU" => "String",
     *               ],
     *             ],
     *           ],
     *           "KitComponents" => [
     *             "KitComponent" => [
     *               [
     *                 "ComponentSKU" => "String",
     *                 "ComponentValue" => "String",
     *                 "AssembleQuantity" => "Integer",
     *                 "MinimumQuantity" => "Integer",
     *                 "MaximumQuantity" => "Integer",
     *                 "SortOrder" => "Integer",
     *               ],
     *             ],
     *           ],
     *           "PriceGroups" => [
     *             "PriceGroup" => [
     *               [
     *                 "GroupID" => "String",
     *                 "Group" => "String",
     *                 "Price" => "Decimal",
     *                 "PromotionPrice" => "Decimal",
     *                 "MinimumQuantity" => "Integer",
     *                 "MaximumQuantity" => "Integer",
     *                 "Multiple" => "Integer",
     *                 "MultipleStartQuantity" => "Integer",
     *                 "MultilevelBands" => [
     *                   "MultiLevelBand" => [
     *                     [
     *                       "Price" => "Decimal",
     *                       "MinimumQuantity" => "Integer",
     *                       "MaximumQuantity" => "Integer",
     *                     ],
     *                   ],
     *                 ],
     *               ],
     *             ],
     *           ],
     *           "Categories" => [
     *             "Category" => [
     *               [
     *                 "CategoryID" => "Integer",
     *                 "Priority" => "Integer",
     *                 "CategoryName" => "String",
     *               ],
     *             ],
     *           ],
     *           "ItemSpecifics" => [
     *             "ItemSpecific" => [
     *               [
     *                 "Name" => "String",
     *                 "Value" => "String",
     *               ],
     *             ],
     *           ],
     *           "WarehouseQuantity" => [
     *             [
     *               "WarehouseID" => "Integer",
     *               "Quantity" => "Integer",
     *             ],
     *           ],
     *           "WarehouseLocations" => [
     *             "WarehouseLocation" => [
     *               [
     *                 "LocationID" => "String",
     *                 "WarehouseID" => "String",
     *                 "Type" => "String",
     *                 "Priority" => "Integer",
     *               ],
     *             ],
     *           ],
     *           "RelatedContents" => [
     *             [
     *               "ContentID" => "Integer",
     *               "ContentName" => "String",
     *               "ContentTypeID" => "Integer",
     *               "ContentTypeName" => "String",
     *               "Priority" => "Integer",
     *             ],
     *           ],
     *           "eBayItems" => [
     *             "eBayItem" => [
     *               [
     *                 "ListingTemplateID" => "String",
     *                 "DesignTemplateID" => "String",
     *                 "eBayCategory1" => "String",
     *                 "eBayCategory2" => "String",
     *                 "eBayStoreCategory1" => "String",
     *                 "eBayStoreCategory2" => "String",
     *               ],
     *             ],
     *           ],
     *           "eBayActiveItems" => [
     *             "eBayActiveItem" => [
     *               [
     *                 "eBayItemID" => "String",
     *               ],
     *             ],
     *           ],
     *           "eBayProductIDs" => [
     *             "eBayProductID" => [
     *               [
     *                 "eBaySiteFullName" => "String",
     *                 "eBayProductIDValue" => "String",
     *               ],
     *             ],
     *           ],
     *         ],
     *       ],
     *       "Messages" => [
     *         "Error" => [
     *           [
     *             "Message" => "String",
     *             "SeverityCode" => "String",
     *             "Description" => "String",
     *           ],
     *         ],
     *         "Warning" => [
     *           [
     *             "Message" => "String",
     *             "SeverityCode" => "String",
     *           ],
     *         ],
     *       ],
     * ]
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Sfinktah\Neto\InvalidOutputSelector
     */
    public function post(array|null $filter = null): array {
        return parent::post($filter);
    }
}
