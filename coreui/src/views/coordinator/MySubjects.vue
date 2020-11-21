<template>
 <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
        <CCard>
          <CCardBody>
            <div class="container">
        <div class="alert alert-success" v-show="successadd">
            Subject Added Successfully.
        </div>
        <div class="alert alert-success" v-show="successdelete">
            Subject Deleted Successfully.
        </div>
        <form @submit.prevent="submit" v-if="add">
             <div class="container">
                <h5>Add New Subject:</h5>
                <hr />
               <div class="form-group row">
                        <label
                            for="subject_id"
                            class="col-md-4 col-form-label text-md-right"
                            >Choose Subject
                        </label>

                        <div class="col-md-6">
                            <select
                                class="form-control"
                                id="subject_id"
                                name="subject_id"
                                required
                                autofocus
                                v-model="fields.subject_id"
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
                    <div class="form-group row"> 
                     <label for="Teacher_count" class="col-md-4 col-form-label text-md-right">Teachers_Count</label>

               <div class="col-md-6">
                <input id="Teacher_count" type="number" min="1" max="99" class="form-control" name="Teacher_count" v-model.number="fields.Teacher_count" required autofocus>
                <div class="alert alert-danger" v-if="errors && errors.Teacher_count">
                    {{ errors.Teacher_count[0] }}
                </div>
              </div>
            </div>

            <div class="form-group row"> 
               <label for="Student_count" class="col-md-4 col-form-label text-md-right">Students_Count</label>

                <div class="col-md-6">
                 <input id="Student_count" type="number" min="1" max="999" class="form-control" name="Student_count" v-model.number="fields.Student_count" required autofocus>
                  <div class="alert alert-danger" v-if="errors && errors.Student_count">
                    {{ errors.Student_count[0] }}
                   </div>
                  </div>
                </div>
                <div class="form-group row">
                    <label
                        for="First_name"
                        class="col-md-4 col-form-label text-md-right"
                        >First_name</label
                    >
                    <div class="col-md-6">
                        <input
                            id="First_name"
                            type="text"
                            class="form-control"
                            name="First_name"
                            minlength="3"
                            v-model="fields.First_name"
                            required
                            autofocus
                        />
                        <div
                            class="alert alert-danger"
                            v-if="errors && errors.First_name"
                        >
                            {{ errors.First_name[0] }}
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
                        for="Subject_Coordinator_Email"
                        class="col-md-4 col-form-label text-md-right"
                        >Subject_Coordinator_Email</label
                    >
                    <div class="col-md-6">
                        <input
                            id="Subject_Coordinator_Email"
                            type="email"
                            class="form-control"
                            name="Subject_Coordinator_Email"
                            v-model="fields.Subject_Coordinator_Email"
                            required
                            autocomplete="email"
                            autofocus
                        />
                        <div
                            class="alert alert-danger"
                            v-if="errors && errors.Subject_Coordinator_Email"
                        >
                            {{ errors.Subject_Coordinator_Email[0] }}
                        </div>
                    </div>
                </div>
                <div class="form-group row"> 
            <label for="Mobile" class="col-md-4 col-form-label text-md-right">Mobile</label>

            <div class="col-md-6">
                <input id="Mobile" type="tel" class="form-control" pattern="[0]{1}[0-9]{9,12}" name="Mobile" v-model="fields.Mobile" required autofocus>
                <div class="alert alert-danger" v-if="errors && errors.Mobile">
                    {{ errors.Mobile[0] }}
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
            <div class="panel-heading"><h1>{{Institution.Institu_name}}'s Subjects</h1></div>
            <div class="panel-body">
                <div style="text-align:left">
                    <div
                        style="display:inline-block"
                    >
                        <a v-on:click="addSubject()" class="btn btn-info"
                            >Add New Subject To Institution</a
                        >
                    </div>
                </div>
                <hr>
                <table style="table-layout:fixed" class="table table-striped">
                    <thead >
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
                            <a style="text-align:left;" @click.prevent="change_sort('subject_id')">Subject_Name</a>
                            <span v-if="this.sort_field=='subject_id' && this.sort_direction=='asc'" @click.prevent="change_sort('subject_id')"><i class="fa-fw select-all fas"></i></span>
                            <span v-if="this.sort_field=='subject_id' && this.sort_direction=='desc'" @click.prevent="change_sort('subject_id')"><i class="fa-fw select-all fas"></i></span>
                            </div>
                        </th>
                        <th style="text-align:left;width:20%;">
                            <div style="text-align:left;">
                            <a style="text-align:left;" @click.prevent="change_sort('Teacher_count')">Teacher_Count</a>
                            <span v-if="this.sort_field=='Teacher_count' && this.sort_direction=='asc'" @click.prevent="change_sort('Teacher_count')"><i class="fa-fw select-all fas"></i></span>
                            <span v-if="this.sort_field=='Teacher_count' && this.sort_direction=='desc'" @click.prevent="change_sort('Teacher_count')"><i class="fa-fw select-all fas"></i></span>
                            </div>
                        </th>
                        <th style="text-align:left;width:20%;">
                            <div style="text-align:left;">
                            <a style="text-align:left;" @click.prevent="change_sort('Student_count')">Student_Count</a>
                            <span v-if="this.sort_field=='Student_count' && this.sort_direction=='asc'" @click.prevent="change_sort('Student_count')"><i class="fa-fw select-all fas"></i></span>
                            <span v-if="this.sort_field=='Student_count' && this.sort_direction=='desc'" @click.prevent="change_sort('Student_count')"><i class="fa-fw select-all fas"></i></span>
                            </div>
                        </th>
                        <th style="width:30%;">   
                            <input style="width:100%;" type="search" v-model="searchtext" placeholder="search subject"/>
                        </th>
                    </tr>
                     </thead>
                    <tbody>
                        <tr v-for="institution_subject in institution_subjects.data" v-bind:key="institution_subject.id">
                            <td>
                                <div style="word-wrap: break-word;">
                                <a @click="gotoclasses(institution_subject.id)"> {{ institution_subject.id }}</a>
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
                                            subject.id == institution_subject.subject_id
                                        "
                                    >
                                       <a @click="gotoclasses(institution_subject.id)">{{ subject.Subject_name }}</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div style="word-wrap: break-word;">
                                   {{institution_subject.Teacher_count}}
                                </div>
                            </td>
                            <td>
                                <div style="word-wrap: break-word;">
                                   {{institution_subject.Student_count}}
                                </div>
                            </td>
                            <td></td>
                        </tr>
                        <hr />
                    </tbody>
                </table>
                <pagination :data="institution_subjects" @pagination-change-page="institution_subjects"></pagination>
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
            institution_subjects: [],
            subjects: [],
            successadd: false,
            successdelete: false,
            addgeneratepass: false,
            fields: {},
            Institution:{},
            add: false,
            searchtext: "",
            column: "id",
            errors: [],
            sort_field: "id",
            sort_direction: "desc",
            passwordshow: false
        };
    },
    mounted() {
        this.loadInstitutionsSubjects();
        this.loadSubjects();
        this.loadInstitutions();
    },

    methods:{
        gotoclasses(id){
            this.$router.push({path: `coordinator-subjects/${id.toString()}/classes`});
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
            this.loadInstitutionsSubjects();
        },
        loadSubjects: function() {
            axios
                .get(this.$apiAdress +'/api/Coordintors/getSubjects?token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.subjects = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        loadInstitutionsSubjects:function(page = 1){
            axios
                .get(this.$apiAdress +'/api/Coordintors/getInstitutionSubject?page='+page+
                        "&search=" +
                        this.searchtext +
                        "&sort_field=" +
                        this.sort_field +
                        "&sort_direction=" +
                        this.sort_direction +
                        "&column=" +
                        this.column +
                        '&token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.institution_subjects = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },

        loadAfterAdd:function(page = 1){
            axios
                .get(this.$apiAdress +'/api/Coordintors/getInstitutionSubject?page='+page+
                        "&search=" +
                        this.searchtext +
                        "&sort_field=" +
                        this.sort_field +
                        "&sort_direction=" +
                        this.sort_direction +
                        "&column=" +
                        this.column+
                        '&token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.institution_subjects = response.data;
                    this.successadd = true;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        loadInstitutions(){
            axios
                .get(this.$apiAdress +'/api/Coordintors/getInstitution?token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.Institution = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        addSubject() {
            this.add = true;
            this.fields.Id_institu = this.Institution.id;
            this.successadd = false;
            this.successdelete = false;
        },
        cancelAdd() {
            this.add = false;
            this.fields = {};
            this.errors = {};
            this.addgeneratepass= false;
            this.loadInstitutionsSubjects();
        },
        submit() {
            axios
                .post(this.$apiAdress +'/api/coordintors/new_subject?token='+ localStorage.getItem("api_token"), this.fields)
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
        genratePassAdd() {
            var generator = require("generate-password");
            this.fields.Subject_Coordinator_password = generator.generate({
                length: 10,
                numbers: true,
                lowercase: true,
                uppercase: true
            });
            this.addgeneratepass = true;
            return this.fields.Subject_Coordinator_password;
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