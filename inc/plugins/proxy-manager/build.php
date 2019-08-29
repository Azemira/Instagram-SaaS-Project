<?php
define("APP_VERSION", null);
require_once "libs/ZipArchive.php";

$config = require("config.php");

$zipFile = "out/{$config['idname']}-{$config['version']}.zip";
Zip(__DIR__, $zipFile);