<?php
 
use Illuminate\Support\Facades\Input;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

 Route::any('abc', function()
    {
        if (Request::getMethod() == 'POST')
        {
            $rules = ['captcha' => 'required|captcha'];
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails())
            {
                echo '<p style="color: #ff0000;">Incorrect!</p>';
            }
            else
            {
                echo '<p style="color: #00ff30;">Matched :)</p>';
            }
        }
    
        $form = '<form method="post">';
        $form .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
        $form .= '<p>' . captcha_img() . '</p>';
        $form .= '<p><input type="text" name="captcha"></p>';
        $form .= '<p><button type="submit" name="check">Check</button></p>';
        $form .= '</form>';
        return $form;
    })->name('abc');
// temp Routes
Route::get('adminSuggestion','AdminController@showAdminsuggestion')->name('adminSuggestion');
Route::get('adminFeedback','AdminController@showAdminfeedback')->name('adminFeedback');
Route::get('adminGrievance','AdminController@showAdmingrevience')->name('adminGrievance');

Route::get('loginabc','HomeController@showLogin')->name('loginabc');
Route::get('registerabc','HomeController@showRegister')->name('registerabc');

Route::get('abc','AdminController@abc')->name('abc');

Route::get('maintenance','HomeController@showMaintenance')->name('maintenance');
Route::get('payment','HomeController@completePayFee')->name('payment');

Route::get('acapVacancy','VacancyController@showAcapVacancy')->name('acapVacancy');
Route::get('acapVacancyAdmin','VacancyController@showAcapVacancyAdmin')->name('acapVacancyAdmin');

Route::get('updatevacantseats/{id}','VacancyController@updatevacantseats')->name('updatevacantseats');


//Route::get('pstatus','HomeController@showpayGateway')->name('pstatus');

Route::post('pstatus','HomeController@returnStatus')->name('pstatus');
//Route::get('status','HomeController@returnStatus')->name('status');

Route::get('mca_showDD','HomeController@show_pay_dd')->name('mca_showDD');
Route::post('user_payment_showDD','HomeController@post_dd')->name('user_payment_showDD');
Route::post('mca_acap_payment','AdminController@payFee')->name('mca_acap_payment');

Route::get('unSubmit','AdminController@adminUnSubmit')->name('unSubmit');
Route::get('unSeized','AdminController@adminUnSeized')->name('unSeized');
Route::get('unFormVerified','AdminController@adminUnFormVerified')->name('unFormVerified');
Route::get('unDocumentVerified','AdminController@adminUnDocumentVerified')->name('unDocumentVerified');

Route::get('adminPayment','AdminController@showAdminPayment')->name('adminPayment');

Route::get('saveid/{id}', 'AdminController@saveid')->name('saveid');

Route::get('backtopage','AdminController@backtopage')->name('backtopage');
Route::post('update_fe_guardian_details','AdminController@updatefeguardian')->name('update_fe_guardian_details');
Route::post('update_fe_personal_details','AdminController@updatefepersonal')->name('update_fe_personal_details');
Route::post('update_fe_contact_details','AdminController@updatefecontact')->name('update_fe_contact_details');
Route::post('update_fe_dte_details','AdminController@updatefedte')->name('update_fe_dte_details');
Route::post('update_fe_academic_details','AdminController@updatefeacademic')->name('update_fe_academic_details');

Route::post('update_me_dte_details','AdminController@updatemedte')->name('update_me_dte_details');
Route::post('update_me_academic_details','AdminController@updatemeacademic')->name('update_me_academic_details');
Route::post('update_me_personal_details','AdminController@updatemepersonal')->name('update_me_personal_details');
Route::post('update_me_guardian_details','AdminController@updatemeguardian')->name('update_me_guardian_details');
Route::post('update_me_contact_details','AdminController@updatemecontact')->name('update_me_contact_details');

Route::post('update_mca_guardian_details','AdminController@updatemcaguardian')->name('update_mca_guardian_details');
Route::post('update_mca_personal_details','AdminController@updatemcapersonal')->name('update_mca_personal_details');
Route::post('update_mca_contact_details','AdminController@updatemcacontact')->name('update_mca_contact_details');
Route::post('update_mca_dte_details','AdminController@updatemcadte')->name('update_mca_dte_details');
Route::post('update_mca_academic_details','AdminController@updatemcaacademic')->name('update_mca_academic_details');

Route::post('update_dse_guardian_details','AdminController@updatedseguardian')->name('update_dse_guardian_details');
Route::post('update_dse_personal_details','AdminController@updatedsepersonal')->name('update_dse_personal_details');
Route::post('update_dse_contact_details','AdminController@updatedsecontact')->name('update_dse_contact_details');
Route::post('update_dse_dte_details','AdminController@updatedsedte')->name('update_dse_dte_details');
Route::post('update_dse_academic_details','AdminController@updatedseacademic')->name('update_dse_academic_details');

Route::get('payReceipt', 'HomeController@showpayReceipt')->name('payReceipt');
Route::post('payReceipt', 'HomeController@showpayReceipt');
Route::get('test/{id}', 'HomeController@test')->name('test');
Route::get('view/{id}', 'HomeController@view')->name('view');
Route::get('delete/{id}', 'HomeController@delete')->name('delete');
Route::get('deleteAdmin/{id}', 'AdminController@deleteAdmin')->name('deleteAdmin');
Route::get('deleteAdminAcap/{id}', 'AdminController@deleteAdminAcap')->name('deleteAdminAcap');
Route::get('pdfview',array('as'=>'pdfview','uses'=>'HomeController@pdfview'));

Route::get('date/{id}', 'AdminController@date')->name('date');
Route::post('datewise','AdminController@postDateWise')->name('datewise');

Route::get('backToLos','AdminController@backToLos')->name('backToLos');


Route::get('pdfview1',array('as'=>'pdfview1','uses'=>'AdminController@pdfview1'));
Route::get('pdfviewIT1',array('as'=>'pdfviewIT1','uses'=>'AdminController@pdfviewIT1'));
Route::get('pdfviewINST1',array('as'=>'pdfviewINST1','uses'=>'AdminController@pdfviewINST1'));
Route::get('pdfviewEXTC1',array('as'=>'pdfviewEXTC1','uses'=>'AdminController@pdfviewEXTC1'));
Route::get('pdfviewDate1',array('as'=>'pdfviewDate1','uses'=>'AdminController@pdfviewDate1'));
Route::get('CSVView1','AdminController@CSVView1')->name('CSVView1');
Route::get('CSVViewfe1','AdminController@CSVViewfe1')->name('CSVViewfe1');


