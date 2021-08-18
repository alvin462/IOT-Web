<template>
  <v-container>
    <v-row justify="center">

      <h2>{{ai_temp}}℃</h2>
    </v-row>
    <v-row justify="center">
     
      <v-btn v-if="this.$store.state.loginState" color="primary" dark @click.stop="all_modify"> 一鍵修改</v-btn>
      <v-btn v-if="this.$store.state.loginState" color="black" dark @click="manual = true">說明</v-btn>
     <v-dialog v-model="manual" max-width="290">
        <v-card>
          <v-card-title class="headline"> 補充說明</v-card-title>

        <v-card-text>
            <p>1.手動開啟時自動偵測關閉，手動關閉時自動偵測開啟，晚上12點後強制將手動關閉。</p>
            <p>2.自動偵測早上6點開啟，晚上12點後關閉。</p>
            <p>3.室內24度且室外低於室內5度以上，將會開啟風扇。</p>
        </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn  color="green darken-1" text @click="manual = false"> 了解 </v-btn>
          </v-card-actions>
         <div class="text-center">
    <v-dialog v-model="load" hide-overlay persistent width="300">
      <v-card color="primary" dark>
        <v-card-text>
          一鍵修改中
          <v-progress-linear indeterminate color="white" class="mb-0"></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>
  </div>
        </v-card-actions>
      </v-card>
    </v-dialog>
      <v-dialog v-model="dialog" max-width="290">
        <v-card>
          <v-card-title class="headline"> 修改全教室數值</v-card-title>

          <v-card-text>
            <v-text-field v-model="all_temp" type="number" counter maxlength="4" label="體感溫度預設值" outlined :rules="[numberRule]"></v-text-field>
            <v-text-field v-model="all_co2" type="number" counter maxlength="6" label="Co2預設值" outlined :rules="[numberRule]"></v-text-field>
            <v-text-field v-model="all_voc" type="number" counter maxlength="6" label="Voc預設值" outlined :rules="[numberRule]"></v-text-field>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn color="green darken-1" text @click="dialog = false"> 取消 </v-btn>
            <v-btn :disabled="load" :loading="load" color="green darken-1" text @click.stop="post"> 確定 </v-btn>
          </v-card-actions>
          
         <div class="text-center">
    <v-dialog v-model="load" hide-overlay persistent width="300">
      <v-card color="primary" dark>
        <v-card-text>
          一鍵修改中
          <v-progress-linear indeterminate color="white" class="mb-0"></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>
  </div>
        </v-card-actions>
      </v-card>
    </v-dialog>
          <v-card-actions>
          <v-spacer></v-spacer>

         
    </v-row>
    <div v-if="this.page==1">
        <v-btn type="button" class="col-md-12" color="success" style="opacity:0.5; height: 205px; margin: 2px">i5507雷雕室 建構中</v-btn>
     
      </div>
