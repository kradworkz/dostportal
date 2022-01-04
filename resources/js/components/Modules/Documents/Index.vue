<template>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body" :style="{ height: height + 'px' }">
                
                <div class="row mb-3">
                    <div class="col-xl-6 col-sm-6 form-inline">
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
                            <li class="list-inline-item d-none d-sm-inline-block font-size-12">{{pagination.current_page}} - {{(pagination.current_page*pagination.per)}} of {{pagination.total}} </li>
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
                                <div class="dropdown" data-toggle="tooltip" data-placement="top" title="" data-original-title="Filter by type">
                                    <button type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-light" style="margin-right: -5px;"><span class="d-none d-sm-inline-block"> <i class='bx bx-file-find'></i></span></button>                                 
                                    <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="height: auto; overflow-y: auto;">
                                        <a @click="filter('-','type')" class="dropdown-item">All</a>
                                        <a @click="filter(typ.id,'type')" class="dropdown-item" v-for="typ in types" v-bind:key="typ.id">{{typ.name}}</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-inline-item d-non d-sm-inline-block">
                                <div class="dropdown" data-toggle="tooltip" data-placement="top" title="" data-original-title="Filter by completion">
                                    <button type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-light" style="margin-right: -5px;"><span class="d-none d-sm-inline-block"> <i class='bx bxs-file-export'></i></span></button>                                 
                                    <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="height: auto; overflow-y: auto;">
                                        <a @click="filter('-','completed')" class="dropdown-item">All</a>
                                        <a @click="filter(1,'completed')" class="dropdown-item">Completed</a>
                                        <a @click="filter(0,'completed')" class="dropdown-item">Not completed</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-inline-item d-non d-sm-inline-block">
                                <div class="dropdown" data-toggle="tooltip" data-placement="top" title="" data-original-title="Refresh">
                                    <button @click="fetch()" type="button" class="btn btn-light" style="margin-right: -5px;"><span class="d-none d-sm-inline-block"> <i class='bx bx-refresh'></i></span></button>                                 
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
                                <th style="width: 25%;" class="text-center">Routing Slip </th>
                                <th style="width: 64%;"></th>
                                <th style="width: 10%;"></th>
                            </tr>
                        </thead>
                        <tbody v-if="documents.length > 0">
                            <tr v-for="(document,index) in documents" v-bind:key="document.id">
                                <td>
                                    <i v-if="document.action == 0" v-bind:class="[(document.is_completed == 0 ? 'bx bx-lg bxs-info-circle text-danger bx-flashing' : 'bx bx-lg bxs-check-circle text-success')]"  class='' style="font-size: 20px;"></i>
                                    <i v-else v-bind:class="[(document.is_completed == 0 ? 'bx bx-lg bxs-comment-error text-danger bx-flashing' : 'bx bx-lg bxs-comment-check text-success')]"  class='' style="font-size: 20px;"></i>
                                </td>
                                <td class="text-center font-weight-bold font-size-12">{{ document.route_slip }}</td>
                                <td class="text-muted">
                                    <div class="text-truncate">{{ (document.subject.length > 60) ? document.subject.substring(0,60)+".." : document.subject }}</div>
                                </td>
                                <td class="text-right">
                                    <button @click="viewModal(document,index)" type="button" class="btn btn-sm btn-primary w-xs waves-effect waves-light">View</button>
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <td class="text-center text-muted" colspan="4">No results found.</td>
                        </tbody>
                    </table>
                </div> 

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['types'],
        data(){
            return {
                currentUrl: window.location.origin,
                windowHeight: window.innerHeight,
                windowWidth: window.innerWidth,
                pagination: {},
                errors: [],
                documents: [],
                keyword: '',
                type2: '-',
                completed: '-',
            }
        },

        computed : {
            height: function() {
                return this.windowHeight - 140;
            },
            width: function() {
                return this.windowWidth;
            },
            counts: function(){
                return Math.floor((this.height - 125) / 54);
            }
        },

        created(){
            this.fetch();
        },

        methods : {
            filter(data,type){
                switch(type){
                    case 'type':
                        this.type2 = data;
                    break;
                    case 'completed':
                        this.completed = data;
                    break;
                }

                let vm = this; let key;
                (this.keyword != '' && this.keyword != null) ? key = this.keyword : key = '-';
                this.fetch(this.currentUrl + '/request/employee/documents/my/'+this.type2+'/'+this.completed+'/'+key+'/'+this.counts);
            },

            makePagination(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev,
                    per: meta.per_page,
                    total: meta.total
                };
                this.pagination = pagination;
            },

            fetch(page_url) {
                let vm = this; let key; let t; let c;
                (this.keyword != '' && this.keyword != null) ? key = this.keyword : key = '-';
                (this.type2 != '' && this.type2 != null) ? t = this.type2 : t = '-';
                (this.completed != '' && this.completed != null) ? c = this.completed : c = '-';
                page_url = page_url || this.currentUrl + '/request/employee/documents/my/'+t+'/'+c+'/'+key+'/'+this.counts;

                axios.get(page_url)
                .then(response => {
                    this.documents = response.data.data;
                    this.makePagination(response.data.meta, response.data.links);
                })
                .catch(err => console.log(err));
            },


            viewModal(document,index){
                this.$parent.$parent.notification(document);
                if(this.documents[index].action != 1){
                    this.documents[index].is_completed = 1;
                }
            },

        }
    }
$(document).ready(function() {$("body").tooltip({ selector: '[data-toggle=tooltip]' });});
</script>
