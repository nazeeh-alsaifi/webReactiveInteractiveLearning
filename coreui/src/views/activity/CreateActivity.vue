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
                    max-width: 200px;
                    max-height: 200px;
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
                  rows="5"
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
            <!--
            <CRow>
              <CCol sm="12" md="6" l="6" xl="6">
                <CSelect
                  label="Category:"
                  :options="filterAndConvertCategories"
                  placeholder="Please choose a category"
                  :value.sync="activity.category_id"
                />
              </CCol>-->
<!--               <CCol sm="12" md="6" l="6" xl="6">
                 <CInput
                  label="Sub Subject:"
                  placeholder="Enter the SubSubject of the activity"
                  v-model="activity.subSubject"
                /> -->
<!--                <CSelect
                  label="Sub Category:"
                  :options="filterAndConvertSubCategories"
                  placeholder="Please choose a sub-category"
                  :value.sync="activity.subCategory_id"
                />
              </CCol>
            </CRow>-->
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
                              @change="OnchangeComponent(index, innerIndex)"
                              :options="componentsNames"
                              placeholder="Please choose a component:"
                              :value.sync="component.name"
                            />
                            <div
                              v-if="
                                sections[index].components[innerIndex].name == 4
                              "
                            >
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
                                        v-model="
                                          sections[index].components[innerIndex]
                                            .data.text_description
                                        "
                                      />
                                    </CCol>
                                  </CRow>
                                  <CRow>
                                    <CCol sm="12" md="12" l="12" xl="12">
                                      <CInput
                                        label="Question:"
                                        placeholder="Enter the Question"
                                        v-model="
                                          sections[index].components[innerIndex]
                                            .data.Question
                                        "
                                      />
                                    </CCol>
                                  </CRow>
                                  <CRow>
                                    <CCol sm="12" md="12" l="12" xl="12">
                                      <label name="image">
                                        Question Image:</label
                                      >
                                      <div>
                                        <input
                                          @change="
                                            onChangeEndQuestionImage(
                                              $event,
                                              index,
                                              innerIndex
                                            )
                                          "
                                          type="file"
                                          accept="image/*"
                                        />
                                      </div>
                                      <div v-if="sections[index].components[innerIndex].data.img_src ==''">
                                      <CImg
                                       :src="getempty()"
                                        style="
                                          margin-left: auto;
                                          margin-right: 10%;
                                          width: 25%;
                                          max-height: 25%;
                                        "
                                        block
                                      >
                                      </CImg>
                                      </div>
                                       <div v-if="sections[index].components[innerIndex].data.img_src !=''">
                                      <CImg
                                       :src="viewEndQuestionImage[index].viewImage[innerIndex]"
                                        style="
                                          margin-left: auto;
                                          margin-right: 10%;
                                          width: 25%;
                                          max-height: 25%;
                                        "
                                        block
                                      >
                                      </CImg>
                                      </div>
                                    </CCol>
                                  </CRow>
                                  <hr>
                                  <CButton
                                    shape="pill"
                                    size="sm"
                                    color="outline-dark"
                                    @click="addComponent(index)"
                                    style="margin-bottom: 1rem"
                                    >Add Component <CIcon name="cil-plus"
                                  /></CButton>
                                </CCardBody>
                              </CCard>
                            </div>
                            <div
                              v-if="
                                sections[index].components[innerIndex].name == 5
                              "
                            >
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
                                        v-model="
                                          sections[index].components[innerIndex]
                                            .data.question_text_description
                                        "
                                      />
                                    </CCol>
                                  </CRow>
                                  <CRow>
                                    <CCol sm="12" md="12" l="12" xl="12">
                                      <CInput
                                        label="Question:"
                                        placeholder="Enter the Question"
                                        v-model="
                                          sections[index].components[innerIndex]
                                            .data.question_Question
                                        "
                                      />
                                    </CCol>
                                  </CRow>
                                  <CRow>
                                    <CCol sm="12" md="12" l="12" xl="12">
                                      <label name="image">
                                        Question Image:</label
                                      >
                                      <div>
                                        <input
                                          @change="
                                            onChangeMultiQuestionImage(
                                              $event,
                                              index,
                                              innerIndex
                                            )
                                          "
                                          type="file"
                                          accept="image/*"
                                        />
                                      </div>
                                      <div v-if=" sections[index].components[innerIndex]
                                            .data.question_img_src ==''">
                                      <CImg
                                       :src="getempty()"
                                        style="
                                          margin-left: auto;
                                          margin-right: 10%;
                                          width: 25%;
                                          max-height: 25%;
                                        "
                                        block
                                      >
                                      </CImg>
                                      </div>
                                       <div v-if=" sections[index].components[innerIndex]
                                            .data.question_img_src !=''">
                                      <CImg
                                       :src="viewMultiQuestionImage[index].viewImage[innerIndex]"
                                        style="
                                          margin-left: auto;
                                          margin-right: 10%;
                                          width: 25%;
                                          max-height: 25%;
                                        "
                                        block
                                      >
                                      </CImg>
                                      </div>
                                    </CCol>
                                  </CRow>
                                  <hr />
                                  <CRow>
                                    <CCol sm="12" md="12" l="12" xl="12">
                                      <CInput
                                        label="Trays_Count:"
                                        type="number"
                                        placeholder="Enter the Trays_Count"
                                        v-model="
                                          sections[index].components[innerIndex]
                                            .data.Trays_Count
                                        "
                                      />
                                    </CCol>
                                  </CRow>
                                  <CRow>
                                    <CCol sm="12" md="12" l="12" xl="12">
                                      <CInput
                                        label="Question_Degree:"
                                        type="number"
                                        placeholder="Enter the Question_Degree"
                                        v-model="
                                          sections[index].components[innerIndex]
                                            .data.Question_Degree
                                        "
                                      />
                                    </CCol>
                                  </CRow>
                                  <CRow
                                    v-for="(answer, answerIndex) in sections[
                                      index
                                    ].components[innerIndex].data.answers"
                                    :key="answerIndex"
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
                                            Answer Number
                                            {{ answerIndex + 1 }} Data
                                          </div>
                                          <div
                                            @click="
                                              deleteAnswer(
                                                index,
                                                innerIndex,
                                                answerIndex
                                              )
                                            "
                                            style="cursor: pointer"
                                          >
                                            <CIcon style="" name="cil-x" />
                                          </div>
                                        </CCardHeader>
                                        <CCardBody
                                          style="background-color: #ebedef"
                                        >
                                          <CRow>
                                            <CCol
                                              sm="12"
                                              md="12"
                                              l="12"
                                              xl="12"
                                            >
                                              <CInput
                                                label="Answer:"
                                                placeholder="Enter the Answer"
                                                v-model="
                                                  sections[index].components[
                                                    innerIndex
                                                  ].data.answers[answerIndex]
                                                    .answer
                                                "
                                              />
                                            </CCol>
                                          </CRow>
                                          <CRow>
                                            <CCol
                                              sm="12"
                                              md="12"
                                              l="12"
                                              xl="12"
                                            >
                                              <label name="image"
                                                >Answer Image:</label
                                              >
                                              <div>
                                                <input
                                                  @change="
                                                    onChangeMultiQuestionAnswerImage(
                                                      $event,
                                                      index,
                                                      innerIndex,
                                                      answerIndex
                                                    )
                                                  "
                                                  type="file"
                                                  accept="image/*"
                                                />
                                              </div>
                                              <div v-if=" sections[index].components[innerIndex]
                                                   .data.answers[answerIndex]
                                                    .answer_img_src ==''">
                                              <CImg
                                              :src="getempty()"
                                                style="
                                                  margin-left: auto;
                                                  margin-right: 10%;
                                                  width: 25%;
                                                  max-height: 25%;
                                                "
                                                block
                                              >
                                              </CImg>
                                              </div>
                                              <div v-if=" sections[index].components[innerIndex]
                                                   .data.answers[answerIndex]
                                                    .answer_img_src !=''">
                                              <CImg
                                              :src="viewMultiAnswersImage[index].viewImage[innerIndex].answers[answerIndex]"
                                                style="
                                                  margin-left: auto;
                                                  margin-right: 10%;
                                                  width: 25%;
                                                  max-height: 25%;
                                                "
                                                block
                                              >
                                              </CImg>
                                              </div>
                                            </CCol>
                                          </CRow>
                                          <hr />
                                          <CRow>
                                            <CCol
                                              sm="12"
                                              md="12"
                                              l="12"
                                              xl="12"
                                            >
                                              <label>Answer Is_true:</label>
                                              <select
                                                class="form-control"
                                                name="Answer Is_true"
                                                v-model="
                                                  sections[index].components[
                                                    innerIndex
                                                  ].data.answers[answerIndex]
                                                    .answer_is_true
                                                "
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
                                    </CCol>
                                  </CRow>
                                  <CButton
                                    shape="pill"
                                    size="sm"
                                    color="outline-danger"
                                    @click="addAnswer(index, innerIndex)"
                                    style="margin-bottom: 1rem"
                                    >Add Answer <CIcon name="cil-plus"
                                  /></CButton>
                                  <CButton
                                    shape="pill"
                                    size="sm"
                                    color="outline-dark"
                                    @click="addComponent(index)"
                                    style="margin-bottom: 1rem"
                                    >Add Component <CIcon name="cil-plus"
                                  /></CButton>
                                </CCardBody>
                              </CCard>
                            </div>
                            <!--------------- video component creation -->
                            <CCard v-if="component.name == 1">
                              <CCardHeader style="background-color: #ced2d8">
                                Please Fill Video Data:
                              </CCardHeader>
                              <CCardBody>
                                <div style="display: flex">
                                  <label
                                    name="video"
                                    style="margin-right: 1rem"
                                  >
                                    upload video:
                                  </label>
                                  <input
                                    @change="
                                      onVideoChange($event, index, innerIndex)
                                    "
                                    type="file"
                                  />
                                </div>

                                <CInput
                                  label="frames per second:"
                                  placeholder="Enter the fps of this video "
                                  v-model="component.data.fps"
                                />
                                <CButton
                                  shape="pill"
                                  size="sm"
                                  color="outline-danger"
                                  @click="addTool(index, innerIndex)"
                                  style="margin-bottom: 1rem"
                                  >Tool <CIcon name="cil-plus"
                                /></CButton>
                                <CCard
                                  body-wrapper
                                  v-for="(tool, toolIndex) in component.data
                                    .tools"
                                  :key="toolIndex"
                                >
                                  <CSelect
                                    label="name:"
                                    :options="measureTools"
                                    placeholder="Please choose a component:"
                                    :value.sync="tool.toolName"
                                  />
                                </CCard>
                              </CCardBody>
                            </CCard>
                          </CCardBody>
                        </CCard>
                      </CCol>
                    </CRow>
                    <CRow style="margin-bottom: 1rem">
                      <CCol sm="12" md="6" l="6" xl="6">
                        <CButton size="sm" color="info" @click="addSection"
                          >Add Section <CIcon name="cil-plus"
                        /></CButton>
                      </CCol>
                    </CRow>
                  </CCardBody>
                </CCard>
              </CCol>
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
      measureTools: [],
      //
      viewEndQuestionImage: [],
      viewMultiQuestionImage: [],
      viewMultiAnswersImage: [],
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
    this.loadMeasureTools();
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
    onChangeEndQuestionImage(e, index, innerIndex){
     this.sections[index].components[innerIndex].data.img_src = e.target.files[0];
          var files = e.target.files || e.dataTransfer.files;
         this.createEndQuestionImage(files[0], index, innerIndex);
    },
    createEndQuestionImage(file, index, innerIndex) {
      //var image = new Image();
      var reader = new FileReader();
      var vm = this;
       if(!vm.viewEndQuestionImage[index])
       {
         vm.viewEndQuestionImage[index]={viewImage:[]}
       }
      reader.onload = (e) => {
        vm.viewEndQuestionImage[index].viewImage[innerIndex] = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    onChangeMultiQuestionAnswerImage(e, index, innerIndex, answerIndex) {
      this.sections[index].components[innerIndex].data.answers[answerIndex].answer_img_src = e.target.files[0];
       var files = e.target.files || e.dataTransfer.files;
         this.createMultiQuestionAnswerImage(files[0], index, innerIndex, answerIndex);
    },
    createMultiQuestionAnswerImage(file, index, innerIndex, answerIndex) {
      //var image = new Image();
      var reader = new FileReader();
      var vm = this;
       if(!vm.viewMultiAnswersImage[index])
       {
         vm.viewMultiAnswersImage[index]={viewImage:[]}
          if(!vm.viewMultiAnswersImage[index].viewImage[innerIndex])
          {
             vm.viewMultiAnswersImage[index].viewImage[innerIndex]={answers:[]}
          }
       }
       if(vm.viewMultiAnswersImage[index])
       {
          if(!vm.viewMultiAnswersImage[index].viewImage[innerIndex])
          {
             vm.viewMultiAnswersImage[index].viewImage[innerIndex]={answers:[]}
          }
       }
      reader.onload = (e) => {
        vm.viewMultiAnswersImage[index].viewImage[innerIndex].answers[answerIndex] = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    onChangeMultiQuestionImage(e, index, innerIndex) {
      console.log("debugging image:", e.target.files[0]);
      this.sections[index].components[innerIndex].data.question_img_src =
        e.target.files[0];
      var files = e.target.files || e.dataTransfer.files;
         this.createMultiQuestionImage(files[0], index, innerIndex);
    },
    createMultiQuestionImage(file, index, innerIndex) {
      //var image = new Image();
      var reader = new FileReader();
      var vm = this;
       if(!vm.viewMultiQuestionImage[index])
       {
         vm.viewMultiQuestionImage[index]={viewImage:[]}
       }
      reader.onload = (e) => {
        vm.viewMultiQuestionImage[index].viewImage[innerIndex] = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    OnchangeComponent(index, innerIndex) {
      if (this.sections[index].components[innerIndex].name == 4) {
      this.sections[index].components[innerIndex].data.img_src = ""; 
      }
      if (this.sections[index].components[innerIndex].name == 5) {
        this.sections[index].components[innerIndex].data = {
          question_img_src: "",
          answers: [
            {
              answer: "",
              answer_img_src: "",
              answer_is_true: "",
            },
            {
              answer: "",
              answer_img_src: "",
              answer_is_true: "",
            },
          ],
        };
      }
    },
    deleteAnswer(index, innerIndex, answerIndex) {
      if (this.sections[index].components[innerIndex].data.answers.length > 2) {
        this.sections[index].components[innerIndex].data.answers.splice(
          answerIndex,
          1
        );
        if(this.viewMultiAnswersImage[index].viewImage[innerIndex].answers[answerIndex])
        {
         this.viewMultiAnswersImage[index].viewImage[innerIndex].answers.splice(answerIndex,1);
        }
      }      
    },
    addAnswer(index, innerIndex) {
      this.sections[index].components[innerIndex].data.answers.push({
        answer: "",
        answer_img_src: "",
        answer_is_true: "",
      });
    },
    onVideoChange(e, index, innerIndex) {
      this.sections[index].components[innerIndex].data.video =
        e.target.files[0];
    },
    addTool(index, innerIndex) {
      const options_obj = this.sections[index].components[innerIndex].data;
      if ("tools" in options_obj) {
        console.log("tools in options_obj:", "tools" in options_obj);
        options_obj.tools.push({
          toolName: "",
        });
      } else {
        this.$set(options_obj, "tools", []);
        options_obj.tools.push({
          toolName: "",
        });
      }
    },
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
      if(this.viewEndQuestionImage[index])
      {
        if(this.viewEndQuestionImage[index].viewImage[innerIndex])
        {
          this.viewEndQuestionImage[index].viewImage.splice(innerIndex, 1);
        }
      }
      if(this.viewMultiQuestionImage[index])
      {
          if(this.viewMultiQuestionImage[index].viewImage[innerIndex])
          {
            this.viewMultiQuestionImage[index].viewImage.splice(innerIndex, 1);
          }
      }    
    },
    addSection() {
      this.sections.push({
        title: "",
        components: [],
      });
    },
    deleteSection(index) {
      this.sections.splice(index, 1);
       if(this.viewEndQuestionImage[index])
      {
         this.viewEndQuestionImage.splice(index, 1);
      }
      if(this.viewMultiQuestionImage[index])
      {
         this.viewMultiQuestionImage.splice(index, 1);
      }
    },
    submit() {
      console.log("activity:", this.activity);
      console.log("sections:", this.sections);
      console.log("tagsValues:", this.tagsValues);

      // if (this.valid(this.activity, this.sections, this.tagsValues)) {
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
      //////
      for (var index = 0; index < this.sections.length; index++) {
        if (this.sections[index].components) {
          for (
            var innerindex = 0;
            innerindex < this.sections[index].components.length;
            innerindex++
          ) {
            if (this.sections[index].components[innerindex].name == 4) {
               if (this.sections[index].components[innerindex].data.img_src) {
                let endquestionimage = this.sections[index].components[innerindex].data
                  .img_src;
                formData.set(
                  "endqimage" + index.toString() + innerindex.toString(),
                  endquestionimage
                );
              }
            }
            if (this.sections[index].components[innerindex].name == 5) {
              if (
                this.sections[index].components[innerindex].data
                  .question_img_src
              ) {
                let multi = this.sections[index].components[innerindex].data
                  .question_img_src;
                formData.set(
                  "qimage" + index.toString() + innerindex.toString(),
                  multi
                );
              }
              for (
                var answerindex = 0;
                answerindex <
                this.sections[index].components[innerindex].data.answers.length;
                answerindex++
              ) {
                if (
                  this.sections[index].components[innerindex].data.answers[
                    answerindex
                  ].answer_img_src
                ) {
                  let answerimage = this.sections[index].components[innerindex]
                    .data.answers[answerindex].answer_img_src;
                  formData.set(
                    "answerimage" +
                      index.toString() +
                      innerindex.toString() +
                      answerindex.toString(),
                    answerimage
                  );
                }
              }
            }
            if (this.sections[index].components[innerindex].name == 1) {
              var videoFile = this.sections[index].components[innerindex].data
                .video;
              if (videoFile) {
                formData.set("video" + index + innerindex, videoFile);
              }
            }
          }
        }
      }
      console.log("FormData:", formData);
      /////
      console.log("activity:", this.activity);
      console.log("sections:", this.sections);
      // console.log("formObj", formObj);
      for (var key of formData.keys()) console.log(key, ":", formData.get(key));
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
      // }
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
    loadMeasureTools() {
      axios
        .get(
          this.$apiAdress +
            "/api/Measuretool?token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          // console.log(response);
          if (response.data.length != 0)
            // this.categories = response.data.map((obj) => obj.Cat_name);
            // console.log("tags:", response.data);
            this.measureTools = response.data.map((obj) => ({
              value: obj.measureTool_name,
              label: obj.measureTool_name,
            }));
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>

<style>
</style>