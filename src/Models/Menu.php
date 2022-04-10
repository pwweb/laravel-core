<?php

namespace PWWEB\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use PWWEB\Core\Traits\Migratable;

/**
 * PWWEB\Core\Models\Menu Model.
 *
 * Standard Menu Model.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 *
 * @property  int _lft
 * @property  int _rgt
 * @property  int parent_id
 * @property  string route
 * @property  string title
 * @property  bool separator
 * @property  bool visible
 * @property  string class
 */
class Menu extends Model
{
    use Migratable;
    use NodeTrait;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        '_lft',
        '_rgt',
        'parent_id',
        'route',
        'title',
        'separator',
        'visible',
        'class',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        '_lft' => 'integer',
        '_rgt' => 'integer',
        'parent_id' => 'integer',
        'route' => 'string',
        'title' => 'string',
        'separator' => 'boolean',
        'visible' => 'boolean',
        'class' => 'string',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'parent_id' => 'integer|nullable',
        'route' => 'required',
        'title' => 'required',
        'separator' => 'required',
        'class' => 'string|nullable',
    ];

    /**
     * Force deleting of nodes on tree updates.
     *
     * @var bool
     */
    private $forceDeleting = false;

    /**
     * Constructor.
     *
     * @param  array  $attributes  additional attributes for model initialisation
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        $this->setTable(config('pwweb.core.table_names.menus'));
        parent::__construct($attributes);
    }
}
