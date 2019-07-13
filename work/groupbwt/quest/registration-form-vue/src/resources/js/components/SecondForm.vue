<template>
    <form>
        <v-text-field
                v-model="company"
                v-validate="'max:50'"
                :counter="50"
                :error-messages="errors.collect('company')"
                label="Company"
                data-vv-name="company"
        ></v-text-field>
        <v-text-field
                v-model="position"
                v-validate="'max:50'"
                :counter="50"
                :error-messages="errors.collect('position')"
                label="Position"
                data-vv-name="position"
        ></v-text-field>
        <v-text-field
                v-model="aboutme"
                v-validate="'max:255'"
                :counter="255"
                :error-messages="errors.collect('aboutme')"
                label="Aboutme"
                data-vv-name="aboutme"
        ></v-text-field>
        <v-layout wrap>
            <v-flex xs12 sm6>
                <v-text-field label="Select photo" @click='pickFile' v-model='imageName'
                              prepend-icon='attach_file'
                              v-bind:errorMessages="errors.photo"></v-text-field>
                <input type="file" style="display: none" ref="image" accept="image/*"
                       @change="onFilePicked">
            </v-flex>
        </v-layout>
        <v-btn color="primary" @click="secondForm()">Continue</v-btn>
    </form>
</template>
<script>
    export default {
        name: "Register",
        data: function () {
            return {
                company: '',
                position: '',
                aboutme: '',
                photo: '',
                imageName: '',
                imageFile: '',
                imageUrl: ''
            };
        },
        methods: {

            secondForm(){
                this.$validator.validate().then(valid => {
                    if (valid) {
                        let formData = new FormData()
                        formData.append('company', this.company)
                        formData.append('position', this.position)
                        formData.append('aboutme', this.aboutme)
                        formData.append('photo', this.imageFile)
                        this.$store.commit('nextStepMut')
                        axios.post('/store2', formData, {'Content-Type': 'multipart/form-data' }).then(respond => {

                        })
                    }
                });
            },
            pickFile() {
                this.$refs.image.click()
            },

            onFilePicked(e) {
                const files = e.target.files
                if (files[0] !== undefined) {
                    this.imageName = files[0].name
                    if (this.imageName.lastIndexOf('.') <= 0) {
                        return
                    }
                    const fr = new FileReader()
                    fr.readAsDataURL(files[0])
                    fr.addEventListener('load', () => {
                        this.imageUrl = fr.result
                        this.imageFile = files[0] // this is an image file that can be sent to server...
                    })
                } else {
                    this.imageName = ''
                    this.imageFile = ''
                    this.imageUrl = ''
                }
            }
        }
    }
</script>