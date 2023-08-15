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

    console.log(date);
    getDataByDate(date);
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

  $("#datepicker").datepicker();

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
};
