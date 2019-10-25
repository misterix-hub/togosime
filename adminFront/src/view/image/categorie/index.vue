<template>
  <div id="pageTable">
    <!-- {{input}} -->
    <!-- {{ input.roles }} -->
    <v-container grid-list-xl fluid>
      <v-layout row wrap>
        <v-flex lg12>
          <v-alert type="success" dismissible v-model="alert.showSuccess" transition="scale-transition">
            {{alertMessage}}
          </v-alert>
          <v-alert type="error" dismissible v-model="alert.showError" transition="scale-transition">
            {{alertMessage}}
          </v-alert>
          <v-alert type="error" dismissible v-model="erreurs.length" transition="scale-transition">
            <ul>
              <ul>
                <li><b>Priere de corriger cette(ces) erreur(s)</b></li>
                <li v-for="(error, i) in erreurs" :key="i">{{ error }}</li>
              </ul>
            </ul>
          </v-alert>
          <v-alert type="warning" dismissible v-model="alert.showWarnning" transition="scale-transition">
            {{alertMessage}}
          </v-alert>
          <v-alert type="info" dismissible v-model="alert.showInfo" transition="scale-transition">
            {{alertMessage}}
          </v-alert>

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
                <v-btn depressed outline icon fab dark @click.native="getCategories()" color="indigo" small>
                  <v-icon>refresh</v-icon>
                </v-btn>
                <v-btn  depressed outline icon fab dark @click.native="$router.push({name: 'image_category_add'})" color="indigo" small >
                  <h5> <i class="fa fa-plus" ></i> </h5>
                </v-btn>
              </v-toolbar>
              <v-divider></v-divider>
              <v-card-text class="pa-0">
                <v-data-table
                  :headers="headers"
                  :search="search"
                  :items="categories"
                  :rows-per-page-items="[10,25,100,200,500,1000,{text:'All','value':-1}]"
                  class="elevation-1"
                  item-key="name"
                  >
                  <template slot="items" slot-scope="props">
                    <td>  {{ props.item.nom }}   </td>
                    <td>  {{ props.item.description }}   </td>
                    <td>
                      <v-btn  depressed outline icon fab dark color="primary" small @click.native="$router.push({ name: 'image_category_edit', params: {id: props.item.id} })">
                        <!-- , initCEAR(props.item.country_id, props.item.account_type_id) -->
                        <v-icon>edit</v-icon>
                      </v-btn>
                      <v-btn  depressed outline icon fab dark color="pink" small @click.native="basic2.dialog = true, elementRemove = props.item.id" >
                        <v-icon>delete</v-icon>
                      </v-btn>
                    </td>
                  </template>0
                </v-data-table>
              </v-card-text>

            </v-card>
        </v-flex>
      </v-layout>
    </v-container>
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
          <v-btn color="white" flat @click.native="basic2.dialog = false, removeClient()">Oui</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>


<script>
export default {
  name: 'categorieImage',
  data () {
    return {
      categories: [],
      elementRemove: '',
      basic2: {
        dialog: false
      },
      basic: {
        dialog: false
      },

      erreurs: [],
      alertMessage: '',
      alert: {
        showSuccess: false,
        showError: false,
        showWarnning: false,
        showInfo: false
      },
      search: '',
      headers: [],
      title: 'Image Upload',
      dialog: false,
      imageName: '',
      imageUrl: '',
      imageFile: '',
      errorDialog: null,
      errorText: '',
      uploadFieldName: 'file',
      maxSize: 1024
    };
  },
  watch: {
  },
  computed: {




  },
  mounted () {
    setTimeout(() => {
      this.mountedInitialisation();

      this.getCategories();
    }, 1000);

  },
  methods: {
    removeClient () {

      this.axios.delete('api/categorieImages/' + this.elementRemove,).then((response) => {

        this.initialisation();
        // console.log('Réussite');
        this.getCategories();
        mountedInitialisation();

      });


    },
    getCategories () {
      let vm = this

      this.axios.get('api/categorieImages').then((response) => {
        this.categories = response.data
        console.log(response.data)

      });

    },
    mountedInitialisation () {
      this.headers = [

        {
          text: 'Nom',
          value: 'nom'
        },
        {
          text: 'Description',
          value: 'description'
        },
        {
          text: 'Action',
          value: 'action'
        }
      ];
    },
    initialisation () {
      this.alertMessage = '';
      this.alert = {
        showSuccess: false,
        showError: false,
        showWarnning: false,
        showInfo: false
      };
      this.erreurs = [];
    },

  }
};
</script>
