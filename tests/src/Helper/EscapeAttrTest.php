<?php
namespace Aura\Html\Helper;

class EscapeAttrTest extends AbstractHelperTest
{
    public function test__invoke()
    {
        $attr = $this->helper;
        
        $values = array(
            'foo' => 'bar',
            'nim' => null,
            'baz' => array('dib', 'zim', 'gir'),
            'required' => true,
            'optional' => false,
        );
        
        $expect = 'foo="bar" baz="dib zim gir" required';
        $actual = $attr($values);
        $this->assertSame($expect, $actual);
    }
    
    public function test__invokeNoAttribs()
    {
        $attr = $this->helper;
        $values = array();
        $expect = '';
        $actual = $attr($values);
        $this->assertSame($expect, $actual);
    }
}
