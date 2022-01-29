#!/bin/bash

if [ "${APP_ENV}" = "local" ]; then
  composer install
fi
