<template>
<div class="d-xl-flex">                
    <div class="w-100">
        <div class="card">
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
                        <ul class="list-inline user-chat-nav text-right mb-0 dropdown">
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
                        </ul>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered table-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 2%;"></th>
                                <th>Name / Email</th>
                                <th class="text-center">Position</th>
                                <th class="text-center">Contant Information</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="user in users" v-bind:key="user.id">
                                <td>
                                    <div class="avatar-xs" v-if="user.avatar == 'n/a'">
                                        <span class="avatar-title rounded-circle">{{user.lastname.charAt(0)}}</span>
                                    </div>
                                    <div v-else>
                                        <img class="rounded-circle avatar-xs" :src="currentUrl+'/images/avatars/'+user.avatar" alt="">
                                    </div>
                                </td>
                                <td>
                                    <h5 class="font-size-13 mb-1 text-dark">{{user.lastname}}, {{user.firstname}} {{user.middlename}}.</h5>
                                    <p class="font-size-12 text-muted mb-0">{{user.department.name}}</p>
                                </td>
                                <td class="text-center">
                                    <h5 class="font-size-12 mb-1 text-dark">{{user.position.name}}</h5>
                                    <p class="font-size-12 text-muted mb-0 ">{{user.status.name}}</p>
                                </td>
                                <td class="text-center">
                                    <h5 class="font-size-12 mb-1 text-dark">{{user.email}}</h5>
                                    <p class="font-size-12 text-muted mb-0">{{user.mobile_no}}</p>
                                </td>
                                <td class="text-center">
                                    <span v-if="user.user_status == 'Active'" class="badge badge-success font-size-11">Active</span>
                                    <span v-else-if="user.user_status == 'Inactive'" class="badge badge-secondary font-size-11">Inactive</span>
                                    <span v-else-if="user.user_status == 'Disabled'" class="badge badge-dark font-size-11">Disabled</span>
                                    <span v-else class="badge badge-danger font-size-11">Retired</span>
                                </td>
                                <td class="text-center">
                                    <a class="mr-3 " @click="updatestatus(user)">
                                    <i v-bind:class="{'text-danger bx bxs-lock': user.user_status == 'Active','text-success bx bx-lock-open': user.user_status == 'Inactive','text-dark bx bx-block': user.user_status == 'Disabled'}"></i></a>
                                    <a @click="roles(user.roles,user.id)" class="mr-3 text-info"><i class='bx bxs-user-detail'></i></a>
                                    <a @click="groups(user.groups,user.id)" class="mr-3 text-info"><i class='bx bx-building-house'></i></a>
                                    <a class="mr-3 text-warning" @click="edit(user)"><i class='bx bx-edit-alt' ></i></a>
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
        <admin-employee-create @status="message" :type="user_type" ref="create"></admin-employee-create>
    </div>

    <div class="modal fade exampleModal" id="updatestatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <admin-employee-status @status="message" ref="status"></admin-employee-status>
    </div>

    <div class="modal fade exampleModal" id="updateroles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <admin-employee-roles @status="message" ref="roles"></admin-employee-roles>
    </div>

    <div class="modal fade exampleModal" id="updategroups" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <admin-employee-groups @status="message" ref="groups"></admin-employee-groups>
    </div>
  
  
  
  
</div>
</template>

<script>
export default {
    props : ['user_type'],
    data(){
        return {
            currentUrl: window.location.origin,
            errors: [],
            pagination: {},
            keyword: '',
            users : [],
        }
    },

    created(){
        this.fetch();
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
            let vm = this; let key;
            (this.keyword != '' && this.keyword != null) ? key = this.keyword : key = '-';
            page_url = page_url || this.currentUrl + '/request/admin/employees/'+key;

            axios.get(page_url)
            .then(response => {
                this.users = response.data.data;
                vm.makePagination(response.data.meta, response.data.links);
            })
            .catch(err => console.log(err));
        },

        addnew(){
            $("#new").modal('show');
            this.$refs.create.clear();
        },

        edit(user){
            this.editable = true;
            $("#new").modal('show');
            this.$refs.create.edit(user,true);
        },

        updatestatus(user){
            $("#updatestatus").modal('show');
            this.$refs.status.update(user.status,user.id);
            this.editable = true;
        },

        roles(roles,user){
            this.editable = true;
            $("#updateroles").modal('show');
            this.$refs.roles.addrole(roles,user);
        },

        groups(groups,user){
            this.editable = true;
            $("#updategroups").modal('show');
            this.$refs.groups.addgroup(groups,user);
        },

        message(val){
            if(val){
                if(this.editable == true){
                    let page_url = '/request/admin/employees/-?page=' + this.pagination.current_page;
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
                this.editable = false;
            }
        }
    }, 
}
</script>