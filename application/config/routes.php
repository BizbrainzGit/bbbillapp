<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'WelcomeForntend';
// $route['default_controller'] = 'FrontendController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['teleMarketing'] = 'tele-market/TeleMarketingHome/dashboard';
$route['Marketing'] = 'market/MarketingHome/dashboard';
$route['Marketing-Lead'] = 'market-lead/MarketLeadHome/dashboard';



// For Admin role
$route['admin-manageBusiness'] = 'BusinessController/BusinessView';
$route['admin-GForm-View'] = 'GFormController/GFormView';
$route['admin-Dashboard'] = 'admin/AdminHome/Dashboard';
$route['admin-LoginReport'] = 'LoginReportController/AdminLoginReportView';
$route['admin-manageDemoWebsites'] = 'DemoWebsitesController/demowebsitesViewForAdmin';
$route['admin-User-cityMapping'] = 'admin/CityMappingController/citymappingView';
$route['admin-Assignments'] = 'AssignmentsController/assignmentsViewForAdmin';

$route['admin-manageCampaigns'] = 'admin/CampaignController/campaignView';
$route['admin-managePackages'] = 'admin/PackagesController/packagesView';
$route['admin-manageSubPackages'] = 'admin/SubPackagesController/SubPackagesView';
$route['admin-Promocodes'] = 'PromocodeController/promocodeViewForAdmin';
$route['admin-DealClosed'] = 'DealClosedController/dealclosedViewForAdmin';
$route['admin-manageEmployees'] = 'admin/EmployeesController/employeesView';
$route['admin-FeedbackQuestions'] = 'admin/FeedbackQuestionController/feedbackquestionView';
$route['admin-manageKeywords'] = 'admin/KeywordsController/keywordsView';
$route['admin-managePaymentMode'] = 'admin/PaymentTypesController/paymentTypesView'; 
$route['admin-managebusinessKeywords'] = 'admin/BusinessKeywordsController/businesskeywordsView';
$route['admin-DemolinksEmailReports'] = 'EmailSendDemolinksController/SendmaildemolinksForAdmin';
$route['admin-SendDemoLinks'] = 'SendLinkController/SendLinkView';
$route['admin-Packages-List'] = 'admin/AdminHome/OurPackagesListView';
$route['admin-BusinessSelectedPackages'] = 'BusinessSelectedPackageController/adminBusinessSelectedPackagesView';
$route['admin-TodayAppointments'] = 'TodayAppointmentsController/todayAppointmentsViewForAdmin'; 
$route['admin-Prospect-Leads'] = 'LeadsController/leadsListViewForAdmin';
$route['admin-managecity'] = 'admin/CityController/cityView';
$route['admin-BusinessTransactions'] = 'BusinessTransactionController/adminBusinessTransactionsView';
$route['admin-Producttypes'] = 'admin/ProductTypesController/producttypeView';



// For Martketing role 
$route['Marketing-manageBusiness'] = 'BusinessController/marketingBusinessView';
$route['Marketing-GForm-View'] = 'GFormController/marketingGFormView';
$route['Market-DealClosed'] = 'DealClosedController/dealclosedViewFormarketing';
$route['Marketing-User-Assignments'] = 'AssignmentsController/assignmentsViewFormarketing';
$route['Marketing-BusinessSelectedPackages'] = 'BusinessSelectedPackageController/marketingBusinessSelectedPackagesView';;
$route['Marketing-User-todayAppointments'] = 'market/MarketingHome/todayAppointmentsView';
$route['Marketing-Packages-List'] = 'market/MarketingHome/MarketingPackagesListView';
$route['Marketing-BusinessTransactions'] = 'BusinessTransactionController/MarketingBusinessTransactionsView';
$route['Marketing-SendDemoLinks'] = 'SendLinkController/marketingSendLinkView';



// For Tele-Marketing role 
$route['Tele-Market-manageBusiness'] = 'BusinessController/teleMarketingBusinessView';
$route['Tele-Marketing-GForm-View'] = 'GFormController/teleMarketingGFormView';
$route['Tele-Marketing-User-todayAppointments'] = 'TodayAppointmentsController/todayAppointmentsViewForTelemarketing';
$route['Tele-Marketing-User-Assignments'] = 'AssignmentsController/assignmentsViewForTelemarketing';
$route['Tele-Marketing-DealClosed'] = 'DealClosedController/dealclosedViewForTelemarketing';
$route['Tele-Marketing-BusinessSelectedPackages'] = 'BusinessSelectedPackageController/teleMarketingBusinessSelectedPackagesView'; 
$route['Tele-Marketing-Prospect-Leads'] = 'LeadsController/leadsListViewForTelemarketing';
$route['Tele-Marketing-Packages-List'] = 'tele-market/TeleMarketingHome/OurPackagesListView';
$route['Tele-Marketing-BusinessTransactions'] = 'BusinessTransactionController/TeleMarketingBusinessTransactionsView';
$route['Tele-Marketing-SendDemoLinks'] = 'SendLinkController/teleMarketingSendLinkView';

