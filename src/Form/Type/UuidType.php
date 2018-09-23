<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 5/19/18
 * Time: 7:47 PM
 */

namespace Cottect\Form\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Ramsey\Uuid\Doctrine\UuidType as BaseUuidType;

class UuidType extends BaseUuidType
{
    /**
     * @param null|string $value
     * @param AbstractPlatform $platform
     *
     * @return mixed|null|\Ramsey\Uuid\UuidInterface|string
     * @throws \Doctrine\DBAL\Types\ConversionException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $uuid = parent::convertToPHPValue($value, $platform);

        if (empty($value)) {
            return null;
        }

        return $uuid->getHex();
    }

    /**
     * @param null|\Ramsey\Uuid\UuidInterface $value
     * @param AbstractPlatform $platform
     *
     * @return mixed|null|\Ramsey\Uuid\UuidInterface|string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return null;
        }

        return $value;
    }
}
