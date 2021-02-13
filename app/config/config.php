<?php
return array(
    "siteUrl" => "http://127.0.0.1:8090",
    "database" => [
        "type" => "mysql",
        "dbName" => "",
        "serverName" => "127.0.0.1",
        "port" => "3306",
        "user" => "root",
        "password" => "",
        "options" => [],
        "cache" => false
    ],
    "sessionName" => "pushNotifyFCMBackend",
    "namespaces" => [],
    "templateEngine" => 'Ubiquity\\views\\engine\\Twig',
    "templateEngineOptions" => array("cache" => false),
    "test" => true,
    "debug" => true,
    "logger" => function ()
    {
        return new \Ubiquity\log\libraries\UMonolog("pushNotifyFCMBackend", \Monolog\Logger::INFO);
    },
    "di" => ["@exec" => ["jquery" => function ($controller)
    {
        return \Ubiquity\core\Framework::diSemantic($controller);
    }]],
    "cache" => ["directory" => "cache/", "system" => "Ubiquity\\cache\\system\\ArrayCache", "params" => []],
    "mvcNS" => ["models" => "models", "controllers" => "controllers", "rest" => ""],
    "isRest" => function ()
    {
        return \Ubiquity\utils\http\URequest::getUrlParts()[0] === "rest";
    }
);
