<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\TypeFormController;
use App\Http\Controllers\Setting;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SchoolDashboardController;
use App\Http\Controllers\FeesController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\PromoteController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\TimeTableController;
use App\Http\Controllers\ExmaController;
use App\Http\Controllers\SchemeHeaderController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\TopperStudentController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\StudentNoticeBoardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




/** for side bar menu active */
function set_active($route)
{
    if (is_array($route)) {
        return in_array(Request::path(), $route) ? 'active' : '';
    }
    return Request::path() == $route ? 'active' : '';
}

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', function () {
        return view('home');
    });
    Route::get('home', function () {
        return view('home');
    });
});

Auth::routes();




Route::group(['middleware' => 'auth'], function () {
    Route::get('/clear', function () {
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        return 'All Config cache cleared!';
    });
});


// ----------------------------Forgot Password ------------------------------//

Route::controller(ForgotPasswordController::class)->group(function () {
    Route::get('/forget-password', 'showForgetPasswordForm')->name('forget-password');
    Route::post('/send-otp', 'otpSend')->name('send-otp');
    Route::get('/new-password', 'showNewPasswordForm')->name('new-password');
    // Route::get('/logout', 'logout')->name('logout');
    // Route::post('change/password', 'changePassword')->name('change/password');
});

// ----------------------------login ------------------------------//
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->name('logout');
    Route::post('change/password', 'changePassword')->name('change/password');
});

// ----------------------------- register -------------------------//
Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'storeUser')->name('register');
});

// -------------------------- main dashboard ----------------------//
Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'index')->middleware('auth')->name('home');
    Route::get('/changesession/{id?}', 'ChangeSession')->middleware('auth')->name('changesession');
    Route::post('/updateProfile', 'UpdateProfile')->middleware('auth')->name('updateProfile');
    Route::get('user/profile/page', 'userProfile')->middleware('auth')->name('user/profile/page');
    Route::get('teacher/dashboard', 'teacherDashboardIndex')->middleware('auth')->name('teacher/dashboard');
    Route::get('student/dashboard', 'studentDashboardIndex')->middleware('auth')->name('student/dashboard');
});

// ----------------------------- user controller -------------------------//
Route::controller(UserManagementController::class)->group(function () {
    Route::get('list/users', 'index')->middleware('auth')->name('list/users');
    Route::post('change/password', 'changePassword')->name('change/password');
    Route::get('view/user/edit/{id}', 'userView')->middleware('auth');
    Route::post('user/update', 'userUpdate')->name('user/update');
    Route::post('user/delete', 'userDelete')->name('user/delete');

});


// ------------------------ setting -------------------------------//
Route::controller(Setting::class)->group(function () {
    Route::get('setting/page', 'index')->middleware('auth')->name('setting/page');
});

// ------------------------ school -------------------------------//

Route::controller(SchoolController::class)->group(function () {
    Route::get('school/add', 'AddSchoolPage')->middleware('auth')->name('add-school');
    Route::post('school/add', 'SaveSchool')->middleware('auth')->name('save-school');
    Route::get('school/list', 'schoolList')->middleware('auth')->name('schoollist');
    Route::post('school/search', 'searhSchool')->middleware('auth')->name('searchSchool');
    Route::get('school/update/{id?}', 'ShowSchool')->middleware('auth')->name('updateSchool');
    Route::post('school/updatedata', 'UpdateSchool')->middleware('auth')->name('updateschooldata');
    Route::get('school/OnlineRegistration', 'OnlineList')->middleware('auth')->name('onlineRegistration');
    Route::post('school/OnlineSearch', 'OnlineSearchList')->middleware('auth')->name('onlineSearch');
    Route::get('school/exportList', 'ExportList')->middleware('auth')->name('exportList');
    Route::post('school/schoolDelete', 'schoolDelete')->middleware('auth')->name('schoolDelete');
    Route::get('school/schooldashboard/{id}', 'schoolDashboard')->middleware('auth')->name('schoolDashboard');



    Route::get('school/addsession', 'AddSession')->middleware('auth')->name('add-session');
    Route::post('school/save-session', 'SaveSession')->middleware('auth')->name('save-session');
    Route::get('school/sessionlist', 'SessionList')->middleware('auth')->name('sessionlist');
    Route::get('school/view/{id?}', 'SessionView')->middleware('auth')->name('sessionview');
    Route::post('school/update-session', 'UpdateSession')->middleware('auth')->name('update-session');
    Route::get('school/state', 'GetState')->middleware('auth')->name('getstate');

});


