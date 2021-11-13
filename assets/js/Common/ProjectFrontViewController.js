$(document).ready(function(){

viewOurProjects();   
        function viewOurProjects(){
            $.ajax({
                type  : 'GET',
                url   : url+"ProjectFrontViewController/OurProductsViewList",
                async : true,
                dataType : 'json',
                success : function(result){
                          if(result.success===true){
                             OurProjectsList(result.data);
                            }        
                }
            });
        }

   function OurProjectsList(projectslist){
       var items = "";
       var i;
       var n = projectslist.length;

    for(var i=0; i<n; i++){
        items+='<div class="col-12 col-md-4 col-lg-4"><div class="card"><figure><img src="'+url+projectslist[i].image+'" height="200px" alt='+projectslist[i].image_alt+'></figure><div class="card-body text-center"><h3><a href="#">'+projectslist[i].project_title+'</a></h3><a  href="'+projectslist[i].project_url+'" class="know-more" target="_blank">Try On</a> </div></div> </div>';
         }    
        
        $("#ourprojectslistforproducts").html(items);
  
  }

//** Projects Categories List  Start **//

// viewClientProjectsCategory();   
//         function viewClientProjectsCategory(){
//             $.ajax({
//                 type  : 'GET',
//                 url   : url+"ProjectFrontViewController/ClientProjectCategorysViewList",
//                 async : true,
//                 dataType : 'json',
//                 success : function(result){
//                           if(result.success===true){
//                              ClientProjectsCategoryList(result.data);
//                             }        
//                 }
//             });
//         }

   function ClientProjectsCategoryList(projectscategorylist){
       var items = "";
       var i;
       var n = projectscategorylist.length;

    for(var i=0; i<n; i++){
        items+='<li><button class="btn btn-sm mt-2 listofprojectscategory" data-projectscategoryid="'+projectscategorylist[i].id+'">'+projectscategorylist[i].projectcategory_name+'</button></li> ';
         }    
        
        $("#productcategoriesListview").html(items);
  
  }

//** Projects Categories List  Start **//

  viewClientProjects();   
        function viewClientProjects(){
            $.ajax({
                type  : 'GET',
                url   : url+"ProjectFrontViewController/ClientProductsViewList",
                async : true,
                dataType : 'json',
                success : function(result){
                          if(result.success===true){
                             ClientProjectsList(result.data);
                            }        
                }
            });
        }

   function ClientProjectsList(projectslist){
       var items = "";
       var i;
       var n = projectslist.length;

    for(var i=0; i<n; i++){
        items+='<li class="col-6 col-lg-4"><div class="inner"><div class="product-block"><figure><img src="'+url+projectslist[i].image+'" class="img-fluid" alt='+projectslist[i].image_alt+'></figure></div><div class="product-detail text-capitalize"><h2>'+projectslist[i].project_title+' </h2><div class="bottom"><a  href="'+projectslist[i].project_url+'" class="know-more" target="_blank">View</a> </div></div></div></li>';
         }    
        
        $("#clientprojectslistforproducts").html(items);
  
  }



function searchClientProductsByCategory(search_forntview_project_category){
 var search_forntview_project_category = search_forntview_project_category;
 $.ajax({
       type:"POST",
       url:url+"ProjectFrontViewController/SearchByCategoryClientProductsViewList",
    dataType: 'json',
    data:{search_forntview_project_category:search_forntview_project_category},
    dataType: 'json',

 success: function(result){
      
      if(result.success==true){
        
        ClientProjectsList(result.data);  
      }
  else if(result.success==false){
        $('#search_project_category-msg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $("#search_project_category-msg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
        viewClientProjects(); 
      }
    },
    
    failure: function (result){
      $('#search_project_category-msg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $("#search_project_category-msg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
         
      });
   

}

$("#searchprojectscategory").click(function(){
  var search_forntview_project_category = $('#search_forntview_project_category').val();
  searchClientProductsByCategory(search_forntview_project_category); 
});

// $(document).on('click', '.listofprojectscategory a', function(e){
//   var id= $(this).attr("data-projectscategoryid");
//   alert(id);
// });

}); // document ready 