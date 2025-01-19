<?php

use PHPUnit\Framework\TestCase;
use Controllers\InsuranceController;
use Config\Config;

/**
 * Test para verificar el funcionamiento del controller
 */
class ControllerTest extends TestCase {
    private InsuranceController $controller;

    protected function setUp(): void {
        $this->controller = new InsuranceController();
    }

    public function testValidFileInput(): void {
        $inputFile = 'input_complete_test.json';

        // archivo JSON temporal
        $jsonPath = Config::getJSONPath() . $inputFile;
        file_put_contents($jsonPath, json_encode([
            'holder' => 'CONDUCTOR_PRINCIPAL',
            'occasionalDriver' => 'NO',
            'prevInsurance_years' => 3,
            'prevInsurance_claimsCount' => 1,
            'prevInsurance_exists' => 'SI',
            'driver_birthDate' => '2005-01-01',
            'occasionalDriver_birthDate' => '1980-01-01',
        ]));

        $output = $this->controller->run($inputFile);

        $this->assertStringContainsString('<CondPpalEsTomador>YES</CondPpalEsTomador>', $output);
        $this->assertStringContainsString('<ConductorUnico>YES</ConductorUnico>', $output);

        unlink($jsonPath);
    }

    public function testFileNotFound(): void {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Input file not found');

        $this->controller->run('non_existing_file.json');
    }

    public function testInvalidJsonFormat(): void {
        $inputFile = 'invalid_format_test.json';

        //formato JSON inválido
        $jsonPath = Config::getJSONPath() . $inputFile;
        file_put_contents($jsonPath, "{ invalid JSON ");

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid JSON format');

        $this->controller->run($inputFile);

        unlink($jsonPath);
    }
}
