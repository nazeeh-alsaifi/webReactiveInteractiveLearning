<template>
 <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
        <CCard>
          <CCardBody>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"><h1>{{Institution.Institu_name}}'s Teachers</h1></div>
            <div class="panel-body">
                <div style="text-align:left">
                  
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
                            <a style="text-align:left;" @click.prevent="change_sort('First_name')">First_name</a>
                            <span v-if="this.sort_field=='First_name' && this.sort_direction=='asc'" @click.prevent="change_sort('First_name')"><i class="fa-fw select-all fas"></i></span>
                            <span v-if="this.sort_field=='First_name' && this.sort_direction=='desc'" @click.prevent="change_sort('First_name')"><i class="fa-fw select-all fas"></i></span>
                            </div>
                        </th>
                        <th style="text-align:left;width:20%;">
                            <div style="text-align:left;">
                            <a style="text-align:left;" @click.prevent="change_sort('Last_Name')">Last_Name</a>
                            <span v-if="this.sort_field=='Last_Name' && this.sort_direction=='asc'" @click.prevent="change_sort('Last_Name')"><i class="fa-fw select-all fas"></i></span>
                            <span v-if="this.sort_field=='Last_Name' && this.sort_direction=='desc'" @click.prevent="change_sort('Last_Name')"><i class="fa-fw select-all fas"></i></span>
                            </div>
                        </th>
                        <th style="text-align:left;width:20%;">
                            <div style="text-align:left;">
                            <a style="text-align:left;" @click.prevent="change_sort('Mobile')">Mobile</a>
                            <span v-if="this.sort_field=='Mobile' && this.sort_direction=='asc'" @click.prevent="change_sort('Mobile')"><i class="fa-fw select-all fas"></i></span>
                            <span v-if="this.sort_field=='Mobile' && this.sort_direction=='desc'" @click.prevent="change_sort('Mobile')"><i class="fa-fw select-all fas"></i></span>
                            </div>
                        </th>
                        <th style="width:20%;">   
                            <input style="width:100%;" type="search" v-model="searchtext" placeholder="search teacher"/>
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
                                        :value="'First_name'"
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
                                </select>
                        </th>
                    </tr>
                     </thead>
                    <tbody>
                        <tr v-for="teacher in teachers" v-bind:key="teacher.id">
                            <td>
                                <div style="word-wrap: break-word;">
                                    <a @click="gotoclasses(teacher.id)"> {{ teacher.id }}</a>
                                </div>
                            </td>
                            <td>
                                 <div style="word-wrap: break-word;">
                                    <a @click="gotoclasses(teacher.id)"> {{ teacher.First_name }}</a>
                                </div>
                            </td>
                            <td>
                                <div style="word-wrap: break-word;">
                                   {{teacher.Last_Name}}
                                </div>
                            </td>
                            <td>
                                <div style="word-wrap: break-word;">
                                   {{teacher.Mobile}}
                                </div>
                            </td>
                            <td></td>
                            <td></td>
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
            teachers: [],
            Institution:{},
            institution_subjects: {},
            institution_calsses: {},
            searchtext: "",
            column: "First_name",
            errors: [],
            sort_field: "id",
            sort_direction: "desc",
            passwordshow: false,
        };
    },
     mounted() {
        this.loadInstitutions();
        this.loadInstitutionsSubjects();
        this.loadInstitutionClass();
        this.loadteachers();
    },
     watch: {
        searchtext() {
            this.loadteachers();
        },
        column() {
            this.loadteachers();
        }
    },
    methods:{
      gotoclasses(id){
            this.$router.push({path: `coordinator-teachers/${id.toString()}/teacherclasses`});
        },
         change_sort(field) {
            if (this.sort_field === field) {
                this.sort_direction =
                    this.sort_direction === "asc" ? "desc" : "asc";
            } else {
                this.sort_field = field;
                this.sort_direction = "asc";
            }
            this.loadteachers();
        },
        loadInstitutionsSubjects:function(){
            axios
                .get(this.$apiAdress +'/api/Coordintors/getNoPageInstitutionSubject?token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.institution_subjects = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        loadInstitutionClass:function(){
            axios
                .get(this.$apiAdress +'/api/Coordintors/getNoPageClasses?token='+ localStorage.getItem("api_token"))
                .then(response => {
                    //this.institution_calsses = response.data;
                    this.institution_calsses = this.filterinstitutionClasses(response.data);
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
         filterinstitutionClasses(institutioncalsses){
                return institutioncalsses.filter((institutioncalss)=>{
                   for (var i in this.institution_subjects) {
                       if(institutioncalss.institution_subject_id==this.institution_subjects[i].id)
                       {
                           return (institutioncalss.institution_subject_id==this.institution_subjects[i].id);
                       }
                    }
              });
         },
            loadteachers: function(){
                    axios.get(this.$apiAdress +'/api/Coordintors/getSortTeachers?search=' +
                        this.searchtext +
                        "&sort_field=" +
                        this.sort_field +
                        "&sort_direction=" +
                        this.sort_direction +
                        "&column=" +
                        this.column +
                        "&token=" +
                        localStorage.getItem("api_token"))
                    .then((response) => {
                      //this.teachers = response.data;
                      this.teachers = this.filterteachers(response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },   
               filterteachers(teachers){
                 return teachers.filter((teacher)=>{
                   for (var i in this.institution_calsses) {
                       if(teacher.id==this.institution_calsses[i].teacher_id)
                       {
                           return (teacher.id==this.institution_calsses[i].teacher_id);
                       }
                    }
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