<?php

namespace Sfinktah\Neto;

class NetoGetItem extends NetoPost
{
    public static string $netoAction = 'GetItem';
    public static array $outputSelectors = [
        'ParentSKU', 'ID', 'Brand', 'Model', 'Virtual', 'Name', 'PrimarySupplier', 'Approved', 'IsActive',
        'IsNetoUtility', 'AuGstExempt', 'NzGstExempt', 'IsGiftVoucher', 'FreeGifts', 'CrossSellProducts',
        'UpsellProducts', 'PriceGroups', 'PriceGroups.MultilevelBands', 'ItemLength', 'ItemWidth', 'ItemHeight',
        'ShippingLength', 'ShippingWidth', 'ShippingHeight', 'ShippingWeight', 'CubicWeight', 'HandlingTime',
        'WarehouseQuantity', 'WarehouseLocations', 'CommittedQuantity', 'AvailableSellQuantity', 'ItemSpecifics',
        'Categories', 'AccountingCode', 'SortOrder1', 'SortOrder2', 'RRP', 'DefaultPrice', 'DefaultPurchasePrice',
        'PromotionPrice', 'PromotionStartDate', 'PromotionStartDateLocal', 'PromotionStartDateUTC',
        'PromotionExpiryDate', 'PromotionExpiryDateLocal', 'PromotionExpiryDateUTC', 'DateArrival', 'DateArrivalUTC',
        'CostPrice', 'UnitOfMeasure', 'BaseUnitOfMeasure', 'BaseUnitPerQuantity', 'QuantityPerScan', 'BuyUnitQuantity',
        'SellUnitQuantity', 'PreOrderQuantity', 'PickPriority', 'PickZone', 'eBayProductIDs', 'TaxCategory',
        'TaxFreeItem', 'TaxInclusive', 'SearchKeywords', 'ShortDescription', 'Description', 'Features',
        'Specifications', 'Warranty', 'eBayDescription', 'TermsAndConditions', 'ArtistOrAuthor', 'Format',
        'ModelNumber', 'Subtitle', 'AvailabilityDescription', 'Images', 'ImageURL', 'BrochureURL', 'ProductURL',
        'DateAdded', 'DateAddedLocal', 'DateAddedUTC', 'DateCreatedLocal', 'DateCreatedUTC', 'DateUpdated',
        'DateUpdatedLocal', 'DateUpdatedUTC', 'UPC', 'UPC1', 'UPC2', 'UPC3', 'Type', 'SubType',
        'NumbersOfLabelsToPrint', 'ReferenceNumber', 'InternalNotes', 'BarcodeHeight', 'SupplierItemCode',
        'SplitForWarehousePicking', 'DisplayTemplate', 'EditableKitBundle', 'RequiresPackaging', 'IsAsset',
        'IsServiceItem', 'WhenToRepeatOnStandingOrders', 'SerialTracking', 'Group', 'ShippingCategory',
        'MonthlySpendRequirement', 'RestrictedToUserGroup', 'IsInventoried', 'IsBought', 'IsSold', 'ExpenseAccount',
        'PurchaseTaxCode', 'CostOfSalesAccount', 'IncomeAccount', 'AssetAccount', 'KitComponents', 'SEOPageTitle',
        'SEOMetaKeywords', 'SEOPageHeading', 'SEOMetaDescription', 'SEOCanonicalURL', 'ItemURL', 'CustomContent',
        'CustomNonDelivery', 'AutomaticURL', 'Job', 'RelatedContents', 'SalesChannels', 'VariantInventoryIDs',
        'IsVariant', 'HSTariffNumber', 'Misc01', 'Misc02', 'Misc03', 'Misc04', 'Misc05', 'Misc06', 'Misc07', 'Misc08',
        'Misc09', 'Misc10', 'Misc11', 'Misc12', 'Misc13', 'Misc14', 'Misc15', 'Misc16', 'Misc17', 'Misc18', 'Misc19',
        'Misc20', 'Misc21', 'Misc22', 'Misc23', 'Misc24', 'Misc25', 'Misc26', 'Misc27', 'Misc28', 'Misc29', 'Misc30',
        'Misc31', 'Misc32', 'Misc33', 'Misc34', 'Misc35', 'Misc36', 'Misc37', 'Misc38', 'Misc39', 'Misc40', 'Misc41',
        'Misc42', 'Misc43', 'Misc44', 'Misc45', 'Misc46', 'Misc47', 'Misc48', 'Misc49', 'Misc50', 'Misc51', 'Misc52',
        'eBayItems', 'eBayActiveItems'
    ];

}
