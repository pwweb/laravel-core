<?php

namespace PWWEB\Core\Models\Menu;

use Eloquent as Model;

/**
 * PWWEB\Core\Models\Menu\Item Model.
 *
 * Standard Item Model.
 *
 * @package   pwweb/localisation
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @property  integer system_menu_environments_id
 * @property  integer _lft
 * @property  integer _rgt
 * @property  integer parent_id
 * @property  integer level
 * @property  string identifier
 * @property  string title
 * @property  boolean separator
 * @property  string class
 */

class Item extends Model
{
    public $table = 'system_menu_items';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'system_menu_environments_id',
        '_lft',
        '_rgt',
        'parent_id',
        'level',
        'identifier',
        'title',
        'separator',
        'class'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'system_menu_environments_id' => 'integer',
        '_lft' => 'integer',
        '_rgt' => 'integer',
        'parent_id' => 'integer',
        'level' => 'integer',
        'identifier' => 'string',
        'title' => 'string',
        'separator' => 'boolean',
        'class' => 'string'
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'system_menu_environments_id' => 'required',
        '_lft' => 'required',
        '_rgt' => 'required',
        'level' => 'required',
        'identifier' => 'required',
        'title' => 'required',
        'separator' => 'required',
        'class' => 'required'
    ];
}
