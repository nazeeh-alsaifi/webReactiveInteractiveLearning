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
        <CAlert :show.sync="alert" closeButton v-bind:color="alertColor">
          <CIcon v-bind:name="alertIcon" />
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
                  :src="viewImage"
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
                  :value.sync="activity.level_id"
                />
              </CCol>
              <CCol sm="12" md="6" l="6" xl="6">
                <CSelect
                  label="free:"
                  :options="free"
                  placeholder="Please choose a level"
                  :value.sync="activity.free"
                />
              </CCol>
            </CRow>
            <CRow>
              <CCol sm="12" md="6" l="6" xl="6">
                <CSelect
                  label="Instructional Purpose:"
                  :options="instructionalPurposes"
                  placeholder="Please choose an Instructional Purpose"
                  :value.sync="activity.instructionalPurpose_id"
                />
              </CCol>
              <CCol sm="12" md="6" l="6" xl="6">
                <CSelect
                  label="Location Instructional Cycle:"
                  :options="locationCycles"
                  placeholder="Please choose a Location Instructional Cycle"
                  :value.sync="activity.locationCycle_id"
                />
              </CCol>
            </CRow>
            <CRow>
              <CCol sm="12" md="6" l="6" xl="6">
                <CSelect
                  label="active:"
                  :options="active"
                  placeholder="Please choose a level"
                  :value.sync="activity.active"
                />
              </CCol>

              <CCol sm="12" md="6" l="6" xl="6">
                <label>Tags:</label>
                <Multiselect
                  v-model="tagsValues"
                  placeholder="Please Choose Tags"
                  label="keyword"
                  track-by="value"
                  :hideSelected="true"
                  openDirection="bottom"
                  :options="tagsOptions"
                  :multiple="true"
                >
                </Multiselect>
                <!-- <pre class="language-json"><code>{{ tagsValues  }}</code></pre> -->
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
                    <div @click="deleteSection(index)" style="cursor: pointer">
                      <CIcon style="" name="cil-x" />
                    </div>
                  </CCardHeader>
                  <CCardBody>
                    <CInput
                      label="Title:"
                      placeholder="Enter the title of the section"
                      v-model="section.title"
                    />
                    <CButton
                      shape="pill"
                      size="sm"
                      color="outline-dark"
                      @click="addComponent(index)"
                      style="margin-bottom: 1rem"
                      >Add Component <CIcon name="cil-plus"
                    /></CButton>
                    <CRow
                      v-for="(component, innerIndex) in section.components"
                      :key="innerIndex"
                    >
                      <CCol>
                        <CCard>
                          <CCardHeader
                            style="
                              display: flex;
                              justify-content: space-between;
                              background-color: #ced2d8;
                            "
                          >
                            <div>
                              Component Number {{ innerIndex + 1 }} of section
                              {{ index + 1 }}:
                            </div>
                            <div
                              @click="deleteComponent(index, innerIndex)"
                              style="cursor: pointer"
                            >
                              <CIcon style="" name="cil-x" />
                            </div>
                          </CCardHeader>
                          <CCardBody style="background-color: #ebedef">
                            <CSelect
                              label="name:"
                              :options="componentsNames"
                              placeholder="Please choose a component:"
                              :value.sync="component.name"
                          />
                          <div v-if="sections[index].components[innerIndex].name == 4">
                          <CCard>
                          <CCardHeader
                            style="
                              display: flex;
                              justify-content: space-between;
                              background-color: #ced2d8;
                            "
                          >
                          <div>Please Insert Question Data</div>
                          </CCardHeader>
                              <CCardBody>
                               <CRow>
                               <CCol sm="12" md="12" l="12" xl="12">
                              <CInput
                              label="text_description:"
                              placeholder="Enter the Text_Description of the Question"
                              v-model="sections[index].components[innerIndex].data.text_description"
                              />
                              </CCol>
                              </CRow>
                              <CRow>
                               <CCol sm="12" md="12" l="12" xl="12">
                                <CInput
                                  label="Question:"
                                  placeholder="Enter the Question"
                                  v-model="sections[index].components[innerIndex].data.Question"
                                />
                               </CCol>
                              </CRow>
                              <CRow>
                                <CCol sm="12" md="12" l="12" xl="12">
                                 <CInput
                                  label="img_src:"
                                  placeholder="Enter the img_src"
                                  v-model="sections[index].components[innerIndex].data.img_src"
                                 />               
                                </CCol>
                              </CRow>
                              </CCardBody>
                               </CCard>
                          </div>
                          <div v-if="sections[index].components[innerIndex].name == 5">
                          <CCard>
                          <CCardHeader
                            style="
                              display: flex;
                              justify-content: space-between;
                              background-color: #ced2d8;
                            "
                          >
                          <div>Please Insert Multi_Question Data</div>
                          </CCardHeader>
                            <CCardBody>
                            <CRow>
                               <CCol sm="12" md="12" l="12" xl="12">
                              <CInput
                              label="text_description:"
                              placeholder="Enter the Text_Description of the Question"
                              v-model="sections[index].components[innerIndex].data.question_text_description"
                              />
                              </CCol>
                              </CRow>
                              <CRow>
                               <CCol sm="12" md="12" l="12" xl="12">
                                <CInput
                                  label="Question:"
                                  placeholder="Enter the Question"
                                  v-model="sections[index].components[innerIndex].data.question_Question"
                                />
                               </CCol>
                              </CRow>
                              <CRow>
                                <CCol sm="12" md="12" l="12" xl="12">
                                 <CInput
                                  label="img_src:"
                                  placeholder="Enter the img_src"
                                  v-model="sections[index].components[innerIndex].data.question_img_src"
                                 />               
                                </CCol>
                              </CRow>
                              <CRow>
                                <CCol sm="12" md="12" l="12" xl="12">
                                 <CInput
                                  label="Trays_Count:"
                                  type="number"
                                  placeholder="Enter the Trays_Count"
                                  v-model="sections[index].components[innerIndex].data.Trays_Count"
                                 />               
                                </CCol>
                              </CRow>
                              <CRow>
                                <CCol sm="12" md="12" l="12" xl="12">
                                <CInput
                                  label="Question_Degree:"
                                  type="number"
                                  placeholder="Enter the Question_Degree"
                                  v-model="sections[index].components[innerIndex].data.Question_Degree"
                                />               
                                </CCol>
                              </CRow>                              
                          <CCard>
                          <CCardHeader
                            style="
                              display: flex;
                              justify-content: space-between;
                              background-color: #ced2d8;
                            "
                          >
                          <div>Please Insert First Answer Data</div>
                          </CCardHeader>
                            <CCardBody>
                              <CRow>
                               <CCol sm="12" md="12" l="12" xl="12">
                                <CInput
                                  label="First Answer:"
                                  placeholder="Enter the Answer"
                                  v-model="sections[index].components[innerIndex].data.first_answer"
                                />
                               </CCol>
                              </CRow>
                              <CRow>
                                <CCol sm="12" md="12" l="12" xl="12">
                                 <CInput
                                  label="First Answer Image"
                                  placeholder="Enter the img_src"
                                  v-model="sections[index].components[innerIndex].data.first_answer_img_src"
                                 />               
                                </CCol>
                              </CRow>
                              <CRow>
                                <CCol sm="12" md="12" l="12" xl="12">
                                 <label>First Answer Is_true:</label>
                                <select
                                 class="form-control"
                                 name="First Answer Is_true"
                                 v-model="sections[index].components[innerIndex].data.first_answer_istrue"
                                 required
                                 autofocus
                                >
                                 <option value=""></option>
                                 <option value="1">True</option>
                                 <option value="0">False</option>
                               </select>
                                </CCol>
                              </CRow>
                              </CCardBody>
                              </CCard>
                          <CCard>
                          <CCardHeader
                            style="
                              display: flex;
                              justify-content: space-between;
                              background-color: #ced2d8;
                            "
                          >
                          <div>Please Insert Second Answer Data</div>
                          </CCardHeader>
                            <CCardBody>
                              <CRow>
                               <CCol sm="12" md="12" l="12" xl="12">
                                <CInput
                                  label="Second Answer:"
                                  placeholder="Enter the Answer"
                                  v-model="sections[index].components[innerIndex].data.second_answer"
                                />
                               </CCol>
                              </CRow>
                              <CRow>
                                <CCol sm="12" md="12" l="12" xl="12">
                                 <CInput
                                  label="Second Answer Image"
                                  placeholder="Enter the img_src"
                                  v-model="sections[index].components[innerIndex].data.second_answer_img_src"
                                 />               
                                </CCol>
                              </CRow>
                              <CRow>
                                <CCol sm="12" md="12" l="12" xl="12">
                                <label>Second Answer Is_true:</label>
                                <select
                                 class="form-control"
                                 name="Second Answer Is_true"
                                 v-model="sections[index].components[innerIndex].data.second_answer_istrue"
                                 required
                                 autofocus
                                >
                                 <option value=""></option>
                                 <option value="1">True</option>
                                 <option value="0">False</option>
                               </select>
                                </CCol>
                              </CRow>
                              </CCardBody>
                              </CCard>
                              <CCard>
                          <CCardHeader
                            style="
                              display: flex;
                              justify-content: space-between;
                              background-color: #ced2d8;
                            "
                          >
                          <div>Please Insert Third Answer Data</div>
                          </CCardHeader>
                            <CCardBody>
                              <CRow>
                               <CCol sm="12" md="12" l="12" xl="12">
                                <CInput
                                  label="Third Answer:"
                                  placeholder="Enter the Answer"
                                  v-model="sections[index].components[innerIndex].data.third_answer"
                                />
                               </CCol>
                              </CRow>
                              <CRow>
                                <CCol sm="12" md="12" l="12" xl="12">
                                 <CInput
                                  label="Third Answer Image"
                                  placeholder="Enter the img_src"
                                  v-model="sections[index].components[innerIndex].data.third_answer_img_src"
                                 />               
                                </CCol>
                              </CRow>
                              <CRow>
                                <CCol sm="12" md="12" l="12" xl="12">
                                 <label>Third Answer Is_true:</label>
                                <select
                                 class="form-control"
                                 name="Third Answer Is_true"
                                 v-model="sections[index].components[innerIndex].data.third_answer_istrue"
                                 required
                                 autofocus
                                >
                                 <option value=""></option>
                                 <option value="1">True</option>
                                 <option value="0">False</option>
                               </select>
                                </CCol>
                              </CRow>
                              </CCardBody>
                              </CCard>
                            </CCardBody>
                          </CCard>
                          </div>
                          </CCardBody>
                        </CCard>
                      </CCol>
                    </CRow>
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
import Multiselect from "vue-multiselect";

