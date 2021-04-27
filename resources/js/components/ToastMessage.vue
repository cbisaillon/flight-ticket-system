<template>
  <div>

  </div>
</template>

<script>
const toastr = require("toastr");

export default {
name: "ToastMessage",
  props: {
    message: {
      type: String,
      required: true
    }
  },
  mounted() {
    console.log("toasting ! " + this.message);
    toastr.error(this.message);
  }
}
</script>

<style scoped>

</style>
