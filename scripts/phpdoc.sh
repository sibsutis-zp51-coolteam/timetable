#!/usr/bin/env bash
SCRIPT=$(readlink -f "${0}")
SCRIPT_PATH=$(dirname "${SCRIPT}")
REPOSITORY_PATH=$(dirname "${SCRIPT_PATH}")
DOC_PATH=$(readlink -f "${REPOSITORY_PATH}/../timetable-doc")

cd ${DOC_PATH}
git checkout master
git pull --rebase
DOC_COMMIT=`cat commit-based.txt`

cd ${REPOSITORY_PATH}
git status
git checkout master
git pull --rebase

PROJECT_COMMIT=`git log --oneline | head -n 1`

if [ "${DOC_COMMIT}" == "${PROJECT_COMMIT}" ]
then
    echo "commits are equals, exit"
    exit
fi

echo "generating commit"

./vendor/phpdocumentor/phpdocumentor/bin/phpdoc -d ${SCRIPT_PATH} -t ${DOC_PATH}/html

cd ${DOC_PATH}
echo ${PROJECT_COMMIT} > commit-based.txt
git add html
git add commit-based.txt
git commit -m "incremental autodocumentation commit $(date)"
git push origin master

