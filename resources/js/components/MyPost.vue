<template>
    <div class="card col-12 mb-5">
        <img :src="post.cover" class="card-img-top">
        <div class="card-body">
            <h5 class="card-title">{{post.title}}</h5>
            <p class="card-text">{{truncateText(post.content, 100)}}</p>
            <p class="card-text">{{post.category?post.category.name:'-'}}</p>
            <router-link :to="{name: 'single-post', params: {slug: post.slug}}" class="btn btn-primary">Read more...</router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: 'MyPost',
    props: {post: Object},
    methods: {
        truncateText(text, maxLength) {
            if (text.length < maxLength) {
                return text;
            } else {
                return text.substring(0, maxLength) + '...';
            }
        }
    }
}
</script>

<style>

</style>