Route::controller(SchoolDashboardController::class)->group(function () {
    Route::get('school', 'index')->middleware('auth')->name('school');
    Route::get('school/profile', 'profileView')->middleware('auth')->name('schoolprofile');
    Route::get('school/class', 'schoolClass')->middleware('auth')->name('schoolClass');
    Route::get('school/add-class', 'addClass')->middleware('auth')->name('add-class');
    Route::post('school/save-class', 'saveClass')->middleware('auth')->name('save-class');
    Route::get('school/subject', 'saveSubject')->middleware('auth')->name('schoolsubject');
    Route::get('school/add-subject', 'addSubject')->middleware('auth')->name('add-subject');
    Route::post('school/store-subject', 'storeSubject')->middleware('auth')->name('store-subject');
    Route::get('school/view-subject/{id?}', 'viewSubject')->middleware('auth')->name('view-subject');
    Route::post('school/update-subject', 'updateSubject')->middleware('auth')->name('update-subject');

});
Route::controller(StudentController::class)->group(function () {
    Route::get('school/add-student', 'studentAdd')->middleware('auth')->name('add-student');
    Route::post('school/store-student', 'studentSave')->middleware('auth')->name('store-student');
    Route::get('school/getschoolsubject', 'getSubject')->middleware('auth')->name('getschoolsubject');
    Route::get('school/pendinglist', 'pendingList')->middleware('auth')->name('pendinglist');
    Route::get('school/print/{id}', 'studentPrint')->middleware('auth')->name('printstudent');
    Route::get('school/update-student/{id}', 'updateStudent')->middleware('auth')->name('updateStudent');
    Route::post('school/update', 'updateStudentrecord')->middleware('auth')->name('update-student');
    Route::get('school/studentlist/{id}', 'studentList')->middleware('auth')->name('studentlist');
    Route::get('school/printstudent/{id}', 'studentPrintmain')->middleware('auth')->name('printstd');
    Route::post('school/student-delete', 'deleteStudent')->middleware('auth')->name('deletestudent');
    Route::get('school/searchStudent', 'searchStudent')->middleware('auth')->name('searchStudent');
    Route::post('school/student-recover', 'recoverStudent')->middleware('auth')->name('recoverstudent');
    Route::get('school/all-student-list/{id}', 'allStudentList')->middleware('auth')->name('allstudentlist');

});


// Fess //

Route::controller(FeesController::class)->group(function () {

    Route::get('school/fesstypelist', 'feesTypeList')->middleware('auth')->name('fesstypelist');
    Route::get('school/add-feestype', 'addfeesType')->middleware('auth')->name('addfeestype');
    Route::post('school/save-fees-type', 'SavefeesType')->middleware('auth')->name('save-fees-type');
    Route::get('school/viewfeestype/{id}', 'viewfeestype')->middleware('auth')->name('viewfeestype');
    Route::get('school/feessetting/{class?}', 'feesSetting')->middleware('auth')->name('feessetting');
    Route::post('school/store-fees', 'storeFees')->middleware('auth')->name('storeFees');
    Route::post('school/update-fees', 'updateFees')->middleware('auth')->name('updateFees');
    Route::get('school/viewfeessetting/{class?}', 'viewFeesSetting')->middleware('auth')->name('viewfeessetting');
    Route::get('school/fee-edit-list/{id}', 'feeEditList')->middleware('auth')->name('fee-edit-list');
    Route::get('school/feesearchStudent', 'feeSearchStudent')->middleware('auth')->name('feesearchStudent');
    Route::get('school/edit-fees/{id}', 'viewFeesEdit')->middleware('auth')->name('edit-fees');
    Route::post('school/update-Edit-Fees', 'updateEditFees')->middleware('auth')->name('updateEditFees');
    Route::get('school/fee-deposite-list/{id}', 'feeDepositeList')->middleware('auth')->name('fee-deposite-list');
    Route::get('school/fees-card/{id}', 'feesCard')->middleware('auth')->name('fees-card');
    Route::get('school/feesearchdeposite', 'feedepositeSearchStudent')->middleware('auth')->name('feesearchdeposite');
    Route::get('school/view-deposite-fees/{id}', 'viewDepositeEdit')->middleware('auth')->name('view-deposite-fees');
    Route::post('school/updateDepositeFees', 'updateDepositeFees')->middleware('auth')->name('updateDepositeFees');

    Route::get('school/recieptprint/{id}/{student}', 'printReciept')->middleware('auth')->name('recieptprint');
    Route::get('school/fees-report/{id}', 'feesReportList')->middleware('auth')->name('fees-report');
    Route::get('school/print-report/{id}', 'printReport')->middleware('auth')->name('print-report');
    Route::post('school/feesearchreport', 'feeReportSearchStudent')->middleware('auth')->name('feesearchreport');
    Route::get('school/pending-fees/{id}', 'feesPendingList')->middleware('auth')->name('pending-fees');
    Route::get('school/feesearchpending', 'feependingSearchStudent')->middleware('auth')->name('feesearchpending');
    Route::get('school/fees-student-list', 'feesStudentList')->middleware('auth')->name('fees-student-list');
    Route::get('school/search-fees-student-list', 'feeCardSearchStudent')->middleware('auth')->name('search-fees-student-list');
    Route::get('school/fees-card-list/{id}', 'feesCardList')->middleware('auth')->name('fees-card-list');
    Route::get('school/print-single-report/{receipt}/{id}', 'printSingleReport')->middleware('auth')->name('print-single-report');


});

