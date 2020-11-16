<template>
  <CRow>
    <CCol col="12" xl="6">
      <transition name="slide">
        <CCard>
          <CCardHeader>
            <strong>Please insert your activation code:</strong>
          </CCardHeader>
          <CCardBody>
            <CRow>
              <CCol sm="12">
                <CInput
                  label="Activation Code"
                  placeholder="Enter your activation code"
                  v-model="activationCode"
                />
              </CCol>
            </CRow>
          </CCardBody>
          <CCardFooter>
            <CButton
              type="submit"
              size="sm"
              color="primary"
              style="margin-right: 1rem"
              @click="store"
              ><CIcon name="cil-check-circle" /> Submit</CButton
            >
          </CCardFooter>
        </CCard>
      </transition>
    </CCol>
  </CRow>
</template>

<script>
export default {
  name: "JoinClass",
  data: () => {
    acivationCode: "";
  },
  methods: {},
};
</script>

<style>
</style>