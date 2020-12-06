<template>
  <CCardBody>
    <div class="m-2" style="display: flex; justify-content: center">
      <button type="button" class="btn btn-primary mr-2" @click="addRow">
        Add Row
      </button>
      <button type="button" class="btn btn-success mr-2" @click="deleteRow">
        Delete Row
      </button>
      <button type="button" class="btn btn-danger mr-2" @click="addHeader">
        Add Column
      </button>
      <button type="button" class="btn btn-warning" @click="deleteHeader">
        Remove Column
      </button>
    </div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th v-for="header in headers" :key="header.id" scope="col">
            <div v-show="header.edit == false" @dblclick="header.edit = true">
              {{ header.value }}
            </div>
            <input
              v-show="header.edit == true"
              v-model="header.value"
              v-on:blur="header.edit = false"
              @keyup.enter="$event.target.blur()"
            />
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="row in rows" :key="row.id">
          <td v-for="rowObject in row.rowObjects" :key="rowObject.id">
            <div
              v-show="rowObject.edit == false"
              @dblclick="rowObject.edit = true"
            >
              {{ rowObject.value }}
            </div>
            <input
              v-show="rowObject.edit == true"
              v-model="rowObject.value"
              v-on:blur="rowObject.edit = false"
              @keyup.enter="$event.target.blur()"
            />
          </td>
        </tr>
      </tbody>
    </table>

    <div class="small">
      <ScatterChart
        :chartData="datacollection"
        :options="options"
      ></ScatterChart>
      <div class="d-flex justify-content-around">
        <div>
          x-Axis:
          <select @change="changeXaxis($event)">
            <option value=""></option>
            <option v-for="(headerName, index) in getAvailableXY" :key="index">
              {{ headerName }}
            </option>
          </select>
        </div>
        <div>
          y-Axis:
          <select @change="changeYaxis($event)">
            <option value=""></option>
            <option v-for="(headerName, index) in getAvailableXY" :key="index">
              {{ headerName }}
            </option>
          </select>
        </div>
      </div>
    </div>
  </CCardBody>
</template>

