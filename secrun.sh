#!/bin/bash

step=1 #間隔的秒數，不能大於60

for (( i = 0; i < 60; i=(i+step) )); do
    php /project/coins/artisan getCoin:price eth_usdt
    php /project/coins/artisan getCoin:price eth_twd
    php /project/coins/artisan getCoin:price bch_twd
    php /project/coins/artisan getCoin:price btc_twd
    php /project/coins/artisan getCoin:price ltc_btc
    php /project/coins/artisan getCoin:price bch_btc
    php /project/coins/artisan getCoin:price ltc_usdt
    php /project/coins/artisan getCoin:price ltc_eth
    php /project/coins/artisan getCoin:price bch_usdt    
    php /project/coins/artisan getCoin:price eth_btc
    php /project/coins/artisan getCoin:price btc_usdt
    php /project/coins/artisan getCoin:price rpc_eth
    php /project/coins/artisan getCoin:price trx_twd
    php /project/coins/artisan getCoin:price usdt_twd
    php /project/coins/artisan getCoin:price ltc_twd
    sleep $step
done
