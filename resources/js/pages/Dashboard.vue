
<template>
    Dashboard
</template>
<script>
console.log("from dash", axios.defaults.headers.common);
// export default {
//     data() {
//         return {
//             users: []
//         }
//     },
//     methods: {
//         async fetchUsers() {
//             console.log('in users => ', axios.defaults);
//             try {
//                 const response = await axios.get('users', {
//                     headers: {
//                         'Authorization' : `Bearer ${this.token}`
//                     }
//                 }).then(response => {
//                     this.users = response.data.data;
//                 })
//                 .catch((err) => {
//                     console.log('err => ', err);
//                     if (err.response.status === 401) {
//                         console.log(err.response.data.message);
//                         this.$router.push({ name: 'login' });
//                     }
//                 });
                
//             } catch (error) {
//                 console.error('error => ', error);
//             }
//         },
//     },
//     beforeMount(){
//         this.fetchUsers();
//     },
// }
</script>