
@echo off
setlocal

set count=2

:Countdown
echo Bat dau sau: %count% giay nua
ping -n 2 127.0.0.1 > nul
set /a count-=1

if %count% gtr 0 (
    goto Countdown
) else (
    echo Countdown finished
    echo Running command...
    start php server/discord.php
)