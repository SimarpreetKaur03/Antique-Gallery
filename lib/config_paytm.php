<?php

define('PAYTM_ENVIRONMENT', 'TEST');
define('PAYTM_MERCHANT_KEY', 'iMCtkGeYZBpcGrU5');
define('PAYTM_MERCHANT_MID', 'SVIOJf37930259924280');
define('PAYTM_MERCHANT_WEBSITE', 'WEBSTAGING');

$PAYTM_STATUS_QUERY_NEW_URL='https://securegw-stage.paytm.in/merchant-status/getTxnStatus';
$PAYTM_TXN_URL='https://securegw-stage.paytm.in/order/process';

define('PAYTM_REFUND_URL', '');
define('PAYTM_STATUS_QUERY_URL', $PAYTM_STATUS_QUERY_NEW_URL);
define('PAYTM_STATUS_QUERY_NEW_URL', $PAYTM_STATUS_QUERY_NEW_URL);
define('PAYTM_TXN_URL', $PAYTM_TXN_URL);
?>