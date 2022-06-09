
<template lang="">
  <div>

<div class="col-6">
    <router-link to="/employee" class="btn btn-primary">All Employee </router-link>
</div>

       <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Pay Salary</h1>
                  </div>



                  <form class="user" @submit.prevent="salaryPaid" enctype="multipart/form-data">
<div class="form-group">
<div class="form-row">
    <div class="col-md-6">
               <label for="exampleFormControlSelect1"><b>Name</b></label>

    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Name" v-model="form.name">
    <small class="text-danger" v-if="errors.name">{{ errors.name[0]}}</small>
    </div>
 <div class="col-md-6">
       <label for="exampleFormControlSelect1"><b>Email</b></label>
    <input type="email" class="form-control" id="exampleInputFirstName" placeholder="Enter email" v-model="form.email">
    <small class="text-danger" v-if="errors.email">{{ errors.email[0]}}</small>
    </div>
</div>
</div>
                
<div class="form-group">
<div class="form-row">
    <div class="col-md-6">
       
              
                  
                            <label for="exampleFormControlSelect1"><b>Months</b></label>

                      <!-- accessing the category_id in the drop down by using v-model to get the category_id fetched by axios on the created method  -->
                      <select class="form-control" id="category_id" v-model="form.salary_month">
                        <option value="January"> January</option>
                         <option value="February"> February</option>
                        <option value="March"> March</option>
                        <option value="April"> April</option>
                        <option value="May"> May</option>
                        <option value="Jun"> Jun</option>
                        <option value="July"> July</option>
                        <option value="August"> August</option>
                        <option value="September"> September</option>
                        <option value="October"> October</option>
                        <option value="November"> November</option>
                        <option value="December"> December</option>

                      </select>    
                         <small class="text-danger" v-if="errors.salary_month">{{ errors.salary_month[0]}}</small>


</div>
<div class="col-md-6">
                            <label for="exampleFormControlSelect1"><b>Salary</b></label>


    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter salary" v-model="form.salary">
    <small class="text-danger" v-if="errors.salary">{{ errors.salary[0]}}</small>
    </div>
</div>

 </div>

    
 
<br>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Pay Now</button>
                    
                    </div>
                    <hr>
                 
                  </form>




                  <hr>
                  <div class="text-center">
                    <!-- <router-link to="/" class="font-weight-bold small">Already have an account?</router-link> -->
                  </div>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
    created(){
     if(!User.loggedIn()){
         this.$router.push({name: '/'})
     }
//accessing the id returned by the index employee page by the edit button & that is given to the edit-employee route
     let id =this.$route.params.id;
     axios.get('/api/employee/edit/'+id)
     .then(({data})=>(this.form = data))
     .catch(console.log('error'))
 },
   data(){
        return{
            form:{
                name: '',
                email:'',
                salary_month: '',
                salary: '',
               

            },
            errors: {

            }
        }
       
    },
     methods: {
         
        //  onFileSelected(event){
        //      //console.log(event);
        //      let file = event.target.files[0];
        //      if(file.size > 1048770){
        //          Notification.image_validation()
        //      }else{
        //          let reader = new FileReader();
        //          reader.onload = event =>{
        //              //-------- pass new photo data this is different from the add employee file 
        //              this.form.newphoto = event.target.result
        //              console.log(event.target.result);
        //          };
        //          reader.readAsDataURL(file);
        //      }
        //  },
         salaryPaid(){
             let id = this.$route.params.id
             axios.post('/api/salary/paid/'+id, this.form)
             .then(()=>{
                 this.$router.push({name:'given-salary'})
                 Notification.success()
             })
             .catch(error=>this.errors = error.response.data.errors)
         },
            
    }
 
}

</script>
<style lang="">
    
</style>