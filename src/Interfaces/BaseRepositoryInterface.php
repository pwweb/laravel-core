<?php

namespace PWWEB\Core\Interfaces;

use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;

 /**
  * PWWEB\Core\Interfaces\BaseRepositoryInterface BaseRepositoryInterface.
  *
  * The base repository all future Interfaces.
  * interface BaseRepositoryInterface
  *
  * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
  * @author    Richard Browne <richard.browne@pw-websolutions.com>
  * @copyright 2020 pw-websolutions.com
  * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
  */
 interface BaseRepositoryInterface
 {

     /**
      * Contructor.
      *
      * @param Application $app Application instance.
      *
      * @throws \Exception
      */
     public function __construct(Application $app);

     /**
      * Get searchable fields array.
      *
      * @return array
      */
     public function getFieldsSearchable();

     /**
      * Configure the Model.
      *
      * @return string
      */
     public function model();

     /**
      * Make Model instance.
      *
      * @throws \Exception
      *
      * @return Model
      */
     public function makeModel();

     /**
      * Paginate records for scaffold.
      *
      * @param int   $perPage       Number of items per page.
      * @param array $columns       Columns to return.
      * @param array $relationships Relationships to eager load.
      *
      * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
      */
     public function paginate($perPage, $columns = ['*'], $relationships = []);

     /**
      * Order by for scaffold.
      *
      * @param array|string $orderBy Column [, and dir] to order by.
      *
      * @return self
      */
     public function orderBy($orderBy);

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
     public function allQuery($search = [], $skip = null, $limit = null, $relationships = []);

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
     public function all($search = [], $skip = null, $limit = null, $columns = ['*'], $relationships = []);

     /**
      * Create model record.
      *
      * @param array $input Input values to save.
      *
      * @return Model
      */
     public function create($input);

     /**
      * Create a new model.
      *
      * @param array $input Input values to save.
      *
      * @return Model
      */
     public function new($input);

     /**
      * Find model record for given id.
      *
      * @param int   $id            ID of the record.
      * @param array $columns       Columns to return.
      * @param array $relationships Relationships to eager load.
      *
      * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
      */
     public function find($id, $columns = ['*'], $relationships = []);

     /**
      * Update model record for given id.
      *
      * @param array $input Input values to save.
      * @param int   $id    ID for the record to update.
      *
      * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
      */
     public function update($input, $id);

     /**
      * Delete model record for a given id.
      *
      * @param int $id ID for the record to delete.
      *
      * @throws \Exception
      *
      * @return bool|mixed|null
      */
     public function delete($id);
 }
