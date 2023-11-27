<template>
  <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
        <CCard>
          <CCardBody>
            <div class="container">
              <div class="panel panel-default">
                <div class="panel-heading"><h1>{{myActivity.title}}</h1></div>
                <hr>
                <div class="panel-body"></div>
                <div style="background-color:#3D2C60; color:#ffffff;"><b style="margin-left:20px; font-size:120%;">Objectives:</b><br><h6 style="margin-left:20px;"> {{myActivity.objectives}} </h6></div>
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
      myActivity: [],
    };
  },
  mounted() {
    this.myId = this.$route.params.activityid;
    this.loadMyActivity();
  },
  methods: {
    loadMyActivity: function() {
      axios
        .get(
          this.$apiAdress +
            "/api/student/" +
            this.myId +
            "/getMyActivity?token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.myActivity = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
  },
};
</script>
