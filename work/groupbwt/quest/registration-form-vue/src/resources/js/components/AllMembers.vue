<template>
    <v-layout row wrap justify-center>
        <v-flex xs6>
            <v-layout justify-center>
                <router-link :to="{ name: 'register' }">
                    <v-btn color="info">Return to registration page</v-btn>
                </router-link>
                <router-link :to="{ name: 'admin' }">
                    <v-btn>Admin panel</v-btn>
                </router-link>
            </v-layout>

            <v-data-table :headers="headers" :items="admin ? membersAdmin : members" class="elevation-1">
                <template v-slot:items="props">
                    <td class="text-xs-center">
                        <img v-if="props.item.photo" class="avatar"
                             :src="'storage/uploads/' + props.item.photo" width="50" height="50" alt="photo">
                        <img v-else class="my-2" :src="defaultImage" width="50" height="50" alt="photo">
                    </td>
                    <td>{{ props.item.firstname }} {{ props.item.lastname }}</td>
                    <td>{{ props.item.reportsubject }}</td>
                    <td><a :href="'mailto:'+props.item.email">{{ props.item.email }}</a></td>
                    <td v-if="admin" class="text-xs-center">
                        <input v-if="props.item.deleted_at" type="checkbox" :data-id="props.item.id" @click="show"
                               checked>
                        <input v-else type="checkbox" :data-id="props.item.id" @click="hide">
                    </td>
                </template>
            </v-data-table>
        </v-flex>
    </v-layout>
</template>
<script>
    export default {
        name: "AllMembers",
        data() {
            return {
                admin: false,
                members: [],
                membersAdmin: [],
                defaultImage: '',
                headers: [
                    {text: 'Photo', align: 'center', sortable: false, value: 'photo'},
                    {text: 'Name', value: 'name'},
                    {text: 'Report subject', value: 'reportsubject'},
                    {text: 'Email', value: 'email'},
                ]
            };
        },
        methods: {
            allcount() {
                axios.post('/api/members').then(respond => {
                    this.members = respond.data.members
                    this.membersAdmin = respond.data.membersAdmin
                    this.defaultImage = respond.data.defaultAvatar
                })
            },
            hide: function (event) {
                this.$store.dispatch('hideMember', event.target.getAttribute('data-id'));
            },
            show(event) {
                this.$store.dispatch('showMember', event.target.getAttribute('data-id'));
            },
            checkAdmin() {
                axios.get('/check-admin').then(respond => {
                    if (respond.data.status === this.$store.state.adminToken) {
                        this.admin = true
                    }
                })
            }
        },
        mounted() {
            this.allcount()
            this.checkAdmin()
        }
    }
</script>