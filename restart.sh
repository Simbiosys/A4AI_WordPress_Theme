#!/bin/bash

echo $PWD

mypath=$PWD
res=''
mypath=${mypath/renderization\/views/$res}
mypath=${mypath/'renderization'/$res}

echo $mypath

rm -rf renderization/data/api/*.json
rm -rf renderization/data/data/initial.json
rm -rf renderization/dashboard/data/tables.json
rm -rf renderization/dashboard/compiled-views/*.php

php $mypath/renderization/starter.php