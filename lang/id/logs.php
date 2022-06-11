<?php

return [
    "template" => '[ :logable | :status ] :datetime :message',
    "transaction.created" => 'Pesanan dibuat',
    "order.taken" => 'Pesanan diambil oleh :name',
    "order.to" => 'Sprinter :sprinter_name menuju :name',
    "order.arrived" => 'Sprinter :sprinter_name sampai di :name',
    "order.legal_process" => 'Dokumen sedang dalam proses legalisir',
    "order.legal_done" => 'Dokumen selesai dilegalisir',
    "order.packing" => 'Dokumen dalam proses pengemasan',
    "order.packed" => 'Dokumen selesai dikemas',
    "order.shipping" => 'Dokumen sedang dalam pengiriman oleh :name',
    "order.received" => 'Dokumen telah diterima oleh :name',
];
