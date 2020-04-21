<?php

namespace Tests\Unit\Traits;

use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\TestCase;

class MigratableTest extends TestCase
{
    protected $modelUnderTest;

    public function setUp(): void
    {
        parent::setUp();

        $this->modelUnderTest = $this->getMockBuilder(Model::class)
            ->setMethods(['getTableName'])
            ->getMock();
    }

    public function testMigratable()
    {
        $this->modelUnderTest->table_name = 'my_test_table';

        $this->assertEquals('my_test_table', $this->modelUnderTest->getTableName());
    }
}
