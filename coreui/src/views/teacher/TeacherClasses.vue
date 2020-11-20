<template>
    <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
        <CCard>
          <CCardBody>
  <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"><h1>{{myteacher.First_name}}'s Classes</h1></div>
            <div class="panel-body">
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
                            <a style="text-align:left;" @click.prevent="change_sort('institution_subject_id')">Subject</a>
                            <span v-if="this.sort_field=='institution_subject_id' && this.sort_direction=='asc'" @click.prevent="change_sort('institution_subject_id')"><i class="fa-fw select-all fas"></i></span>
                            <span v-if="this.sort_field=='institution_subject_id' && this.sort_direction=='desc'" @click.prevent="change_sort('institution_subject_id')"><i class="fa-fw select-all fas"></i></span>
                            </div>
                        </th>
                        <th style="text-align:left;width:20%;">
                            <div style="text-align:left;">
                            <a style="text-align:left;" @click.prevent="change_sort('teacher_id')">Teacher</a>
                            <span v-if="this.sort_field=='teacher_id' && this.sort_direction=='asc'" @click.prevent="change_sort('teacher_id')"><i class="fa-fw select-all fas"></i></span>
                            <span v-if="this.sort_field=='teacher_id' && this.sort_direction=='desc'" @click.prevent="change_sort('teacher_id')"><i class="fa-fw select-all fas"></i></span>
                            </div>
                        </th>
                        <th style="text-align:left;width:20%;">
                            <div style="text-align:left;">
                            <a style="text-align:left;" @click.prevent="change_sort('keyclass')">Keyclass</a>
                            <span v-if="this.sort_field=='keyclass' && this.sort_direction=='asc'" @click.prevent="change_sort('keyclass')"><i class="fa-fw select-all fas"></i></span>
                            <span v-if="this.sort_field=='keyclass' && this.sort_direction=='desc'" @click.prevent="change_sort('keyclass')"><i class="fa-fw select-all fas"></i></span>
                            </div>
                        </th>
                        <th style="width:25%;">   
                            <input style="width:100%;" type="search" v-model="searchtext" placeholder="search keyclass"/>
                        </th>
                        <th>
                        </th>
                    </tr>
                     </thead>
                    <tbody>
                        <tr v-for="institutions_key_class in institutions_key_classes.data" v-bind:key="institutions_key_class.id">
                            <td>
                                <div style="word-wrap: break-word;">
                                   <a @click="gotoclass(institutions_key_class.id)">{{ institutions_key_class.id }}</a>
                                </div>
                            </td>
                            <td>
                                <div
                                    v-for="institution_subject in institution_subjects"
                                    v-bind:key="institution_subject.id"
                                >
                                <div
                                    v-for="subject in subjects"
                                    v-bind:key="subject.id"
                                >
                                    <div
                                        style="word-wrap: break-word;"
                                        v-if="
                                            (subject.id == institution_subject.subject_id)&&(institution_subject.id==institutions_key_class.institution_subject_id)
                                        "
                                    >
                                     <a @click="gotoclass(institutions_key_class.id)">{{ subject.Subject_name }}</a>
                                    </div>
                                </div>
                                </div>
                            </td>
                            <td>
                                <div v-for="teacher in teachers" v-bind:key="teacher.id">
                                    <div
                                        style="word-wrap: break-word;"
                                        v-if="teacher.id == institutions_key_class.teacher_id"
                                    >
                                       {{teacher.First_name}} {{teacher.Last_Name}}
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div style="word-wrap: break-word;">
                                   {{institutions_key_class.keyclass}}
                                </div>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <hr />
                    </tbody>
                </table>
                <pagination :data="institutions_key_classes" @pagination-change-page="institutions_key_classes"></pagination>
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
          institutions_key_classes: [],
          institution_subjects: [],
            subjects:[],
            teachers:[],
            myteacher:{},
            searchtext: "",
            column: "id",
            errors: [],
            sort_field: "id",
            sort_direction: "desc",
        };
    },
         mounted() {
            this.loadmyTeacher();
            this.loadSubjects();
            this.loadkeyclasses();
            this.loadInstitutionSubject();
            this.loadTeachers();

            },
             watch: {
        searchtext() {
            this.loadkeyclasses();
        }
        },
        methods:{
        gotoclass(id){
            //this.$router.go(-1)
            this.$router.push({path: `/teacher-classes/${id.toString()}/myclass`});
        },    
        change_sort(field) {
            if (this.sort_field === field) {
                this.sort_direction =
                    this.sort_direction === "asc" ? "desc" : "asc";
            } else {
                this.sort_field = field;
                this.sort_direction = "asc";
            }
            this.loadkeyclasses();
        },
        loadmyTeacher: function() {
            axios
                .get(this.$apiAdress +'/api/Teachers/getMyTeacher?token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.myteacher = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        loadSubjects: function() {
            axios
                .get(this.$apiAdress +'/api/Teachers/getSubjects?token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.subjects = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        loadkeyclasses: function(page = 1){
            axios.get(this.$apiAdress +'/api/Teachers/getTeacherClasses?page='+page+
                        "&search=" +
                        this.searchtext +
                        "&sort_field=" +
                        this.sort_field +
                        "&sort_direction=" +
                        this.sort_direction +
                        "&column=" +
                        this.column+
                        "&token="+ localStorage.getItem("api_token"))
                    .then((response) => {
                        this.institutions_key_classes = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
        },
        loadInstitutionSubject: function(){
            axios
                .get(this.$apiAdress +'/api/Teachers/getAllInstitutionSubject?token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.institution_subjects = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        
        loadTeachers: function(){
                    axios.get(this.$apiAdress +'/api/Teachers/getTeachers?token='+ localStorage.getItem("api_token"))
                    .then((response) => {
                        this.teachers = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
    }            
}
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