<template>
  <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
        <CCard>
          <CCardBody>
            <div class="container">
              <div class="panel panel-default">
                <div class="alert alert-success" v-show="successadd">
                  Unit_Measure Added Successfully.
                </div>
                <div class="alert alert-success" v-show="successedit">
                  Unit_Measure Updated Successfully.
                </div>
                <div class="alert alert-success" v-show="successdelete">
                  Unit_Measure Deleted Successfully.
                </div>
                <form @submit.prevent="submit" v-if="add">
                  <hr />
                  <div class="container">
                    <h5>Add Unit_Measure:</h5>
                    <hr />
                    <div class="form-group row">
                      <label
                        for="Unit_id"
                        class="col-md-4 col-form-label text-md-right"
                        >Choose Unit</label
                      >

                      <div class="col-md-6">
                        <select
                          class="form-control"
                          id="Unit_id"
                          name="Unit_id"
                          v-model="fields.Unit_id"
                          required
                          autofocus
                        >
                          <option
                            v-for="unit in units"
                            v-bind:key="unit.id"
                            :value="unit.id"
                            >{{ unit.unit_name }}</option
                          >
                        </select>
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.Unit_id"
                        >
                          {{ errors.category_id[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="Unit_measure"
                        class="col-md-4 col-form-label text-md-right"
                        >Unit_Measure
                      </label>

                      <div class="col-md-6">
                        <input
                          id="Unit_measure"
                          type="text"
                          class="form-control"
                          name="Unit_measure"
                          v-model="fields.Unit_measure"
                          required
                          autofocus
                        />
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.Unit_measure"
                        >
                          {{ errors.Unit_measure[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="Measure_sample"
                        class="col-md-4 col-form-label text-md-right"
                        >Measure_Sample
                      </label>

                      <div class="col-md-6">
                        <input
                          id="Measure_sample"
                          type="text"
                          class="form-control"
                          name="Measure_sample"
                          v-model="fields.Measure_sample"
                          required
                          autofocus
                        />
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.Measure_sample"
                        >
                          {{ errors.Measure_sample[0] }}
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
                    <h5>Edit Unit_Measure:</h5>
                    <hr />
                    <div class="form-group row">
                      <label
                        for="unit_id"
                        class="col-md-4 col-form-label text-md-right"
                        >Choose Unit</label
                      >
                      <div class="col-md-6">
                        <select
                          class="form-control"
                          id="unit_id"
                          name="unit_id"
                          v-model="editfields.unit_id"
                          required
                          autofocus
                        >
                          <option
                            v-for="unit in units"
                            v-bind:key="unit.id"
                            :value="unit.id"
                            >{{ unit.unit_name }}</option
                          >
                        </select>
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.unit_id"
                        >
                          {{ errors.unit_id[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="Unit_measure"
                        class="col-md-4 col-form-label text-md-right"
                        >Unit_Measure
                      </label>
                      <div class="col-md-6">
                        <input
                          id="Unit_measure"
                          type="text"
                          class="form-control"
                          name="Unit_measure"
                          v-model="editfields.Unit_measure"
                          required
                          autofocus
                        />
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.name"
                        >
                          {{ errors.name[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="Measure_sample"
                        class="col-md-4 col-form-label text-md-right"
                        >Measure_Sample
                      </label>
                      <div class="col-md-6">
                        <input
                          id="Measure_sample"
                          type="text"
                          class="form-control"
                          name="Measure_sample"
                          v-model="editfields.Measure_sample"
                          required
                          autofocus
                        />
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.name"
                        >
                          {{ errors.name[0] }}
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
                <div class="panel-heading"><h1>Units_Measure</h1></div>
                <div class="panel-body">
                  <div style="text-align:left">
                    <div
                      style="display:inline-block"
                      v-for="permission in permissions"
                      v-bind:key="permission.id"
                    >
                      <div v-if="permission.permission == 'add Settings'">
                        <a v-on:click="addUnit()" class="btn btn-info"
                          >Add New Sub_Subject</a
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
                              @click.prevent="change_sort('Unit_measure')"
                              >Name</a
                            >
                            <span
                              v-if="
                                this.sort_field == 'Unit_measure' &&
                                  this.sort_direction == 'asc'
                              "
                              @click.prevent="change_sort('Unit_measure')"
                              ><CIcon name="cil-arrow-top" /></span
                            >
                            <span
                              v-if="
                                this.sort_field == 'Unit_measure' &&
                                  this.sort_direction == 'desc'
                              "
                              @click.prevent="change_sort('Unit_measure')"
                              ><CIcon name="cil-arrow-bottom" /></span
                            >
                          </div>
                        </th>
                        <th style="text-align:left;width:10%;">
                          <div style="text-align:left;">
                            <a
                              style="text-align:left;"
                              @click.prevent="change_sort('unit_id')"
                              >Unit</a
                            >
                            <span
                              v-if="
                                this.sort_field == 'unit_id' &&
                                  this.sort_direction == 'asc'
                              "
                              @click.prevent="change_sort('unit_id')"
                              ><CIcon name="cil-arrow-top" /></span
                            >
                            <span
                              v-if="
                                this.sort_field == 'unit_id' &&
                                  this.sort_direction == 'desc'
                              "
                              @click.prevent="change_sort('unit_id')"
                              ><CIcon name="cil-arrow-bottom" /></span
                            >
                          </div>
                        </th>
                        <th style="text-align:left;width:20%;">
                          <div style="text-align:left;">
                            <a
                              style="text-align:left;"
                              @click.prevent="change_sort('Measure_sample')"
                              >Measure_sample</a
                            >
                            <span
                              v-if="
                                this.sort_field == 'Measure_sample' &&
                                  this.sort_direction == 'asc'
                              "
                              @click.prevent="change_sort('Measure_sample')"
                              ><CIcon name="cil-arrow-top" /></span
                            >
                            <span
                              v-if="
                                this.sort_field == 'Measure_sample' &&
                                  this.sort_direction == 'desc'
                              "
                              @click.prevent="change_sort('Measure_sample')"
                              ><CIcon name="cil-arrow-bottom" /></span
                            >
                          </div>
                        </th>
                        <th style="width:30%;">
                          <input
                            style="width:100%;"
                            type="search"
                            v-model="searchtext"
                            placeholder="search unit_measure"
                          />
                        </th>
                        <th style="width:10%;"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="unitsmeasure in unitmeasures.data"
                        v-bind:key="unitsmeasure.id"
                      >
                        <td>
                          <div style="word-wrap: break-word;">
                            {{ unitsmeasure.id }}
                          </div>
                        </td>
                        <td>
                          <div style="word-wrap: break-word;">
                            {{ unitsmeasure.Unit_measure }}
                          </div>
                        </td>
                        <td>
                          <div v-for="unit in units" v-bind:key="unit.id">
                            <div
                              style="word-wrap: break-word;"
                              v-if="unit.id == unitsmeasure.unit_id"
                            >
                              {{ unit.unit_name }}
                            </div>
                          </div>
                        </td>

                        <td>
                          <div style="word-wrap: break-word;">
                            {{ unitsmeasure.Measure_sample }}
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
                                v-on:click="editUnit(unitsmeasure)"
                                v-if="!edit && unitsmeasure.id != editfields.id"
                                class="btn btn-info"
                              >
                                Edit
                              </button>
                              <button
                                v-on:click="cancelEdit()"
                                v-if="unitsmeasure.id == editfields.id"
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
                                @click="deleteUnitMeasure(unitsmeasure)"
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
                    :data="unitmeasures"
                    @pagination-change-page="loadUnitsMeasure"
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
      unitmeasures: [],
      units: [],
      permissions: [],
      loading: true,
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
    this.loadUnitsMeasure();
    this.loadUnits();
    this.Permissions();
  },
  watch: {
    searchtext() {
      this.loadUnitsMeasure();
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
      this.loadUnitsMeasure();
    },
    loadUnitsMeasure: function(page = 1) {
      axios
        .get(
          this.$apiAdress +
            "/api/unitMeasure/getpage?page=" +
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
          this.unitmeasures = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    loadUnits: function() {
      axios
        .get(
          this.$apiAdress +
            "/api/Unit?token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.units = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    loadAfterAdd: function(page = 1) {
      axios
        .get(
          this.$apiAdress +
            "/api/unitMeasure/getpage?page=" +
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
          this.unitmeasures = response.data;
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
            "/api/unitMeasure/getpage?page=" +
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
          this.unitmeasures = response.data;
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
            "/api/unitMeasure/getpage?page=" +
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
          this.unitmeasures = response.data;
          this.successadd = false;
          this.successedit = false;
          this.successdelete = true;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    addUnit() {
      this.add = true;
      this.successadd = false;
      this.successedit = false;
      this.successdelete = false;
    },
    cancelAdd() {
      this.add = false;
      this.fields = {};
      this.errors = {};
      this.loadUnitsMeasure();
    },
    submit() {
      axios
        .post(
          this.$apiAdress +
            "/api/UnitMeasure?token=" +
            localStorage.getItem("api_token"),
          this.fields
        )
        .then((response) => {
          this.fields = {};
          this.success = true;
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
    editUnit(unitmeasures) {
      this.edit = true;
      this.editfields = unitmeasures;
      this.successadd = false;
      this.successedit = false;
      this.successdelete = false;
    },
    cancelEdit() {
      this.edit = false;
      this.editfields = {};
      this.loadUnitsMeasure();
    },
    update() {
      axios
        .post(
          this.$apiAdress +
            "/api/unitMeasures/store1?token=" +
            localStorage.getItem("api_token"),
          this.editfields
        )
        .then((response) => {
          this.editfields = {};
          this.success = true;
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
    deleteUnitMeasure(id) {
      axios
        .post(
          this.$apiAdress +
            "/api/unitMeasures/delete?token=" +
            localStorage.getItem("api_token"),
          id
        )
        .then((data) => {
          this.loadAfterDelete();
          this.loadUnits();
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
