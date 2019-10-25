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
        <material-card color="green" title="Repondre au message" text="Repondre au message">
          <v-form>
            <v-container py-0>
              <v-layout wrap>
                <v-flex xs12 md6>
                  <v-text-field disabled label="Email" v-model="message.email" class="purple-input"/>
                </v-flex>

                <v-flex xs12 md6>
                  <v-text-field disabled label="Contact" v-model="message.contact" class="purple-input"/>
                </v-flex>

                <v-flex xs12 md6>
                  <v-textarea
                    label="Message" disabled
                    v-model="message.message"
                    class="purple-input"
                  />
                </v-flex>

                <v-flex xs12 md6>
                  <v-textarea
                    label="Reponse"
                    v-model="message.reponse"
                    class="purple-input"
                  />
                </v-flex>

                <v-flex  xs12 text-xs-right>
                  <v-btn
                    :loading="loading"
                    class="mx-0 font-weight-light"
                    color="success"
                    @click="sendMessage"
                  >Repondre</v-btn>
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
    data (){
      return {
        message: {
          email: '',
          contact: '',
          message: '',
          sujet: '',
          reponse: '',

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

        this.getMessage()



    },
    methods: {
      getMessage () {
          let vm = this;
          this.axios.get('api/messages/'+vm.$route.params.id).then((response) => {
            this.message = response.data
            console.log('message to update',response.data)
          });
      },

      initialisationClient (){
        this.message = {
          email: '',
          contact: '',
          message: '',
          sujet: '',
        }
      },

      sendMessage (){
        this.loading = true
        if(this.message.reponse != ''){
          let message = {
            email: this.message.email,
            sujet: this.message.sujet,
            contact: this.message.contact,
            message: this.message.message,
            reponse: this.message.reponse,
          }
          this.axios.put('/api/messages/'+this.$route.params.id+'/answer', message).then((response) => {
            console.log(response.data)
            this.alertMessage = 'Reponse envoyé avec success'
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
