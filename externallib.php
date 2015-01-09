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
 * @copyright  (C) 2014 Remote Learner.net Inc http://www.remote-learner.net
 */

require_once($CFG->libdir."/externallib.php");

/**
 * Web service to get and update request for webservices.
 */
class mod_kronossandvm_external extends external_api {

    /**
     * Returns description of method parameters for vm_requests
     *
     * @return external_function_parameters
     */
    public static function vm_requests_parameters() {
        return new external_function_parameters(array(
        ));
    }

    /**
     * Get virtual machine requests.
     *
     * @return array Array of virtual machine requests.
     */
    public static function vm_requests() {
        global $DB;
        $sql = 'SELECT vmr.*, ud.data customerid,
                       c.coursename, c.imageid, c.otcourseno, c.imagesource, c.imagetype,
                       c.tusername, c.tpassword, c.imagename, a.duration
                  FROM {vm_requests} vmr,
                       {user_info_data} ud,
                       {user_info_field} udf,
                       {kronossandvm} a,
                       {vm_courses} c
                 WHERE ud.userid = vmr.userid
                       AND ud.fieldid = udf.id
                       AND udf.shortname = \'customerid\'
                       AND vmr.vmid = a.id
                       AND a.otcourseid = c.id
                       AND vmr.isactive = 1
                       AND isnull(vmr.instanceip)
                       AND vmr.isscript = 0
              ORDER BY vmr.id';
        $vmrequests = $DB->get_records_sql($sql);
        return $vmrequests;
    }

    /**
     * Returns description of vm_requests return value
     *
     * @return external_multiple_structure
     */
    public static function vm_requests_returns() {
        return new external_multiple_structure(
            new external_single_structure(array(
                'id' => new external_value(PARAM_INT, 'Id of request'),
                'vmid' => new external_value(PARAM_INT, 'Virtual machine id'),
                'userid' => new external_value(PARAM_INT, 'Id of user who make request'),
                'requesttime' => new external_value(PARAM_INT, 'Request time of session'),
                'starttime' => new external_value(PARAM_INT, 'Start time of session'),
                'endtime' => new external_value(PARAM_INT, 'End time of session'),
                'instanceid' => new external_value(PARAM_TEXT, 'Instance id'),
                'instanceip' => new external_value(PARAM_TEXT, 'Instance ip'),
                'isscript' => new external_value(PARAM_INT, 'Is script'),
                'username' => new external_value(PARAM_TEXT, 'VM Request username'),
                'password' => new external_value(PARAM_TEXT, 'VM Request password'),
                'isactive' => new external_value(PARAM_INT, 'Is active flag'),
                'customerid' => new external_value(PARAM_TEXT, 'Customer id'),
                'coursename' => new external_value(PARAM_TEXT, 'Course name'),
                'imageid' => new external_value(PARAM_TEXT, 'Image Id'),
                'otcourseno' => new external_value(PARAM_TEXT, 'OT Course No'),
                'imagesource' => new external_value(PARAM_TEXT, 'Image source'),
                'imagetype' => new external_value(PARAM_TEXT, 'Image type'),
                'tusername' => new external_value(PARAM_TEXT, 'Username'),
                'tpassword' => new external_value(PARAM_TEXT, 'Password'),
                'imagename' => new external_value(PARAM_TEXT, 'Name of image'),
                'duration' => new external_value(PARAM_INT, 'Duration virtual machine is active.')
            ))
        );
    }

    /**
     * Returns description of method parameters for update_vm_requests
     *
     * @return external_function_parameters
     */
    public static function update_vm_request_parameters() {
        return new external_function_parameters(array(
                'id' => new external_value(PARAM_INT, 'Id of request'),
                'requesttime' => new external_value(PARAM_INT, 'Request time of session', VALUE_OPTIONAL),
                'starttime' => new external_value(PARAM_INT, 'Start time of session', VALUE_OPTIONAL),
                'endtime' => new external_value(PARAM_INT, 'End time of session', VALUE_OPTIONAL),
                'instanceid' => new external_value(PARAM_TEXT, 'Instance id', VALUE_OPTIONAL),
                'instanceip' => new external_value(PARAM_TEXT, 'Instance ip', VALUE_OPTIONAL),
                'isscript' => new external_value(PARAM_INT, 'Is script', VALUE_OPTIONAL),
                'username' => new external_value(PARAM_TEXT, 'VM Request username', VALUE_OPTIONAL),
                'password' => new external_value(PARAM_TEXT, 'VM Request password', VALUE_OPTIONAL),
                'isactive' => new external_value(PARAM_INT, 'Is active flag', VALUE_OPTIONAL)
        ));
    }

    /**
     * Update virtual machine request.
     *
     * @param int $id Id of session.
     * @param int $requesttime Request time of sesion.
     * @param int $starttime Start time of session.
     * @param int $endtime End time of session.
     * @param string $instanceid Id of instance.
     * @param string $instanceip Ip of instance.
     * @param int $isscript Is request proccessed.
     * @param string $username Username.
     * @param string $password Password.
     * @param int $isactive Is request active.
     *
     * @return array Array of virtual machine requests.
     */
    public static function update_vm_request($id, $requesttime = null, $starttime = null, $endtime = 0, $instanceid = null,
            $instanceip = null, $isscript = null, $username = null, $password = null, $isactive = null) {
        global $DB;
        $request = $DB->get_record('vm_requests', array('id' => $id));
        if (empty($request)) {
            return array('id' => $id, 'status' => 'fail');
        }
        $args = func_get_args();
        $i = 1;
        foreach (array('requesttime', 'starttime', 'endtime', 'instanceid', 'instanceip', 'isscript', 'username', 'password', 'isactive') as $name) {
            if (!empty($args[$i]) && $args[$i] != null) {
                $request->$name = $args[$i];
            }
            $i++;
        }
        $DB->update_record('vm_requests', $request);
        return array('id' => $id, 'status' => 'success');
    }

    /**
     * Returns description of update_vm_requests return value.
     *
     * @return external_single_structure
     */
    public static function update_vm_request_returns() {
        return new external_single_structure(array(
            'id' => new external_value(PARAM_INT, 'Id of request'),
            'status' => new external_value(PARAM_TEXT, 'Status of update request. "success" on successful update. "fail" on missing request.')
        ));
    }

    /**
     * Returns description of method parameters for delete_vm_request
     *
     * @return external_function_parameters
     */
    public static function delete_vm_request_parameters() {
        return new external_function_parameters(array(
            'id' => new external_value(PARAM_INT, 'Id of request')
        ));
    }

    /**
     * Delete virtual machine request.
     *
     * @return array Array of virtual machine requests.
     */
    public static function delete_vm_request($id) {
        global $DB;
        $request = $DB->get_record('vm_requests', array('id' => $id));
        if (empty($request)) {
            return array('id' => $id, 'status' => 'fail');
        }
        $DB->delete_records('vm_requests', array('id' => $id));
        return array('id' => $id, 'status' => 'success');
    }

    /**
     * Returns description of delete_vm_request return value
     *
     * @return external_single_structure
     */
    public static function delete_vm_request_returns() {
        return new external_single_structure(array(
            'id' => new external_value(PARAM_INT, 'Id of request'),
            'status' => new external_value(PARAM_TEXT, 'Status of update request. "success" on successful update. "fail" on missing request.')
        ));
    }
}
