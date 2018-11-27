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

require_once('../../config.php');
require_once('lib.php');

$id = required_param('id', PARAM_INT);   // Course.

$PAGE->set_url('/mod/kronossandvm/index.php', ['id' => $id]);

if (! $course = $DB->get_record('course', ['id' => $id])) {
    print_error('invalidcourseid');
}

require_course_login($course);
$PAGE->set_pagelayout('incourse');

$params = ['context' => context_course::instance($id)];

$strvms = get_string('modulenameplural', 'mod_kronossandvm');
// Print the header.
$PAGE->navbar->add($strvms);
$PAGE->set_title($strvms);
$PAGE->set_heading($course->fullname);
echo $OUTPUT->header();
echo $OUTPUT->heading($strvms, 2);

// Get all the appropriate data.
if (! $vms = get_all_instances_in_course('kronossandvm', $course)) {
    notice(get_string('thereareno', 'moodle', $strvms), "../../course/view.php?id=$course->id");
    die();
}

$usesections = course_format_uses_sections($course->format);

// Print the list of instances (your module will probably extend this).

$timenow  = time();
$strname  = get_string('name');

$table = new html_table();

if ($usesections) {
    $strsectionname = get_string('sectionname', 'format_'.$course->format);
    $table->head  = [$strsectionname, $strname];
    $table->align = ['center', 'left'];
} else {
    $table->head  = [$strname];
    $table->align = ['left'];
}

$currentsection = '';
foreach ($vms as $vm) {
    if (!$vm->visible) {
        // Show dimmed if the mod is hidden.
        $link = "<a class=\"dimmed\" href=\"view.php?id=$vm->coursemodule\">".format_string($vm->name, true)."</a>";
    } else {
        // Show normal if the mod is visible.
        $link = "<a href=\"view.php?id=$vm->coursemodule\">".format_string($vm->name, true)."</a>";
    }
    $printsection = '';
    if ($vm->section !== $currentsection) {
        if ($vm->section) {
            $printsection = get_section_name($course, $vm->section);
        }
        if ($currentsection !== '') {
            $table->data[] = 'hr';
        }
        $currentsection = $vm->section;
    }
    if ($usesections) {
        $table->data[] = [$printsection, $link];
    } else {
        $table->data[] = [$link];
    }
}

echo '<br />';

echo html_writer::table($table);

// Finish the page.

echo $OUTPUT->footer();