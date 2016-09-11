#!/bin/bash
deployDir=$1
gitFullName=$2
gitName=$3

gitClone="/root/.gitbucket/repositories/$gitFullName.git"
gitDeployPath="$deployDir/$gitName"

if [ ! -d $gitDeployPath ]
then
        cd $deployDir
        git clone -b release-3.0 ssh://root@127.0.0.1:/$gitClone
fi
cd $gitDeployPath
git fetch --all
git reset --hard origin/release-3.0
#cd "$deployDir/yii2-cmf-api"
#git fetch --all
#git reset --hard origin/develop

