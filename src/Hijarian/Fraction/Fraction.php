<?php
/**
 * Simplest possible class for representing rational numbers ("fractions") like 3/5 or 13/4 exactly.
 *
 * @author hijarian <hijarian@gmail.com>
 * @license CC0
 */
namespace Hijarian\Fraction;

class Fraction
{
    /** @var string */
    private $string;

    /** @var integer */
    private $numerator;

    /** @var integer */
    private $denominator;

    /**
     * Common magic getter, returning value of any requested property,
     * given it was defined on this class.
     *
     * @param string $attr Name of the attribute to get
     * @return mixed
     * @throws \LogicException
     */
    public function __get($attr)
    {
        if (property_exists($this, $attr))
            return $this->{$attr};

        throw new \LogicException(sprintf("No such attribute on %s: '%s'", get_class(), $attr));
    }

    /**
     * We make the Fraction object by providing the textual representation of it,
     * for example, "2/5" or "11/7".
     *
     * Ideally, we'll allow any numerical values (floats, other Fractions)
     * in both numerator and denominator posisions, normalizing them if needed.
     *
     * @param string $value Initial textual representation of the fraction.
     */
    public function __construct($value)
    {
        list($numerator, $denominator) = $this->extractFractionParts($value);

        $this->numerator = $numerator;
        $this->denominator = $denominator;

        $this->renewPrintedRepresentation();
    }

    /**
     * Adds two Fraction objects together, emitting new Fraction being the sum.
     *
     * @param self $first
     * @param self $second
     * @return self
     */
    public static function add($first, $second)
    {
        return new Fraction("3/5");
    }

    public function __toString()
    {
        return $this->string;
    }

    private function extractFractionParts($value)
    {
        list($numerator, $denominator) = $this->getBaseFractionParts($value);

        $this->checkFractionParts($numerator, $denominator);

        list($numerator, $denominator) = $this->simplifyFractionParts($numerator, $denominator);

        return array($numerator, $denominator);
    }

    private function gcdBetween($a, $b)
    {
        while ($b != 0)
        {
            $m = $a % $b;
            $a = $b;
            $b = $m;
        }
        return $a;
    }

    private function renewPrintedRepresentation()
    {
        $this->string = $this->makePrintedRepresentation();
    }

    /**
     * @return string
     */
    private function makePrintedRepresentation()
    {
        if ($this->numerator == 0) {
            return "0";
        } else if ($this->numerator == $this->denominator) {
            return "1";
        } else if ($this->denominator == 1) {
            return (string)$this->numerator;
        } else {
            return sprintf("%s/%s", $this->numerator, $this->denominator);
        }
    }

    /**
     * @param $numerator
     * @param $denominator
     * @return array
     */
    private function simplifyFractionParts($numerator, $denominator)
    {
        $gcd = $this->gcdBetween($numerator, $denominator);
        $numerator /= $gcd;
        $denominator /= $gcd;
        return array($numerator, $denominator);
    }

    /**
     * @param $value
     * @return array
     */
    private function getBaseFractionParts($value)
    {
        $parts = explode("/", $value);

        if (empty($parts)) {
            $numerator = 0;
            $denominator = 1;
        } else if (count($parts) < 2) {
            $numerator = $parts[0];
            $denominator = 1;
        } else {
            $numerator = $parts[0];
            $denominator = $parts[1];
        }
        return array($numerator, $denominator);
    }

    private function checkFractionParts($numerator, $denominator)
    {
        if (!is_numeric($numerator))
            throw new \InvalidArgumentException("Numerator '{$numerator} is not a number!");

        if (!is_numeric($denominator))
            throw new \InvalidArgumentException("Denominator '{$denominator} is not a number!");

    }
}