// Promote //

Route::controller(PromoteController::class)->group(function () {
    Route::get('school/promote-list/{id}', 'promoteList')->middleware('auth')->name('promote-list');
    Route::get('school/promotesearchStudent', 'promoteSearchStudent')->middleware('auth')->name('promotesearchStudent');
    Route::post('school/promote-student', 'promoteStudent')->middleware('auth')->name('promoteStudent');

});

Route::controller(StaffController::class)->group(function () {
    Route::get('school/add-staff', 'addStaff')->middleware('auth')->name('add-staff');
    Route::post('school/store-staff', 'storeStaff')->middleware('auth')->name('store-staff');
    Route::get('school/staff-list', 'listStaff')->middleware('auth')->name('staff-list');
    Route::post('school/searchStaff', 'searchStaff')->middleware('auth')->name('searchStaff');
    Route::get('school/view-staff/{id}', 'viewStaff')->middleware('auth')->name('view-staff');
    Route::post('school/update-staff', 'updateStaff')->middleware('auth')->name('update-staff');
    Route::post('school/deletestaff', 'DeleteStaff')->middleware('auth')->name('deletestaff');
    Route::get('school/promote-staff-list', 'promoteListStaff')->middleware('auth')->name('promote-staff-list');
    Route::post('school/search-promote-staff', 'searchPromoteStaff')->middleware('auth')->name('promotesearchStaff');
    Route::post('school/promoteStaff', 'promoteStaff')->middleware('auth')->name('promoteStaff');
});


// Student Dashboard Code Goes Here //

Route::controller(StudentAuthController::class)->group(function () {
    Route::get('student/login', 'login')->name('student-login')->middleware('guest.student');
    Route::post('student/login', 'authenticate')->name('student-login');
    Route::get('student/logout', 'logout')->name('student-logout');
    Route::post('student/change/password', 'changePassword')->name('student/change/password');
});


// CODED BY ANKIT //

Route::controller(StudentDashboardController::class)->group(function () {
    Route::get('student', 'index')->middleware('auth.student')->name('student');
    Route::get('time-table', 'timeTable')->middleware('auth.student')->name('time-table');
    Route::get('fees/feesdeposite', 'feesdeposite')->name('fees/feesdeposite');
    Route::get('student/student_profile', 'student_profile')->name('student_profile');
    Route::get('student/fees-info', 'feesInfo')->name('fees-info');
    Route::get('student/fees-card', 'feesCard')->name('fees-card');
    Route::get('student/topper-student','topperstudent')->middleware('auth.student')->name('topper-student');
    Route::get('student/view-student-scheme/{text}', 'viewstudentscheme')->middleware('auth.student')->name('view-student-scheme');

});

Route::controller(SlideController::class)->group(function () {

    Route::get('school/slider', 'slider')->name('slider');
    Route::get('school/addslider', 'create')->name('addslider');
    Route::post('school/saveslider', 'saveslider')->middleware('auth')->name('saveslider');
    Route::get('school/editslider/{id}', 'edit')->name('editslider');
    Route::post('school/editslider/updateslider/{id}', 'updateslider')->middleware('auth')->name('updateslider');
    Route::get('school/removeslider/{id}', 'removeslider')->name('removeslider');
});

Route::controller(ExmaController::class)->group(function () {
    Route::get('school/exam_list', 'exam_list')->middleware('auth')->name('exam_list');
    Route::get('school/add-scheme', 'addscheme')->middleware('auth')->name('add-scheme');
    Route::post('school/savescheme', 'savescheme')->middleware('auth')->name('savescheme');
    Route::get('school/edit-scheme/{id}', 'editscheme')->middleware('auth')->name('edit-scheme');
    Route::post('school/updatescheme', 'updatescheme')->middleware('auth')->name('updatescheme');
    Route::get('school/removescheme/{id}', 'removescheme')->middleware('auth')->name('removescheme');
    Route::get('school/view-scheme/{text}', 'viewtestscheme')->middleware('auth')->name('view-scheme');
});