// For Market-Lead role 
$route['Market-Lead-Promocodes'] = 'PromocodeController/promocodeViewForMarketingLead';
$route['Market-Lead-GForm-View'] = 'GFormController/marketLeadGFormView';
$route['Market-Lead-LoginReport'] = 'LoginReportController/MarketLeadLoginReportView';
$route['Market-Lead-DemolinksEmailReports'] = 'EmailSendDemolinksController/SendmaildemolinksForMarketingLead';
$route['Market-Lead-Packages-List'] = 'market-lead/MarketLeadHome/OurPackagesListView'; 
$route['Market-Lead-manageBusiness'] = 'BusinessController/marketLeadBusinessView';
$route['Market-Lead-BusinessSelectedPackages'] = 'BusinessSelectedPackageController/marketingLeadBusinessSelectedPackagesView'; 
$route['Market-Lead-DealClosed'] = 'DealClosedController/dealclosedViewFormarketingLead'; 
$route['Market-Lead-User-Assignments'] = 'AssignmentsController/assignmentsViewFormarketingLead';
$route['Market-Lead-Prospect-Leads'] = 'LeadsController/leadsListViewForMarketingLead';
$route['Market-Lead-User-todayAppointments']= 'market-lead/TodayAllAppointmentsController/todayAppointmentsView';

$route['Market-Lead-BusinessTransactions'] = 'BusinessTransactionController/MarketLeadBusinessTransactionsView';
$route['Market-Lead-SendDemoLinks'] = 'SendLinkController/marketLeadSendLinkView';






$route['sendlinkbuynow']='SendLinkBuyNowController/SendLinkBuyNowView'; 
$route['paymentlink']='CustomerPaymentLinkController/CustomerPaymentView'; 

$route['login']='Welcome/loginView';
$route['websites']='Welcome/demowebsites'; 
$route['feedback']='Welcome/Feedbackview';
$route['Enquire-View']='LeadsController/leadsView';
$route['forgot']='Welcome/forgotPassword';
$route['buynow']='CustomerBuyController/CustomerBuyView';
$route['Home']='WelcomeForntend/index';
$route['About-Us'] = 'WelcomeForntend/aboutusView';
$route['Our-Products']='WelcomeForntend/ourproductsView';
$route['Clients-Projects']='WelcomeForntend/ourprojectsView';
$route['Our-Team']='WelcomeForntend/ourteamView';
$route['Gallery']='WelcomeForntend/galleryView';
$route['Careers']='WelcomeForntend/careerView';
$route['Contact-Us']='WelcomeForntend/contactView';
$route['Privacy-Policy']='WelcomeForntend/privacypolicyView';
$route['Website-Design']='WelcomeForntend/ServiceFullView/1'; 
$route['E-Commerce']='WelcomeForntend/ServiceFullView/2'; 
$route['Digital-Marketing']='WelcomeForntend/ServiceFullView/3'; 
$route['Logo-Design']='WelcomeForntend/ServiceFullView/4'; 
$route['Mobile-Applications']='WelcomeForntend/ServiceFullView/5'; 
$route['Server-Maintenance']='WelcomeForntend/ServiceFullView/6'; 

// For Dashboard in Managing Director Role
$route['Managing-Director-Dashboard'] = 'managingdirector/ManagingDirectorHome/Dashboard';

// For Dashboard in Accountant Role
$route['Accountant-manageBusiness'] = 'BusinessController/accountantBusinessView'; 
$route['Accountant-Dashboard'] = 'accountant/AccountantHome/Dashboard';
$route['Accountant-DealClosed'] = 'DealClosedController/dealclosedViewForAccounts';
$route['Accountant-BusinessSelectedPackages'] = 'BusinessSelectedPackageController/accountantBusinessSelectedPackagesView'; 
$route['Accountant-BusinessTransactions'] = 'BusinessTransactionController/accountantBusinessTransactionsView';


//for front end role

$route['templateadmin-Dashboard'] = 'templateadmin/TemplateAdminHome/Dashboard';
$route['templateadmin-managemenu'] = 'templateadmin/MenuController/menuView';
$route['templateadmin-managebanner'] = 'templateadmin/BannerController/BannerView';
$route['templateadmin-manageGallerytype'] = 'templateadmin/GalleryTypeController/gallerytypeView';
$route['templateadmin-managegallery'] = 'templateadmin/GalleryController/GalleryView';
$route['templateadmin-manageprojectcategory'] = 'templateadmin/ProjectCategoryController/projectcategoryView';
$route['templateadmin-manageproject'] = 'templateadmin/ProjectController/ProjectView';
$route['templateadmin-managejobskill'] = 'templateadmin/JobSkillController/JobSkillView';
$route['templateadmin-managejob'] = 'templateadmin/JobController/JobView';
$route['templateadmin-manageservices'] = 'templateadmin/ServiceController/ServiceView';
$route['templateadmin-manageservicecontent'] = 'templateadmin/ServiceContentController/ServiceContentView';
$route['templateadmin-manageclientlogos'] = 'templateadmin/ClientLogoController/ClientLogoView';
$route['templateadmin-managecontact'] = 'templateadmin/TemplateAdminHome/contactformView';
$route['templateadmin-managejobapply'] = 'templateadmin/TemplateAdminHome/JobApplyDetailsView';
$route['templateadmin-managebuynowimg'] = 'templateadmin/BuyNowimgController/BuyNowimgView';
$route['templateadmin-managecountlist'] = 'templateadmin/CountListController/CountListView';


//for It Departments role 

$route['IT-Department-Dashboard'] = 'itdepartment/ItDepartmentHome/Dashboard';
$route['IT-Department-manageDemoWebsites'] = 'DemoWebsitesController/demowebsitesViewForITDerparment';