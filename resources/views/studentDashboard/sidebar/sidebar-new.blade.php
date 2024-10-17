<style>
    #menu ul {
        margin: 0;
        padding: 0;
        z-index: 10;
    }

    .main-menu li a i {
        margin: 3px 8px;
    }

    #menu .active {
        color: #ffe400 !important;
    }

    #menu {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #menu .main-menu {
        display: none;
    }


    /* When the menu is active (open) */
    .main-menu.open {
        transform: translateX(0%);
        opacity: 1;

    }



    #menu input[type="checkbox"],
    #menu ul span.drop-icon {
        display: none;
    }

    #menu li,
    #toggle-menu,
    #menu .sub-menu {
        border-style: solid;
        border-left: 0px;
        border-right: 0px;
        border-color: #ffffff59;
    }

    #menu li,
    #toggle-menu,
    #menu .sub-sub-menu {
        border-style: solid;
        border-left: 0px;
        border-right: 0px;
        border-color: #ffffff59;

    }

    #menu li,
    #toggle-menu {
        border-width: 0 0 1px;
    }

    #menu .sub-menu {
        background-color: #7a26c9;
        border-width: 1px 1px 0;
        margin: 0 1em;
        border-radius: 5px;
    }

    #menu .sub-sub-menu {
        background-color: #7a26c9;
        border-width: 1px 1px 0;
        margin: 0 1em;
        border-radius: 5px;
    }

    #menu .sub-menu li:last-child {
        border-width: 0;
    }

    #menu .sub-sub-menu li:last-child {
        border-width: 0;
    }


    #menu li,
    #toggle-menu,
    #menu a {
        position: relative;
        display: block;
        color: white;
        text-shadow: 1px 1px 0 rgba(0, 0, 0, .125);
    }

    #toggle-menu {
        background-color: #7a26c9;
    }

    #toggle-menu,
    #menu a {
        padding: 0.7em 0.8em;
        font-size: 0.9em;
    }

    #menu a {
        transition: all .125s ease-in-out;
        -webkit-transition: all .125s ease-in-out;
    }

    #menu a:hover {
        background: rgb(255, 255, 255);
        background: linear-gradient(90deg, rgba(255, 255, 255, 0.04245448179271705) 0%, rgba(255, 255, 255, 0.29175420168067223) 100%);
        color: #ffe400;
    }

    #menu a:active {
        background: rgb(255, 255, 255);
        background: linear-gradient(90deg, rgba(255, 255, 255, 0.04245448179271705) 0%, rgba(255, 255, 255, 0.29175420168067223) 100%);
        color: #ffe400;
    }

    #menu .sub-menu {
        display: none;
    }

    #menu .sub-sub-menu {
        display: none;
    }

    #menu input[type="checkbox"]:checked+.sub-menu {
        display: block;
    }

    #menu .open {
        display: block;
    }

    #menu .sub-menu .open {
        display: block;
    }

    #menu .sub-menu a:hover {
        color: #ffe400;
    }

    #menu .sub-sub-menu a:hover {
        color: #ffe400;
    }

    #menu .sub-menu a:active {
        color: #ffe400;
    }

    #menu .sub-sub-menu a:active {
        color: #ffe400;
    }

    #toggle-menu .bx-menu,
    #menu li label.bx-menu {
        position: absolute;
        right: 1.5em;
        top: 1.25em;
    }

    #menu label.drop-icon,
    #toggle-menu .bx-menu {
        border-radius: 50%;
        width: 1em;
        height: 1em;
        text-align: center;
        text-shadow: 0 0 0 transparent;
        color: #ffffff;
        margin-left: auto;
    }

    #toggle-menu .bx-x {
        border-radius: 50%;
        width: 1em;
        height: 1em;
        text-align: center;
        text-shadow: 0 0 0 transparent;
        color: #ffffff;
        margin-left: 10px;
    }


    #menu a {
        padding: 0.7em 0.8em;
        font-size: 0.9em;
        display: flex;
        justify-content: space-start;
        color: white;
        text-shadow: none;
    }


    @media only screen and (max-width: 64em) and (min-width: 52.01em) {

        #menu .sub-menu li {
            width: auto;
        }

        #menu .sub-sub-menu li {
            width: auto;
        }

    }

    @media only screen and (min-width: 52em) {

        #menu .main-menu {
            display: block;
        }

        #toggle-menu,
        #menu label.bx-menu {
            display: none;
        }

        #menu ul span.drop-icon {
            display: inline-block;
        }

        #menu li {
            float: left;
            border-width: 0 1px 0 0;
        }

        #menu .sub-menu li {
            float: none;
        }

        #menu .sub-sub-menu li {
            float: none;
        }

        #menu .sub-menu {
            border-width: 0;
            margin: -1px 3px;
            position: absolute;
            top: 100%;
            left: 0;
            width: 15em;
            z-index: 3000;
            -webkit-box-shadow: 10px 10px 29px -3px rgba(204, 204, 204, 1);
            -moz-box-shadow: 10px 10px 29px -3px rgba(204, 204, 204, 1);
            box-shadow: 10px 10px 29px -3px rgba(204, 204, 204, 1);
        }

        #menu .sub-sub-menu {
            border-width: 0;
            margin: -1px 3px;
            position: absolute;
            top: 100%;
            left: 0;
            width: 15em;
            z-index: 3000;
            -webkit-box-shadow: 10px 10px 29px -3px rgba(204, 204, 204, 1);
            -moz-box-shadow: 10px 10px 29px -3px rgba(204, 204, 204, 1);
            box-shadow: 10px 10px 29px -3px rgba(204, 204, 204, 1);
        }

        #menu .sub-menu,
        #menu input[type="checkbox"]:checked+.sub-menu {
            display: none;
        }

        #menu .sub-menu li {
            border-width: 0 0 1px;
        }

        #menu .sub-sub-menu li {
            border-width: 0 0 1px;
        }

        #menu .sub-sub-menu li {
            border-width: 0 0 1px;
        }

        #menu .sub-menu .sub-menu {
            top: 0;
            left: 100%;
        }

        #menu .sub-menu .sub-sub-menu {
            top: 0;
            left: 100%;
        }

        #menu li:hover .sub-menu {
            display: block;
        }

        #menu .sub-menu li:hover .sub-sub-menu {
            display: block;
        }


    }

    @media only screen and (max-width: 52em) {

        #menu li,
        #toggle-menu,
        #menu a {
            color: black;

        }


        #menu label.drop-icon,
        #toggle-menu .bx-menu {
            border-radius: 50%;
            width: 1em;
            height: 1em;
            text-align: center;
            text-shadow: 0 0 0 transparent;
            color: black;
        }

        .main-menu {
            display: flex;
            transform: translateX(-100%);
            transition: transform 1s ease;
            position: absolute;
            top: 100%;
            height: 100vh;
            width: 40vw;
            flex-direction: column;
            background-color: white;
        }

        #menu {
            justify-content: left;
        }

        #menu #toggle-menu .bx-menu {
            font-size: 40px;
            margin: -50px -60px 0px 0px;
            color: white;
        }

        #menu #toggle-menu .bx-x {
            font-size: 40px;
            color: white;
            margin-left: -20px;
            margin-top: 10px;
        }

        #toggle-menu {
            background-color: transparent;
        }

        #menu li,
        #toggle-menu,
        #menu .sub-menu {
            border-color: #8b898959;
        }

        #menu li,
        #toggle-menu,
        #menu .sub-sub-menu {
            border-color: #8b898959;
        }

        #toggle-menu,
        #menu a {
            padding: 0.7em 1.5em;
            font-size: 0.9em;
            display: flex;
            justify-content: space-start;
            color: black;
            text-shadow: none;
        }

        #menu a:hover {
            padding: 0.7em 1.5em;
            font-size: 0.9em;
            display: flex;
            justify-content: space-between;
            color: #7a26c9;
            font-weight: bold;
            text-shadow: none;
            background-color: #ebebeb61;

        }

        #menu a:active {
            padding: 0.7em 1.5em;
            font-size: 0.9em;
            display: flex;
            justify-content: space-between;
            color: #7a26c9;
            font-weight: bold;
            text-shadow: none;
            background-color: #ebebeb61;

        }

        #menu .sub-menu {
            background-color: transparent;
        }

        #menu .sub-sub-menu {
            background-color: transparent;
        }

        #menu .sub-menu a:hover {
            color: #7a26c9;
            font-weight: bold;
            background-color: #ebebeb61;
        }

        #menu .sub-sub-menu a:hover {
            color: #7a26c9;
            font-weight: bold;
            background-color: #ebebeb61;
        }



        .header h6 {
            font-size: 0.8rem;
        }

        .header p {
            font-size: 11px;
        }

        #menu .main-menu {
            display: flex;
        }

        #menu .active {
            color: #7a26c9 !important;
            font-weight: bold;
        }

    }

    @media only screen and (max-width: 52em) {

        .main-menu {
            width: 60vw;
        }
    }

    @media print {
        #menu {
            display: none;
        }
    }