Route::get('pdfview2',array('as'=>'pdfview2','uses'=>'AdminController@pdfview2'));
Route::get('pdfviewIT2',array('as'=>'pdfviewIT2','uses'=>'AdminController@pdfviewIT2'));
Route::get('pdfviewINST2',array('as'=>'pdfviewINST2','uses'=>'AdminController@pdfviewINST2'));
Route::get('pdfviewEXTC2',array('as'=>'pdfviewEXTC2','uses'=>'AdminController@pdfviewEXTC2'));
Route::get('pdfviewDate2',array('as'=>'pdfviewDate2','uses'=>'AdminController@pdfviewDate2'));
Route::get('CSVView2','AdminController@CSVView2')->name('CSVView2');



Route::get('pdfview3',array('as'=>'pdfview3','uses'=>'AdminController@pdfview3'));
Route::get('pdfviewIT3',array('as'=>'pdfviewIT3','uses'=>'AdminController@pdfviewIT3'));
Route::get('pdfviewINST3',array('as'=>'pdfviewINST3','uses'=>'AdminController@pdfviewINST3'));
Route::get('pdfviewEXTC3',array('as'=>'pdfviewEXTC3','uses'=>'AdminController@pdfviewEXTC3'));
Route::get('pdfviewDate3',array('as'=>'pdfviewDate3','uses'=>'AdminController@pdfviewDate3'));
Route::get('CSVView3','AdminController@CSVView3')->name('CSVView3');


Route::get('pdfview4',array('as'=>'pdfview4','uses'=>'AdminController@pdfview4'));
Route::get('pdfviewIT4',array('as'=>'pdfviewIT4','uses'=>'AdminController@pdfviewIT4'));
Route::get('pdfviewINST4',array('as'=>'pdfviewINST4','uses'=>'AdminController@pdfviewINST4'));
Route::get('pdfviewEXTC4',array('as'=>'pdfviewEXTC4','uses'=>'AdminController@pdfviewEXTC4'));
Route::get('pdfviewDate4',array('as'=>'pdfviewDate4','uses'=>'AdminController@pdfviewDate4'));
Route::get('CSVView4','AdminController@CSVView4')->name('CSVView4');

Route::get('pdfview5',array('as'=>'pdfview5','uses'=>'AdminController@pdfview5'));
Route::get('pdfviewIT5',array('as'=>'pdfviewIT5','uses'=>'AdminController@pdfviewIT5'));
Route::get('pdfviewINST5',array('as'=>'pdfviewINST5','uses'=>'AdminController@pdfviewINST5'));
Route::get('pdfviewEXTC5',array('as'=>'pdfviewEXTC5','uses'=>'AdminController@pdfviewEXTC5'));
Route::get('pdfviewDate5',array('as'=>'pdfviewDate5','uses'=>'AdminController@pdfviewDate5'));
Route::get('CSVView5','AdminController@CSVView5')->name('CSVView5');

Route::get('pdfview6',array('as'=>'pdfview6','uses'=>'AdminController@pdfview6'));
Route::get('pdfviewIT6',array('as'=>'pdfviewIT6','uses'=>'AdminController@pdfviewIT6'));
Route::get('pdfviewINST6',array('as'=>'pdfviewINST6','uses'=>'AdminController@pdfviewINST6'));
Route::get('pdfviewEXTC6',array('as'=>'pdfviewEXTC6','uses'=>'AdminController@pdfviewEXTC6'));
Route::get('pdfviewDate6',array('as'=>'pdfviewDate6','uses'=>'AdminController@pdfviewDate6'));
Route::get('CSVView6','AdminController@CSVView6')->name('CSVView6');

Route::get('pdfview7',array('as'=>'pdfview7','uses'=>'AdminController@pdfview7'));
Route::get('pdfviewIT7',array('as'=>'pdfviewIT7','uses'=>'AdminController@pdfviewIT7'));
Route::get('pdfviewINST7',array('as'=>'pdfviewINST7','uses'=>'AdminController@pdfviewINST7'));
Route::get('pdfviewEXTC7',array('as'=>'pdfviewEXTC7','uses'=>'AdminController@pdfviewEXTC7'));
Route::get('pdfviewDate7',array('as'=>'pdfviewDate7','uses'=>'AdminController@pdfviewDate7'));
Route::get('CSVView7','AdminController@CSVView7')->name('CSVView7');

Route::get('pdfview8',array('as'=>'pdfview8','uses'=>'AdminController@pdfview8'));
Route::get('pdfviewIT8',array('as'=>'pdfviewIT8','uses'=>'AdminController@pdfviewIT8'));
Route::get('pdfviewINST8',array('as'=>'pdfviewINST8','uses'=>'AdminController@pdfviewINST8'));
Route::get('pdfviewEXTC8',array('as'=>'pdfviewEXTC8','uses'=>'AdminController@pdfviewEXTC8'));
Route::get('pdfviewDate8',array('as'=>'pdfviewDate8','uses'=>'AdminController@pdfviewDate8'));
Route::get('CSVView8','AdminController@CSVView8')->name('CSVView8');



Route::get('pdfviewMca1',array('as'=>'pdfviewMca1','uses'=>'AdminController@pdfviewMca1'));
Route::get('CSVViewMca1','AdminController@CSVViewMca1')->name('CSVViewMca1');

Route::get('pdfviewMca2',array('as'=>'pdfviewMca2','uses'=>'AdminController@pdfviewMca2'));
Route::get('CSVViewMca2','AdminController@CSVViewMca2')->name('CSVViewMca2');

Route::get('pdfviewMca3',array('as'=>'pdfviewMca3','uses'=>'AdminController@pdfviewMca3'));
Route::get('CSVViewMca3','AdminController@CSVViewMca3')->name('CSVViewMca3');

Route::get('pdfviewMca3Shift1',array('as'=>'pdfviewMca3Shift1','uses'=>'AdminController@pdfviewMca3Shift1'));
Route::get('pdfviewMca3Shift2',array('as'=>'pdfviewMca3Shift2','uses'=>'AdminController@pdfviewMca3Shift2'));


Route::get('pdfviewMca4',array('as'=>'pdfviewMca4','uses'=>'AdminController@pdfviewMca4'));
Route::get('CSVViewMca4','AdminController@CSVViewMca4')->name('CSVViewMca4');
Route::get('pdfviewMca4Shift1',array('as'=>'pdfviewMca4Shift1','uses'=>'AdminController@pdfviewMca4Shift1'));
Route::get('pdfviewMca4Shift2',array('as'=>'pdfviewMca4Shift2','uses'=>'AdminController@pdfviewMca4Shift2'));


