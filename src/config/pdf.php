<?php

return [
    'mode'                  => '',
    'format'                => 'A4',
    'defaultFontSize'       => '',
    'defaultFont'           => '',
    'marginLeft'            => 10,
    'marginRight'           => 10,
    'marginTop'             => 40,
    'marginBottom'          => 35,
    'marginHeader'          => 10,
    'marginFooter'          => 5,
    'orientation'           => '',

    'title'                 => 'Laravel mpdf wrapper',
    'author'                => 'Kendu',
    'watermark'             => '',
    'showWatermark'         => false,
    'watermarkFont'         => 'DejaVuSansCondensed',
    'displayMode'           => 'fullpage',
    'watermarkTextAlpha'    => 0.1,

    'protection'            => [
        /*
        | SetProtection – Encrypts and sets the PDF document permissions
        |
        | https://mpdf.github.io/reference/mpdf-functions/setprotection.html
        */
        'permissions' => [
            'copy' => false,
            'print' => true,
            'modify' => false,
            'annot-forms' => false,
            'fill-forms' => false,
            'extract' => false,
            'assemble' => false,
            'print-highres' => false,
        ],
        'user_password' => null,
        'owner_password' => null,
        'length' => 40,
        'enabled' => true,
    ],
];
