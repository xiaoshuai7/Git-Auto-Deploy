#!/usr/bin/env php
<?php
$config = require("config.php");
$php    = $_SERVER['_'];
$host   = $config['host'];
$port   = $config['http-port'];
$path   = __DIR__ . '/';
exec("{$php} -S {$host}:{$port} -t {$path}/");