<template>
  <div>


<br>

<input type="text" class="form-control" style="width:300px;" placeholder="Search Here" v-model="searchTerm"></input>
<br>
      <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Todays Orders</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                          <th>Customer Name</th>
                        <!-- <th>Qty</th> -->
                        <!-- <th>Sub Total</th> -->
                        <!-- <th>Vat</th> -->
                        <th>Total Amount</th>
                        <th>Pay</th>
                        <th>Due</th>
                        <th>Pay By</th>
                         <!-- <th>Order Date</th>
                        <th>Order Month</th>
                        <th>Order Month</th> -->
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="order in filtersearch" :key="order.id">
                        <td>{{ order.name }}</td>
                        <!-- <td>{{ order.qty }}</td>
                        <td>{{ order.sub_total }}</td>
                         <td>{{ order.vat }}</td> -->
                          <td>{{ order.total }} $</td>
                           <td>{{ order.pay }} $</td>
                            <td>{{ order.due }} $</td>
                             <td>{{ order.payby }}</td>
                              <!-- <td>{{ order.order_date }}</td>
                               <td>{{ order.order_month }}</td>
                                <td>{{ order.order_year }}</td> -->
                     
                          <td><router-link :to="{name: 'view-order', params:{id:order.id}}" class="btn btn-sm btn-primary">View</router-link>
                          <!-- <a @click="deleteOrder(order.id)" class="btn btn-sm btn-danger"><font color="#ffffff">Delete</font></a> -->
                          </td>
                 

                      </tr>
                     
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
  </div>
</template>
<script>
export default {
    
    created(){

        this.allOrder()
     if(!User.loggedIn()){
         this.$router.push({name: '/'})
     }

     
 },
 data(){
     return {
         orders:[],
         searchTerm: ''
     }
 },
 computed: {
   filtersearch(){
     return this.orders.filter(order => {
       return order.name.match(this.searchTerm)
     })
   }
 },

     methods: {
         allOrder(){
             axios.get('/api/allorders')
             .then(({data}) =>(this.orders = data))
             .catch()
         },
 

      
    },

 
}

</script>
<style>
    #em_photo{
        height: 60px;
        width: 60px;
    }
</style>