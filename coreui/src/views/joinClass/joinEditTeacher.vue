<template>
  <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
        <CCard>
          <CCardHeader>
            <strong>Please edit your information:</strong>
          </CCardHeader>
          <CCardBody>
            <form @submit.prevent="submit">
              <div class="alert alert-success" v-show="success">
                Profile Updated Successfully.
              </div>
              <CRow>
                <CCol sm="12" md="6" xl="6" l="6" style="margin-bottom: 1rem">
                  <label>First Name:</label>
                  <div>
                    <input
                      minlength="3"
                      type="text"
                      class="form-control"
                      name="firstName"
                      v-model="fields.firstName"
                      required
                      autofocus
                    />
                    <div
                      class="alert alert-danger"
                      v-if="errors && errors.email"
                    >
                      {{ errors.email[0] }}
                    </div>
                  </div>
                </CCol>
                <CCol sm="12" md="6" xl="6" l="6" style="margin-bottom: 1rem">
                  <label>Last Name:</label>
                  <div>
                    <input
                      minlength="3"
                      type="text"
                      class="form-control"
                      name="lastName"
                      v-model="fields.lastName"
                      required
                      autofocus
                    />
                    <div
                      class="alert alert-danger"
                      v-if="errors && errors.email"
                    >
                      {{ errors.email[0] }}
                    </div>
                  </div>
                </CCol>

                <CCol sm="12" md="6" xl="6" l="6" style="margin-bottom: 1rem">
                  <label for="nationality_id">Nationality</label>
                  <select
                    class="form-control"
                    id="nationality_id"
                    name="nationality_id"
                    v-model="fields.nationality_id"
                    required
                    autofocus
                  >
                    <option
                      v-for="nationality in nationalities"
                      v-bind:key="nationality.id"
                      :value="nationality.id"
                    >
                      {{ nationality.Nationality_name }}
                    </option>
                  </select>
                  <div
                    class="alert alert-danger"
                    v-if="errors && errors.nationality_id"
                  >
                    {{ errors.nationality_id[0] }}
                  </div>
                </CCol>
                <CCol sm="12" md="6" xl="6" l="6" style="margin-bottom: 1rem">
                  <label for="mobile">Mobile:</label>
                  <input
                    id="mobile"
                    type="tel"
                    class="form-control"
                    pattern="[0]{1}[0-9]{9,12}"
                    name="mobile"
                    v-model="fields.mobile"
                    required
                    autofocus
                  />
                  <div
                    class="alert alert-danger"
                    v-if="errors && errors.mobile"
                  >
                    {{ errors.mobile[0] }}
                  </div>
                </CCol>
                <CCol sm="12" md="6" xl="6" l="6" style="margin-bottom: 1rem">
                  <label htmlFor="email">Email:</label>
                  <div>
                    <input
                      id="email"
                      type="email"
                      class="form-control"
                      name="email"
                      v-model="fields.email"
                      required
                      autocomplete="email"
                    />
                    <div
                      class="alert alert-danger"
                      v-if="errors && errors.email"
                    >
                      {{ errors.email[0] }}
                    </div>
                  </div>
                </CCol>
                <CCol sm="12" md="6" xl="6" l="6">
                  <label for="password">New Password</label>
                  <div v-if="!passwordshow">
                    <div>
                      <input
                        id="password"
                        type="password"
                        pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
                        class="form-control"
                        name="password"
                        v-model="fields.password"
                        required
                        autofocus
                      />
                      <a
                        style="margin-top: 1em"
                        class="btn btn-outline-danger"
                        v-on:click="showpass()"
                        >show</a
                      >
                      <button
                        v-if="!addgeneratepass"
                        v-on:click="genratePassAdd()"
                        style="margin-top: 1em"
                        class="btn btn-outline-info"
                      >
                        Auto Generate
                      </button>
                      <div
                        class="alert alert-danger"
                        v-if="errors && errors.password"
                      >
                        {{ errors.password[0] }}
                      </div>
                    </div>
                  </div>

                  <div v-if="passwordshow">
                    <div>
                      <input
                        id="password"
                        type="text"
                        pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
                        class="form-control"
                        name="password"
                        v-model="fields.password"
                        required
                        autofocus
                      />
                      <a
                        style="margin-top: 1em"
                        class="btn btn-outline-danger"
                        v-on:click="hidepass()"
                        >hide</a
                      >
                      <button
                        v-if="!addgeneratepass"
                        v-on:click="genratePassAdd()"
                        style="margin-top: 1em"
                        class="btn btn-outline-info"
                      >
                        Auto Generate
                      </button>
                      <div
                        class="alert alert-danger"
                        v-if="errors && errors.password"
                      >
                        {{ errors.password[0] }}
                      </div>
                    </div>
                  </div>
                </CCol>
              </CRow>

              <hr />
              <div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </CCardBody>
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
      fields: {},
      teacher: {},
      nationalities: [],
      freshuser: {},
      success: false,
      addgeneratepass: false,
      passwordshow: false,
      errors: [],
    };
  },
  mounted() {
    // this.loadteacher();
    this.id = this.$route.params.id;
    this.loadnationalities();
    console.log("router1:", this.$route);
  },
  methods: {
    /* 
    loadteacher: function () {
      axios
        .get(
          this.$apiAdress +
            "/api/joinClass/getTeacher?id=" +
            this.$route.params.id
        )
        .then((response) => {
          this.teacher = response.data;
          console.log("teacher=", this.teacher);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
     */
    submit() {
      let self = this;
      const formData = new FormData();
      formData.set("id", this.$route.params.id);
      formData.set("email", this.fields.email);
      formData.set("new_password", this.fields.password);
      formData.set("firstName", this.fields.firstName);
      formData.set("lastName", this.fields.lastName);
      formData.set("nationalityId", this.fields.nationality_id);
      formData.set("mobile", this.fields.mobile);

      /*
      if (!this.fields.password) {
        this.fields.password = this.freshuser.password;
      }
      */

      axios
        .post(this.$apiAdress + "/api/joinClass/updateTeacherProfile", formData)
        .then((response) => {
          self.success = true;
          self.errors = {};
          console.log("update teacher response", self.response);
          self.$router.push({
            path: `join-edit-teacher-profile/addStudentsNum`,
          });
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
    loadnationalities: function () {
      axios
        .get(this.$apiAdress + "/api/joinClass/getNationalities")
        .then((response) => {
          this.nationalities = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    genratePassAdd() {
      var generator = require("generate-password");
      this.fields.password = generator.generate({
        length: 10,
        numbers: true,
        lowercase: true,
        uppercase: true,
      });
      this.addgeneratepass = true;
      // return Coordinator_password;
    },
    showpass() {
      this.passwordshow = true;
    },
    hidepass() {
      this.passwordshow = false;
    },
  },
};
</script>

<style scoped>
input:invalid {
  border: red solid 1px;
}
</style>