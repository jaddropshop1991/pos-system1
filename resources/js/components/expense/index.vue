<template lang="">
  <div>

<div class="col-6">
    <router-link to="/store-expense" class="btn btn-primary">Add expense </router-link>
</div>
<br>

<input type="text" class="form-control" style="width:300px;" placeholder="Search Here" v-model="searchTerm"></input>
<br>
      <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">expense list</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                          <th>expense details</th>
                        <th>expense amount</th>
                        <th>expense date</th>
                            <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="expense in filtersearch" :key="expense.id">
                        <td>{{ expense.details }}</td>
                        <td>{{ expense.amount }}</td>
                        <td>{{ expense.expenses_date }}</td>
                     
                          <td><router-link :to="{name: 'edit-expense', params:{id:expense.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                          <a @click="deleteExpense(expense.id)" class="btn btn-sm btn-danger"><font color="#ffffff">Delete</font></a></td>
                 

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

        this.allExpense()
     if(!User.loggedIn()){
         this.$router.push({name: '/'})
     }

     
 },
 data(){
     return {
         categories:[],
         searchTerm: ''
     }
 },
 computed: {
   filtersearch(){
     return this.categories.filter(expense => {
       return expense.details.match(this.searchTerm)
     })
   }
 },

     methods: {
         allExpense(){
             axios.get('/api/allexpenses')
             .then(({data}) =>(this.categories = data))
             .catch()
         },
 
 deleteExpense(id){

           //sweet alert
           Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {

axios.delete('api/expense/delete/'+id)
.then(()=>{
  this.categories =  this.categories.filter(expense => {
    //return the employees without page reload that ids don't match with the deleted employee id
    return expense.id != id
  })
})
.catch(()=>{
  this.$router.push({name: 'expense'})
})
    Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
  }
})

         }
      
    },

 
}

</script>
<style>
    #em_photo{
        height: 60px;
        width: 60px;
    }
</style>