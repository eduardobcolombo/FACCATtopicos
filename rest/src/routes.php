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

$app->get('/api/v1/municipios', function (Request $request, Response $response) {
    $cities = [
        ['id'=>1,'city'=>'Canela','state'=>'RS'],
        ['id'=>2,'city'=>'Gramado','state'=>'RS'],
        ['id'=>3,'city'=>'Taquara','state'=>'RS'],
    ];
    $states = [
        ['id'=>1, 'state'=>'RS'],
        ['id'=>2, 'state'=>'SC'],
    ];

    $response->getBody()->write(json_encode($cities));

    return $response;
});
