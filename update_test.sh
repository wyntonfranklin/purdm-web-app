#!/usr/bin/env bash

version=0.0.6u

tar -xvf /home/shady/Documents/websites/wfexpenses${version}.tar.gz -C /home/shady/Documents/websites/
rsync -a /home/shady/Documents/websites/wfexpenses${version}/ /home/shady/Documents/websites/test