Route::get('pdfviewMca5',array('as'=>'pdfviewMca5','uses'=>'AdminController@pdfviewMca5'));
Route::get('CSVViewMca5','AdminController@CSVViewMca5')->name('CSVViewMca5');
Route::get('pdfviewMca5Shift1',array('as'=>'pdfviewMca5Shift1','uses'=>'AdminController@pdfviewMca5Shift1'));
Route::get('pdfviewMca5Shift2',array('as'=>'pdfviewMca5Shift2','uses'=>'AdminController@pdfviewMca5Shift2'));

Route::get('pdfviewMca6',array('as'=>'pdfviewMca6','uses'=>'AdminController@pdfviewMca6'));
Route::get('CSVViewMca6','AdminController@CSVViewMca6')->name('CSVViewMca6');
Route::get('pdfviewMca6Shift1',array('as'=>'pdfviewMca6Shift1','uses'=>'AdminController@pdfviewMca6Shift1'));
Route::get('pdfviewMca6Shift2',array('as'=>'pdfviewMca6Shift2','uses'=>'AdminController@pdfviewMca6Shift2'));

Route::get('pdfviewMca7',array('as'=>'pdfviewMca7','uses'=>'AdminController@pdfviewMca7'));
Route::get('CSVViewMca7','AdminController@CSVViewMca7')->name('CSVViewMca7');
Route::get('pdfviewMca7Shift1',array('as'=>'pdfviewMca7Shift1','uses'=>'AdminController@pdfviewMca7Shift1'));
Route::get('pdfviewMca7Shift2',array('as'=>'pdfviewMca7Shift2','uses'=>'AdminController@pdfviewMca7Shift2'));

//FE PDF Routes
Route::get('pdfviewfe1',array('as'=>'pdfviewfe1','uses'=>'AdminController@pdfviewfe1'));
Route::get('pdfviewfe2',array('as'=>'pdfviewfe2','uses'=>'AdminController@pdfviewfe2'));
Route::get('pdfviewfe3',array('as'=>'pdfviewfe3','uses'=>'AdminController@pdfviewfe3'));
Route::get('pdfviewfe4',array('as'=>'pdfviewfe4','uses'=>'AdminController@pdfviewfe4'));
Route::get('pdfviewfe5',array('as'=>'pdfviewfe5','uses'=>'AdminController@pdfviewfe5'));
Route::get('pdfviewfe6',array('as'=>'pdfviewfe6','uses'=>'AdminController@pdfviewfe6'));
Route::get('pdfviewfe7',array('as'=>'pdfviewfe7','uses'=>'AdminController@pdfviewfe7'));
Route::get('pdfviewfe8',array('as'=>'pdfviewfe8','uses'=>'AdminController@pdfviewfe8'));
Route::get('pdfviewfe3cmpnshift1',array('as'=>'pdfviewfe3cmpnshift1','uses'=>'AdminController@pdfviewfe3cmpnshift1'));
Route::get('pdfviewfe3cmpnshift2',array('as'=>'pdfviewfe3cmpnshift2','uses'=>'AdminController@pdfviewfe3cmpnshift2'));
Route::get('pdfviewfe3etrx',array('as'=>'pdfviewfe3etrx','uses'=>'AdminController@pdfviewfe3etrx'));
Route::get('pdfviewfe3extc',array('as'=>'pdfviewfe3extc','uses'=>'AdminController@pdfviewfe3extc'));
Route::get('pdfviewfe3inft',array('as'=>'pdfviewfe3inft','uses'=>'AdminController@pdfviewfe3inft'));
Route::get('pdfviewfe3inst',array('as'=>'pdfviewfe3inst','uses'=>'AdminController@pdfviewfe3inst'));

Route::get('pdfviewfe4cmpnshift1',array('as'=>'pdfviewfe4cmpnshift1','uses'=>'AdminController@pdfviewfe4cmpnshift1'));
Route::get('pdfviewfe4cmpnshift2',array('as'=>'pdfviewfe4cmpnshift2','uses'=>'AdminController@pdfviewfe4cmpnshift2'));
Route::get('pdfviewfe4etrx',array('as'=>'pdfviewfe4etrx','uses'=>'AdminController@pdfviewfe4etrx'));
Route::get('pdfviewfe4extc',array('as'=>'pdfviewfe4extc','uses'=>'AdminController@pdfviewfe4extc'));
Route::get('pdfviewfe4inft',array('as'=>'pdfviewfe4inft','uses'=>'AdminController@pdfviewfe4inft'));
Route::get('pdfviewfe4inst',array('as'=>'pdfviewfe4inst','uses'=>'AdminController@pdfviewfe4inst'));

Route::get('pdfviewfe5cmpnshift1',array('as'=>'pdfviewfe5cmpnshift1','uses'=>'AdminController@pdfviewfe5cmpnshift1'));
Route::get('pdfviewfe5cmpnshift2',array('as'=>'pdfviewfe5cmpnshift2','uses'=>'AdminController@pdfviewfe5cmpnshift2'));
Route::get('pdfviewfe5etrx',array('as'=>'pdfviewfe5etrx','uses'=>'AdminController@pdfviewfe5etrx'));
Route::get('pdfviewfe5extc',array('as'=>'pdfviewfe5extc','uses'=>'AdminController@pdfviewfe5extc'));
Route::get('pdfviewfe5inft',array('as'=>'pdfviewfe5inft','uses'=>'AdminController@pdfviewfe5inft'));
Route::get('pdfviewfe5inst',array('as'=>'pdfviewfe5inst','uses'=>'AdminController@pdfviewfe5inst'));

Route::get('pdfviewfe6cmpnshift1',array('as'=>'pdfviewfe6cmpnshift1','uses'=>'AdminController@pdfviewfe6cmpnshift1'));
Route::get('pdfviewfe6cmpnshift2',array('as'=>'pdfviewfe6cmpnshift2','uses'=>'AdminController@pdfviewfe6cmpnshift2'));
Route::get('pdfviewfe6etrx',array('as'=>'pdfviewfe6etrx','uses'=>'AdminController@pdfviewfe6etrx'));
Route::get('pdfviewfe6extc',array('as'=>'pdfviewfe6extc','uses'=>'AdminController@pdfviewfe6extc'));
Route::get('pdfviewfe6inft',array('as'=>'pdfviewfe6inft','uses'=>'AdminController@pdfviewfe6inft'));
Route::get('pdfviewfe6inst',array('as'=>'pdfviewfe6inst','uses'=>'AdminController@pdfviewfe6inst'));

