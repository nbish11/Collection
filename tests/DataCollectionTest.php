<?php

class DataCollectionTest extends PHPUnit_Framework_TestCase
{
    public function testRetrievesCorrectData()
    {
        $data = array('name' => 'Nathan');
        $collection = new DataCollection($data);

        $value = $collection->get('name');

        $this->assertEquals($value, 'Nathan');
    }

    public function testRetrievesDefaultValue()
    {
        $collection = new DataCollection();

        $value = $collection->get('name', 'Emma');

        $this->assertEquals($value, 'Emma');
    }

    public function testReturnsNullIfCannotRetrieveData()
    {
        $collection = new DataCollection();

        $value = $collection->get('name');

        $this->assertNull($value);
    }

    public function testSetsData()
    {
        $collection = new DataCollection();
        $collection->set('name', 'Nathan');

        $value = $collection->get('name');

        $this->assertEquals($value, 'Nathan');
    }

    public function testDataExists()
    {
        $data = array('name' => 'Nathan');
        $collection = new DataCollection($data);

        $exists = $collection->exists('name');

        $this->assertTrue($exists);
    }

    public function testDataDoesNotExist()
    {
        $collection = new DataCollection();

        $exists = $collection->exists('name');

        $this->assertFalse($exists);
    }

    public function testRemovesDataIfSet()
    {
        $data = array('name' => 'Kaitlen');
        $collection = new DataCollection($data);

        $collection->remove('name');
        $exists = $collection->exists('name');

        $this->assertFalse($exists);
    }

    public function testRetrievesAllDataAsArray()
    {
        $expectedData = array('name' => 'Kaitlen');
        $collection = new DataCollection($expectedData);

        $actualData = $collection->all();

        $this->assertEquals($expectedData, $actualData);
    }

    public function testMergesWithAnotherArray()
    {
        $expectedData = array(
            'name' => 'Kaitlen',
            'age' => 24
        );
        $collection = new DataCollection(array(
            'name' => 'Kaitlen'
        ));

        $collection->merge(array(
            'age' => 24
        ));
        $actualData = $collection->all();

        $this->assertEquals($expectedData, $actualData);
    }

    public function testMergesWithAnotherArrayOverwritingPreviousData()
    {
        $expectedData = array(
            'name' => 'Nathan',
            'age' => 25
        );
        $collection = new DataCollection(array(
            'name' => 'Kaitlen'
        ));

        $collection->merge(array(
            'name' => 'Nathan',
            'age' => 25
        ));
        $actualData = $collection->all();

        $this->assertEquals($expectedData, $actualData);
    }

    public function testMergesWithAnotherArrayRecursive()
    {
        $expectedData = array(
            'address' => array(
                'country' => 'Australia',
                'state' => 'Queensland'
            )
        );
        $collection = new DataCollection(array(
            'address' => array(
                'country' => 'Australia'
            )
        ));

        $collection->merge(array(
            'address' => array(
                'state' => 'Queensland'
            )
        ));
        $actualData = $collection->all();

        $this->assertEquals($expectedData, $actualData);
    }

    public function testMergesWithAnotherArrayRecursiveOverwritingPreviousData()
    {
        $expectedData = array(
            'address' => array(
                'country' => 'Australia',
                'state' => 'Tasmania'
            )
        );
        $collection = new DataCollection(array(
            'address' => array(
                'country' => 'Australia',
                'state' => 'Queensland'
            )
        ));

        $collection->merge(array(
            'address' => array(
                'state' => 'Tasmania'
            )
        ));
        $actualData = $collection->all();

        $this->assertEquals($expectedData, $actualData);
    }

    public function testCanReplaceCollectionData()
    {
        $collection = new DataCollection(array(
            'name' => 'Nathan'
        ));

        $collection->replace(array('welcome' => 'Hello, World!'));
        $exists = $collection->exists('name');

        $this->assertFalse($exists);
    }

