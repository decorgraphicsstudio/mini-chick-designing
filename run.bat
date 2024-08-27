@echo off

rem Navigate to the Laravel project directory
cd /d E:\yaseen

rem Start Laravel's built-in server
start /b php artisan serve --port=8000

rem Wait for the server to start
timeout /t 2 /nobreak >nul

rem Open the project in the default web browser
start http://localhost:8000

exit
