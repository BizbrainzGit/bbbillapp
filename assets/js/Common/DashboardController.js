








EmplyeesaleReportviewListData();   
function EmplyeesaleReportviewListData(){
    $.ajax({
    type : 'GET',
    url : url+"DashboardController/EmployeeSaleReportsList",
    async : true,
    dataType : 'json',
    success : function(result){
      if(result.success===true){
        EmplyeesaleReportViewList(result.data)
        $("#alltotalsalesemployeewise_monthname").html(result.monthview);
      } 

    }
    });
}

 function EmplyeesaleReportViewList(salereportlist){

   if ( $.fn.DataTable.isDataTable('#employeesalereporttable')) {
         $('#employeesalereporttable').DataTable().destroy();
         }  
         $('#employeesalereporttable tbody').empty();
          var data=salereportlist;
         var table = $('#employeesalereporttable').DataTable({
         paging: true,
         searching: true,
         columns: [
      {data: 'package_created_name',title: 'Employee Name'},
      //{data: 'gstgrand_total_amount',title:'Package Amount'},
      {data: 'transaction_amount',title:'Collected Amount'},
      {data: 'withouttransaction_amount',title:'Collected Amount <br> (With Out GST)'}, 
           ] 
       });
 
table.rows.add(data).draw();
 
 }


 function AllSalesEmployeewiseData(list){
  var id= list;
 $.ajax({
    type: "GET",
    url:url+'DashboardController/EmployeeSaleReportsListByMonth/'+id,
    dataType: 'json',
  success:function(result){
      if(result.success==true)
      {
             EmplyeesaleReportViewList(result.data)
             $("#alltotalsalesemployeewise_monthname").html(result.monthview);
             
       }else{
            alert('request failed', 'error');
      }

    },
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});

}


ProjectviewListData();   
function ProjectviewListData(){
    $.ajax({
    type : 'GET',
    url : url+"DashboardController/ProjectList",
    async : true,
    dataType : 'json',
    success : function(result){
      if(result.success===true){
        ProjectViewList(result.data)
      } 

    }
    });
}

 function ProjectViewList(projectlist){

   if ( $.fn.DataTable.isDataTable('#projectslisttable')) {
         $('#projectslisttable').DataTable().destroy();
         }  
         $('#projectslisttable tbody').empty();
          var data=projectlist;
         var table = $('#projectslisttable').DataTable({
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'S No'},
      {data: 'business_id',title:'Project ID'},
      {data: 'package_name',title:'Package Name'}, 
      {data: 'campaign_name',title:'Campaign Name'}, 
      {data: 'company_name',title:'Project Name'},
      {data: 'person_name',title: 'Client Name'},
      {data: 'mobile_no',title: 'Mobile No.'},
      {data: 'tele_name',title: 'TME Name.'},
      {data: 'marketing_name',title: 'ME Name.'},
      {data: 'status',title: 'Project Status'},
           ] 
       });
 
table.rows.add(data).draw();
 
 }

viewAllSales();   
function viewAllSales(){
            $.ajax({
                type  : 'GET',
                url   : url+"DashboardController/AllSalesListForDashboard",
                async : true,
                dataType : 'json',
                success : function(result){
     if(result.success==true){
       
         var a= result.offlinesale ;
         var b= result.onlinesale ;
         var c= result.paymenttypesale
       Allsalesindashboard(a,b,c) ;
      

              }        
                }
            });
        }


  function Allsalesindashboard(data1,data2,data3){

       if(data1[0].totalamount!=0 && data1[0].totalamount!=null){
                   var offline_amount= data1[0].totalamount;
        }else{
                 var offline_amount= 0;
        }
        $('#offline_totalamount').html(offline_amount);

         if(data2[0].totalamount!=0 && data2[0].totalamount!=null){
                   var online_amount= data2[0].totalamount;
        }else{
                 var online_amount= 0;
        }
        $('#online_totalamount').html(online_amount);
       var data = data3;
       var items = "";
       var i;
       var n = data.length;

    for(i=0;i<n;i++){
        items+='<div class="row m-2"> <div class="col-6 col-sm-6 mt-2"><div class="d-flex purchase-detail-legend align-items-center"><h5 class="font-weight-height">'+data[i].paymenttype_name+'</h5></div></div><div class="col-6 col-sm-6mt-2"><div class="d-flex purchase-detail-legend align-items-center"><h5 class="font-weight-heigh text-primary"><span class="rupeesymbole">₹</span>'+data[i].totalamount+'</h5></div></div></div>'
         }

   $("#alltypepayment_totalamountsales").html(items);
  
  }
                                    
