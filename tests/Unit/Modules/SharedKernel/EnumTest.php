<?php
namespace Tests\Unit\Modules\SharedKernel;

use App\Modules\SharedKernel\Enum;
use Tests\TestCase;

/**
 * MockEnum
 * Mock class for use in EnumTest.
 *
 */
class MockEnum extends  Enum{
    const Foo = 0;
    const Bar = 1;
}

class EnumTest extends TestCase
{

    /**
     * Test for the getKeys function.
     * Test reflection to get correct keys for enum class.
     * @return void
     * @throws
     */
    public function testGetKeys()
    {
        $keys = MockEnum::getKeys();

        $this->assertContains('Foo', $keys);
        $this->assertContains('Bar', $keys);
    }

    /**
     * Test for the getValues function.
     * Test reflection to get correct values for enum class.
     * @return void
     * @throws
     */
    public function testGetValues()
    {
        $values = MockEnum::getValues();

        $this->assertContains(0, $values);
        $this->assertContains(1, $values);
    }


    /**
     * Test for the getValue function.
     * Check for getValue return value can compatible with constant values in a enum.
     * @return void
     * @throws
     */
    public function testGetValue()
    {
        $foo = MockEnum::getByValue(0);
        $bar = MockEnum::getByValue(1);

        $this->assertEquals(
            MockEnum::Foo,
            $foo
        );

        $this->assertEquals(
            MockEnum::Bar,
            $bar
        );
    }
}
