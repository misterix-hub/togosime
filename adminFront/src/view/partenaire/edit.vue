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
        basic: {
          dialog: false
        },
      }
    },

    mounted() {
      if(this.$props.type == 'update') {
        // console.log("update gamme")
        this.getPartenaire()

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
            partenaire.append("fournisseur", this.partenaire.fournisseur);

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
