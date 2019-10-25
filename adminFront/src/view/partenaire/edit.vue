<template>
<v-container py-0>
    <br>
    <v-alert
      type="success"
      dismissible
      v-model="alert.showSuccess"
      transition="scale-transition"
    >{{alertMessage}}</v-alert>
    <v-alert
      type="error"
      dismissible
      v-model="alert.showError"
      transition="scale-transition"
    >{{alertMessage}}</v-alert>
    <br>
    <v-layout wrap>

      <v-flex xs12 md12 lg12>
        <material-card color="green" title="Edit Profile" text="Complete your profile">
          <v-form>
            <v-container py-0>
              <v-layout wrap>
                <v-flex xs6 md6 lg6>
                  <v-btn
                  v-show="$props.type == 'update'"
                      class="mx-0 font-weight-light"
                      color="success"
                      @click="basic2.dialog = true"
                    >Apercu de l'image</v-btn>
                </v-flex>
                <v-flex xs6 md6 lg6>
                  <v-btn
                  v-show="$props.type == 'update'"
                      class="mx-0 font-weight-light"
                      color="success"
                      @click="basic3.dialog = true"
                    >Voir produits</v-btn>
                </v-flex>
                <v-flex xs12 md12>
                  <v-text-field label="Nom" v-model="partenaire.nom" class="purple-input"/>
                </v-flex>

                <v-flex xs12 md12>
                  <v-textarea label="Description" v-model="partenaire.description" class="purple-input"/>
                </v-flex>
                <v-flex xs12 md12>
                  <label for="icone">Icone:</label>
                  <br>
                  <input
                    id="file"
                    ref="file"
                    accept=".png, .jpg, .jpeg"
                   type="file" label="Icone" >
                </v-flex>
                <v-flex xs12 md12 lg12>
                  <v-switch
                    label="Fournisseur (Oui/Non) *"
                    v-model="partenaire.fournisseur"
                  ></v-switch>
                </v-flex>

                <v-flex xs6 md6 lg6>
                  <v-btn
                      class="mx-0 font-weight-light"
                      color="success"
                      @click="$router.push({ name: 'provider_list' })"
                    >Liste</v-btn>
                </v-flex>
                <v-flex v-show="$props.type == 'new'" xs6 md6 lg6 text-xs-right>
                  <v-btn
                    :loading="loading"
                    class="mx-0 font-weight-light"
                    color="success"
                    @click="addProvider"
                  >Ajouter</v-btn>
                </v-flex>
                <v-flex v-show="$props.type == 'update'" xs6 md6 lg6 text-xs-right>
                  <v-btn
                    :loading="loading"
                    class="mx-0 font-weight-light"
                    color="success"
                    @click="updateProvider"
                  >Mettre à jour</v-btn>
                </v-flex>

              </v-layout>
            </v-container>
          </v-form>
        </material-card>
      </v-flex>
    </v-layout>
    <br><br>
    <v-dialog v-model="basic2.dialog" persistent max-width="600px" >
      <v-card :color="basic2.bgColor" style="color: #FFFFFF">
        <v-card-title>
          <span class="headline" >Apercu</span>
        </v-card-title>
        <v-divider></v-divider>
        <v-card-text>
          <img max-width="550px" :src="partenaire.logo">
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="white" flat @click.native="basic2.dialog = false">Quitter</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog v-model="basic3.dialog" persistent max-width="900px" >
      <v-card :color="basic3.bgColor" style="color: #FFFFFF">
        <v-card-title>
          <span class="headline" style="color: black">Produits
          <v-btn color="green" flat @click.native="basic3.dialog = false">Fermer</v-btn>

          </span>
        </v-card-title>
        <v-divider></v-divider>
        <v-card-text>
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
                <v-btn depressed outline icon fab dark @click.native="getProduits()" color="indigo" small>
                  <v-icon>refresh</v-icon>
                </v-btn>
                <v-btn  depressed outline icon fab dark @click.native="$router.push({name: 'product_add'})" color="indigo" small >
                  <h5> <i class="fa fa-plus" ></i> </h5>
                </v-btn>
              </v-toolbar>
              <v-divider></v-divider>
              <v-card-text class="pa-0">
                <v-data-table
                  :headers="headers"
                  :search="search"
                  :items="produits"
                  :rows-per-page-items="[10,25,100,200,500,1000,{text:'All','value':-1}]"
                  class="elevation-1"
                  item-key="name"
                  >
                  <template slot="items" slot-scope="props">
                    <td>  {{ props.item.nom }}   </td>
                    <td>  {{ props.item.description }}   </td>
                    <td>  {{ props.item.prix }}   </td>
                    <td>  <span v-if="props.item.categorie_produit">{{ props.item.categorie_produit.nom }}</span><span v-else>-----</span>   </td>
                    <td>
                      <v-btn  depressed outline icon fab dark color="primary" small @click.native="$router.push({ name: 'product_edit', params: {id: props.item.id} })">
                        <!-- , initCEAR(props.item.country_id, props.item.account_type_id) -->
                        <v-icon>edit</v-icon>
                      </v-btn>
                      <v-btn  depressed outline icon fab dark color="pink" small @click.native="basic2.dialog = true, elementRemove = props.item.id" >
                        <v-icon>delete</v-icon>
                      </v-btn>
                    </td>
                  </template>
                </v-data-table>

              </v-card-text>


            </v-card>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="green" flat @click.native="basic3.dialog = false">Fermer</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>
