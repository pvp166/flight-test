<script setup>
import { RouterLink, RouterView } from 'vue-router'

</script>

<template>
  <div>

  </div>
  <nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Flight With Me</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">

            <RouterLink class="nav-link active" aria-current="page" to="/">Home</RouterLink>
          </li>
          <li class="nav-item">

            <RouterLink class="nav-link active" aria-current="page" to="/login" v-if="login">Login</RouterLink>
            <RouterLink class="nav-link active" aria-current="page" to="/logout" v-else>Logout</RouterLink>
          </li>

          <li class="nav-item">

            <RouterLink class="nav-link active" aria-current="page" to="/register">Register</RouterLink>
          </li>
          <li class="nav-item">

            <RouterLink class="nav-link active" aria-current="page" to="/list">List</RouterLink>
          </li>

        </ul>
      </div>
    </div>
  </nav>
  <!-- <header>
   

    <div class="wrapper">
      

      <nav>
        <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/about">About</RouterLink>
      </nav>
    </div>
  </header> -->

  <RouterView />
</template>

<style scoped></style>
<script>
import { mapState, mapActions } from 'vuex';
export default {
  computed: {
    ...mapState(['login'])
  },
  methods: {
    ...mapActions(['toggleLogin']),
    
  },
  mounted() {
    
    // console.log(Boolean( window.localStorage.getItem('token')))
    console.log(this.login);
  }
}
</script>
