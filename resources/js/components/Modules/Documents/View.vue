<template>
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-12">
                    <span class="font-size-13 text-muted">&nbsp;&nbsp;# <span class="text-danger font-weight-bold font-size-16">{{document.route_slip}}</span> &nbsp; <span class="badge badge-success font-size-10 ml-2'">{{ (document.is_status) ? 'Routed' : 'Not Routed'}}</span></span>
                    <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close" @click="comment = false">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <span class="float-right mr-3">
                        <!--<button class="btn btn-light btn-sm" type="button">
                            <i class="bx bxs-comment-dots bx-tada align-middle mr-1"></i> Mark as read
                        </button> -->
                        <button class="btn btn-light btn-sm" type="button" @click="show">
                            <i class="bx bxs-comment-dots bx-tada align-middle mr-1"></i> Comments
                        </button>
                    </span>
                 
                </div>
            </div>
            <div class="modal-body" >
            
                <div v-if="comment == false" class="row" style="margin-top: -20px; display:flex;">
                    <div class="col-md-7">
                        <div class="card-body" ref="details">
                            <blockquote class="p-3 border-light border rounded ">
                                <div class="d-flex">
                                    <div class="mr-3">
                                        <i class="bx bxs-quote-alt-left text-info font-size-14"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0"> {{document.subject}}</p>
                                        <footer class="blockquote-footer"><cite title="Source Title">{{ document.remarks}}</cite></footer>
                                    </div>
                                </div>
                                
                            </blockquote>
                            <hr></hr>  
                            <div class="row font-size-12">
                                <div class="col-sm-4">
                                    <h6 class="font-size-12"><i class="bx bx-notepad mr-1 text-primary"></i> Type</h6>
                                    <p class="text-muted mb-0">{{document.type.name}}</p>
                                </div>
                                <div class="col-sm-4">
                                    <h6 class="font-size-12"><i class="bx bxs-user-circle mr-1 text-primary"></i> Sender</h6>
                                    <p class="text-muted mb-0">{{document.sender.name}}</p>
                                </div>
                                <div class="col-sm-4">
                                    <h6 class="font-size-12"><i class="bx bxs-bank mr-1 text-primary"></i>Company</h6>
                                    <p class="text-muted mb-0">{{ document.company.name}}</p>
                                </div>
                            </div>
                            <hr></hr>
                            <div class="row font-size-12">
                                <div class="col-sm-4">
                                    <h6 class="font-size-12"><i class="bx bx-calendar mr-1 text-primary"></i> Document Date</h6>
                                    <p class="text-muted mb-0">{{document.document_at}}</p>
                                </div>
                                <div class="col-sm-4">
                                    <h6 class="font-size-12"><i class="bx bx-calendar-check mr-1 text-primary"></i>Received Date</h6>
                                    <p class="text-muted mb-0">{{ document.received_at}}</p>
                                </div>
                                <div class="col-sm-4">
                                    <h6 class="font-size-12"><i class="bx bx-calendar-plus mr-1 text-primary"></i>Created Date</h6>
                                    <p class="text-muted mb-0">{{ document.created_at}}</p>
                                </div>
                            </div>
                            <hr></hr>
                            <span class="badge badge-primary mr-1"  v-for="keyword in document.keywords">
                                {{ keyword.data }}
                            </span>
                           
                            <div class="row mt-4">
                                <div class="col-xl-6" v-for="attachment in document.attachments" v-bind:key="attachment.id">
                                    <div class="card border mb-2 p-3">
                                        <a @click="download(attachment.id)" class="text-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                        <i class="bx bxs-file-doc"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-10">
                                                <h5 class="font-size-12 mb-0 text-truncate"><a href="#" class="text-dark">{{attachment.name}}</a></h5>
                                                <small>Size : 3.25 MB</small>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="card-body">
                            <div class="chat-leftsidebar-nav">
                                
                                <div class="" >
                                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#home1" role="tab">
                                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                <span class="d-none d-sm-block">Routed to</span> 
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#profile1" role="tab">
                                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                <span class="d-none d-sm-block">Comments</span> 
                                            </a>
                                        </li>
                                    </ul>
                                     <div class="tab-content p-0 text-muted">
                                        <div class="tab-pane active" id="home1" role="tabpanel">
                                            <simplebar  style="max-height: 360px;">
                                                <ul class="list-unstyled chat-list">
                                                    <li v-for="routing in document.routings" v-bind:key="routing.id">
                                                        <a href="#">
                                                            <div class="media">
                                                                <div class="align-self-center mr-3">
                                                                    <i class="mdi mdi-circle font-size-10"></i>
                                                                </div>
                                                                <div class="align-self-center mr-3">
                                                                    <img :src="currentUrl+'/images/avatars/'+routing.avatar" class="rounded-circle avatar-xs" alt="">
                                                                </div>
                                                                
                                                                <div class="media-body overflow-hidden">
                                                                    <h5 class="text-truncate font-size-14 mb-1">{{ routing.name}}</h5>
                                                                    <p class="text-truncate font-size-12 mb-0">
                                                                        <span class="comment-text">{{(routing.comments.length > 0) ? routing.comments[0].text : 'Hey! there I\'m available'}} </span>
                                                                    </p>
                                                                </div>
                                                                <div class="align-self-center avatar-xs mr-3">
                                                                    <div class="avatar-title bg-light rounded-circle font-size-16" v-bind:class="[(routing.completed == 1 ? 'text-success' : 'text-danger')]">
                                                                        <i v-bind:class="[(routing.completed == 1 ? 'bx bxs-check-circle' : 'bx bxs-x-circle')]"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </simplebar>
                                        </div>
                                        <div class="tab-pane" id="profile1" role="tabpanel">
                                            <simplebar style="max-height:360px;" ref="feed">
                                                <div class="search-box mt-3 mb-0">
                                                    <div class="position-relative">
                                                        <input v-on:keyup.enter="store" v-model="text" type="text" class="form-control bg-light border-light rounded" placeholder="Aa...">
                                                        <i class="bx bxs-comment-dots search-icon"></i>
                                                    </div>
                                                </div>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item py-3" v-for="comment in comments" v-bind:key="comment.id">
                                                        <div class="media" style="margin-left: -10px;">
                                                            <div class="avatar-xs mr-4">
                                                                <img :src="currentUrl+'/images/avatars/'+comment.avatar" class="rounded-circle avatar-xs m-1" alt="">
                                                            </div>
                                                            <div class="media-body">
                                                                <h5 class="font-size-14 text-primary">{{comment.name}} <small class="text-muted float-right">{{ (comment.comment != undefined) ? comment.comment.created_at : comment.created_at}}</small></h5>
                                                                <p class="text-muted">{{(comment.comment != undefined) ? comment.comment.text : comment.text }}</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <div class="col-md-12 align-center" style="margin-top: 80px;" v-if="comments.length == 0">
                                                    <center>
                                                    <i class='text-muted bx bx-notepad' style="font-size: 100px;"></i><br>
                                                    <p class="text-muted font-size-11">No comments found</p>
                                                    </center>
                                                </div>
                                            </simplebar>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div v-else class="row" style="margin-top: -20px; min-height: 50vh;">
                    <div class="col-md-12">
                        <div class="card-body">
                            <h5 class="font-size-15"><i class="bx bx-message-dots text-muted align-middle mr-1"></i> Comments :</h5>
                            <simplebar style="max-height:40vh;" ref="feed">
                                <div>
                                    <div class="media py-3" v-for="(comment,index) in comments" v-bind:key="comment.id" v-bind:class="[(index != 0 ? 'border-top' : '')]">
                                        <div class="avatar-xs mr-3">
                                            <img :src="currentUrl+'/images/avatars/'+comment.avatar" class="rounded-circle avatar-xs" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="font-size-14 mb-1">{{comment.name}} <small class="text-muted float-right">{{ (comment.comment != undefined) ? comment.comment.created_at : comment.created_at}}</small></h5>
                                            <p class="text-muted">{{(comment.comment != undefined) ? comment.comment.text : comment.text }}</p>
                                            <div>
                                                <a href="javascript: void(0);" class="text-success"><i class="mdi mdi-reply"></i> Reply</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </simplebar>

                        </div>
                    </div>
                </div>
            </div>

            <div v-if="comment == true" class="modal-footer">
                <div class="col-md-12 app-search d-none d-lg-block" style="margin-top: -10px; margin-bottom: -10px;">
                    <div class="position-relative">
                        <input v-on:keyup.enter="store" v-model="text" type="text" class="text-dark form-control bg-light" placeholder="Aa">
                        <span class="text-dark bx bxs-comment-dots"></span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import simplebar from 'simplebar-vue';
    export default {
        data(){
            return {
                currentUrl: window.location.origin,
                windowHeight: window.innerHeight,
                windowWidth: window.innerWidth,
                errors: [], 
                document: {
                    sender: {},
                    company: {},
                    type: {},
                },
                comment: false,
                comments: [],
                text: '',
                type: 'routing',
                comment_id : ''
            }
        },

        computed : {
            height: function() {
                return this.windowHeight - 140;
            },
            width: function() {
                return this.windowWidth;
            }
        },


        methods : {
            view(document){
                this.document = document;
                this.sortComment(document);
            },

            fetch(id){
                axios.get(this.currentUrl + '/request/document/'+id)
                .then(response => {
                    this.document = response.data.data;
                    this.sortComment(this.document);
                    this.viewed(id);
                })
                .catch(err => console.log(err));
            },

            sortComment(document){
                let com = document.routings.filter(function (e) {return e.comments.length > 0;});
                this.comments = com.sort((a, b) => new Date(a.completed_at) - new Date(b.completed_at))
            },

            store(){
                axios.post(this.currentUrl + '/request/document/comment', {
                    id: (this.type == 'routing') ? this.document.id : this.comment_id,
                    text: this.text,
                    type: this.type
                })
                .then(response => {
                    console.log(response);
                    // this.viewModal(response.data.data);
                    this.comments.unshift(response.data.data);
                    this.clear();
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

            download(id){
                axios.post(this.currentUrl + '/request/document/download', {
                    id: id
                })
                .then(response => {})
                .catch(err => console.log(err));
            },
            
            show(){
                (this.comment == true) ? this.comment = false : this.comment = true;
            },

            viewed(id){
                axios.get(this.currentUrl + '/request/document/view/'+id)
                .then(response => {})
                .catch(err => console.log(err));
            },

            clear(){
                this.text = '';
            },

            viewModal(document){
                this.$parent.$parent.notification(document);
            }

        }, components : { simplebar}
    }
</script>