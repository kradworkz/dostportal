<template>
    <div>   
        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-directions" v-bind:class="[(seens.length != 0 ? 'bx-tada' : '')]"></i>
                <span v-if="seens.length != 0" class="badge badge-danger badge-pill">{{seens.length}}</span>
            </button>
            <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right p-0"
                aria-labelledby="page-header-notifications-dropdown">
                <div class="p-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="m-0" key="t-notifications"> Travel Notifications </h6>
                        </div>
                        <div class="col-auto">
                            <a href="#!" class="small" key="t-view-all"> View All {{'('+seens.length+')'}}</a>
                        </div>
                    </div>
                </div>
 
                <simplebar style="max-height:40vh;" ref="feed">
                    <ul class="list-group">
                        <li class="list-group-item" v-for="(seen,index) in seens" v-bind:key="index" style="width: 100%; cursor: pointer;" @click="view(seen,seen.type)">
                            <div class="media">
                                <div class="avatar-xs mr-3">
                                    <span class="avatar-title rounded-circle" v-if="seen.type == 'tagged'">
                                        <i class="bx bxs-purchase-tag-alt"></i>
                                    </span>
                                    <span :class="'avatar-title rounded-circle bg-'+seen.status.color" v-else-if="seen.type == 'statuses'">
                                        <i class="bx bx-detail"></i>
                                    </span>
                                    <span class="avatar-title rounded-circle bg-dark" v-else-if="seen.type == 'new'">
                                        <i class="bx bxs-folder-plus"></i>
                                    </span>
                                    <span class="avatar-title rounded-circle bg-warning" v-else="seen.type == 'comment'">
                                        <i class="bx bxs-comment-dots"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                
                                    <div class="float-right" style="margin-top: 5px;">
                                        <p class="mb-0 font-size-10" style="margin-top: -5px;"><i class='bx bx-calendar mr-1'></i>{{seen.created_at}}</p>
                                    </div>
                                    <h5 class="font-size-12 font-weight-bold mb-0">{{seen.code}}</h5>
                                    <p class="font-size-11 mt-2 mb-0"><span class="text-info font-weight-bold">{{seen.user}}</span> <span class="text-muted">{{ seen.action }}</span></p>
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
        props: ['profile'],
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [],
                pagination: {},
                seens: [],
                roles: [],
            }
        },
        
        created(){
            this.fetch();
            this.listenForNewEvent();
            this.roles = this.profile.roles.map(function(a) {return a.name;});
    
        },

        methods : {
            listenForNewEvent(){
                Echo.join('public-channel')
                .listen('TravelEvent', (data) => {
                    let user =  this.profile.id;
                    var exists = data.event.users.some(function(field){
                        return field.user_id === user;
                    });
                    if(data.event.type != "new"){
                        if(data.event.type == "comments"){
                            if(data.event.comment_by != user){
                                if(this.roles.includes('Regional Director')){
                                    data.event.action = data.event.action2;
                                    this.seens.unshift(data.event);
                                }else{
                                    (exists) ? this.seens.unshift(data.event) : '';
                                }
                            }
                        }else{
                            (exists) ? this.seens.unshift(data.event) : '';
                        }
                    }else{
                        (this.roles.includes('Regional Director')) ? this.seens.unshift(data.event) : '';
                    }
                });
            },

            fetch(page_url) {
                axios.get(this.currentUrl + '/request/employee/notification/travel/seen')
                .then(response => {
                    this.seens = [...response.data.new,...response.data.tagged,...response.data.comments,...response.data.statuses];
                    this.seens.sort(function(a,b){
                        return new Date(b.created_at) - new Date(a.created_at);
                    });
                })
                .catch(err => console.log(err));
            },

            view(travel,type){
                let index = this.seens.findIndex(seen => seen.id === travel.id);
                this.seens.splice(index, 1);
                this.check(travel,type);
                this.$parent.viewTravel(travel.id);
            },

            check(travel,type){
                let id;
                if(type == "comments"){
                    id = travel.comment_id;
                }else if(type == "statuses"){
                    id = travel.status_id;
                }else{
                    id = travel.id;
                }

                axios.get(this.currentUrl + '/request/travel/view/'+id+'/'+type)
                .then(response => {})
                .catch(err => console.log(err));
            }
        }, components : { simplebar}
    }
</script>
