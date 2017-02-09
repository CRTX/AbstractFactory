#!/bin/bash

crowdr_project="abstractfactory"
crowdr_name_format="%s-%s"

crowdr_config="
#PHP CLI
php build docker/php
php volume $(pwd):/app
php env TRAVIS=true
php env TRAVIS_JOB_ID=${TRAVIS_JOB_ID}

"
