<template>
    <v-layout justify-center row>
    <v-flex xs1>
        <v-card-text>
            <v-btn color="#3B5998" v-bind:href="fbUrl">
                <v-icon>fa-facebook-f</v-icon>
            </v-btn>
        </v-card-text>
    </v-flex>
        <v-flex xs1>
            <v-card-text>
                <v-btn color="#55ACEE" v-bind:href="twUrl">
                    <v-icon>fa-twitter</v-icon>
                </v-btn>
            </v-card-text>
        </v-flex>
    </v-layout>
</template>
<script>
    export default {
        name: "Share",
        data: () => ({
            fbUrl: 'https://www.facebook.com/sharer/sharer.php?u=' + window.location.hostname,
            gpUrl: 'https://plus.google.com/share?url=' + window.location.hostname,
            twText: 'Check out this Meetup with SoCal AngularJS!',
        }),
        computed: {
            twUrl: function () {
                return 'http://twitter.com/share?text=' + this.twText + '&url=';
            }
        }
    }
</script>