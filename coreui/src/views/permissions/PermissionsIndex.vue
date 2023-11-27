<template>
  <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
        <CCard>
          <CCardBody>
    <div class="container">
        <div class="alert alert-success" v-show="successadd">
            Permissions Created Successfully.
        </div>
        <div class="alert alert-success" v-show="successdelete">
            Permission Deleted Successfully.
        </div>
        <div class="alert alert-success" v-show="successaddtorole">
            Permission Added To Role Successfully.
        </div>
        <form @submit.prevent="submit" v-if="add && !addtorole">
            <div class="container">
                <h5>Create Permission:</h5>
                <hr />
                    <div class="form-group row">
                    <label
                        for="permissions"
                        class="col-md-4 col-form-label text-md-right"
                        >Permission Name</label
                    >
                    <div class="col-md-6">
                        <input
                            id="permissions"
                            type="text"
                            class="form-control"
                            name="permissions"
                            minlength="3"
                            v-model="fields.permissions"
                            required
                            autofocus
                        />
                            <div
                                class="alert alert-danger"
                                v-if="errors && errors.permissions"
                            >
                                {{ errors.permissions[0] }}
                            </div>
                        </div>
                    </div>
                 <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-info">
                            Create
                        </button>
                        <button
                            v-on:click="cancelcreate()"
                            class="btn btn-outline-danger"
                        >
                            Cancel Create
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <form @submit.prevent="newAddToRole" v-if="!add && addtorole">
            <div class="container">
                <h5>Add Permission To Role:</h5>
                <hr />
                <div class="form-group row">
                        <label
                            for="role_id"
                            class="col-md-4 col-form-label text-md-right"
                            >Choose Role</label
                        >
                        <div class="col-md-6">
                            <select
                                class="form-control"
                                id="role_id"
                                name="role_id"
                                required
                                autofocus
                                v-model="addfields.role_id"
                            >
                                <option
                                    v-for="role in roles"
                                    v-bind:key="role.id"
                                    :value="role.id"
                                    >{{ role.name }}</option
                                >
                            </select>
                            <div
                                class="alert alert-danger"
                                v-if="errors && errors.role_id"
                            >
                                {{ errors.role_id[0] }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            for="permission_id"
                            class="col-md-4 col-form-label text-md-right"
                            >Choose Permission</label
                        >
                        <div class="col-md-6">
                            <select
                                class="form-control"
                                id="permission_id"
                                name="permission_id"
                                required
                                autofocus
                                v-model="addfields.permission_id"
                            >
                                <option
                                    v-for="permission in permissions"
                                    v-bind:key="permission.id"
                                    :value="permission.id"
                                    >{{ permission.name }}</option
                                >
                            </select>
                            <div
                                class="alert alert-danger"
                                v-if="errors && errors.permission_id"
                            >
                                {{ errors.permission_id[0] }}
                            </div>
                        </div>
                    </div>
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-info">
                            Add
                        </button>
                        <button
                            v-on:click="canceladdToRole()"
                            class="btn btn-outline-danger"
                        >
                            Cancel Add
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <div class="panel panel-default">
            <div class="panel-heading"><h1>Permissions</h1></div>
            <div class="panel-body">
                <div style="text-align:left">
                    <div
                        style="display:inline-block"
                    >
                        <a v-on:click="createPermission()" class="btn btn-info" v-if="!add && !addtorole"
                            >Create Permission</a
                        >
                        <a v-on:click="addToRole()" class="btn btn-info" v-if="!add && !addtorole"
                            >Add Permission to Role</a
                        >
                    </div>
                </div>
                <br>
                <table style="table-layout:fixed" class="table table-striped">
                    <thead>
                    <tr>
                        <th style="text-align:left;width:10%;"></th>
                        <th style="text-align:left;width:50%;"></th>
                        <th style="text-align:left;width:20%;"></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="rolespermission in rolespermissions" v-bind:key="rolespermission.id">   
                            <td>
                                <div style="word-wrap: break-word;">
                                   {{rolespermission.id}}
                                </div>
                            </td>
                            <td>
                                <div v-for="permission in permissions" v-bind:key="permission.id">
                                    <div v-for="role in roles" v-bind:key="role.id">
                                        <div v-if="rolespermission.role_id==role.id && rolespermission.permission_id==permission.id" >
                                        <div style="word-wrap: break-word;">
                                           Permission : [{{permission.name}}] for Role:[{{role.name}}]
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div
                                    style="display:inline-block"
                                >
                                <div v-for="permission in permissions" v-bind:key="permission.id">
                                   <div v-for="role in roles" v-bind:key="role.id">
                                    <div v-if="rolespermission.role_id==role.id && rolespermission.permission_id==permission.id" >
                                    <button
                                       @click="deletepermission(rolespermission.id)"
                                        class="btn btn-danger"    
                                    >
                                        Delete
                                    </button>
                                    </div>
                                   </div>
                                </div>
                                </div>
                            </td>
                        </tr>
                        <hr />
                    </tbody>
                </table>
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
            roles: [],
            permissions: [],
            rolespermissions: [],
            successadd: false,
            successaddtorole: false,
            successdelete: false,
            fields: {},
            addfields: {},
            add: false,
            addtorole: false,
            errors: [],
        };
    },
    mounted() {
        this.loadRolesPermissions();
        this.loadRolesPermissionsArray();
    },
    methods: {
        loadRolesPermissions: function() {
            axios
                .get(this.$apiAdress +'/api/Permissions?token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.roles = response.data.roles;
                    this.permissions = response.data.permissions;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        loadRolesPermissionsArray: function() {
            axios
                .get(this.$apiAdress +'/api/permissions/roles_permissions?token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.rolespermissions = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        loadAfterAdd(){
                axios
                .get(this.$apiAdress +'/api/Permissions?token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.roles = response.data.roles;
                    this.permissions = response.data.permissions;
                    this.successadd = true;
                    this.successdelete = false;
                    this.successaddtorole = false;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        createPermission() {
            this.add = true;
            this.successadd = false;
            this.successdelete = false;
            this.successaddtorole = false;

        },
        cancelcreate() {
            this.add = false;
            this.fields = {};
            this.errors = {};
            this.loadRolesPermissions();
        },
        submit() {
            axios
                .post(this.$apiAdress +'/api/Permissions?token='+ localStorage.getItem("api_token"), this.fields)
                .then(response => {
                    this.fields = {};
                    this.success = true;
                    this.add = false;
                    this.loadAfterAdd();
                    this.errors = {};
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.errors;
                    }
                    console.log("Error");
                });
        },
        addToRole(){
            this.addtorole = true;
            this.successadd = false;
            this.successdelete = false;
            this.successaddtorole = false;

        },
        canceladdToRole() {
            this.addtorole = false;
            this.addfields = {};
            this.errors = {};
            this.loadRolesPermissions();
        },
        newAddToRole() {
            axios
                .post(this.$apiAdress +'/api/permissions/addtorole?token='+ localStorage.getItem("api_token"), this.addfields)
                .then(response => {
                    this.addfields = {};
                    this.addtorole = false;
                    this.successaddtorole = true;
                    this.loadRolesPermissions();
                    this.loadRolesPermissionsArray();
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.errors;
                    }
                    console.log("Error");
                });
        },
        deletepermission(id) {
            axios
                .get(this.$apiAdress +'/api/permissions/'+ id +'/delete?token='+ localStorage.getItem("api_token"))
                .then(data => {
                    this.successdelete = true;
                    this.successadd = false;
                    this.successaddtorole = false;
                    this.loadRolesPermissions();
                    this.loadRolesPermissionsArray();
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    }    
}

</script>
<style>
input:invalid {
  border: red solid 1px;
}
</style>
