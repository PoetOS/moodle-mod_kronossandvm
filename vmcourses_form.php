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

require_once($CFG->libdir.'/formslib.php');

/**
 * Class to define the add virtual machine template.
 *
 * @see moodleform
 */
class vmcourses_form extends moodleform {
    /**
     * @var boolean $edit True if form is editing.
     */
    private $edit = false;
    /**
     * Constructor.
     *
     * @param string $url Url of page moodle form is on.
     * @param object $editdata Data to be edited.
     */
    public function __construct($url, $editdata = null) {
        if (!empty($editdata)) {
            $this->edit = true;
        }
        parent::__construct($url);
        if (!empty($editdata)) {
            $this->set_data($editdata);
        }
    }

    /**
     * Method that defines all of the elements of the form.
     *
     */
    public function definition() {
        $mform =& $this->_form;
        foreach (array('otcourseno', 'coursename', 'imageid', 'imagename' , 'vmwareno', 'imagesource', 'imagetype', 'tusername', 'tpassword') as $name) {
            $mform->addElement('text', $name, get_string($name, 'mod_kronossandvm'));
            $mform->setType($name, PARAM_TEXT);
        }
        $mform->addRule('coursename', null, 'required', null, 'client');
        $mform->addElement('checkbox', 'isactive', get_string('isactive', 'mod_kronossandvm'));
        $mform->setType('isactive', PARAM_INT);
        $mform->setDefault('isactive', 1);
        if ($this->edit) {
            $mform->addElement('hidden', 'id', 0);
            $mform->setType('id', PARAM_INT);
            $mform->addElement('submit', 'submitbutton', get_string('update'));
        } else {
            $mform->addElement('submit', 'submitbutton', get_string('add'));
        }
    }

    /**
     * Reset data to defaults.
     */
    public function reset_data() {
        $this->set_data(array(
            'otcourseno' => '',
            'coursename' => '',
            'imageid' => '',
            'imagename' => '',
            'vmwareno' => '',
            'imagesource' => '',
            'imagetype' => '',
            'tusername' => '',
            'tpassword' => '',
            'isactive' => 1));
    }
}
