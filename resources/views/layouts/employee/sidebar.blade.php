<div style="position: fixed;">
    <div class="py-3 border-bottom mt-2">
        <div class="media">
            <div class="align-self-center mr-3">
                <img src="{{asset('images/avatars/'.Auth::user()->avatar)}}" class="avatar-xs rounded-circle" alt="">
            </div>
            <div class="media-body">
                <h5 class="font-size-15 mt-0 mb-1">{{ Auth::user()->profile->firstname }} {{Auth::user()->profile->lastname}}</h5>
                <p class="text-muted mb-0"><i class="mdi mdi-circle text-success align-middle mr-1"></i><span>{{ Auth::user()->username }}</span></p>
            </div>
          
        </div>
    </div>

    <div class="search-box chat-search-box py-3">
        <div class="position-relative">
            <input type="text" class="form-control" placeholder="Search...">
            <i class="bx bx-search-alt search-icon"></i>
        </div>
    </div>

    <div class="chat-leftsidebar-nav">
        
        <ul class="nav nav-pills nav-justified">
            <li class="nav-item">
                <a href="/home" class="nav-link {{ (request()->is('home')) ? 'active' : '' }}">
                    <i class="bx bx-chat font-size-20 d-sm-none"></i>
                    <span class="d-none d-sm-block">Employee</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="/management" class="nav-link {{ (request()->is('management')) ? 'active' : '' }}">
                    <i class="bx bx-group font-size-20 d-sm-none"></i>
                    <span class="d-none d-sm-block">Management</span>
                </a>
            </li>
        </ul>

        @if(request()->is('home')) 
        <div class="py-4">
            <div class="card border shadow-none mb-2">
                <a @click="show(0,'e')" class="text-body">
                    <div class="p-2">
                        <div class="d-flex">
                            <div class="avatar-xs align-self-center ml-2 mr-3">
                                <div class="avatar-title rounded bg-transparent text-success font-size-20">
                                    <i class='text-success bx bxs-dashboard h2 mt-1'></i>
                                </div>
                            </div> 
                            <div class="overflow-hidden mr-auto">
                                <h5 class="font-size-13 text-truncate mb-1">Home</h5> 
                                <p class="text-muted font-size-12 text-truncate mb-0">Dost IX</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="card border shadow-none mb-2">
                <a @click="show(1,'e')" class="text-body">
                    <div class="p-2">
                        <div class="d-flex">
                            <div class="avatar-xs align-self-center ml-2 mr-3">
                                <div class="avatar-title rounded bg-transparent text-warning font-size-20">
                                    <i class='text-info bx bxs-book-bookmark h2 mt-1'></i>
                                </div>
                            </div> 
                            <div class="overflow-hidden mr-auto">
                                <h5 class="font-size-13 text-truncate mb-1">My Documents</h5> 
                                <p class="text-muted font-size-12 text-truncate mb-0 documentcount">0 pending documents</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="card border shadow-none mb-2">
                <a @click="show(2,'e')" class="text-body">
                    <div class="p-2">
                        <div class="d-flex">
                            <div class="avatar-xs align-self-center ml-2 mr-3">
                                <div class="avatar-title rounded bg-transparent text-danger font-size-20">
                                    <i class='text-danger bx bx-trip h2 mt-1'></i>
                                </div>
                            </div> 
                            <div class="overflow-hidden mr-auto">
                                <h5 class="font-size-13 text-truncate mb-1">My Travels</h5> 
                                <p class="text-muted font-size-12 text-truncate mb-0 travelcount">0 pending travels</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="card border shadow-none mb-2">
                <a @click="show(3,'e')" class="text-body">
                    <div class="p-2">
                        <div class="d-flex">
                            <div class="avatar-xs align-self-center ml-2 mr-3">
                                <div class="avatar-title rounded bg-transparent text-warning font-size-20">
                                    <i class='text-warning bx bxs-notepad h2 mt-1'></i>
                                </div>
                            </div> 
                            <div class="overflow-hidden mr-auto">
                                <h5 class="font-size-13 text-truncate mb-1">My Requests</h5> 
                                <p class="text-muted font-size-12 text-truncate mb-0 requestcount">0 requests</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endif
    
        @if(Auth::user()->hasRole(["Regional Director","Document Staff"]))
            @if(request()->is('management')) 
            <div class="py-4">
                <div class="card border shadow-none mb-2">
                    <a @click="show(0,'m')" class="text-body">
                        <div class="p-2">
                            <div class="d-flex">
                                <div class="avatar-xs align-self-center ml-2 mr-3">
                                    <div class="avatar-title rounded bg-transparent text-success font-size-20">
                                        <i class='text-success bx bxs-dashboard h2 mt-1'></i>
                                    </div>
                                </div> 
                                <div class="overflow-hidden mr-auto">
                                    <h5 class="font-size-13 text-truncate mb-1">Home</h5> 
                                    <p class="text-muted text-truncate mb-0">Dost IX</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="card border shadow-none mb-2">
                    <a @click="show(1,'m')" class="text-body">
                        <div class="p-2">
                            <div class="d-flex">
                                <div class="avatar-xs align-self-center ml-2 mr-3">
                                    <div class="avatar-title rounded bg-transparent text-warning font-size-20">
                                        <i class='text-info bx bxs-book-bookmark h2 mt-1'></i>
                                    </div>
                                </div> 
                                <div class="overflow-hidden mr-auto">
                                    <h5 class="font-size-13 text-truncate mb-1">Manage Documents</h5> 
                                    <p class="text-muted text-truncate mb-0 documentcount">0 documents</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="card border shadow-none mb-2">
                    <a @click="show(2,'m')" class="text-body">
                        <div class="p-2">
                            <div class="d-flex">
                                <div class="avatar-xs align-self-center ml-2 mr-3">
                                    <div class="avatar-title rounded bg-transparent text-danger font-size-20">
                                        <i class='text-danger bx bx-trip h2 mt-1'></i>
                                    </div>
                                </div> 
                                <div class="overflow-hidden mr-auto">
                                    <h5 class="font-size-13 text-truncate mb-1">Manage Travels</h5> 
                                    <p class="text-muted text-truncate mb-0 travelcount">0 travels</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="card border shadow-none mb-2">
                    <a @click="show(3,'m')" class="text-body">
                        <div class="p-2">
                            <div class="d-flex">
                                <div class="avatar-xs align-self-center ml-2 mr-3">
                                    <div class="avatar-title rounded bg-transparent text-warning font-size-20">
                                        <i class='text-warning bx bxs-notepad h2 mt-1'></i>
                                    </div>
                                </div> 
                                <div class="overflow-hidden mr-auto">
                                    <h5 class="font-size-13 text-truncate mb-1">Manage Requests</h5> 
                                    <p class="text-muted text-truncate mb-0 requestcount">0 requests</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endif
        @endif
    </div>
</div>