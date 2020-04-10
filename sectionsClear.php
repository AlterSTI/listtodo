<?php
declare(strict_types=1);

$resultArray = [
   [
        'id' => 1,
        'pid' => 0,
        'name' => 'Автомобили',
   ],
   [
        'id' => 2,
        'pid' => 0,
        'name' => 'Самолеты',
   ],

    [
        'id' => 3,
        'pid' => 0,
        'name' => 'Телефоны',
    ],

    [
        'id' => 8,
        'pid' => 1,
        'name' => 'Грузовые',
    ],

    [
        'id' => 7,
        'pid' => 1,
        'name' => 'Легковые',
    ],

    [
        'id' => 9,
        'pid' => 2,
        'name' => 'Истребители',
    ],

    [
        'id' => 10,
        'pid' => 2,
        'name' => 'Штурмовики',
    ],

    [
        'id' => 11,
        'pid' => 2,
        'name' => 'Бомбардировщики',
    ],

    [
        'id' => 12,
        'pid' => 2,
        'name' => 'Разведчики',
    ],

    [
        'id' => 13,
        'pid' => 3,
        'name' => 'Мобильные',
    ],

    [
        'id' => 14,
        'pid' => 3,
        'name' => 'Стационарные',
    ],

    [
        'id' => 15,
        'pid' => 8,
        'name' => 'Iveco',
    ],

    [
        'id' => 16,
        'pid' => 8,
        'name' => 'Man',
    ],

    [
        'id' => 17,
        'pid' => 7,
        'name' => 'Daewoo',
    ],

    [
        'id' => 18,
        'pid' => 7,
        'name' => 'Opel',
    ],

    [
        'id' => 19,
        'pid' => 7,
        'name' => 'Audi',
    ],

    [
        'id' => 20,
        'pid' => 9,
        'name' => 'Як1',
    ],

    [
        'id' => 21,
        'pid' => 9,
        'name' => 'Як9',
    ],

    [
        'id' => 22,
        'pid' => 10,
        'name' => 'Ил-2',
    ],

    [
        'id' => 23,
        'pid' => 10,
        'name' => 'Ил-4',
    ],

    [
        'id' => 24,
        'pid' => 11,
        'name' => 'ТБ-3',
    ],

    [
        'id' => 25,
        'pid' => 11,
        'name' => 'Пе-2',
    ],

    [
        'id' => 26,
        'pid' => 17,
        'name' => 'Lanos',
    ],

    [
        'id' => 27,
        'pid' => 17,
        'name' => 'Sens',
    ],

    [
        'id' => 28,
        'pid' => 26,
        'name' => 1.5,
    ],

    [
        'id' => 29,
        'pid' => 26,
        'name' => 1.6,
    ],
];

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
/**
 * Print beautiful data on display
 * @param mixed $array
 *
 * @return void
 */
function pre($array) : void
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
    return;
}

$answerArray = buildingTree(0, $resultArray);

pre($answerArray);