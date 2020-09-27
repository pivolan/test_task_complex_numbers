<?php

namespace pivolan\ComplexNumbers;


/**
 * Class ComplexNumber
 * @package pivolan\ComplexNumbers
 */
class ComplexNumber
{
    /**
     * @var float
     */
    private $realPart = 0.0;
    /**
     * @var float
     */
    private $imaginaryPart = 0.0;

    public function __construct(float $realPart, float $imaginaryPart)
    {
        $this->realPart = $realPart;
        $this->imaginaryPart = $imaginaryPart;
    }

    public function add(ComplexNumber $complexNumber): ComplexNumber
    {
        $this->realPart += $complexNumber->getRealPart();
        $this->imaginaryPart += $complexNumber->getImaginaryPart();

        return $this;
    }

    public function subtract(ComplexNumber $complexNumber): ComplexNumber
    {
        $this->realPart -= $complexNumber->getRealPart();
        $this->imaginaryPart -= $complexNumber->getImaginaryPart();

        return $this;
    }

    public function multiply(ComplexNumber $complexNumber): ComplexNumber
    {
        $realPart = $this->getRealPart() * $complexNumber->getRealPart() - $this->getImaginaryPart(
            ) * $complexNumber->getImaginaryPart();
        $imaginaryPart = $this->getRealPart() * $complexNumber->getImaginaryPart() + $this->getImaginaryPart(
            ) * $complexNumber->getRealPart();
        $this->realPart = $realPart;
        $this->imaginaryPart = $imaginaryPart;

        return $this;
    }

    public function divide(ComplexNumber $complexNumber): ComplexNumber
    {
        $ar = $this->getRealPart();
        $ai = $this->getImaginaryPart();
        $br = $complexNumber->getRealPart();
        $bi = $complexNumber->getImaginaryPart();

        $div = $br * $br + $bi * $bi;
        if ($div === 0.0) {
            throw new DivisionByZeroException(__METHOD__.': division by zero');
        }

        $this->realPart = ($ar * $br + $ai * $bi) / $div;
        $this->imaginaryPart = ($ai * $br - $ar * $bi) / $div;

        return $this;
    }

    public function string(): string
    {
        return $this->getRealPart().' '.$this->getImaginaryPart().'i';
    }

    /**
     * @return float
     */
    public function getRealPart(): float
    {
        return $this->realPart;
    }

    /**
     * @return float
     */
    public function getImaginaryPart(): float
    {
        return $this->imaginaryPart;
    }
}