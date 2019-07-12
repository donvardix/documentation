<template>
    <v-app>
        <v-content>
                <v-layout row justify-center>

                        <router-view></router-view>

                </v-layout>
        </v-content>
    </v-app>
</template>

<script>
    export default {
        name: "App",
    }
</script>

<style scoped>

</style>