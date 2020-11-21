<?php

namespace PWWEB\Core\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Log;
use PWWEB\Core\Models\Currency;
use PWWEB\Core\Models\ExchangeRate;

class UpdateExchangeRates implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Date to run the update for.
     *
     * @var string
     */
    protected $date;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Carbon $date)
    {
        $this->date = $date->toDateString();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $ecb = 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';
        $api = 'https://api.exchangeratesapi.io/'.$this->date.'?base=GBP';

        $response = Http::get($api);

        if (true === $response->successful()) {
            $data = $response->json();
            $rates = [];
            $currencies = Currency::select('id', 'iso')->get();
            foreach ($currencies as $currency) {
                if (true === isset($data['rates'][$currency->iso])) {
                    $rates[] = [
                        'currency_id' => $currency->id,
                        'rate' => $data['rates'][$currency->iso],
                        'date' => $this->date,
                    ];
                }
            }
            ExchangeRate::upsert($rates, ['currency_id', 'date'], ['rate']);
            Log::info('Exchange Rates Updated');
        } else {
            Log::error('Exchange Rate API Failed.');
        }//end if
    }

    /**
    * The unique ID of the job.
    *
    * @return string
    */
    public function uniqueId()
    {
        return $this->date;
    }
}
