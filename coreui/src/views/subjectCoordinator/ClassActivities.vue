<template>
  <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
        <CCard>
          <CCardBody>
            <div v-if="addActivities && !edit" class="container">
              <div class="panel panel-default">
                <div style="text-align:left">
                  <div style="display:inline-block">
                    <a
                      v-on:click="exitAdd()"
                      class="btn btn-primary"
                      style="color:#ffffff;"
                      >Exit Add</a
                    >
                  </div>
                </div>
                <hr />
                <div class="panel-heading"><h1>All Activities :</h1></div>
                <hr />
                <div class="panel-body">
                  <div style="display:inline-block">
                    <div
                      v-for="myActivity in allActivities.data"
                      v-bind:key="myActivity.id"
                    >
                      <div>
                        <img
                          style="width: 25%; high: 25%; border-radius:12%"
                          :src="getimage(myActivity.image)"
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
                    <hr />
                    <pagination
                      :data="allActivities"
                      @pagination-change-page="loadMyActivities"
                    ></pagination>
                  </div>
                </div>
              </div>
            </div>
            <div v-if="viewActivities" class="container">
              <div class="panel panel-default">
                <div style="text-align:left">
                  <div style="display:inline-block">
                    <a
                      v-on:click="addNewActivities()"
                      v-if="!edit"
                      class="btn btn-primary"
                      style="color:#ffffff;"
                      >Add Activities</a
                    >
                  </div>
                </div>
                <hr />
                <div class="panel-heading"><h1>Class Activities :</h1></div>
                <hr />
                <div class="panel-body">
                  <div style="display:inline-block">
                    <div
                      v-for="myActivity in myActivities.data"
                      v-bind:key="myActivity.id"
                    >
                      <div>
                        <img
                          style="width: 25%; high: 25%; border-radius:12%"
                          :src="getimage(myActivity.image)"
                          alt="Profile Image"
                        />
                      </div>
                      <div style="word-wrap: break-word; font-size:150%;">
                        <b> {{ myActivity.title }} </b>
                      </div>
                      <div style="word-wrap: break-word;">
                        {{ myActivity.objectives }}
                      </div>
                      <div style="display:inline-block" v-if="!edit">
                        <a
                          v-on:click="editActivity(myActivity)"
                          class="btn btn-primary"
                          style="color:#ffffff;"
                          >Edit Activity</a
                        >
                      </div>
                      <div v-if="edit && editfield.id === myActivity.id">
                        <div class="container">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h1>{{ editfield.title }}</h1>
                            </div>
                            <hr />
                            <div class="panel-body"></div>
                            <div
                              style="background-color:#3D2C60; color:#ffffff;"
                            >
                              <b style="margin-left:20px; font-size:120%;"
                                >Objectives:</b
                              ><br /><h9 style="margin-left:20px;">
                                {{ editfield.objectives }}
                              </h9>
                            </div>
                          </div>
                          <hr />
                          <button
                            v-on:click="cancelEdit()"
                            class="btn btn-outline-danger"
                          >
                            Cancel Edit
                          </button>
                        </div>
                      </div>
                      <hr />
                    </div>
                    <hr />
                    <pagination
                      :data="myActivities"
                      @pagination-change-page="loadAllActivities"
                    ></pagination>
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
      myId: {},
      allActivities: [],
      myActivities: [],
      edit: false,
      editfield: {},
      addActivities: false,
      viewActivities: true,
    };
  },
  mounted() {
    this.myId = this.$route.params.classid;
    this.loadAllActivities();
    this.loadMyActivities();
  },
  methods: {
    editActivity(myActivity) {
      this.edit = true;
      this.editfield = myActivity;
    },
    cancelEdit() {
      this.edit = false;
      this.editfield = {};
      this.loadMyActivities();
    },
    getimage(image) {
      return this.$apiAdress + "/storage/image/" + image;
    },
    addNewActivities() {
      this.addActivities = true;
      this.viewActivities = false;
    },
    exitAdd() {
      this.viewActivities = true;
      this.addActivities = false;
    },
    loadAllActivities: function() {
      axios
        .get(
          this.$apiAdress +
            "/api/SubjectCoordinators/" +
            this.myId +
            "/getAvailableActivities?token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.allActivities = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    loadMyActivities: function(page = 1) {
      axios
        .get(
          this.$apiAdress +
            "/api/SubjectCoordinators/" +
            this.myId +
            "/getMyActivities?page=" +
            page +
            "&token=" +
            localStorage.getItem("api_token")
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
