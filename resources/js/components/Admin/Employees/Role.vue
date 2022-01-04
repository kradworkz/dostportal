<template>
    <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Roles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form @submit.prevent="create">
                <div class="modal-body">
                    
                    <div class="row customerform" style="margin-right: 10px; margin-left: 10px;">
                         <div class="col-md-12">
                            <div class="form-group">
                                <label>Roles: <span v-if="errors.role" class="haveerror">({{ errors.role[0] }})</span></label>
                                <multiselect 
                                v-model="role" 
                                :options="roles" 
                                label="name" track-by="id" 
                                :show-labels="false" :allow-empty="false"
                                :multiple="true"
                                placeholder="Select Role">
                                </multiselect>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><span>Update</span></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</template>

<script>;
    import Multiselect from 'vue-multiselect';
    export default {
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [], 
                roles : [],
                role: [],
                id: ''
            }
        },

        methods : {
            fetchRole() {
                axios.get(this.currentUrl + '/request/admin/roles')
                .then(response => {
                    this.roles = response.data.data;
                })
                .catch(err => console.log(err));
            },

            addrole(roles,id){
                this.id = id;
                this.role = roles;
                this.fetchRole();
            },

            create(){
                var result = this.role.map(function(a) {return a.id;});
                axios.post(this.currentUrl + '/request/admin/employee/role', {
                    id: this.id,
                    roles: result
                })
                .then(response => {
                     $("#updateroles").modal('hide');
                     this.text = '';
                     this.id = '';
                     this.role = [];
                    this.$emit('status', true);
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                });
            },
        }, components: { Multiselect }
    }
</script>