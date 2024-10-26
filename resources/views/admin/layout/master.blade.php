<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="/assets/images/favicon-32x32.png" type="image/png">
    <!--plugins-->
    <link href="/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet">
    <link href="/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet">
    <link href="/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- loader-->
    <link href="/assets/css/pace.min.css" rel="stylesheet">
    <script src="/assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="../../../css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="/assets/css/app.css" rel="stylesheet">
    <link href="/assets/css/icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>House Management | @yield('page-title')</title>
</head>

<body class="bg-theme bg-theme2">
@php
    $prefix = Request::route()->getPrefix();
@endphp
        <!--wrapper-->
<div class="wrapper">
    <!--sidebar wrapper -->
    <div class="sidebar-wrapper" data-simplebar="true">
        <div class="sidebar-header">
            <div>
                <img src="/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
            </div>
            <div>
                <h4 class="logo-text">BMS</h4>
            </div>
            <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
            </div>
        </div>
        <!--navigation-->
        <ul class="menus" id="menu">
            <li class="mm-active">
                <a href="{{route('building_admin.dashboard')}}">

                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            @php
                if (auth()->guard('building_admin')->check()) {
                    $buildingadmin = auth()->guard('building_admin')->user();
                    $features = $buildingadmin->getBuildingAccessFeatures();
                } else {
                    echo "<script>window.location.href = '" . route('building_admin.login') . "';</script>";
                    exit;
                }
            @endphp
            @if(in_array('package', $features))
                <li {{ ($prefix == '/package') ? 'active' : '' }}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i></div>
                        <div class="menu-title">Packages</div>
                    </a>
                    <ul>
                        <li><a href="{{ route('packages.create') }}"><i class='bx bx-radio-circle'></i>Add Package</a>
                        </li>
                        <li><a href="{{ route('packages.backendindex') }}"><i class='bx bx-radio-circle'></i>Manage
                                Package</a></li>
                    </ul>
                </li>
            @endif
            @if(in_array('block', $features))
                <li {{ ($prefix == '/block') ? 'active' : '' }}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i></div>
                        <div class="menu-title">Block</div>
                    </a>
                    <ul>
                        <li><a href="{{ route('block.index') }}"><i class='bx bx-radio-circle'></i>Manage Block</a></li>
                    </ul>
                </li>
            @endif
            @if(in_array('invoice_type', $features))
                <li {{($prefix == '/invoice_type') ? 'active' : ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i></div>
                        <div class="menu-title">Invoice Type</div>
                    </a>
                    <ul>
                        <li><a href="{{route('invoice.type')}}"><i class='bx bx-radio-circle'></i>Manage Type</a></li>
                    </ul>
                </li>
            @endif
            @if(in_array('flat_area', $features))
                <li {{($prefix  == '/flat_area')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">Flat Area</div>
                    </a>
                    <ul>
                        <li><a href="{{route('flatarea.create')}}"><i class='bx bx-radio-circle'></i>Add Flat Area</a>
                        </li>
                        <li><a href="{{route('flatarea.index')}}"><i class='bx bx-radio-circle'></i>Manage Flat Area</a>
                        </li>

                    </ul>
                </li>
            @else
            @endif
            @if(in_array('flat', $features))
                <li {{($prefix  == '/flat')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">Flats</div>
                    </a>
                    <ul>
                        <li><a href="{{route('flat.create')}}"><i class='bx bx-radio-circle'></i>Add Flat</a>
                        </li>
                        <li><a href="{{route('flat.index')}}"><i class='bx bx-radio-circle'></i>Manage Flat</a>
                        </li>

                    </ul>
                </li>
            @else
            @endif
            @if(in_array('invoice', $features))
                <li {{($prefix  == '/invoice')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">Invoice</div>
                    </a>
                    <ul>
                        <li><a href="{{route('invoice.create')}}"><i class='bx bx-radio-circle'></i>Add All User Invoice</a>
                        </li>

                        <li><a href="{{route('additional.invoive')}}"><i class='bx bx-radio-circle'></i>Add Additional
                                User Invoice</a>
                        </li>
                        <li><a href="{{route('invoice.index')}}"><i class='bx bx-radio-circle'></i>Manage Invoice</a>
                        </li>
                    </ul>
                </li>
            @else
            @endif
            @if(in_array('allotment', $features))
                <li {{($prefix  == '/allotment')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">Allotments</div>
                    </a>
                    <ul>
                        <li><a href="{{ route('allotments.create') }}"><i class='bx bx-radio-circle'></i>Add Allotments</a>
                        </li>
                        <li><a href="{{ route('allotments.index') }}"><i class='bx bx-radio-circle'></i>Manage
                                Allotments</a>
                        </li>
                    </ul>
                </li>
            @else
            @endif
            @if(in_array('complaint', $features))
                <li {{($prefix  == '/complaint')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">Complaints</div>
                    </a>
                    <ul>
                        <li><a href="{{route('complaints.create')}}"><i class='bx bx-radio-circle'></i>Add
                                Complaints</a>
                        </li>
                        <li><a href="{{route('complaints.unsolved')}}"><i class='bx bx-radio-circle'></i>Unresolved</a>
                        </li>
                        <li><a href="{{route('complaints.inprogress')}}"><i
                                        class='bx bx-radio-circle'></i>In-progress</a>
                        </li>
                        <li><a href="{{route('complaints.resolved')}}"><i class='bx bx-radio-circle'></i>Resolved</a>
                        </li>
                        <li><a href="{{route('complaints.index')}}"><i class='bx bx-radio-circle'></i>All Complaints</a>
                        </li>
                    </ul>
                </li>
            @else
            @endif
            @if(in_array('adminuserregister', $features))
                <li {{($prefix  == '/adminuserregister')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">Admin User Register</div>
                    </a>
                    <ul>
                        <li><a href="{{route('all.superadmin.user')}}"><i class='bx bx-radio-circle'></i>Admin User
                                Register</a>
                        </li>
                    </ul>
                </li>
            @else
            @endif
            @if(in_array('employee', $features))
                <li {{($prefix  == '/employee')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">Employees</div>
                    </a>
                    <ul>
                        <li><a href="{{route('employees.index')}}"><i class='bx bx-radio-circle'></i>Manage
                                Employees</a>
                        </li>
                        <li><a href="{{route('employees.create')}}"><i class='bx bx-radio-circle'></i>Add Employees</a>
                        </li>
                    </ul>
                </li>
            @else
            @endif
            @if(in_array('payroll', $features))
                <li {{($prefix  == '/payroll')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">Payroll</div>
                    </a>
                    <ul>
                        <li><a href="{{route('payroll.index')}}"><i class='bx bx-radio-circle'></i>Manage Payroll</a>
                        </li>
                        <li><a href="{{route('payroll.create')}}"><i class='bx bx-radio-circle'></i>Add Payroll</a>
                        </li>
                    </ul>
                </li>
            @else
            @endif
            @if(in_array('attendance', $features))
                <li {{($prefix  == '/attendance')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">Attendance</div>
                    </a>
                    <ul>
                        <li><a href="{{route('attendance.index')}}"><i class='bx bx-radio-circle'></i>Manage Attendance</a>
                        </li>
                        <li><a href="{{route('attendance.create')}}"><i class='bx bx-radio-circle'></i>Add
                                Attendance</a>
                        </li>
                    </ul>
                </li>
            @else
            @endif
            @if(in_array('leave', $features))
                <li {{($prefix  == '/leave')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">Leave</div>
                    </a>
                    <ul>
                        <li><a href="{{route('leave.index')}}"><i class='bx bx-radio-circle'></i>Manage Leave</a>
                        </li>
                        <li><a href="{{route('leave.create')}}"><i class='bx bx-radio-circle'></i>Add Leave</a>
                        </li>
                    </ul>
                </li>
            @else
            @endif
            @if(in_array('hr_notification', $features))
                <li {{($prefix  == '/hr_notification')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">Hr Notification</div>
                    </a>
                    <ul>
                        <li><a href="{{route('hr_notification.index')}}"><i class='bx bx-radio-circle'></i>Manage Hr
                                Notification</a>
                        </li>
                        <li><a href="{{route('hr_notification.create')}}"><i class='bx bx-radio-circle'></i>Add HR
                                Notification</a>
                        </li>
                    </ul>
                    <ul>
                        @if(in_array('notification', $features))
                            <li {{($prefix  == '/notification')? 'active': ''}}>
                                <a href="javascript:;" class="has-arrow">
                                    <div class="parent-icon"><i class="bx bx-category"></i>
                                    </div>
                                    <div class="menu-title">Notification</div>
                                </a>
                                <ul>
                                    <li><a href="{{route('notification.index')}}"><i class='bx bx-radio-circle'></i>Manage
                                            Notification</a>
                                    </li>
                                    <li><a href="{{route('notification.create')}}"><i class='bx bx-radio-circle'></i>Add
                                            Notification</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </li>
            @else
            @endif
            @if(in_array('role', $features))
                <li {{($prefix  == '/role')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">Roles</div>
                    </a>
                    <ul>
                        <li><a href="{{route('role.index')}}"><i class='bx bx-radio-circle'></i>Manage Roles</a>
                        </li>
                        <li><a href="{{route('role.create')}}"><i class='bx bx-radio-circle'></i>Add Roles</a>
                        </li>
                    </ul>
                </li>
            @else
            @endif
            @if(in_array('user_role', $features))
                <li {{($prefix  == '/user_role')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">User Role</div>
                    </a>
                    <ul>
                        <li><a href="{{route('user_role.index')}}"><i class='bx bx-radio-circle'></i>Manage User
                                Role</a>
                        </li>
                        <li><a href="{{route('user_role.create')}}"><i class='bx bx-radio-circle'></i>Add User Role</a>
                        </li>
                    </ul>
                </li>
            @else
            @endif
            @if(in_array('activity_logs', $features))
                <li {{($prefix  == '/activity_logs')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">Activity Logs</div>
                    </a>
                    <ul>
                        <li><a href="{{route('activity_logs.index')}}"><i class='bx bx-radio-circle'></i>Manage Activity
                                Log</a>
                        </li>
                        <li><a href="{{route('activity_logs.create')}}"><i class='bx bx-radio-circle'></i>Add Activity
                                Log</a>
                        </li>
                    </ul>
                </li>
            @else
            @endif
            @if(in_array('permissions', $features))
                <li {{($prefix  == '/permissions')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">Permissions</div>
                    </a>
                    <ul>
                        <li><a href="{{route('permissions.index')}}"><i class='bx bx-radio-circle'></i>Manage
                                Permissions</a>
                        </li>
                        <li><a href="{{route('permissions.create')}}"><i class='bx bx-radio-circle'></i>Add Permissions</a>
                        </li>
                    </ul>
                </li>
            @else
            @endif
            @if(in_array('booking', $features))
                <li {{($prefix  == '/booking')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">Booking</div>
                    </a>
                    <ul>
                        <li><a href="{{route('booking.index')}}"><i class='bx bx-radio-circle'></i>Manage Booking</a>
                        </li>
                        <li><a href="{{route('booking.create')}}"><i class='bx bx-radio-circle'></i>Add Booking</a>
                        </li>
                    </ul>
                </li>
            @else
            @endif
            @if(in_array('comunity_hall_booking', $features))
                <li {{($prefix  == '/comunity_hall_booking')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">CommunityHallBooking</div>
                    </a>
                    <ul>
                        <li><a href="{{route('community_hall.index')}}"><i class='bx bx-radio-circle'></i>Manage
                                HallBooking</a>
                        </li>
                        <li><a href="{{route('community_hall.create')}}"><i class='bx bx-radio-circle'></i>Add
                                HallBooking</a>
                        </li>
                    </ul>
                </li>
            @else
            @endif
            @if(in_array('tenancy', $features))
                <li {{($prefix  == '/tenancy')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">Tenancy</div>
                    </a>
                    <ul>
                        <li><a href="{{route('tenancy.index')}}"><i class='bx bx-radio-circle'></i>Manage Tenancy</a>
                        </li>
                        <li><a href="{{route('tenancy.create')}}"><i class='bx bx-radio-circle'></i>Add Tenancy</a>
                        </li>
                    </ul>
                </li>
            @else
            @endif
            @if(in_array('resident_document', $features))
                <li {{($prefix  == '/resident_document')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">Resident Document</div>
                    </a>
                    <ul>
                        <li><a href="{{route('resident_document.index')}}"><i class='bx bx-radio-circle'></i>Manage
                                Resident
                                Document</a>
                        </li>
                        <li><a href="{{route('resident_document.create')}}"><i class='bx bx-radio-circle'></i>Add
                                Resident
                                Document</a>
                        </li>
                    </ul>
                </li>
            @else
            @endif
            @if(in_array('service_access', $features))
                <li {{($prefix  == '/service_access')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">Service Access</div>
                    </a>
                    <ul>
                        <li><a href="{{route('service_access.index')}}"><i class='bx bx-radio-circle'></i>Manage Service
                                Access</a>
                        </li>
                        <li><a href="{{route('service_access.create')}}"><i class='bx bx-radio-circle'></i>Add Service
                                Access</a>
                        </li>
                    </ul>
                </li>
            @else
            @endif
            @if(in_array('parking', $features))
                <li {{($prefix  == '/parking')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">Parking</div>
                    </a>
                    <ul>
                        <li><a href="{{route('parking.index')}}"><i class='bx bx-radio-circle'></i>Manage Parking</a>
                        </li>
                        <li><a href="{{route('parking.create')}}"><i class='bx bx-radio-circle'></i>Add Parking</a>
                        </li>
                    </ul>
                </li>
            @else
            @endif
            @if(in_array('car_sticker', $features))
                <li {{($prefix  == '/car_sticker')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">Car Sticker</div>
                    </a>
                    <ul>
                        <li><a href="{{route('carsticker.index')}}"><i class='bx bx-radio-circle'></i>Manage Car Sticker</a>
                        </li>
                        <li><a href="{{route('carsticker.create')}}"><i class='bx bx-radio-circle'></i>Add Car
                                Sticker</a>
                        </li>
                    </ul>
                </li>
            @else
            @endif
            @if(in_array('complaint_type', $features))
                <li {{($prefix  == '/complaint_type')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i></div>
                        <div class="menu-title">Complaint Type</div>
                    </a>
                    <ul>
                        <li><a href="{{route('complaint.type')}}"><i class='bx bx-radio-circle'></i>Manage Complaint
                                Type</a></li>
                    </ul>
                </li>
            @else
            @endif
            @if(in_array('employee_depart', $features))
                <li {{($prefix  == '/employee_depart')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i></div>
                        <div class="menu-title">Employee Depart</div>
                    </a>
                    <ul>
                        <li><a href="{{route('employee.depart')}}"><i class='bx bx-radio-circle'></i>Manage Employee
                                Depart</a></li>
                    </ul>
                </li>
            @else
            @endif
            @if(in_array('employee_designation', $features))
                <li {{($prefix  == '/employee_designation')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i></div>
                        <div class="menu-title">Employee Designation</div>
                    </a>
                    <ul>
                        <li><a href="{{route('employee.designation')}}"><i class='bx bx-radio-circle'></i>Manage
                                Employee Designation</a></li>
                    </ul>
                </li>
            @else
            @endif
            @if(in_array('manage_tenants_request', $features))
                <li {{($prefix  == '/manage_tenants_request')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i></div>
                        <div class="menu-title">Manage Tenants Request</div>
                    </a>
                    <ul>
                        <li><a href="{{route('superadminrents.index')}}"><i class='bx bx-radio-circle'></i>Manage
                                Tenants</a></li>
                    </ul>
                </li>
            @else
            @endif
            @if(in_array('manage_notice', $features))
                <li {{($prefix  == '/manage_notice')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i></div>
                        <div class="menu-title">Manage Notice</div>
                    </a>
                    <ul>
                        <li><a href="{{route('manage.notice')}}"><i class='bx bx-radio-circle'></i>Manage
                                Notice</a></li>

                    </ul>
                </li>
            @else
            @endif
            @if(in_array('manage_nocs', $features))
                <li {{($prefix  == '/manage_nocs')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i></div>
                        <div class="menu-title">Manage NOC,S</div>
                    </a>
                    <ul>
                        <li><a href="{{route('nocs.create')}}"><i class='bx bx-radio-circle'></i>Ganrate Noc,s</a>
                        </li>
                        <li><a href="{{route('nocs.index')}}"><i class='bx bx-radio-circle'></i>Manage
                                Noc,s</a></li>

                    </ul>
                </li>
            @else
            @endif
            @if(in_array('guest_information', $features))
                <li {{($prefix  == '/guest_information')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i></div>
                        <div class="menu-title">Guest Information</div>
                    </a>
                    <ul>
                        <li><a href="{{route('nocs.create')}}"><i class='bx bx-radio-circle'></i>Ganrate Noc,s</a></li>
                        <li><a href="{{route('guest.view.admin')}}"><i class='bx bx-radio-circle'></i>Guest Card</a>
                        </li>

                    </ul>
                </li>
            @else
            @endif
            @if(in_array('fixed_assets', $features))
                <li {{($prefix  == '/fixed_assets')? 'active': ''}}>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i></div>
                        <div class="menu-title">Fixed Assets</div>
                    </a>
                    <ul>
                        <li><a href="{{route('assets.create')}}"><i
                                        class='bx bx-radio-circle'></i>Create</a></li>
                        <li><a href="{{route('assets.index')}}"><i class='bx bx-radio-circle'></i>Manage</a>
                        </li>

                    </ul>
                </li>
            @else
            @endif
            {{--            <li>--}}
            {{--                <a href="javascript:;" class="has-arrow">--}}
            {{--                    <div class="parent-icon"><i class="bx bx-category"></i></div>--}}
            {{--                    <div class="menu-title">Manage Document</div>--}}
            {{--                </a>--}}
            {{--                <ul>--}}
            {{--                    <li><a href="{{route('document.manage')}}"><i class='bx bx-radio-circle'></i>Manage--}}
            {{--                            Document</a></li>--}}
            {{--                    <li><a href="{{route('document.create')}}"><i class='bx bx-radio-circle'></i>Add Document</a>--}}
            {{--                    </li>--}}
            {{--                </ul>--}}
            {{--            </li>--}}
        </ul>
        <!--end navigation-->
    </div>
    <!--end sidebar wrapper -->
    <!--start header -->
    <header>
        <div class="topbar d-flex align-items-center">
            <nav class="navbar navbar-expand gap-3">
                <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                </div>
                <div class="search-bar flex-grow-1">
                    <div class="position-relative search-bar-box">
                        <input type="text" class="form-control search-control" placeholder="Type to search..."> <span
                                class="position-absolute top-50 search-show translate-middle-y"><i
                                    class='bx bx-search'></i></span>
                        <span class="position-absolute top-50 search-close translate-middle-y"><i
                                    class='bx bx-x'></i></span>
                    </div>
                </div>
                <div class="top-menu ms-auto">
                    <ul class="navbar-nav align-items-center gap-1">
                        <li class="nav-item mobile-search-icon d-flex d-lg-none" data-bs-toggle="modal"
                            data-bs-target="#SearchModal">
                            <a class="nav-link" href="avascript:;"><i class='bx bx-search'></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown dropdown-laungauge d-none d-sm-flex">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="avascript:;"
                               data-bs-toggle="dropdown"><img src="/assets/images/county/02.png" width="22" alt="">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
                                                src="/assets/images/county/01.png" width="20" alt=""><span class="ms-2">English</span></a>
                                </li>
                                <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
                                                src="/assets/images/county/02.png" width="20" alt=""><span class="ms-2">Catalan</span></a>
                                </li>
                                <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
                                                src="/assets/images/county/03.png" width="20" alt=""><span class="ms-2">French</span></a>
                                </li>
                                <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
                                                src="/assets/images/county/04.png" width="20" alt=""><span class="ms-2">Belize</span></a>
                                </li>
                                <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
                                                src="/assets/images/county/05.png" width="20" alt=""><span class="ms-2">Colombia</span></a>
                                </li>
                                <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
                                                src="/assets/images/county/06.png" width="20" alt=""><span class="ms-2">Spanish</span></a>
                                </li>
                                <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
                                                src="/assets/images/county/07.png" width="20" alt=""><span class="ms-2">Georgian</span></a>
                                </li>
                                <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
                                                src="/assets/images/county/08.png" width="20" alt=""><span class="ms-2">Hindi</span></a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown dropdown-app">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"
                               href="javascript:;"><i class='bx bx-grid-alt'></i></a>
                            <div class="dropdown-menu dropdown-menu-end p-0">
                                <div class="app-container p-2 my-2">
                                    <div class="row gx-0 gy-2 row-cols-3 justify-content-center p-2">
                                        <div class="col">
                                            <a href="javascript:;">
                                                <div class="app-box text-center">
                                                    <div class="app-icon">
                                                        <img src="/assets/images/app/slack.png" width="30" alt="">
                                                    </div>
                                                    <div class="app-name">
                                                        <p class="mb-0 mt-1">Slack</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="javascript:;">
                                                <div class="app-box text-center">
                                                    <div class="app-icon">
                                                        <img src="/assets/images/app/behance.png" width="30" alt="">
                                                    </div>
                                                    <div class="app-name">
                                                        <p class="mb-0 mt-1">Behance</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="javascript:;">
                                                <div class="app-box text-center">
                                                    <div class="app-icon">
                                                        <img src="/assets/images/app/google-drive.png" width="30"
                                                             alt="">
                                                    </div>
                                                    <div class="app-name">
                                                        <p class="mb-0 mt-1">Dribble</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="javascript:;">
                                                <div class="app-box text-center">
                                                    <div class="app-icon">
                                                        <img src="/assets/images/app/outlook.png" width="30" alt="">
                                                    </div>
                                                    <div class="app-name">
                                                        <p class="mb-0 mt-1">Outlook</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="javascript:;">
                                                <div class="app-box text-center">
                                                    <div class="app-icon">
                                                        <img src="/assets/images/app/github.png" width="30" alt="">
                                                    </div>
                                                    <div class="app-name">
                                                        <p class="mb-0 mt-1">GitHub</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="javascript:;">
                                                <div class="app-box text-center">
                                                    <div class="app-icon">
                                                        <img src="/assets/images/app/stack-overflow.png" width="30"
                                                             alt="">
                                                    </div>
                                                    <div class="app-name">
                                                        <p class="mb-0 mt-1">Stack</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="javascript:;">
                                                <div class="app-box text-center">
                                                    <div class="app-icon">
                                                        <img src="/assets/images/app/figma.png" width="30" alt="">
                                                    </div>
                                                    <div class="app-name">
                                                        <p class="mb-0 mt-1">Stack</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="javascript:;">
                                                <div class="app-box text-center">
                                                    <div class="app-icon">
                                                        <img src="/assets/images/app/twitter.png" width="30" alt="">
                                                    </div>
                                                    <div class="app-name">
                                                        <p class="mb-0 mt-1">Twitter</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="javascript:;">
                                                <div class="app-box text-center">
                                                    <div class="app-icon">
                                                        <img src="/assets/images/app/google-calendar.png" width="30"
                                                             alt="">
                                                    </div>
                                                    <div class="app-name">
                                                        <p class="mb-0 mt-1">Calendar</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="javascript:;">
                                                <div class="app-box text-center">
                                                    <div class="app-icon">
                                                        <img src="/assets/images/app/spotify.png" width="30" alt="">
                                                    </div>
                                                    <div class="app-name">
                                                        <p class="mb-0 mt-1">Spotify</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="javascript:;">
                                                <div class="app-box text-center">
                                                    <div class="app-icon">
                                                        <img src="/assets/images/app/google-photos.png" width="30"
                                                             alt="">
                                                    </div>
                                                    <div class="app-name">
                                                        <p class="mb-0 mt-1">Photos</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="javascript:;">
                                                <div class="app-box text-center">
                                                    <div class="app-icon">
                                                        <img src="/assets/images/app/pinterest.png" width="30" alt="">
                                                    </div>
                                                    <div class="app-name">
                                                        <p class="mb-0 mt-1">Photos</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="javascript:;">
                                                <div class="app-box text-center">
                                                    <div class="app-icon">
                                                        <img src="/assets/images/app/linkedin.png" width="30" alt="">
                                                    </div>
                                                    <div class="app-name">
                                                        <p class="mb-0 mt-1">linkedin</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="javascript:;">
                                                <div class="app-box text-center">
                                                    <div class="app-icon">
                                                        <img src="/assets/images/app/dribble.png" width="30" alt="">
                                                    </div>
                                                    <div class="app-name">
                                                        <p class="mb-0 mt-1">Dribble</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="javascript:;">
                                                <div class="app-box text-center">
                                                    <div class="app-icon">
                                                        <img src="/assets/images/app/youtube.png" width="30" alt="">
                                                    </div>
                                                    <div class="app-name">
                                                        <p class="mb-0 mt-1">YouTube</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="javascript:;">
                                                <div class="app-box text-center">
                                                    <div class="app-icon">
                                                        <img src="/assets/images/app/google.png" width="30" alt="">
                                                    </div>
                                                    <div class="app-name">
                                                        <p class="mb-0 mt-1">News</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="javascript:;">
                                                <div class="app-box text-center">
                                                    <div class="app-icon">
                                                        <img src="/assets/images/app/envato.png" width="30" alt="">
                                                    </div>
                                                    <div class="app-name">
                                                        <p class="mb-0 mt-1">Envato</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="javascript:;">
                                                <div class="app-box text-center">
                                                    <div class="app-icon">
                                                        <img src="/assets/images/app/safari.png" width="30" alt="">
                                                    </div>
                                                    <div class="app-name">
                                                        <p class="mb-0 mt-1">Safari</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                    </div><!--end row-->

                                </div>
                            </div>
                        </li>

                        <li class="nav-item dropdown dropdown-large">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                               data-bs-toggle="dropdown"><span class="alert-count">7</span>
                                <i class='bx bx-bell'></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:;">
                                    <div class="msg-header">
                                        <p class="msg-header-title">Notifications</p>
                                        <p class="msg-header-badge">8 New</p>
                                    </div>
                                </a>
                                <div class="header-notifications-list">
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="user-online">
                                                <img src="/assets/images/avatars/avatar-1.png" class="msg-avatar"
                                                     alt="user avatar">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">Daisy Anderson<span class="msg-time float-end">5 sec
												ago</span></h6>
                                                <p class="msg-info">The standard chunk of lorem</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="notify bg-light-danger text-danger">dc
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">New Orders <span class="msg-time float-end">2 min
												ago</span></h6>
                                                <p class="msg-info">You have recived new orders</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="user-online">
                                                <img src="/assets/images/avatars/avatar-2.png" class="msg-avatar"
                                                     alt="user avatar">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">Althea Cabardo <span class="msg-time float-end">14
												sec ago</span></h6>
                                                <p class="msg-info">Many desktop publishing packages</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="notify bg-light-success text-success">
                                                <img src="/assets/images/app/outlook.png" width="25" alt="user avatar">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">Account Created<span class="msg-time float-end">28 min
												ago</span></h6>
                                                <p class="msg-info">Successfully created new email</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="notify bg-light-info text-info">Ss
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">New Product Approved <span
                                                            class="msg-time float-end">2 hrs ago</span></h6>
                                                <p class="msg-info">Your new product has approved</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="user-online">
                                                <img src="/assets/images/avatars/avatar-4.png" class="msg-avatar"
                                                     alt="user avatar">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">Katherine Pechon <span class="msg-time float-end">15
												min ago</span></h6>
                                                <p class="msg-info">Making this the first true generator</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="notify bg-light-success text-success"><i
                                                        class='bx bx-check-square'></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">Your item is shipped <span
                                                            class="msg-time float-end">5 hrs
												ago</span></h6>
                                                <p class="msg-info">Successfully shipped your item</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="notify bg-light-primary">
                                                <img src="/assets/images/app/github.png" width="25" alt="user avatar">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">New 24 authors<span class="msg-time float-end">1 day
												ago</span></h6>
                                                <p class="msg-info">24 new authors joined last week</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="user-online">
                                                <img src="/assets/images/avatars/avatar-8.png" class="msg-avatar"
                                                     alt="user avatar">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">Peter Costanzo <span class="msg-time float-end">6 hrs
												ago</span></h6>
                                                <p class="msg-info">It was popularised in the 1960s</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <a href="javascript:;">
                                    <div class="text-center msg-footer">
                                        <button class="btn btn-light w-100">View All Notifications</button>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown dropdown-large">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                               role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">8</span>
                                <i class='bx bx-shopping-bag'></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:;">
                                    <div class="msg-header">
                                        <p class="msg-header-title">My Cart</p>
                                        <p class="msg-header-badge">10 Items</p>
                                    </div>
                                </a>
                                <div class="header-message-list">
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="position-relative">
                                                <div class="cart-product rounded-circle bg-light">
                                                    <img src="/assets/images/products/11.png" class=""
                                                         alt="product image">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
                                                <p class="cart-product-price mb-0">1 X $29.00</p>
                                            </div>
                                            <div class="">
                                                <p class="cart-price mb-0">$250</p>
                                            </div>
                                            <div class="cart-product-cancel"><i class="bx bx-x"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="position-relative">
                                                <div class="cart-product rounded-circle bg-light">
                                                    <img src="/assets/images/products/02.png" class=""
                                                         alt="product image">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
                                                <p class="cart-product-price mb-0">1 X $29.00</p>
                                            </div>
                                            <div class="">
                                                <p class="cart-price mb-0">$250</p>
                                            </div>
                                            <div class="cart-product-cancel"><i class="bx bx-x"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="position-relative">
                                                <div class="cart-product rounded-circle bg-light">
                                                    <img src="/assets/images/products/03.png" class=""
                                                         alt="product image">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
                                                <p class="cart-product-price mb-0">1 X $29.00</p>
                                            </div>
                                            <div class="">
                                                <p class="cart-price mb-0">$250</p>
                                            </div>
                                            <div class="cart-product-cancel"><i class="bx bx-x"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="position-relative">
                                                <div class="cart-product rounded-circle bg-light">
                                                    <img src="/assets/images/products/04.png" class=""
                                                         alt="product image">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
                                                <p class="cart-product-price mb-0">1 X $29.00</p>
                                            </div>
                                            <div class="">
                                                <p class="cart-price mb-0">$250</p>
                                            </div>
                                            <div class="cart-product-cancel"><i class="bx bx-x"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="position-relative">
                                                <div class="cart-product rounded-circle bg-light">
                                                    <img src="/assets/images/products/05.png" class=""
                                                         alt="product image">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
                                                <p class="cart-product-price mb-0">1 X $29.00</p>
                                            </div>
                                            <div class="">
                                                <p class="cart-price mb-0">$250</p>
                                            </div>
                                            <div class="cart-product-cancel"><i class="bx bx-x"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="position-relative">
                                                <div class="cart-product rounded-circle bg-light">
                                                    <img src="/assets/images/products/06.png" class=""
                                                         alt="product image">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
                                                <p class="cart-product-price mb-0">1 X $29.00</p>
                                            </div>
                                            <div class="">
                                                <p class="cart-price mb-0">$250</p>
                                            </div>
                                            <div class="cart-product-cancel"><i class="bx bx-x"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="position-relative">
                                                <div class="cart-product rounded-circle bg-light">
                                                    <img src="/assets/images/products/07.png" class=""
                                                         alt="product image">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
                                                <p class="cart-product-price mb-0">1 X $29.00</p>
                                            </div>
                                            <div class="">
                                                <p class="cart-price mb-0">$250</p>
                                            </div>
                                            <div class="cart-product-cancel"><i class="bx bx-x"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="position-relative">
                                                <div class="cart-product rounded-circle bg-light">
                                                    <img src="/assets/images/products/08.png" class=""
                                                         alt="product image">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
                                                <p class="cart-product-price mb-0">1 X $29.00</p>
                                            </div>
                                            <div class="">
                                                <p class="cart-price mb-0">$250</p>
                                            </div>
                                            <div class="cart-product-cancel"><i class="bx bx-x"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="position-relative">
                                                <div class="cart-product rounded-circle bg-light">
                                                    <img src="/assets/images/products/09.png" class=""
                                                         alt="product image">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
                                                <p class="cart-product-price mb-0">1 X $29.00</p>
                                            </div>
                                            <div class="">
                                                <p class="cart-price mb-0">$250</p>
                                            </div>
                                            <div class="cart-product-cancel"><i class="bx bx-x"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <a href="javascript:;">
                                    <div class="text-center msg-footer">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <h5 class="mb-0">Total</h5>
                                            <h5 class="mb-0 ms-auto">$489.00</h5>
                                        </div>
                                        <button class="btn btn-light w-100">Checkout</button>
                                    </div>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="user-box dropdown px-3">
                    <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#"
                       role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="/assets/images/avatars/avatar-8.png" class="user-img" alt="user avatar">
                        <div class="user-info">
                            <p class="user-name mb-0"></p>
                            {{--								{{ Auth::user()->name }}--}}
                            <p class="designattion mb-0">Web Designer</p>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        class="bx bx-user fs-5"></i><span>Profile</span></a>
                        </li>
                        <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        class="bx bx-cog fs-5"></i><span>Settings</span></a>
                        </li>
                        <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        class="bx bx-home-circle fs-5"></i><span>Dashboard</span></a>
                        </li>
                        <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        class="bx bx-dollar-circle fs-5"></i><span>Earnings</span></a>
                        </li>
                        <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        class="bx bx-download fs-5"></i><span>Downloads</span></a>
                        </li>
                        <li>
                            <div class="dropdown-divider mb-0"></div>
                        </li>
                        <form method="POST" action="{{ route('logout') }}"
                              class="dropdown-item d-flex align-items-center">
                            @csrf
                            <button type="submit" class="btn btn-link">
                                <i class="bx bx-log-out-circle"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!--end header -->
    <!--start page wrapper -->
    @yield('main-content')
    <!--end page wrapper -->
    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
    <footer class="page-footer" style="position: fixed; bottom:0%;">
        <p class="mb-0">Copyright © 2021. All right reserved.</p>
    </footer>
</div>
<!--end wrapper-->
<!--start switcher-->
<div class="switcher-wrapper">
    <div class="switcher-btn"><i class='bx bx-cog bx-spin'></i>
    </div>
    <div class="switcher-body">
        <div class="d-flex align-items-center">
            <h5 class="mb-0 text-uppercase">Theme Customizer</h5>
            <button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
        </div>
        <hr>
        <p class="mb-0">Gaussian Texture</p>
        <hr>
        <ul class="switcher">
            <li id="theme1"></li>
            <li id="theme2"></li>
            <li id="theme3"></li>
            <li id="theme4"></li>
            <li id="theme5"></li>
            <li id="theme6"></li>
        </ul>
        <hr>
        <p class="mb-0">Gradient Background</p>
        <hr>
        <ul class="switcher">
            <li id="theme7"></li>
            <li id="theme8"></li>
            <li id="theme9"></li>
            <li id="theme10"></li>
            <li id="theme11"></li>
            <li id="theme12"></li>
            <li id="theme13"></li>
            <li id="theme14"></li>
            <li id="theme15"></li>
        </ul>
    </div>
</div>
<!--end switcher-->
<!-- Bootstrap JS -->
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="/assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="/assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
<script src="/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#Transaction-History').DataTable({
            lengthMenu: [[6, 10, 20, -1], [6, 10, 20, 'Todos']]
        });
    });
</script>
<script src="/assets/js/index.js"></script>
<!--app JS-->
<script src="/assets/js/app.js"></script>
<script>
    new PerfectScrollbar('.product-list');
    new PerfectScrollbar('.customers-list');
</script>
</body>

</html>
