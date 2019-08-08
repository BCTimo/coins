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
 * Class getCoinALLPrice
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */
class getCoinALLPrice extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "getCoin:all";

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
        $all=$this->getTickers();
        foreach($all['data'] as $k=>$v){
            $json=$this->getTickerInfo($v['pair']);
            $this->insertUpdate($v['pair'],$json);

        
        }
        dd();

            
        $json=$this->getTickerInfo('eth_usdt');
        $this->insertUpdate('eth_usdt',$json);

        //$json=$this->getTickerInfo('btc_usdt');
        //dd($json);
    }
    public function insertUpdate($coinType,$json){
        $isExist = DB::select('select coin_type from bito where coin_type="'.$coinType.'"');
        if(!$isExist){
            DB::table('bito')->insert(
                [
                    'coin_type' => $coinType, 
                    'bids' => json_encode($json['bids']),
                    'asks' => json_encode($json['asks']),
                ]
            );
        }else{
            DB::table('bito')->where('coin_type',$coinType)->update(
                [
                    'bids' => json_encode($json['bids']),
                    'asks' => json_encode($json['asks']),
                ]
            );
        };
    }
    function getTickers() {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.bitopro.com/v2/tickers");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output, true);

        return $output;
    }
    public function getTickerInfo($coinType) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.bitopro.com/v2/order-book/".$coinType);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output, true);
    
        return $output;
    }
}
