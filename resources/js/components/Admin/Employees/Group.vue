<template>
    <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form @submit.prevent="create">
                <div class="modal-body">
                    
                    <div class="row customerform" style="margin-right: 10px; margin-left: 10px;">
                         <div class="col-md-12">
                            <div class="form-group">
                                <label>Groups: <span v-if="errors.group" class="haveerror">({{ errors.group[0] }})</span></label>
                                <multiselect 
                                v-model="group" 
                                :options="groups" 
                                label="name" track-by="id" 
                                :show-labels="false" :allow-empty="false"
                                :multiple="true"
                                placeholder="Select Group">
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
                groups : [],
                group: [],
                id: ''
            }
        },

        methods : {
            fetchGroup() {
                axios.get(this.currentUrl + '/request/admin/groups')
                .then(response => {
                    this.groups = response.data.data;
                })
                .catch(err => console.log(err));
            },

            addgroup(groups,id){
                this.id = id;
                this.group = groups;
                this.fetchGroup();
            },

            create(){
                var result = this.group.map(function(a) {return a.id;});
                axios.post(this.currentUrl + '/request/admin/employee/group', {
                    id: this.id,
                    groups: result
                })
                .then(response => {
                     $("#updategroups").modal('hide');
                     this.id = '';
                     this.group = [];
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