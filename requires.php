<?php

require_once("core/database/Database.php");
require_once("Configuration.php");

require_once("products/controller/Controller.php");

require_once("products/model/Product.php");
require_once("products/model/ProductDto.php");

require_once("products/repository/InMemoryRepository.php");
require_once("products/repository/DatabaseRepository.php");
require_once("products/repository/ProductRepository.php");

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
