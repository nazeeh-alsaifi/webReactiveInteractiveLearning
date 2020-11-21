<template>
  <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
        <CCard>
          <CCardHeader>
            <strong>Invite teachers:</strong>
          </CCardHeader>
          <CCardBody>
            <CRow
              v-for="(teacher, index) in teachers"
              :key="index"
              style="margin-bottom: 1rem"
            >
              <CCol
                sm="12"
                md="2"
                xl="2"
                l="2"
                style="
                  display: flex;
                  align-items: flex-end;
                  justify-content: center;
                "
              >
                <h4>Teacher #{{ index + 1 }}:</h4>
              </CCol>
              <CCol sm="12" md="2" xl="2" l="2">
                <label>KeyClass:</label>
                <div>
                  <input
                    minlength="3"
                    type="text"
                    class="form-control"
                    :name="'kclass' + index"
                    disabled
                    autofocus
                    v-bind:placeholder="teacher.kClass"
                  />
                  <div class="alert alert-danger" v-if="errors && errors.email">
                    {{ errors.email[0] }}
                  </div>
                </div>
              </CCol>
              <CCol sm="12" md="2" xl="2" l="2">
                <label>First Name:</label>
                <div>
                  <input
                    minlength="3"
                    type="text"
                    class="form-control"
                    :name="'firstName' + index"
                    v-model="form.firstNames[index]"
                    required
                    autofocus
                  />
                  <div class="alert alert-danger" v-if="errors && errors.email">
                    {{ errors.email[0] }}
                  </div>
                </div>
              </CCol>
              <CCol sm="12" md="2" xl="2" l="2">
                <label>Last Name:</label>
                <div>
                  <input
                    minlength="3"
                    type="text"
                    class="form-control"
                    :name="'lastName' + index"
                    v-model="form.lastNames[index]"
                    required
                    autofocus
                  />
                  <div class="alert alert-danger" v-if="errors && errors.email">
                    {{ errors.email[0] }}
                  </div>
                </div>
              </CCol>
              <CCol sm="12" md="4" xl="4" l="4">
                <label>Email:</label>
                <div>
                  <input
                    type="email"
                    class="form-control"
                    :name="'email' + index"
                    v-model="form.emails[index]"
                    required
                    autocomplete="email"
                  />
                  <div class="alert alert-danger" v-if="errors && errors.email">
                    {{ errors.email[0] }}
                  </div>
                </div>
              </CCol>
            </CRow>
          </CCardBody>
          <CCardFooter>
            <CButton
              size="sm"
              color="primary"
              style="margin-right: 1rem"
              @click="submit()"
              ><CIcon name="cil-check-circle" /> Submit</CButton
            >
          </CCardFooter>
        </CCard>
      </transition>
    </CCol>
  </CRow>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      teachers: [],
      errors: [],
      fields: {},
      form: {
        firstNames: [],
        lastNames: [],
        emails: [],
      },
    };
  },
  mounted() {
    this.createTeachers();
    this.id = this.$route.params.id;
  },
  methods: {
    submit() {
      console.log(this.form);
      console.log(this.teachers);
      var request = this.formObjects(this.teachers, this.form);
      console.log(request);
      this.updateTeachers(request);
    },
    formObjects(teachers, form) {
      var request = [];
      for (var i = 0; i < teachers.length; i++) {
        const obj = {};
        obj["user_id"] = teachers[i].user_id;
        obj["firstName"] = form.firstNames[i];
        obj["lastName"] = form.lastNames[i];
        obj["email"] = form.emails[i];
        obj["kClass"] = teachers[i].kClass;
        request.push(obj);
      }
      return request;
    },
    updateTeachers(request) {
      let self = this;

      axios
        .post(this.$apiAdress + "/api/joinClass/updateTeachers", {
          data: request,
        })
        .then((response) => {
          // self.teachers = [];
          self.success = true;
          self.errors = {};
          self.$router.push({ path: "/" });
        })
        .catch((error) => {
          console.log(error);
          if (error.response.data.message == "The given data was invalid.") {
            self.message = "";
            for (let key in error.response.data.errors) {
              if (error.response.data.errors.hasOwnProperty(key)) {
                self.message += error.response.data.errors[key][0] + "  ";
              }
            }
            self.showAlert();
          } else {
            console.log(error);
            self.$router.push({ path: "/" });
          }
        });
    },
    createTeachers() {
      let self = this;
      axios
        .post(this.$apiAdress + "/api/joinClass/createTeachers", {
          id: self.$route.params.id,
        })
        .then((response) => {
          self.success = true;
          self.errors = {};
          self.teachers = response.data.users;
        })
        .catch((error) => {
          console.log(error);
          if (error.response.data.message == "The given data was invalid.") {
            self.message = "";
            for (let key in error.response.data.errors) {
              if (error.response.data.errors.hasOwnProperty(key)) {
                self.message += error.response.data.errors[key][0] + "  ";
              }
            }
            self.showAlert();
          } else {
            console.log(error);
            self.$router.push({ path: "/" });
          }
        });
    },
  },
};
</script>

<style scoped>
input:invalid {
  border: red solid 1px;
}
label {
  margin-bottom: 0.2rem;
}
</style>