<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuperAdmin\InvoiceController;
use App\Http\Controllers\SuperAdmin\BlockController;
use App\Http\Controllers\User\MainController;
use App\Http\Controllers\User\UserInvoiceController;
use App\Http\Controllers\User\UserComplaintsController;
use App\Http\Controllers\SuperAdmin\FlatAreaController;
use App\Http\Controllers\SuperAdmin\AllotmentsController;
use App\Http\Controllers\SuperAdmin\ComplaintsController;
use App\Http\Controllers\SuperAdmin\Invoice_typeController;
use App\Http\Controllers\SuperAdmin\SuperAdminRoleController;
use App\Http\Controllers\SuperAdmin\ComplaintTypeController;
use App\Http\Controllers\SuperAdmin\EmployeesController;
use App\Http\Controllers\SuperAdmin\AttendanceController;
use App\Http\Controllers\SuperAdmin\LeaveController;
use App\Http\Controllers\Superadmin\RolesController;
use App\Http\Controllers\Superadmin\UserRolesController;
use App\Http\Controllers\Superadmin\HrNotificationController;
use App\Http\Controllers\Superadmin\NotificationController;
use App\Http\Controllers\Superadmin\ActivityLogsController;
use App\Http\Controllers\Superadmin\PermissionController;
use App\Http\Controllers\Superadmin\BookingController;
use App\Http\Controllers\Superadmin\CommunityHallBookingController;
use App\Http\Controllers\Superadmin\TenancyController;
use App\Http\Controllers\Superadmin\DocumentController;
use App\Http\Controllers\Superadmin\ServiceAccessController;
use App\Http\Controllers\Superadmin\ParkingController;
use App\Http\Controllers\Superadmin\CarStickerController;
use App\Http\Controllers\EmployeeAuthController;
use App\Http\Controllers\SuperAdmin\FlatController;
use App\Http\Controllers\Superadmin\NOCSController;
use App\Http\Controllers\superadmin\CardController;
use App\Http\Controllers\Superadmin\employee_depart;
use App\Http\Controllers\Superadmin\NoticController;
use App\Http\Controllers\Superadmin\SalaryController;
use App\Http\Controllers\User\RegisterationController;
use App\Http\Controllers\SuperAdmin\PayrollController;
use App\Http\Controllers\superadmin\InventoryController;
use App\Http\Controllers\Employee\EmployeeMainController;
use App\Http\Controllers\Superadmin\Employee_designation;
use App\Http\Controllers\superadmin\FixedAssetsController;
use App\Http\Controllers\Employee\EmployeeLeaveController;
use App\Http\Controllers\Superadmin\GuestTemporaryController;
use App\Http\Controllers\Superadmin\UserRentController;
use App\Http\Controllers\Superadmin\PackageController;
use App\Http\Controllers\Superadmin\PaymentController;
use App\Http\Middleware\CheckFeatureAccess;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
//    Route::get('/', [HomeController::class, 'index']);
//    Route::get('/get-flats/{blockId}', [HomeController::class, 'getFlats']);
//    Route::post('flat-login', [HomeController::class, 'login'])->name('flat.login');
//});

