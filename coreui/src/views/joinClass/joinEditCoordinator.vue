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
                  <Clabel for="name">Name:</Clabel>
                  <div>
                    <input
                      id="name"
                      type="text"
                      class="form-control"
                      minlength="3"
                      name="name"
                      v-model="teacher.name"
                      required
                      autofocus
                    />
                    <div
                      class="alert alert-danger"
                      v-if="errors && errors.name"
                    >
                      {{ errors.name[0] }}
                    </div>
                  </div>
                </CCol>
              </CRow>
              <CRow style="margin-bottom: 1rem">
                <CCol>
                  <Clabel for="email">Email:</Clabel>
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
                  <Clabel for="password" class="col-form-label"
                    >New Password</Clabel
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
      user: {},
      fields: {},
      teacher: {},
      teachers: [],
      users: [],
      nationalities: [],
      freshuser: {},
      image: "",
      success: false,
      addgeneratepass: false,
      passwordshow: false,
      errors: [],
    };
  },
  mounted() {
    this.loadusers();
    this.loadteacher();
    this.loadnationalities();
  },
  methods: {
    getphoto() {
      return this.$apiAdress + "/storage/image/" + this.freshuser.image;
    },
    getempty() {
      return this.$apiAdress + "/storage/image/no-image.jpg";
    },
    handleOnchange(e) {
      this.image = e.target.files[0];
      this.submit();
    },
    loadusers: function () {
      axios
        .get(
          this.$apiAdress +
            "/api/Coordintors/getUsers?token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.users = response.data.users;
          this.user = response.data.you;
          this.freshuser = this.filteruser()[0];
          this.fields = this.freshuser;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    loadnationalities: function () {
      axios
        .get(
          this.$apiAdress +
            "/api/Coordintors/getNationalities?token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.nationalities = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    filteruser: function () {
      return this.users.filter((userr) => {
        return userr.id == this.user;
      });
    },
    loadteacher: function () {
      axios
        .get(
          this.$apiAdress +
            "/api/Coordintors/getTeachers?token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.teachers = response.data;
          this.teacher = this.filterteacher()[0];
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    filterteacher: function () {
      return this.teachers.filter((teacher) => {
        return teacher.user_id == this.user;
      });
    },
    submit() {
      const formData = new FormData();
      formData.set("image", this.image);
      formData.set("id", this.teacher.id);
      formData.set("First_name", this.teacher.First_name);
      formData.set("Last_Name", this.teacher.Last_Name);
      formData.set("Mobile", this.teacher.Mobile);
      formData.set("Gender", this.teacher.Gender);
      formData.set("birth_date", this.teacher.birth_date);
      formData.set("nationality_id", this.teacher.nationality_id);
      if (!this.fields.password) {
        this.fields.password = this.freshuser.password;
      }
      axios
        .post(
          this.$apiAdress +
            "/api/coordintors/storeuserprofile?token=" +
            localStorage.getItem("api_token"),
          this.fields
        )
        .then((response) => {
          this.fields = {};
          this.success = true;
          this.errors = {};
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
          }
          console.log("Error");
        });
      axios
        .post(
          this.$apiAdress +
            "/api/coordintors/storeteacherprofile?token=" +
            localStorage.getItem("api_token"),
          formData
        )
        .then((response) => {
          this.teacher = {};
          this.success = true;
          this.errors = {};
          this.loadusers();
          this.loadteacher();
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