<script>
import ScatterChart from "./ScatterChart.vue";
export default {
  name: "ChartAndTable",
  components: {
    ScatterChart,
  },
  data() {
    return {
      headers: [
        { id: 0, value: "#", edit: false },
        { id: 1, value: "header1", edit: false },
        { id: 2, value: "header2", edit: false },
        { id: 3, value: "header3", edit: false },
      ],

      rows: [
        // row1
        {
          id: 0,
          rowObjects: [
            //rowDataObj
            { id: 0, value: "1", edit: false },
            { id: 1, value: "4", edit: false },
            { id: 2, value: "6", edit: false },
            { id: 3, value: "8", edit: false },
          ],
        },
        {
          id: 1,
          rowObjects: [
            { id: 0, value: "2", edit: false },
            { id: 1, value: "3", edit: false },
            { id: 2, value: "6", edit: false },
            { id: 3, value: "9", edit: false },
          ],
        },
        {
          id: 2,
          rowObjects: [
            { id: 0, value: "3", edit: false },
            { id: 1, value: "8", edit: false },
            { id: 2, value: "12", edit: false },
            { id: 3, value: "16", edit: false },
          ],
        },
      ],

      // chart
      options: { responsive: true, maintainAspectRatio: false },
      Xheader: "header1",
      Yheader: "header2",
    };
  },
  computed: {
    datacollection: {
      get: function () {
        return {
          datasets: [
            {
              label: "My First dataset",
              borderColor: "#2196f3",
              backgroundColor: "#2196f3",
              data: this.calculateScatterData(this.Xheader, this.Yheader),
            },
          ],
        };
      },
      set: function (newHeaders) {
        this.Xheader = newHeaders.x;
        this.Yheader = newHeaders.y;
      },
    },

    getAvailableXY() {
      const headersNames = [];
      this.headers
        .filter((header) => header.id != 0)
        .forEach((remainingHeaders) =>
          headersNames.push(remainingHeaders.value)
        );
      return headersNames;
    },
  },
  methods: {
    changeXaxis(e) {
      const headerName =
        e.target.options[e.target.options.selectedIndex].innerText;
      this.Xheader = headerName.trim();
    },
    changeYaxis(e) {
      const headerName =
        e.target.options[e.target.options.selectedIndex].innerText;
      this.Yheader = headerName.trim();
    },
    getChartHeaderData(headerName) {
      // console.log("getChartHeaderData:", headerName);
      const headerID = this.headers.filter(
        (header) => header.value === headerName
      )[0].id;
      const headerData = [];
      this.rows.forEach((row) =>
        headerData.push(row.rowObjects[headerID].value)
      );
      // console.log("getChartHeaderData:", headerID, headerData);
      return headerData;
    },

    calculateScatterData(headerName1, headerName2) {
      const h1 = this.getChartHeaderData(headerName1);
      const h2 = this.getChartHeaderData(headerName2);
      const data = [];
      for (var i = 0; i < h1.length; i++) {
        const temp = {};
        temp["x"] = h1[i];
        temp["y"] = h2[i];
        data.push(temp);
      }
      console.log("data:", data);
      return data;
    },

    addRow() {
      const len = this.rows.length;
      if (len != 0) {
        const lastRow = this.rows[len - 1];
        const newRow = {};
        const newRowId = lastRow.id + 1;

        newRow["id"] = newRowId;

        const newRowObjects = [];

        for (var i = 0; i < this.headers.length; i++) {
          const rowObject = {};
          if (i == 0) {
            rowObject["id"] = i;
            rowObject["value"] = newRowId + 1;
            rowObject["edit"] = false;
          } else {
            rowObject["id"] = i;
            rowObject["value"] = "col" + i;
            rowObject["edit"] = false;
          }
          newRowObjects.push(rowObject);
        }
        newRow["rowObjects"] = newRowObjects;
        this.rows.push(newRow);
      } else {
        const defaultRow = {};
        defaultRow["id"] = 0;
        const newRowObjects = [];
        for (var d = 0; d < this.headers.length; d++) {
          const rowObject = {};
          if (d == 0) {
            rowObject["id"] = d;
            rowObject["value"] = d + 1;
            rowObject["edit"] = false;
          } else {
            rowObject["id"] = d;
            rowObject["value"] = "col" + d;
            rowObject["edit"] = false;
          }
          newRowObjects.push(rowObject);
        }
        defaultRow["rowObjects"] = newRowObjects;
        console.log("default row", defaultRow);
        this.rows.push(defaultRow);
      }
    },

    deleteRow() {
      this.rows.pop();
    },
    addHeader() {
      const len = this.headers.length;
      if (len != 0) {
        const newHeader = {};
        newHeader["id"] = len;
        newHeader["value"] = "header" + len;
        newHeader["edit"] = false;

        //   commit("addHeader", newHeader);
        this.addHeaderCommit(newHeader);
      } else {
        const defaultHeader = { id: 0, value: "#", edit: false };
        //   commit("addHeader", defaultHeader);
        this.addHeaderCommit(defaultHeader);
      }
    },
    addHeaderCommit(newHeader) {
      this.headers.push(newHeader);
      if (newHeader.id != 0) {
        this.rows.forEach((row) => {
          const rowObject = {};
          rowObject["id"] = newHeader.id;
          rowObject["value"] = "col" + newHeader.id;
          rowObject["edit"] = false;
          row.rowObjects.push(rowObject);
        });
      } else {
        this.rows.forEach((row, index) => {
          const rowObject = {};
          rowObject["id"] = 0;
          rowObject["value"] = index + 1;
          rowObject["edit"] = false;
          row.rowObjects.push(rowObject);
        });
      }
    },
    deleteHeader() {
      var len = this.headers.length;
      if (len !== 0) {
        //   commit("deleteHeader", state.headers[len - 1].id);
        const id = this.headers[len - 1].id;
        this.headers = this.headers.filter((header) => header.id !== id);
        this.rows.forEach((row) => row.rowObjects.pop());
      }
    },
  },
};
</script>

<style>
</style>