<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Remote db singleton.
 *
 * @package    local_readonlydbsingleton
 * @author     Rujul Trivedi
 * @copyright  Rujul Trivedi
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_readonlydbsingleton;

defined('MOODLE_INTERNAL') || die;

class remotedb {

    /** @var remotedb singleton instance */
    private static $instance;

    /**
     * Protected constructor, please use get_instance() to get an instance of this class.
     */
    private function __construct() {
        global $DB, $CFG, $REMOTEDB;

        $remotedbhost = $CFG->remotedbhost;
        $remotedbname = $CFG->remotedbname;
        $remotedbuser = $CFG->remotedbuser;
        $remotedbpass = $CFG->remotedbpass;
        if (!empty($dbhost) && !empty($dbname)
            && !empty($dbuser) && !empty($dbpass)) {
            $dbclass = get_class($DB);
            $REMOTEDB = new $dbclass();
            $REMOTEDB->connect($remotedbhost, $remotedbuser, $remotedbpass, $remotedbname, $CFG->prefix);
        }
        else {
            $REMOTEDB = $DB;
        }
    }

    /**
     * Returns the singleton instance of this class, this method automatically creates singleton instance if needed.
     *
     * @return remotedb
     */
    public static function get_instance() : remotedb {
        if (!isset(static::$instance)) {
            self::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Disable the cloning of this class.
     *
     * @return void
     * @throws \Exception
     */
    final public function __clone() {
        throw new \Exception('Feature disabled.');
    }

    /**
     * Disable the wakeup of this class.
     *
     * @return void
     * @throws \Exception
     */
    final public function __wakeup() {
        throw new \Exception('Feature disabled.');
    }
}
