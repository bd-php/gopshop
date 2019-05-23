<?php

$input = file_get_contents('php://input');
//var_dump($input);

$entityBody = json_decode($entityBody, true);
//var_dump($entityBody);

$res = [];

if (isset($entityBody['choose_category'])) {
    $res['choose_category_en'] = urlencode($entityBody['choose_category']);
}

if (isset($entityBody['choose_subcat'])) {
    $res['choose_subcat_en'] = urlencode($entityBody['choose_subcat']);
}

echo json_encode($res);

?>