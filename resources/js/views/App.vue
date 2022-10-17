<template>
    <div>
        <MyHeader />
        <MyMain />
    </div>
</template>

<script>

    import MyHeader from '../components/MyHeader.vue';
    import MyMain from '../components/MyMain.vue';

    export default {
        name: 'App',
        components: {
            MyHeader,
            MyMain
        }
    }
</script>
