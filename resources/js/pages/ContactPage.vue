<template>
    <div class="container">
        <h1>Contattaci per informazioni</h1>


        <form @submit.prevent="sendMail">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" v-model="name">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" v-model="email">
            </div>

            <div class="form-group">
                <label for="message">Messagge</label>
                <textarea class="form-control" id="message" rows="5" v-model="message"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>



    </div>
</template>

<script>
    export default {
        name: "ContactPage",
        data() {
            return {
                name: '',
                email: '',
                message: ''
            }
        },
        methods: {
            sendMail() {
                axios.post('/api/contacts', {
                    'name': this.name,
                    'email': this.email,
                    'message': this.message
                }).then((response) => {
                    console.log(response);
                });
            }
        }
    }
</script>

<style>

</style>
