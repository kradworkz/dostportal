<template>
    <div class="modal-dialog modal-dialog-centered modal" role="document" style="max-width: 650px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Vehicle Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form @submit.prevent="create">
                <div class="modal-body">
                    <div class="row" style="margin-right: 10px; margin-left: 10px;">
                        <div class="col-md-12 customerform" style="margin-top: 15px;">
                            <div class="row">
                                <div class="col-md-6" style="margin-top: -10px;">
                                    <div class="form-group">
                                        <label>Name: <span v-if="errors.name" class="haveerror">({{ errors.name[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="vehicle.name" style="text-transform: capitalize;">
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top: -10px;">
                                    <div class="form-group">
                                        <label>Plate: <span v-if="errors.plate" class="haveerror">({{ errors.plate[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="vehicle.plate" style="text-transform: uppercase;">
                                    </div>
                                </div>
                                 <div class="col-md-12" style="margin-top: -10px;">
                                    <div class="form-group">
                                        <label>Destination: <span v-if="errors.destination" class="haveerror">({{ errors.destination[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="vehicle.destination" style="text-transform: capitalize;">
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top: -10px;">
                                    <div class="form-group">
                                        <label>Driver: <span v-if="errors.user_id" class="haveerror">({{ errors.user_id[0] }})</span></label>
                                        <multiselect 
                                        ref="indi"
                                        v-model="user" 
                                        :options="users" 
                                        :show-labels="false"
                                        track-by="id" 
                                        :allow-empty="false"
                                        id="ajax" @search-change="asyncFind" 
                                        :custom-label="nameWithLang"
                                        placeholder="Select Driver">
                                        </multiselect>
                                    </div>
                                </div>
                                 <div class="col-md-6" style="margin-top: -10px;">
                                    <div class="form-group">
                                        <label>Group: <span v-if="errors.group_id" class="haveerror">({{ errors.group_id[0] }})</span></label>
                                         <multiselect 
                                            v-model="group" 
                                            :options="groups"
                                            :allow-empty="false"
                                            :show-labels="false"
                                            placeholder="Select Group" 
                                            label="acronym" track-by="id">
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
                vehicle: {id: '', name: '', plate: '', destination: ''},
                editable: false,
                group: '',
                groups: [],
                users: [],
                user: ''
            }
        },

        created(){
            this.fetchGroup();
        },

        methods : {
            nameWithLang ({ firstname, lastname }) {
                return `${firstname} ${lastname}`;
            },

            asyncFind(value) {
                if(value != ''){
                    axios.post(this.currentUrl + '/request/admin/employee/search', {
                        word: value,
                    })
                    .then(response => {
                        this.users = response.data.data;
                    })
                    .catch(err => console.log(err));
                }
            },

            fetchGroup() {
                axios.get(this.currentUrl + '/request/admin/groups')
                .then(response => {
                    this.groups = response.data.data;
                })
                .catch(err => console.log(err));
            },

            create(){
                axios.post(this.currentUrl + '/request/admin/vehicle/store', {
                    id: this.vehicle.id,
                    name: this.vehicle.name,
                    destination: this.vehicle.destination,
                    plate: this.vehicle.plate,
                    group_id: this.group.id,
                    user_id: this.user.id,
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

            edit(vehicle,editable){
                this.vehicle = vehicle;
                this.group = vehicle.group;
                this.editable = editable;
            },

            clear(){
                $("#new").modal("hide");
                this.editable = false;
                this.vehicle = {id: '',name: '',destination: '',plate: ''}, 
                this.group = {id: ''},
                this.errors = [];
            },
        }, components: { Multiselect }
    }
</script>