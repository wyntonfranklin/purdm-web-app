#!/usr/bin/env bash

# Version number
version=0.0.2-dist
# Change these variables for your application

# tempoary file location
temp=C:/Users/wfranklin/Documents/purdmdist/temp

# source application
path=C:/Users/wfranklin/Documents/GitHub/wfexpenses
zpath=C:/Users/wfranklin/Documents/purdmdist/temp/wfexpenses
output=C:/Users/wfranklin/Documents/purdmdist/output/
fname=wfexpenses${version}

cd ${path}

echo "Creating temp"
mkdir -p ${temp}
cp -R ${path} ${temp}/${fname}

cd "${temp}"
echo "Copy files"
cp -f ${fname}/index-production.php ${fname}/index.php
cp -f ${fname}/protected/config/database-copy.php ${fname}/protected/config/database.php
rm -rf ${fname}/assets/*
rm -rf ${fname}/protected/runtime/*

echo "Going into temp"
cd "${temp}" ..
echo "Running targ"
tar --force-local -rf ${output}wfexpenses${version}.tar ${fname}/assets ${fname}/images ${fname}/protected ${fname}/public ${fname}/screenshots ${fname}/sql  ${fname}/yii ${fname}/index.php ${fname}/README.md ${fname}/.htaccess ${fname}/icon.ico
gzip -f ${output}wfexpenses${version}.tar

rm -rf ${temp}/${fname}/