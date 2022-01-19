#!/bin/bash
# run the web and PHP servers
docker exec -u root Sti_project service nginx start
docker exec -u root Sti_project service php5-fpm start
