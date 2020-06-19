<?php

namespace PWWEB\Core\Blade;

use Illuminate\Support\Facades\Blade;

/**
 * PWWEB\Core\Blade\Directive IsNull.
 *
 * Blade directive to check whether one or multiple expressions are null.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @method    static self multipleArgs()
 * @method    static self stripQuotes()
 */
class Directive
{
    /**
     * Name of the directive.
     *
     * @var string
     */
    private $name;

    /**
     * Determine the name of the blade directive and register it.
     *
     * @param bool $hasEnd Flag to determine if a corresponding end tag is required.
     *
     * @return void
     */
    public function __construct($hasEnd = true)
    {
        $this->name = strtolower((new \ReflectionClass($this))->getShortName());

        // Register the directive.
        Blade::directive($this->name, [$this, 'handle']);

        if (true === $hasEnd) {
            Blade::directive('end'.$this->name, [$this, 'handleEnd']);
        }
    }

    /**
     * Default handler for handling ends, usually for if statements.
     *
     * @param string $expression Expression to be parsed.
     *
     * @return string
     */
    public function handleEnd(string $expression)
    {
        return '<?php endif; ?>';
    }

    /**
     * Parse expression.
     *
     * @param string $expression Expression to be seperated.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function multipleArgs($expression)
    {
        return collect(explode(',', $expression))->map(
            function ($item) {
                return trim($item);
            }
        );
    }

    /**
     * Strip quotes.
     *
     * @param string $expression Expression to strip quotes from.
     *
     * @return string
     */
    public static function stripQuotes($expression)
    {
        return str_replace(["'", '"'], '', $expression);
    }
}
