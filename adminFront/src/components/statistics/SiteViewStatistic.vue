<template>
  <v-card class="card">
    <v-card-text class="pa-3">
      <line-chart :data="data" xtitle="Mois" ytitle="Nombre d'abonnement" :dataset="{borderWidth: 3}"/>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  data() {
    return {
      data: {
        '2018-05-13': 640,
        '2018-05-14': 200,
        '2018-05-15': 250,
        '2018-05-16': 350,
        '2018-05-17': 200,
        '2018-05-18': 670,
        '2018-05-19': 600,
        '2018-05-20': 800,
        '2018-05-21': 800,
        '2018-05-22': 800,
        '2018-05-24': 800,
        }
    }
  },
  mounted(){
    this.getPartenaireNombreAbonnementParJour()
  },
  methods:{
    getPartenaireNombreAbonnementParMois (){
      let data = {}
      console.log('/api/statistiques/getPartenaireNombreAbonnementParMois/'+this.$store.state.curentUser.partenaire_id)
      this.axios.get('/api/statistiques/getPartenaireNombreAbonnementParMois/'+this.$store.state.curentUser.partenaire_id).then((response)=>{
        response.data.forEach((element)=>{
          data[element.mois] = element.nombre
        })
        this.data = data
        console.log('data', data)

      })
    },
    getPartenaireNombreAbonnementParJour (){
      let data = {}
      console.log('/api/statistiques/getPartenaireNombreAbonnementParJour/'+this.$store.state.curentUser.partenaire_id)
      this.axios.get('/api/statistiques/getPartenaireNombreAbonnementParJour/'+this.$store.state.curentUser.partenaire_id).then((response)=>{
        response.data.forEach((element)=>{
          data[element.mois] = element.nombre
        })
        this.data = data
        console.log('data', data)

      })
    }
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
