<?php
return [
    'user' => [
        [
            'code' => 'PRL',
            'title' => 'Layanan',
            'children' => [
                [
                    'code' => 'PRL',
                    'title' => 'Profile',
                    'url' => '/profile',
                    'childrenTitle' => 'Daftar Layanan',
                    'children' => []
                ],
                [
                    'code' => 'PAL',
                    'title' => 'Pengajuan Legalisir',
                    'url' => '/pengajuan-legalisir',
                    'childrenTitle' => 'Pengajuan Legalisir',
                    'children' => [
                        [
                            'code' => 'IJZ',
                            'title' => 'Ijazah',
                            'url' => '/pengajuan-legalisir/ijazah',
                            'children' => []
                        ],
                    ]
                ],
                [
                    'code' => 'CKS',
                    'title' => 'Cek Status',
                    'url' => '/cek-status',
                    'children' => []
                ],
                [
                    'code' => 'RPJ',
                    'title' => 'Riwayat Pengajuan',
                    'url' => '/riwayat',
                    'children' => []
                ],
            ]
        ],
    ]
];
