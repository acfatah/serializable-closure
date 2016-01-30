<?php

namespace Test\Unit;

use Acfatah\SerializableClosure\Serializer;

class SerializerTest extends \PHPUnit_Framework_TestCase
{
    protected $serialized;

    public function testSerializeUnserializeMethod()
    {
        $greet = 'Hello';

        $closure = function ($person) use ($greet) {
            return $greet . " $person!";
        };

        // no exception is thrown
        $serialized = \Acfatah\SerializableClosure\Serializer::serialize(
            $closure
        );

        $unserialized = \Acfatah\SerializableClosure\Serializer::unserialize($serialized);

        $this->assertNotFalse($unserialized);
        $this->assertTrue(is_callable($unserialized));
        $this->assertEquals('Hello world!', $unserialized('world'));
    }
}