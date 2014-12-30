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
 * Kronos sandbox activity.
 *
 * @package    mod_kronossandvm
 * @author     Remote-Learner.net Inc
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @copyright  (C) 2014 Remote Learner.net Inc http://www.remote-learner.net
 */

/**
 * Add instance.
 *
 * @param object $kronossandvm Activity to add.
 * @return int
 */
function kronossandvm_add_instance($kronossandvm) {
    global $DB;
    $kronossandvm->timecreated  = time();
    $kronossandvm->timemodified = $kronossandvm->timecreated;
    $returnid = $DB->insert_record("kronossandvm", $kronossandvm);
    return $returnid;
}

/*
 * Update instance.
 *
 * @param object $kronossandvm
 * @return bool success.
 */
function kronossandvm_update_instance($kronossandvm) {
    global $DB;
    $kronossandvm->timemodified = time();
    $kronossandvm->id           = $kronossandvm->instance;
    $DB->update_record("kronossandvm", $kronossandvm);
    return true;
}

/*
 * Update instance.
 *
 * @param int $id kronossandvm id
 * @return bool success
 */
function kronossandvm_delete_instance($id) {
    global $DB;
    if (!$kronossandvm = $DB->get_record('kronossandvm', array('id' => $id))) {
        return false;
    }

    if (!$cm = get_coursemodule_from_instance('kronossandvm', $id)) {
        return false;
    }

    if (!$context = context_module::instance($cm->id, IGNORE_MISSING)) {
        return false;
    }

    $DB->delete_records('kronossandvm', array('id' => $id));
    return true;
}
