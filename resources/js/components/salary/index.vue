<template lang="">
  <div>

<div class="col-6">
    <router-link to="/given-salary" class="btn btn-primary">Pay salary </router-link>
</div>
<br>

<input type="text" class="form-control" style="width:300px;" placeholder="Search Here" v-model="searchTerm"></input>
<br>
      <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">salary list</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <!-- <th>employee_id</th>
                        <th>amount</th>
                        <th>salary date</th>
                        <th>salary month</th>
                        <th>salary year</th>
                          <th>Action</th> -->

                          <th>Month Name</th>
                          <th>Details</th>

                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="salary in filtersearch" :key="salary.id">
                        <td>{{ salary.salary_month }}</td>
                        <!-- <td><img :src="salary.photo" id="em_photo"></td> -->
                        <!-- <td>{{ salary.amount }}</td> -->
                        <!-- <td>{{ salary.salary_date }}</td>
                        <td>{{ salary.salary_month}}</td>
                        
                        <td>{{ salary.salary_year}}</td> -->
                          <td><router-link :to="{name: 'view-salary', params:{id:salary.salary_month}}" class="btn btn-sm btn-primary">View Salary</router-link>
                          <!-- <a @click="deletesalary(salary.id)" class="btn btn-sm btn-danger"><font color="#ffffff">Delete</font></a> -->
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

        this.allSalary()
     if(!User.loggedIn()){
         this.$router.push({name: '/'})
     }

     
 },
 data(){
     return {
         salaries:[],
         searchTerm: ''
     }
 },
 computed: {
   filtersearch(){
     return this.salaries.filter(salary => {
       return salary.salary_month.match(this.searchTerm)
     })
   }
 },

     methods: {
         allSalary(){
             axios.get('/api/allsalaries')
             .then(({data}) =>(this.salaries = data))
             .catch()
         },
 
//  deletesalary(id){

//            //sweet alert
//            Swal.fire({
//   title: 'Are you sure?',
//   text: "You won't be able to revert this!",
//   icon: 'warning',
//   showCancelButton: true,
//   confirmButtonColor: '#3085d6',
//   cancelButtonColor: '#d33',
//   confirmButtonText: 'Yes, delete it!'
// }).then((result) => {
//   if (result.isConfirmed) {

// axios.delete('api/salary/delete/'+id)
// .then(()=>{
//   this.salaries =  this.salaries.filter(salary => {
//     //return the salaries without page reload that ids don't match with the deleted salary id
//     return salary.id != id
//   })
// })
// .catch(()=>{
//   this.$router.push({name: 'salary'})
// })
//     Swal.fire(
//       'Deleted!',
//       'Your file has been deleted.',
//       'success'
//     )
//   }
// })

//          }
      
    },

 
}

</script>
<style>
    #em_photo{
        height: 60px;
        width: 60px;
    }
</style>