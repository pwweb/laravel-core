<?php

namespace PWWEB\Core\Repositories;

use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;

/**
 * PWWEB\Core\Repositories\BaseRepository BaseRepository.
 *
 * The base repository all future repositories.
 * Class BaseRepository
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
abstract class BaseRepository
{
    /**
     * Model the repository is based on.
     *
     * @var Model
     */
    protected $model;

    /**
     * Instance of the application.
     *
     * @var Application
     */
    protected $app;

    /**
     * Constructor for the repository.
     *
     * @param Application $app Dependency injection of the application instance.
     *
     * @throws \Exception
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Get searchable fields array.
     *
     * @return array
     */
    abstract public function getFieldsSearchable();

    /**
     * Configure the Model.
     *
     * @return string
     */
    abstract public function model();

    /**
     * Make Model instance.
     *
     * @throws \Exception
     *
     * @return Model
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (false === ($model instanceof Model)) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * Paginate records for scaffold.
     *
     * @param int   $perPage Items per page.
     * @param array $columns Column names to retrieve.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage, $columns = ['*'])
    {
        $query = $this->allQuery();

        return $query->paginate($perPage, $columns);
    }

    /**
     * Build a query for retrieving all records.
     *
     * @param array    $search Search values for the query.
     * @param int|null $skip   [Optional] Flag to skip the query.
     * @param int|null $limit  [Optional] Limit for the query.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function allQuery($search = [], $skip = null, $limit = null)
    {
        $query = $this->model->newQuery();

        if (0 < count($search)) {
            foreach ($search as $key => $value) {
                if (true === in_array($key, $this->getFieldsSearchable())) {
                    $query->where($key, $value);
                }
            }
        }

        if (false === is_null($skip)) {
            $query->skip($skip);
        }

        if (false === is_null($limit)) {
            $query->limit($limit);
        }

        return $query;
    }

    /**
     * Retrieve all records with given filter criteria.
     *
     * @param array    $search  Search values for the query.
     * @param int|null $skip    [Optional] Flag to skip the query.
     * @param int|null $limit   [Optional] Limit for the query.
     * @param array    $columns Column names to retrieve.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all($search = [], $skip = null, $limit = null, $columns = ['*'])
    {
        $query = $this->allQuery($search, $skip, $limit);

        return $query->get($columns);
    }

    /**
     * Create model record.
     *
     * @param array $input Values for new record creation.
     *
     * @return Model
     */
    public function create($input)
    {
        $model = $this->model->newInstance($input);

        $model->save();

        return $model;
    }

    /**
     * Find model record for given ID.
     *
     * @param int   $id      The ID of the record to be retrieved.
     * @param array $columns Column names to retrieve.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function find($id, $columns = ['*'])
    {
        $query = $this->model->newQuery();

        return $query->find($id, $columns);
    }

    /**
     * Update model record for given ID.
     *
     * @param array $input Values for the update of the record.
     * @param int   $id    The ID of the record to be retrieved.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     */
    public function update($input, $id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        $model->fill($input);

        $model->save();

        return $model;
    }

    /**
     * Delete model record for a given ID.
     *
     * @param int $id The ID of the record to be deleted.
     *
     * @throws \Exception
     *
     * @return bool|mixed|null
     */
    public function delete($id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        return $model->delete();
    }
}
