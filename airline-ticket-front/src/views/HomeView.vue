<script>
import axios from 'axios'
export default {
  data() {
    return {
      error: null,
      loginState: true,
      form: {
        userName: '',
        password: '',
        confirmPassword: ''
      },
      url: 'http://localhost:8000'
    }
  },
  methods: {

    signup: function (event) {
      event.preventDefault();
      console.log("This is something");
      if (this.loginState) {
        this.loginState = !this.loginState;
      }
      else {
        console.log("Go here");
        if (this.password === this.confirmPassword) {
          let formData = new FormData();
          formData.append('userName', this.form.userName);
          formData.append('password', this.form.password)

          const headers = {
            'Content-Type': 'multipart/form-data',
          }

          axios.post('http://localhost:8000/auth/create', formData, { headers })
            .then(response => {
              console.log('Response:', response.data);
            })
            .catch(error => {
              console.error('Error:', error);
            });
        }
        else {
          console.log("deo");
        }
      }

    },
    login: function (event) {
      event.preventDefault();
      if (!this.loginState) {
        this.loginState = !this.loginState;
      }
      else {
        let formData = new FormData();
        formData.append('userName', this.form.userName);
        formData.append('password', this.form.password);
        // const config = {
        const headers = {
          'Content-Type': 'multipart/form-data',
        }

        axios.post('http://localhost:8000/auth/login', formData, { headers })
          .then(response => {
            console.log('Response:', response.data);
          })
          .catch(error => {
            console.error('Error:', error);
          });
      }
    }
  }
}
</script>

<template>
  <div>
    <h3 v-if="loginState">
      Đăng nhập
    </h3>
    <h3 v-else>
      Đăng kí
    </h3>
    <div>{{ error }}</div>
    <div>
      <label> Username</label>
      <input v-model="form.userName" />
    </div>
    <div>
      <label> Password</label>
      <input v-model="form.password" />
    </div>

    <div v-if="!loginState">
      <label>Confirm Password</label>
      <input v-model="form.confirmPassword" />
    </div>


    <button @click="(event) => login(event)">Login</button>
    <button @click="(event) => signup(event)">Register</button>
  </div>
</template>
