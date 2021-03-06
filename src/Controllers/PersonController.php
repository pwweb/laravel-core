<?php

namespace PWWEB\Core\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Laracasts\Flash\Flash;
use PWWEB\Core\Enums\Gender;
use PWWEB\Core\Enums\Title;
use PWWEB\Core\Interfaces\PersonRepositoryInterface;
use PWWEB\Core\Requests\CreatePersonRequest;
use PWWEB\Core\Requests\UpdatePersonRequest;

/**
 * PWWEB\Core\Controllers\Person Controller.
 *
 * Standard CRUD controller for the Person Model.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class PersonController extends Controller
{
    /**
     * Repository of Persons to be used throughout the controller.
     *
     * @var PersonRepositoryInterface
     */
    private $personRepository;

    /**
     * Constructor for the Person controller.
     *
     * @param PersonRepositoryInterface $personRepository Repository of Persons.
     */
    public function __construct(PersonRepositoryInterface $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    /**
     * Display a listing of Persons.
     *
     * @param Request $request Request containing the information for filtering.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $persons = $this->personRepository->all();

        return view('core::persons.index')
            ->with('persons', $persons);
    }

    /**
     * Show the form for creating a new Person.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        $persons = $this->personRepository->all();
        $genders = Gender::getAll();
        $titles = Title::getAll();

        return view('core::persons.create')
            ->with('persons', $persons)
            ->with('titles', $titles)
            ->with('genders', $genders);
    }

    /**
     * Store a newly created Persons in storage.
     *
     * @param CreatePersonRequest $request Request containing the information to be stored.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatePersonRequest $request): RedirectResponse
    {
        $input = $request->all();

        $person = $this->personRepository->create($input);

        if (false === empty($person)) {
            Flash::success('Person saved successfully.');
        } else {
            Flash::error('Person could not be saved.');
        }

        return redirect(route('core.persons.index'));
    }

    /**
     * Display the specified Person.
     *
     * @param int $id ID of the Person to be displayed. Used for retrieving currently held data.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $person = $this->personRepository->find($id);

        if (true === empty($person)) {
            Flash::error('Person not found');

            return redirect(route('core.persons.index'));
        }

        return view('core::persons.show')
            ->with('person', $person);
    }

    /**
     * Show the form for editing the specified Person.
     *
     * @param int $id ID of the Person to be edited. Used for retrieving currently held data.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $person = $this->personRepository->find($id);
        $genders = Gender::getAll();
        $titles = Title::getAll();

        if (true === empty($person)) {
            Flash::error('Person not found');

            return redirect(route('core.persons.index'));
        }

        return view('core::persons.edit')
            ->with('person', $person)
            ->with('titles', $titles)
            ->with('genders', $genders);
    }

    /**
     * Update the specified Person in storage.
     *
     * @param int                 $id      ID of the Person to be updated.
     * @param UpdatePersonRequest $request Request containing the information to be updated.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdatePersonRequest $request): RedirectResponse
    {
        $person = $this->personRepository->find($id);

        if (true === empty($person)) {
            Flash::error('Person not found');

            return redirect(route('core.persons.index'));
        }

        $person = $this->personRepository->update($request->all(), $id);

        if (false === empty($person)) {
            Flash::success('Person updated successfully.');
        } else {
            Flash::error('Person could not be updated.');
        }

        return redirect(route('core.persons.index'));
    }

    /**
     * Remove the specified Person from storage.
     *
     * @param int $id ID of the Person to be destroyed.
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $person = $this->personRepository->find($id);

        if (true === empty($person)) {
            Flash::error('Person not found');

            return redirect(route('core.persons.index'));
        }

        $this->personRepository->delete($id);

        Flash::success('Person deleted successfully.');

        return redirect(route('core.persons.index'));
    }
}