</style>


<nav id="menu">
    <label for="tm" id="toggle-menu"><i class='bx bx-menu' id="menu-icon"></i></label>
    <input type="checkbox" id="tm">
    <ul class="main-menu clearfix">
        <li><a class="{{ set_active(['student']) }}" href="{{ route('student') }}"><i class="fas feather-grid"></i>
                <span>Dashboard</span></a></li>
        <li><a class="" href="javascript:void(0)"><i class="fas fa-building"></i>
                <span>FEES</span>
                <label title="Toggle Drop-down" class="drop-icon" for="sm1"> <i
                        class='bx bxs-chevron-down'></i></label>
            </a>
            <ul class="sub-menu">
                <li><a href="{{ route('fees-info')}}">Fees Info</a></li>
                <li><a href="{{ route('fees-card')}}">Fees Card</a></li>
                <li><a href="{{ route('fees/feesdeposite') }}">Online Fees Deposite</a></li>
                <li><a href="{{-- route('fees/feesdeposite') --}}">Current Running Fees </a></li>
                <li><a href="">N.O.C. Fees</a></li>
                <li><a href="">Transport Fees Info</a></li>
                <li><a href="">Hostel Fees Info</a></li>
            </ul>
        </li>

        <li><a class="" href="javascript:void(0)"><i class="fas fa-building"></i>
                <span>Student</span>
                <label title="Toggle Drop-down" class="drop-icon" for="sm1"> <i
                        class='bx bxs-chevron-down'></i></label>
            </a>
            <ul class="sub-menu">
                <li><a href="{{ route('student_profile') }}">Profile</a></li>
                <li><a href="{{ route('time-table') }}">Time Table</a></li>
                <li><a href="">Record</a></li>
                <li><a href="">Result</a></li>
                <li><a href="">Test Mark</a></li>
                <li><a href="">Exam Mark</a></li>
                <li><a href="">Attendance Record</a></li>
                <li><a href="{{ route('topper-student') }}">Topper Student</a></li>
                <li><a href="">Leave Application Form</a></li>
                <li><a href="">Leave Application Form Status</a></li>
                <li><a href="">Password Change</a></li>
                <li><a href="{{ route('view-student-maintenance') }}">Student Maintenance</a></li>
                <li><a href="">Complaint</a></li>
            </ul>
        </li>

        <li><a class="" href="javascript:void(0)"><i class="fas fa-building"></i>
                <span>Download</span>
                <label title="Toggle Drop-down" class="drop-icon" for="sm1"> <i
                        class='bx bxs-chevron-down'></i></label>
            </a>
            <ul class="sub-menu">
                <li><a href="">Id Card</a></li>
                <li><a href="#">Exam
                    <label title="Toggle Drop-down" class="drop-icon" for="sm2"> <i
                            class='bx bxs-chevron-down'></i></label>
                </a>
                <ul class="sub-sub-menu">
                    <li><a class="{{ set_active(['school/slider']) }}"
                            href="{{ route('view-student-scheme', 'Test Exam') }}">Test
                            Exam Scheme</a></li>
                    <li><a class="{{ set_active(['school/slider']) }}"
                            href="{{ route('view-student-scheme', 'Monthly Exam') }}">Monthly
                            Exam Scheme</a></li>
                    <li><a class="{{ set_active(['school/slider']) }}"
                            href="{{ route('view-student-scheme', 'Quarterly Exam') }}">Quarterly
                            Exam Scheme</a></li>
                    <li><a class="{{ set_active(['school/slider']) }}"
                            href="{{ route('view-student-scheme', 'Half Yearly Exam') }}">Half Yearly
                            Exam Scheme</a></li>
                    <li><a class="{{ set_active(['school/slider']) }}"
                            href="{{ route('view-student-scheme', 'Annual Exam') }}">Annual
                            Exam Scheme</a></li>
                </ul>
            </li>
                <li><a href="">Exam Desk Slip</a></li>
                <li><a href="">Exam Admit Card</a></li>
                <li><a href="">T.C.</a></li>
                <li><a href="">C.C.</a></li>
            </ul>
        </li>
        <li><a class="" href="javascript:void(0)"><i class="fas fa-building"></i>
            <span>Notice</span>
            <label title="Toggle Drop-down" class="drop-icon" for="sm1"> <i
                    class='bx bxs-chevron-down'></i></label>
        </a>
        <ul class="sub-menu">
            <li><a href="{{ route('notice-for-you') }} ">Notice For You</a></li>
            <li><a href=" {{ route('student-notice-for-all')}}">Notice For All</a></li>
        
        </ul>
    </li>
        <li><a class="" href="javascript:void(0)"><i class="fas fa-building"></i>
                <span>Work</span>
                <label title="Toggle Drop-down" class="drop-icon" for="sm1"> <i
                        class='bx bxs-chevron-down'></i></label>
            </a>
            <ul class="sub-menu">
                <li><a href="">Class Work</a></li>
                <li><a href="">Home Work</a></li>
                <li><a href="">Online Class</a></li>
                <li><a href="">Online Coaching</a></li>
                <li><a href="">Online Class Room</a></li>
            </ul>
        </li>
        <li><a class="" href="javascript:void(0)"><i class="fas fa-building"></i>
                <span>Institute</span>
                <label title="Toggle Drop-down" class="drop-icon" for="sm1"> <i
                        class='bx bxs-chevron-down'></i></label>
            </a>
            <ul class="sub-menu">
                <li><a href="">Gallery</a></li>
                <li><a href="">Library</a></li>
                <li><a href="">Staff Info</a></li>
                <li><a href="">Institute Rules</a></li>
                <li><a href="">Contact</a></li>
            </ul>
        </li>

        {{-- Sub Sub Menu  --}}

        {{-- <li><a class="" href="javascript:void(0)"><i class="fas fa-building"></i>
                <span>Setting</span>
                <label title="Toggle Drop-down" class="drop-icon" for="sm1"> <i
                        class='bx bxs-chevron-down'></i></label>
            </a>

            <ul class="sub-menu">
                    <li><a href="#">Class
                            <label title="Toggle Drop-down" class="drop-icon" for="sm2"> <i
                                    class='bx bxs-chevron-down'></i></label>
                        </a>
                        <input type="checkbox" id="sm2">
                        <ul class="sub-sub-menu">
                            <li><a class="{{ set_active(['school/class']) }}"
                                    href="{{ route('schoolClass') }}">Class
                                    List</a></li>
                            <li><a class="{{ set_active(['school/add-class']) }}"
                                    href="{{ route('add-class') }}">Add
                                    Class</a></li>

                        </ul>
                    </li>

                    <li><a href="#">Subject
                            <label title="Toggle Drop-down" class="drop-icon" for="sm2"> <i
                                    class='bx bxs-chevron-down'></i></label>
                        </a>

                        <ul class="sub-sub-menu">
                            <li><a class="{{ set_active(['school/add-subject']) }}"
                                    href="{{ route('add-subject') }}">Add
                                    Subject</a></li>
                            <li><a class="{{ set_active(['school/subject']) }}"
                                    href="{{ route('schoolsubject') }}">Subject
                                    List</a></li>
                        </ul>
                    </li>
            </ul>
        </li> --}}
    </ul>
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

