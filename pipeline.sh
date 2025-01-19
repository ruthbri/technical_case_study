#!/bin/bash

echo "Ejecutando pruebas unitarias..."
if ! vendor/bin/phpunit --testdox tests; then
    echo "❌ Las pruebas unitarias fallaron. Se deben corregir los errores antes de continuar."
    exit 1
fi

echo "Ejecutando análisis de PHPStan..."
if ! vendor/bin/phpstan analyse --level=max; then
    echo "❌ Análisis de PHPStan fallido. Se deben corregir los errores antes de continuar."
    exit 1
fi

echo "✅ Pruebas y análisis completados exitosamente. Iniciando servidor..."
php -S localhost:8000 &
sleep 2

# Abre el navegador en la URL del servidor
if which xdg-open > /dev/null; then
    xdg-open http://localhost:8000
elif which open > /dev/null; then
    open http://localhost:8000
else
    echo "Navegador no detectado. Abre manualmente: http://localhost:8000"
fi
