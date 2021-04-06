<?php

namespace Hummingbot;

use  Hummingbot\SDK\Requests\Miner\Bounty\Markets;

require_once('../vendor/autoload.php');

try {
    $markets = (new Markets)->run();
    var_dump( $markets->filter( [ 'exchange_name' => 'binance', 'quote_asset' => 'USDT', 'bots' => ['>=', 30] ] ) );
} catch (Exception $e) {
    var_dump($e);
    echo 'Exception when calling Bank markets->run: ', $e->getMessage(), PHP_EOL;
}
