<?php

namespace Controllers;

use Config\Config;
use Model\InsuranceMapper;
use Services\XMLBuilder;

/**
 * Recibe un archivo Json, valida que el archivo exista y tenga un formato Json válido.
 * Mapea los datos de Json a un formato interno
 * Devuelve un XML
 */

class InsuranceController {
    public function run(string $inputFile): string {
        $jsonPath = Config::getJSONPath() . $inputFile;

        if (!file_exists($jsonPath)) {
            throw new \Exception('Input file not found: ' . $inputFile);
        }

        $jsonContent = file_get_contents($jsonPath);
        if ($jsonContent === false) {
            throw new \Exception('Failed to read JSON file: ' . $inputFile);
        }

        $inputData = json_decode($jsonContent, true);
        if (!is_array($inputData) || !$this->isValidStringKeyArray($inputData)) {
            throw new \Exception('Invalid JSON format or structure: ' . json_last_error_msg());
        }

        /** @var array<string, mixed> $inputData */
        $mapper = new InsuranceMapper($inputData);
        $mappedData = $mapper->map();

        $xmlBuilder = new XMLBuilder();
        $xml = $xmlBuilder->buildXML($mappedData);

        return $xml;
    }

    /**
     *
     * @param array<mixed, mixed> $array
     * @return bool
     */
    private function isValidStringKeyArray(array $array): bool {
        foreach (array_keys($array) as $key) {
            if (!is_string($key)) {
                return false;
            }
        }
        return true;
    }
}
