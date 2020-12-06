<template>
  <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
        <CCard>
          <CCardBody>
            <div class="container">
              <div class="alert alert-success" v-show="successadd">
                AcedemicLevel Added Successfully.
              </div>
              <div class="alert alert-success" v-show="successedit">
                AcedemicLevel Updated Successfully.
              </div>
              <div class="alert alert-success" v-show="successdelete">
                AcedemicLevel Deleted Successfully.
              </div>
              <form @submit.prevent="submit" v-if="add">
                <div class="container">
                  <h5>Add AcademicLevel:</h5>

                  <div class="form-group row">
                    <label
                      for="AcademicLevel"
                      class="col-md-4 col-form-label text-md-right"
                      >Academic Level</label
                    >

                    <div class="col-md-6">
                      <input
                        id="AcademicLevel"
                        type="text"
                        class="form-control"
                        name="AcademicLevel"
                        minlength="3"
                        v-model="fields.AcademicLevel"
                        required
                        autofocus
                      />
                      <div
                        class="alert alert-danger"
                        v-if="errors && errors.AcademicLevel"
                      >
                        {{ errors.AcademicLevel[0] }}
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
                   <h5>Edit Academic Level:</h5>
                   <hr />
                  <div class="form-group row">
                    <label
                      for="AcademicLevel"
                      class="col-md-4 col-form-label text-md-right"
                      >Academic Level</label
                    >
                    <div class="col-md-6">
                      <input
                        id="AcademicLevel"
                        type="text"
                        class="form-control"
                        name="AcademicLevel"
                        minlength="3"
                        v-model="editfields.AcademicLevel"
                        required
                        autofocus
                      />
                      <div
                        class="alert alert-danger"
                        v-if="errors && errors.AcademicLevel"
                      >
                        {{ errors.AcademicLevel[0] }}
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
                <div class="panel-heading"><h1>Academic Levels</h1></div>
                <div class="panel-body">
                  <div style="text-align:left">
                    <div
                      style="display:inline-block"
                      v-for="permission in permissions"
                      v-bind:key="permission.id"
                    >
                      <div v-if="permission.permission == 'add Settings'">
                        <a v-on:click="addAcademic()" class="btn btn-info"
                          >Add New Academic Level</a
                        >
                      </div>
                    </div>
                  </div>
                  <hr />
                  <table style="table-layout:fixed" class="table table-striped">
                    <thead>
                      <tr>
                        <th style="text-align:left;width:10%;">
                          <div style="text-align:left;">
                            <a
                              style="text-align:left;"
                              @click.prevent="change_sort('id')"
                              >
                              Id</a
                            >
                            <span
                              v-if="
                                this.sort_field == 'id' &&
                                  this.sort_direction == 'asc'
                              "
                              @click.prevent="change_sort('id')"
                              ><CIcon name="cil-arrow-top" /></span>
                            <span
                              v-if="
                                this.sort_field == 'id' &&
                                  this.sort_direction == 'desc'
                              "
                              @click.prevent="change_sort('id')"
                              ><CIcon name="cil-arrow-bottom" /></span>
                          </div>
                        </th>
                        <th style="text-align:left;width:30%;">
                          <div style="text-align:left;">
                            <a
                              style="text-align:left;"
                              @click.prevent="change_sort('AcademicLevel')"
                              >Name</a
                            >
                            <span
                              v-if="
                                this.sort_field == 'AcademicLevel' &&
                                  this.sort_direction == 'asc'
                              "
                              @click.prevent="change_sort('AcademicLevel')"
                              ><CIcon name="cil-arrow-top" /></span
                            >
                            <span
                              v-if="
                                this.sort_field == 'AcademicLevel' &&
                                  this.sort_direction == 'desc'
                              "
                              @click.prevent="change_sort('AcademicLevel')"
                              ><CIcon name="cil-arrow-bottom" /></span
                            >
                          </div>
                        </th>
                        <th style="width:30%;">
                          <input
                            style="width:100%;"
                            type="search"
                            v-model="searchtext"
                            placeholder="search academic level"
                          />
                        </th>
                        <th style="width:10%;"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="academiclevel in academiclevels.data"
                        v-bind:key="academiclevel.id"
                      >
                        <td style="width:10%;">
                          <div style="word-wrap: break-word;">
                            {{ academiclevel.id }}
                          </div>
                        </td>
                        <td style="width:30%;">
                          <div style="word-wrap: break-word;">
                            {{ academiclevel.AcademicLevel }}
                          </div>
                        </td>
                        <td style="width:30%;">
                          <div
                            v-for="permission in permissions"
                            v-bind:key="permission.id"
                          >
                            <div
                              v-if="permission.permission == 'edit Settings'"
                            >
                              <a
                                v-on:click="editAcademic(academiclevel)"
                                v-if="
                                  !edit && academiclevel.id != editfields.id
                                "
                                class="btn btn-info"
                                >Edit
                              </a>
                              <button
                                v-on:click="cancelEdit()"
                                v-if="academiclevel.id == editfields.id"
                                class="btn btn-outline-danger"
                              >
                                Cancel Edit
                              </button>
                            </div>
                          </div>
                        </td>
                        <td style="width:10%;">
                          <div
                            v-for="permission in permissions"
                            v-bind:key="permission.id"
                          >
                            <div
                              v-if="permission.permission == 'delete Settings'"
                            >
                              <button
                                @click="deleteAcademicLevel(academiclevel)"
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
                    :data="academiclevels"
                    @pagination-change-page="loadAcademiclevels"
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
      academiclevels: {},
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
    this.loadAcademiclevels();
    this.Permissions();
  },
  watch: {
    searchtext() {
      this.loadAcademiclevels();
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
      this.loadAcademiclevels();
    },
    loadAcademiclevels: function(page = 1) {
      let self = this;
      axios
        .get(
          this.$apiAdress +
            "/api/academiclevel/getpage?page=" +
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
          self.academiclevels = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    loadAfterAdd: function(page = 1) {
      let self = this;
      axios
        .get(
          this.$apiAdress +
            "/api/academiclevel/getpage?page=" +
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
          self.academiclevels = response.data;
          self.successadd = true;
          self.successedit = false;
          self.successdelete = false;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    loadAfterEdit: function(page = 1) {
      let self = this;
      axios
        .get(
          this.$apiAdress +
            "/api/academiclevel/getpage?page=" +
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
          self.academiclevels = response.data;
          self.successadd = false;
          self.successedit = true;
          self.successdelete = false;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    loadAfterDelete: function(page = 1) {
      let self = this;
      axios
        .get(
          this.$apiAdress +
            "/api/academiclevel/getpage?page=" +
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
          self.academiclevels = response.data;
          self.successadd = false;
          self.successedit = false;
          self.successdelete = true;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    addAcademic() {
      this.add = true;
      this.successadd = false;
      this.successedit = false;
      this.successdelete = false;
    },
    cancelAdd() {
      this.add = false;
      this.fields = {};
      this.errors = {};
      this.loadAcademiclevels();
    },
    submit() {
      let self = this;
      axios
        .post(
          this.$apiAdress +
            "/api/AcademicLevels?token=" +
            localStorage.getItem("api_token"),
          this.fields
        )
        .then((response) => {
          self.fields = {};
          self.success = true;
          self.add = false;
          self.loadAfterAdd();
          self.errors = {};
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
          }
          console.log("Error");
        });
    },
    editAcademic(academiclevel) {
      this.edit = true;
      this.editfields = academiclevel;
      this.successadd = false;
      this.successedit = false;
      this.successdelete = false;
    },
    cancelEdit() {
      this.edit = false;
      this.editfields = {};
      this.loadAcademiclevels();
    },
    update() {
      let self = this;
      axios
        .post(
          this.$apiAdress +
            "/api/academiclevels/store1?token=" +
            localStorage.getItem("api_token"),
          this.editfields
        )
        .then((response) => {
          self.editfields = {};
          self.edit = false;
          self.successedit = true;
          self.errors = {};
          self.loadAfterEdit();
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
          }
          console.log("Error");
        });
    },
    deleteAcademicLevel(id) {
      axios
        .post(
          this.$apiAdress +
            "/api/academiclevels/delete?token=" +
            localStorage.getItem("api_token"),
          id
        )
        .then((data) => {
          this.loadAfterDelete();
        })
        .catch(function(error) {
          this.errors = error.response.data.errors;
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
