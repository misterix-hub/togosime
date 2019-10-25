<template>
  <v-app id="login" :style="{'background-color':$root.themeColor}">
    <v-content>
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md4 lg4>
            <v-card class="elevation-1 pa-3">
              <v-card-text>
                <div class="layout column align-center">
                  <img src="../../assets/logo.png" alt="Partenaire" width="300" height="180">
                  <h1 class="flex my-4" :style="{'color':$root.themeColor}">Admin</h1>
                </div>
                <v-form>
                  <v-text-field
                    :color="$root.themeColor"
                    append-icon="person"
                    name="login"
                    label="Utilisateur"
                    type="text"
                    v-model="userEmail"
                    :rules="[rules.required]"
                    @keyup.enter="login"/>
                  <v-text-field
                    append-icon="lock"

                    :color="$root.themeColor"
                    :type="hidePassword ? 'password' : 'text'"
                    name="password" label="Mot de passe"
                    id="password"
                    :rules="[rules.required]"
                    v-model="password"
                    @click:append="hidePassword = !hidePassword"
                    @keyup.enter="login"/>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn block :color="$root.btn.defaultColor" style="color: white" @click="login(), loading = true" :loading="loading">Connecter</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
      <v-snackbar
        v-model="showResult"
        :timeout="10000"
        bottom
        right
        :color="color"
        >
        {{ result }}
      </v-snackbar>
    </v-content>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      loading: false,
      userEmail: '',
      password: '',
      hidePassword: true,
      error: false,
      color: '',
      showResult: false,
      result: '',
      rules: {
        required: value => !!value || 'Champs obligatoires.'
      }
    }
  },
  mounted() {
    // this.$root.themeColor = '#c8234d'
    // console.log('All Variable: ', this.$store.state);
    this.LogOut();
  },
  methods: {
    LogOut () {
      this.$store.state.access_token = '';
      this.$store.state.expires_in = '';
      this.$store.state.token_type = '';
      this.$store.state.curentUser = {};
      this.$store.state.userIsConnect = false;
      // console.log('this.$store.state: ', this.$store.state);
    },

    getMe () {
      const vm = this;
      let currentUser = {}


      var headers = {
        'Authorization': 'Bearer ' + vm.$store.state.access_token
      };

      // console.log('headers: ', headers);

      vm.axios.post('api/auth/me', {}, {headers: headers}).then((response) => {
        console.log('currentuser:', response.data);

        currentUser = response.data;
        // partenaire = currentUser.partenaire;
        vm.$store.state.curentUser = currentUser

        vm.$store.state.userIsConnect = true;

        if(vm.$store.state.userIsConnect == true){
          vm.$router.push({ name: 'home' });

        }


      })
      .catch((error) => {
        console.log('log: ', error);
      });
    },

    login() {
      console.log('start login')
      const vm = this;

      if (!vm.userEmail || !vm.password) {

        vm.result = "L'utilisateur et mot de passe ne peuvent pas être null.";
        vm.showResult = true;
        vm.color = 'red';

        return;
      }

      var headers = {
        'Content-Type': 'application/json',
        'Authorization': vm.$store.state.token_type + ' ' + vm.$store.state.access_token
      };

      var data = {
        email: vm.userEmail,
        password: vm.password
      };

      // console.log(data)

      vm.axios.post('api/login', data )
      .then((response) => {

        console.log('response.data: ', response.data);

        if (response.data !== 0 && response.data.user.type == 'ADMIN') {
          vm.$store.state.access_token = response.data.access_token;
          vm.$store.state.expires_in = response.data.expires_in;
          vm.$store.state.token_type = response.data.token_type;
          vm.loading = false;
          vm.$store.state.curentUser = response.data.user
          // console.log('response.data.user: ', response.data.user);


          vm.$store.state.userIsConnect = true;
          vm.axios.defaults.headers.common = {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + vm.$store.state.access_token
          };

          if(vm.$store.state.userIsConnect == true){
            vm.$router.push({ name: 'dashboard' });

          }


        } else {
          vm.error = true;
          vm.result = "Votre Compte est désactivé, veuillez contacter l'administrateur";
          vm.showResult = true;
          vm.color = 'red';
          vm.loading = false;
        }

      })
      .catch((error) => {

        console.log('log: ', error);

        vm.error = true;
        vm.result = "L'utilisateur ou mot de passe incorrect.";
        vm.showResult = true;
        vm.color = 'red';
        vm.loading = false;
      });

      /* if (vm.userEmail === vm.$root.userEmail && vm.password === vm.$root.userPassword) {
        vm.$router.push({ name: 'dashboard' });
      }
      else {
        vm.error = true;
        vm.result = "L'utilisateur ou mot de passe incorrect.";
        vm.showResult = true;
        vm.color = 'red';
      } */

    }
  }
}

// this.$root.themeColor
</script>

<style scoped lang="css">
  #login {
    height: 50%;
    width: 100%;
    position: absolute;
    top: 0;
    left: 0;
    content: "";
    z-index: 0;
  }
</style>
