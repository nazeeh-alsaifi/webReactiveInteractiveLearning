<template>
  <div>
    <Video1V v-if="name == 'Video'" />
    <ChartAndTable v-if="name == 'Sheet and a chart'" />
  </div>
</template>

<script>
import ChartAndTable from "./ChartAndTable";
import Video1V from "./Video1V";
export default {
  name: "ActivityComponent",
  components: {
    ChartAndTable,
    Video1V,
  },
  props: {
    name: String,
  },
};
</script>

<style>
</style>