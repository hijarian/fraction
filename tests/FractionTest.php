<?php
/**
 * Test suite for Fraction class.
 */
use \Hijarian\Fraction\Fraction;

class FractionTest extends PHPUnit_Framework_TestCase
{
    public function SimplifyingFractions()
    {
        return array(
            array('3/5', '3/5'),
            array('4/8', '1/2'),
            array('0/1', '0'),
            array('12/12', '1'),
            array('8/2', '4'),
            array('30/10', '3'),
            array('3/6', '1/2'),
            array('2/3', '2/3'),
            array('1', '1')
        );
    }

    /**
     * @test
     * @dataProvider SimplifyingFractions
     */
    public function SimplifiesFractionsOnInstantiating($given, $expected)
    {
        $fraction = new Fraction($given);

        $this->assertEquals($expected, (string)$fraction);
    }

    public function InvalidInputs()
    {
        return array(
            array('abcde'),
            array('abcde/deadbeef'),
            array('1/xxx'),
            array('xxx/123'),
        );
    }

    /**
     * @test
     * @dataProvider InvalidInputs
     * @expectedException \InvalidArgumentException
     */
    public function ThrowsExceptionWhenNonNumericInput($input)
    {
        new Fraction($input);
    }

    public function FractionsAddition()
    {
        return array(
            array('0/1', '0/2', '0'),
            array('2/5', '3/5', '1'),
            array('2/5', '2/5', '4/5'),
            array('2/4', '1/3', '5/6'),
            array('2/5', '4/5', '6/5'),
            array('7/9', '3/9', '10/9'),
            array('2/9', '1/9', '1/3'),
            array('2/5', '1/5', '3/5'),
            array('1', '2', '3')
        );
    }

    /**
     * @test
     * @dataProvider FractionsAddition
     */
    public function CanAddFractions($first_value, $second_value, $expected_result)
    {
        $first = new Fraction($first_value);
        $second = new Fraction($second_value);
        $result = Fraction::add($first, $second);

        $this->assertEquals($expected_result, (string)$result);
    }

}
