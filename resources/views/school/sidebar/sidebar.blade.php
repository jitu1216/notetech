
<body>
    <nav>
        <div class="navbar">
            <i class='bx bx-menu'></i>
            <div class="logo"><a href="#"></a></div>
            <div class="nav-links">
                <div class="sidebar-logo">
                    {{-- <span class="logo-name">Gyanoday</span> --}}
                    <i class='bx bx-x'></i>
                </div>
                <ul class="links">
                    <li class="{{ set_active(['school']) }}">
                        <a class="{{ set_active(['school']) }}" href="{{ route('school') }}"><i
                                class="fas feather-grid"></i> <span>DASHBOARD</span></a>
                    </li>

                    <li>
                        <a href="#"><i class="fas fa-building"></i>
                            <span>ADMISSION</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <i class='bx bxs-chevron-down htmlcss-arrow arrow '></i>
                        <ul class="htmlCss-sub-menu sub-menu">
                            @if (Custom::getUser()->role_name == 'Staff')
                                {{-- <li><a class="{{ set_active(['school/add-student']) }}"
                                            href="{{ route('add-student') }}">New Admission</a></li> --}}
                                <li><a
                                        @if (in_array('1', Custom::getStaffPower())) class="{{ set_active(['school/add-student']) }}"
                                         href="{{ route('add-student') }}"@else
                                         class="{{ set_active(['school/add-student']) }} popup"
                                            href="javascript:(0)" @endif>New
                                        Admission</a></li>
                                <li><a
                                        @if (in_array('14', Custom::getStaffPower())) class="{{ set_active(['school/studentlist', 'school/search']) }}"
                                            href="{{ route('pendinglist') }}" @else
                                            class="{{ set_active(['school/studentlist', 'school/search']) }} popup"
                                                href="javascript:(0)" @endif>Pending
                                        Admission</a></li>
                                <li><a
                                        @if (in_array('2', Custom::getStaffPower())) class="{{ set_active(['school/studentlist', 'school/search']) }}"
                                        href="{{ route('studentlist', '2') }}" @else
                                        class="{{ set_active(['school/studentlist', 'school/search']) }} popup"
                                            href="javascript:(0)" @endif>Approved
                                        Admission</a></li>
                                <li><a class="{{ set_active(['school/studentlist', 'school/search']) }} popup"
                                        href="javascript:(0)">Rejected Admission</a></li>
                                <li><a class="{{ set_active(['school/studentlist', 'school/search']) }} popup"
                                        href="javascript:(0)">Recover Student</a></li>
                                <li><a
                                        @if (in_array('12', Custom::getStaffPower())) class="{{ set_active(['school/studentlist', 'school/search']) }}"
                                                href="{{ route('allstudentlist', '5') }}" @else
                                                class="{{ set_active(['school/studentlist', 'school/search']) }} popup"
                                                    href="javascript:(0)" @endif>All
                                        Student List</a></li>
                            @else
                                <li><a class="{{ set_active(['school/add-student']) }}"
                                        href="{{ route('add-student') }}">New Admission</a></li>
                                <li><a class="{{ set_active(['school/pendinglist', 'school/search']) }}"
                                        href="{{ route('pendinglist') }}">Pending Admission</a></li>
                                <li><a class="{{ set_active(['school/studentlist', 'school/search']) }}"
                                        href="{{ route('studentlist', '2') }}">Approved Admission</a></li>
                                <li><a class="{{ set_active(['school/studentlist', 'school/search']) }}"
                                        href="{{ route('studentlist', '3') }}">Rejected Admission</a></li>
                                <li><a class="{{ set_active(['school/studentlist', 'school/search']) }}"
                                        href="{{ route('studentlist', '4') }}">Recover Student</a></li>
                                <li><a class="{{ set_active(['school/studentlist', 'school/search']) }}"
                                        href="{{ route('allstudentlist', '5') }}">All Student List</a></li>
                            @endif
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-building"></i>
                            <span>FEES</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <i class='bx bxs-chevron-down htmlcss-arrow arrow '></i>
                        <ul class="htmlCss-sub-menu sub-menu">
                            @if (Custom::getUser()->role_name == 'Staff')
                                @if (in_array('4', Custom::getStaffPower()))
                                    <li><a class="{{ set_active(['school/fesstypelist']) }}"
                                            href="{{ route('fesstypelist') }}">Fees Type</a></li>
                                    <li><a class="{{ set_active(['school/viewfeessetting', 'school/search']) }}"
                                            href="{{ route('viewfeessetting') }}">Fees Setting</a></li>
                                    <li><a class="{{ set_active(['school/fee-edit-list', 'school/search']) }}"
                                            href="{{ route('fee-edit-list', '2') }}">Fee Edit</a></li>
                                    <li><a class="{{ set_active(['school/fee-deposite-list', 'school/search']) }}"
                                            href="{{ route('fee-deposite-list', '2') }}">Fees Deposite</a></li>
                                    <li><a class="{{ set_active(['school/fees-card', 'school/search']) }}"
                                            href="{{ route('fees-card', '2') }}">Fees Card</a></li>
                                    <li><a class="{{ set_active(['school/fees-report', 'school/search']) }}"
                                            href="{{ route('fees-report', '2') }}">Fees Report</a></li>
                                    <li><a class="{{ set_active(['school/pending-fees', 'school/search']) }}"
                                            href="{{ route('pending-fees', '2') }}">Pending Fees</a></li>
                                    <li><a class="{{ set_active(['school/pending-fees', 'school/search']) }}"
                                            href="{{ route('pending-fees', '2') }}">Current Running Fees</a></li>
                                @else
                                    <li><a class="{{ set_active(['school/fesstypelist']) }} popup"
                                            href="javascript:void(0)">Fees Type</a></li>
                                    <li><a class="{{ set_active(['school/viewfeessetting', 'school/search']) }} popup"
                                            href="javascript:void(0)">Fees Setting</a></li>
                                    <li><a class="{{ set_active(['school/fee-edit-list', 'school/search']) }} popup"
                                            href="javascript:void(0)">Fee Edit</a></li>
                                    <li><a
                                            @if (in_array('13', Custom::getStaffPower())) class="{{ set_active(['school/fee-deposite-list', 'school/search']) }}"
                                                href="{{ route('fee-deposite-list', '2') }}" @else
                                                class="{{ set_active(['school/studentlist', 'school/search']) }} popup"
                                                    href="javascript:(0)" @endif>Fees
                                            Deposite</a></li>
                                    <li><a class="{{ set_active(['school/fee-edit-list', 'school/search']) }} popup"
                                            href="javascript:void(0)">Fee Card</a></li>
                                    <li><a class="{{ set_active(['school/fees-report', 'school/search']) }} popup"
                                            href="javascript:void(0)">Fees Report</a></li>

                                    <li><a
                                            @if (in_array('15', Custom::getStaffPower())) class="{{ set_active(['school/fees-report', 'school/search']) }}"
                                                    href="{{ route('pending-fees', '2') }}" @else
                                                    class="{{ set_active(['school/fees-report', 'school/search']) }} popup"
                                                        href="javascript:(0)" @endif>Pending
                                            Fees</a></li>
                                    <li><a class="{{ set_active(['school/fees-report', 'school/search']) }} popup"
                                            href="javascript:void(0)">Current Running Fees</a></li>
                                @endif
                            @else
                                <li><a class="{{ set_active(['school/fesstypelist']) }}"
                                        href="{{ route('fesstypelist') }}">Fees Type</a></li>
                                <li><a class="{{ set_active(['school/viewfeessetting', 'school/search']) }}"
                                        href="{{ route('viewfeessetting') }}">Fees Setting</a></li>
                                <li><a class="{{ set_active(['school/fee-edit-list', 'school/search']) }}"
                                        href="{{ route('fee-edit-list', '2') }}">Fee Edit</a></li>

                                <li><a class="{{ set_active(['school/fee-deposite-list', 'school/search']) }}"
                                        href="{{ route('fee-deposite-list', '2') }}">Fees Deposite</a></li>

                                <li><a class="{{ set_active(['school/fees-card', 'school/search']) }}"
                                        href="{{ route('fees-card', '2') }}">Fees Card</a></li>

                                <li><a class="{{ set_active(['school/fees-report', 'school/search']) }}"
                                        href="{{ route('fees-report', '2') }}">Fees Report</a></li>
                                <li><a class="{{ set_active(['school/pending-fees', 'school/search']) }}"
                                        href="{{ route('pending-fees', '2') }}">Pending Fees</a></li>
                                <li><a class="{{ set_active(['school/pending-fees', 'school/search']) }}"
                                        href="{{ route('pending-fees', '2') }}">Current Running Fees</a></li>
                            @endif

                            {{-- <li><a class="{{set_active(['school/studentlist', 'school/search'])}}" href="{{ route('studentlist','4') }}">Recover Student</a></li> --}}

                        </ul>
                    </li>
                    <li class="{{ set_active(['school/class', 'school/add-class']) }}">
                        <a href="#"><i class="fas fa-building"></i>
                            <span>SETTING</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <i class='bx bxs-chevron-down htmlcss-arrow arrow '></i>
                        <ul class="htmlCss-sub-menu sub-menu">
                            @if (Custom::getUser()->role_name == 'Staff')
                                @if (in_array('115', Custom::getStaffPower()))
                                    <li><a class="{{ set_active(['school/class']) }}"
                                            href="{{ route('schoolClass') }}">Class
                                            List</a></li>
                                    <li><a class="{{ set_active(['school/add-class']) }}"
                                            href="{{ route('add-class') }}">Add
                                            Class</a></li>
                                    <li><a class="{{ set_active(['school/subject']) }}"
                                            href="{{ route('schoolsubject') }}">Subject List</a></li>
                                    <li><a class="{{ set_active(['school/add-subject']) }}"
                                            href="{{ route('add-subject') }}">Add Subject</a></li>
                                @else
                                    <li><a class="{{ set_active(['school/class']) }} popup"
                                            href="javascript:void(0)">Class
                                            List</a></li>
                                    <li><a class="{{ set_active(['school/add-class']) }} popup"
                                            href="javascript:void(0)">Add
                                            Class</a></li>
                                    <li><a class="{{ set_active(['school/subject']) }} popup"
                                            href="javascript:void(0)">Subject List</a></li>
                                    <li><a class="{{ set_active(['school/add-subject']) }} popup"
                                            href="javascript:void(0)">Add Subject</a></li>
                                @endif
                            @else
                                <li><a class="{{ set_active(['school/class']) }}"
                                        href="{{ route('schoolClass') }}">Class
                                        List</a></li>
                                <li><a class="{{ set_active(['school/add-class']) }}"
                                        href="{{ route('add-class') }}">Add
                                        Class</a></li>
                                <li><a class="{{ set_active(['school/subject']) }}"
                                        href="{{ route('schoolsubject') }}">Subject List</a></li>
                                <li><a class="{{ set_active(['school/add-subject']) }}"
                                        href="{{ route('add-subject') }}">Add Subject</a></li>
                                <li><a class="{{ set_active(['school/slider']) }}"
                                        href="{{ route('slider') }}">Slider</a></li>
                                <li><a class="{{ set_active(['school/slider']) }}"
                                        href="{{ route('exam_list') }}">Exam Scheme</a></li>
                            @endif


                            {{-- <li><a class="{{set_active(['school/list', 'school/search'])}}" href="{{ route('schoollist') }}">Approved Admission</a></li>
                            <li><a class="{{set_active(['school/list', 'school/search'])}}" href="{{ route('schoollist') }}">Rejected Admission</a></li>
                            <li><a class="{{set_active(['school/list', 'school/search'])}}" href="{{ route('schoollist') }}">Student List</a></li>
                            <li><a class="{{set_active(['school/list', 'school/search'])}}" href="{{ route('schoollist') }}">Recover Student</a></li> --}}

                        </ul>
                    </li>
                    {{-- <li>
                        <a href="#"><i class="fas fa-rupee-sign"></i>
                            <span>FEES</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <i class='bx bxs-chevron-down js-arrow arrow'></i>
                        <ul class="js-sub-menu sub-menu">
                            <li ><a href="{{ route('fesstypelist') }}" class="{{set_active(['school/sessionlist'])}}">Deposite</a></li>

                        </ul>
                    </li> --}}
                    {{-- <li class="{{set_active(['school/OnlineRegistration'])}}">
                        <a class="{{set_active(['school/OnlineRegistration'])}}" href="{{ route('onlineRegistration') }}"><i class="fas fa-book"></i> <span>ONLINE REGISTRATIONS</span></a>
                    </li> --}}


                    <li class="{{ set_active(['school/add-staff', 'school/add-class']) }}">
                        <a href="#"><i class="fas fa-user"></i>
                            <span>STAFF</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <i class='bx bxs-chevron-down js-staff arrow '></i>
                        <ul class="js-staff-menu sub-menu">

                            @if (Custom::getUser()->role_name == 'Staff')
                                @if (in_array('11', Custom::getStaffPower()))
                                    <li><a class="{{ set_active(['school/staff-list']) }}"
                                            href="{{ route('staff-list') }}">Staff List</a></li>
                                    <li><a class="{{ set_active(['school/add-staff']) }}"
                                            href="{{ route('add-staff') }}">Add
                                            Staff</a></li>
                                @else
                                    <li><a class="{{ set_active(['school/staff-list']) }} popup"
                                            href="javascript:void(0)">Staff List</a></li>
                                    <li><a class="{{ set_active(['school/add-staff']) }} popup"
                                            href="javascript:void(0)">Add
                                            Staff</a></li>
                                @endif
                            @else
                                <li><a class="{{ set_active(['school/staff-list']) }}"
                                        href="{{ route('staff-list') }}">Staff List</a></li>
                                <li><a class="{{ set_active(['school/add-staff']) }}"
                                        href="{{ route('add-staff') }}">Add
                                        Staff</a></li>
                            @endif


                            {{-- <li><a href="add-department.html">Staff Attendance</a></li> --}}
                            {{-- <li><a href="add-department.html">Staff Salary</a></li> --}}

                        </ul>
                    </li>

                    <li class="{{ set_active(['school/add-staff', 'school/add-class']) }}">
                        <a href="#"><i class="fas fa-pen"></i>
                            <span>Data Entry</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <i class='bx bxs-chevron-down js-staff arrow '></i>
                        <ul class="js-staff-menu sub-menu">

                            @if (Custom::getUser()->role_name == 'Staff')
                                <li><a
                                        @if (in_array('8', Custom::getStaffPower())) class="{{ set_active(['school/staff-list']) }}"
                                            href="{{ route('promote-list', '2') }}" @else
                                            class="{{ set_active(['school/staff-list']) }} popup"
                                                href="javascript:(0)" @endif>Promote
                                        Student</a></li>
                                <li><a
                                        @if (in_array('16', Custom::getStaffPower())) class="{{ set_active(['school/staff-list']) }}"
                                                            href="{{ route('promote-staff-list') }}" @else
                                                            class="{{ set_active(['school/staff-list']) }} popup"
                                                                href="javascript:(0)" @endif>Promote
                                        Staff</a></li>
                            @else
                                <li><a class="{{ set_active(['school/staff-list']) }}"
                                        href="{{ route('promote-list', '2') }}">Promote Student</a></li>
                                <li><a class="{{ set_active(['school/staff-list']) }}"
                                        href="{{ route('promote-staff-list') }}">Promote Staff</a></li>
                            @endif
                        </ul>
                    </li>
                    <li class="{{ set_active(['school/add-staff', 'school/add-class']) }}">
                        <a href="#"><i class="fas fa-pen"></i>
                            <span>Attendance</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <i class='bx bxs-chevron-down js-staff arrow '></i>
                        <ul class="js-staff-menu sub-menu">

                            @if (Custom::getUser()->role_name == 'Staff')
                                <li><a
                                        @if (in_array('17', Custom::getStaffPower())) class="{{ set_active(['school/take_student_attendance']) }}"
                                            href="{{ route('school/take_student_attendance') }}" @else
                                            class="{{ set_active(['school/take_student_attendance-list']) }} popup"
                                                href="javascript:(0)" @endif>Take
                                        Student Attendance</a></li>
                                <li><a
                                        @if (in_array('17', Custom::getStaffPower())) class="{{ set_active(['school/view_student_attendance']) }}"
                                                        href="{{ route('school/view_student_attendance') }}" @else
                                                        class="{{ set_active(['school/view_student_attendance']) }} popup"
                                                            href="javascript:(0)" @endif>Edit
                                        Student Attendance</a></li>
                                <li><a
                                        @if (in_array('17', Custom::getStaffPower())) class="{{ set_active(['school/student-attendance-record']) }}"
                                                            href="{{ route('school/student-attendance-record') }}" @else
                                                            class="{{ set_active(['school/student-attendance-record']) }} popup"
                                                                href="javascript:(0)" @endif>Student
                                        Attendance Record</a></li>
                                <li><a
                                        @if (in_array('26', Custom::getStaffPower())) class="{{ set_active(['school/holiday-list']) }}"
                                                                href="{{ route('school/holiday-list') }}" @else
                                                                class="{{ set_active(['school/holiday-list']) }} popup"
                                                                    href="javascript:(0)" @endif>Holiday List</a></li>
                            @else
                                <li><a class="{{ set_active(['school/take_student_attendance']) }}"
                                        href="{{ route('school/take_student_attendance') }}">Take Student
                                        Attendance</a></li>
                                <li><a class="{{ set_active(['school/view_student_attendance']) }}"
                                        href="{{ route('school/view_student_attendance') }}">Edit Student
                                        Attendance</a></li>
                                <li><a class="{{ set_active(['school/student-attendance-record']) }}"
                                        href="{{ route('school/student-attendance-record') }}">Student
                                        Attendance Record</a></li>
                                <li><a class="{{ set_active(['school/holiday-list']) }}"
                                        href="{{ route('school/holiday-list') }}">Holiday List</a></li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="search-box">
                {{-- <i class='bx bx-search'></i> --}}
                <div class="input-box">
                    <input type="text" placeholder="Search...">
                </div>
            </div>
        </div>
    </nav>


    <div class="modal fade contentmodal" id="popupbox" tabindex="-3" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header pb-0 border-bottom-0  justify-content-end">
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="feather-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('deletestudent') }}" method="POST">
                        @csrf
                        <div class="delete-wrap text-center">
                            {{-- <div class="del-icon">
                                <i class="feather-x-circle"></i>
                            </div> --}}
                            <input type="hidden" name="id" class="id" value="">
                            <h6 style="color:rgb(107, 107, 107)">You are Not Authorized to View This Page ?</h6>
                            <div class="row align-items-center justify-content-center">
                                <div class="col-md-12">
                                    <a href="https://www.freeiconspng.com/img/25253"
                                        title="Image from freeiconspng.com"><img
                                            src="https://www.freeiconspng.com/uploads/round-error-icon-16.jpg"
                                            width="50" height="50" alt="round error icon" /></a>
                                </div>
                                <div class="col-md-8 mt-2">
                                    <h5 class="name text-left">Please Contact your Admin !</h5>
                                </div>
                            </div>
                            <div class="submit-section">
                                {{-- <button type="submit" class="btn btn-success me-2">Yes</button> --}}
                                {{-- <a class="btn btn-danger" data-bs-dismiss="modal">No</a> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--<script src="script.js"></script>-->

    <script>
        $('.popup').on('click', function() {
            $('#popupbox').modal('show');
        });

        // search-box open close js code
        let navbar = document.querySelector(".navbar");
        let searchBox = document.querySelector(".search-box .bx-search");
        // let searchBoxCancel = document.querySelector(".search-box .bx-x");

        // sidebar open close js code
        let navLinks = document.querySelector(".nav-links");
        let menuOpenBtn = document.querySelector(".navbar .bx-menu");
        let menuCloseBtn = document.querySelector(".nav-links .bx-x");
        menuOpenBtn.onclick = function() {
            navLinks.style.left = "0";
        }
        menuCloseBtn.onclick = function() {
            navLinks.style.left = "-100%";
        }


        // sidebar submenu open close js code
        let htmlcssArrow = document.querySelector(".htmlcss-arrow");
        htmlcssArrow.onclick = function() {
            navLinks.classList.toggle("show1");
        }

        let jsArrow = document.querySelector(".js-arrow");
        jsArrow.onclick = function() {
            navLinks.classList.toggle("show3");
        }

        let jsStaff = document.querySelector(".js-staff");
        jsStaff.onclick = function() {
            navLinks.classList.toggle("show4");
        }
    </script>
</body>

</html>
