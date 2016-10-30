<?php

namespace PhpunitDe\Tests;

use AbdulBundle\Util\Subject;
use PHPUnit\Framework\TestCase;

/**
 * Class MockAndStubTest.
 * Prophecy is an alternative framework for MockBuilder to create test doubles.
 * @package PhpunitDe\Tests
 */
class MockAndStubTest extends TestCase
{
    public function testCreateMock()
    {
        $stubClass = $this->createMock('AbdulBundle\Util\ClassForMockTest');
        $stubClass->method('add')
            ->willReturn(30);

        $sum = $stubClass->add(10, 20);

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

    public function testReturnArgumentAndSelf()
    {
        $stubClass = $this->createMock('AbdulBundle\Util\ClassForMockTest');
        $stubClass->method('getFirstArgument')
            ->will(static::returnArgument(0));
        $stubClass->method('getClassObject')
            ->will(static::returnSelf());

        static::assertEquals('foo', $stubClass->getFirstArgument('foo', 'bar'));
        static::assertSame($stubClass, $stubClass->getClassObject());
    }

    public function testMockBuilderForClassDoesNotExist()
    {
        $stubNewClass = $this->getMockBuilder('ClassDoesNotExist')
            ->setMethods(['functionDoesNotExist1', 'functionDoesNotExist2'])
            ->getMock();

        $stubNewClass->method('functionDoesNotExist1')
            ->will(static::returnCallback('md5'));

        $stubNewClass->method('functionDoesNotExist2')
            ->will(static::returnValue(12));

        static::assertEquals(md5('hello world'), $stubNewClass->functionDoesNotExist1('hello world'));
        static::assertEquals(12, $stubNewClass->functionDoesNotExist2());
    }

    /**
     * What is the use of it?
     */
    public function testReturnValueMapStub()
    {
        // Create a stub for the SomeClass class.
        $stub = $this->createMock('AbdulBundle\Util\ClassForMockTest');

        // Create a map of arguments to return values.
        $map = [
            ['a', 'b', 'c', 'd'],
            ['e', 'f', 'g', 'h']
        ];

        // Configure the stub.
        $stub->method('doSomething')
            ->will(static::returnValueMap($map));

        // $stub->doSomething() returns different values depending on
        // the provided arguments.
        static::assertEquals('d', $stub->doSomething('a', 'b', 'c'));
        static::assertEquals('h', $stub->doSomething('e', 'f', 'g'));
    }

    /**
     * @expectedException \Exception
     */
    public function testThrowExceptionStub()
    {
        // Create a stub for the SomeClass class.
        $stub = $this->createMock('AbdulBundle\Util\ClassForMockTest');

        // Configure the stub.
        $stub->method('doSomething')
            ->will(static::throwException(new \Exception()));

        $stub->doSomething();
    }

    public function testObserversAreUpdated()
    {
        $stubObserver = $this->getMockBuilder('AbdulBundle\Util\Observer')
            ->setMethods(['update'])
            ->getMock();

        $stubObserver->expects(static::once())
            ->method('update')
            ->with(static::equalTo('something'));

        $subject = new Subject('Arabic');
        $subject->attach($stubObserver);
        $subject->doSomething();
    }

    public function testErrorsAreReported()
    {
        $stubObserver = $this->getMockBuilder('AbdulBundle\Util\Observer')
            ->setMethods(['reportError'])
            ->getMock();

        $stubObserver->expects(static::exactly(2))
            ->method('reportError')
            ->with(
                static::greaterThan(0),
                static::stringContains('Something'),
                static::isInstanceOf('AbdulBundle\Util\Subject')
            );

        $subject = new Subject('Arabic');
        $subject->attach($stubObserver);
        $subject->doSomethingBad();
        $subject->doSomethingBad();
    }

    public function testFunctionCalledTwiceWithDifferentArguments()
    {
        $stub = $this->getMockBuilder(\stdClass::class)
            ->setMethods(['set'])
            ->getMock();

        $stub->expects(static::exactly(2))
            ->method('set')
            ->withConsecutive(
                [static::equalTo('foo'), static::greaterThan(0)],
                [static::equalTo('bar'), static::greaterThan(0)]
            );

        $stub->set('foo', 21);
        $stub->set('bar', 22);
    }
}