<template>
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Staff Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form @submit.prevent="create">
                <div class="modal-body">
                    
                    <div class="row customerform" style="margin-right: 10px; margin-left: 10px;">
                        
                        <div class="col-md-3" style="margin-top: 20px;">
                            <myUpload field="img" @crop-success="cropSuccess" v-model="photo.show" :width="500" :height="500" :params="params" :headers="headers" lang-type="en" img-format="png">
                            </myUpload>
                            <div @click="toggleShow" class="fuzone" style="width: 225px; height: 210px;">
                                <div v-if="photo.url != ''">
                                    <img :src="photo.url" style="width: 200px; height: 200x;">
                                </div>
                                <div v-else class="fu-text" @click="toggleShow">
                                    <span><i class="fa fa-picture"></i> Click here to upload<br> <span
                                            v-if="errors.avatar"
                                            style="color: red; font-size: 12px; margin-top: -20px;">
                                            ({{ errors.avatar[0] }})</span></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 customerform" style="margin-top: 20px;">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Lastname: <span v-if="errors.lastname" class="haveerror">({{ errors.lastname[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="user.lastname" style="text-transform: capitalize;">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Firstname: <span v-if="errors.firstname" class="haveerror">({{ errors.firstname[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="user.firstname" style="text-transform: capitalize;">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Initial: <span v-if="errors.middlename" class="haveerror">({{ errors.middlename[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="user.middlename" style="text-transform: capitalize;">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Extension: <span v-if="errors.extension" class="haveerror">({{ errors.extension[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="user.extension" style="text-transform: capitalize;">
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-top: -7px;">
                                    <div class="form-group">
                                        <label>Email: <span v-if="errors.email" class="haveerror">({{ errors.email[0] }})</span></label>
                                        <input type="email" class="form-control" v-model="user.email" style="text-transform: lowercase;">
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-top: -7px;">
                                    <div class="form-group">
                                        <label>Mobile No.: <span v-if="errors.mobile_no" class="haveerror">({{ errors.mobile_no[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="user.mobile_no">
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-top: -7px;">
                                    <div class="form-group">
                                        <label>Birthdate: <span v-if="errors.birthday" class="haveerror">({{ errors.birthday[0] }})</span></label>
                                        <input type="date" class="form-control" v-model="user.birthday">
                                    </div>
                                </div>

                                <div class="col-md-6" style="margin-top: -10px;">
                                    <div class="row" style="margin-top: 20px;">
                                        <div class="col-md-4">
                                            <div class="custom-control custom-radio mb-3">
                                                <input type="radio" id="customRadio1" class="custom-control-input" checked="checked" value="Male" v-model="user.gender">
                                                <label class="custom-control-label" for="customRadio1">Male</label>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="custom-control custom-radio mb-3">
                                                <input type="radio" id="customRadio2" class="custom-control-input" checked="checked" value="Female" v-model="user.gender">
                                                <label class="custom-control-label" for="customRadio2">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <hr></hr>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Position: <span v-if="errors.position_id" class="haveerror">({{ errors.position_id[0] }})</span></label>
                                         <multiselect 
                                        v-model="user.position" 
                                        :options="positions" 
                                        id="ajax" @search-change="asyncFind" 
                                        label="name" track-by="id" :show-labels="false" :allow-empty="false"
                                        placeholder="Search Position">
                                        </multiselect>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status: <span v-if="errors.status_id" class="haveerror">({{ errors.status_id[0] }})</span></label>
                                        <multiselect 
                                        v-model="user.status" 
                                        :options="statuses" 
                                        :show-labels="false"
                                        label="name" track-by="id" 
                                        :allow-empty="false"
                                        placeholder="Select Status">
                                        </multiselect>
                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-top: -8px; margin-bottom: 10px;">
                                    <div class="form-group">
                                        <label>Department: <span v-if="errors.department_id" class="haveerror">({{ errors.department_id[0] }})</span></label>
                                        <multiselect 
                                        v-model="user.department" 
                                        :options="departments" 
                                        :show-labels="false"
                                        label="name" track-by="id" 
                                        :allow-empty="false"
                                        placeholder="Select Department">
                                        </multiselect>
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
    import myUpload from 'vue-image-crop-upload/upload-2.vue';
    export default {
        props : ['type'],
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [], 
                user: {
                    id: '',
                    email: '',
                    firstname: '',
                    lastname: '',
                    middlename: '',
                    type: '',
                    extension: '', 
                    gender: '', 
                    mobile_no: '',
                    birthday: '',
                    avatar: '', 
                    position:{id:''},
                    department: {id:''}, 
                    status: {id: ''}
                },
                photo: {show: false,url: '',signature: ''},
                params: {token: '123456798',name: 'avatar'},
                headers: {smail: '*_~'},
                editable: false,
                positions: [],
                departments: [],
                statuses: []
            }
        },
        
        created(){
            this.fetchDepartment();
            this.fetchStatuses();
        },

        methods : {
            asyncFind(value) {
                axios.post(this.currentUrl + '/request/admin/position/search', {
                    word: value,
                })
                .then(response => {
                    this.positions = response.data.data;
                })
                .catch(err => console.log(err));
            },

            fetchDepartment() {
                axios.get(this.currentUrl + '/request/dropdowns/Group/Department')
                .then(response => {
                    this.departments = response.data.data;
                })
                .catch(err => console.log(err));
            },

            fetchStatuses() {
                axios.get(this.currentUrl + '/request/dropdowns/Group/Employment Status')
                .then(response => {
                    this.statuses = response.data.data;
                })
                .catch(err => console.log(err));
            },

            create(){
                
                axios.post(this.currentUrl + '/request/admin/employee/store', {
                    id: this.user.id,
                    firstname: this.user.firstname,
                    lastname: this.user.lastname,
                    middlename: this.user.middlename,
                    extension: this.user.extension,
                    email: this.user.email,
                    birthday: this.user.birthday,
                    gender: this.user.gender,
                    mobile_no: this.user.mobile_no,
                    position_id: (this.user.position != undefined) ? this.user.position.id : '',
                    department_id: (this.user.department != undefined) ? this.user.department.id : '',
                    status_id: (this.user.status != undefined) ? this.user.status.id : '',
                    img: this.photo.url,
                    editable: this.editable
                })
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

            edit(user,editable){
                this.user = user;
                this.editable = editable;
            },

            clear(){
                this.editable = false;
                $("#new").modal("hide");
                this.empty();
            },

            empty(){
                this.user = {};
            },

            toggleShow() {
                this.photo.show = !this.photo.show;
            },

            cropSuccess(imgDataUrl, field) {
                this.photo.url = imgDataUrl;
            }

        }, components: { Multiselect, myUpload }
    }
</script>