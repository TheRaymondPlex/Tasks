<?php

require_once "config/config.php";

require_once "config/db.php";
require_once "config/route.php";
require_once MODEL_PATH . 'Model.php';
require_once VIEW_PATH . 'View.php';
require_once CONTROLLER_PATH . 'Controller.php';

Routing::buildRoute();