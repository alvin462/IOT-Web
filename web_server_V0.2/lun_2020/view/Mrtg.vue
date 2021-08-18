<template>
  <v-container>
    <v-row justify="center">
      <v-col class="d-flex" cols="12" sm="6">
        <v-select
          v-model="class_start"
          :items="class_name"
          item-value="val"
          item-text="val"
          filled
          label="選擇教室"
          dense
          persistent-hint
          return-object
          single-line
        ></v-select>
      </v-col>
    </v-row>

    <v-row justify="center">
      <v-col class="d-flex" cols="12" sm="6">
        <iframe
          v-if="class_start.val === 'i2511'"
          src="/mrtg/i2511"
          style="margin: 0; width: 100%; height: 1300px; border: none; overflow: hidden"
          scrolling="no"
          frameborder="0"
        >
        </iframe>
        <iframe
          v-if="class_start.val === 'i2512'"
          src="/mrtg/i2512"
          style="margin: 0; width: 100%; height: 1300px; border: none; overflow: hidden"
          scrolling="no"
          frameborder="0"
        >
        </iframe>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
module.exports = {
  data: function () {
    return {
      class_start: {
        val: "i2511",
      },
      class_name: [
        {
          val: "i2511",
        },
        {
          val: "i2512",
        },
      ],
    };
  },
};
</script>
