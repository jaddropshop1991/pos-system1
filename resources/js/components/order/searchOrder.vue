<template lang="">
  <div>

<div class="col-6">
    <router-link to="/order" class="btn btn-primary">All order </router-link>
</div>

       <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Search Order</h1>
                  </div>



                  <form class="user" @submit.prevent="searchDate" enctype="multipart/form-data">
<div class="form-group">
<div class="form-row">
    <div class="col-md-12">
      <label class="label" for="customFile">Search By Date</label>

    <input type="date" class="form-control" id="exampleInputFirstName" required="" v-model="date">
    </div>

</div>
</div>
                



 <div class="form-group">

                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Search</button>
                    
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



<div class="row">
                 <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Simple Tables</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>   
                    
                    <th>Product Name</th>
                        <th>Qty</th>
                        <th>Sub Total</th>
                        <th>Vat</th>
                        <th>Total</th>
                        <th>Pay</th>
                         <th>Due</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="order in orders">
                        <td>{{ order.name }}</td>
                        <td>{{ order.qty }}</td>
                        <td>{{ order.sub_total }}</td>
                        <td>{{ order.vat }}</td>
                       <td>{{ order.total }}</td>
                    <td>{{ order.pay }}</td>
                        <td>{{ order.due }}</td>


<!-- 
                        <td><img :src="'/'+detail.image" id="em_photo"></td>
                        <td>{{ order.pro_quantity }}</td>
                         <td>{{ order.product_price }} $</td>
                         <td>{{ order.sub_total }} $</td> -->

                        <!-- <td><span class="badge badge-success">Delivered</span></td>
                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td> -->
                      </tr>
                     
                    
                      
                     
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
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
            // form:{
            //     order_name: null,
             
          

            // },

            date:'',
            orders:{}
            
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
        //  searchDate(){
        //      var data = {date:this.date};
        //      axios.post('/api/search/order/', data)
        //           .then(({data})=>(this.orders = data))

        //      .catch(error=>this.errors = error.response.data.errors)
        //  },
          searchDate(){ 
      var data = {date:this.date}
       axios.post('/api/search/order/',data)
        .then(({data}) => (this.orders = data))
        .catch(error =>this.errors = error.response.data.errors)
     },
//   } 
            
    }
 
}

</script>
<style lang="">
    
</style>