<!----->
<div v-if="this.page==2">
  
    <div  class="col-md-11" style="opacity:0.5;">
      <v-btn  type="button" class="col-md-12" large style="margin: 2px"> 走廊 </v-btn>
    </div>

    <div class="row col-md-3" style="opacity:0.5; float: left; margin: 0px">
      <div class="col-md-9">
        <v-btn type="button" class="col-md-12" color="success" style="height: 230px; margin: 2px">i3501</v-btn>
        <v-btn type="button" class="col-md-12" color="success" style="height: 230px; margin: 2px">i3502</v-btn>
      </div>

      <div class="col-md-3" style="opacity:0.5;">
        <v-btn type="button" class="col-md-12" style=" height: 465px; margin: 2px">走廊</v-btn>
      </div>
    </div>

    <div class="row col-md-3" style="float: left; margin: 0px">
      <div class="col-md-5" style="opacity:0.5;">
        <v-btn type="button" class="col-md-12" color="success" style="height: 80px; margin: 2px 0px 2px 0px">i2506</v-btn>
        <v-btn type="button" class="col-md-12" color="success" style="height: 80px; margin: 2px 0px 2px 0px">i2507</v-btn>

        <v-btn type="button" class="col-md-12" color="success" style="height: 80px; margin: 2px 0px 2px 0px">i2508</v-btn>
        <v-btn type="button" class="col-md-12" color="success" style="height: 80px; margin: 2px 0px 2px 0px">i2509</v-btn>
        <v-btn type="button" class="col-md-12" color="success" style="height: 80px; margin: 2px 0px 2px 0px">i2510</v-btn>
      </div>


      <div class="col-md-7" >
        <v-btn type="button" class="col-md-12" color="success" style="opacity:0.5; height: 205px; margin: 2px">i2505</v-btn>
        <v-dialog v-model="i2511" width="500">
          <template v-slot:activator="{ on, attrs }">
            <v-btn type="button" class="col-md-12" :color="i2511_Color" style="height: 205px; margin: 2px" large v-bind="attrs" v-on="on">i2511
              <v-img v-if="i2511_fan=='風扇狀態:開'" max-height="30" max-width="30" src="src/img/fan.gif"></v-img>
              </btn>
          </template>
          <i2511></i2511>
        </v-dialog>
      </div>
    </div>

    <div class="row col-md-3" style="float: left; margin: 0px">
      <div class="col-md-7">
        <v-btn type="button" class="col-md-12" color="success" style="opacity:0.5; height: 205px; margin: 2px">i2504</v-btn>
        <v-dialog v-model="i2512" width="500">
          <template v-slot:activator="{ on, attrs }">
            <v-btn type="button" class="col-md-12" :color="i2512_Color" style=" height: 205px; margin: 2px" large v-bind="attrs" v-on="on"> i2512<v-img v-if="i2512_fan=='風扇狀態:開'" max-height="30" max-width="30"  src="src/img/fan.gif"></v-img> </v-btn>
          </template>
          <i2512></i2512>
        </v-dialog>
      </div>

      <div style="opacity:0.5;" class="col-md-5">
        <v-btn type="button" class="col-md-12" color="success" style="height: 100px; margin: 2px">i2503</v-btn>
        <v-btn type="button" class="col-md-12" color="success" style="height: 100px; margin: 2px">i2501</v-btn>
        <v-btn type="button" class="col-md-12" color="success" style="height: 100px; margin: 2px">i2515</v-btn>
        <v-btn type="button" class="col-md-12" color="success" style="height: 100px; margin: 2px">i2513</v-btn>
      </div>
    </div>

    <div class="row col-md-2" style=" opacity:0.5; float: left; margin: 0px">
      <div class="col-md-8">
        <v-btn type="button" class="col-md-12" color="success" style="height: 100px; margin: 2px 0px 2px 0px">i2502</v-btn>
        <v-btn type="button" class="col-md-12" color="success" style="height: 118px; margin: 45px 0px 45px 0px">樓梯</v-btn>
        <v-btn type="button" class="col-md-12" color="success" style="height: 100px; margin: 2px 0px 2px 0px">i2514</v-btn>
      </div>
      <div class="col-md-4" style="opacity:0.5;">
        <v-btn type="button" class="col-md-12" style="height: 415px; margin: 2px">走廊</v-btn>
      </div>
    </div>

    <div class="col-md-8" style="opacity:0.5; float: left">
      <v-btn type="button" class="col-md-12" large style="float: right; margin: 2px 0px 2px 0px">走廊</v-btn>

      <v-btn type="button" class="col-md-1" large color="primary" style="float: right; margin: 2px">廁所</v-btn>

      <v-btn type="button" class="col-md-1" dark large style="float: right; margin: 2px">電梯</v-btn>
    </div>
</div>

 <div class="text-center">
    <v-pagination
      v-model="page"
      :length="2"
    >
    </v-pagination>
  </div>
  </v-container>
  

</template>

