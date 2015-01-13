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
 * Kronos virtual machine manager.
 *
 * @package    mod_kronossandvm
 * @author     Remote-Learner.net Inc
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @copyright  (C) 2015 Remote Learner.net Inc http://www.remote-learner.net
 */

require_once('../../config.php');
require_once($CFG->dirroot.'/mod/kronossandvm/lib.php');
require_once($CFG->dirroot.'/mod/kronossandvm/instances_table.php');

require_login();

$id = required_param('id', PARAM_INT);

$PAGE->set_pagelayout('admin');
$PAGE->set_url('/mod/kronossandvm/instances.php', array('id' => $id));
$PAGE->set_context(context_system::instance());

if (!kronossandvm_canconfig()) {
    print_error('nopermissiontoshow');
}

echo $OUTPUT->header();

echo html_writer::tag('h4', get_string('vmcoursesinstances', 'mod_kronossandvm'));

// There is instances using this template currently.
$table = new instances_table('instances', $id);
$table->out(25, true);

echo $OUTPUT->footer();
