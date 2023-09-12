<template>
    <main class="main">
        <div class="login_register">
            <div class="base_info">
                <div class="icon">
                    <img src="@/assets/images/icon.png" alt="">
                </div>
                <div class="description">
                    <label class="title">A fortuna fica ao lado daquele que ousa.</label>
                    <p class="subtitle">Todo progresso ocorre fora da zona de conforto.</p>
                </div>
                <div class="objects">
                    <img src="@/assets/images/objects.png" alt="">
                </div>
            </div>
            <div class="base_form">
                <div class="title">
                    <label for="">Login</label>
                </div>
                <div class="form_login">
                    <div class="input_group">
                        <label class="group_label">Endereço de e-mail</label>
                        <input class="group_input" v-model="email" type="email" name="email" placeholder="email@main.com.br">
                    </div>
                    <div class="input_group">
                        <label class="group_label">Senha de acesso</label>
                        <input class="group_input" v-model="password" type="password" name="password" placeholder="********">
                    </div>
                    <div class="submit_forget">
                        <router-link class="link" to="/register">Não tenho conta</router-link>
                        <button @click="auth" class="btn-submit btn-dark">
                            Acessar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<script>

export default {
  data() {
    return {
        email: '',
        password: ''
    };
  },
  methods: {
    clean(){
      this.email = '';
      this.password = '';
    },
    showAlert(type, msg) {
      this.$swal({
        text: msg,
        icon: type,
        confirmButtonText: 'Confirmar'
      });
    },
    auth() {
        var data = {
            email: this.email,
            password: this.password
        };

        this.$http.post("login", data)
        .then(response => {

            this.showAlert(response.data.status, response.data.msg);

            if (response.data.status === 'success') {
                if (response.data.authenticated === true) {
                    localStorage.setItem('userLogin', response.data.user);
                    // this.clean(); 
                    this.$router.push('dashboard'); 
                } else {
                    this.$router.push('/');
                }
            }

        })
        .catch(error => {
            console.error(error);
        });
    }
      
  }
};
</script>