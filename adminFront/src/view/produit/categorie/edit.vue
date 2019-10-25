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
                <v-flex xs12 md12>
                  <v-text-field label="Nom" v-model="categorie.nom" class="purple-input"/>
                </v-flex>

                <v-flex xs12 md12>
                  <v-text-field label="Description" v-model="categorie.description" class="purple-input"/>
                </v-flex>
                <v-flex lg12 xs12>
                  <v-autocomplete
                    label="Gamme"
                    :items="gammes"
                    v-model="categorie.gamme_id"
                    autocomplete
                    item-text="nom"
                    item-value="id"
                  ></v-autocomplete>
                </v-flex>
                <v-flex xs6 md6 lg6>
                  <v-btn
                      class="mx-0 font-weight-light"
                      color="success"
                      @click="$router.push({ name: 'product_category_list' })"
                    >Liste</v-btn>
                </v-flex>
                <v-flex v-show="$props.type == 'new'" xs12 text-xs-right>
                  <v-btn
                    :loading="loading"
                    class="mx-0 font-weight-light"
                    color="success"
                    @click="addCategorie"
                  >Ajouter</v-btn>
                </v-flex>
                <v-flex v-show="$props.type == 'update'" xs12 text-xs-right>
                  <v-btn
                    :loading="loading"
                    class="mx-0 font-weight-light"
                    color="success"
                    @click="updateCategorie"
                  >Mettre à jour</v-btn>
                </v-flex>
              </v-layout>
            </v-container>
          </v-form>
        </material-card>
      </v-flex>
    </v-layout>
    <br><br>
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
        gammes: [],
        categorie: {
          nom: '',
          description: '',
          gamme_id: ''

        },
        alert: {
          showSuccess: false,
          showError: false
        },
        alertMessage: '',
        loading: false,
      }
    },

    mounted() {
      if(this.$props.type == 'update') {
        // console.log("update page")
        this.getCategorie()

      }

      this.getGammes()

    },
    methods: {
      getCategorie () {
          let vm = this;
          this.axios.get('api/categories/'+vm.$props.id+'/details').then((response) => {
            this.categorie.id = response.data.id
            this.categorie.nom = response.data.nom
            this.categorie.description = response.data.description
            this.categorie.gamme_id = response.data.gamme_produit_id
            // console.log('categorie to update',response.data)
          });
      },
      getGammes () {
          let vm = this;
            // console.log('gamme to update')

          this.axios.get('/api/gammes').then((response) => {
            this.gammes = response.data
            // console.log('gamme to update',response.data)

          });

      },
      initialisationCategorie (){
        this.categorie = {
          nom: '',
          description: '',
        }
      },
      addCategorie (){
        let vm = this
        this.loading = true
        if(this.categorie.gamme_id != '' && this.categorie.nom != '' && this.categorie.description != ''){

          let categorie = {
            gamme_produit_id: this.categorie.gamme_id,
            nom: this.categorie.nom,
            description: this.categorie.description,
          }
          this.axios.post('/api/categories/store', categorie).then(
            (response) => {
              console.log(response.data)
              this.alertMessage = 'Categorie ajouté avec success'
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
      updateCategorie (){
        console.log(this.categorie.gamme_id)
        this.loading = true
        if(this.categorie.nom != '' && this.categorie.prenom != '' && this.categorie.email != '' && this.categorie.telephone != ''){
          let categorie = {
            gamme_produit_id: this.categorie.gamme_id,
            nom: this.categorie.nom,
            description: this.categorie.description,
          }
          this.axios.put('/api/categories/'+this.$props.id+'/update', categorie).then((response) => {
            console.log(response.data)
            this.alertMessage = 'Categorie mis à jour avec success'
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
