<?php

//namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Measurement;
class MeasurementTest extends TestCase
{
    /** @test
     * @dataProvider dataProvider
     */
    public function isConversionCorrect($value, $expected): void
    {
        $measurement = new Measurement();
        $measurement->setCelsius($value);

        $fahrenheit = $measurement->getFahrenheit();
        $this->assertEquals($expected, $fahrenheit);
    }
    public function dataProvider(): array
    {
        return [
            [1.9, 60],
            [12, 53.6],
            [17, 62.6],
            [9, 10],
            [20, 68],
        ];
    }
}
