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
use Modularis\Controller\UserController;

$router->get('/', UserController::class .  '@show');
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
use Modularis\Middleware\AuthMiddleware;
use Modularis\Controller\AuthController;

$router->get('/', function ($request, $response) {
    $response->render('Hello World!');
}, AuthMiddleware::class . '@verify');

$router->get('/', function ($request, $response) {
    $response->render('Hello World!');
}, [
    AuthMiddleware::class . '@verify',
    AuthMiddleware::class . '@permissions'
]);

$router->get('/', AuthController::class . '@index', [
    AuthMiddleware::class . '@verify',
    AuthMiddleware::class . '@permissions'
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
use Modularis\Controller\UserController;

$router->group('/user')->start()
    ->get('/', UserController::class . '@index')
    ->post('/', UserController::class . '@store')
    ->put('/', UserController::class . '@update')
    ->delete('/', UserController::class . '@destroy');
```

---

## Route Group with Middleware

### Anonymous Middleware

```php
use Modularis\Controller\UserController;

$router->group('/user', function ($request, $response) {
    // Group-level middleware logic
})->start()
    ->get('/', UserController::class . '@index', function ($request, $response) {
        // Route-level middleware logic
    })
    ->post('/', UserController::class . '@store')
    ->put('/', UserController::class . '@update', [
        function ($request, $response) {
            // First middleware logic
        },
        function ($request, $response) {
            // Second middleware logic
        }
    ])
    ->delete('/', UserController::class . '@destroy');
```

### Using Middleware Classes

```php
use Modularis\Controller\UserController;
use Modularis\Middleware\AuthMiddleware;

$router->group('/user', AuthMiddleware::class . '@verify')->start()
    ->get('/', UserController::class . '@index', AuthMiddleware::class . '@permissions')
    ->post('/', UserController::class . '@store')
    ->put('/', UserController::class . '@update', [
        AuthMiddleware::class . '@verify',
        AuthMiddleware::class . '@permissions'
    ])
    ->delete('/', UserController::class . '@destroy');
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
//=========================================

use Modularis\Controller\UserController;

$router->get('/user/{id:int}', UserController::class . '@show');
```

---

## Router Execution

```php
require dirname(__DIR__) . '/vendor/autoload.php';

use Modularis\Router;
use Modularis\Controller\UserController;

$router = new Router();

$router->group('/user')->start()
    ->get('/', UserController::class . '@index')
    ->post('/', UserController::class . '@store')
    ->put('/', UserController::class . '@update')
    ->delete('/', UserController::class . '@destroy');

$router->dispatch();
```
