<template>
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="text-danger font-weight-bold font-size-16 ml-3">Travel Information</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="margin-bottom: 0px; height: 450px;">

                <div class="row" style="margin-top: -20px; display:flex;">
                    <div class="col-md-7">
                        <div class="card-body" ref="details">
                            <blockquote class="p-3 border-light border rounded ">
                               <span :class="'float-right badge badge-'+event.status.color+' font-size-10 ml-2'">{{ event.status.name }}</span>
                                <div class="d-flex">
                                    <div class="mr-3">
                                        <i class="bx bxs-quote-alt-left text-info font-size-14"></i>
                                    </div>
                                    <div>
                                        <p class="mb-2 font-weight-bold">{{event.destination}} </p>
                                        <p class="text-muted font-size-12">{{information.purpose}}</p>
                                    </div>
                                </div>
                            </blockquote>

                           <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-selected="true">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">Information</span>    
                                    </a>
                                </li>
                                <li class="nav-item" v-if="add != undefined">
                                    <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-selected="false">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block">Travel Funds</span>    
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="row font-size-12 mt-2">
                                        <div class="col-sm-6">
                                            <h6 class="text-muted font-size-12"><i class="bx bxs-calendar mr-1 text-primary"></i> Departure</h6>
                                            <p class="font-weight-bold text-dark mb-0">{{event.start_at}}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <h6 class="text-muted font-size-12"><i class="bx bxs-calendar mr-1 text-primary"></i> Arrival</h6>
                                            <p class="font-weight-bold text-dark mb-0">{{event.end_at}}</p>
                                        </div>
                                    </div>
                                    <hr></hr>
                                    <div class="row font-size-12">
                                        <div class="col-sm-6">
                                            <h6 class="text-muted font-size-12"><i class="bx bxs-car mr-1 text-primary"></i> Vehicle</h6>
                                            <p class="font-weight-bold text-dark mb-0">{{event.vehicle.name}} <span class="text-info font-size-11">({{event.vehicle.plate}}) </span>, {{event.vehicle.group}}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <h6 class="text-muted font-size-12"><i class="bx bxs-user-circle mr-1 text-primary"></i> Driver</h6>
                                            <p class="font-weight-bold text-dark mb-0">{{event.vehicle.user}}</p>
                                        </div>
                                    </div>
                                <hr></hr>
                                <div class="row font-size-12">
                                        <div class="col-sm-6">
                                            <div class="team">
                                                <a v-for="employee in event.employees" v-bind:key="employee.id" class="team-member d-inline-block" data-toggle="tooltip" data-placement="top" title="" :data-original-title="employee.name">
                                                    <img :src="currentUrl+'/images/avatars/'+employee.avatar" class="rounded-circle avatar-xs m-1" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="profile" role="tabpanel" v-if="add != undefined">
                                    <div class="float-right">
                                        <select v-model="add.fund" class="custom-select custom-select-sm ml-2" disabled style="width: 200px;">
                                            <option value="" selected disabled>Select Funds</option>
                                            <option value="General Funds">General Funds</option>
                                            <option value="Project Funds">Project Funds</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                    <br><br>
                                    <div class="row">
                                    <div class="col-md-12"><hr></hr></div>
                                        <div class="col-xl-4">
                                            <h5 class="font-size-11 text-primary"> Actual</h5>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="custom-control custom-checkbox custom-checkbox-primary">
                                                <input id="a1" type="checkbox" class="custom-control-input" v-model="add.a1" value="1" onclick="return false;">
                                                <label class="custom-control-label" for="a1">Accommodation</label>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="custom-control custom-checkbox custom-checkbox-primary">
                                                <input id="a2" type="checkbox" class="custom-control-input" v-model="add.a2" value="1" onclick="return false;">
                                                <label class="custom-control-label" for="a2">Meals/Food</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12"><hr></hr></div>

                                        <div class="col-xl-4">
                                            <div>
                                                <h5 class="font-size-11 text-primary pull-right">Per Diem</h5>
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="custom-control custom-checkbox custom-checkbox-primary mb-4">
                                                <input id="p1" type="checkbox" class="custom-control-input" v-model="add.p1" value="1" onclick="return false;">
                                                <label class="custom-control-label" for="p1">Accommodation</label>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="custom-control custom-checkbox custom-checkbox-primary mb-4">
                                                <input id="p2" type="checkbox" class="custom-control-input" v-model="add.p2" value="1" onclick="return false;">
                                                <label class="custom-control-label" for="p2">Incidental Expenses</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="card-body" style="margin-left: -50px;">
                            <div class="chat-leftsidebar-nav">
                                <div class="row" v-if="event.status.name != 'Approved' && roles.includes('Regional Director')">
                                    <div class="col-md-8">
                                        <select v-model="status" class="custom-select custom-select-sm" style="width: 100%;">
                                            <option v-for="status in statuses" v-bind:key="status.id" :value="status.id" v-if="status.name != 'Pending' && status.name != 'Completed'">{{status.name}}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button @click="save" type="button" class="btn btn-success btn-sm btn-block waves-effect waves-light">Save</button>
                                    </div>
                                </div>
                                <hr v-if="event.status.name != 'Approved' && roles.includes('Regional Director')"></hr>
                                <div class="search-box mb-0">
                                    <div class="position-relative">
                                        <input v-on:keyup.enter="store" v-model="text" type="text" class="form-control bg-light border-light rounded" placeholder="Aa...">
                                        <i class="bx bxs-comment-dots search-icon"></i>
                                    </div>
                                </div>
                               <div data-simplebar="init" :style="{ 'height': '360px' }">
                                    <ul class=" mt-3 list-group list-group-flush">
                                        <li class="list-group-item py-3" v-for="comment in event.comments" v-bind:key="comment.id">
                                            <div class="media" style="margin-left: -10px;">
                                                <div class="avatar-sm mr-4">
                                                    <img :src="currentUrl+'/images/avatars/'+comment.avatar" class="rounded-circle avatar-sm m-1" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="mt-2 font-size-14 text-primary">{{comment.user}} <small class="text-muted float-right">{{comment.created_at}}</small></h5>
                                                    <p class="text-muted">{{comment.comment}}</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="col-md-12 align-center" style="margin-top: 80px;" v-if="event.comments.length == 0">
                                        <center>
                                        <i class='text-muted bx bx-notepad' style="font-size: 100px;"></i><br>
                                        <p class="text-muted font-size-11">No comments found</p>
                                        </center>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['statuses','profile'],
        data(){
            return {
                currentUrl: window.location.origin,
                windowHeight: window.innerHeight,
                windowWidth: window.innerWidth,
                roles: {},
                event: { user: {}, mode: {}, vehicle: {}, status: {}, comments: []},
                information : [],
                text: '',
                status: 61,
                add : {fund: '',a1: 0,a2: 0,p1: 0,p2: 0}
            }
        },

        computed : {
            height: function() {
                return this.windowHeight - 140;
            },
            width: function() {
                return this.windowWidth - 340;
            },
            counts: function(){
                return Math.floor((this.height - 125) / 54);
            }
        },

        created(){
            this.roles = this.profile.roles.map(function(a) {return a.name;});
        },

        methods : {
            fetch(id){
                axios.get(this.currentUrl + '/request/travel/'+id)
                .then(response => {
                    this.event = response.data.data;
                    this.information = JSON.parse(response.data.data.information)[0];
                    this.add = this.information.additional[0];
                })
                .catch(err => console.log(err));
            },

            set(event,type){
                if(type == "id"){
                    axios.get(this.currentUrl + '/request/travel/'+event)
                    .then(response => {
                        this.event = response.data.data;
                        this.information = JSON.parse(response.data.data.information)[0];
                        this.add = this.information.additional[0];
                    })
                    .catch(err => console.log(err));
                }else{
                    $("#showEvent").modal("show");
                    this.event = event;
                    this.information = JSON.parse(this.event.information)[0];
                    this.add = this.information.additional[0];
                }
            },

            store(){
                axios.post(this.currentUrl + '/request/travel/comment', {
                    id: this.event.id,
                    text: this.text
                })
                .then(response => {
                    this.event.comments.unshift(response.data.data);
                    this.text = '';
                    Vue.$toast.success('<strong>Comment Posted</strong>', {
                        position: 'bottom-right'
                    });
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }else{
                        Vue.$toast.error('<strong>Please contact Administrator</strong>', {
                            position: 'bottom-right'
                        });
                    }
                });
            },

            save(){
                axios.post(this.currentUrl + '/request/travel/status', {
                    id: this.event.id,
                    status_id: this.status
                })
                .then(response => {
                    this.event.status = response.data.data.status;
                    this.$emit('res', response.data.data);
                    Vue.$toast.success('<strong>Event Approved</strong>', {
                        position: 'bottom-right'
                    });
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }else{
                        Vue.$toast.error('<strong>Please contact Administrator</strong>', {
                            position: 'bottom-right'
                        });
                    }
                });
            }
        }
    }
</script>
