<template>
   <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
        <CCard>
          <CCardBody>
<div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"><h1>Class Activities :</h1></div>
            <div class="panel-body">
                <table style="table-layout:fixed" class="table table-striped">
                    <thead >
                    <tr>
                       <th></th>
                       <th></th>
                       <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(myActivity, index) in myActivities.data" v-bind:key="myActivity.id"> 
                            <td>
                            <div v-if="index %3===0"> 
                             <div>
                              <img
                                  style="width: 100%; high: 100%; border-radius:12%"
                                  :src="getempty()"
                                   alt="Profile Image"
                              />
                              </div>
                                <div style="word-wrap: break-word; font-size:150%;">
                                    <b> {{ myActivity.title }} </b>
                                </div>
                                <div style="word-wrap: break-word;">
                                     {{ myActivity.objectives }}
                                </div>
                                </div>
                            </td>
                            <td>
                            <div v-if="index %3===1"> 
                            <div>
                              <img
                                  style="width: 100%; high: 100%; border-radius:12%"
                                  :src="getempty()"
                                   alt="Profile Image"
                              />
                              </div>
                                <div style="word-wrap: break-word; font-size:150%;">
                                    <b> {{ myActivity.title }} </b>
                                </div>
                                <div style="word-wrap: break-word;">
                                     {{ myActivity.objectives }}
                                </div>
                                </div>
                            </td>
                            <td>
                            <div v-if="index %3===2">     
                            <div>
                              <img
                                  style="width: 100%; high: 100%; border-radius:12%"
                                  :src="getempty()"
                                   alt="Profile Image"
                              />
                              </div>
                                <div style="word-wrap: break-word; font-size:150%;">
                                    <b> {{ myActivity.title }} </b>
                                </div>
                                <div style="word-wrap: break-word;">
                                     {{ myActivity.objectives }}
                                </div>
                                </div>
                            </td>
                        </tr>
                        <hr />
                    </tbody>
                </table>
              <pagination :data="institutions_key_classes" @pagination-change-page="institutions_key_classes"></pagination>
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
            myId: {},
            myActivities: [],
        };
    },
     mounted() {
       this.myId = this.$route.params.id;
       this.loadMyActivities();
    },
    methods:{
    getempty() {
      return this.$apiAdress + "/storage/image/420975_heroa_1544885894_1603884485_1605874019.jpg";
    },
        loadMyActivities: function() {
            axios
                .get(this.$apiAdress +'/api/student/'+this.myId+'/getMyActivities?token='+ localStorage.getItem("api_token"))
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