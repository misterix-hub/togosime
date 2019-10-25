<template>
  <div>
     <v-tabs
      v-model="tab"
      background-color="deep-purple accent-4"
      class="elevation-2"
      centered="true"
      grow="false"
      vertical="false"
      right="false"
      prev-icon="mdi-arrow-left-bold-box-outline"
      next-icon="'mdi-arrow-right-bold-box-outline"
      icons-and-text="false"
    >
      <v-tabs-slider></v-tabs-slider>

      <v-tab>
        Details
        <v-icon v-if="icons">mdi-user</v-icon>
      </v-tab>

      <v-tab>
        Lignes
        <v-icon v-if="icons">mdi-money</v-icon>
      </v-tab>

      <v-tab-item>
        <v-card
          flat
          tile
        >
          <v-card-text>
            <edit :clientEdit="client" :id="$route.params.id" type="update"></edit>
          </v-card-text>
        </v-card>
      </v-tab-item>

      <v-tab-item>
        <v-card
          flat
          tile
        >
          <v-card-text>
            <p-line :pageId="$route.params.id"></p-line>
          </v-card-text>
        </v-card>
      </v-tab-item>
    </v-tabs>
  </div>
</template>
<script>
import edit from './edit'
import pLine from './pLine'
export default {
  components: {edit, pLine},
  data (){
    return {
      client: {},

    }
  },

  methods: {

  }

}
</script>
