<?php
return array ("/route/test/(index/)?" => array ("controller" => "controllers\\TestControllerWithControl","action" => "index","parameters" => [ ],"name" => "test-route-index" ),"/route/test/ctrl/" => array ("controller" => "controllers\\TestControllerWithControl","action" => "actionWithControl","parameters" => [ ],"name" => "test-route-ctrl" ),
		"/route/test/params/(.+?)/(.*?)" => array ("controller" => "controllers\\TestControllerWithControl","action" => "withParams","parameters" => array (false,"~1" ),"name" => "test-route-params","cache" => false,"duration" => false ) );
