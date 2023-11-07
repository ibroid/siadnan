@echo off
echo Untuk melihat link assets. Silahkan input password.
set /p input= Masukan Password : 
echo Link akan muncul di bawah ini : 
cd go_helper && go_helper_win.exe --do=link_assets --pass=%input%
pause