function AllSalesData(list){
  var id= list;
 $.ajax({
    type: "GET",
    url:url+'DashboardController/AllSalesListForDashboardByMonth/'+id,
    dataType: 'json',
  success:function(result){
      if(result.success==true)
      { 
         var a= result.offlinesale ;
         var b= result.onlinesale ;
         var c= result.paymenttypesale
         Allsalesindashboard(a,b,c) ;

       }else{
            alert('request failed', 'error');
      }

    },
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});

}


viewAllAppointment();   
function viewAllAppointment(){
            $.ajax({
                type  : 'GET',
                url   : url+"DashboardController/AllAppointmentForDashboard",
                async : true,
                dataType : 'json',
                success : function(result){
     if(result.success==true){
        
       var items = 0;
          if(result.userrole=="Marketing"){
             
              items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.todayappt+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-success">Today Appointments</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.totalappt+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-success">Total Appointments</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';
            
              $('#todayappointment_notification').html(result.todayappt);


          }else if(result.userrole=="Marketing-Lead"){
              
              items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.alltodayappt+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-success">Today Team Appointments</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.alltotalappt+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-success">Total Team Appointments</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.todayappt+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-success">Today Appointments</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.totalappt+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-success">Total Appointments</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';

              $('#todayappointment_notification').html(result.todayappt); 

                // if(result.todayappt>=0){
                //    alert(result.todayappt);
                // }
          
          }else if(result.userrole=="Tele-Marketing"){

             items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.todayappt+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-success">Today Appointments</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.totalappt+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-success">Total Appointments</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';

          }else{
             items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.todayappt+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-success">Today Appointments</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.totalappt+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-success">Total Appointments</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';
          }


      
        $("#allappointment_viewdashboard").html(items);
              }        
                }
            });
        }




function AllAppointmentsData(list){
  var id= list;
 $.ajax({
    type: "GET",
    url:url+'DashboardController/AllAppointmentListForDashboardByMonth/'+id,
    dataType: 'json',
  success:function(result){
      if(result.success==true)
      { 
         
          var items = 0;
          if(result.userrole=="Marketing"){
             
             items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.totalappt+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-success">Total Appointments</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';

          }else if(result.userrole=="Marketing-Lead"){
             
             items='<div class="carousel-item active"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.alltotalappt+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-success">Total Team Appointments</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.totalappt+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-success">Total Appointments</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';

          }else if(result.userrole=="Tele-Marketing"){

             items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.totalappt+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-success">Total Appointments</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';

          }else{
             items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.totalappt+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-success">Total Appointments</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';
          }

        $("#allappointment_viewdashboard").html(items);

       }else{
            alert('request failed', 'error');
      }

    },
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});

}

viewDashboardAllDealclose();   
function viewDashboardAllDealclose(){
            $.ajax({
                type  : 'GET',
                url   : url+"DashboardController/AllDealcloseForDashboard",
                async : true,
                dataType : 'json',
                success : function(result){
     if(result.success==true){
             var items = 0;
          if(result.userrole=="Marketing"){
             
              items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.todaydealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Today Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.totaldealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';


          }else if(result.userrole=="Marketing-Lead"){
              
              items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.alltodaydealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Today Team Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.alltotaldealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Team Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.todaydealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Today Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.totaldealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';

          }else if(result.userrole=="Tele-Marketing"){

             items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.todaydealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Today Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.totaldealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';

          }else{
             items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.todaydealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Today Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.totaldealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';
          }


      
        $("#alldealclose_viewdashboard").html(items);
              }        
                }
            });
        }