<script>
    $('.popup').on('click', function() {
        $('#popupbox').modal('show');
    });

    $('#toggle-menu').on('click', function() {
        var $menu = $('.main-menu');
        var $icon = $('#menu-icon');

        if ($menu.hasClass('open')) {
            $menu.removeClass('open'); // Slide out
            $icon.removeClass('bx-x').addClass('bx-menu');
        } else {
            $menu.addClass('open'); // Slide in
            $icon.removeClass('bx-menu').addClass('bx-x');
        }
    });

    $('li').click(function(e) {
        e.stopPropagation();
        $(this).find('ul.sub-menu').toggleClass('open');
        // $('ul.sub-menu').not($(this).find('ul.sub-menu')).removeClass('open');

        if (!$(this).find('ul.sub-menu').hasClass('open')) {
            $(this).find('ul.sub-sub-menu').toggleClass('open');
        }
        $('ul.sub-sub-menu').not($(this).find('ul.sub-sub-menu')).removeClass('open');
    });

    // Remove the 'open' class when clicking anywhere else on the document
    $(document).click(function() {
        $('ul.sub-menu, ul.sub-sub-menu').removeClass('open');
    });


    // $('li').click(function(e) {
    //     e.stopPropagation();
    //     $(this).find('ul.sub-menu').toggleClass('open');
    //     $('ul.sub-menu').not($(this).find('ul.sub-menu')).removeClass('open');
    // });

    // $(document).click(function() {
    //     $('ul.sub-menu').removeClass('open');
    // });
</script>
