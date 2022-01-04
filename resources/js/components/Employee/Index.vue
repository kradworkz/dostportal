<template>
    <div>
        <employee-home v-if="show == 0" :profile="profile" ref="wew"></employee-home>
        <documents-index @status="message"  :types="types"  v-else-if="show == 1"></documents-index>
        <travels-index :modes="trvlmodes" :statuses="trvlstatuses" :profile="profile" :types="types" v-else-if="show == 2"></travels-index>
        <requests-index :types="reqtypes" :locations="locations" :profile="profile" v-else></requests-index>
    </div>
</template>

<script>
    export default {
        props: ['profile','trvlmodes','trvlstatuses','types','reqtypes','locations'],
        data(){
            return {
                currentUrl: window.location.origin,
                show : 0,
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

