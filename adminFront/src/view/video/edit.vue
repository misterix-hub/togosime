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
                <v-flex lg12 xs12 md12>
                  <v-text-field label="Titre" v-model="video.titre" class="purple-input"/>
                </v-flex>

                <v-flex lg12 xs12 md12>
                  <v-textarea label="Description" v-model="video.description" class="purple-input"/>
                </v-flex>

                <v-flex lg12 xs12 md12>
                  <v-text-field
                    label="Lien"
                    type="url"
                    v-model="video.url"
                    class="purple-input"
                  />
                </v-flex>


                <v-flex xs6 md6 lg6>
                  <v-btn
                      class="mx-0 font-weight-light"
                      color="success"
                      @click="$router.push({ name: 'video_list' })"
                    >Liste</v-btn>
                </v-flex>
                <v-flex v-show="$props.type == 'new'" xs6 md6 lg6 text-xs-right>
                  <v-btn
                    :loading="loading"
                    class="mx-0 font-weight-light"
                    color="success"
                    @click="addVideo"
                  >Ajouter</v-btn>
                </v-flex>
                <v-flex v-show="$props.type == 'update'" xs12 text-xs-right>
                  <v-btn
                    :loading="loading"
                    class="mx-0 font-weight-light"
                    color="success"
                    @click="updateVideo"
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
        video: {
          titre: '',
          description: '',
          url: '',
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
        this.getVideo()

      }
    },
    methods: {
      getVideo () {
          let vm = this;
          this.axios.get('api/videos/'+vm.$props.id).then((response) => {
            this.video = response.data
            // console.log('client to update',response.data)
          });
      },
      initialisationVideo (){
        this.video = {
          titre: '',
          description: '',
          url: '',
        }
      },
      addVideo (){
        let vm = this
        this.loading = true
        if( this.video.titre != '' && this.video.description != '' && this.video.url ){

          let client = {
            titre: this.video.titre,
            description: this.video.description,
            url: this.video.url,
          }
          console.log(this.$store.state.curentUser.partenaire_id)
          this.axios.post('/api/videos', client).then(
            (response) => {
              console.log(response.data)
              this.alertMessage = 'Video ajouté avec success'
              this.alert.showSuccess = true
              this.loading = false
              let client = {
                titre: '',
                description: '',
                telephone: '',
                url: '',
              }
              //console.log('this client',vm.client)
              //console.log('client',client)
              vm.initialisationVideo()

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
      updateVideo (){
        this.loading = true
        if(this.video.titre != '' && this.video.description != '' && this.video.url != '' ){
          let client = {
            titre: this.video.titre,
            description: this.video.description,
            url: this.video.url,
          }
          this.axios.put('/api/videos/'+this.$props.id, client).then((response) => {
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
