<template>
  <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
        <CCard>
          <CCardBody>
            <div class="container">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h1>Subject: {{ subject.Subject_name }}</h1>
                </div>
                <div class="panel-body">
                  <div style="text-align:left">
                    <div style="display:inline-block">
                      <a v-on:click="classActivity(myId)"  class="btn btn-primary" style="color:#ffffff;"
                        >Class Activities</a>
                    </div>
                    <hr />
                  </div>
                  <hr />
                  <table style="table-layout:fixed" class="table table-striped">
                    <thead>
                      <tr>
                        <th style="text-align:left;width:10%;">
                          <div style="text-align:left;">
                            <a
                              style="text-align:left;"
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
                        <th style="text-align:left;width:15%;">
                          <div style="text-align:left;">
                            <a
                              style="text-align:left;"
                              @click.prevent="change_sort('First_Name')"
                              >First_Name</a
                            >
                            <span
                              v-if="
                                this.sort_field == 'First_Name' &&
                                  this.sort_direction == 'asc'
                              "
                              @click.prevent="change_sort('First_Name')"
                              ><CIcon name="cil-arrow-top" /></span
                            >
                            <span
                              v-if="
                                this.sort_field == 'First_Name' &&
                                  this.sort_direction == 'desc'
                              "
                              @click.prevent="change_sort('First_Name')"
                              ><CIcon name="cil-arrow-bottom" /></span
                            >
                          </div>
                        </th>
                        <th style="text-align:left;width:15%;">
                          <div style="text-align:left;">
                            <a
                              style="text-align:left;"
                              @click.prevent="change_sort('Last_Name')"
                              >Last_Name</a
                            >
                            <span
                              v-if="
                                this.sort_field == 'Last_Name' &&
                                  this.sort_direction == 'asc'
                              "
                              @click.prevent="change_sort('Last_Name')"
                              ><CIcon name="cil-arrow-top" /></span
                            >
                            <span
                              v-if="
                                this.sort_field == 'Last_Name' &&
                                  this.sort_direction == 'desc'
                              "
                              @click.prevent="change_sort('Last_Name')"
                              ><CIcon name="cil-arrow-bottom" /></span
                            >
                          </div>
                        </th>
                        <th style="text-align:left;width:20%;">
                          <div style="text-align:left;">
                            <a
                              style="text-align:left;"
                              @click.prevent="change_sort('Mobile')"
                              >Mobile</a
                            >
                            <span
                              v-if="
                                this.sort_field == 'Mobile' &&
                                  this.sort_direction == 'asc'
                              "
                              @click.prevent="change_sort('Mobile')"
                              ><CIcon name="cil-arrow-top" /></span
                            >
                            <span
                              v-if="
                                this.sort_field == 'Mobile' &&
                                  this.sort_direction == 'desc'
                              "
                              @click.prevent="change_sort('Mobile')"
                              ><CIcon name="cil-arrow-bottom" /></span
                            >
                          </div>
                        </th>
                        <th style="width:20%;">
                          <input
                            style="width:100%;"
                            type="search"
                            v-model="searchtext"
                            placeholder="search student"
                          />
                        </th>
                        <th>
                          <a>COL</a>
                          <select
                            style="width:10%; color:#ffffff;"
                            class="btn btn-primary"
                            v-model="column"
                          >
                            <option class="form-control" :value="'First_Name'"
                              >First_Name</option
                            >
                            <option class="form-control" :value="'Last_Name'"
                              >Last_Name</option
                            >
                            <option class="form-control" :value="'Mobile'"
                              >Mobile</option
                            >
                          </select>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="student in students" v-bind:key="student.id">
                        <td>
                          <div style="word-wrap: break-word;">
                            {{ student.id }}
                          </div>
                        </td>
                        <td>
                          <div style="word-wrap: break-word;">
                            {{ student.First_Name }}
                          </div>
                        </td>
                        <td>
                          <div style="word-wrap: break-word;">
                            {{ student.Last_Name }}
                          </div>
                        </td>
                        <td>
                          <div style="word-wrap: break-word;">
                            {{ student.Mobile }}
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
import axios from "axios";
export default {
  data: function() {
    return {
      students: [],
      student_classes: [],
      subject: {},
      searchtext: "",
      column: "First_Name",
      sort_field: "id",
      sort_direction: "desc",
      myId: {},
    };
  },
  mounted() {
    this.myId = this.$route.params.id;
    this.loadStudentClasses();
    this.loadStudents();
    this.loadSubjects();
  },
  watch: {
    searchtext() {
      this.loadStudents();
    },
    column() {
      this.loadStudents();
    },
  },
  methods: {
    classActivity(id) {
      this.$router.push({
        path: `/teacher-classes/${id.toString()}/myclass/myactivities`,
      });
    },
    change_sort(field) {
      if (this.sort_field === field) {
        this.sort_direction = this.sort_direction === "asc" ? "desc" : "asc";
      } else {
        this.sort_field = field;
        this.sort_direction = "asc";
      }
      this.loadStudents();
    },
    loadSubjects: function() {
      axios
        .get(
          this.$apiAdress +
            "/api/Teachers/" +
            this.myId +
            "/getMyClassSubject?token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.subject = response.data;
          //this.subject = this.filterSubject(response.data.data)[0];
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    loadStudents: function() {
      axios
        .get(
          this.$apiAdress +
            "/api/Teachers/getStudents?search=" +
            this.searchtext +
            "&sort_field=" +
            this.sort_field +
            "&sort_direction=" +
            this.sort_direction +
            "&column=" +
            this.column +
            "&token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          //this.students = response.data;
          this.students = this.filterStudent(response.data);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    filterStudent(students) {
      return students.filter((student) => {
        for (var i in this.student_classes) {
          if (student.id == this.student_classes[i].student_id) {
            return student.id == this.student_classes[i].student_id;
          }
        }
      });
    },
    loadStudentClasses: function() {
      axios
        .get(
          this.$apiAdress +
            "/api/Teachers/" +
            this.myId +
            "/getStudentClasses?token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.student_classes = response.data;
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
