<?php

namespace PWWEB\Core\Models\Menu;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kalnoy\Nestedset\NodeTrait;
use PWWEB\Core\Traits\Migratable;

/**
 * PWWEB\Core\Models\Menu\Item Model.
 *
 * Standard Item Model.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @property  int environment_id
 * @property  int _lft
 * @property  int _rgt
 * @property  int parent_id
 * @property  int level
 * @property  string identifier
 * @property  string title
 * @property  bool separator
 * @property  string class
 */
class Item extends Model
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
        'environment_id',
        '_lft',
        '_rgt',
        'parent_id',
        'level',
        'identifier',
        'name',
        'separator',
        'class',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'environment_id' => 'integer',
        '_lft' => 'integer',
        '_rgt' => 'integer',
        'parent_id' => 'integer',
        'level' => 'integer',
        'identifier' => 'string',
        'name' => 'string',
        'separator' => 'boolean',
        'class' => 'string',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'environment_id' => 'integer|required',
        'parent_id' => 'integer|nullable',
        'level' => 'required',
        'identifier' => 'required',
        'name' => 'required',
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
     * @param array $attributes additional attributes for model initialisation
     *
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('pwweb.core.table_names.menu_items'));
    }

    /**
     * Accessor for person of the user.
     *
     * @return BelongsTo
     */
    public function environment(): BelongsTo
    {
        return $this->belongsTo(config('pwweb.core.models.menu_environment'));
    }
}
