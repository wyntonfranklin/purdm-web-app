#!/usr/bin/env bash

# Version number
version=update-0.0.2
# Change these variables for your application

# tempoary file location
temp=~/.temp

# source application
path=~/Documents/websites/wfexpenses/
zpath=~/.temp/wfexpenses
output=~/Documents/websites/
fname=wfexpenses${version}

echo "Changing directory to "${path}
cd ${path}
echo "Running grunt"
npm test

echo "Create temp folder"
mkdir -p ${temp}

echo "Copy source to temp"
cp -R ${path} ${temp}/${fname}

echo "Change directory to "${temp}
cd ${temp}


echo "Prepare assets for update"
cp -f ${fname}/index-production.php ${fname}/index.php
rm -rf ${fname}/assets/*
rm -rf ${fname}/protected/config/*
rm -rf ${fname}/protected/runtime/*

cd ${temp} ..
echo "Adding folders to tar"
tar -rf ${output}wfexpenses${version}.tar ${fname}/assets ${fname}/images ${fname}/protected ${fname}/public ${fname}/sql ${fname}/index.php ${fname}/.htaccess ${fname}/icon.ico
echo "Running gzip on tar"
gzip -f ${output}wfexpenses${version}.tar
echo "Cleaning up"
rm -rf ${temp}/${fname}/
echo "Output directory is "${output}
