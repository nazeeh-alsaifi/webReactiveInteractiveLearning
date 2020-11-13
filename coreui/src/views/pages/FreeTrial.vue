<template>
  <CRow>
    <CCol col="12" xl="6">
      <transition name="slide">
        <CCard>
          <CCardBody>
    <div class="container">
        <div class="alert alert-success" v-show="success">Thank you for completing the registration process Please check the email you will receive, activate copy it and enter it to join to class .</div>
    <form @submit.prevent="submit">
        <div class="container">
          <h1>Free Trail:</h1>
            <hr> 
        <div v-if="part1">    
        <div class="form-group row"> 
            <label for="First_Name" class="col-md-4 col-form-label text-md-right">First Name</label>

            <div class="col-md-6">
                <input id="First_Name" type="text" minlength="3" class="form-control" name="First_Name" v-model="fields.First_Name" required autofocus>
                <div class="alert alert-danger" v-if="errors && errors.First_Name">
                    {{ errors.First_Name[0] }}
                </div>
            </div>
        </div>

        <div class="form-group row"> 
            <label for="Last_Name" class="col-md-4 col-form-label text-md-right">Last Name</label>

            <div class="col-md-6">
                <input id="Last_Name" type="text" minlength="3" class="form-control" name="Last_Name" v-model="fields.Last_Name" required autofocus>
                <div class="alert alert-danger" v-if="errors && errors.Last_Name">
                    {{ errors.Last_Name[0] }}
                </div>
            </div>
        </div>

        <div class="form-group row"> 
            <label for="Email" class="col-md-4 col-form-label text-md-right">Email</label>

            <div class="col-md-6">
                <input id="Email" type="email" class="form-control" name="Email" v-model="fields.Email" required autocomplete="Email" autofocus>
                <div class="alert alert-danger" v-if="errors && errors.Email">
                    {{ errors.Email[0] }}
                </div>
            </div>
        </div>

        <div class="form-group row"> 
            <label for="Mobile" class="col-md-4 col-form-label text-md-right">Mobile</label>
            <div class="col-md-6">
                <input id="Mobile" type="tel" class="form-control" pattern="[0]{1}[0-9]{9,12}" name="Mobile" v-model="fields.Mobile" required autofocus>
                <div class="alert alert-danger" v-if="errors && errors.Mobile">
                    {{ errors.Mobile[0] }}
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="Academy_Type" class="col-md-4 col-form-label text-md-right">Choose Academy_Type</label>

            <div class="col-md-6">
                <select class="form-control" id="Academy_Type" name="Academy_Type" v-model="fields.Academy_Type" required autofocus>
                     <option v-for="academicLevel in academicLevels" v-bind:key="academicLevel.id" :value="academicLevel.id">{{ academicLevel.AcademicLevel }}</option>
                </select>
                <div class="alert alert-danger" v-if="errors && errors.Academy_Type">
                    {{ errors.Academy_Type[0] }}
                </div>
            </div>
        </div>

        <div class="form-group row"> 
            <label for="Institution_Name" class="col-md-4 col-form-label text-md-right">Institution_Name</label>

            <div class="col-md-6">
                <input id="Institution_Name" type="text" minlength="3" class="form-control" name="Institution_Name" v-model="fields.Institution_Name" required autofocus>
                <div class="alert alert-danger" v-if="errors && errors.Institution_Name">
                    {{ errors.Institution_Name[0] }}
                </div>
            </div>
        </div>

        <div class="form-group row"> 
            <label for="Department_Of_Institution" class="col-md-4 col-form-label text-md-right">Department_Of_Institution</label>

            <div class="col-md-6">
                <input id="Department_Of_Institution" type="text" class="form-control" name="Department_Of_Institution" v-model="fields.Department_Of_Institution" required autofocus>
                <div class="alert alert-danger" v-if="errors && errors.Department_Of_Institution">
                    {{ errors.Department_Of_Institution[0] }}
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="Country" class="col-md-4 col-form-label text-md-right">Choose Country</label>

            <div class="col-md-6">
                <select class="form-control" id="Country" name="Country" v-model="fields.Country" required autofocus>
                     <option v-for="country in countries" v-bind:key="country.id" :value="country.id">{{ country.country_name }}</option>
                </select>
                <div class="alert alert-danger" v-if="errors && errors.Country">
                    {{ errors.Country[0] }}
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="City" class="col-md-4 col-form-label text-md-right">Choose City</label>

            <div class="col-md-6">
                <select class="form-control" id="City" name="City" v-model="fields.City" required autofocus>
                     <option v-for="city in filteredCities" v-bind:key="city.id" :value="city.id">{{ city.city_name }}</option>
                </select>
                <div class="alert alert-danger" v-if="errors && errors.City">
                    {{ errors.City[0] }}
                </div>
            </div>
        </div>

        <div class="form-group row"> 
            <label for="Address1" class="col-md-4 col-form-label text-md-right">Address1</label>

            <div class="col-md-6">
                <input id="Address1" type="text" class="form-control" name="Address1" v-model="fields.Address1" required autofocus>
                <div class="alert alert-danger" v-if="errors && errors.Address1">
                    {{ errors.Address1[0] }}
                </div>
            </div>
        </div>

        <div class="form-group row"> 
            <label for="Address2" class="col-md-4 col-form-label text-md-right">Address2</label>

            <div class="col-md-6">
                <input id="Address2" type="text" class="form-control" name="Address2" v-model="fields.Address2" required autofocus>
                <div class="alert alert-danger" v-if="errors && errors.Address2">
                    {{ errors.Address2[0] }}
                </div>
            </div>
        </div>
         <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
               <a class="btn btn-info" v-on:click="topart2()">Continue</a>
            </div>
        </div>       
        </div>
        <div v-if="part2">
        <a class="btn btn-info" v-on:click="topart1()">Go Back</a>
        <div class="form-group row">
            <label for="Subject" class="col-md-4 col-form-label text-md-right">Choose Subject</label>

            <div class="col-md-6">
                <select class="form-control" id="Subject" name="Subject" v-model="fields.Subject" required autofocus>
                     <option v-for="subject in subjects" v-bind:key="subject.id" :value="subject.id">{{ subject.Subject_name }}</option>
                </select>
                <div class="alert alert-danger" v-if="errors && errors.Subject">
                    {{ errors.Subject[0] }}
                </div>
            </div>
        </div>

        <div class="form-group row"> 
            <label for="Teachers_Count" class="col-md-4 col-form-label text-md-right">Teachers_Count</label>

            <div class="col-md-6">
                <input id="Teachers_Count" type="number" class="form-control" min="1" max="99" name="Teachers_Count" v-model.number="fields.Teachers_Count" required autofocus>
                <div class="alert alert-danger" v-if="errors && errors.Teachers_Count">
                    {{ errors.Teachers_Count[0] }}
                </div>
            </div>
        </div>

        <div class="form-group row"> 
            <label for="Students_Count" class="col-md-4 col-form-label text-md-right">Students_Count</label>

            <div class="col-md-6">
                <input id="Students_Count" type="number" min="1" max="999" class="form-control" name="Students_Count" v-model.number="fields.Students_Count" required autofocus>
                <div class="alert alert-danger" v-if="errors && errors.Students_Count">
                    {{ errors.Students_Count[0] }}
                </div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-info">
                    Submit
                </button>
            </div>
        </div>
        </div>
        </div>
    </form>
    </div>

          </CCardBody>
        </CCard>
      </transition>
    </CCol>
  </CRow>
