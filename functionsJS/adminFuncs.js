
// setup table sorter
$(document).ready(
  function () {
    $("#historyTable").tablesorter({ sortList: [[0, 1]] });
    $("#customerTable").tablesorter({ sortList: [[3, 1]] });
    $("#productTable").tablesorter({ sortList: [[4, 1]] });

    $("#from").datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 2,
      onClose: function (selectedDate) {
        $("#to").datepicker("option", "minDate", selectedDate);
      }
    });
    $("#to").datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 2,
      onClose: function (selectedDate) {
        $("#from").datepicker("option", "maxDate", selectedDate);
      }
    });
  }
);