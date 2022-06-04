SET FROM="C:\repos\PHP-Calendar-View"
SET TO="C:\Dev\xampp\htdocs"

ECHO %FROM%
ECHO %TO%

ROBOCOPY %FROM% %TO% *.* /S