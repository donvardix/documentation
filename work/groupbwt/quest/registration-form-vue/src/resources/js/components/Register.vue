<template>
    <v-layout row wrap justify-center>
        <div id="map" class="mb-3"></div>
        <v-flex xs8>
            <v-layout justify-center>
                <router-link :to="{ name: 'all-members' }">
                    <v-btn color="success">All members ({{ numberMembers }})</v-btn>
                </router-link>
            </v-layout>
            <v-stepper v-model="formstep">
                <v-stepper-header>
                    <v-stepper-step :complete="formstep > 1" step="1">Registration of step 1</v-stepper-step>

                    <v-divider></v-divider>

                    <v-stepper-step :complete="formstep > 2" step="2">Registration of step 2</v-stepper-step>

                    <v-divider></v-divider>

                    <v-stepper-step step="3">Registration of step 3</v-stepper-step>
                </v-stepper-header>

                <v-stepper-items>
                    <v-stepper-content step="1">
                        <v-card class="mb-5" height="auto">
                            <FirstForm/>
                        </v-card>
                    </v-stepper-content>


                    <v-stepper-content step="2">
                        <v-card class="mb-5" height="auto">
                            <SecondForm/>
                        </v-card>
                    </v-stepper-content>


                    <v-stepper-content step="3">
                        <v-card class="mb-5" height="200px">
                            <Share/>
                        </v-card>
                        <a :href="`/`">
                            <v-btn color="info">Return to registration page</v-btn>
                        </a>
                    </v-stepper-content>
                </v-stepper-items>
            </v-stepper>
        </v-flex>
    </v-layout>
</template>
<script>
    import FirstForm from './FirstForm'
    import SecondForm from './SecondForm'
    import Share from './Share'

    export default {
        name: "Register",
        components: {
            FirstForm, SecondForm, Share
        },
        $_veeValidate: {
            validator: 'new'
        },
        data: function () {
            return {
                session: 0
            };
        },
        computed: {
            numberMembers: function () {
                return this.$store.state.countMembers
            },
            formstep: {
                get: function () {
                    axios.get('/session').then(respond => {
                        this.session = respond.data.session
                    });
                    if (this.session === 1 && this.$store.state.formstep === 1) {
                        this.$store.dispatch('nextStep');
                        return this.$store.state.formstep
                    } else {
                        return this.$store.state.formstep
                    }
                },
                set: function () {

                }
            },
        },
        methods: {},
        beforeMount() {
            this.$store.dispatch('countMembers')
        },
        mounted() {
            window.initMap();
        }
    }
</script>

<style scoped>
    #map {
        width: 100%;
        height: 450px;
    }
</style>