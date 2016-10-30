<?php

namespace PhpunitDe\Tests;

use AbdulBundle\Controller\ProductController;
use PHPUnit\Framework\TestCase;

/**
 * Class MockAndStubTest
 * @package PhpunitDe\Tests
 */
class MockAndStubTest extends TestCase
{
    public function testCreateMock()
    {
        $stubCalculator = $this->createMock('AbdulBundle\Util\Calculator');
        $stubCalculator->method('add')
            ->willReturn(30);

        $sum = $stubCalculator->add(10, 20);

        static::assertEquals(30, $sum);
    }

    public function testGetMockBuilderAPI()
    {
        $stubProduct = $this->getMockBuilder('AbdulBundle\Controller\ProductController')
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->getMock();

        // willReturn($value) is short hand for will(static::returnValue($value))
        $stubProduct->method('getOneProductAction')
            ->will(static::returnValue(
                [
                    'product' => [
                        'id' => 1,
                        'name' => 'Logitech Mouse',
                        'price' => 25.00,
                        'description' => 'Brand new Logitech bluetooth mouse.',
                        'category_id' => null
                    ]
                ]
            ));

        static::assertArrayHasKey('product', $stubProduct->getOneProductAction());
    }

    public function testReturnArgumentStub()
    {
        $stubCalc = $this->createMock('AbdulBundle\Util\Calculator');
        $stubCalc->method('add')
            ->will(static::returnArgument(0));

        static::assertEquals('foo', $stubCalc->add('foo', 'bar'));
    }
}