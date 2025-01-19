<?php
use PHPUnit\Framework\TestCase;
use Services\XMLBuilder;

/**
 * Test para verificar la generación del XML
 */
class XMLBuilderTest extends TestCase {
    public function testBuildXML(): void {
        $data = [
            'CondPpalEsTomador' => 'YES',
            'ConductorUnico' => 'YES',
            'FecCot' => '2025-01-12',
            'AnosSegAnte' => 3,
            'NroCondOca' => 1,
            'SeguroEnVigor' => 'YES',
            'IsYoungDriver' => 'YES',
            'IsYoungOccasionalDriver' => 'NO'
        ];

        $builder = new XMLBuilder();
        $xmlOutput = $builder->buildXML($data);

        $this->assertStringContainsString('<CondPpalEsTomador>YES</CondPpalEsTomador>', $xmlOutput);
        $this->assertStringContainsString('<ConductorUnico>YES</ConductorUnico>', $xmlOutput);
        $this->assertStringContainsString('<FecCot>2025-01-12</FecCot>', $xmlOutput);
        $this->assertStringContainsString('<AnosSegAnte>3</AnosSegAnte>', $xmlOutput);
        $this->assertStringContainsString('<IsYoungDriver>YES</IsYoungDriver>', $xmlOutput);
        $this->assertStringContainsString('<IsYoungOccasionalDriver>NO</IsYoungOccasionalDriver>', $xmlOutput);
    }
}
