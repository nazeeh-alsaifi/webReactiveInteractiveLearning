<template>
    <h1>{{myActivities}}</h1>
</template>
<script>
import axios from 'axios'
export default {
     data: function() {
        return {
            myId: {},
            allActivities: [],
            myActivities: [],
        };
    },
     mounted() {
       this.myId = this.$route.params.id;
       this.loadAllActivities();
       this.loadMyActivities();
    },
    methods:{
     loadAllActivities: function() {
            axios
                .get(this.$apiAdress +'/api/Teachers/'+this.myId+'/getAvailableActivities?token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.allActivities = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        loadMyActivities: function() {
            axios
                .get(this.$apiAdress +'/api/Teachers/'+this.myId+'/getMyActivities?token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.myActivities = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
    }    
}
</script>