app
===

A Symfony project created on November 7, 2017, 3:33 pm.

Clone project from repo.

Navigate terminal to docker folder("cd docker")

Create .env file("cp .env.dist .env") and change parameters in.env file

Build containers("docker-compose build") 

Turn on containers("docker-compose up -d")

Go to PHP machine as root user (docker-compose exec --user root php bash)

Open bash in php container("docker-compose exec php bash")

Change permissions("/etc/init.d/symfony3_permission.sh")

Change ownership("chown -R app:app .")

*on php machine("docker-compose exec php bash")
Install composer dependency ("composer install").

Create uploads dir and add permission ("mkdir web/uploads", "mkdir web/uploads/media", "chmod -R 0777 web/uploads").

Configure db settings if you are not or you did it incorrect in composer part ("app/config/parameters.yml")

Create database schema ("sf3 doctrine:schema:update --force")

Setup permission over var directory on server ("/etc/init.d/symfony3_permission.sh")

Create admin user ("sf3 fos:user:create admin --super-admin")

Clear cache("sf3 cache:clear --env=prod && sf3 cache:clear --env=dev")

Navigate to http://localhost/app_dev.php/ for development env

Navigate to http://localhost/ for production env

To access phpmyadmin navigate to http://localhost:8080/ (use username and password from mysql in .env file)
