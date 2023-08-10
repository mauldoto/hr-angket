window.onload = () => {
  let masterData = {};
  console.log(masterData.hasOwnProperty("pelayanan"));

  const kepuasan = document.querySelectorAll(".kepuasan");
  kepuasan.forEach((element) => {
    element.addEventListener("click", function () {
      let kategori = document.querySelector(".saran.active");
      if (!kategori) {
        alert("pilih kategori terlebih dahulu!");
        return;
      }

      kategori = kategori.dataset.value;

      deleteActiveClass();
      // deleteTextKepuasan();
      this.classList.add("active");

      document.querySelector("#textKepuasan" + this.dataset.id).innerHTML =
        this.dataset.text;

      masterData[kategori] = this.dataset.value;

      // console.log(masterData);
      console.log(Object.keys(masterData).length);
    });
  });

  function deleteActiveClass() {
    document.querySelectorAll(".kepuasan").forEach((element) => {
      element.classList.remove("active");
    });
  }

  function deleteTextKepuasan() {
    document.querySelectorAll(".text-kepuasan").forEach((element) => {
      element.innerHTML = "";
    });
  }

  const saran = document.querySelectorAll(".saran");
  saran.forEach((elm) => {
    elm.addEventListener("click", function () {
      saran.forEach((elmSaran) => elmSaran.classList.remove("active"));
      this.classList.add("active");

      // $(".mid-section").slideUp();
      deleteActiveClass();
      // deleteTextKepuasan();

      if (
        Object.keys(masterData).length > 0 &&
        masterData[this.dataset.value]
      ) {
        const selectedSatisfy = document.querySelector(
          '.kepuasan[data-value="' + masterData[this.dataset.value] + '"]'
        );

        selectedSatisfy.classList.add("active");
        document.querySelector(
          "#textKepuasan" + selectedSatisfy.dataset.id
        ).innerHTML = selectedSatisfy.dataset.text;
      }

      // $(".mid-section").slideDown();
    });
  });

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
};
