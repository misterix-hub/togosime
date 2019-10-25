<template>
  <v-card class="card">
    <center><h4>Commandes par gamme</h4></center>
    <v-card-text class="pa-2">
      <pie-chart :data="data" legend="right" :donut="true"></pie-chart>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  data() {
    return {
      data: {}
    }
  },
  mounted(){
    this.nombreDeGamme()
  },
  methods:{
    nombreDeGamme (){
      let data = {}
      this.axios.get('/api/statistiques/nombreDeCategorieCommande').then((response)=>{
        response.data.forEach((element)=>{
          data[element.nom] = element.nombre
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
