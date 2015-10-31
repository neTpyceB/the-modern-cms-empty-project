#!/bin/bash

BASEDIR=$(dirname $0)
cd $BASEDIR

php phpunit.phar --colors --debug --verbose --bootstrap phpunit_bootstrap.php --coverage-text=coverage_project .

while read line
do
    name=$line
    echo "$name"
done < coverage_project

php phpunit.phar --colors --debug --verbose --bootstrap phpunit_bootstrap.php --coverage-text=coverage_neTpyceB ../vendor/neTpyceB

while read line
do
    name=$line
    echo "$name"
done < coverage_neTpyceB