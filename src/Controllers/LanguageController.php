<?php

namespace PWWEB\Core\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use PWWEB\Core\Interfaces\LanguageRepositoryInterface;
use PWWEB\Core\Middleware\Locale;
use PWWEB\Core\Requests\CreateLanguageRequest;
use PWWEB\Core\Requests\UpdateLanguageRequest;

/**
 * PWWEB\Core\Controllers\LanguageController LanguageController.
 *
 * The CRUD controller for Language
 * Class LanguageController
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class LanguageController extends Controller
{
    /**
     * Repository of Languages to be used throughout the controller.
     *
     * @var \PWWEB\Core\Interfaces\LanguageRepositoryInterface
     */
    private $languageRepository;

    /**
     * Constructor for the Language controller.
     *
     * @param \PWWEB\Core\Interfaces\LanguageRepositoryInterface $languageRepo Repository of Languages
     */
    public function __construct(LanguageRepositoryInterface $languageRepo)
    {
        $this->languageRepository = $languageRepo;
    }

    /**
     * Display a listing of the Language.
     *
     * @param Request $request Request containing the information for filtering.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $languages = $this->languageRepository->all();

        return view('core::languages.index')
            ->with('languages', $languages);
    }

    /**
     * Show the form for creating a new Language.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('core::languages.create');
    }

    /**
     * Store a newly created Language in storage.
     *
     * @param CreateLanguageRequest $request Request containing the information to be stored.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateLanguageRequest $request)
    {
        $input = $request->all();

        $language = $this->languageRepository->create($input);

        Flash::success('Language saved successfully.');

        return redirect(route('core.languages.index'));
    }

    /**
     * Display the specified Language.
     *
     * @param int $id ID of the Language to be displayed. Used for retrieving currently held data.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $language = $this->languageRepository->find($id);

        if (true === empty($language)) {
            Flash::error('Language not found');

            return redirect(route('core.languages.index'));
        }

        return view('core::languages.show')
            ->with('language', $language);
    }

    /**
     * Show the form for editing the specified Language.
     *
     * @param int $id ID of the Language to be edited. Used for retrieving currently held data.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $language = $this->languageRepository->find($id);

        if (true === empty($language)) {
            Flash::error('Language not found');

            return redirect(route('core.languages.index'));
        }

        return view('core::languages.edit')->with('language', $language);
    }

    /**
     * Update the specified Language in storage.
     *
     * @param int                   $id      ID of the Language to be updated.
     * @param UpdateLanguageRequest $request Request containing the information to be updated.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateLanguageRequest $request)
    {
        $language = $this->languageRepository->find($id);

        if (true === empty($language)) {
            Flash::error('Language not found');

            return redirect(route('core.languages.index'));
        }

        $language = $this->languageRepository->update($request->all(), $id);

        Flash::success('Language updated successfully.');

        return redirect(route('core.languages.index'));
    }

    /**
     * Remove the specified Language from storage.
     *
     * @param int $id ID of the Language to be destroyed.
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $language = $this->languageRepository->find($id);

        if (true === empty($language)) {
            Flash::error('Language not found');

            return redirect(route('core.languages.index'));
        }

        $this->languageRepository->delete($id);

        Flash::success('Language deleted successfully.');

        return redirect(route('core.languages.index'));
    }

    /**
     * Switch the locale.
     *
     * @param Request $request Laravel request instance.
     * @param string  $locale  Locale to change to.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeLocale(Request $request, $locale)
    {
        $check = $this->languageRepository->isLocaleActive($locale);
        // If a locale does not match any of the ones allowed, go back without doing anything.
        if (true === is_null($check)) {
            return redirect()->back();
        }

        // Set the right sessions.
        $request->session()->put(Locale::SESSION_KEY, $locale);
        // app()->setLocale($locale);
        // \LangCountry::setAllSessions($lang_country);

        // If a user is logged in and it has a lang_country property, set the new lang_country.

        if (null !== \Auth::user() && true === array_key_exists('locale', \Auth::user()->getAttributes())) {
            try {
                \Auth::user()->locale = $locale;
                \Auth::user()->save();
            } catch (\Exception $e) {
                \Log::error(get_class($this).' at '.__LINE__.': '.$e->getMessage());
            }
        }

        return redirect()->back();
    }
}
