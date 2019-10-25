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
                  <v-text-field label="Nom" v-model="page.nom" class="purple-input"/>
                </v-flex>

                <v-flex xs12 md12>
                  <v-textarea label="Contenu" v-model="page.contenu" class="purple-input"/>
                </v-flex>
                <v-flex xs12 md12>
                <label for="icone">
                Icone:

                </label>
                <br>
                  <input
                    id="file"
                    ref="file"
                    accept=".png, .jpg, .jpeg"
                   type="file" label="Icone" >
                </v-flex>
                <v-flex xs6 md6 lg6>
                  <v-btn
                      class="mx-0 font-weight-light"
                      color="success"
                      @click="$router.push({ name: 'page_list' })"
                    >Liste</v-btn>
                </v-flex>
                <v-flex v-show="$props.type == 'new'" xs6 md6 lg6 text-xs-right>
                  <v-btn
                    :loading="loading"
                    class="mx-0 font-weight-light"
                    color="success"
                    @click="addPage"
                  >Ajouter</v-btn>
                </v-flex>
                <v-flex v-show="$props.type == 'update'" xs6 md6 lg6 text-xs-right>
                  <v-btn
                    :loading="loading"
                    class="mx-0 font-weight-light"
                    color="success"
                    @click="updatePage"
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
        page: {
          nom: '',
          contenu: '',
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
        this.getPage()

      }

    },
    methods: {
      getPage () {
          let vm = this;
          // console.log('gamme to update')
          this.axios.get('api/pages/'+vm.$props.id).then((response) => {
            this.page = response.data
            console.log('page to update',response.data)
          });
      },
      initialisationPage (){
        this.page = {
          nom: '',
          contenu: '',
        }
      },
      addPage (){
        let vm = this
        this.loading = true
        if(this.page.nom != '' && this.page.contenu != ''){

          let page = new FormData();
          page.append("icone", this.$refs.file.files[0]);
          page.append("nom", this.page.nom);
          page.append("contenu", this.page.contenu);

          this.axios.post('/api/pages', page,
          {
						headers: {
							'Content-Type': 'multipart/form-data'
						}

					}
          ).then(
            (response) => {
              console.log(response.data)
              this.alertMessage = 'Page ajouté avec success'
              this.alert.showSuccess = true
              this.loading = false
              let page = {
                nom: '',
                valeur: '',
              }
              //console.log('this page',vm.page)
              //console.log('page',page)
              vm.initialisationPage()

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
      updatePage (){
        this.loading = true
        if(this.page.nom != '' && this.page.contenu != ''){
          let page = new FormData();
          page.append("icone", this.$refs.file.files[0]);
          page.append("nom", this.page.nom);
          page.append("contenu", this.page.contenu);
//  for (var p of page){
//           console.log(p)
//       }
          this.axios.post('/api/pages/'+this.$props.id+'/update', page,
          {
						headers: {
							'Content-Type': 'multipart/form-data'
						}

					}
          ).then((response) => {
            console.log(response.data)
            this.alertMessage = 'Page mis à jour avec success'
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
