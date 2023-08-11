<template>
    <div>
        <div>
            
            <h3>
                Đăng kí
            </h3>
            <div v-if="Object.keys(errors).length > 0">
                <p class="text-danger">{{ errors.userName }}</p>
                <p class="text-danger">{{ errors.password }}</p>
                <p class="text-danger">{{ errors.confirmPassword }}</p>
            </div>
            <div>
                <label> Username</label>
                <input v-model="form.userName" />
            </div>
            <div>
                <label> Password</label>
                <input v-model="form.password" type="password" />
            </div>



            <button @click="(event) => login(event)">Login</button>
            <button @click="(event) => signup(event)">Register</button>
        </div>


    </div>
</template>
  
<style></style>
  
  
<script>
import axios from 'axios'
export default {
    data() {
        return {
            errors: {},
            form: {
                userName: '',
                password: '',
                confirmPassword: ''
            },
            url: 'http://localhost:8000',
            table: {},
            loading: false,

        }
    },
    created() {



    },
    methods: {
        signup: function (event) {
            event.preventDefault();
            this.$router.push('/register').catch(() => undefined)

        },
        login: function (event) {
            event.preventDefault();
           

                const errorList = [];
                if (this.form.userName.length == 0) {
                    errorList.userName = "Mời bạn điền tên người dùng";
                }
                if (this.form.password.length == 0) {
                    errorList.password = "Mời bạn điền tên mật khẩu";
                }
                this.errors = errorList;
                if (Object.keys(errorList).length == 0) {
                    let formData = new FormData();
                    formData.append('userName', this.form.userName);
                    formData.append('password', this.form.password);
                    const headers = {
                        'Content-Type': 'multipart/form-data',
                    }
                    axios.post('http://localhost:8000/auth/login', formData, { headers })
                        .then(response => {

                            window.localStorage.setItem('token', response.data.token)
                            this.$router.push('/').catch(() => undefined)
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }

            
        },
    }
}
</script>