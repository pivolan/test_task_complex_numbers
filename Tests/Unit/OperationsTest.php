<?php

namespace Tests\Units;

use PHPUnit\Framework\TestCase;
use pivolan\ComplexNumbers\ComplexNumber;
use pivolan\ComplexNumbers\DivisionByZeroException;

class OperationsTest extends TestCase
{
    /**
     * @param ComplexNumber $a
     * @param ComplexNumber $b
     * @param ComplexNumber $expected
     * @dataProvider dataAddProvider
     */
    public function testComplexNumbersAdd(ComplexNumber $a, ComplexNumber $b, ComplexNumber $expected)
    {
        $this->assertEquals($expected, $a->add($b), 'Not equal');
    }

    public function dataAddProvider()
    {
        return [
            [new ComplexNumber("10", 10), new ComplexNumber(0, 0), new ComplexNumber(10, 10)],
            [new ComplexNumber(0, 0), new ComplexNumber(10, 10), new ComplexNumber(10, 10)],
            [new ComplexNumber(-10, -10), new ComplexNumber(-5, 10), new ComplexNumber(-15, 0)],
        ];
    }

    /**
     * @param ComplexNumber $a
     * @param ComplexNumber $b
     * @param ComplexNumber $expected
     * @dataProvider dataSubProvider
     */
    public function testComplexNumbersSub(ComplexNumber $a, ComplexNumber $b, ComplexNumber $expected)
    {
        $this->assertEquals($expected, $a->subtract($b), 'Not equal');
    }

    public function dataSubProvider()
    {
        return [
            [new ComplexNumber(10, 10), new ComplexNumber(0, 0), new ComplexNumber(10, 10)],
            [new ComplexNumber(0, 0), new ComplexNumber(10, 10), new ComplexNumber(-10, -10)],
            [new ComplexNumber(0, 0), new ComplexNumber(0, 0), new ComplexNumber(0, 0)],
            [new ComplexNumber(-10, -10), new ComplexNumber(-5, 10), new ComplexNumber(-5, -20)],
        ];
    }

    /**
     * @param ComplexNumber $a
     * @param ComplexNumber $b
     * @param ComplexNumber $expected
     * @dataProvider dataMultiplyProvider
     */
    public function testComplexNumbersMultiply(ComplexNumber $a, ComplexNumber $b, ComplexNumber $expected)
    {
        $this->assertEquals($expected, $a->multiply($b), 'Not equal');
    }

    public function dataMultiplyProvider()
    {
        return [
            [new ComplexNumber(10, 10), new ComplexNumber(0, 0), new ComplexNumber(0, 0)],
            [new ComplexNumber(0, 0), new ComplexNumber(10, 10), new ComplexNumber(0, 0)],
            [new ComplexNumber(-10, -10), new ComplexNumber(-5, 10), new ComplexNumber(150, -50)],
        ];
    }

    /**
     * @param ComplexNumber $a
     * @param ComplexNumber $b
     * @param ComplexNumber $expected
     * @dataProvider dataDivProvider
     * @throws DivisionByZeroException
     */
    public function testComplexNumbersDiv(ComplexNumber $a, ComplexNumber $b, ComplexNumber $expected)
    {
        $this->assertEquals($expected, $a->divide($b), 'Not equal');
    }

    public function testComplexNumbersDivByZero()
    {
        $this->expectException(DivisionByZeroException::class);
        (new ComplexNumber(10.0, 10.0))->divide(new ComplexNumber(0.0, 0.0));
    }

    public function dataDivProvider()
    {
        return [
            [new ComplexNumber(10, 10), new ComplexNumber(1, 1), new ComplexNumber(10, 0)],
            [new ComplexNumber(10, 10), new ComplexNumber(0, 1), new ComplexNumber(10, -10)],
            [new ComplexNumber(10, 10), new ComplexNumber(1, 0), new ComplexNumber(10, 10)],
            [new ComplexNumber(-10, -10), new ComplexNumber(-5, 10), new ComplexNumber(-0.4, 1.2)],
        ];
    }
}