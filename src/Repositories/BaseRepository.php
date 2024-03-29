<?php

namespace PWWEB\Core\Repositories;

use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;
use PWWEB\Core\Interfaces\BaseRepositoryInterface;

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
abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * The model instance.
     *
     * @var Model
     */
    protected $model;

    /**
     * Application instance.
     *
     * @var Application
     */
    protected $app;

    /**
     * Order deatils.
     *
     * @var array
     */
    protected $orderBy = [];

    /**
     * Contructor.
     *
     * @param Application $app Application instance.
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

        if (false === $model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * Paginate records for scaffold.
     *
     * @param int   $perPage       Number of items per page.
     * @param array $columns       Columns to return.
     * @param array $relationships Relationships to eager load.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage, $columns = ['*'], $relationships = [])
    {
        $query = $this->allQuery([], null, null, $relationships);

        return $query->paginate($perPage, $columns);
    }

    /**
     * Order by for scaffold.
     *
     * @param array|string $orderBy Column [, and dir] to order by.
     *
     * @return self
     */
    public function orderBy($orderBy)
    {
        if (false === is_array($orderBy)) {
            $this->orderBy[$orderBy] = 'asc';
        } else {
            foreach ($orderBy as $key => $value) {
                if (false === is_array($value)) {
                    // String...
                    if (false === in_array(strtolower($value), ['asc', 'desc'])) {
                        $this->orderBy[$value] = 'asc';
                    } else {
                        $this->orderBy[$key] = $value;
                    }
                } else {
                    // Array...
                    if (true === isset($value[0])) {
                        $this->orderBy[$value[0]] = 'asc';
                    } else {
                        $this->orderBy = array_merge($this->orderBy, $value);
                    }
                }
            }
        }//end if

        return $this;
    }

    /**
     * Build a query for retrieving all records.
     *
     * @param array    $search        Search parameters
     * @param int|null $skip          Number of items to skip
     * @param int|null $limit         Limit of the query results.
     * @param array    $relationships Relationships to eager load.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function allQuery($search = [], $skip = null, $limit = null, $relationships = [])
    {
        $query = $this->model->with($relationships)->newQuery();

        if (count($search) > 0) {
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

        if (false === is_null($this->orderBy)) {
            foreach ($this->orderBy as $key => $value) {
                $query->orderBy($key, $value);
            }
        }

        return $query;
    }

    /**
     * Retrieve all records with given filter criteria.
     *
     * @param array    $search        Search parameters.
     * @param int|null $skip          Number of entries to skip.
     * @param int|null $limit         Number of entries to return.
     * @param array    $columns       Columns to return.
     * @param array    $relationships Relationships to eager load.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all($search = [], $skip = null, $limit = null, $columns = ['*'], $relationships = [])
    {
        $query = $this->allQuery($search, $skip, $limit, $relationships);

        return $query->get($columns);
    }

    /**
     * Create model record.
     *
     * @param array $input Input values to save.
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
     * Create new model record.
     *
     * @param array $input Input values to save.
     *
     * @return Model
     */
    public function new($input)
    {
        $model = $this->model->newInstance($input);

        return $model;
    }

    /**
     * Find model record for given id.
     *
     * @param int   $id            ID of the record.
     * @param array $columns       Columns to return.
     * @param array $relationships Relationships to eager load.
     * @param array $counts        Relationships to count.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function find($id, $columns = ['*'], $relationships = [], $counts = [])
    {
        $query = $this->model->with($relationships)->newQuery();

        return $query->find($id, $columns);
    }

    /**
     * Update model record for given id.
     *
     * @param array $input Input values to save.
     * @param int   $id    ID for the record to update.
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
     * Delete model record for a given id.
     *
     * @param int $id ID for the record to delete.
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

    /**
     * Pluck model record.
     *
     * @param string[] $columns Columns to pluck.
     *
     * @throws \Exception
     *
     * @return bool|mixed|null
     */
    public function pluck($columns)
    {
        $query = $this->model->newQuery();

        $model = $query->pluck(...$columns);

        return $model;
    }
}
