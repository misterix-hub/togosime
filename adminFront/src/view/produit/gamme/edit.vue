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
                  <v-text-field label="Nom" v-model="gamme.nom" class="purple-input"/>
                </v-flex>

                <v-flex xs12 md12>
                  <v-textarea label="Description" v-model="gamme.description" class="purple-input"/>
                </v-flex>
                <v-flex xs6 md6 lg6>
                  <v-btn
                      class="mx-0 font-weight-light"
                      color="success"
                      @click="$router.push({ name: 'product_gamme_list' })"
                    >Liste</v-btn>
                </v-flex>
                <v-flex v-show="$props.type == 'new'" xs6 md6 lg6 text-xs-right>
                  <v-btn
                    :loading="loading"
                    class="mx-0 font-weight-light"
                    color="success"
                    @click="addGamme"
                  >Ajouter</v-btn>
                </v-flex>
                <v-flex v-show="$props.type == 'update'" xs6 md6 lg6 text-xs-right>
                  <v-btn
                    :loading="loading"
                    class="mx-0 font-weight-light"
                    color="success"
                    @click="updateGamme"
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
        gamme: {
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
        // console.log("update gamme")
        this.getGamme()

      }

    },
    methods: {
      getGamme () {
          let vm = this;
          // console.log('gamme to update')
          this.axios.get('api/gammes/'+vm.$props.id+'/details').then((response) => {
            this.gamme = response.data
            console.log('gamme to update',response.data)
          });
      },
      initialisationGamme (){
        this.gamme = {
          nom: '',
          description: '',
        }
      },
      addGamme (){
        let vm = this
        this.loading = true
        if(this.gamme.nom != '' && this.gamme.description != ''){

          let gamme = {
            nom: this.gamme.nom,
            description: this.gamme.description,
          }
          this.axios.post('/api/gammes/store', gamme).then(
            (response) => {
              console.log(response.data)
              this.alertMessage = 'Gamme ajouté avec success'
              this.alert.showSuccess = true
              this.loading = false
              let gamme = {
                nom: '',
                description: '',
              }
              //console.log('this gamme',vm.gamme)
              //console.log('gamme',gamme)
              vm.initialisationGamme()

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
      updateGamme (){
        this.loading = true
        if(this.gamme.nom != '' && this.gamme.description != ''){
          let gamme = {
            nom: this.gamme.nom,
            description: this.gamme.description,
          }
          this.axios.put('/api/gammes/'+this.$props.id+'/update', gamme).then((response) => {
            console.log(response.data)
            this.alertMessage = 'Gamme mis à jour avec success'
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
