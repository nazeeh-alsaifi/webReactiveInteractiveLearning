<template>
  <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
        <CCard>
          <CCardBody>
            <div class="container">
              <div class="alert alert-success" v-show="successadd">
                Location_Instructional_Cycle Added Successfully.
              </div>
              <div class="alert alert-success" v-show="successedit">
                Location_Instructional_Cycle Updated Successfully.
              </div>
              <div class="alert alert-success" v-show="successdelete">
                Location_Instructional_Cycle Deleted Successfully.
              </div>
              <form @submit.prevent="submit" v-if="add">
                <div class="container">
                  <h5>Add Location_Instructional_Cycle:</h5>
                  <hr />
                  <div class="form-group row">
                    <label
                      for="Location_Instructional_Cycle"
                      class="col-md-4 col-form-label text-md-right"
                      >Location_Instructional_Cycle</label
                    >

                    <div class="col-md-6">
                      <input
                        id="Location_Instructional_Cycle"
                        type="text"
                        class="form-control"
                        minlength="3"
                        name="Location_Instructional_Cycle"
                        v-model="fields.Location_Instructional_Cycle"
                        required
                        autofocus
                      />
                      <div
                        class="alert alert-danger"
                        v-if="errors && errors.Location_Instructional_Cycle"
                      >
                        {{ errors.Location_Instructional_Cycle[0] }}
                      </div>
                    </div>
                  </div>

                  <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                      <button type="submit" class="btn btn-info">
                        Add
                      </button>
                      <button
                        v-on:click="cancelAdd()"
                        class="btn btn-outline-danger"
                      >
                        Cancel Add
                      </button>
                    </div>
                  </div>
                </div>
              </form>
              <form @submit.prevent="update" v-if="edit">
                <div class="container">
                  <hr />
                  <h5>Edit Location_Instructional_Cycle:</h5>
                  <hr />
                  <div class="form-group row">
                    <label
                      for="Location_Instructional_Cycle"
                      class="col-md-4 col-form-label text-md-right"
                      >Name</label
                    >

                    <div class="col-md-6">
                      <input
                        id="Location_Instructional_Cycle"
                        type="text"
                        minlength="3"
                        class="form-control"
                        name="Location_Instructional_Cycle"
                        v-model="editfields.Location_Instructional_Cycle"
                        required
                        autofocus
                      />
                      <div
                        class="alert alert-danger"
                        v-if="errors && errors.Location_Instructional_Cycle"
                      >
                        {{ errors.Location_Instructional_Cycle[0] }}
                      </div>
                    </div>
                  </div>

                  <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                      <button type="submit" class="btn btn-outline-primary">
                        Update
                      </button>
                      <button
                        v-on:click="cancelEdit()"
                        class="btn btn-outline-danger"
                      >
                        Cancel Edit
                      </button>
                    </div>
                  </div>
                </div>
              </form>
              <div class="panel panel-default">
                <div class="panel-heading"><h1>Locations_Cycle</h1></div>
                <div class="panel-body">
                  <div style="text-align:left">
                    <div
                      style="display:inline-block"
                      v-for="permission in permissions"
                      v-bind:key="permission.id"
                    >
                      <div v-if="permission.permission == 'add Settings'">
                        <a v-on:click="addLocation()" class="btn btn-info"
                          >Add New Location_Instructional_Cycle</a
                        >
                      </div>
                    </div>
                  </div>
                  <br />
                  <table style="table-layout:fixed" class="table table-striped">
                    <thead>
                      <tr>
                        <th style="text-align:left;width:10%;">
                          <div style="text-align:left;">
                            <a
                              style="text-align:left;"
                              @click.prevent="change_sort('id')"
                              >Id</a
                            >
                            <span
                              v-if="
                                this.sort_field == 'id' &&
                                  this.sort_direction == 'asc'
                              "
                              @click.prevent="change_sort('id')"
                              ><CIcon name="cil-arrow-top" /></span
                            >
                            <span
                              v-if="
                                this.sort_field == 'id' &&
                                  this.sort_direction == 'desc'
                              "
                              @click.prevent="change_sort('id')"
                              ><CIcon name="cil-arrow-bottom" /></span
                            >
                          </div>
                        </th>
                        <th style="text-align:left;width:25%;">
                          <div style="text-align:left;">
                            <a
                              style="text-align:left;"
                              @click.prevent="
                                change_sort('Location_Instructional_Cycle')
                              "
                              >Name</a
                            >
                            <span
                              v-if="
                                this.sort_field ==
                                  'Location_Instructional_Cycle' &&
                                  this.sort_direction == 'asc'
                              "
                              @click.prevent="
                                change_sort('Location_Instructional_Cycle')
                              "
                              ><CIcon name="cil-arrow-top" /></span
                            >
                            <span
                              v-if="
                                this.sort_field ==
                                  'Location_Instructional_Cycle' &&
                                  this.sort_direction == 'desc'
                              "
                              @click.prevent="
                                change_sort('Location_Instructional_Cycle')
                              "
                              ><CIcon name="cil-arrow-bottom" /></span
                            >
                          </div>
                        </th>
                        <th style="width:35%;">
                          <input
                            style="width:100%;"
                            type="search"
                            v-model="searchtext"
                            placeholder="search Name"
                          />
                        </th>
                        <th style="width:10%;"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="location in locations.data"
                        v-bind:key="location.id"
                      >
                        <td>
                          <div style="word-wrap: break-word;">
                            {{ location.id }}
                          </div>
                        </td>
                        <td>
                          <div style="word-wrap: break-word;">
                            {{ location.Location_Instructional_Cycle }}
                          </div>
                        </td>
                        <td>
                          <div
                            v-for="permission in permissions"
                            v-bind:key="permission.id"
                          >
                            <div
                              v-if="permission.permission == 'edit Settings'"
                            >
                              <a
                                v-on:click="editLocation(location)"
                                v-if="!edit && location.id != editfields.id"
                                class="btn btn-info"
                                >Edit</a
                              >
                              <button
                                v-on:click="cancelEdit()"
                                v-if="location.id == editfields.id"
                                class="btn btn-outline-danger"
                              >
                                Cancel Edit
                              </button>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div
                            v-for="permission in permissions"
                            v-bind:key="permission.id"
                          >
                            <div
                              v-if="permission.permission == 'delete Settings'"
                            >
                              <button
                                @click="deleteLocation(location)"
                                class="btn btn-danger"
                              >
                                Delete
                              </button>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <hr />
                    </tbody>
                  </table>
                  <pagination
                    :data="locations"
                    @pagination-change-page="loadLocations"
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
      locations: {},
      permissions: [],
      successadd: false,
      successedit: false,
      successdelete: false,
      fields: {},
      editfields: {},
      edit: false,
      add: false,
      searchtext: "",
      errors: [],
      sort_field: "id",
      sort_direction: "desc",
    };
  },
  mounted() {
    this.loadLocations();
    this.Permissions();
  },
  watch: {
    searchtext() {
      this.loadLocations();
    },
  },
  methods: {
    Permissions() {
      axios
        .get(
          this.$apiAdress +
            "/api/user/getUserPermissions?token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.permissions = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    change_sort(field) {
      if (this.sort_field === field) {
        this.sort_direction = this.sort_direction === "asc" ? "desc" : "asc";
      } else {
        this.sort_field = field;
        this.sort_direction = "asc";
      }
      this.loadLocations();
    },
    loadLocations: function(page = 1) {
      axios
        .get(
          this.$apiAdress +
            "/api/locationInstructional/getpage?page=" +
            page +
            "&search=" +
            this.searchtext +
            "&sort_field=" +
            this.sort_field +
            "&sort_direction=" +
            this.sort_direction +
            "&token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.locations = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    loadAfterAdd: function(page = 1) {
      axios
        .get(
          this.$apiAdress +
            "/api/locationInstructional/getpage?page=" +
            page +
            "&search=" +
            this.searchtext +
            "&sort_field=" +
            this.sort_field +
            "&sort_direction=" +
            this.sort_direction +
            "&token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.locations = response.data;
          this.successadd = true;
          this.successedit = false;
          this.successdelete = false;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    loadAfterEdit: function(page = 1) {
      axios
        .get(
          this.$apiAdress +
            "/api/locationInstructional/getpage?page=" +
            page +
            "&search=" +
            this.searchtext +
            "&sort_field=" +
            this.sort_field +
            "&sort_direction=" +
            this.sort_direction +
            "&token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.locations = response.data;
          this.successadd = false;
          this.successedit = true;
          this.successdelete = false;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    loadAfterDelete: function(page = 1) {
      axios
        .get(
          this.$apiAdress +
            "/api/locationInstructional/getpage?page=" +
            page +
            "&search=" +
            this.searchtext +
            "&sort_field=" +
            this.sort_field +
            "&sort_direction=" +
            this.sort_direction +
            "&token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.locations = response.data;
          this.successadd = false;
          this.successedit = false;
          this.successdelete = true;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    addLocation() {
      this.add = true;
      this.successadd = false;
      this.successedit = false;
      this.successdelete = false;
    },
    cancelAdd() {
      this.add = false;
      this.fields = {};
      this.errors = {};
      this.loadLocations();
    },
    submit() {
      axios
        .post(
          this.$apiAdress +
            "/api/LocationInstructional?token=" +
            localStorage.getItem("api_token"),
          this.fields
        )
        .then((response) => {
          this.fields = {};
          this.success = true;
          this.add = false;
          this.loadAfterAdd();
          this.errors = {};
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
          }
          console.log("Error");
        });
    },
    editLocation(location) {
      this.edit = true;
      this.editfields = location;
      this.successadd = false;
      this.successedit = false;
      this.successdelete = false;
    },
    cancelEdit() {
      this.edit = false;
      this.editfields = {};
      this.loadLocations();
    },
    update() {
      axios;
      axios
        .post(
          this.$apiAdress +
            "/api/locationInstructional/store1?token=" +
            localStorage.getItem("api_token"),
          this.editfields
        )
        .then((response) => {
          this.editfields = {};
          this.edit = false;
          this.successedit = true;
          this.errors = {};
          this.loadAfterEdit();
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
          }
          console.log("Error");
        });
    },
    deleteLocation(id) {
      axios
        .post(
          this.$apiAdress +
            "/api/locationInstructional/delete?token=" +
            localStorage.getItem("api_token"),
          id
        )
        .then((data) => {
          this.loadAfterDelete();
        })
        .catch(function(error) {
          console.log(error);
        });
    },
  },
};
</script>

<style scoped>
table {
  width: 100%;
  border-collapse: separate; /* Don't collapse */
  border-spacing: 0;
}

table th {
  /* Apply both top and bottom borders to the <th> */
  border-top: 2px solid rgba(99, 99, 99, 0.5);
  border-bottom: 2px solid rgba(99, 99, 99, 0.5);
}

table th:first-child {
  /* Apply a left border on the first <td> or <th> in a row */
  border-left: 2px solid rgba(99, 99, 99, 0.5);
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
}
table th:last-child {
  /* Apply a left border on the first <td> or <th> in a row */
  border-right: 2px solid rgba(99, 99, 99, 0.5);
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
}
table thead th {
  top: 0;
}
input:invalid {
  border: red solid 1px;
}
</style>
