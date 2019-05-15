var manageProductTable;

//funcion para filtrar los select
function myPillFilter(col, id) {
    var data = document.getElementById(id).value;
    manageProductTable.columns(col).search(data).draw();

}


$(document).ready(function () {

    manageProductTable = $('#manageProductTable').DataTable({
        dom: 'Blrtip',
        'ajax': 'componentes/php/consultar_administrativos_2.php',
        "buttons": [
            {extend: 'excel',
                exportOptions: {
                    columns: [0,1, 2, 3, 4, 5]
                },
                filename: 'Usuarios'
            }
        ]

    });

    $("#borrarFiltro").click(function () {
        location.reload();
    });

//funcion para filtrar los input
    $('#inputName').on('keyup', function () {
        manageProductTable.column(0).search(this.value).draw();
    });
    //funcion para filtrar los input
    $('#inputape').on('keyup', function () {
        manageProductTable.column(1).search(this.value).draw();
    });
}); // document.ready fucntion





 