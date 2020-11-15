<template>
  <CRow>
    <CCol col="12" xl="6">
      <transition name="slide">
        <CCard>
          <CCardBody>
    <div class="container">
    <form @submit.prevent="submit">
        <div class="alert alert-success" v-show="success">Profile Updated Successfully.</div>
        <hr>
        <div class="container">
             <h1>Personal Info:</h1>
            <hr> 
            <div v-if="fields.image" class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
            <img style="width:20%; high:30%; border-radius:50%;" :src="getphoto()" alt="Profile Image">   
            <input @change="handleOnchange" type="file" accept="image/*">                     
        </div>
        </div>
        <div v-if="!fields.image" class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
            <img style="width:20%; high:30%; border-radius:50%;" :src="getempty()" alt="Profile Image">   
            <input @change="handleOnchange" type="file" accept="image/*">                     
        </div>
        </div>
        <hr>    
        <div class="form-group row"> 
            <div style="display:inline-block; width:50%;">
            <label for="First_Name" class="col-md-4 col-form-label text-md-right">First_Name</label>
            <div class="col-md-6">
                <input id="First_Name"  minlength="3" type="text" class="form-control" name="First_Name" v-model="employee.First_Name" required autofocus>
                <div class="alert alert-danger" v-if="errors && errors.First_Name">
                    {{ errors.First_Name[0] }}
                </div>
            </div>
            </div>
            <div style="display:inline-block; width:50%;">
            <label for="Last_Name" class="col-md-4 col-form-label text-md-right">Last_Name</label>
            <div class="col-md-6">
                <input id="Last_Name" type="text"  minlength="3" class="form-control" name="Last_Name" v-model="employee.Last_Name" required autofocus>
                <div class="alert alert-danger" v-if="errors && errors.Last_Name">
                    {{ errors.Last_Name[0] }}
                </div>
            </div>
           </div>
        </div>
        <hr>
        <div class="form-group row"> 
            <div style="display:inline-block; width:50%;">
            <label for="Mobile" class="col-md-4 col-form-label text-md-right">Mobile</label>
            <div class="col-md-6">
                <input id="Mobile" type="tel" pattern="[0]{1}[0-9]{9,12}" class="form-control" name="Mobile" v-model="employee.Mobile" required autofocus>
                <div class="alert alert-danger" v-if="errors && errors.Mobile">
                    {{ errors.Mobile[0] }}
                </div>
            </div>
            </div>
            <div style="display:inline-block; width:50%;">
            <label for="birth_date" class="col-md-4 col-form-label text-md-right">Birth_Date</label>

            <div class="col-md-6">
                <input id="birth_date" type="date" class="form-control" name="Mobile" v-model="employee.birth_date" required autofocus>
                <div class="alert alert-danger" v-if="errors && errors.birth_date">
                    {{ errors.birth_date[0] }}
                </div>
            </div>            
            </div>
        </div>
        <hr>
        <div class="form-group row">
        <div style="display:inline-block; width:50%;"> 
            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" v-model="fields.email" required autocomplete="email">
                <div class="alert alert-danger" v-if="errors && errors.email">
                    {{ errors.email[0] }}
                </div>
            </div>
        </div>
        <div style="display:inline-block; width:50%;">
                <label for="nationality_id" class="col-md-4 col-form-label text-md-right">Nationality</label>
                     <div class="col-md-6">
                        <select
                            class="form-control"
                            id="nationality_id"

                            name="nationality_id"
                            v-model="employee.nationality_id"
                            required
                            autofocus
                        >
                            <option
                                v-for="nationality in nationalities"
                                v-bind:key="nationality.id"
                                :value="nationality.id"
                                >{{nationality.Nationality_name}}</option
                            >
                        </select>
                        <div
                            class="alert alert-danger"
                            v-if="errors && errors.nationality_id"
                        >
                            {{ errors.nationality_id[0] }}
                        </div>
                    </div>
                </div>
       </div>
       <hr>
        <div class="form-group row">
          <div style="display:inline-block; width:50%;">
            <label for="Gender" class="col-md-4 col-form-label text-md-right">Gender</label>
            <div class="col-md-6">
                <div class="col-md-6">
                <select class="form-control" id="Gender" style="width:250%;" name="Gender"
                    v-model="employee.Gender" required autofocus>
                    <option value=""></option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                </div>
                <div class="alert alert-danger" v-if="errors && errors.Gender">
                    {{ errors.Gender[0] }}
                </div>

                </div>
            </div>
            <div style="display:inline-block; width:50%;">
            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
            <div  v-if="!passwordshow">
            <div>
                <input id="password" style="width:50%;" type="password" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" class="form-control" name="password" v-model="fields.password" required autofocus>
                <a  style="margin-top: 1em;" class="btn btn-outline-danger" v-on:click="showpass()">show</a>
                <button
                    v-if="!addgeneratepass"
                    v-on:click="genratePassAdd()"
                    style="margin-top: 1em;"
                    class="btn btn-outline-info"
                >
                        Auto Generate
                </button>
                <div class="alert alert-danger" v-if="errors && errors.password">
                    {{ errors.password[0] }}
                </div>
            </div>
            </div>
            <div  v-if="passwordshow">
            <div>
                <input id="password" style="width:50%;" type="text" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" class="form-control" name="password" v-model="fields.password" required autofocus>
                 <a style="margin-top: 1em;" class="btn btn-outline-danger" v-on:click="hidepass()">hide</a>
                  <button
                        v-if="!addgeneratepass"
                        v-on:click="genratePassAdd()"
                        style="margin-top: 1em;"
                        class="btn btn-outline-info"
                    >
                        Auto Generate
                    </button>
                <div class="alert alert-danger" v-if="errors && errors.password">
                    {{ errors.password[0] }}
                </div>                   
            </div>
            </div>
        </div>
        </div>
         <hr>
            <div>
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
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
        data() {
            return {
                user: {},
                fields: {},
                employee: {},
                employees: [],
                users: [],
                nationalities: [],
                freshuser: {},
                image:'',
                success: false,
                addgeneratepass: false,
                passwordshow:false,
                errors: []
            }
        },
        mounted() {
            this.loadusers();
            this.loademployee();
            this.loadnationalities();
        },
        methods: {
            getphoto(){
               return "../laravel/public/storage/image/"+this.freshuser.image;//"'/"
            },
            getempty(){
               return "../laravel/public/storage/image/no-image.jpg";
            },
            handleOnchange(e){
            this.image = e.target.files[0];
            this.submit();     
            },
            loadusers: function(){
                    axios.get(this.$apiAdress +'/api/users/myusers?token=' + localStorage.getItem("api_token"))
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
            loadnationalities: function(){
                    axios.get(this.$apiAdress +'/api/Nationality?token='+ localStorage.getItem("api_token"))
                    .then((response) => {
                        this.nationalities = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            filteruser: function(){
                return this.users.filter((userr)=>{
                return (userr.id==this.user);
                });
            },
            loademployee: function(){
                    axios.get(this.$apiAdress +'/api/Employee?token='+ localStorage.getItem("api_token"))
                    .then((response) => {
                        this.employees = response.data;
                        this.employee = this.filteremployee()[0];
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            filteremployee: function(){
                return this.employees.filter((employee)=>{
                return (employee.user_id==this.user);
                });
            },
            submit() {
                const formData = new FormData
                formData.set('image',this.image)
                formData.set('id',this.employee.id)
                formData.set('First_Name',this.employee.First_Name)
                formData.set('Last_Name',this.employee.Last_Name)
                formData.set('Mobile',this.employee.Mobile)
                formData.set('Gender',this.employee.Gender)
                formData.set('birth_date',this.employee.birth_date)
                formData.set('nationality_id',this.employee.nationality_id)
                if(!this.fields.password)
                {
                    this.fields.password = this.user.password;
                }
                axios.post(this.$apiAdress +'/api/users/store_user_profile?token='+ localStorage.getItem("api_token"),this.fields).then(response => {
                    this.fields = {};
                    this.success = true;
                    this.errors = {};
                }).catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                    console.log('Error');
                });
                axios.post(this.$apiAdress +'/api/users/store_employee_profile?token='+ localStorage.getItem("api_token"), formData).then(response => {
                    this.employee = {};
                    this.success = true;
                    this.errors = {};
                    this.loadusers();
                    this.loademployee();
                }).catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                    console.log('Error');
                });
            },
            genratePassAdd() {
            var generator = require("generate-password");
            this.fields.password = generator.generate({
                length: 10,
                numbers: true,
                lowercase: true,
                uppercase: true
            });
            this.addgeneratepass = true;
            return addgeneratepass;
            },
             showpass() {
              this.passwordshow = true;
            },
            hidepass() {
              this.passwordshow = false;
            },
        }
};
</script>

<style scoped>
input:invalid {
  border: red solid 1px;
}
</style>