</template>

<script>
import axios from 'axios'
export default {
  data: () => {
            return {
                fields: {},
                countries: [],
                cities: [],
                subjects: [],
                academicLevels: [],
                success: false,
                part1: true,
                part2: false,
                errors: [],

            }
        },
        mounted() {
            this.loadSubjects();
            this.loadCountries();
            this.loadCities();
            this.loadAcademiclevels();
        },
        computed:{
        filteredCities: function(){
         return this.cities.filter((city)=>{

         return (city.country_id==this.fields.Country);
         });
          }
        },
        methods: {
        loadSubjects: function () {
                 let self = this;
                 axios.get(this.$apiAdress +'/api/purchase/getsubjects')
                 .then(function (response) {
                 self.subjects = response.data;
                }).catch(function (error) {
                console.log(error);
                });
        },
        loadCities: function () {
              let self = this;
              axios.get(this.$apiAdress +'/api/purchase/getcities')
              .then(function (response) {
               self.cities = response.data;
                }).catch(function (error) {
                 console.log(error);
              });
            },
            loadCountries: function () {
             let self = this;
              axios.get(this.$apiAdress +'/api/purchase/getcountries')
              .then(function (response) {
               self.countries = response.data;
               }).catch(function (error) {
                console.log(error);
               });
            },
            loadAcademiclevels: function () {
                let self = this;
                axios.get(this.$apiAdress +'/api/purchase/getacademiclevels')
                .then(function (response) {
                self.academicLevels = response.data;
                }).catch(function (error) {
                console.log(error);
                 });
            },
             submit() {
               let self = this;
               axios.post(this.$apiAdress +'/api/Purchase/Free_Trail', this.fields).then(response => {
               this.fields = {};
               this.success = true;
               this.errors = {};
               self.$router.push({ path: '/'});
             }).catch(function (error) {
               if(error.response.data.message == 'The given data was invalid.'){
                 self.message = '';
                for (let key in error.response.data.errors) {
                 if (error.response.data.errors.hasOwnProperty(key)) {
                  self.message += error.response.data.errors[key][0] + '  ';
                 }
               }
             }
              console.log(error);
            });
          },
            topart1(){
            this.part1 = true;
            this.part2 = false;
        },
        topart2(){
            this.part2 = true;
            this.part1 = false;
        }
      }

};
</script>

<style>
input:invalid {
  border: red solid 1px;
}
</style>