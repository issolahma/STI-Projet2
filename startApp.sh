#! /bin/bash

if [ "$(docker ps -q -f name=Sti_project)" ]; then
  echo "delete old container..."
  docker kill Sti_project
  docker rm Sti_project
fi


# pull and run a container named "Sti_project"
echo "docker run..."
docker run -ti -v "/$PWD/site":/usr/share/nginx/ -d -p 8080:80 --name Sti_project --hostname sti arubinst/sti:project2018

# change database perms
echo "change db perms..."
docker exec -u root Sti_project chown -R www-data:www-data /usr/share/nginx/databases
#docker exec -u root Sti_project usermod -a -G www-data labo

# run the web and PHP servers
echo "start services..."
docker exec -u root Sti_project service nginx start
docker exec -u root Sti_project service php5-fpm start