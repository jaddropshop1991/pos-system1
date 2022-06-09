<template lang="">
   
</template>


<script>
export default {
created() {
    localStorage.removeItem('token')
    localStorage.removeItem('user')
    Toast.fire({
                icon: 'success',
                title: 'logout successfully'
                })
   this.$router.push({name:'/'})
}   
}
</script>
<style lang="">
    
</style>