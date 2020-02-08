#!/usr/bin/env bash

tar -xvf /home/shady/Documents/websites/wfexpenses0.0.4.tar -C /home/shady/Documents/websites/
rsync -a /home/shady/Documents/websites/wfexpenses0.0.4/ /home/shady/Documents/websites/test
