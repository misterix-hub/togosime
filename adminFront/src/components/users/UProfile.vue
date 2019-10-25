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

      <v-flex xs12 md8>
        <material-card color="green" title="Edit Profile" text="Complete your profile">
          <v-form>
            <v-container py-0>
              <v-layout wrap>
                <v-flex xs12 md6>
                  <v-text-field label="Nom" v-model="user.last_name" class="purple-input"/>
                </v-flex>

                <v-flex xs12 md6>
                  <v-text-field label="Prenom" v-model="user.first_name" class="purple-input"/>
                </v-flex>



                <v-flex xs12 md6>
                  <v-text-field label="email" v-model="user.email" class="purple-input"/>
                </v-flex>

                <v-flex xs12>
                  <v-textarea
                    class="purple-input"
                    label="Ma description"
                    v-model="user.description"
                  />
                </v-flex>

                <v-flex xs12 text-xs-right>
                  <v-btn
                    class="mx-0 font-weight-light"
                    color="success"
                    @click="updateProfile"
                  >Update Profile</v-btn>
                </v-flex>
              </v-layout>
            </v-container>
          </v-form>
        </material-card>
      </v-flex>
      <v-flex xs12 md4>
        <material-card class="v-card-profile">
          <v-avatar slot="offset" class="mx-auto d-block" size="130">
            <img :src="photo">
          </v-avatar>
          <br>
          <center>
            <input
              @change="changePhoto()"
              type="file"
              id="file"
              ref="file"
              accept=".png, .jpg, .jpeg"
            >
          </center>
          <v-card-text class="text-xs-center">
            <br>
            <h4 class="card-title font-weight-light">{{ user.first_name }} {{ user.last_name }}</h4>
            <p class="card-description font-weight-light">{{ user.description }}</p>
          </v-card-text>
        </material-card>
      </v-flex>
    </v-layout>
    <br><br>
  </v-container>
</template>

<script>
export default {
  //
  data() {
    return {
      user: {
        first_name: "",
        last_name: "",
        email: "",
        username: "",
        adress: "",
        description: "",
        photo: ""
      },
      alert: {
        showSuccess: false,
        showError: false
      },
      alertMessage: ""
    };
  },
  mounted() {
    this.initialisation();
  },
  computed: {
    photo (){
      if(this.user.photo != null || this.user.photo != ''  ){
        return this.axios.defaults.baseURL+this.user.photo
      }else{
        return '../../assets/css/profile.jpg'
      }
    },
  },
  methods: {
    initialisation() {
      this.getUser();
    },
    getUser() {
      this.axios.get("api/users/" + this.$store.state.curentUser.id).then(
        response => {
          console.log("user got:", response.data);
          this.user = response.data;
        },
        error => {
          this.alert.showError = true;
          this.alertMessage = "Impossible d'acceder aux données";
        }
      );
    },
    updateProfile() {
      var headers = {
        "Content-Type": "application/json",
        Authorization:
          this.$store.state.token_type + " " + this.$store.state.access_token
      };

      // console.log('input: ', input);

      this.axios
        .put("api/users/" + this.$store.state.curentUser.id, this.user)
        .then(
          response => {
            console.log("user updated:", response.data);
            this.user = response.data;
            this.alert.showSuccess = true;
            this.alertMessage = "Modification effectué avec success";
          },
          error => {
            this.alert.showError = true;
            this.alertMessage = "Veuillez corriger les champs et réessayer";
          }
        );
    },
    changePhoto() {
      var headers = {
        "Content-Type": "application/json",
        Authorization:
          this.$store.state.token_type + " " + this.$store.state.access_token
      };

      // console.log('input: ', input);
      let form = new FormData();
      form.append("photo", this.$refs.file.files[0]);

       // Show form data content
      for (var p of form){
          console.log(p)
      }
      this.axios.post("api/users/" + this.$store.state.curentUser.id+"/updatePhoto", form,
      	{
						headers: {
							'Content-Type': 'multipart/form-data'
						}

					}
      ).then(
        response => {
          console.log("user photo updated:", response.data);
          this.user.photo = response.data
          this.$store.state.curentUser.photo = response.data
          this.alert.showSuccess = true;
          this.alertMessage = "Image modifiée avec success";
        },
        error => {
          this.alert.showError = true;
          this.alertMessage = "Veuillez corriger les champs et réessayer";
        }
      );
    }
  }
};
</script>
