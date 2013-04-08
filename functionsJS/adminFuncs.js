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
        refreshTable();
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
        refreshTable();
      }
    });
  }
);

// reinit tables after ajax
$(document).ajaxStop(function () {
  $("#historyTable").tablesorter({ sortList: [[0, 1]] });
  $("#customerTable").tablesorter({ sortList: [[3, 1]] });
  $("#productTable").tablesorter({ sortList: [[4, 1]] });

  $("#tableView").fadeIn();
});

// table refresh
function refreshTable() {
  $("#tableView").fadeOut();
  reloadHistory($("#o").val());
  // table fades in at ajax completion
}

// grab history with new dates
function reloadHistory(opt) {
  var link = "/functionsPHP/historyService";
  var f = $("#hf").val();
  var t = $("#ht").val();

  $.post(link, { opt: opt, from: f, to: t },
    function (data) {
      $("#tableView").html(data);
    }
  );
}