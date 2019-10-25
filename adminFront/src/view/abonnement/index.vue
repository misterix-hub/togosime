<template>
  <v-container>
    <v-alert type="success" dismissible v-model="alert.showSuccess" transition="scale-transition">
      {{alertMessage}}
    </v-alert>
    <v-alert type="error" dismissible v-model="alert.showError" transition="scale-transition">
      {{alertMessage}}
    </v-alert>
    <center>
      <v-flex>
        <v-text-field v-model="telephone" label="telephone"  class="purple-input"/>
      </v-flex>
    </center>
    <br>
    <center>
      <v-btn
        color="success"
        @click="rechercherClient()"
      >Rechercher</v-btn>
    </center>
  </v-container>
</template>

<script>
export default {
  data (){
    return {
      telephone: '',
      alertMessage: '',
      alert: {
        showSuccess: false,
        showError: false,
        showWarnning: false,
        showInfo: false
      },
    }
  },
  methods: {
    rechercherClient () {
        let vm = this;
        this.axios.get('api/clients-telephone='+vm.telephone).then((response) => {
          if(response.data.id){
            console.log('client BY PHONE',response.data)
            this.$router.push({ name: 'client_edit', params: {id: response.data.id} })
            //this.client = response.data
          }
          else{
            this.alertMessage = "Aucun utilisateur ne pessede ce numero de telephone"
            this.alert.showError = true
          }

        });

    },

  },
}
</script>
