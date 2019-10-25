<template>
  <v-navigation-drawer
    v-model="toggle"
    fixed app>
    <v-toolbar flat dark :color="$root.themeColor" class="toolbar">
      <router-link :to="{ name: 'dashboard' }">
         <img src="../../assets/logo.jpg" width="50px"></img>
      </router-link>
      <router-link :to="{ name: 'dashboard' }" class="text">
        {{ $root.app.name }}
      </router-link>
    </v-toolbar>
    <v-list >
      <!--
      <v-list-tile  @click="changeRoute('home', 1)" >
        <v-list-tile-action>
          <v-icon>home</v-icon>
        </v-list-tile-action>
        <v-list-tile-title :class="[{'active': selectedIndex === 1}, 'item-title' ]" >Accueil</v-list-tile-title>
      </v-list-tile>
      -->
       <v-list-tile  @click="changeRoute('dashboard', 1)">
        <v-list-tile-action>
          <v-icon>dashboard</v-icon>
        </v-list-tile-action>
        <v-list-tile-title :class="[{'active': selectedIndex === 1}, 'item-title' ]" >Tableau de bord</v-list-tile-title>
      </v-list-tile>
      <v-list-tile  @click="changeRoute('setting', 2)">
        <v-list-tile-action>
          <v-icon>settings_applications</v-icon>
        </v-list-tile-action>
        <v-list-tile-title :class="[{'active': selectedIndex === 2}, 'item-title' ]" >Parametre</v-list-tile-title>
      </v-list-tile>

      <v-list-group
        prepend-icon="book">
        <v-list-tile slot="activator">
          <v-list-tile-title class="item-title">Page</v-list-tile-title>
        </v-list-tile>
        <v-list-tile  @click="changeRoute('page_list', 3)">
          <v-list-tile-title class="padding" :class="[{'active': selectedIndex === 3}, 'item-title' ]" >Liste</v-list-tile-title>
        </v-list-tile>

        <v-list-tile @click="changeRoute('page_add', 4)">
          <v-list-tile-title class="padding" :class="[{'active': selectedIndex === 4}, 'item-title' ]" >Ajouter </v-list-tile-title>
        </v-list-tile>

      </v-list-group>

      <v-list-group
        prepend-icon="videocam">
        <v-list-tile slot="activator">
          <v-list-tile-title class="item-title">Video</v-list-tile-title>
        </v-list-tile>
        <v-list-tile  @click="changeRoute('video_list', 5)">
          <v-list-tile-title class="padding" :class="[{'active': selectedIndex === 5}, 'item-title' ]" >Liste</v-list-tile-title>
        </v-list-tile>
        <v-list-tile @click="changeRoute('video_add', 6)">
          <v-list-tile-title class="padding" :class="[{'active': selectedIndex === 6}, 'item-title' ]" >Ajouter </v-list-tile-title>
        </v-list-tile>
      </v-list-group>

      <v-list-group
        prepend-icon="image">
        <v-list-tile slot="activator">
          <v-list-tile-title class="item-title">Image</v-list-tile-title>
        </v-list-tile>
        <v-list-tile  @click="changeRoute('image_category_list', 7)">
          <v-list-tile-title class="padding" :class="[{'active': selectedIndex === 7}, 'item-title' ]" >Liste categorie</v-list-tile-title>
        </v-list-tile>
        <v-list-tile @click="changeRoute('image_category_add', 8)">
          <v-list-tile-title class="padding" :class="[{'active': selectedIndex === 8}, 'item-title' ]" >Ajouter categorie</v-list-tile-title>
        </v-list-tile>
        <v-list-tile  @click="changeRoute('image_list', 9)">
          <v-list-tile-title class="padding" :class="[{'active': selectedIndex === 9}, 'item-title' ]" >Liste image</v-list-tile-title>
        </v-list-tile>
        <v-list-tile @click="changeRoute('image_add', 10)">
          <v-list-tile-title class="padding" :class="[{'active': selectedIndex === 10}, 'item-title' ]" >Ajouter image</v-list-tile-title>
        </v-list-tile>
      </v-list-group>

      <v-list-group
        prepend-icon="record_voice_over">
        <v-list-tile slot="activator">
          <v-list-tile-title class="item-title">Annonce</v-list-tile-title>
        </v-list-tile>
        <v-list-tile  @click="changeRoute('annonce_list', 11)">
          <v-list-tile-title class="padding" :class="[{'active': selectedIndex === 11}, 'item-title' ]" >Liste</v-list-tile-title>
        </v-list-tile>
        <v-list-tile @click="changeRoute('annonce_add', 12)">
          <v-list-tile-title class="padding" :class="[{'active': selectedIndex === 12}, 'item-title' ]" >Ajouter </v-list-tile-title>
        </v-list-tile>
      </v-list-group>

      <v-list-tile  @click="changeRoute('message_list', 13)">
        <v-list-tile-action>
          <v-icon>inbox</v-icon>
        </v-list-tile-action>
        <v-list-tile-title :class="[{'active': selectedIndex === 13}, 'item-title' ]" >Message</v-list-tile-title>
      </v-list-tile>
      <v-list-group
        prepend-icon="shopping_cart">
        <v-list-tile slot="activator">
          <v-list-tile-title class="item-title">Produit</v-list-tile-title>
        </v-list-tile>
        <v-list-tile  @click="changeRoute('product_gamme_list', 14)">
          <v-list-tile-title class="padding" :class="[{'active': selectedIndex === 14}, 'item-title' ]" >Liste gamme</v-list-tile-title>
        </v-list-tile>
         <v-list-tile @click="changeRoute('product_gamme_add', 15)">
          <v-list-tile-title class="padding" :class="[{'active': selectedIndex === 15}, 'item-title' ]" >Ajouter gamme</v-list-tile-title>
        </v-list-tile>
         <v-list-tile  @click="changeRoute('product_category_list', 16)">
          <v-list-tile-title class="padding" :class="[{'active': selectedIndex === 16}, 'item-title' ]" >Liste categorie</v-list-tile-title>
        </v-list-tile>
        <v-list-tile @click="changeRoute('product_category_add', 17)">
          <v-list-tile-title class="padding" :class="[{'active': selectedIndex === 17}, 'item-title' ]" >Ajouter categorie</v-list-tile-title>
        </v-list-tile>
        <v-list-tile  @click="changeRoute('product_list', 18)">
          <v-list-tile-title class="padding" :class="[{'active': selectedIndex === 18}, 'item-title' ]" >Liste produit</v-list-tile-title>
        </v-list-tile>
        <v-list-tile @click="changeRoute('product_add', 19)">
          <v-list-tile-title class="padding" :class="[{'active': selectedIndex === 19}, 'item-title' ]" >Ajouter produit</v-list-tile-title>
        </v-list-tile>
      </v-list-group>
      <v-list-group
        prepend-icon="subject">
        <v-list-tile slot="activator">
          <v-list-tile-title class="item-title">Fournisseurs</v-list-tile-title>
        </v-list-tile>
        <v-list-tile  @click="changeRoute('provider_list', 20)">
          <v-list-tile-title class="padding" :class="[{'active': selectedIndex === 20}, 'item-title' ]" >Liste</v-list-tile-title>
        </v-list-tile>
        <v-list-tile @click="changeRoute('provider_add', 21)">
          <v-list-tile-title class="padding" :class="[{'active': selectedIndex === 21}, 'item-title' ]" >Ajouter</v-list-tile-title>
        </v-list-tile>
      </v-list-group>
      <v-list-group
        prepend-icon="add_shopping_cart">
        <v-list-tile slot="activator">
          <v-list-tile-title class="item-title">Commande</v-list-tile-title>
        </v-list-tile>
        <v-list-tile  @click="changeRoute('order_pending', 22)">
          <v-list-tile-title class="padding" :class="[{'active': selectedIndex === 22}, 'item-title' ]" >En attente</v-list-tile-title>
        </v-list-tile>
        <v-list-tile @click="changeRoute('order_validated', 23)">
          <v-list-tile-title class="padding" :class="[{'active': selectedIndex === 23}, 'item-title' ]" >Validée</v-list-tile-title>
        </v-list-tile>
      </v-list-group>
       <v-list-group
        prepend-icon="book">
        <v-list-tile slot="activator">
          <v-list-tile-title class="item-title">Administrateur</v-list-tile-title>
        </v-list-tile>
        <v-list-tile  @click="changeRoute('user_list', 24)">
          <v-list-tile-title class="padding" :class="[{'active': selectedIndex === 24}, 'item-title' ]" >Liste</v-list-tile-title>
        </v-list-tile>

        <v-list-tile @click="changeRoute('user_add', 25)">
          <v-list-tile-title class="padding" :class="[{'active': selectedIndex === 25}, 'item-title' ]" >Ajouter </v-list-tile-title>
        </v-list-tile>

      </v-list-group>

    </v-list>


  </v-navigation-drawer>
