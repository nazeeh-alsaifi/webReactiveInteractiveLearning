<template>
  <CCardBody>
    <Video1V v-if="name == 'video'" />
    <Datatable1v v-if="name == 'datasheet'" />
    <TableControl v-if="name == 'datasheet'" />
    <Chart2V v-if="name == 'datasheet'" />
  </CCardBody>
</template>

<script>
import Datatable1v from "./Datatable1v";
import TableControl from "./TableControl";
import Chart2V from "./Chart2V";
import Video1V from "./Video1V";
export default {
  name: "ActivityComponent",
  components: {
    Datatable1v,
    TableControl,
    Chart2V,
    Video1V,
  },
  props: {
    name: String,
  },
};
</script>

<style>
</style>