# Modularis PHP

**A Minimal and Expressive PHP Micro Routing Framework**

## Getting Started

```php
require dirname(__DIR__) . '/vendor/autoload.php';

use Modularis\Router;

$router = new Router();

// Define your routes here

$router->dispatch();
```

---

## Defining Routes

Supported HTTP methods: `GET`, `POST`, `PUT`, `DELETE`, `PATCH`, `OPTIONS`, `HEAD`

```php
$router->get('/', function ($request, $response) {
    $response->render('Hello World!');
});
```

---

## Route with Controller Method

```php
$router->get('/', 'Modularis\Controller\UserController@show');
```

---

## Route with Middleware

```php
$router->get('/', function ($request, $response) {
    $response->render('Hello World!');
}, function ($request, $response) {
    // Middleware logic
});
```

---

## Route with Multiple Middlewares

```php
$router->get('/', function ($request, $response) {
    $response->render('Hello World!');
}, [
    function ($request, $response) {
        // First middleware logic
    },
    function ($request, $response) {
        // Second middleware logic
    }
]);
```

---

## Middleware Classes

```php
$router->get('/', function ($request, $response) {
    $response->render('Hello World!');
}, 'Modularis\Middleware\AuthMiddleware@verify');

$router->get('/', function ($request, $response) {
    $response->render('Hello World!');
}, [
    'Modularis\Middleware\AuthMiddleware@verify',
    'Modularis\Middleware\AuthMiddleware@permissions'
]);

$router->get('/', 'Modularis\Controller\AuthController@index', [
    'Modularis\Middleware\AuthMiddleware@verify',
    'Modularis\Middleware\AuthMiddleware@permissions'
]);
```

---

## Route Groups

### Basic Group

```php
$router->group('/user')->start()
    ->get('/', function ($request, $response) {
        // GET logic
    })
    ->post('/', function ($request, $response) {
        // POST logic
    })
    ->put('/', function ($request, $response) {
        // PUT logic
    })
    ->delete('/', function ($request, $response) {
        // DELETE logic
    });
```

### With Controllers

```php
$router->group('/user')->start()
    ->get('/', 'Modularis\Controller\UserController@index')
    ->post('/', 'Modularis\Controller\UserController@store')
    ->put('/', 'Modularis\Controller\UserController@update')
    ->delete('/', 'Modularis\Controller\UserController@destroy');
```

---

## Route Group with Middleware

### Anonymous Middleware

```php
$router->group('/user', function ($request, $response) {
    // Group-level middleware logic
})->start()
    ->get('/', 'Modularis\Controller\UserController@index', function ($request, $response) {
        // Route-level middleware logic
    })
    ->post('/', 'Modularis\Controller\UserController@store')
    ->put('/', 'Modularis\Controller\UserController@update', [
        function ($request, $response) {
            // First middleware logic
        },
        function ($request, $response) {
            // Second middleware logic
        }
    ])
    ->delete('/', 'Modularis\Controller\UserController@destroy');
```

### Using Middleware Classes

```php
$router->group('/user', 'Modularis\Middleware\AuthMiddleware@verify')->start()
    ->get('/', 'Modularis\Controller\UserController@index', 'Modularis\Middleware\AuthMiddleware@permissions')
    ->post('/', 'Modularis\Controller\UserController@store')
    ->put('/', 'Modularis\Controller\UserController@update', [
        'Modularis\Middleware\AuthMiddleware@verify',
        'Modularis\Middleware\AuthMiddleware@permissions'
    ])
    ->delete('/', 'Modularis\Controller\UserController@destroy');
```

---

## Route Parameters

Typed parameters syntax: `/user/{id:int}/{name:string}/{token:uuid}`

```php
$router->get('/user/{id:int}', function ($request, $response) {
    $userId = $request->params['id'];

    print_r($request->params);  // URL parameters
    print_r($request->body);    // POST data
    print_r($request->query);   // GET query parameters
    print_r($request->headers); // HTTP headers

    $response->render('Hello World!');

    $response->json([
        'status' => 200,
        'message' => 'Success'
    ]);
});
```

### Using a Controller

```php
$router->get('/user/{id:int}', 'Modularis\Controller\UserController@show');

namespace Modularis\Controller;

class UserController
{
    public function show($request, $response)
    {
        $userId = $request->params['id'];

        print_r($request->params);
        print_r($request->body);
        print_r($request->query);
        print_r($request->headers);

        $response->render('Hello World!');

        $response->json([
            'status' => 200,
            'message' => 'Success'
        ]);
    }
}
```

---

## Router Execution

```php
require dirname(__DIR__) . '/vendor/autoload.php';

use Modularis\Router;

$router = new Router();

$router->group('/user')->start()
    ->get('/', 'Modularis\Controller\UserController@index')
    ->post('/', 'Modularis\Controller\UserController@store')
    ->put('/', 'Modularis\Controller\UserController@update')
    ->delete('/', 'Modularis\Controller\UserController@destroy');

$router->dispatch();
```
