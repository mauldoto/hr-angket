window.onload = () => {
  let masterData = {};

  const kepuasan = document.querySelectorAll(".kepuasan");
  kepuasan.forEach((element) => {
    element.addEventListener("click", function () {
      const kategori = this.dataset.key;

      deleteActiveClass(kategori);
      this.classList.add("active");
      document.querySelector("#textKepuasan" + this.dataset.id).innerHTML =
        this.dataset.text;

      masterData[kategori] = this.dataset.value;
    });
  });

  function deleteActiveClass(kategori) {
    document
      .querySelectorAll(".kepuasan[data-key='" + kategori + "']")
      .forEach((element) => {
        element.classList.remove("active");
      });
  }

  function deleteTextKepuasan() {
    document.querySelectorAll(".text-kepuasan").forEach((element) => {
      element.innerHTML = "";
    });
  }

  // const saran = document.querySelectorAll(".saran");
  // saran.forEach((elm) => {
  //   elm.addEventListener("click", function () {
  //     saran.forEach((elmSaran) => elmSaran.classList.remove("active"));
  //     this.classList.add("active");

  //     // $(".mid-section").slideUp();
  //     deleteActiveClass();
  //     // deleteTextKepuasan();

  //     if (
  //       Object.keys(masterData).length > 0 &&
  //       masterData[this.dataset.value]
  //     ) {
  //       const selectedSatisfy = document.querySelector(
  //         '.kepuasan[data-value="' + masterData[this.dataset.value] + '"]'
  //       );

  //       selectedSatisfy.classList.add("active");
  //       document.querySelector(
  //         "#textKepuasan" + selectedSatisfy.dataset.id
  //       ).innerHTML = selectedSatisfy.dataset.text;
  //     }

  //     // $(".mid-section").slideDown();
  //   });
  // });

  $("#formID").submit(function (event) {
    event.preventDefault();

    if (Object.keys(masterData).length < 4) {
      alert("Mohon berikan penilaian semua kategori!");
      return;
    }

    document.querySelector('input[name="submited_data"]').value =
      JSON.stringify(masterData);

    $(this)[0].submit();
  });

  document.querySelector("#loadbtn").addEventListener("click", function () {
    const date = document.querySelector("#datepicker").value;
    if (!date) {
      alert("Silakan pilih tanggal!");
      return;
    }

    document.querySelector(".table-section").innerHTML = "";

    const startDate = document.querySelector("#startDate").value;
    const endDate = document.querySelector("#endDate").value;

    getDataByRangeDate(startDate, endDate);
  });

  function getDataByDate(date) {
    const baseUrl = document.querySelector("meta[name='baseURL']").content;

    $.ajax({
      url: baseUrl + "/tamu/report?date=" + date,
      type: "get",
      success: function (results) {
        const data = JSON.parse(results);
        const dataSurvey = data.data;
        renderResults(dataSurvey);
      },
    });
  }

  function getDataByRangeDate(startDate, endDate) {
    const baseUrl = document.querySelector("meta[name='baseURL']").content;

    $.ajax({
      url:
        baseUrl + "/tamu/report?startDate=" + startDate + "&endDate=" + endDate,
      type: "get",
      success: function (results) {
        const data = JSON.parse(results);
        const dataSurvey = data.data;
        renderAllChart(dataSurvey);
        // console.log(dataSurvey);
      },
    });
  }

  $("#datepicker").daterangepicker({
    startDate: moment().subtract(1, "months"),
    endDate: moment(),
    maxDate: moment(),
    opens: "center",
    autoUpdateInput: false,
  });

  $("#datepicker").on("apply.daterangepicker", function (ev, picker) {
    $("#startDate").val(picker.startDate.format("MM/DD/YYYY"));
    $("#endDate").val(picker.endDate.format("MM/DD/YYYY"));
    $("#datepicker").val(
      picker.startDate.format("DD-MM-YYYY") +
        " - " +
        picker.endDate.format("DD-MM-YYYY")
    );
  });

  function renderResults(data) {
    const master = {
      0: "TIDAK PUAS",
      1: "CUKUP PUAS",
      2: "SANGAT PUAS",
    };

    let parentElm = "";
    data.forEach((item) => {
      let elm = "<tr>";
      elm += "<th scope='row'>" + item.TANGGAL + "</th>";
      elm += "<td>" + master[item.PELAYANAN] + "</td>";
      elm += "<td>" + master[item.HIDANGAN] + "</td>";
      elm += "<td>" + master[item.FASILITAS] + "</td>";
      elm += "<td>" + master[item.KEBERSIHAN] + "</td>";
      elm += "</tr>";

      parentElm += elm;
    });

    document.querySelector(".body-table").innerHTML = parentElm;
  }

  function renderAllChart(data) {
    const listKeys = Object.keys(data);
    listKeys.forEach((item) => {
      renderChart(data[item]);
    });
  }

  function renderChart(dataValues) {
    const parentElmChart = document.querySelector(".table-section");
    const newChartElm = document.createElement("div");
    newChartElm.classList.add(
      "col-xs-12",
      "col-md-6",
      "text-center",
      "container-chart"
    );

    let expHtml = "<h5>" + dataValues.name + "</h5>";
    expHtml +=
      '<div class="container-chart" style="width: 300px;height: 300px">';
    expHtml +=
      '<canvas class="chart-' + dataValues.name.toLowerCase() + '"></canvas>';
    expHtml += "</div>";

    newChartElm.innerHTML = expHtml;

    parentElmChart.appendChild(newChartElm);

    const data = {
      labels: ["Sangat Puas", "Cukup Puas", "Tidak Puas"],
      datasets: [
        {
          label: "Orang",
          data: [dataValues.PUAS, dataValues.CUKUPPUAS, dataValues.TIDAKPUAS],
          backgroundColor: [
            "rgb(51, 204, 51)",
            "rgb(255, 205, 86)",
            "rgb(255, 99, 132)",
          ],
          hoverOffset: 4,
        },
      ],
    };

    const pieOptions = {
      events: false,
      // animation: {
      //   duration: 500,
      //   easing: "easeOutQuart",
      //   // onComplete: function () {
      //   //   var ctx = this.chart.ctx;
      //   //   ctx.font = Chart.helpers.fontString(
      //   //     Chart.defaults.global.defaultFontFamily,
      //   //     "normal",
      //   //     Chart.defaults.global.defaultFontFamily
      //   //   );
      //   //   ctx.textAlign = "center";
      //   //   ctx.textBaseline = "bottom";

      //   //   console.log(this.data.datasets);

      //   //   // this.data.datasets.forEach(function (dataset) {
      //   //   //   for (var i = 0; i < dataset.data.length; i++) {
      //   //   //     // var model =
      //   //   //     //     dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
      //   //   //     //   total = dataset._meta[Object.keys(dataset._meta)[0]].total,
      //   //   //     //   mid_radius =
      //   //   //     //     model.innerRadius +
      //   //   //     //     (model.outerRadius - model.innerRadius) / 2,
      //   //   //     //   start_angle = model.startAngle,
      //   //   //     //   end_angle = model.endAngle,
      //   //   //     //   mid_angle = start_angle + (end_angle - start_angle) / 2;

      //   //   //     // var x = mid_radius * Math.cos(mid_angle);
      //   //   //     // var y = mid_radius * Math.sin(mid_angle);

      //   //   //     ctx.fillStyle = "#fff";
      //   //   //     if (i == 3) {
      //   //   //       // Darker text color for lighter background
      //   //   //       ctx.fillStyle = "#444";
      //   //   //     }

      //   //   //     ctx.fillText(dataset.data[i] + " Org");
      //   //   //   }
      //   //   // });
      //   // },
      // },
    };

    const config = {
      type: "pie",
      data: data,
      plugins: [ChartDataLabels],
      options: {
        plugins: {
          datalabels: {
            color: "white",
            labels: {
              value: {
                color: "white",
                font: {
                  weight: "bold",
                  size: 18,
                },
              },
            },
            formatter: function (value, context) {
              return value + " Org";
            },
          },
        },
      },
    };

    var ctx = document
      .querySelector(".chart-" + dataValues.name.toLowerCase())
      .getContext("2d");

    new Chart(ctx, config);
  }
};
