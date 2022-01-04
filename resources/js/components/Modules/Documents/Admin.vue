<template>
<div class="d-xl-flex">                
    <div class="w-100">
        <div class="card" :style="{ height: height + 'px' }">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-xl-6 col-sm-6 form-inline">
                         <button type="button" @click="addnew" class="btn btn-danger waves-effect waves-light mr-2"><i class='bx bx-plus-medical'></i></button>
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
                                <div class="dropdown" data-toggle="tooltip" data-placement="top" title="" data-original-title="Filter by Document type">
                                    <button type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-light" style="margin-right: -5px;"><span class="d-none d-sm-inline-block"> <i class='bx bx-folder'></i></span></button>                                 
                                    <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="height: auto; overflow-y: auto;">
                                        <a @click="filter(1,'doc')" class="dropdown-item">Incoming Documents</a>
                                        <a @click="filter(0,'doc')" class="dropdown-item">Outcoming Documents</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-inline-item d-non d-sm-inline-block">
                                <div class="dropdown" data-toggle="tooltip" data-placement="top" title="" data-original-title="Filter by type">
                                    <button type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-light" style="margin-right: -5px;"><span class="d-none d-sm-inline-block"> <i class='bx bx-file-find'></i></span></button>                                 
                                    <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="height: auto; overflow-y: auto;">
                                        <a @click="filter('','type')" class="dropdown-item">All</a>
                                        <a @click="filter(typ.id,'type')" class="dropdown-item" v-for="typ in types" v-bind:key="typ.id">{{typ.name}}</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-inline-item d-non d-sm-inline-block">
                                <div class="dropdown" data-toggle="tooltip" data-placement="top" title="" data-original-title="Filter by completion">
                                    <button type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-light" style="margin-right: -5px;"><span class="d-none d-sm-inline-block"> <i class='bx bxs-file-export'></i></span></button>                                 
                                    <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="height: auto; overflow-y: auto;">
                                        <a @click="filter('','completed')" class="dropdown-item">All</a>
                                        <a @click="filter(1,'completed')" class="dropdown-item">Completed</a>
                                        <a @click="filter(0,'completed')" class="dropdown-item">Not completed</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-inline-item d-non d-sm-inline-block">
                                <div class="dropdown" data-toggle="tooltip" data-placement="top" title="" data-original-title="Filter by Status">
                                    <button type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-light" style="margin-right: -5px;"><span class="d-none d-sm-inline-block"> <i class='bx bxs-file-import'></i></span></button>                                 
                                    <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="height: auto; overflow-y: auto;">
                                        <a @click="filter('','status')" class="dropdown-item">All</a>
                                        <a @click="filter(1,'status')" class="dropdown-item">Routed</a>
                                        <a @click="filter(0,'status')" class="dropdown-item">Not Routed</a>
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
                                <th tyle="width: 25%;" class="text-center">Routing Slip</th>
                                <th>Subject</th>
                                <th class="text-center" v-if="width > 1230">Contact Information</th>
                                <th class="text-center" v-if="width > 1030">Encoded by/at</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="document in documents" v-bind:key="document.id">
                                <td>
                                    <i v-if="document.is_completed == 0" v-bind:class="[(document.is_status == 0 ? 'text-danger bx-flashing' : 'text-warning')]" class='bx bx-lg bxs-info-circle' style="font-size: 20px;"></i>
                                    <i v-else class='text-success bx bx-lg bxs-badge-check' style="font-size: 20px;"></i>
                                </td>
                                <td class="text-center font-weight-bold font-size-12">{{ document.route_slip }}</td>
                                <td class="text-muted">
                                    {{ (document.subject.length > 60) ? document.subject.substring(0,60)+".." : document.subject }}
                                </td>
                                <td class="text-center" v-if="width > 1230">
                                    <h5 class="font-size-11 mb-1 text-dark">{{document.sender.name}}</h5>
                                    <p class="font-size-11 text-muted mb-0">{{document.company.name}}</p>
                                </td>
                                 <td class="text-center" v-if="width > 1030">
                                    <h5 class="font-size-11 mb-1 text-dark">{{(document.encoder.name != undefined) ? document.encoder.name : document.encoder }}</h5>
                                    <p class="font-size-11 text-muted mb-0">{{document.created_at}}</p>
                                </td>
                                <td class="text-right" v-if="roles.includes('Regional Director')">
                                    <button @click="action('route',document)" v-if="document.is_status == 0" type="button" class="btn btn-sm btn-primary w-xs waves-effect waves-light">Tag</button>
                                    <button @click="action('view',document)" v-else type="button" class="btn btn-sm btn-primary w-xs waves-effect waves-light">View</button>
                                </td>
                                <td class="text-right" v-else>
                                    <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Tag Employee" class="mr-3 text-success" @click="action('route',document)"><i class='bx bxs-purchase-tag' ></i></a>
                                    <a data-toggle="tooltip" data-placement="top" title="" data-original-title="View Document" class="mr-3 text-info" @click="action('view',document)"><i class='bx bx-show'></i></a>
                                    <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Document" class="mr-3 text-warning" @click="action('edit',document)"><i class='bx bx-edit-alt' ></i></a>
                                    <a class="text-danger"><i class='bx bx-trash'></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade exampleModal" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <document-create @status="message" :type="type"  :types="types" :actions="actions" ref="create"></document-create>
    </div>

    <div class="modal fade exampleModal" id="route" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <document-route @status="message" ref="route"></document-route>
    </div>

    <div class="modal fade exampleModal" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <document-view @status="message" ref="view"></document-view>
    </div>
  