function AllDealcloseData(list){
  var id= list;
  
 $.ajax({
    type: "GET",
    url:url+'DashboardController/AllDealcloseListForDashboardByMonth/'+id,
    dataType: 'json',
  success:function(result){
      if(result.success==true)
      { 
         
          var items = 0;
          if(result.userrole=="Marketing"){
             
             items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.totaldealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';

          }else if(result.userrole=="Marketing-Lead"){
             
             items='<div class="carousel-item active"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_dealcloses">'+result.alltotaldealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Team Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_dealcloses">'+result.totaldealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';

          }else if(result.userrole=="Tele-Marketing"){

             items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.totaldealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';

          }else{
             items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.totaldealclose+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Dealclose</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';
          }

        $("#alldealclose_viewdashboard").html(items);

       }else{
            alert('request failed', 'error');
      }

    },
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});

}



viewDashboardAllMonthlySales();   
function viewDashboardAllMonthlySales(){
            $.ajax({
                type  : 'GET',
                url   : url+"DashboardController/AllMonthlySalesForDashboard",
                async : true,
                dataType : 'json',
                success : function(result){
     if(result.success==true){
             var items = 0;
          if(result.userrole=="Marketing"){
             
              items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.todaymonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Today Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.totalmonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';


          }else if(result.userrole=="Marketing-Lead"){
              
              items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.alltodaymonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Today Team Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.alltotalmonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Team Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.todaymonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Today Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.totalmonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';

          }else if(result.userrole=="Tele-Marketing"){

             items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.todaymonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Today Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.totalmonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';

          }else{
             items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.todaymonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Today Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_appts">'+result.totalmonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';
          }

        $("#allmonthlysales_viewdashboard").html(items);
              }        
                }
            });
        }
function AllMonthlySalesData(list){
  var id= list;
 $.ajax({
    type: "GET",
    url:url+'DashboardController/AllMonthlySalesListForDashboardByMonth/'+id,
    dataType: 'json',
  success:function(result){
      if(result.success==true)
      { 
         
          var items = 0;
          if(result.userrole=="Marketing"){
             
             items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.totalmonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';

          }else if(result.userrole=="Marketing-Lead"){
             
             items='<div class="carousel-item active"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_monthlysaless">'+result.alltotalmonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Team Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div><div class="carousel-item"><div class="mb-3 text-center" ><h2 class="mr-3"><span id="total_monthlysaless">'+result.totalmonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';

          }else if(result.userrole=="Tele-Marketing"){

             items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.totalmonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';

          }else{
             items='<div class="carousel-item active"><div class="mb-3 text-center"><h2 class="mr-3"><span id="">'+result.totalmonthlysales+'</span></h2></div><div class="mb-3 text-center"><h4 class="text-primary">Total Sales</h4></div><button class="btn btn-warning m-8 btn-outline-secondary btn-sm btn-icon-text d-flex align-items-center"><i class="mdi mdi-calendar mr-1"></i><span class="text-left">'+result.monthview+'</span></button></div>';
          }

        $("#allmonthlysales_viewdashboard").html(items);

       }else{
            alert('request failed', 'error');
      }

    },
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }

});

}



