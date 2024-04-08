<template>  
    <router-view />
    <!-- <router-view name="loginView" /> -->
</template>
  
<script>
import Layout from './components/Layout.vue'

export default {
    name: 'App',
    components: {
        Layout
    }
}
</script>