Route::get('pdfviewfe7cmpnshift1',array('as'=>'pdfviewfe7cmpnshift1','uses'=>'AdminController@pdfviewfe7cmpnshift1'));
Route::get('pdfviewfe7cmpnshift2',array('as'=>'pdfviewfe7cmpnshift2','uses'=>'AdminController@pdfviewfe7cmpnshift2'));
Route::get('pdfviewfe7etrx',array('as'=>'pdfviewfe7etrx','uses'=>'AdminController@pdfviewfe7etrx'));
Route::get('pdfviewfe7extc',array('as'=>'pdfviewfe7extc','uses'=>'AdminController@pdfviewfe7extc'));
Route::get('pdfviewfe7inft',array('as'=>'pdfviewfe7inft','uses'=>'AdminController@pdfviewfe7inft'));
Route::get('pdfviewfe7inst',array('as'=>'pdfviewfe7inst','uses'=>'AdminController@pdfviewfe7inst'));

Route::get('pdfviewfe8cmpnshift1',array('as'=>'pdfviewfe8cmpnshift1','uses'=>'AdminController@pdfviewfe8cmpnshift1'));
Route::get('pdfviewfe8cmpnshift2',array('as'=>'pdfviewfe8cmpnshift2','uses'=>'AdminController@pdfviewfe8cmpnshift2'));
Route::get('pdfviewfe8etrx',array('as'=>'pdfviewfe8etrx','uses'=>'AdminController@pdfviewfe8etrx'));
Route::get('pdfviewfe8extc',array('as'=>'pdfviewfe8extc','uses'=>'AdminController@pdfviewfe8extc'));
Route::get('pdfviewfe8inft',array('as'=>'pdfviewfe8inft','uses'=>'AdminController@pdfviewfe8inft'));
Route::get('pdfviewfe8inst',array('as'=>'pdfviewfe8inst','uses'=>'AdminController@pdfviewfe8inst'));



//DSE PDF Routes open
Route::get('pdfviewdse1',array('as'=>'pdfviewdse1','uses'=>'AdminController@pdfviewdse1'));
Route::get('pdfviewdse2',array('as'=>'pdfviewdse2','uses'=>'AdminController@pdfviewdse2'));
Route::get('pdfviewdse3',array('as'=>'pdfviewdse3','uses'=>'AdminController@pdfviewdse3'));
Route::get('pdfviewdse4',array('as'=>'pdfviewdse4','uses'=>'AdminController@pdfviewdse4'));
Route::get('pdfviewdse5',array('as'=>'pdfviewdse5','uses'=>'AdminController@pdfviewdse5'));
Route::get('pdfviewdse6',array('as'=>'pdfviewdse6','uses'=>'AdminController@pdfviewdse6'));
Route::get('pdfviewdse7',array('as'=>'pdfviewdse7','uses'=>'AdminController@pdfviewdse7'));
Route::get('pdfviewdse8',array('as'=>'pdfviewdse8','uses'=>'AdminController@pdfviewdse8'));


Route::get('pdfviewdse3cmpnshift1',array('as'=>'pdfviewdse3cmpnshift1','uses'=>'AdminController@pdfviewdse3cmpnshift1'));
Route::get('pdfviewdse3cmpnshift2',array('as'=>'pdfviewdse3cmpnshift2','uses'=>'AdminController@pdfviewdse3cmpnshift2'));
Route::get('pdfviewdse3etrx',array('as'=>'pdfviewdse3etrx','uses'=>'AdminController@pdfviewdse3etrx'));
Route::get('pdfviewdse3extcshift1',array('as'=>'pdfviewdse3extcshift1','uses'=>'AdminController@pdfviewdse3extcshift1'));
Route::get('pdfviewdse3extcshift2',array('as'=>'pdfviewdse3extcshift2','uses'=>'AdminController@pdfviewdse3extcshift2'));
Route::get('pdfviewdse3inft',array('as'=>'pdfviewdse3inft','uses'=>'AdminController@pdfviewdse3inft'));
Route::get('pdfviewdse3inst',array('as'=>'pdfviewdse3inst','uses'=>'AdminController@pdfviewdse3inst'));

Route::get('pdfviewdse4cmpnshift1',array('as'=>'pdfviewdse4cmpnshift1','uses'=>'AdminController@pdfviewdse4cmpnshift1'));
Route::get('pdfviewdse4cmpnshift2',array('as'=>'pdfviewdse4cmpnshift2','uses'=>'AdminController@pdfviewdse4cmpnshift2'));
Route::get('pdfviewdse4etrx',array('as'=>'pdfviewdse4etrx','uses'=>'AdminController@pdfviewdse4etrx'));
Route::get('pdfviewdse4extcshift1',array('as'=>'pdfviewdse4extcshift1','uses'=>'AdminController@pdfviewdse4extcshift1'));
Route::get('pdfviewdse4extcshift2',array('as'=>'pdfviewdse4extcshift2','uses'=>'AdminController@pdfviewdse4extcshift2'));
Route::get('pdfviewdse4inft',array('as'=>'pdfviewdse4inft','uses'=>'AdminController@pdfviewdse4inft'));
Route::get('pdfviewdse4inst',array('as'=>'pdfviewdse4inst','uses'=>'AdminController@pdfviewdse4inst'));

Route::get('pdfviewdse5cmpnshift1',array('as'=>'pdfviewdse5cmpnshift1','uses'=>'AdminController@pdfviewdse5cmpnshift1'));
Route::get('pdfviewdse5cmpnshift2',array('as'=>'pdfviewdse5cmpnshift2','uses'=>'AdminController@pdfviewdse5cmpnshift2'));
Route::get('pdfviewdse5etrx',array('as'=>'pdfviewdse5etrx','uses'=>'AdminController@pdfviewdse5etrx'));
Route::get('pdfviewdse5extcshift1',array('as'=>'pdfviewdse5extcshift1','uses'=>'AdminController@pdfviewdse5extcshift1'));
Route::get('pdfviewdse5extcshift2',array('as'=>'pdfviewdse5extcshift2','uses'=>'AdminController@pdfviewdse5extcshift2'));
Route::get('pdfviewdse5inft',array('as'=>'pdfviewdse5inft','uses'=>'AdminController@pdfviewdse5inft'));
Route::get('pdfviewdse5inst',array('as'=>'pdfviewdse5inst','uses'=>'AdminController@pdfviewdse5inst'));

