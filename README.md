# Serializable Closure

A class that enables serialization of closure.

```
use Acfatah\SerializableClosure\SerializableClosure;

$serializable = new Acfatah\SerializableClosure\SerializableClosure(
    function () {
        // this closure does something...
    }
);

```

Or,

```
$serialized = Acfatah\SerializableClosure\SerializableClosure::serialize(
    function () {
        // this closure does something...
    }
);

```
