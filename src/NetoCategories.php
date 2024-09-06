<?php

namespace Sfinktah\Neto;

use Sfinktah\MarkleCache\MarkleCache;

class NetoCategories
{

    protected static function getCategories(): array {
        $responseData = NetoGetContent::make()
            ->withOutputSelectors(['ContentName'])
            ->withFilter(['ContentType' => 'Category'])
            ->post()
            ->responseData();
        return collect($responseData['Content'])
            ->pluck('ContentName', 'ContentID')
            ->toArray();
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
}