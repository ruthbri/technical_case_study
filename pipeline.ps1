# Ejecuta pruebas unitarias con PHPUnit
Write-Host "Ejecutando pruebas unitarias..."
if (-not (php vendor/bin/phpunit --testdox tests)) {
    Write-Host "❌ Las pruebas unitarias fallaron. Se deben corregir los errores antes de continuar." -ForegroundColor Red
    exit 1
}

# Ejecuta análisis estático con PHPStan
Write-Host "Ejecutando análisis de PHPStan..."
if (-not (php vendor/bin/phpstan analyse --level=max)) {
    Write-Host "❌ Análisis de PHPStan fallido. Se deben corregir los errores antes de continuar." -ForegroundColor Red
    exit 1
}

# Pruebas y análisis completados
Write-Host "✅ Pruebas y análisis completados exitosamente. Iniciando servidor..." -ForegroundColor Green

# Inicia el servidor PHP en localhost:8000
Start-Process -NoNewWindow -FilePath "php" -ArgumentList "-S", "localhost:8000"
Start-Sleep -Seconds 2

# Abre el navegador en la URL del servidor
if (Get-Command "start" -ErrorAction SilentlyContinue) {
    Start-Process "http://localhost:8000"
} else {
    Write-Host "Navegador no detectado. Abre manualmente: http://localhost:8000"
}
