<template>
  <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
        <CCard>
          <CCardBody>
            <div class="container">
              <div class="panel panel-default">
                <div class="alert alert-success" v-show="successadd">
                  Measure Tool Added Successfully.
                </div>
                <div class="alert alert-success" v-show="successedit">
                  Measure Tool Updated Successfully.
                </div>
                <div class="alert alert-success" v-show="successdelete">
                  Measure Tool Deleted Successfully.
                </div>
                <form @submit.prevent="submit" v-if="add">
                  <div class="container">
                    <hr />
                    <h5>Add Measure Tool:</h5>
                    <hr />
                    <div class="form-group row">
                      <label
                        for="measureTools_name"
                        class="col-md-4 col-form-label text-md-right"
                        >Measure Tool Name</label
                      >

                      <div class="col-md-6">
                        <input
                          id="measureTools_name"
                          type="text"
                          class="form-control"
                          name="measureTools_name"
                          minlength="3"
                          v-model="fields.measureTools_name"
                          required
                          autofocus
                        />
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.measureTools_name"
                        >
                          {{ errors.measureTools_name[0] }}
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
                    <div class="form-group row">
                      <label
                        for="src_link"
                        class="col-md-4 col-form-label text-md-right"
                        >Source_link</label
                      >

                      <div class="col-md-6">
                        <input
                          id="src_link"
                          type="text"
                          class="form-control"
                          name="src_link"
                          minlength="3"
                          v-model="fields.src_link"
                          required
                          autofocus
                        />
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.src_link"
                        >
                          {{ errors.src_link[0] }}
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
                    <h5>Edit Measure_Tool:</h5>
                    <hr />
                    <div class="form-group row">
                      <label
                        for="measureTool_name"
                        class="col-md-4 col-form-label text-md-right"
                        >Measure_Tool</label
                      >
                      <div class="col-md-6">
                        <input
                          id="measureTool_name"
                          type="text"
                          class="form-control"
                          minlength="3"
                          name="measureTool_name"
                          v-model="editfields.measureTool_name"
                          required
                          autofocus
                        />
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.measureTool_name"
                        >
                          {{ errors.measureTool_name[0] }}
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
                          minlength="3"
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

                    <div class="form-group row">
                      <label
                        for="src_link"
                        class="col-md-4 col-form-label text-md-right"
                        >Source_Link</label
                      >
                      <div class="col-md-6">
                        <input
                          id="src_link"
                          type="text"
                          class="form-control"
                          minlength="3"
                          name="src_link"
                          v-model="editfields.src_link"
                          required
                          autofocus
                        />
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.src_link"
                        >
                          {{ errors.src_link[0] }}
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
                <div class="panel-heading"><h1>Measure Tools</h1></div>
                <div class="panel-body">
                  <div style="text-align:left">
                    <div
                      style="display:inline-block"
                      v-for="permission in permissions"
                      v-bind:key="permission.id"
                    >
                      <div v-if="permission.permission == 'add Settings'">
                        <a v-on:click="addMeasureTool()" class="btn btn-info"
                          >Add New Measure Tools</a
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
                              @click.prevent="change_sort('measureTool_name')"
                              >Name</a
                            >
                            <span
                              v-if="
                                this.sort_field == 'measureTool_name' &&
                                  this.sort_direction == 'asc'
                              "
                              @click.prevent="change_sort('measureTool_name')"
                              ><CIcon name="cil-arrow-top" /></span
                            >
                            <span
                              v-if="
                                this.sort_field == 'measureTool_name' &&
                                  this.sort_direction == 'desc'
                              "
                              @click.prevent="change_sort('measureTool_name')"
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
                        <th style="text-align:left;width:20%;">
                          <div style="text-align:left;">
                            <a
                              style="text-align:left;"
                              @click.prevent="change_sort('src_link')"
                              >Source_Link</a
                            >
                            <span
                              v-if="
                                this.sort_field == 'src_link' &&
                                  this.sort_direction == 'asc'
                              "
                              @click.prevent="change_sort('src_link')"
                              ><CIcon name="cil-arrow-top" /></span
                            >
                            <span
                              v-if="
                                this.sort_field == 'src_link' &&
                                  this.sort_direction == 'desc'
                              "
                              @click.prevent="change_sort('src_link')"
                              ><CIcon name="cil-arrow-bottom" /></span
                            >
                          </div>
                        </th>
                        <th style="width:30%;">
                          <input
                            style="width:100%;"
                            type="search"
                            v-model="searchtext"
                            placeholder="search measure tool"
                          />
                        </th>
                        <th style="width:10%;">
                          <a>COL</a>
                          <select
                            style="width:10%;"
                            class="btn btn-info"
                            v-model="column"
                          >
                            <option
                              class="form-control"
                              :value="'measureTool_name'"
                              >Name</option
                            >
                            <option class="form-control" :value="'Description'"
                              >Description</option
                            >
                            <option class="form-control" :value="'src_link'"
                              >Source_Link</option
                            >
                          </select>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="measuretool in measuretools.data"
                        v-bind:key="measuretool.id"
                      >
                        <td>
                          <div style="word-wrap: break-word;">
                            {{ measuretool.id }}
                          </div>
                        </td>
                        <td>
                          <div style="word-wrap: break-word;">
                            {{ measuretool.measureTool_name }}
                          </div>
                        </td>
                        <td>
                          <div style="word-wrap: break-word;">
                            {{ measuretool.Description }}
                          </div>
                        </td>
                        <td>
                          <div style="word-wrap: break-word;">
                            {{ measuretool.src_link }}
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
                                v-on:click="editMeasureTool(measuretool)"
                                v-if="!edit && measuretool.id != editfields.id"
                                class="btn btn-info"
                                >Edit</a
                              >
                              <button
                                v-on:click="cancelEdit()"
                                v-if="measuretool.id == editfields.id"
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
                                @click="deleteMeasureTool(measuretool)"
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
                    :data="measuretools"
                    @pagination-change-page="loadMeasureTools"
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
      measuretools: {},
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
      column: "measureTool_name",
    };
  },
  mounted() {
    this.loadMeasureTools();
    this.Permissions();
  },
  watch: {
    searchtext() {
      this.loadMeasureTools();
    },
    column() {
      this.loadMeasureTools();
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
      this.loadMeasureTools();
    },
    loadMeasureTools: function(page = 1) {
      axios
        .get(
          this.$apiAdress +
            "/api/measuretool/getpage?page=" +
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
          this.measuretools = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    loadAfterAdd: function(page = 1) {
      axios;
      axios
        .get(
          this.$apiAdress +
            "/api/measuretool/getpage?page=" +
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
          this.measuretools = response.data;
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
            "/api/measuretool/getpage?page=" +
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
          this.measuretools = response.data;
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
            "/api/measuretool/getpage?page=" +
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
          this.measuretools = response.data;
          this.successadd = false;
          this.successedit = false;
          this.successdelete = true;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    addMeasureTool() {
      this.add = true;
      this.successadd = false;
      this.successedit = false;
      this.successdelete = false;
    },
    cancelAdd() {
      this.add = false;
      this.fields = {};
      this.errors = {};
      this.loadMeasureTools();
    },
    submit() {
      axios
        .post(
          this.$apiAdress +
            "/api/Measuretool?token=" +
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
    editMeasureTool(measuretool) {
      this.edit = true;
      this.editfields = measuretool;
      this.successadd = false;
      this.successedit = false;
      this.successdelete = false;
    },
    cancelEdit() {
      this.edit = false;
      this.editfields = {};
      this.loadMeasureTools();
    },
    update() {
      axios
        .post(
          this.$apiAdress +
            "/api/measuretools/store1?token=" +
            localStorage.getItem("api_token"),
          this.editfields
        )
        .then((response) => {
          this.editfields = {};
          this.edit = false;
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
    deleteMeasureTool(id) {
      axios
        .post(
          this.$apiAdress +
            "/api/measuretools/delete?token=" +
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
