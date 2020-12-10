/* Variables */
var table;
var num_itens


/* Create Datatable */
$(document).ready(function () {
    table = $('#historyTable').DataTable({
        "aLengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "Todas"]
        ],
        "orderClasses": false,
        "order": [[ 3, "desc" ]]
    });

    num_itens = table.data().count() / 7
});

/* Event to draw circle */
$('#historyTable').on('draw.dt', function () 
{
    $('#historyTable').ready(function () 
    {
        $(function () 
        {
            if (num_itens > 0) 
            {
                table.rows({search:'applied'}).every(function ( rowIdx, tableLoop, rowLoop ) 
                {
                    var rowNode = this.node();
                     
                    $(rowNode).find("td:visible").each(function ()
                    {
                        id = '#sellPerCirc' + rowIdx
                        percentage = parseFloat(table.row(rowIdx).data()[2])
                        perCircIterative($(id), percentage)

                        return false;
                    });
                });
            }
            else
            {
                $('tr:odd').css('background-color', 'white');
            }

            /* background color white when filter is empty */
            if(table.$('tr', {"filter":"applied"}).length == 0)
            {
                $('tr:odd').css('background-color', 'white');
            }
        })
    });
});

/* Drawing Circle with percentage */
var flag = false;
function perCircIterative($id, percentage) {
    if(percentage < 1)
        percentage = 1
    
    percentage = (percentage * 360) / 100

    for(var i = 0; (i < percentage); ++i)
    {
        curr = (100 * i) / 360;
        if (i <= 180) {
            if(percentage > 180)
                $id.css('background-color', '#b21b18');
            $id.css('background-image', 'linear-gradient(' + (90 + i) + 'deg, transparent 50%, #ccc 50%),linear-gradient(90deg, #ccc 50%, transparent 50%)');
        } else {
            $id.css('background-color', '#b21b18');
            $id.css('background-image', 'linear-gradient(' + (i - 90) + 'deg, transparent 50%, #b21b18 50%),linear-gradient(90deg, #ccc 50%, transparent 50%)');
        }
    }
}


/* URL to delete classification */
$('#deleteURL').click(function(){ getDeleteURL();});

function getDeleteURL() {  
    window.location.href = "backend/delete.php?id=" + id;
}

$(document).on("click", ".deleteModal", function () {
    id = $(this).data('id');
});