Route::get('pdfviewdse6cmpnshift1',array('as'=>'pdfviewdse6cmpnshift1','uses'=>'AdminController@pdfviewdse6cmpnshift1'));
Route::get('pdfviewdse6cmpnshift2',array('as'=>'pdfviewdse6cmpnshift2','uses'=>'AdminController@pdfviewdse6cmpnshift2'));
Route::get('pdfviewdse6etrx',array('as'=>'pdfviewdse6etrx','uses'=>'AdminController@pdfviewdse6etrx'));
Route::get('pdfviewdse6extcshift1',array('as'=>'pdfviewdse6extcshift1','uses'=>'AdminController@pdfviewdse6extcshift1'));
Route::get('pdfviewdse6extcshift2',array('as'=>'pdfviewdse6extcshift2','uses'=>'AdminController@pdfviewdse6extcshift2'));
Route::get('pdfviewdse6inft',array('as'=>'pdfviewdse6inft','uses'=>'AdminController@pdfviewdse6inft'));
Route::get('pdfviewdse6inst',array('as'=>'pdfviewdse6inst','uses'=>'AdminController@pdfviewdse6inst'));

Route::get('pdfviewdse7cmpnshift1',array('as'=>'pdfviewdse7cmpnshift1','uses'=>'AdminController@pdfviewdse7cmpnshift1'));
Route::get('pdfviewdse7cmpnshift2',array('as'=>'pdfviewdse7cmpnshift2','uses'=>'AdminController@pdfviewdse7cmpnshift2'));
Route::get('pdfviewdse7etrx',array('as'=>'pdfviewdse7etrx','uses'=>'AdminController@pdfviewdse7etrx'));
Route::get('pdfviewdse7extcshift1',array('as'=>'pdfviewdse7extcshift1','uses'=>'AdminController@pdfviewdse7extcshift1'));
Route::get('pdfviewdse7extcshift2',array('as'=>'pdfviewdse7extcshift2','uses'=>'AdminController@pdfviewdse7extcshift2'));
Route::get('pdfviewdse7inft',array('as'=>'pdfviewdse7inft','uses'=>'AdminController@pdfviewdse7inft'));
Route::get('pdfviewdse7inst',array('as'=>'pdfviewdse7inst','uses'=>'AdminController@pdfviewdse7inst'));

Route::get('pdfviewdse8cmpnshift1',array('as'=>'pdfviewdse8cmpnshift1','uses'=>'AdminController@pdfviewdse8cmpnshift1'));
Route::get('pdfviewdse8cmpnshift2',array('as'=>'pdfviewdse8cmpnshift2','uses'=>'AdminController@pdfviewdse8cmpnshift2'));
Route::get('pdfviewdse8etrx',array('as'=>'pdfviewdse8etrx','uses'=>'AdminController@pdfviewdse8etrx'));
Route::get('pdfviewdse8extcshift1',array('as'=>'pdfviewdse8extcshift1','uses'=>'AdminController@pdfviewdse8extcshift1'));
Route::get('pdfviewdse8extcshift2',array('as'=>'pdfviewdse8extcshift2','uses'=>'AdminController@pdfviewdse8extcshift2'));
Route::get('pdfviewdse8inft',array('as'=>'pdfviewdse8inft','uses'=>'AdminController@pdfviewdse8inft'));
Route::get('pdfviewdse8inst',array('as'=>'pdfviewdse8inst','uses'=>'AdminController@pdfviewdse8inst'));
//DSE pdf routes closed


Route::post('/getmail','HomeController@sendmail');

Route::post('/getotp','HomeController@sendotp');

Route::get('login','HomeController@showLogin')->name('login');
Route::post('login','HomeController@checklogin');



Route::get('forgotPassword','HomeController@showForgotPasssword')->name('forgotPassword');

Route::post('forgotPassword','HomeController@sendPassswordEmail');

Route::get('register','HomeController@showRegister')->name('register');

Route::post('register','HomeController@checkregister');

Route::get('registerMobile','HomeController@showregisterMobile')->name('registerMobile');

Route::post('registerMobile','HomeController@verifyMobile');

Route::get('registerEmail','HomeController@showregisterEmail')->name('registerEmail');

Route::post('registerEmail','HomeController@verifyEmail');

//DSE ROUTES
Route::get('dse_profile','HomeController@showdseProfile')->name('dse_profile');


Route::get('dse_change_password','HomeController@showdseChangePassword')->name('dse_change_password');
Route::post('dse_change_password','HomeController@submitdseChangePassword')->name('dse_change_password');

Route::get('dse_payment_details','HomeController@showdsePaymentDetails')->name('dse_payment_details');

//Dse Acap Payment
Route::get('dse_acap_form_payment','HomeController@showFeAcapFormPayment')->name('dse_acap_form_payment');
Route::post('dse_acap_form_payment','HomeController@payFee');

Route::get('dse_dte_details','HomeController@showdseDte')->name('dse_dte_details'); 
Route::post('dse_dte_details','HomeController@insertdseDte')->name('dse_dte_details'); 


Route::get('dse_guardian_details','HomeController@showdseGuard')->name('dse_guardian_details');
Route::post('dse_guardian_details','HomeController@insertdseGaurd')->name('dse_guardian_details');

Route::get('dse_contact_details','HomeController@showdseContact')->name('dse_contact_details');
Route::post('dse_contact_details','HomeController@insertdseContact')->name('dse-contact_details');

Route::get('dse_personal_details','HomeController@showdsePersonal')->name('dse_personal_details');
Route::post('dse_personal_details','HomeController@insertdsePersonal')->name('dse_personal_details');


Route::get('dse_document_upload','HomeController@showdseDocumentUpload')->name('dse_document_upload');
Route::post('dse_document_upload','HomeController@uploaddseDocumentUpload');
Route::get('dse_acap_document_upload','HomeController@showdseAcapDocumentUpload')->name('dse_acap_document_upload');
Route::post('dse_acap_document_upload','HomeController@uploaddseAcapDocumentUpload')->name('dse_acap_document_upload');

Route::get('dse_academic_details','HomeController@showdseAcademic')->name('dse_academic_details');
Route::post('dse_academic_details','HomeController@insertdseAcademic')->name('dse_academic_details');


Route::get('dse_admission_payment','HomeController@showAdmissionPayment')->name('dse_admission_payment');
Route::post('dse_admission_payment','HomeController@payFee');

Route::get('dse_showDD','HomeController@show_pay_dd')->name('dse_showDD');
Route::post('user_payment_showDD','HomeController@post_dd')->name('user_payment_showDD');


Route::get('dse_final_submit','HomeController@showdsefinalSubmit')->name('dse_final_submit');
Route::post('dse_final_submit','HomeController@postdsefinalSubmit')->name('dse_final_submit');

