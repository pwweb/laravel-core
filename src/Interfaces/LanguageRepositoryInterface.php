<?php

namespace PWWEB\Core\Interfaces;

use PWWEB\Core\Models\Language;

/**
 * PWWEB\Core\Interfaces\LanguageRepository LanguageRepository.
 *
 * The repository for Language.
 * interface LanguageRepositoryInterface
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
interface LanguageRepositoryInterface extends BaseRepositoryInterface
{


    /**
     * Return searchable fields.
     *
     * @return array
     */
    public function getFieldsSearchable();


    /**
     * Configure the Model.
     *
     * @return string
     **/
    public function model();


    /**
     * Retrieve all active languages.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllActive();


    /**
     * Retrieve active language based on locale.
     *
     * @param string $locale The locale to check.
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function isLocaleActive(string $locale);


    /**
     * Retrieve active language based on lang.
     *
     * @param string $lang The language to check.
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function isLangActive(string $lang);


    /**
     * Find a language by its locale, e.g. en-gb.
     *
     * @param string $locale locale to be used to retrieve the language
     *
     * @throws \PWWEB\Core\Exceptions\LanguageDoesNotExist
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findByLocale(string $locale);
}
