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

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');
}

require_once($CFG->dirroot.'/course/moodleform_mod.php');
require_once($CFG->dirroot.'/mod/kronossandvm/lib.php');

/**
 * Activity settings page.
 */
class mod_kronossandvm_mod_form extends moodleform_mod {
    /**
     * Define form for settings.
     */
    public function definition() {
        global $DB;

        $mform =& $this->_form;

        $mform->addElement('text', 'name', get_string('name'), array('size' => '64'));
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');

        $this->add_intro_editor(true);

        $this->standard_coursemodule_elements();

        if (!$options = $DB->get_records_menu("vm_courses", null, 'imageid', 'id, coursename')) {
                // Place holder data.
                $obj = new stdClass();
                $obj->coursename = 'testcoursename';
                $obj->imageid = 'testid1';
                $obj->otcourseno = 'testid2';
                $obj->imagesource = 'testid3';
                $obj->isactive = 1;
                $obj->imagetype = 'testid4';
                $obj->tusername = 'testid5';
                $obj->tpassword = 'testid6';
                $obj->imagename = 'testid7';
                $DB->insert_record('vm_courses', $obj);
                $options = $DB->get_records_menu("vm_courses", null, 'imageid', 'id, coursename');
        }

        $mform->addElement('select', 'otcourseid', get_string('otcourseid', 'kronossandvm'), $options);
        $mform->addRule('otcourseid', get_string('required'), 'required', null, 'client');

        $this->add_action_buttons();
    }
}