//FE ROUTES
Route::get('fe_profile','HomeController@showfeProfile')->name('fe_profile');

Route::get('fe_dte_details','HomeController@showfeDte')->name('fe_dte_details');
Route::post('fe_dte_details','HomeController@insertfeDte');

Route::get('fe_academic_details','HomeController@showfeAca')->name('fe_academic_details');
Route::post('fe_academic_details','HomeController@insertfeAca');

Route::get('fe_personal_details','HomeController@showfePersonal')->name('fe_personal_details');
Route::post('fe_personal_details','HomeController@insertfePersonal');

Route::get('fe_guardian_details','HomeController@showfeGuard')->name('fe_guardian_details');
Route::post('fe_guardian_details','HomeController@insertfeGuard');

Route::get('fe_contact_details','HomeController@showfeContact')->name('fe_contact_details');
Route::post('fe_contact_details','HomeController@insertfeContact');

Route::get('fe_document_upload','HomeController@showfeDocumentUpload')->name('fe_document_upload');
Route::post('fe_document_upload','HomeController@uploadfeDocumentUpload');
Route::post('fe_acap_document_upload','HomeController@uploadfeAcapDocumentUpload')->name('fe_acap_document_upload');

Route::get('fe_Welcome','HomeController@showfeWelcome')->name('fe_Welcome');
 
Route::get('fe_payment_details','HomeController@showfePaymentDetails')->name('fe_payment_details');

Route::get('fe_admission_payment','HomeController@showAdmissionPayment')->name('fe_admission_payment');
Route::post('fe_admission_payment','HomeController@payFee');
 
Route::get('fe_showDD','HomeController@show_pay_dd')->name('fe_showDD');
Route::post('user_payment_showDD','HomeController@post_dd')->name('user_payment_showDD');

Route::get('fe_cash','HomeController@show_pay_cash')->name('fe_show_cash');//by cash 2020
Route::post('user_payment_show_cash','HomeController@post_cash')->name('user_payment_show_cash');

Route::get('fe_final_submit','HomeController@showfefinalSubmit')->name('fe_final_submit');
Route::post('fe_final_submit','HomeController@postfefinalSubmit');

Route::post('payGateway','HomeController@returnStatus')->name('payGateway');
Route::get('payment','HomeController@completePayFee')->name('payment');

Route::get('fe_change_password','HomeController@showfeChangePassword')->name('fe_change_password');
Route::post('fe_change_password','HomeController@submitfeChangePassword')->name('fe_change_password');

Route::get('logout','HomeController@logout')->name('logout');

//fe acap payment
Route::get('fe_acap_form_payment','HomeController@showFeAcapFormPayment')->name('fe_acap_form_payment');
Route::post('fe_acap_form_payment','HomeController@payFeeDD');


//MCA ROUTES
Route::get('mca_profile','HomeController@showmcaProfile')->name('mca_profile');

Route::get('mca_payment_details','HomeController@showmcaPaymentDetails')->name('mca_payment_details');

Route::get('mca_change_password','HomeController@showmcaChangePassword')->name('mca_change_password');
Route::post('mca_change_password','HomeController@submitmcaChangePassword')->name('mca_change_password');

Route::get('mca_dte_details','HomeController@showmcaDte')->name('mca_dte_details');
Route::post('mca_dte_details','HomeController@insertmcaDte');

Route::get('mca_academic_details','HomeController@showmcaAca')->name('mca_academic_details');
Route::post('mca_academic_details','HomeController@insertmcaAca');

Route::get('mca_personal_details','HomeController@showmcaPersonal')->name('mca_personal_details');
Route::post('mca_personal_details','HomeController@insertmcaPersonal');

Route::get('mca_guardian_details','HomeController@showmcaGuard')->name('mca_guardian_details');
Route::post('mca_guardian_details','HomeController@insertmcaGaurd');

Route::get('mca_contact_details','HomeController@showmcaContact')->name('mca_contact_details');
Route::post('mca_contact_details','HomeController@insertmcaContact');

Route::get('mca_document_upload','HomeController@showmcaDocumentUpload')->name('mca_document_upload');
Route::post('mca_document_upload','HomeController@uploadmcaDocumentUpload');

Route::get('mca_acap_form_payment','HomeController@showMcaAcapFormPayment')->name('mca_acap_form_payment');
Route::post('mca_acap_form_payment','HomeController@payFee');


Route::get('mca_admission_payment','HomeController@showAdmissionPayment')->name('mca_admission_payment');
Route::post('mca_admission_payment','HomeController@payFee');

Route::get('mca_showDD','HomeController@show_pay_dd')->name('mca_showDD');
Route::post('user_payment_showDD','HomeController@post_dd')->name('user_payment_showDD');;

Route::get('mca_final_submit','HomeController@showmcafinalSubmit')->name('mca_final_submit');
Route::post('mca_final_submit','HomeController@postmcafinalSubmit');

Route::get('mca_Welcome','HomeController@showmcaWelcome')->name('mca_Welcome');


//ME ROUTES
Route::get('me_profile','HomeController@showmeProfile')->name('me_profile');

Route::get('me_payment_details','HomeController@showmePaymentDetails')->name('me_payment_details');

Route::get('me_change_password','HomeController@showmeChangePassword')->name('me_change_password');
Route::post('me_change_password','HomeController@submitmeChangePassword');

Route::get('me_acap_form_payment','HomeController@showacapFormPayment')->name('me_acap_form_payment');
Route::post('me_acap_form_payment','HomeController@payFee');

Route::get('me_dte_details','HomeController@showmeDte')->name('me_dte_details');
Route::post('me_dte_details','HomeController@insertmeDte');

Route::get('me_academic_details','HomeController@showmeAca')->name('me_academic_details');
Route::post('me_academic_details','HomeController@insertmeAca');

Route::get('me_personal_details','HomeController@showmePersonal')->name('me_personal_details');
Route::post('me_personal_details','HomeController@insertmePersonal');

Route::get('me_guardian_details','HomeController@showmeGuard')->name('me_guardian_details');
Route::post('me_guardian_details','HomeController@insertmeGuard');

Route::get('me_contact_details','HomeController@showmeContact')->name('me_contact_details');
Route::post('me_contact_details','HomeController@insertmeContact');

Route::get('me_document_upload','HomeController@showmeDocumentUpload')->name('me_document_upload');
Route::post('me_document_upload','HomeController@uploadmeDocumentUpload');


Route::get('me_acap_document_upload','HomeController@showmeAcapDocumentUpload')->name('me_acap_document_upload');
Route::post('me_acap_document_upload','HomeController@uploadmeDocumentUpload');

