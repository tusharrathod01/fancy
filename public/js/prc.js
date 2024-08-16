
  //   // $( "#partys" ).autocomplete({  
  //   //    source: [  
  //   //     "AVIRAT INFO",
  //   //     "OUTSIDE",
  //   //     "INTRA",
  //   //     "EXTRA",
  //   //     "MEMO",
  //   //     "PF",
  //   //    ]
  //   // }); 
    
  //   // $( ".refno" ).autocomplete({  
  //   //     source: [  
  //   //      "1",
  //   //      "2",
  //   //      "3",
  //   //      "4",
  //   //      "5",
  //   //      "6",
  //   //      "7",
  //   //     ],
  //   //     change: function( event, ui ) {
  //   //         alert("Change Event Triggered");
  //   //     }
  //   //  }); 
  //   //  $(document).ready( function() {
  //   //         var now = new Date();
  //   //         var today = now.getFullYear() + '-' + (now.getMonth() + 1) + '-' + now.getDate();
  //   //         $('#datepicker').val(today);
  //   //         $('#overdue').val(today);
  //   //         $('#duedate').val(today);
  //   //       });
  //   // $(document).ready( function() {
  //   //     var now = new Date();
  //   //     var today = now.getFullYear() + '-' + (now.getMonth() + 1) + '-' + now.getDate();
  //   //     $('#date').val(today);
  //   //   });
  //   // $(document).ready( function() {
  //   //     var now = new Date();
  //   //     var today = now.getFullYear() + '-' + (now.getMonth() + 1) + '-' + now.getDate();
  //   //     $('#duedate').val(today);
  //   //   });
  //   //   $(document).ready( function() {
  //   //     var now = new Date();
  //   //     var today = now.getFullYear() + '-' + (now.getMonth() + 1) + '-' + now.getDate();
  //   //     $('#overdue').val(today);
  //   //   });
  //     (function($, window, document, undefined){
  //       $("#overdueno").on("change", function(){
  //          var date = new Date($("#overdue").val()),
  //              days = parseInt($("#overdueno").val(), 10);


               
  //           console.log(date);
  //           // if(!isNaN(date.getTime())){
  //               date.setDate(date.getDate() + days);
  //               var first_date = moment(date).format('DD-MM-YYYY');  
  //               $("#overdue").val(first_date);
  //           // } else {
  //           //     alert("Invalid Date");  
  //           // }
  //       });
        
  //       //From: http://stackoverflow.com/questions/3066586/get-string-in-yyyymmdd-format-from-js-date-object
  //       Date.prototype.toInputFormat = function() {
  //          var yyyy = this.getFullYear().toString();
  //          var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
  //          var dd  = this.getDate().toString();
  //          return (dd[1]?dd:"0"+dd[0]) + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + yyyy; // padding
  //       };
  //   })(jQuery, this, document);

  //   (function($, window, document, undefined){
  //     $("#dueno").on("change", function(){
  //        var date = new Date($("#duedate").val()),
  //            days = parseInt($("#dueno").val(), 10);
         
  //       //   if(!isNaN(date.getTime())){
  //             date.setDate(date.getDate() + days);
  //             var duedate = moment(date).format('DD-MM-YYYY');  
  //             $("#duedate").val(duedate);
  //       //   } else {
  //       //       alert("Invalid Date");  
  //       //   }
  //     });
      
  //     //From: http://stackoverflow.com/questions/3066586/get-string-in-yyyymmdd-format-from-js-date-object
  //     Date.prototype.toInputFormat = function() {
  //        var yyyy = this.getFullYear().toString();
  //        var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
  //        var dd  = this.getDate().toString();
  //        return yyyy + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + (dd[1]?dd:"0"+dd[0]); // padding
  //     };
  // })(jQuery, this, document);
      