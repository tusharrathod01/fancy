
  var availablePartys = [
    "AVIRAT INFO",
    "OUTSIDE",
    "INTRA",
    "EXTRA",
    "MEMO",
    "PF",
  ];
  $( "#partys" ).autocomplete({
    source: availablePartys
  });


  $('#reservationdate').datetimepicker({
    format: 'L',
});

  $(document).ready( function() {
    var now = new Date();
    var today = now.getFullYear() + '-' + (now.getMonth() + 1) + '-' + now.getDate();
    $('#reservationdate').val(today);
});

