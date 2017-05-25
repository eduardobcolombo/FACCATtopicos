<template>
        <form @submit.prevent="onSubmitted">
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" id="name" class="form-control"
                       v-model="nameContent">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="text" id="email" class="form-control"
                       v-model="emailContent">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" class="form-control"
                       v-model="phoneContent">
            </div>
            <h1>{{ msg }}</h1>
            <button class="btn btn-primary" type="submit">Enviar</button>
        </form>
</template>


<script>
    import axios from 'axios';
    export default {
        data() {
            return {
                nameContent: '',
                emailContent: '',
                phoneContent: '',
                msg: 'enviar'
            }
        },
        methods: {
            onSubmitted() {
                axios.post('http://localhost:8888/api/customers/store',
                        { name: this.nameContent, email: this.emailContent, phone: this.nameContent})
                        .then(
                                (response) => this.onMessage(response)
                        )
                        .catch(
                            (error) => console.log(error)
                        );
            },
            onMessage(message) {
                this.msg = message.data.msg
            }
        }
    }
</script>