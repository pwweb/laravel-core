<?php

namespace PWWEB\Core\Tests\Unit\Enums;

use BadMethodCallException;
use PHPUnit\Framework\TestCase;
use PWWEB\Core\Enums\Title;
use TypeError;

class TitleTest extends TestCase
{
    /** @test */
    public function enums_can_be_constructed()
    {
        $noTitle = Title::none();
        $drTitle = Title::dr();
        $profTitle = Title::prof();
        $profDrTitle = Title::profdr();
        $engTitle = Title::eng();
        $diplIngTitle = Title::dipling();

        $this->assertInstanceOf(Title::class, $noTitle);
        $this->assertInstanceOf(Title::class, $drTitle);
        $this->assertInstanceOf(Title::class, $profTitle);
        $this->assertInstanceOf(Title::class, $profDrTitle);
        $this->assertInstanceOf(Title::class, $engTitle);
        $this->assertInstanceOf(Title::class, $diplIngTitle);
    }

    /** @test */
    public function unknown_enum_method_triggers_exception()
    {
        $this->expectException(BadMethodCallException::class);

        Title::meng();
    }

    /** @test */
    public function invalid_value_type_throws_exception()
    {
        $this->expectException(TypeError::class);

        Title::make([]);
    }

    /** @test */
    public function to_json()
    {
        $json = json_encode(Title::eng());

        $this->assertEquals('"eng"', $json);
    }

    /** @test */
    public function to_string()
    {
        $drString = (string) Title::dr();

        $this->assertEquals('dr', $drString);
    }

    /** @test **/
    public function to_label()
    {
        $diplIngString = Title::dipling();

        $this->assertEquals('Dipl-Ing.', $diplIngString->label);
    }
}
