<?php

declare(strict_types=1);

require_once("requires.php");

switch (getRequestParam("command")) {
    case "productlist":
        $repo = new \products\DatabaseRepository();
        $response = new \response\RequestResponseJson();
        $controller = new \products\Controller($repo, $response);
        $controller->productList();
        break;
    case "productcreate":
        $repo = new \products\DatabaseRepository();
        $response = new \response\RequestResponseJson();
        $controller = new \products\Controller($repo, $response);
        $controller->productCreate();
        break;
    case "productupdate":
        $repo = new \products\DatabaseRepository();
        $response = new \response\RequestResponseJson();
        $controller = new \products\Controller($repo, $response);
        $controller->productUpdate();
        break;
    case "productdelete":
        $repo = new \products\DatabaseRepository();
        $response = new \response\RequestResponseJson();
        $controller = new \products\Controller($repo, $response);
        $controller->productDelete();
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
