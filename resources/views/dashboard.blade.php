@extends('superadmin.layout.master')
@section('page-title')
Dashboard
@endsection
@section('main-content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0"> Total Flats</p>
                                <h4 class="my-1">400</h4>
                                <p class="mb-0 font-13"><i class='bi bi-bank align-middle'></i></p>
                            </div>
                            <div class="widgets-icons ms-auto"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bank" viewBox="0 0 16 16">
                                <path d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.5.5 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89zM3.777 3h8.447L8 1zM2 6v7h1V6zm2 0v7h2.5V6zm3.5 0v7h1V6zm2 0v7H12V6zM13 6v7h1V6zm2-1V4H1v1zm-.39 9H1.39l-.25 1h13.72z"/>
                              </svg>
                            </div>
                        </div>
                        <div id="chart1"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Flats On Rent</p>
                                <h4 class="my-1">100</h4>
                                <p class="mb-0 font-13"></p>
{{--                                <i class='bx bxs-up-arrow align-middle'></i>--}}
                            </div>
                            <div class="widgets-icons ms-auto"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bank" viewBox="0 0 16 16">
                                <path d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.5.5 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89zM3.777 3h8.447L8 1zM2 6v7h1V6zm2 0v7h2.5V6zm3.5 0v7h1V6zm2 0v7H12V6zM13 6v7h1V6zm2-1V4H1v1zm-.39 9H1.39l-.25 1h13.72z"/>
                              </svg>
                            </div>
                        </div>
                        <div id="chart2"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Flats On OwnerShip</p>
                                <h4 class="my-1">200</h4>
                                <p class="mb-0 font-13"></p>
{{--                                <i class='bx bxs-down-arrow align-middle'></i>--}}
                            </div>
                            <div class="widgets-icons ms-auto"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bank" viewBox="0 0 16 16">
                                <path d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.5.5 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89zM3.777 3h8.447L8 1zM2 6v7h1V6zm2 0v7h2.5V6zm3.5 0v7h1V6zm2 0v7H12V6zM13 6v7h1V6zm2-1V4H1v1zm-.39 9H1.39l-.25 1h13.72z"/>
                              </svg>
                            </div>
                        </div>
                        <div id="chart3"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-10">
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Flats Available For Sale</p>
                                <h4 class="my-1">50</h4>
                                <p class="mb-0 font-13"><i class='bi bi-bank align-middle'></i></p>
                            </div>
                            <div class="widgets-icons ms-auto"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bank" viewBox="0 0 16 16">
                                <path d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.5.5 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89zM3.777 3h8.447L8 1zM2 6v7h1V6zm2 0v7h2.5V6zm3.5 0v7h1V6zm2 0v7H12V6zM13 6v7h1V6zm2-1V4H1v1zm-.39 9H1.39l-.25 1h13.72z"/>
                              </svg>
                            </div>
                        </div>
                        <div id="chart5"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Flat Available On Rent</p>
                                <h4 class="my-1">50</h4>
                                <p class="mb-0 font-13"></p>
                            </div>
                            <div class="widgets-icons ms-auto"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bank" viewBox="0 0 16 16">
                                <path d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.5.5 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89zM3.777 3h8.447L8 1zM2 6v7h1V6zm2 0v7h2.5V6zm3.5 0v7h1V6zm2 0v7H12V6zM13 6v7h1V6zm2-1V4H1v1zm-.39 9H1.39l-.25 1h13.72z"/>
                              </svg>
                            </div>
                        </div>
                        <div id="chart6"></div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
        <div class="row row-cols-1 row-cols-xl-12">
            <div class="col d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h4 class="mb-1">Revenue</h4>
                                <p class="mb-0 font-13"><i class='bx bxs-calendar'></i>in last 30 days revenue</p>
                            </div>

                        </div>
                        <div class="row row-cols-1 row-cols-sm-3 mt-4">
                            <div class="col-lg-4">
                                <div>
                                    <p class="mb-0">Monthly Billing (All Resident)</p>
                                    <h4 class="my-1 text-white">150,0000</h4>
                                    <p class="mb-0 font-13"><i class='bx bxs-up-arrow align-middle'></i> For The Month August 2024</p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div>
                                    <p class="mb-0">Recovery For The Month</p>
                                    <h4 class="my-1 text-white">70,0000</h4>
                                    <p class="mb-0 font-13"><i class='bx bxs-up-arrow align-middle'></i> On 15th August</p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div>
                                    <p class="mb-0">Balance Recovery For The Month</p>
                                    <h4 class="my-1 text-white">80,0000</h4>
                                    <p class="mb-0 font-13"><i class='bx bxs-down-arrow align-middle'></i> Total For Last August 2024</p>
                                </div>
                            </div>
                        </div>
                        <div id="chart4"></div>
                    </div>
                </div>
            </div>

        </div>
        <!--end row-->
        <!--Start row-->
        <h6 class="mb-0 text-uppercase">Accounts Info</h6>
		<hr>
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">0 - 10 Days</p>
                                <h4 class="my-1">Rs: 50,0000</h4>
                                <!-- <p class="mb-0 font-13"><i class="bx bxs-up-arrow align-middle"></i>$34 from last week</p> -->
                            </div>
                            <div class="widgets-icons ms-auto"><i class="bx bxs-wallet"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">10 - 20 Days</p>
                                <h4 class="my-1">Rs: 10,0000</h4>
                                <!-- <p class="mb-0 font-13"><i class='bx bxs-up-arrow align-middle'></i>$24 from last week</p> -->
                            </div>
                            <div class="widgets-icons ms-auto"><i class='bx bxs-wallet'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">20 - 30 Days</p>
                                <h4 class="my-1">Rs: 50,0000</h4>
                                <!-- <p class="mb-0 font-13"><i class='bx bxs-down-arrow align-middle'></i>$34 from last week</p> -->
                            </div>
                            <div class="widgets-icons ms-auto"><i class='bx bxs-wallet'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">30 - 60 Days</p>
                                <h4 class="my-1">Rs: 20,0000</h4>
                                <!-- <p class="mb-0 font-13"><i class='bx bxs-down-arrow align-middle'></i>12.2% from last week</p> -->
                            </div>
                            <div class="widgets-icons ms-auto"><i class='bx bxs-wallet'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
        <div class="row">
            <div class="col-xl-8 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h5 class="mb-1">Complaints</h5>
                                <p class="mb-0 font-13"><i class='bx bxs-calendar'></i>in last 30 days</p>
                            </div>

                        </div>
                        <div class="table-responsive mt-4">
                            <table class="table align-middle mb-0 table-hover" id="Transaction-History">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Date & Time</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="">
                                                    <img src="assets/images/avatars/avatar-9.png" class="rounded-circle" width="46" height="46" alt="">
                                                </div>
                                                <div class="ms-2">
                                                    <h6 class="mb-1 font-14">Ali Muhammad</h6>
                                                    <p class="mb-0 font-13">Complaint Id #8547846</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Aug 10, 2024</td>
                                        <td>Rs:2500.00</td>
                                        <td>
                                            <div class="badge rounded-pill bg-light text-white w-100">Completed</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="">
                                                    <img src="assets/images/avatars/avatar-1.png" class="rounded-circle" width="46" height="46" alt="">
                                                </div>
                                                <div class="ms-2">
                                                    <h6 class="mb-1 font-14">Abdul Wahab</h6>
                                                    <p class="mb-0 font-13">Complaint Id #8547847</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Aug 10, 2024</td>
                                        <td>Rs:5000.00</td>
                                        <td>
                                            <div class="badge rounded-pill bg-light text-white w-100">In Progress</div>
                                        </td>
                                    </tr>



                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="">
                                                    <img src="assets/images/avatars/avatar-8.png" class="rounded-circle" width="46" height="46" alt="">
                                                </div>
                                                <div class="ms-2">
                                                    <h6 class="mb-1 font-14">Faizan Alam</h6>
                                                    <p class="mb-0 font-13">Complaint Id #8547848</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Aug 11, 2024</td>
                                        <td>Rs:1500.00</td>
                                        <td>
                                            <div class="badge rounded-pill bg-light text-white w-100">Completed</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="">
                                                    <img src="assets/images/avatars/avatar-9.png" class="rounded-circle" width="46" height="46" alt="">
                                                </div>
                                                <div class="ms-2">
                                                    <h6 class="mb-1 font-14">Uzair Ali</h6>
                                                    <p class="mb-0 font-13">Complaint Id #8547849</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Aug 13, 2024</td>
                                        <td>Rs:6000.00</td>
                                        <td>
                                            <div class="badge rounded-pill bg-light text-white w-100">Completed</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="">
                                                    <img src="assets/images/avatars/avatar-16.png" class="rounded-circle" width="46" height="46" alt="">
                                                </div>
                                                <div class="ms-2">
                                                    <h6 class="mb-1 font-14">Jawad Khan</h6>
                                                    <p class="mb-0 font-13">Complaint Id #8547850</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Aug 13, 2024</td>
                                        <td>Rs:2000.00</td>
                                        <td>
                                            <div class="badge rounded-pill bg-light text-white w-100">Completed</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="col d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h5 class="mb-0">COMPLAINTS</h5>
                            </div>
                            <div class="dropdown ms-auto">
                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">	<i class='bx bx-dots-horizontal-rounded font-22  text-option'></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:;">Action</a>
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="mt-5" id="chart15"></div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Unresolved<span class="badge bg-light-white-2 rounded-pill">0</span>
                        </li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">In-Progress<span class="badge bg-light-white-3 rounded-pill">1</span>
                        </li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Resolved<span class="badge bg-white rounded-pill text-dark">4</span>
                        </li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">All Complaints <span class="badge bg-light-white-4 text-white rounded-pill">5</span>
                        </li>
                    </ul>
                </div>
            </div>
            </div>
        </div>
        <h6 class="mb-0 text-uppercase">Complaint Lead Time Resolution Status</h6>
		<hr>
        <div class="row row-cols-1 row-cols-md-3 row-cols-xl-5">
					<div class="col">
						<div class="card radius-10">
							<div class="card-body">
								<div class="text-center">
									<div class="widgets-icons rounded-circle mx-auto mb-3"><i class="lni lni-user"></i>
									</div>
									<p class="mb-0">Plumbing</p>
                                    <h4 class="my-1">1.5 Hours</h4>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10">
							<div class="card-body">
								<div class="text-center">
									<div class="widgets-icons rounded-circle mx-auto mb-3"><i class="lni lni-bug"></i>
									</div>
									<p class="mb-0">Cleaning</p>
                                    <h4 class="my-1">1.75 Hours</h4>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10">
							<div class="card-body">
								<div class="text-center">
									<div class="widgets-icons rounded-circle mx-auto mb-3"><i class="lni lni-tab"></i>
									</div>
									<p class="mb-0">Lifts</p>
									<h4 class="my-1">0.5 Hours</h4>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10">
							<div class="card-body">
								<div class="text-center">
									<div class="widgets-icons rounded-circle mx-auto mb-3"><i class="lni lni-car"></i>
									</div>
									<p class="mb-0">Parking</p>
                                    <h4 class="my-1">2.0 Hours</h4>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10">
							<div class="card-body">
								<div class="text-center">
									<div class="widgets-icons rounded-circle mx-auto mb-3"><i class='lni lni-fireworks'></i>
									</div>
									<p class="mb-0">Fire</p>
                                    <h4 class="my-1">0.25 Hours </h4>
								</div>
							</div>
						</div>
					</div>
				</div>
        <!--end row-->
        <div class="row row-cols-1 row-cols-lg-3">
            <div class="col-xl-8 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h5 class="mb-1">Top Ranking State Agents</h5>
                                <p class="mb-0 font-13"></p>
                            </div>

                        </div>
                        <div class="table-responsive mt-4">
                            <table class="table align-middle mb-0 table-hover" id="Transaction-History">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Flats On hand</th>
                                        <th>Flats On Sale</th>
                                        <th>Flats On Rent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="">
                                                    <img src="assets/images/avatars/avatar-1.png" class="rounded-circle" width="46" height="46" alt="">
                                                </div>
                                                <div class="ms-2">
                                                    <h6 class="mb-1 font-14">Mr Iqbal</h6>
                                                    <p class="mb-0 font-13"></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td> 100: Flats </td>
                                        <td> 65: Flats </td>
                                        <td> 35: Flats </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="">
                                                    <img src="assets/images/avatars/avatar-1.png" class="rounded-circle" width="46" height="46" alt="">
                                                </div>
                                                <div class="ms-2">
                                                    <h6 class="mb-1 font-14">Abdul Gafar</h6>
                                                    <p class="mb-0 font-13"></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>120: Flats</td>
                                        <td>50: Flats</td>
                                        <td>70: Flats</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="">
                                                    <img src="assets/images/avatars/avatar-8.png" class="rounded-circle" width="46" height="46" alt="">
                                                </div>
                                                <div class="ms-2">
                                                    <h6 class="mb-1 font-14">Asim Raza</h6>
                                                    <p class="mb-0 font-13"></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>70: Flats</td>
                                        <td>40: Flats</td>
                                        <td>30: Flats</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="">
                                                    <img src="assets/images/avatars/avatar-9.png" class="rounded-circle" width="46" height="46" alt="">
                                                </div>
                                                <div class="ms-2">
                                                    <h6 class="mb-1 font-14">Uzair Ali</h6>
                                                    <p class="mb-0 font-13"></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>90: Flats</td>
                                        <td>60: Flats</td>
                                        <td>30: Flats</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="">
                                                    <img src="assets/images/avatars/avatar-9.png" class="rounded-circle" width="46" height="46" alt="">
                                                </div>
                                                <div class="ms-2">
                                                    <h6 class="mb-1 font-14">Mr Jawad Khan</h6>
                                                    <p class="mb-0 font-13"></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>50: Flats</td>
                                        <td>35: Flats</td>
                                        <td>15: Flats</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <p class="font-weight-bold mb-1">Visitors</p>
                        <div class="d-flex align-items-center">
                            <div>
                                <h4 class="mb-0">43,540</h4>
                            </div>
                            <div class="">
                                <p class="mb-0 align-self-center font-weight-bold ms-2">4.4 <i class='bx bxs-up-arrow-alt mr-2'></i>
                                </p>
                            </div>
                        </div>
                        <div id="chart21"></div>
                    </div>
                </div>
            </div>

        </div>

        <!--end row-->
        <div class="row">
        <div class="col-12  d-flex gap-2 mb-2">
            <div class="col-xl-4">
                <div class="card radius-10 overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Monthly Maintenance</p>
                                <h4 class="mb-0">75%</h4>
                            </div>
                            <div class="ms-auto">
                                <p class="mb-0 font-13 text-white">+12.34 Increase</p>
                                <p class="mb-0 font-13">From Last Week</p>
                            </div>
                        </div>
                    </div>
                    <div id="chart12"></div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card radius-10 overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Electricity for Servent Quorter </p>
                                <h4 class="mb-0">3%</h4>
                            </div>
                            <div class="ms-auto">
                                <p class="mb-0 font-13 text-white">+21.34 Increase</p>
                                <p class="mb-0 font-13">From Last Week</p>
                            </div>
                        </div>
                    </div>
                    <div id="chart13"></div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card radius-10 overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Water Tanker</p>
                                <h4 class="mb-0">5%</h4>
                            </div>
                            <div class="ms-auto">
                                <p class="mb-0 font-13 text-white">+18.42 Increase</p>
                                <p class="mb-0 font-13">From Last Week</p>
                            </div>
                        </div>
                    </div>
                    <div id="chart14"></div>
                </div>
            </div>

        </div>

    </div>
        <div class="row">
{{--        <div class="col-12 col-xl-8 d-flex">--}}
{{--            --}}
{{--        </div>--}}
        <div class="col-12  d-flex gap-2 mb-3">
            <div class="col-xl-4">
                <div class="card radius-10 overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Comunity Hall Booking</p>
                                <h4 class="mb-0">8%</h4>
                            </div>
                            <div class="ms-auto">
                                <p class="mb-0 font-13 text-white">+18.42 Increase</p>
                                <p class="mb-0 font-13">From Last Week</p>
                            </div>
                        </div>
                    </div>
                    <div id="chart11"></div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card radius-10 overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Property Damage Challan</p>
                                <h4 class="mb-0">7%</h4>
                            </div>
                            <div class="ms-auto">
                                <p class="mb-0 font-13 text-white">+18.42 Increase</p>
                                <p class="mb-0 font-13">From Last Week</p>
                            </div>
                        </div>
                    </div>
                    <div id="chart10"></div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card radius-10 overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1">Gym / Swimming pool</p>
                                <h4 class="mb-0">2%</h4>
                            </div>
                            <div class="ms-auto">
                                <p class="mb-0 font-13 text-white">+18.42 Increase</p>
                                <p class="mb-0 font-13">From Last Week</p>
                            </div>
                        </div>
                    </div>
                    <div id="chart9"></div>
                </div>
            </div>
        </div>
<!--end row-->
            
        </div>

    </div>

</div>
@endsection
