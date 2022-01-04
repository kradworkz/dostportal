<template>
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Route Document <span class="text-info"> : "{{ document.route_slip }}"</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form @submit.prevent="create">
                <div class="modal-body">
                    <div class="row customerform" style="margin-right: 10px; margin-left: 10px;">
                        <div class="col-md-12 customerform" style="margin-top: 20px;">
                            <div class="row">

                                <!--<div class="col-md-12" style="margin-top: 1px; margin-bottom: 20px;" v-if="option != ''">
                                    <div class="alert alert-info alert-dismissible fade show mb-0" role="alert">
                                        <i class='bx bx-info-circle mr-2'></i>
                                        <span v-if="option == 'All Employees'">All Employee of DOST-IX will be tag.</span>
                                        <span v-if="option == 'By Group'">All selected Groups will be tag.</span>
                                        <span v-if="option == 'Individually'">Only selected employee will be tag.</span>
                                    </div>
                                </div> -->
                         
                                <div class="col-md-12" style="margin-top: -8px; margin-bottom: 10px;">
                                    <div class="form-group">
                                        <label>Route Mode: <span v-if="errors.option" class="haveerror">({{ errors.option[0] }})</span></label>
                                        <multiselect 
                                        v-model="option"
                                        :options="options" 
                                        :show-labels="false"
                                        :allow-empty="false"
                                        @input="onChange(option)"
                                        placeholder="Select Mode">
                                        </multiselect>
                                    </div>
                                </div>

                                <div class="col-md-12" style="margin-top: -8px; margin-bottom: 10px;" v-if="option == 'By Group'">
                                    <div class="form-group">
                                        <label>Groups: <span v-if="errors.groups" class="haveerror">({{ errors.groups[0] }})</span></label>
                                        <multiselect 
                                        v-model="group" 
                                        :options="groups" 
                                        :show-labels="false"
                                        label="name" track-by="id" 
                                        :allow-empty="false"
                                        :multiple="true"
                                        placeholder="Select Group">
                                        </multiselect>
                                    </div>
                                </div>

                                <div class="col-md-12" style="margin-top: -8px; margin-bottom: 10px;" v-if="option == 'Individually'">
                                    <div class="form-group">
                                        <label>Individuals: <span v-if="errors.individuals" class="haveerror">({{ errors.individuals[0] }})</span></label>
                                        <multiselect 
                                        ref="indi"
                                        v-model="individuals" 
                                        :options="employees" 
                                        :show-labels="false"
                                        track-by="id" 
                                        :allow-empty="false"
                                        @input="haha"
                                        :multiple="true"
                                        id="ajax" @search-change="asyncFind" 
                                        :custom-label="nameWithLang"
                                        placeholder="Select Individually">
                                        </multiselect>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Route</button>
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
                groups: [],
                group: [],
                document: {},
                options: ['All Employees','By Group','Individually'],
                option: '',
                individuals: [],
                employees: [],
                actions: [],
                action: []
            }
        },

        methods : {
            nameWithLang ({ firstname, lastname }) {
                return `${firstname} ${lastname}`;
            },

            asyncFind(value) {
                if(value != ''){
                    axios.post(this.currentUrl + '/request/admin/employee/search', {
                        word: value,
                        document_id: this.document.id
                    })
                    .then(response => {
                        this.employees = response.data.data;
                    })
                    .catch(err => console.log(err));
                }
            },

            haha(){
                this.employees = [];
                this.$refs.indi.$el.focus();
            },
            
            route(data){
                this.fetchGroup();
                this.document = data;
            },

            fetchGroup() {
                axios.get(this.currentUrl + '/request/dropdowns/Group/-')
                .then(response => {
                    this.groups = response.data.data;
                })
                .catch(err => console.log(err));
            },

            onChange(data){
                this.group = [];
                this.individuals = [];
            },

            create(){
                let data = new FormData();
                
          
                data.append('id', (this.document.id != undefined) ? this.document.id : '');
                data.append('option', this.option);

                switch(this.option){
                    case 'By Group':
                        var result = this.group.map(function(a) {return a.id;});
                        data.append('groups', (this.group.length > 0) ? JSON.stringify(result) : '');
                    break;
                    case 'Individually':
                        var result = this.individuals.map(function(a) {return a.id;});
                        data.append('individuals', (this.individuals.length > 0) ? JSON.stringify(result) : '');
                    break;
                }
                
                axios.post(this.currentUrl + '/request/document/route', data)
                .then(response => {
                    this.clear();
                    this.$emit('status', true);
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                });
            },

            edit(document,editable){
                this.document = document;
                this.keywords = document.keywords;
                this.editable = editable;
            },

            clear(){
                this.editable = false;
                $("#new").modal("hide");
                this.empty();
            },

            empty(){
                this.document = {};
            }

        }, components: { Multiselect }
    }
</script>