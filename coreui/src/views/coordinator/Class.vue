<template>
    <h1>{{myId}}</h1>
</template>
<script>
export default {
     data: function() {
        return {
          institutions_key_classes: [],
            subjects:[],
            teachers:[],
            mysubject:{},
            searchtext: "",
            column: "id",
            errors: [],
            sort_field: "id",
            sort_direction: "desc",  
            myId: {},
        };
    },
      mounted() {
            this.myId = this.$route.params.id;
      }
}
</script>