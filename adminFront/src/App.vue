<template>
  <div>
    <template v-if="!$route.meta.allowAnonymous">
      <v-app id="inspire">
        <div class="app-container">
          <toolbar @toggleNavigationBar="drawer = !drawer"/>
          <navigation :toggle="drawer"/>
          <v-content>
            <breadcrumbs />
            <router-view/>
            <page-footer />
          </v-content>
        </div>
      </v-app>
    </template>
    <template v-else>
      <transition>
        <keep-alive>
          <router-view></router-view>
        </keep-alive>
      </transition>
    </template>
  </div>
</template>

<script>
export default {
  name: 'App',
  data() {
    return {
      drawer: true
    }
  },
  created () {
    window.getApp = this;
  },
  mounted() {
    // this.$root.themeColor = '#c8234d'
    // console.log('All Variable: ', this.$store.state);
  },
  methods: {
    handleDownload (tHeader, filterVal, list) {
      window.getAppRecipient.downloadLoading = true;
      import('./Export2Excel').then(excel => {
        
        const data = this.formatJson(filterVal, list);
        excel.export_json_to_excel({
          header: tHeader,
          data,
          filename: 'statistique',
          autoWidth: true,
          bookType: 'xlsx'
        });
        window.getAppRecipient.downloadLoading = false;
      });
    },
    formatJson (filterVal, jsonData) {
      return jsonData.map(v => filterVal.map(j => {
        if (j === 'timestamp') {
          return parseTime(v[j]);
        } else {
          return v[j];
        }
      }));
    },
    toggleNavigationBar () {
      this.drawer = !this.drawer;
    },
    storeInitialisation () {

      console.log('localStorage: ', localStorage);

      localStorage.setItem('statEaccess_token', this.$store.state.access_token);
      localStorage.setItem('statEexpires_in', this.$store.state.expires_in);
      localStorage.setItem('statEtoken_type', this.$store.state.token_type);
      localStorage.setItem('statEcurentUser', JSON.stringify(this.$store.state.curentUser));
      localStorage.setItem('statEuserIsConnect', this.$store.state.userIsConnect);
      localStorage.setItem('statEpath', this.$store.state.path);

      /* 
      localStorage.setItem('statEaccess_token', JSON.stringify(this.$store.state.access_token));
      localStorage.setItem('statEexpires_in', JSON.stringify(this.$store.state.expires_in));
      localStorage.setItem('statEtoken_type', JSON.stringify(this.$store.state.token_type));
      localStorage.setItem('statEcurentUser', JSON.stringify(this.$store.state.curentUser));
      localStorage.setItem('statEuserIsConnect', JSON.stringify(this.$store.state.userIsConnect));
      localStorage.setItem('statEpath', JSON.stringify(this.$store.state.path));
      */

    }
  }
}
</script>

<style>
</style>