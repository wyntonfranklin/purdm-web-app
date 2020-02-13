#!/usr/bin/env bash

version=update-0.0.2

sh ./create_update.sh
tar -xvf /home/shady/Documents/websites/wfexpenses${version}.tar.gz -C /home/shady/Documents/websites/
rsync -a /home/shady/Documents/websites/wfexpenses${version}/ /home/shady/Documents/websites/test
