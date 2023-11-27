<template>
<CCardBody>
    <div style="color:#321fdb;">Text_Description:     <a style="color:black;">{{MultiQuestions.text_description}}</a></div>
    <div style="color:#321fdb;">Question:  <a style="color:black;">{{MultiQuestions.Question}}</a></div>
    <div style="color:#321fdb;" v-if="MultiQuestions.img_src!='no-image.jpg'">Image: 
       <CImg
        :src="getimage(MultiQuestions.img_src)"
        style="
          margin-left: auto;
          margin-right: 10%;
          width: 25%;
          max-height: 25%;
          "
        block
      >
    </CImg></div>
    <div style="color:#321fdb;">Trays_Count: <a style="color:black;">{{MultiQuestionsSettings.trays_count}}</a></div>
    <div style="color:#321fdb;">Question_Degree: <a style="color:black;">{{MultiQuestionsSettings.degree}}</a></div>
    <hr>
    <CRow
      v-for="(AnswerQuestion, answerIndex) in AnswerQuestions"
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
          </CCardHeader>
          <CCardBody>

       <div style="color:#321fdb;">Answer: <a style="color:black;">{{AnswerQuestion.Answer}}</a></div>
       <div style="color:#321fdb;" v-if="AnswerQuestion.img_src!='no-image.jpg'">Image:
       <CImg
        :src="getimage(AnswerQuestion.img_src)"
        style="
          margin-left: auto;
          margin-right: 10%;
          width: 25%;
          max-height: 25%;
          "
        block
       >
       </CImg></div>
       <div v-if="AnswerQuestion.is_true == '1'">
       <div style="color:black;">This Answer Is <a style="color:red;">True</a></div>
       </div>
      <div v-if="AnswerQuestion.is_true == '0'">
       <div style="color:black;">This Answer Is <a style="color:red;">False</a></div>
       </div> 
    </CCardBody>
    </CCard>
    </CCol>
    </CRow>
</CCardBody>
</template>
<script>
import axios from 'axios'
export default {
    name: "MultiQuestion",  
    props: {
    sectioncomponentid: Number,
    },
      data: function() {
    return {
       MultiQuestions: {},
       MultiQuestionsSettings: {},
       AnswerQuestions:[],

    };
  },
    mounted() {
    this.GetQuestions();
    },

    methods: {
      getimage(img_src) {
        return this.$apiAdress + "/storage/image/" + img_src; 
      },
      GetQuestions() {
        axios.get(this.$apiAdress +"/api/Employees/" + this.sectioncomponentid + "/getQuetions?token=" +
                  localStorage.getItem("api_token"))
        .then((response) => {
          this.MultiQuestions = response.data.MultiQuestions;
          this.MultiQuestionsSettings = response.data.MultiQuestionsSettings;
          this.AnswerQuestions = response.data.AnswerQuestions;
        })
        .catch(function(error) {
          console.log(error);
        });
      }    
    }
}
</script>
<style scoped>

</style>