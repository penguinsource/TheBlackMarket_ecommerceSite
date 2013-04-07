// setup table sorter
$(document).ready(
  function () {
    $("#historyTable").tablesorter({ sortList: [[0, 1]] });
    $("#customerTable").tablesorter({ sortList: [[3, 1]] });
    $("#productTable").tablesorter({ sortList: [[4, 1]] });

    $("#from").datepicker({
      changeMonth: true,
      numberOfMonths: 2,
      dateFormat: "yy-mm-dd",
      defaultDate: -7,
      onClose: function (selectedDate) {
        $("#to").datepicker("option", "minDate", selectedDate);
        $("#hf").val($("#from").val());
      }
    });
    $("#to").datepicker({
      changeMonth: true,
      numberOfMonths: 2,
      dateFormat: "yy-mm-dd",
      defaultDate: 0,
      onClose: function (selectedDate) {
        $("#from").datepicker("option", "maxDate", selectedDate);
        $("#ht").val($("#to").val());
      }
    });
  }
);


function refreshTable(from, to) {
  var func = '<?php printStats($con, $opt, ';
  func += (from != null) ? '"' + from + '", ' : "null, ";
  func += (to != null) ? '"' + to + '"' : "null";
  func += '); ?>';

  alert(func);

  document.getElementById('tableView').innerHTML = func;
}


// toggle the date range selection
function toggleDate() {
  $("#dateSelect").slideToggle();
}

// redirect
function reloadPage(opt) {
  var f = $("#hf").val();
  var t = $("#ht").val();

  var link = "admin?opt=" + opt;
  link += (f != null) ? "&from=" + f : "";
  link += (t != null) ? "&to=" + f : "";

  location.replace(link);

  return false;
}