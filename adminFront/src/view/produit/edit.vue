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
                <v-flex xs12 md12>
                  <v-text-field label="Nom" v-model="produit.nom" class="purple-input"/>
                </v-flex>
                <v-flex xs12 md12>
                  <v-text-field label="Prix" type="number" v-model="produit.prix" class="purple-input"/>
                </v-flex>

                <v-flex xs12 md12>
                  <v-textarea label="Description" v-model="produit.description" class="purple-input"/>
                </v-flex>
                <v-flex xs12 md12>
                <label for="file">
                Image:

                </label>
                <br>
                  <input
                    id="file"
                    ref="file"
                    accept=".png, .jpg, .jpeg"
                   type="file" label="Icone" >
                </v-flex>
                <v-flex lg12 xs12>
                  <v-autocomplete
                    label="Categorie"
                    :items="categories"
                    v-model="produit.categorie_produit_id"
                    autocomplete
                    item-text="nom"
                    item-value="id"
                  ></v-autocomplete>
                </v-flex>
                <v-flex xs6 md6 lg6>
                  <v-btn
                      class="mx-0 font-weight-light"
                      color="success"
                      @click="$router.push({ name: 'product_list' })"
                    >Liste</v-btn>
                </v-flex>
                <v-flex v-show="$props.type == 'new'" xs12 text-xs-right>
                  <v-btn
                    :loading="loading"
                    class="mx-0 font-weight-light"
                    color="success"
                    @click="addProduit"
                  >Ajouter</v-btn>
                </v-flex>
                <v-flex v-show="$props.type == 'update'" xs12 text-xs-right>
                  <v-btn
                    :loading="loading"
                    class="mx-0 font-weight-light"
                    color="success"
                    @click="updateProduit"
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
          <img max-width="550px" :src="produit.image">
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="white" flat @click.native="basic2.dialog = false">Quitter</v-btn>
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
        categories: [],
        produit: {
          nom: '',
          description: '',
          categorie_produit_id: ''

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
      }
    },

    mounted() {
      if(this.$props.type == 'update') {
        // console.log("update page")
        this.getProduit()

      }

      this.getCategories()

    },
    methods: {
      getProduit () {
          let vm = this;
          this.axios.get('api/produits/'+vm.$props.id+'/details').then((response) => {
            this.produit = response.data
            console.log('produit to update',response.data)

          });
      },
      getCategories () {
          let vm = this;
          console.log('get cat')

          this.axios.get('/api/categories').then((response) => {
            this.categories = response.data
            //console.log('gacarttte to update',response.data)

          });

      },
      initialisationCategorie (){
        this.produit = {
          nom: '',
          description: '',
          prix: '',
          categorie_produit_id: ''
        }
        this.$refs.file.value = ''

      },
      addProduit (){
        let vm = this
        this.loading = true
        if(this.produit.categorie_produit_id != '' && this.produit.nom != '' && this.produit.description != '' && this.produit.prix){

          let produit = new FormData();
          produit.append("image", this.$refs.file.files[0]);
          produit.append("nom", this.produit.nom);
          produit.append("description", this.produit.description);
          produit.append("prix", this.produit.prix);
          produit.append("categorie_produit_id", this.produit.categorie_produit_id);

          this.axios.post('/api/produits/store', produit,
          {
						headers: {
							'Content-Type': 'multipart/form-data'
						}

					}
          ).then(
            (response) => {
              console.log(response.data)
              this.alertMessage = 'Produit ajouté avec success'
              this.alert.showSuccess = true
              this.loading = false
              let categorie = {
                nom: '',
                description: '',
              }
              //console.log('this categorie',vm.categorie)
              //console.log('categorie',categorie)
              vm.initialisationCategorie()

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
      updateProduit (){
        let vm = this
        this.loading = true
        if(this.produit.nom != '' && this.produit.description != '' && this.produit.gamme_produit_id != ''){
          let produit = new FormData();
          produit.append("image", this.$refs.file.files[0]);
          produit.append("nom", this.produit.nom);
          produit.append("description", this.produit.description);
          produit.append("prix", this.produit.prix);
          produit.append("categorie_produit_id", this.produit.categorie_produit_id);

          this.axios.post('/api/produits/'+this.$props.id+'/update', produit,
           {
						headers: {
							'Content-Type': 'multipart/form-data'
						}

					}
          ).then((response) => {
            console.log(response.data)
            vm.produit = response.data

            this.alertMessage = 'Produit mis à jour avec success'
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
