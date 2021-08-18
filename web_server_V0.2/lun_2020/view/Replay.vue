<template>
<v-container>
    <v-row justify="center">
        <v-col class="d-flex" cols="12" sm="6">

            <v-select v-model="class_start" :items="class_name" item-value="val" item-text="val" filled label="選擇教室" dense persistent-hint return-object single-line @input="re"></v-select>
        </v-col>
        <v-date-picker v-model="clickdate" :allowed-dates="allowedDates" class="mt-4" :max="getmax" :full-width="fullWidth" :landscape="$vuetify.breakpoint.smAndUp" :picker-date.sync="clickdate" locale="zh-cn"></v-date-picker>

    </v-row>
    <v-row align="center">
        <v-col class="d-flex" cols="12">
            <v-select v-model="select_start" :items="items_start" item-text="time" item-value="val" label="Start" persistent-hint return-object single-line @input="time_pick"></v-select>
            <v-select v-model="select_end" :items="items_end" item-text="time" item-value="val" label="End" persistent-hint return-object single-line @input="time_pick"></v-select>
        </v-col>

        <v-row>

            <v-col cols="12">
                <v-btn v-for="(item,index) of btn_list" @click.stop="clickbutton(item)">{{item}}</v-btn>
            </v-col>
        </v-row>
        <v-col cols="8" id="list">

        </v-col>
</v-container>
</template>

