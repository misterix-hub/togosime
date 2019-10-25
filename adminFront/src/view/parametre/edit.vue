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
                  <v-text-field label="Nom" v-model="parametre.nom" class="purple-input"/>
                </v-flex>

                <v-flex xs12 md12>
                  <v-textarea label="Valeur" v-model="parametre.valeur" class="purple-input"/>
                </v-flex>
                <v-flex xs6 md6 lg6>
                  <v-btn
                      class="mx-0 font-weight-light"
                      color="success"
                      @click="$router.push({ name: 'setting' })"
                    >Liste</v-btn>
                </v-flex>
                <v-flex v-show="$props.type == 'new'" xs6 md6 lg6 text-xs-right>
                  <v-btn
                    :loading="loading"
                    class="mx-0 font-weight-light"
                    color="success"
                    @click="addParametre"
                  >Ajouter</v-btn>
                </v-flex>
                <v-flex v-show="$props.type == 'update'" xs6 md6 lg6 text-xs-right>
                  <v-btn
                    :loading="loading"
                    class="mx-0 font-weight-light"
                    color="success"
                    @click="updateParametre"
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
        parametre: {
          nom: '',
          valeur: '',
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
        this.getParametre()

      }

    },
    methods: {
      getParametre () {
          let vm = this;
          // console.log('gamme to update')
          this.axios.get('api/parametres/'+vm.$props.id).then((response) => {
            this.parametre = response.data
            console.log('gamme to update',response.data)
          });
      },
      initialisationGamme (){
        this.parametre = {
          nom: '',
          valeur: '',
        }
      },
      addParametre (){
        let vm = this
        this.loading = true
        if(this.parametre.nom != '' && this.parametre.description != ''){

          let gamme = {
            nom: this.parametre.nom,
            valeur: this.parametre.valeur,
          }
          this.axios.post('/api/parametres', gamme).then(
            (response) => {
              console.log(response.data)
              this.alertMessage = 'Parametre ajouté avec success'
              this.alert.showSuccess = true
              this.loading = false
              let gamme = {
                nom: '',
                valeur: '',
              }
              //console.log('this gamme',vm.parametre)
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
      updateParametre (){
        this.loading = true
        if(this.parametre.nom != '' && this.parametre.description != ''){
          let gamme = {
            nom: this.parametre.nom,
            valeur: this.parametre.valeur,
          }
          this.axios.put('/api/parametres/'+this.$props.id, gamme).then((response) => {
            console.log(response.data)
            this.alertMessage = 'Parametre mis à jour avec success'
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
