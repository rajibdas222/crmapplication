$(document).ready(function () {
    console.log('Employee script ok');

    $('[data-toggle="tooltip"]').tooltip();
    //data table
    $('#approach-data').DataTable();

    //Approach data submit error script
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    //Create Approach
    $('body').on('click', '#submitForm', function (e) {
        e.preventDefault();

        var approachForm = $("#approachForm");
        var formData = approachForm.serialize();
        var approach_url = Globals.base_url+"home/employee/store";

        alert(approach_url);
        $.ajax({
            url: approach_url,

            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $('#approachModal').modal('hide');
                window.location.href = "home";
            },

            error: function (data) {
                console.log('Error',data)

            }
        });

    });








    //Export data CSV
    $(document).on('click', 'a.csv-export-data', function (){
        event.preventDefault();

        var searchIDs = $(".check-data-row:checked").map(function(){
            return $(this).attr('row_id');
        }).get();

        var approachExport = searchIDs;
        var export_url = Globals.base_url+"export_selected/"+approachExport;

        if (approachExport.length>0) {
            window.location = export_url;
        }else{
            alert("Please select the row");
            return false;
        }


    });



    //Search Filter
    $('.filterable .btn-filter').click(function () {
        var $panel = $(this).parents('.filterable'),
            $filters = $panel.find('.filters input'),
            $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });
    $('.filterable.filters input').keyup(function (e) {
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
            inputContent = $input.val().toLowerCase(),
            $panel = $input.parents('.filterable'),
            column = $panel.find('.filters th').index($input.parents('th')),
            $table = $panel.find('.table'),
            $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function () {
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="' + $table.find('.filters th').length + '">No result found</td></tr>'));
        }
    });


});

