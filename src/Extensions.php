<?php

namespace EnumExtension;

/**
 * Enumの拡張するためのtrait
 * 
 * @package EnumExtension
 * 
 * @method static array cases()
 */
trait Extensions
{
    /*----------------------------------------*
     * Assert Enum
     *----------------------------------------*/

    /**
     * このtraitがEnumに適用されていることを保証する
     * 
     * @throws \BadMethodCallException
     */
    private static function assertEnum(): void
    {
        if (!enum_exists(self::class)) throw new \BadMethodCallException("This trait can only be used in Enum");
    }



    /*----------------------------------------*
     * From Name
     *----------------------------------------*/

    /**
     * nameを元にEnumを生成する
     * 
     * @param int|string $name
     * @throws \BadMethodCallException
     * @throws \ValueError
     * @return static
     */
    public static function fromName(int|string $name): static
    {
        self::assertEnum();

        foreach (self::cases() as $case) {
            if ($name === $case->name) return $case;
        }

        throw new \ValueError("$name is not a valid backing name for enum " . self::class);
    }

    /**
     * nameを元にEnumを生成する
     * 該当するnameが存在しない場合はnullを返す
     * 
     * @param int|string $name
     * @throws \BadMethodCallException
     * @return static|null
     */
    public static function tryFromName(int|string $name): ?static
    {
        try {
            return self::fromName($name);
        } catch (\ValueError $error) {
            return null;
        }
    }



    /*----------------------------------------*
     * Cases Reverse
     *----------------------------------------*/

    /**
     * casesの逆順配列を返す
     * 
     * @throws \BadMethodCallException
     * @return array
     */
    public static function casesReverse(): array
    {
        self::assertEnum();

        return array_reverse(self::cases());
    }



    /*----------------------------------------*
     * Names
     *----------------------------------------*/

    /**
     * casesからnameを取り出した配列を返す
     * 
     * @throws \BadMethodCallException
     * @return array
     */
    public static function names(): array
    {
        self::assertEnum();

        return array_column(self::cases(), "name");
    }

    /**
     * namesの逆順配列を返す
     * 
     * @throws \BadMethodCallException
     * @return array
     */
    public static function namesReverse(): array
    {
        return array_reverse(self::names());
    }



    /*----------------------------------------*
     * Values
     *----------------------------------------*/

    /**
     * casesからvalueを取り出した配列を返す
     * 
     * @throws \BadMethodCallException
     * @return array
     */
    public static function values(): array
    {
        self::assertEnum();

        return array_column(self::cases(), "value");
    }

    /**
     * valuesの逆順配列を返す
     * 
     * @throws \BadMethodCallException
     * @return array
     */
    public static function valuesReverse(): array
    {
        return array_reverse(self::values());
    }
}
