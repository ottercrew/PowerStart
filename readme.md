# Otter Crew PowerStart


## Requirements

* PHP >= 5.5
* Composer - [Install](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)
* NodeJs and NPM [Install](https://nodejs.org/en/download/)

## Installation
Clone the Repo

		git clone git@bitbucket.org:temprepos/wordpress-workflow.git

Copy .env.example to .env and update all the variables

		THEME_NAME=theme_name

		DB_NAME=database_name
		DB_USER=database_user
		DB_PASSWORD=database_password
		DB_HOST=database_host

		WP_ENV=dev
		WP_HOME=http://example.com
		WP_SITEURL=http://example.com/wordpress

		# Generate your keys here: https://api.wordpress.org/secret-key/1.1/salt/
		AUTH_KEY=generateme
		SECURE_AUTH_KEY=generateme
		LOGGED_IN_KEY=generateme
		NONCE_KEY=generateme
		AUTH_SALT=generateme
		SECURE_AUTH_SALT=generateme
		LOGGED_IN_SALT=generateme
		NONCE_SALT=generateme

Install all PHP Dependecies

        composer install

Install all Node modules

        npm install

Install Wordpress by using WP-CLI

		vendor/bin/wp core install --url="your_domain_name"  --title="Your Blog Title" --admin_user="admin" --admin_password="your_password" --admin_email="your_email" --path="absoute_path_to_wordpress_folder"

Start Gulp

        gulp

You should have your installation running on http://localhost:3000 and WP Admin on http://localhost:3000/wordpress/wp-admin

Tasks
===========
1.gulp                  //executes only one time styles, scripts and images tasks
2.gulp watch	        //keep watching all the scss and js files and execute styles and scripts
3.gulp styles 	        //manipulates scss
4.gulp scripts	        //mainpulates js
5.gulp images	        //minify images
6.gulp clean            //delete all the files inside js and css folder   

7.gulp production --yes //will minify all css and js and remove source map

