<?php

header('Access-Control-Allow-Origin');

$args = array('child_of' => 2);
$categories = get_categories( $args );
var_dump($categories);

// function getCategory(){
//     $args = array('child_of' => 2);
//     $categories = get_categories( $args );
//     return $categories;
// }