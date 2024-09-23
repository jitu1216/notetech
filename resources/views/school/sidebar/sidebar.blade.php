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

    #menu .open{
        display: block;
    }

    #menu .sub-menu .open{
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
        #menu{
            display: none;
        }
    }
</style>


<nav id="menu">
    <label for="tm" id="toggle-menu"><i class='bx bx-menu' id="menu-icon"></i></label>
    <input type="checkbox" id="tm">
    <ul class="main-menu clearfix">
        <li><a class="{{ set_active(['school']) }}" href="{{ route('school') }}"><i class="fas feather-grid"></i>
                <span>Dashboard</span></a></li>
        <li><a class="" href="javascript:void(0)"><i class="fas fa-building"></i>
                <span>Admission</span>
                <label title="Toggle Drop-down" class="drop-icon" for="sm1"> <i
                        class='bx bxs-chevron-down'></i></label>
            </a>
            {{-- <input type="checkbox" id="sm1"> --}}
            <ul class="sub-menu">
                @if (Custom::getUser()->role_name == 'Staff')
                    <li><a
                            @if (in_array('1', Custom::getStaffPower())) class="{{ set_active(['school/add-student']) }}"
                        href="{{ route('add-student') }}"@else
                        class="{{ set_active(['school/add-student']) }} popup"
                           href="javascript:(0)" @endif>
                            <span>New Admission</span></a></li>
                    <li><a
                            @if (in_array('14', Custom::getStaffPower())) class="{{ set_active(['school/pendinglist']) }}"
                                href="{{ route('pendinglist') }}"@else
                                class="popup"
                                   href="javascript:(0)" @endif>
                            <span>Pending Admission</span></a></li>
                    <li><a
                            @if (in_array('2', Custom::getStaffPower())) class="{{ set_active(['school/add-student']) }}"
                                        href="{{ route('studentlist', '2') }}"@else
                                        class="{{ set_active(['school/add-student']) }} popup"
                                           href="javascript:(0)" @endif>
                            <span>Approved Student</span></a></li>
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
                    <li><a class="{{ set_active(['school/add-student']) }}" href="{{ route('add-student') }}">New
                            Admission</a></li>
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

                    {{-- <li><a href="#">Item 2.2
                            <label title="Toggle Drop-down" class="drop-icon" for="sm2"> <i
                                    class='bx bxs-chevron-down'></i></label>
                        </a>
                        <input type="checkbox" id="sm2">
                        <ul class="sub-menu">
                            <li><a href="#">Item 2.2.1</a></li>
                            <li><a href="#">Item 2.2.2</a></li>
                            <li><a href="#">Item 2.2.3</a></li>
                        </ul>
                    </li> --}}
                @endif
            </ul>
        </li>
        <li><a class="" href="javascript:void(0)"><i class="fas fa-building"></i>
                <span>Fees</span>
                <label title="Toggle Drop-down" class="drop-icon" for="sm1"> <i
                        class='bx bxs-chevron-down'></i></label>
            </a>
            {{-- <input type="checkbox" id="sm1"> --}}
            <ul class="sub-menu">
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
                        <li><a class="{{ set_active(['school/fesstypelist']) }} popup" href="javascript:void(0)">Fees
                                Type</a></li>
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
                    <li><a class="{{ set_active(['school/fesstypelist']) }}" href="{{ route('fesstypelist') }}">Fees
                            Type</a></li>
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
            </ul>
        </li>

        <li><a class="" href="javascript:void(0)"><i class="fas fa-building"></i>
                <span>Setting</span>
                <label title="Toggle Drop-down" class="drop-icon" for="sm1"> <i
                        class='bx bxs-chevron-down'></i></label>
            </a>
            {{-- <input type="checkbox" id="sm1"> --}}
            <ul class="sub-menu">
                @if (Custom::getUser()->role_name == 'Staff')
                    @if (in_array('115', Custom::getStaffPower()))
                        <li><a href="#">Class
                                <label title="Toggle Drop-down" class="drop-icon" for="sm2"> <i
                                        class='bx bxs-chevron-down'></i></label>
                            </a>
                            {{-- <input type="checkbox" id="sm2"> --}}
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
                            {{-- <input type="checkbox" id="sm2"> --}}
                            <ul class="sub-sub-menu">
                                <li><a class="{{ set_active(['school/add-subject']) }}"
                                        href="{{ route('add-subject') }}">Add
                                        Subject</a></li>
                                <li><a class="{{ set_active(['school/subject']) }}"
                                        href="{{ route('schoolsubject') }}">Subject
                                        List</a></li>
                            </ul>
                        </li>
                    @else
                        <li><a href="#">Class
                                <label title="Toggle Drop-down" class="drop-icon" for="sm2"> <i
                                        class='bx bxs-chevron-down'></i></label>
                            </a>
                            {{-- <input type="checkbox" id="sm2"> --}}
                            <ul class="sub-sub-menu">
                                <li><a class="{{ set_active(['school/class']) }}  popup"
                                        href="javascript:void(0)">Class
                                        List</a></li>
                                <li><a class="{{ set_active(['school/add-class']) }} popup"
                                        href="javascript:void(0)">Add
                                        Class</a></li>
                            </ul>
                        </li>

                        <li><a href="#">Subject
                                <label title="Toggle Drop-down" class="drop-icon" for="sm2"> <i
                                        class='bx bxs-chevron-down'></i></label>
                            </a>
                            {{-- <input type="checkbox" id="sm2"> --}}
                            <ul class="sub-sub-menu">
                                <li><a class="{{ set_active(['school/add-subject']) }} popup"
                                        href="javascript:void(0)">Add
                                        Subject</a></li>
                                <li><a class="{{ set_active(['school/subject']) }} popup"
                                        href="javascript:void(0)">Subject
                                        List</a></li>
                            </ul>
                        </li>

                        <li><a href="#">Slider
                                <label title="Toggle Drop-down" class="drop-icon" for="sm2"> <i
                                        class='bx bxs-chevron-down'></i></label>
                            </a>
                            {{-- <input type="checkbox" id="sm2"> --}}
                            <ul class="sub-sub-menu">
                                <li><a class="{{ set_active(['school/slider']) }} popup"
                                        href="javascript:void(0)">Slider</a></li>
                                <li><a class="{{ set_active(['school/addslider']) }} popup"
                                        href="javascript:void(0)">Add Slider</a></li>
                            </ul>
                        </li>

                        <li><a href="#">Exam
                                <label title="Toggle Drop-down" class="drop-icon" for="sm2"> <i
                                        class='bx bxs-chevron-down'></i></label>
                            </a>
                            {{-- <input type="checkbox" id="sm2"> --}}
                            <ul class="sub-sub-menu">
                                <li><a class="{{ set_active(['school/slider']) }} popup"
                                        href="javascript:void(0)">Exam
                                        Scheme</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Time Table
                                <label title="Toggle Drop-down" class="drop-icon" for="sm2"> <i
                                        class='bx bxs-chevron-down'></i></label>
                            </a>
                            {{-- <input type="checkbox" id="sm2"> --}}
                            <ul class="sub-sub-menu">
                                <li><a class="{{ set_active(['school/add-time-table']) }} popup"
                                        href="javascript:void(0)">Add Time Table</a></li>
                                <li><a class="{{ set_active(['school/add-time-table']) }} popup"
                                        href="javascript:void(0)">Edit Time Table</a></li>
                                <li><a class="{{ set_active(['school/add-time-table']) }} popup"
                                        href="javascript:void(0)">Print Time Table</a></li>
                            </ul>
                        </li>
                    @endif
                @else
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
                        {{-- <input type="checkbox" id="sm2"> --}}
                        <ul class="sub-sub-menu">
                            <li><a class="{{ set_active(['school/add-subject']) }}"
                                    href="{{ route('add-subject') }}">Add
                                    Subject</a></li>
                            <li><a class="{{ set_active(['school/subject']) }}"
                                    href="{{ route('schoolsubject') }}">Subject
                                    List</a></li>
                        </ul>
                    </li>

                    <li><a href="#">Slider
                            <label title="Toggle Drop-down" class="drop-icon" for="sm2"> <i
                                    class='bx bxs-chevron-down'></i></label>
                        </a>
                        {{-- <input type="checkbox" id="sm2"> --}}
                        <ul class="sub-sub-menu">
                            <li><a class="{{ set_active(['school/slider']) }}"
                                    href="{{ route('slider') }}">Slider</a></li>
                            <li><a class="{{ set_active(['school/addslider']) }}"
                                    href="{{ route('addslider') }}">Add Slider</a></li>
                        </ul>
                    </li>

                    <li><a href="#">Exam
                            <label title="Toggle Drop-down" class="drop-icon" for="sm2"> <i
                                    class='bx bxs-chevron-down'></i></label>
                        </a>
                        {{-- <input type="checkbox" id="sm2"> --}}
                        <ul class="sub-sub-menu">
                            <li><a class="{{ set_active(['school/slider']) }}"
                                    href="{{ route('exam_list') }}">Exam
                                    Scheme</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Time Table
                            <label title="Toggle Drop-down" class="drop-icon" for="sm2"> <i
                                    class='bx bxs-chevron-down'></i></label>
                        </a>
                        {{-- <input type="checkbox" id="sm2"> --}}
                        <ul class="sub-sub-menu">
                            <li><a class="{{ set_active(['school/add-time-table']) }}"
                                    href="{{ route('add-time-table') }}">Add Time Table</a></li>
                            <li><a class="{{ set_active(['school/add-time-table']) }}"
                                    href="{{ route('edit-time-table') }}">Edit Time Table</a></li>
                            <li><a class="{{ set_active(['school/add-time-table']) }}"
                                    href="{{ route('view-time-table') }}">Print Time Table</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </li>

        <li><a class="" href="javascript:void(0)"><i class="fas fa-user"></i>
                <span>Staff</span>
                <label title="Toggle Drop-down" class="drop-icon" for="sm1"> <i
                        class='bx bxs-chevron-down'></i></label>
            </a>
            {{-- <input type="checkbox" id="sm1"> --}}
            <ul class="sub-menu">
                @if (Custom::getUser()->role_name == 'Staff')
                    @if (in_array('11', Custom::getStaffPower()))
                        <li><a class="{{ set_active(['school/staff-list']) }}"
                                href="{{ route('staff-list') }}">Staff List</a></li>
                        <li><a class="{{ set_active(['school/add-staff']) }}" href="{{ route('add-staff') }}">Add
                                Staff</a></li>
                    @else
                        <li><a class="{{ set_active(['school/staff-list']) }} popup" href="javascript:void(0)">Staff
                                List</a></li>
                        <li><a class="{{ set_active(['school/add-staff']) }} popup" href="javascript:void(0)">Add
                                Staff</a></li>
                    @endif
                @else
                    <li><a class="{{ set_active(['school/staff-list']) }}" href="{{ route('staff-list') }}">Staff
                            List</a></li>
                    <li><a class="{{ set_active(['school/add-staff']) }}" href="{{ route('add-staff') }}">Add
                            Staff</a></li>
                @endif
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
