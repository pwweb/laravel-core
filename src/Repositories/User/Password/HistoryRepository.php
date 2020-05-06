<?php

namespace PWWEB\Core\Repositories\User\Password;

use App\Repositories\BaseRepository;
use PWWEB\Core\Models\User\Password\History;

/**
 * PWWEB\Core\Repositories\User\Password\HistoryRepository HistoryRepository.
 *
 * The repository for User Password History.
 * Class HistoryRepository
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class HistoryRepository extends BaseRepository
{
    /**
     * Fields that can be searched by.
     *
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'password',
    ];

    /**
     * Return searchable fields.
     *
     * @return array
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model.
     *
     * @return string
     **/
    public function model(): string
    {
        return History::class;
    }
}
