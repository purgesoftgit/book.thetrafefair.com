if(window.location.href != "https://www.thetradeinternational.com/get-ordered-item-and-cancelled-history" && window.location.href != "https://www.thetradeinternational.com/bar-restaurant-meeting-list" && window.location.href != "https://www.thetradeinternational.com/get-upcoming-checkin-checkout"){
  
    function updateDataTableSelectAllCtrl(table){
       var table             = table.table().node();
       var chkbox_all        = $('tbody input[type="checkbox"]', table);
       var chkbox_checked    = $('tbody input[type="checkbox"]:checked', table);
       var chkbox_select_all  = $('thead input[name="select_all"]', table).get(0);

       // If none of the checkboxes are checked
       if(chkbox_checked.length === 0){
          chkbox_select_all.checked = false;
          if('indeterminate' in chkbox_select_all){
             chkbox_select_all.indeterminate = false;
          }

       // If all of the checkboxes are checked
       } else if (chkbox_checked.length === chkbox_all.length){
          chkbox_select_all.checked = true;
          if('indeterminate' in chkbox_select_all){
             chkbox_select_all.indeterminate = false;
          }

       // If some of the checkboxes are checked
       } else {
          chkbox_select_all.checked = true;
          if('indeterminate' in chkbox_select_all){
             chkbox_select_all.indeterminate = true;
          }
       }
    }

    $(document).ready(function(){
      var rowCount = $('#myTable tbody').find('tr').length
    // Array holding selected row IDs
     var rows_selected = [];
     $('#myTable tbody').on('click', 'input[type="checkbox"]', function(e){
       $('.delete-all').prop('disabled',false)
        var row = $(this).closest('tr');
        // Get row data
        var data = table.row(row).data();

        // Get row ID
        var rowId = data[1];
        // Determine whether row ID is in the list of selected row IDs 
        var index = $.inArray(rowId, rows_selected);

        // If checkbox is checked and row ID is not in list of selected row IDs
        if(this.checked && index === -1){
           rows_selected.push(rowId);

        // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
        } else if (!this.checked && index !== -1){
           rows_selected.splice(index, 1);
        }


        $('.append-all-ids').text(rows_selected);
       
        if(this.checked){
           row.addClass('selected');
        } else {
           row.removeClass('selected');
        }

        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);

        // Prevent click event from propagating to parent
        e.stopPropagation();
     });
      if(rowCount > 1){
        
         // Handle click on checkbox

         var table = $('#myTable').DataTable({
        'columnDefs': [{
           'targets': 0,
           'searchable':false,
           'orderable':false,
           'width':'1%',
           'className': 'dt-body-center',
           'render': function (data, type, full, meta){
               return '<input type="checkbox">';
           }
        }],
        'order': [1, 'desc'],
        'rowCallback': function(row, data, dataIndex){
           // Get row ID
           var rowId = data[0];

           // If row ID is in the list of selected row IDs
           if($.inArray(rowId, rows_selected) !== -1){
              $(row).find('input[type="checkbox"]').prop('checked', true);
              $(row).addClass('selected');
           }
        }
     });
      }

      $('#myTable').on('click', 'tbody td, thead th:first-child', function(e){
        $(this).parent().find('input[type="checkbox"]').trigger('click');
     });

     // Handle click on "Select all" control
     $('thead input[name="select_all"]', table.table().container()).on('click', function(e){
       $('.delete-all').prop('disabled',false)
        if(this.checked){
           $('#myTable tbody input[type="checkbox"]:not(:checked)').trigger('click');
        } else {
           $('#myTable tbody input[type="checkbox"]:checked').trigger('click');
        }

        // Prevent click event from propagating to parent
        e.stopPropagation();
     });

    // Handle table draw event
     table.on('draw', function(){

        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
     });
     });

    ///for myTable id script end

    //payments myTable1 id scrip start

    $(document).ready(function(){
      var rowCount = $('#myTable1 tbody').find('tr').length
    // Array holding selected row IDs
     var rows_selected = [];
     $('#myTable1 tbody').on('click', 'input[type="checkbox"]', function(e){
       $('.delete-all').prop('disabled',false)
        var row = $(this).closest('tr');
        // Get row data
        var data = table.row(row).data();

        // Get row ID
        var rowId = data[1];
        // Determine whether row ID is in the list of selected row IDs 
        var index = $.inArray(rowId, rows_selected);

        // If checkbox is checked and row ID is not in list of selected row IDs
        if(this.checked && index === -1){
           rows_selected.push(rowId);

        // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
        } else if (!this.checked && index !== -1){
           rows_selected.splice(index, 1);
        }


        $('.append-all-ids1').text(rows_selected);
       
        if(this.checked){
           row.addClass('selected');
        } else {
           row.removeClass('selected');
        }

        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);

        // Prevent click event from propagating to parent
        e.stopPropagation();
     });
      if(rowCount > 1){
        
         // Handle click on checkbox

         var table = $('#myTable1').DataTable({
        'columnDefs': [{
           'targets': 0,
           'searchable':false,
           'orderable':false,
           'width':'1%',
           'className': 'dt-body-center',
           'render': function (data, type, full, meta){
               return '<input type="checkbox">';
           }
        }],
        'order': [1, 'desc'],
        'rowCallback': function(row, data, dataIndex){
           // Get row ID
           var rowId = data[0];

           // If row ID is in the list of selected row IDs
           if($.inArray(rowId, rows_selected) !== -1){
              $(row).find('input[type="checkbox"]').prop('checked', true);
              $(row).addClass('selected');
           }
        }
     });
      }

      $('#myTable1').on('click', 'tbody td, thead th:first-child', function(e){
        $(this).parent().find('input[type="checkbox"]').trigger('click');
     });

     // Handle click on "Select all" control
     $('thead input[name="select_all"]', table.table().container()).on('click', function(e){
       $('.delete-all').prop('disabled',false)
        if(this.checked){
           $('#myTable1 tbody input[type="checkbox"]:not(:checked)').trigger('click');
        } else {
           $('#myTable1 tbody input[type="checkbox"]:checked').trigger('click');
        }

        // Prevent click event from propagating to parent
        e.stopPropagation();
     });

    // Handle table draw event
     table.on('draw', function(){

        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
     });
     });
    //payments myTable1 id scrip start

    //payments myTable2 id scrip start

    $(document).ready(function(){
      var rowCount = $('#myTable2 tbody').find('tr').length
    // Array holding selected row IDs
     var rows_selected = [];
     $('#myTable2 tbody').on('click', 'input[type="checkbox"]', function(e){
       $('.delete-all').prop('disabled',false)
        var row = $(this).closest('tr');
        // Get row data
        var data = table.row(row).data();

        // Get row ID
        var rowId = data[1];
        // Determine whether row ID is in the list of selected row IDs 
        var index = $.inArray(rowId, rows_selected);

        // If checkbox is checked and row ID is not in list of selected row IDs
        if(this.checked && index === -1){
           rows_selected.push(rowId);

        // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
        } else if (!this.checked && index !== -1){
           rows_selected.splice(index, 1);
        }


        $('.append-all-ids2').text(rows_selected);
       
        if(this.checked){
           row.addClass('selected');
        } else {
           row.removeClass('selected');
        }

        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);

        // Prevent click event from propagating to parent
        e.stopPropagation();
     });
      if(rowCount > 1){
        
         // Handle click on checkbox

         var table = $('#myTable2').DataTable({
        'columnDefs': [{
           'targets': 0,
           'searchable':false,
           'orderable':false,
           'width':'1%',
           'className': 'dt-body-center',
           'render': function (data, type, full, meta){
               return '<input type="checkbox">';
           }
        }],
        'order': [1, 'desc'],
        'rowCallback': function(row, data, dataIndex){
           // Get row ID
           var rowId = data[0];

           // If row ID is in the list of selected row IDs
           if($.inArray(rowId, rows_selected) !== -1){
              $(row).find('input[type="checkbox"]').prop('checked', true);
              $(row).addClass('selected');
           }
        }
     });
      }

      $('#myTable2').on('click', 'tbody td, thead th:first-child', function(e){
        $(this).parent().find('input[type="checkbox"]').trigger('click');
     });

     // Handle click on "Select all" control
     $('thead input[name="select_all"]', table.table().container()).on('click', function(e){
       $('.delete-all').prop('disabled',false)
        if(this.checked){
           $('#myTable2 tbody input[type="checkbox"]:not(:checked)').trigger('click');
        } else {
           $('#myTable2 tbody input[type="checkbox"]:checked').trigger('click');
        }

        // Prevent click event from propagating to parent
        e.stopPropagation();
     });

    // Handle table draw event
     table.on('draw', function(){

        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
     });
     });
    //payments myTable2 id scrip start
}