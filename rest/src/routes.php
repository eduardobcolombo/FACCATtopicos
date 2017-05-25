<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
// Routes

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->group('/api', function () use($app){
    $app->group('/v1', function () use($app){
        $app->get('/municipios', function (Request $request, Response $response) {

            $mapper = new CityMapper($this->db);
            $cities = $mapper->getCities();
            $response->getBody()->write(json_encode($cities));

            return $response;
        });

    });
});
