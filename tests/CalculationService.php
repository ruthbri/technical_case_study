<?php
use PHPUnit\Framework\TestCase;
use Services\CalculationService;

/**
 * Test para verificar el funcionamiento del metodo isYoungDriver()
 * en la clase CalculationService
 */
class CalculationServiceTest extends TestCase {
    public function testIsYoungDriver(): void {
        $this->assertEquals('YES', CalculationService::isYoungDriver('2005-01-01'));
        $this->assertEquals('NO', CalculationService::isYoungDriver('1980-01-01'));
        $this->assertEquals('NO', CalculationService::isYoungDriver(null));
        $this->assertEquals('NO', CalculationService::isYoungDriver(''));
    }
}
