---
  title: Rest Server
  subtitle: How to create a simple php server and contact it through Triangular
  layout: docs.hbs
---

# Creating the Server
We will use the popular [Slim](http://www.slimframework.com/) php framework to set up a simple server. The server will allow cross-origin requests, in order to allow our app to contact it even if they reside on different domains.

- Create a folder named api at the root of your web server directory in your localhost.
- Download the slim framework from [here](https://github.com/slimphp/Slim/releases) in zip format. At the time of writing this guide, the current framework version is 2.6.2.
- Extract the downloaded archive and copy the folder named Slim that you will find, inside your api folder that you created in step 1.
- Create two files inside your api folder: index.php and .htaccess
- Paste the following in the index.php :
		<?php
		require 'Slim/Slim.php';

		 \Slim\Slim::registerAutoloader();

		$app = new \Slim\Slim();
		
		$app->map('/', function() use($app) {
			$response = $app->response();    

		    $response->header('Access-Control-Allow-Origin', '*');
		    $response->header('Access-Control-Allow-Methods', 'GET, POST , OPTIONS');
		    $response->header('Access-Control-Allow-Headers', 'Cache-Control, Pragma, accept, x-requested-with, origin, content-type, x-xsrf-token');

		    $data = array('Harris' => 'programmer', 'Chris' => 'CEO');
		    echo json_encode($data);
		})->via('GET', 'POST'); 

		$app->run();

- Paste the following in the .htaccess file :
		RewriteEngine On
		RewriteCond %{REQUEST_FILENAME} !-f
		RewriteRule ^ index.php [QSA,L]

# Testing the Server
If you did everything right, you should see the following when you visit localhost/api in your browser :

	{"Harris":"programmer","Chris":"CEO"}

This is hardcoded sample data in json format that the endpoint returns once you visit the above url. In a production environment you will ofcourse want this data to be fetched from a database that your server will connect to.

If you have curl installed, you can also try this:

	curl -i http://127.0.0.1/api/

which will render something like the following :

	HTTP/1.1 200 OK
	Server: nginx/1.6.3
	Date: Tue, 07 Jul 2015 11:24:41 GMT
	Content-Type: text/html
	Transfer-Encoding: chunked
	Connection: keep-alive
	X-Powered-By: PHP/5.5.11
	Access-Control-Allow-Origin: *
	Access-Control-Allow-Methods: GET, POST
	Access-Control-Allow-Headers: accept, origin, content-type

	{"Harris":"programmer","Chris":"CEO"}

# Contacting the Server through Angular
Having confirmed that our simple test server is up and running, and is allowing CORS, all we have to do is use the angular $http service to contact it. In any controller inject the $http service and do the following:

	var req = {
        method: 'POST',
        url: 'http://localhost/api/',
        headers: {
           'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
        },
        data: { test: 'test' }
    }
    $http(req).success(function(res){console.log(res)}).error(function(err){console.log(err)});

If you have your browser console open you will see the response data rendered there once the endpoint responds. Changing the method to GET will make the service fire a GET request instead.

# Further information
For more information regarding slim, and guides on how to set up multiple routes in your server you can read the readme in the Slim github repository [here](https://github.com/codeguy/Slim).