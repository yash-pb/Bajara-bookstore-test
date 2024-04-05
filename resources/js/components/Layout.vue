
<template>
    <div>
        <Header></Header>
        <Sidebar></Sidebar>
        <div class="px-3 py-3 lg:pl-[20rem] w-full overflow-auto xl:overflow-x-hidden">
            <router-view />
        </div>
    </div>
</template>
<script>
    import Header from './Header.vue';
    import Sidebar from './Sidebar.vue';

    export default {
        name: 'Layout',
        components: {
            Header,
            Sidebar
        }
    }

</script>