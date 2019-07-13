<template>
    <v-form>
        <v-text-field
                v-model="firstname"
                v-validate="'required|max:50'"
                :counter="50"
                :error-messages="errors.collect('firstname')"
                label="First name"
                data-vv-name="firstname"
                required
        ></v-text-field>
        <v-text-field
                v-model="lastname"
                v-validate="'required|max:50'"
                :counter="50"
                :error-messages="errors.collect('lastname')"
                label="Last name"
                data-vv-name="lastname"
                required
        ></v-text-field>
        <v-menu
                v-model="menu"
                :close-on-content-click="false"
                :nudge-right="40"
                lazy
                transition="scale-transition"
                offset-y
                full-width
                max-width="290px"
                min-width="290px"
        >
            <template v-slot:activator="{ on }">
                <v-text-field
                        v-model="date"
                        v-validate="'required|max:50|date_format:yyyy-MM-dd'"
                        :error-messages="errors.collect('date')"
                        label="Birth day"
                        prepend-icon="event"
                        readonly
                        v-on="on"
                        data-vv-name="date"
                        required
                ></v-text-field>
            </template>
            <v-date-picker v-model="date" @input="menu = false"
                           :max="new Date().toISOString().substr(0, 10)"></v-date-picker>
        </v-menu>
        <v-spacer></v-spacer>
        <v-text-field
                v-model="reportsubject"
                v-validate="'required|max:255'"
                :counter="255"
                :error-messages="errors.collect('reportsubject')"
                label="Report subject"
                data-vv-name="reportsubject"
                required
        ></v-text-field>
        <v-select
                v-model="country"
                v-validate="'required'"
                :items="countries"
                :error-messages="errors.collect('country')"
                label="Select country"
                data-vv-name="country"
                required
        ></v-select>
        <v-text-field
                v-model="phone"
                v-validate="'required|numeric|min:12|max:15'"
                :counter="15"
                :error-messages="errors.collect('phone')"
                label="Phone"
                data-vv-name="phone"
                required
        ></v-text-field>
        <v-text-field
                v-model="email"
                v-validate="'required|max:50|email'"
                :counter="50"
                :error-messages="errors.collect('email')"
                label="Email"
                data-vv-name="email"
                required
        ></v-text-field>
        <v-stepper-step :rules="[() => false]" step="1" v-show="showEmailError">
            <small>The email has already been taken.</small>
        </v-stepper-step>
        <v-btn color="primary" @click="firstForm()">Continue</v-btn>
    </v-form>
</template>
<script>
    export default {
        name: "FirstForm",
        data: function () {
            return {
                firstname: '',
                lastname: '',
                reportsubject: '',
                country: '',
                phone: '',
                email: '',
                countries: [],
                date: '',
                menu: false,
                showEmailError: false,
            };
        },
        methods: {
            firstForm() {
                this.$validator.validate().then(valid => {
                    if (valid) {
                        let memberData = {
                            firstname: this.firstname,
                            lastname: this.lastname,
                            birthdate: this.date,
                            reportsubject: this.reportsubject,
                            country: this.country,
                            phone: this.phone,
                            email: this.email,
                        };
                        axios.post('/store', memberData).then(respond => {
                            if (respond.data.email === 'error') {
                                this.showEmailError = true
                            } else {
                                this.$store.dispatch('nextStep');
                                this.$store.dispatch('countMembers')
                            }
                        })
                    }
                });
            },
            getCountries() {
                axios.get('/api/countries').then(response => {
                    this.countries = response.data.countries
                })
            },
            resetFilters() {
                this.form.reset()
            },

        },
        mounted() {
            this.getCountries()
            this.$store.dispatch('countMembers')
        }
    }
</script>