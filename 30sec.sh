#!/bin/bash

step=30 #間隔的秒數，不能大於60
for (( i = 0; i < 60; i=(i+step) )); do
    php /project/coins/artisan getCoin:price xem_btc
    php /project/coins/artisan getCoin:price xem_twd
    php /project/coins/artisan getCoin:price xem_usdt
    php /project/coins/artisan getCoin:price xem_eth
    php /project/coins/artisan getCoin:price cgp_twd
    php /project/coins/artisan getCoin:price sda_twd
    php /project/coins/artisan getCoin:price bito_btc
    php /project/coins/artisan getCoin:price bch_eth
    php /project/coins/artisan getCoin:price btg_usdt
    php /project/coins/artisan getCoin:price btg_twd
    php /project/coins/artisan getCoin:price rpc_twd
    php /project/coins/artisan getCoin:price bcd_twd
    php /project/coins/artisan getCoin:price rpc_eth
    php /project/coins/artisan getCoin:price panda_eth
    php /project/coins/artisan getCoin:price panda_twd
    php /project/coins/artisan getCoin:price npxs_eth
    php /project/coins/artisan getCoin:price qntu_eth
    php /project/coins/artisan getCoin:price bito_eth
    php /project/coins/artisan getCoin:price btg_eth
    php /project/coins/artisan getCoin:price bito_usdt
    php /project/coins/artisan getCoin:price twdt_eth
    php /project/coins/artisan getCoin:price bito_twd
    php /project/coins/artisan getCoin:price xrp_twd
    php /project/coins/artisan getCoin:price mith_twd
    php /project/coins/artisan getCoin:price bchsv_twd
    sleep $step
done
