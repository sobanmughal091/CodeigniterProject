<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
// $route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/**
 * Admin Panel Routes
 */

//  Login and Logout
$route['login'] = 'login';
$route['login-authentication'] = 'login/authenticate';
$route['logout'] = 'login/logout';
// Index
$route['index'] = 'index';
// Patients
$route['patients-list'] = 'patients/index';
$route['add-patient'] = 'patients/addPatient';
$route['create-patient'] = 'patients/create';
$route['edit-patient/(:any)'] = 'patients/editPatient';
$route['update-patient/(:any)'] = 'patients/update';
$route['delete-patient/(:any)'] = 'patients/delete';
// Appointments
$route['appointment-list'] = 'appointment/index';
$route['add-appointment'] = 'appointment/addAppointment';
$route['create-appointment'] = 'appointment/create';
$route['edit-appointment/(:any)'] = 'appointment/editAppointment';
$route['update-appointment/(:any)'] = 'appointment/update';
$route['delete-appointment/(:any)'] = 'appointment/delete';
// Doctors
$route['doctors-list'] = 'doctors/index';
$route['add-doctor'] = 'doctors/addDoctor';
$route['create-doctor'] = 'doctors/create';
$route['edit-doctor/(:any)'] = 'doctors/editDoctor';
$route['update-doctor/(:any)'] = 'doctors/update';
$route['delete-doctor/(:any)'] = 'doctors/delete';
// Inpatients
$route['inpatients-list'] = 'inpatients/index';
$route['add-inpatient'] = 'inpatients/addInpatient';
$route['create-inpatient'] = 'inpatients/create';
$route['edit-inpatient/(:any)'] = 'inpatients/editInpatient';
$route['update-inpatient/(:any)'] = 'inpatients/update';
$route['delete-inpatient/(:any)'] = 'inpatients/delete';
// Bills
$route['bill-list-page'] = 'bills/index';
$route['bill-list-show/(:any)'] = 'bills/show';
$route['add-bill'] = 'bills/addBill';
$route['edit-bill'] = 'bills/editBill';
$route['update-bill'] = 'bills/updateBill';
$route['delete-bill'] = 'bills/delete';
// Consultant Management
$route['consultancy-list-page'] = 'consultants/index';
$route['consultancy-list-show'] = 'consultants/show';
$route['add-consultancy'] = 'consultants/addConsultancy';
$route['edit-consultancy'] = 'consultants/editConsultants';
$route['update-consultancy'] = 'consultants/updateConsultancy';
$route['delete-consultancy'] = 'consultants/delete';
