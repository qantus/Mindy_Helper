<?php
use Mindy\Helper\Creator;

/**
 * 
 *
 * All rights reserved.
 * 
 * @author Falaleev Maxim
 * @email max@studio107.ru
 * @version 1.0
 * @company Studio107
 * @site http://studio107.ru
 * @date 07/01/14.01.2014 13:50
 */


abstract class Test
{
    public function __construct(array $options = [])
    {
        foreach($options as $name => $param) {
            $this->$name = $param;
        }
    }
}

class TestCreate extends Test
{
    public $test;
}

class CreatorTest extends TestCase
{
    public function testCreate()
    {
        $obj = Creator::createObject([
            'class' => 'TestCreate',
            'test' => 1
        ]);

        $this->assertInstanceOf('TestCreate', $obj);
        $this->assertEquals(1, $obj->test);
    }

    public function testCreateFromDefaults()
    {
        Creator::$objectConfig = [
            'TestCreate' => [
                'test' => 1
            ]
        ];

        $obj = Creator::createObject([
            'class' => 'TestCreate',
        ]);
        $this->assertInstanceOf('TestCreate', $obj);
        $this->assertEquals(1, $obj->test);

        $obj = Creator::createObject('TestCreate');
        $this->assertInstanceOf('TestCreate', $obj);
        $this->assertEquals(1, $obj->test);
    }

    public function testConfigure()
    {
        $obj = Creator::createObject([
            'class' => 'TestCreate',
            'test' => 1
        ]);

        $this->assertInstanceOf('TestCreate', $obj);
        $this->assertEquals(1, $obj->test);

        Creator::configure($obj, ['test' => 2]);
        $this->assertEquals(2, $obj->test);
    }

    public function testObjectVars()
    {
        $obj = Creator::createObject([
            'class' => 'TestCreate',
            'test' => 1
        ]);

        $this->assertInstanceOf('TestCreate', $obj);
        $this->assertEquals(get_object_vars($obj), Creator::getObjectVars($obj));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testException()
    {
        $obj = Creator::createObject([]);
    }

    public function testCreateExtra()
    {
        $obj = Creator::createObject([
            'class' => 'TestCreate'
        ], ['test' => 1]);

        $obj = Creator::createObject([
            'class' => 'TestCreate'
        ], ['test' => 1]);
    }
}
