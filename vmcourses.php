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
require_once($CFG->dirroot.'/mod/kronossandvm/vmcourses_table.php');
require_once($CFG->dirroot.'/mod/kronossandvm/vmcourses_form.php');
require_once($CFG->libdir.'/adminlib.php');
require_login();

$PAGE->set_pagelayout('admin');
$PAGE->set_url('/mod/kronossandvm/vmcourses.php');

$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_pagelayout('admin');
$PAGE->set_title(get_string('vmcourseslist', 'mod_kronossandvm'));
$PAGE->set_heading(get_string('vmcourseslist', 'mod_kronossandvm'));

if (!kronossandvm_canconfig()) {
    print_error('nopermissiontoshow');
}

$mform = new vmcourses_form($PAGE->url);
$formdata = $mform->get_data();
if ($formdata) {
    if (empty($formdata->isactive)) {
        $formdata->isactive = 0;
    }
    $DB->insert_record('vm_courses', $formdata);
    redirect($PAGE->url);
}
echo $OUTPUT->header();

$table = new vmcourses_table('admin');
$table->out(25, true);

echo html_writer::tag('h3', get_string('addtemplate', 'mod_kronossandvm'));
$mform->display();

echo $OUTPUT->footer();
