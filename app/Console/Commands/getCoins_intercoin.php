<?php
/**
 *
 * PHP version >= 7.0
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */

namespace App\Console\Commands;


use App\Post;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use DB;


/**
 * Class getCoins_intercoin
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */
class getCoins_intercoin extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "getCoin:intercoin {coinType}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "取得買賣掛單價";


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $coinType=$this->argument('coinType');
        
        $json=$this->getTickerInfo($coinType);
        $this->insertUpdate($coinType,$json);
    }
    public function insertUpdate($coinType,$json){
        $isExist = DB::select('select coin_type from intercoin where coin_type="'.$coinType.'"');
        if(!$isExist){
            DB::table('intercoin')->insert(
                [
                    'coin_type' => $coinType, 
                    'bids' => json_encode($json['data']['bids']),
                    'asks' => json_encode($json['data']['asks']),
                ]
            );
        }else{
            DB::table('intercoin')->where('coin_type',$coinType)->update(
                [
                    'bids' => json_encode($json['data']['bids']),
                    'asks' => json_encode($json['data']['asks']),
                ]
            );
        };
    }
    public function getTickerInfo($coinType) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api-exchange.intercoinx.pro/trading/get_orders_list/".$coinType."/30");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output, true);
    
        return $output;
    }
}