viewDashboardAllCitywiseSales();   
function viewDashboardAllCitywiseSales(){
            $.ajax({
                type  : 'GET',
                url   : url+"DashboardController/AllSalesForDashboardByCitywise",
                async : true,
                dataType : 'json',
                success : function(result){
     if(result.success==true){
          
       var data =result.data;
       var items = "";
       var i;
       var n = data.length;
    for(i=0;i<n;i++) {
        items+='<div class="row mt-2  d-sm-flex"><div class="col-6 col-sm-6 text-left"><h5>'+data[i].cityname+'</h5></div><div class="col-6 col-sm-6 text-left"><h5>'+data[i].totalamount+'</h5> </div></div>'
         }
    
     
      var data1 =result.todaycitywisesales;
         if((data1.length)>0){
       var items1 = "";
       var j;
       var n = data1.length;
     for(j=0;j<n;j++) {
        items1+='<div class="row mt-2  d-sm-flex"> <div class="col-6 col-sm-6 text-left"><h5>'+data1[j].cityname+'</h5></div><div class="col-6 col-sm-6 text-left"><h5>'+data1[j].totalamount+'</h5> </div></div>'
         }
         }else{
          items1='<div class="row mt-2  d-sm-flex"> <div class="col-6 col-sm-6 text-left"><h5></h5></div><div class="col-6 col-sm-6 text-left"><h5> 0 </h5> </div></div>'
         }

   $("#alltotalsalescitywise_monthname").html(result.monthview);
   $("#alltotalsalescitywise").html(items);
   $("#todaytotalsalescitywise").html(items1);
       
              }        
                }
            });
        }

function AllSalesCitywiseData(list){
  
   $(".class-hide").hide();
  var id= list;
 $.ajax({
    type: "GET",
    url:url+'DashboardController/AllSalesForDashboardByCitywiseMonth/'+id,
    dataType: 'json',
  success:function(result){
      if(result.success==true)
      {
               var data =result.data;
               var items = "";
               var i;
               var n = data.length;

            for(i=0;i<n;i++) {
                items+='<div class="row mt-2  d-sm-flex"><div class="col-6 col-sm-6 text-left"><h5>'+data[i].cityname+'</h5></div><div class="col-6 col-sm-6 text-left"><h5>'+data[i].totalamount+'</h5> </div></div>'
                 }
   
             $("#alltotalsalescitywise_monthname").html(result.monthview);
             $("#alltotalsalescitywise").html(items);

       }else{
            alert('request failed', 'error');
      }

    },
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});

}




viewDashboardAllCitywiseAppointments();   
function viewDashboardAllCitywiseAppointments(){
            $.ajax({
                type  : 'GET',
                url   : url+"DashboardController/AllAppointmentsForDashboardByCitywise",
                async : true,
                dataType : 'json',
                success : function(result){
     if(result.success==true){
      var data1 =result.todaycitywiseappointments;
         if((data1.length)>0){
       var items1 = "";
       var j;
       var n = data1.length;
     for(j=0;j<n;j++) {
        items1+='<div class="row mt-2  d-sm-flex"> <div class="col-6 col-sm-6 text-left"><h5>'+data1[j].cityname+'</h5></div><div class="col-6 col-sm-6 text-left"><h5>'+data1[j].totalappointments+'</h5> </div></div>'
         }
         
         }else{
          items1='<div class="row mt-2  d-sm-flex"> <div class="col-6 col-sm-6 text-left"><h5></h5></div><div class="col-6 col-sm-6 text-left"><h5> 0 </h5> </div></div>'
         }

   $("#alltotalappointmentscitywise_monthname").html(result.monthview);
   $("#todaytotalappointmentscitywise").html(items1);
       
              }        
                }
            });
        }

function AllAppointmentsCitywiseData(list){
  
   $(".class-hide").hide();
  var id= list;
 $.ajax({
    type: "GET",
    url:url+'DashboardController/AllAppointmentsForDashboardByCitywiseMonth/'+id,
    dataType: 'json',
  success:function(result){
      if(result.success==true)
      {
               var data =result.data;
               var items = "";
               var i;
               var n = data.length;

            for(i=0;i<n;i++) {
                items+='<div class="row mt-2  d-sm-flex"><div class="col-6 col-sm-6 text-left"><h5>'+data[i].cityname+'</h5></div><div class="col-6 col-sm-6 text-left"><h5>'+data[i].totalappointments+'</h5> </div></div>'
                 }
   
             $("#alltotalappointmentscitywise_monthname").html(result.monthview);
             $("#alltotalappointmentscitywise").html(items);

       }else{
            alert('request failed', 'error');
      }

    },
 
 fail:function(result){
      alert('Information request failed: ' + textStatus, 'error');
    }


});

}