<template>
  <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
        <CCard>
          <CCardBody>
            <div class="container">
              <div class="alert alert-success" v-show="successadd">
                Country Added Successfully.
              </div>
              <div class="alert alert-success" v-show="successedit">
                Country Updated Successfully.
              </div>
              <div class="alert alert-success" v-show="successdelete">
                Country Deleted Successfully.
              </div>
              <form @submit.prevent="submit" v-if="add">
                <div class="container">
                  <h5>Add Country:</h5>
                  <hr />
                  <div class="form-group row">
                    <label
                      for="country_name"
                      class="col-md-4 col-form-label text-md-right"
                      >Country Name</label
                    >

                    <div class="col-md-6">
                      <input
                        id="country_name"
                        type="text"
                        class="form-control"
                        name="country_name"
                        minlength="3"
                        v-model="fields.country_name"
                        required
                        autofocus
                      />
                      <div
                        class="alert alert-danger"
                        v-if="errors && errors.country_name"
                      >
                        {{ errors.country_name[0] }}
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
                  <h1>Edit Country:</h1>
                  <hr />
                  <div class="form-group row">
                    <label
                      for="country_name"
                      class="col-md-4 col-form-label text-md-right"
                      >Country Name</label
                    >

                    <div class="col-md-6">
                      <input
                        id="country_name"
                        type="text"
                        class="form-control"
                        minlength="3"
                        v-model="editfields.country_name"
                        name="country_name"
                        required
                        autofocus
                      />
                      <div
                        class="alert alert-danger"
                        v-if="errors && errors.country_name"
                      >
                        {{ errors.country_name[0] }}
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
              <div>
                <div class="panel panel-default"><h1>Countries</h1></div>
                <div class="panel-body">
                  <div>
                    <div style="text-align:left">
                      <div
                        style="display:inline-block"
                        v-for="permission in permissions"
                        v-bind:key="permission.id"
                      >
                        <div v-if="permission.permission == 'add Settings'">
                          <a v-on:click="addCountry()" class="btn btn-info"
                            >Add New Country</a
                          >
                        </div>
                      </div>
                    </div>
                    <hr />
                    <table
                      style="table-layout:fixed;width:100%;"
                      class="table table-striped"
                    >
                      <thead>
                        <tr>
                          <th style="text-align:left;width:10%;">
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
                          </th>
                          <th style="text-align:left; width:25%;">
                            <a
                              style="text-align:left;"
                              @click.prevent="change_sort('country_name')"
                              >Name</a
                            >
                            <span
                              v-if="
                                this.sort_field == 'country_name' &&
                                  this.sort_direction == 'asc'
                              "
                              @click.prevent="change_sort('country_name')"
                              ><CIcon name="cil-arrow-top" /></span
                            >
                            <span
                              v-if="
                                this.sort_field == 'country_name' &&
                                  this.sort_direction == 'desc'
                              "
                              @click.prevent="change_sort('country_name')"
                              ><CIcon name="cil-arrow-bottom" /></span
                            >
                          </th>
                          <th style="width:35%;">
                            <input
                              style="width:100%;"
                              type="search"
                              v-model="searchtext"
                              placeholder="search country"
                            />
                          </th>
                          <th style="width:10%;"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="country in countries.data"
                          v-bind:key="country.id"
                        >
                          <td>
                            <div style="word-wrap: break-word;">
                              {{ country.id }}
                            </div>
                          </td>
                          <td>
                            <div style="word-wrap: break-word;">
                              {{ country.country_name }}
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
                                  v-on:click="editCountry(country)"
                                  v-if="!edit && country.id != editfields.id"
                                  class="btn btn-info"
                                  >Edit</a
                                >
                                <button
                                  v-on:click="cancelEdit()"
                                  v-if="country.id == editfields.id"
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
                                v-if="
                                  permission.permission == 'delete Settings'
                                "
                              >
                                <button
                                  @click="deleteCountry(country)"
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
                      :data="countries"
                      @pagination-change-page="loadCountries"
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
      countries: {},
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
    this.loadCountries();
    this.Permissions();
  },

  watch: {
    searchtext() {
      this.loadCountries();
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
      this.loadCountries();
    },
    loadCountries: function(page = 1) {
      axios
        .get(
          this.$apiAdress +
            "/api/country/getpage?page=" +
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
          this.countries = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    loadAfterAdd: function(page = 1) {
      axios
        .get(
          this.$apiAdress +
            "/api/country/getpage?page=" +
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
          this.countries = response.data;
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
            "/api/country/getpage?page=" +
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
          this.countries = response.data;
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
            "/api/country/getpage?page=" +
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
          this.countries = response.data;
          this.successadd = false;
          this.successedit = false;
          this.successdelete = true;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    addCountry() {
      this.add = true;
      this.successadd = false;
      this.successedit = false;
      this.successdelete = false;
    },
    cancelAdd() {
      this.add = false;
      this.fields = {};
      this.errors = {};
      this.loadCountries();
    },
    submit() {
      axios
        .post(
          this.$apiAdress +
            "/api/Countries?token=" +
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
    editCountry(country) {
      this.edit = true;
      this.editfields = country;
      this.successadd = false;
      this.successedit = false;
      this.successdelete = false;
    },
    cancelEdit() {
      this.edit = false;
      this.editfields = {};
      this.loadCountries();
    },
    update() {
      axios
        .post(
          this.$apiAdress +
            "/api/countries/store1?token=" +
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
    deleteCountry(id) {
      axios
        .post(
          this.$apiAdress +
            "/api/countries/delete?token=" +
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
