<template>
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 v-if="type == 0" class="modal-title" id="exampleModalLabel">Outgoing Document</h5>
                <h5 v-else class="modal-title" id="exampleModalLabel">Incoming Document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form @submit.prevent="create" enctype="multipart/form-data">
                <div class="modal-body">

                
                    
                    <div class="row customerform" style="margin-right: 10px; margin-left: 10px;">
                        
                        <div class="col-md-12 customerform" style="margin-top: 10px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Employee: <span v-if="errors.employees" class="haveerror">({{ errors.employees[0] }})</span></label>
                                        <multiselect 
                                        ref="indi"
                                        v-model="employees" 
                                        :options="users" 
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

                                <div class="col-md-8" style="margin-top: -10px;">
                                    <div class="form-group">
                                        <label>Purpose: <span v-if="errors.purpose" class="haveerror">({{ errors.purpose[0] }})</span></label>
                                        <textarea v-model="travel.purpose" class="form-control" rows="1"></textarea>
                                    </div>
                                </div>
                                 <div class="col-md-4" style="margin-top: -10px;">
                                    <div class="form-group">
                                        <label>Remarks: <span v-if="errors.remarks" class="haveerror">({{ errors.remarks[0] }})</span></label>
                                        <textarea v-model="travel.remarks" class="form-control" rows="1"></textarea>
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-4" style="margin-top: -10px;">
                                    <div class="form-group">
                                        <label>Mode of Travel: <span v-if="errors.company_id" class="haveerror">({{ errors.company_id[0] }})</span></label>
                                        <multiselect 
                                            v-model="travel.mode" 
                                            :options="modes"
                                            :show-labels="false"
                                            label="name" track-by="id" 
                                            :allow-empty="false"
                                            placeholder="Select Mode">
                                        </multiselect>
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-top: -10px;">
                                    <div class="form-group">
                                        <label>Destination: <span v-if="errors.destination" class="haveerror">({{ errors.destination[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="travel.subject">
                                    </div>
                                </div>
                                


                                <div class="col-md-4" style="margin-top: -10px;">
                                    <div class="form-group">
                                        <label>Travel Info: <span v-if="errors.info_id" class="haveerror">({{ errors.info_id[0] }})</span></label>
                                        <multiselect 
                                            v-model="travel.info" 
                                            :options="infos" 
                                            :show-labels="false"
                                            label="name" track-by="id" 
                                            :allow-empty="false"
                                            placeholder="Select Info">
                                        </multiselect>
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-top: -10px;">
                                    <div class="form-group">
                                        <label>Start Date: <span v-if="errors.start_at" class="haveerror">({{ errors.start_at[0] }})</span></label>
                                        <input type="date" class="form-control" v-model="travel.start">
                                    </div>
                                </div>
                                 <div class="col-md-4" style="margin-top: -10px;">
                                    <div class="form-group">
                                        <label>End Date: <span v-if="errors.end_at" class="haveerror">({{ errors.end_at[0] }})</span></label>
                                        <input type="date" class="form-control" v-model="travel.end">
                                    </div>
                                </div>
                                

                                
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><span v-if="editable == true">Update</span><span v-else>Create</span></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';
    export default {
        props : ['modes','infos'],
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [], 
                travel: {
                    destination: '',
                    purpose: '',
                    remarks: '',
                    others: [],
                    status: '',
                    info: '',
                    mode: '',
                    employees: [],
                    start: '',
                    end: '',
                },
                users: [],
                editable: false,

               
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
                        document_id: 1
                    })
                    .then(response => {
                        this.employees = response.data.data;
                    })
                    .catch(err => console.log(err));
                }
            },

            create(){
                var result = this.action.map(function(a) {return a.id;});
                let data = new FormData();
                for (var i = this.attachments.length - 1; i >= 0; i--) {
                    data.append('files[]', this.attachments[i]);
                }
  
                data.append('id', (this.document.id != undefined) ? this.document.id : '');
                data.append('subject', (this.document.subject != undefined) ? this.document.subject : '');
                data.append('keywords', (this.keywords.length == 0) ? '' : JSON.stringify(this.keywords));
                data.append('actions', (this.action.length == 0) ? '' : JSON.stringify(result));
                data.append('remarks', (this.document.remarks != undefined) ? this.document.remarks : '');
                data.append('received', (this.document.received != undefined) ? this.document.received : '');
                data.append('document', (this.document.document != undefined) ? this.document.document : '');
                data.append('type_id', (this.document.type != undefined) ? this.document.type.id : '');
                data.append('sender_id', (this.document.sender != undefined) ? this.document.sender.id : '');
                data.append('company_id', (this.document.company != undefined) ? this.document.company.id : '');
                data.append('editable', this.editable);
                data.append('is_incoming', this.type);
                
                axios.post(this.currentUrl + '/request/document/store', data)
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