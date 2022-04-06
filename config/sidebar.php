<?php
return [
    'user' => [
        [
            'code' => 'PRL',
            'title' => 'Layanan',
            'url' => '/profil',
            'children' => [
                [
                    'code' => 'LAI',
                    'title' => 'Layanan Pengajuan',
                    'url' => '/layanan',
                    'childrenTitle' => 'Daftar Layanan',
                    'children' => [
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
        [
            'code' => 'LAI',
            'title' => 'Layanan Pengajuan',
            'url' => '/layanan',
            'children' => []
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
];
