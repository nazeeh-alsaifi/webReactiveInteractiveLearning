<template>
  <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
        <CCard>
          <CCardHeader> My Activities: </CCardHeader>
          <CCardBody>
            <CRow>
              <CCol
                sm="12"
                md="6"
                l="4"
                xl="4"
                v-for="activity in myActivities.data"
                :key="activity.id"
              >
                <CCard>
                  <CCardImg
                    variant="top"
                    src="https://via.placeholder.com/640x480"
                  ></CCardImg>
                  <CCardBody
                    @click="gotoactivity(activity.id)"
                    style="cursor: pointer"
                  >
                    <CCardTitle> {{ activity.title }} </CCardTitle>
                    <CCardText> {{ activity.objectives }} </CCardText>
                  </CCardBody>
                </CCard>
              </CCol>
            </CRow>
          </CCardBody>
          <CPagination
            :activePage.sync="page"
            @update:activePage="loadMyActivities"
            align="center"
          />
        </CCard>
      </transition>
    </CCol>
  </CRow>
</template>
<script>
import axios from "axios";
export default {
  data: function () {
    return {
      myActivities: [],
      page: 1,
    };
  },
  mounted() {
    this.loadMyActivities();
  },
  methods: {
    gotoactivity(activityid) {
      this.$router.push({
        path: `/admin-activities-dashboard/${activityid.toString()}/Activity`,
      });
    },
    getimage(image) {
      return this.$apiAdress + "/storage/image/" + image;
    },
    loadMyActivities: function (page = 1) {
      axios
        .get(
          this.$apiAdress +
            "/api/Employees/getMyActivities?page=" +
            page +
            "&token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.myActivities = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>