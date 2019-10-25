<template>
  <v-card class="card">
    <v-card-text class="pa-2">
      <pie-chart :data="data" legend="right" :donut="true"></pie-chart>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  data() {
    return {
      data: {'USA': 90, 'China': 70, 'Russia': 40, 'Germany': 30, 'United Kingdom': 35, 'Turkey': 22}
    }
  },
  mounted(){
    this.nombreDeTypeAbonnementVendu()
  },
  methods:{
    nombreDeTypeAbonnementVendu (){
      let data = {}
      console.log('/api/statistiques/nombreDeTypeAbonnementVendu/'+this.$store.state.curentUser.partenaire_id)
      this.axios.get('/api/statistiques/nombreDeTypeAbonnementVendu/'+this.$store.state.curentUser.partenaire_id).then((response)=>{
        response.data.forEach((element)=>{
          data[element.libelle] = element.nombre
        })
        this.data = data
        console.log('data', data)

      })
    },
  }
}
</script>

<style>
  .card {
    border-radius: 3px;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, 0.125);
    box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.21);
    background-color: transparent;
  }
</style>
