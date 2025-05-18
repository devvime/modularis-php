# Modularis PHP

PHP Micro Router Framework

### Configurations

```php
require dirname(__DIR__) . '/vendor/autoload.php';

use Modularis\Router;

$router = new Router();

// routes here

$router->dispatch();
```

### Create routes

Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS, HEAD

```php
# $router->get
# $router->post
# $router->put
# $router->delete
# $router->patch
# $router->options
# $router->head
$router->get('/', function ($request, $response) {
    $response->render('Hello world!');
});
```

### Route with class (Controller@method)

```php
$router->get('/', 'Modularis\Controller\UserController@show');
```

### Route with Middleware

```php
$router->get('/', function ($request, $response) {
    $response->render('Hello world!');
}, function($request, $response) {
    // middleware code
});
```

### Route with multiple middlewares

```php
$router->get('/', function ($request, $response) {
    $response->render('Hello world!');
}, [
    function($request, $response) {
        // middleware code
    },
    function($request, $response) {
        // middleware code
    }
]);
```

### Using classes (Class@Method)

```php
$router->get('/', function ($request, $response) {
    $response->render('Hello world!');
}, 'Modularis\Middleware\AuthMiddleware@verify');

# Using multiple middlewares

$router->get('/', function ($request, $response) {
    $response->render('Hello world!');
}, [
    'Modularis\Middleware\AuthMiddleware@verify',
    'Modularis\Middleware\AuthMiddleware@permissions'
]);

$router->get('/', 'Modularis\Controller\AuthController@index', [
    'Modularis\Middleware\AuthMiddleware@verify',
    'Modularis\Middleware\AuthMiddleware@permissions'
]);
```

### Route group

```php
$router->group('/user')->start()
    ->get('/', function ($request, $response) {
        // code ...
    })
    ->post('/', function ($request, $response) {
        // code ...
    });

# Using classes

$router->group('/user')->start()
    ->get('/', 'Modularis\Controller\UserController@index')
    ->post('/', 'Modularis\Controller\UserController@store');
    ->put('/', 'Modularis\Controller\UserController@update');
    ->delete('/', 'Modularis\Controller\UserController@destroy');
```

### Route group with middlewares

```php
$router->group('/user', function($request, $response) {
    // MIdlewares code ...
})->start()
    ->get('/', 'Modularis\Controller\UserController@index', function($request, $response) {
        // MIdlewares code ...
    })
    ->post('/', 'Modularis\Controller\UserController@store');
    ->put('/', 'Modularis\Controller\UserController@update'), [
        function($request, $response) {
            // MIdlewares code ...
        },
        function($request, $response) {
            // MIdlewares code ...
        }
    ];
    ->delete('/', 'Modularis\Controller\UserController@destroy');

# Using classes (Class@Method)

$router->group('/user', 'Modularis\Middleware\AuthMiddleware@verify')->start()
    ->get('/', 'Modularis\Controller\UserController@index', 'Modularis\Middleware\AuthMiddleware@permissions')
    ->post('/', 'Modularis\Controller\UserController@store');
    ->put('/', 'Modularis\Controller\UserController@update', [
        'Modularis\Middleware\AuthMiddleware@verify',
        'Modularis\Middleware\AuthMiddleware@permissions'
    ]);
    ->delete('/', 'Modularis\Controller\UserController@destroy');
```

# Route params

Param types ('/user/{id:int}/{name:string}/{token:uuid}')

```php
$router->get('/user/{id:int}', function ($request, $response) {
    $userId = $request->params['id'];

    print_r($request->params); // URL params
    print_r($request->body); // PHP Inputs $_POST ...
    print_r($request->query); // URL query params ?page=2&limit=10
    print_r($request->headers); // Request Headers

    $response->render('Hello World!'); // render text or HTML
        
    $response->json([
        'status'=>200,
        'message'=>'Success'
    ]); // render text or HTML
});

# Using class

$router->get('/user/{id:int}', 'Modularis\Controller\UserController@show');

class UserController {

    public function show($request, $response)
    {
        $userId = $request->params['id'];

        print_r($request->params); // URL params
        print_r($request->body); // PHP Inputs $_POST ...
        print_r($request->query); // URL query params ?page=2&limit=10
        print_r($request->headers); // Request Headers

        $response->render('Hello World!'); // render text or HTML

        $response->json([
            'status'=>200,
            'message'=>'Success'
        ]); // render text or HTML
    }

}
```

### Router start

call to dispatch function ```php $router->dispatch(); ```.

```php
require dirname(__DIR__) . '/vendor/autoload.php';

use Modularis\Router;

$router = new Router();

$router->group('/user')->start()
    ->get('/', 'Modularis\Controller\UserController@index')
    ->post('/', 'Modularis\Controller\UserController@store');
    ->put('/', 'Modularis\Controller\UserController@update');
    ->delete('/', 'Modularis\Controller\UserController@destroy');

$router->dispatch();
```