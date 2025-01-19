<?php

namespace Services;

class XMLBuilder {
    /**
     * Genero un XML a partir de los datos mapeados.
     *
     * @param array<string, string|int|null> $mappedData Datos mapeados en un array asociativo.
     * @return string XML generado como string.
     * @throws \RuntimeException Si la generación del XML falla.
     */
    public function buildXML(array $mappedData): string {

        $xml = new \SimpleXMLElement('<TarificacionThirdPartyRequest/>');
        $datosGenerales = $xml->addChild('DatosGenerales');

        // nodos XML
        foreach ($mappedData as $key => $value) {
            $datosGenerales->addChild($key, is_scalar($value) ? (string)$value : null);
        }

        $result = $xml->asXML();

        if ($result === false) {
            throw new \RuntimeException('Failed to generate XML.');
        }

        return $result;
    }
}