<script>
  export default {
    props: {
      type: '',
      id: ''
    },
    data (){
      return {
        produits: [],
        partenaire: {
          nom: '',
          description: '',
          fournisseur: false
        },
        alert: {
          showSuccess: false,
          showError: false
        },
        alertMessage: '',
        loading: false,
        basic2: {
          dialog: false,
          bgColor: 'blue'
        },
         basic3: {
          dialog: false,
          bgColor: 'white'
        },
        basic: {
          dialog: false
        },
      }
    },

    mounted() {
      if(this.$props.type == 'update') {
        // console.log("update gamme")
        this.getPartenaire()
        this.getProduits()
        this.mountedInitialisation()

      }

    },
    methods: {
      getPartenaire () {
          let vm = this;
          // console.log('gamme to update')
          this.axios.get('api/partenaires/'+vm.$props.id).then((response) => {
            this.partenaire = response.data
            console.log('partner to update',response.data)
          });
      },
      getProduits () {
        let vm = this
        // this.axios.get('api/categories').then((response) => {

        this.axios.get('api/partenaires/'+vm.$props.id+'/produits').then((response) => {
          this.produits = response.data
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
          text: 'Prix',
          value: 'prix'
        },
         {
          text: 'categorie',
          value: 'categorie'
        },

         {
          text: 'Action',
          value: 'action'
        }
      ];
    },
      initialisationPartenaire (){
        this.partenaire = {
          nom: '',
          description: '',
          fournisseur: false
        }
        this.$refs.file.value = ''
      },
      addProvider (){
        let vm = this
        this.loading = true
        if(this.partenaire.nom != '' && this.partenaire.description != ''){
          let partenaire = new FormData();
          partenaire.append("logo", this.$refs.file.files[0]);
          partenaire.append("nom", this.partenaire.nom);
          partenaire.append("description", this.partenaire.description);
          if(this.partenaire.fournisseur){
            partenaire.append("fournisseur", 1);
          console.log(this.partenaire.fournisseur);


          }else{
            partenaire.append("fournisseur", 0);
          console.log(this.partenaire.fournisseur);


          }

          // if(this.partenaire.fournisseur == 'true'){
          //   partenaire.append("fournisseur", 1);

          // }else{
          //   partenaire.append("fournisseur", 0);

          // }

          this.axios.post('/api/partenaires', partenaire,
          {
						headers: {
							'Content-Type': 'multipart/form-data'
						}

					}
          ).then(
            (response) => {
              console.log(response.data)
              this.alertMessage = 'Partenaire ajouté avec success'
              this.alert.showSuccess = true
              this.loading = false
              let gamme = {
                nom: '',
                description: '',
              }
              //console.log('this gamme',vm.gamme)
              //console.log('gamme',gamme)
              vm.initialisationPartenaire()

            },
            (error) => {
              this.loading = false
               this.alertMessage = 'Erreur veuillez verifier vos entrées'
              this.alert.showError = true
            }
          )
        }
        else {
          this.alertMessage = 'Veillez remplir les champs'
          this.alert.showError = true
          this.loading = false

        }

      },
      updateProvider (){
        this.loading = true
        let vm = this
        if(this.partenaire.nom != '' && this.partenaire.description != ''){
          let partenaire = new FormData();
          partenaire.append("logo", this.$refs.file.files[0]);
          partenaire.append("nom", this.partenaire.nom);
          partenaire.append("description", this.partenaire.description);
          partenaire.append("fournisseur", this.partenaire.fournisseur);
          let ppartenaire = {
            description: this.partenaire.description
          }

          this.axios.post('/api/partenaires/'+this.$props.id+'/update', partenaire,
          {
						headers: {
							'Content-Type': 'multipart/form-data'
						}

					}
          ).then((response) => {
            console.log(response.data)
            this.partenaire = response.data
            this.alertMessage = 'Partenaire mis à jour avec success'
            this.partenaire = response.data.partenaire
            this.alert.showSuccess = true
            this.loading = false
          },
          (error) => {
            this.loading = false
          })
        }
        else {
          this.alertMessage = 'Veillez remplir les champs'
          this.alert.showError = true
          this.loading = false
        }

      },

    }
  }
</script>
