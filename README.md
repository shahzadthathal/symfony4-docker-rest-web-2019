# Smyfony 4 with docker and Rest + Web 2019

## Quick Start

``` bash
#Git clone:
git clone https://github.com/shahzadthathal/symfony4-docker-rest-web-2019.git

#Change dir
cd symfony4-docker-rest-web-2019/

#Add an entry to /etc/hosts
127.0.1.1 sf4.local

#Dcoker build
docker-compose build

#Docker up
docker-compose up -d

#If you are on Ubuntu then change .docker/data dir owner with your www user group or give data folder write permission.
sudo chown shahzad:shahzad -R .docker/data/

#Launch php bash
docker exec -it -u dev sf4_2019_php bash

#Change directory
cd sf4

#Install dependencies
composer install


#Copy .env.dist to .env and update this connection url
DATABASE_URL=mysql://sf4:sf4@mysql:3306/sf4


#Make migrations
php bin/console make:migration

#Run migrations
php bin/console doctrine:migrations:migrate

#Add some fixture data
php bin/console doctrine:fixtures:load

#If everything went okay:
http://sf4.local/login
Admin login:
admin@app.com
123456

#API endpoints
Add content, post a josn data and also add a dummy token in header:
Url: http://sf4.local/api/content
Header: x-auth-token : xyz
Body:
{
  "title":"My title",
  "description":"My description",
  "content":"My content",
  "email":"xyz@app.com"
}

#Get contents:
http://sf4.local/api/contents
Header: x-auth-token : xyz

#Get single content:
http://sf4.local/api/content/3
Header: x-auth-token : xyz

#If you want to use mysql:
docker exec -it sf4_2019_mysql bash
mysql -uroot -proot

#PHP Unit Tests
phpunit
```