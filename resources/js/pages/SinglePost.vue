<template>

    <div>
        <article v-if="post">
            <h1 >{{post.title}}</h1>
            <div class="mb-2">
                {{post.category?post.category.name:'Nessuna categoria'}}
            </div>
            <div class="mb-3">
                <span v-for="tag in post.tags" class="mr-2 badge badge-primary" :key="tag.id">{{tag.name}}</span>
            </div>
            <img class="img-fluid mb-4" :src="post.cover" :alt="post.title" />
            <p>{{post.content}}</p>
            <router-link :to="{name: 'blog'}">Torna alla lista</router-link>
        </article>
        <div v-else class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: 'SinglePost',
    data() {
        return {
            post: null
        }
    },
    methods: {
        getSinglePost() {

            const slug = this.$route.params.slug;

            axios.get('/api/posts/' + slug)
            .then((response) => {
                this.post = response.data.result;
            })
            .catch((error) => {
                this.$router.push({name: 'not-found'});
            });

        }
    },
    mounted() {
        this.getSinglePost();
    }
}
</script>

<style>

</style>
