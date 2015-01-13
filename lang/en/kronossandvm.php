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

$string['pluginname'] = 'Kronos sandbox';
$string['settings'] = 'Settings';
$string['modulename'] = 'Kronos sandbox';
$string['modulenameplural'] = 'Kronos sandboxes';
$string['pluginadministration'] = 'Kronos sandbox activity';
$string['kronossandvm:addinstance'] = 'Add instance';
$string['kronossandvm:employee'] = 'Kronos Employee';
$string['errormoduleid'] = 'Course Module ID was incorrect';
$string['errorcourseconfig'] = 'The course is misconfigured';
$string['errormoduleidorinstance'] = 'You must specify a course_module ID or an instance ID';
$string['instructions1'] = 'Click the button to request a sandbox session.';
$string['instructions2'] = 'Wait 15-20 minutes for the session to be created and the environment to be set up for you.';
$string['instructions3'] = 'Keep this page open and click Update Status in 15-20 minutes. You will know that the session is ready when you see a link to access it on this page.';
$string['updatestatus'] = 'Update Status';
$string['systemrequestederror'] = '<B><font color=FF0000>There was an error while processing your request. Please try again.  if this problem persists, please contact Kronos Educational Services support at +1 978-947-2901 or kvcsupport@kronos.com.</font></B>';
$string['systemrequested'] = '<B>Your request has been submitted.  please return to this page in 15 minutes to get your connection details.</B>';
$string['systembeingprepared'] = '<B><font color=FF0000>Your system is being prepared. You will need to click the Update Status link to refresh the page, which displays the session connection information when your session is ready. Most requests are completed within 15-20 minutes.</font></B>';
$string['peruserrestriction'] = '<B><font color=FF0000>You have already requested a system today.  KnowledgePass virtual labs are limited to {$a->limit} request per user account per day.</font></B>';
$string['persolutionrestriction'] = '<B><font color=FF0000>Your organization has already requested the maximum amount of systems available per day. This limit is currently {$a->mod_kronossandvm_requestssolutionperday}.  Please try again tomorrow.</font></B>';
$string['conpersolutionrestriction'] = '<B><font color=FF0000>Your organization has reached the maximum number of concurrent virtual lab systems available. This limit is {$a->mod_kronossandvm_requestsconcurrentpercustomer}.  Please try again later.</font></B>';
$string['requestsystem'] = 'Request a Sandbox System';
$string['restrictkronosemployee'] = 'Virtual Lab is only for customers.';
$string['systemready'] = 'Your system is now available';
$string['accesstext'] = 'To access the virtual lab system ';
$string['clickhere'] = 'click here';
$string['downloadinstructions'] = ' and open your connection file.';
$string['yourusername'] = 'Your username: ';
$string['yourpassword'] = 'Your password: ';
$string['availableuntil'] = 'This machine will be available until {$a->endtime} Eastern time.';
$string['requestsuserperday'] = 'Allowed virtual machine requests per <b>user</b> per day';
$string['requestsuserperdaydesc'] = 'This limits how many virtual machine requests a <b>user</b> can make each day starting at 12 am Eastern time';
$string['requestssolutionperday'] = 'Allowed virtual machine requests per <b>customer</b> per day';
$string['requestssolutionperdaydesc'] = 'This limits how many virtual machine requests <b>customers</b> students can make each day starting at 12 am Eastern time';
$string['requestsconcurrentpercustomer'] = 'Allowed virtual concurrent machine requests';
$string['requestsconcurrentpercustomerdesc'] = 'This limits how many virtual machine requests can exist at one time.';
$string['requesturl'] = 'URL to download connection to virtual machine';
$string['requesturldesc'] = 'This URL is template based, {instanceip} will be replaced with the instanceip field. Other fields include instanceid, userid, requesttime, starttime, endtime, username and password.';
$string['kronosemployee'] = 'Username used by kronos employee.';
$string['kronosemployeedesc'] = 'Username used by kronos employee which cannot start a Virtual Lab.';
$string['missingsolutionid'] = 'Missing solution id, please contact the administrator';
$string['eventvmrequestcreated'] = 'Virtual machine request created';
$string['eventvmrequestcreateddescription'] = 'Virtual machine request created by the user with id {$a->userid}';
$string['one'] = 'one';
$string['otcourseno'] = 'OT Course No';
$string['coursename'] = 'Course name';
$string['imageid'] = 'Image id';
$string['imagename'] = 'Image name';
$string['vmwareno'] = 'Vmware no';
$string['imagesource'] = 'Image source';
$string['imagetype'] = 'Image type';
$string['vmcourseslist'] = 'Virtual machine templates';
$string['tusername'] = 'Username';
$string['tpassword'] = 'Password';
$string['isactive'] = 'Active';
$string['addtemplate'] = 'Add virtual machine';
$string['templatesneeded'] = 'Virtual machine templates need to be added before creating an activity. Please click here.';
$string['templatesneededcontact'] = '<span style="color: red">Virtual machine templates need to be added before you can create an activity. Please contact the system adminstrator.</span>';
$string['edittemplate'] = 'Edit virtual machine';
$string['confirmdelete'] = 'Are you sure you want to delete ?';
$string['vmcoursesexist'] = 'The following courses contain an activity using this template, please delete the activity first.';
$string['instances'] = 'Instances';
$string['otcourseid'] = 'Virtual machine templates';
$string['vmcoursesinstances'] = 'Virtual machine instances';
$string['managetemplates'] = 'Manage virtual machine templates';
$string['managetemplatestitle'] = 'Virtual machine templates';
$string['vmactivityduration'] = 'Duration';
