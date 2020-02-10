#!/usr/bin/env bash

# Version number
version=0.0.1-dist
# Change these variables for your application

# tempoary file location
temp=~/.temp

# source application
path=~/Documents/websites/wfexpenses/
zpath=~/.temp/wfexpenses
output=~/Documents/websites/
fname=wfexpenses${version}

cd ${path}
echo "Running grunt"
npm test

mkdir -p ${temp}
cp -R ${path} ${temp}/${fname}

cd ${temp}
cp -f ${fname}/index-production.php ${fname}/index.php
rm -rf ${fname}/assets/*

cd ${temp} ..
tar -rf ${output}wfexpenses${version}.tar ${fname}/assets ${fname}/images ${fname}/protected ${fname}/public ${fname}/screenshots ${fname}/sql  ${fname}/yii ${fname}/index.php ${fname}/README.md ${fname}/.htaccess ${fname}/icon.ico
gzip -f ${output}wfexpenses${version}.tar

rm -rf ${temp}/${fname}/

