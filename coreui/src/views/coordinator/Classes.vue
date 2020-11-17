<template>
    <h1>{{institutions_key_classes}}</h1>
</template>
<script>
import axios from 'axios'
export default {
     data: function() {
        return {
          institutions_key_classes: [],
            subjects:[],
            teachers:[],
            mysubject:{},
            searchtext: "",
            column: "id",
            errors: [],
            sort_field: "id",
            sort_direction: "desc",  
            myId: {},
        };
    },
         mounted() {
            this.myId = this.$route.params.id;
            this.loadmySubjects();
            this.loadSubjects();
            this.loadkeyclasses();
            this.loadTeachers();
            },
        methods:{
        change_sort(field) {
            if (this.sort_field === field) {
                this.sort_direction =
                    this.sort_direction === "asc" ? "desc" : "asc";
            } else {
                this.sort_field = field;
                this.sort_direction = "asc";
            }
            this.loadkeyclasses();
        },
        loadTeachers: function(){
                    axios.get(this.$apiAdress +'/api/Coordintors/getTeachers?token='+ localStorage.getItem("api_token"))
                    .then((response) => {
                        this.teachers = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
        loadSubjects: function() {
            axios
                .get(this.$apiAdress +'/api/Coordintors/getSubjects?token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.subjects = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        loadmySubjects: function() {
            axios
                .get(this.$apiAdress +'/api/Coordintors/'+this.myId+'/getMySubject?token='+ localStorage.getItem("api_token"))
                .then(response => {
                    this.mysubject = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        loadkeyclasses: function(page = 1){
            axios.get(this.$apiAdress +'/api/Coordintors/'+this.myId+'/getClasses?page='+page+
                        "&search=" +
                        this.searchtext +
                        "&sort_field=" +
                        this.sort_field +
                        "&sort_direction=" +
                        this.sort_direction +
                        "&column=" +
                        this.column+
                        "&token="+ localStorage.getItem("api_token"))
                    .then((response) => {
                        this.institutions_key_classes = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
        },
    }            
}
</script>
<style scoped>
table {
  width: 100%;
  border-collapse: separate; /* Don't collapse */
  border-spacing: 0;
}

table th {
  /* Apply both top and bottom borders to the <th> */
  border-top: 2px solid rgba(99,99,99,0.5);;
  border-bottom: 2px solid rgba(99,99,99,0.5);;
}

table th:first-child{
  /* Apply a left border on the first <td> or <th> in a row */
  border-left: 2px solid rgba(99,99,99,0.5);;
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
}
table th:last-child{
  /* Apply a left border on the first <td> or <th> in a row */
  border-right: 2px solid rgba(99,99,99,0.5);;
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
}
table thead th {
  top: 0;
}
input:invalid {
  border: red solid 1px;
}
</style>