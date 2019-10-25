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
                  <v-text-field label="Email" v-model="utilisateur.email" class="purple-input"/>
                </v-flex>

                <v-flex xs12 md12>
                  <v-text-field type="password" label="Mot de passe" v-model="utilisateur.password" class="purple-input"/>
                </v-flex>

                <v-flex xs6 md6 lg6>
                  <v-btn
                      class="mx-0 font-weight-light"
                      color="success"
                      @click="$router.push({ name: 'user_list' })"
                    >Liste</v-btn>
                </v-flex>
                <v-flex v-show="$props.type == 'new'" xs6 md6 lg6 text-xs-right>
                  <v-btn
                    :loading="loading"
                    class="mx-0 font-weight-light"
                    color="success"
                    @click="addAdmin"
                  >Ajouter</v-btn>
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
        utilisateur: {
          email: '',
          password: '',
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
        this.getAdmin()

      }

    },
    methods: {
      getAdmin () {
          let vm = this;
          // console.log('gamme to update')
          this.axios.get('api/users/'+vm.$props.id).then((response) => {
            this.user = response.data
            console.log('user to update',response.data)
          });
      },
      initialisationAdmin (){
        this.utilisateur = {
          email: '',
          password: '',
        }
      },
      addAdmin (){
        let vm = this
        this.loading = true
        if(this.utilisateur.email != '' && this.utilisateur.password != ''){
          let utilisateur = new FormData();
          utilisateur.append("email", this.utilisateur.email);
          utilisateur.append("password", this.utilisateur.password);
          utilisateur.append("type", 'ADMIN');

          this.axios.post('/api/users', utilisateur,
          {
						headers: {
							'Content-Type': 'multipart/form-data'
						}

					}
          ).then(
            (response) => {
              console.log(response.data)
              this.alertMessage = 'Administration ajouté avec success'
              this.alert.showSuccess = true
              this.loading = false
              let utilisateur = {
                email: '',
                password: '',
              }
              //console.log('this gamme',vm.gamme)
              //console.log('gamme',gamme)
              vm.initialisationAdmin()

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

      }
    }
  }
</script>