<script>
let webcam = [
  {
    class: "i2511",
  //  url: "https://lundic2020.tk:8081",
    url: "https://lundic2020.tk/php/i2511.php",
    url_lan_pi: "http://192.168.25.99",
    color: "success",
  },
  {
    class: "i2512",
    url: "https://lundic2020.tk/php/i2512.php",
    url_lan_pi: "http://120.114.140.251",
    color: "error",
  },
];

for (let i = 0; i < webcam.length; i++) {
 
  Vue.component(webcam[i].class, {
    data() {
      return {
        load: false,
        dialog: false,
        text: [],
        modify: [],
        webcam: webcam[i].url,
        // raspi_lan: webcam[i].url_lan_pi,
        title: webcam[i].class,
        fan: null,
        timer: null,
        ai_temp:null,
        temp:null,
        temp_font:null,
       numberRule: (v) => {
        if (!isNaN(parseFloat(v))) return true;
        return "請輸入數字";
      },
      };
    },
    created: function get() {      
  this.timer = setInterval(() => {
        this.$http.get("https://lundic2020.tk/php/" + webcam[i].class + "_btn.txt?" + new Date().getTime()).then(
          (response) => {
            this.fan = response.body;
          },
          (response) => {
            console.log("取得失敗");
          }
        );
      }, 1000);
      this.$http.get("https://lundic2020.tk/php/" + webcam[i].class + "_modify.txt?" + new Date().getTime()).then(
        (response) => {
          this.modify = response.body.split(" ");
        },
        (response) => {
          console.log("取得失敗");
        }
      );

      this.$http.get("https://lundic2020.tk/php/" + webcam[i].class + "_session.txt?" + new Date().getTime()).then(
        (response) => {
          this.text = response.body.split(" ");
        },
        (response) => {
          console.log("取得失敗");
        }
      );
      this.$http.get("https://lundic2020.tk/php/ai_temp.txt?" + new Date().getTime()).then(
        (response) => {
          this.ai_temp = response.body;
          this.temp = Math.abs(this.text[1].split(':')[1].split('℃')[0]-this.ai_temp.split(':')[1])
          this.temp=parseInt(this.temp)
        },
        (response) => {
          console.log("取得失敗");
        }
      );
    },
    //以生命週期控制定時撈取
    beforeDestroy() {
      clearInterval(this.timer);
    },
    template: `<v-card   min-width='510'>
          <v-card-title class="headline lime lighten-3">
           <p >室內外溫差:{{temp}}℃</br>
           偵測{{text[4]}} {{text[5]}}</p>
          </v-card-title>
           <v-row justify="center">
          <v-btn color="primary" dark @click.stop="open" v-if="this.$store.state.loginState">數值修改</v-btn>
          </v-row>
    <v-dialog v-model="dialog" persistent max-width="290">
      <v-card>
        <v-card-title class="headline">修改判斷值</v-card-title>
        <v-card-text>
            <v-text-field v-model="modify[0]" type="number" counter maxlength="4" label="體感溫度" outlined :rules="[numberRule]"></v-text-field>
            <v-text-field v-model="modify[1]" type="number" counter maxlength="6" label="Co2" outlined :rules="[numberRule]"></v-text-field>
            <v-text-field v-model="modify[2]" type="number" counter maxlength="6" label="Voc" outlined :rules="[numberRule]"></v-text-field>
          <h3>目前判定基準值</h3></br>
           <p class="font-weight-black">體感溫度:{{modify[0]}}℃</p>
           <p class="font-weight-black">CO2:{{modify[1]}}ppm</p>
           <p class="font-weight-black">VOC:{{modify[2]}}ppb</p>
           
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn color="green darken-1" text @click="modify_close" > 關閉</v-btn>
          <v-btn :disabled="load" :loading="load" color="green darken-1" text @click.stop="modify_sure()">確定</v-btn>
          <div class="text-center">
    <v-dialog v-model="load" hide-overlay persistent width="300">
      <v-card color="primary" dark>
        <v-card-text>
          請稍後...
          <v-progress-linear indeterminate color="white" class="mb-0"></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>
  </div>
        </v-card-actions>
      </v-card>
    </v-dialog>
           <v-row>
          </v-row>
          <v-divider></v-divider>
          <v-card-actions>
             <img v-if="this.$store.state.loginState" id="i2511" ondragstart="return false;" oncontextmenu="return false;" style="width: 349px; height:290px"  v-bind:src = "webcam" alt="鏡頭關閉">

          <v-card-text>
           <p :class="temp_font" class="font-weight-black">{{text[0]}}</p></br>
           <p class="font-weight-black">{{text[1]}}</p></br>
           <p class="font-weight-black">{{text[2]}}</p></br>
           <p class="font-weight-black">{{text[3]}}</p></br>
           <p class="font-weight-black">{{fan}}</p>
        <v-row>
             <v-btn   v-if="this.$store.state.loginState"  color="success" @click.stop="on">on</v-btn>
             <v-btn   v-if="this.$store.state.loginState"  type="button" color="error" @click.stop="off">off</v-btn>
        </v-row>
          </v-card-text>
          </v-card-actions>
        </v-card>
`,watch: {
      load(val){
        if (!val) return;
        setTimeout(() => {
          this.load = false
        }, 1000);
      }
    },
    methods: {

      open() {
        this.dialog = true;
        this.$http.get("https://lundic2020.tk/php/" + webcam[i].class + "_modify.txt?" + new Date().getTime()).then(
          (response) => {
            this.modify = response.body.split(" ");
          },
          (response) => {
            console.log("取得失敗");
          }
        );
      },
      modify_sure() {
        if ( this.modify[0] && this.modify[1] && this.modify[2]) {
           this.load = true;
        let temp = "&temp=" + this.modify[0];
        let co2 = "&co2=" + this.modify[1];
        let voc = "&voc=" + this.modify[2];
        let mode = "mode=" + webcam[i].class + "_modify";
        let url = "../php/contorl_fan.php";
        $.post(url, mode + temp + co2 + voc, function (e) {
        });
        }
       
      
      },
      modify_close() {
        this.dialog = false;
        this.$http.get("https://lundic2020.tk/php/" + webcam[i].class + "_modify.txt?" + new Date().getTime()).then(
          (response) => {
            this.modify = response.body.split(" ");
          },
          (response) => {
            console.log("取得失敗");
          }
        );
      },
      on() {
        let mode = "mode=" + webcam[i].class + "_on";
        let url = "../php/contorl_fan.php";
        $.post(url, mode, function (d) {
          //console.log(d);
        });
      },
      off() {
        let url = "../php/contorl_fan.php";
        let mode = "mode=" + webcam[i].class + "_off";
        $.post(url, mode, function (d) {});
      },
    },
  });
}

