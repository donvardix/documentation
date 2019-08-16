<template>
  <v-app>
    <v-app-bar app>
      <v-toolbar-title class="headline text-uppercase">
        <span>Vuetify</span>
        <span class="font-weight-light">MATERIAL DESIGN</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>

      <v-btn text @click="$router.push('/')">
        <span class="mr-2">Home</span>
      </v-btn>
      <v-btn text @click="$router.push('items')">
        <span class="mr-2">Items</span>
      </v-btn>
      <v-btn text @click="$router.push('about')">
        <span class="mr-2">About</span>
      </v-btn>

    </v-app-bar>

    <v-content>
      <router-view/>
    </v-content>
  </v-app>
</template>

<script>
  export default {
    name: 'App',
    data: () => ({
      //
    }),
  };
</script>
