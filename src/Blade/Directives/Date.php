<?php

namespace PWWEB\Core\Blade\Directives;

use Illuminate\Support\Str;
use PWWEB\Core\Blade\Directive;

/**
 * PWWEB\Core\Blade\Directive Date.
 *
 * Blade directive to check whether one or multiple expressions are not null.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @method    handle()
 */
class Date extends Directive
{
    /**
     * Constructor for the Date Directive.
     */
    public function __construct()
    {
        // Set to false, to not generate a @enddate directive.
        parent::__construct(false);
    }

    /**
     * Handle the functionality for the blade directive.
     *
     * @param string $expression List of expressions
     *
     * @return string
     */
    public function handle(string $expression): string
    {
        if (true === Str::contains($expression, ',')) {
            $expression = self::multipleArgs($expression);

            $date = $expression->get(0);
            $format = self::stripQuotes($expression->get(1));
        } else {
            $date = $expression;
            $format = config('pwweb.core.date_format');
        }

        return implode(
            '',
            [
                "<?php if (false === is_null({$date})) : ?>",
                "<?php echo {$date}->format('".$format."') ?>",
                '<?php endif; ?>',
            ]
        );
    }
}
