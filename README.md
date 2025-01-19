# Technical Case Study - Insurance App

Este proyecto es una App para Mapear datos de seguros de autos en XML. Utiliza **PHP**, **PHPUnit** para pruebas unitarias y **PHPStan** para análisis estático del código.

## Contenido del archivo `TechnicalCaseStudy.zip`

El archivo `TechnicalCaseStudy.zip` contiene la estructura completa del proyecto, con los siguientes directorios principales:

technical_case_study/
- assets/
- config/
- controllers/
- model/
- services/
- tests/
- vendor/
- index.php
- pipeline.sh
- README.md


## Requisitos previos

Antes de ejecutar el proyecto, asegúrate de contar con lo siguiente:

- **PHP**: Versión 7.4 o superior.
- **Composer**: Para instalar las dependencias.
- **Navegador**: Para abrir la interfaz generada en `localhost`.
- **PowerShell o GitBash** Para ejecutar el script de pipeline.

## Instalación

1. **Descomprime el archivo `TechnicalCaseStudy.zip`**:
   - Extrae todo el contenido del archivo en un directorio de tu elección, por ejemplo:
     ```
     C:\technical_case_study\
     ```

2. **Instala las dependencias**:
   - Abre una terminal en el directorio descomprimido y ejecuta:
     ```bash
     composer install
     ```

   Esto instalará las dependencias necesarias en el directorio `vendor/`.

## Ejecución del proyecto

1. Abre Git Bash o silimar en el directorio del proyecto y ejecuta:
2. sh pipeline.sh

Si estas en ambiente windows:

1. Abre PowerShell en el directorio del proyecto y ejecuta:
2. .\pipeline.ps1
