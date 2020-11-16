<template>
  <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
        <CCard>
          <CCardHeader> Activity Index </CCardHeader>
          <CCardBody>
            <Video1V />
            <TableControl />
            <Datatable1v />
            <Chart2V />
          </CCardBody>
        </CCard>
      </transition>
    </CCol>
  </CRow>
</template>

<script>
import Datatable1v from "./Datatable1v";
import TableControl from "./TableControl";
import Chart2V from "./Chart2V";
import Video1V from "./Video1V";
export default {
  name: "ActivityIndex",
  components: {
    Datatable1v,
    TableControl,
    Chart2V,
    Video1V,
  },
};
</script>

<style>
</style>