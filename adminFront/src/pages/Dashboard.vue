<template>
  <v-container fluid grid-list-xl>
    <v-layout row wrap>
      <!-- Widgets-->

      <v-flex d-flex lg3 sm6 xs12>
        <widget icon="people" :title="total_produit" subTitle= 'Total produit' supTitle="Total produit" color="#0ba119"/>
      </v-flex>
      <v-flex d-flex lg3 sm6 xs12>
        <widget icon="people" :title="total_categorie_produit" subTitle= 'Total categorie' supTitle="Total categorie" color="#0ba119"/>
      </v-flex>
      <v-flex d-flex lg3 sm6 xs12>
        <widget icon="people" :title="total_gamme_produit" subTitle= 'Total gamme' supTitle="Total gamme" color="#0ba119"/>
      </v-flex>
      <v-flex d-flex lg3 sm6 xs12>
        <widget icon="people" :title="total_fournisseur" subTitle= 'Total fournisseur' supTitle="Total fournisseur" color="#0ba119"/>
      </v-flex>
      <v-flex d-flex lg3 sm6 xs12>
        <widget icon="money" :title="total_commande" subTitle= 'total commandes' supTitle="total commandes" color="#0ba119"/>
      </v-flex>
      <v-flex d-flex lg3 sm6 xs12>
        <widget icon="credit_card" :title="total_commande_valide" subTitle= 'Commandes validés' supTitle="Commandes validés" color="#0ba119"/>
      </v-flex>
      <v-flex d-flex lg3 sm6 xs12>
        <widget icon="credit_card" :title="total_commande_attente" subTitle= 'Commandes en attente' supTitle="Commandes en attente" color="#0ba119"/>
      </v-flex>
       <v-flex d-flex lg3 sm6 xs12>
        <widget icon="people" :title="total_partenaire" subTitle= 'Total partenaire' supTitle="Total partenaire" color="#0ba119"/>
      </v-flex>

      <v-flex d-flex lg6 sm12 xs12>
        <gamme-commande-statistique/>
      </v-flex>
      <v-flex d-flex lg6 sm12 xs12>
        <categorie-commande-statistique/>
      </v-flex>
      <!--
      <v-flex d-flex lg12 sm12 xs12>
        <total-earnings-statistic/>
      </v-flex>
      -->

    </v-layout>
  </v-container>
</template>

<script>
import CategorieCommandeStatistique from '../components/statistics/CategorieCommandeStatistique'
import GammeCommandeStatistique from '../components/statistics/GammeCommandeStatistique'
import ProduitCommande from '../components/statistics/ProduitCommande'
export default {
  components: {GammeCommandeStatistique, ProduitCommande, CategorieCommandeStatistique},
  data() {
    return {
      total_produit: '0',
      total_categorie_produit: '0',
      total_gamme_produit: '0',
      total_fournisseur: '0',
      total_partenaire: '0',
      total_commande: '0',
      total_commande_valide: '0',
      total_commande_attente: '0',
    }
  },
  mounted() {
    this.getGeneralCount();
  },
  methods: {
    getGeneralCount (){
      console.log('/api/statistiques/generalCount')
      this.axios.get('/api/statistiques/generalCount').then((response)=>{
        this.total_produit = response.data.total_produit
        this.total_categorie_produit = response.data.total_categorie_produit
        this.total_gamme_produit = response.data.total_gamme_produit
        this.total_fournisseur = response.data.total_fournisseur
        this.total_partenaire = response.data.total_partenaire
        this.total_commande = response.data.total_commande
        this.total_commande_valide = response.data.total_commande_valide
        this.total_commande_attente = response.data.total_commande_attente
      })
    }
  }
}
</script>

<style>

</style>
