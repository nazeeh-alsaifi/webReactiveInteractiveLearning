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

              <CRow style="margin-bottom: 1rem">
                <CCol>
                  <CLabel name="email">Email:</CLabel>
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
              </CRow>

              <CRow>
                <CCol>
                  <CLabel name="password" class="col-form-label"
                    >New Password</CLabel
                  >
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

      freshuser: {},
      success: false,
      addgeneratepass: false,
      passwordshow: false,
      errors: [],
    };
  },
  mounted() {
    // this.loadteacher();
  },
  methods: {
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
    submit() {
      const formData = new FormData();
      formData.set("id", this.$route.params.id);
      formData.set("email", this.fields.email);
      formData.set("new_password", this.fields.password);
      /*
      if (!this.fields.password) {
        this.fields.password = this.freshuser.password;
      }
      */

      axios
        .post(this.$apiAdress + "/api/joinClass/updateTeacherProfile", formData)
        .then((response) => {
          this.teacher = {};
          this.success = true;
          this.errors = {};
          console.log("update teacher response", this.response);
        })
        .catch((error) => {
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
        uppercase: true,
      });
      this.addgeneratepass = true;
      return Coordinator_password;
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