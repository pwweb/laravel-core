<?php

namespace PWWEB\Core\Blade\Directives;

use Illuminate\Support\Str;
use PWWEB\Core\Blade\Directive;

/**
 * PWWEB\Core\Blade\Directive IsNotNull.
 *
 * Blade directive to check whether one or multiple expressions are not null.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 *
 * @method handle()
 */
class IsNotNull extends Directive
{
    /**
     * Handle the functionality for the blade directive.
     *
     * @param  string  $expression  List of expressions
     * @return string
     */
    public function handle(string $expression): string
    {
        if (true === Str::contains($expression, ',')) {
            $expression = self::multipleArgs($expression);

            return implode(
                '',
                [
                    "<?php if (! is_null({$expression->get(0)})) : ?>",
                    "<?php echo {$expression->get(1)}; ?>",
                    '<?php endif; ?>',
                ]
            );
        }

        return "<?php if (! is_null({$expression})) : ?>";
    }
}
