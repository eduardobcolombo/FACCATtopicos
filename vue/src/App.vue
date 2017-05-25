<template>
  <div id="app">

    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <app-landing></app-landing>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
  import Landing from './components/landing.vue';

  export default {
  data () {
    return {}
  },
  components: {
    'app-landing': Landing
  }

}
</script>

<style lang="scss">

</style>
