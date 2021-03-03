<?php

declare(strict_types=1);

namespace DeSmart\Enum;

use function DeSmart\Enum\Helpers\toConstName;

abstract class Enumeration
{
    /**
     * @var int|string
     */
    private $value;

    /**
     * @param int|string $value
     */
    private function __construct($value)
    {
        $this->value = $value;
    }

    public static function __callStatic(string $name, array $arguments): self
    {
        $class = static::class;
        $constName = toConstName($name);

        try {
            $const = new \ReflectionClassConstant($class, $constName);
        } catch (\ReflectionException $e) {
            throw new \BadMethodCallException("Constant $class::$constName does not exist.");
        }

        return new static($const->getValue());
    }

    public static function fromName($name): self
    {
        return self::__callStatic($name, []);
    }

    /**
     * @param int|string $value
     * @return static
     */
    public static function fromValue($value): self
    {
        if (! \is_string($value) && ! \is_int($value)) {
            throw new \TypeError("Enum value can only be integer or string.");
        }

        if (\in_array($value, self::constants(), true)) {
            return new static($value);
        }

        $class = static::class;

        throw new \UnexpectedValueException("Constant with value $value in enum class $class does not exist.");
    }

    private static function constants(): array
    {
        return (new \ReflectionClass(static::class))->getConstants();
    }

    /**
     * @return int|string
     */
    public function getValue()
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->getValue();
    }

    public function equals(Enumeration $other): bool
    {
        if (! $other instanceof static) {
            throw new \InvalidArgumentException('Cannot compare enums of different types.');
        }

        return $this->value === $other->value;
    }
}