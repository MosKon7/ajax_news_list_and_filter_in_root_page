<?php
$arUrlRewrite=array (
    1 =>
        array (
            'CONDITION' => '#^/projects/([0-9a-zA-Z_-]+)/.*#',
            'RULE' => 'ELEMENT_CODE=$1',
            'PATH' => '/projects/detail.php',
            'SORT' => 100,
        ),
);