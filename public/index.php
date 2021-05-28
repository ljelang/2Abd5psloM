<?php
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

require __DIR__ . '/../vendor/autoload.php';

// Create App
$app = AppFactory::create();

// Create Twig
$twig = Twig::create(__DIR__ . '/../templates', ['cache' => __DIR__ . '/../cache']);

// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $twig));

// Define named route
$app->get('/hello/{name}', function ($request, $response, $args) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'view/profile.html', [
        'name' => $args['name']
    ]);
})->setName('profile');

$app->post('/send/mail', function() use ($app) {
	$postData = $app->request()->getBody();
	$entity = json_decode($entity, true);
})->setName('sendMail');


// Run app
$app->run();

