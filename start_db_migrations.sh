#!/bin/sh
bin/console make:migration
bin/console doctrine:schema:update --force
bin/console cache:clear