</div>
</template>

<script>
export default {
    props: ['actions','types','profile'],
    data(){
        return {
            currentUrl: window.location.origin,
            windowHeight: window.innerHeight,
            windowWidth: window.innerWidth,
            errors: [],
            pagination: {},
            keyword: '',
            documents : [],
            type2: '',
            type: 1,
            status: '',
            completed: '',
            roles: {}
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
        // this.fetchType();
        // this.fetchAction();
        this.roles = this.profile.roles.map(function(a) {return a.name;});
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

        fetchType() {
            axios.get(this.currentUrl + '/request/dropdowns/Document Type/-')
            .then(response => {
                this.types = response.data.data;
            })
            .catch(err => console.log(err));
        },

        fetchAction() {
            axios.get(this.currentUrl + '/request/dropdowns/Document Action/-')
            .then(response => {
                this.actions = response.data.data;
            })
            .catch(err => console.log(err));
        },

        fetch(page_url) {
            let vm = this; let key; let t; let s; let c;
            (this.keyword != '' && this.keyword != null) ? key = this.keyword : key = '-';
            (this.type2 != '' && this.type2 != null) ? t = this.type2 : t = '-';
            (this.status != '' && this.status != null) ? s = this.status : s = '-';
            (this.completed != '' && this.completed != null) ? c = this.completed : c = '-';
            page_url = page_url || this.currentUrl + '/request/documents/'+this.type+'/'+t+'/'+s+'/'+c+'/'+key+'/'+this.counts;

            axios.get(page_url)
            .then(response => {
                this.documents = response.data.data;
                vm.makePagination(response.data.meta, response.data.links);
            })
            .catch(err => console.log(err));
        },

        addnew(){
            $("#new").modal('show');
            this.$refs.create.clear();
        },

        action(type,document)
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
                    this.$refs.view.view(document,true);
                break;
            }
           
        },

        updatestatus(document){
            $("#updatestatus").modal('show');
            this.$refs.status.update(document.status,document.id);
            this.editable = true;
        },

        message(val){
            if(val){
                if(this.editable == true){
                    let page_url = '/request/documents/'+this.type+'/-/-/-/-/'+this.counts+'?page=' + this.pagination.current_page;
                    this.fetch(page_url);
                    Vue.$toast.success('<strong>Successfully Updated</strong>', {
                        position: 'bottom-right'
                    });
                }else{
                    this.fetch();
                    Vue.$toast.success('<strong>Successfully Created</strong>', {
                        position: 'bottom-right'
                    });
                }
                $("#new").modal('hide');
                $("#route").modal('hide');
                this.editable = false;
            }
        },

        filter(data,type){
            
            switch(type){
                case 'type':
                    this.type2 = data;
                break;
                case 'status':
                    this.status = data;
                break;
                case 'completed':
                    this.completed = data;
                break;
                case 'doc':
                    this.type = data;
                break;  
            }
            this.fetch();
        },
    }, 
}
$(document).ready(function() {$("body").tooltip({ selector: '[data-toggle=tooltip]' });});
</script>