module.exports = {
  data() {
    return {
        page: 2,
      dialog: false,
      load:false,
      i2512: false,
      i2511: false,
      i2511_fan:null,
      i2512_fan:null,
      i2511_Color: "success",
      i2512_Color: "success",
      all: [],
      co2: [],
      voc: [],
      temp: [],
      activeColor: 'red',
      all_temp: 30,
      all_co2: 300,
      all_voc: 300,
      timer: null,
      ai_temp:[],
      in_temp:[],
      manual: false,
      numberRule: (v) => {
        if (!isNaN(parseFloat(v))) return true;
        return "請輸入數字";
      },
    };
  },
  created: function () {
    this.color();
  },
  updated() {
    this.color();
  },watch: {
      load(val) {
        if (!val) return;
        setTimeout(() => (this.load = false), 1000);
      },
    },
  methods: {
   
    color() {
     this.$http.get("https://lundic2020.tk/php/" + "i2511_btn.txt?" + new Date().getTime()).then(
          (response) => {
            this.i2511_fan=response.body;
          },
          (response) => {
            console.log("取得失敗");
          }
        );
        this.$http.get("https://lundic2020.tk/php/" + "i2512_btn.txt?" + new Date().getTime()).then(
          (response) => {
            this.i2512_fan=response.body;
          },
          (response) => {
            console.log("取得失敗");
          }
        );
        this.$http.get("https://lundic2020.tk/php/" + "ai_temp.txt?" + new Date().getTime()).then(
          (response) => {
            this.ai_temp=response.body;
            this.ai_temp.split(':')[1]
            
          },
          (response) => {
            console.log("取得失敗");
          }
        );
      for (let i = 0; i < webcam.length; i++) {
        
        this.$http.get("https://lundic2020.tk/php/" + webcam[i].class + "_session.txt?" + new Date().getTime()).then(
          (response) => {
            this.all.push(response.body.split(" "));
          },
          (response) => {
            console.log("取得失敗");
          }
        );
      }
      for (let i = 0; i < webcam.length; i++) {
        this.$http.get("https://lundic2020.tk/php/" + webcam[i].class + "_modify.txt?" + new Date().getTime()).then(
          (response) => {
            let modify = response.body.split(" ");
            this.all.forEach((item) => {
              this.temp.push(item[0].split(":")[1].split("℃")[0]);
              this.in_temp.push(item[1].split(":")[1].split("℃")[0]);
              this.co2.push(item[2].split(":")[1].split("ppm")[0]);
              this.voc.push(item[3].split(":")[1].split("ppb")[0]);
            });
            if (i == 0) {
            sum= Math.abs(this.in_temp[0]-this.ai_temp.split(':')[1])
              if (this.temp[0] >= parseFloat(modify[0]) + 3 || this.co2[0] >= parseFloat(modify[1]) + 100 || this.voc[0] >= parseFloat(modify[2]) + 100 || sum > 10  && this.in_temp[0] > 24) {
                this.i2511_Color = "error";
              } else if ((parseFloat(modify[0]) <= this.temp[0] && this.temp[0] < parseFloat(modify[0]) + 3) || (this.co2[0] >= parseFloat(modify[1]) && this.co2[0] < parseFloat(modify[1]) + 100) || (this.voc[0] >= parseFloat(modify[2]) && this.voc[0] < parseFloat(modify[2]) + 100) || sum > 5 && this.in_temp[0] > 24) {
                this.i2511_Color = "warning";
              } else {
                this.i2511_Color = "success";
              }
            }
            if (i == 1) {
            sum1=Math.abs(this.in_temp[1]-this.ai_temp.split(':')[1])
              if (this.temp[1] >= parseFloat(modify[0]) + 3 || this.co2[1] >= parseFloat(modify[1]) + 100 || this.voc[1] >= parseFloat(modify[2]) + 100 || sum1 > 10 && this.in_temp[1] > 24) {
                this.i2512_Color = "error";
              } else if ((parseFloat(modify[0]) <= this.temp[1] && this.temp[1] < parseFloat(modify[0]) + 3) || (this.co2[1] >= parseFloat(modify[1]) && this.co2[1] < parseFloat(modify[1]) + 100) || (this.voc[1] >= parseFloat(modify[2]) && this.voc[1] < parseFloat(modify[2]) + 100) || sum1 > 5 && this.in_temp[1] > 24) {
                this.i2512_Color = "warning";
              } else {
                this.i2512_Color = "success";
              }
            }
          },
          (response) => {
            console.log("取得失敗");
          }
        );
      }
    },
    all_modify() {
      this.all_temp = 30;
      this.all_co2 = 750;
      this.all_voc = 300;
      this.dialog = true;
    },
    post() {
      if (this.all_temp && this.all_co2 && this.all_voc ) {
       this.load=true;
      let temp = "&temp=" + this.all_temp;
      let co2 = "&co2=" + this.all_co2;
      let voc = "&voc=" + this.all_voc;
      let mode = "mode=all_modify";
      let url = "../php/contorl_fan.php";
      $.post(url, mode + temp + co2 + voc, function (d) {
      });
        this.dialog = false;
    }
 
    
     
    },
  },
};

</script>
