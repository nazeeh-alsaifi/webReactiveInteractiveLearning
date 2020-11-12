<template>
  <CRow>
    <CCol col="12" xl="6">
      <transition name="slide">
        <CCard>
          <CCardBody>
 <div class="container">
        <div class="alert alert-success" v-show="successadd">
            City Added Successfully.
        </div>
        <div class="alert alert-success" v-show="successedit">
            City Updated Successfully.
        </div>
        <div class="alert alert-success" v-show="successdelete">
            City Deleted Successfully.
        </div>
        <form @submit.prevent="submit" v-if="add">
            <div class="container">
                <h5>Add City:</h5>
                <hr />
                <div class="form-group row">
                    <label
                        for="city_name"
                        class="col-md-4 col-form-label text-md-right"
                        >City Name</label
                    >

                    <div class="col-md-6">
                        <input
                            id="city_name"
                            type="text"
                            class="form-control"
                            name="city_name"
                            minlength="3"
                            v-model="fields.city_name"
                            required
                            autofocus
                        />
                        <div
                            class="alert alert-danger"
                            v-if="errors && errors.city_name"
                        >
                            {{ errors.city_name[0] }}
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label
                        for="Country_id"
                        class="col-md-4 col-form-label text-md-right"
                        >Choose Country</label
                    >

                    <div class="col-md-6">
                        <select
                            class="form-control"
                            id="Country_id"
                            name="Country_id"
                            v-model="fields.Country_id"
                            required
                            autofocus
                        >
                            <option
                                v-for="country in countries"
                                v-bind:key="country.id"
                                :value="country.id"
                                >{{ country.country_name }}</option
                            >
                        </select>
                        <div
                            class="alert alert-danger"
                            v-if="errors && errors.Country_id"
                        >
                            {{ errors.Country_id[0] }}
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
        <div class="panel panel-default">
            <div class="panel-heading"><h1>Cities</h1></div>
            <div class="panel-body">
                <div style="text-align:left">
                    <div
                        style="display:inline-block"
                    >
                        <a v-on:click="addCity()" class="btn btn-info"
                            >Add New City</a
                        >
                    </div>
                </div>
                <hr>
                <table style="table-layout:fixed" class="table table-striped">
                    <thead>
                    <tr>
                        <th style="text-align:left;width:10%;">
                            <div style="text-align:left;">
                            <a style="text-align:left;" @click.prevent="change_sort('id')">Id</a>
                            <span v-if="this.sort_field=='id' && this.sort_direction=='asc'" @click.prevent="change_sort('id')"><i class="fa-fw select-all fas"></i></span>
                            <span v-if="this.sort_field=='id' && this.sort_direction=='desc'" @click.prevent="change_sort('id')"><i class="fa-fw select-all fas"></i></span>
                            </div>
                        </th>
                        <th style="text-align:left;width:20%;">
                            <div style="text-align:left;">
                            <a style="text-align:left;" @click.prevent="change_sort('city_name')">Name</a>
                            <span v-if="this.sort_field=='city_name' && this.sort_direction=='asc'" @click.prevent="change_sort('city_name')"><i class="fa-fw select-all fas"></i></span>
                            <span v-if="this.sort_field=='city_name' && this.sort_direction=='desc'" @click.prevent="change_sort('city_name')"><i class="fa-fw select-all fas"></i></span>
                            </div>
                        </th>
                        <th style="text-align:left;width:20%;">
                            <div style="text-align:left;">
                            <a style="text-align:left;" @click.prevent="change_sort('country_id')">Country</a>
                            <span v-if="this.sort_field=='country_id' && this.sort_direction=='asc'" @click.prevent="change_sort('country_id')"><i class="fa-fw select-all fas"></i></span>
                            <span v-if="this.sort_field=='country_id' && this.sort_direction=='desc'" @click.prevent="change_sort('country_id')"><i class="fa-fw select-all fas"></i></span>
                            </div>
                        </th>
                        <th style="width:40%;">
                            <input style="width:100%;" type="search" v-model="searchtext" placeholder="search city"/>
                        </th>
                        <th style="width:10%;"></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="city in cities.data" v-bind:key="city.id">
                            <td>
                                <div style="word-wrap: break-word;">
                                   {{ city.id }}
                                </div>
                            </td>
                            <td>
                               <div style="word-wrap: break-word;">
                                  {{city.city_name}}
                               </div>
                            </td>
                            <td>
                                <div
                                    v-for="country in countries"
                                    v-bind:key="country.id"
                                >
                                    <div
                                        style="word-wrap: break-word;"
                                        v-if="country.id == city.country_id"
                                    >
                                    {{ country.country_name }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <a
                                        v-on:click="editCity(city)"
                                        v-if="!edit && city.id != editfields.id"
                                        class="btn btn-info"
                                        >Edit</a
                                    >
                                    <button
                                        v-on:click="cancelEdit()"
                                        v-if="city.id == editfields.id"
                                        class="btn btn-outline-danger"
                                    >
                                        Cancel Edit
                                    </button>
                                </div>
                                <form
                                    @submit.prevent="update"
                                    v-if="edit && city.id == editfields.id"
                                >
                                    <div class="container">
                                        <div class="form-group row">
                                            <label
                                                for="city_name"
                                                class="col-md-4 col-form-label text-md-right"
                                                >City Name</label
                                            >

                                            <div class="col-md-6">
                                                <input
                                                    id="city_name"
                                                    type="text"
                                                    class="form-control"
                                                    name="city_name"
                                                    minlength="3"
                                                    v-model="
                                                        editfields.city_name
                                                    "
                                                    required
                                                    autofocus
                                                />
                                                <div
                                                    class="alert alert-danger"
                                                    v-if="errors &&errors.city_name"
                                                >
                                                    {{ errors.city_name[0] }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label
                                                for="country_id"
                                                class="col-md-4 col-form-label text-md-right"
                                                >Choose Country</label
                                            >

                                            <div class="col-md-6">
                                                <select
                                                    class="form-control"
                                                    id="country_id"
                                                    name="country_id"
                                                    v-model="editfields.country_id"
                                                    required
                                                    autofocus
                                                >
                                                    <option
                                                        v-for="country in countries"
                                                        v-bind:key="country.id"
                                                        :value="country.id"
                                                        >
                                                        {{country.country_name}}
                                                        </option
                                                    >
                                                </select>
                                                <div
                                                    class="alert alert-danger"
                                                    v-if="errors && errors.country_id"
                                                >
                                                    {{ errors.country_id[0] }}
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
                                    style="display:inline-block"
                                >
                                    <button
                                        @click="deleteCity(city.id)"
                                        class="btn btn-danger"
                                    >
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <hr />
                    </tbody>
                </table>
                <pagination :data="cities" @pagination-change-page="loadCities"></pagination>
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
            cities: [],
            countries: [],
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
        this.loadCities();
        this.loadCountries();
    },
     watch:{
        searchtext(){
             this.loadCities();
        }
    },
    methods: {
        change_sort(field){
            if(this.sort_field === field)
            {
                this.sort_direction =  this.sort_direction === 'asc' ? 'desc' : 'asc' ;
            }else{
                this.sort_field = field;
                this.sort_direction = 'asc';
            }
           this.loadCities();
        },
        loadCities: function(page = 1) {
            axios
                .get(this.$apiAdress +'/api/city/getpage?page=' + page
                + '&search=' + this.searchtext
                + '&sort_field=' + this.sort_field
                + '&sort_direction=' + this.sort_direction)
                .then(response => {
                    this.cities = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },

        loadCountries: function() {
            axios
                .get(this.$apiAdress +"/api/Countries")
                .then(response => {
                    this.countries = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        loadAfterAdd: function(page = 1) {
            axios
                .get(this.$apiAdress +'/api/city/getpage?page=' + page
                + '&search=' + this.searchtext
                + '&sort_field=' + this.sort_field
                + '&sort_direction=' + this.sort_direction)
                .then(response => {
                    this.cities = response.data;
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
                .get(this.$apiAdress +'/api/city/getpage?page=' + page
                + '&search=' + this.searchtext
                + '&sort_field=' + this.sort_field
                + '&sort_direction=' + this.sort_direction)
                .then(response => {
                    this.cities = response.data;
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
                .get(this.$apiAdress +'/api/city/getpage?page=' + page
                + '&search=' + this.searchtext
                + '&sort_field=' + this.sort_field
                + '&sort_direction=' + this.sort_direction)
                .then(response => {
                    this.cities = response.data;
                    this.successadd = false;
                    this.successedit = false;
                    this.successdelete = true;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        addCity() {
            this.add = true;
            this.successadd = false;
            this.successedit = false;
            this.successdelete = false;
        },
        cancelAdd() {
            this.add = false;
            this.fields = {};
            this.errors = {};
            this.loadCities();
        },
        submit() {
            axios
                .post(this.$apiAdress +"/api/Cities", this.fields)
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
        editCity(city) {
            this.edit = true;
            this.editfields = city;
            this.successadd = false;
            this.successedit = false;
            this.successdelete = false;
        },
        cancelEdit() {
            this.edit = false;
            this.editfields = {};
            this.loadCities();
        },
        update() {
            axios
                .post(this.$apiAdress +"/api/cities/store1", this.editfields)
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
        deleteCity(id) {
            axios
                .delete(this.$apiAdress +"/api/Cities/" + id)
                .then(data => {
                    this.loadAfterDelete();
                    this.loadCountries();
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