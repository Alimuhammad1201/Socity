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
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">Dashtrans</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="{{route('dashboard')}}">
						<div class="menu-title">Dashboard</div>
					</a>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i></div>
						<div class="menu-title">Block</div>
					</a>
					<ul>
						<li> <a href="{{route('block.index')}}"><i class='bx bx-radio-circle'></i>Manage Block</a></li>
					</ul>
				</li>
				
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i></div>
						<div class="menu-title">Flat Area</div>
					</a>
					<ul>
						<li> <a href="{{route('flatarea.create')}}"><i class='bx bx-radio-circle'></i>Add Flat Area</a>
						</li>
						<li> <a href="{{route('flatarea.index')}}"><i class='bx bx-radio-circle'></i>Manage Flat
								Area</a></li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i></div>
						<div class="menu-title">Flats</div>
					</a>
					<ul>
						<li> <a href="{{route('flat.create')}}"><i class='bx bx-radio-circle'></i>Add Flat</a></li>
						<li> <a href="{{route('flat.index')}}"><i class='bx bx-radio-circle'></i>Manage Flat</a></li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i></div>
						<div class="menu-title">Allotments</div>
					</a>
					<ul>
						<li> <a href="{{ route('allotments.create') }}"><i class='bx bx-radio-circle'></i>Add
								Allotments</a></li>
						<li> <a href="{{ route('allotments.index') }}"><i class='bx bx-radio-circle'></i>Manage
								Allotments</a></li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i></div>
						<div class="menu-title">Invoice Type</div>
					</a>
					<ul>
						<li> <a href="{{route('invoice.type')}}"><i class='bx bx-radio-circle'></i>Manage Type</a></li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i></div>
						<div class="menu-title">Invoice</div>
					</a>
					<ul>
						<li> <a href="{{route('invoice.create')}}"><i class='bx bx-radio-circle'></i>Add All User
								Invoice</a></li>
						<li> <a href="{{route('additional.invoive')}}"><i class='bx bx-radio-circle'></i>Add Additional
								User Invoice</a></li>
						<li> <a href="{{route('invoice.index')}}"><i class='bx bx-radio-circle'></i>Manage Invoice</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i></div>
						<div class="menu-title">Complaint Type</div>
					</a>
					<ul>
						<li> <a href="{{route('complaint.type')}}"><i class='bx bx-radio-circle'></i>Manage Complaint
								Type</a></li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i></div>
						<div class="menu-title">Complaints</div>
					</a>
					<ul>
						<li> <a href="{{route('complaints.unsolved')}}"><i class='bx bx-radio-circle'></i>Unresolved</a>
						</li>
						<li> <a href="{{route('complaints.inprogress')}}"><i
									class='bx bx-radio-circle'></i>In-progress</a></li>
						<li> <a href="{{route('complaints.resolved')}}"><i class='bx bx-radio-circle'></i>Resolved</a>
						</li>
						<li> <a href="{{route('complaints.index')}}"><i class='bx bx-radio-circle'></i>All
								Complaints</a></li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i></div>
						<div class="menu-title">Employee Depart</div>
					</a>
					<ul>
						<li> <a href="{{route('employee.depart')}}"><i class='bx bx-radio-circle'></i>Manage Employee
								Depart</a></li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i></div>
						<div class="menu-title">Employee Designation</div>
					</a>
					<ul>
						<li> <a href="{{route('employee.designation')}}"><i class='bx bx-radio-circle'></i>Manage
								Employee Designation</a></li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i></div>
						<div class="menu-title">Employees</div>
					</a>
					<ul>
						<li> <a href="{{route('employees.index')}}"><i class='bx bx-radio-circle'></i>Manage
								Employees</a></li>
						<li> <a href="{{route('employees.create')}}"><i class='bx bx-radio-circle'></i>Add Employees</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i></div>
						<div class="menu-title">Payroll</div>
					</a>
					<ul>
						<li> <a href="{{route('payroll.index')}}"><i class='bx bx-radio-circle'></i>Manage Payroll</a>
						</li>
						<li> <a href="{{route('payroll.create')}}"><i class='bx bx-radio-circle'></i>Add Payroll</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i></div>
						<div class="menu-title">Attendance</div>
					</a>
					<ul>
						<li> <a href="{{route('attendance.index')}}"><i class='bx bx-radio-circle'></i>Manage
								Attendance</a></li>
						<li> <a href="{{route('attendance.create')}}"><i class='bx bx-radio-circle'></i>Add
								Attendance</a></li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i></div>
						<div class="menu-title">Leave</div>
					</a>
					<ul>
						<li> <a href="{{route('leave.index')}}"><i class='bx bx-radio-circle'></i>Manage Leave</a></li>
						<li> <a href="{{route('leave.create')}}"><i class='bx bx-radio-circle'></i>Add Leave</a></li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i> </div>
						<div class="menu-title">Hr Notification</div>
					</a>
					<ul>
						<li> <a href="{{route('hr_notification.index')}}"><i class='bx bx-radio-circle'></i>Manage Hr
								Notification</a></li>
						<li> <a href="{{route('hr_notification.create')}}"><i class='bx bx-radio-circle'></i>Add HR
								Notification</a></li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i></div>
						<div class="menu-title">Activity Logs</div>
					</a>
					<ul>
						<li> <a href="{{route('activity_logs.index')}}"><i class='bx bx-radio-circle'></i>Manage
								Activity Log</a></li>
						<li> <a href="{{route('activity_logs.create')}}"><i class='bx bx-radio-circle'></i>Add Activity
								Log</a></li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i></div>
						<div class="menu-title">Manage Document</div>
					</a>
					<ul>
						<li> <a href="{{route('document.manage')}}"><i class='bx bx-radio-circle'></i>Manage
								Document</a></li>
						<li> <a href="{{route('document.create')}}"><i class='bx bx-radio-circle'></i>Add Document</a>
						</li>
					</ul>
				</li>

				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i></div>
						<div class="menu-title">Manage Notice</div>
					</a>
					<ul>
						<li> <a href="{{route('manage.notice')}}"><i class='bx bx-radio-circle'></i>Manage
								Notice</a></li>
						
					</ul>
				</li>

				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i></div>
						<div class="menu-title">Manage NOC,S</div>
					</a>
					<ul>
						<li> <a href="{{route('nocs.create')}}"><i class='bx bx-radio-circle'></i>Ganrate Noc,s</a></li>
						<li> <a href="{{route('nocs.index')}}"><i class='bx bx-radio-circle'></i>Manage
								Noc,s</a></li>
						
					</ul>
				</li>

				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i></div>
						<div class="menu-title">Guest Information</div>
					</a>
					<ul>
						{{-- <li> <a href="{{route('nocs.create')}}"><i class='bx bx-radio-circle'></i>Ganrate Noc,s</a></li> --}}
						<li> <a href="{{route('guest.view.admin')}}"><i class='bx bx-radio-circle'></i>Guest Card</a></li>
						
					</ul>
				</li>
				
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
							<input type="text" class="form-control search-control" placeholder="Type to search...">
							<span class="position-absolute top-50 search-show translate-middle-y"><i
									class='bx bx-search'></i></span>
							<span class="position-absolute top-50 search-close translate-middle-y"><i
									class='bx bx-x'></i></span>
						</div>
					</div>
					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center gap-1">
							

							<li class="nav-item dropdown dropdown-app">
								
								<div class="dropdown-menu dropdown-menu-end p-0">
									<div class="app-container p-2 my-2">
										<div class="row gx-0 gy-2 row-cols-3 justify-content-center p-2">
											

										</div>
										<!--end row-->

									</div>
								</div>
							</li>

							<li class="nav-item dropdown dropdown-large">
								<div class="dropdown-menu dropdown-menu-end">
									<div class="header-notifications-list">
									</div>
								</div>
							</li>
							<li class="nav-item dropdown dropdown-large">
								
								<div class="dropdown-menu dropdown-menu-end">
									
									<div class="header-message-list">
										
									</div>
									
								</div>
							</li>
						</ul>
					</div>
					<div class="user-box dropdown px-3">
						<a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
							href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="/assets/images/avatars/avatar-8.png" class="user-img" alt="user avatar">
							<div class="user-info">
								<p class="user-name mb-0">{{ Auth::user()->name }}</p>
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
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i
				class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer" style="position: fixed; bottom:0%;">
			<p class="mb-0">Copyright © 2021. All right reserved.</p>
		</footer>
	</div>
	<!--end wrapper-->
	<!--start switcher-->
	<div class="switcher-wrapper">
		<div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
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
		$(document).ready(function() {
			$('#Transaction-History').DataTable({
				lengthMenu: [[6, 10, 20, -1], [6, 10, 20, 'Todos']]
			});
		  } );
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