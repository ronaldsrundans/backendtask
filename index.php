<?php

declare(strict_types=1);

require_once("requires.php");

switch (getRequestParam("command")) {
    case "cardlist":
        $repo = new \cards\DatabaseRepository();
        $response = new \response\RequestResponseJson();
        $controller = new \cards\Controller($repo, $response);
        $controller->cardList();
        break;
    case "cardcreate":
        $repo = new \cards\DatabaseRepository();
        $response = new \response\RequestResponseJson();
        $controller = new \cards\Controller($repo, $response);
        $controller->cardCreate();
        break;
    case "cardupdate":
        $repo = new \cards\DatabaseRepository();
        $response = new \response\RequestResponseJson();
        $controller = new \cards\Controller($repo, $response);
        $controller->cardUpdate();
        break;
    case "carddelete":
        $repo = new \cards\DatabaseRepository();
        $response = new \response\RequestResponseJson();
        $controller = new \cards\Controller($repo, $response);
        $controller->cardDelete();
        break;
    default :
        echo "Nothing to do";
        break;
}

function getRequestParam($paramName){
    $paramValue = $_GET[$paramName] ?? null;
    if (!$paramValue) {
        $paramValue = $_POST[$paramName] ?? null;
    }

    return $paramValue;
}
