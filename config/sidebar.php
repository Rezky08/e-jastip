<?php
return [
    \App\Supports\Repositories\AuthRepository::GUARD_WEB => [
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
    ],
    \App\Supports\Repositories\AuthRepository::GUARD_ADMIN => [
        [
            'code' => 'ARL',
            'title' => 'Layanan',
            'children' => [
                [
                    'code' => 'ARL',
                    'title' => 'Pengajuan Legalisir',
                    'childrenTitle' => 'Pengajuan Legalisir',
                    'children' => [
                        [
                            'code' => 'AJZ',
                            'title' => 'Ijazah',
                            'routeName' => 'admin.pengajuan-legalisir.ijazah',
                            'children' => []
                        ],
                    ]
                ],
            ]
        ],
    ],
    \App\Supports\Repositories\AuthRepository::GUARD_SPRINTER => [
        [
            'code' => 'SOR',
            'title' => 'Order',
            'children' => [
                [
                    'code' => 'SOI',
                    'title' => 'Incoming',
                    'routeName' => 'sprinter.order.incoming',
                    'children' => []
                ],
            ]
        ],
    ]
];
