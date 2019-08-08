#!/bin/bash

step=1 #間隔的秒數，不能大於60

for (( i = 0; i < 60; i=(i+step) )); do
php /project/coins/artisan getCoin:intercoin ICBX-BTC
php /project/coins/artisan getCoin:intercoin ETH-BTC
php /project/coins/artisan getCoin:intercoin LTC-BTC
php /project/coins/artisan getCoin:intercoin LTC-ETH
php /project/coins/artisan getCoin:intercoin ICBX-ETH
php /project/coins/artisan getCoin:intercoin ICBX-USDT
php /project/coins/artisan getCoin:intercoin ETH-USDT
php /project/coins/artisan getCoin:intercoin BTC-USDT
php /project/coins/artisan getCoin:intercoin EOS-ICBX
php /project/coins/artisan getCoin:intercoin LTC-ICBX
php /project/coins/artisan getCoin:intercoin BCHABC-ICBX
php /project/coins/artisan getCoin:intercoin XRP-ICBX
php /project/coins/artisan getCoin:intercoin NEO-ICBX
php /project/coins/artisan getCoin:intercoin ADA-ICBX
php /project/coins/artisan getCoin:intercoin ETC-ICBX
sleep $step
done
