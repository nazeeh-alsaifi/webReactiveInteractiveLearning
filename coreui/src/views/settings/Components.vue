<template>
  <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
        <CCard>
          <CCardBody>
            <div class="container">
              <div class="panel panel-default">
                <div class="alert alert-success" v-show="successadd">
                  Component Added Successfully.
                </div>
                <div class="alert alert-success" v-show="successedit">
                  Component Updated Successfully.
                </div>
                <div class="alert alert-success" v-show="successdelete">
                  Component Deleted Successfully.
                </div>
                <form @submit.prevent="submit" v-if="add">
                  <hr />
                  <div class="container">
                    <h5>Add Component:</h5>
                    <hr />
                    <div class="form-group row">
                      <label
                        for="Component_name"
                        class="col-md-4 col-form-label text-md-right"
                        >Conmponent Name</label
                      >
                      <div class="col-md-6">
                        <input
                          id="Component_name"
                          type="text"
                          class="form-control"
                          name="Component_name"
                          minlength="3"
                          v-model="fields.Component_name"
                          required
                          autofocus
                        />
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.Component_name"
                        >
                          {{ errors.Component_name[0] }}
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label
                        for="Description"
                        class="col-md-4 col-form-label text-md-right"
                        >Description</label
                      >

                      <div class="col-md-6">
                        <input
                          id="Description"
                          type="text"
                          class="form-control"
                          name="Description"
                          minlength="3"
                          v-model="fields.Description"
                          required
                          autofocus
                        />
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.Description"
                        >
                          {{ errors.Description[0] }}
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
                  <hr />
                  <div class="container">
                    <hr />
                    <h5>Edit Component:</h5>
                    <hr />
                    <div class="form-group row">
                      <label
                        for="Component_name"
                        class="col-md-4 col-form-label text-md-right"
                        >Conmponent Name</label
                      >
                      <div class="col-md-6">
                        <input
                          id="Component_name"
                          type="text"
                          minlength="3"
                          class="form-control"
                          name="Component_name"
                          v-model="editfields.Component_name"
                          required
                          autofocus
                        />
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.Component_name"
                        >
                          {{ errors.Component_name[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="Description"
                        class="col-md-4 col-form-label text-md-right"
                        >Description</label
                      >
                      <div class="col-md-6">
                        <input
                          id="Description"
                          type="text"
                          minlength="3"
                          class="form-control"
                          name="Description"
                          v-model="editfields.Description"
                          required
                          autofocus
                        />
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.Description"
                        >
                          {{ errors.Description[0] }}
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
                <div class="panel-heading"><h1>Components</h1></div>
                <div class="panel-body">
                  <div style="text-align:left">
                    <div
                      style="display:inline-block"
                      v-for="permission in permissions"
                      v-bind:key="permission.id"
                    >
                      <div v-if="permission.permission == 'add Settings'">
                        <a v-on:click="addComponent()" class="btn btn-info"
                          >Add New Component</a
                        >
                      </div>
                    </div>
                  </div>
                  <br />
                  <table style="table-layout:fixed" class="table table-striped">
                    <thead>
                      <tr style="width:100%;">
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
                        <th style="text-align:left;width:20%;">
                          <div style="text-align:left;">
                            <a
                              style="text-align:left;"
                              @click.prevent="change_sort('Component_name')"
                              >Name</a
                            >
                            <span
                              v-if="
                                this.sort_field == 'Component_name' &&
                                  this.sort_direction == 'asc'
                              "
                              @click.prevent="change_sort('Component_name')"
                              ><CIcon name="cil-arrow-top" /></span
                            >
                            <span
                              v-if="
                                this.sort_field == 'Component_name' &&
                                  this.sort_direction == 'desc'
                              "
                              @click.prevent="change_sort('Component_name')"
                              ><CIcon name="cil-arrow-bottom" /></span
                            >
                          </div>
                        </th>
                        <th style="text-align:left;width:20%;">
                          <div style="text-align:left;">
                            <a
                              style="text-align:left;"
                              @click.prevent="change_sort('Description')"
                              >Description</a
                            >
                            <span
                              v-if="
                                this.sort_field == 'Description' &&
                                  this.sort_direction == 'asc'
                              "
                              @click.prevent="change_sort('Description')"
                              ><CIcon name="cil-arrow-top" /></span
                            >
                            <span
                              v-if="
                                this.sort_field == 'Description' &&
                                  this.sort_direction == 'desc'
                              "
                              @click.prevent="change_sort('Description')"
                              ><CIcon name="cil-arrow-bottom" /></span
                            >
                          </div>
                        </th>
                        <th style="text-align:left;width:30%;">
                          <input
                            style="width:100%;"
                            type="search"
                            v-model="searchtext"
                            placeholder="search components"
                          />
                        </th>
                        <th style="text-align:left;width:20%;">
                          <a>COL</a>
                          <select
                            style="width:12%;"
                            class="btn btn-info"
                            v-model="column"
                          >
                            <option
                              class="form-control"
                              :value="'Component_name'"
                              >Component_name</option
                            >
                            <option class="form-control" :value="'Description'"
                              >Description</option
                            >
                          </select>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="component in components.data"
                        v-bind:key="component.id"
                      >
                        <td>
                          <div style="word-wrap: break-word;">
                            {{ component.id }}
                          </div>
                        </td>
                        <td>
                          <div style="word-wrap: break-word;">
                            {{ component.Component_name }}
                          </div>
                        </td>
                        <td>
                          <div style="word-wrap: break-word;">
                            {{ component.Description }}
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
                              <button
                                v-on:click="editComponent(component)"
                                v-if="!edit && component.id != editfields.id"
                                class="btn btn-info"
                              >
                                Edit
                              </button>
                              <button
                                v-on:click="cancelEdit()"
                                v-if="component.id == editfields.id"
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
                                @click="deleteComponent(component)"
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
                    :data="components"
                    @pagination-change-page="loadComponents"
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
      components: [],
      permissions: [],
      successadd: false,
      successedit: false,
      successdelete: false,
      fields: {},
      editfields: {},
      edit: false,
      add: false,
      searchtext: "",
      column: "Component_name",
      errors: [],
      sort_field: "id",
      sort_direction: "desc",
    };
  },
  mounted() {
    this.loadComponents();
    this.Permissions();
  },
  watch: {
    searchtext() {
      this.loadComponents();
    },
    column() {
      this.loadComponents();
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
      this.loadComponents();
    },
    loadComponents(page = 1) {
      axios
        .get(
          this.$apiAdress +
            "/api/component/getpage?page=" +
            page +
            "&search=" +
            this.searchtext +
            "&sort_field=" +
            this.sort_field +
            "&sort_direction=" +
            this.sort_direction +
            "&column=" +
            this.column +
            "&token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.components = response.data;
          this.successadd = false;
          this.successedit = false;
          this.successdelete = false;
        });
    },
    loadAfterAdd: function(page = 1) {
      axios
        .get(
          this.$apiAdress +
            "/api/component/getpage?page=" +
            page +
            "&search=" +
            this.searchtext +
            "&sort_field=" +
            this.sort_field +
            "&sort_direction=" +
            this.sort_direction +
            "&column=" +
            this.column +
            "&token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.components = response.data;
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
            "/api/component/getpage?page=" +
            page +
            "&search=" +
            this.searchtext +
            "&sort_field=" +
            this.sort_field +
            "&sort_direction=" +
            this.sort_direction +
            "&column=" +
            this.column +
            "&token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.components = response.data;
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
            "/api/component/getpage?page=" +
            page +
            "&search=" +
            this.searchtext +
            "&sort_field=" +
            this.sort_field +
            "&sort_direction=" +
            this.sort_direction +
            "&column=" +
            this.column +
            "&token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.components = response.data;
          this.successadd = false;
          this.successedit = false;
          this.successdelete = true;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    addComponent() {
      this.add = true;
      this.successadd = false;
      this.successedit = false;
      this.successdelete = false;
    },
    cancelAdd() {
      this.add = false;
      this.fields = {};
      this.errors = {};
      this.loadComponents();
    },
    submit() {
      axios
        .post(
          this.$apiAdress +
            "/api/Component?token=" +
            localStorage.getItem("api_token"),
          this.fields
        )
        .then((response) => {
          this.fields = {};
          this.errors = {};
          this.add = false;
          this.loadAfterAdd();
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
          }
          console.log("Error");
        });
    },
    editComponent(component) {
      this.edit = true;
      this.editfields = component;
      this.successadd = false;
      this.successedit = false;
      this.successdelete = false;
    },
    cancelEdit() {
      this.edit = false;
      this.editfields = {};
      this.errors = {};
      this.loadComponents();
    },
    update() {
      axios
        .post(
          this.$apiAdress +
            "/api/components/store1?token=" +
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
    deleteComponent(id) {
      axios
        .post(
          this.$apiAdress +
            "/api/components/delete?token=" +
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
