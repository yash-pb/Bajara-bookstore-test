<template>
    <Layout />
</template>
  
<script>
import Dashboard from './pages/Dashboard.vue'
import Layout from './components/Layout.vue'

export default {
    name: 'App',
    components: {
        Layout,
        Dashboard
    }
}
</script>