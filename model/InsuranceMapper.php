<?php

namespace Model;

use Services\CalculationService;

class InsuranceMapper {
    /** @var array<string, mixed> */
    private array $data;

    /**
     * @param array<string, mixed> $data
     */
    public function __construct(array $data) {
        $this->data = $data;
    }

    /**
     * @return array<string, string|int>
     */
    public function map(): array {
        return [
            'CondPpalEsTomador' => $this->mapHolder(),
            'ConductorUnico' => $this->mapOccasionalDriver(),
            'FecCot' => date('Y-m-d'),
            'AnosSegAnte' => $this->mapPreviousInsuranceYears(),
            'NroCondOca' => $this->mapClaimsCount(),
            'SeguroEnVigor' => $this->mapPreviousInsuranceStatus(),
            'IsYoungDriver' => $this->mapIsYoungDriver($this->getStringOrNull($this->data['driver_birthDate'] ?? null)),
            'IsYoungOccasionalDriver' => $this->mapIsYoungDriver($this->getStringOrNull($this->data['occasionalDriver_birthDate'] ?? null)),
        ];
    }

    private function mapHolder(): string {
        return ($this->data['holder'] ?? '') === 'CONDUCTOR_PRINCIPAL' ? 'YES' : 'NO';
    }

    private function mapOccasionalDriver(): string {
        return ($this->data['occasionalDriver'] ?? '') === 'NO' ? 'YES' : 'NO';
    }

    private function mapPreviousInsuranceYears(): int {
        $value = $this->data['prevInsurance_years'] ?? null;
        return is_numeric($value) ? intval($value) : 0;
    }

    private function mapClaimsCount(): int {
        $value = $this->data['prevInsurance_claimsCount'] ?? null;
        return is_numeric($value) ? intval($value) : 0;
    }

    private function mapPreviousInsuranceStatus(): string {
        return ($this->data['prevInsurance_exists'] ?? '') === 'SI' ? 'YES' : 'NO';
    }

    private function mapIsYoungDriver(?string $birthDate): string {
        if (empty($birthDate) || !strtotime($birthDate)) {
            return 'NO';
        }
        return CalculationService::isYoungDriver($birthDate);
    }

    /**
     * Garantizo que el valor sea una cadena o null.
     *
     * @param mixed $value
     * @return string|null
     */
    private function getStringOrNull(mixed $value): ?string {
        return is_string($value) ? $value : null;
    }
}
