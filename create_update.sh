#!/usr/bin/env bash

# Version number
version=0.0.4
# Change these variables for your application

# tempoary file location
temp=~/.temp

# source application
path=~/Documents/websites/wfexpenses/
zpath=~/.temp/wfexpenses
output=~/Documents/websites/
fname=wfexpenses${version}

mkdir -p ${temp}
cp -R ${path} ${temp}/${fname}

cd ${temp}
cp -f ${fname}/index-production.php ${fname}/index.php
rm -r ${fname}/assets/*
rm -r ${fname}/protected/config/*

cd ${temp} ..
gzip -rf ${output}wfexpenses${version}.tar ${fname}/assets ${fname}/images ${fname}/protected ${fname}/public ${fname}/screenshots ${fname}/sql  ${fname}/yii ${fname}/index.php ${fname}/README.md ${fname}/.htaccess ${fname}/icon.ico

rm -r ${temp}/${fname}/

