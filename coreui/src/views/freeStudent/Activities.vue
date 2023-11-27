<template>
  <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
        <CCard>
          <CCardHeader> Class Activities: </CCardHeader>
          <CCardBody>
            <div class="container">
              <div class="row">
                <div class="col-lg-3 mb-4">
                  <h4 class="mt-4">Activities Filters:</h4>
                  <div class="form-check">
                    <CInputCheckbox
                      label="Is Free"
                      name="selectIsFree"
                      v-on:change="IsFree()"
                      :checked="is_free"
                    />
                  </div>
                  <h6 style="color: red" class="mt-2">
                    SubSubjects:
                  </h6>
                  <div class="form-check">
                    <CInputCheckbox
                      v-for="SubSubject in SubSubjects"
                      :key="SubSubject.id"
                      :label="SubSubject.sub_subject_name"
                      name="selectSubSubjects"
                      v-on:change="subsubjectchange(SubSubject.id)"
                      :checked="fixedsubsubject[SubSubject.id]"
                    />
                  </div>

                  <h6 style="color: red" class="mt-2">
                    InstructionalCycle_Locations:
                  </h6>
                  <div class="form-check">
                    <CInputCheckbox
                      v-for="Location in Locations"
                      :key="Location.id"
                      :label="Location.Location_Instructional_Cycle"
                      name="selectLocations"
                      v-on:change="locationschange(Location.id)"
                      :checked="fixedlocation[Location.id]"
                    />
                  </div>
                  <h6 style="color: red" class="mt-2">
                    Levels Of Scaffolding:
                  </h6>
                  <div class="form-check">
                    <CInputCheckbox
                      v-for="LevelOfScaffolding in LevelsOfScaffolding"
                      :key="LevelOfScaffolding.id"
                      :label="LevelOfScaffolding.Level_Name"
                      name="selectLevelsOfScaffolding"
                      v-on:change="Levelschange(LevelOfScaffolding.id)"
                      :checked="fixedLevels[LevelOfScaffolding.id]"
                    />
                  </div>
                  <h6 style="color: red" class="mt-2">
                    InstructionalPurposes:
                  </h6>
                  <div class="form-check">
                    <CInputCheckbox
                      v-for="InstructionalPurpose in InstructionalPurposes"
                      :key="InstructionalPurpose.id"
                      :label="InstructionalPurpose.Instructional_Purpose"
                      name="selectInstructionalPurposes"
                      v-on:change="
                        InstructionalPurposeschange(InstructionalPurpose.id)
                      "
                      :checked="fixedInstructional[InstructionalPurpose.id]"
                    />
                  </div>
                </div>
                <div class="col-lg-9">
                  <div>
                    <input
                      type="search"
                      v-model="searchtext"
                      placeholder="search activity"
                    />
                    <button
                      style="margin-left: 8px"
                      v-on:click="ClearSearch()"
                      class="btn btn-primary"
                    >
                      Clear
                    </button>
                  </div>
                  <div class="row mt-4">
                    <div
                      class="col-lg-4 col-md-6 mb-4"
                      v-for="myActivity in myActivities.data"
                      v-bind:key="myActivity.id"
                    >
                      <div class="card h-100">
                        <div
                          style="
                            background-color: blue;
                            color: white;
                            font-size: 70%;
                            width: 15%;
                          "
                          v-if="myActivity.is_free"
                        >
                          free
                        </div>
                        <a href="#">
                          <img
                            class="card-img-top"
                            @click="gotoactivity(myActivity.id)"
                            :src="getimage(myActivity.image)"
                            alt="Profile Image"
                          />
                        </a>
                        <div class="card-body">
                          <h4 class="card-title">
                            <a
                              style="color: blue"
                              @click="gotoactivity(myActivity.id)"
                            >
                              {{ myActivity.title }}
                            </a>
                          </h4>
                          <p class="card-text">{{ myActivity.objectives }}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <pagination
                    :data="myActivities"
                    @pagination-change-page="loadMyActivities"
                  ></pagination>
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
      myActivities: {},
      SubSubjects: [],
      LevelsOfScaffolding: [],
      Locations: [],
      InstructionalPurposes: [],
      fixedsubsubject: [],
      fixedlocation: [],
      fixedLevels: [],
      fixedInstructional: [],
      searchtext: "",
      is_free: false,
      selected: {
        LocationFilter: [],
        LevelFilter: [],
        InstructionalFilter: [],
        SubSubjectsFilter: [],
      },
    };
  },
  mounted() {
    this.loadMyActivities();
    this.loadSubSubjects();
    this.loadLevelsOfScaffolding();
    this.LoadLocations();
    this.LoadInstructionalPurposes();
  },
  watch: {
    searchtext() {
      this.loadMyActivities();
    },
    is_free() {
      this.loadMyActivities();
    },
  },
  methods: {
    ClearSearch() {
      this.searchtext = "";
      this.fixedsubsubject = [];
      this.fixedlocation = [];
      this.fixedLevels = [];
      this.fixedInstructional = [];
      this.is_free = false;
      this.selected = {
        LocationFilter: [],
        LevelFilter: [],
        InstructionalFilter: [],
        SubSubjectsFilter: [],
      };
      this.loadMyActivities();
    },
    IsFree() {
      if (this.is_free) {
        this.is_free = false;
      } else {
        this.is_free = true;
      }
    },
    subsubjectchange(id) {
      let exist = false;
      for (let i = 0; i < this.selected.SubSubjectsFilter.length; i++) {
        if (this.selected.SubSubjectsFilter[i] == id) {
          exist = true;
          this.selected.SubSubjectsFilter.splice(i, 1);
          this.fixedsubsubject[id] = false;
          break;
        }
      }
      if (!exist) {
        this.selected.SubSubjectsFilter.push(id);
        this.fixedsubsubject[id] = true;
      }
      this.loadMyActivities();
    },
    locationschange(id) {
      let exist = false;
      for (let i = 0; i < this.selected.LocationFilter.length; i++) {
        if (this.selected.LocationFilter[i] == id) {
          exist = true;
          this.selected.LocationFilter.splice(i, 1);
          this.fixedlocation[id] = false;
          break;
        }
      }
      if (!exist) {
        this.selected.LocationFilter.push(id);
        this.fixedlocation[id] = true;
      }
      this.loadMyActivities();
    },
    Levelschange(id) {
      let exist = false;
      for (let i = 0; i < this.selected.LevelFilter.length; i++) {
        if (this.selected.LevelFilter[i] == id) {
          exist = true;
          this.selected.LevelFilter.splice(i, 1);
          this.fixedLevels[id] = false;
          break;
        }
      }
      if (!exist) {
        this.selected.LevelFilter.push(id);
        this.fixedLevels[id] = true;
      }
      this.loadMyActivities();
    },
    InstructionalPurposeschange(id) {
      let exist = false;
      for (let i = 0; i < this.selected.InstructionalFilter.length; i++) {
        if (this.selected.InstructionalFilter[i] == id) {
          exist = true;
          this.selected.InstructionalFilter.splice(i, 1);
          this.fixedInstructional[id] = false;
          break;
        }
      }
      if (!exist) {
        this.selected.InstructionalFilter.push(id);
        this.fixedInstructional[id] = true;
      }
      this.loadMyActivities();
    },
    loadSubSubjects: function() {
      axios
        .get(
          this.$apiAdress +
            "/api/freestudent/getSubSubjects?&token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.SubSubjects = response.data;
        });
    },
    loadLevelsOfScaffolding: function() {
      axios
        .get(
          this.$apiAdress +
            "/api/freestudent/getLevelsOfScaffolding?&token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.LevelsOfScaffolding = response.data;
        });
    },
    LoadLocations: function() {
      axios
        .get(
          this.$apiAdress +
            "/api/freestudent/getLocationInstructionalCycle?&token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.Locations = response.data;
        });
    },
    LoadInstructionalPurposes: function() {
      axios
        .get(
          this.$apiAdress +
            "/api/freestudent/getInstructionalPurpose?&token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.InstructionalPurposes = response.data;
        });
    },

    gotoactivity(activityid) {
      this.$router.push({
        path: `/free-student-activities/${activityid.toString()}/myactivity`,
      });
    },
    getimage(image) {
      return this.$apiAdress + "/storage/image/" + image;
    },
    loadMyActivities: function(page = 1) {
      axios
        .get(
          this.$apiAdress +
            "/api/freestudent/getMyActivities?page=" +
            page +
            "&search=" +
            this.searchtext +
            "&is_free=" +
            this.is_free +
            "&token=" +
            localStorage.getItem("api_token"),
          {
            params: this.selected,
          }
        )
        .then((response) => {
          this.myActivities = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
  },
};
</script>
