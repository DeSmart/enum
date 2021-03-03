<?php

declare(strict_types=1);

namespace DeSmart\Enum\Tests;

use DeSmart\Enum\Enumeration;
use PHPUnit\Framework\TestCase;

class EnumerationTest extends TestCase
{
    /** @test */
    public function it_should_create_enum(): void
    {
        $this->assertInstanceOf(Character::class, Character::good());
        $this->assertEquals('good', Character::good()->getValue());
        $this->assertEquals('good', Character::GOOD()->getValue());
        $this->assertEquals('good', Character::fromName('good')->getValue());
        $this->assertEquals('good', Character::fromValue('good')->getValue());
        $this->assertEquals('evil', Character::evil()->getValue());
        $this->assertEquals('evil', Character::EVIL()->getValue());
        $this->assertEquals('evil', Character::fromName('evil')->getValue());
        $this->assertEquals('evil', Character::fromValue('evil')->getValue());
        $this->assertEquals('sometimes_good_or_evil', Character::sometimesGoodSometimesEvil()->getValue());
        $this->assertEquals('sometimes_good_or_evil', Character::SOMETIMES_GOOD_SOMETIMES_EVIL()->getValue());
        $this->assertEquals('sometimes_good_or_evil', Character::sometimes_good_sometimes_evil()->getValue());
        $this->assertEquals('sometimes_good_or_evil', Character::fromName('sometimesGoodSometimesEvil')->getValue());
        $this->assertEquals('sometimes_good_or_evil', Character::fromName('sometimes_good_sometimes_evil')->getValue());
        $this->assertEquals('sometimes_good_or_evil', Character::fromName('SOMETIMES_GOOD_SOMETIMES_EVIL')->getValue());
        $this->assertEquals('sometimes_good_or_evil', Character::fromValue('sometimes_good_or_evil')->getValue());
        $this->assertTrue(Character::good()->equals(Character::good()));
        $this->assertTrue(Character::good()->equals(Character::fromName('good')));
        $this->assertTrue(Character::good()->equals(Character::fromValue('good')));
    }

    /** @test */
    public function it_should_throw_exception_when_unknown_const_name(): void
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectErrorMessage('Constant DeSmart\Enum\Tests\Character::NON_EXISTING does not exist.');
        
        Character::fromName('non_existing');
    }

    /** @test */
    public function it_should_throw_exception_when_unknown_const_value(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectErrorMessage('Constant with value non_existing in enum class DeSmart\Enum\Tests\Character does not exist.');

        Character::fromValue('non_existing');
    }

    /** @test */
    public function it_should_throw_error_when_value_type_is_disallowed(): void
    {
        $this->expectException(\TypeError::class);
        $this->expectErrorMessage('Enum value can only be integer or string.');

        Character::fromValue(['non_existing']);
    }
}

/**
 * @method static Character good()
 * @method static Character evil()
 * @method static Character sometimesGoodSometimesEvil()
 */
class Character extends Enumeration
{
    const GOOD = 'good';
    const EVIL = 'evil';
    const SOMETIMES_GOOD_SOMETIMES_EVIL = 'sometimes_good_or_evil';
}