//Route::post('me_pay_receipt', 'HomeController@returnStatus')->name('me_pay_receipt');
Route::get('me_admission_payment','HomeController@showadmissionPayment')->name('me_admission_payment');
Route::post('me_admission_payment','HomeController@payFee');

Route::get('me_showDD','HomeController@show_pay_dd')->name('me_showDD');
Route::post('user_payment_showDD','HomeController@post_dd')->name('user_payment_showDD');

Route::get('me_final_submit','HomeController@showfinalSubmit')->name('me_final_submit');
Route::post('me_final_submit','HomeController@postmefinalSubmit');

Route::get('logout','HomeController@logout')->name('logout');

// Admin Routes


Route::get('mailpage','AdminController@mailcontroler')->name('mailcontroler');//changed by kartik
Route::post('mailpage','AdminController@mailcontroler')->name('mailcontroler');//changed by kartik


Route::get('admin_showDD','AdminController@show_pay_dd')->name('admin_showDD');
Route::post('payment_showDD','AdminController@post_dd')->name('payment_showDD');

Route::post('updatestaffrole','AdminController@adminUserStaffRole')->name('updatestaffrole');
Route::get('adminLogin','AdminController@showadminlogin')->name('adminLogin');
Route::post('adminLogin','AdminController@checkadminlogin');

Route::get('staffRoleSelector','AdminController@showroleselector')->name('staffRoleSelector');
Route::post('staffRoleSelector','AdminController@postroleselector');

Route::get('adminSelector','AdminController@showAdminSelector')->name('adminSelector');
Route::post('adminSelector','AdminController@postAdminSelector');

Route::get('adminsEvent','AdminController@showAdminsEvent')->name('adminsEvent');
Route::post('adminsEvent','AdminController@postAdminsEvent');

Route::get('adminDashboard','AdminController@showAdminDashboard')->name('adminDashboard');

Route::get('adminStudentIntake','AdminController@showAdminStudentIntake')->name('adminStudentIntake');

//common verifier methods for all
Route::get('adminVerifier','AdminController@showAdminVerifier')->name('adminVerifier');
Route::post('adminVerifierSearch','AdminController@AfterSearchAdminVerifier')->name('adminVerifierSearch');
Route::get('postAdminVerifier','AdminController@postAdminVerifier')->name('postAdminVerifier');


//common seizer methods for all
Route::get('adminSeizer','AdminController@showAdminSeizer')->name('adminSeizer');
Route::post('adminSeizer','AdminController@AfterSearchAdminSeizer');
Route::get('postAdminSeizer','AdminController@postAdminSeizer')->name('postAdminSeizer');
 
//common cash payment 
Route::get('adminCashPayment','AdminController@showCashPayment')->name('adminCashPayment');
Route::post('SearchCashPayment','AdminController@SearchCashPayment');
Route::get('ShowAcapCashPayment','AdminController@showacapCashPayment')->name('showacapCashPayment');

Route::post('PostCashPayment','AdminController@PostCashPayment')->name('PostCashPayment');

//common for feg,mca,meg,dse
Route::get('adminDocumentVerifier','AdminController@showAdminDocumentVerifier')->name('adminDocumentVerifier');
Route::post('adminSearchDocumentVerifier','AdminController@adminSearchDocumentVerifier')->name('adminSearchDocumentVerifier');


//for mca
Route::post('adminDocumentVerifier','AdminController@verifyAdminDocumentVerifier');
//for meg
Route::post('adminDocumentVerifierMEG','AdminController@verifyAdminDocumentVerifierMEG')->name('adminDocumentVerifierMEG');
//for feg
Route::post('adminDocumentVerifierFE','AdminController@verifyAdminDocumentVerifierFE')->name('adminDocumentVerifierFE');
//for dse
Route::post('adminDocumentVerifierDSE','AdminController@verifyAdminDocumentVerifierDSE')->name('adminDocumentVerifierDSE');



//common for all
Route::get('adminDocumentVerifierAcap','AdminController@showAdminDocumentVerifierAcap')->name('adminDocumentVerifierAcap');

//for mca
Route::post('adminDocumentVerifierAcap','AdminController@verifyAdminDocumentVerifierAcap'); 
//for meg
Route::post('adminDocumentVerifierAcapMEG','AdminController@verifyAdminDocumentVerifierAcapMEG')->name('adminDocumentVerifierAcapMEG'); 

//for feg
Route::post('adminDocumentVerifierAcapFE','AdminController@verifyAdminDocumentVerifierAcapFE')->name('adminDocumentVerifierAcapFE'); 
//for dse
Route::post('adminDocumentVerifierAcapDSE','AdminController@verifyAdminDocumentVerifierAcapDSE')->name('adminDocumentVerifierAcapDSE');


Route::get('doc-verify','AdminController@doc_verify')->name('doc-verify');



//for mca dte
Route::get('adminViewAllDocuments','AdminController@showalldocuments')->name('adminViewAllDocuments');
//for meg dte
Route::get('adminViewAllDocumentsMEG','AdminController@showalldocumentsMEG')->name('adminViewAllDocumentsMEG');

//for fe dte
Route::get('adminViewAllDocumentsFE','AdminController@showalldocumentsFE')->name('adminViewAllDocumentsFE');
//for dse dte
Route::get('adminViewAllDocumentsDSE','AdminController@showalldocumentsDSE')->name('adminViewAllDocumentsDSE');


//for mca acap
Route::get('adminViewAllDocumentsAcap','AdminController@showalldocumentsAcap')->name('adminViewAllDocumentsAcap');
//for meg acap
Route::get('adminViewAllDocumentsAcapMEG','AdminController@showalldocumentsAcapMEG')->name('adminViewAllDocumentsAcapMEG');
//for feg acap
Route::get('adminViewAllDocumentsAcapFE','AdminController@showalldocumentsAcapFE')->name('adminViewAllDocumentsAcapFE');
 //for dse acap
Route::get('adminViewAllDocumentsAcapDSE','AdminController@showalldocumentsAcapDSE')->name('adminViewAllDocumentsAcapDSE');


Route::get('adminAdmit','AdminController@showAdminAdmit')->name('adminAdmit');
Route::post('adminAdmitSearch','AdminController@AfterSearchAdminAdmit')->name('adminAdmitSearch');
Route::post('adminAdmit','AdminController@postAdminAdmit');

Route::get('adminUploadAllotmentList','AdminController@showAdminUploadAllotmentList')->name('adminUploadAllotmentList');
Route::post('adminUploadAllotmentList','AdminController@postAdminUploadAllotmentList');


