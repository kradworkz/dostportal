<template>
    <div class="modal-dialog modal-dialog-centered modal" role="document" style="max-width: 650px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">group Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form @submit.prevent="create">
                <div class="modal-body">
                    <div class="row" style="margin-right: 10px; margin-left: 10px;">
                        <div class="col-md-12 customerform" style="margin-top: 15px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name: <span v-if="errors.name" class="haveerror">({{ errors.name[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="group.name" style="text-transform: capitalize;">
                                    </div>
                                </div>
                                
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Acronym: <span v-if="errors.acronym" class="haveerror">({{ errors.acronym[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="group.acronym" style="text-transform: capitalize;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Type: <span v-if="errors.type" class="haveerror">({{ errors.type[0] }})</span></label>
                                         <multiselect 
                                            v-model="group.type" 
                                            :options="types"
                                            :allow-empty="false"
                                            :show-labels="false"
                                            placeholder="Select Type">
                                        </multiselect>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';
    export default {
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [], 
                group: {id: '', name: '', acronym: '', type: ''},
                editable: false,
                type: {id: ''},
                types: ['Regional Office','Provincial S&T Center'],
            }
        },

        created(){
            this.fetchGroup();
        },

        methods : {
            fetchGroup() {
                axios.get(this.currentUrl + '/request/admin/groups')
                .then(response => {
                    this.groups = response.data.data;
                })
                .catch(err => console.log(err));
            },

            create(){
                axios.post(this.currentUrl + '/request/admin/group/store', {
                    id: this.group.id,
                    name: this.group.name,
                    acronym: this.group.acronym,
                    type: this.group.type,
                    editable: this.editable
                })
                .then(response => {
                    this.clear();
                    this.$emit('status', true);
                    Vue.$toast.success('<strong>Successfully Created</strong>', {
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

            edit(group,editable){
                this.group = group;
                this.editable = editable;
            },

            clear(){
                $("#new").modal("hide");
                this.editable = false;
                this.group = {id: '',name: '',acronym: '',type: ''}, 
                this.group = {id: ''},
                this.errors = [];
            },
        }, components: { Multiselect }
    }
</script>