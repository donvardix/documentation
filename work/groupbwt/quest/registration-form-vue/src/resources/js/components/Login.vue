<template>
    <v-container fluid fill-height>
        <v-layout align-center justify-center>
            <v-flex xs12 sm8 md4>
                <v-card>
                    <v-toolbar dark>
                        <v-toolbar-title>Login form</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-form>
                            <v-text-field v-model="email" prepend-icon="mail" name="email" label="Email" type="text"></v-text-field>
                            <v-text-field v-model="password" prepend-icon="lock" name="password" label="Password" id="password" type="password"></v-text-field>
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                            <v-btn @click="login">Login</v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        name: "Login",
        data: () => ({
            email: null,
            password: null,
        }),
        methods: {
            login() {
                let formData = {
                    email: this.email,
                    password: this.password
                }
                this.$store.dispatch('login', formData)

            },
        },
    }
</script>

<style scoped>

</style>