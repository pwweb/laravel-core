<?php

namespace PWWEB\Core\Interfaces;

use Illuminate\Container\Container as Application;
use PWWEB\Core\Models\ExchangeRate;

/**
 * PWWEB\Core\Interfaces\ExchangeRateRepository ExchangeRateRepository.
 *
 * The repository for ExchangeRate.
 * interface ExchangeRateRepositoryInterface
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
interface ExchangeRateRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Contructor.
     *
     * @param  Application  $app  Application instance.
     *
     * @throws \Exception
     */
    public function __construct(Application $app);

    /**
     * Return searchable fields.
     *
     * @return array
     */
    public function getFieldsSearchable(): array;

    /**
     * Configure the Model.
     *
     * @return string
     **/
    public function model(): string;
}
