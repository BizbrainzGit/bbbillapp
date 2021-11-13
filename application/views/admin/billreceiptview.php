<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/adminLayout_Header.php');
?>



     

<div class="main-panel">
<div class="content-wrapper" >
  <!-- <div class="content-wrapper receipt-class" style="display: none;" > -->
  <div id='printarea1'>
 
          <div class="row">
            <div class="col-12">

              <div class="card">
                <div class="card-body">
                  <div class="row grid-margin">
                    <div class="col-12">
                    	<div class="header"> </div>
                     </div>
                   

                     <div class="col-12">
                      
                      <div style="border: 2px solid;padding: 5px;border-radius: 12px;">
                           <div class="row clearfixed">


                       <div class="col-sm-12" >
                        <div class="row">
                          <div class="col-sm-4" >  </div>
                        

                        <div class="col-sm-7 form-group" style="text-align: ;"> <h2 style="padding-top: 10px">Customer Receipt</h2>   </div>

                        <div class="col-sm-1"> 
                          <div class="row">
                           <div><button type="button" class="btn btn-info btn-sm" id='babubtn' value='Print'> Print </button></div>
                            <div><button type="button" class="btn btn-info btn-sm" id='babubtn1' value='PDF'> PDF </button></div>
                          </div>  
                       </div>
                       
                        </div> 
                        <hr>
                        </div>
                        
                         

                         <div class="col-sm-2">
                          <label >S.No. :</label>
                        </div>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" placeholder="" name="" id="" >
                        </div>
                        
                        <div class="col-sm-2">
                          <label >Date :</label>
                        </div>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" placeholder="" name="" id="" >
                        </div>

                        <div class="col-sm-2">
                          <label >Business Name :</label>
                        </div>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" placeholder="" name="" id="" >
                        </div>

                        <div class="col-sm-2">
                          <label >Address :</label>
                        </div>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" placeholder="" name="" id="" >
                        </div>

                        <div class="col-sm-2">
                          <label >City :</label>
                        </div>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" placeholder="" name="" id="" >
                        </div>
                         
                        <div class="col-sm-2">
                          <label >Pincode :</label>
                        </div>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" placeholder="" name="" id="" >
                        </div>

                        <div class="col-sm-2">
                          <label >Contact Person :</label>
                        </div>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" placeholder="" name="" id="" >
                        </div>

                        <div class="col-sm-2">
                          <label >Contact Number:</label>
                        </div>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" placeholder="" name="" id="" >
                        </div>

                        <div class="col-sm-2">
                          <label >Authorized Person :</label>
                        </div>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" placeholder="" name="" id="" >
                        </div>

                        <div class="col-sm-2">
                          <label >Designation :</label>
                        </div>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" placeholder="" name="" id="" >
                        </div>

                        
                        <div class="col-sm-2">
                          <label >Mobile Number :</label>
                        </div>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" placeholder="" name="" id="" >
                        </div>
                                              
                        <div class="col-sm-2">
                          <label >Email ID :</label>
                        </div>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" placeholder="" name="" id="" >
                        </div>


                        <div class="col-sm-6">
                        <div class="row">
                          <div class="col-sm-12" >
                        <div style="margin-left: 5px;">
                           <label >Authorised Sigatory & Stamp:</label>
                        </div>
                        <div class="col-sm-12">
                          <div style="height: 250px;background-color: ;border: 1px solid;border-radius: 12px;"><p style="padding: 5px 5px 0px 5px;text-align: justify;">The undersigned has read, understood and accepted the Terms of Service, Basic Terms & Conditions(mentioned at the back ofcustomer receipt) including the contents of ECS / CCSI I NACH MANDATE FORM and other documents forming partof the contract </p><hr></div>
                        </div>
                        </div>
                        

                        <div class="col-sm-12">
                          <div style="padding: 10px 0px 0px 15px;text-align: justify;"><p>Advertiser/Signatory confirms that he/she has been explained about the services/product's. Advertiser/Signatory confirms that the Terms of Services and Basic Terms Executive Signature& Conditions (See: Back of Customer Receipt) including the Arbitration Clause hasalso been thoroughly explained in vernacular language by the executive concerned, the Terms of Service & Basic Terms & Conditions including the Arbitration Clause areagreed and accepted by the Advertiser/Signatory. The Advertiser/Signatory confirms the receipt of the electronic copy of Terms of Service/ Basic Terms & Conditions. The terms of service is also available at http://www.bizbrainz.in/Terms-of-Use.</p></div>
                        </div> 
                        </div> 
                        </div>
                      
                      

                         <div class="col-sm-6">
                          <div style="background-color: ;border: 1px solid;border-radius: 12px;"><h4 style="text-align: center;padding: 10px 0px 10px 0px ; background-color: gray;border-radius: 12px 12px 0px 0px;">PAYMENT DETAILS</h4>
                            <div class="row" style="padding-left: 5px;">
                           <div class="col-sm-4"> <p>Total Payment Recived :</p>   </div>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="" name="" id="" >
                        </div>
                        </div>

                        <div class="row" style="padding-left: 5px;">
                           <div class="col-sm-4"> <p>In Words :</p>  </div>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="" name="" id="" >
                        </div>
                        </div>

                         <div class="row" style="padding-left: 5px;">
                           <div class="col-sm-3">  <p>Payment Methode :</p>  </div>
                        <div class="col-sm-9">
                          <div class="row" id="receiptpayment">
                       </div>
                        <!-- <div class="col-sm-3">
                          <input type="checkbox" class="" placeholder="" name="" id="" >
                          <span style="font-size: 13px;">Cash</span>
                          </div>
                        <div class="col-sm-4">
                          <input type="checkbox" class="" placeholder="" name="" id="" >
                          <span style="font-size: 13px;">Cheque</span>
                         </div>
                        <div class="col-sm-5">
                          <input type="checkbox" class="" placeholder="" name="" id="" >
                          <span style="font-size: 13px;">Net Banking</span>
                        </div>
                        <div class="col-sm-3">
                          <input type="checkbox" class="" placeholder="" name="" id="" >
                          <span style="font-size: 13px;">UPI</span>
                        </div>
                        <div class="col-sm-4">
                          <input type="checkbox" class="" placeholder="" name="" id="" >
                          <span style="font-size: 13px;">Debit Card</span>
                        </div>
                        <div class="col-sm-5">
                          <input type="checkbox" class="" placeholder="" name="" id="" >
                          <span style="font-size: 13px;">Creadit Card</span>
                        </div> -->
                                                </div>
                        </div>

                        <div class="row" style="padding-left: 5px;">
                           <div class="col-sm-4">  <p>Bank Name :</p>   </div>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="" name="" id="" >
                        </div>
                        </div>

                        <div class="row" style="padding-left: 5px;">
                           <div class="col-sm-2">  <p>Date :</p>   </div>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" placeholder="" name="" id="" >
                        </div>

                         <div class="col-sm-2">  <p>Cheque No. :</p>   </div>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" placeholder="" name="" id="" >
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-sm-6" >
                        <div style="">
                          <div class="row" style="padding-left: 5px;">
                           <div class="col-sm-4">  <p>TME Name :</p>   </div>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="" name="" id="" >
                        </div>
                        </div>

                        <div class="row" style="padding-left: 5px;">
                           <div class="col-sm-4">  <p>TME Code :</p>   </div>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="" name="" id="" >
                        </div>
                        </div>

                        <div class="row" style="padding-left: 5px;">
                           <div class="col-sm-4">  <p>EXE Name :</p>   </div>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="" name="" id="" >
                        </div>
                        </div>

                        <div class="row" style="padding-left: 5px;">
                           <div class="col-sm-4">  <p>EXE Code :</p>   </div>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" placeholder="" name="" id="" >
                        </div>
                        </div>

                        </div> 
                        </div>

                        <div class="col-sm-6">
                          <div class="row" >
                           <div class="col-sm-12">
                          <div>Executive Signature :</div>
                        </div>
                        <div class="col-sm-11" style="height: 175px; border: 1px solid;border-radius: 12px;">
                          
                        </div>
                        </div>
                        </div>

                       </div>

                      </div>
                    </div>
                        
                      </div>
                    </div>

                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>




 
       
         
