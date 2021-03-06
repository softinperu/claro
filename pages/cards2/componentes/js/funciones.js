var manageProductTable;

//funcion para filtrar los select
function myPillFilter(col, id) {
    var data = document.getElementById(id).value;
    manageProductTable.columns(col).search(data).draw();

}


$(document).ready(function () {

    manageProductTable = $('#manageProductTable').DataTable({
        dom: 'Blrtip',
        'ajax': 'componentes/php/cards_process.php',
        "buttons": [
            {extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5,6,7,8,9,10,11,12]
                },
                filename: 'Cards x Actividades'
            }
        ]

    });

    $("#borrarFiltro").click(function () {
        location.reload();
    });

//funcion para filtrar los input
    $('#inputTarea').on('keyup', function () {
        manageProductTable.column(1).search(this.value).draw();
    });
    //funcion para filtrar los input
    $('#inputArqui').on('keyup', function () {
        manageProductTable.column(0).search(this.value).draw();
    });
}); // document.ready fucntion



 