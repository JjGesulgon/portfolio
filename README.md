## Table of contents
* [General info](#general-info)
* [Technologies](#technologies)
* [Setup](#setup)

## General info
This is a custom-made website with CMS capabilities. This project can handle 2 domains. One for the Main Website, the other is for its CMS. 
	
## Technologies
Project is created with:
* Laravel 6
* Vue.js
	
## Setup
To run this project, follow the steps below:

```
$ cd portfolio
$ cp .env.example .env
$ composer install 
$ php artisan storage:link
$ php artisan passport:keys
$ php artisan key:generate
$ php artisan passport:install
$ npm install *
$ npm run watch
```
