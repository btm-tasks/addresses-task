# Installation
- run 
- ```docker-compose build && docker-compose up -d```
- then run
- ```docker exec -it addresses_task-php-1 bash```
- you can now run 
- to install the dependencies
  - ```composer install```
- to run all unit tests
  - ```php artisan test```
- to run application commands
  - get all geolocation points from address
  - ```php artisan app:geo-decode-addresses```
  - calculate distance between main branch and the other branches
  - ```php artisan app:calcualte-distance-and-generate-sorted-file```

# About Architecture
  - I used adapter design pattern to make it easy for me to use another geo-location providers
  - I used service design pattern to make it easy for me to introduce another interfaces like we can do the same login from admin panel, we'll only create controller that uses the same service
  - I like to make test coverage 100%
  - the csv files are saved and generate at the storage/csv_files directory
  - I prefer to work with types, So I created types directory 
