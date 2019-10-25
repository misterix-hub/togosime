<template>
  <div>
    <v-card >
        <v-toolbar card color="white">
          <v-text-field
          flat
          solo
          prepend-icon="fa-search"
          placeholder="Tapez quelque chose"
          v-model="search"
          hide-details
          class="hidden-sm-and-down"
          ></v-text-field>
          <v-btn depressed outline icon fab dark @click.native="getAbonnements()" color="indigo" small>
            <v-icon>refresh</v-icon>
          </v-btn>

          <v-dialog v-model="basic.dialog" scrollable persistent max-width="500px">
            <v-btn color="indigo" depressed outline icon fab dark @click="getTypesAbonnement()"  small slot="activator">
              <h5> <i class="fa fa-plus" ></i> </h5>
            </v-btn>
            <v-card>
              <v-card-title>
                <span  class="headline">Ajouter abonnement</span>
              </v-card-title>
              <v-divider></v-divider>
              <v-card-text>
                <v-form>
                  <v-flex >
                    <v-autocomplete
                      placeholder="Type abonnement*"
                      :items="typesAbonnement"
                      v-model="input.typeAbonnementId"
                      autocomplete
                      item-text="libelle"
                      item-value="id"
                    ></v-autocomplete>
                  </v-flex>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat @click.native="basic.dialog = false, initialisationOfInput()">Fermer</v-btn>
                <v-btn color="blue darken-1" flat @click.native="basic.dialog = false, addClientAbonnement()">Ajouter</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
        <v-divider></v-divider>
        <v-card-text class="pa-0">
          <v-data-table
            :headers="headers"
            :search="search"
            :items="abonnements"
            :rows-per-page-items="[10,25,100,200,500,1000,{text:'All','value':-1}]"
            class="elevation-1"
            item-key="name"
            >
            <template slot="items" slot-scope="props">
              <td>  {{ props.item.prix }}   </td>
              <td>  {{ props.item.nombre_passage }}   </td>
              <td>  {{ props.item.surplus }} </td>
              <td>  {{ props.item.date_abonnement }}   </td>
              <td>  {{ props.item.date_expiration }} </td>
            </template>
          </v-data-table>
        </v-card-text>

      </v-card>


  </div>
</template>

<script>
export default {
  props: {
    clientId: ''
  },
  data () {
    return {
      search: '',
      headers: [],
      abonnements: [],
      abonnement: {
        nombre_passage: '',
      },
      basic: {
        dialog: false
      },
      typesAbonnement: [],
      input: {
        typeAbonnementId: ''
      }

    }
  },
  mounted() {
    setTimeout(() => {
      this.mountedInitialisation();
      this.getAbonnements();
      this.getTypesAbonnement()
    }, 1000);
  },
  methods: {
    addClientAbonnement () {
      let vm = this;
      let input = {id: this.$props.clientId, typeAbonnementId: this.input.typeAbonnementId, partenaire_id: vm.$store.state.curentUser.partenaire_id}
      console.log(input)
      this.axios.post('api/clients/'+vm.$props.clientId+'/abonnements', input).then((response) => {
        //console.log('client abonnement added',response.data)
        this.getAbonnements();


      });
    },
    getAbonnements (){
      let vm = this;
      this.axios.get('api/clients/'+vm.$props.clientId+'/abonnements').then((response) => {
        this.abonnements = response.data
        console.log('client abonnement',response.data)

      });
    },
    getTypesAbonnement (){
      let vm = this;
      this.axios.get('/api/partenaires/'+vm.$store.state.curentUser.partenaire_id+'/typesAbonnement').then((response) => {
        this.typesAbonnement = response.data
        console.log('client type abonnement',response.data)

      });
    },
    mountedInitialisation () {
      this.headers = [
        {
          text: 'Prix',
          value: 'prix'
        },
        {
          text: 'Nombre de passage',
          value: 'nombre_passage'
        },
        {
          text: 'Surplus',
          value: 'surplus'
        },
         {
          text: 'Date d\'abonnement',
          value: 'date_abonnement'
        },
         {
          text: 'Date d\'expiration',
          value: 'date_expiration'
        }
      ];
    },
  },
}
</script>
