<?php

class SerializableClosureTest extends \PHPUnit_Framework_TestCase
{
    protected $closure;
    protected $serializable;
    protected $serialized;

    public function setUp()
    {
        $greet = 'Hello';

        $closure = function ($person) use ($greet) {
            return $greet . " $person!";
        };

        $this->closure = $closure;
    }

    public function getWrappedClosure()
    {
        return new Acfatah\SerializableClosure\SerializableClosure(
            $this->closure
        );
    }

    public function serializeClosure()
    {
        return serialize($this->getWrappedClosure());
    }

    public function unserializeClosure()
    {
        return unserialize($this->serializeClosure());
    }

    public function testSerialize()
    {
        // no \Exception thrown
        $this->serializeClosure();
    }

    public function testUnserialize()
    {
        $unserialized = $this->unserializeClosure();

        $this->assertNotFalse($unserialized);
        $this->assertTrue(is_callable($unserialized));
        $this->assertEquals('Hello world!', $unserialized('world'));
    }

    public function testClosuresProduceSameResult()
    {
        $closure = $this->closure;
        $unserialized_closure = $this->unserializeClosure();

        $this->assertEquals(
            $closure('world'),
            $unserialized_closure('world')
        );
    }

    public function testClosureHasSameParameters()
    {
        $expected = new \ReflectionFunction($this->closure);
        $actual = new \ReflectionFunction(
            $this->unserializeClosure()->getClosure()
        );

        $this->assertEquals(
            $expected->getNumberOfRequiredParameters(),
            $actual->getNumberOfRequiredParameters()
        );

        $this->assertEquals(
            $expected->getNumberOfParameters(),
            $actual->getNumberOfParameters()
        );

        $this->assertEquals(
            $expected->getParameters(),
            $actual->getParameters()
        );
    }

    public function testClosureHasSameStaticVariables()
    {
        $expected = new \ReflectionFunction($this->closure);
        $actual = new \ReflectionFunction(
            $this->unserializeClosure()->getClosure()
        );

        $this->assertSame(
            $expected->getStaticVariables(),
            $actual->getStaticVariables()
        );
    }
}
