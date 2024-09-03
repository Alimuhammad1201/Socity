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
                </div>

                <!-- Super Admin Form -->
                <div id="superadmin" class="form-section active">
                    <div class="col-md-6 mx-auto">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="p-4">
                                    <div class="mb-3 text-center">
                                        <img src="assets/images/logo-icon.png" width="60" alt="">
                                    </div>
                                    <div class="text-center mb-4">
                                        <h5 class="">Super Admin Login</h5>
                                        <p class="mb-0">Please fill the below details to create your account</p>
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" action="{{ route('login') }}" method="POST">
                                            @csrf
                                           

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

                <!-- Admin Form -->
                <div id="admin" class="form-section">
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
                <div id="user" class="form-section">
                    <div class="col-md-6 mx-auto">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="p-4">
                                    <div class="mb-3 text-center">
                                        <img src="assets/images/logo-icon.png" width="60" alt="">
                                    </div>
                                    <div class="text-center mb-4">
                                        <h5 class="">User Login</h5>
                                        <p class="mb-0">Please fill the below details to create your account</p>
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" action="" method="POST">
                                            @csrf
                                            <div class="col-md-6">
                                                <label for="user_block" class="form-label">Block</label>
                                                <select class="form-select" id="user_block" aria-label="Default select example">
                                                    <option selected="">A</option>
                                                    <option value="1">B</option>
                                                    <option value="2">C</option>
                                                    <option value="3">D</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="user_flat_no" class="form-label">Flat No</label>
                                                <select class="form-select" id="user_flat_no" aria-label="Default select example">
                                                    <option selected="">101</option>
                                                    <option value="1">102</option>
                                                    <option value="2">103</option>
                                                    <option value="3">104</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="user_contact" class="form-label">Contact no</label>
                                                <input type="number" class="form-control" id="user_contact" placeholder="Contact no">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="user_password" class="form-label">Password</label>
                                                <div class="input-group" id="show_hide_password_user">
                                                    <input type="password" class="form-control border-end-0" id="user_password" placeholder="Enter Password">
                                                    <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="user_confirm_password" class="form-label">Confirm Password</label>
                                                <div class="input-group" id="show_hide_password_user_confirm">
                                                    <input type="password" class="form-control border-end-0" id="user_confirm_password" placeholder="Enter Password">
                                                    <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                        <form class="row g-3" action="{{ route('flat.login') }}" method="POST">
                                            @csrf

                                            <div class="col-md-12">
                                                <label for="user_email" class="form-label">email</label>
                                                <div class="input-group" id="show_hide_email_user">
                                                    <input type="email" class="form-control border-end-0" name="email" id="user_Email" placeholder="Enter email">
                                                    <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                          
                                   
                                          
                                            <div class="col-md-12">
                                                <label for="user_password" class="form-label">Password</label>
                                                <div class="input-group" id="show_hide_password_user">
                                                    <input type="password" class="form-control border-end-0" name="password" id="user_password" placeholder="Enter Password">
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

                <!-- Security Form -->
                <div id="security" class="form-section">
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
                
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showForm(formId) {
            const forms = document.querySelectorAll('.form-section');
            forms.forEach(form => {
                form.classList.remove('active');
            });
            document.getElementById(formId).classList.add('active');
        }


        $(document).ready(function() {
        $('#block').change(function() {
            var blockId = $(this).val();
            if(blockId) {
                $.ajax({
                    url: '/get-flats/'+blockId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#flat_no').empty();
                        $('#flat_no').append('<option value="" selected>Select Flat No</option>');
                        $.each(data, function(key, value) {
                            $('#flat_no').append('<option value="'+ value.id +'">'+ value.flat_no +'</option>');
                        });
                    }
                });
            } else {
                $('#flat_no').empty();
                $('#flat_no').append('<option value="" selected>Select Flat No</option>');
            }
        });
    });
    </script>
</body>
</html>
