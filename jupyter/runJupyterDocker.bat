@echo off

set user=%1
set port=%2

docker run -d -it --rm -p %port%:8888 -e DOCKER_STACKS_JUPYTER_CMD=nbclassic --mount type=bind,source=D:\xampp\htdocs\app\solucions\%user%,target=/home/solutions --mount type=bind,source=D:\xampp\htdocs\jupyter\.jupyter,target=/home/jovyan/.jupyter,readonly -e NB_USER="jovyan" -e CHOWN_HOME=yes -w "/home/solutions/" jupyter/base-notebook start-notebook.sh --NotebookApp.token=""