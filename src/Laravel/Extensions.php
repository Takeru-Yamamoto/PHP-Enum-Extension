<?php

namespace EnumExtension\Laravel;

use EnumExtension\Extensions as BaseExtensions;

use Illuminate\Database\Eloquent\Casts\AsEnumArrayObject;
use Illuminate\Database\Eloquent\Casts\AsEnumCollection;

/**
 * Laravelで使用するEnumの拡張するためのtrait
 * 
 * @package EnumExtension\Laravel
 */
trait Extensions
{
    use BaseExtensions;

    /*----------------------------------------*
     * Model Casting
     *----------------------------------------*/

    /**
     * ModelのCastsでEnumのArrayObjectを指定するためのメソッド
     * 
     * @throws \BadMethodCallException
     * @return string
     */
    public static function castAsArrayObject(): string
    {
        self::assertEnum();

        return AsEnumArrayObject::of(self::class);
    }

    /**
     * ModelのCastsでEnumのCollectionを指定するためのメソッド
     * 
     * @throws \BadMethodCallException
     * @return string
     */
    public static function castAsCollection(): string
    {
        self::assertEnum();

        return AsEnumCollection::of(self::class);
    }
}
