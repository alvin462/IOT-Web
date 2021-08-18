<template>
  <v-container class="fill-height" fluid>
    <v-row align="center" justify="center">
      <v-col cols="12" sm="8" md="4">
        <v-card class="elevation-12">
          <v-toolbar color="primary" dark flat>
            <v-toolbar-title>管理員登入</v-toolbar-title>
            <v-spacer></v-spacer>
          </v-toolbar>
          <v-card-text>
            <v-form>
              <v-text-field label="User" v-model="username" prepend-icon="mdi-account"  :rules="rules" hide-details="auto" type="text" autofocus></v-text-field>
              <v-text-field id="password" label="Password" v-model="password" prepend-icon="mdi-lock" type="password"  :rules="rules" hide-details="auto" @keyup.enter="login"></v-text-field>
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-spacer id="msg"></v-spacer>
            <v-btn color="primary" @click.stop="login">Login</v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
// let url = 'https://lundic2020.tk//php/webcam_firewall.php';
// let i2511 = 'i2511=stop';
// $.post(url, i2511, function (d) {});
module.exports = {
  data: function () {
    return {
      username: null,
      password: null,
      rules: [(value) => !!value || "請輸入."],
    };
  },
  methods: {
    login() {
      let post = "username=" + encodeURIComponent(this.username) + "&password=" + encodeURIComponent(this.password);
      let vm = this;

      $.post("./auth.php", "mode=login&" + post, function (d) {
        let rd = JSON.parse(d);
        if (rd.loginState) {
          if (vm.$router.currentRoute.query.redirect) {
            vm.$router.push(vm.$router.currentRoute.query.redirect);
          } else {
            let url = "https://lundic2020.tk/php/webcam_firewall.php";
            let i2511 = "i2511=start";
            $.post(url, i2511, function (d) {});
            vm.$router.push("replay");
          }
        }
      });
    },
  },
  beforeCreate: function () {
    //Check loginState
    // console.log(this.$store.state.loginState)
    if (!this.$store.state.loginState) {
      console.log("This is Login.vue beforeCreate(no login)");
      //this.$store.state.sidebar.user.img = './img/emptyhead.png';
    } else {
      console.log("This is Login.vue beforeCreate(is login)");

      this.$router.push("home");
    }
  },
};
</script>
