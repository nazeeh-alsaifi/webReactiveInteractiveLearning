<template>
  <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
        <CCard>
          <CCardBody>
        <div class="container">
        <div class="alert alert-success" v-show="successadd">
            Employee Added Successfully.
        </div>
        <div class="alert alert-success" v-show="successedit">
            Employee Updated Successfully.
        </div>
        <div class="alert alert-success" v-show="successdelete">
            Employee Deleted Successfully.
        </div>
        <form @submit.prevent="submit" v-if="add">
            <div class="container">
                <h5>Add Employee:</h5>
                <hr />
                <div class="form-group row">
                    <label
                        for="First_Name"
                        class="col-md-4 col-form-label text-md-right"
                        >First_Name</label
                    >
                    <div class="col-md-6">
                        <input
                            id="First_Name"
                            type="text"
                            class="form-control"
                            name="First_Name"
                            minlength="3"
                            v-model="fields.First_Name"
                            required
                            autofocus
                        />
                        <div
                            class="alert alert-danger"
                            v-if="errors && errors.First_Name"
                        >
                            {{ errors.First_Name[0] }}
                        </div>
                    </div>
                </div>
                 <div class="form-group row">
                    <label
                        for="Last_Name"
                        class="col-md-4 col-form-label text-md-right"
                        >Last_Name</label
                    >
                    <div class="col-md-6">
                        <input
                            id="Last_Name"
                            type="text"
                            class="form-control"
                            name="Last_Name"
                            minlength="3"
                            v-model="fields.Last_Name"
                            required
                            autofocus
                        />
                        <div
                            class="alert alert-danger"
                            v-if="errors && errors.Last_Name"
                        >
                            {{ errors.Last_Name[0] }}
                        </div>
                    </div>
                </div>

                 <div class="form-group row">
                    <label
                        for="Mobile"
                        class="col-md-4 col-form-label text-md-right"
                        >Mobile</label
                    >
                    <div class="col-md-6">
                        <input
                            id="Mobile"
                            type="tel"
                            pattern="[0]{1}[0-9]{9,12}"
                            class="form-control"
                            name="Mobile"

                            v-model="fields.Mobile"
                            autocomplete="tel"
                            required
                            autofocus
                        />
                        <div
                            class="alert alert-danger"
                            v-if="errors && errors.Mobile"
                        >
                            {{ errors.Mobile[0] }}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label
                        for="Email"
                        class="col-md-4 col-form-label text-md-right"
                        >Email</label
                    >
                    <div class="col-md-6">
                        <input
                            id="Email"
                            type="email"
                            class="form-control"
                            name="Email"
                            v-model="fields.Email"
                            required
                            autocomplete="email"
                            autofocus
                        />
                        <div
                            class="alert alert-danger"
                            v-if="errors && errors.Email"
                        >
                            {{ errors.Email[0] }}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                <label for="Gender" class="col-md-4 col-form-label text-md-right">Gender</label>
                <div class="col-md-6">
                <select class="form-control" id="Gender" name="Gender"
                    v-model="fields.Gender" required autofocus>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <div class="alert alert-danger" v-if="errors && errors.Gender">
                    {{ errors.Gender[0] }}
                </div>
                </div>
                </div>
                <div class="form-group row">
                <label for="Role" class="col-md-4 col-form-label text-md-right">Role</label>
                <div class="col-md-6">
                <select class="form-control" id="Role" name="Role"
                    v-model="fields.Role" required autofocus>
                    <option value="admin">Admin</option>
                    <option value="editor">Editor</option>
                </select>
                <div class="alert alert-danger" v-if="errors && errors.Role">
                    {{ errors.Role[0] }}
                </div>
                </div>
                </div>
                <div class="form-group row">
                <label for="country_id" class="col-md-4 col-form-label text-md-right">Choose Country</label>
                <div class="col-md-6">
                <select class="form-control" id="country_id" name="country_id" v-model="fields.country_id" required autofocus>
                     <option v-for="country in countries" v-bind:key="country.id" :value="country.id">{{ country.country_name }}</option>
                </select>
                <div class="alert alert-danger" v-if="errors && errors.country_id">
                    {{ errors.country_id[0] }}
                </div>
                </div>
                </div>

                <div class="form-group row">
                <label for="city_id" class="col-md-4 col-form-label text-md-right">Choose City</label>
                <div class="col-md-6">
                <select class="form-control" id="city_id" name="city_id" v-model="fields.city_id" required autofocus>
                     <option v-for="city in filteredCities" v-bind:key="city.id" :value="city.id">{{ city.city_name }}</option>
                </select>
                <div class="alert alert-danger" v-if="errors && errors.city_id">
                    {{ errors.city_id[0] }}
                </div>
                </div>
                </div>
                <div class="form-group row">
                    <label
                        for="birth_date"
                        class="col-md-4 col-form-label text-md-right"
                        >Date Of Birth</label
                    >
                    <div class="col-md-6">
                        <input
                            id="birth_date"
                            type="date"
                            class="form-control"
                            name="birth_date"
                            v-model="fields.birth_date"
                            required
                            autofocus
                        />
                        <div
                            class="alert alert-danger"
                            v-if="errors && errors.birth_date"
                        >
                            {{ errors.birth_date[0] }}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label
                        for="jop_date"
                        class="col-md-4 col-form-label text-md-right"
                        >Jop Date</label
                    >
                    <div class="col-md-6">
                        <input
                            id="jop_date"
                            type="date"
                            class="form-control"
                            name="jop_date"
                            v-model="fields.jop_date"
                            required
                            autofocus
                        />
                        <div
                            class="alert alert-danger"
                            v-if="errors && errors.jop_date"
                        >
                            {{ errors.jop_date[0] }}
                        </div>
                    </div>
                </div>
                 <div class="form-group row">
                    <label
                        for="Address"
                        class="col-md-4 col-form-label text-md-right"
                        >Address1</label
                    >
                    <div class="col-md-6">
                        <input
                            id="Address"
                            type="text"
                            class="form-control"
                            name="Address"
                            v-model="fields.Address"
                            required
                            autofocus
                        />
                        <div
                            class="alert alert-danger"
                            v-if="errors && errors.Address"
                        >
                            {{ errors.Address[0] }}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label
                        for="Address1"
                        class="col-md-4 col-form-label text-md-right"
                        >Address2</label
                    >
                    <div class="col-md-6">
                        <input
                            id="Address1"
                            type="text"
                            class="form-control"
                            name="Address1"
                            v-model="fields.Address1"
                            required
                            autofocus
                        />
                        <div
                            class="alert alert-danger"
                            v-if="errors && errors.Address1"
                        >
                            {{ errors.Address1[0] }}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                        <label
                            for="password"
                            class="col-md-4 col-form-label text-md-right"
                            >Password</label
                        >

                        <div class="col-md-6" v-if="!passwordshow">
                            <input
                                id="password"
                                type="password"
                                class="form-control"
                                name="password"
                                pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
                                v-model="fields.password"
                                required
                                autofocus
                            />
                            <a class="btn btn-info" v-on:click="showpass()"
                                >show</a
                            >
                            <div
                                class="alert alert-danger"
                                v-if="errors && errors.password"
                            >
                                {{ errors.password[0] }}
                            </div>
                            <button
                                v-if="!addgeneratepass"
                                v-on:click="genratePassAdd()"
                                class="btn btn-outline-info"
                            >
                                Auto Generate
                            </button>
                        </div>
                        <div class="col-md-6" v-if="passwordshow">
                            <input
                                id="password"
                                type="text"
                                class="form-control"
                                name="password"
                                pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
                                v-model="fields.password"
                                required
                                autofocus
                            />
                            <a class="btn btn-info" v-on:click="hidepass()"
                                >hide</a
                            >
                            <div
                                class="alert alert-danger"
                                v-if="errors && errors.password"
                            >
                                {{ errors.password[0] }}
                            </div>
                            <button
                                v-if="!addgeneratepass"
                                v-on:click="genratePassAdd()"
                                class="btn btn-outline-info"
                            >
                                Auto Generate
                            </button>
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
                <div class="form-group row">
                    <label
                        for="First_Name"
                        class="col-md-4 col-form-label text-md-right"
                        >First_Name</label
                    >
                    <div class="col-md-6">
                        <input
                            id="First_Name"
                            type="text"
                            minlength="3"
                            class="form-control"
                            name="First_Name"
                            v-model="editfields.First_Name"
                            required
                            autofocus
                        />
                        <div
                            class="alert alert-danger"
                            v-if="errors && errors.First_Name"
                        >
                            {{ errors.First_Name[0] }}
                        </div>
                    </div>
                </div>
                 <div class="form-group row">
                    <label
                        for="Last_Name"
                        class="col-md-4 col-form-label text-md-right"
                        >Last_Name</label
                    >
                    <div class="col-md-6">
                        <input
                            id="Last_Name"
                            type="text"
                            minlength="3"
                            class="form-control"
                            name="Last_Name"
                            v-model="editfields.Last_Name"
                            required
                            autofocus
                        />
                        <div
                            class="alert alert-danger"
                            v-if="errors && errors.Last_Name"
                        >
                            {{ errors.Last_Name[0] }}
                        </div>
                    </div>
                </div>

                 <div class="form-group row">
                    <label
                        for="Mobile"
                        class="col-md-4 col-form-label text-md-right"
                        >Mobile</label
                    >
                    <div class="col-md-6">
                        <input
                            id="Mobile"
                            type="tel"
                            class="form-control"
                            pattern="[0]{1}[0-9]{9,12}"
                            name="Mobile"
                            v-model="editfields.Mobile"
                            required
                            autofocus
                        />
                        <div
                            class="alert alert-danger"
                            v-if="errors && errors.Mobile"
                        >
                            {{ errors.Mobile[0] }}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                <label for="Gender" class="col-md-4 col-form-label text-md-right">Gender</label>
                <div class="col-md-6">
                <select class="form-control" id="Gender" name="Gender"
                    v-model="editfields.Gender" required autofocus>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <div class="alert alert-danger" v-if="errors && errors.Gender">
                    {{ errors.Gender[0] }}
                </div>
                </div>
                </div>
                <div class="form-group row">
                <label for="Role" class="col-md-4 col-form-label text-md-right">Role</label>
                <div class="col-md-6">
                <select class="form-control" id="Role" name="Role"
                    v-model="editfields.Role" required autofocus>
                    <option value="admin">Admin</option>
                    <option value="editor">Editor</option>
                </select>
                <div class="alert alert-danger" v-if="errors && errors.Role">
                    {{ errors.Role[0] }}
                </div>
                </div>
                </div>
                <div class="form-group row">
                <label for="country_id" class="col-md-4 col-form-label text-md-right">Choose Country</label>
                <div class="col-md-6">
                <select class="form-control" id="country_id" name="country_id" v-model="editfields.country_id" required autofocus>
                     <option v-for="country in countries" v-bind:key="country.id" :value="country.id">{{ country.country_name }}</option>
                </select>
                <div class="alert alert-danger" v-if="errors && errors.country_id">
                    {{ errors.country_id[0] }}
                </div>
                </div>
                </div>

                <div class="form-group row">
                <label for="city_id" class="col-md-4 col-form-label text-md-right">Choose City</label>
                <div class="col-md-6">
                <select class="form-control" id="city_id" name="city_id" v-model="editfields.city_id" required autofocus>
                     <option v-for="city in filterededitCities" v-bind:key="city.id" :value="city.id">{{ city.city_name }}</option>
                </select>
                <div class="alert alert-danger" v-if="errors && errors.city_id">
                    {{ errors.city_id[0] }}
                </div>
                </div>
                </div>
                <div class="form-group row">
                    <label
                        for="birth_date"
                        class="col-md-4 col-form-label text-md-right"
                        >Date Of Birth</label
                    >
                    <div class="col-md-6">
                        <input
                            id="birth_date"
                            type="date"
                            class="form-control"
                            name="birth_date"
                            v-model="editfields.birth_date"
                            required
                            autofocus
                        />
                        <div
                            class="alert alert-danger"
                            v-if="errors && errors.birth_date"
                        >
                            {{ errors.birth_date[0] }}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label
                        for="jop_date"
                        class="col-md-4 col-form-label text-md-right"
                        >Jop Date</label
                    >
                    <div class="col-md-6">
                        <input
                            id="jop_date"
                            type="date"
                            class="form-control"
                            name="jop_date"
                            v-model="editfields.jop_date"
                            required
                            autofocus
                        />
                        <div
                            class="alert alert-danger"
                            v-if="errors && errors.jop_date"
                        >
                            {{ errors.jop_date[0] }}
                        </div>
                    </div>
                </div>
                 <div class="form-group row">
                    <label
                        for="Address"
                        class="col-md-4 col-form-label text-md-right"
                        >Address1</label
                    >
                    <div class="col-md-6">
                        <input
                            id="Address"
                            type="text"
                            class="form-control"
                            name="Address"
                            v-model="editfields.Address"
                            required
                            autofocus
                        />
                        <div
                            class="alert alert-danger"
                            v-if="errors && errors.Address"
                        >
                            {{ errors.Address[0] }}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label
                        for="Address1"
                        class="col-md-4 col-form-label text-md-right"
                        >Address2</label
                    >
                    <div class="col-md-6">
                        <input
                            id="Address1"
                            type="text"
                            class="form-control"
                            name="Address1"
                            v-model="editfields.Address1"
                            required
                            autofocus
                        />
                        <div
                            class="alert alert-danger"
                            v-if="errors && errors.Address1"
                        >
                            {{ errors.Address1[0] }}
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
                        <button
                            v-on:click="cancelEdit()"
                            class="btn btn-outline-danger"
                        >
                            Cancel Edit
                        </button>
                    </div>
                </div>
        </form>
        <div class="panel panel-default">
            <div class="panel-heading"><h1>Emoployees</h1></div>
            <div class="panel-body">
                <div style="text-align:left">
                    <div
                        style="display:inline-block"
                        v-for="permission in permissions" v-bind:key="permission.id"
                    >
                    <div v-if="permission.permission =='add Settings'">
                        <a v-on:click="addEmployee()" class="btn btn-info"
                            >Add New Employee</a
                        >
                    </div>
                    </div>
                </div>
                <hr>
                <table style="table-layout:fixed" class="table table-striped">
                    <thead >
                    <tr>
                       <th style="text-align:left;width:5%;">
                            <div style="text-align:left;">
                            <a style="text-align:left;" @click.prevent="change_sort('id')">Id</a>
                            <span v-if="this.sort_field=='id' && this.sort_direction=='asc'" @click.prevent="change_sort('id')"><i class="fa-fw select-all fas"></i></span>
                            <span v-if="this.sort_field=='id' && this.sort_direction=='desc'" @click.prevent="change_sort('id')"><i class="fa-fw select-all fas"></i></span>
                            </div>
                        </th>
                         <th style="text-align:left;width:10%;">
                            <div style="text-align:left;">
                            <a style="text-align:left;" @click.prevent="change_sort('First_Name')">First_Name</a>
                            <span v-if="this.sort_field=='First_Name' && this.sort_direction=='asc'" @click.prevent="change_sort('First_Name')"><i class="fa-fw select-all fas"></i></span>
                            <span v-if="this.sort_field=='First_Name' && this.sort_direction=='desc'" @click.prevent="change_sort('First_Name')"><i class="fa-fw select-all fas"></i></span>
                            </div>
                        </th>
                        <th style="text-align:left;width:10%;">
                            <div style="text-align:left;">
                            <a style="text-align:left;" @click.prevent="change_sort('Last_Name')">Last_Name</a>
                            <span v-if="this.sort_field=='Last_Name' && this.sort_direction=='asc'" @click.prevent="change_sort('Last_Name')"><i class="fa-fw select-all fas"></i></span>
                            <span v-if="this.sort_field=='Last_Name' && this.sort_direction=='desc'" @click.prevent="change_sort('Last_Name')"><i class="fa-fw select-all fas"></i></span>
                            </div>
                        </th>
                        <th style="text-align:left;width:15%;">
                            <div style="text-align:left;">
                            <a style="text-align:left;" @click.prevent="change_sort('Mobile')">Mobile</a>
                            <span v-if="this.sort_field=='Mobile' && this.sort_direction=='asc'" @click.prevent="change_sort('Mobile')"><i class="fa-fw select-all fas"></i></span>
                            <span v-if="this.sort_field=='Mobile' && this.sort_direction=='desc'" @click.prevent="change_sort('Mobile')"><i class="fa-fw select-all fas"></i></span>
                            </div>
                        </th>
                        <th style="text-align:left;width:15%;">
                            <div style="text-align:left;">
                            <a style="text-align:left;" @click.prevent="change_sort('Address')">Address1</a>
                            <span v-if="this.sort_field=='Address' && this.sort_direction=='asc'" @click.prevent="change_sort('Address')"><i class="fa-fw select-all fas"></i></span>
                            <span v-if="this.sort_field=='Address' && this.sort_direction=='desc'" @click.prevent="change_sort('Address')"><i class="fa-fw select-all fas"></i></span>
                            </div>
                        </th>
                        <th style="text-align:left;width:15%;">
                            <div style="text-align:left;">
                            <a style="text-align:left;" @click.prevent="change_sort('Address1')">Address2</a>
                            <span v-if="this.sort_field=='Address1' && this.sort_direction=='asc'" @click.prevent="change_sort('Address1')"><i class="fa-fw select-all fas"></i></span>
                            <span v-if="this.sort_field=='Address1' && this.sort_direction=='desc'" @click.prevent="change_sort('Address1')"><i class="fa-fw select-all fas"></i></span>
                            </div>
                        </th>
                        <th style="width:20%;">   
                            <input style="width:100%;" type="search" v-model="searchtext" placeholder="search employee"/>
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
                                        :value="'First_Name'"
                                        >First_Name</option
                                    >
                                    <option
                                        class="form-control"
                                        :value="'Last_Name'"
                                        >Last_Name</option
                                    >
                                    <option
                                        class="form-control"
                                        :value="'Mobile'"
                                        >Mobile</option
                                    >
                                    <option
                                        class="form-control"
                                        :value="'Address'"
                                        >Address1</option
                                    >
                                    <option
                                        class="form-control"
                                        :value="'Address1'"
                                        >Address2</option
                                    >
                                </select>
                        </th>
                    </tr>
                     </thead>
                    <tbody>
                        <tr v-for="employee in employees.data" v-bind:key="employee.id">
                            <td>
                                <div style="word-wrap: break-word;">
                                   {{employee.id}}
                                </div>
                            </td>
                            <td>
                                <div style="word-wrap: break-word;">
                                   {{employee.First_Name}}
                                </div>
                            </td>
                             <td>
                                <div style="word-wrap: break-word;">
                                   {{employee.Last_Name}}
                                </div>
                            </td>
                            <td>
                                <div style="word-wrap: break-word;">
                                   {{employee.Mobile}}
                                </div>
                            </td>
                             <td>
                                <div style="word-wrap: break-word;">
                                   {{employee.Address}}
                                </div>
                            </td>
                             <td>
                                <div style="word-wrap: break-word;">
                                   {{employee.Address1}}
                                </div>
                            </td>
                            <td>
                                <div v-for="permission in permissions" v-bind:key="permission.id">
                                    <div v-if="permission.permission =='edit Settings'">
                                <button
                                        v-on:click="
                                            editEmployee(employee)
                                        "
                                        v-if="
                                            !edit &&
                                                employee.id != editfields.id
                                        "
                                        class="btn btn-info"
                                    >
                                        Edit
                                    </button>
                                    <button
                                        v-on:click="cancelEdit()"
                                        v-if="employee.id == editfields.id"
                                        class="btn btn-outline-danger"
                                    >
                                        Cancel Edit
                                    </button>
                                </div>    
                                </div>
                            </td>
                            <td>
                                <div  v-for="permission in permissions" v-bind:key="permission.id">
                                    <div v-if="permission.permission =='delete Settings'">
                                   <button
                                        @click="deleteEmployee(employee)"
                                        class="btn btn-danger"
                                    >X</button>
                                  </div>  
                                </div>
                            </td>
                        </tr>
                        <hr />
                    </tbody>
                </table>
                <pagination :data="employees" @pagination-change-page="loadEmployees"></pagination>
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
            users: [],
            employees: [],
            countries: [],
            cities: [],
            permissions: [],
            nationalities:[],
            successadd: false,
            successedit: false,
            successdelete: false,
            addpart1: true,
            addpart2: false,
            editpart1: true,
            editpart2: false,
            addgeneratepass: false,
            fields: {},
            editfields: {},
            edit: false,
            add: false,
            searchtext: "",
            column: "First_Name",
            errors: [],
            sort_field: "id",
            sort_direction: "desc",
            passwordshow: false,
        };
    },
    mounted() {
        this.loadUsers();
        this.loadCountries();
        this.loadCities();
        this.loadEmployees();
        this.Permissions();
    },
    computed: {
        filteredCities: function() {
            return this.cities.filter(city => {
                return city.country_id == this.fields.country_id;
            });
        },
        filterededitCities: function() {
            return this.cities.filter(city => {
                return city.country_id == this.editfields.country_id;
            });
        }
    },
    watch: {
        searchtext() {
            this.loadUsers();
            this.loadEmployees();
        },
        column() {
            this.loadUsers();
            this.loadEmployees();
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
        showpass() {
            this.passwordshow = true;
        },
        hidepass() {
            this.passwordshow = false;
        },
        change_sort(field) {
            if (this.sort_field === field) {
                this.sort_direction =
                    this.sort_direction === "asc" ? "desc" : "asc";
            } else {
                this.sort_field = field;
                this.sort_direction = "asc";
            }
            this.loadUsers();
            this.loadEmployees();
        },
        loadCountries: function() {
            axios
                .get(this.$apiAdress +'/api/Countries?token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.countries = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        loadCities: function() {
            axios
                .get(this.$apiAdress +'/api/Cities?token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.cities = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        loadnationalities: function(){
                    axios.get(this.$apiAdress +'/api/Nationality?token='+ localStorage.getItem("api_token"))
                    .then((response) => {
                        this.nationalities = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
        },
        loadUsers: function(){
                    axios.get(this.$apiAdress + '/api/users?token='+ localStorage.getItem("api_token"))
                    .then((response) => {
                        this.users = response.data.users;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
        },
        loadEmployees: function(page = 1){
                    axios
                .get(this.$apiAdress +
                    "/api/employee/getpage?page=" +
                        page +
                        "&search=" +
                        this.searchtext +
                        "&sort_field=" +
                        this.sort_field +
                        "&sort_direction=" +
                        this.sort_direction +
                        "&column=" +
                        this.column
                        +'&token='+ localStorage.getItem("api_token")
                )
                    .then((response) => {
                        this.employees = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
        },
        loadAfterAdd: function(page = 1) {
            axios
                .get(this.$apiAdress +
                    "/api/employee/getpage?page=" +
                        page +
                        "&search=" +
                        this.searchtext +
                        "&sort_field=" +
                        this.sort_field +
                        "&sort_direction=" +
                        this.sort_direction +
                        "&column=" +
                        this.column
                        +'&token='+ localStorage.getItem("api_token")
                )
                .then(response => {
                    this.employees = response.data;
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
                .get(this.$apiAdress +
                     "/api/employee/getpage?page=" +
                        page +
                        "&search=" +
                        this.searchtext +
                        "&sort_field=" +
                        this.sort_field +
                        "&sort_direction=" +
                        this.sort_direction +
                        "&column=" +
                        this.column
                        +'&token='+ localStorage.getItem("api_token")
                )
                .then(response => {
                    this.employees = response.data;
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
                .get(this.$apiAdress +
                     "/api/employee/getpage?page=" +
                        page +
                        "&search=" +
                        this.searchtext +
                        "&sort_field=" +
                        this.sort_field +
                        "&sort_direction=" +
                        this.sort_direction +
                        "&column=" +
                        this.column
                        +'&token='+ localStorage.getItem("api_token")
                )
                .then(response => {
                    this.employees = response.data;
                    this.successadd = false;
                    this.successedit = false;
                    this.successdelete = true;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        addEmployee() {
            this.add = true;
            this.successadd = false;
            this.successedit = false;
            this.successdelete = false;
        },
        cancelAdd() {
            this.add = false;
            this.fields = {};
            this.errors = {};
            this.addgeneratepass= false;
            this.loadUsers();
            this.loadEmployees();
        },
        submit() {
            axios
                .post(this.$apiAdress +'/api/Employee?token='+ localStorage.getItem("api_token"), this.fields)
                .then(response => {
                    this.fields = {};
                    this.errors = {};
                    this.add = false;
                    this.loadAfterAdd();
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                    console.log("Error");
                });
        },
        editEmployee(employee) {
            this.edit = true;
            this.editfields = employee;
            this.successadd = false;
            this.successedit = false;
            this.successdelete = false;
        },
        cancelEdit() {
            this.edit = false;
            this.editfields = {};
            this.errors = {};
            this.loadEmployees();
        },
        update() {
            axios
                .post(this.$apiAdress +'/api/employees/store1?token='+ localStorage.getItem("api_token"), this.editfields)
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
        genratePassAdd() {
            var generator = require("generate-password");
            this.fields.password = generator.generate({
                length: 10,
                numbers: true,
                lowercase: true,
                uppercase: true
            });
            this.addgeneratepass = true;
            return password;
        },
         deleteEmployee(id) {
            axios
                .post(this.$apiAdress +'/api/employees/delete?token='+ localStorage.getItem("api_token"), id)
                .then(data => {
                    this.loadAfterDelete();
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
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