<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
 $app->group('/api', function () use ($app) {
	 
/*
$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});


});
*/
$app->post('/checkBalance','\App\src\Controller\BalanceController:checkBalance');  // SAFARICOM C2B APIS
$app->post('/faibaRecharge','\App\src\Controller\AccountController:purchaseAirtime');  // SAFARICOM C2B APIS
$app->post('/queryStatus','\App\src\Controller\QueryStatusController:QueryPaymentStatus');  // SAFARICOM C2B APIS
$app->post('/createAccount','\App\src\Controller\ProfileController:createAccount'); //B2C RESULTS API
$app->post('/validateOTP','\App\src\Controller\ProfileController:validateOTP'); //B2C RESULTS API
//END OF SAFARICOM APIS
});
//	END OF ALL APIS
