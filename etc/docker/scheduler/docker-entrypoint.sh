#!/bin/sh

set -su

prehook /usr/local/bin/wait_db_connect.sh --
prehook /usr/local/bin/composer_install.sh --

while [ true ]
do
  until [ "$(date '+%S')" -eq "00" ]
  do
    sleep 0.5
  done

  # random sleep 1s - 10s
  sleep $(( $(od -vAn -N4 -tu4 < /dev/random) % 10 + 1 ))

  php artisan schedule:run --verbose --no-interaction &
done