Route::get('adminPrintForm','AdminController@showAdminPrintForm')->name('adminPrintForm');
Route::post('adminPrintForm','AdminController@postAdminPrintForm');


Route::get('seizerPrintForm','AdminController@showSeizerPrintForm')->name('seizerPrintForm');
Route::post('seizerPrintForm','AdminController@postSeizerPrintForm');

Route::get('adminPartPayment','AdminController@showAdminPartPayment')->name('adminPartPayment');
Route::post('adminPartPaymentSearch','AdminController@AfterSearchAdminPartPayment')->name('adminPartPaymentSearch');
Route::get('adminPartPaymentSearch','AdminController@AfterSearchAdminPartPayment')->name('adminPartPaymentSearch');
Route::get('adminPartPaymentreturn','AdminController@AfterSearchAdminPartPaymentreturn')->name('adminPartPaymentSearchreturn');
Route::post('adminPartPayment','AdminController@postAdminPartPayment')->name('adminPartPayment');

Route::post('adminPartPaymentUpload','AdminController@AdminPartPaymentUpload')->name('adminPartPaymentUpload');


Route::get('adminCancelAdmission','AdminController@showAdminCancelAdmission')->name('adminCancelAdmission');
Route::post('adminCancelAdmissionSearch','AdminController@AfterSearchAdminCancelAdmission')->name('adminCancelAdmissionSearch');
Route::get('postAdminCancelAdmission','AdminController@postAdminCancelAdmission')->name('postAdminCancelAdmission');


Route::get('adminLosAcapApplied','AdminController@showAdminLosAcapApplied')->name('adminLosAcapApplied');
Route::post('adminLosAcapApplied','AdminController@searchAdminLosAcapApplied');

Route::get('adminLosAcapSeized','AdminController@showAdminLosAcapSeized')->name('adminLosAcapSeized');
Route::post('adminLosAcapSeized','AdminController@searchAdminLosAcapSeized');

Route::get('adminLosAcapAdmitted','AdminController@showAdminLosAcapAdmitted')->name('adminLosAcapAdmitted');
Route::post('adminLosAcapAdmitted','AdminController@searchAdminLosAcapAdmitted');

Route::get('adminLosAcapCancelled','AdminController@showAdminLosAcapCancelled')->name('adminLosAcapCancelled');
Route::post('adminLosAcapCancelled','AdminController@searchAdminLosAcapCancelled');

Route::get('adminLosAcapPartPayment','AdminController@showAdminLosAcapPartPayment')->name('adminLosAcapPartPayment');
Route::post('adminLosAcapPartPayment','AdminController@searchAdminLosAcapPartPayment');

Route::get('adminLosDteAdmitted','AdminController@showAdminLosDteAdmitted')->name('adminLosDteAdmitted');
Route::post('adminLosDteAdmitted','AdminController@searchAdminLosDteAdmitted');

Route::get('adminLosDteCancelled','AdminController@showAdminLosDteCancelled')->name('adminLosDteCancelled');
Route::post('adminLosDteCancelled','AdminController@searchAdminLosDteCancelled');

Route::get('adminLosDtePartPayment','AdminController@showAdminLosDtePartPayment')->name('adminLosDtePartPayment');
Route::post('adminLosDtePartPayment','AdminController@searchAdminLosDtePartPayment');

Route::get('adminUsersStaff','AdminController@showAdminUsersStaff')->name('adminUsersStaff');
Route::post('adminUsersStaff','AdminController@addAdminUsersStaff');

Route::get('adminUsersAdmin','AdminController@showAdminUsersAdmin')->name('adminUsersAdmin');
Route::post('adminUsersAdmin','AdminController@addAdminUsersAdmin');

Route::get('adminFormView','AdminController@showAdminFormView')->name('adminFormView');
Route::post('adminFormView','AdminController@checkadminFormView');

Route::get('adminFormViewMEG','AdminController@showAdminFormViewMEG')->name('adminFormViewMEG');
Route::post('adminFormViewMEG','AdminController@checkadminFormViewMEG');

Route::get('adminFormViewFE','AdminController@showAdminFormViewFE')->name('adminFormViewFE');
Route::post('adminFormViewFE','AdminController@checkadminFormViewFE');

Route::get('adminFormViewDSE','AdminController@showAdminFormViewDSE')->name('adminFormViewDSE');
Route::post('adminFormViewDSE','AdminController@checkadminFormViewDSE');


Route::get('adminTransactionDetails','AdminController@showAdminTransactionDetails')->name('adminTransactionDetails');
Route::post('adminTransactionDetails','AdminController@addAdminTransactionDetails');
Route::get('adminUnseize','AdminController@postAdminUnseize')->name('adminUnseize');


Route::get('adminStaffRoleHistory','AdminController@showAdminStaffRoleHistory')->name('adminStaffRoleHistory');
Route::post('adminStaffRoleHistory','AdminController@addAdminStaffRoleHistory');


Route::get('adminUsersStudent','AdminController@showAdminUsersStudent')->name('adminUsersStudent');
Route::post('adminUsersStudent','AdminController@AfterSearchAdminUsersStudent');
Route::get('postAdminUsersStudent','AdminController@postAdminUsersStudent')->name('postAdminUsersStudent');


Route::get('/adminLatestNews', 'AdminController@showLatestNews')->name('adminLatestNews');
Route::post('/adminLatestNews', 'AdminController@postLatestNews');
Route::get('/deleteNews/{id}', 'AdminController@deleteNews')->name('deleteNews');

Route::get('/adminPdfNotice', 'AdminController@showPdfs')->name('adminPdfNotice');
Route::post('/adminPdfNotice', 'AdminController@postPdfs');
Route::get('/deleteNotice/{id}', 'AdminController@deleteNotice')->name('deleteNotice');


Route::get('adminAccounts','AdminController@showAdminAccounts')->name('adminAccounts');
Route::post('adminAccounts','AdminController@searchAdminAccounts');

Route::get('adminEvents','AdminController@showAdminEvents')->name('adminEvents');
Route::post('adminEvents','AdminController@addAdminEvents');

Route::get('changeAdminPassword','AdminController@showChangeAdminPassword')->name('changeAdminPassword');
Route::post('changeAdminPassword','AdminController@changeAdminPassword');

Route::get('changeStaffPassword','AdminController@showChangeStaffPassword')->name('changeStaffPassword');
Route::post('changeStaffPassword','AdminController@changeStaffPassword');

Route::get('adminLogout','AdminController@adminLogout')->name('adminLogout');


//Route::get('mca_showDD','HomeController@mca_showDD')->name('mca_showDD');
?>