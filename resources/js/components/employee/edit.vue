
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
                    <h1 class="h4 text-gray-900 mb-4">Employee Update</h1>
                  </div>



                  <form class="user" @submit.prevent="employeeUpdate" enctype="multipart/form-data">
<div class="form-group">
<div class="form-row">
    <div class="col-md-6">
    <input type="text" class="form-control" name="name" id="exampleInputFirstName" placeholder="Enter Name" v-model="form.name">
    <small class="text-danger" v-if="errors.name">{{ errors.name[0]}}</small>
    </div>
 <div class="col-md-6">
    <input type="email" class="form-control" name="email" id="exampleInputFirstName" placeholder="Enter email" v-model="form.email">
    <small class="text-danger" v-if="errors.email">{{ errors.email[0]}}</small>
    </div>
</div>
</div>
                
<div class="form-group">
<div class="form-row">
    <div class="col-md-6">
    <input type="text" class="form-control" name="address" id="exampleInputFirstName" placeholder="Enter address" v-model="form.address">
    <small class="text-danger" v-if="errors.address">{{ errors.address[0]}}</small>
</div>
<div class="col-md-6">
    <input type="text" class="form-control" name="salary" id="exampleInputFirstName" placeholder="Enter salary" v-model="form.salary">
    <small class="text-danger" v-if="errors.salary">{{ errors.salary[0]}}</small>
    </div>
</div>

 </div>

 <div class="form-group">
<div class="form-row">
    <div class="col-md-6">
    <input type="date" class="form-control" name="joining_date" id="exampleInputFirstName" placeholder="Enter joining date" v-model="form.joining_date">
    <small class="text-danger" v-if="errors.joining_date">{{ errors.joining_date[0]}}</small>
</div>
<div class="col-md-6">
    <input type="text" class="form-control" name="nid" id="exampleInputFirstName" placeholder="Enter nid" v-model="form.nid">
    <small class="text-danger" v-if="errors.nid">{{ errors.nid[0]}}</small>
    </div>
</div>
</div>       

 <div class="form-group">
<div class="form-row">
    <div class="col-md-6">
    <input type="text" class="form-control" name="phone" id="exampleInputFirstName" placeholder="Enter phone" v-model="form.phone">
    <small class="text-danger" v-if="errors.phone">{{ errors.phone[0]}}</small>
</div>
<div class="col-md-6">
    <!-- <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter nid" v-model="form.nid"> -->
    <!-- <small class="text-danger" v-if="errors.nid">{{ errors.nid[0]}}</small> -->
    </div>
</div>
</div>  
 <div class="form-group">
                      <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="customFile" @change="onFileSelected">
                            <!-- <small class="text-danger" v-if="errors.photo">{{ errors.photo[0]}}</small> -->
  <small class="text-danger" v-if="errors.photo"> {{ errors.photo[0] }} </small>
                        <label class="custom-file-label" for="customFile">Choose file</label>
                      </div>

                      <div class="col-md-6">
                          <img :src="form.photo" style="height: 40px; width:40px;">
                          
                      </div>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Update</button>
                    
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
                phone: '',
                salary: '',
                address: '',
                photo:'',
                newphoto:'',
                nid: '',
                joining_date: '',

                image:''

            },
            errors: {

            }
        }
       
    },
     methods: {
         
         onFileSelected(event){
             //console.log(event);
            //  let file = event.target.files[0];
            //  if(file.size > 1048770){
            //      Notification.image_validation()
            //  }else{
            //      let reader = new FileReader();
            //      reader.onload = event =>{
            //          //-------- pass new photo data this is different from the add employee file 
            //          this.form.newphoto = event.target.result
            //          console.log(event.target.result);
            //      };
            //      reader.readAsDataURL(file);
            //  }

             this.form.image = event.target.files[0];

         },
        //  employeeUpdate(){
        //      let id = this.$route.params.id
        //      axios.patch('/api/employee/update/'+id, this.form)
        //      .then(()=>{
        //          this.$router.push({name:'employee'})
        //          Notification.success()
        //      })
        //      .catch(error=>this.errors = error.response.data.errors)
        //  },
         employeeUpdate(){
             let id = this.$route.params.id;

    //             let formData = new FormData();

    // formData.append("image", this.form.image);
    // formData.append("name", this.form.name);
    // formData.append("email", this.form.email);
    //  formData.append("salary", this.form.salary);
    //   formData.append("address", this.form.address);
    //         formData.append("phone", this.form.phone);
    //    formData.append("nid", this.form.nid);
    //     formData.append("joining_date", this.form.joining_date);

//     let formData = new FormData();
// formData.append("image", this.form.image)

 var data = {
  //  image:this.form.image, 
   name:this.form.name,
      email:this.form.email, 
      salary:this.form.salary, 
      address:this.form.address,
      phone:this.form.phone, 
      nid:this.form.nid, 
      joining_date:this.form.joining_date, 
      }
             axios.patch('/api/employee/update/'+id, data)
             .then(()=>{
                 this.$router.push({name:'employee'})
                 Notification.success()
             })
             .catch(error=>this.errors = error.response.data.errors)
         },
            
    }
 
}

</script>
<style lang="">
    
</style>