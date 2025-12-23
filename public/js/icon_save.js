function toggleSave(event, btn) {
  event.stopPropagation(); // không trigger click card

  btn.classList.toggle("saved");

  const icon = btn.querySelector("i");
  if (btn.classList.contains("saved")) {
    icon.classList.remove("fa-regular");
    icon.classList.add("fa-solid");
  } else {
    icon.classList.remove("fa-solid");
    icon.classList.add("fa-regular");
  }
}