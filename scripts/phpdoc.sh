#!/usr/bin/env bash
SCRIPT=$(readlink -f "${0}")
SCRIPT_PATH=$(dirname "${SCRIPT}")
REPOSITORY_PATH=$(dirname "${SCRIPT_PATH}")
DOC_PATH=$(readlink -f "${REPOSITORY_PATH}/../timetable-doc")
STRUCTURE_PATH="/tmp/phpdocmd"

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
rm -rf ${STRUCTURE_PATH}
mkdir ${STRUCTURE_PATH}
mkdir ${DOC_PATH}/markdown -p
./vendor/phpdocumentor/phpdocumentor/bin/phpdoc -d ${SCRIPT_PATH} -t ${STRUCTURE_PATH} --template="xml"
./vendor/evert/phpdoc-md/bin/phpdocmd ${STRUCTURE_PATH}/structure.xml ${DOC_PATH}/markdown
rm -rf ${STRUCTURE_PATH}

cd ${DOC_PATH}
echo ${PROJECT_COMMIT} > commit-based.txt
git add html
git add commit-based.txt
git add markdown
git commit -m "generating documentation for commit ${PROJECT_COMMIT}"
git push origin master

