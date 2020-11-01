<?php

namespace PWWEB\Core\Contracts;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface Country
{
    /**
     * A country can have multiple languages.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function languages(): HasMany;
}