    public function testCollectionCanBeCleared()
    {
        $collection = new DataCollection(array(
            'name' => 'Kaitlen',
            'age' => 24
        ));

        $collection->clear();
        $data = $collection->all();

        $this->assertEmpty($data);
    }

    public function testCollectionShouldBeEmpty()
    {
        $collection = new DataCollection();

        $isEmpty = $collection->isEmpty();

        $this->assertTrue($isEmpty);
    }

    public function testCollectionShouldNotBeEmpty()
    {
        $collection = new DataCollection(array(
            'name' => 'Kaitlen'
        ));

        $isEmpty = $collection->isEmpty();

        $this->assertFalse($isEmpty);
    }

    public function testCollectionIsCountable()
    {
        $collection = new DataCollection(array(
            'name' => 'Kaitlen'
        ));

        $this->assertCount(1, $collection);
    }

    public function testOffsetExists()
    {
        $collection = new DataCollection(array(
            'name' => 'Kaitlen'
        ));

        $this->assertTrue(isset($collection['name']));
        $this->assertFalse(isset($collection['age']));
    }

    public function testOffsetSet()
    {
        $collection = new DataCollection();

        $collection['name'] = 'Kaitlen';

        $this->assertArrayHasKey('name', $collection);
    }

    public function testOffsetGet()
    {
        $collection = new DataCollection(array(
            'name' => 'Kaitlen'
        ));

        $value = $collection['name'];

        $this->assertEquals('Kaitlen', $value);
    }

    public function testOffsetUnset()
    {
        $collection = new DataCollection(array(
            'name' => 'Kaitlen'
        ));

        unset($collection['name']);

        $this->assertEmpty($collection);
    }

    public function testDataCanBeCheckedForExistanceUsingPropertyNotation()
    {
        $collection = new DataCollection(array(
            'name' => 'Kaitlen'
        ));

        $this->assertTrue(isset($collection->name));
        $this->assertFalse(isset($collection->age));
    }

    public function testDataCanBeSetUsingPropertyNotation()
    {
        $collection = new DataCollection();

        $collection->name = 'Kaitlen';

        $this->assertArrayHasKey('name', $collection->all());
    }

    public function testDataCanBeRetrievedUsingPropertyNotation()
    {
        $collection = new DataCollection(array(
            'name' => 'Kaitlen'
        ));

        $value = $collection->name;

        $this->assertEquals('Kaitlen', $value);
    }

    public function testDataCanBeUnsetUsingPropertyNotation()
    {
        $collection = new DataCollection(array(
            'name' => 'Kaitlen'
        ));

        unset($collection->name);

        $this->assertEmpty($collection->all());
    }

    public function testDataCanBeIteratedOver()
    {
        $collection = new DataCollection(array(
            'name' => 'Kaitlen'
        ));

        foreach ($collection as $key => $value) {
            $this->assertEquals('name', $key);
            $this->assertEquals('Kaitlen', $value);
        }
    }

    public function testCanRetrieveAllKeys()
    {
        $collection = new DataCollection(array(
            'name' => 'Kaitlen',
            'age' => 24,
            'country' => 'Australia'
        ));

        $expected = array('name', 'age', 'country');
        $actual = $collection->keys();

        $this->assertEquals($expected, $actual);
    }

    public function testCanRetrieveAllValues()
    {
        $collection = new DataCollection(array(
            'name' => 'Kaitlen',
            'age' => 24,
            'country' => 'Australia'
        ));

        $expected = array('Kaitlen', 24, 'Australia');
        $actual = $collection->values();

        $this->assertEquals($expected, $actual);
    }

    public function testCollectionCanBeWalkedOver()
    {
        $collection = new DataCollection(range(1, 5));

        $collection->map(function (&$n) {
            $n = $n * $n * $n;
        });

        $expected = array(1, 8, 27, 64, 125);
        $actual = $collection->all();

        $this->assertEquals($expected, $actual);
    }
}
