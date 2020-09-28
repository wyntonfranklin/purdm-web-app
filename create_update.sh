#!/usr/bin/env bash

# source repo
SOURCEPATH=${1}

# output folder no trailing slashes
OUTPUT=${2}

# Version number
version=${3}

if [ -z "$SOURCEPATH" ]
then
      echo "No source folder given"
      exit 0
fi


if [ -z "$OUTPUT" ]
then
      echo "No output folder given"
      exit 0
fi

if [ -z "$version" ]
then
      echo "Version number not given"
      exit 0
fi

# tempoary file location
temp=$(mktemp -d -t ci-XXXXXXXXXX)

# get variables
path=${SOURCEPATH}
zpath=${temp}/wfexpenses
output=${OUTPUT}/
fname=wfexpenses${version}

cd ${path}
echo "Running grunt updating scripts"
npm test

echo "Creating temp project"
mkdir -p ${temp}
cp -R ${path} ${temp}/${fname}

cd "${temp}"

echo "Coping files to temp"

cp -f ${fname}/index-production.php ${fname}/index.php

rm -r ${fname}/assets/*
rm -r ${fname}/backup/*
rm -r ${fname}/temp/*
rm -r ${fname}/protected/config/*
rm -r ${fname}/protected/migrations/*
rm -r ${fname}/protected/runtime/*
rm -r ${fname}/protected/controllers/TestController.php # remove test controller

cd "${temp}" ..

echo "Creating archive"

tar --force-local -rf ${output}wfexpenses${version}.tar ${fname}/assets
tar --force-local -rf ${output}wfexpenses${version}.tar ${fname}/images ${fname}/protected ${fname}/public ${fname}/sql
tar --force-local -rf ${output}wfexpenses${version}.tar ${fname}/index.php ${fname}/.htaccess ${fname}/icon.ico
tar --force-local -rf ${output}wfexpenses${version}.tar ${fname}/backup ${fname}/temp
gzip -f ${output}wfexpenses${version}.tar

echo "Archive creation complete"
echo "Cleaning up assets"

rm -rf ${temp}/${fname}/
echo "All done... You can close this window."

