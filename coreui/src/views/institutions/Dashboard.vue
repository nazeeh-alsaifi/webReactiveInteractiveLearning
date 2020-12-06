<template>
  <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
        <CCard>
          <CCardBody>
            <div class="container">
              <div class="panel panel-default">
                <div class="alert alert-success" v-show="successadd">
                  Institution Added Successfully.
                </div>
                <div class="alert alert-success" v-show="successedit">
                  Institution Updated Successfully.
                </div>
                <div class="alert alert-success" v-show="successdelete">
                  Institution Deleted Successfully.
                </div>
                <form @submit.prevent="submit" v-if="add">
                  <hr />
                  <div class="container">
                    <h5>Add Institution:</h5>
                    <hr />
                    <div class="form-group row">
                      <label
                        for="Instititution_Name"
                        class="col-md-4 col-form-label text-md-right"
                        >Instititution Name</label
                      >
                      <div class="col-md-6">
                        <input
                          id="Instititution_Name"
                          type="text"
                          class="form-control"
                          name="Instititution_Name"
                          minlength="3"
                          v-model="fields.Instititution_Name"
                          required
                          autofocus
                        />
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.Instititution_Name"
                        >
                          {{ errors.Instititution_Name[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="Institution_Type"
                        class="col-md-4 col-form-label text-md-right"
                        >Choose Institution Type</label
                      >
                      <div class="col-md-6">
                        <select
                          class="form-control"
                          id="Institution_Type"
                          name="Institution_Type"
                          v-model="fields.Institution_Type"
                          required
                          autofocus
                        >
                          <option
                            v-for="academiclevel in academiclevels"
                            v-bind:key="academiclevel.id"
                            :value="academiclevel.id"
                            >{{ academiclevel.AcademicLevel }}</option
                          >
                        </select>
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.Institution_Type"
                        >
                          {{ errors.Institution_Type[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="Country"
                        class="col-md-4 col-form-label text-md-right"
                        >Choose Country</label
                      >

                      <div class="col-md-6">
                        <select
                          class="form-control"
                          id="Country"
                          name="Country"
                          v-model="fields.Country"
                          required
                          autofocus
                        >
                          <option
                            v-for="country in countries"
                            v-bind:key="country.id"
                            :value="country.id"
                            >{{ country.country_name }}</option
                          >
                        </select>
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.Country"
                        >
                          {{ errors.Country[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="City"
                        class="col-md-4 col-form-label text-md-right"
                        >Choose City</label
                      >

                      <div class="col-md-6">
                        <select
                          class="form-control"
                          id="City"
                          name="City"
                          v-model="fields.City"
                          required
                          autofocus
                        >
                          <option
                            v-for="city in filteredCities"
                            v-bind:key="city.id"
                            :value="city.id"
                            >{{ city.city_name }}</option
                          >
                        </select>
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.city"
                        >
                          {{ errors.city[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="Mobile"
                        class="col-md-4 col-form-label text-md-right"
                        >Mobile</label
                      >

                      <div class="col-md-6">
                        <input
                          id="Mobile"
                          type="tel"
                          class="form-control"
                          name="Mobile"
                          pattern="[0]{1}[0-9]{9,12}"
                          v-model="fields.Mobile"
                          required
                          autofocus
                        />
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.Mobile"
                        >
                          {{ errors.Mobile[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="Email"
                        class="col-md-4 col-form-label text-md-right"
                        >Email</label
                      >

                      <div class="col-md-6">
                        <input
                          id="Email"
                          type="email"
                          class="form-control"
                          name="Email"
                          v-model="fields.Email"
                          required
                          autocomplete="Email"
                        />
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.Email"
                        >
                          {{ errors.Email[0] }}
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label
                        for="Address1"
                        class="col-md-4 col-form-label text-md-right"
                        >Address1</label
                      >

                      <div class="col-md-6">
                        <input
                          id="Address1"
                          type="text"
                          class="form-control"
                          name="Address1"
                          v-model="fields.Address1"
                          required
                          autofocus
                        />
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.Address1"
                        >
                          {{ errors.Address1[0] }}
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label
                        for="Address2"
                        class="col-md-4 col-form-label text-md-right"
                        >Address2</label
                      >

                      <div class="col-md-6">
                        <input
                          id="Address2"
                          type="text"
                          class="form-control"
                          name="Address2"
                          v-model="fields.Address2"
                          required
                          autofocus
                        />
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.Address2"
                        >
                          {{ errors.Address2[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="First_name"
                        class="col-md-4 col-form-label text-md-right"
                        >First_name</label
                      >

                      <div class="col-md-6">
                        <input
                          id="First_name"
                          type="text"
                          class="form-control"
                          name="First_name"
                          minlength="3"
                          v-model="fields.First_name"
                          required
                          autofocus
                        />
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.First_name"
                        >
                          {{ errors.First_name[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="Last_Name"
                        class="col-md-4 col-form-label text-md-right"
                        >Last_Name</label
                      >

                      <div class="col-md-6">
                        <input
                          id="Last_Name"
                          type="text"
                          class="form-control"
                          name="Last_Name"
                          minlength="3"
                          v-model="fields.Last_Name"
                          required
                          autofocus
                        />
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.Last_Name"
                        >
                          {{ errors.Last_Name[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="Coordinator_email"
                        class="col-md-4 col-form-label text-md-right"
                        >Coordinator_email</label
                      >

                      <div class="col-md-6">
                        <input
                          id="Coordinator_email"
                          type="email"
                          class="form-control"
                          name="Coordinator_email"
                          v-model="fields.Coordinator_email"
                          required
                          autocomplete="Coordinator_email"
                        />
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.Coordinator_email"
                        >
                          {{ errors.Coordinator_email[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="Coordinator_password"
                        class="col-md-4 col-form-label text-md-right"
                        >Coordinator_password</label
                      >

                      <div class="col-md-6" v-if="!passwordshow">
                        <input
                          id="Coordinator_password"
                          type="password"
                          class="form-control"
                          pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
                          name="Coordinator_password"
                          v-model="fields.Coordinator_password"
                          required
                          autofocus
                        />
                        <a class="btn btn-info" v-on:click="showpass()">show</a>
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.Coordinator_password"
                        >
                          {{ errors.Coordinator_password[0] }}
                        </div>
                        <button
                          v-if="!addgeneratepass"
                          v-on:click="genratePassAdd()"
                          class="btn btn-outline-info"
                        >
                          Auto Generate
                        </button>
                      </div>
                      <div class="col-md-6" v-if="passwordshow">
                        <input
                          id="Coordinator_password"
                          type="text"
                          class="form-control"
                          pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
                          name="Coordinator_password"
                          v-model="fields.Coordinator_password"
                          required
                          autofocus
                        />
                        <a class="btn btn-info" v-on:click="hidepass()">hide</a>
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.Coordinator_password"
                        >
                          {{ errors.Coordinator_password[0] }}
                        </div>
                        <button
                          v-if="!addgeneratepass"
                          v-on:click="genratePassAdd()"
                          class="btn btn-outline-info"
                        >
                          Auto Generate
                        </button>
                      </div>
                    </div>
                    <div class="form-group row mb-0">
                      <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-info">
                          Add
                        </button>
                        <button
                          v-on:click="cancelAdd()"
                          class="btn btn-outline-danger"
                        >
                          Cancel Add
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
                <form @submit.prevent="update" v-if="edit">
                  <hr />
                  <div class="container">
                    <h5>Edit Institution:</h5>
                    <hr />
                    <div class="form-group row">
                      <label
                        for="Institu_name"
                        class="col-md-4 col-form-label text-md-right"
                        >Instititution Name</label
                      >
                      <div class="col-md-6">
                        <input
                          id="Institu_name"
                          type="text"
                          class="form-control"
                          name="Institu_name"
                          minlength="3"
                          v-model="editfields.Institu_name"
                          required
                          autofocus
                        />
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.Institu_name"
                        >
                          {{ errors.Institu_name[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="academicLevels_id"
                        class="col-md-4 col-form-label text-md-right"
                        >Choose Institution Type</label
                      >
                      <div class="col-md-6">
                        <select
                          class="form-control"
                          id="academicLevels_id"
                          name="academicLevels_id"
                          v-model="editfields.academicLevels_id"
                          required
                          autofocus
                        >
                          <option
                            v-for="academiclevel in academiclevels"
                            v-bind:key="academiclevel.id"
                            :value="academiclevel.id"
                            >{{ academiclevel.AcademicLevel }}</option
                          >
                        </select>
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.academicLevels_id"
                        >
                          {{ errors.academicLevels_id[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="country_id"
                        class="col-md-4 col-form-label text-md-right"
                        >Choose Country</label
                      >

                      <div class="col-md-6">
                        <select
                          class="form-control"
                          id="country_id"
                          name="country_id"
                          v-model="editfields.country_id"
                          required
                          autofocus
                        >
                          <option
                            v-for="country in countries"
                            v-bind:key="country.id"
                            :value="country.id"
                            >{{ country.country_name }}</option
                          >
                        </select>
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.country_id"
                        >
                          {{ errors.country_id[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="Id_city"
                        class="col-md-4 col-form-label text-md-right"
                        >Choose City</label
                      >

                      <div class="col-md-6">
                        <select
                          class="form-control"
                          id="city_id"
                          name="city_id"
                          v-model="editfields.city_id"
                          required
                          autofocus
                        >
                          <option
                            v-for="city in filterededitCities"
                            v-bind:key="city.id"
                            :value="city.id"
                            >{{ city.city_name }}</option
                          >
                        </select>
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.city_id"
                        >
                          {{ errors.city_id[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="Mobile"
                        class="col-md-4 col-form-label text-md-right"
                        >Mobile</label
                      >

                      <div class="col-md-6">
                        <input
                          id="Mobile"
                          type="tel"
                          class="form-control"
                          name="Mobile"
                          pattern="[0]{1}[0-9]{9,12}"
                          v-model="editfields.Mobile"
                          required
                          autofocus
                        />
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.Mobile"
                        >
                          {{ errors.Mobile[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="Email"
                        class="col-md-4 col-form-label text-md-right"
                        >Email</label
                      >

                      <div class="col-md-6">
                        <input
                          id="Email"
                          type="email"
                          class="form-control"
                          name="Email"
                          v-model="editfields.Email"
                          required
                          autocomplete="email"
                        />
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.email"
                        >
                          {{ errors.email[0] }}
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label
                        for="Address"
                        class="col-md-4 col-form-label text-md-right"
                        >Address1</label
                      >

                      <div class="col-md-6">
                        <input
                          id="Address"
                          type="text"
                          class="form-control"
                          name="Address"
                          v-model="editfields.Address"
                          required
                          autofocus
                        />
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.Address"
                        >
                          {{ errors.Address[0] }}
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label
                        for="Address1"
                        class="col-md-4 col-form-label text-md-right"
                        >Address2</label
                      >

                      <div class="col-md-6">
                        <input
                          id="Address1"
                          type="text"
                          class="form-control"
                          name="Address1"
                          v-model="editfields.Address1"
                          required
                          autofocus
                        />
                        <div
                          class="alert alert-danger"
                          v-if="errors && errors.Address1"
                        >
                          {{ errors.Address1[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="form-group row mb-0">
                      <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-outline-primary">
                          Update
                        </button>

                        <button
                          v-on:click="cancelEdit()"
                          class="btn btn-outline-danger"
                        >
                          Cancel Edit
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
                <div class="panel-heading"><h1>Institutions</h1></div>
                <div class="panel-body">
                  <div style="text-align:left">
                    <div
                      style="display:inline-block"
                      v-for="permission in permissions"
                      v-bind:key="permission.id"
                    >
                      <div v-if="permission.permission == 'add Institution'">
                        <a
                          v-on:click="addInstitution()"
                          v-if="!edit"
                          class="btn btn-info"
                          >Add New Institution</a
                        >
                      </div>
                    </div>
                  </div>
                  <br />
                  <table style="table-layout:fixed" class="table table-striped">
                    <thead>
                      <tr style="width:100%;">
                        <th style="text-align:left; width:5%;">
                          <div style="text-align:left;">
                            <a
                              style="text-align:left;font-size:12px"
                              @click.prevent="change_sort('id')"
                              >Id</a
                            >
                            <span
                              v-if="
                                this.sort_field == 'id' &&
                                  this.sort_direction == 'asc'
                              "
                              @click.prevent="change_sort('id')"
                              ><CIcon name="cil-arrow-top" /></span
                            >
                            <span
                              v-if="
                                this.sort_field == 'id' &&
                                  this.sort_direction == 'desc'
                              "
                              @click.prevent="change_sort('id')"
                              ><CIcon name="cil-arrow-bottom" /></span
                            >
                          </div>
                        </th>
                        <th style="text-align:left;width:10%;font-size:12px">
                          <div style="text-align:left;">
                            <a
                              style="text-align:left;"
                              @click.prevent="change_sort('Institu_name')"
                              >Name</a
                            >
                            <span
                              v-if="
                                this.sort_field == 'Institu_name' &&
                                  this.sort_direction == 'asc'
                              "
                              @click.prevent="change_sort('Institu_name')"
                              ><CIcon name="cil-arrow-top" /></span
                            >
                            <span
                              v-if="
                                this.sort_field == 'Institu_name' &&
                                  this.sort_direction == 'desc'
                              "
                              @click.prevent="change_sort('Institu_name')"
                              ><CIcon name="cil-arrow-bottom" /></span
                            >
                          </div>
                        </th>
                        <th style="text-align:left;width:10%;font-size:12px">
                          <div style="text-align:left;">
                            <a
                              style="text-align:left;"
                              @click.prevent="change_sort('academicLevels_id')"
                              >Institution Type</a
                            >
                            <span
                              v-if="
                                this.sort_field == 'academicLevels_id' &&
                                  this.sort_direction == 'asc'
                              "
                              @click.prevent="change_sort('academicLevels_id')"
                              ><CIcon name="cil-arrow-top" /></span
                            >
                            <span
                              v-if="
                                this.sort_field == 'academicLevels_id' &&
                                  this.sort_direction == 'desc'
                              "
                              @click.prevent="change_sort('academicLevels_id')"
                              ><CIcon name="cil-arrow-bottom" /></span
                            >
                          </div>
                        </th>
                        <th style="text-align:left;width:10%;font-size:12px">
                          <div style="text-align:left;">
                            <a
                              style="text-align:left;"
                              @click.prevent="change_sort('country_id')"
                              >Country</a
                            >
                            <span
                              v-if="
                                this.sort_field == 'country_id' &&
                                  this.sort_direction == 'asc'
                              "
                              @click.prevent="change_sort('country_id')"
                              ><CIcon name="cil-arrow-top" /></span
                            >
                            <span
                              v-if="
                                this.sort_field == 'country_id' &&
                                  this.sort_direction == 'desc'
                              "
                              @click.prevent="change_sort('country_id')"
                              ><CIcon name="cil-arrow-bottom" /></span
                            >
                          </div>
                        </th>
                        <th style="text-align:left;width:10%;font-size:12px">
                          <div style="text-align:left;">
                            <a
                              style="text-align:left;"
                              @click.prevent="change_sort('city_id')"
                              >City</a
                            >
                            <span
                              v-if="
                                this.sort_field == 'city_id' &&
                                  this.sort_direction == 'asc'
                              "
                              @click.prevent="change_sort('city_id')"
                              ><CIcon name="cil-arrow-top" /></span
                            >
                            <span
                              v-if="
                                this.sort_field == 'city_id' &&
                                  this.sort_direction == 'desc'
                              "
                              @click.prevent="change_sort('city_id')"
                              ><CIcon name="cil-arrow-bottom" /></span
                            >
                          </div>
                        </th>
                        <th style="text-align:left;width:10%;font-size:12px">
                          <div style="text-align:left;">
                            <a
                              style="text-align:left;"
                              @click.prevent="change_sort('Mobile')"
                              >Mobile</a
                            >
                            <span
                              v-if="
                                this.sort_field == 'Mobile' &&
                                  this.sort_direction == 'asc'
                              "
                              @click.prevent="change_sort('Mobile')"
                              ><CIcon name="cil-arrow-top" /></span
                            >
                            <span
                              v-if="
                                this.sort_field == 'Mobile' &&
                                  this.sort_direction == 'desc'
                              "
                              @click.prevent="change_sort('Mobile')"
                              ><CIcon name="cil-arrow-bottom" /></span
                            >
                          </div>
                        </th>
                        <th style="text-align:left;width:10%;font-size:12px">
                          <div style="text-align:left;">
                            <a
                              style="text-align:left;"
                              @click.prevent="change_sort('Email')"
                              >Email</a
                            >
                            <span
                              v-if="
                                this.sort_field == 'Email' &&
                                  this.sort_direction == 'asc'
                              "
                              @click.prevent="change_sort('Email')"
                              ><CIcon name="cil-arrow-top" /></span
                            >
                            <span
                              v-if="
                                this.sort_field == 'Email' &&
                                  this.sort_direction == 'desc'
                              "
                              @click.prevent="change_sort('Email')"
                              ><CIcon name="cil-arrow-bottom" /></span
                            >
                          </div>
                        </th>
                        <th style="text-align:left;width:10%;font-size:12px">
                          <div style="text-align:left;">
                            <a
                              style="text-align:left;"
                              @click.prevent="change_sort('Address')"
                              >Address1</a
                            >
                            <span
                              v-if="
                                this.sort_field == 'Address' &&
                                  this.sort_direction == 'asc'
                              "
                              @click.prevent="change_sort('Address')"
                              ><CIcon name="cil-arrow-top" /></span
                            >
                            <span
                              v-if="
                                this.sort_field == 'Address' &&
                                  this.sort_direction == 'desc'
                              "
                              @click.prevent="change_sort('Address')"
                              ><CIcon name="cil-arrow-bottom" /></span
                            >
                          </div>
                        </th>
                        <th style="text-align:left;width:10%;font-size:12px">
                          <div style="text-align:left;">
                            <a
                              style="text-align:left;"
                              @click.prevent="change_sort('Address1')"
                              >Address2</a
                            >
                            <span
                              v-if="
                                this.sort_field == 'Address1' &&
                                  this.sort_direction == 'asc'
                              "
                              @click.prevent="change_sort('Address1')"
                              ><CIcon name="cil-arrow-top" /></span
                            >
                            <span
                              v-if="
                                this.sort_field == 'Address1' &&
                                  this.sort_direction == 'desc'
                              "
                              @click.prevent="change_sort('Address1')"
                              ><CIcon name="cil-arrow-bottom" /></span
                            >
                          </div>
                        </th>
                        <th style="text-align:left;width:25%;font-size:12px">
                          <input
                            style="width:100%;"
                            type="search"
                            v-model="searchtext"
                            placeholder="search institution"
                          />
                        </th>
                        <th style="text-align:left;width:10%;font-size:12px">
                          <a>COL</a>
                          <select
                            style="width:10%;"
                            class="btn btn-info"
                            v-model="column"
                          >
                            <option class="form-control" :value="'Institu_name'"
                              >Institution_Name</option
                            >
                            <option class="form-control" :value="'Email'"
                              >Email</option
                            >
                            <option class="form-control" :value="'Mobile'"
                              >Mobile</option
                            >
                            <option class="form-control" :value="'Address'"
                              >Address</option
                            >
                            <option class="form-control" :value="'Address1'"
                              >Address1</option
                            >
                          </select>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="Institution in institutions.data"
                        v-bind:key="Institution.id"
                      >
                        <td>
                          <div>
                            {{ Institution.id }}
                          </div>
                        </td>
                        <td>
                          <div style="word-wrap: break-word;">
                            {{ Institution.Institu_name }}
                          </div>
                        </td>
                        <td>
                          <div
                            v-for="academiclevel in academiclevels"
                            v-bind:key="academiclevel.id"
                          >
                            <div
                              style="word-wrap: break-word;"
                              v-if="
                                academiclevel.id ==
                                  Institution.academicLevels_id
                              "
                            >
                              {{ academiclevel.AcademicLevel }}
                            </div>
                          </div>
                        </td>
                        <td>
                          <div
                            v-for="country in countries"
                            v-bind:key="country.id"
                          >
                            <div
                              style="word-wrap: break-word;"
                              v-if="country.id == Institution.country_id"
                            >
                              {{ country.country_name }}
                            </div>
                          </div>
                        </td>
                        <td>
                          <div
                            style="word-wrap: break-word;"
                            v-for="city in cities"
                            v-bind:key="city.id"
                          >
                            <div v-if="city.id == Institution.city_id">
                              {{ city.city_name }}
                            </div>
                          </div>
                        </td>
                        <td>
                          <div style="word-wrap: break-word;">
                            {{ Institution.Mobile }}
                          </div>
                        </td>
                        <td>
                          <div style="word-wrap: break-word;">
                            {{ Institution.Email }}
                          </div>
                        </td>
                        <td>
                          <div style="word-wrap: break-word;">
                            {{ Institution.Address }}
                          </div>
                        </td>
                        <td>
                          <div style="word-wrap: break-word;">
                            {{ Institution.Address1 }}
                          </div>
                        </td>
                        <td>
                          <div
                            v-for="permission in permissions"
                            v-bind:key="permission.id"
                          >
                            <div
                              v-if="permission.permission == 'edit Institution'"
                            >
                              <button
                                v-on:click="editInstitution(Institution)"
                                v-if="!edit && Institution.id != editfields.id"
                                class="btn btn-info"
                              >
                                Edit
                              </button>
                              <button
                                v-on:click="cancelEdit()"
                                v-if="Institution.id == editfields.id"
                                class="btn btn-outline-danger"
                              >
                                Cancel Edit
                              </button>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div
                            v-for="permission in permissions"
                            v-bind:key="permission.id"
                          >
                            <div
                              v-if="
                                permission.permission == 'delete Institution'
                              "
                            >
                              <button
                                @click="deleteComponent(Institution)"
                                class="btn btn-danger"
                                style="width:25%;"
                              >
                                x
                              </button>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <hr />
                    </tbody>
                  </table>
                  <pagination
                    :data="institutions"
                    @pagination-change-page="loadInstitutions"
                  ></pagination>
                </div>
              </div>
            </div>
          </CCardBody>
        </CCard>
      </transition>
    </CCol>
  </CRow>
</template>

<script>
import axios from "axios";
export default {
  data: function() {
    return {
      institutions: {},
      countries: [],
      academiclevels: [],
      cities: [],
      permissions: [],
      successadd: false,
      successedit: false,
      successdelete: false,
      addpart1: true,
      addpart2: false,
      editpart1: true,
      editpart2: false,
      addgeneratepass: false,
      fields: {},
      editfields: {},
      edit: false,
      add: false,
      searchtext: "",
      column: "Institu_name",
      errors: [],
      sort_field: "id",
      sort_direction: "desc",
      passwordshow: false,
    };
  },
  mounted() {
    this.loadInstitutions();
    this.loadCountries();
    this.loadCities();
    this.loadAcademiclevels();
    this.Permissions();
  },
  computed: {
    filteredCities: function() {
      return this.cities.filter((city) => {
        return city.country_id == this.fields.Country;
      });
    },
    filterededitCities: function() {
      return this.cities.filter((city) => {
        return city.country_id == this.editfields.country_id;
      });
    },
  },
  watch: {
    searchtext() {
      this.loadInstitutions();
    },
    column() {
      this.loadInstitutions();
    },
  },
  methods: {
    Permissions() {
      axios
        .get(
          this.$apiAdress +
            "/api/user/getUserPermissions?token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.permissions = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    showpass() {
      this.passwordshow = true;
    },
    hidepass() {
      this.passwordshow = false;
    },
    change_sort(field) {
      if (this.sort_field === field) {
        this.sort_direction = this.sort_direction === "asc" ? "desc" : "asc";
      } else {
        this.sort_field = field;
        this.sort_direction = "asc";
      }
      this.loadInstitutions();
    },
    loadInstitutions(page = 1) {
      axios
        .get(
          this.$apiAdress +
            "/api/institution/getpage?page=" +
            page +
            "&search=" +
            this.searchtext +
            "&sort_field=" +
            this.sort_field +
            "&sort_direction=" +
            this.sort_direction +
            "&column=" +
            this.column +
            "&token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.institutions = response.data;
          this.successadd = false;
          this.successedit = false;
          this.successdelete = false;
        });
    },
    loadCountries: function() {
      axios
        .get(
          this.$apiAdress +
            "/api/Countries?token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.countries = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    loadCities: function() {
      axios
        .get(
          this.$apiAdress +
            "/api/Cities?token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.cities = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    loadAcademiclevels: function() {
      axios
        .get(
          this.$apiAdress +
            "/api/AcademicLevels?token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.academiclevels = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    loadAfterAdd: function(page = 1) {
      axios
        .get(
          this.$apiAdress +
            "/api/institution/getpage?page=" +
            page +
            "&search=" +
            this.searchtext +
            "&sort_field=" +
            this.sort_field +
            "&sort_direction=" +
            this.sort_direction +
            "&column=" +
            this.column +
            "&token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.institutions = response.data;
          this.successadd = true;
          this.successedit = false;
          this.successdelete = false;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    loadAfterEdit: function(page = 1) {
      axios
        .get(
          this.$apiAdress +
            "/api/institution/getpage?page=" +
            page +
            "&search=" +
            this.searchtext +
            "&sort_field=" +
            this.sort_field +
            "&sort_direction=" +
            this.sort_direction +
            "&column=" +
            this.column +
            "&token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.institutions = response.data;
          this.successadd = false;
          this.successedit = true;
          this.successdelete = false;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    loadAfterDelete: function(page = 1) {
      axios
        .get(
          this.$apiAdress +
            "/api/institution/getpage?page=" +
            page +
            "&search=" +
            this.searchtext +
            "&sort_field=" +
            this.sort_field +
            "&sort_direction=" +
            this.sort_direction +
            "&column=" +
            this.column +
            "&token=" +
            localStorage.getItem("api_token")
        )
        .then((response) => {
          this.institutions = response.data;
          this.successadd = false;
          this.successedit = false;
          this.successdelete = true;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    addInstitution() {
      this.add = true;
      this.successadd = false;
      this.successedit = false;
      this.successdelete = false;
    },
    cancelAdd() {
      this.add = false;
      this.fields = {};
      this.errors = {};
      this.addgeneratepass = false;
      this.loadInstitutions();
    },
    submit() {
      axios
        .post(
          this.$apiAdress +
            "/api/Institution?token=" +
            localStorage.getItem("api_token"),
          this.fields
        )
        .then((response) => {
          this.fields = {};
          this.errors = {};
          this.add = false;
          this.loadAfterAdd();
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
          }
          console.log("Error");
        });
    },
    editInstitution(institution) {
      this.edit = true;
      this.editfields = institution;
      this.successadd = false;
      this.successedit = false;
      this.successdelete = false;
    },
    cancelEdit() {
      this.edit = false;
      this.editfields = {};
      this.errors = {};
      this.loadInstitutions();
    },
    update() {
      axios
        .post(
          this.$apiAdress +
            "/api/institutions/store1?token=" +
            localStorage.getItem("api_token"),
          this.editfields
        )
        .then((response) => {
          this.editfields = {};
          this.edit = false;
          this.successedit = true;
          this.errors = {};
          this.loadAfterEdit();
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
          }
          console.log("Error");
        });
    },
    deleteComponent(id) {
      axios
        .post(
          this.$apiAdress +
            "/api/institutions/delete?token=" +
            localStorage.getItem("api_token"),
          id
        )
        .then((data) => {
          this.loadAfterDelete();
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    toaddpart1() {
      this.addpart1 = true;
      this.addpart2 = false;
    },
    toaddpart2() {
      this.addpart2 = true;
      this.addpart1 = false;
    },
    genratePassAdd() {
      var generator = require("generate-password");
      this.fields.Coordinator_password = generator.generate({
        length: 10,
        numbers: true,
        lowercase: true,
        uppercase: true,
      });
      this.addgeneratepass = true;
      return Coordinator_password;
    },
  },
};
</script>

<style scoped>
table {
  width: 100%;
  border-collapse: separate; /* Don't collapse */
  border-spacing: 0;
}

table th {
  /* Apply both top and bottom borders to the <th> */
  border-top: 2px solid rgba(99, 99, 99, 0.5);
  border-bottom: 2px solid rgba(99, 99, 99, 0.5);
}

table th:first-child {
  /* Apply a left border on the first <td> or <th> in a row */
  border-left: 2px solid rgba(99, 99, 99, 0.5);
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
}
table th:last-child {
  /* Apply a left border on the first <td> or <th> in a row */
  border-right: 2px solid rgba(99, 99, 99, 0.5);
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
}
table thead th {
  top: 0;
}
input:invalid {
  border: red solid 1px;
}
</style>
