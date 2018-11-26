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
* Kronos virtual machine request web service.
*
* @package    mod_kronossandvm
* @author     Remote-Learner.net Inc
* @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
* @copyright  (C) 2015 Remote Learner.net Inc http://www.remote-learner.net
*/

defined('MOODLE_INTERNAL') || die();

function xmldb_kronossandvm_upgrade($oldversion=0) {
    global $DB;

    $dbman = $DB->get_manager();
    $result = true;

    if ($result && $oldversion < 2018110101) {
        // Rename the tables using proper Moodle convention.
        $table = new xmldb_table('vm_requests');
        if ($dbman->table_exists($table)) {
            $dbman->rename_table($table, 'kronossandvm_requests');
        }
        $table = new xmldb_table('vm_courses');
        if ($dbman->table_exists($table)) {
            $dbman->rename_table($table, 'kronossandvm_courses');
        }

        upgrade_mod_savepoint(true, 2018110101, 'kronossandvm');
    }

    return $result;
}