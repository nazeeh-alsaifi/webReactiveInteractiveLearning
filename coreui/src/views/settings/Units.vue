<template>
  <CRow>
    <CCol col="12" xl="6">
      <transition name="slide">
        <CCard>
          <CCardBody>
    <div class="container">
        <div class="panel panel-default">
            <div class="alert alert-success" v-show="successadd">
                Unit Added Successfully.
            </div>
            <div class="alert alert-success" v-show="successedit">
                Unit Updated Successfully.
            </div>
            <div class="alert alert-success" v-show="successdelete">
                Unit Deleted Successfully.
            </div>
            <form @submit.prevent="submit" v-if="add">
                <div class="container">
                    <h5>Add Unit:</h5>
                    <hr />
                    <div class="form-group row">
                        <label
                            for="unit_name"
                            class="col-md-4 col-form-label text-md-right"
                            >Unit Name</label
                        >

                        <div class="col-md-6">
                            <input
                                id="unit_name"
                                type="text"
                                class="form-control"
                                name="unit_name"
                                v-model="fields.unit_name"
                                required
                                autofocus
                            />
                            <div
                                class="alert alert-danger"
                                v-if="errors && errors.unit_name"
                            >
                                {{ errors.unit_name[0] }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label
                            for="Sample_unit"
                            class="col-md-4 col-form-label text-md-right"
                            >Sample Unit</label
                        >

                        <div class="col-md-6">
                            <input
                                id="Sample_unit"
                                type="text"
                                class="form-control"
                                name="Sample_unit"
                                v-model="fields.Sample_unit"
                                required
                                autofocus
                            />
                            <div
                                class="alert alert-danger"
                                v-if="errors && errors.Sample_unit"
                            >
                                {{ errors.Sample_unit[0] }}
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
            <div class="panel-heading"><h1>Units</h1></div>
            <div class="panel-body">
                <div style="text-align:left">
                    <div
                        style="display:inline-block"
                        v-for="permission in permissions" v-bind:key="permission.id"
                    >
                    <div v-if="permission.permission =='add Settings'">
                        <a v-on:click="addUnit()" class="btn btn-info"
                            >Add New Unit</a
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
                            <a style="text-align:left;" @click.prevent="change_sort('unit_name')">Name</a>
                            <span v-if="this.sort_field=='unit_name' && this.sort_direction=='asc'" @click.prevent="change_sort('unit_name')"><i class="fa-fw select-all fas"></i></span>
                            <span v-if="this.sort_field=='unit_name' && this.sort_direction=='desc'" @click.prevent="change_sort('unit_name')"><i class="fa-fw select-all fas"></i></span>
                            </div>
                        </th>
                        <th style="text-align:left; width:25%;">
                            <div style="text-align:left;">
                            <a style="text-align:left;" @click.prevent="change_sort('Sample_unit')">Sample</a>
                            <span v-if="this.sort_field=='Sample_unit' && this.sort_direction=='asc'" @click.prevent="change_sort('Sample_unit')"><i class="fa-fw select-all fas"></i></span>
                            <span v-if="this.sort_field=='Sample_unit' && this.sort_direction=='desc'" @click.prevent="change_sort('Sample_unit')"><i class="fa-fw select-all fas"></i></span>
                            </div>
                        </th>
                        <th style="width:30%;">
                            <input style="width:100%;" type="search" v-model="searchtext" placeholder="search Unit"/>
                        </th>
                        <th style="width:10%;">
                             <a>COL</a>
                            <select style="width:12%;" class="btn btn-info" v-model="column">
                                <option class="form-control" :value="'unit_name'">Unit Name</option>
                                <option class="form-control" :value="'Sample_unit'">Sample Unit</option>
                            </select>
                        </th>
                    </tr>
                     </thead>
                    <tbody>
                        <tr  v-for="unit in units.data" v-bind:key="unit.id">
                            <td>
                                <div style="word-wrap: break-word;">
                                   {{unit.id}}
                                </div>
                            </td>
                            <td>
                                <div style="word-wrap: break-word;">
                                    {{unit.unit_name}}
                                </div>
                            </td>
                            <td>
                                <div style="word-wrap: break-word;">
                                  {{unit.Sample_unit}}
                                </div>
                            </td>
                            <td>
                                <div v-for="permission in permissions" v-bind:key="permission.id">
                                    <div v-if="permission.permission =='edit Settings'">
                                    <button
                                        v-on:click="editUnit(unit)"
                                        v-if="!edit && unit.id != editfields.id"
                                        class="btn btn-info"
                                    >
                                        Edit
                                    </button>
                                    <button
                                        v-on:click="cancelEdit()"
                                        v-if="unit.id == editfields.id"
                                        class="btn btn-outline-danger"
                                    >
                                        Cancel Edit
                                    </button>
                                    </div>
                                </div>
                                <form
                                    @submit.prevent="update"
                                    v-if="edit && unit.id == editfields.id"
                                >
                                    <div class="container">
                                        <div class="form-group row">
                                            <label
                                                for="unit_name"
                                                class="col-md-4 col-form-label text-md-right"
                                                >Unit Name</label
                                            >
                                            <hr />

                                            <div class="col-md-6">
                                                <input
                                                    id="unit_name"
                                                    type="text"
                                                    class="form-control"
                                                    name="unit_name"
                                                    v-model="
                                                        editfields.unit_name
                                                    "
                                                    required
                                                    autofocus
                                                />
                                                <div
                                                    class="alert alert-danger"
                                                    v-if="
                                                        errors &&
                                                            errors.unit_name
                                                    "
                                                >
                                                    {{ errors.unit_name[0] }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label
                                                for="Sample_unit"
                                                class="col-md-4 col-form-label text-md-right"
                                                >Sample Unit</label
                                            >
                                            <hr />

                                            <div class="col-md-6">
                                                <input
                                                    id="Sample_unit"
                                                    type="text"
                                                    class="form-control"
                                                    name="Sample_unit"
                                                    v-model="
                                                        editfields.Sample_unit
                                                    "
                                                    required
                                                    autofocus
                                                />
                                                <div
                                                    class="alert alert-danger"
                                                    v-if="
                                                        errors &&
                                                            errors.Sample_unit
                                                    "
                                                >
                                                    {{ errors.Sample_unit[0] }}
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
                                        @click="deleteUnit(unit)"
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
                 <pagination :data="units" @pagination-change-page="loadUnits"></pagination>
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
            units: [],
            permissions: [],
            successadd: false,
            successedit: false,
            successdelete: false,
            fields: {},
            editfields: {},
            edit: false,
            add: false,
            searchtext: '',
            column:'unit_name',
            errors: [],
            sort_field: 'id',
            sort_direction: 'desc',
        };
    },
    mounted() {
        this.loadUnits();
        this.Permissions();
    },
    watch:{
        searchtext(){
             this.loadUnits();
        },
        column(){
            this.loadUnits();
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
        change_sort(field){
            if(this.sort_field === field)
            {
                this.sort_direction =  this.sort_direction === 'asc' ? 'desc' : 'asc' ;
            }else{
                this.sort_field = field;
                this.sort_direction = 'asc';
            }
           this.loadUnits();
        },
        loadUnits: function(page =1) {
            axios
                .get(this.$apiAdress +'/api/unit/getpage?page=' + page
                 + '&search=' + this.searchtext
                + '&sort_field=' + this.sort_field
                + '&sort_direction=' + this.sort_direction
                 + '&column=' + this.column
                 +'&token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.units = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        loadAfterAdd: function(page = 1) {
            axios
                .get(this.$apiAdress +'/api/unit/getpage?page=' + page
                 + '&search=' + this.searchtext
                + '&sort_field=' + this.sort_field
                + '&sort_direction=' + this.sort_direction
                 + '&column=' + this.column
                 +'&token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.units = response.data;
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
                .get(this.$apiAdress +'/api/unit/getpage?page=' + page
                 + '&search=' + this.searchtext
                + '&sort_field=' + this.sort_field
                + '&sort_direction=' + this.sort_direction
                 + '&column=' + this.column
                 +'&token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.units = response.data;
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
                .get(this.$apiAdress +'/api/unit/getpage?page=' + page
                 + '&search=' + this.searchtext
                + '&sort_field=' + this.sort_field
                + '&sort_direction=' + this.sort_direction
                 + '&column=' + this.column
                 +'&token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.units = response.data;
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
            this.loadUnits();
        },
        submit() {
            axios
                .post(this.$apiAdress +'/api/Unit?token='+ localStorage.getItem("api_token"), this.fields)
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
        editUnit(unit) {
            this.edit = true;
            this.editfields = unit;
            this.successadd = false;
            this.successedit = false;
            this.successdelete = false;
        },
        cancelEdit() {
            this.edit = false;
            this.editfields = {};
            this.loadUnits();
        },
        update() {
            axios
                .post(this.$apiAdress +'/api/units/store1?token='+ localStorage.getItem("api_token"), this.editfields)
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
        deleteUnit(id) {
            axios
                .post(this.$apiAdress +'/api/units/delete?token='+ localStorage.getItem("api_token"), id)
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