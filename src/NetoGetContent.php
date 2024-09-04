<?php

namespace Sfinktah\Neto;

/**
 * https://developers.maropost.com/documentation/engineers/api-documentation/content/getcontent
 */
class NetoGetContent extends NetoPost
{
    public static string $netoAction = 'GetContent';
    public static array $availableOutputSelectors = [
        'ContentID', 'ID', 'ContentName', 'ContentType', 'ParentContentID', 'Active', 'SortOrder', 'OnSiteMap',
        'OnMenu', 'AllowReviews', 'ContentReference', 'ShortDescription1', 'ShortDescription2', 'ShortDescription3',
        'Description1', 'Description2', 'Description3', 'Author', 'ContentURL', 'Label1', 'Label2', 'Label3',
        'SEOMetaDescription', 'SEOMetaKeywords', 'SEOPageHeading', 'SEOPageTitle', 'SEOCanonicalURL', 'SearchKeywords',
        'HeaderTemplate', 'BodyTemplate', 'FooterTemplate', 'SearchResultsTemplate', 'RelatedContents',
        'ExternalSource', 'ExternalReference1', 'ExternalReference2', 'ExternalReference3', 'DatePosted',
        'DatePostedLocal', 'DatePostedUTC', 'DateUpdated', 'DateUpdatedLocal', 'DateUpdatedUTC'
    ];

    public static array $availableDataItems = [
        "ContentID" => ["Integer"/*, ...*/],
        "ParentContentID" => ["Integer"/*, ...*/],
        "ContentName" => ["String"/*, ...*/],
        "Active" => "Boolean",
        "ContentType" => "String",
        "OnSiteMap" => "Boolean",
        "OnMenu" => "Boolean",
        "AllowReviews" => "Boolean",
        "RequireLogin" => "Boolean",
        "DatePostedFrom" => "DateTime",
        "DatePostedTo" => "DateTime",
        "DateUpdatedFrom" => "DateTime",
        "DateUpdatedTo" => "DateTime",
        "Page" => "Integer",
        "Limit" => "Integer",
    ];

    /**
     * Get response decoded as array/object
     * @return array = [
     *       "Content" =>  [ [
     *           "ID" => "Integer",
     *           "ContentID" => "Integer",
     *           "ContentName" => "String",
     *           "ParentContentID" => "Integer",
     *           "Active" => "Boolean",
     *           "SortOrder" => "Integer",
     *           "OnSiteMap" => "Boolean",
     *           "OnMenu" => "Boolean",
     *           "AllowReviews" => "Boolean",
     *           "RequireLogin" => "String",
     *           "ContentReference" => "String",
     *           "ShortDescription1" => "String",
     *           "ShortDescription2" => "String",
     *           "ShortDescription3" => "String",
     *           "Description1" => "String",
     *           "Description2" => "String",
     *           "Description3" => "String",
     *           "Author" => "String",
     *           "ContentURL" => "String",
     *           "Label1" => "String",
     *           "Label2" => "String",
     *           "Label3" => "String",
     *           "SEOMetaDescription" => "String",
     *           "SEOMetaKeywords" => "String",
     *           "SEOPageHeading" => "String",
     *           "SEOPageTitle" => "String",
     *           "SEOCanonicalURL" => "String",
     *           "SearchKeywords" => "String",
     *           "HeaderTemplate" => "String",
     *           "BodyTemplate" => "String",
     *           "FooterTemplate" => "String",
     *           "SearchResultsTemplate" => "String",
     *           "RelatedContents" =>  [
     *               "RelatedContent" =>  [ [
     *                   "ContentID" => "Integer"
     *               ] ]
     *           ] ,    "ExternalSource" => "String",
     *           "ExternalReference1" => "String",
     *           "ExternalReference2" => "String",
     *           "ExternalReference3" => "String",
     *           "DatePosted" => "DateTime",
     *           "DatePostedLocal" => "DateTime",
     *           "DatePostedUTC" => "DateTime",
     *           "DateUpdated" => "DateTime",
     *           "DateUpdatedLocal" => "DateTime",
     *           "DateUpdatedUTC" => "DateTime"
     *       ] ],
     *       "Messages" =>  [
     *           "Error" =>  [ [
     *               "Message" => "String",
     *               "SeverityCode" => "String",
     *               "Description" => "String"
     *           ] ] ,    "Warning" =>  [ [
     *               "Message" => "String",
     *               "SeverityCode" => "String"
     *           ] ]
     *       ]
     *   ];
     */
    public function responseData(): array {
        return $this->responseData;
    }
}
