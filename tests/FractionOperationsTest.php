<?php
/**
 * Test suite for Fraction class.
 *
 * This test cases checks how the arithmetic operations work on Fractions.
 */
use \Hijarian\Fraction\Fraction;

class FractionOperationsTest extends PHPUnit_Framework_TestCase
{
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
        $this->checkBinaryOperation('add', $first_value, $second_value, $expected_result);
    }

    public function FractionsMultiplication()
    {
        return array(
            array('1/2', '1/3', '1/6'),
            array('2/5', '3/2', '3/5'),
            array('5/5', '3/2', '3/2'),
            array('4/3', '3/4', '1'),
            array('3/4', '4/3', '1'),
            array('0', '1', '0'),
            array('1', '0', '0'),
            array('4/3', '1', '4/3'),
            array('1', '4/3', '4/3'),
        );
    }

    /**
     * @test
     * @dataProvider FractionsMultiplication
     */
    public function CanMultiplyFractions($first_value, $second_value, $expected_result)
    {
        $this->checkBinaryOperation('mult', $first_value, $second_value, $expected_result);
    }

    public function FractionsDivision()
    {
        return array(
            array('1/2', '1/3', '3/2'),
            array('2/5', '3/2', '4/15'),
            array('5/5', '3/2', '2/3'),
            array('4/3', '3/4', '16/9'),
            array('3/4', '4/3', '9/16'),
            array('0', '1', '0'),
            array('4/3', '1', '4/3'),
            array('1', '4/3', '3/4'),
        );
    }

    /**
     * @test
     * @dataProvider FractionsDivision
     */
    public function CanDivideFractions($first_value, $second_value, $expected_result)
    {
        $this->checkBinaryOperation('divide', $first_value, $second_value, $expected_result);
    }

    public function DivisionByZero()
    {
        return array(
            array('0'),
            array('0/10'),
        );
    }

    /**
     * @test
     * @dataProvider DivisionByZero
     * @expectedException \InvalidArgumentException
     */
    public function ThrowsExceptionOnDivisionByZeroFraction($zero_valued_divisor)
    {
        $arbitrary_fraction = '1/2';
        $this->checkBinaryOperation('divide', $arbitrary_fraction, $zero_valued_divisor, null);
    }

    public function FractionsSubtraction()
    {
        return array(
            array('1/2', '1/2', '0'),
            array('1', '2', '-1'),
            array('3/2', '1/2', '1'),
            array('-3/4', '1/4', '-1')
        );
    }

    /**
     * @test
     * @dataProvider FractionsSubtraction
     */
    public function CanSubtractFractions($first_value, $second_value, $expected_result)
    {
        $this->checkBinaryOperation('subtract', $first_value, $second_value, $expected_result);
    }

    private function checkBinaryOperation($operation, $first_operand, $second_operand, $expected_result)
    {
        $first = new Fraction($first_operand);
        $second = new Fraction($second_operand);
        // We have to use FQDN here because of how call_user_func operates.
        $result = call_user_func(array('\Hijarian\Fraction\Fraction', $operation), $first, $second);

        $this->assertEquals($expected_result, (string)$result);
    }
}
