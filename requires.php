<?php

require_once("core/database/Database.php");
require_once("Configuration.php");

require_once("cards/controller/Controller.php");


require_once("cards/model/Card.php");
require_once("cards/model/CardDto.php");

require_once("cards/repository/InMemoryRepository.php");
require_once("cards/repository/DatabaseRepository.php");
require_once("cards/repository/CardRepository.php");

require_once("core/request/Request.php");

require_once("core/response/RequestResponse.php");
require_once("core/response/RequestResponseJson.php");
require_once("core/response/RequestResponseXml.php");

require_once("core/validation/Validator.php");
require_once("core/validation/NumberValidator.php");
require_once("core/validation/CountValidator.php");
require_once("core/validation/StringValidator.php");
require_once("core/validation/SkuValidator.php");
require_once("core/validation/ErrorMessage.php");
