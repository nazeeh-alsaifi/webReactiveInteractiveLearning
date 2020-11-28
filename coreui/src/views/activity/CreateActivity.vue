<template>
  <CRow>
    <CCol col="12" xl="12">
      <CCard>
        <CCardHeader>
          <strong v-if="part == 1">Please fill your activity:</strong>
          <strong v-if="part == 2"
            >Please add the sections and fill their titles:</strong
          >
        </CCardHeader>
        <CAlert :show.sync="alert" closeButton color="danger">
          <CIcon name="cil-ban" />
          {{ message }}
        </CAlert>
        <transition name="slide">
          <CCardBody v-if="part == 1">
            <CRow>
              <CCol sm="12" md="12" l="12" xl="12">
                <CInput
                  label="Title:"
                  placeholder="Enter the title of the activity"
                  v-model="activity.title"
                />
              </CCol>
            </CRow>

            <CRow style="margin-bottom: 1rem">
              <!-- <CCol>
                <CJumbotron
                  v-bind:style="'background-image:url(' + getempty() + ')'"
                >
                </CJumbotron>
              </CCol> -->
              <CCol>
                <!-- <CInputFile
                  label="Activity Image"
                  @change="handleOnchange"
                  type="file"
                  accept="image/*"
                /> -->
                <label name="image"> Activity Image:</label>
                <div>
                  <input @change="onFileChange" type="file" accept="image/*" />
                </div>
              </CCol>
            </CRow>
            <CRow style="margin-bottom: 1rem">
              <CCol>
                <!-- <CImg v-if="!activity.image" :src="getempty()" fluid> </CImg> -->
                <CImg
                  :src="activity.image"
                  style="
                    margin-left: auto;
                    margin-right: auto;
                    width: 60%;
                    max-height: 480px;
                  "
                  block
                >
                </CImg>
              </CCol>
            </CRow>
            <CRow>
              <CCol sm="12" md="12" l="12" xl="12">
                <CTextarea
                  label="Learning Objective:"
                  placeholder="Enter the learning objective of this activity"
                  v-model="activity.objective"
                  rows="9"
                  columns="9"
                />
              </CCol>
            </CRow>
            <CRow>
              <CCol sm="12" md="6" l="6" xl="6">
                <!-- <CInput
                  label="Subject:"
                  placeholder="Enter the subject of the activity"
                  v-model="activity.subject"
                /> -->
                <CSelect
                  label="Subject:"
                  :options="subjects"
                  placeholder="Please choose a subject"
                  :value.sync="activity.subject_id"
                />
              </CCol>
              <CCol sm="12" md="6" l="6" xl="6">
                <!-- <CInput
                  label="Sub Subject:"
                  placeholder="Enter the SubSubject of the activity"
                  v-model="activity.subSubject"
                /> -->
                <CSelect
                  label="Sub Subject:"
                  :options="filterAndConvertSubSubjects"
                  placeholder="Please choose a sub-subject"
                  :value.sync="activity.subSubject_id"
                />
              </CCol>
            </CRow>
            <CRow>
              <CCol sm="12" md="6" l="6" xl="6">
                <CSelect
                  label="Category:"
                  :options="filterAndConvertCategories"
                  placeholder="Please choose a category"
                  :value.sync="activity.category_id"
                />
              </CCol>
              <CCol sm="12" md="6" l="6" xl="6">
                <!-- <CInput
                  label="Sub Subject:"
                  placeholder="Enter the SubSubject of the activity"
                  v-model="activity.subSubject"
                /> -->
                <CSelect
                  label="Sub Category:"
                  :options="filterAndConvertSubCategories"
                  placeholder="Please choose a sub-category"
                  :value.sync="activity.subCategory_id"
                />
              </CCol>
            </CRow>
            <CRow>
              <CCol sm="12" md="6" l="6" xl="6">
                <CSelect
                  label="Level:"
                  :options="levels"
                  placeholder="Please choose a level"
                  :value.sync="activity.level"
                />
              </CCol>
            </CRow>
          </CCardBody>
        </transition>
        <!-- --------------------------------------------- Part2 -->
        <transition name="slide">
          <CCardBody v-if="part == 2">
            <CRow style="margin-bottom: 1rem">
              <CCol sm="12" md="6" l="6" xl="6">
                <CButton size="sm" color="info" @click="addSection"
                  >Add Section <CIcon name="cil-plus"
                /></CButton>
              </CCol>
            </CRow>
            <CRow v-for="(section, index) in sections" :key="index">
              <CCol>
                <CCard>
                  <CCardHeader
                    style="display: flex; justify-content: space-between"
                  >
                    <div>Section Number {{ index + 1 }}:</div>
                    <div @click="deleteSection" style="cursor: pointer">
                      <CIcon style="" name="cil-x" />
                    </div>
                  </CCardHeader>
                  <CCardBody>
                    <CInput
                      label="Title:"
                      placeholder="Enter the title of the section"
                      v-model="section.title"
                    />
                  </CCardBody>
                </CCard>
              </CCol>
              <!-- <CCol sm="12" md="6" l="6" xl="6">
                <CInput
                  :label="'Section Number ' + (index + 1) + ':'"
                  placeholder="Enter the title of the section"
                  v-model="section.title"
                />
              </CCol> -->
            </CRow>
          </CCardBody>
        </transition>
        <CCardFooter>
          <CButton
            size=""
            color="danger"
            style="margin-right: 1rem"
            v-if="part > 1"
            v-on:click="part == 1 ? part : part--"
            ><CIcon name="cil-arrow-left" /> Back</CButton
          >
          <CButton
            size=""
            color="success"
            v-if="part < 2"
            v-on:click="part == 2 ? part : part++"
          >
            Next <CIcon name="cil-arrow-thick-from-left"
          /></CButton>

          <CButton
            type="submit"
            size=""
            color="outline-warning"
            v-if="part == 2"
            @click="submit"
          >
            Submit
            <CIcon name="cil-check"
          /></CButton>
        </CCardFooter>
      </CCard>
      <!---------------------------------------------------------------PART 2  -->
      <!-- <CCard v-if="part == 2">
        <CCardFooter>
          <CButton type="submit" size="sm" color="success" v-on:click="part = 2"
            ><CIcon name="cil-check-circle" /> Next</CButton
          >
        </CCardFooter>
      </CCard> -->
    </CCol>
  </CRow>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      // form
      activity: {
        image: this.getempty(),
      },
      subjects: [],
      subSubjects: [],
      categories: [],
      subCategories: [],
      levels: ["Advanced", "Hard", "Medium", "Easy"],
      sections: [
        {
          title: "",
        },
      ],

      //form wizard
      part: 1,

      // alert
      alert: true,
      message: "Empty Message!",
    };
  },
  mounted() {
    this.loadSubjects();
    this.loadSubSubjects();
    this.loadCategories();
    this.loadSubCategories();
  },
  computed: {
    // convertSubjects() {
    //   return this.subjects.map((obj) => obj.Subject_name);
    // },
    filterAndConvertSubSubjects() {
      return this.subSubjects
        .filter((obj) => this.activity.subject_id == obj.subject_id)
        .map((obj) => ({ value: obj.id, label: obj.sub_subject_name }));
    },
    filterAndConvertCategories() {
      return this.categories
        .filter((obj) => this.activity.subject_id == obj.subject_id)
        .map((obj) => ({ value: obj.id, label: obj.Cat_name }));
    },
    filterAndConvertSubCategories() {
      return this.subCategories
        .filter((obj) => this.activity.category_id == obj.category_id)
        .map((obj) => ({ value: obj.id, label: obj.sub_cat_name }));
    },
  },
  methods: {
    addSection() {
      this.sections.push({
        title: "",
      });
    },
    deleteSection(index) {
      this.sections.splice(index, 1);
    },
    submit() {
      const formData = new FormData();
      formData.set("title", this.activity.title);
      formData.set("image", this.activity.image);
      formData.set("objective", this.activity.objective);
      formData.set("subject_id", this.activity.subject_id);
      formData.set("subSubject_id", this.activity.subSubject_id);
      formData.set("category_id", this.activity.category_id);
      formData.set("subCategory", this.activity.subCategory_id);
      formData.set("level", this.activity.level);
      formData.set("sections", this.sections);

      for (var key of formData.keys()) console.log(key, ":", formData.get(key));

      // this.part = 2;
    },
    getempty() {
      return this.$apiAdress + "/storage/image/no_image.png";
    },

    // getphoto() {
    //   return this.$apiAdress + "/storage/image/" + this.freshuser.image; //"'/"
    // },

    onFileChange(e) {
      console.log("debugging image:", e.target.files[0]);
      var files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      this.createImage(files[0]);
    },
    createImage(file) {
      var image = new Image();
      var reader = new FileReader();
      var vm = this;

      reader.onload = (e) => {
        vm.activity.image = e.target.result;
      };
      reader.readAsDataURL(file);
    },

    loadSubjects() {
      axios
        .get(
          this.$apiAdress +
            "/api/Subjects?token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          // console.log(response);
          if (response.data.length != 0)
            this.subjects = response.data.map((obj) => ({
              value: obj.id,
              label: obj.Subject_name,
            }));
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    loadSubSubjects() {
      axios
        .get(
          this.$apiAdress +
            "/api/SubSubject?token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          // console.log(response);
          if (response.data.length != 0)
            // this.subSubjects = response.data.map((obj) => obj.sub_subject_name);
            this.subSubjects = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    loadCategories() {
      axios
        .get(
          this.$apiAdress +
            "/api/Category?token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          // console.log(response);
          if (response.data.length != 0)
            // this.categories = response.data.map((obj) => obj.Cat_name);
            this.categories = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    loadSubCategories() {
      axios
        .get(
          this.$apiAdress +
            "/api/SubCategory?token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          // console.log(response);
          if (response.data.length != 0)
            // this.categories = response.data.map((obj) => obj.Cat_name);
            this.subCategories = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    loadLevels() {
      // need implementation after merging with suliman
    },
  },
};
</script>

<style>
</style>