<?php
include('Layouts/adminLayout_Footer.php');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
<script type="text/javascript">
  
  $("#babubtn").click(function () {
    var divToPrint = document.getElementById('printarea1');
    var htmlToPrint = '' +
        '<style type="text/css">' +
        'table th, table td {' +
        'border:1px solid #000;' +
        'padding;0.5em;' +
        '}' +
        '</style>';

    htmlToPrint += divToPrint.outerHTML;
    var printWindow = window.open('', '', 'height=400,width=800');
    printWindow.document.write('<html><head><title>Receipt</title>');
    printWindow.document.write('<link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/css/vendor.bundle.base.css">');
    printWindow.document.write('<link rel="stylesheet"  href="/<?php echo base_url();?>assets/css/vertical-layout-light/style.css">');
    printWindow.document.write('<link rel="stylesheet" href="/<?php echo base_url();?>assets/css/custom.css">');
    printWindow.document.write('</head><body >');
    printWindow.document.write(htmlToPrint);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
    

    
});
  

// function DownloadExcel(link) {
//   var url = base_url+link;
//   window.open(url, '_blank');
// }
// $("#babubtn1").click(function () {
//     var divToPrint = document.getElementById('printarea1');
//     var htmlToPrint = '' +
//         '<style type="text/css">' +
//         'table th, table td {' +
//         'border:1px solid #000;' +
//         'padding;0.5em;' +
//         '}' +
//         '</style>';

//     htmlToPrint += divToPrint.outerHTML;
//      DownloadExcel(htmlToPrint);
//      return false;


// });



var doc = new jsPDF();
var specialElementHandlers = {
    '#editor': function (element, renderer) {
        return true;
    }
};

$('#babubtn1').click(function () {

    // doc.addCss('<link rel="stylesheet"  href="/<?php echo base_url();?>assets/css/vertical-layout-light/style.css">');
    // doc.addCss('<link rel="stylesheet" href="/<?php echo base_url();?>assets/css/custom.css">');
    doc.fromHTML($('#printarea1').html(), 15, 15, {
        
            'elementHandlers': specialElementHandlers
           
    });

    doc.save('sample-file.pdf');
});


</script>

<!-- <script>
    // here we will write our custom code for printing our div
    $(function(){
      $('#babubtn').click(function () {
        alert("kk");
                //Print ele2 with default options
                newWin = window.open("");
    newWin.document.write('<link rel="stylesheet"  href="/<?php echo base_url();?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">');
   newWin.document.write('<link rel="stylesheet"  href="/<?php echo base_url();?>assets/css/vertical-layout-light/style.css">');
                $.print("#printarea1");
            });
   });
  </script> -->