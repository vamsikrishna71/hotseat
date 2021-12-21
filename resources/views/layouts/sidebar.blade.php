<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">@lang('translation.Menu')</li>
                <li>
                    <a href="index" class="waves-effect">
                        <span key="t-file-manager">Admin dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <span key="t-multi-level">Employees</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="employee.details" key="t-level-2-2">Overview</a>
                        </li>
                        <li>
                            <a href="employee.create" key="t-level-2-2">Add Employee</a>
                        </li>

                    </ul>
                </li>
                {{-- <li>
                    <a href="{{ url('mywork') }}" class="waves-effect">
                        <span key="t-dashboards">My Work</span>
                    </a>
                </li> --}}
                <!-- <li>
                    <a href="{{ url('bookseat') }}" class="waves-effect">
                        <span key="t-dashboards">Book Seat</span>
                    </a>
                </li> -->

                {{-- <li>
                    <a href="ui-notifications" class="waves-effect">
                        <span key="t-layouts">Booking</span>
                    </a>
                </li> --}}

                {{-- <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <span key="t-dashboards">Team</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <span key="t-dashboards">calendar</span>
                    </a>
                </li> --}}

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <span key="t-multi-level">Location</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="{{ URL('location') }}" key="t-level-2-1">
                                Overview</a>
                        </li>
                        <li>
                            <a href="{{ URL('addlocation') }}" key="t-level-2-2">Add Location</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <span key="t-multi-level">Desk</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="{{ URL('floor') }}" key="t-level-2-1">
                                All Desks</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="charts-apex" class="waves-effect">
                        <span key="t-file-manager">Reports</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <span key="t-multi-level">Settings</span>
                    </a>
                    {{-- <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="javascript: void(0);" class="has-arrow" key="t-level-1-1">Location</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li>
                                    <a href="{{ URL('location') }}" key="t-level-2-1">All Location</a>
                                </li>
                                <li>
                                    <a href="{{ url('addlocation') }}" key="t-level-2-2">Add Location</a>
                                </li>
                            </ul>
                        </li>
                    </ul> --}}
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