export default {
  name: "CreateActivity",
  components: {
    Multiselect,
  },
  data() {
    return {
      // form
      viewImage: this.getempty(),
      activity: {},
      subjects: [],
      subSubjects: [],
      categories: [],
      subCategories: [],
      levels: [],
      active: [
        { value: 0, label: "No" },
        { value: 1, label: "Yes" },
      ],
      free: [
        { value: 0, label: "No" },
        { value: 1, label: "Yes" },
      ],
      instructionalPurposes: [],
      locationCycles: [],
      tagsValues: [],
      tagsOptions: [],
      sections: [
        {
          title: "",
          components: [],
        },
      ],
      componentsNames: [],
      //form wizard
      part: 1,
      // alert
      alert: false,
      alertColor: "",
      message: "Empty Message!",
      alertIcon: "",
    };
  },
  mounted() {
    this.loadSubjects();
    this.loadSubSubjects();
    this.loadCategories();
    this.loadSubCategories();
    this.loadLevels();
    this.loadTags();
    this.loadInstructionalPurpose();
    this.loadLocationCycles();
    this.loadComponentsNames();
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
    // handleOnchange(index,innerIndex){
    //   if(this.sections[index].components[innerIndex].name == 4){
    //   this.sections[index].components[innerIndex].data=
    //   {
    //     text_description: "",
    //     Question: "",
    //     img_src: "",
    //   };
    //   }
    // },
    // onFileChange(e,index,innerIndex){
    //   console.log("debugging image:", e.target.files[0]);
    //   var files = e.target.files || e.dataTransfer.files;
    //   if (!files.length) return;
    //   this.sections[index].components[innerIndex].data.img_src = e.target.files[0];  
    // },
    addComponent(index) {
      console.log("sections:", this.sections);
      console.log("index:", index);

      this.sections[index].components.push({
        name: "",
        data: {},
      });
    },
    deleteComponent(index, innerIndex) {
      this.sections[index].components.splice(innerIndex, 1);
    },
    addSection() {
      this.sections.push({
        title: "",
        components: [],
      });
    },
    deleteSection(index) {
      this.sections.splice(index, 1);
    },
    submit() {
      console.log("activity:", this.activity);
      console.log("sections:", this.sections);
      console.log("tagsValues:", this.tagsValues);

      if (this.valid(this.activity, this.sections, this.tagsValues)) {
        const formData = new FormData();
        formData.set("title", this.activity.title);
        formData.set("image", this.activity.image);
        formData.set("objective", this.activity.objective);
        formData.set("subject_id", this.activity.subject_id);
        formData.set("subSubject_id", this.activity.subSubject_id);
        formData.set("category_id", this.activity.category_id);
        formData.set("subCategory_id", this.activity.subCategory_id);
        formData.set("level_id", this.activity.level_id);
        formData.set("active", this.activity.active);
        formData.set("free", this.activity.free);
        formData.set(
          "instructionalPurpose_id",
          this.activity.instructionalPurpose_id
        );
        // locationCycle_Id
        formData.set("locationCycle_id", this.activity.locationCycle_id);

        formData.set(
          "sections",
          JSON.stringify(this.sections.filter((obj) => obj.title.length != 0))
        );
        formData.set("tags", JSON.stringify(this.tagsValues));

        console.log("activity:", this.activity);
        console.log("sections:", this.sections);
        // console.log("formObj", formObj);
        for (var key of formData.keys())
          console.log(key, ":", formData.get(key));
        // this.part = 2;
        axios
          .post(
            this.$apiAdress +
              "/api/activity/store?token=" +
              localStorage.getItem("api_token"),
            formData
          )
          .then((response) => {
            console.log("store activity response", self.response);
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
    getempty() {
      return this.$apiAdress + "/storage/image/no-image.jpg";
    },

    // getphoto() {
    //   return this.$apiAdress + "/storage/image/" + this.freshuser.image; //"'/"
    // },
    showAlert(message, color = "danger", icon = "cil-ban") {
      if (this.alert == true) {
        this.alert = false;
      }
      this.alertIcon = icon;
      this.alertColor = color;
      this.message = message;
      this.alert = true;
    },
    valid(activity, sections, tags) {
      var activity_keys_num = 12;
      var AllSectionsWithoutTitle = this.sections.filter(
        (obj) => obj.title.length != 0
      );
      var SectionsWithComponentsButWithoutTitle = this.sections.filter(
        (obj) => obj.title.length == 0 && obj.components.length != 0
      );
      var ComponentsWithoutSelecting = this.sections.filter((obj) => {
        var flag = true;
        obj.components.forEach(
          (com_obj) => (flag = flag & (com_obj.name.length != 0))
        );
        return flag;
      });
      if (
        Object.keys(activity).length != activity_keys_num &&
        tags.length != 0
      ) {
        this.part = 1;
        this.showAlert(
          "Please make sure that you have filled all the forms and choosen an image!" +
            Object.keys(activity).length
        );
      } else if (AllSectionsWithoutTitle.length == 0) {
        this.showAlert("You need to fill at least one title!");
      } else if (SectionsWithComponentsButWithoutTitle.length != 0) {
        this.showAlert(
          "Please make sure that you titled all sections that have components!"
        );
      } else if (ComponentsWithoutSelecting.length == 0) {
        this.showAlert("some components names are missing!");
      } else {
        this.showAlert("Completed!", "success", "cil-check");
        return true;
      }
      return false;
      // var emptyTitles =false;
      // this.sections.forEach((obj) => {

      // });
    },
    onFileChange(e) {
      console.log("debugging image:", e.target.files[0]);
      var files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      this.activity.image = e.target.files[0];
      this.createImage(files[0]);
    },
    createImage(file) {
      var image = new Image();
      var reader = new FileReader();
      var vm = this;

      reader.onload = (e) => {
        vm.viewImage = e.target.result;
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
      //TODO need implementation after merging with suliman
      axios
        .get(
          this.$apiAdress +
            "/api/LevelOfScaffolding?token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          // console.log(response);
          if (response.data.length != 0)
            // this.categories = response.data.map((obj) => obj.Cat_name);
            this.levels = response.data.map((obj) => ({
              value: obj.id,
              label: obj.Level_Name,
            }));
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    loadTags() {
      //TODO need implementation after merging with suliman
      axios
        .get(
          this.$apiAdress +
            "/api/Tag?token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          // console.log(response);
          if (response.data.length != 0)
            // this.categories = response.data.map((obj) => obj.Cat_name);
            console.log("tags:", response.data);
          this.tagsOptions = response.data.map((obj) => ({
            value: obj.id,
            keyword: obj.keyword,
          }));
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    loadInstructionalPurpose() {
      axios
        .get(
          this.$apiAdress +
            "/api/InstructionalPurpose?token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          // console.log(response);
          if (response.data.length != 0)
            // this.categories = response.data.map((obj) => obj.Cat_name);
            console.log("tags:", response.data);
          this.instructionalPurposes = response.data.map((obj) => ({
            value: obj.id,
            label: obj.Instructional_Purpose,
          }));
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    loadLocationCycles() {
      axios
        .get(
          this.$apiAdress +
            "/api/LocationInstructional?token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          // console.log(response);
          if (response.data.length != 0)
            // this.categories = response.data.map((obj) => obj.Cat_name);
            console.log("tags:", response.data);
          this.locationCycles = response.data.map((obj) => ({
            value: obj.id,
            label: obj.Location_Instructional_Cycle,
          }));
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    loadComponentsNames() {
      axios
        .get(
          this.$apiAdress +
            "/api/Component?token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          // console.log(response);
          if (response.data.length != 0)
            // this.categories = response.data.map((obj) => obj.Cat_name);
            console.log("tags:", response.data);
          this.componentsNames = response.data.map((obj) => ({
            value: obj.id,
            label: obj.Component_name,
          }));
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    /*  getUserId() {
      axios
        .get(
          this.$apiAdress +
            "/api/activity/getUserId?token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          // console.log(response);
          if (response.data.length != 0)
            // this.categories = response.data.map((obj) => obj.Cat_name);
            this.userId = resonse.data.id;
        })
        .catch(function (error) {
          console.log(error);
        });
    }, */
  },
};
</script>

<style>
</style>