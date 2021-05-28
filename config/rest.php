<?php

return [
  'api_key' => env('API_KEY', 'NONE'),
  'app_debug' => env('APP_DEBUG', 'NONE'),
  'api_url' => env('API_URL', 'NONE'),
  'customer_invoice' => env('CUSTOMER_INVOICE', 'NONE'),
  'surat_jalan' => env('SURAT_JALAN','NONE'),
  'detail_customer'=>env('DETAIL_CUSTOMER','NONE'),
  'add_customer_from_sj'=>env('ADD_CUSTOMER_FROM_SJ','NONE'),
  'add_do_dtl' => env('ADD_DO_DTL','NONE'),
  'detail_invoice'=> env('DETAIL_INVOICE','NONE'),
  'ttf_arh'=>env('TTF_ARH','NONE'),
  'ttf_arl'=>env('TTF_ARL','NONE'),
  'ttf_entry'=>env('TTF_ENTRY','NONE'),
  'customer'=>env('CUSTOMER','NONE'),
];

?>