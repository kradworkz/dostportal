<template>
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="width: 600px;">
        <div class="modal-content">
            <form @submit.prevent="create" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Choose Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    
                    <div class="row justify-content-center mt-4">
                        <div class="col-xl-12 mb-3">
                            <p class="text-muted text-center">Please choose a Travel type</p>
                        </div>
                        <div class="col-xl-5">
                            <label class="card-radio-label mb-3">
                                <input type="radio" v-model="is_vehicle" value="1" class="card-radio-input" v-on:change="radio">
                                <div class="card-radio">
                                    <i class="bx bxs-car font-size-24 text-primary align-middle mr-2"></i>
                                    <span>Vehicle Reservation</span>
                                </div>
                            </label>
                        </div>
                        <div class="col-xl-5">
                            <label class="card-radio-label mb-3">
                                <input type="radio" v-model="is_vehicle" value="0" class="card-radio-input" v-on:change="radio">
                                <div class="card-radio">
                                    <i class="bx bx-trip font-size-24 text-primary align-middle mr-2"></i>

                                    <span>Travel Order</span>
                                </div>
                            </label>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <multiselect 
                                    v-model="mode" 
                                    :options="modes"
                                    :show-labels="false"
                                    label="name" track-by="id" 
                                    :allow-empty="false"
                                    :disabled="disable"
                                    placeholder="Select Mode">
                                </multiselect>
                            </div>
                        </div>
                        <div class="col-xl-12 mt-2 mb-4">
                            <div class="text-center mt-2">
                                <button @click="proceed" type="button" class="btn btn-success w-lg">Proceed</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';
    export default {
        props: ['modes','profile'],
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [],
                mode: '',
                is_vehicle: 1,
                disable: true,
                v: ''
            }
        },

        created(){
            this.mode = this.modes[0];
        },

        methods : {

            radio(event){
                var optionText = event.target.value;
                if(optionText == 0){ 
                    this.disable = false;
                    this.mode = '';
                }else{
                    this.disable = true;
                }
            },

            proceed(){
                if(this.mode == ''){
                     Vue.$toast.error('<strong>Please choose a mode</strong>', {
                        position: 'bottom-right'
                    });
                }else{
                    var data = {
                        "is_vehicle" : this.is_vehicle,
                        "mode" : this.mode
                    };
                    this.$emit('ch', data);
                }
            }
        }, components : { Multiselect }
    }
</script>
