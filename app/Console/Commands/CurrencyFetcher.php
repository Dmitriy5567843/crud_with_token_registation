<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CurrencyFetcher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:fetch {to} {from} {amount}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch the currency';


    public function handle()
    {


//        $curl = curl_init();
//
//        curl_setopt_array($curl, array(
//            CURLOPT_URL => "https://api.apilayer.com/exchangerates_data/convert?to={$this->argument('to')}&from={$this->argument('from')}&amount={$this->argument('amount')}",
//            CURLOPT_HTTPHEADER => array(
//                "Content-Type: text/plain",
//                "apikey:XlhjLHykX2lJcMcVSf5kWqki2i2k80MC"
//            ),
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => "",
//            CURLOPT_MAXREDIRS => 10,
//            CURLOPT_TIMEOUT => 0,
//            CURLOPT_FOLLOWLOCATION => true,
//            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//            CURLOPT_CUSTOMREQUEST => "GET"
//        ));
//
//        $response = curl_exec($curl);
//
//        curl_close($curl);
//
//        $this->info($response);
    }
}
