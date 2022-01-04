<template>          
    <div class="col-md-12">
        <div class="card" :style="{ height: height + 'px' }">
            <div class="card-body" v-if="calendar == false">

                <div class="row mb-3">
                    <div class="col-xl-6 col-sm-6 form-inline">
                         <button type="button" @click="choose" class="btn btn-danger waves-effect waves-light mr-2"><i class='bx bx-calendar'></i></button>
                        <form class="float-sm-right form-inline">
                            <div class="search-box">
                                <div class="position-relative">
                                    <input type="text" class="form-control bg-light border-light rounded" placeholder="Search..." v-model="keyword" @keyup="fetch()">
                                   <i class='bx bx-search-alt search-icon'></i>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-6 col-sm-6">
                        <ul class="list-inline document-chat-nav text-right mb-0 dropdown">
                            <li class="list-inline-item d-none d-sm-inline-block font-size-12">{{pagination.current_page}} out of {{pagination.last_page}}</li>
                            <li class="list-inline-item d-none d-sm-inline-block">
                                <a class="btn nav-btn" v-bind:class="[{disabled: !pagination.prev_page_url}]" @click="fetch(pagination.prev_page_url)">
                                    <i class='bx bxs-chevron-left font-size-16'></i>
                                </a>
                            </li>
                            <li class="list-inline-item d-none d-sm-inline-block">
                                <a class="btn nav-btn" v-bind:class="[{disabled: !pagination.next_page_url}]" @click="fetch(pagination.next_page_url)">
                                    <i class='bx bxs-chevron-right font-size-16'></i>
                                </a>
                            </li>
                            <li class="list-inline-item d-non d-sm-inline-block">
                                <div class="dropdown" data-toggle="tooltip" data-placement="top" title="" data-original-title="Filter by Travel type">
                                    <button type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-light" style="margin-right: -5px;"><span class="d-none d-sm-inline-block"> <i class='bx bxs-navigation'></i></span></button>                                 
                                    <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="height: auto; overflow-y: auto;">
                                        <a @click="filter(1,'type')" class="dropdown-item">Vehicle Registration</a>
                                        <a @click="filter(0,'type')" class="dropdown-item">Travel Order</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-inline-item d-non d-sm-inline-block">
                                <div class="dropdown" data-toggle="tooltip" data-placement="top" title="" data-original-title="Filter by type">
                                    <button type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-light" style="margin-right: -5px;"><span class="d-none d-sm-inline-block"> <i class='bx bx-trip'></i></span></button>                                 
                                    <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="height: auto; overflow-y: auto;">
                                        <a @click="filter('','mode')" class="dropdown-item">All</a>
                                        <a @click="filter(mode.id,'mode')" class="dropdown-item" v-for="mode in modes" v-bind:key="mode.id">{{mode.name}}</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-inline-item d-non d-sm-inline-block">
                                <div class="dropdown" data-toggle="tooltip" data-placement="top" title="" data-original-title="Filter by Status">
                                    <button type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-light" style="margin-right: -5px;"><span class="d-none d-sm-inline-block"> <i class='bx bxs-traffic-cone'></i></span></button>                                 
                                    <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="height: auto; overflow-y: auto;">
                                        <a @click="filter('','status')" class="dropdown-item">All</a>
                                        <a @click="filter(sta.id,'status')" class="dropdown-item" v-for="sta in statuses" v-bind:key="sta.id">{{sta.name}}</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered table-nowrap">
                        <thead class="thead-light">
                            <tr class="font-size-12">
                                <th style="width: 1%;"></th>
                                <th tyle="width: 25%;">Travel Information</th>
                                <th class="text-center">Transportation</th>
                                <th class="text-center">Requested By</th>
                                <th class="text-center">Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="travel in travels" v-bind:key="travel.id">
                                <td>
                                    <i :class="'bx bx-lg '+travel.status.others+' text-'+travel.status.color" style="font-size: 20px;"></i>
                                </td>
                                <td class="font-size-12">
                                    <h5 class="font-size-11 mb-1 text-dark">{{ (travel.destination.length > 60) ? travel.destination.substring(0,60)+".." : travel.destination }}</span></h5>
                                    <p class="font-size-11 text-muted mb-0">{{travel.date}}</p>
                                </td>
                                <td class="text-center font-size-12" v-if="travel.vehicle != null">
                                    <h5 class="font-size-11 mb-1 text-dark">{{travel.vehicle.name}} <span class="text-info">({{travel.vehicle.plate}})</span></h5>
                                    <p class="font-size-11 text-muted mb-0">{{travel.vehicle.group}}</p>
                                </td>
                                <td class="text-center font-size-12" v-else>
                                    <h5 class="font-size-11 mb-1 text-danger">{{travel.mode.name}}</h5>
                                    <p class="font-size-11 text-muted mb-0">test</p>
                                </td>
                                <td class="text-center">
                                    <h5 class="font-size-11 mb-1 text-dark">{{travel.user.name}}</h5>
                                    <p class="font-size-11 text-muted mb-0">{{travel.created_at}}</p>
                                </td>
                                <td class="text-center"><span :class="'badge badge-bg badge-'+travel.status.color">{{travel.status.name}}</span></td>
                                <td class="text-right">
                                    <button @click="action('view',travel)" type="button" class="btn btn-sm btn-primary w-xs waves-effect waves-light">View</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="row md-3" v-else>
                <travel-calendar v-if="tcv == true" :modetype="modetype" :traveltype="traveltype" ref="trvlcalendar"></travel-calendar>
                <travel-calendar-travel :modetype="modetype" :traveltype="traveltype" v-else></travel-calendar-travel>
            </div>

        </div>

    <div class="modal fade exampleModal" id="showEvent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <travel-view @res="sts" :profile="profile" :statuses="statuses" ref="view"></travel-view>
    </div>

    <div class="modal fade exampleModal" id="choose" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <travel-calendar-choose :modes="modes" @ch="msg" ref="choose"></travel-calendar-choose>
    </div>

  
    <!--<div class="modal fade exampleModal" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <travel-create @status="message" :infos="infos" :modes="modes" ref="create"></travel-create>
    </div>

    <div class="modal fade exampleModal" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <travel-view @status="message" ref="view"></travel-view>
    </div>-->
  
