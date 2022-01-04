/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import VueToast from 'vue-toast-notification';
Vue.use(VueToast);
import VueMoment from 'vue-moment'
 
Vue.use(VueMoment)
import Vue from 'vue';
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/********************************************************************************************************
 * Components for Admin module  | Components for admin module  | Components for admin module 
 ********************************************************************************************************/

Vue.component('admin-index', require('./components/Admin/Index/Index.vue').default);
Vue.component('admin-dropdown', require('./components/Admin/Dropdowns/Index.vue').default);
Vue.component('admin-position', require('./components/Admin/Positions/Index.vue').default);
Vue.component('admin-position-create', require('./components/Admin/Positions/Create.vue').default);
Vue.component('admin-employee', require('./components/Admin/Employees/Index.vue').default);
Vue.component('admin-employee-create', require('./components/Admin/Employees/Create.vue').default);
Vue.component('admin-employee-status', require('./components/Admin/Employees/Create.vue').default);
Vue.component('admin-employee-roles', require('./components/Admin/Employees/Role.vue').default);
Vue.component('admin-employee-groups', require('./components/Admin/Employees/Group.vue').default);
Vue.component('admin-group', require('./components/Admin/Groups/Index.vue').default);
Vue.component('admin-group-create', require('./components/Admin/Groups/Create.vue').default);
Vue.component('admin-vehicle', require('./components/Admin/Vehicles/Index.vue').default);
Vue.component('admin-vehicle-create', require('./components/Admin/Vehicles/Create.vue').default);
Vue.component('admin-role', require('./components/Admin/Roles/Index.vue').default);
Vue.component('admin-role-create', require('./components/Admin/Roles/Create.vue').default);
////////////////////
////////////////////

// Vue.component('trace-document', require('./components/Module_Trace/Document/Index.vue').default);
// Vue.component('trace-document-create', require('./components/Module_Trace/Document/Create.vue').default);
// Vue.component('trace-document-route', require('./components/Module_Trace/Document/Route.vue').default);
// Vue.component('trace-document-view', require('./components/Module_Trace/Document/View.vue').default);


/********************************************************************************************************
 * Components for documents module  | Components for employee module  | Components for employee module 
 ********************************************************************************************************/
Vue.component('employee', require('./components/Employee/Index.vue').default);
Vue.component('employee-home', require('./components/Employee/Home.vue').default);
Vue.component('employee-side', require('./components/Employee/Side.vue').default);
Vue.component('employee-notifications-d', require('./components/Employee/Notification-Document.vue').default);
Vue.component('employee-notifications-t', require('./components/Employee/Notification-Travel.vue').default);

/********************************************************************************************************
 * Components for management module  | Components for  management module  | Components for management module 
 ********************************************************************************************************/
Vue.component('management', require('./components/Management/Index.vue').default);
Vue.component('management-home', require('./components/Management/Home.vue').default);



// Vue.component('management', require('./components/Management/Index.vue').default);
// Vue.component('management-home', require('./components/Management/Home/Index.vue').default);
// Vue.component('management-documents', require('./components/Management/Documents/Index.vue').default);
// Vue.component('management-document-lists', require('./components/Management/Documents/Documents.vue').default);
// Vue.component('management-travels', require('./components/Management/Travels/Index.vue').default);
// Vue.component('management-requests', require('./components/Management/Requests/Index.vue').default);


/********************************************************************************************************
 * Components for documents module  | Components for documents module  | Components for documents module 
 ********************************************************************************************************/
Vue.component('documents-admin', require('./components/Modules/Documents/Admin.vue').default);
Vue.component('documents-index', require('./components/Modules/Documents/Index.vue').default);
Vue.component('document-create', require('./components/Modules/Documents/Create.vue').default);
Vue.component('document-view', require('./components/Modules/Documents/View.vue').default);
Vue.component('document-route', require('./components/Modules/Documents/Route.vue').default);


