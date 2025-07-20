@echo off
REM Inicia Apache si no está corriendo (requiere XAMPP control en segundo plano)
echo Iniciando MarketMar...

REM Cambiar a la carpeta del proyecto (opcional)
cd /d C:\xampp\htdocs\MarketMar

REM Abrir en navegador predeterminado
start http://localhost/MarketMar/

REM Mensaje opcional
echo Proyecto MarketMar abierto en el navegador.
pause
