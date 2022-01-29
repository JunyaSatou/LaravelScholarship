#!/bin/sh

set -su

prehook /usr/local/bin/wait_db_connect.sh --
prehook /usr/local/bin/composer_install.sh --

if [ "$APP_ENV" = 'local' ]; then
  php artisan migrate
fi

LOG_STREAM=/tmp/stdout

if ! [ -p $LOG_STREAM ]; then
  mkfifo $LOG_STREAM
  chmod 666 $LOG_STREAM
fi

/bin/sh -c php-fpm -D | tail -f $LOG_STREAM
