<template>
    <v-container>
        <v-row justify="center">
            <v-col cols="8">
                <h1>Users:</h1>
                <v-simple-table>
                    <thead>
                    <tr>
                        <th class="text-left">Name</th>
                        <th class="text-left">Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in users" :key="user.email">
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                    </tr>
                    </tbody>
                </v-simple-table>
                <v-overlay :value="overlay">
                    <v-progress-circular indeterminate size="64"></v-progress-circular>
                </v-overlay>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
    import axios from 'axios'

    export default {
        data() {
            return {
                users: [],
                overlay: false,
            }
        },
        created() {
            this.overlay = true;
            this.fetch();
        },
        methods: {
            fetch() {
                const token = 'Nn0UELsFhM0g1Z4GvG2RGWHSHxpFd1x9L3BnE0YuIacQiatpXJRUQ7hOYggZ';
                axios.get('/api/hotels', {headers: {'Authorization': 'Bearer ' + token}}).then(response => {
                    this.users = response.data.response;
                    this.overlay = false;
                })
            }
        }
    }
</script>
