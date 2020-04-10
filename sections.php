<?php
declare(strict_types=1);

use ListTodo\Models\Connector;
use ListTodo\Controllers\Controller;
use ListTodo\Models\Deal;

include_once 'includes/include.php';
include_once 'functions.php';

$connector = (new Connector('fdb19.runhosting.com', '3371060_deals', 'Bnmjyt_06', '3371060_deals'))->getConnection();
$controller = new Controller($connector);

$query = 'SELECT * FROM sections';
$result = $connector->query($query);
foreach ($result as $resultItem) {
    $resultArray[$resultItem['id']] = [
        'id'    => $resultItem['id'],
        'pid'   => $resultItem['pid'] ?? 0,
        'name'   => $resultItem['name'],
    ];
}
pre($resultArray);

/**
 * Recursive building Section Tree
 *
 * @param int   $parentSectionId    parent section id
 * @param array $dataSections       array of sections data
 *
 * @return array
 */
function buildingTree(int $parentSectionId, array $dataSections) : array
{
    $answerData = [];
    foreach ($dataSections as $dataSectionItem) {
        $parentId  = (int) ($dataSectionItem['pid'] ?? 0);
        $sectionId = (int) ($dataSectionItem['id'] ?? 0);
        if ($parentId === $parentSectionId) {
            $answerData[] = [
                'ITEM'      => $dataSectionItem,
                'CHILD_SECTIONS'  => buildingTree($sectionId, $dataSections)
            ];
        }
    }
    return $answerData;
}

$answerArray = buildingTree(0, $resultArray);

pre($answerArray);