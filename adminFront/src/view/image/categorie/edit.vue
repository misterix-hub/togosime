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
                <v-flex xs12 md12 lg12>
                  <v-text-field label="Nom" v-model="categorie.nom" class="purple-input"/>
                </v-flex>

                <v-flex xs12 md12 lg12>
                  <v-textarea label="Description" v-model="categorie.description" class="purple-input"/>
                </v-flex>

                <v-flex v-show="$props.type == 'new'" xs12 text-xs-right>
                  <v-btn
                    :loading="loading"
                    class="mx-0 font-weight-light"
                    color="success"
                    @click="addCategory"
                  >Ajouter</v-btn>
                </v-flex>
                <v-flex v-show="$props.type == 'update'" xs12 text-xs-right>
                  <v-btn
                    :loading="loading"
                    class="mx-0 font-weight-light"
                    color="success"
                    @click="updateCategory"
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
        categorie: {
          nom: '',
          description: '',
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
    },
    methods: {
      getCategorie () {
          let vm = this;
          this.axios.get('api/categorieImages/'+vm.$props.id).then((response) => {
            this.categorie = response.data

          });
      },
      initialisationCategorie (){
        this.categorie = {
          nom: '',
          description: '',
        }
      },
      addCategory (){
        let vm = this
        this.loading = true
        if( this.categorie.nom != '' && this.categorie.description != ''){

          let categorie = {
            nom: this.categorie.nom,
            description: this.categorie.description,
          }
          this.axios.post('/api/categorieImages', categorie).then(
            (response) => {
              console.log(response.data)
              this.alertMessage = 'Categorie ajoutée avec success'
              this.alert.showSuccess = true
              this.loading = false
              let categorie = {
                nom: '',
                description: '',
              }
              //console.log('this client',vm.client)
              //console.log('client',client)
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
      updateCategory (){
        this.loading = true
        if(this.categorie.nom != '' && this.categorie.description != ''){
          let categorie = {
            nom: this.categorie.nom,
            description: this.categorie.description,
          }
          this.axios.put('/api/categorieImages/'+this.$props.id, categorie).then((response) => {
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
