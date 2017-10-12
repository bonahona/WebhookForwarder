#!/bin/bash

cd Scripts/Bash/
./MigrateDatabase.sh up

cd /var/www/html

/usr/sbin/apache2ctl -D FOREGROUND