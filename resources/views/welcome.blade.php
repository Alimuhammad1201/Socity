<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png">
    <!--plugins-->
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet">
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet">
    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet">
    <script src="assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="../../../css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <title>Dashtrans - Bootstrap5 Admin Template</title>
    <style>
        .form-section {
            display: none;
        }
        .form-section.active {
            display: block;
        }
    </style>
</head>

<body class="bg-theme bg-theme2">
<!--wrapper-->
<div class="wrapper">
    <div class="d-flex align-items-center justify-content-center my-5">
        <div class="container-fluid">
            <!-- Buttons to toggle forms -->
            <div class="text-center mb-4 gap-2">
                <button class="btn btn-light m-2" onclick="showForm('superadmin')">Super Admin</button>
                <button class="btn btn-light m-2" onclick="showForm('admin')">Admin</button>
                <button class="btn btn-light m-2" onclick="showForm('user')">User</button>
                <button class="btn btn-light m-2" onclick="showForm('security')">Security</button>
                <button class="btn btn-light m-2" onclick="showForm('employee')">Employee</button>

            </div>

            <!-- Super Admin Form -->
            <div id="superadmin" class="form-section {{ old('form_id', 'superadmin') == 'superadmin' ? 'active' : '' }}">
                <div class="col-md-6 mx-auto">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="p-4">
                                <div class="mb-3 text-center">
                                    <img src="assets/images/logo-icon.png" width="60" alt="">
                                </div>
                                <div class="text-center mb-4">
                                    <h5 class="">Super Admin Login</h5>
                                    <p class="mb-0">Please fill the below details to Login your account</p>
                                </div>
                                <div class="form-body">
                                    <form class="row g-3" action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="form_id" value="superadmin">


                                        <div class="col-md-6">
                                            <label for="superadmin_email" class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Email">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="superadmin_password" class="form-label">Password</label>
                                            <div class="input-group" id="show_hide_password_superadmin">
                                                <input type="password" class="form-control border-end-0" name="password" placeholder="Enter Password">
                                                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-light">Login</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Admin Form -->
            <div id="admin" class="form-section {{ old('form_id') == 'admin' ? 'active' : '' }}">
                <div class="col-md-6 mx-auto">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="p-4">
                                <div class="mb-3 text-center">
                                    <img src="assets/images/logo-icon.png" width="60" alt="">
                                </div>
                                <div class="text-center mb-4">
                                    <h5 class="">Admin Login</h5>
                                    <p class="mb-0">Please fill the below details to create your account</p>
                                </div>
                                <div class="form-body">
                                    <form class="row g-3" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="form_id" value="admin">


                                        <div class="col-md-12">
                                            <label for="admin_email" class="form-label">Email Address</label>
                                            <input type="email" class="form-control" id="admin_email" placeholder="Email">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="admin_password" class="form-label">Password</label>
                                            <div class="input-group" id="show_hide_password_admin">
                                                <input type="password" class="form-control border-end-0" id="admin_password" placeholder="Enter Password">
                                                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="admin_confirm_password" class="form-label">Confirm Password</label>
                                            <div class="input-group" id="show_hide_password_admin_confirm">
                                                <input type="password" class="form-control border-end-0" id="admin_confirm_password" placeholder="Enter Password">
                                                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-light">Sign up</button>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <p class="mb-0">Already have an account? <a href="auth-basic-signin.html">Sign in here</a></p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Form -->
            <div id="user" class="form-section {{ old('form_id') == 'user' ? 'active' : '' }}">
                <div class="col-md-6 mx-auto">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="p-4">
                                <div class="mb-3 text-center">
                                    <img src="assets/images/logo-icon.png" width="60" alt="">
                                </div>
                                <div class="text-center mb-4">
                                    <h5 class="">User Login</h5>
                                    <p class="mb-0">Please fill the below details to Login your account</p>
                                </div>
                                <div class="form-body">
                                    <form class="row g-3" action="{{ route('flat.login') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="form_id" value="user">

                                        <div class="col-md-6">
                                            <label for="user_email" class="form-label">email</label>
                                            <div class="input-group">
                                                <input type="email" class="form-control border-end-0 @error('email') is-invalid @enderror"
                                                       name="email" id="user_Email" placeholder="Enter email" value="{{ old('email') }}">

                                                @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror

                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <label for="user_password" class="form-label">Password</label>
                                            <div class="input-group" id="show_hide_password_user">
                                                <input type="password" class="form-control border-end-0 @error('password') is-invalid @enderror"
                                                       name="password" id="user_password" placeholder="Enter Password">
                                                @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-light">Login</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Security Form -->
            <div id="security" class="form-section {{ old('form_id') == 'secuirty' ? 'active' : '' }}">
                <div class="col-md-6 mx-auto">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="p-4">
                                <div class="mb-3 text-center">
                                    <img src="assets/images/logo-icon.png" width="60" alt="">
                                </div>
                                <div class="text-center mb-4">
                                    <h5 class="">Security Login</h5>
                                    <p class="mb-0">Please fill the below details to create your account</p>
                                </div>
                                <div class="form-body">
                                    <form class="row g-3" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="form_id" value="secuirty">
                                        <div class="col-md-12">
                                            <label for="security_email" class="form-label">Email Address</label>
                                            <input type="email" class="form-control" id="security_email" placeholder="Email">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="security_password" class="form-label">Password</label>
                                            <div class="input-group" id="show_hide_password_security">
                                                <input type="password" class="form-control border-end-0" id="security_password" placeholder="Enter Password">
                                                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="security_confirm_password" class="form-label">Confirm Password</label>
                                            <div class="input-group" id="show_hide_password_security_confirm">
                                                <input type="password" class="form-control border-end-0" id="security_confirm_password" placeholder="Enter Password">
                                                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-light">Sign up</button>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <p class="mb-0">Already have an account? <a href="auth-basic-signin.html">Sign in here</a></p>
                                                <hr>
                                                <p class="mb-0">Powerd by <a href="https://triatechsol.com/" target="_blank">@triatechsoloution</a></p>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Employee Form --}}
            <div id="employee" class="form-section {{ old('form_id') == 'employee' ? 'active' : '' }}">
                <div class="col-md-6 mx-auto">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="p-4">
                                <div class="mb-3 text-center">
                                    <img src="assets/images/logo-icon.png" width="60" alt="">
                                </div>
                                <div class="text-center mb-4">
                                    <h5 class="">Employee Login</h5>
                                    <p class="mb-0">Please fill the below details to create your account</p>
                                </div>
                                <div class="form-body">
                                    <form class="row g-3" action="{{ route('employee.login') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="form_id" value="employee">
                                        <div class="col-md-6">
                                            <label for="employee_email" class="form-label">Email Address</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="employee_email" name="employee_email" placeholder="Email">
                                            @error('employee_email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="employee_password" class="form-label">Password</label>
                                            <div class="input-group" id="show_hide_password_employee">
                                                <input type="password" class="form-control border-end-0" id="employee_password" name="employee_password" placeholder="Enter Password">
                                                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-light">Login</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        function showForm(formId) {
            var forms = document.querySelectorAll('.form-section');
            forms.forEach(function (form) {
                form.classList.remove('active');
            });

            var selectedForm = document.getElementById(formId);
            if (selectedForm) {
                selectedForm.classList.add('active');
            }
        }

        document.querySelectorAll('.btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var formId = this.getAttribute('onclick').match(/'(.+?)'/)[1];
                showForm(formId);
            });
        });
    });




</script>
</body>
</html>
