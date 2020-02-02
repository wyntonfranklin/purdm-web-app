#!/usr/bin/env bash

# Change these variables for your application
temp=~/.temp
path=~/Documents/websites/wfexpenses
zpath=~/.temp/wfexpenses
output=~/Documents/websites/

mkdir -p ${temp}
cp -R ${path} ${temp}

cd ${temp}
cp -f wfexpenses/index-production.php wfexpenses/index.php
cp -f wfexpenses/protected/config/main-install.php wfexpenses/protected/config/main.php
rm -r wfexpenses/assets/*

cd ${temp} ..
zip -r ${output}wfexpense-dist.zip wfexpenses/assets wfexpenses/images wfexpenses/protected wfexpenses/public wfexpenses/screenshots wfexpenses/sql  wfexpenses/yii wfexpenses/index.php wfexpenses/README.md wfexpenses/.htaccess wfexpenses/icon.ico

rm -r ${zpath}

