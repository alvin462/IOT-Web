
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
  <!-- <meta http-equiv="content-type" content="upgrade-insecure-requests"> -->
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <script src="src/jquery/jquery-3.4.1.js"></script>
  <script src="src/vue/vue.js"></script>
  <script src="src/vue/vuex.js"></script>
  <script src="src/vuetify/vuetify.js"></script>
  <script src="src/router/vue-router.js"></script>
  <script src="https://unpkg.com/http-vue-loader"></script>
  <script src="src/response/vue-resource@1.5.1"></script>
  <link rel="stylesheet" href="src/vuetify/vuetify@2.x/vuetify.min.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css">
  

  

</head>

<body>
  <div id="app">
    <v-app>
      <v-navigation-drawer  v-model="drawer" app
      
      >
        <v-list dense>

          <v-list-item to="/home" link>
            <v-list-item-action>
              <v-icon>mdi-home</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title >教室環境</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
         
          <v-list-item v-if="$store.state.loginState" to="/replay" link>
            <v-list-item-action>
              <v-icon>mdi-television</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>影像回放</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
         
          <v-list-item v-if="$store.state.loginState" to="/mrtg" link>
            <v-list-item-action>
            <img src="../lun_2020/src/img/modify.png" alt="">
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>流量統計圖</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <!-- <v-list-group   >
          <template v-slot:activator>
          <v-list-item-action>
              <img src="../lun_2020/src/img/modify.png" alt="">
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>MRTG</v-list-item-title>
            </v-list-item-content>
          </template>

          <v-list-item
            v-for="([title, icon], i) in cruds"
            :key="i"
            link
            @click.stop="mrtg(title)"
          >
            <v-list-item-title v-text="title"></v-list-item-title>

          
          </v-list-item>
        </v-list-group> -->

        <!-- <v-list-item v-if="$store.state.loginState" to="/modify" link>
            <v-list-item-action>
             
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>測試布局</v-list-item-title>
            </v-list-item-content>
          </v-list-item> -->
          
          <v-list-item @click.stop='loginout' to="/login" link>
            <v-list-item-action>
              <v-icon>mdi-account</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>{{ $store.state.loginState ? '登出' : '登入'}}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        
        </v-list>
        
        
      </v-navigation-drawer>
      <v-app-bar app  dark>
        <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
        <v-toolbar-title>DIC 環境監控系統</v-toolbar-title>
      </v-app-bar>
      <!-- 導入文件router-view--->
      <v-main>
      <router-view></router-view>

      </v-main>
      <v-footer app dark>
        <span class="white--text">&copy; DIC-{{ new Date().getFullYear() }}</span>
      </v-footer>
  </div>

</body>
<style>
   #app {
    font-family: 'Noto Sans TC';
  }
</style>
<script>

const routes = [
    {
      path: '/home',
      name: 'home',
      component: httpVueLoader('./view/Home.vue'),
      meta:{title:'教室環境'}
    },  
    {
      path: '/login',
      name: 'login',
      component: httpVueLoader('./view/Login.vue'),
      meta:{
        requiresAuth:false,
        title:'管理員登入'
      },
    },
    {
      path:'/replay',
      name:'replay',
      component:httpVueLoader('./view/Replay.vue'),
      meta:{
        requiresAuth:true,
        title:'影像回放'
      }
    },  
    {
      path:'/mrtg',
      name:'mrtg',
      component:httpVueLoader('./view/Mrtg.vue'),
      meta:{
        requiresAuth:true,
        title:'MRTG'
      }
    },
    {
      path:'/test',
      name:'test',
      component:httpVueLoader('./view/Test.vue'),
      meta:{
        requiresAuth:true,
        title:'測試布局'
      }
    },
    {
  path: '/*',
  redirect: '/login',
}
  ]

  const router = new VueRouter({routes});
  router.beforeEach((to,from,next)=>{
      document.title = to.meta.title
      if(to.meta.requiresAuth){
        store.commit('getLoginState',function(isLogin){
          if ( !isLogin ) {
            next({
              path: '/login',
                query:{redirect:to.fullPath}
            });
          } else {
            next();
          }
        });
      } else {
        //console.log('Router Befor Event Handler(no auth)');
        next();
      }
    });
    const store = new Vuex.Store({
      state: {
        loginState: false,
      },
      mutations:{
        getLoginState(state,func){
           $.post('./auth.php','mode=getAll',function(d){
           let data = JSON.parse(d);
            state.loginState = data.loginState;
          
             if (func)
               state.loginState ? func(true) : func(false);
           });

        }
      }
    });
new Vue({
    el: '#app',
    data: {
      drawer: null,
      loginstate:null,
      cruds: [
        ['i2511', 'mdi-plus-outline'],
        ['i2512', 'mdi-file-outline'],
      ],
    },
    methods:{
     
      loginout(){
        let url = 'https://lundic2020.tk/php/webcam_firewall.php';
                let i2511 = 'i2511=stop';
                $.post(url, i2511, function(d) {
                });
              if ( this.$store.state.loginState ) {
            $.post('./auth.php','mode=logout',function(d){});
            this.$store.state.loginState = false;
          }
          if ( this.$router.currentRoute.path != '/login' ) {
            this.$router.push('login');
          }
      }
    },
      mounted: function(){
        store.commit('getLoginState');
      },
    vuetify: new Vuetify(),
    router,
    store
  })

</script>

</html>
