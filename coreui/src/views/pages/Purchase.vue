<template>
<div>
  <h1>This is purchase page!</h1>
  <h1>{{items}}</h1>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  data: () => {
    return {
      items: [],   
    }
  },

  mounted: function(){
    this.getAcademic();
  },

  methods: {
    getAcademic (){
      this.items = this.$apiAdress +'/api/AcademicLevel';
      // let self = this;
       axios.get( this.$apiAdress +'/api/Academiclevel')
       .then(function (response) {
         this.items = response.data;
       }).catch(function (error) {
         console.log(error);
       });
    }
 }
}
</script>

<style>

</style>