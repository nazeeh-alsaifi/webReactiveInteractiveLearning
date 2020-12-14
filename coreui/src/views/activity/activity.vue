<template>
  <!-- <CRow>
      
    </CRow> -->
  <CContainer>
    <CJumbotron
      style="background-color: #321fdb; color: #ffffff; max-height: 200px"
    >
      <h1>{{ myActivity.title }}</h1>
      <p class="lead">Learning Objective:</p>
      <p>{{ myActivity.objectives }}</p>
      <!-- <CButton @click="test" color="primary" class="mb-2"> test</CButton> -->
    </CJumbotron>
    <CRow v-for="(section, index) in myActivity.sections" :key="index">
      <CCol col="12" xl="12">
        <transition name="slide">
          <CCard>
            <CCardHeader @click="collapse = !collapse">
              <CIcon v-bind:name="getIcon" />
              {{ section.title }}
            </CCardHeader>
            <CCollapse v-show="collapse">
              <CCardBody>
                <CRow
                  v-for="(component, innerIndex) in section.components"
                  :key="innerIndex"
                >
                  <CCol col="12" xl="12">
                    <CCard>
                      <CCardBody>
                        {{ component.Component_name }}
                        <ActivityComponent
                          v-bind:name="component.Component_name"
                          v-bind:options="JSON.parse(component.pivot.options)"
                          v-bind:sectionComponentId="component.pivot.id"
                        ></ActivityComponent>
                      </CCardBody>
                    </CCard>
                  </CCol>
                </CRow>
              </CCardBody>
            </CCollapse>
          </CCard>
        </transition>
      </CCol>
    </CRow>
  </CContainer>
</template>
<script>
import axios from "axios";
import ActivityComponent from "@/views/activity/ActivityComponent";

export default {
  components: {
    ActivityComponent,
  },
  data: function () {
    return {
      myId: {},
      myActivity: {},
      collapse: false,
    };
  },
  mounted() {
    this.myId = this.$route.params.AdminActivity;
    this.loadMyActivity();
    // this.fillCollapse();
  },
  computed: {
    getIcon() {
      return this.collapse ? "cil-caret-bottom" : "cil-caret-right";
    },
    // fillCollapse() {
    //   for (var i = 0; i < this.myActivity.sections.length; i++) {
    //     this.collapse.push(false);
    //   }
    // },
  },
  methods: {
    test() {
      console.log("sections:", this.myActivity.sections);
      console.log("collapse:", this.collapse);
      console.log("sections length:", this.myActivity.sections.length);
    },
    // fillCollapse() {
    //   if (this.myActivity.sections.length != 0) {
    //     for (var i = 0; i < this.myActivity.sections.length; i++) {
    //       this.collapse.push(false);
    //     }
    //   }
    // },
    loadMyActivity: function () {
      axios
        .get(
          this.$apiAdress +
            "/api/Employees/" +
            this.myId +
            "/getMyActivity?token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          console.log(response);
          this.myActivity = response.data.activity;
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    // isExpanded(key) {
    //   return this.collapse[key] == true;
    // },
    // toggleExpansion(key) {
    //   if (this.isExpanded(key))
    //     this.expandedGroup.splice(this.expandedGroup.indexOf(key), 1);
    //   else this.expandedGroup.push(key);
    // },
  },
};
</script>
<style scoped>
.jumbotron {
  margin-bottom: 0;
}
.card {
  margin-bottom: 0;
}
.card-header {
  font-size: 1;
  font-weight: 900 !important;
}
</style>
