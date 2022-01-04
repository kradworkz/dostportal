<template>
    <div class="modal-dialog modal-dialog-centered modal" role="document" style="max-width: 650px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Position Information</h5>
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
                                        <input type="text" class="form-control" v-model="position.name" style="text-transform: capitalize;">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Code: <span v-if="errors.code" class="haveerror">({{ errors.code[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="position.code" style="text-transform: uppercase;">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label>Salary Grade: <span v-if="errors.salary" class="haveerror">({{ errors.salary[0] }})</span></label>
                                         <multiselect 
                                            v-model="position.salary" 
                                            :options="salaries"
                                            :allow-empty="false"
                                            :show-labels="false"
                                            placeholder="Select Salary" 
                                            label="name" track-by="id"
                                            :custom-label="nameWithLang"
                                            >
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
                position: {id: '',name: '',code: '', salary: { id : ''}},
                editable: false,
                salaries: []
            }
        },

        created(){
            this.fetchSalary();
        },

        methods : {
            nameWithLang ({ name, others }) {
                return `Salary Grade ${name}  (₱ ${this.formatPrice(others)})`;
            },

            formatPrice(value) {
                let val = (value/1).toFixed(2).replace(',', '.')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            },

            fetchSalary() {
                axios.get(this.currentUrl + '/request/dropdowns/Salary/-')
                .then(response => {
                    this.salaries = response.data.data;
                })
                .catch(err => console.log(err));
            },

            create(){
                axios.post(this.currentUrl + '/request/admin/position/store', {
                    id: this.position.id,
                    name: this.position.name,
                    code: this.position.code,
                    salary_id: this.position.salary.id,
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

            edit(position,editable){
                this.position = position;
                this.editable = editable;
            },

            clear(){
                $("#new").modal("hide");
                this.editable = false;
                this.position = {id: '',name: '',code: '',salary: {id: ''}}, 
                this.errors = [];
            },
        }, components: { Multiselect }
    }
</script>