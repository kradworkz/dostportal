<template>
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="min-width: 65vw;">
        <div class="modal-content">
            <form @submit.prevent="create" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <span class="text-muted font-size-12" v-if="info.startStr != info.endStr"> {{ moment(info.start,'date') }} - {{ moment(info.end,'date') }}</span>
                        <span class="text-muted font-size-12" v-else> {{ moment(info.start,'date') }} , {{ moment(info.start,'time') }} - {{ moment(info.end,'time') }}</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <div class="row customerform" style="margin-right: 10px; margin-left: 10px;">
                        
                        <div class="col-md-12 customerform" data-simplebar="init" style="margin-top: 10px;" :style="{ height: (height-150) + 'px' }">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Employee: <span v-if="errors.employees" class="haveerror">({{ errors.employees[0] }})</span></label>
                                        <multiselect 
                                        ref="indi"
                                        v-model="travel.employees" 
                                        :options="users" 
                                        :show-labels="false"
                                        track-by="id" 
                                        :allow-empty="false"
                                        :multiple="true"
                                        id="ajax" @search-change="asyncFind" 
                                        :custom-label="nameWithLang"
                                        placeholder="Select Individually">
                                        </multiselect>
                                    </div>
                                </div>

                                <div class="col-md-12" style="margin-top: -7px;">
                                    <div class="form-group">
                                        <label>Purpose: <span v-if="errors.purpose" class="haveerror">({{ errors.purpose[0] }})</span></label>
                                        <textarea v-model="travel.purpose" class="form-control" rows="1"></textarea>
                                    </div>
                                </div>
                                
                                <!--<div class="col-md-3">
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
                                </div>-->
                                
                                <div class="col-md-12" style="margin-top: -7px;">
                                    <div class="form-group">
                                        <label>Destination: <span v-if="errors.destination" class="haveerror">({{ errors.destination[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="travel.destination">
                                    </div>
                                </div>
                                
                                <div class="col-md-6" style="margin-top: -7px;">
                                    <div class="form-group">
                                        <label>Others: <span v-if="errors.others" class="haveerror">({{ errors.others[0] }})</span></label>
                                        <multiselect 
                                            ref="ky"
                                            v-model="others" 
                                            :options="options"
                                            id="keywords"
                                            :show-labels="false" 
                                            :allow-empty="false"
                                            :multiple="true"
                                            label="data" track-by="data"
                                            tag-placeholder="press enter to separate" 
                                            :taggable="true" @tag="addOthers"
                                            placeholder="Add keywords">
                                        </multiselect>
                                    </div>
                                </div>

                                <div class="col-md-6" style="margin-top: -7px;">
                                    <div class="form-group">
                                        <label>Remarks: <span v-if="errors.remarks" class="haveerror">({{ errors.remarks[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="travel.remarks">
                                    </div>
                                </div>
                            </div>

                            <div class="row" v-if="traveltype == 0">
                                <div class="col-md-12">
                                    <blockquote class="p-3 border-light border rounded ">
                                        <div class="float-right">
                                            <select v-model="travel.fund" class="custom-select custom-select-sm ml-2" style="width: 200px;">
                                                <option value="" selected disabled>Select Funds</option>
                                                <option value="General Funds">General Funds</option>
                                                <option value="Project Funds">Project Funds</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                        <h6 class="font-size-12 card-title text-danger mb-2 mt-2">Travel Expenses</h6>
                                        <div class="row">
                                        <div class="col-md-12"><hr></hr></div>
                                            <div class="col-xl-4">
                                                <h5 class="font-size-14 text-primary"> Actual</h5>
                                            </div>

                                            <div class="col-xl-4">
                                                <div class="custom-control custom-checkbox custom-checkbox-primary">
                                                    <input id="a1" type="checkbox" class="custom-control-input" v-model="travel.a1" value="1">
                                                    <label class="custom-control-label" for="a1">Accommodation</label>
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="custom-control custom-checkbox custom-checkbox-primary">
                                                    <input id="a2" type="checkbox" class="custom-control-input" v-model="travel.a2" value="1">
                                                    <label class="custom-control-label" for="a2">Meals/Food</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12"><hr></hr></div>

                                            <div class="col-xl-4">
                                                <div>
                                                    <h5 class="font-size-14 text-primary pull-right">Per Diem</h5>
                                                </div>
                                            </div>

                                            <div class="col-xl-4">
                                                <div class="custom-control custom-checkbox custom-checkbox-primary mb-4">
                                                    <input id="p1" type="checkbox" class="custom-control-input" v-model="travel.p1" value="1">
                                                    <label class="custom-control-label" for="p1">Accommodation</label>
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="custom-control custom-checkbox custom-checkbox-primary mb-4">
                                                    <input id="p2" type="checkbox" class="custom-control-input" v-model="travel.p2" value="1">
                                                    <label class="custom-control-label" for="p2">Incidental Expenses</label>
                                                </div>
                                            </div>
                                        </div>
                                    </blockquote>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><span>Create</span></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    import Multiselect from 'vue-multiselect';
    export default {
        props: ['traveltype','modetype'],
        data(){
            return {
                currentUrl: window.location.origin,
                windowHeight: window.innerHeight,
                errors: [],
                info: {},
                travel: {
                    destination: '',
                    purpose: '',
                    remarks: '',
                    others: '',
                    status: '',
                    info: '',
                    mode: '',
                    employees: [],
                    start: '',
                    end: '',
                    type: '',
                    vehicle: '',
                    fund: '',
                    a1: false,
                    a2: false,
                    p1: false,
                    p2: false,
                },
                users: [],
                modes: [],
                types: [{'id': 0, 'name' : "Travel Order"} , {'id': 1, 'name' : "Vehicle Registration"} ],
                is_vehicle: '',
                options: [],
                others: []
            }
        },

        computed : {
            height: function() {
                return this.windowHeight - 140;
            }
        },


        methods : {
            set(info){
                this.info = info;
            },

            addOthers(data) {
                const tag = {
                    data: data
                };
                this.others.push(tag);
                this.$refs.ky.$el.focus();
            },

            create(){
                var result = this.travel.employees.map(function(a) {return a.id;});
                let data = new FormData(); let check;
                // for (var i = this.attachments.length - 1; i >= 0; i--) {
                //     data.append('files[]', this.attachments[i]);
                // }

                if(this.traveltype != 1){ // if not vehicle w/ funds
                    if(this.travel.fund == ''){
                        if(this.travel.a1 == false && this.travel.a2 == false){
                            check = false;
                        }
                        if(this.travel.p1 == false && this.travel.p2 == false){
                            check = false;
                        }
                    }else{
                        check = true;
                    }
                }else{
                    check = true;
                }

                data.append('id', (this.travel.id != undefined) ? this.travel.id : '');
                data.append('purpose', (this.travel.purpose != undefined) ? this.travel.purpose : '');
                data.append('others', (this.others.length  == 0) ? '' : JSON.stringify(this.others));
                data.append('remarks', (this.travel.remarks != undefined) ? this.travel.remarks : '');
                data.append('destination', (this.travel.destination != undefined) ? this.travel.destination : '');
                data.append('mode_id', this.modetype);
                data.append('status_id', 60);
                data.append('start_at', (this.info != undefined) ? this.moment(this.info.start,'wew') : '');
                data.append('end_at', (this.info != undefined) ? this.moment(this.info.end,'wew') : '');
                (this.modetype == 57) ? data.append('vehicle_id', (this.info != undefined) ? this.info.resource.id : '') : '';
                data.append('editable', this.editable);
                data.append('is_vehicle', this.traveltype);
                data.append('employees', (result.length > 0) ? JSON.stringify(result) : '');
                (this.traveltype != 1) ? data.append('fund', this.travel.fund) : '';
                (this.traveltype != 1) ? data.append('a1', this.travel.a1) : '';
                (this.traveltype != 1) ? data.append('a2', this.travel.a2) : '';
                (this.traveltype != 1) ? data.append('p1', this.travel.p1) : '';
                (this.traveltype != 1) ? data.append('p2', this.travel.p2) : '';
                
                if(check){
                    axios.post(this.currentUrl + '/request/travel/store', data)
                    .then(response => {
                        this.$emit('status', response.data.data);
                        $("#newEvent").modal("hide");
                        Vue.$toast.success('<strong>Successfully Updated</strong>', {
                            position: 'bottom-right'
                        });
                    })
                    .catch(error => {
                        if (error.response.status == 422) {
                            this.errors = error.response.data.errors;
                        }
                    });
                }else{
                    Vue.$toast.success('<strong>Please choose a fund</strong>', {
                        position: 'bottom-right'
                    });
                }

            },

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

            moment: function(date,type)
            {
                let dte;
                if(type == 'time'){
                    dte = moment(date).format('h:mma');
                }else if(type == 'date'){
                    dte = moment(date).format('MMMM D YYYY');
                }else{
                    dte = moment(date).format('YYYY-MM-DD HH:mm:ss');
                }
                return dte;
            },
        }, components : { moment,Multiselect }
    }
</script>
