<?php

namespace PWWEB\Core\Helpers\Application;

/**
 * PWWEB\Core\Helpers\Application\Version Class.
 *
 * Helper for retrieving the application version.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class Version
{
    const MAJOR = 1;
    const MINOR = 1;
    const PATCH = 1;

    /**
     * Accessor for application version.
     *
     * @return string
     */
    public static function get(): string
    {
        $commitHash = trim(exec('git log --pretty="%h" -n1 HEAD'));

        $commitDate = new \DateTime(trim(exec('git log -n1 --pretty=%ci HEAD')));
        $commitDate->setTimezone(new \DateTimeZone('UTC'));

        return sprintf('v%s.%s.%s-dev.%s (%s)', self::MAJOR, self::MINOR, self::PATCH, $commitHash, $commitDate->format('Y-m-d H:i:s'));
    }
}
