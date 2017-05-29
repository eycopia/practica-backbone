<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;
$config['db']['host']   = "localhost";
$config['db']['user']   = "user";
$config['db']['pass']   = "password";
$config['db']['dbname'] = "exampleapp";


$app = new \Slim\App(["settins" => $config]);
$container = $app->getContainer();
$container['view'] = new \Slim\Views\PhpRenderer("vistas/");



$app->get('/', function (Request $r, Response $rsp){
	$rsp = $this->view->render($rsp, "index.html");
});

$app->get('/toditito', function (Request $request, Response $response) {
    $response = $this->view->render($response, "toditito.html");
});

$app->get('/bookstore', function (Request $request, Response $response) {
    $response = $this->view->render($response, "books.html");
});

$app->get('/api/books', function (Request $request, Response $response) {
 	$b = new \App\Books();
 	return $response->withJson($b->all());
});

$app->get('/api/books/{id}', function (Request $request, Response $response, $args) {
    $response = $this->view->render($response, "books.html");
});
$app->post('/api/books', function (Request $request, Response $response) {
    $b = new \App\Books();
    // print_r($request);exit;
 	return $response->withJson($b->add($request->getParsedBody()));
});

$app->delete('/api/books/{id}', function (Request $request, Response $response, $args) {
    $b = new \App\Books();
 	return $response->withJson($b->delete($args['id']));
});

$app->run();