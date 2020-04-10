<?php
declare(strict_types=1);

use ListTodo\Models\Connector;
use ListTodo\Controllers\Controller;
use ListTodo\Models\Deal;

define('START_WITH_INDEX', 1);

include_once 'includes/include.php';
include_once 'functions.php';

$connector = (new Connector('fdb19.runhosting.com', '3371060_deals', 'Bnmjyt_06', '3371060_deals'))->getConnection();
$controller = new Controller($connector);
$start = new DateTime('first day of this month 00:00:00');
$finish = new DateTime('last day of this month 23:59:59');

$arResult = $controller->getList($start, $finish);
//pre($result);

//$result = $controller->getDealById(4);
//pre($result);
//$deal = new Deal(3, new DateTime('2020-03-20'), 'Хрен знает что');
//$newId = $controller->saveDeal($deal);
//pre($newId);
//pre($controller->getDealById($newId));
include_once 'templates/template.php';
