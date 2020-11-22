<template>
  <CRow>
    <CCol col="12" xl="6">
      <transition name="slide">
        <CCard>
          <CCardHeader>
            <strong>Please insert your activation code:</strong>
          </CCardHeader>
          <CAlert :show.sync="dismissCountDown" color="primary" fade>
            ({{ dismissCountDown }}) {{ message }}
          </CAlert>
          <CCardBody>
            <CRow>
              <CCol sm="12">
                <CInput
                  label="Activation Code"
                  placeholder="Enter your activation code"
                  v-model="activationCode"
                />
              </CCol>
            </CRow>
          </CCardBody>
          <CCardFooter>
            <CButton
              size="sm"
              color="primary"
              style="margin-right: 1rem"
              @click="checkCode()"
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
  name: "JoinClass",
  data: () => {
    return {
      activationCode: "",
      role: "",
      message: "",
      dismissSecs: 7,
      dismissCountDown: 0,
      showDismissibleAlert: false,
    };
  },

  methods: {
    checkCode() {
      let self = this;
      axios
        .post(this.$apiAdress + "/api/activation-code", {
          activationCode: self.activationCode,
        })
        .then(function (response) {
          // console.log(response);
          self.role = response.data.role;
          self.id = response.data.id;
          self.message =
            "You activation code is valid. You will be redirected shortly...";
          console.log("role", self.role);
          if (self.role == "coordinator") {
            self.$router.push({
              path: `join-to-class/${self.id.toString()}/join-edit-coordinator-profile`,
            });
          } else if (self.role == "teacher") {
            self.$router.push({
              path: `join-to-class/${self.id.toString()}/join-edit-teacher-profile`,
            });
          }
        })
        .catch(function (error) {
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
    countDownChanged(dismissCountDown) {
      this.dismissCountDown = dismissCountDown;
    },
    showAlert() {
      this.dismissCountDown = this.dismissSecs;
    },
  },
  mounted: function () {
    // this.checkCode();
  },
};
</script>

<style>
</style>