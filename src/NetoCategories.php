<?php

namespace Sfinktah\Neto;

use Sfinktah\MarkleCache\MarkleCache;

class NetoCategories
{

    /**
     * @var array = [['ContentName' => 'String', 'ContentID' => 2, 'ContentType' => 1, 'ParentContentID' => 1]]
     */
    static protected array $categories;

    /**
     * @var bool|array = ['ContentName' => 'String', 'ContentID' => 2, 'ContentType' => 1, 'ParentContentID' => 1]
     */
    protected mixed $categoryData;

    public function categoryName(): string {
        return $this->categoryData['ContentName'] ?? '';
    }

    public function categoryID(): int {
        return $this->categoryData['ContentID'] ?? 0;
    }

    public function contentType(): int {
        return $this->categoryData['ContentType'] ?? 0;
    }

    public function parentCategoryID(): int {
        return $this->categoryData['ParentContentID'] ?? 0;
    }

    public function parent(): static {
        return self::make($this->parentCategoryID());
    }

    /**
     * @return static[] array of child categories
     */
    public function children(): array {
        $result = [];
        foreach (self::$categories as $c) {
            if ($c['ParentContentID'] == $this->categoryID()) {
                $result[] = self::make($c['ContentID']);
            }
        }
        return $result;
    }

    protected static function getCategories(): array {
        $responseData = NetoGetContent::make()
            ->withFilter(['ContentType' => 'Category'])
            ->withOutputSelectors(['ContentName', 'ContentID', 'ContentType', 'ParentContentID'])
            ->post()
            ->responseData();
        self::$categories = collect($responseData['Content'])
            ->map(fn($c) => collect($c)->mapWithKeys(fn($v, $k) => $k == 'ContentID' || $k == 'ContentType' || $k == 'ParentContentID' ? [$k => intval($v)] : [$k => $v] ))
            ->toArray();

        return self::$categories;
    }

    public static function getCategory(int $categoryId, string $key = 'ContentID') {
        $categories = self::getCategoriesCached();
        return collect($categories)->first(fn($c) => $c[$key] == $categoryId) ?? false;
    }

    public static function getCategoriesCached() {
        // MarkleCache::forget('netoCategories');
        return self::$categories = MarkleCache::remember('netoCategoryArray', 3600, fn() => self::getCategories());
    }

    /**
     * @param string $categoryName
     * @return false|mixed
     */
    public static function getCategoryID(string $categoryName): string|false {
        // Get all categories
        $categories = collect(self::getCategoriesCached());
        // Search for the category name by ID
        return collect($categories)->first(fn($c) => $c['ContentName'] == $categoryName)['ContentID'] ?? false;
    }

    /**
     * @param int $categoryId
     * @return string|false
     */
    public static function getCategoryName(int $categoryId): false|string {
        // Get all categories
        $categories = collect(self::getCategoriesCached());
        // Search for the category name by ID
        return collect($categories)->first(fn($c) => $c['ContentID'] == $categoryId)['ContentName'] ?? false;
    }

    /**
     * @param int|string|self $category Category Name, ID or object
     */
    public function __construct(int|string|self $category) {
        if (is_int($category) || preg_match('/^[0-9]+$/', $category)) {
            $this->categoryData = self::getCategory(intval($category));
        }
        else if (is_string($category)) {
            $this->categoryData = self::getCategory($category);
        }
        else if ($category instanceof self) {
            $this->categoryData = self::getCategory($category->categoryID());
        }
    }

    /**
     * Get category object by Name or ID
     * @param int|string|self $category Category Name, ID or object
     */
    public static function make(int|string|self $category): static {
        return new static($category);
    }

    /**
     * Get root category object
     */
    public static function root(): static {
        return new static(1);
    }

}