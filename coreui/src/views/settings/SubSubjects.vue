<template>
  <CRow>
    <CCol col="12" xl="6">
      <transition name="slide">
        <CCard>
          <CCardBody>
 <div class="container">
        <div class="panel panel-default">
            <div class="alert alert-success" v-show="successadd">
                Sub_Subject Added Successfully.
            </div>
            <div class="alert alert-success" v-show="successedit">
                Sub_Subject Updated Successfully.
            </div>
            <div class="alert alert-success" v-show="successdelete">
                Sub_Subject Deleted Successfully.
            </div>
            <form @submit.prevent="submit" v-if="add">
                <hr />
                <div class="container">
                    <h5>Add Sub_Subject:</h5>
                    <hr />
                    <div class="form-group row">
                        <label
                            for="sub_subject_name"
                            class="col-md-4 col-form-label text-md-right"
                            >Sub_Subject Name</label
                        >
                        <div class="col-md-6">
                            <input
                                id="sub_subject_name"
                                type="text"
                                minlength="3"
                                class="form-control"
                                name="sub_subject_name"
                                v-model="fields.sub_subject_name"
                                required
                                autofocus
                            />
                            <div
                                class="alert alert-danger"
                                v-if="errors && errors.sub_subject_name"
                            >
                                {{ errors.sub_subject_name[0] }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label
                            for="Id_subject"
                            class="col-md-4 col-form-label text-md-right"
                            >Choose Subject</label
                        >

                        <div class="col-md-6">
                            <select
                                class="form-control"
                                id="Id_subject"
                                name="Id_subject"
                                required
                                autofocus
                                v-model="fields.Id_subject"
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
                                v-if="errors && errors.Id_subject"
                            >
                                {{ errors.Id_subject[0] }}
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
            <div class="panel-heading"><h1>Sub_Subject</h1></div> 
            <div class="panel-body">
                <div style="text-align:left">
                    <div
                        style="display:inline-block"
                        v-for="permission in permissions" v-bind:key="permission.id"
                    >
                    <div v-if="permission.permission =='add Settings'">
                        <a v-on:click="addSub()" class="btn btn-info"
                            >Add New Sub_Subject</a
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
                            <a style="text-align:left;" @click.prevent="change_sort('sub_subject_name')">Name</a>
                            <span v-if="this.sort_field=='sub_subject_name' && this.sort_direction=='asc'" @click.prevent="change_sort('sub_subject_name')"><i class="fa-fw select-all fas"></i></span>
                            <span v-if="this.sort_field=='sub_subject_name' && this.sort_direction=='desc'" @click.prevent="change_sort('sub_subject_name')"><i class="fa-fw select-all fas"></i></span>
                            </div>
                        </th>
                        <th style="text-align:left;width:25%;">
                            <div style="text-align:left;">
                            <a style="text-align:left;" @click.prevent="change_sort('subject_id')">Subject</a>
                            <span v-if="this.sort_field=='subject_id' && this.sort_direction=='asc'" @click.prevent="change_sort('subject_id')"><i class="fa-fw select-all fas"></i></span>
                            <span v-if="this.sort_field=='subject_id' && this.sort_direction=='desc'" @click.prevent="change_sort('subject_id')"><i class="fa-fw select-all fas"></i></span>
                            </div>
                        </th>
                        <th style="width:30%;">
                            <input style="width:100%;" type="search" v-model="searchtext" placeholder="search sub_subject"/>
                        </th>
                        <th style="width:10%;"></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="subsubject in sub_subjects.data" v-bind:key="subsubject.id">
                            <td>
                                <div style="word-wrap: break-word;">
                                   {{ subsubject.id }}
                                </div>
                            </td>
                            <td>
                                <div style="word-wrap: break-word;">
                                    {{
                                        subsubject.sub_subject_name
                                    }}
                                </div>
                            </td>
                            <td>
                                <div
                                    v-for="subject in subjects"
                                    v-bind:key="subject.id"
                                >
                                    <div
                                        style="word-wrap: break-word;"
                                        v-if="
                                            subject.id == subsubject.subject_id
                                        "
                                    >
                                       {{ subject.Subject_name }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div v-for="permission in permissions" v-bind:key="permission.id">
                                    <div v-if="permission.permission =='edit Settings'">
                                    <button
                                        v-on:click="editSub(subsubject)"
                                        v-if="
                                            !edit &&
                                                subsubject.id != editfields.id
                                        "
                                        class="btn btn-info"
                                    >
                                        Edit
                                    </button>
                                    <button
                                        v-on:click="cancelEdit()"
                                        v-if="subsubject.id == editfields.id"
                                        class="btn btn-outline-danger"
                                    >
                                        Cancel Edit
                                    </button>
                                    </div>
                                </div>
                                <form
                                    @submit.prevent="update"
                                    v-if="
                                        edit && subsubject.id == editfields.id
                                    "
                                >
                                    <div class="container">
                                        <div class="form-group row">
                                            <label
                                                for="sub_subject_name"
                                                class="col-md-4 col-form-label text-md-right"
                                                >Sub_Subject Name</label
                                            >
                                            <div class="col-md-6">
                                                <input
                                                    id="sub_subject_name"
                                                    type="text"
                                                    minlength="3"
                                                    class="form-control"
                                                    name="sub_subject_name"
                                                    v-model="
                                                        editfields.sub_subject_name
                                                    "
                                                    required
                                                    autofocus
                                                />
                                                <div
                                                    class="alert alert-danger"
                                                    v-if="
                                                        errors &&
                                                            errors.sub_subject_name
                                                    "
                                                >
                                                    {{
                                                        errors
                                                            .sub_subject_name[0]
                                                    }}
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
                                                    v-model="
                                                        editfields.subject_id
                                                    "
                                                    required
                                                    autofocus
                                                >
                                                    <option
                                                        v-for="subject in subjects"
                                                        v-bind:key="subject.id"
                                                        :value="subject.id"
                                                        >{{
                                                            subject.Subject_name
                                                        }}</option
                                                    >
                                                </select>
                                                <div
                                                    class="alert alert-danger"
                                                    v-if="
                                                        errors &&
                                                            errors.subject_id
                                                    "
                                                >
                                                    {{ errors.subject_id[0] }}
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
                                        @click="deleteSubSubject(subsubject)"
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
                <pagination :data="sub_subjects" @pagination-change-page="loadSubSubjects"></pagination>
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
            sub_subjects: [],
            subjects: [],
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
        this.loadSubjects();
        this.loadSubSubjects();
        this.Permissions();
    },
    watch:{
    searchtext(){
             this.loadSubSubjects();
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
           this.loadSubSubjects();
        },
        loadSubSubjects(page = 1) {
            axios
                .get(this.$apiAdress +'/api/suSubject/getpage?page=' + page
                + '&search=' + this.searchtext
                + '&sort_field=' + this.sort_field
                + '&sort_direction=' + this.sort_direction
                 +'&token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.sub_subjects = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        loadSubjects: function() {
            axios
                .get(this.$apiAdress +'/api/Subjects?token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.subjects = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        loadAfterAdd: function(page = 1) {
            axios
                .get(this.$apiAdress +'/api/suSubject/getpage?page=' + page
                + '&search=' + this.searchtext
                + '&sort_field=' + this.sort_field
                + '&sort_direction=' + this.sort_direction
                +'&token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.sub_subjects = response.data;
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
                .get(this.$apiAdress +'/api/suSubject/getpage?page=' + page
                + '&search=' + this.searchtext
                + '&sort_field=' + this.sort_field
                + '&sort_direction=' + this.sort_direction
                +'&token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.sub_subjects = response.data;
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
                .get(this.$apiAdress +'/api/suSubject/getpage?page=' + page
                + '&search=' + this.searchtext
                + '&sort_field=' + this.sort_field
                + '&sort_direction=' + this.sort_direction
                +'&token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.sub_subjects = response.data;
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
            this.loadSubSubjects();
        },
        submit() {
            axios
                .post(this.$apiAdress +'/api/SuSubject?token='+ localStorage.getItem("api_token"), this.fields)
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
        editSub(subsubject) {
            this.edit = true;
            this.editfields = subsubject;
            this.successadd = false;
            this.successedit = false;
            this.successdelete = false;
        },
        cancelEdit() {
            this.edit = false;
            this.editfields = {};
            this.loadSubSubjects();
        },
        update() {
            axios
                .post(this.$apiAdress +'/api/suSubjects/store1?token='+ localStorage.getItem("api_token"), this.editfields)
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
        deleteSubSubject(id) {
            axios
                .post(this.$apiAdress +'/api/suSubjects/delete?token='+ localStorage.getItem("api_token"),id)
                .then(data => {
                    this.loadAfterDelete();
                    this.loadSubSubjects();
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