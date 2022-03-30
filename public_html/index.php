<?php

include '../App/Services/PokemonService.php';

if ($_GET['url']) {
    $url = explode('/', $_GET['url']);

    if ($url[0] === 'api') {
        $service = 'App\Services\\' . ucfirst($url[1]) . 'Service';

        $method = strtolower($_SERVER['REQUEST_METHOD']);

        try {
            $response = call_user_func_array(array(new $service, $method), [$url[2]]);

            // var_dump($response);
            http_response_code(200);
            echo json_encode(array('status' => 'sucess', 'data' => $response));
            exit;
        } catch (\Exception $e) {
            http_response_code(404);
            echo json_encode(array('status' => 'error', 'data' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
}
