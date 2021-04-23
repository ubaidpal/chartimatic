<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 09-Sep-16 4:22 PM
 * File Name    : PublishedScope.php
 */

namespace Cartimatic\Store\traits;

use Cartimatic\Store\Scopes\IsDraftScope as PublishedScope;
trait PublishedTrait {

    /**
     * Boot the scope.
     *
     * @return void
     */
    public static function bootPublishedTrait()
    {
        static::addGlobalScope(new PublishedScope);
    }

    /**
     * Get the name of the column for applying the scope.
     *
     * @return string
     */
    public function getPublishedColumn()
    {
        return defined('static::PUBLISHED_COLUMN') ? static::PUBLISHED_COLUMN : 'is_published';
    }

    /**
     * Get the fully qualified column name for applying the scope.
     *
     * @return string
     */
    public function getQualifiedPublishedColumn()
    {
        return $this->getTable().'.'.$this->getPublishedColumn();
    }

    /**
     * Get the query builder without the scope applied.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function withDrafts()
    {
        return with(new static)->newQueryWithoutScope(new PublishedScope);
    }
}
