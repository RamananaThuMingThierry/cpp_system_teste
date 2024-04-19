<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Inclure Bootstrap JS (jQuery non nécessaire pour Bootstrap 5+) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Inclure SweetAlert JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script>
    // Fonction pour afficher la boîte de dialogue de confirmation de suppression
    function confirmDelete() {
        // Afficher la boîte de dialogue de confirmation de suppression avec SweetAlert
        swal({
            title: "Êtes-vous sûr ?",
            text: "Une fois supprimé, vous ne pourrez pas récupérer cet étudiant !",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
               
                swal("L'étudiant a été supprimé avec succès !", {
                    icon: "success",
                });
            } else {
                // Si l'utilisateur clique sur le bouton "Annuler" ou ferme la boîte de dialogue
                swal("Suppression annulée !");
            }
        });
    }
</script>

