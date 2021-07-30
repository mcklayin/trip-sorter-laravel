## Trip service

### Requirements:
 -  docker
 -  sail
 

#### Installation:
 

 - `composer install` in CLI

OR

  - `docker run --rm \
         -u "$(id -u):$(id -g)" \
         -v $(pwd):/opt \
         -w /opt \
         laravelsail/php80-composer:latest \
         composer install --ignore-platform-reqs` in CLI


##### How to run:

Start Docker containers:

`sail up` or `sail up -d` or `./vendor/bin/sail up` in CLI


--- 
To get trip data with dummy data do:

`sail artisan trip:build` in CLI


##### TO DO:
 - [ ] API Controller to get trip with list of boardings
 - [ ] Input validation
 - [ ] Cover with tests  
