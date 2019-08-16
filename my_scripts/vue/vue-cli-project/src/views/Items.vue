<template>
    <v-container>
        <v-row justify="center">
            <v-col cols="8">
                <h1>Posts:</h1>
                <v-simple-table>
                    <thead>
                    <tr>
                        <th class="text-left">Name</th>
                        <th class="text-left">Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in items">
                        <td>{{ item.title }}</td>
                        <td>{{ item.body }}</td>
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
    export default {
        data() {
            return {
                overlay: false,
            }
        },
        computed: {
            items() {
                return this.$store.getters.items;
            }
        },
        created() {
            this.$store.dispatch('getItems');
        },
        methods: {
        }
    };
</script>
