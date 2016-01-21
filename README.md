# Serializable Closure

[![Build Status](https://travis-ci.org/acfatah/serializable-closure.svg?branch=master)](https://travis-ci.org/acfatah/serializable-closure)

A class that enables serialization of closure.

```
$serializable = new Acfatah\SerializableClosure\SerializableClosure(
    function () {
        // this closure does something...
    }
);

```

Or,

```
$serialized = Acfatah\SerializableClosure\Serializer::serialize(
    function () {
        // this closure does something...
    }
);

```
