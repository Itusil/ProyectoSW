function cambiar(email){
Swal.fire({
  title: '¿Estás seguro de querer cambiar el estado de este usuario?',
  showDenyButton: true,
  showCancelButton: false,
  confirmButtonText: `Si`,
  denyButtonText: `No`,
}).then((result) => {
  if (result.isConfirmed) {
		window.location.href = "ChangeUserState.php?email="+email;
  } else if (result.isDenied) {
  }
})
}

function borrar(email){
Swal.fire({
  title: '¿Estás seguro de querer borrar este usuario?',
  showDenyButton: true,
  showCancelButton: false,
  confirmButtonText: `Si`,
  denyButtonText: `No`,
}).then((result) => {
  if (result.isConfirmed) {
		window.location.href = "RemoveUser.php?email="+email;
  } else if (result.isDenied) {
  }
})
}