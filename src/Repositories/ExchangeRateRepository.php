<?php

namespace PWWEB\Core\Repositories;

use Carbon\Carbon;
use PWWEB\Core\Interfaces\ExchangeRateRepositoryInterface;
use PWWEB\Core\Jobs\UpdateExchangeRates;
use PWWEB\Core\Models\ExchangeRate;

/**
 * PWWEB\Core\Repositories\ExchangeRateRepository ExchangeRateRepository.
 *
 * The repository for ExchangeRate.
 * Class ExchangeRateRepository
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class ExchangeRateRepository extends BaseRepository implements ExchangeRateRepositoryInterface
{
    /**
     * Fields that can be searched by.
     *
     * @var array
     */
    protected $fieldSearchable = [
        'currency_id',
        'rate',
    ];

    /**
     * Return searchable fields.
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model.
     *
     * @return string
     **/
    public function model()
    {
        return config('pwweb.core.models.exchange_rate');
    }

    /**
     * Get a Rate from the DB based on currency and an optional date.
     *
     * @param int    $currency_id Currency ID number.
     * @param Carbon $date        Date to limit the search to.
     *
     * @return Model|null The model to return
     */
    public function getRate($currency_id, Carbon $date)
    {
        $query = $this->model->newQuery();

        return $query->where('currency_id', $currency_id)
            ->where('date', $date->toDateString())
            ->firstOr(
                ['id', 'rate'],
                function () {
                    $duplicate = $this->getClosestRate($currency_id, $date)->replicate()->fill(
                        [
                        'currency_id' => $currency_id,
                        'date' => $date->toDateString(),
                        ]
                    );
                    $duplicate->save();

                    // Trigger pull and update to ExchangeRates:
                    UpdateExchangeRates::dispatch($date)->onQueue('pw-core');

                    return $duplicate;
                }
            );
    }

    /**
     * Get the closest rate to the current date.
     *
     * @param int    $currency_id Currency ID to look for.
     * @param Carbon $date        Date string in Y-m-d format.
     *
     * @return Model Closest Model or new default model.
     */
    public function getClosestRate($currency_id, $date)
    {
        $query = $this->model->newQuery();

        $older = $query->where('currency_id', $currency_id)
            ->where('date', '<', $date->toDateString())
            ->orderBy('date', 'ASC')
            ->first();

        $newer = $query->where('currency_id', $currency_id)
            ->where('date', '>', $date->toDateString())
            ->orderBy('date', 'ASC')
            ->first();

        if (false === is_null($older) && false === is_null($newer)) {
            $daysOld = $older->date->diffInDays($date);
            $daysNew = $newer->date->diffInDays($date);

            if ($daysOld >= $daysNew) {
                return $newer;
            } else {
                return $older;
            }
        } else {
            return ($newer ?? ($older ?? $this->model->newInstance(['rate' => 1])));
        }
    }
}
