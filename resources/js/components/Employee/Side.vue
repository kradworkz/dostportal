<template>
<div class="ml-lg-4" style="position: fixed;">
    <!--<div class="py-3 border-bottom mt-2">
        <div class="media">
            <div class="align-self-center mr-3">
                <img src="assets/images/dost.png" class="avatar-xs rounded-circle" alt="">
            </div>
            <div class="media-body">
                <p class="text-muted mb-0"><span>Republic of the Philippines</span></p>
                <h5 class="font-size-15 mt-0 mb-1">DOST-IX</h5>
            </div>
        </div>
    </div>-->


    <div class="chat-leftsidebar-nav">
        <div class="py-4">

            <div class="search-box chat-search-box py-3">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <i class="bx bx-search-alt search-icon"></i>
                </div>
            </div>

            <div class="card border shadow-none"  style="margin-bottom: 10px;">
                <a class="text-body">
                    <div class="p-1">
                        <div class="d-flex mt-1">
                            <div class="avatar-xs align-self-center ml-2 mr-2">
                                <div class="avatar-title rounded bg-transparent">
                                    <i class='text-success bx bxs-bell-ring h4 mt-1'></i>
                                </div>
                            </div> 
                            <div class="overflow-hidden mr-auto align-self-center">
                                <h5 class="font-size-12 text-truncate mt-1">Notifications</h5> 
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <p class="font-size-11 text-truncate text-center mb-4 mt-4">No pending request</p>


            <div class="card border shadow-none"  style="margin-bottom: 10px;">
                <a class="text-body">
                    <div class="p-1">
                        <div class="d-flex mt-1">
                            <div class="avatar-xs align-self-center ml-2 mr-2">
                                <div class="avatar-title rounded bg-transparent">
                                    <i class='text-primary bx bx-calendar h4 mt-1'></i>
                                </div>
                            </div> 
                            <div class="overflow-hidden mr-auto align-self-center">
                                <h5 class="font-size-12 text-truncate mt-1">Schedules</h5> 
                            </div>
                        </div>
                    </div>
                </a>
            </div>
             <div class="table-responsive" v-if="schedules.length > 0">
                <table class="table table-centered table-nowrap font-size-11" style="border-top:hidden;">
                    <tbody>
                        <tr v-for="(s,index) in schedules" v-bind:key="index">
                            <td>{{s.code}}</td>
                            <td class="text-right">{{s.start_at}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p v-else class="font-size-11 text-truncate text-center mb-4 mt-4">No schedules</p>
            
            <div class="card border shadow-none"  style="margin-bottom: 10px;">
                <a class="text-body">
                    <div class="p-1">
                        <div class="d-flex mt-1">
                            <div class="avatar-xs align-self-center ml-2 mr-2">
                                <div class="avatar-title rounded bg-transparent">
                                    <i class='text-danger bx bx-gift h4 mt-1'></i>
                                </div>
                            </div> 
                            <div class="overflow-hidden mr-auto align-self-center">
                                <h5 class="font-size-12 text-truncate mt-1">Birthdays</h5> 
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="table-responsive" v-if="birthdays.length > 0">
                <table class="table table-centered table-nowrap font-size-11" style="border-top:hidden;">
                    <tbody>
                        <tr v-for="(b,index) in birthdays" v-bind:key="index" :class="(b.type == 'today') ? 'font-weight-bold text-primary' : ''">
                            <td><i v-if="b.type == 'today'" class='bx bx-tada bxs-cake text-danger'></i>&nbsp;{{b.name}}</td>
                            <td class="text-right">{{b.birthday}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p v-else class="font-size-11 text-truncate text-center mb-4 mt-4">No birthday for this month</p>

        </div>
    </div>
    
</div>
</template>

<script>
    export default {
        props : ['birthdays','schedules'],
        data(){
            return {
                currentUrl: window.location.origin,
                windowHeight: window.innerHeight,
            }
        },
        computed : {
            height: function() {
                return this.windowHeight - 140;
            },
        },
    }
</script>
