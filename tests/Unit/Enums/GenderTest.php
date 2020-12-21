<?php

namespace PWWEB\Core\Tests\Unit\Enums;

use BadMethodCallException;
use PHPUnit\Framework\TestCase;
use PWWEB\Core\Enums\Gender;
use TypeError;

class GenderTest extends TestCase
{
    /** @test */
    public function enums_can_be_constructed()
    {
        $noGender = Gender::none();
        $maleGender = Gender::male();
        $femaleGender = Gender::female();
        $diverseGender = Gender::diverse();

        $this->assertInstanceOf(Gender::class, $noGender);
        $this->assertInstanceOf(Gender::class, $maleGender);
        $this->assertInstanceOf(Gender::class, $femaleGender);
        $this->assertInstanceOf(Gender::class, $diverseGender);
    }

    /** @test */
    public function unknown_enum_method_triggers_exception()
    {
        $this->expectException(BadMethodCallException::class);

        Gender::nonBinary();
    }

    /** @test */
    public function invalid_value_type_throws_exception()
    {
        $this->expectException(TypeError::class);

        Gender::make([]);
    }

    /** @test */
    public function test_equals()
    {
        $noGender = Gender::none();

        $this->assertTrue($noGender->equals(Gender::none()));
        $this->assertFalse($noGender->equals(Gender::male()));
    }

    /** @test */
    public function test_equals_multiple()
    {
        $noGender = Gender::none();

        $this->assertFalse($noGender->equals(
            Gender::none(),
            Gender::male(),
        ));

        $this->assertFalse($noGender->equals(
            Gender::male(),
        ));
    }

    /** @test */
    public function to_json()
    {
        $json = json_encode(Gender::male());

        $this->assertEquals('"male"', $json);
    }

    /** @test */
    public function to_string()
    {
        $maleString = (string) Gender::male();

        $this->assertEquals('male', $maleString);
    }
}
