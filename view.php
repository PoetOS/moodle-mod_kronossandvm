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

require_once('../../config.php');
require_once($CFG->dirroot.'/mod/kronossandvm/lib.php');

// Course Module ID.
$id = required_param('id', PARAM_INT);

if (!$cm = get_coursemodule_from_id('kronossandvm', $id)) {
    print_error(get_string('errormoduleid', 'mod_kronossandvm'));
}
if (!$course = $DB->get_record('course', array('id' => $cm->course))) {
    print_error(get_string('errorcourseconfig', 'mod_kronossandvm'));
}
if (!$kronossandvm = $DB->get_record('kronossandvm', array('id' => $cm->instance))) {
    print_error(get_string('errormoduleid', 'mod_kronossandvm'));
}

echo $kronossandvm->name;
