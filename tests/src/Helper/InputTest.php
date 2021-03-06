<?php
namespace Aura\Html\Helper;

use Aura\Html\HelperFactory;
use Aura\Html\HelperLocator;
use Aura\Html\Escaper;

class InputTest extends AbstractHelperTest
{
    protected function newHelper()
    {
        $helper = parent::newHelper();
        
        $helper->setHelperLocator(new HelperLocator(new HelperFactory(
            new Escaper,
            array(
                'button'            => function () { return new Input\Generic; },
                'checkbox'          => function () { return new Input\Checkbox; },
                'color'             => function () { return new Input\Generic; },
                'date'              => function () { return new Input\Generic; },
                'datetime'          => function () { return new Input\Generic; },
                'datetime-local'    => function () { return new Input\Generic; },
                'email'             => function () { return new Input\Generic; },
                'file'              => function () { return new Input\Generic; },
                'hidden'            => function () { return new Input\Generic; },
                'image'             => function () { return new Input\Generic; },
                'month'             => function () { return new Input\Generic; },
                'number'            => function () { return new Input\Generic; },
                'password'          => function () { return new Input\Generic; },
                'radio'             => function () { return new Input\Radio; },
                'range'             => function () { return new Input\Generic; },
                'reset'             => function () { return new Input\Generic; },
                'search'            => function () { return new Input\Generic; },
                'select'            => function () { return new Input\Select; },
                'submit'            => function () { return new Input\Generic; },
                'tel'               => function () { return new Input\Generic; },
                'text'              => function () { return new Input\Generic; },
                'textarea'          => function () { return new Input\Textarea; },
                'time'              => function () { return new Input\Generic; },
                'url'               => function () { return new Input\Generic; },
                'week'              => function () { return new Input\Generic; },
            )
        )));
        
        return $helper;
    }
    
    public function testCheckbox()
    {
        $spec = array(
            'type' => 'checkbox',
            'name' => 'field_name',
            'attribs' => array(
                'id' => null,
                'type' => null,
                'name' => null,
                'value' => 'foo',
                'label' => 'DOOM',
            ),
            'value' => 'foo',
        );
        
        $input = $this->helper;
        $actual = $input($spec);
        $expect = '<label><input type="checkbox" name="field_name" value="foo" checked /> DOOM</label>' . PHP_EOL;
        $this->assertSame($expect, $actual);
    }
    
    public function testInput()
    {
        $spec = array(
            'type' => 'text',
            'name' => 'field_name',
            'attribs' => array(
                'id' => null,
                'type' => null,
                'name' => null,
            ),
            'options' => array(),
            'value' => 'foo',
        );
        
        $input = $this->helper;
        $actual = $input($spec);
        $expect = '<input type="text" name="field_name" value="foo" />' . PHP_EOL;
        $this->assertSame($expect, $actual);
    }
    
    public function testNoType()
    {
        $spec = array(
            'name' => 'field_name',
            'attribs' => array(
                'id' => null,
                'type' => null,
                'name' => null,
            ),
            'options' => array(),
            'value' => 'foo',
        );
        
        $input = $this->helper;
        $actual = $input($spec);
        $expect = '<input type="text" name="field_name" value="foo" />' . PHP_EOL;
        $this->assertSame($expect, $actual);
    }
    
    public function testRadio()
    {
        $spec = array(
            'type' => 'radio',
            'name' => 'field_name',
            'label' => null,
            'attribs' => array(
                'id' => null,
                'type' => null,
                'name' => null,
                'foo' => 'bar',
            ),
            'options' => array('opt1' => 'Label 1', 'opt2' => 'Label 2', 'opt3' => 'Label 3'),
            'value' => 'opt2',
        );
        
        $input = $this->helper;
        $actual = $input($spec);
        $expect = '<label><input type="radio" name="field_name" foo="bar" value="opt1" /> Label 1</label>' . PHP_EOL
                . '<label><input type="radio" name="field_name" foo="bar" value="opt2" checked /> Label 2</label>' . PHP_EOL
                . '<label><input type="radio" name="field_name" foo="bar" value="opt3" /> Label 3</label>' . PHP_EOL;
        $this->assertSame($expect, $actual);
    }
    
    public function testSelect()
    {
        $spec = array(
            'type' => 'select',
            'name' => 'field_name',
            'attribs' => array(
                'id' => null,
                'type' => null,
                'name' => null,
                'foo' => 'bar',
            ),
            'options' => array(
                'opt1' => 'Label 1',
                'opt2' => 'Label 2',
                'opt3' => 'Label 3',
                'Group A' => array(
                    'opt4' => 'Label 4',
                    'opt5' => 'Label 5',
                    'opt6' => 'Label 6',
                ),
                'Group B' => array(
                    'opt7' => 'Label 7',
                    'opt8' => 'Label 8',
                    'opt9' => 'Label 9',
                ),
            ),
            'value' => 'opt5',
        );
        
        $input = $this->helper;
        $actual = $input($spec);
        
        $expect = '<select name="field_name" foo="bar">' . PHP_EOL
                . '    <option value="opt1">Label 1</option>' . PHP_EOL
                . '    <option value="opt2">Label 2</option>' . PHP_EOL
                . '    <option value="opt3">Label 3</option>' . PHP_EOL
                . '    <optgroup label="Group A">' . PHP_EOL
                . '        <option value="opt4">Label 4</option>' . PHP_EOL
                . '        <option value="opt5" selected>Label 5</option>' . PHP_EOL
                . '        <option value="opt6">Label 6</option>' . PHP_EOL
                . '    </optgroup>' . PHP_EOL
                . '    <optgroup label="Group B">' . PHP_EOL
                . '        <option value="opt7">Label 7</option>' . PHP_EOL
                . '        <option value="opt8">Label 8</option>' . PHP_EOL
                . '        <option value="opt9">Label 9</option>' . PHP_EOL
                . '    </optgroup>' . PHP_EOL
                . '</select>' . PHP_EOL;
        
        $this->assertSame($expect, $actual);
    }
    
    public function testTextarea()
    {
        $spec = array(
            'type' => 'textarea',
            'name' => 'field_name',
            'label' => null,
            'attribs' => array(
                'id' => null,
                'type' => null,
                'name' => null,
                'foo' => 'bar',
            ),
            'options' => array('baz' => 'dib'),
            'value' => 'Text in the textarea.',
        );
        
        $input = $this->helper;
        $actual = $input($spec);
        $expect = '<textarea name="field_name" foo="bar">Text in the textarea.</textarea>';
        $this->assertSame($expect, $actual);
    }
}