Route::get('/', [HomeController::class, 'index']);
Route::get('/get-flats/{blockId}', [HomeController::class, 'getFlats']);
Route::post('flat-login', [HomeController::class, 'login'])->name('flat.login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// Employee
Route::get('/employee/dashboard', [EmployeeMainController::class, 'employee_dashboard'])->name('employee.dashboard');

// Login Routes
Route::post('/employee/login', [EmployeeAuthController::class, 'login'])->name('employee.login');

Route::controller(PackageController::class)->group(function () {
    Route::get('/packages', 'index')->name('packages.index');
    Route::get('/backend/packages', 'backendindex')->name('packages.backendindex');
    Route::get('/subscribe/{id}', 'subscribe')->name('subscribe');
    Route::get('/packages/create', 'create')->name('packages.create');
    Route::post('/packages/store', 'store')->name('packages.store');
    Route::get('/packages/edit/{id}', 'edit')->name('packages.edit');
    Route::post('/packages/update/{id}', 'update')->name('packages.update');
});
Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('processPayment');


// Dashboards Route

// Super Admin
Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

// Flat User
Route::controller(MainController::class)->group(function () {
    Route::get('user/dashboard', 'index')->name('user.dashboard');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(SuperAdminRoleController::class)->group(function () {
    Route::get('/all', 'AllSuperAdminRole')->name('all.superadmin.user');
    Route::get('/add', 'AddSuperAdminRole')->name('add.superadmin');
    Route::post('/store', 'StoreSuperAdminRole')->name('superadmin.role.store');
    Route::get('/edit/{id}', 'EditSuperAdminRole')->name('edit.superadmin');
    Route::post('/update', 'UpdateSuperAdminRole')->name('admin.role.update');
    Route::get('/delete/{id}', 'DeleteSuperAdminRole')->name('delete.superadmin');

});
Route::middleware(['auth', 'feature:block'])->group(function () {
    Route::controller(BlockController::class)->group(function () {
        Route::get('/superadmin/block', 'index')->name('block.index');
        Route::post('/block/create', 'store')->name('block.store');
        Route::put('/block/update', 'update')->name('block.update');
        Route::delete('/block/delete/{id}', 'destroy')->name('block.delete');
    });
});
//Route::middleware(['auth', 'feature:block'])->group(function () {
//    Route::get('/superadmin/block', [BlockController::class, 'index'])->name('block.index');
//    Route::post('/block/create', [BlockController::class, 'store'])->name('block.store');
//    Route::put('/block/update', [BlockController::class, 'update'])->name('block.update');
//    Route::delete('/block/delete/{id}', [BlockController::class, 'destroy'])->name('block.delete');
//});

Route::controller(Invoice_typeController::class)->group(function () {
    Route::get('/superadmin/invoce/type', 'index')->name('invoice.type');
    Route::POST('/invoice/type/create', 'store')->name('type.create');
    Route::put('/invoice/type/update', 'update')->name('invoice_type.update');
    Route::delete('/inovice/type/delete/{id}', 'destroy')->name('invoice_type.delete');

});

Route::controller(FlatAreaController::class)->group(function () {
    Route::get('/superadmin/flatarea', 'index')->name('flatarea.index');
    Route::get('/superadmin/flatarea/create', 'create')->name('flatarea.create');
    Route::get('/superadmin/flatarea/edit/{id}', 'edit')->name('flatarea.edit');
    Route::POST('/flatarea/create', 'store')->name('flatarea.add');
    Route::PUT('/flatarea/edit/{id}', 'update')->name('flatarea.update');
    Route::delete('/flatarea/delete/{id}', 'destroy')->name('flatarea.delete');

});

Route::controller(FlatController::class)->group(function () {
    Route::get('/superadmin/flat', 'index')->name('flat.index');
    Route::get('/superadmin/flat/create', 'create')->name('flat.create');
    Route::get('/superadmin/flat/edit/{id}', 'edit')->name('flat.edit');
    Route::POST('/flat/create', 'store')->name('flat.add');
    Route::PUT('/flat/edit/{id}', 'update')->name('flat.update');
    Route::delete('/flat/delete/{id}', 'destroy')->name('flat.delete');

});

Route::controller(AllotmentsController::class)->group(function () {
    Route::get('/superadmin/allotments', 'index')->name('allotments.index');
    Route::get('/superadmin/allotments/create', 'create')->name('allotments.create');
    Route::POST('/allotments', 'store')->name('allotments.store');
    Route::delete('/allotments/delete/{id}', 'destroy')->name('allot.delete');
    Route::get('/superadmin/allotments/edit/{id}', 'edit')->name('allot.edit');

    Route::PUT('/allotments/update/{id}', 'update')->name('allotments.update');
});

Route::controller(InvoiceController::class)->group(function () {
    Route::get('/superadmin/invoice', 'index')->name('invoice.index');
    Route::get('/superadmin/invoice/create', 'create')->name('invoice.create');
    Route::POST('/invoice/create', 'store')->name('invoice.store');
    Route::get('invoice/{id}', 'showInvoice')->name('invoice.show');
    Route::get('/additional/invoice/create', 'AdditionalInvoice')->name('additional.invoive');
    Route::POST('additional/create', 'AdditionalStore')->name('addi_invoice.store');
    Route::get('/additional/invoice/{id}', 'AdditionalInvoiceshow')->name('additional_invoice.show');
    Route::delete('/invoice/delete/{id}', 'destroy')->name('invoice.delete');
    Route::get('/invoice/edit/{id}', 'edit')->name('invoice.edit');
    Route::PUT('/invoice/update/{id}', 'update')->name('invoice.update');
    Route::get('/additional/invoice/create', 'AdditionalInvoice')->name('additional.invoive');
    Route::POST('additional/create', 'AdditionalStore')->name('addi_invoice.store');
    Route::get('/additional/invoice/{id}', 'AdditionalInvoiceshow')->name('additional_invoice.show');

});

Route::controller(ComplaintsController::class)->group(function () {
    Route::get('/superadmin/complaints', 'all_complaints')->name('complaints.index');
    Route::PUT('/superadmin/complaint/update/', 'update')->name('complaints.update');

    Route::get('/get-owner/{flatId}', 'getOwner');
    Route::get('/superadmin/complaints/unsolved', 'unsolved')->name('complaints.unsolved');
    Route::get('/superadmin/complaints/inprogress', 'inprogress')->name('complaints.inprogress');
    Route::get('/superadmin/complaints/resolved', 'resolved')->name('complaints.resolved');
});

Route::controller(ComplaintTypeController::class)->group(function () {
    Route::get('/superadmin/complaint_type', 'index')->name('complaint.type');
    Route::POST('/complaint_type/create', 'store')->name('complaint_type.store');
    Route::put('/complaint_type/update', 'update')->name('complaint_type.update');
    Route::delete('/complaint_type/delete/{id}', 'destroy')->name('complaint_type.delete');
});
Route::controller(MainController::class)->group(function () {
    Route::get('user/dashboard', 'index')->name('user.dashboard');
});

Route::controller(UserInvoiceController::class)->group(function () {
    Route::get('/user/invoice/view/', 'viewInvoice')->name('view.invoice');
    Route::get('/user/additional/invoice', 'viewadditionalinvoice')->name('view_additional.invoice');
});

Route::controller(UserComplaintsController::class)->group(function () {
    Route::get('/user/complaint/create', 'create')->name('complaints.create');
    Route::POST('/complaint/create', 'store')->name('complaints.store');
    Route::get('/user/complaints/action', 'complain_action')->name('action');

    Route::get('/get-owner/{flatId}', 'getOwner');

});

//    Route::controller(DocumentController::class)->group(function () {
//        Route::get('/superadmin/documents/', 'index')->name('document.manage');
//        Route::get('/superadmin/document/create/', 'create')->name('document.create');
//        Route::get('/superadmin/document/edit/{id}', 'edit')->name('document.edit');
//        Route::POST('/document/store', 'store')->name('document.store');
//        Route::delete('/documents/delete/{id}', 'destroy')->name('documents.delete');
//        Route::PUT('/documents/update/{id}', 'update')->name('document.update');
//    });


Route::controller(NoticController::class)->group(function () {
    Route::get('superadmin/manage/notice', 'index')->name('manage.notice');
    Route::POST('superadmin/add/notice', 'store')->name('notic.store');
    Route::PUT('/superadmin/update', 'update')->name('notic.update');
    Route::delete('/superadmin/delete/{id}', 'destroy')->name('notic.delete');
    Route::get('/user/view/notic/', 'view_user_notic')->name('view_user_notic');

});

Route::controller(NOCSController::class)->group(function () {
    Route::get('/superadmin/nocs/', 'index')->name('nocs.index');
    Route::get('/superadmin/nocs/create', 'create')->name('nocs.create');
    Route::get('/superadmin/nocs/edit/{id}', 'edit')->name('nocs.edit');
    Route::POST('/nocs/store/', 'store')->name('noc.store');
    Route::get('NOC/Ceartifce/{id}', 'show')->name('show.noc');
    Route::delete('/nocs/delete/{id}', 'destroy')->name('nocs.delete');
    Route::get('/user/View/NOC', 'user_view_noc')->name('user.view');
});

// SUPER ADMIN PAYROLL
Route::controller(Employee_designation::class)->group(function () {
    Route::get('/superadmin/employee/designation', 'index')->name('employee.designation');
    Route::POST('/designation/add', 'store')->name('employee_designation.store');
    Route::put('/designation/update', 'update')->name('employee_designation.update');
    Route::delete('/designation/delete/{id}', 'destroy')->name('designation.delete');
});

Route::controller(employee_depart::class)->group(function () {
    Route::get('/superadmin/employee/depart', 'index')->name('employee.depart');
    Route::POST('/depart/add', 'store')->name('employee_depart.store');
    Route::put('/depart/update', 'update')->name('employee_depart.update');
    Route::delete('/depart/delete/{id}', 'destroy')->name('depart.delete');

});


Route::controller(EmployeesController::class)->group(function () {
    Route::get('/superadmin/employees', 'index')->name('employees.index');
    Route::get('/superadmin/employees/create', 'create')->name('employees.create');
    Route::Post('/superadmin/employees/store', 'store')->name('employees.store');
    Route::get('/superadmin/employees/edit/{id}', 'edit')->name('employees.edit');
    Route::post('/superadmin/update/{id}', 'update')->name('employees.update');
    Route::get('/superadmin/delete/{id}', 'destroy')->name('employees.delete');
});

Route::controller(PayrollController::class)->group(function () {
    Route::get('/superadmin/payroll', 'index')->name('payroll.index');
    Route::get('/superadmin/payroll/create', 'create')->name('payroll.create');
    Route::post('/superadmin/payroll/store', 'store')->name('payroll.store');
    Route::get('/superadmin/payroll/edit/{id}', 'edit')->name('payroll.edit');
    Route::post('/superadmin/payroll/update/{id}', 'update')->name('payroll.update');
    Route::get('/superadmin/payroll/delete/{id}', 'destroy')->name('payroll.delete');

});

Route::controller(AttendanceController::class)->group(function () {
    Route::get('/superadmin/attendance', 'index')->name('attendance.index');
    Route::get('/superadmin/attendance/create', 'create')->name('attendance.create');
    Route::post('/superadmin/attendance/store', 'store')->name('attendance.store');
    Route::get('/superadmin/attendance/edit/{id}', 'edit')->name('attendance.edit');
    Route::post('/superadmin/attendance/update/{id}', 'update')->name('attendance.update');
    Route::get('/superadmin/attendance/delete/{id}', 'destroy')->name('attendance.delete');
});

Route::middleware(['auth:employee_guard'])->group(function () {
    Route::get('/employee/attendance', [AttendanceController::class, 'showMonthlyAttendance'])->name('employee.attendance');
    Route::get('/employee/attendance/create', [AttendanceController::class, 'showMonthlyAttendanceCreate'])->name('employee.attendance.create');
    Route::post('/attendance/store', [AttendanceController::class, 'showMonthlyAttendanceStore'])->name('employee.attendance.store');
    Route::post('/employee/attendance/check-in', [AttendanceController::class, 'checkIn'])->name('employee.attendance.check-in');
    Route::post('/employee/attendance/check-out', [AttendanceController::class, 'checkOut'])->name('employee.attendance.check-out');
});

Route::controller(LeaveController::class)->group(function () {
    Route::get('superadmin/leave', 'index')->name('leave.index');
    Route::get('superadmin/leave/create', 'create')->name('leave.create');
    Route::post('superadmin/leave/store', 'store')->name('leave.store');
    Route::get('superadmin/leave/edit/{id}', 'edit')->name('leave.edit');
    Route::post('superadmin/leave/update/{id}', 'update')->name('leave.update');
    Route::get('superadmin/leave/delete/{id}', 'destroy')->name('leave.delete');
});

Route::controller(RolesController::class)->group(function () {
    Route::get('superadmin/roles', 'index')->name('role.index');
    Route::get('superadmin/roles/create', 'create')->name('role.create');
    Route::post('superadmin/roles/store', 'store')->name('role.store');
    Route::get('superadmin/roles/edit/{id}', 'edit')->name('role.edit');
    Route::post('superadmin/roles/update/{id}', 'update')->name('role.update');
    Route::get('superadmin/roles/delete/{id}', 'destroy')->name('role.destroy');
});

Route::controller(UserRolesController::class)->group(function () {
    Route::get('superadmin/user_roles', 'index')->name('user_role.index');
    Route::get('superadmin/user_roles/create', 'create')->name('user_role.create');
    Route::post('superadmin/user_role/store', 'store')->name('user_role.store');
    Route::get('superadmin/user_role/edit/{id}', 'edit')->name('user_role.edit');
    Route::post('superadmin/user_role/update/{id}', 'update')->name('user_role.update');
    Route::get('superadmin/user_role/delete/{id}', 'destroy')->name('user_role.destroy');
});

Route::controller(HrNotificationController::class)->group(function () {
    Route::get('superadmin/hr_notification', 'index')->name('hr_notification.index');
    Route::get('superadmin/hr_notification/create', 'create')->name('hr_notification.create');
    Route::post('superadmin/hr_notification/store', 'store')->name('hr_notification.store');
    Route::get('superadmin/hr_notification/edit/{id}', 'edit')->name('hr_notification.edit');
    Route::post('superadmin/hr_notification/update/{id}', 'update')->name('hr_notification.update');
    Route::get('superadmin/hr_notification/delete/{id}', 'destroy')->name('hr_notification.destroy');
});
Route::controller(NotificationController::class)->group(function () {
    Route::get('superadmin/notification', 'index')->name('notification.index');
    Route::get('superadmin/notification/create', 'create')->name('notification.create');
    Route::post('superadmin/notification/store', 'store')->name('notification.store');
    Route::get('superadmin/notification/edit/{id}', 'edit')->name('notification.edit');
    Route::post('superadmin/notification/update/{id}', 'update')->name('notification.update');
    Route::get('superadmin/notification/delete/{id}', 'destroy')->name('notification.destroy');
});

Route::controller(ActivityLogsController::class)->group(function () {
    Route::get('superadmin/activity_logs', 'index')->name('activity_logs.index');
    Route::get('superadmin/activity_logs/create', 'create')->name('activity_logs.create');
    Route::post('superadmin/activity_logs/store', 'store')->name('activity_logs.store');
    Route::get('superadmin/activity_logs/edit/{id}', 'edit')->name('activity_logs.edit');
    Route::post('superadmin/activity_logs/update/{id}', 'update')->name('activity_logs.update');
    Route::get('superadmin/activity_logs/delete/{id}', 'destroy')->name('activity_logs.destroy');
});

Route::controller(PermissionController::class)->group(function () {
    Route::get('superadmin/permissions', 'index')->name('permissions.index');
    Route::get('superadmin/permissions/create', 'create')->name('permissions.create');
    Route::post('superadmin/permissions/store', 'store')->name('permissions.store');
    Route::get('superadmin/permissions/edit/{id}', 'edit')->name('permissions.edit');
    Route::post('superadmin/permissions/update/{id}', 'update')->name('permissions.update');
    Route::get('superadmin/permissions/delete/{id}', 'destroy')->name('permissions.destroy');
});

Route::controller(BookingController::class)->group(function () {
    Route::get('superadmin/booking', 'index')->name('booking.index');
    Route::get('superadmin/booking/create', 'create')->name('booking.create');
    Route::post('superadmin/booking/store', 'store')->name('booking.store');
    Route::get('superadmin/booking/edit/{id}', 'edit')->name('booking.edit');
    Route::post('superadmin/booking/update/{id}', 'update')->name('booking.update');
    Route::get('superadmin/booking/delete/{id}', 'destroy')->name('booking.destroy');
});
Route::controller(CommunityHallBookingController::class)->group(function () {
    Route::get('superadmin/community_hall', 'index')->name('community_hall.index');
    Route::get('superadmin/community_hall/create', 'create')->name('community_hall.create');
    Route::post('superadmin/community_hall/store', 'store')->name('community_hall.store');
    Route::get('superadmin/community_hall/edit/{id}', 'edit')->name('community_hall.edit');
    Route::post('superadmin/community_hall/update/{id}', 'update')->name('community_hall.update');
    Route::get('superadmin/community_hall/delete/{id}', 'destroy')->name('community_hall.destroy');
});
Route::controller(TenancyController::class)->group(function () {
    Route::get('superadmin/Tenancy', 'index')->name('tenancy.index');
    Route::get('superadmin/Tenancy/create', 'create')->name('tenancy.create');
    Route::post('superadmin/Tenancy/store', 'store')->name('tenancy.store');
    Route::get('superadmin/Tenancy/edit/{id}', 'edit')->name('tenancy.edit');
    Route::post('superadmin/Tenancy/update/{id}', 'update')->name('tenancy.update');
    Route::get('superadmin/Tenancy/delete/{id}', 'destroy')->name('tenancy.destroy');
});
Route::controller(DocumentController::class)->group(function () {
    Route::get('superadmin/resident_document', 'index')->name('resident_document.index');
    Route::get('superadmin/resident_document/create', 'create')->name('resident_document.create');
    Route::post('superadmin/resident_document/store', 'store')->name('resident_document.store');
    Route::get('superadmin/resident_document/edit/{id}', 'edit')->name('resident_document.edit');
    Route::post('superadmin/resident_document/update/{id}', 'update')->name('resident_document.update');
    Route::get('superadmin/resident_document/delete/{id}', 'destroy')->name('resident_document.destroy');
});
Route::controller(ServiceAccessController::class)->group(function () {
    Route::get('superadmin/service_access', 'index')->name('service_access.index');
    Route::get('superadmin/service_access/create', 'create')->name('service_access.create');
    Route::post('superadmin/service_access/store', 'store')->name('service_access.store');
    Route::get('superadmin/service_access/edit/{id}', 'edit')->name('service_access.edit');
    Route::post('superadmin/service_access/update/{id}', 'update')->name('service_access.update');
    Route::get('superadmin/service_access/delete/{id}', 'destroy')->name('service_access.destroy');
});
Route::controller(ParkingController::class)->group(function () {
    Route::get('superadmin/parking', 'index')->name('parking.index');
    Route::get('superadmin/parking/create', 'create')->name('parking.create');
    Route::post('superadmin/parking/store', 'store')->name('parking.store');
    Route::get('superadmin/parking/edit/{id}', 'edit')->name('parking.edit');
    Route::post('superadmin/parking/update/{id}', 'update')->name('parking.update');
    Route::get('superadmin/parking/delete/{id}', 'destroy')->name('parking.destroy');
});
Route::controller(CarStickerController::class)->group(function () {
    Route::get('superadmin/carsticker', 'index')->name('carsticker.index');
    Route::get('superadmin/carsticker/create', 'create')->name('carsticker.create');
    Route::post('superadmin/carsticker/store', 'store')->name('carsticker.store');
    Route::get('superadmin/carsticker/edit/{id}', 'edit')->name('carsticker.edit');
    Route::post('superadmin/carsticker/update/{id}', 'update')->name('carsticker.update');
    Route::get('superadmin/carsticker/delete/{id}', 'destroy')->name('carsticker.destroy');
    Route::get('car-sticker/pdf/{id}', 'generatePdf')->name('car.sticker.pdf');

});
Route::controller(SalaryController::class)->group(function () {
    Route::get('/superadmin/process-salaries/{id}', 'processMonthlySalaries')->name('admin.process_salaries');
});


// SUPER ADMIN INVENTORY MANAGEMENT

Route::controller(FixedAssetsController::class)->group(function () {
    Route::get('/superadmin/fixed/assets/', 'index')->name('assets.index');
    Route::get('/superadmin/fixed/create/', 'create')->name('assets.create');
    Route::POST('/create/store/', 'store')->name('assets.store');
    Route::get('/superadmin/fixed/edit/{id}', 'edit')->name('assets.edit');

});

Route::controller(CardController::class)->group(function () {
    Route::get('/superadmin/card/', 'index')->name('card.index');
    Route::get('/superadmin/card/create/', 'create')->name('card.create');
    Route::get('/superadmin/card/edit/{id}', 'edit')->name('card.edit');
});

Route::controller(InventoryController::class)->group(function () {
    Route::get('/superadmin/inventory', 'index')->name('inventory.index');
    Route::get('/superadmin/inventory/create/', 'create')->name('inventory.create');
    Route::get('/superadmin/inventory/edit/{id}', 'edit')->name('inventory.edit');
});

// FLAT USER Panel Route

Route::controller(UserInvoiceController::class)->group(function () {
    Route::get('/user/invoice/view/', 'viewInvoice')->name('view.invoice');
    Route::get('/user/additional/invoice', 'viewadditionalinvoice')->name('view_additional.invoice');
});

Route::controller(UserComplaintsController::class)->group(function () {
    Route::get('/user/complaint/create', 'create')->name('complaints.create');
    Route::POST('/complaint/create', 'store')->name('complaints.store');
    Route::get('/user/complaints/action', 'complain_action')->name('action');

    Route::get('/get-owner/{flatId}', 'getOwner');
});

Route::controller(UserRentController::class)->group(function () {
    Route::get('/user/rent/index', 'index')->name('rents.index');
    Route::get('/user/rent/create', 'create')->name('rents.create');
    Route::POST('/user/rent/store', 'store')->name('rents.store');
    Route::get('/user/rent/action', 'rent_action')->name('rent.action');
    Route::get('/superadmin/rent/superadminindex', 'superadminindex')->name('superadminrents.index');
    Route::get('/superadmin/rent/edit/{id}', 'edit')->name('superadminrents.edit');
    Route::POST('/superadmin/rent/update/{id}', 'update')->name('superadminrents.update');

//    Route::get('/get-owner/{flatId}', 'getOwner');
});
Route::controller(UserRentController::class)->group(function () {
    Route::get('/user/rent/index', 'index')->name('rents.index');
    Route::get('/user/rent/create', 'create')->name('rents.create');
    Route::POST('/user/rent/store', 'store')->name('rents.store');
    Route::get('/user/rent/action', 'rent_action')->name('rent.action');
    Route::get('/superadmin/rent/superadminindex', 'superadminindex')->name('superadminrents.index');
    Route::get('/superadmin/rent/edit/{id}', 'edit')->name('superadminrents.edit');
    Route::POST('/superadmin/rent/update/{id}', 'update')->name('superadminrents.update');

//    Route::get('/get-owner/{flatId}', 'getOwner');
});

Route::controller(RegisterationController::class)->group(function () {
    Route::get('/user/Registeration', 'register')->name('user.register');
    Route::POST('/user/Registeration/create', 'store')->name('create');
    Route::get('/registration/{id}/card', 'showcard')->name('registration.card');

});

Route::controller(GuestTemporaryController::class)->group(function () {
    Route::get('/user/manage/guest/', 'index')->name('manage.card');
    Route::get('/user/temporary/guest/register/', 'create')->name('create.temporary.guest');
    Route::POST('/temporary/create/', 'store')->name('guest.store');
    Route::get('/superadmin/guest/manage/', 'admin_view')->name('guest.view.admin');
    Route::put('/superadmin/guest/', 'guest_checkout_admin')->name('guest.update');
    Route::put('/superadmin/guest/update/{id}', 'update')->name('guest.update.user');
    Route::get('/user/guest/card/edit/{id}', 'user_guest_edit')->name('user.guest.edit');
});

// Employee Panel Route
Route::controller(EmployeeLeaveController::class)->group(function () {
    Route::get('/employee/leave/', 'index')->name('action.leave');
    Route::get('/employee/leave/create/', 'create')->name('employee.leave');
    Route::POST('/employee/leave/store/', 'store')->name('employee.store');
});


require __DIR__ . '/auth.php';
