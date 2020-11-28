<template>
  <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
        <CCard>
          <CCardBody>
            <div class="container">
              <div class="panel panel-default">
                <div class="alert alert-success" v-show="successadd">
                  Category Added Successfully.
                </div>
                <div class="alert alert-success" v-show="successedit">
                  Category Updated Successfully.
                </div>
                <div class="alert alert-success" v-show="successdelete">
                  Category Deleted Successfully.
                </div>
                <form @submit.prevent="submit" v-if="add">
                  <hr />
                  <h1>Add Category:</h1>
                  <hr />
                  <div class="container">
                    <div class="form-group row">
                      <label
                        for="Cat_name"
                        class="col-md-4 col-form-label text-md-right"
                        >Category Name</label
                      >

                      <div class="col-md-6">
                        <input
                          id="Cat_name"
                          type="text"
                          class="form-control"
                          name="Cat_name"
                          minlength="3"
                          v-model="fields.Cat_name"
                          required
                          autofocus
                        />
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.Cat_name"
                        >
                          {{ errors.Cat_name[0] }}
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label
                        for="Subj_id"
                        class="col-md-4 col-form-label text-md-right"
                        >Choose Subject</label
                      >

                      <div class="col-md-6">
                        <select
                          class="form-control"
                          id="Subj_id"
                          name="Subj_id"
                          v-model="fields.Subj_id"
                          required
                          autofocus
                        >
                          <option
                            v-for="subject in subjects"
                            v-bind:key="subject.id"
                            :value="subject.id"
                            >{{ subject.Subject_name }}</option
                          >
                        </select>
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.Subj_id"
                        >
                          {{ errors.Subj_id[0] }}
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
                    <h5>Edit Category:</h5>
                    <hr />
                    <div class="form-group row">
                      <label
                        for="Cat_name"
                        class="col-md-4 col-form-label text-md-right"
                        >Category Name</label
                      >
                      <div class="col-md-6">
                        <input
                          id="Cat_name"
                          type="text"
                          class="form-control"
                          name="Cat_name"
                          minlength="3"
                          v-model="editfields.Cat_name"
                          required
                          autofocus
                        />
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.Cat_name"
                        >
                          {{ errors.Cat_name[0] }}
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label
                        for="subject_id"
                        class="col-md-4 col-form-label text-md-right"
                        >Choose Subject</label
                      >
                      <div class="col-md-6">
                        <select
                          class="form-control"
                          id="subject_id"
                          name="subject_id"
                          v-model="editfields.subject_id"
                          required
                          autofocus
                        >
                          <option
                            v-for="subject in subjects"
                            v-bind:key="subject.id"
                            :value="subject.id"
                            >{{ subject.Subject_name }}</option
                          >
                        </select>
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.subject_id"
                        >
                          {{ errors.subject_id[0] }}
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
                <div class="panel-heading"><h1>Categories</h1></div>
                <div class="panel-body">
                  <div style="text-align:left">
                    <div
                      style="display:inline-block"
                      v-for="permission in permissions"
                      v-bind:key="permission.id"
                    >
                      <div v-if="permission.permission == 'add Settings'">
                        <a v-on:click="addCategory()" class="btn btn-info"
                          >Add New Category</a
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
                              style="text-align:left; "
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
                              @click.prevent="change_sort('Cat_name')"
                              >Name</a
                            >
                            <span
                              v-if="
                                this.sort_field == 'Cat_name' &&
                                  this.sort_direction == 'asc'
                              "
                              @click.prevent="change_sort('Cat_name')"
                              ><CIcon name="cil-arrow-top" /></span
                            >
                            <span
                              v-if="
                                this.sort_field == 'Cat_name' &&
                                  this.sort_direction == 'desc'
                              "
                              @click.prevent="change_sort('Cat_name')"
                              ><CIcon name="cil-arrow-bottom" /></span
                            >
                          </div>
                        </th>
                        <th style="text-align:left;width:20%;">
                          <div style="text-align:left;">
                            <a
                              style="text-align:left;"
                              @click.prevent="change_sort('subject_id')"
                              >Subject</a
                            >
                            <span
                              v-if="
                                this.sort_field == 'subject_id' &&
                                  this.sort_direction == 'asc'
                              "
                              @click.prevent="change_sort('subject_id')"
                              ><CIcon name="cil-arrow-top" /></span
                            >
                            <span
                              v-if="
                                this.sort_field == 'subject_id' &&
                                  this.sort_direction == 'desc'
                              "
                              @click.prevent="change_sort('subject_id')"
                              ><CIcon name="cil-arrow-bottom" /></span
                            >
                          </div>
                        </th>
                        <th style="width:35%;">
                          <input
                            style="width:100%;"
                            type="search"
                            v-model="searchtext"
                            placeholder="search category"
                          />
                        </th>
                        <th style="width:15%;"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="category in categories.data"
                        v-bind:key="category.id"
                      >
                        <td>
                          <div style="word-wrap: break-word;">
                            {{ category.id }}
                          </div>
                        </td>
                        <td>
                          <div style="word-wrap: break-word;">
                            {{ category.Cat_name }}
                          </div>
                        </td>
                        <td>
                          <div
                            v-for="subject in subjects"
                            v-bind:key="subject.id"
                          >
                            <div
                              style="word-wrap: break-word;"
                              v-if="subject.id == category.subject_id"
                            >
                              {{ subject.Subject_name }}
                            </div>
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
                                v-on:click="editCategory(category)"
                                v-if="!edit && category.id != editfields.id"
                                class="btn btn-info"
                              >
                                Edit
                              </button>
                              <button
                                v-on:click="cancelEdit()"
                                v-if="category.id == editfields.id"
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
                                @click="deleteCategory(category)"
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
                    :data="categories"
                    @pagination-change-page="loadCategories"
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
      categories: [],
      permissions: [],
      subjects: [],
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
    this.loadCategories();
    this.loadSubjects();
    this.Permissions();
  },
  watch: {
    searchtext() {
      this.loadCategories();
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
      this.loadCategories();
    },
    loadCategories: function(page = 1) {
      axios
        .get(
          this.$apiAdress +
            "/api/category/getpage?page=" +
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
          this.categories = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    loadSubjects: function() {
      axios
        .get(
          this.$apiAdress +
            "/api/Subjects?token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.subjects = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    loadAfterAdd: function(page = 1) {
      axios
        .get(
          this.$apiAdress +
            "/api/category/getpage?page=" +
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
          this.categories = response.data;
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
            "/api/category/getpage?page=" +
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
          this.categories = response.data;
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
            "/api/category/getpage?page=" +
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
          this.categories = response.data;
          this.successadd = false;
          this.successedit = false;
          this.successdelete = true;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    addCategory() {
      this.add = true;
      this.successadd = false;
      this.successedit = false;
      this.successdelete = false;
    },
    cancelAdd() {
      this.add = false;
      this.fields = {};
      this.errors = {};
      this.loadCategories();
    },
    submit() {
      axios
        .post(
          this.$apiAdress +
            "/api/Category?token=" +
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
    editCategory(category) {
      this.edit = true;
      this.editfields = category;
      this.successadd = false;
      this.successedit = false;
      this.successdelete = false;
    },
    cancelEdit() {
      this.edit = false;
      this.editfields = {};
      this.loadCategories();
    },
    update() {
      axios
        .post(
          this.$apiAdress +
            "/api/categories/store1?token=" +
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
    deleteCategory(id) {
      axios
        .post(
          this.$apiAdress +
            "/api/categories/delete?token=" +
            localStorage.getItem("api_token"),
          id
        )
        .then((data) => {
          this.loadAfterDelete();
          this.loadSubjects();
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
