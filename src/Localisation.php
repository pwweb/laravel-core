<?php

/**
 * PWWEB\Core.
 *
 * Localisation Master Class.
 *
 * @author    Frank Pillukeit <clients@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace PWWEB\Core;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use PWWEB\Core\Contracts\Language as LanguageContract;
use PWWEB\Core\Models\Language;
use PWWEB\Core\Repositories\LanguageRepository;

class Localisation
{
    /**
     * The Laravel application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Normalized Laravel Version.
     *
     * @var string
     */
    protected $version;

    /**
     * True when this is a Lumen application.
     *
     * @var bool
     */
    protected $lumen = false;

    /**
     * Repository of languages to be used throughout the controller.
     *
     * @var \PWWEB\Core\Repositories\LanguageRepository
     */
    private $languageRepository;

    /**
     * Constructor.
     *
     * @param \PWWEB\Core\Repositories\LanguageRepository $languageRepo Repository of Languages
     * @param \Illuminate\Foundation\Application          $app          laravel application for further use
     */
    public function __construct(LanguageRepository $languageRepo, $app = null)
    {
        if (null === $app) {
            $app = app();
            //Fallback when $app is not given
        }

        $this->app = $app;
        $this->version = $app->version();
        $this->lumen = Str::contains($this->version, 'Lumen');

        $this->languageRepository = $languageRepo;
    }

    /**
     * Retrieves all active languages.
     *
     * @return \Illuminate\Database\Eloquent\Collection a collection of active languages
     */
    public function languages(): Collection
    {
        return $this->languageRepository->getAllActive();
    }

    /**
     * Determines the currently selected locale.
     *
     * @param string $locale (Optional) Locale to be used for language retrieval
     *
     * @return LanguageContract A language object
     */
    public function currentLanguage(string $locale = ''): LanguageContract
    {
        $fallbackLocale = config('app.locale');

        if ('' === $locale) {
            $locale = app()->getLocale();
        } elseif ($locale === $fallbackLocale) {
            $locale = 'en-GB';
        } else {
            $locale = $fallbackLocale.'-'.strtoupper($fallbackLocale);
        }

        try {
            $current = $this->languageRepository->findByLocale($locale);
        } catch (\InvalidArgumentException $e) {
            $current = $this->currentLanguage($fallbackLocale);
        }

        return $current;
    }

    /**
     * Renders a language selector / switcher according to view file.
     *
     * @return \Illuminate\Contracts\Support\Renderable language selector / switcher markup
     */
    public function languageSelector(): Renderable
    {
        $languages = $this->languages();
        $current = $this->currentLanguage();

        return view('core::atoms.languageselector', compact('languages', 'current'));
    }
}
