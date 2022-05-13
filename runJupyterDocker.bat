@echo off
set user=%1
docker run -d -it --rm -p 8888:8888 -e DOCKER_STACKS_JUPYTER_CMD=nbclassic -v D:\xampp\htdocs\app\solucions\%user%:/home/ -e NB_USER="%user%" -e CHOWN_HOME=yes -w "/home/${NB_USER}" jupyter/base-notebook start-notebook.sh --NotebookApp.token=""