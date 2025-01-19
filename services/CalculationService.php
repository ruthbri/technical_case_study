<?php

namespace Services;

class CalculationService {
    /**
     * Calculo si un conductor es joven (menor de 25 años).
     *
     * @param string|null $birthDate Fecha de nacimiento en formato 'YYYY-MM-DD'.
     * @return string 'YES' si es joven, 'NO' en caso contrario.
     */
    public static function isYoungDriver(?string $birthDate): string {
        if (empty($birthDate) || !strtotime($birthDate)) {
            return 'NO';
        }

        $currentDate = new \DateTime();
        $birthDateObj = new \DateTime($birthDate);
        $age = $currentDate->diff($birthDateObj)->y;

        return $age < 25 ? 'YES' : 'NO';
    }
}
