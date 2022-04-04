<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class getProductJson implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $productId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($productUrl)
    {
        $subStr = str_replace("https://www.digikala.com/product/dkp-", "", $productUrl);
        $array = explode('/', $subStr);
        $this->productId = $array[0];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, 'https://api.digikala.com/v1/product/'.$this->productId.'/');
        curl_setopt($ch, CURLOPT_POST, false);
        $results = curl_exec($ch);
        curl_close($ch);
        $json= json_decode($results);

        return $json->data->product;
    }


}