Route::controller(DownloadController::class)->group(function () {
    Route::get('school/id-card', 'idcard')->middleware('auth')->name('id-card');
    Route::get('school/search-id-card', 'searchIdcard')->middleware('auth')->name('searchidcard');
    Route::get('school/admit-card/{text}', 'admitcard')->middleware('auth')->name('admit-card');
    Route::get('school/search-admit-card', 'searchadmitcard')->middleware('auth')->name('searchadmitcard');
    Route::get('school/desk-slip/{text}', 'deskslip')->middleware('auth')->name('desk-slip');
    Route::get('school/search-desk-slip', 'searchdeskslip')->middleware('auth')->name('searchdeskslip');
    Route::get('school/tc/{id}', 'tc')->middleware('auth')->name('tc');
    Route::get('school/cc/{id}', 'cc')->middleware('auth')->name('cc');
    Route::post('school/save-cc', 'savecc')->middleware('auth')->name('save-cc');
    Route::get('school/tc-cc-list', 'tccclist')->middleware('auth')->name('tc-cc-list');
    Route::get('school/search-tc-cc', 'searchtccc')->middleware('auth')->name('search-tc-cc');
    Route::post('school/store-tc', 'storeTc')->middleware('auth')->name('store_tc');
    Route::get('school/view-noc/{id}/{text}', 'viewnoc')->middleware('auth')->name('view-noc');
    Route::get('school/noc-list/{text}', 'noclist')->middleware('auth')->name('noc-list');
    Route::get('school/search-noc', 'searchtccc')->middleware('auth')->name('search-noc');
    Route::post('school/save-noc', 'savenoc')->middleware('auth')->name('save-noc');

});
Route::controller(SchemeHeaderController::class)->group(function () {
    Route::get('school/scheme-class-list', 'scheme_list')->middleware('auth')->name('scheme_list');
    Route::get('school/add-scheme-class', 'addclass')->middleware('auth')->name('add-scheme-class');
    Route::post('school/saveclass', 'saveSchemeclass')->middleware('auth')->name('saveclass');
    Route::get('school/edit-scheme-class/{id}', 'editclass')->middleware('auth')->name('edit-class');
    Route::post('school/updateclass', 'updateclass')->middleware('auth')->name('updateclass');
    Route::get('school/removeclass/{id}', 'removeclass')->middleware('auth')->name('removeclass');
    Route::get('school/exam-time', 'examTime')->middleware('auth')->name('exam-time');
    Route::post('school/save-exam-time', 'saveExamTime')->middleware('auth')->name('save-exam-time');
});

Route::controller(TopperStudentController::class)->group(function (){
    Route::get('school/topper-student','topperstudent')->middleware('auth')->name('topper-student');
    Route::get('school/add-topper','addtopper')->middleware('auth')->name('add-topper');
    Route::post('school/savetopper', 'savetopper')->middleware('auth')->name('savetopper');
});

