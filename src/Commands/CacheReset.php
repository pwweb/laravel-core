<?php

/**
 * PWWEB\Core\Commands.
 *
 * Definition of the cache reset artisan command.
 *
 * @author    Frank Pillukeit <clients@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace PWWEB\Core\Commands;

use Illuminate\Console\Command;
use PWWEB\Core\LocalisationRegistrar;

class CacheReset extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'pwweb:core:cache-reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset the cache';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (true === app(LocalisationRegistrar::class)->forgetCachedLanguages()) {
            $this->info('Language cache flushed.');
        } else {
            $this->error('Unable to flush cache.');
        }
    }
}
