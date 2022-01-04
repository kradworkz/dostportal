<template>
    <div>
        <management-home  v-if="show == 0" ref="wew"></management-home>
        <documents-admin @status="message"  :actions="docactions" :types="doctypes" :profile="profile" v-else-if="show == 1"></documents-admin>
        <travels-admin :modes="trvlmodes" :statuses="trvlstatuses" :profile="profile" v-else-if="show == 2"></travels-admin>
    </div>
</template>

<script>
    export default {
        props: ['trvlmodes','trvlstatuses', 'profile','docactions','doctypes'],
        data(){
            return {
                currentUrl: window.location.origin,
                show : 0,
                types: [],
            }
        },

        methods : {
            showUpdate(show){
                this.show = show;
            },

            message(val){
                this.fetch();
            }
        }
    }
</script>
