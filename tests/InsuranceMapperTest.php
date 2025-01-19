<?php
use PHPUnit\Framework\TestCase;
use Model\InsuranceMapper;

/**
 * Test para verificar el funcionamiento del mapeo de datos
 */
class InsuranceMapperTest extends TestCase {
  public function testValidMapping(): void {
    $input = [
        'holder' => 'CONDUCTOR_PRINCIPAL',
        'occasionalDriver' => 'NO',
        'prevInsurance_years' => 3,
        'prevInsurance_claimsCount' => 1,
        'prevInsurance_exists' => 'SI',
        'driver_birthDate' => '2005-01-01',
        'occasionalDriver_birthDate' => '1980-01-01'
    ];

    $mapper = new InsuranceMapper($input);
    $result = $mapper->map();

    $this->assertEquals('YES', $result['CondPpalEsTomador']);
    $this->assertEquals('YES', $result['ConductorUnico']);
    $this->assertEquals(3, $result['AnosSegAnte']);
    $this->assertEquals(1, $result['NroCondOca']);
    $this->assertEquals('YES', $result['SeguroEnVigor']);
    $this->assertEquals('YES', $result['IsYoungDriver']);
    $this->assertEquals('NO', $result['IsYoungOccasionalDriver']); // Verifica este valor.
  }

  public function testEmptyValues(): void {
    $input = [
        'holder' => '',
        'occasionalDriver' => '',
        'prevInsurance_years' => '',
        'prevInsurance_claimsCount' => null,
        'prevInsurance_exists' => '',
        'driver_birthDate' => '',
        'occasionalDriver_birthDate' => ''
    ];

    $mapper = new InsuranceMapper($input);
    $result = $mapper->map();

    $this->assertEquals('NO', $result['CondPpalEsTomador']);
    $this->assertEquals('NO', $result['ConductorUnico']);
    $this->assertEquals(0, $result['AnosSegAnte']);
    $this->assertEquals(0, $result['NroCondOca']);
    $this->assertEquals('NO', $result['SeguroEnVigor']);
    $this->assertEquals('NO', $result['IsYoungDriver']);
    $this->assertEquals('NO', $result['IsYoungOccasionalDriver']);
  }
}
