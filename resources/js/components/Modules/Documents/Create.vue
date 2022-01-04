<template>
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
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
                        
                        <div class="col-md-12 customerform" style="margin-top: 20px;">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Subject: <span v-if="errors.subject" class="haveerror">({{ errors.subject[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="document.subject">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Type: <span v-if="errors.type_id" class="haveerror">({{ errors.type_id[0] }})</span></label>
                                        <multiselect 
                                            v-model="document.type" 
                                            :options="types" 
                                            :show-labels="false"
                                            label="name" track-by="id" 
                                            :allow-empty="false"
                                            placeholder="Select Type">
                                        </multiselect>
                                    </div>
                                </div>

                                <div class="col-md-4" style="margin-top: -7px;">
                                    <div class="form-group">
                                        <label>Document Date: <span v-if="errors.document" class="haveerror">({{ errors.document[0] }})</span></label>
                                        <input type="date" class="form-control" v-model="document.document">
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-top: -7px;">
                                    <div class="form-group">
                                        <label>Sent Date: <span v-if="errors.received" class="haveerror">({{ errors.received[0] }})</span></label>
                                        <input type="date" class="form-control" v-model="document.received">
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-top: -7px;">
                                    <div class="form-group">
                                        <label>Remarks: <span v-if="errors.remarks" class="haveerror">({{ errors.remarks[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="document.remarks" style="text-transform: capitalize;">
                                    </div>
                                </div>

                                <div class="col-md-4" style="margin-top: -7px;">
                                    <div class="form-group">
                                        <label>Addressee: <span v-if="errors.sender_id" class="haveerror">({{ errors.sender_id[0] }})</span></label>
                                        <multiselect 
                                            v-model="document.sender" 
                                            :options="senders" 
                                            :show-labels="false"
                                            id="sender" @search-change="asyncListing"  
                                            label="name" track-by="id" 
                                            :allow-empty="false"
                                            tag-placeholder="Add this as new addressee" 
                                            :taggable="true" @tag="addListing"
                                            placeholder="Search or add addressee">
                                        </multiselect>
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-top: -7px;">
                                    <div class="form-group">
                                        <label>Company: <span v-if="errors.company_id" class="haveerror">({{ errors.company_id[0] }})</span></label>
                                        <multiselect 
                                            v-model="document.company" 
                                            :options="companies"
                                            id="company" @search-change="asyncListing"  
                                            :show-labels="false"
                                            label="name" track-by="id" 
                                            :allow-empty="false"
                                            tag-placeholder="Add this as new company" 
                                            :taggable="true" @tag="addListing"
                                            placeholder="Search or add company">
                                        </multiselect>
                                    </div>
                                </div>

                                <div class="col-md-4" style="margin-top: 10px;">
                                 <input class="mt-2 mb-4" multiple type="file" @change="uploadFieldChange"><span v-if="errors['files.'+0]" class="haveerror">(required)</span>
                                </div>

                                 <div class="col-md-12" style="margin-top: -7px;">
                                    <div class="form-group">
                                       <label>Action Needed: <span v-if="errors.actions" class="haveerror">({{ errors.actions[0] }})</span></label>
                                        <multiselect 
                                            v-model="action" 
                                            :options="actions" 
                                            :show-labels="false"
                                            label="name" track-by="id" 
                                            :allow-empty="false"
                                            :multiple="true"
                                            placeholder="Select Action">
                                        </multiselect>
                                    </div>
                                </div>
                                
                                <div class="col-md-12" style="margin-top: -7px;">
                                    <div class="form-group">
                                        <label>Keywords: <span v-if="errors.keywords" class="haveerror">({{ errors.keywords[0] }})</span></label>
                                        <multiselect 
                                            ref="ky"
                                            v-model="keywords" 
                                            :options="options"
                                            id="keywords"
                                            :show-labels="false" 
                                            :allow-empty="false"
                                            :multiple="true"
                                            label="data" track-by="data"
                                            tag-placeholder="press enter to separate" 
                                            :taggable="true" @tag="addKeywords"
                                            placeholder="Add keywords">
                                        </multiselect>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <hr></hr>
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
        props : ['type','types','actions'],
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [], 
                document: {
                    id: '',
                    subject: '',
                    remarks: '',
                    document: '',
                    received: '',
                    is_incoming: '', 
                    sender: {id:''},
                    company: {id:''},
                    type: {id:''},
                },
                editable: false,
                attachments: [],
                companies: [],
                senders: [],
                keywords: [],
                options: [],
                action:[]
            }
        },

        methods : {
          
            asyncListing(value,type) {
                axios.post(this.currentUrl + '/request/common/listing/search', {
                    word: value,
                    type: type
                })
                .then(response => {
                    (type == 'company') ? this.companies = response.data.data : this.senders = response.data.data;
                })
                .catch(err => console.log(err));
            },

          
            addListing(data,type) {
                axios.post(this.currentUrl + '/request/common/listing/store', {
                    name: data,
                    type: type
                })
                .then(response => {
                    if(type == 'company'){
                        this.companies.push(response.data.data);
                        this.document.company = response.data.data;
                    }else{
                        this.document.sender = response.data.data;
                        this.senders.push(response.data.data);
                    }
                })
                .catch(err => console.log(err)); 
            },

            addKeywords(data) {
                const tag = {
                    data: data
                };
                this.keywords.push(tag);
                this.$refs.ky.$el.focus();
            },
             
            uploadFieldChange(e) {
                e.preventDefault();
                var files = e.target.files || e.dataTransfer.files;

                if (!files.length)
                    return;
                for (var i = files.length - 1; i >= 0; i--) {
                    this.attachments.push(files[i]);
                }
            },

            create(){
                var result = this.action.map(function(a) {return a.id;});
                let data = new FormData();
                if(this.attachments.length > 0){
                    for (var i = this.attachments.length - 1; i >= 0; i--) {
                        data.append('files[]', this.attachments[i]);
                    }
                }else{
                    if(this.editable == false){
                        data.append('files[]', []);
                    }
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
                this.action = [];
                this.document = document;
                this.keywords = document.keywords;
                this.editable = editable;
                var ac = JSON.parse(document.actions);
                for (var i=0, iLen=ac.length; i<iLen; i++) {
                    var index = this.actions.findIndex(x => x.id === ac[i]);
                    this.action.push(this.actions[i]);
                }
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