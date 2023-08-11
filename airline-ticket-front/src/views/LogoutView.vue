<template>

</template>
  
<style></style>
  
  
<script>
import axios from 'axios'
export default {

    created() {
        window.localStorage.removeItem('token');
        this.$router.push('/').catch(() => undefined);
    },

}
</script>