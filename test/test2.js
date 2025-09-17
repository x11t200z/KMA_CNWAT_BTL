document.querySelectorAll("#left .parent > span").forEach(item => {
  item.addEventListener("click", () => {
    item.parentElement.classList.toggle("open");
  });
});
