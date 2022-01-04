<template>          
    <div class="col-md-12">
        <div class="card" :style="{ height: height + 'px' }">
            <div class="card-body">

                <div class="row mb-3">
                    <div class="col-xl-6 col-sm-6 form-inline">
                         <button type="button" @click="add" class="btn btn-danger waves-effect waves-light mr-2"><i class='bx bx-calendar'></i></button>
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
                                        <a @click="filter('','type')" class="dropdown-item">All</a>
                                        <a @click="filter(typ.id,'type')" class="dropdown-item" v-for="typ in types" v-bind:key="typ.id">{{typ.name}}</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-inline-item d-non d-sm-inline-block">
                                <div class="dropdown" data-toggle="tooltip" data-placement="top" title="" data-original-title="Filter by Status">
                                    <button type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-light" style="margin-right: -5px;"><span class="d-none d-sm-inline-block"> <i class='bx bxs-traffic-cone'></i></span></button>                                 
                                    <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="height: auto; overflow-y: auto;">
                                        <a @click="filter('','location')" class="dropdown-item">All</a>
                                        <a @click="filter(loc.id,'location')" class="dropdown-item" v-for="loc in locations" v-bind:key="loc.id">{{loc.name}}</a>
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
                                <th class="text-center">Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    <div class="modal fade exampleModal" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <request-create :locations="locations" :types="types" @status="message" ref="create"></request-create>
    </div>

    <div class="modal fade exampleModal" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <request-view @status="message" ref="view"></request-view>
    </div>
  
</div>
</template>

<script>
export default {
     props: ['profile', 'types','locations'],
    data(){
        return {
            currentUrl: window.location.origin,
            windowHeight: window.innerHeight,
            windowWidth: window.innerWidth,
            errors: [],
            pagination: {},
            keyword: '',
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
            page_url = page_url || this.currentUrl + '/request/travels/'+t+'/'+s+'/'+m+'/'+key+'/'+this.counts;

            axios.get(page_url)
            .then(response => {
                this.travels = response.data.data;
                vm.makePagination(response.data.meta, response.data.links);
            })
            .catch(err => console.log(err));
        },
        
        add(){
            $("#new").modal('show');
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

        action(type,event)
        {
            switch(type){
                case 'edit':
                    this.editable = true;
                    $("#new").modal('show');
                    this.$refs.create.edit(document,true);
                break;
                case 'view':
                    $("#view").modal('show');
                    this.$refs.view.set(event,'event');
                break;
            }
           
        },

        filter(data,type){
            
            switch(type){
                case 'type':
                    this.type = data;
                break;
                case 'location':
                    this.status = data;
                break;
                case 'status':
                    this.completed = data;
                break;
            }
            this.fetch();
        },
    }, 
}
$(document).ready(function() {$("body").tooltip({ selector: '[data-toggle=tooltip]' });});
</script>