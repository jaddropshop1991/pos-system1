<template lang="">
  <div>

<div class="col-6">
    <router-link to="/category" class="btn btn-primary">All Category </router-link>
</div>

       <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Add Category</h1>
                  </div>



                  <form class="user" @submit.prevent="categoryInsert" enctype="multipart/form-data">
<div class="form-group">
<div class="form-row">
    <div class="col-md-12">
    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Category Name" v-model="form.category_name">
    <small class="text-danger" v-if="errors.category_name">{{ errors.category_name[0]}}</small>
    </div>
 <!-- <div class="col-md-6">
    <input type="email" class="form-control" id="exampleInputFirstName" placeholder="Enter email" v-model="form.email">
    <small class="text-danger" v-if="errors.email">{{ errors.email[0]}}</small>
    </div> -->
</div>
</div>
                
<!-- <div class="form-group">
<div class="form-row">
    <div class="col-md-6">
    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter address" v-model="form.address">
    <small class="text-danger" v-if="errors.address">{{ errors.address[0]}}</small>
</div>
<div class="col-md-6">
    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter shopname" v-model="form.shopname">
    <small class="text-danger" v-if="errors.shopname">{{ errors.shopname[0]}}</small>
    </div>
</div>

 </div> -->


 <div class="form-group">
<!-- <div class="form-row">
    <div class="col-md-6">
    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter phone" v-model="form.phone">
    <small class="text-danger" v-if="errors.phone">{{ errors.phone[0]}}</small>
</div>
<div class="col-md-6">

    </div>
</div> -->
<!-- </div>  
 <div class="form-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" @change="onFileSelected">
  <small class="text-danger" v-if="errors.photo"> {{ errors.photo[0] }} </small>
                        <label class="custom-file-label" for="customFile">Choose file</label>
                      </div>

                      <div class="col-md-6">
                          <img :src="form.photo" style="height: 40px; width:40px;">
                          
                      </div> -->
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    
                    </div>
                    <!-- <hr> -->
                 
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
 },
   data(){
        return{
            form:{
                category_name: null,
             
          

            },
            errors: {

            }
        }
       
    },
     methods: {
         
         onFileSelected(event){
             //console.log(event);
             let file = event.target.files[0];
             if(file.size > 1048770){
                 Notification.image_validation()
             }else{
                 let reader = new FileReader();
                 reader.onload = event =>{
                     this.form.photo = event.target.result
                     console.log(event.target.result);
                 };
                 reader.readAsDataURL(file);
             }
         },
         categoryInsert(){
             axios.post('/api/category', this.form)
             .then(()=>{
                 this.$router.push({name:'category'})
                 Notification.success()
             })
             .catch(error=>this.errors = error.response.data.errors)
         },
            
    }
 
}

</script>
<style lang="">
    
</style>