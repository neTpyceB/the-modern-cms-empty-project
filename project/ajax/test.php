<?php
// This content is visible when requesting /-/ajax/test/


// Example response
$res = [
    'result' => 1,
    'data' => [
        'Hello World'
    ]
];

header('Content-Type: application/json');
echo json_encode($res, JSON_OBJECT_AS_ARRAY);