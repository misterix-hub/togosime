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
          <v-btn depressed outline icon fab dark @click.native="getLignes()" color="indigo" small>
            <v-icon>refresh</v-icon>
          </v-btn>

          <v-dialog v-model="basic.dialog" scrollable persistent max-width="500px">
            <v-btn color="indigo" depressed outline icon fab dark @click=""  small slot="activator">
              <h5> <i class="fa fa-plus" ></i> </h5>
            </v-btn>
            <v-card>
              <v-card-title>
                <span  class="headline">Ajouter ligne</span>
              </v-card-title>
              <v-divider></v-divider>
              <v-card-text>
                <v-form>
                  <v-flex >
                    <v-text-field label="Ligne" v-model="ligne"/>
                  </v-flex>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat @click.native="basic.dialog = false, initialisationOfInput()">Fermer</v-btn>
                <v-btn color="blue darken-1" flat @click.native="basic.dialog = false, addLigne()">Ajouter</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
        <v-divider></v-divider>
        <v-card-text class="pa-0">
          <v-data-table
            :headers="headers"
            :search="search"
            :items="lignes"
            :rows-per-page-items="[10,25,100,200,500,1000,{text:'All','value':-1}]"
            class="elevation-1"
            item-key="name"
            >
            <template slot="items" slot-scope="props">
              <td>  {{ props.item.ligne }}   </td>
              <td>
                <v-btn  depressed outline icon fab dark color="pink" small @click.native="basic2.dialog = true, elementRemove = props.item.id" >
                  <v-icon>delete</v-icon>
                </v-btn>
              </td>
            </template>
          </v-data-table>
        </v-card-text>

      </v-card>

      <v-dialog v-model="basic2.dialog" persistent max-width="500px">
      <v-card color="red" style="color: #FFFFFF">
        <v-card-title>
          <span class="headline" >Suppression</span>
        </v-card-title>
        <v-divider></v-divider>
        <v-card-text>
          Ete vous sûre de vouloir le supprimer ?
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="white" flat @click.native="basic2.dialog = false">Non</v-btn>
          <v-btn color="white" flat @click.native="basic2.dialog = false, removeLigne()">Oui</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>


  </div>
</template>

<script>
export default {
  data () {
    return {
      search: '',
      headers: [],
      ligne: '',
      lignes: [],
      elementRemove: '',
      abonnement: {
        nombre_passage: '',
      },
      basic: {
        dialog: false
      },
      basic2: {
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
      this.getLignes();
    }, 1000);
  },
  methods: {
    removeLigne () {

      this.axios.delete('api/lignePages/' + this.elementRemove,).then((response) => {

        this.getLignes();
        this.mountedInitialisation();

      });


    },
    addLigne () {
      let vm = this;
      let input = {ligne: this.ligne}
      console.log(input)
      this.axios.post('api/pages/'+this.$route.params.id+'/lignes', input).then((response) => {
        //console.log('client abonnement added',response.data)
        this.getLignes();
        this.ligne = ''

      });
    },
    getLignes (){
      let vm = this;
      this.axios.get('api/pages/'+this.$route.params.id+'/lignes').then((response) => {
        this.lignes = response.data
        console.log('client abonnement',response.data)

      });
    },
    initialisationOfInput(){
      this.ligne = ''
    },
    mountedInitialisation () {
      this.headers = [
        {
          text: 'Ligne',
          value: 'ligne'
        },
         {
          text: 'Action',
          value: 'action'
        }
      ];
    },
  },
}
</script>
