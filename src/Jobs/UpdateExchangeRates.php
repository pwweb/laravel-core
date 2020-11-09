<?php

namespace PWWEB\Core\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Log;

class UpdateExchangeRates implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $ecb = 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';
        $api = 'https://api.exchangeratesapi.io/latest?base=GBP';

        $response = Http::get($api);

        if ($response->successful()) {
            $data = $response->json();
            foreach ($data['rates'] as $iso => $rate) {
                $currency = Currency::firstWhere('iso', $iso);
                if (null === $currency) {
                    continue;
                }
                $rate = new ExchangeRate(
                    [
                        'rate' => $rate,
                        'date' => date('Y-m-d'),
                    ]
                );

                $currency->exchangeRate()->save($rate);
            }
            Log::info('Exchange Rates Updated');
        } else {
            Log::error('Exchange Rate API Failed.');
        }//end if
    }
}