/********************************************************************************************************
 * Components for travels module  | Components for travels module  | Components for travels module 
 ********************************************************************************************************/
Vue.component('travels-admin', require('./components/Modules/Travels/Admin.vue').default);
Vue.component('travels-index', require('./components/Modules/Travels/Index.vue').default);
Vue.component('travel-create', require('./components/Modules/Travels/Create.vue').default);
Vue.component('travel-view', require('./components/Modules/Travels/View.vue').default);
Vue.component('travel-calendar', require('./components/Modules/Travels/Calendar/Index.vue').default);
Vue.component('travel-calendar-travel', require('./components/Modules/Travels/Calendar/Travel-calendar.vue').default);
Vue.component('travel-calendar-create', require('./components/Modules/Travels/Calendar/Create.vue').default);
Vue.component('travel-calendar-choose', require('./components/Modules/Travels/Calendar/Choose.vue').default);

/********************************************************************************************************
 * Components for travels module  | Components for travels module  | Components for travels module 
 ********************************************************************************************************/
Vue.component('requests-index', require('./components/Modules/Requests/Index.vue').default);
Vue.component('request-create', require('./components/Modules/Requests/Create.vue').default);
Vue.component('request-view', require('./components/Modules/Requests/View.vue').default);

const app = new Vue({
    el: '#app',
    data(){
        return {
            currentUrl: window.location.origin,
            profile : {},
            counts: []
        }
    },

    created(){
        // this.getUser();
        this.getCount();
    },

    methods :{
        show(num,type){
            if(type == 'e'){
                this.$refs.showe.showUpdate(num);
            }else{
                this.$refs.showm.showUpdate(num);
            }
            if(num == 0){
                $("#eside").css("display", "block");
            }else{
                $("#eside").css("display", "none");
            }
        },

        viewDocument(id){
            this.$refs.viewDocument.fetch(id);
            $("#viewDocument").modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
        },

        viewTravel(id){
            this.$refs.viewTravel.fetch(id);
            $("#viewTravel").modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
        },

        message(val){
            if(val){
                if(this.editable == true){
                    let page_url = '/request/documents/'+this.type+'/-/-/-/-?page=' + this.pagination.current_page;
                    this.fetch(page_url);
                    Vue.$toast.success('<strong>Successfully Updated</strong>', {
                        position: 'bottom-right'
                    });
                }else{
                    this.fetch();
                    Vue.$toast.success('<strong>Successfully Created</strong>', {
                        position: 'bottom-right'
                    });
                }
                $("#new").modal('hide');
                $("#route").modal('hide');
                this.editable = false;
            }
        },

        notification(document){
            this.$refs.notification.view(document);
        },

        count(type,count){ // count user documents, travels and requests 
        switch(type){
            case 1: 
                $(".documentcount").text(count+' documents');
            break;
            case 2: 
                $(".travelcount").text(count+' travels');
            break;
            case 3:
                $(".requestcount").text(count+' requests');
            break;
            case 4:
                $(".docpendingcount").text(count+' requests');
            break;
            case 4:
                $(".incomingcount").text(count+' requests');
            break;
            case 6:
                $(".outcomingcount").text(count+' requests');
            break;
        }
           
        },

        getCount(){
            axios.get(this.currentUrl + '/request/counts')
            .then(response => {
                this.count = response.data;
                $(".documentcount").text(this.count.document+' pending documents');
                $(".travelcount").text(this.count.travel+' pending travels');
                $("#profile-avatar").attr("src",this.currentUrl+'/images/avatars/'+this.profile.avatar);
            })
            .catch(err => console.log(err));          
        },

        getUser(){
            axios.get(this.currentUrl + '/request/profile')
            .then(response => {
                this.profile = response.data.data;
                $("#name").text(this.profile.profile.name);
                $("#username").text(this.profile.username);
                $("#profile-avatar").attr("src",this.currentUrl+'/images/avatars/'+this.profile.avatar);
            })
            .catch(err => console.log(err));          
        }
    }
});