</div>
</template>

<script>
export default {
    props: ['modes','statuses','profile'],
    data(){
        return {
            currentUrl: window.location.origin,
            windowHeight: window.innerHeight,
            windowWidth: window.innerWidth,
            errors: [],
            pagination: {},
            keyword: '',
            travels : [],
            status: '',
            type: '',
            mode: '',
            calendar: false,
            tcv: false,
            traveltype: '',
            modetype: ''
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
        this.fetch();
        // this.roles = this.$parent.$parent.profile.roles.map(function(a) {return a.name;});
    },

    methods: {
        
        makePagination(meta, links) {
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev
            };
            this.pagination = pagination;
        },

        fetch(page_url) {
            let vm = this; let key; let t; let s; let m;
            (this.keyword != '' && this.keyword != null) ? key = this.keyword : key = '-';
            (this.type != '' && this.type != null) ? t = this.type : t = '-';
            (this.status != '' && this.status != null) ? s = this.status : s = '-';
            (this.mode != '' && this.mode != null) ? m = this.mode: m = '-';
            page_url = page_url || this.currentUrl + '/request/travels/admin/'+t+'/'+s+'/'+m+'/'+key+'/'+this.counts;

            axios.get(page_url)
            .then(response => {
                this.travels = response.data.data;
                vm.makePagination(response.data.meta, response.data.links);
            })
            .catch(err => console.log(err));
        },

        addnew(){
            // $("#new").modal('show');
            // this.$refs.create.clear();
            (this.calendar == true) ? this.calendar = false : this.calendar = true;
        },
        
        choose(){
            $("#choose").modal('show');
        },

        msg(val){
            this.calendar = true;
            this.traveltype = val.is_vehicle;
            this.modetype = val.mode.id;
            if(val.mode.name == "Official Vehicle"){
                this.tcv = true;
            }else{
                this.tcv = false;
            }
            $("#choose").modal('hide');
        },

        sts(data){
            let index = this.travels.findIndex(x => x.id === data.id);
            this.travels[index] = data;
        },  

        action(type,event)
        {
            switch(type){
                case 'edit':
                    this.editable = true;
                    $("#new").modal('show');
                    this.$refs.create.edit(document,true);
                break;
                case 'route':
                    $("#route").modal('show');
                    this.$refs.route.route(document,true);
                break;
                case 'view':
                    $("#view").modal('show');
                    this.$refs.view.set(event,'event');
                break;
            }
           
        },

        updatestatus(document){
            $("#updatestatus").modal('show');
            this.$refs.status.update(document.status,document.id);
            this.editable = true;
        },

        filter(data,type){
            switch(type){
                case 'type':
                    this.type = data;
                break;
                case 'status':
                    this.status = data;
                break;
                case 'mode':
                    this.mode = data;
                break;
            }
            this.fetch();
        },
    }, 
}
$(document).ready(function() {$("body").tooltip({ selector: '[data-toggle=tooltip]' });});
</script>