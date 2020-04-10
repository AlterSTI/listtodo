<?php
declare(strict_types=1);



$answer = [
    'error' => '',
    'data'  => '',
];

$action = $_POST['ACTION'] ?? '';
$data   = json_decode($_POST['DATA']) ?? '';


switch ($action) {
    case 'addDeal':
        pre($data);
        break;
    case 'editDeal':
        pre($data);
        break;
    case 'deleteDeal':
        pre($data);
        break;
    case 'getList':
    default:
        pre($data);

}