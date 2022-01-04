<template>
    <div>   
        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-file" v-bind:class="[(pagination.total != 0 ? 'bx-tada' : '')]"></i>
                <span v-if="pagination.total != 0" class="badge badge-danger badge-pill">{{pagination.total}}</span>
            </button>
            <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right p-0"
                aria-labelledby="page-header-notifications-dropdown">
                <div class="p-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="m-0" key="t-notifications">Document Notifications </h6>
                        </div>
                        <div class="col-auto">
                            <a href="#!" class="small" key="t-view-all"> View All {{'('+pagination.total+')'}}</a>
                        </div>
                    </div>
                </div>
 
                <simplebar style="max-height:40vh;" ref="feed">
                    <ul class="list-group">
                        <li class="list-group-item" v-for="seen in seens" v-bind:key="seen.id" style="width: 100%; cursor: pointer;" @click="view(seen)">
                            <div class="media">
                                <div class="avatar-xs mr-3">
                                    <span class="avatar-title rounded-circle" v-bind:class="[(seen.action == 0 ? 'bg-warning' : 'bg-danger')]">
                                        <i class='bx' v-bind:class="[(seen.action == 0 ? 'bx-show' : 'bxs-comment-dots')]"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    <h5 class="font-size-12 font-weight-bold mb-0">{{seen.route_slip}}</h5>
                                    <p class="font-size-11 text-muted">{{seen.subject}}</p>

                                    <div class="float-right" style="margin-top: -5px;">
                                        <p class="text-muted mb-0 font-size-11"><i class='bx bx-user mr-1'></i></i> {{seen.router}}</p>
                                    </div>
                                    <p class="text-muted mb-0 font-size-11" style="margin-top: -5px;"><i class='bx bx-calendar mr-1'></i>{{seen.created_at}}</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </simplebar>

                <div class="p-2 border-top">
                    <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="javascript:void(0)">
                        <i class="mdi mdi-arrow-right-circle mr-1"></i> <span key="t-view-more">View More..</span> 
                    </a>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import simplebar from 'simplebar-vue';
    export default {
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [],
                pagination: {},
                seens: []
            }
        },
        
        created(){
            this.fetch();
            this.listenForNewEvent();
        },

        methods : {
            makePagination(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev,
                    total: meta.total
                };
                this.pagination = pagination;
            },

            listenForNewEvent(){
                Echo.join('public-channel')
                .listen('TraceEvent', (data) => {
                    this.seens.unshift(data.event);
                    this.pagination.total++;
                });
            },

            fetch(page_url) {
                let vm = this; 
                axios.get(this.currentUrl + '/request/employee/notification/document/seen')
                .then(response => {
                    this.seens = response.data.data;
                    vm.makePagination(response.data.meta, response.data.links);
                })
                .catch(err => console.log(err));
            },

            view(document){
                if(document.action == 0 && document.is_completed == 0){
                    let index = this.seens.findIndex(seen => seen.document_id === document.id);
                    this.seens.splice(index, 1);
                    (this.seens.length > 0) ? this.pagination.total-- : '';
                }
                this.$parent.viewDocument(document.document_id);
            }
        }, components : { simplebar}
    }
</script>
