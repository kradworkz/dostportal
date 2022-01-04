<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>
                <li>
                    <a href="/home"  class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboards</span>
                    </a>
                </li>
                @if(Auth::user()->type == "Administrator")
                
                <li>
                    <a class="waves-effect">
                    <i class='bx bx-book-bookmark' ></i>
                        <span key="t-chat">TRACE</span>
                    </a>
                    <ul class="sub-menu " aria-expanded="false">
                        <li><a href="/documents/incoming" key="t1" class="font-size-11"><i class='bx bxs-file' ></i>Incoming Documents</a></li>
                        <li><a href="/documents/outgoing" key="t1" class="font-size-11"><i class='bx bx-file' ></i>Outgoing Documents</a></li>
                    </ul>
                </li>

                <li>
                    <a class="waves-effect">
                    <i class='bx bx-trip'></i>
                        <span key="t-chat">TRAVELS</span>
                    </a>
                    <ul class="sub-menu " aria-expanded="false">
                        <li><a href="/travels/vehicle" key="t1" class="font-size-11"><i class='bx bxs-file' ></i>Vehicle Registration</a></li>
                        <li><a href="/travels/order" key="t1" class="font-size-11"><i class='bx bx-file' ></i>Travel Order</a></li>
                    </ul>
                </li>

                <li>
                    <a href="/employees" class="waves-effect">
                    <i class='bx bxs-face'></i>
                        <span key="t-chat">Employees</span>
                    </a>
                </li>

                <li>
                    <a class="waves-effect">
                    <i class='bx bx-category' ></i>
                        <span key="t-chat">LISTS</span>
                    </a>
                    <ul class="sub-menu " aria-expanded="false">
                        <li><a href="/roles" key="t1" class="font-size-11"><i class='bx bxs-user-circle'></i>Roles</a></li>
                        <li><a href="/groups" key="t1" class="font-size-11"><i class='bx bx-group'></i>Groups</a></li>
                        <li><a href="/vehicles" key="t1" class="font-size-11"><i class='bx bxs-car'></i>Vehicles</a></li>
                        <li><a href="/positions" key="t1" class="font-size-11"><i class='bx bxs-id-card'></i>Positions</a></li>
                        <li><a href="/lists" key="t1" class="font-size-11"><i class='bx bx-list-ol'></i>Dropdowns</a></li>
                    </ul>
                </li>

                
                
                @elseif(Auth::user()->type == "Member")
                <li>
                    <a href="/assets/list" class="waves-effect">
                    <i class='bx bx-detail' ></i>
                        <span key="t-chat">Lists</span>
                    </a>
                </li>
                <li>
                    <a href="/stations" class="waves-effect">
                    <i class='bx bx-map'></i>
                        <span key="t-chat">Stations</span>
                    </a>
                </li>
                <li>
                    <a href="/search" class="waves-effect">
                    <i class='bx bx-search'></i>
                        <span key="t-chat">Search</span>
                    </a>
                </li>
                @elseif(Auth::user()->type == "Researcher")
                <li>
                    <a href="/researches" class="waves-effect">
                    <i class='bx bxs-book'></i>
                        <span key="t-chat">Researches</span>
                    </a>
                </li>
                @elseif(Auth::user()->type == "Laboratory Coordinator")
                <li>
                    <a href="/laboratory/basic" class="waves-effect">
                    <i class='bx bxs-box'></i>
                        <span key="t-chat">Basic Laboratories</span>
                    </a>
                </li>
                <li>
                    <a href="/laboratory/specialized" class="waves-effect">
                    <i class='bx bxs-cabinet'></i>
                        <span key="t-chat">Specialized Laboratories</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>