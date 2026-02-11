let btnSupprimer = document.querySelectorAll(".boutonSupprimer");

btnSupprimer.forEach((button) => {
    button.addEventListener("click", function (event) {
        Swal.fire({
            title: "Êtes vous sûr?",
            text: "Vous ne pourrez pas revenir en arrière!",
            icon: "warning",
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Supprimer",
            showCancelButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("delete_form_" + this.dataset.id);
                Swal.fire({
                    title: "Supprimé!",
                    text: "Ce livre a été supprimé",
                    icon: "success",
                });
            }
        });
    });
});
