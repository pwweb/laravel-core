<?php

namespace PWWEB\Core\Traits;

/**
 * PWWEB\Core\Traits\Migratable.
 *
 * Trait providing additional functionalities for migratable models.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
trait Migratable
{
    /**
     * Accessor for the table name of the model, whether this is the Laravel default one
     * (derived from the model name), or explicitly set table name in the model.
     *
     * @return string
     */
    public static function getTableName()
    {
        return with(new static())->getTable();
    }
}
