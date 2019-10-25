<template>
  <div>
	  blakldjfv
  </div>
</template>



<script>

export default{
  data() {
    return {
	  messages: {

	  }
    }
  },
  mounted() {
    // console.log("debut")
    // this.$echo.private('action-channel-one').listen('TrialEvent', (payload) => {
    //         console.log("ok: "+payload)
    // });
    window.Echo.channel('action-channel-one')
    .listen('TrialEvent', (e) => {
        console.log(e);
    });

    window.Echo.channel('channel-name')
    .listen('TestEvent', (e) => {
        console.log(e);
    });


    axios.get('/updates').then(res => (this.updates = res.data)) 
      Echo.private('updates')
          .listen('UpdateCreated', data => this.updates.unshift(data.update))

    // window.Echo.leave('channel-name');
  },
}

</script>