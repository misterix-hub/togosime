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
                <v-flex xs12 md6>
                  <v-text-field label="Nom" v-model="client.nom" class="purple-input"/>
                </v-flex>

                <v-flex xs12 md6>
                  <v-text-field label="Prenom" v-model="client.prenom" class="purple-input"/>
                </v-flex>

                <v-flex xs12 md6>
                  <v-text-field
                    label="Email"
                    type="email"
                    v-model="client.email"
                    class="purple-input"
                  />
                </v-flex>

                <v-flex xs12 md6>
                  <v-text-field type="number" label="Telephone" v-model="client.telephone" class="purple-input"/>
                </v-flex>
                <v-flex lg6 xs12>
                  <v-autocomplete
                    label="Carte"
                    :items="cartes"
                    v-model="client.carte_id"
                    autocomplete
                    item-text="identifiant"
                    item-value="id"
                  ></v-autocomplete>
                </v-flex>
                <div class="d-flex">
                  <v-switch
                    label="Statut (Activé/Désactivé) *"
                    v-model="client.compte.statut"
                  ></v-switch>
                </div>
                <v-flex v-show="$props.type == 'new'" xs12 text-xs-right>
                  <v-btn
                    :loading="loading"
                    class="mx-0 font-weight-light"
                    color="success"
                    @click="addClient"
                  >Ajouter</v-btn>
                </v-flex>
                <v-flex v-show="$props.type == 'update'" xs12 text-xs-right>
                  <v-btn
                    :loading="loading"
                    class="mx-0 font-weight-light"
                    color="success"
                    @click="updateClient"
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
        cartes: [],
        client: {
          nom: '',
          prenom: '',
          email: '',
          telephone: '',
          compte: {
            statut: true
          },
          carte_id: ''

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
        this.getClient()

      }
      if(this.$props.type == 'new') {
        // console.log("new page")
        this.getCartes()
      }

    },
    methods: {
      getClient () {
          let vm = this;
          this.axios.get('api/clients/'+vm.$props.id).then((response) => {
            this.client = response.data
            // console.log('client to update',response.data)
            if(this.$props.type == 'update') {
              this.cartes.push({
                id: response.data.carte.id,
                identifiant: response.data.carte.identifiant
              })
              this.client.carte_id = response.data.carte.id
            }
          });
      },
      getCartes () {
          let vm = this;
            // console.log('carte to update')

          this.axios.get('/api/partenaires/'+vm.$store.state.curentUser.partenaire_id+'/cartes').then((response) => {
            this.cartes = response.data
            // console.log('carte to update',response.data)

          });

      },
      initialisationClient (){
        this.client = {
          nom: '',
          prenom: '',
          telephone: '',
          email: '',
          compte: {
            statut: true,
          },
          carte_id: ''

        }
      },
      addClient (){
        let vm = this
        this.loading = true
        if(this.client.carte_id != '' && this.client.nom != '' && this.client.prenom != '' && this.client.email != '' && this.client.telephone != ''){

          let client = {
            carte_id: this.client.carte_id,
            nom: this.client.nom,
            prenom: this.client.prenom,
            email: this.client.email,
            telephone: this.client.telephone,
            statut: this.client.compte.statut,
            partenaireId: this.$store.state.curentUser.partenaire_id,
          }
          console.log(this.$store.state.curentUser.partenaire_id)
          this.axios.post('/api/clients', client).then(
            (response) => {
              console.log(response.data)
              this.alertMessage = 'Client ajouté avec success'
              this.alert.showSuccess = true
              this.loading = false
              let client = {
                nom: '',
                prenom: '',
                telephone: '',
                email: '',
                compte: {
                  statut: true,
                },
                carte_id: ''
              }
              //console.log('this client',vm.client)
              //console.log('client',client)
              vm.initialisationClient()

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
      updateClient (){
        this.loading = true
        if(this.client.nom != '' && this.client.prenom != '' && this.client.email != '' && this.client.telephone != ''){
          let client = {
            nom: this.client.nom,
            prenom: this.client.prenom,
            email: this.client.email,
            telephone: this.client.telephone,
            statut: this.client.compte.statut,
          }
          this.axios.put('/api/clients/'+this.$props.id, client).then((response) => {
            console.log(response.data)
            this.alertMessage = 'Client mis à jour avec success'
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
