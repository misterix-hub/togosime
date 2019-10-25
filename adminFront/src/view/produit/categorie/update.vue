<template>
  <div>
    <v-card
      flat
      tile
    >
      <v-card-text>
        <edit :clientEdit="client" :id="$route.params.id" type="update"></edit>
      </v-card-text>
    </v-card>
  </div>
</template>
<script>
import edit from './edit'
export default {
  components: {edit},
  data (){
    return {
      client: {},

    }
  },

  methods: {

  }

}
</script>