<script>
module.exports = {
    data: function () {
        return {
            class_start: {
                val: null
            },
            class_name: [{
                val: 'i2511'
            }, {
                val: 'i2512'
            }],
            date: new Date(), //用於datepick 最大天 與最少天限制
            select_start: {
                time: null,
                val: null
            },
            items_start: [{
                time: '00時',
                val: 24
            }, {
                time: '01時',
                val: 01
            }, {
                time: '02時',
                val: 02
            }, {
                time: '03時',
                val: 03
            }, {
                time: '04時',
                val: 04
            }, {
                time: '05時',
                val: 05
            }, {
                time: '06時',
                val: 06
            }, {
                time: '07時',
                val: 07
            }, {
                time: '08時',
                val: 08
            }, {
                time: '09時',
                val: 09
            }, {
                time: '10時',
                val: 10
            }, {
                time: '11時',
                val: 11
            }, {
                time: '12時',
                val: 12
            }, {
                time: '13時',
                val: 13
            }, {
                time: '14時',
                val: 14
            }, {
                time: '15時',
                val: 15
            }, {
                time: '16時',
                val: 16
            }, {
                time: '17時',
                val: 17
            }, {
                time: '18時',
                val: 18
            }, {
                time: '19時',
                val: 19
            }, {
                time: '20時',
                val: 20
            }, {
                time: '21時',
                val: 21
            }, {
                time: '22時',
                val: 22
            }, {
                time: '23時',
                val: 23
            }, ],
            select_end: {
                time: null,
                val: null
            },
            items_end: [{
                time: '00時',
                val: 24
            }, {
                time: '01時',
                val: 01
            }, {
                time: '02時',
                val: 02
            }, {
                time: '03時',
                val: 03
            }, {
                time: '04時',
                val: 04
            }, {
                time: '05時',
                val: 05
            }, {
                time: '06時',
                val: 06
            }, {
                time: '07時',
                val: 07
            }, {
                time: '08時',
                val: 08
            }, {
                time: '09時',
                val: 09
            }, {
                time: '10時',
                val: 10
            }, {
                time: '11時',
                val: 11
            }, {
                time: '12時',
                val: 12
            }, {
                time: '13時',
                val: 13
            }, {
                time: '14時',
                val: 14
            }, {
                time: '15時',
                val: 15
            }, {
                time: '16時',
                val: 16
            }, {
                time: '17時',
                val: 17
            }, {
                time: '18時',
                val: 18
            }, {
                time: '19時',
                val: 19
            }, {
                time: '20時',
                val: 20
            }, {
                time: '21時',
                val: 21
            }, {
                time: '22時',
                val: 22
            }, {
                time: '23時',
                val: 23
            }, ],
            clickdate: new Date().toISOString().slice(0, 10), //用於datepick 最大天 與最少天限制
            fullWidth: true,
            date_list: [], //檔名this.date_list=xxxx-xx-xx 來自created
            time_list: [], //時間篩選處理
            btn_list: null, //this.btn_list檔名=XXXX年XX月XX日....用於創建按鈕的名稱
            videocreate: null, //this.videocreate檔名=video檔案位置 用於methods的clickbutton 創建影片
            list_for_datepick: [], //沒有的日期disable
            time_picker_month: null
        };
    },

    computed: {
        getmax() {
            /* 可當now使用*/

            var maxDate = new Date(
                    this.date.getFullYear(),
                    this.date.getMonth(),
                    this.date.getDate() + 1,
                )
                .toISOString()
                .slice(0, 10);
            return maxDate;
        },

    },
    watch: {
        // 日期點擊事件-創建按鈕
        clickdate(val, oldval) {
            $("#list").empty();
            date_btn = [];
            this.btn_list = date_btn; //this.btn_list檔名=XXXX年XX月XX日....用於創建按鈕的名稱
            this.date_list.forEach((item) => {
             //   console.log(item[2].sort())
               let date_list = item[0] + "-" + item[1] + "-" + item[2];
                if (val == date_list) {
                    btn_name =
                        item[0] +
                        "年" +
                        item[1] +
                        "月" +
                        item[2] +
                        "日" +
                        item[3] +
                        "時" +
                        item[4] +
                        "分" +
                        item[5] +
                        "秒";
                    date_btn.push(btn_name);

                }
            });
        },
    },
    methods: {
        allowedDates(val) {
            let for_picker = []
            for_picker = this.list_for_datepick
            return for_picker.indexOf(val) !== -1 //for_picker 格式 = val 索引陣列是否!== -1, -1是代表沒有索引到產生的值 所以必須不等於-1 才會是有影片檔的值

        },
        re() {
            $("#list").empty();
            this.btn_list = null
            //這裡取得php檔名

            this.date_list = []; //時間選擇器清空 已導致重複
            this.time_list = []; //清空檔案索引配對 已導致重複
            this.list_for_datepick = []; //清空檔案索引配對 已導致重複
            let list = [];
            this.$http.get("../php/" + this.class_start.val + "_videodata.php").then(
                (response) => {
                    this.videocreate = response.body; //this.videocreate檔名=video檔案位置
                    response.body.forEach((item) => {

                        let date_list = item.split("lan-")[1].split(".mp4")[0].split("-");
                        let date_video =
                            date_list[0] + "-" + date_list[1] + "-" + date_list[2];
                        this.list_for_datepick.push(date_video)
                        this.date_list.push(date_list);
                    });
                },
                (response) => {
                    console.log("取得失敗");
                }
            );
            //這裡是取得時間～
            this.$http.get("../php/" + this.class_start.val + "_videotime.php").then(
                (response) => {
                    response.body.forEach(item => {
                        this.time_list.push(item)
                    });
                },
                (response) => {
                    console.log("取得失敗");
                }
            );
            //檔名this.date_list=xxxx-xx-xx
            //檔名XX:XX:XX
        },
        //點擊按鈕創建影片
        clickbutton(date_time) {
            // cnt = 0 代表點的是日期
            let date_name =
                date_time.slice(0, 4) +
                "-" +
                date_time.slice(5, 7) +
                "-" +
                date_time.slice(8, 10) +
                "-" +
                date_time.slice(11, 13) +
                "-" +
                date_time.slice(14, 16) +
                "-" +
                date_time.slice(17, 19);
            this.videocreate.forEach((item) => {
                let date_list = item.split("lan-")[1].split(".mp4")[0].split("-");
                let date_list_real =
                    date_list[0] +
                    "-" +
                    date_list[1] +
                    "-" +
                    date_list[2] +
                    "-" +
                    date_list[3] +
                    "-" +
                    date_list[4] +
                    "-" +
                    date_list[5];
                if (date_name == date_list_real) {
                    $("#list").empty();
                    let file = "../" + item;

                    $("#list").append(
                        '<video style="width: 100%;  height: auto" controls><source src="' +
                        file +
                        '" type="video/mp4"></video>'
                    );
                }
            });

        },
        //點擊時間選擇
        time_pick() {
            $("#list").empty();
            // this.btn_list=null
            let Time = [] //影片總分
            let original_start_hour = [] //影片開始時
            let original_start_min = [] //影片開始分
            let over_min = []; //結束分
            let over_hour = []; //結束時
            let btn_origin = [] //按鈕創建原始狀態
            let btn_no_origin = [] //按鈕創建處理狀態
            //師兼篩選器 開始篩選 
            if (this.select_start.val && this.select_end.val) {

                let start_to_end = this.select_start.val + '-' + this.select_end.val
                this.time_list.forEach(item => {
                    let time = item.split(':')[1]
                    Time.push(time);
                })
                this.date_list.forEach(item => {

                    original_start_hour.push(item[3])
                    original_start_min.push(item[4])
                })

                for (let i = 0; i < this.date_list.length; i++) {
                    over_min[i] = parseInt(original_start_min[i]) + parseInt(Time[i])

                    if (over_min[i] > 60) {
                        over_hour[i] = parseInt(original_start_hour[i]) + 1;
                    } else if (over_min[i] < 60) {
                        over_hour[i] = parseInt(original_start_hour[i])
                    }
                    if (original_start_hour[i] >= this.select_start.val && over_hour[i] < this.select_end.val) {
                        btn_origin.push(this.date_list[i])
                    }
                }

                btn_origin.forEach((item) => {
                    //月份篩選
                    if (item[1] == this.clickdate.split("-")[1]) {
                        let btn_name =
                            item[0] +
                            "年" +
                            item[1] +
                            "月" +
                            item[2] +
                            "日" +
                            item[3] +
                            "時" +
                            item[4] +
                            "分" +
                            item[5] +
                            "秒";
                        btn_no_origin.push(btn_name)
                    }
                })
            }
            this.btn_list = btn_no_origin
        },

    },
};
</script>
