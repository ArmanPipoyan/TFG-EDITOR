# TFG- Aula de programació interactiva

One of the biggest problems teachers face in programming is supervising students when it comes to making problems and developing code in class. These make it difficult to receive feedback directly, as there are no tools by which a teacher can help students in the class without exposing themselves or wasting time going table by table. Furthermore, this problem has been exacerbated due to the health crisis, as the need to have a tool to solve this problem. So, we decided to create an interactive programming, classroom where the teacher will be able to post problems and students will be able to solve them. The innovation in this project is that at all times the teacher can see in a list the code developed by students and access and modify them, thus providing real-time feedback from the comfort of your computer.

# Table of Contents
   * [What is this?](#1)
   * [Requeriments](#R)
   * [Description](#2)
   * [Authors](#6)
   
# What is this? <a name="1"></a>

# Requeriments <a name="R"></a>
For running each sample code:

- <a href="https://www.python.org/downloads/">Python 3</a>
- An IDE such as Visual Studio Code or PHPStorm
- Apache, PHP 8.1.3 and Mysql stack
- Composer
- G++
- Python
- Docker

## INSTALLATION GUIDE:
1. <a href="https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-20-04-es">Install Apache, PHP and Mysql (The project name should be tfg)</a>
2. Run 'composer update' to install all the dependencies.
3. Set the mysql password in the file Model/connection.php
4. Load the content of "webtfg.sql" to a DB named webtfg.
5. Create a Github OAuth App with repo premissions and set the variables in githubApiToken.json.
6. Clone this repo to /var/www/tfg/
7. Install Python 3
8. Install G++
9. Install Docker
10. Start working in localhost

# Description <a name="2"></a>

- In the directory Documentation we have all the documentation needed for the TFG dossier.
- The project has been developed using the MVC design pattern, thus we have three directories named Model, View and Controller to differ the layers.
- In the directory app all the problems and solutions of these problems are stored. Moreover, we have that is used to do the online compilation/interpretation of the code written by the students.
- In the directory jupyter we have the scripts, for Windows and Unix, to run and stop docker containers that contain Jupyter servers.
- composer.json and composer.lock is the file where all the dependencies of PHP are stored.
- githubApiToken.json is where the secrect keys of the Github OAuth Auth keys are stored and read when necessary.
- webtfg.sql is the DB dump that contains Unix paths and will not work on Windows.
- webtfg_win.sql is the opposite of the webtfg.sql, it only works for Windows.

# Authors <a name="6"></a>
- Youssef Assbaghi 1493477 UAB
- Arman Pipoyan Paronyan 1530274 UAB
