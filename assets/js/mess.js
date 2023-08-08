window.onload = () => {
  const kepuasan = document.querySelectorAll(".kepuasan");
  kepuasan.forEach((element) => {
    element.addEventListener("click", function () {
      deleteActiveClass();
      deleteTextKepuasan();
      this.classList.add("active");

      document.querySelector("#textKepuasan" + this.dataset.id).innerHTML =
        this.dataset.text;
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
      document.querySelectorAll(".saran").forEach((element) => {
        element.classList.remove("active");
      });

      this.classList.add("active");
    });
  });
};
