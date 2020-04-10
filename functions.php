<?php
function pre($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
    return;
}
function _pre($array){
    echo '<pre>';
    var_dump($array);
    echo '</pre>';
    return;
}
