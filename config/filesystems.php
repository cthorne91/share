<?php

return [
    'default' => 'local',
    'disks' => [
        'local' => [
            'driver' => 'local',
            'root' => implode('/', array_slice(explode('/', getcwd()), 0, 3)),
        ],
        'cwd' => [
            'driver' => 'local',
            'root' => getcwd(),
        ],
    ],
];
