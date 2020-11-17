<template>
  <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
        <CCard>
          <CCardBody>
    <div class="container">
        <div class="panel panel-default">
            <div class="alert alert-success" v-show="successadd">
                Sub_Category Added Successfully.
            </div>
            <div class="alert alert-success" v-show="successedit">
                Sub_Category Updated Successfully.
            </div>
            <div class="alert alert-success" v-show="successdelete">
                Sub_Category Deleted Successfully.
            </div>
            <form @submit.prevent="submit" v-if="add">
                <div class="container">
                    <h5>Add Sub_Category:</h5>
                    <hr />
                    <div class="form-group row">
                        <label
                            for="sub_ct_name"
                            class="col-md-4 col-form-label text-md-right"
                            >Sub_Category Name</label
                        >
                        <div class="col-md-6">
                            <input
                                id="sub_ct_name"
                                type="text"
                                minlength="3"
                                class="form-control"
                                name="sub_ct_name"
                                v-model="fields.sub_ct_name"
                                required
                                autofocus
                            />
                            <div
                                class="alert alert-danger"
                                v-if="errors && errors.sub_ct_name"
                            >
                                {{ errors.sub_ct_name[0] }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            for="Id_cat"
                            class="col-md-4 col-form-label text-md-right"
                            >Choose Category</label
                        >

                        <div class="col-md-6">
                            <select
                                class="form-control"
                                id="Id_cat"
                                name="Id_cat"
                                v-model="fields.Id_cat"
                                required
                                autofocus
                            >
                                <option
                                    v-for="category in categories"
                                    v-bind:key="category.id"
                                    :value="category.id"
                                    >{{ category.Cat_name }}</option
                                >
                            </select>
                            <div
                                class="alert alert-danger"
                                v-if="errors && errors.Id_cat"
                            >
                                {{ errors.Id_cat[0] }}
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
            <div class="panel-heading"><h1>Sub_Category</h1></div>
            <div class="panel-body">
                <div style="text-align:left">
                    <div
                        style="display:inline-block"
                        v-for="permission in permissions" v-bind:key="permission.id"
                    >
                    <div v-if="permission.permission =='add Settings'">
                        <a v-on:click="addSub()" class="btn btn-info"
                            >Add New Sub_Category</a
                        >
                    </div>
                    </div>
                </div>
                <hr>
                <table style="table-layout:fixed" class="table table-striped">
                    <thead >
                    <tr>
                        <th style="text-align:left; width:10%;">
                            <div style="text-align:left;">
                            <a style="text-align:left;" @click.prevent="change_sort('id')">Id</a>
                            <span v-if="this.sort_field=='id' && this.sort_direction=='asc'" @click.prevent="change_sort('id')"><i class="fa-fw select-all fas"></i></span>
                            <span v-if="this.sort_field=='id' && this.sort_direction=='desc'" @click.prevent="change_sort('id')"><i class="fa-fw select-all fas"></i></span>
                            </div>
                        </th>
                        <th style="text-align:left; width:25%;">
                            <div style="text-align:left;">
                            <a style="text-align:left;" @click.prevent="change_sort('sub_cat_name')">Name</a>
                            <span v-if="this.sort_field=='sub_cat_name' && this.sort_direction=='asc'" @click.prevent="change_sort('sub_cat_name')"><i class="fa-fw select-all fas"></i></span>
                            <span v-if="this.sort_field=='sub_cat_name' && this.sort_direction=='desc'" @click.prevent="change_sort('sub_cat_name')"><i class="fa-fw select-all fas"></i></span>
                            </div>
                        </th>
                        <th style="text-align:left;width:25%;">
                            <div style="text-align:left;">
                            <a style="text-align:left;;" @click.prevent="change_sort('category_id')">Category</a>
                            <span v-if="this.sort_field=='category_id' && this.sort_direction=='asc'" @click.prevent="change_sort('category_id')"><i class="fa-fw select-all fas"></i></span>
                            <span v-if="this.sort_field=='category_id' && this.sort_direction=='desc'" @click.prevent="change_sort('category_id')"><i class="fa-fw select-all fas"></i></span>
                            </div>
                        </th>
                        <th style="width:30%;">
                            <input style="width:100%;" type="search" v-model="searchtext" placeholder="search sub category"/>
                        </th>
                        <th style="width:10%;"></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="sub_category in sub_categories.data" v-bind:key="sub_category.id">
                            <td>
                                <div style="word-wrap: break-word;">
                                   {{ sub_category.id }}
                                </div>
                            </td>

                            <td>
                                <div style="word-wrap: break-word;">
                                  {{ sub_category.sub_cat_name }}
                                </div>
                            </td>
                            <td>
                                <div
                                    v-for="category in categories"
                                    v-bind:key="category.id"
                                >
                                    <div
                                        style="word-wrap: break-word;"
                                        v-if="
                                            category.id == sub_category.category_id
                                        "
                                    >
                                    {{ category.Cat_name }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div  v-for="permission in permissions" v-bind:key="permission.id">
                                    <div v-if="permission.permission =='edit Settings'">
                                    <button
                                        v-on:click="editSub(sub_category)"
                                        v-if="
                                            !edit &&
                                                sub_category.id != editfields.id
                                        "
                                        class="btn btn-info"
                                    >
                                        Edit
                                    </button>
                                    <button
                                        v-on:click="cancelEdit()"
                                        v-if="sub_category.id == editfields.id"
                                        class="btn btn-outline-danger"
                                    >
                                        Cancel Edit
                                    </button>
                                    </div>
                                </div>
                                <form
                                    @submit.prevent="update"
                                    v-if="
                                        edit && sub_category.id == editfields.id
                                    "
                                >
                                    <div class="container">
                                        <div class="form-group row">
                                            <label
                                                for="sub_cat_name"
                                                class="col-md-4 col-form-label text-md-right"
                                                >Sub_Category Name</label
                                            >

                                            <div class="col-md-6">
                                                <input
                                                    id="sub_cat_name"
                                                    type="text"
                                                    minlength="3"
                                                    class="form-control"
                                                    name="sub_cat_name"
                                                    v-model="
                                                        editfields.sub_cat_name
                                                    "
                                                    required
                                                    autofocus
                                                />
                                                <div
                                                    class="alert alert-danger"
                                                    v-if="
                                                        errors &&
                                                            errors.sub_cat_name
                                                    "
                                                >
                                                    {{ errors.sub_cat_name[0] }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label
                                                for="category_id"
                                                class="col-md-4 col-form-label text-md-right"
                                                >Choose Category</label
                                            >

                                            <div class="col-md-6">
                                                <select
                                                    class="form-control"
                                                    id="category_id"
                                                    name="category_id"
                                                    v-model="editfields.category_id"
                                                >
                                                    <option
                                                        v-for="category in categories"
                                                        v-bind:key="category.id"
                                                        :value="category.id"
                                                        >{{
                                                            category.Cat_name
                                                        }}</option
                                                    >
                                                </select>
                                                <div
                                                    class="alert alert-danger"
                                                    v-if="
                                                        errors && errors.category_id
                                                    "
                                                >
                                                    {{ errors.category_id[0] }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <div class="col-md-8 offset-md-4">
                                                <button
                                                    type="submit"
                                                    class="btn btn-outline-primary"
                                                >
                                                    Update
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <div
                                     v-for="permission in permissions" v-bind:key="permission.id"
                                >
                                <div v-if="permission.permission =='delete Settings'">
                                    <button
                                        @click="
                                            deleteSubCategory(sub_category)
                                        "
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
                <pagination :data="sub_categories" @pagination-change-page="loadSubCategories"></pagination>
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
import axios from 'axios'
export default {
   data: function() {
        return {
            sub_categories: [],
            categories: [],
            permissions: [],
            successadd: false,
            successedit: false,
            successdelete: false,
            fields: {},
            editfields: {},
            edit: false,
            add: false,
            searchtext: '',
            errors: [],
            sort_field: 'id',
            sort_direction: 'desc',
        };
    },
    mounted() {
        this.loadCategories();
        this.loadSubCategories();
        this.Permissions();
    },
    watch:{
        searchtext(){
             this.loadSubCategories();
        }
    },
    methods: {
          Permissions(){
                axios
                .get(this.$apiAdress +'/api/user/getUserPermissions?token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.permissions = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        loadCategories: function() {
            axios
                .get(this.$apiAdress +'/api/Category?token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.categories = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        change_sort(field){
            if(this.sort_field === field)
            {
                this.sort_direction =  this.sort_direction === 'asc' ? 'desc' : 'asc' ;
            }else{
                this.sort_field = field;
                this.sort_direction = 'asc';
            }
           this.loadSubCategories();
        },
        loadSubCategories: function(page = 1) {
            axios
                .get(this.$apiAdress +'/api/subCategory/getpage?page=' + page
                + '&search=' + this.searchtext
                + '&sort_field=' + this.sort_field
                + '&sort_direction=' + this.sort_direction
                +'&token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.sub_categories = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        loadAfterAdd: function(page = 1) {
            axios
                .get(this.$apiAdress +'/api/subCategory/getpage?page=' + page
                + '&search=' + this.searchtext
                + '&sort_field=' + this.sort_field
                + '&sort_direction=' + this.sort_direction
                +'&token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.sub_categories = response.data;
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
               .get(this.$apiAdress +'/api/subCategory/getpage?page=' + page
               + '&search=' + this.searchtext
                + '&sort_field=' + this.sort_field
                + '&sort_direction=' + this.sort_direction
                +'&token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.sub_categories = response.data;
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
                .get(this.$apiAdress +'/api/subCategory/getpage?page=' + page
                + '&search=' + this.searchtext
                + '&sort_field=' + this.sort_field
                + '&sort_direction=' + this.sort_direction
                +'&token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.sub_categories = response.data;
                    this.successadd = false;
                    this.successedit = false;
                    this.successdelete = true;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        addSub() {
            this.add = true;
            this.successadd = false;
            this.successedit = false;
            this.successdelete = false;
        },
        cancelAdd() {
            this.add = false;
            this.fields = {};
            this.errors = {};
            this.loadSubCategories();
        },
        submit() {
            axios
                .post(this.$apiAdress +'/api/SubCategory?token='+ localStorage.getItem("api_token"), this.fields)
                .then(response => {
                    this.fields = {};
                    this.success = true;
                    this.add = false;
                    this.loadAfterAdd();
                    this.errors = {};
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                    console.log("Error");
                });
        },
        editSub(subcateg) {
            this.edit = true;
            this.editfields = subcateg;
            this.successadd = false;
            this.successedit = false;
            this.successdelete = false;
        },
        cancelEdit() {
            this.edit = false;
            this.editfields = {};
            this.loadSubCategories();
        },
        update() {
            axios
                .post(this.$apiAdress +'/api/subCategories/store1?token='+ localStorage.getItem("api_token"), this.editfields)
                .then(response => {
                    this.editfields = {};
                    this.edit = false;
                    this.successedit = true;
                    this.errors = {};
                    this.loadAfterEdit();
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                    console.log("Error");
                });
        },
        deleteSubCategory(id) {
            axios
                .post(this.$apiAdress +'/api/subCategories/delete?token='+ localStorage.getItem("api_token"), id)
                .then(data => {
                    this.loadAfterDelete();
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    }
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
  border-top: 2px solid rgba(99,99,99,0.5);;
  border-bottom: 2px solid rgba(99,99,99,0.5);;
}

table th:first-child{
  /* Apply a left border on the first <td> or <th> in a row */
  border-left: 2px solid rgba(99,99,99,0.5);;
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
}
table th:last-child{
  /* Apply a left border on the first <td> or <th> in a row */
  border-right: 2px solid rgba(99,99,99,0.5);;
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