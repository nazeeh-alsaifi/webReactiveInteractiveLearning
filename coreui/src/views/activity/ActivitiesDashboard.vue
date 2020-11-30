<template>
   <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
        <CCard>
          <CCardBody>
<div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"><h1>Activities :</h1></div>
            <div class="panel-body">
              <div style="display:inline-block">
                        <div v-for="myActivity in myActivities.data" v-bind:key="myActivity.id">  
                             <div>
                              <img
                                  @click="gotoactivity(myActivity.id)"
                                  style="width: 25%; high: 25%; border-radius:12%"
                                  :src="getimage(myActivity.image)"
                                   alt="Profile Image"
                              />
                              </div>
                                <div style="word-wrap: break-word; font-size:150%;">
                                    <b @click="gotoactivity(myActivity.id)"> {{ myActivity.title }} </b>
                                </div>
                                <div style="word-wrap: break-word;" @click="gotoactivity(myActivity.id)">
                                     {{ myActivity.objectives }}
                                </div><hr>
                                </div>
              <pagination :data="myActivities" @pagination-change-page="loadMyActivities"></pagination>
            </div>
            </div>
        </div>
    </div>
          </CCardBody>
        </CCard>
      </transition>
    </CCol>
  </CRow>   
</template>
<script>
import axios from "axios";
export default {
     data: function() {
        return {
            myActivities: [],
        };
    },
     mounted() {
       this.loadMyActivities();
    },
    methods:{
    gotoactivity(activityid){
            this.$router.push({path: `/admin-activities-dashboard/${activityid.toString()}/Activity`});
        },  
    getimage(image) {
      return this.$apiAdress + '/storage/image/'+image;
    },
        loadMyActivities: function(page = 1) {
            axios
                .get(this.$apiAdress +'/api/Employees/getMyActivities?page='+page
                     + '&token='+ localStorage.getItem("api_token"))
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