Route::controller(MaintenanceController::class)->group(function () {
    Route::get('school/item-list', 'item_list')->middleware('auth')->name('item_list');
    Route::get('school/add-item', 'additem')->middleware('auth')->name('add-item');
    Route::post('school/saveitem', 'saveitem')->middleware('auth')->name('saveitem');
    Route::get('school/edit-item/{id}', 'edititem')->middleware('auth')->name('edit-item');
    Route::post('school/updateitem', 'updateitem')->middleware('auth')->name('updateitem');
    Route::get('school/removeitem/{id}', 'removeitem')->middleware('auth')->name('removeitem');
    Route::get('school/student-maintenance-list', 'studentmaintenancelist')->middleware('auth')->name('student-maintenance-list');
    Route::get('school/search-student-maintenance-list', 'searchstudentmaintenancelist')->middleware('auth')->name('search-student-maintenance-list');
    Route::get('school/student-maintenance/{id}', 'studentmaintenance')->middleware('auth')->name('student-maintenance');
    Route::post('school/save-student-maintenance', 'savestudentmaintenance')->middleware('auth')->name('save-student-maintenance');
    Route::get('school/student-maintenance-record/{id?}', 'studentMaintenanceRecord')->middleware('auth')->name('student-maintenance-record');
    Route::get('student/view-student-maintenance', 'viewStudentmaintenance')->middleware('auth.student')->name('view-student-maintenance');
 });

 Route::controller(NoticeController::class)->group(function () {
    Route::get('school/notice-item', 'notice_item')->middleware('auth')->name('notice_item');
    Route::get('school/add-notice-item', 'addnoticeitem')->middleware('auth')->name('add-notice-item');
    Route::post('school/save-notice-item', 'savenoticeitem')->middleware('auth')->name('save-notice-item');
    Route::get('school/edit-notice-item/{id}', 'editnoticeitem')->middleware('auth')->name('edit-notice-item');
    Route::post('school/updatenoticeitem', 'updatenoticeitem')->middleware('auth')->name('update-notice-item');
    Route::get('school/removenoticeitem/{id}', 'removenoticeitem')->middleware('auth')->name('removenoticeitem');
    Route::get('school/student-notice-list', 'studentnoticelist')->middleware('auth')->name('student-notice-list');
    Route::get('school/search-student-notice-list', 'searchstudentnotice')->middleware('auth')->name('search-student-notice-list');
    Route::get('school/student-notice/{id}', 'studentnotice')->middleware('auth')->name('student-notice');
    Route::post('school/save-student-notice', 'savestudentnotice')->middleware('auth')->name('save-student-notice');
    Route::get('school/genrate-notice-list', 'genratenoticelist')->middleware('auth')->name('genrate-notice-list');
    Route::get('school/search-genrate-notice-list', 'searchgenratenotice')->middleware('auth')->name('search-genrate-notice-list');
    Route::get('school/notice-for-all-list', 'notice_for_all_list')->middleware('auth')->name('notice-for-all-list');
    Route::get('school/add-notice-for-all', 'add_notice_for_all')->middleware('auth')->name('add-notice-for-all');
    Route::post('school/save-notice-for_all', 'savenoticeforall')->middleware('auth')->name('save-notice-for-all');
    Route::get('school/edit-notice-for-all/{id}', 'editnoticeforall')->middleware('auth')->name('edit-notice-for-all');
    Route::post('school/update-notice-for-all', 'updatenoticeforall')->middleware('auth')->name('update-notice-for-all');
    Route::get('school/remove-notice/{id}', 'remove_notice')->middleware('auth')->name('remove-notice');
    Route::get('school/student-notice-for-all/{id}', 'notice_for_all')->middleware('auth')->name('notice-for-all');

 });

 Route::controller(StudentNoticeBoardController::class)->group(function () {
    Route::get('student/notice-for-you', 'notice_for_you')->middleware('auth.student')->name('notice-for-you');
    Route::get('student/notice-for-all/{id}', 'notice_for_all')->middleware('auth.student')->name('student-notice-for-all');
    Route::get('student/student-notice-for-all-list', 'notice_for_all_list')->middleware('auth.student')->name('student-notice-for-all-list');

   });

Route::middleware('auth')->controller(AttendanceController::class)->group(function () {
    Route::get('school/take_student_attendance/{id?}', 'takestudentattendance')->name('school/take_student_attendance');
    Route::post('school/submitstudentattendance', 'saveStudentAttendance')->name('submitstudentattendance');
    Route::get('school/view_student_attendance/{id?}/{date?}', 'viewstudentattendance')->name('school/view_student_attendance');
    Route::post('school/updatestudentattendance', 'updatestudentattendance')->name('updatestudentattendance');
    Route::get('school/student-attendance-record/{id?}/{date?}', 'studentAttendanceRecord')->name('school/student-attendance-record');
    Route::get('school/holiday-list', 'viewHoliday')->name('school/holiday-list');
    Route::get('school/add-holiday', 'viewAddHoliday')->name('add-holiday');
    Route::post('school/save-holiday', 'saveHoliday')->name('save-holiday');
    Route::get('school/remove-holiday/{id}', 'removeHoliday')->name('remove-holiday');
    Route::get('school/edit-holiday/{id}', 'editHoliday')->name('edit-holiday');
    Route::post('school/update-holiday', 'updateHoliday')->name('update-holiday');
});



Route::middleware('auth')->controller(TimeTableController::class)->group(function () {
    Route::get('school/add-time-table', 'addTimeTable')->name('add-time-table');
    Route::get('school/edit-time-table/{id?}', 'editTimeTable')->name('edit-time-table');
    Route::post('school/save-time-table', 'saveTimeTable')->name('save-time-table');
    Route::post('school/update-time-table', 'updateTimeTable')->name('update-time-table');
    Route::get('school/view-time-table/{id?}', 'viewTimeTable')->name('view-time-table');

});



