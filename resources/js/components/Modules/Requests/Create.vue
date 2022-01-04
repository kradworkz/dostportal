<template>
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Request Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form @submit.prevent="create" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row customerform" style="margin-right: 10px; margin-left: 10px;">
                        <div class="col-md-12 customerform" style="margin-top: 10px;">
                            <div class="row">
                           
                                
    {{locations}}
                                
                                
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
    export default {
        props: ['types'],
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [], 
                req: {
                    purpose: '',
                    footage: '',
                    incident: '',
                    location: '',
                    equipment: '',
                    personnel: '',

                },
                editable: false,
            }
        },

        methods : {
            create(){

            }
        }
    }
</script>
