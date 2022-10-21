<template>
    <div class="container">
        <h1>Contattaci per informazioni</h1>

        <div v-if="success" class="alert alert-success" role="alert">
            Grazie di averci contattato. Riceverai risposta entro 48 ore!
        </div>

        <form @submit.prevent="sendMail">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" :class="errors.name?'is-invalid':''" id="name" v-model="name" >

                <div v-for="(error, index) in errors.name" class="invalid-feedback" :key="index">
                    {{error}}
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" :class="errors.email?'is-invalid':''" id="email" v-model="email" >

                <div v-for="(error, index) in errors.email" class="invalid-feedback" :key="index">
                    {{error}}
                </div>
            </div>

            <div class="form-group">
                <label for="message">Messagge</label>
                <textarea class="form-control" :class="errors.message?'is-invalid':''" id="message" rows="5" v-model="message" ></textarea>

                <div v-for="(error, index) in errors.message" class="invalid-feedback" :key="index">
                    {{error}}
                </div>
            </div>

            <button type="submit" class="btn btn-primary" :disabled="sending">{{sending?'Invio in corso, attendi...':'Invia'}}</button>

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
                message: '',
                errors: {},
                success: false,
                sending: false
            }
        },
        methods: {
            sendMail() {

                this.sending = true; //invio in corso

                //https://www.atatus.com/blog/how-to-perform-http-requests-with-axios-a-complete-guide/

                axios.post('/api/contacts',
                    {
                        'name': this.name,
                        'email': this.email,
                        'message': this.message
                    }
                ).then((response) => {

                    this.success = response.data.success;
                    this.sending = false;

                    if (this.success) {
                        this.errors = {};
                        this.name = '';
                        this.email = '';
                        this.message = '';
                    } else {
                        this.errors = response.data.errors;
                    }

                });

            }
        }
    }
</script>

<style>

</style>
