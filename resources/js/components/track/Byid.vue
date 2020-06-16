<template>
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="row page-title-header">
        <div class="col-12">
          <div class="page-header">
            <div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">
              <ul class="quick-links">
                <li>
                  <!-- <a href="#">{{perusahaan.fullname}}</a> -->
                </li>
              </ul>
              <ul class="quick-links ml-auto">
                <li>
                  <a href="#">Settings</a>
                </li>
                <li>
                  <a href="#">Analytics</a>
                </li>
                <li>
                  <a href="#">Watchlist</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <el-table
                v-loading="table.isLoading"
                :data="table.data.filter(data => !table.search 
                  || data.pesan.toLowerCase().includes(table.search.toLowerCase())
                )"
                style="width: 100%"
              >
                <el-table-column type="index" width="50"></el-table-column>
                <el-table-column prop="pesan" label="pesan" header-align="center"></el-table-column>
                <el-table-column prop="created_at" label="waktu" header-align="center"></el-table-column>
              </el-table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import urlBase from "@/js/url";
import moment from "moment";

export default {
  data() {
    return {
      id: this.$route.params.id,
      track: [],
      url: {
        pdf: urlBase.urlWeb + "/PDF"
      },
      today: moment().format("DD-MM-YYYY"),
      range: null,
      table: {
        isLoading: false,
        data: [],
        search: null
      },
      show: {
        tanggal: false,
        range: false
      },
      sort: {
        type: null,
        data: null
      },
      options: [
        {
          value: "range",
          label: "Range Tanggal"
        },
        {
          value: "Tanggal",
          label: "Tanggal"
        }
      ],
      pickerOptions: {
        shortcuts: [
          {
            text: "Minggu Lalu",
            onClick(picker) {
              const end = new Date();
              const start = new Date();
              start.setTime(start.getTime() - 3600 * 1000 * 24 * 7);
              picker.$emit("pick", [start, end]);
            }
          },
          {
            text: "Bulan Lalu",
            onClick(picker) {
              const end = new Date();
              const start = new Date();
              start.setTime(start.getTime() - 3600 * 1000 * 24 * 30);
              picker.$emit("pick", [start, end]);
            }
          },
          {
            text: "3 Bulan Terakhir",
            onClick(picker) {
              const end = new Date();
              const start = new Date();
              start.setTime(start.getTime() - 3600 * 1000 * 24 * 90);
              picker.$emit("pick", [start, end]);
            }
          }
        ]
      }
    };
  },
  mounted() {
    this.GetData(this.today);
  },
  methods: {
    SortType() {
      if (this.sort.type == "Tanggal") {
        this.show.tanggal = true;
        this.show.range = false;
      }
      if (this.sort.type == "range") {
        this.show.tanggal = false;
        this.show.range = true;
      }
    },
    moment(arg) {
      moment.locale("id");
      return moment(arg);
    },
    GetData(date) {
      this.table.isLoading = true;
      this.table.data = [];
      axios
        .post(urlBase.urlWeb + "/track", {
          type: "trackById",
          permohonan_id: this.id
        })
        .then(
          r => (
            (this.table.data = r.data),
            (this.table.isLoading = false),
            console.log(r.data)
          )
        );
    },
    GetDataByDateRange(date) {
      this.table.isLoading = true;
      axios
        .post(urlBase.urlWeb + "/perizinan/permohonan", {
          type: "dataByRange",
          date: date
        })
        .then(
          r => (
            console.log(r.data),
            (this.table.data = r.data),
            (this.table.isLoading = false)
          )
        );
    },
    edit(index, row) {
      window.location.href = urlBase.urlWeb + "/track/" + row.permohonan_id;
    },
    deleteTable(index, row) {
      this.$confirm("hapus Data ini ?", "Warning", {
        confirmButtonText: "OK",
        cancelButtonText: "Cancel",
        type: "warning"
      })
        .then(() => {
          axios
            .post(urlBase.urlWeb + "/master/aclGroup", {
              type: "hapus",
              aclId: row.aclGroup_id
            })
            .then(r => this.GetModulGroup());
        })
        .catch(() => {
          this.$message({
            type: "info",
            message: "Delete canceled"
          });
        });
    }
  }
};
</script>
