<?php

class SerializableClosureTest extends \PHPUnit_Framework_TestCase
{
    protected $closure;
    protected $serializable;
    protected $serialized;

    public function setUp()
    {
        $greet = 'Hello';

        $this->closure = function ($person) use ($greet) {
            return $greet . " $person!";
        };

        $this->serializable = new Acfatah\SerializableClosure\SerializableClosure($this->closure);
        $this->serialized = serialize($this->serializable);
    }

    public function testUnserialize()
    {
        $unserialized = unserialize($this->serialized);
        $this->assertNotFalse($unserialized);
        $this->assertTrue(is_callable($unserialized));
        $this->assertEquals('Hello world!', $unserialized('world'));
    }

    public function testGetClosure()
    {
        $closure = $this->closure;
        $serializable = unserialize($this->serialized);
        $unserialized_closure = $serializable->getClosure();
        $expected = new \ReflectionFunction($closure);
        $actual = new \ReflectionFunction($unserialized_closure);

        $this->assertEquals(
            $expected->getNumberOfParameters(),
            $actual->getNumberOfParameters()
        );
        $this->assertEquals(
            $expected->getNumberOfRequiredParameters(),
            $actual->getNumberOfRequiredParameters()
        );
        $this->assertEquals(
            $expected->getParameters(),
            $actual->getParameters()
        );
        $this->assertSame(
            $expected->getStaticVariables(),
            $actual->getStaticVariables()
        );
        $this->assertEquals($closure('world'), $unserialized_closure('world'));
    }
}
