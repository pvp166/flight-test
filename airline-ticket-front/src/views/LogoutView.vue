<template></template>
  
<style></style>
  
  
<script>

import { mapActions } from 'vuex';
export default {
    methods: {
        ...mapActions(['toggleLogin'])
    },
    created() {
        window.localStorage.removeItem('token');
        this.toggleLogin(true);
        this.$router.push('/').catch(() => undefined);
        
    },

}
</script>