</template>

<script>
export default {
  props: {
    toggle: {
        type: Boolean,
        required: false,
        default: false
    }
  },

  data() {
    return {
      selectedIndex: 10,
      admins: [
        ['Management', 'people_outline'],
        ['Settings', 'settings']
      ]
    }
  },

  methods: {
    changeRoute(routeName, selectedIndex) {
      const vm = this;

      vm.selectedIndex = selectedIndex;

      return vm.$router.push({ name: routeName });
    },
    changeRouteParam(routeName, selectedIndex, params) {
      const vm = this;

      vm.selectedIndex = selectedIndex;

      return vm.$router.push({ name: routeName, params: params });
    },
    updateJob(){

    }
  },
  mounted() {
    console.log("val"+this.$store.state.path['USER'])


    // window.Echo.channel('job-channel')
    // .listen('JobEvent', (e) => {
    //     console.log(e);
    // });


    // axios.get('/updates').then(res => (this.updates = res.data))
    //   Echo.private('updates')
    //       .listen('UpdateCreated', data => this.updates.unshift(data.update))

  }
}
</script>

<style>
  .padding {
    padding-left: 55px;
  }

  .toolbar {
    font-weight: bold;
    font-size: 18px;
  }

  .toolbar .text {
    padding-left: 15px;
    color: white;
    text-decoration:none;
  }

  .item-title {
    font-size: 17px;
    font-weight: 500;
  }
  .item-sub-title {
    font-size: 15px;
    font-weight: 500;
  }

  .active {
    font-weight: bold;
  }
</style>
