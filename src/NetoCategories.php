<?php

namespace Sfinktah\Neto;

use Sfinktah\MarkleCache\MarkleCache;

class NetoCategories
{

    static protected array $categories;

    protected static function getCategories(): array {
        $responseData = NetoGetContent::make()
            ->withFilter(['ContentType' => 'Category'])
            ->withOutputSelectors(['ContentName', 'ContentID', 'ContentType', 'ParentContentID'])
            ->post()
            ->responseData();
        self::$categories = $responseData;
        sd($responseData);
        return collect($responseData['Content'])
            ->pluck('ContentName', 'ContentID')
            ->toArray();
    }

    public static function getCategory(int $category) {
        /**
         * @var NetoGetContent $responseData
         */
        $responseData = NetoGetContent::make();
        $responseData
            ->withFilter(['ContentType' => 'Category', 'ContentID' => $category])
            ->withOutputSelectors(['ContentName', 'ContentID', 'ContentType', 'ParentContentID'])
            ->post()
            ->responseData();
        return $responseData;

    }

    public static function getCategoriesCached() {
        return MarkleCache::remember('netoCategories', 3600, fn() => self::getCategories());
    }

    /**
     * @param string $categoryName
     * @return false|mixed
     */
    public static function getCategoryID(string $categoryName): string|false {
        // Get specific category ID
        return collect(self::getCategoriesCached())->search($categoryName);
    }

    /**
     * @param int|string $categoryId
     * @return string|false
     */
    public static function getCategoryName(int|string $categoryId): false|string {
        // Get all categories
        $categories = self::getCategoriesCached();
        // Search for the category name by ID
        return collect($categories)->first(fn($v, $k) => $k == $categoryId, false);
    }

    /**
     * @param int|string|self $category Category Name, ID or object
     */
    public function __construct(int|string|self $category) {
        if (is_int($category) || preg_match('/^[0-9]+$/', $category)) {
            $this->category = self::getCategory(intval($category));
        }
    }

    /**
     * @param array|null $data = static::$availableDataItems
     */
    public static function make(array|null $data = null): static {
        return new static($data);
    }

}