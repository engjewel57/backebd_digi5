protected $routeMiddleware = [
    // ... existing middleware
    'admin' => \App\Http\Middleware\AdminMiddleware::class,
    'client' => \App\Http\Middleware\ClientMiddleware::class,
];