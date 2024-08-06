{{-- <div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main Menu</span>
                </li>
                {{-- <li class="{{set_active(['setting/page'])}}">
                    <a href="{{ route('setting/page') }}">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li> --}}
{{-- <li class="{{set_active(['home'])}}">
                    <a href="{{ route('home') }}"><i class="fas feather-grid"></i> <span>Dashboard</span></a>
                </li> --}}
{{-- <li class="submenu {{set_active(['home','teacher/dashboard','student/dashboard'])}}">
                    <a href="#"><i class="feather-grid"></i>
                        <span> Dashboard</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('home') }}" class="{{set_active(['home'])}}">Admin Dashboard</a></li>
                        <li><a href="{{ route('teacher/dashboard') }}" class="{{set_active(['teacher/dashboard'])}}">Teacher Dashboard</a></li>
                        <li><a href="{{ route('student/dashboard') }}" class="{{set_active(['student/dashboard'])}}">Student Dashboard</a></li>
                    </ul>
                </li> --}}


{{-- {{-- <li class="submenu">
                    <a href="#"><i class="fas fa-chalkboard-teacher"></i>
                        <span> </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="teachers.html">Teacher List</a></li>
                        <li><a href="teacher-details.html">Teacher View</a></li>
                        <li><a href="add-teacher.html">Teacher Add</a></li>
                        <li><a href="edit-teacher.html">Teacher Edit</a></li>
                    </ul>
                </li> --}}
{{-- <li class="submenu {{set_active(['school/add','school/list'])}}">
                    <a href="#"><i class="fas fa-building"></i>
                        <span>Schools</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li ><a href="{{ route('add-school') }}" class="{{set_active(['school/add'])}}">Add School</a></li>
                        <li ><a href="{{ route('schoollist') }}" class="{{set_active(['school/list', 'school/search'])}}">School List</a></li>
                    </ul>
                </li>
                <li class="{{set_active(['school/OnlineRegistration'])}}">
                    <a class="{{set_active(['school/OnlineRegistration'])}}" href="{{ route('onlineRegistration') }}"><i class="fas fa-book"></i> <span>Online Registrations</span></a>
                </li>
                <li class="menu-title">
                    <span>Management</span>
                </li>
                <li class="submenu {{set_active(['school/sessionlist',''])}} ">
                    <a href="#"><i class="fas fa-cog"></i>
                        <span>Setting</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li ><a href="{{ route('sessionlist') }}" class="{{set_active(['school/sessionlist'])}}">Session</a></li>
                        <li><a href="departments.html">Add Occupation</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-user"></i>
                        <span>Staff</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="departments.html">Staff List</a></li>
                        <li><a href="add-department.html">Add Staff</a></li>
                        <li><a href="add-department.html">Staff Attendance</a></li>
                        <li><a href="add-department.html">Staff Salary</a></li>
                    </ul>
                </li> --}}
{{-- <li class="submenu">
                    <a href="#"><i class="fas fa-book-reader"></i>
                        <span></span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="subjects.html">Subject List</a></li>
                        <li><a href="add-subject.html">Subject Add</a></li>
                        <li><a href="edit-subject.html">Subject Edit</a></li>
                    </ul>
                </li> --}}


{{-- </ul>
        </div>
    </div>
</div> --}}



<body>
    <nav>
        <div class="navbar">
            <i class='bx bx-menu'></i>
            <div class="logo"><a href="#"></a></div>
            <div class="nav-links">
                <div class="sidebar-logo">
                    {{-- <span class="logo-name">CodingLab</span> --}}
                    <i class='bx bx-x'></i>
                </div>
                <ul class="links">
                    <li class="{{set_active(['home'])}}">
                        <a class="{{set_active(['home'])}}" href="{{ route('home') }}"><i class="fas feather-grid"></i> <span>DASHBOARD</span></a>
                    </li>

                    <li>
                        <a href="#"><i class="fas fa-building"></i>
                            <span>SCHOOL</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <i class='bx bxs-chevron-down htmlcss-arrow arrow '></i>
                        <ul class="htmlCss-sub-menu sub-menu">
                            <li><a class="{{set_active(['school/add'])}}" href="{{ route('add-school') }}">Add School</a></li>
                            <li><a class="{{set_active(['school/list', 'school/search'])}}" href="{{ route('schoollist') }}">School List</a></li>
                            {{-- <li><a href="#">Card Design</a></li>
                            <li class="more">
                                <span><a href="#">More</a>
                                    <i class='bx bxs-chevron-right arrow more-arrow'></i>
                                </span>
                                <ul class="more-sub-menu sub-menu">
                                    <li><a href="#">Neumorphism</a></li>
                                    <li><a href="#">Pre-loader</a></li>
                                    <li><a href="#">Glassmorphism</a></li>
                                </ul>
                            </li> --}}
                        </ul>
                    </li>
                    <li class="{{set_active(['school/OnlineRegistration'])}}">
                        <a class="{{set_active(['school/OnlineRegistration'])}}" href="{{ route('onlineRegistration') }}"><i class="fas fa-book"></i> <span>ONLINE REGISTRATIONS</span></a>
                    </li>

                    <li>
                        <a href="#"><i class="fas fa-cog"></i>
                            <span>SETTING</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <i class='bx bxs-chevron-down js-arrow arrow'></i>
                        <ul class="js-sub-menu sub-menu">
                            <li ><a href="{{ route('sessionlist') }}" class="{{set_active(['school/sessionlist'])}}">Session</a></li>

                        </ul>
                    </li>
                    {{-- <li>
                        <a href="#"><i class="fas fa-user"></i>
                            <span>STAFF</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <i class='bx bxs-chevron-down js-staff arrow '></i>
                        <ul class="js-staff-menu sub-menu">
                            <li><a href="departments.html">Staff List</a></li>
                            <li><a href="add-department.html">Add Staff</a></li>
                            <li><a href="add-department.html">Staff Attendance</a></li>
                            <li><a href="add-department.html">Staff Salary</a></li>

                        </ul>
                    </li> --}}
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
    <!--<script src="script.js"></script>-->

    <script>
        // search-box open close js code
        let navbar = document.querySelector(".navbar");
        let searchBox = document.querySelector(".search-box .bx-search");
        // let searchBoxCancel = document.querySelector(".search-box .bx-x");

        // searchBox.addEventListener("click", () => {
        //     navbar.classList.toggle("showInput");
        //     if (navbar.classList.contains("showInput")) {
        //         searchBox.classList.replace("bx-search", "bx-x");
        //     } else {
        //         searchBox.classList.replace("bx-x", "bx-search");
        //     }
        // });

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
        // let moreArrow = document.querySelector(".more-arrow");
        // moreArrow.onclick = function() {
        //     navLinks.classList.toggle("show2");
        // }
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
