<template>
  <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
        <CCard>
          <CCardHeader>
            <strong>Please insert the number of students in your class:</strong>
          </CCardHeader>
          <CAlert :show.sync="alert" color="primary" fade>
            {{ message }}
          </CAlert>
          <CCardBody>
            <h4>Remaining Number of Seats: {{ numberOfSeats }}</h4>
            <CRow>
              <CCol sm="12" md="3" l="3" xl="3">
                <CInput
                  label="Number of Students:"
                  placeholder="Enter number of students"
                  v-model="numberOfStudents"
                />
              </CCol>
              <CCol sm="12" md="2" l="2" xl="2">
                <CInput label="Key Class:" v-model="newKeyClass" disabled />
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
      numberOfSeats: null,
      message: "",
      alert: false,
      numberOfStudents: null,
      newKeyClass: "",
    };
  },
  mounted() {
    this.id = this.$route.params.id;

    this.getRemainingSeats();
  },
  methods: {
    submit() {
      const formData = new FormData();
      formData.set("id", this.$route.params.id);
      formData.set("numberOfStudents", this.numberOfStudents);
      formData.set("newKeyClass", this.newKeyClass);

      axios
        .post(this.$apiAdress + "/api/joinClass/createStudents", formData)
        .then((response) => {
          console.log("this response:", response);
          this.numberOfSeats = response.data.remaining;
          this.showAlert("created students");
          this.$router.push({ path: "/" });
        })
        .catch(function (error) {
          this.showAlert(
            "error while trying to get the number of remaining seats!"
          );
          console.log(error);
        });
    },
    getRemainingSeats() {
      const formData = new FormData();
      formData.set("id", this.$route.params.id);
      axios
        .post(this.$apiAdress + "/api/joinClass/getRemainingSeats", formData)
        .then((response) => {
          console.log("this response:", response);
          this.numberOfSeats = response.data.remaining;
          this.newKeyClass = response.data.newKeyClass;
        })
        .catch(function (error) {
          this.showAlert(
            "error while trying to get the number of remaining seats!"
          );
          console.log(error);
        });
    },
    showAlert(message) {
      this.message = message;
      this.alert = true;
    },
    beforeDestroy() {},
  },
};
</script>

<style>
</style>