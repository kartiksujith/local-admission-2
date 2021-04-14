<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB; 
use Illuminate\Support\Facades\Hash;
use App\studentLogin;
use App\me_students;
use App\admission;
use App\dd_details;
use App\fees_transaction;
use App\mca_students;
use App\dse_students; 
use Captcha;
use Validator;
use Illuminate\Support\Facades\Input;
// below header for mail
//use Image;
use Illuminate\Support\Facades\Mail;
use PDF;
use Storage;
use URL;
use App\fe_students;

class HomeController extends Controller
{
    public static function showAcapVacancy(Request $request)
    {
    return view('acap_vacancy_user');
    }
    
    public static function showAcapVacancyAdmin(Request $request)   
    {
    return view('acap_vacancy_admin');
    }
    
  public static function showMaintenance(Request $request)
    {
    return view('user.maintenance');
    }
  
  public static function showlogin(Request $request)
    {
    return view('user.login');
    }
    public static function showpay(Request $request)
    {
    return view('user.payReceipt');
    } 

    public static function meprogressbar($course,$dte_id){
  if($course == "MEG"){
     $userprogress = DB::table('me_students')->select('is_dte_completed','is_academic_completed','is_personal_completed','is_guardian_completed','is_contact_completed','is_document_completed')->where('dte_id', $dte_id)->get();

   }

      if(DB::table('admission')->where('dte_id', $dte_id)->exists())
            {
               $payment = DB::table('admission')->select('balance_amt')->where('dte_id',$dte_id)->get();
               if($payment[0]->balance_amt=="0")
                     {
                      $is_payment_forprogress=1;
                    }
                    else
                    {
                      $is_payment_forprogress=0;
                    }
            }
           else{
            $is_payment_forprogress=0;
            
            }
      $prog_val = 0;  
      $progress_array=array($userprogress[0]->is_dte_completed,$userprogress[0]->is_academic_completed,$userprogress[0]->is_personal_completed,$userprogress[0]->is_guardian_completed,$userprogress[0]->is_contact_completed,$userprogress[0]->is_document_completed,$is_payment_forprogress);
      $probar_per_count=0;
      for($initial_x=0;$initial_x<count($progress_array);$initial_x++)
      {
        $probar_per_count= $probar_per_count+$progress_array[$initial_x];
      }
        
        $prog_val = $probar_per_count;
        return   array($prog_val,$userprogress);   
  }
     public static function progressbar($course,$dte_id){
            if($course == "FEG"){

   
     $userprogress = DB::table('fe_students')->select('is_dte_details_completed','is_academic_completed','is_personal_completed','is_guardian_completed','is_contact_completed','is_document_completed')->where('dte_id', $dte_id)->get();

   }
   
   
   if($course == "DSE"){
     $userprogress = DB::table('dse_students')->select('is_dte_details_completed','is_academic_completed','is_personal_completed','is_guardian_completed','is_contact_completed','is_document_completed')->where('dte_id', $dte_id)->get();

   }
   if($course == "MCA"){
     $userprogress = DB::table('mca_students')->select('is_dte_details_completed','is_academic_completed','is_personal_completed','is_guardian_completed','is_contact_completed','is_document_completed')->where('dte_id', $dte_id)->get();

   }

      if(DB::table('admission')->where('dte_id', $dte_id)->exists())
            {
               $payment = DB::table('admission')->select('balance_amt')->where('dte_id',$dte_id)->get();
               if($payment[0]->balance_amt=="0")
                     {
                      $is_payment_forprogress=1;
                    }
                    else
                    {
                      $is_payment_forprogress=0;
                    }
            }
           else{
            $is_payment_forprogress=0;
            
            }
      $prog_val = 0;  
      // return $userprogress;
      $progress_array=array($userprogress[0]->is_dte_details_completed,$userprogress[0]->is_academic_completed,$userprogress[0]->is_personal_completed,$userprogress[0]->is_guardian_completed,$userprogress[0]->is_contact_completed,$userprogress[0]->is_document_completed,$is_payment_forprogress);
      $probar_per_count=0;
      for($initial_x=0;$initial_x<count($progress_array);$initial_x++)
      {
        $probar_per_count= $probar_per_count+$progress_array[$initial_x];
      }
        
        $prog_val = $probar_per_count;
        // return $progress_array;
        return   array($prog_val,$userprogress);   
  }

  public static  function checklogin(Request $request)
    {
    $dte = null;
    $acap = null;
    $dte_id = $request->input('dteId');
    $pass = $request->input('password');
    $request->session()->put('log_dte', $dte);
    $request->session()->put('log_acap', $acap);
    if (DB::table('student_login')->where('dte_id', $dte_id)->exists())
      {
      $user = DB::table('student_login')->select('mobile_verified', 'email_verified', 'stud_pwd')->where('dte_id', $dte_id)->get();
      if ($user[0]->mobile_verified == 1 && $user[0]->email_verified == 1)
        {
        //echo $pass;
        //return $user[0]->stud_pwd;
        if (Hash::check($pass, $user[0]->stud_pwd))
          //if($pass == $user[0]->stud_pwd )
          {
           $request->session()->put('log_dte_id', $dte_id);

           if (substr($dte_id, 0, 1) == 'D') 
            {
              $request->session()->put('log_course', 'DSE'); 
              return redirect()->route('dse_profile');
             }
           elseif (substr($dte_id, 0, 1) == 'E' || substr($dte_id, 0, 1) == 'P' || substr($dte_id, 0, 1) == 'N') 
             {
                 $request->session()->put('log_course', 'FEG'); 
                return redirect()->route('fe_profile');
             }
           elseif (substr($dte_id, 0, 2) == "MC") 
            {
               $request->session()->put('log_course', 'MCA'); 
              return redirect()->route('mca_profile');
           }
           elseif (substr($dte_id, 0, 2) == "ME") 
            {
                 $request->session()->put('log_course', 'MEG'); 
              return redirect()->route('me_profile');
             }
          }
          else
          {
              $request->session()->flash('error', 'Invalid Credentials');
              return view('user.login');
          }
        }
        else
        {
        if ($user[0]->mobile_verified == 1)
          {
          $request->session()->flash('error', 'Your email does not seem to be registered.');
          $request->session()->put('reg_dte_id',$dte_id);
          
          $user = DB::table('student_login')->select('email_verified','email')->where('dte_id', $dte_id)->get();
           $email=$user[0]->email;
           if($user[0]->email_verified == 1)
           {
            return redirect()->route('logout');
           }
           else
                return view('user.registerEmail')->with('email_id',$email);
          //return view('user.registerEmail');
          }
          else
          {
          $request->session()->flash('error', 'Your mobile does not seem to be registered.');
          $request->session()->put('reg_dte_id',$dte_id);
          
          $user = DB::table('student_login')->select('mobile_verified','mobile')->where('dte_id', $dte_id)->get();
           
           if($user[0]->mobile_verified == 1)
           {
            return redirect()->route('registerEmail');
           }
           else
           {
                $mobile1 = $user[0]->mobile;
              //  return $mobile1;
                return view('user.registerMobile')->with('mobile1',$mobile1);
           }
          //return view('user.registerMobile');
          }
        }
      }
      else
      {
      $request->session()->flash('error', 'You do not seem to be a registered User.');
      return view('user.login');
      }
    }

  public static function test($id, Request $request)
    {
       $course = $request->session()->get('log_course');
       $dte_id = $request->session()->get('log_dte_id');
       // return $id;
    if ($id == 'DTE')
      {
      $dte = 'yes';
      $acap = null;
      DB::table('student_login')->where('dte_id', $dte_id)->update(['dte_login' => 1]);
      $users = DB::select(DB::raw("SELECT event_to, status_to from status_details where dte_id LIKE '%".$dte_id."%' AND status_to = 'INITIATED' AND event_to LIKE '%".$id."%' ORDER BY updated_at DESC LIMIT 1"));
   //   return $users;
      
      if($users == [])
      {//return $users;
        DB::select("call insert_status_details_initiated('$dte_id','$course','$id')");
      }
      
      //if($users[0]->status_to == "INITIATED" AND $users[0]->event_to == "DTE")

      $request->session()->put('log_dte', $dte);
      $request->session()->put('log_acap', $acap);

      // return redirect()->route('logout');

     

        if($course == 'MEG')
        {
          return redirect()->route('me_dte_details');
        }
        else if($course == 'MCA')
        {
           return redirect()->route('mca_dte_details');
        }
         else if($course == 'FEG')
        {
           return redirect()->route('fe_dte_details');
        }
        else if($course == 'DSE')
        {
           return redirect()->route('dse_dte_details');
        }
        else
        {
             return redirect()->route('logout');
        }

      
     }
    elseif ($id == 'ACAP')
      {
      $acap = 'yes';
      $dte = null;
      $request->session()->put('log_dte', $dte);
      $request->session()->put('log_acap', $acap);
      DB::table('student_login')->where('dte_id', $dte_id)->update(['acap_login' => 1]);

         if($course == 'MEG')
        {
          //CHANGE AMOUNT TO 1770
          $check = DB::select(DB::raw("select * from fees_transaction where dte_id LIKE '%".$dte_id."%' AND trans_status = 'Success' AND trans_amt = '2360' AND course = 'MEGACAP' "));
          if($check == null || $check == [] )
           return redirect()->route('me_acap_form_payment');

         else
         {
          
          
          $users = DB::select(DB::raw("SELECT event_to, status_to from status_details where dte_id LIKE '%".$dte_id."%' AND status_to = 'INITIATED' AND event_to LIKE '%".$id."%' ORDER BY updated_at DESC LIMIT 1"));
   
                  if($users == [])
                  {  
                    DB::select("call insert_status_details_initiated('$dte_id','$course','$id')");
                  }
                  else 
                  {
            
                  }
                  
                  return redirect()->route('me_dte_details');
         }
          
        }
        else if($course == 'MCA')
        {
          //CHANGE AMOUNT TO 1770
          $check = DB::select(DB::raw("select * from fees_transaction where dte_id LIKE '%".$dte_id."%' AND trans_status = 'Success' AND trans_amt = '2360' AND course = 'MCAACAP' "));
          if($check == null || $check == [] )
           return redirect()->route('mca_acap_form_payment');

         else
         {
          
          
          $users = DB::select(DB::raw("SELECT event_to, status_to from status_details where dte_id LIKE '%".$dte_id."%' AND status_to = 'INITIATED' AND event_to LIKE '%".$id."%' ORDER BY updated_at DESC LIMIT 1"));
          
                  if($users == [])
                  {  
                    DB::select("call insert_status_details_initiated('$dte_id','$course','$id')");
                  }
                  else 
                  {
            
                  }
                  
                  return redirect()->route('mca_dte_details');
         }
        }

         else if($course == 'FEG')
        {
          //CHANGE AMOUNT TO 1770
          $check = DB::select(DB::raw("select * from fees_transaction where dte_id LIKE '%".$dte_id."%' AND trans_status = 'Success' AND trans_amt = '2360' AND course = 'FEGACAP' "));
          if($check == null || $check == [] ){
           return redirect()->route('fe_acap_form_payment');
          }
          else
          {
          // return $id;
          
            $users = DB::select(DB::raw("SELECT event_to, status_to from status_details where dte_id LIKE '%".$dte_id."%' AND status_to = 'INITIATED' AND event_to LIKE '%".$id."%' ORDER BY updated_at DESC LIMIT 1"));
        // return $users;
                  if($users == [])
                  {  
                    DB::select("call insert_status_details_initiated('$dte_id','$course','$id')");/// make this chages if we need to make it without payment 
                  }
                  else 
                  {
            
                  }
            
            // return $users;
            //       if($users == [])
            //       {  
                    DB::select("call insert_status_details_initiated('$dte_id','$course','$id')");/// make this chages if we need to make it without payment 
                  // }
                  // else 
                  // {
            
                  // }
                  
                  return redirect()->route('fe_dte_details');
         }
        }
        else if($course == 'DSE')
        {
          //CHANGE AMOUNT TO 1770
          $check = DB::select(DB::raw("select * from fees_transaction where dte_id LIKE '%".$dte_id."%' AND trans_status = 'Success' AND trans_amt = '2360' AND course = 'DSEACAP' "));
          if($check == null || $check == [] )
           return redirect()->route('dse_acap_form_payment');
         //dse_acap_form_payment

         else
         {
          
          
          $users = DB::select(DB::raw("SELECT event_to, status_to from status_details where dte_id LIKE '%".$dte_id."%' AND status_to = 'INITIATED' AND event_to LIKE '%".$id."%' ORDER BY updated_at DESC LIMIT 1"));
            //return $users;  
                  if($users == [])
                  {  
                    DB::select("call insert_status_details_initiated('$dte_id','$course','$id')");
                   // return $users;
                  }
                  else 
                  {
            
                  }
                  
                  return redirect()->route('dse_dte_details');
         }
        }
        else
        {
             return redirect()->route('logout');
        }
      
      }
    }
    
    
    public static function aes128Encrypt($str,$key){
        $block = mcrypt_get_block_size('rijndael_128', 'ecb');
        $pad = $block - (strlen($str) % $block);
        $str .= str_repeat(chr($pad), $pad);
        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $str, MCRYPT_MODE_ECB));
    }

     public static function payFeeDD(Request $request)
    {
        $key = '1862392036201268';

         $newEncrypter = new \Illuminate\Encryption\Encrypter( $key,config('app.cipher'));

    // $mandatory = $refNo.'|'.$submerchantid.'|'.$amount.'|'.$dte_id.'|'.$email;
         // $encMandatory = $newEncrypter->encrypt($mandatory);
            //return $encMandatory; 

        $dte_id =$request->session()->get('log_dte_id', 'null');
      //  $fees_transaction  = fees_transaction::find(10);
             // return $fees_transaction;
      //  return $dte_id;
         // return $dte_id;
        //$submerchantid='';
        if ($dte_id != 'null') 
        {
          
          $user=DB::table('student_login')->where('dte_id', $dte_id)->get();
          $email=$user[0]->email; 
          $course=$user[0]->course;
          $DTE=$request->session()->get('log_dte');
          $ACAP=$request->session()->get('log_acap');
        //return $course;
        //11 acap reg,12 acapp fees ,22 dte fees
          //1-feg,2 -dse,3-Mca,4-meg
          if($course == 'FEG') {
                  if($ACAP == null) { 
                      $submerchantid = '122'; 
                  }
                  else { 
                      $submerchantid = '111'; 
                  }
              }
            if($course == 'DSE') {
                  if($ACAP == null) { 
                      $submerchantid = '222'; 
                  }
                  else { 
                      $submerchantid = '211'; 
                  }
              }
          if($course == 'MEG') {
                  if($ACAP == null) { 
                      $submerchantid = '422'; 
                  }
                  else { 
                      $submerchantid = '411'; 
                  }
              }

          if($course == 'MCA') {
                  if($ACAP == null) { 
                      $submerchantid = '322'; 
                  }
                  else { 
                      $submerchantid = '311'; 
                  }
              }
          if($ACAP==null)
          {
             $event_type = "DTE";
             $optn = $course."DTE";
             $amount = $request->input('amount');
            //return $optn;
          }
          if($DTE==null)
          {
            $event_type = "ACAP";
            $optn = $course."ACAP";
             $amount = 2360;//ACAP FORM FEES
            //return $optn;
          }
         //return $amount;
         
          
          $data = false;
          while(!$data)
          {
               $numbers = range(910000, 919999);
               shuffle($numbers);  
               $randno=array_slice($numbers, 0, 1);
             
              $user1 = DB::table('fees_transaction')->select('trans_id')->where('ref_no', $randno[0])->get();
                
             
                        if($user1 == [])
                        {
                            $data = false;
                          
                        }
                         else
                          $data = true;
              
          }
        
       
         $user1 = DB::table('student_login')->select('email')->where('dte_id', $dte_id)->get();
         $email = $user1[0]->email;
          $randNo=$randno[0];                                             
          $fees_transaction = new fees_transaction;
          $fees_transaction->ref_no= $randNo;
          $fees_transaction->dte_id=$dte_id;
          $fees_transaction->sub_merchant_id=$submerchantid;
          $fees_transaction->course=$optn;
          $fees_transaction->init_amt=$amount;
          $fees_transaction->admission_type=$event_type;
          $fees_transaction->save(); 
          //return $fees_transaction;
            //return $key;
          $refNo = $randNo;

          //$key = '1862392036201268';
          $paymode = '9';
          $returnurl = 'https://vesitadmissions.ves.ac.in/admissionForms/pg/index.php/pstatus';
         
          $newEncrypter = new \Illuminate\Encryption\Encrypter( $key,config('app.cipher'));

          $mandatory = $refNo.'|'.$submerchantid.'|'.$amount.'|'.$dte_id.'|'.$email.'|'.$optn;
      $encMandatory =(new static)->aes128Encrypt($mandatory,$key);
      //return $encMandatory;
 
      //$encOptn = (new static)->aes128Encrypt($optn,$key);
        
      $encRef = (new static)->aes128Encrypt($refNo,$key);
      $encSubmerchantid = (new static)->aes128Encrypt($submerchantid,$key);
      $encAmount =(new static)->aes128Encrypt($amount,$key);
      $encPaymode = (new static)->aes128Encrypt($paymode,$key);
      $encReturn =(new static)->aes128Encrypt($returnurl,$key);
     //return $encRef;
   return view('user.paymentGateway')->with('refNo',$refNo)->with('submerchantid',$submerchantid)->with('paymode',$paymode)->with('amount',$amount);
//fe-dse 131198
      //icid=183625
      // $url = 'https://eazypay.icicibank.com/EazyPG?merchantid=183625&mandatory fields='.$encMandatory.'&optional fields=&returnurl='.$encReturn.'&Reference No='.$encRef.'&submerchantid='.$encSubmerchantid.'&transaction amount='.$encAmount.'&paymode='.$encPaymode;
      $url = 'https://eazypay.icicibank.com/EazyPG?icid=183625&mandatory fields='.$encMandatory.'&optional fields=&returnurl='.$encReturn.'&Reference No='.$encRef.'&submerchantid='.$encSubmerchantid.'&transaction amount='.$encAmount.'&paymode='.$encPaymode;
     // return $url;
     //  return "hvdjh";
     return redirect($url);
                                                                                      
        }   
    }
    
    public static function showpayReceipt(Request $request)
    {
      return view('user.payReceipt');
    }


    public static function showpayGateway(Request $request)
    {
      return view('user.paymentGateway');
    }

    /*public static function postpayGateway(Request $request)
    {

    }*/

    public static function returnStatus(Request $request)
    {
    
      
      if(!empty($_POST))
      {

          $status="";
          if($_POST['Response_Code'] == "E000"){$status="Success";}
          if($_POST['Response_Code'] == "E001"){$status="Unauthorized Payment Mode";}
          if($_POST['Response_Code'] == "E002"){$status="Unauthorized Key";}
          if($_POST['Response_Code'] == "E003"){$status="Unauthorized Packet";}
          if($_POST['Response_Code'] == "E004"){$status="Unauthorized Merchant";}
          if($_POST['Response_Code'] == "E005"){$status="Unauthorized Return URL";}
          if($_POST['Response_Code'] == "E006"){$status="Transaction Already Paid";}
          if($_POST['Response_Code'] == "E007"){$status="Transaction Failed";}
          if($_POST['Response_Code'] == "E008"){$status="Failure from Third Party due to Technical Error or Funds Shortage";}
          if($_POST['Response_Code'] == "E0031"){$status="Mandatory fields coming from merchant are empty";}
          if($_POST['Response_Code'] == "E0032"){$status="Mandatory fields coming from database are empty";}
          if($_POST['Response_Code'] == "E0033"){$status="Payment mode coming from merchant is empty";}
          if($_POST['Response_Code'] == "E0034"){$status="PG Reference number coming from merchant is empty";}
          if($_POST['Response_Code'] == "E0035"){$status="Sub merchant id coming from merchant is empty";}
          if($_POST['Response_Code'] == "E0036"){$status="Transaction amount coming from merchant is empty";}
          if($_POST['Response_Code'] == "E0037"){$status="Payment mode coming from merchant is other than 0 to 9";}
          if($_POST['Response_Code'] == "E0038"){$status="Transaction amount coming from merchant is more than 9 digit length";}
          if($_POST['Response_Code'] == "E0039"){$status="Mandatory value Email in wrong format";}
          if($_POST['Response_Code'] == "E00310"){$status="Mandatory value mobile number in wrong format";}
          if($_POST['Response_Code'] == "E00311"){$status="Mandatory value amount in wrong format";}
          if($_POST['Response_Code'] == "E00312"){$status="Mandatory value Pan card in wrong format";}
          if($_POST['Response_Code'] == "E00313"){$status="Mandatory value Date in wrong format";}
          if($_POST['Response_Code'] == "E00314"){$status="Mandatory value String in wrong format";}
          if($_POST['Response_Code'] == "E00315"){$status="Optional value Email in wrong format";}
          if($_POST['Response_Code'] == "E00316"){$status="Optional value mobile number in wrong format";}
          if($_POST['Response_Code'] == "E00317"){$status="Optional value amount in wrong format";}
          if($_POST['Response_Code'] == "E00318"){$status="Optional value pan card number in wrong format";}
          if($_POST['Response_Code'] == "E00319"){$status="Optional value date in wrong format";}
          if($_POST['Response_Code'] == "E00320"){$status="Optional value string in wrong format";}
          if($_POST['Response_Code'] == "E00321"){$status="Request packet mandatory columns is not equal to mandatory columns set in enrolment or optional columns are not equal to optional columns length set in enrolment";}
          if($_POST['Response_Code'] == "E00324"){$status="Merchant Reference Number and Mandatory Columns are Null";}
          if($_POST['Response_Code'] == "E00325"){$status="Merchant Reference Number Duplicate";}
          if($_POST['Response_Code'] == "E00326"){$status="Sub merchant id coming from merchant is non numeric";}
          if($_POST['Response_Code'] == "E00327"){$status="Cash Challan Generated";}
          if($_POST['Response_Code'] == "E00328"){$status="Cheque Challan Generated";}
          if($_POST['Response_Code'] == "E00329"){$status="NEFT Challan Generated";}
          if($_POST['Response_Code'] == "E00330"){$status="Transaction Amount and Mandatory Transaction Amount mismatch in Request URL";}

          $transID = 'NA';
          $sTaxAmt = 0;
          $pFeeAmt = 0;
          $totalAmt = 0;
          $transAmt = 0;
          $transTimestamp = '0000-00-00 00:00:00';
          $paymentMode = 'NA';
          $refNo = '';


          if(isset($_POST['Unique_Ref_Number'])){if($_POST['Unique_Ref_Number']!=null || $_POST['Unique_Ref_Number']!=''){$transID = $_POST['Unique_Ref_Number'];}}
          if(isset($_POST['Service_Tax_Amount'])){if($_POST['Service_Tax_Amount']!=null || $_POST['Service_Tax_Amount']!=''){$sTaxAmt = $_POST['Service_Tax_Amount'];}}
          if(isset($_POST['Processing_Fee_Amount'])){if($_POST['Processing_Fee_Amount']!=null || $_POST['Processing_Fee_Amount']!=''){$pFeeAmt = $_POST['Processing_Fee_Amount'];}}
          if(isset($_POST['Total_Amount'])){if($_POST['Total_Amount']!=null || $_POST['Total_Amount']!=''){$totalAmt = $_POST['Total_Amount'];}}
          if(isset($_POST['Transaction_Amount'])){if($_POST['Transaction_Amount']!=null || $_POST['Transaction_Amount']!=''){$transAmt = $_POST['Transaction_Amount'];}}
          if(isset($_POST['Transaction_Date'])){if($_POST['Transaction_Date']!=null || $_POST['Transaction_Date']!=''){$transTimestamp = $_POST['Transaction_Date'];}}
          if(isset($_POST['Payment_Mode'])){if($_POST['Payment_Mode']!=null || $_POST['Payment_Mode']!=''){$paymentMode = $_POST['Payment_Mode'];}}
          if(isset($_POST['ReferenceNo'])){if($_POST['ReferenceNo']!=null || $_POST['ReferenceNo']!=''){$refNo = $_POST['ReferenceNo'];}}


           /*DB::select("call update_student_login_verify_email('$transID','$sTaxAmt',$pFeeAmt,$totalAmt,$transAmt,$transTimestamp,$paymentMode,$status,$refNo)");//change the procedure name*/
             $dte_id = $request->session()->get('log_dte_id');
           $id = DB::table('fees_transaction')->select('master_trans_id')->where('ref_no', $_POST['ReferenceNo'])->get();
           $fees_transaction = fees_transaction::find($id[0]->master_trans_id);
           $fees_transaction->trans_id = $_POST['Unique_Ref_Number'];
           $fees_transaction->s_tax_amt = $_POST['Service_Tax_Amount'];
           $fees_transaction->p_fee_amt = $_POST['Processing_Fee_Amount'];
           $fees_transaction->total_amt = $_POST['Total_Amount'];
           $fees_transaction->trans_amt = $_POST['Transaction_Amount'];
           $fees_transaction->trans_timestamp = $_POST['Transaction_Date'];
           $fees_transaction->payment_mode = $_POST['Payment_Mode'];
           $fees_transaction->payment_timestamp=$_POST['Transaction_Date'];
           $fees_transaction->trans_status = $status;
           $fees_transaction->save();

                $request->session()->put('response_code',$_POST['Response_Code']);
                $request->session()->put('submerchantId', $_POST['SubMerchantId']);
            $course = $_POST['SubMerchantId'];
            

             if($course == "311")//MCA AGCAP REGIS
           {
              
                $user1 = DB::table('fees_transaction')->select('dte_id','master_trans_id')->where('ref_no', $_POST['ReferenceNo'])->get(); 
                if($user1!= [])
               {
                    $dte_id=$user1[0]->dte_id;
                    $master_trans_id = $user1[0]->master_trans_id;
               }
 
              
               if($_POST['Response_Code']=="E000" || $_POST['Response_Code']=="E00327" || $_POST['Response_Code']=="E00328" || $_POST['Response_Code']=="E00329")
                {
                  DB::table('student_login')->where('dte_id', $dte_id)->update(['acap_login' => 1]);
                  $fees = fees_transaction::find($master_trans_id);
                  $fees->response_code = $_POST['Response_Code'];
                  $fees->admission_type = "ACAP";
                  $fees->save();
                  //return redirect()->route('mca_dte_details'); complete pay fee function

                }
            
            
          }

        
              if($course == "312")//Mca AGCAP fees payment
           {
               $user1 = DB::table('fees_transaction')->select('dte_id','master_trans_id')->where('ref_no', $_POST['ReferenceNo'])->get();
               if($user1!=[])
               {
                    $dte_id=$user1[0]->dte_id;
                    $master_trans_id =$user1[0]->master_trans_id;
               }
               if($_POST['Response_Code']=="E000" || $_POST['Response_Code']=="E00327" || $_POST['Response_Code']=="E00328" || $_POST['Response_Code']=="E00329")
                {
                    
                    $user1 = DB::select(DB::raw(" SELECT category  FROM `mca_students` WHERE dte_id LIKE '%".$dte_id."%' "));
                    $category= $user1[0]->category;
                    $user = DB::select(DB::raw("SELECT amt FROM fees_structure WHERE fee_category LIKE '%".$category."%' and course='MCA' "));
                    date_default_timezone_set("Asia/Kolkata");
                
                    $user3 = DB::select(DB::raw("SELECT * FROM admission WHERE dte_id LIKE '%".$dte_id."%'  and status='INCOMPLETE' and admission_type = 'ACAP' "));
                          
                  $Admission = admission::find($user3[0]->admission_id);
                  $Admission->paid_amt =  $_POST['Transaction_Amount'];
                  $Admission->updated_at = date("Y-m-d H:i:s");
                  $Admission->balance_amt = 0;
                  $Admission->save();
                  
                  $fees = fees_transaction::find($master_trans_id);
                  $fees->response_code = $_POST['Response_Code'];
                  $fees->save();

                  /* if( DB::table('acap_payment')->where('dte_id', $dte_id)->update(['agcapregisfees' => 1]))
                   {
                          //refresh the admin Account page to show the current status of payment detail(student complete it's payment process or not) for ACAP student
                   }*/
                }
              
              else
              {
                  //return redirect()->route('me_acap_form_payment');
                  //refresh the admin Account page to show the current status of payment detail(student complete it's payment process or not) for ACAP student
              }
          }

            if($course == "322") //MCA DTE Admission fees
          {
                $user1 = DB::table('fees_transaction')->select('dte_id','master_trans_id')->where('ref_no', $_POST['ReferenceNo'])->get();  
                if($user1!= [])
               {
                    $dte_id=$user1[0]->dte_id;
                    $master_trans_id = $user1[0]->master_trans_id;
               }
               if($_POST['Response_Code']=="E000" || $_POST['Response_Code']=="E00327" || $_POST['Response_Code']=="E00328" || $_POST['Response_Code']=="E00329")
               {

                    $users= DB::select(DB::raw("SELECT admission_id, paid_amt, balance_amt from admission where dte_id LIKE '%".$dte_id."%' AND status = 'INCOMPLETE' ORDER BY updated_at DESC LIMIT 1"));
                  $Admission = admission::find($users[0]->admission_id);
                  $Admission->paid_amt =  $_POST['Transaction_Amount'];
                  $Admission->granted_amt =  $_POST['Transaction_Amount'];
                  $Admission->balance_amt =0;
                  $Admission->save();
                  
                  $fees = fees_transaction::find($master_trans_id);
                  $fees->admission_id = $users[0]->admission_id;
                  $fees->response_code = $_POST['Response_Code'];
                  $fees->save();
                  //return redirect()->route('me_document_upload');
                  
               }
               
      
          }

             if($course == "111")//FEG AGCAP REGIS
           {
                $user1 = DB::table('fees_transaction')->select('dte_id','master_trans_id')->where('ref_no', $_POST['ReferenceNo'])->get(); 
                if($user1!= [])
               {
                    $dte_id=$user1[0]->dte_id;
                    $master_trans_id = $user1[0]->master_trans_id;
               }
 
              
               if($_POST['Response_Code']=="E000" || $_POST['Response_Code']=="E00327" || $_POST['Response_Code']=="E00328" || $_POST['Response_Code']=="E00329")
                {
                  DB::table('student_login')->where('dte_id', $dte_id)->update(['acap_login' => 1]);
                  $fees = fees_transaction::find($master_trans_id);
                  $fees->response_code = $_POST['Response_Code'];
                  $fees->admission_type = "ACAP";
                  $fees->save();
                  

                }
          }
          if($course == "112") //FE AGCAP Admission fees
          {
               $user1 = DB::table('fees_transaction')->select('dte_id','master_trans_id')->where('ref_no', $_POST['ReferenceNo'])->get();
               if($user1!=[])
               {
                    $dte_id=$user1[0]->dte_id;
                    $master_trans_id =$user1[0]->master_trans_id;
               }
               if($_POST['Response_Code']=="E000" || $_POST['Response_Code']=="E00327" || $_POST['Response_Code']=="E00328" || $_POST['Response_Code']=="E00329")
                {
                    
                    $user1 = DB::select(DB::raw(" SELECT category  FROM `fe_students` WHERE dte_id LIKE '%".$dte_id."%' "));
                    $category= $user1[0]->category;
                    $user = DB::select(DB::raw("SELECT amt FROM fees_structure WHERE fee_category LIKE '%".$category."%' and course='FEG' "));
                    date_default_timezone_set("Asia/Kolkata");
                
                    $user3 = DB::select(DB::raw("SELECT * FROM admission WHERE dte_id LIKE '%".$dte_id."%'  and status='INCOMPLETE' and admission_type = 'ACAP' "));
                    // return $user3;     
                  $Admission = admission::find($user3[0]->admission_id);
                  $Admission->paid_amt =  $_POST['Transaction_Amount'];
                  $Admission->updated_at = date("Y-m-d H:i:s");
                  $Admission->balance_amt = 0;
                  $Admission->save();
                  
                  $fees = fees_transaction::find($master_trans_id);
                  $fees->response_code = $_POST['Response_Code'];
                  $fees->save();

                 
                }
              
          }



           if($course == "122") //FE DTE Admission fees
          {
               
                $user1 = DB::table('fees_transaction')->select('dte_id','master_trans_id')->where('ref_no', $_POST['ReferenceNo'])->get();  
                if($user1!= [])
               {
                    $dte_id=$user1[0]->dte_id;
                    $master_trans_id = $user1[0]->master_trans_id;
               }
               if($_POST['Response_Code']=="E000" || $_POST['Response_Code']=="E00327" || $_POST['Response_Code']=="E00328" || $_POST['Response_Code']=="E00329")
               {

                    $users= DB::select(DB::raw("SELECT admission_id, paid_amt, balance_amt from admission where dte_id LIKE '%".$dte_id."%' AND status = 'INCOMPLETE' ORDER BY updated_at DESC LIMIT 1"));
                  $Admission = admission::find($users[0]->admission_id);
                  $Admission->paid_amt =  $_POST['Transaction_Amount'];
                  $Admission->granted_amt =  $_POST['Transaction_Amount'];
                  $Admission->balance_amt =0;
                  $Admission->save();
                  
                  $fees = fees_transaction::find($master_trans_id);
                  $fees->admission_id = $users[0]->admission_id;
                  $fees->response_code = $_POST['Response_Code'];
                  $fees->save();
      
          }
        }
            if($course == "211")//DSE AGCAP REGIS
           {
               $user1 = DB::table('fees_transaction')->select('dte_id','master_trans_id')->where('ref_no', $_POST['ReferenceNo'])->get(); 
                if($user1!= [])
               {
                    $dte_id=$user1[0]->dte_id;
                    $master_trans_id = $user1[0]->master_trans_id;
               }
 
              
               if($_POST['Response_Code']=="E000" || $_POST['Response_Code']=="E00327" || $_POST['Response_Code']=="E00328" || $_POST['Response_Code']=="E00329")
                {
                  DB::table('student_login')->where('dte_id', $dte_id)->update(['acap_login' => 1]);
                  $fees = fees_transaction::find($master_trans_id);
                  $fees->response_code = $_POST['Response_Code'];
                  $fees->admission_type = "ACAP";
                  $fees->save();
                  //return redirect()->route('mca_dte_details'); complete pay fee function

                }
          }
          if($course == "212") //DSE AGCAP Admission fees
          {
               $user1 = DB::table('fees_transaction')->select('dte_id','master_trans_id')->where('ref_no', $_POST['ReferenceNo'])->get();
               if($user1!=[])
               {
                    $dte_id=$user1[0]->dte_id;
                    $master_trans_id =$user1[0]->master_trans_id;
               }
               if($_POST['Response_Code']=="E000" || $_POST['Response_Code']=="E00327" || $_POST['Response_Code']=="E00328" || $_POST['Response_Code']=="E00329")
                {
                    
                    $user1 = DB::select(DB::raw(" SELECT category  FROM `dse_students` WHERE dte_id LIKE '%".$dte_id."%' "));
                    $category= $user1[0]->category;
                    $user = DB::select(DB::raw("SELECT amt FROM fees_structure WHERE fee_category LIKE '%".$category."%' and course='DSE' "));
                    date_default_timezone_set("Asia/Kolkata");
                
                    $user3 = DB::select(DB::raw("SELECT * FROM admission WHERE dte_id LIKE '%".$dte_id."%'  and status='INCOMPLETE' and admission_type = 'ACAP' "));
                          
                  $Admission = admission::find($user3[0]->admission_id);
                  $Admission->paid_amt =  $_POST['Transaction_Amount'];
                  $Admission->updated_at = date("Y-m-d H:i:s");
                  $Admission->balance_amt = 0;
                  $Admission->save();
                  
                  $fees = fees_transaction::find($master_trans_id);
                  $fees->response_code = $_POST['Response_Code'];
                  $fees->save();

                 
                }
          }



           if($course == "222") //DSE DTE Admission fees
          {
                $user1 = DB::table('fees_transaction')->select('dte_id','master_trans_id')->where('ref_no', $_POST['ReferenceNo'])->get();  
                if($user1!= [])
               {
                    $dte_id=$user1[0]->dte_id;
                    $master_trans_id = $user1[0]->master_trans_id;
               }
               if($_POST['Response_Code']=="E000" || $_POST['Response_Code']=="E00327" || $_POST['Response_Code']=="E00328" || $_POST['Response_Code']=="E00329")
               {

                    $users= DB::select(DB::raw("SELECT admission_id, paid_amt, balance_amt from admission where dte_id LIKE '%".$dte_id."%' AND status = 'INCOMPLETE' ORDER BY updated_at DESC LIMIT 1"));
                  $Admission = admission::find($users[0]->admission_id);
                  $Admission->paid_amt =  $_POST['Transaction_Amount'];
                  $Admission->granted_amt =  $_POST['Transaction_Amount'];
                  $Admission->balance_amt =0;
                  $Admission->save();
                  
                  $fees = fees_transaction::find($master_trans_id);
                  $fees->admission_id = $users[0]->admission_id;
                  $fees->response_code = $_POST['Response_Code'];
                  $fees->save();
                }
      
          }

           if($course == "411")//ME AGCAP REGIS
           {
                  $user1 = DB::table('fees_transaction')->select('dte_id','master_trans_id')->where('ref_no', $_POST['ReferenceNo'])->get(); 
                if($user1!= [])
               {
                    $dte_id=$user1[0]->dte_id;
                    $master_trans_id = $user1[0]->master_trans_id;
               }
 
               
               if($_POST['Response_Code']=="E000" || $_POST['Response_Code']=="E00327" || $_POST['Response_Code']=="E00328" || $_POST['Response_Code']=="E00329")
                {
                  DB::table('student_login')->where('dte_id', $dte_id)->update(['acap_login' => 1]);
                  $fees = fees_transaction::find($master_trans_id);
                  $fees->response_code = $_POST['Response_Code'];
                  $fees->admission_type = "ACAP";
                  $fees->save();
                  //return redirect()->route('mca_dte_details'); complete pay fee function

                }
            
         
          }

          if($course == "412") //ME AGCAP Admission fees
          {
               $user1 = DB::table('fees_transaction')->select('dte_id','master_trans_id')->where('ref_no', $_POST['ReferenceNo'])->get();
               if($user1!=[])
               {
                    $dte_id=$user1[0]->dte_id;
                    $master_trans_id =$user1[0]->master_trans_id;
               }
               if($_POST['Response_Code']=="E000" || $_POST['Response_Code']=="E00327" || $_POST['Response_Code']=="E00328" || $_POST['Response_Code']=="E00329")
                {
                    
                    $user1 = DB::select(DB::raw(" SELECT category  FROM `me_students` WHERE dte_id LIKE '%".$dte_id."%' "));
                    $category= $user1[0]->category;
                    $user = DB::select(DB::raw("SELECT amt FROM fees_structure WHERE fee_category LIKE '%".$category."%' and course='MEG' "));
                    date_default_timezone_set("Asia/Kolkata");
                
                    $user3 = DB::select(DB::raw("SELECT * FROM admission WHERE dte_id LIKE '%".$dte_id."%'  and status='INCOMPLETE' and admission_type = 'ACAP' "));
                          
                  $Admission = admission::find($user3[0]->admission_id);
                  $Admission->paid_amt =  $_POST['Transaction_Amount'];
                  $Admission->updated_at = date("Y-m-d H:i:s");
                  $Admission->balance_amt = 0;
                  $Admission->save();
                  
                  $fees = fees_transaction::find($master_trans_id);
                  $fees->response_code = $_POST['Response_Code'];
                  $fees->save();

                 
                }
      
          }



           if($course == "422") //ME DTE Admission fees
          {
                   $user1 = DB::table('fees_transaction')->select('dte_id','master_trans_id')->where('ref_no', $_POST['ReferenceNo'])->get(); 
                  // return $user1;
                if($user1!= [])
               {
                    $dte_id=$user1[0]->dte_id;
                    $master_trans_id = $user1[0]->master_trans_id;
               }
               if($_POST['Response_Code']=="E000" || $_POST['Response_Code']=="E00327" || $_POST['Response_Code']=="E00328" || $_POST['Response_Code']=="E00329")
               {

                    $users= DB::select(DB::raw("SELECT admission_id, paid_amt, balance_amt from admission where dte_id LIKE '%".$dte_id."%' AND status = 'INCOMPLETE' ORDER BY updated_at DESC LIMIT 1"));
                  $Admission = admission::find($users[0]->admission_id);
                  $Admission->paid_amt =  $_POST['Transaction_Amount'];
                  $Admission->granted_amt =  $_POST['Transaction_Amount'];
                  $Admission->balance_amt =0;
                  $Admission->save();
                  
                  $fees = fees_transaction::find($master_trans_id);
                  $fees->admission_id = $users[0]->admission_id;
                  $fees->response_code = $_POST['Response_Code'];
                  $fees->save();
                  //return redirect()->route('me_document_upload');
                  
               }
               
      
      
          }


             
          

          $referenceNo=$_POST['ReferenceNo'];
          $UniqueRefNumber=$_POST['Unique_Ref_Number'];
          $referenceCode=$_POST['Response_Code'];

            $data = [];
            $data['referenceNo'] = $referenceNo;
            $data['transaction_ID']=$UniqueRefNumber;
            $data['referenceCode']=$referenceCode;
            $data['status']=$status;
            $data['event'] = $course;
            return view('user.payReceipt',$data);

        }
    }

    public static function completePayFee(Request $request)
    {
        $submerchantId = $request->session()->get('submerchantId',null);
        $responsecode = $request->session()->get('response_code',null);
        //return $submerchantId;
        if($submerchantId == "111")
        {
            if($responsecode=="E000" || $responsecode=="E00327" || $responsecode=="E00328" || $responsecode=="E00329")
            {
                return redirect()->route('fe_dte_details'); 
            }
            else
            {
                return redirect()->route('fe_acap_form_payment');
            }
        }
        
         if($submerchantId == "112")
        {
            if($responsecode=="E000" || $responsecode=="E00327" || $responsecode=="E00328" || $responsecode=="E00329")
            {
                    $request->session()->flash('error','Payment Successfull.');
                return redirect()->route('adminAdmit'); 
                
            }
            else
            {
                return redirect()->route('adminAdmit');
            }
        }
        
         if($submerchantId == "122")
        {
            if($responsecode=="E000" || $responsecode=="E00327" || $responsecode=="E00328" || $responsecode=="E00329")
            {
               return redirect()->route('fe_final_submit');
            }
            else
            {
                return redirect()->route('fe_admission_payment');
            }
        }
        if($submerchantId == "211")
        {
            if($responsecode=="E000" || $responsecode=="E00327" || $responsecode=="E00328" || $responsecode=="E00329")
            {
                return redirect()->route('dse_dte_details'); 
            }
            else
            {
                return redirect()->route('dse_profile');
            }
        }
        
         if($submerchantId == "212")
        {
            if($responsecode=="E000" || $responsecode=="E00327" || $responsecode=="E00328" || $responsecode=="E00329")
            {
                    $request->session()->flash('error','Payment Successfull.');
                return redirect()->route('adminAdmit'); 
                
            }
            else
            {
                return redirect()->route('adminAdmit');
            }
        }
        
         if($submerchantId == "222")
        {
            if($responsecode=="E000" || $responsecode=="E00327" || $responsecode=="E00328" || $responsecode=="E00329")
            {
               return redirect()->route('dse_final_submit');
            }
            else
            {
                return redirect()->route('dse_admission_payment');
            }
        }
    
        if($submerchantId == "311")
        {
            if($responsecode=="E000" || $responsecode=="E00327" || $responsecode=="E00328" || $responsecode=="E00329")
            {
                return redirect()->route('mca_dte_details'); 
            }
            else
            {
                return redirect()->route('mca_profile');
            }
        }
        
         if($submerchantId == "312")
        {
            if($responsecode=="E000" || $responsecode=="E00327" || $responsecode=="E00328" || $responsecode=="E00329")
            {
                    $request->session()->flash('error','Payment Successfull.');
                return redirect()->route('adminAdmit'); 
                
            }
            else
            {
                return redirect()->route('adminAdmit');
            }
        }
        
         if($submerchantId == "322")
        {
            if($responsecode=="E000" || $responsecode=="E00327" || $responsecode=="E00328" || $responsecode=="E00329")
            {
               return redirect()->route('mca_final_submit');
            }
            else
            {
                return redirect()->route('mca_admission_payment');
            }
        }
      if($submerchantId == "411")
        {
            if($responsecode=="E000" || $responsecode=="E00327" || $responsecode=="E00328" || $responsecode=="E00329")
            {
                
                 return redirect()->route('me_dte_details');  
            }
            else
            {    return redirect()->route('me_profile');
            }
        }

        if($submerchantId == "412")
        {
            if($responsecode=="E000" || $responsecode=="E00327" || $responsecode=="E00328" || $responsecode=="E00329")
            {
                $request->session()->flash('error','Payment Successfull.');
                return redirect()->route('adminAdmit'); 
            }
            else
            {    return redirect()->route('adminAdmit'); 
            }
        }
         if($submerchantId == "422")
        {
            if($responsecode=="E000" || $responsecode=="E00327" || $responsecode=="E00328" || $responsecode=="E00329")
            {
                 return redirect()->route('me_final_submit'); 
            }
            else
            {   
                 
                return redirect()->route('me_admission_payment');
            }
        }
        
    
      
    }






 public static function delete($id, Request $request)
    {
        $dte_id = $request->session()->get('log_dte_id');
        $course = $request->session()->get('log_course');
        if($course == "MEG")
        {
        $column_name1=$id;
        $column_name2=$id.'_path';
        $me_students = new me_students;
        if(DB::table('me_students')->where('dte_id', $dte_id)->exists()) 
          { 
           DB::table('me_students')->where('dte_id', $dte_id)->update([$column_name1 => null,$column_name2 => null]);
           return redirect()->route('me_document_upload');
          }
          else
          {
           return redirect()->route('me_document_upload');
          }
        }

        if($course == "MCA")
        {
        $column_name1=$id;
        $column_name2=$id.'_path';
        $mca_students = new mca_students;
        if(DB::table('mca_students')->where('dte_id', $dte_id)->exists()) 
          { 
           DB::table('mca_students')->where('dte_id', $dte_id)->update([$column_name1 => null,$column_name2 => null]);
           return redirect()->route('mca_document_upload');
          }
          else
          {
           return redirect()->route('mca_document_upload');
          }
        }
        if($course == "FEG")
        {
        $column_name1=$id;
        $column_name2=$id.'_path';
        $fe_students = new fe_students;
        if(DB::table('fe_students')->where('dte_id', $dte_id)->exists()) 
          { 
           DB::table('fe_students')->where('dte_id', $dte_id)->update([$column_name1 => null,$column_name2 => null]);
           return redirect()->route('fe_document_upload');
          }
          else
          {
           return redirect()->route('fe_document_upload');
          }
        }
        if($course == "DSE")
        {
        $column_name1=$id;
        $column_name2=$id.'_path';
        $dse_students = new dse_students;
        if(DB::table('dse_students')->where('dte_id', $dte_id)->exists()) 
          { 
           DB::table('dse_students')->where('dte_id', $dte_id)->update([$column_name1 => null,$column_name2 => null]);
            if(Session('log_acap')!="yes")
              return redirect()->route('dse_document_upload');
            else
              return redirect()->route('dse_acap_document_upload');
          }
          else
          {
           if(Session('log_acap')!="yes")
              return redirect()->route('dse_document_upload');
           else
              return redirect()->route('dse_acap_document_upload');
          }
        }
    }

  public static function showForgotPasssword(Request $request)
    {
    return view('user.forgotPassword');
    }
    public $str;
    public static function generatePassword()
    {
          $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz@#$&*+-=_!%^";  

       $size = strlen( $chars );

     //  echo "Random string =";
       $length=10;
       $str="";
       for( $i = 0; $i <$length; $i++ ) {

              $str .= $chars[ rand( 0, $size - 1 ) ];

              
            }
            return $str;

    }
    public function sendPassswordEmail(Request $request)
    {
    $a = $this->generatePassword();
     $email = $request->input('email');
     $dte_id =$request->input('dteId');
     $sl  = new studentLogin;
     $sl = $sl->find($dte_id);
     // return $email;
    $data = array(
      'name' => $a
    );
    
    
    if (DB::table('student_login')->where('email',$email)->exists())
    {
        $users=DB::table('student_login')->where('email',$email)->get();
        $dte_id1=$users[0]->dte_id;
        if($dte_id==$dte_id)
        {
         $sl->stud_pwd=Hash::make($a);
         $sl->save();
         Mail::send('user.mail1', $data, function ($message) use($email)
        {
          $message->to($email, 'Vesit Admissions')->subject('Email Verification');
          $message->from('vesit.admission@ves.ac.in', 'Vesit Admissions');
        });

        return redirect()->route('logout');
      }
     }
     else
     {
        return redirect()->route('me_guardian_details');
     }
   }

  /*public static function sendPassswordEmail(Request $request)
    {

    // send password string to user mail

    }*/

    public static function generateHash()
    {
          $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz@_";  

       $size = strlen( $chars );

     //  echo "Random string =";
       $length=30;
       $str="";
       for( $i = 0; $i <$length; $i++ ) {

              $str .= $chars[ rand( 0, $size - 1 ) ];

              
            }
            return $str;

    }
  public static function checkregister(Request $request)
    {
    $dte_id = $request->input('dteId');
    $password = $request->input('password');
    $password = Hash::make($password);
    $course = $request->input('course'); // REMOVE CODE WHEN WEBSITE IS ENABLED FOR ALL COURCES AND UNCOMMENT BELOW CODE
    $f_name = $request->input('first_name');
    $m_name = $request->input('middle_name');
    $l_name = $request->input('last_name');
    $mobile = $request->input('mobile');
    $recaptcha = $request->input('recaptcha');
    $hash   = (new static)->generateHash();

    $cp = $request->input('password_confirmation');

   /* $request->validate(['dteId' => 'required|max:12',

    // 'course' => 'required',

    'password' => 'required|min:8|max:16|confirmed', ]);*/
    $studentLogin = new studentLogin;

     $recaptch = $request->session()->pull('recaptcha');
   
      if(true)
      {
      if (Hash::check($cp, $password)&& $recaptch == $recaptcha)
        {
            $request->session()->put('reg_dte_id', $dte_id);
            if (DB::table('student_login')->where('dte_id', $dte_id)->exists())
              {
                      $user = DB::table('student_login')->select('account_status', 'mobile_verified', 'email_verified')->where('dte_id', $dte_id)->get();                      
                      if ($user[0]->account_status == 1) return redirect()->route('logout');
                      elseif ($user[0]->mobile_verified == 1)
                        {
                        DB::select("call insert_student_login('$dte_id','$hash','$password','$course','$f_name','$m_name','$l_name','$mobile')");
                        return redirect()->route('registerEmail');
                        }
                        else
                        {
                          DB::select("call insert_student_login('$dte_id','$hash','$password','$course','$f_name','$m_name','$l_name','$mobile')");
                        return redirect()->route('registerMobile');
                        }
              }
              else
              {
                 
                     DB::select("call insert_student_login('$dte_id','$hash','$password','$course','$f_name','$m_name','$l_name','$mobile')");
                     return redirect()->route('registerMobile');
                
              }
        }
         else
            {
                
               $array_object = [['dte_id' => $dte_id,'first_name'=>$f_name,'last_name'=>$l_name,'middle_name'=>$m_name,'mobile'=>$mobile,'course'=>$course]];
                $user = json_decode(json_encode($array_object));
                if($recaptch != $recaptcha && !Hash::check($cp, $password))
                $request->session()->flash('error','Enter details correctly');
                elseif(!Hash::check($cp, $password))
                 $request->session()->flash('error','Password Entered did not match');
                 elseif($recaptch != $recaptcha)
                   $request->session()->flash('error','Enter Recaptcha Properly');
                 $request->session()->put('user',$user);
                return redirect()->route('register');
            }
        
      }
    }

    public static function generateCaptch()
    {
          $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";  

       $size = strlen( $chars );

     //  echo "Random string =";
       $length=6;
       $str="";
       for( $i = 0; $i <$length; $i++ ) {

              $str .= $chars[ rand( 0, $size - 1 ) ];

              
            }
            return $str;

    }

  public static function showregister(Request $request)
    {

          $recaptch   = (new static)->generateCaptch();
           $request->session()->put('recaptcha',$recaptch);
          if($request->session()->has('user'))
          {
             $user =$request->session()->get('user');
               $array_object = [['dte_id' => $user[0]->dte_id,'first_name'=>$user[0]->first_name,'last_name'=>$user[0]->last_name,'middle_name'=>$user[0]->middle_name,'mobile'=>$user[0]->mobile,'course'=>$user[0]->course]];
                $user = json_decode(json_encode($array_object));
              
          }
          else
          {
           $array_object = [['dte_id' => null,'first_name'=>null,'last_name'=>null,'middle_name'=>null,'mobile'=>null,'course'=>null]];
                $user = json_decode(json_encode($array_object));
            
          }
          
         
         return view('user.register')->with('recaptch',$recaptch)->with('user',$user);
    }

  public static function showregisterMobile(Request $request)
    {
      $dte_id = $request->session()->get('reg_dte_id', null);
      if ($dte_id != null)
      {
           $user = DB::table('student_login')->select('mobile_verified','mobile')->where('dte_id', $dte_id)->get();
           
           if($user[0]->mobile_verified == 1)
           {
            return redirect()->route('registerEmail');
           }
           else
           {
                $mobile1 = $user[0]->mobile;
              //  return $mobile1;
                return view('user.registerMobile')->with('mobile1',$mobile1);
           }
      }
      else
      {
      return redirect()->route('logout');
      }
    }

    public function pdfview(Request $request)
    {
        $dte_id = $request->session()->get('log_dte_id');
        $users1 = DB::table("mca_students")->where('dte_id',$dte_id)->get();
        $users1 = json_decode(json_encode($users1));
        $users2 = DB::table("student_login")->where('dte_id',$dte_id)->get();
        $users2 = json_decode(json_encode($users2));
        $users1['email'] = $users2[0]->email;
        $users1['mobile'] = $users2[0]->mobile;
        $users1['hash'] = $users2[0]->hash;
        
        view()->share('users1',$users1);


        if($request->has('download')){
            $pdf = PDF::loadView('user.mca.pdfview');
            return $pdf->stream('user.mca.pdfview.pdf');
        }


        return view('user.mca.pdfview',$users1);
    }

 

  public $otp;

  public function setotp()
    {
    $otp = mt_rand(1000, 9999);
    
    return $otp;
    }

  public function setemailotp()
    {
    $otp = mt_rand(12345, 98765);
    $studentLogin = new studentLogin();
    $studentLogin->email_otp = $otp;
    $studentLogin->save();
    return $otp;
    }

  // function for email and user.mail is location of mail blade

  public function sendmail(Request $request)
    {
    $a = $this->setotp();
    $email = $request->input('email1');
    $data = array(
      'name' => $a
    );
    $dte_id = $request->session()->get('reg_dte_id');
    $request->session()->put('reg_email',$email);
    DB::select("call update_student_login_email('$dte_id','$email','$a')");
    Mail::send('user.mail', $data, function ($message) use($email)
      {
      $message->to($email, '')->subject('Email Verification');
      $message->from('vesit.admission@ves.ac.in', 'Vesit Admissions');
      });
    return "HTML Email Sent. Check your inbox.";
    return $data;
    }

  // function to verify the email

  public function verifyEmail(Request $request)
    {
       // return $request->all() ;
    $enteredOtp = $request->input('emailotp');
    $dte_id = $request->session()->get('reg_dte_id');
    $user = DB::table('student_login')->select('email_otp')->where('dte_id', $dte_id)->get();
    $otp1 = $user[0]->email_otp;
      $minute = $request->input('currentMin');
     $second = $request->input('currentSec');
     
    if ($enteredOtp == $otp1)
      {
          $request->session()->pull('reg_email');
               $request->session()->pull('user');
      DB::select("call update_student_login_verify_email('$dte_id','$enteredOtp')");
      $request->session()->flash('error','You are successfully Registered');
      return redirect()->route('login');
      }
      else
      {
        $request->session()->flash('min',$minute);
        $request->session()->flash('sec',$second);
        $request->session()->flash('wrongotp','0');
         $email= $request->session()->get('reg_email');
        // return $email;
          $request->session()->flash('email',$email);
          $request->session()->flash('email_error', 'Entered incorrect OTP, please try entering correct OTP');
          return redirect()->route('registerEmail');
      }
     
    }

  public function sendotp(Request $request)
    {
    $a = $this->setotp();
    $mobile = $request->input('mobile');
    $message=$a.' is your OTP for VESIT Admissions.';
    $dte_id = $request->session()->get('reg_dte_id');
    $request->session()->put('reg_mobile',$mobile);
    DB::select("call update_student_login_mobile('$dte_id','$mobile','$a')");
    $request ='username=vivekanandeducation&pass=6_9mv!KS&senderid=AVESIT&dest_mobileno='.$mobile.'&message='.$message.'&response=Y';
   // $request='username=vivekanandeducation&pass=6_9mv!KS@&senderid=AVESIT&dest_mobileno='.$mobile.'&message='.$message.'&response=Y';
    $ch = curl_init('http://203.129.203.243/blank/sms/user/urlsms.php?');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
    $resuponce=curl_exec($ch);
    curl_close($ch);
    return $resuponce;    
  }


 public function verifyMobile(Request $request)
    {
      // return $request->all() ;
    $enteredOtp = $request->input('enterOTP');
    $dte_id = $request->session()->get('reg_dte_id');
    $user = DB::table('student_login')->select('mobile_otp')->where('dte_id', $dte_id)->get();
    $otp1 = $user[0]->mobile_otp;
    $minute = $request->input('currentMin');
     $second = $request->input('currentSec');
   
    if ($enteredOtp == $otp1)
      {
        $request->session()->pull('reg_mobile');
      DB::select("call update_student_login_verify_mobile('$dte_id','$enteredOtp')");
      return redirect()->route('registerEmail');
      }
      else
      {
        $request->session()->flash('min',$minute);
        $request->session()->flash('sec',$second);
        $request->session()->flash('wrongotp','0');
         $mobile= $request->session()->get('reg_mobile');
          $request->session()->flash('mobile',$mobile);
          $request->session()->flash('mobile_error', 'Entered incorrect OTP, please try entering correct OTP');
          return redirect()->route('registerMobile');
      }
    }
 
  public static function showregisterEmail(Request $request)
  {   
          $dte_id = $request->session()->get('reg_dte_id', null);
      if ($dte_id != null)
      {
           $user = DB::table('student_login')->select('email_verified','email')->where('dte_id', $dte_id)->get();
           $email=$user[0]->email;
           if($user[0]->email_verified == 1)
           {
            return redirect()->route('logout');
           }
           else
                return view('user.registerEmail')->with('email_id',$email);
      }
      else
      {
      return redirect()->route('logout');
      }
    
   
    }




    //FE Module controller

     public static function showfeProfile(Request $request)
    {
      $dte_id = $request->session()->get('log_dte_id', null);
      $course = $request->session()->get('log_course');

      DB::table('student_login')->where('dte_id', $dte_id)->update(['dte_login' => 0, 'acap_login' => 0]);
      if ($dte_id != null)
      {
          $dtes = DB::select(DB::raw("SELECT event_name, event_from_date, event_to_date, event_type FROM event WHERE event_type = 'DTE' AND course LIKE '%".$course."%'"));
          /*DB::table('event')->select('event_name', 'event_from_date', 'event_to_date','event_type')->where('event_type' , 'DTE' AND 'course' , $course)->get();*/
          $acaps = DB::select(DB::raw("SELECT event_name, event_from_date, event_to_date, event_type FROM event WHERE event_type = 'ACAP' AND course LIKE '%".$course."%'"));
         /*DB::table('event')->select('event_name', 'event_from_date', 'event_to_date','event_type')->where('event_type' , 'ACAP' AND 'course' , $course)->get();*/

        //eligibility
         if(DB::table('dte_allotments')->where('dte_id', $dte_id)->exists())
         { 
            $eligibility=1;
         }
         else
         { $eligibility=0;}

        //status
        $user1 =DB::select(DB::raw("SELECT status_to from status_details where dte_id LIKE '%".$dte_id."%' AND event_to = 'DTE' ORDER BY updated_at DESC LIMIT 1"));
        if($user1==[] || $user1==null)
          {
              if($eligibility==1) 
                $status_dte='Eligible';
              else 
                $status_dte='Not Eligible';
          }
         elseif( $user1!=[])   
          {
              if($eligibility==1) 
                $status_dte=$user1[0]->status_to;
              else 
                $status_dte='Not Eligible';
          }

            //acap
        $user2 =DB::select(DB::raw("SELECT status_to from status_details where dte_id LIKE '%".$dte_id."%' AND event_to = 'ACAP' ORDER BY updated_at DESC LIMIT 1"));
        //return $user2;
        if($user2==[] || $user2==null)
          {
                $status_acap='Eligible For Acap';
          }
         elseif( $user2!=[])   
          {
                $status_acap=$user2[0]->status_to;
          }
        


        
        

      $data = [];
      $data['dtes'] = $dtes;
      $data['acaps'] = $acaps;
      $data['status_dte'] = $status_dte;  
        $data['status_acap'] = $status_acap;  
      return view('user.fe.profile', $data);
      }
      else
      {
        return redirect()->route('logout');
      }
    }

   public static function showfeAca(Request $request)
    {
      $dte_id =$request->session()->get('log_dte_id', 'null');


    if ($dte_id != 'null')
      {
          $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {
              $data = [];
              $newOrOldSystem = array(
                'N' => 'New',
                'O' => 'Old',
                'P' => 'Provisional'
              );
              $data['newOrOldSystem'] = $newOrOldSystem;
              $months = array(
                'Jan' => 'Jan',
                'Feb' => 'Feb',
                'Mar' => 'Mar',
                'Apr' => 'Apr',
                'May' => 'May',
                'Jun' => 'Jun',
                'Jul' => 'Jul',
                'Aug' => 'Aug',
                'Sep' => 'Sep',
                'Oct' => 'Oct',
                'Nov' => 'Nov',
                'Dec' => 'Dec'
              );
              $data['months'] = $months;

              $vocational_subjects=array(
              'ACR3'=>'Air Conditioning and Refrigeration-III',
              'ACR4'=>'Air Conditioning and Refrigeration-IV',
              'AE'=>'Auto Engineering',
              'ASRP'=>'Auto Shop Repair Practice',
              'BIO'=>'Biology',
              'CS'=>'Computer Science',
              'CT'=>'Construction Technology',
              'CE'=>'Consumer Electronics',
              'DP'=>'Dairy Production',
              'DMA'=>'Data Management Applications',
              'EA'=>'Electrical Appliances',
              'PD'=>'Physical Education',
              'EM'=>'Electrical Machine',
              'EMT'=>'Electrical Maintenance',
              'EAE'=>'Electricity and Electronics',
              'E'=>'Electronics',
              'ESM'=>'Elementary Structure Mechanics',
              'ES'=>'Engineering Science',
              'ECE'=>'Estimation in Civil Engineering',
              'FT2'=>'Foundry Technology-II',
              'GCE'=>'General Civil Engineering',
              'GBD'=>'Geom and Building Drawing',
              'GMD'=>'Geom and Mechanical Drawing',
              'GT2'=>'Geospatial Technology-II',
              'IT'=>'Information Technology',
              'MM'=>'Mechanical Maintenance',
              'MME'=>'Milk Marketing and Entrepreneurship',
              'OMCD'=>'Operation and Maintenance of communication Devices',
              'SMCR'=>'Scooter and Motor Cycle Servicing',
              'WA2'=>'Web Applications-II',
              'NA'=>'Not Applicable'
              );
              $data['vocational_subjects'] = $vocational_subjects;
              $university_types = array(
                'Maharashtra_Board' => 'Maharashtra Board',
                'CBSE' => 'CBSE',
                'ICSE' => 'ICSE',
                'OTHER'=> 'Other'
              );


              $data['university_types'] = $university_types;
              $status = DB::table('fe_students')->select('is_academic_completed')->where('dte_id', $dte_id)->get();
              if (DB::table('fe_students')->select('is_academic_completed')->where('dte_id', $dte_id)->exists() && $status[0]->is_academic_completed == "1")
                {
                    $user1 = DB::table('fe_students')->select('dte_id','x_passing_month','x_passing_year','x_board','x_board_seat_no', 'x_max_marks', 'x_obtained_marks', 'x_percentage','x_school_name', 'x_school_city','x_school_state','xii_passing_month','xii_passing_year', 'xii_board','xii_board_seat_no','xii_college_name','xii_college_city','xii_college_state','xii_max_marks','xii_obtained_marks','xii_maths_max_marks','xii_maths_obtained_marks','xii_physics_max_marks','xii_physics_obtained_marks','xii_chemistry_max_marks','xii_chemistry_obtained_marks','xii_vocational_subject1','xii_vocational_subject1_code','xii_vocational_subject1_max_marks','xii_vocational_subject1_obtained_marks','xii_aggregate_marks', 'xii_percentage','is_cet','cet_seat_no','cet_score','cet_month','cet_year','cet_percentile','cet_maths','cet_physics','cet_chemistry','is_jee','jee_seat_no','jee_total_score','jee_score','jee_year','jee_month','jee_maths_score','jee_physics_score','jee_chemistry_score','is_academic_completed')->where('dte_id', $dte_id)->get();
                    }  
                      
               else
               {
                     $array_object = [['dte_id' => $dte_id,'is_academic_completed'=>0,'x_passing_month'=>null,'x_passing_year'=>0,'x_board'=>null,'x_board_seat_no'=>null, 'x_max_marks'=>null, 'x_obtained_marks'=>null, 'x_percentage'=>null,'x_school_name'=>null, 'x_school_city'=>null,'x_school_state'=>null,'xii_passing_month'=>null,'xii_passing_year'=>0, 'xii_board'=>null,'xii_board_seat_no'=>null,'xii_college_name'=>null,'xii_college_city'=>null,'xii_college_state'=>null,'xii_max_marks'=>null,'xii_obtained_marks'=>null,'xii_maths_max_marks'=>null,'xii_maths_obtained_marks'=>null,'xii_physics_max_marks'=>null,'xii_physics_obtained_marks'=>null,'xii_chemistry_max_marks'=>null,'xii_chemistry_obtained_marks'=>null,'xii_vocational_subject1'=>null,'xii_vocational_subject1_code'=>null,'xii_vocational_subject1_max_marks'=>null,'xii_vocational_subject1_obtained_marks'=>null, 'xii_aggregate_marks'=>null,'xii_percentage'=>null,'is_cet'=>1,'cet_seat_no'=>null,'cet_score'=>null,'cet_month'=>null,'cet_year'=>0,'cet_percentile'=>null,'cet_maths'=>null,'cet_physics'=>null,'cet_chemistry'=>null,'is_jee'=>1,'jee_seat_no'=>null,'jee_total_score'=>null,'jee_score'=>null,'jee_year'=>0,'jee_month'=>null,'jee_maths_score'=>null,'jee_physics_score'=>null,'jee_chemistry_score'=>null]];
                      $user1 = json_decode(json_encode($array_object));

                }
               $course = $request->session()->get('log_course');
               list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
               if ($userprogress[0]->is_dte_details_completed==0) {
                 // HomeController::showfeDte();
                return redirect('fe_dte_details');
               }

                  $data['user1'] = $user1;
                  //return $data;
                  return view('user.fe.academic_details', $data);
          }
          else{
              return redirect()->route('fe_profile');}
          
      }
      
      else
      {
      return redirect()->route('logout');
      }
    }

     public static function insertfeAca(Request $request)
      {
        $dte_id=$request->session()->get('log_dte_id');

        // SSC details
        $x_school_name = $request->input('sscSchool'); 
        $x_board = $request->input('sscBoard');
        $x_school_city = $request->input('sscCity');
        $x_school_state = $request->input('sscState');
        $x_passing_year = $request->input('xPassingYear');
        $x_passing_month =$request->input('xPassingMonth');
        $x_obtained_marks = $request->input('xObtainedMarks');
        $x_max_marks = $request->input('xTotalMarks');
        $x_percentage = $request->input('xPercentage');
        $x_board_seat_no=$request->input('sscBoardNumber');

         // HSC details
         $xii_college_name = $request->input('hscCollege');
         $xii_board = $request->input('hscBoard');
         if($xii_board=='Maharashtra_Board'){
          $xii_board='Maharashtra board';
         }

         if($xii_board=='OTHER'){
          $xii_board= $request->input('hscotherBoard');
         }
         // return $xii_board;
         $xii_college_state = $request->input('hscState');
         $xii_college_city = $request->input('hscCity');
         $xii_passing_year = $request->input('xiiPassingYear');
         $xii_passing_month = $request->input('hscMonth');
         $xii_obtained_marks = $request->input('xiiObtainedMarks');
         $xii_max_marks = $request->input('xiiMaximumMarks');
         $xii_percentage = $request->input('xiiPercentage');
         $xii_aggregate_marks=$request->input('hscAggregateMarks');
         $xii_math_obtain =$request->input('hscMathsObtainMarks');
         $xii_math_max = $request->input('hscMathsMaxMarks');
         $xii_physics_obtain =$request->input('hscPhysicsObtainMarks');
         $xii_physics_max = $request->input('hscPhysicsMaxMarks');
         $xii_chemistry_obtain =$request->input('hscChemistryObtainMarks');
         $xii_chemistry_max = $request->input('hscChemistryMaxMarks');

         $xii_vocational_subject1 =$request->input('hscVocationalSubject1');
         $xii_vocational_subject1_code= $request->input('hscVocationalSubject1Code');
         $xii_vocational_subject1_max_marks =$request->input('hscVocationalSubject1MaxMarks');
         $xii_vocational_subject1_obtained_marks = $request->input('hscVocationalSubject1ObtainMarks');

         // return $xii_board;
         $xii_board_seat_no=$request->input('hscBoardNumber');

         // CET details

         $is_cet =$request->input('isCet');
         if ($is_cet=='no') {
         $is_cet ="0";
         $cet_seat_no=null;
         $cet_score="0";
         $cet_month=null;
         $cet_year="0";
         $cet_maths="0";
         $cet_physics="0";
         $cet_chemistry="0";

         }
         else{
         $is_cet =1;
         $cet_seat_no=$request->input('cetSeatNumber');
         $cet_score=$request->input('cetScore');
         $cet_month=$request->input('cetMonth');
         $cet_year=$request->input('cetYear');
         $cet_maths=$request->input('cetMathsScore');
         $cet_physics=$request->input('cetPhysicsScore');
         $cet_chemistry=$request->input('cetChemistryScore');
       }
         // JEE details
         $is_jee =$request->input('isJee');

         if ($is_jee=='no') {
           
         $is_jee ="0";  
         $jee_seat_no=null;
         $jee_score="0";
         $jee_month=null;
         $jee_year="0";
         $jee_maths="0";
         $jee_physics="0";
         $jee_chemistry="0";

         }
         else{
         $is_jee =1;
         $jee_seat_no=$request->input('jeeSeatNumber');
         $jee_score=$request->input('jeeMainsScore');
         $jee_month=$request->input('jeeMonth');
         $jee_year=$request->input('jeeYear');
         $jee_maths=$request->input('jeeMathsScore');
         $jee_physics=$request->input('jeePhysicsScore');
         $jee_chemistry=$request->input('jeeChemistryScore');
}

//return $cet_score;
     if (DB::table('fe_students')->where('dte_id', $dte_id)->exists()) 
         { 
        
    //Prodedure
          DB::statement("update fe_students set x_passing_month = '".$x_passing_month."', x_passing_year = '".$x_passing_year."' ,x_board = '".$x_board."' ,x_max_marks = '".$x_max_marks."',x_obtained_marks = '".$x_obtained_marks."',x_percentage = '".$x_percentage."',x_school_name = '".$x_school_name."',x_school_city = '".$x_school_city."',x_school_state = '".$x_school_state."',x_board_seat_no = '".$x_board_seat_no."',xii_passing_month = '".$xii_passing_month."',xii_passing_year = '".$xii_passing_year."',xii_board = '".$xii_board."',xii_max_marks = '".$xii_max_marks."',xii_obtained_marks = '".$xii_obtained_marks."',xii_maths_max_marks = '".$xii_math_max."',xii_maths_obtained_marks = '".$xii_math_obtain."', xii_physics_max_marks = '".$xii_physics_max."',xii_physics_obtained_marks = '".$xii_physics_obtain."',xii_chemistry_max_marks = '".$xii_chemistry_max."',xii_chemistry_obtained_marks = '".$xii_chemistry_obtain."', xii_vocational_subject1 = '".$xii_vocational_subject1."',xii_vocational_subject1_code = '".$xii_vocational_subject1_code."',xii_vocational_subject1_max_marks = '".$xii_vocational_subject1_max_marks."',xii_vocational_subject1_obtained_marks = '".$xii_vocational_subject1_obtained_marks."',xii_board_seat_no = '".$xii_board_seat_no."',xii_aggregate_marks = '".$xii_aggregate_marks."',xii_percentage = '".$xii_percentage."',xii_college_name = '".$xii_college_name."',xii_college_city = '".$xii_college_city."',xii_college_state = '".$xii_college_state."',is_cet = '".$is_cet."',cet_seat_no = '".$cet_seat_no."',cet_score = '".$cet_score."',cet_month = '".$cet_month."',cet_year = '".$cet_year."',cet_maths = '".$cet_maths."',cet_physics = '".$cet_physics."',cet_chemistry = '".$cet_chemistry."',is_jee = '".$is_jee."',jee_seat_no = '".$jee_seat_no."',jee_score = '".$jee_score."',jee_month = '".$jee_month."',jee_year = '".$jee_year."',jee_maths_score = '".$jee_maths."',jee_physics_score = '".$jee_physics."',jee_chemistry_score = '".$jee_chemistry."',is_academic_completed = 1,created_at = CURRENT_TIMESTAMP  where dte_id = '".$dte_id."' ");
      //  DB::statement("update fe_students set x_passing_month = '".$x_passing_month."' where dte_id = '".$dte_id."' ");
   //  DB::insert("INSERT INTO `fe_students`(`dte_id`,`x_passing_month`,`x_passing_year`,`x_board`,`x_max_marks`,`x_obtained_marks`,`x_percentage`,`x_school_name`,`x_school_city`,`x_school_state`,`x_board_seat_no`,`xii_passing_month`,`xii_passing_year`,`xii_board`,`xii_max_marks`,`xii_obtained_marks`,`xii_maths_max_marks`,`xii_maths_obtained_marks`, `xii_physics_max_marks`,`xii_physics_obtained_marks`,`xii_chemistry_max_marks`,`xii_chemistry_obtained_marks`, `xii_vocational_subject1`,`xii_vocational_subject1_code`,`xii_vocational_subject1_max_marks`,`xii_vocational_subject1_obtained_marks`,`xii_board_seat_no`,`xii_aggregate_marks`,`xii_percentage`,`xii_college_name`,`xii_college_city`,`xii_college_state`,`is_cet`,`cet_seat_no`,`cet_score`,`cet_month`,`cet_year`,`cet_maths`,`cet_physics`,`cet_chemistry`,`is_jee`,`jee_seat_no`,`jee_score`,`jee_month`,`jee_year`,`jee_maths_score`,`jee_physics_score`,`jee_chemistry_score`,`is_academic_completed`,`created_at`,`updated_at`) VALUES(_dte_id,_x_passing_month,_x_passing_year,_x_board,_x_max_marks,_x_obtained_marks,_x_percentage,_x_school_name,_x_school_city,_x_school_state,_x_board_seat_no,_xii_passing_month,_xii_passing_year,_xii_board,_xii_max_marks,_xii_obtained_marks,_xii_maths_max_marks,_xii_maths_obtained_marks,_xii_physics_max_marks, _xii_physics_obtained_marks,_xii_chemistry_max_marks,_xii_chemistry_obtained_marks, _xii_vocational_subject1,_xii_vocational_subject1_code,_xii_vocational_subject1_max_marks,_xii_vocational_subject1_obtained_marks,   _xii_board_seat_no,_xii_aggregate_marks,_xii_percentage,_xii_college_name,_xii_college_city,_xii_college_state,_is_cet,_cet_seat_no,_cet_score,_cet_month,_cet_year,_cet_maths,_cet_physics,_cet_chemistry,_is_jee,_jee_seat_no,_jee_score,_jee_month,_jee_year,_jee_maths,_jee_physics,_jee_chemistry,1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP"));
      
      return redirect('fe_personal_details');

   
    }

}

   public static function showfeDte(Request $request)
    {
         
         $dte_id = $request->session()->get('log_dte_id');
         $activedte= $request->session()->get('log_dte', 'null');
     $activeacap = $request->session()->get('log_acap');
        $course = $request->session()->get('log_course');
        
        if($activedte == "yes")
        {
          
          $event = "DTE";

        }
        else if($activeacap == "yes")
        {
          
          $event = "ACAP";
        }
    if ($dte_id != 'null')
      {
         $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {
     $data = [];
      $months = array(
        'Jan' => 'Jan',
        'Feb' => 'Feb',
        'Mar' => 'Mar',
        'Apr' => 'Apr',
        'May' => 'May',
        'Jun' => 'Jun',
        'Jul' => 'Jul',
        'Aug' => 'Aug',
        'Sep' => 'Sep',
        'Oct' => 'Oct',
        'Nov' => 'Nov',
        'Dec' => 'Dec'
      );
      if($event == "DTE")
      {
      $categories = array(
        'OPEN' => 'Open (Non Sindhi)',
        'OPEN_EBC' => 'Open EBC(Non Sindhi)',
        'OPEN_OMS' => 'Open (Other than Maharashtra State)',
        'OPEN_CI' => 'Open (CBSE/ISC Board)',
        'SINDHI' => 'Sindhi Minority',
        'SINDHI_EBC' => 'Sindhi Minority EBC',
        'SINDHI_CI' => 'SINDHI (CBSE/ISC Board)',
        'SBC' => 'SBC (Maharashtra Board)',
        'SBC_CI' => 'SBC (CBSE/ISC Board)',
        'VJ' => 'VJ (Maharashtra Board)',
        'VJ_CI' => 'VJ (CBSE/ISC Board)',
        'DT' => 'DT (Maharashtra Board)',
        'DT_CI' => 'DT (CBSE/ISC Board)',
        'NT' => 'NT (Maharashtra Board)',
        'NT_CI' => 'NT (CBSE/ISC Board)',
        'SC' => 'SC (Maharashtra Board)',
        'SC_CI' => 'SC (CBSE/ISC Board)',
        'OBC' => 'OBC (Maharashtra Board)',
        'OBC_CI' => 'OBC (CBSE/ISC Board)',
        'ST' => 'ST (Maharashtra Board)',
        'ST_CI' => 'ST (CBSE/ISC Board)',
        'EWS'=>'EWS (Maharashtra Board)',
        'EWS_CI'=>'EWS (CBSE/ISC Board)',
        'PMSSS' => 'PMSSS',
        'JK' => 'JK',
        'NEUT' => 'NEUT',
        'TFWS' => 'TFWS (Maharashtra Board)',
        'TFWS_CI' => 'TFWS (CBSE/ISC Board)',
        
      );
      }
      //return $event;
     if($event == "ACAP")
     {
       $categories = array(
        'OPEN' => 'Open',
        'SINDHI' => 'Sindhi'
      );
     }
      $candidate_types = array(
        'A' => 'Type A',
        'B' => 'Type B',
        'C' => 'Type C',
        'D' => 'Type D',
        'E' => 'Type E',
        'F' => 'Type F',
        'O' => 'Type OMS',
      );
      // $opentype=DB::table('fees_structure')->select('fee_category')->where('course','FEG')->where('type','NONMINORITY')->groupBy('fee_category')->get();
      // $minotype=DB::table('fees_structure')->select('fee_category')->where('course','FEG')->where('type','MINORITY')->groupBy('fee_category')->get();
      // $reservedtype=DB::table('fees_structure')->select('fee_category')->where('course','FEG')->where('type','RESERVED')->groupBy('fee_category')->get();
    
      $data['months'] = $months;
      $data['candidate_types'] = $candidate_types;
          $opentype= DB::select(DB::raw("SELECT  GROUP_CONCAT( DISTINCT fee_category) AS fee_category FROM fees_structure WHERE course='FEG' AND type='NONMINORITY' "));          

          $minotype=DB::select(DB::raw("SELECT GROUP_CONCAT( DISTINCT fee_category) AS fee_category FROM fees_structure WHERE course='FEG' AND type='MINORITY' "));
          $reservedtype=DB::select(DB::raw("SELECT GROUP_CONCAT( DISTINCT fee_category) AS fee_category FROM fees_structure WHERE course='FEG' AND type='RESERVED' "));
$categories=array('open'=>$opentype,'minotype'=>$minotype,'reservedtype'=>$reservedtype);
        $data['open']=explode(",",$opentype[0]->fee_category);
        $data['minotype']=explode(",",$minotype[0]->fee_category);
        $data['reservedtype']=explode(",",$reservedtype[0]->fee_category);
      // return $data;
    
      $check = DB::table('fe_students')->select('is_dte_details_completed')->where('dte_id', $dte_id)->get(); 

      if ( DB::table('fe_students')->select('is_dte_details_completed')->where('dte_id', $dte_id)->exists() && $check[0]->is_dte_details_completed == "1")
        {
        $user1 = DB::table('fe_students')->select('dte_id', 'category', 'candidate_type', 'cet_score','mh_state_general_merit_no', 'seat_type','shift_allotted','dte_branch','allotted_cap_round','course_allotted','course_allotted_code','is_dte_details_completed')->where('dte_id', $dte_id)->get();

        }
        else
        {
          
          if($activedte=='yes')
          {
             
               $user2 = DB::table('dte_allotments')->select('dte_seat_type_allotted','shift_allotted','allotted_cap_round','course_allotted','course_allotted_code','branch')->where('dte_id', $dte_id)->get();
                 $array_object = [['dte_id' => $dte_id,'is_dte_details_completed'=>0 ,'dte_password' => null, 'category' => null, 'acap_category' => null,'candidate_type' => null, 'cet_score' => null, 'mh_state_general_merit_no' => null,'cet_percentile'=>null,'seat_type' => $user2[0]->dte_seat_type_allotted,'allotted_cap_round' =>     $user2[0]->allotted_cap_round,'course_allotted' => $user2[0]->course_allotted,'course_allotted_code' =>     $user2[0]->course_allotted_code,'shift_allotted' =>$user2[0]->shift_allotted,'dte_branch'=>$user2[0]->branch,'cet_month' => null,'cet_year'=> 0]];
                $user1 = json_decode(json_encode($array_object));

             
                 
          }
          elseif($activeacap=='yes')
          {
           
            $array_object = [['dte_id' => $dte_id, 'is_dte_details_completed'=>0 ,'dte_password' => null, 'category' => null, 'reserved' => null,'candidate_type' => null, 'cet_score' => null, 'mh_state_general_merit_no' => null,'all_india_merit_no' => null, 'minority_dte_merit_no' => null,'cet_percentile'=>null,'seat_type' => null,'allotted_cap_round' => null,'course_allotted' => null,'course_allotted_code' => null,'shift_allotted'=>null,'dte_branch'=>null,'cet_month' => null,'cet_year' => 0]];
            $user1 = json_decode(json_encode($array_object));
           
        }
        
     }
// $abc=HomeController::progressbar($course,$dte_id); 
// return $abc;

               list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
// return $user1['prog_val'];


      $data['user1'] = $user1;
      // return $data;
      return view('user.fe.dte_details', $data);
      }

          else
              return redirect()->route('fe_profile');
          }
      else
      {
      return redirect()->route('logout');
      }

    }

    


  public static function showfeContact(Request $request)
    {
      $dte_id = $request->session()->get('log_dte_id', 'null');

    if ($dte_id != 'null')
      {
        $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {

      $data = [];
      $residences = array(
        'Local' => 'L',
        'Outstation' => 'O'
      );
      $data['residences'] = $residences;

      
      $check = DB::table('fe_students')->select('is_contact_completed')->where('dte_id', $dte_id)->get(); 
      if (DB::table('fe_students')->select('is_contact_completed')->where('dte_id', $dte_id)->exists() && $check[0]->is_contact_completed == "1")
        {
        $user1 = DB::table('fe_students')->select('dte_id', 'permanent_address_line1', 'permanent_address_line2', 'permanent_city','permanent_district', 'permanent_state', 'permanent_pincode', 'permanent_nearest_rail_station', 'correspondance_address_line1', 'correspondance_address_line2', 'correspondance_city', 'correspondance_state', 'correspondance_pincode', 'correspondance_nearest_rail_station', 'resident_of', 'local_guardian_name', 'local_guardian_address_line1', 'local_guardian_address_line2', 'local_guardian_city','correspondance_district', 'local_guardian_state', 'local_guardian_pincode','local_guardian_district','local_guardian_nearest_rail_station','is_contact_completed')->where('dte_id', $dte_id)->get();
        }
        else
        {
        $array_object = [['dte_id' => $dte_id,'is_contact_completed'=>0 ,'permanent_address_line1' => null, 'permanent_address_line2' => null, 'permanent_city' => null, 'permanent_state' => null,'permanent_district' => null, 'permanent_pincode' => null, 'permanent_nearest_rail_station' => null, 'correspondance_address_line1' => null, 'correspondance_address_line2' => null, 'correspondance_city' => null, 'correspondance_state' => null, 'correspondance_district' => null, 'correspondance_pincode' => null, 'correspondance_nearest_rail_station' => null, 'resident_of' => 'Local', 'local_guardian_name' => null, 'local_guardian_address_line1' => null, 'local_guardian_address_line2' => null, 'local_guardian_city' => null, 'local_guardian_state' => null, 'local_guardian_pincode' => null,'local_guardian_district'=>null,'local_guardian_nearest_rail_station'=>null,' is_contact_completed' => 0]];
        $user1 = json_decode(json_encode($array_object));
        }
       
       $course = $request->session()->get('log_course');
        list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
        if($userprogress[0]->is_guardian_completed==0){
          // HomeController::showfeGuard();
          return redirect('fe_guardian_details');

        }
      $data['user1'] = $user1;

      $data['status'] = "Not Submitted";
      if($user1[0]->correspondance_address_line1 == null)
       $data['permanent'] = "false";
      elseif($user1[0]->correspondance_address_line1 == $user1[0]->permanent_address_line1)
        $data['permanent'] = "true";
      else
        $data['permanent'] = "false";
      

      return view('user.fe.contact_details', $data);
      }
          else
              return redirect()->route('fe_profile');
          }
      else
      {
        return redirect()->route('logout');
      }
    }

  public static function insertfeContact(Request $request)
  {
    $dte_id=$request->session()->get('log_dte_id');
    $permanent_address_line1 = $request->input('permanentAddressLine1');
    $permanent_address_line2 = $request->input('permanentAddressLine2');
    $permanent_city = $request->input('permanentAddressCity');
    $permanent_state = $request->input('permanentAddressState');
    $permanent_district = $request->input('permanentAddressDistrict');
    $permanent_pincode = $request->input('permanentAddressPincode');
    $permanent_nearest_rail_station = $request->input('permanentAddressNearestRailwayStation');
    

    $is_correspon_as_permanent=$request->input('isSame');
    $is_local_or_outstation=$request->input('localOutstation');
    
         $correspondance_address_line1 = $request->input('currentAddressLine1');
         $correspondance_address_line2 = $request->input('currentAddressLine2');
         $correspondance_city = $request->input('currentAddressCity');
         $correspondance_district =  $request->input('currentAddressDistrict'); 
         $correspondance_state = $request->input('currentAddressState');
         $correspondance_pincode = $request->input('currentAddressPincode');
         $correspondance_nearest_rail_station = $request->input('currentAddressNearestRailwayStation');

    //return $correspondance_city;
    if($is_local_or_outstation=="Local")
    {
        $local_guardian_name = null;
        $local_guardian_address_line1 = null;
        $local_guardian_address_line2 =  null;
        $local_guardian_city =  null;
         $local_guardian_district =  null;
        $local_guardian_state =  null;
        $local_guardian_pincode = "0"; 
        $local_nearest_rail_station = null;


    }
    else
    {
        $local_guardian_name = $request->input('localGuardianName');
        $local_guardian_address_line1 = $request->input('localGuardianAddressLine1');
        $local_guardian_address_line2 = $request->input('localGuardianAddressLine2');
        $local_guardian_city = $request->input('localGuardianAdreessCity');
        $local_guardian_district = $request->input('localGuardianAdreessDristict');
        $local_guardian_state = $request->input('localGuardianAddressState');
        $local_guardian_pincode = $request->input('localGuardianAddressPincode');
        $local_nearest_rail_station = $request->input('localAddressNearestRailwayStation');
    }

    if (DB::table('fe_students')->where('dte_id', $dte_id)->exists()) 
         { 
       
    DB::select("call insert_update_fe_contact('$dte_id','$permanent_address_line1','$permanent_address_line2','$permanent_city','$permanent_district','$permanent_state','$permanent_pincode','$permanent_nearest_rail_station','$correspondance_address_line1','$correspondance_address_line2','$correspondance_city','$correspondance_district','$correspondance_state','$correspondance_pincode','$correspondance_nearest_rail_station','$is_local_or_outstation','$local_guardian_name','$local_guardian_address_line1','$local_guardian_address_line2','$local_guardian_city','$local_guardian_district','$local_guardian_state','$local_guardian_pincode','$local_nearest_rail_station')");
       }
       /*fe_document_upload*/
        return redirect()->route('fe_document_upload');
    }

 

   public static function insertfeDte(Request $request)
      {
          $dte_id=$request->session()->get('log_dte_id');
         $activedte= $request->session()->get('log_dte', 'null');
     $activeacap = $request->session()->get('log_acap');
        $course = $request->session()->get('log_course');
      
        if($activedte == "yes")
        {
          
          $event = "DTE";

        }
        else if($activeacap == "yes")
        {
          
          $event = "ACAP";
        }
        
          /*$user = DB::table('mca_students')->where('dte_id', $dte_id)->get();
          if ($user==[])
          {
          if($log_dte=="yes")
          {
          $category = $request->input('category');
            $acap_category="NA";
          }
          elseif($log_acap=="yes")
           {
            $acap_category = $request->input('category');
            $category="NA";
          }
          }
          elseif (DB::table('mca_students')->where('dte_id', $dte_id)->exists()) {         
          
          if($log_dte=="yes")
          {
         
          $category = $request->input('category');
          if($user[0]->acap_category==null)
            $acap_category="NA";
          else
            $acap_category = $user[0]->acap_category; 
          }
          elseif($log_acap=="yes")
          {
            $acap_category = $request->input('category');
            if($user[0]->category==null)
            $category="NA";
          else
            $category = $user[0]->category; 
          }
        }*/
/*          if(log_acap==null)
          {
*/         
          //$category = $request->input('category');
          /*}
          elseif(log_dte==null)
          {
              $acap_category=$request->input('category');
          }*/
          /*if($category == "RESERVED")
          {
            $category = $request->input('reserved');
          }*/
          
          $candidate_type = $request->input('candidate_types');
          $mh_state_general_merit_no = $request->input('mhStateGeneralmeritNo');
          $activedte= $request->session()->get('log_dte', 'null');
          $activeacap= $request->session()->get('log_acap','null');
          //return $minority_dte_merit_no;
        //Procedure

        if($activedte=='yes')
        {
          //$type='DTE';
       // return    $dte_id;    
          $user1 = DB::table('fe_students')->select('dte_id','seat_type','allotted_cap_round','course_allotted','course_allotted_code','acap_category')->where('dte_id', $dte_id)->get();
         //  return $user1;
          $seat_type =$user1[0]->seat_type;
         // $type=$seat_type;
          $allotted_cap_round =$user1[0]->allotted_cap_round;
          $course_allotted = $user1[0]->course_allotted;
          $course_allotted_code =$user1[0]->course_allotted_code;
          
           $cat_Radio = $request->input('cat_Radio');
           // return $cat_Radio;
          if ($cat_Radio== "Reserverd") {
            $category = $request->input('reservedcategory');  
          }
          if ($cat_Radio=="Minority") {
            $category =  $request->input('minoritycategory');  
          }
          if ($cat_Radio== "General") {
            $category = $request->input('opencategory');  
          }
          // return $category;
          if($user1[0]->acap_category == null || $user1[0]->acap_category == "NA" )
             $acap_category="NA";
          else
             $acap_category=$user1[0]->acap_category;

        }
        elseif($activeacap=='yes')
        {
          $user1 = DB::table('fe_students')->select('category','seat_type')->where('dte_id', $dte_id)->get();

          $type='ACAP';
        //     if(DB::table('dte_allotments')->where('dte_id', $dte_id)->exists())
        //   {
        //       $seat_type=$user1[0]->seat_type;

        //   }
        //   else
        //   {
              $seat_type ="NA";

         // }

         // return $user1;
          $type='-';
          $allotted_cap_round ="NA";
          $course_allotted = "NA";
          $course_allotted_code ="0000000";
          
          //changes by kartik
          $cat_Radio = $request->input('cat_Radio');
           // return $cat_Radio;
          if ($cat_Radio== "Reserverd") {
            $category = $request->input('reservedcategory');  
          }
          if ($cat_Radio=="Minority") {
            $category =  $request->input('minoritycategory');  
          }
          if ($cat_Radio== "General") {
            $category = $request->input('opencategory');  
          }



           // $acap_category = $request->input('category');
          $acap_category = $category;
          
          if($user1 == '[]' || $user1[0]->category == null || $user1[0]->category == "NA" )
             $category="NA";
          else
             $category=$user1[0]->category;

        }
       // return $category;
    DB::select("call insert_update_fe_dte('$dte_id','$category','$candidate_type','$mh_state_general_merit_no','$seat_type','$acap_category')");
    return redirect('fe_academic_details');
                  
    }

    //Guardian details
  public static function showfeGuard(Request $request)
    {
      $dte_id = $request->session()->get('log_dte_id', 'null');
    if ($dte_id != 'null')
      {
         $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {
      $data = [];
      $check = DB::table('fe_students')->select('is_guardian_completed')->where('dte_id', $dte_id)->get(); 
      if (DB::table('fe_students')->select('is_guardian_completed')->where('dte_id', $dte_id)->exists() && $check[0]->is_guardian_completed == "1")
        {
        $user1 = DB::table('fe_students')->select('dte_id', 'g_relation', 'g_first_name', 'g_middle_name', 'g_last_name', 'g_mobile', 'g_occupation', 'g_qualification', 'g_office_address','g_office_tel_no','g_annual_income', 'mother_name', 'parent_domicile_no', 'parent_domicile_date', 'parent_domicile_appl_no', 'parent_domicile_appl_date','candidate_type','is_guardian_completed')->where('dte_id', $dte_id)->get();
          //return $user1[0]->candidate_type;
          if(($user1[0]->parent_domicile_no == "0" && $user1[0]->parent_domicile_date == "1111-11-11")&&($user1[0]->parent_domicile_appl_no == "0" && $user1[0]->parent_domicile_appl_date == "1111-11-11"))
          {
              $parent_domicile = "na";
          }
          else if($user1[0]->parent_domicile_no == "0" && $user1[0]->parent_domicile_date == "1111-11-11")
          {
            $parent_domicile = "false";
          }
          else if($user1[0]->parent_domicile_appl_no == "0" && $user1[0]->parent_domicile_appl_date == "1111-11-11")
          {
            $parent_domicile = "true";
          }
          

        }
        else
        {
              $candidate_type = DB::table('fe_students')->select('candidate_type')->where('dte_id', $dte_id)->get()[0]->candidate_type;
             // return $candidate_type;
        $array_object = [['dte_id' => $dte_id, 'is_guardian_completed'=>0,'g_relation' => 'F', 'g_first_name' => null, 'g_middle_name' => null, 'g_last_name' => null, 'g_mobile' => null, 'g_occupation' => null, 'g_office_address'=>null ,'g_office_tel_no'=> null ,'g_qualification' => null, 'g_annual_income' => null, 'mother_name' => null, 'parent_domicile_no' => null, 'parent_domicile_date' => null, 'parent_domicile_appl_no' => null, 'parent_domicile_appl_date' => null,'candidate_type'=>$candidate_type]];
        $user1 = json_decode(json_encode($array_object));
        $parent_domicile = "na";
        }

      $relations = array(
        'Husband' => 'H',
        'Parent' => 'F',
        'Guardian' => 'G',
      );
    $course = $request->session()->get('log_course');
    list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
    if($userprogress[0]->is_personal_completed==0){
        // HomeController::showfeAca();
      return redirect('fe_personal_details');
    }
      $data['user1'] = $user1;
      $data['relations'] = $relations;
      $data['parent_domicile'] =$parent_domicile;
      return view('user.fe.guardian_details', $data);
      }
      else
              return redirect()->route('fe_profile');
          }
      else
      {
      return redirect()->route('logout');
      }
    }

 public static function insertfeGuard(Request $request)
 {
 $dte_id=$request->session()->get('log_dte_id');
    $g_relation = $request->input('relation');
    $g_first_name = $request->input('firstName');
    $g_middle_name = $request->input('middleName');
    $g_last_name = $request->input('lastName');
    $mother_name = $request->input('motherMaidenName');
    $g_mobile = $request->input('mobile');
    $g_office_address=$request->input('office_address');
    $g_office_tel_no=$request->input('office_tel_no');
    $g_occupation = $request->input('occupation');
    $g_qualification = $request->input('qualification');
    $g_annual_income = $request->input('annualIncome');
   if($g_office_tel_no == null)
        $g_office_tel_no =0; 
    
    if($g_office_address == null)
        $g_office_address= "NA";
    $if_domecile=$request->input('dom');
    //return $g_relation;
    //return $if_domecile;
    if($if_domecile=="yes")
    {
         $parent_domicile_no = $request->input('parentDomecileNo');
        $parent_domicile_date = $request->input('dateOfParentDomecile');
       // return $parent_domicile_date;
        $parent_domicile_appl_no = "0";
         $parent_domicile_appl_date = "1111-11-11";
    }
    if($if_domecile=="no")
    { 
         $parent_domicile_appl_no = $request->input('parentDomecileApplicationNo');
         $parent_domicile_appl_date = $request->input('applicationDateOfParentDomecile');
     //return $parent_domicile_appl_no;

         $parent_domicile_no ="0";
         $parent_domicile_date = "1111-11-11";
    }
    if($if_domecile=="na")
    {
        $parent_domicile_appl_no = "0";
         $parent_domicile_appl_date = "1111-11-11";
         $parent_domicile_no ="0";
         $parent_domicile_date = "1111-11-11";
    }
  if (DB::table('fe_students')->where('dte_id', $dte_id)->exists()) 
         { 
       
    $mob=DB::table('student_login')->select('mobile')->where('dte_id', $dte_id)->get();
     
    if($mob[0]->mobile==$g_mobile){
 
$request->session()->flash('error','Please fill different mobile number ');
return redirect('fe_guardian_details');
    }
   // return $mob[0]->mobile;
    //Procedure
    DB::select("call insert_update_fe_guardian('$dte_id','$g_relation','$g_first_name','$g_middle_name','$g_last_name','$g_mobile','$g_occupation','$g_qualification','$g_office_address','$g_office_tel_no','$g_annual_income','$parent_domicile_no','$parent_domicile_date','$parent_domicile_appl_no','$parent_domicile_appl_date','$mother_name')");
    return redirect('fe_contact_details');
      }
    }



    //Personal details
  public static function showfePersonal(Request $request)
    {
       $dte_id = $request->session()->get('log_dte_id', 'null');

    if ($dte_id != 'null')
      {
         $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {
      $data = [];
      $blood_groups = array(
        'A+' => 'A+',
        'A-' => 'A-',
        'B+' => 'B+',
        'B-' => 'B-',
        'AB+' => 'AB+',
        'AB-' => 'AB-',
        'O+' => 'O+',
        'O-' => 'O-',
        'un' => 'Unknown'
      );
      $genders = array(
        'Male' => 'Male',
        'Female' => 'Female',
        'Others' => 'Other'
      );
      $data['blood_groups'] = $blood_groups;
      $data['genders'] = $genders;

        $check = DB::table('fe_students')->select('is_personal_completed')->where('dte_id', $dte_id)->get(); 
      if (DB::table('fe_students')->select('is_personal_completed')->where('dte_id', $dte_id)->exists() && $check[0]->is_personal_completed == "1")
        {

        $user1 = DB::table('fe_students')->select('dte_id', 'name_on_marksheet','gender', 'date_of_birth', 'place_of_birth_city', 'place_of_birth_state', 'student_domicile_no', 'student_domicile_date', 'student_domicile_appl_no', 'student_domicile_appl_date', 'mother_tongue', 'nationality', 'caste_tribe', 'religion', 'blood_group', 'uid','is_personal_completed')->where('dte_id', $dte_id)->get();

            if(($user1[0]->student_domicile_no == "0" && $user1[0]->student_domicile_date == "1111-11-11")&&($user1[0]->student_domicile_appl_no == "0" && $user1[0]->student_domicile_appl_date == "1111-11-11"))
            {
                      $domicile = "na";
            }
          else if($user1[0]->student_domicile_no == "0" && $user1[0]->student_domicile_date == "1111-11-11")
          {
             $domicile = "false";
          }
          elseif($user1[0]->student_domicile_appl_no == "0" && $user1[0]->student_domicile_appl_date == "1111-11-11")
          {
            $domicile = "true";
          }
        

        }
        else
        {
        $array_object = [['dte_id' => $dte_id,'is_personal_completed'=>0 ,'name_on_marksheet' => null, 'gender' => 'Male', 'date_of_birth' => null, 'place_of_birth_city' => null, 'place_of_birth_state' => null, 'student_domicile_no' => null, 'student_domicile_date' => null, 'student_domicile_appl_no' => null, 'student_domicile_appl_date' => null, 'mother_tongue' => null, 'nationality' => null, 'caste_tribe' => null, 'religion' => null, 'blood_group' => null, 'uid' => null]];
        $user1 = json_decode(json_encode($array_object));
        $domicile = "true";
        }
          $course = $request->session()->get('log_course');
          list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
     
          if($userprogress[0]->is_academic_completed==0){
            // HomeController::showfeAca();
            return redirect('fe_academic_details');
          }
      $data['user1'] = $user1;
      $data['domicile'] = $domicile;
     

      return view('user.fe.personal_details', $data);
      }
      else
              return redirect()->route('fe_profile');
          }
      else
      {
      return redirect()->route('logout');
      }
    }

     public static function insertfePersonal(Request $request)
      {
    $dte_id=$request->session()->get('log_dte_id'); 
    $name_on_marksheet = $request->input('nameAsOnMarksheet');
    $gender = $request->input('gender');
    $date_of_birth = $request->input('dob');
   //  return $date_of_birth;
    $if_domecile=$request->input('dom');
    $place_of_birth_city = $request->input('placeOfBirthCity');
    $place_of_birth_state = $request->input('placeOfBirthState');
    $student_domicile_no = $request->input('domicileNumber');
    $student_domicile_date = $request->input('domicileDate');
    $student_domicile_appl_no = $request->input('applicationNumber');
    $student_domicile_appl_date = $request->input('applictionDate');
    $mother_tongue = $request->input('motherTongue');
    $nationality = $request->input('nationality');
    $caste_tribe = $request->input('casteTribe');
    $religion = $request->input('religion');
    $blood_group = $request->input('bloodGroup');
    $uid = $request->input('uid');
    if($if_domecile=="yes")
    {
        $student_domicile_appl_no = "0";
         $student_domicile_appl_date = "1111-11-11";
    }
    if($if_domecile=="no")
    {
         $student_domicile_no ="0";
         $student_domicile_date = "1111-11-11";
    }
    if($if_domecile=="na")
    {
        $student_domicile_appl_no = "0";
        $student_domicile_appl_date = "1111-11-11"; 
        $student_domicile_no ="0";
        $student_domicile_date = "1111-11-11";
        
    }
    
    if (DB::table('fe_students')->where('dte_id', $dte_id)->exists()) 
         { 
    
          $us=studentlogin::where('dte_id',$dte_id)->take(1)->get();
          $first_name=$us[0]->first_name;
          $middle_name=$us[0]->middle_name;
          $last_name=$us[0]->last_name;
    //Prcedure
    DB::select("call insert_update_fe_personal('$dte_id','$name_on_marksheet','$gender','$date_of_birth','$place_of_birth_state','$place_of_birth_city','$mother_tongue','$nationality','$caste_tribe ','$religion','$blood_group','$uid','$student_domicile_no','$student_domicile_date','$student_domicile_appl_no','$student_domicile_appl_date','$first_name','$middle_name','$last_name')");
    return redirect('fe_guardian_details');
  }
}
//document upload
    public static function showfeDocumentUpload(Request $request)
    {
        $dte_id = $request->session()->get('log_dte_id');
        $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          //$path =  DB::table('me_students')->select('photo_path')->where('dte_id', $dte_id)->get();

          $activedte= $request->session()->get('log_dte', 'null');
     $activeacap = $request->session()->get('log_acap');
      
          
          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {
       if (DB::table('fe_students')->where('dte_id', $dte_id)->exists())
        {
        $user1 = DB::table('fe_students')->select('dte_id','is_cet','is_jee','photo','photo_path','signature','signature_path','fc_confirmation_receipt','fc_confirmation_receipt_path','dte_allotment_letter','dte_allotment_letter_path','arc_ackw_receipt','arc_ackw_receipt_path','cet_result','cet_result_path','jee_result','jee_result_path','ssc_marksheet','ssc_marksheet_path','hsc_marksheet','hsc_marksheet_path','hsc_passing_certi','hsc_passing_certi_path','hsc_leaving_certi','hsc_leaving_certi_path','migration_certi','migration_certi_path','birth_certi','birth_certi_path','domicile','domicile_path','aadhar','aadhar_path','proforma_o','proforma_o_path','minority_affidavit','minority_affidavit_path','community_certi','community_certi_path','retention','retention_path','caste_certi','caste_certi_path','caste_validity_certi','caste_validity_certi_path','non_creamy_layer_certi','non_creamy_layer_certi_path','proforma_a_b1_b2','proforma_a_b1_b2_path','income_certi','income_certi_path','proforma_c_d_e','proforma_c_d_e_path','proforma_g1_g2','proforma_g1_g2_path','proforma_j_k_l','proforma_j_k_l_path','proforma_v','proforma_v_path','proforma_u','proforma_u_path','medical_certi','medical_certi_path','anti_ragging_affidavit','anti_ragging_affidavit_path','gap_certi','gap_certi_path','is_document_completed')->where('dte_id', $dte_id)->get();
        $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        $hash = $hash[0]->hash;
       

        }
        else
        {
        $array_object = [['dte_id'=> $dte_id,'photo'=>null,'photo_path'=>null,'signature'=>null,'signature_path'=>null,'fc_confirmation_receipt'=>null,'fc_confirmation_receipt_path'=>null,'dte_allotment_letter'=>null,'dte_allotment_letter_path'=>null,'arc_ackw_receipt'=>null,'arc_ackw_receipt_path'=>null,'cet_result'=>null,'cet_result_path'=>null,'jee_result'=>null,'jee_result_path'=>null,'ssc_marksheet'=>null,'ssc_marksheet_path'=>null,'hsc_marksheet'=>null,'hsc_marksheet_path'=>null,'hsc_passing_certi'=>null,'hsc_passing_certi_path'=>null,'hsc_leaving_certi'=>null,'hsc_leaving_certi_path'=>null,'migration_certi'=>null,'migration_certi_path'=>null,'birth_certi'=>null,'birth_certi_path'=>null,'domicile'=>null,'domicile_path'=>null,'aadhar'=>null,'aadhar_path'=>null,'proforma_o'=>null,'proforma_o_path'=>null,'minority_affidavit'=>null,'minority_affidavit_path'=>null,'community_certi'=>null,'community_certi_path'=>null,'retention'=>null,'retention_path'=>null,'caste_certi'=>null,'caste_certi_path'=>null,'caste_validity_certi'=>null,'caste_validity_certi_path'=>null,'non_creamy_layer_certi'=>null,'non_creamy_layer_certi_path'=>null,'proforma_a_b1_b2'=>null,'proforma_a_b1_b2_path'=>null,'income_certi'=>null,'income_certi_path'=>null,'proforma_c_d_e'=>null,'proforma_c_d_e_path'=>null,'proforma_g1_g2'=>null,'proforma_g1_g2_path'=>null,'proforma_j_k_l'=>null,'proforma_j_k_l_path'=>null,'proforma_v'=>null,'proforma_v_path'=>null,'proforma_u'=>null,'proforma_u_path'=>null,'medical_certi'=>null,'medical_certi_path'=>null,'anti_ragging_affidavit'=>null,'anti_ragging_affidavit_path'=>null,'gap_certi'=>null,'gap_certi_path'=>null,'is_document_completed'=>0]];
        $user1 = json_decode(json_encode($array_object));
        $hash = null;
        }
        //return $user1;
        
        $course = $request->session()->get('log_course');
        list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
        if($userprogress[0]->is_contact_completed==0){
          // HomeController::showfeContact();  
          return redirect('fe_contact_details');
        }

        $data=[];
        $data['user1']=$user1;
        $data['hash']=$hash;
        //$photo_path = 'storage'.$user1;
        
        // if ($user1[0]->is_jee==0) {
        //   return $user1[0]->is_jee;
        //   # code...
        // }
         if ($activedte == "yes") {
          return view('user.fe.document_upload',$data);
      }

       if ($activeacap == "yes") {
         if($userprogress[0]->is_document_completed==1){
          // return $user1;
            $user1['prog_val']=7;
          $data['user1']=$user1;
          // return 'done';
        }
          return view('user.fe.acap_document_upload',$data);      }
        

      }
       else
              return redirect()->route('fe_profile');
          
    }



 public static function showFeAcapFormPayment(Request $request)
    {
       $dte_id = $request->session()->get('log_dte_id');
        $course = $request->session()->get('log_course');
          //list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
    return view('user.fe.acap_form_payment');
    }



    public static function uploadfeDocumentUpload(Request $request)
    {

      
      /* $request->validate([
        'ssc_marksheet','hsc_marksheet','hsc_leaving_certi','first_year_marksheet','second_year_marksheet','third_year_marksheet','fourth_year_marksheet','convocational_certi','birth_certi','domicile_certi','proforma_o','retention_certi','minority_affidavit','gap_certi','community_certi','cast_certi','caste_validity_certi','non_creamy_layer_certi','proforma_h','proforma_a_b1_b2','proforma_f_f1','income_certi','proforma_j_k_l','medical_certi' => 'mimes:pdf|max:1024'
        ]);*/

      $dte_id=$request->session()->get('log_dte_id'); 
      $use = DB::table('student_login')->select('hash')->where('dte_id', $dte_id)->get();
      $destinationPath = $dte_id.'_'.$use[0]->hash;
      //  $abc=(int)$request->hasFile('ssc_marksheet');

      $activedte= $request->session()->get('log_dte', 'null');
     $activeacap = $request->session()->get('log_acap');
        $fe_students = new fe_students;
        if(DB::table('fe_students')->where('dte_id', $dte_id)->exists()) 
          { 
           $fe_students  = fe_students::find($dte_id);
          }
          else
          {
            $fe_students->dte_id = $dte_id;
          }
        //return $fe_students->is_cet;
        //return  $fe_students->is_jee;
        $a = $request->input('cet_result');
        //return $a;
          $test_photo = $request->input('photo');
       //  return $fe_students->photo_path;
         if($fe_students->photo_path == null)
         {
                  if ($test_photo=="yes") 
                  {
                       if($request->hasFile('photo'))
                      {
                            $rules = ['photo' => 'mimes:jpg,png,jpeg'];
                             $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('photo_error', 'Please Upload Only JPG or PNG type image. File size should be less than 1 mb.');
                              return redirect()->route('fe_document_upload');
                             }
                            $extension = $request->file('photo')->getClientOriginalExtension();
                        
                            $filenametostore = 'photo'.$dte_id.'.'.$extension;
                    
                            $path =  $request->file('photo')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $fe_students->photo_path = $filenametostore;
                            $fe_students->photo='Yes';
                            $fe_students->save();
                      }
                      else
                        {
                              $fe_students->photo='No';
                              $fe_students->save();
                        }
                 }
                  elseif ($test_photo=="no") {
                    $fe_students->photo='No';
                  }
                  elseif ($test_photo== null) {
                    $request->session()->flash('photo_error', 'Please select an option');
                      return redirect()->route('fe_document_upload');
                  }
          
         }
         

      $test_signature = $request->input('signature');
    //  return $test_signature;
    //return $a;
    if($fe_students->signature_path == null)
         {
                  if ($test_signature=="yes") 
                  {
                        if($request->hasFile('signature'))
                        {
                                $rules = ['signature' => 'mimes:jpg,png,jpeg'];
                                  $validator = Validator::make(Input::all() , $rules);
                                if ($validator->fails())
                                 {
                                  $request->session()->flash('signature_error', 'Please Upload Only JPG or PNG type image. File size should be less than 1 mb.');
                                  return redirect()->route('fe_document_upload');
                                 }
                                $extension = $request->file('signature')->getClientOriginalExtension();
                                $filenametostore = 'signature'.$dte_id.'.'.$extension;
                                $path = $request->file('signature')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                  $fe_students->signature_path = $filenametostore;
                                   $fe_students->signature='Yes';
                                $fe_students->save();
                        }
                               else
                                {
                                      $fe_students->signature='No';
                                      $fe_students->save();
                                }
                 }
                  elseif ($test_signature=="no") {
                    $fe_students->signature='No';
                  }
                  elseif ($test_signature== null) {
                    $request->session()->flash('signature_error', 'Please select an option');
                      return redirect()->route('fe_document_upload');
                  }
         }

      $test_fc_confirmation_receipt = $request->input('fc_confirmation_receipt');
      //return $test_fc_confirmation_receipt;
       if($fe_students->fc_confirmation_receipt_path == null)
         {
      
              if ($test_fc_confirmation_receipt=="yes") 
              {
                 if($request->hasFile('fc_confirmation_receipt'))
                 { 
                        $rules = ['fc_confirmation_receipt' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('fc_confirmation_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('fe_document_upload');
                         }
                        $extension = $request->file('fc_confirmation_receipt')->getClientOriginalExtension();
                        $filenametostore = 'fc_confirmation_receipt'.$dte_id.'.'.$extension;
                        $path = $request->file('fc_confirmation_receipt')->storeAs($destinationPath, $filenametostore,'public_uploads');
                          $fe_students->fc_confirmation_receipt_path =$filenametostore;
                           $fe_students->fc_confirmation_receipt='Yes';
                        $fe_students->save();
                }
                  else
                    {
                          $fe_students->fc_confirmation_receipt='No';
                          $fe_students->save();
                    }
             }
             elseif ($test_fc_confirmation_receipt=="no") {
                $fe_students->fc_confirmation_receipt='No';
              }
              elseif ($test_fc_confirmation_receipt== null) {
                $request->session()->flash('fc_confirmation_error', 'Please select an option');
                  return redirect()->route('fe_document_upload');
              }

         }
       //return $activedte;
    //  if ($activedte == "yes") {
        
          $test_dte_allotment_letter = $request->input('dte_allotment_letter');
              //return $test_dte_allotment_letter;
              if($fe_students->dte_allotment_letter_path == null)
                 {
                      if ($test_dte_allotment_letter=="yes") 
                      {
                          if($request->hasFile('dte_allotment_letter'))
                        {
                                $rules = ['dte_allotment_letter' => 'mimes:pdf|max:1024'];
                                  $validator = Validator::make(Input::all() , $rules);
                                if ($validator->fails())
                                 {
                                  $request->session()->flash('dte_allotment_letter_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                  return redirect()->route('fe_document_upload');
                                 }
                                $extension = $request->file('dte_allotment_letter')->getClientOriginalExtension();
                                $filenametostore = 'dte_allotment_letter_'.$dte_id.'.'.$extension;
                           
                                $path = $request->file('dte_allotment_letter')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                      $fe_students->dte_allotment_letter_path = $filenametostore;
                                       $fe_students->dte_allotment_letter='Yes';
                                $fe_students->save();
                         }
            
                       else
                        {
                              $fe_students->dte_allotment_letter='No';
                              $fe_students->save();
                        }
                       }
                      elseif ($test_dte_allotment_letter=="no") {
                        $fe_students->dte_allotment_letter='No';
                      }
                      elseif ($test_dte_allotment_letter== null) {
                       // return 'Hello';
                        $request->session()->flash('dte_allotment_letter_error', 'Please select an option');
                          return redirect()->route('fe_document_upload');
                      }
                 }
//return $a;
              $test_arc_ackw_receipt = $request->input('arc_ackw_receipt');
              
              if($fe_students->arc_ackw_receipt_path == null)
                 {
                      if ($test_arc_ackw_receipt=="yes") 
                      {
                            if($request->hasFile('arc_ackw_receipt'))
                              {
                                $rules = ['arc_ackw_receipt' => 'mimes:pdf|max:1024'];
                                  $validator = Validator::make(Input::all() , $rules);
                                if ($validator->fails())
                                 {
                                  $request->session()->flash('arc_ackw_receipt_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                  return redirect()->route('fe_document_upload');
                                 }
                                $extension = $request->file('arc_ackw_receipt')->getClientOriginalExtension();
                                $filenametostore = 'arc_ackw_receipt_'.$dte_id.'.'.$extension;
                           
                                $path = $request->file('arc_ackw_receipt')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                $fe_students->arc_ackw_receipt_path = $filenametostore;
                                $fe_students->arc_ackw_receipt='Yes';
                                $fe_students->save();
                              }
                        
                               else
                                {
                                      $fe_students->arc_ackw_receipt='No';
                                      $fe_students->save();
                                }
                     }
                     elseif ($test_arc_ackw_receipt=="no") {
                         $fe_students->arc_ackw_receipt='No';
                     }
                      elseif ($test_arc_ackw_receipt== null) {
                        $request->session()->flash('arc_ackw_receipt_error', 'Please select an option');
                          return redirect()->route('fe_document_upload');
                      }
            }

            $test_hsc_leaving_certi = $request->input('hsc_leaving_certi');
              if($fe_students->hsc_leaving_certi_path == null)
                 {
                      
                          if ($test_hsc_leaving_certi=="yes") 
                          {
                              if($request->hasFile('hsc_leaving_certi')) 
                              {
                                $rules = ['hsc_leaving_certi' => 'mimes:pdf|max:1024'];
                                  $validator = Validator::make(Input::all() , $rules);
                                if ($validator->fails())
                                 {
                                  $request->session()->flash('hsc_leaving_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                  return redirect()->route('fe_document_upload');
                                 }
                                $extension = $request->file('hsc_leaving_certi')->getClientOriginalExtension();
                                $filenametostore = 'hsc_leaving_certi_'.$dte_id.'.'.$extension;
                                $path = $request->file('hsc_leaving_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                $fe_students->hsc_leaving_certi_path = $filenametostore;
                                      $fe_students->hsc_leaving_certi = 'Yes';
                                $fe_students->save();
                               }
                                else
                                {
                                      $fe_students->hsc_leaving_tc='No';
                                      $fe_students->save();
                                }
                         }
                     elseif ($test_hsc_leaving_certi=="no") {
                        $fe_students->hsc_leaving_certi='No';
                      }
                      elseif ($test_hsc_leaving_certi== null) {
                        $request->session()->flash('hsc_leaving_certi_error', 'Please select an option');
                          return redirect()->route('fe_document_upload');
                      }
                 }

    
              $test_migration_certi = $request->input('migration_certi');
              if($fe_students->migration_certi_path == null)
                 {
                              if ($test_migration_certi=="yes") 
                          {
                          if($request->hasFile('migration_certi')) 
                          {
                            $rules = ['migration_certi' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('migration_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              return redirect()->route('fe_document_upload');
                             }
                            $extension = $request->file('migration_certi')->getClientOriginalExtension();
                           $filenametostore = 'migration_certi_'.$dte_id.'.'.$extension;
                            $path = $request->file('migration_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $fe_students->migration_certi_path = $filenametostore;
                                    $fe_students->migration_certi='Yes';
                            $fe_students->save();
                          }
                          else
                            {
                                  $fe_students->migration_certi='No';
                                  $fe_students->save();
                            }
                        }
                        elseif ($test_migration_certi=="no") {
                            $fe_students->migration_certi='No';
                          }
                          elseif ($test_migration_certi== null) {
                            $request->session()->flash('migration_certi_error', 'Please select an option');
                              //return redirect()->route('fe_document_upload');
                          }
                 }

            $test_aadhar = $request->input('aadhar');
              if($fe_students->aadhar_path == null)
                 {
                          if ($test_aadhar=="yes") 
                          {
                              if($request->hasFile('aadhar')) 
                              {
                                $rules = ['aadhar' => 'mimes:pdf|max:1024'];
                                  $validator = Validator::make(Input::all() , $rules);
                                if ($validator->fails())
                                 {
                                  $request->session()->flash('aadhar_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                  return redirect()->route('fe_document_upload');
                                 }
                                $extension = $request->file('aadhar')->getClientOriginalExtension();
                                $filenametostore = 'aadhar_'.$dte_id.'.'.$extension;
                                $path = $request->file('aadhar')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                $fe_students->aadhar_path =$filenametostore;
                                        $fe_students->aadhar='Yes';
                                $fe_students->save();
                               }
                        
                                else
                                {
                                      $fe_students->aadhar='No';
                                      $fe_students->save();
                                }
                        }
                     elseif ($test_aadhar=="no") {
                        $fe_students->aadhar='No';
                      }
                      elseif ($test_aadhar== null) {
                        $request->session()->flash('aadhar_error', 'Please select an option');
                          return redirect()->route('fe_document_upload');
                      }
                 }
            $test_retention = $request->input('retention');
               
               if($fe_students->retention_path == null)
                 {
                              if ($test_retention=="yes") 
                          {
                                  if($request->hasFile('retention')) 
                                  {
                                            $rules = ['retention' => 'mimes:pdf|max:1024'];
                                              $validator = Validator::make(Input::all() , $rules);
                                            if ($validator->fails())
                                             {
                                              $request->session()->flash('retention_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                              return redirect()->route('fe_document_upload');
                                             }
                                            $extension = $request->file('retention')->getClientOriginalExtension();
                                            $filenametostore = 'retention_'.$dte_id.'.'.$extension;
                                            $path = $request->file('retention')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                            $fe_students->retention_path = $filenametostore;
                                            $fe_students->retention='Yes';
                                            $fe_students->save();
                                  }
                            
                                   else
                                    {
                                          $fe_students->retention='No';
                                          $fe_students->save();
                                    }
                        }
                        elseif ($test_retention=="no") {
                            $fe_students->retention='No';
                          }
                          elseif ($test_retention=="na") {
                            $fe_students->retention='Not Applicable';
                          }
                          elseif ($test_retention== null) {
                            $request->session()->flash('retention_error', 'Please select an option');
                              return redirect()->route('fe_document_upload');
                          }
                 }
            $test_caste_validity_certi = $request->input('caste_validity_certi');
              if($fe_students->caste_validity_certi_path == null)
              {
                  if ($test_caste_validity_certi=="yes") 
              {
                      if($request->hasFile('caste_validity_certi')) 
                      {
                        $rules = ['caste_validity_certi' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('caste_validity_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('fe_document_upload');
                         }
                        $extension = $request->file('caste_validity_certi')->getClientOriginalExtension();
                        $filenametostore = 'caste_validity_certi_'.$dte_id.'.'.$extension;
                        $path = $request->file('caste_validity_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $fe_students->caste_validity_certi_path = $filenametostore;
                        $fe_students->caste_validity_certi='Yes';
                        $fe_students->save();
                       }
                       else
                        {
                              $fe_students->caste_validity_certi='No';
                              $fe_students->save();
                        }
             }
             elseif ($test_caste_validity_certi=="no") {
                $fe_students->caste_validity_certi='No';
              }
              elseif ($test_caste_validity_certi=="na") {
                $fe_students->caste_validity_certi='Not Applicable';
              }
              elseif ($test_caste_validity_certi== null) {
                $request->session()->flash('caste_validity_certi_error', 'Please select an option');
                  return redirect()->route('fe_document_upload');
              }
             }
            $test_non_creamy_layer_certi = $request->input('non_creamy_layer_certi');
             if($fe_students->non_creamy_layer_certi_path == null)
             {
                    if ($test_non_creamy_layer_certi=="yes") 
                {
                        if($request->hasFile('non_creamy_layer_certi')) 
                        {
                          $rules = ['non_creamy_layer_certi' => 'mimes:pdf|max:1024'];
                            $validator = Validator::make(Input::all() , $rules);
                          if ($validator->fails())
                           {
                            $request->session()->flash('non_creamy_layer_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                            return redirect()->route('fe_document_upload');
                           }
                          $extension = $request->file('non_creamy_layer_certi')->getClientOriginalExtension();
                          $filenametostore = 'non_creamy_layer_certi_'.$dte_id.'.'.$extension;
                          $path = $request->file('non_creamy_layer_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                          $fe_students->non_creamy_layer_certi_path = $filenametostore;
                          $fe_students->non_creamy_layer_certi='Yes';
                          $fe_students->save();
                          }
                  
                           else
                          {
                                $fe_students->non_creamy_layer_certi='No';
                                $fe_students->save();
                          }
                }
                elseif ($test_non_creamy_layer_certi=="no") {
                  $fe_students->non_creamy_layer_certi='No';
                }
                elseif ($test_non_creamy_layer_certi=="na") {
                  $fe_students->non_creamy_layer_certi='Not Applicable';
                }
                elseif ($test_non_creamy_layer_certi== null) {
                  $request->session()->flash('non_creamy_layer_certi_error', 'Please select an option');
                    return redirect()->route('fe_document_upload');
                }
              }
    
           $test_proforma_a_b1_b2 = $request->input('proforma_a_b1_b2');
             if($fe_students->proforma_a_b1_b2_path == null)
              {
                 
                    if ($test_proforma_a_b1_b2=="yes") 
                {
                        if($request->hasFile('proforma_a_b1_b2')) 
                        {
                          $rules = ['proforma_a_b1_b2' => 'mimes:pdf|max:1024'];
                            $validator = Validator::make(Input::all() , $rules);
                          if ($validator->fails())
                           {
                            $request->session()->flash('proforma_a_b1_b2_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                            return redirect()->route('fe_document_upload');
                           }
                          $extension = $request->file('proforma_a_b1_b2')->getClientOriginalExtension();
                         $filenametostore = 'proforma_a_b1_b2_'.$dte_id.'.'.$extension;
                         $path = $request->file('proforma_a_b1_b2')->storeAs($destinationPath, $filenametostore,'public_uploads');
                         $fe_students->proforma_a_b1_b2_path = $filenametostore;
                          $fe_students->proforma_a_b1_b2='Yes';
                          $fe_students->save();
                          }
                  
                           else
                          {
                                $fe_students->proforma_a_b1_b2='No';
                                $fe_students->save();
                          }
                }
                elseif ($test_proforma_a_b1_b2=="no") {
                  $fe_students->proforma_a_b1_b2='No';
                }
                elseif ($test_proforma_a_b1_b2=="na") {
                  $fe_students->proforma_a_b1_b2='Not Applicable';
                }
                elseif ($test_proforma_a_b1_b2== null) {
                  $request->session()->flash('proforma_a_b1_b2_error', 'Please select an option');
                    return redirect()->route('fe_document_upload');
                }
            }
            
            
           $test_proforma_g1_g2 = $request->input('proforma_g1_g2');
                  if($fe_students->proforma_g1_g2_path == null)
                     {
                              if ($test_proforma_g1_g2=="yes") 
                          {
                                  if($request->hasFile('proforma_g1_g2')) 
                                  {
                                    $rules = ['proforma_g1_g2' => 'mimes:pdf|max:1024'];
                                      $validator = Validator::make(Input::all() , $rules);
                                    if ($validator->fails())
                                     {
                                      $request->session()->flash('proforma_g1_g2_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                      return redirect()->route('fe_document_upload');
                                     }
                                    $extension = $request->file('proforma_g1_g2')->getClientOriginalExtension();
                                    $filenametostore = 'proforma_g1_g2_'.$dte_id.'.'.$extension;
                                    $path = $request->file('proforma_g1_g2')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                    $fe_students->proforma_g1_g2_path = $filenametostore;
                                    $fe_students->proforma_g1_g2='Yes';
                                    $fe_students->save();
                                    }
                                     else
                                    {
                                          $fe_students->proforma_g1_g2='No';
                                          $fe_students->save();
                                    }
                          }
                          elseif ($test_proforma_g1_g2=="no") {
                            $fe_students->proforma_g1_g2='No';
                          }
                          elseif ($test_proforma_g1_g2=="na") {
                            $fe_students->proforma_g1_g2='Not Applicable';
                          }
                          elseif ($test_proforma_g1_g2== null) {
                            $request->session()->flash('proforma_g1_g2_error', 'Please select an option');
                              return redirect()->route('fe_document_upload');
                          }
                     }
                     
                $test_proforma_v = $request->input('proforma_v');
                  if($fe_students->proforma_v_path == null)
                     {
                              if ($test_proforma_v=="yes") 
                          {
                                  if($request->hasFile('proforma_v'))
                                  {
                                    $rules = ['proforma_v' => 'mimes:pdf|max:1024'];
                                      $validator = Validator::make(Input::all() , $rules);
                                    if ($validator->fails())
                                     {
                                      $request->session()->flash('proforma_v_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                      return redirect()->route('fe_document_upload');
                                     }
                                    $extension = $request->file('proforma_v')->getClientOriginalExtension();
                                    $filenametostore = 'proforma_v_'.$dte_id.'.'.$extension;
                                    $path = $request->file('proforma_v')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                    $fe_students->proforma_v_path = $filenametostore;
                                    $fe_students->proforma_v='Yes';
                                    $fe_students->save();
                                    }
                                     else
                                    {
                                          $fe_students->proforma_v='No';
                                          $fe_students->save();
                                    }
                          }
                          elseif ($test_proforma_v=="no") {
                            $fe_students->proforma_v='No';
                          }
                          elseif ($test_proforma_v=="na") {
                            $fe_students->proforma_v='Not Applicable';
                          }
                          elseif ($test_proforma_v== null) {
                            $request->session()->flash('proforma_v_error', 'Please select an option');
                              return redirect()->route('fe_document_upload');
                          }
                     }


                    $test_proforma_u = $request->input('proforma_u');
                  if($fe_students->proforma_u_path == null)
                     {
                              if ($test_proforma_u=="yes") 
                          {
                                  if($request->hasFile('proforma_u')) 
                                  {
                                    $rules = ['proforma_u' => 'mimes:pdf|max:1024'];
                                      $validator = Validator::make(Input::all() , $rules);
                                    if ($validator->fails())
                                     {
                                      $request->session()->flash('proforma_u_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                      return redirect()->route('fe_document_upload');
                                     }
                                    $extension = $request->file('proforma_u')->getClientOriginalExtension();
                                    $filenametostore = 'proforma_u_'.$dte_id.'.'.$extension;
                                    $path = $request->file('proforma_u')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                    $fe_students->proforma_u_path = $filenametostore;
                                    $fe_students->proforma_u='Yes';
                                    $fe_students->save();
                                    }
                                     else
                                    {
                                          $fe_students->proforma_u='No';
                                          $fe_students->save();
                                    }
                          }
                          elseif ($test_proforma_u=="no") {
                            $fe_students->proforma_u='No';
                          }
                          elseif ($test_proforma_u=="na") {
                            $fe_students->proforma_u='Not Applicable';
                          }
                          elseif ($test_proforma_u== null) {
                            $request->session()->flash('proforma_u_error', 'Please select an option');
                              return redirect()->route('fe_document_upload');
                          }
                     }
                     
            //return "hello";
           $test_income_certi = $request->input('income_certi');
              if($fe_students->income_certi_path == null)
                   {
                                if ($test_income_certi=="yes") 
                            {
                                    if($request->hasFile('income_certi')) 
                                    {
                                      $rules = ['income_certi' => 'mimes:pdf|max:1024'];
                                        $validator = Validator::make(Input::all() , $rules);
                                      if ($validator->fails())
                                       {
                                        $request->session()->flash('income_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                        return redirect()->route('fe_document_upload');
                                       }
                                      $extension = $request->file('income_certi')->getClientOriginalExtension();
                                      $filenametostore = 'income_certi_'.$dte_id.'.'.$extension;
                                      $path = $request->file('income_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                      $fe_students->income_certi_path = $filenametostore;
                                      $fe_students->income_certi='Yes';
                                      $fe_students->save();
                                    }
                                    else
                                      {
                                            $fe_students->income_certi='No';
                                            $fe_students->save();
                                      }
                          }
                          elseif ($test_income_certi=="no") {
                              $fe_students->income_certi='No';
                            }
                            elseif ($test_income_certi=="na") {
                              $fe_students->income_certi='Not Applicable';
                            }
                            elseif ($test_income_certi== null) {
                              $request->session()->flash('income_certi_error', 'Please select an option');
                                return redirect()->route('fe_document_upload');
                            }
                   }

           $test_proforma_c_d_e = $request->input('proforma_c_d_e');
                  if($fe_students->proforma_c_d_e_path == null)
                   { 
                            if ($test_proforma_c_d_e=="yes") 
                        {
                                if($request->hasFile('proforma_c_d_e')) 
                                {
                                  $rules = ['proforma_c_d_e' => 'mimes:pdf|max:1024'];
                                    $validator = Validator::make(Input::all() , $rules);
                                  if ($validator->fails())
                                   {
                                    $request->session()->flash('proforma_c_d_e_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                    return redirect()->route('fe_document_upload');
                                   }
                                  $extension = $request->file('proforma_c_d_e')->getClientOriginalExtension();
                                  $filenametostore = 'proforma_c_d_e'.$dte_id.'.'.$extension;
                                  $path = $request->file('proforma_c_d_e')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                  $fe_students->proforma_c_d_e_path = $filenametostore;
                                          $fe_students->proforma_c_d_e='Yes';
                                  $fe_students->save();
                                }
                                 else
                                  {
                                        $fe_students->proforma_c_d_e='No';
                                        $fe_students->save();
                                  }
                      }
                      elseif ($test_proforma_c_d_e=="no") {
                          $fe_students->proforma_c_d_e='No';
                        }
                        elseif ($test_proforma_c_d_e=="na") {
                          $fe_students->proforma_c_d_e='Not Applicable';
                        }
                        elseif ($test_proforma_c_d_e== null) {
                          $request->session()->flash('proforma_c_d_e_error', 'Please select an option');
                            return redirect()->route('fe_document_upload');
                        }
                   }
           $test_proforma_j_k_l = $request->input('proforma_j_k_l');
           //return $test_proforma_j_k_l;
                if($fe_students->proforma_j_k_l_path == null)
                   { 
                            if ($test_proforma_j_k_l=="yes") 
                        {
                                if($request->hasFile('proforma_j_k_l')) 
                                {
                                    //return "h";
                                  $rules = ['proforma_j_k_l' => 'mimes:pdf|max:1024'];
                                    $validator = Validator::make(Input::all() , $rules);
                                  if ($validator->fails())
                                   {
                                    $request->session()->flash('proforma_j_k_l_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                    return redirect()->route('fe_document_upload');
                                   }
                                  $extension = $request->file('proforma_j_k_l')->getClientOriginalExtension();
                                  $filenametostore = 'proforma_j_k_l_'.$dte_id.'.'.$extension;
                                  $path = $request->file('proforma_j_k_l')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                  $fe_students->proforma_j_k_l_path =$filenametostore;
                                  $fe_students->proforma_j_k_l='Yes';
                                  $fe_students->save();
                                }
                                else
                                  {
                                        $fe_students->proforma_j_k_l='No';
                                        $fe_students->save();
                                  }
                      }
                      elseif ($test_proforma_j_k_l=="no") {
                          $fe_students->proforma_j_k_l='No';
                        }
                        elseif ($test_proforma_j_k_l=="na") {
                          $fe_students->proforma_j_k_l='Not Applicable';
                        }
                        elseif ($test_proforma_j_k_l== null) {
                          $request->session()->flash('proforma_j_k_l_error', 'Please select an option');
                            return redirect()->route('fe_document_upload');
                        }
                   }


           $test_caste_certi = $request->input('caste_certi');
      
              if($fe_students->caste_certi_path == null)
                {
                      if ($test_caste_certi=="yes") 
                  {
                          if($request->hasFile('caste_certi')) 
                          {
                            $rules = ['caste_certi' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('caste_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              return "Hello";
                              return redirect()->route('fe_document_upload');
                             }
                            $extension = $request->file('caste_certi')->getClientOriginalExtension();
                            $filenametostore = 'caste_certi_'.$dte_id.'.'.$extension;
                            $path = $request->file('caste_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $fe_students->caste_certi_path =$filenametostore;
                            $fe_students->caste_certi='Yes';
                            $fe_students->save();
                           }
                            else
                            {
                                  $fe_students->caste_certi='No';
                                  $fe_students->save();
                            }
                 }
                 elseif ($test_caste_certi=="no") {
                    $fe_students->caste_certi='No';
                  }
                  elseif ($test_caste_certi=="na") {
                    $fe_students->caste_certi='Not Applicable';
                  }
                  elseif ($test_caste_certi== null) {
                    $request->session()->flash('caste_certi_error', 'Please select an option');
                    return "Hello2";
                      return redirect()->route('fe_document_upload');
                  }
               }


               $test_ssc_marksheet = $request->input('ssc_marksheet');
      if($fe_students->ssc_marksheet_path == null)
         {
                      if ($test_ssc_marksheet=="yes") 
                      {
                            if($request->hasFile('ssc_marksheet')) 
                            {
                              $rules = ['ssc_marksheet' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('ssc_marksheet_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              return "Hello";
                              return redirect()->route('fe_document_upload');
                             }
                      
                               //get file extension
                            $extension = $request->file('ssc_marksheet')->getClientOriginalExtension();
                            
                            //filename to store
                            $filenametostore = 'ssc_marksheet_'.$dte_id.'.'.$extension;
                            
                            //Upload File
                            $path = $request->file('ssc_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                     $fe_students->ssc_marksheet_path = $filenametostore;
                                      $fe_students->ssc_marksheet = 'Yes';
                            $fe_students->save();
                          }
                          else
                            {
                                  $fe_students->ssc_marksheet='No';
                                  $fe_students->save();
                            }
                }
                elseif ($test_ssc_marksheet=="no") {
                    $fe_students->ssc_marksheet='No';
                  }
                  elseif ($test_ssc_marksheet== null) {
                    $request->session()->flash('ssc_marksheet_error', 'Please select an option');
                    return "Hello2";
                      return redirect()->route('fe_document_upload');
                  }
         }
         
      $test_hsc_marksheet = $request->input('hsc_marksheet');
       if($fe_students->hsc_marksheet_path == null)
         {
                          if ($test_hsc_marksheet=="yes") 
                          {
                                  if($request->hasFile('hsc_marksheet')) 
                                  {
                                    $rules = ['hsc_marksheet' => 'mimes:pdf|max:1024'];
                                      $validator = Validator::make(Input::all() , $rules);
                                    if ($validator->fails())
                                     {
                                      $request->session()->flash('hsc_marksheet_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                      return redirect()->route('fe_document_upload');
                                     }
                                    $extension = $request->file('hsc_marksheet')->getClientOriginalExtension();
                                    $filenametostore = 'hsc_marksheet'.$dte_id.'.'.$extension;
                                    $path = $request->file('hsc_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                    $fe_students->hsc_marksheet_path = $filenametostore;
                                     $fe_students->hsc_marksheet='Yes';
                                    $fe_students->save();
                                  }
                                  else
                                    {
                                          $fe_students->hsc_marksheet='No';
                                          $fe_students->save();
                                    }
                    }
                    elseif ($test_hsc_marksheet=="no") {
                        $fe_students->hsc_marksheet='No';
                      }
                      elseif ($test_hsc_marksheet== null) {
                        $request->session()->flash('hsc_marksheet_error', 'Please select an option');
                          return redirect()->route('fe_document_upload');
                      }
         }           
      

      $test_hsc_passing_certi = $request->input('hsc_passing_certi');
       if($fe_students->hsc_passing_certi_path == null)
         {
                  if ($test_hsc_passing_certi=="yes") 
                  {
                      if($request->hasFile('hsc_passing_certi')) 
                      {
                        $rules = ['hsc_passing_certi' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('hsc_passing_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('fe_document_upload');
                         }
                        $extension = $request->file('hsc_passing_certi')->getClientOriginalExtension();
                        $filenametostore = 'hsc_passing_certi_'.$dte_id.'.'.$extension;
                        $path = $request->file('hsc_passing_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $fe_students->hsc_passing_certi_path = $filenametostore;
                                $fe_students->hsc_passing_certi='Yes';
                        $fe_students->save();
                      }
                      else
                        {
                              $fe_students->hsc_passing_certi='No';
                              $fe_students->save();
                        }
                }
            elseif ($test_hsc_passing_certi=="no") {
                $fe_students->hsc_passing_certi='No';
              }
              elseif ($test_hsc_passing_certi== null) {
                $request->session()->flash('convocation_passing_certi_error', 'Please select an option');
                  return redirect()->route('fe_document_upload');
              }
         }

      


      $test_birth_certi = $request->input('birth_certi');
     if($fe_students->birth_certi_path == null)
         {
                  if ($test_birth_certi=="yes") 
              {
                      if($request->hasFile('birth_certi')) 
                      {
                        $rules = ['birth_certi' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('birth_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('fe_document_upload');
                         }
                        $extension = $request->file('birth_certi')->getClientOriginalExtension();
                        $filenametostore = 'birth_certi_'.$dte_id.'.'.$extension;
                        $path = $request->file('birth_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $fe_students->birth_certi_path = $filenametostore;
                        $fe_students->birth_certi='Yes';
                        $fe_students->save();
                      }
                      else
                        {
                              $fe_students->birth_certi='No';
                              $fe_students->save();
                        }
             }
            elseif ($test_birth_certi=="no") {
                $fe_students->birth_certi='No';
              }
              elseif ($test_birth_certi== null) {
                $request->session()->flash('birth_certi_error', 'Please select an option');
                  return redirect()->route('fe_document_upload');
              }
         }
      $test_domicile = $request->input('domicile');
      if($fe_students->domicile_path == null)
         {
                  if ($test_domicile=="yes") 
                  {
                      if($request->hasFile('domicile')) 
                      {
                        $rules = ['domicile' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('domicile_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('fe_document_upload');
                         }
                        $extension = $request->file('domicile')->getClientOriginalExtension();
                        $filenametostore = 'domicile_'.$dte_id.'.'.$extension;
                        $path = $request->file('domicile')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $fe_students->domicile_path =$filenametostore;
                                $fe_students->domicile='Yes';
                        $fe_students->save();
                       }
                
                        else
                        {
                              $fe_students->domicile='No';
                              $fe_students->save();
                        }
                }
             elseif ($test_domicile=="no") {
                $fe_students->domicile='No';
              }
              elseif ($test_domicile== null) {
                $request->session()->flash('domicile_error', 'Please select an option');
                  return redirect()->route('fe_document_upload');
              }
         }

     
           
     $test_proforma_o = $request->input('proforma_o');
           if($fe_students->proforma_o_path == null)
         {
                      if ($test_proforma_o=="yes") 
                  {
                          if($request->hasFile('proforma_o')) 
                          {
                                $rules = ['proforma_o' => 'mimes:pdf|max:1024'];
                                  $validator = Validator::make(Input::all() , $rules);
                                if ($validator->fails())
                                 {
                                  $request->session()->flash('proforma_o_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                  return redirect()->route('fe_document_upload');
                                }
                            $extension = $request->file('proforma_o')->getClientOriginalExtension();
                            $filenametostore = 'proforma_o_'.$dte_id.'.'.$extension;
                            $path = $request->file('proforma_o')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $fe_students->proforma_o_path = $filenametostore;
                                    $fe_students->proforma_o='Yes';
                            $fe_students->save();
                            }
                            else
                            {
                                  $fe_students->proforma_o='No';
                                  $fe_students->save();
                            }
                 }
                  elseif ($test_proforma_o=="no") {
                    $fe_students->proforma_o='No';
                  }
                  elseif ($test_proforma_o=="na") {
                    $fe_students->proforma_o='Not Applicable';
                  }
                  elseif ($test_proforma_o== null) {
                    $request->session()->flash('proforma_o_error', 'Please select an option');
                      return redirect()->route('fe_document_upload');
                  }
         }
       

      $test_minority_affidavit = $request->input('minority_affidavit');
      if($fe_students->minority_affidavit_path == null)
         {
                  if ($test_minority_affidavit=="yes") 
              {
              if($request->hasFile('minority_affidavit')) 
              {
                        $rules = ['minority_affidavit' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('minority_affidavit_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('fe_document_upload');
                         }
                        $extension = $request->file('minority_affidavit')->getClientOriginalExtension();
                        $filenametostore = 'minority_affidavit_'.$dte_id.'.'.$extension;
                        $path = $request->file('minority_affidavit')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $fe_students->minority_affidavit_path = $filenametostore;
                        $fe_students->minority_affidavit='Yes';
                        $fe_students->save();
                        }
                         else
                        {
                              $fe_students->minority_affidavit='No';
                              $fe_students->save();
                        }
              }
              elseif ($test_minority_affidavit=="no") {
                $fe_students->minority_affidavit='No';
              }
              elseif ($test_minority_affidavit=="na") {
                $fe_students->minority_affidavit='Not Applicable';
              }
              elseif ($test_minority_affidavit== null) {
                $request->session()->flash('minority_affidavit_error', 'Please select an option');
                  return redirect()->route('fe_document_upload');
              }
         }

      $test_gap_certi = $request->input('gap_certi');
       if($fe_students->gap_certi_path == null)
         {
                  if ($test_gap_certi=="yes") 
              {
                          if($request->hasFile('gap_certi')) 
                          {
                                $rules = ['gap_certi' => 'mimes:pdf|max:1024'];
                                  $validator = Validator::make(Input::all() , $rules);
                                if ($validator->fails())
                                 {
                                  $request->session()->flash('gap_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                  return redirect()->route('fe_document_upload');
                                 }
                                $extension = $request->file('gap_certi')->getClientOriginalExtension();
                                $filenametostore = 'gap_certi_'.$dte_id.'.'.$extension;
                                $path = $request->file('gap_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                $fe_students->gap_certi_path =$filenametostore;
                                $fe_students->gap_certi='Yes';
                                $fe_students->save();
                            }
                                else
                                {
                                      $fe_students->gap_certi='No';
                                      $fe_students->save();
                                }
            }
              elseif ($test_gap_certi=="no") {
                $fe_students->gap_certi='No';
              }
              elseif ($test_gap_certi=="na") {
                $fe_students->gap_certi='Not Applicable';
              }
              elseif ($test_gap_certi== null) {
                $request->session()->flash('gap_certi_error', 'Please select an option');
                  return redirect()->route('fe_document_upload');
              }
         }
      $test_community_certi = $request->input('community_certi');
      
      if($fe_students->community_certi_path == null)
         {
                      if ($test_community_certi=="yes") 
                  {
                          if($request->hasFile('community_certi')) 
                          {
                            $rules = ['community_certi' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('community_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              return redirect()->route('fe_document_upload');
                             }
                            $extension = $request->file('community_certi')->getClientOriginalExtension();
                            $filenametostore = 'community_certi_'.$dte_id.'.'.$extension;
                            $path = $request->file('community_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $fe_students->community_certi_path = $filenametostore;
                            $fe_students->community_certi='Yes';
                            $fe_students->save();
                            }
                             else
                            {
                                  $fe_students->community_certi='No';
                                  $fe_students->save();
                            }
                  }
                  elseif ($test_community_certi=="no") {
                    $fe_students->community_certi='No';
                  }
                  elseif ($test_community_certi=="na") {
                    $fe_students->community_certi='Not Applicable';
                  }
                  elseif ($test_community_certi== null) {
                    $request->session()->flash('community_certi_error', 'Please select an option');
                      return redirect()->route('fe_document_upload');
                  } 
         }
            $test_medical_certi = $request->input('medical_certi');
       if($fe_students->medical_certi_path == null)
         {
                      if ($test_medical_certi=="yes") 
                  {
                          if($request->hasFile('medical_certi')) 
                          {
                            $rules = ['medical_certi' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('medical_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              return redirect()->route('fe_document_upload');
                             }
                            $extension = $request->file('medical_certi')->getClientOriginalExtension();
                            $filenametostore = 'medical_certi_'.$dte_id.'.'.$extension;
                            $path = $request->file('medical_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $fe_students->medical_certi_path = $filenametostore;
                                    $fe_students->medical_certi='Yes';
                            $fe_students->save();
                          }
                            else
                            {
                                  $fe_students->medical_certi='No';
                                  $fe_students->save();
                            }
                }
                elseif ($test_medical_certi=="no") {
                    $fe_students->medical_certi='No';
                  }
                  elseif ($test_medical_certi== null) {
                    $request->session()->flash('medical_certi_error', 'Please select an option');
                      return redirect()->route('fe_document_upload');
                  }
         }
      $test_anti_ragging_affidavit = $request->input('anti_ragging_affidavit');
        if($fe_students->anti_ragging_affidavit_path == null)
         {
                  if ($test_anti_ragging_affidavit=="yes") 
              {
                      if($request->hasFile('anti_ragging_affidavit')) 
                      {
                        $rules = ['anti_ragging_affidavit' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('anti_ragging_affidavit_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('fe_document_upload');
                         }
                        $extension = $request->file('anti_ragging_affidavit')->getClientOriginalExtension();
                        $filenametostore = 'anti_ragging_affidavit'.$dte_id.'.'.$extension;
                        $path = $request->file('anti_ragging_affidavit')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $fe_students->anti_ragging_affidavit_path = $filenametostore;
                                $fe_students->anti_ragging_affidavit='Yes';
                        $fe_students->save();
                      }
                       else
                        {
                              $fe_students->anti_ragging_affidavit='No';
                              $fe_students->save();
                        }
            }
            elseif ($test_anti_ragging_affidavit=="no") {
                $fe_students->anti_ragging_affidavit='No';
              }
              elseif ($test_anti_ragging_affidavit== null) {
                $request->session()->flash('anti_ragging_affidavit_error', 'Please select an option');
                  return redirect()->route('fe_document_upload');
              }
         }

     // }
  //active dte ends here





        //return $fe_students->hsc_passing_certi_path;

      //          $test_hsc_passing_certi = $request->input('hsc_passing_certi');
      // return $test_hsc_passing_certi;
      
        if($fe_students->is_cet == '1'){

        $test_cet_result = $request->input('cet_result');
        //return $test_cet_result;
        if($fe_students->cet_result_path == null)
         {
                  if ($test_cet_result=="yes") 
                  {
                      if($request->hasFile('cet_result'))
                          {
                            $rules = ['cet_result' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('cet_result_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              return redirect()->route('fe_document_upload');
                             }
                            $extension = $request->file('cet_result')->getClientOriginalExtension();
                            $filenametostore = 'cet_result_'.$dte_id.'.'.$extension;
                       
                            $path = $request->file('cet_result')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $fe_students->cet_result_path = $filenametostore;
                            $fe_students->cet_result = 'Yes';
                            $fe_students->save();
                          }
                          else
                            {
                                  $fe_students->cet_result='No';
                                  $fe_students->save();
                            }
            }
            elseif ($test_cet_result=="no") {
                $fe_students->cet_result='No';
              }
              elseif ($test_cet_result== null) {
                $request->session()->flash('cet_result_error', 'Please select an option');
                  return redirect()->route('fe_document_upload');
              }

         }
       }
      // return $a;
        if ($fe_students->is_jee == '1') {
          
         
        $test_jee_result = $request->input('jee_result');
        //return $test_jee_result;
        if($fe_students->jee_result_path == null)
         {
                  if ($test_jee_result=="yes") 
                  {
                      if($request->hasFile('jee_result'))
                          {
                            $rules = ['jee_result' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('jee_result_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              return redirect()->route('fe_document_upload');
                             }
                            $extension = $request->file('jee_result')->getClientOriginalExtension();
                            $filenametostore = 'jee_result_'.$dte_id.'.'.$extension;
                       
                            $path = $request->file('jee_result')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $fe_students->jee_result_path = $filenametostore;
                            $fe_students->jee_result = 'Yes';
                            $fe_students->save();
                          }
                          else
                            {
                                  $fe_students->jee_result='No';
                                  $fe_students->save();
                            }
            }
            elseif ($test_jee_result=="no") {
                $fe_students->jee_result='No';
              }
              elseif ($test_jee_result== null) {
                $request->session()->flash('jee_result_error', 'Please select an option');
                  return redirect()->route('fe_document_upload');
              }

         }
       }
 
      
        $user1 = DB::table('fe_students')->select('dte_id','is_cet','is_jee','photo','photo_path','signature','signature_path','fc_confirmation_receipt','fc_confirmation_receipt_path','dte_allotment_letter','dte_allotment_letter_path','arc_ackw_receipt','arc_ackw_receipt_path','cet_result','cet_result_path','jee_result','jee_result_path','ssc_marksheet','ssc_marksheet_path','hsc_marksheet','hsc_marksheet_path','hsc_passing_certi','hsc_passing_certi_path','hsc_leaving_certi','hsc_leaving_certi_path','migration_certi','migration_certi_path','birth_certi','birth_certi_path','domicile','domicile_path','aadhar','aadhar_path','proforma_o','proforma_o_path','minority_affidavit','minority_affidavit_path','community_certi','community_certi_path','retention','retention_path','caste_certi','caste_certi_path','caste_validity_certi','caste_validity_certi_path','non_creamy_layer_certi','non_creamy_layer_certi_path','proforma_a_b1_b2','proforma_a_b1_b2_path','income_certi','income_certi_path','proforma_c_d_e','proforma_c_d_e_path','proforma_g1_g2','proforma_g1_g2_path','proforma_u','proforma_u_path','proforma_v','proforma_v_path','proforma_j_k_l','proforma_j_k_l_path','medical_certi','medical_certi_path','anti_ragging_affidavit','anti_ragging_affidavit_path','gap_certi','gap_certi_path','is_document_completed')->where('dte_id', $dte_id)->get();
        $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        $hash = $hash[0]->hash;

   // return $user1;
        if($user1[0]->photo ==  "Yes" && $user1[0]->signature == "Yes")
        {
            $fe_students->is_document_completed =1;
             $fe_students->save();
    
        }
        elseif($user1[0]->photo ==  null || $user1[0]->signature == null)
        {
              $fe_students->is_document_completed =0;
             // return "hello";
             $fe_students->save();
        }

        $data=[];
        
$course = $request->session()->get('log_course');
list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);

        $data['user1']=$user1;
        $data['hash'] = $hash;
        if ($activedte == "yes") {
        return view('user.fe.document_upload',$data);
      }

       if ($activeacap == "yes") {
        if($userprogress[0]->is_document_completed==1){
            $user1['prog_val']=7;
          $data['user1']=$user1;
          // return 'done';
        }

        return view('user.fe.acap_document_upload',$data);
      }


  }
        



  public static function uploadfeAcapDocumentUpload(Request $request)
    {


      $dte_id=$request->session()->get('log_dte_id'); 
      $use = DB::table('student_login')->select('hash')->where('dte_id', $dte_id)->get();
      $destinationPath = $dte_id.'_'.$use[0]->hash;

      $activedte= $request->session()->get('log_dte', 'null');
     $activeacap = $request->session()->get('log_acap');
     
        $fe_students = new fe_students;
        if(DB::table('fe_students')->where('dte_id', $dte_id)->exists()) 
          { 
           $fe_students  = fe_students::find($dte_id);
          }
          else
          {
            $fe_students->dte_id = $dte_id;
          }
        
        //return $fe_students->is_cet;
        //return  $fe_students->is_jee;
        $a = $request->input('jee_result');
        //return $a;
          $test_photo = $request->input('photo');
       //  return $fe_students->photo_path;
         if($fe_students->photo_path == null)
         {
                  if ($test_photo=="yes") 
                  {
                       if($request->hasFile('photo'))
                      {
                            $rules = ['photo' => 'mimes:jpg,png,jpeg'];
                             $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('photo_error', 'Please Upload Only JPG or PNG type image. File size should be less than 1 mb.');
                              return redirect()->route('fe_document_upload');
                             }
                            $extension = $request->file('photo')->getClientOriginalExtension();
                            $filenametostore = 'photo'.$dte_id.'.'.$extension;
                    
                            $path =  $request->file('photo')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $fe_students->photo_path = $filenametostore;
                            $fe_students->photo='Yes';
                            $fe_students->save();
                      }
                      else
                        {
                              $fe_students->photo='No';
                              $fe_students->save();
                        }
                 }
                  elseif ($test_photo=="no") {
                    $fe_students->photo='No';
                  }
                  elseif ($test_photo== null) {
                    $request->session()->flash('photo_error', 'Please select an option');
                      return redirect()->route('fe_document_upload');
                  }
          
         }
     
      $test_signature = $request->input('signature');
    //  return $test_signature;
    
    if($fe_students->signature_path == null)
         {
                  if ($test_signature=="yes") 
                  {
                        if($request->hasFile('signature'))
                        {
                                $rules = ['signature' => 'mimes:jpg,png,jpeg'];
                                  $validator = Validator::make(Input::all() , $rules);
                                if ($validator->fails())
                                 {
                                  $request->session()->flash('signature_error', 'Please Upload Only JPG or PNG type image. File size should be less than 1 mb.');
                                  return redirect()->route('fe_document_upload');
                                 }
                                $extension = $request->file('signature')->getClientOriginalExtension();
                                $filenametostore = 'signature'.$dte_id.'.'.$extension;
                                $path = $request->file('signature')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                  $fe_students->signature_path = $filenametostore;
                                   $fe_students->signature='Yes';
                                $fe_students->save();
                        }
                               else
                                {
                                      $fe_students->signature='No';
                                      $fe_students->save();
                                }
                 }
                  elseif ($test_signature=="no") {
                    $fe_students->signature='No';
                  }
                  elseif ($test_signature== null) {
                    $request->session()->flash('signature_error', 'Please select an option');
                      return redirect()->route('fe_document_upload');
                  }
         }
      
      $test_fc_confirmation_receipt = $request->input('fc_confirmation_receipt');
      //return $test_fc_confirmation_receipt;
       if($fe_students->fc_confirmation_receipt_path == null)
         {
      
              if ($test_fc_confirmation_receipt=="yes") 
              {
                 if($request->hasFile('fc_confirmation_receipt'))
                 { 
                        $rules = ['fc_confirmation_receipt' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('fc_confirmation_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('fe_document_upload');
                         }
                        $extension = $request->file('fc_confirmation_receipt')->getClientOriginalExtension();
                        $filenametostore = 'fc_confirmation_receipt'.$dte_id.'.'.$extension;
                        $path = $request->file('fc_confirmation_receipt')->storeAs($destinationPath, $filenametostore,'public_uploads');
                          $fe_students->fc_confirmation_receipt_path =$filenametostore;
                           $fe_students->fc_confirmation_receipt='Yes';
                        $fe_students->save();
                }
                  else
                    {
                          $fe_students->fc_confirmation_receipt='No';
                          $fe_students->save();
                    }
             }
             elseif ($test_fc_confirmation_receipt=="no") {
                $fe_students->fc_confirmation_receipt='No';
              }
              elseif ($test_fc_confirmation_receipt== null) {
                $request->session()->flash('fc_confirmation_error', 'Please select an option');
                  return redirect()->route('fe_document_upload');
              }

         }
       //return $activedte;
    //  if ($activedte == "yes") {
        
          
            

               $test_ssc_marksheet = $request->input('ssc_marksheet');
      if($fe_students->ssc_marksheet_path == null)
         {
                      if ($test_ssc_marksheet=="yes") 
                      {
                            if($request->hasFile('ssc_marksheet')) 
                            {
                              $rules = ['ssc_marksheet' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('ssc_marksheet_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              //return "Hello";
                              return redirect()->route('fe_document_upload');
                             }
                      
                               //get file extension
                            $extension = $request->file('ssc_marksheet')->getClientOriginalExtension();
                            
                            //filename to store
                            $filenametostore = 'ssc_marksheet_'.$dte_id.'.'.$extension;
                            
                            //Upload File
                            $path = $request->file('ssc_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                     $fe_students->ssc_marksheet_path = $filenametostore;
                                      $fe_students->ssc_marksheet = 'Yes';
                            $fe_students->save();
                          }
                          else
                            {
                                  $fe_students->ssc_marksheet='No';
                                  $fe_students->save();
                            }
                }
                elseif ($test_ssc_marksheet=="no") {
                    $fe_students->ssc_marksheet='No';
                  }
                  elseif ($test_ssc_marksheet== null) {
                    $request->session()->flash('ssc_marksheet_error', 'Please select an option');
                    return "Hello2";
                      return redirect()->route('fe_document_upload');
                  }
         }
         
         
         
      $test_hsc_marksheet = $request->input('hsc_marksheet');
       if($fe_students->hsc_marksheet_path == null)
         {
                          if ($test_hsc_marksheet=="yes") 
                          {
                                  if($request->hasFile('hsc_marksheet')) 
                                  {
                                    $rules = ['hsc_marksheet' => 'mimes:pdf|max:1024'];
                                      $validator = Validator::make(Input::all() , $rules);
                                    if ($validator->fails())
                                     {
                                      $request->session()->flash('hsc_marksheet_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                      return redirect()->route('fe_document_upload');
                                     }
                                    $extension = $request->file('hsc_marksheet')->getClientOriginalExtension();
                                    $filenametostore = 'hsc_marksheet'.$dte_id.'.'.$extension;
                                    $path = $request->file('hsc_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                    $fe_students->hsc_marksheet_path = $filenametostore;
                                     $fe_students->hsc_marksheet='Yes';
                                    $fe_students->save();
                                  }
                                  else
                                    {
                                          $fe_students->hsc_marksheet='No';
                                          $fe_students->save();
                                    }
                    }
                    elseif ($test_hsc_marksheet=="no") {
                        $fe_students->hsc_marksheet='No';
                      }
                      elseif ($test_hsc_marksheet== null) {
                        $request->session()->flash('hsc_marksheet_error', 'Please select an option');
                          return redirect()->route('fe_document_upload');
                      }
         }           
      

      $test_hsc_passing_certi = $request->input('hsc_passing_certi');
       if($fe_students->hsc_passing_certi_path == null)
         {
                  if ($test_hsc_passing_certi=="yes") 
                  {
                      if($request->hasFile('hsc_passing_certi')) 
                      {
                        $rules = ['hsc_passing_certi' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('hsc_passing_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('fe_document_upload');
                         }
                        $extension = $request->file('hsc_passing_certi')->getClientOriginalExtension();
                        $filenametostore = 'hsc_passing_certi_'.$dte_id.'.'.$extension;
                        $path = $request->file('hsc_passing_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $fe_students->hsc_passing_certi_path = $filenametostore;
                                $fe_students->hsc_passing_certi='Yes';
                        $fe_students->save();
                      }
                      else
                        {
                              $fe_students->hsc_passing_certi='No';
                              $fe_students->save();
                        }
                }
            elseif ($test_hsc_passing_certi=="no") {
                $fe_students->hsc_passing_certi='No';
              }
              elseif ($test_hsc_passing_certi== null) {
                $request->session()->flash('convocation_passing_certi_error', 'Please select an option');
                  return redirect()->route('fe_document_upload');
              }
         }

      


      $test_birth_certi = $request->input('birth_certi');
     if($fe_students->birth_certi_path == null)
         {
                  if ($test_birth_certi=="yes") 
              {
                      if($request->hasFile('birth_certi')) 
                      {
                        $rules = ['birth_certi' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('birth_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('fe_document_upload');
                         }
                        $extension = $request->file('birth_certi')->getClientOriginalExtension();
                        $filenametostore = 'birth_certi_'.$dte_id.'.'.$extension;
                        $path = $request->file('birth_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $fe_students->birth_certi_path = $filenametostore;
                        $fe_students->birth_certi='Yes';
                        $fe_students->save();
                      }
                      else
                        {
                              $fe_students->birth_certi='No';
                              $fe_students->save();
                        }
             }
            elseif ($test_birth_certi=="no") {
                $fe_students->birth_certi='No';
              }
              elseif ($test_birth_certi== null) {
                $request->session()->flash('birth_certi_error', 'Please select an option');
                  return redirect()->route('fe_document_upload');
              }
         }
      $test_domicile = $request->input('domicile');
      if($fe_students->domicile_path == null)
         {
                  if ($test_domicile=="yes") 
                  {
                      if($request->hasFile('domicile')) 
                      {
                        $rules = ['domicile' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('domicile_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('fe_document_upload');
                         }
                        $extension = $request->file('domicile')->getClientOriginalExtension();
                        $filenametostore = 'domicile_'.$dte_id.'.'.$extension;
                        $path = $request->file('domicile')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $fe_students->domicile_path =$filenametostore;
                                $fe_students->domicile='Yes';
                        $fe_students->save();
                       }
                
                        else
                        {
                              $fe_students->domicile='No';
                              $fe_students->save();
                        }
                }
             elseif ($test_domicile=="no") {
                $fe_students->domicile='No';
              }
              elseif ($test_domicile== null) {
                $request->session()->flash('domicile_error', 'Please select an option');
                  return redirect()->route('fe_document_upload');
              }
         }

     
           
     $test_proforma_o = $request->input('proforma_o');
           if($fe_students->proforma_o_path == null)
         {
                      if ($test_proforma_o=="yes") 
                  {
                          if($request->hasFile('proforma_o')) 
                          {
                                $rules = ['proforma_o' => 'mimes:pdf|max:1024'];
                                  $validator = Validator::make(Input::all() , $rules);
                                if ($validator->fails())
                                 {
                                  $request->session()->flash('proforma_o_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                  return redirect()->route('fe_document_upload');
                                }
                            $extension = $request->file('proforma_o')->getClientOriginalExtension();
                            $filenametostore = 'proforma_o_'.$dte_id.'.'.$extension;
                            $path = $request->file('proforma_o')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $fe_students->proforma_o_path = $filenametostore;
                                    $fe_students->proforma_o='Yes';
                            $fe_students->save();
                            }
                            else
                            {
                                  $fe_students->proforma_o='No';
                                  $fe_students->save();
                            }
                 }
                  elseif ($test_proforma_o=="no") {
                    $fe_students->proforma_o='No';
                  }
                  elseif ($test_proforma_o=="na") {
                    $fe_students->proforma_o='Not Applicable';
                  }
                  elseif ($test_proforma_o== null) {
                    $request->session()->flash('proforma_o_error', 'Please select an option');
                      return redirect()->route('fe_document_upload');
                  }
         }
       

      $test_minority_affidavit = $request->input('minority_affidavit');
      if($fe_students->minority_affidavit_path == null)
         {
                  if ($test_minority_affidavit=="yes") 
              {
              if($request->hasFile('minority_affidavit')) 
              {
                        $rules = ['minority_affidavit' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('minority_affidavit_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('fe_document_upload');
                         }
                        $extension = $request->file('minority_affidavit')->getClientOriginalExtension();
                        $filenametostore = 'minority_affidavit_'.$dte_id.'.'.$extension;
                        $path = $request->file('minority_affidavit')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $fe_students->minority_affidavit_path = $filenametostore;
                        $fe_students->minority_affidavit='Yes';
                        $fe_students->save();
                        }
                         else
                        {
                              $fe_students->minority_affidavit='No';
                              $fe_students->save();
                        }
              }
              elseif ($test_minority_affidavit=="no") {
                $fe_students->minority_affidavit='No';
              }
              elseif ($test_minority_affidavit=="na") {
                $fe_students->minority_affidavit='Not Applicable';
              }
              elseif ($test_minority_affidavit== null) {
                $request->session()->flash('minority_affidavit_error', 'Please select an option');
                  return redirect()->route('fe_document_upload');
              }
         }
         
      $test_gap_certi = $request->input('gap_certi');
       if($fe_students->gap_certi_path == null)
         {
                  if ($test_gap_certi=="yes") 
              {
                          if($request->hasFile('gap_certi')) 
                          {
                                $rules = ['gap_certi' => 'mimes:pdf|max:1024'];
                                  $validator = Validator::make(Input::all() , $rules);
                                if ($validator->fails())
                                 {
                                  $request->session()->flash('gap_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                  return redirect()->route('fe_document_upload');
                                 }
                                $extension = $request->file('gap_certi')->getClientOriginalExtension();
                                $filenametostore = 'gap_certi_'.$dte_id.'.'.$extension;
                                $path = $request->file('gap_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                $fe_students->gap_certi_path =$filenametostore;
                                $fe_students->gap_certi='Yes';
                                $fe_students->save();
                            }
                                else
                                {
                                      $fe_students->gap_certi='No';
                                      $fe_students->save();
                                }
            }
              elseif ($test_gap_certi=="no") {
                $fe_students->gap_certi='No';
              }
              elseif ($test_gap_certi=="na") {
                $fe_students->gap_certi='Not Applicable';
              }
              elseif ($test_gap_certi== null) {
                $request->session()->flash('gap_certi_error', 'Please select an option');
                  return redirect()->route('fe_document_upload');
              }
         }
      $test_community_certi = $request->input('community_certi');
      
      if($fe_students->community_certi_path == null)
         {
                      if ($test_community_certi=="yes") 
                  {
                          if($request->hasFile('community_certi')) 
                          {
                            $rules = ['community_certi' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('community_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              return redirect()->route('fe_document_upload');
                             }
                            $extension = $request->file('community_certi')->getClientOriginalExtension();
                            $filenametostore = 'community_certi_'.$dte_id.'.'.$extension;
                            $path = $request->file('community_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $fe_students->community_certi_path = $filenametostore;
                            $fe_students->community_certi='Yes';
                            $fe_students->save();
                            }
                             else
                            {
                                  $fe_students->community_certi='No';
                                  $fe_students->save();
                            }
                  }
                  elseif ($test_community_certi=="no") {
                    $fe_students->community_certi='No';
                  }
                  elseif ($test_community_certi=="na") {
                    $fe_students->community_certi='Not Applicable';
                  }
                  elseif ($test_community_certi== null) {
                    $request->session()->flash('community_certi_error', 'Please select an option');
                      return redirect()->route('fe_document_upload');
                  } 
         }
       
       //return $fe_students;
     // }
  //active dte ends here





        //return $fe_students->hsc_passing_certi_path;

      //          $test_hsc_passing_certi = $request->input('hsc_passing_certi');
      // return $test_hsc_passing_certi;
      
        if($fe_students->is_cet == '1'){

        $test_cet_result = $request->input('cet_result');
        //return $test_cet_result;
        if($fe_students->cet_result_path == null)
         {
                  if ($test_cet_result=="yes") 
                  {
                      if($request->hasFile('cet_result'))
                          {
                            $rules = ['cet_result' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('cet_result_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              return redirect()->route('fe_document_upload');
                             }
                            $extension = $request->file('cet_result')->getClientOriginalExtension();
                            $filenametostore = 'cet_result_'.$dte_id.'.'.$extension;
                       
                            $path = $request->file('cet_result')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $fe_students->cet_result_path = $filenametostore;
                            $fe_students->cet_result = 'Yes';
                            $fe_students->save();
                          }
                          else
                            {
                                  $fe_students->cet_result='No';
                                  $fe_students->save();
                            }
            }
            elseif ($test_cet_result=="no") {
                $fe_students->cet_result='No';
              }
              elseif ($test_cet_result== null) {
                $request->session()->flash('cet_result_error', 'Please select an option');
                  return redirect()->route('fe_document_upload');
              }

         }
       }
      // return $a;
        if ($fe_students->is_jee == '1') {
          
         
        $test_jee_result = $request->input('jee_result');
        //return $test_jee_result;
        if($fe_students->jee_result_path == null)
         {
                  if ($test_jee_result=="yes") 
                  {
                      if($request->hasFile('jee_result'))
                          {
                            $rules = ['jee_result' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('jee_result_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              return redirect()->route('fe_document_upload');
                             }
                            $extension = $request->file('jee_result')->getClientOriginalExtension();
                            $filenametostore = 'jee_result_'.$dte_id.'.'.$extension;
                       
                            $path = $request->file('jee_result')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $fe_students->jee_result_path = $filenametostore;
                            $fe_students->jee_result = 'Yes';
                            $fe_students->save();
                          }
                          else
                            {
                                  $fe_students->jee_result='No';
                                  $fe_students->save();
                            }
            }
            elseif ($test_jee_result=="no") {
                $fe_students->jee_result='No';
              }
              elseif ($test_jee_result== null) {
                $request->session()->flash('jee_result_error', 'Please select an option');
                  return redirect()->route('fe_document_upload');
              }

         }
       }
 
      
        $user1 = DB::table('fe_students')->select('dte_id','is_cet','is_jee','photo','photo_path','signature','signature_path','fc_confirmation_receipt','fc_confirmation_receipt_path','cet_result','cet_result_path','jee_result','jee_result_path','ssc_marksheet','ssc_marksheet_path','hsc_marksheet','hsc_marksheet_path','hsc_passing_certi','hsc_passing_certi_path','birth_certi','birth_certi_path','domicile','domicile_path','proforma_o','proforma_o_path','minority_affidavit','minority_affidavit_path','community_certi','community_certi_path','medical_certi','medical_certi_path','anti_ragging_affidavit','anti_ragging_affidavit_path','gap_certi','gap_certi_path','is_document_completed')->where('dte_id', $dte_id)->get();
        $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        $hash = $hash[0]->hash;

        //return $user1;
$course = $request->session()->get('log_course');
list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
        if($user1[0]->photo ==  "Yes" && $user1[0]->signature == "Yes")
        {
            $fe_students->is_document_completed =1;
             $fe_students->save();
              if ($activeacap == "yes") {
             
             
                $user1['prog_val']=7;
            }
    
        }
        elseif($user1[0]->photo ==  null || $user1[0]->signature == null)
        {
              $fe_students->is_document_completed =0;
             // return "hello";
             $fe_students->save();
        }
           


        
        $data=[];
        $data['user1']=$user1;
        $data['hash'] = $hash;
// return $user1;
        if ($activedte == "yes") {
        return view('user.fe.document_upload',$data);
      }

       if ($activeacap == "yes") {
        if($userprogress[0]->is_document_completed==1){
            $user1['prog_val']=7;
          $data['user1']=$user1;
          // return 'done';
        }
        return view('user.fe.acap_document_upload',$data);
      }


  }

  public static function showfePaymentDetails(Request $request)
  {
     $dte_id = $request->session()->get('log_dte_id', 'null');
    if ($dte_id != 'null')
      {
          $users = DB::table('fees_transaction')->where('dte_id',$dte_id)->get();
          return view('user.fe.payment_details')->with('users',$users);
      }
      else
      {
      return redirect()->route('logout');
      }
  }

   public static function showfeChangePassword(Request $request)
  {
    return view('user.fe.change_password');
  }

  

  public static function submitfeChangePassword(Request $request)
  {
    $pass = $request->input('oldPassword');
   //return $pass;
    $password = $request->input('password');
    
    $cnf_password=$request->input('password_confirmation');

      if(  $password!=$cnf_password){
            $request->session()->flash('error','Password does not match');
            return redirect()->route('fe_change_password');
    }
    if($password==null || $pass==null || $cnf_password==null){
            $request->session()->flash('error','Please fill your password details');
            return redirect()->route('fe_change_password');
      }

    $password = Hash::make($password);
    //return $password;
    $dte_id = $request->session()->get('log_dte_id');
    //return $dte_id;
    $user = DB::table('student_login')->select('stud_pwd')->where('dte_id', $dte_id)->get();
   if (Hash::check($pass, $user[0]->stud_pwd))
   {
    
      DB::table('student_login')->where('dte_id', $dte_id)->update(['stud_pwd' => $password]);
      return redirect()->route('fe_profile');
    }
    else
    {

          $request->session()->flash('error','Enter Correct Old Password ');
           return redirect()->route('fe_change_password');
    }
  }

  public static function showfefinalSubmit(Request $request)
    {
      $dte_id = $request->session()->get('log_dte_id',null);
      if($dte_id != null)
        { $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {

             $course = $request->session()->get('log_course');
            list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
            if($userprogress[0]->is_document_completed==0){
              return redirect('fe_document_upload');
            }
            if ($acap_login[0]->acap_login == 1) {
              # code...
              $user1['prog_val']=7;
            }
          if (DB::table('fe_students')->where('dte_id', $dte_id)->exists())
            {   $check = DB::table('fe_students')->select('is_personal_completed', 'is_guardian_completed', 'is_contact_completed', 'is_dte_details_completed', 'is_document_completed', 'is_academic_completed')->where('dte_id',$dte_id)->get();
             //return $check;
            if(DB::table('admission')->where('dte_id', $dte_id)->exists())
            {
               $payment = DB::table('admission')->select('balance_amt')->where('dte_id',$dte_id)->get();
               //return $payment;
            }
           else{
            $array_object2 = [['balance_amt' => null]];
            $payment = json_decode(json_encode($array_object2));     
            }
            // $course = $request->session()->get('log_course');
            // $user1['prog_val']= HomeController::progressbar($course,$dte_id);




          return view('user.fe.final_submit')->with('check',$check)->with('payment',$payment)->with('user1',$user1);

            }
          else
          {
            $array_object1 = [['is_personal_completed' => null, 'is_guardian_completed' => null, 'is_contact_completed' => null, 'is_dte_details_completed' => null, 'is_document_completed' => null, 'is_academic_completed' => null, 'is_payment_completed' => null]];
            $check = json_decode(json_encode($array_object1));
            $array_object2 = [['balance_amt' => null]];
            $payment = json_decode(json_encode($array_object2));

           
            return view('user.fe.final_submit')->with('check',$check)->with('payment',$payment)->with('user1',$user1);

          }      
        }
        else
              return redirect()->route('fe_profile');
          }
      else
          return redirect()->route('logout');  
    }

    public static function postfefinalSubmit(Request $request)
    {
     $dte_id = $request->session()->get('log_dte_id');
     $course = $request->session()->get('log_course');
     $log_acap = $request->session()->get('log_acap');
     $log_dte = $request->session()->get('log_dte');
     if($log_acap == null)
        $event = "DTE";
      if($log_dte == null){
        $event = "ACAP";
        DB::select("call insert_status_details_submitted('$dte_id','$event','$course')");

      }

        
      DB::select("call insert_status_details_submitted('$dte_id','$event','$course')");
      return redirect()->route('fe_profile');
    }




  //DSE MODULE

     public static function showdseChangePassword(Request $request)
  {
    return view('user.dse.change_password');
  }

   public static function submitdseChangePassword(Request $request)
  {
    $pass = $request->input('oldPassword');
   // return $pass;
    $password = $request->input('password');
    $cnf_password=$request->input('password_confirmation');
    if($password!=$cnf_password){
            $request->session()->flash('error','Password does not match');
            return redirect()->route('dse_change_password');
    }
    if($password==null || $pass==null || $cnf_password==null){
            $request->session()->flash('error','Please fill your password details');
            return redirect()->route('dse_change_password');
      }
    $password = Hash::make($password);
    //return $password;
    $dte_id = $request->session()->get('log_dte_id');
    //return $dte_id;
    $user = DB::table('student_login')->select('stud_pwd')->where('dte_id', $dte_id)->get();
   if (Hash::check($pass, $user[0]->stud_pwd))
   {
      DB::table('student_login')->where('dte_id', $dte_id)->update(['stud_pwd' => $password]);
      return redirect()->route('dse_profile');
    }
    else
    {
          $request->session()->flash('error','Enter Correct  Old Password');
           return redirect()->route('dse_change_password');
    }
  }

 public static function showdseDte(Request $request)
  {
    $dte_id = $request->session()->get('log_dte_id');
         $activedte= $request->session()->get('log_dte', 'null');
     $activeacap = $request->session()->get('log_acap','null');
        $course = $request->session()->get('log_course');
        
        if($activedte == "yes")
        {
          
          $event = "DTE";

        }
        else if($activeacap == "yes")
        {
          
          $event = "ACAP";
        }
    if ($dte_id != 'null')
      {
         $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {
     $data = [];
       $months = array(
        'Jan' => 'Jan',
        'Feb' => 'Feb',
        'Mar' => 'Mar',
        'Apr' => 'Apr',
        'May' => 'May',
        'Jun' => 'Jun',
        'Jul' => 'Jul',
        'Aug' => 'Aug',
        'Sep' => 'Sep',
        'Oct' => 'Oct',
        'Nov' => 'Nov',
        'Dec' => 'Dec'
      ); 
      if($event == "DTE")
      {
      $categories = array(
        'OPEN' => 'Open (Non Sindhi)',
        'OPEN_EBC' => 'Open EBC(Non Sindhi)',
        'SINDHI' => 'Sindhi Minority',
        'SINDHI_EBC' => 'Sindhi Minority EBC',
        'SBC' => 'SBC',
        'VJ' => 'VJ',
        'DT' => 'DT',
        'NT' => 'NT',
        'SC' => 'SC',
        'OBC' => 'OBC',
        'ST' => 'ST',
        'SEBC' => 'SEBC'
        
       
      );
      }
     if($event == "ACAP")
     {
       $categories = array(
        'OPEN' => 'Open',
        'SINDHI' => 'Sindhi'
      );
     }
      $candidate_types = array(
        'A' => 'Type A',
        'B' => 'Type B',
        'C' => 'Type C',
        'D' => 'Type D',
        'E' => 'Type E',
        'F' => 'Type F',
        'O' => 'Type OMS',
      );
     
       $data['months'] = $months;
      // $data['categories'] = $categories;
      $data['candidate_types'] = $candidate_types;
      $opentype= DB::select(DB::raw("SELECT  GROUP_CONCAT( DISTINCT fee_category) AS fee_category FROM fees_structure WHERE course='DSE' AND type='NONMINORITY' "));          

          $minotype=DB::select(DB::raw("SELECT GROUP_CONCAT( DISTINCT fee_category) AS fee_category FROM fees_structure WHERE course='DSE' AND type='MINORITY' "));
          $reservedtype=DB::select(DB::raw("SELECT GROUP_CONCAT( DISTINCT fee_category) AS fee_category FROM fees_structure WHERE course='DSE' AND type='RESERVED' "));
$categories=array('open'=>$opentype,'minotype'=>$minotype,'reservedtype'=>$reservedtype);
        $data['open']=explode(",",$opentype[0]->fee_category);
        $data['minotype']=explode(",",$minotype[0]->fee_category);
        $data['reservedtype']=explode(",",$reservedtype[0]->fee_category);
      // return $data;
       // return $activeacap;
       
      $check = DB::table('dse_students')->select('is_dte_details_completed')->where('dte_id', $dte_id)->get();

      if ( DB::table('dse_students')->select('is_dte_details_completed')->where('dte_id', $dte_id)->exists() && $check[0]->is_dte_details_completed == "1")
        {
        $user1 = DB::table('dse_students')->select('dte_id',  'category', 'candidate_type', 'mh_state_general_merit_no','seat_type','shift_allotted','allotted_cap_round','course_allotted','course_allotted_code','dte_branch', 'is_dte_details_completed','acap_category')->where('dte_id', $dte_id)->get();

        }
        else
        {
          
          if($activedte=='yes')
          {
             
               $user2 = DB::table('dte_allotments')->select('dte_seat_type_allotted' ,'course_allotted_code','course_allotted','shift_allotted','allotted_cap_round','branch' )->where('dte_id', $dte_id)->get();
          
                 $array_object = [['dte_id' => $dte_id,'is_dte_details_completed'=>0 ,'seat_type'=> $user2[0]->dte_seat_type_allotted,'allotted_cap_round'=> $user2[0]->allotted_cap_round,'course_allotted'=>$user2[0]->course_allotted,'course_allotted_code'=>$user2[0]->course_allotted_code,'shift_allotted'=>$user2[0]->shift_allotted,'dte_branch'=>$user2[0]->branch,'category'=>'OPEN MU','candidate_type'=>'A','mh_state_general_merit_no'=>null ]];
                $user1 = json_decode(json_encode($array_object));

             
                 
          }
          elseif($activeacap=='yes')
          {
           
            $array_object = [['dte_id' => $dte_id, 'is_dte_details_completed'=>0 ,'dte_password' => null, 'category' => null, 'reserved' => null,'candidate_type' => null,'seat_type'=>null,  'mh_state_general_merit_no' => null,'allotted_cap_round' => null,'course_allotted' => null,'course_allotted_code' => null,'dte_branch'=>null,'shift_allotted'=>null ]];
            $user1 = json_decode(json_encode($array_object));
           
        }
        
     }
 //to check route valadiation and  progress
        $course = $request->session()->get('log_course');
        list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);

//end to check route valadiation and  progresss
       

      $data['user1'] = $user1;
      return view('user.dse.dte_details', $data);
      }

          else 
              return redirect()->route('dse_profile');
          }
      else
      {
      return redirect()->route('logout');
      }

    }

  public static function insertdseDte(Request $request)
    {
          $dte_id=$request->session()->get('log_dte_id');
         $activedte= $request->session()->get('log_dte', 'null');
      $activeacap = $request->session()->get('log_acap');
        $course = $request->session()->get('log_course');
        //echo $activedte;
       // return  $activedte;
        //echo $course;
        // return $dte_id;
        if($activedte == "yes")
        {
          
          $event = "DTE";

        }
        else if($activeacap == "yes")
        {
          
          $event = "ACAP";
        }
        
           /*$user = DB::table('mca_students')->where('dte_id', $dte_id)->get();
          if ($user==[])
          {
          if($log_dte=="yes")
          {
          $category = $request->input('category');
            $acap_category="NA";
          }
          elseif($log_acap=="yes")
           {
            $acap_category = $request->input('category');
            $category="NA";
          }
          }
          elseif (DB::table('mca_students')->where('dte_id', $dte_id)->exists()) {         
          
          if($log_dte=="yes")
          {
         
          $category = $request->input('category');
          if($user[0]->acap_category==null)
            $acap_category="NA";
          else
            $acap_category = $user[0]->acap_category; 
          }
          elseif($log_acap=="yes")
          {
            $acap_category = $request->input('category');
            if($user[0]->category==null)
            $category="NA";
          else
            $category = $user[0]->category; 
          }
        }*/    
           /*     if(log_acap==null)
          {
          */
           //$category = $request->input('category');
           /*}
          elseif(log_dte==null)
          {
              $acap_category=$request->input('category');
          } 
           if($category == "RESERVED")
          {
            $category = $request->input('reserved');
          } 
          */
          $candidate_type = $request->input('candidate_types');
           
          $mh_state_general_merit_no = $request->input('mhStateGeneralmeritNo');
           $activedte= $request->session()->get('log_dte', 'null');
          $activeacap= $request->session()->get('log_acap','null');
         
        /*if ($minority_dte_merit_no == null) {
          $minority_dte_merit_no = 00;
        }*/
        if($activedte=='yes')
        {
          $type='DTE';
          
          $user1 = DB::table('dse_students')->select('dte_id','seat_type','allotted_cap_round','course_allotted','course_allotted_code','dte_branch','category','candidate_type' ,'mh_state_general_merit_no','shift_allotted','acap_category')->where('dte_id', $dte_id)->get();
          //return $user1;
          $seat_type =$user1[0]->seat_type;
        //  return $seat_type;
          $allotted_cap_round =$user1[0]->allotted_cap_round;
          $course_allotted = $user1[0]->course_allotted;
          $course_allotted_code =$user1[0]->course_allotted_code;
          // $category = $request->input('category');
          $shift_allotted=$user1[0]->shift_allotted;
          $dte_branch=$user1[0]->dte_branch; 
          //changes by kartik
          $cat_Radio = $request->input('cat_Radio');
           // return $cat_Radio;
          if ($cat_Radio== "Reserverd") {
            $category = $request->input('reservedcategory');  
          }
          if ($cat_Radio=="Minority") {
            $category =  $request->input('minoritycategory');  
          }
          if ($cat_Radio== "General") {
            $category = $request->input('opencategory');  
          }
          
          //return $category;
          if($user1[0]->acap_category == null || $user1[0]->acap_category == "NA" )
             $acap_category="NA";
          else
             $acap_category=$user1[0]->acap_category;
           
        }

        else if($activeacap=='yes')
        {
          $user1 = DB::table('dse_students')->select('category','seat_type')->where('dte_id', $dte_id)->get();
          //return $user1;
          //$shift_allotted="NA";
          $type='ACAP';
        //  return $user1[0]->seat_type;
         // if($user1[0]->seat_type==null)
         // {
           $seat_type ="NA";
          //}
         // else
          //{
//              $seat_type=$user1[0]->seat_type;
          //}
          $allotted_cap_round ="NA";
          $course_allotted = "NA";
          $course_allotted_code ="0000000";
          $dte_branch="NA";
            
            //changes by kartik
          $cat_Radio = $request->input('cat_Radio');
           // return $cat_Radio;
          if ($cat_Radio== "Reserverd") {
            $category = $request->input('reservedcategory');  
          }
          if ($cat_Radio=="Minority") {
            $category =  $request->input('minoritycategory');  
          }
          if ($cat_Radio== "General") {
            $category = $request->input('opencategory');  
          }



           // $acap_category = $request->input('category');
          $acap_category = $category;
          if($user1 == '[]' || $user1[0]->category == null || $user1[0]->category == "NA" )
             $category="NA";
          else
             $category=$user1[0]->category;
 
        }
       // return $category;
    /*DB::select("call insert_update_dse_dte('$dte_id','$category','$candidate_type' ,'$all_india_merit_no','$mh_state_general_merit_no','$minority_dte_merit_no','$seat_type','$acap_category','$course_allotted','$shift_allotted','$choice_code_allotted','$course_allotted_code','$allotted_cap_round')");
    */

    DB::select("call insert_update_dse_dte('$dte_id','$category','$candidate_type' ,'$mh_state_general_merit_no','$seat_type' ,'$acap_category')");
    return redirect()->route('dse_academic_details'); 
                  
    }
  public static function showdseGuard(Request $request)
    {
    $dte_id = $request->session()->get('log_dte_id', 'null');
    if ($dte_id != 'null')
      {
         $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {
      $data = [];
      $check = DB::table('dse_students')->select('is_guardian_completed')->where('dte_id', $dte_id)->get(); 
      if (DB::table('dse_students')->select('is_guardian_completed')->where('dte_id', $dte_id)->exists() && $check[0]->is_guardian_completed == "1")
        {
        $user1 = DB::table('dse_students')->select('dte_id', 'g_relation', 'g_first_name', 'g_middle_name', 'g_last_name', 'g_mobile', 'g_occupation', 'g_qualification', 'g_office_address','g_office_tel_no','g_annual_income', 'mother_name', 'parent_domicile_no', 'parent_domicile_date', 'parent_domicile_appl_no', 'parent_domicile_appl_date','candidate_type','is_guardian_completed')->where('dte_id', $dte_id)->get();

          if(($user1[0]->parent_domicile_no == "0" && $user1[0]->parent_domicile_date == "1111-11-11")&&($user1[0]->parent_domicile_appl_no == "0" && $user1[0]->parent_domicile_appl_date == "1111-11-11"))
          {
              $parent_domicile = "na";
          }
          else if($user1[0]->parent_domicile_no == "0" && $user1[0]->parent_domicile_date == "1111-11-11")
          {
            $parent_domicile = "false";
          }
          else if($user1[0]->parent_domicile_appl_no == "0" && $user1[0]->parent_domicile_appl_date == "1111-11-11")
          {
            $parent_domicile = "true";
          }
          

        }
        else
        {
                          $candidate_type = DB::table('dse_students')->select('candidate_type')->where('dte_id', $dte_id)->get()[0]->candidate_type;

        $array_object = [['dte_id' => $dte_id, 'is_guardian_completed'=>0,'g_relation' => 'F', 'g_first_name' => null, 'g_middle_name' => null, 'g_last_name' => null, 'g_mobile' => null, 'g_occupation' => null, 'g_office_address'=>null ,'g_office_tel_no'=> null ,'g_qualification' => null, 'g_annual_income' => null, 'mother_name' => null, 'parent_domicile_no' => null, 'parent_domicile_date' => null, 'parent_domicile_appl_no' => null, 'parent_domicile_appl_date' => null,'candidate_type'=>$candidate_type]];
        $user1 = json_decode(json_encode($array_object));
        $parent_domicile = "na";
        }

      $relations = array(
        'Husband' => 'H',
        'Parent' => 'F',
        'Guardian' => 'G'
      );
        //routes validation and progress bar 

       $course = $request->session()->get('log_course');
      list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
       if($userprogress[0]->is_personal_completed ==0){
      return redirect('dse_personal_details');
      }
      // end routes validation and progress bar 

      $data['user1'] = $user1;
      $data['relations'] = $relations;
      $data['parent_domicile'] =$parent_domicile;
      //return $data;

      return view('user.dse.guardian_details', $data);
      }
      else
              return redirect()->route('dse_profile');
          }
      else
      {
      return redirect()->route('logout');
      }
    }


  public static function insertdseGaurd(Request $request)
    {
    $dte_id=$request->session()->get('log_dte_id');
    $g_relation = $request->input('relation');
    $g_first_name = $request->input('firstName');
    $g_middle_name = $request->input('middleName');
    $g_last_name = $request->input('lastName');
    $mother_name = $request->input('motherMaidenName');
    $g_mobile = $request->input('mobile');
    $g_office_address=$request->input('office_address');
    $g_office_tel_no=$request->input('office_tel_no');
    $g_occupation = $request->input('occupation');
    $g_qualification = $request->input('qualification');
    $g_annual_income = $request->input('annualIncome');
   
   if($g_office_tel_no == null)
        $g_office_tel_no =0; 
    
    if($g_office_address == null)
        $g_office_address= "NA";
    $if_domecile=$request->input('dom');
    //return $g_relation;
    if($if_domecile=="yes")
    {
         $parent_domicile_no = $request->input('parentDomecileNo');
        $parent_domicile_date = $request->input('dateOfParentDomecile');
       // return $parent_domicile_date;
        $parent_domicile_appl_no = "0";
         $parent_domicile_appl_date = "1111-11-11";
    }
    if($if_domecile=="no")
    {
         $parent_domicile_appl_no = $request->input('parentDomecileApplicationNo');
         $parent_domicile_appl_date = $request->input('applicationDateOfParentDomecile');
         $parent_domicile_no ="0";
         $parent_domicile_date = "1111-11-11";
    }
    if($if_domecile=="na")
    {
        $parent_domicile_appl_no = "0";
         $parent_domicile_appl_date = "1111-11-11";
         $parent_domicile_no ="0";
         $parent_domicile_date = "1111-11-11";
    }
        /*if (DB::table('dse_students')->where('dte_id', $dte_id)->exists()) 
         { 
        $dse_students  = dse_students::find($dte_id);
        
          $dse_students->dte_id = $dte_id;
          $dse_students->g_relation = $g_relation;
          $dse_students->g_first_name = $g_first_name;
          $dse_students->g_middle_name = $g_middle_name;
          $dse_students->g_last_name = $g_last_name;
          $dse_students->mother_name = $mother_name;
          $dse_students->g_mobile = $g_mobile;
          $dse_students->g_occupation = $g_occupation;
          $dse_students->g_qualification = $g_qualification;
          $dse_students->g_annual_income = $g_annual_income;
          $dse_students->parent_domicile_no = $parent_domicile_no;
          $dse_students->parent_domicile_date = $parent_domicile_date;
          $dse_students->parent_domicile_appl_no = $parent_domicile_appl_no;
          $dse_students->parent_domicile_appl_date = $parent_domicile_appl_date;
          $dse_students->save();
          }*/
          
        //Procedure
           $mob=DB::table('student_login')->select('mobile')->where('dte_id', $dte_id)->get();
     
                if($mob[0]->mobile==$g_mobile){
                       
                      $request->session()->flash('error','Please fill different mobile number ');
                      return redirect('dse_guardian_details');
                }

        DB::select("call insert_update_dse_guardian('$dte_id','$g_relation','$g_first_name','$g_middle_name','$g_last_name','$g_mobile','$g_occupation','$g_qualification','$g_office_address','$g_office_tel_no','$g_annual_income','$parent_domicile_no','$parent_domicile_date','$parent_domicile_appl_no','$parent_domicile_appl_date','$mother_name')");
      return redirect()->route('dse_contact_details');

    }

public static function showdseContact(Request $request)
    {
    //return view('user.dse.contact_details');
    $dte_id = $request->session()->get('log_dte_id', 'null');
    if ($dte_id != 'null')
      {
        $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {
      $data = [];
      $residences = array(
        'Local' => 'L',
        'Outstation' => 'O'
      );
      $data['residences'] = $residences;

      $check = DB::table('dse_students')->select('is_contact_completed')->where('dte_id', $dte_id)->get(); 
      if (DB::table('dse_students')->select('is_contact_completed')->where('dte_id', $dte_id)->exists() && $check[0]->is_contact_completed == "1")
        {
        $user1 = DB::table('dse_students')->select('dte_id', 'permanent_address_line1', 'permanent_address_line2', 'permanent_city','permanent_district', 'permanent_state', 'permanent_pincode', 'permanent_nearest_rail_station', 'correspondance_address_line1', 'correspondance_address_line2', 'correspondance_city', 'correspondance_state', 'correspondance_pincode', 'correspondance_nearest_rail_station', 'resident_of', 'local_guardian_name', 'local_guardian_address_line1', 'local_guardian_address_line2', 'local_guardian_city','correspondance_district', 'local_guardian_state', 'local_guardian_pincode', 'local_guardian_nearest_rail_station', 'is_contact_completed')->where('dte_id', $dte_id)->get();
        }
        else
        {
        $array_object = [['dte_id' => $dte_id,'is_contact_completed'=>0 ,'permanent_address_line1' => null, 'permanent_address_line2' => null, 'permanent_city' => null, 'permanent_state' => null,'permanent_district' => null, 'permanent_pincode' => null, 'permanent_nearest_rail_station' => null, 'correspondance_address_line1' => null, 'correspondance_address_line2' => null, 'correspondance_city' => null, 'correspondance_state' => null, 'correspondance_district' => null, 'correspondance_pincode' => null, 'correspondance_nearest_rail_station' => null, 'resident_of' => 'Local', 'local_guardian_name' => null, 'local_guardian_address_line1' => null, 'local_guardian_address_line2' => null, 'local_guardian_city' => null, 'local_guardian_state' => null, 'local_guardian_pincode' => null, 'local_guardian_nearest_rail_station' => null,' is_contact_completed' => 0]];
        $user1 = json_decode(json_encode($array_object));
        }

        //routes validation and progress bar 

       $course = $request->session()->get('log_course');
      list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
       if($userprogress[0]->is_guardian_completed ==0){
      return redirect('dse_guardian_details');
      }
      // end routes validation and progress bar 

      $data['user1'] = $user1;

      $data['status'] = "Not Submitted";
      if($user1[0]->correspondance_address_line1 == null)
       $data['permanent'] = "false";
      elseif($user1[0]->correspondance_address_line1 == $user1[0]->permanent_address_line1)
        $data['permanent'] = "true";
      else
        $data['permanent'] = "false";
      return view('user.dse.contact_details', $data);
      }
          else
              return redirect()->route('dse_profile');
          }
      else
      {
      return redirect()->route('logout');
      }
    } 
  
  public static function insertdseContact(Request $request)
    {
      $dte_id=$request->session()->get('log_dte_id');
      $permanent_address_line1 = $request->input('permanentAddressLine1');
      $permanent_address_line2 = $request->input('permanentAddressLine2');
      $permanent_city = $request->input('permanentAddressCity');
      $permanent_state = $request->input('permanentAddressState');
      $permanent_district = $request->input('permanentAddressDistrict');
      $permanent_pincode = $request->input('permanentAddressPincode');
      $permanent_nearest_railway_station = $request->input('permanentAddressNearestRailwayStation');
      

      $local_guardian_name = $request->input('localGuardianName');
      $local_guardian_address_line1 = $request->input('localGuardianAddressLine1');
      $local_guardian_address_line2 = $request->input('localGuardianAddressLine2');
      $local_guardian_city = $request->input('localGuardianAddressCity');
      $local_guardian_state = $request->input('localGuardianAddressState');
      $local_guardian_district = $request->input('localGuardianAddressDistrict');
      $local_guardian_pincode = $request->input('localGuardianAddressPincode');
      $local_guardian_nearest_railway_station = $request->input('localGuardianNearestRailwayStation');
      $is_correspon_as_permanent=$request->input('isSame');
      $is_local_or_outstation=$request->input('localOutstation');
    // return $is_correspon_as_permanent;

      // if($is_correspon_as_permanent=="yes")
      // {
      //     $correspondance_address_line1 =  $permanent_address_line1;
      //     $correspondance_address_line2 = $permanent_address_line2;
      //     $correspondance_city = $permanent_city;
      //     $correspondance_state = $permanent_state;
      //     $correspondance_district = $permanent_district;
      //     $correspondance_pincode =$permanent_pincode;
      //     $correspondance_nearest_rail_station =  $permanent_nearest_rail_station;

      // }
      // else
      // {
           $correspondance_address_line1 = $request->input('currentAddressLine1');
           $correspondance_address_line2 = $request->input('currentAddressLine2');
           $correspondance_city = $request->input('currentAddressCity');
           $correspondance_district =  $request->input('currentAddressDistrict'); 
           $correspondance_state = $request->input('currentAddressState');
           $correspondance_pincode = $request->input('currentAddressPincode');
           $correspondance_nearest_railway_station = $request->input('currentAddressNearestRailwayStation');
      // }


      if($is_local_or_outstation=="Local")
      {
          $local_guardian_name = "NA";
          $local_guardian_address_line1 = "NA";
          $local_guardian_address_line2 = "NA";
          $local_guardian_city =  "NA";
           $local_guardian_district =  "NA";
          $local_guardian_state =  "NA";
          $local_guardian_pincode = "0"; 
          $local_guardian_nearest_railway_station = "0";

      }
      else
      {
          $local_guardian_name = $request->input('localGuardianName');
          $local_guardian_address_line1 = $request->input('localGuardianAddressLine1');
          $local_guardian_address_line2 = $request->input('localGuardianAddressLine2');
          $local_guardian_city = $request->input('localGuardianAdreessCity');
          $local_guardian_district = $request->input('localGuardianAddressDistrict');
          $local_guardian_state = $request->input('localGuardianAddressState');
          $local_guardian_pincode = $request->input('localGuardianAddressPincode');
          $local_guardian_nearest_railway_station = $request->input('localGuardianNearestRailwayStation');
      }
      
      if (DB::table('dse_students')->where('dte_id', $dte_id)->exists()) 
           { 
          
      
      //Procedure
      DB::select("call insert_update_dse_contact('$dte_id','$permanent_address_line1','$permanent_address_line2','$permanent_city','$permanent_district','$permanent_state','$permanent_pincode','$permanent_nearest_railway_station','$correspondance_address_line1','$correspondance_address_line2','$correspondance_city','$correspondance_district','$correspondance_state','$correspondance_pincode','$correspondance_nearest_railway_station','$is_local_or_outstation','$local_guardian_name','$local_guardian_address_line1','$local_guardian_address_line2','$local_guardian_city','$local_guardian_district','$local_guardian_state','$local_guardian_pincode','$local_guardian_nearest_railway_station')");
         }
      if(Session('log_acap')!="yes")
          return redirect()->route('dse_document_upload');
      else
        return redirect()->route('dse_acap_document_upload');
      
      }
  
  public static function showdsePersonal(Request $request)
    {
   
    //return view('user.dse.personal_details');
    $dte_id = $request->session()->get('log_dte_id', 'null');

    if ($dte_id != 'null')
      {
         $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {
      $data = [];
      $blood_groups = array(
        'A+' => 'A+',
        'A-' => 'A-',
        'B+' => 'B+',
        'B-' => 'B-',
        'AB+' => 'AB+',
        'AB-' => 'AB-',
        'O+' => 'O+',
        'O-' => 'O-',
        'un' => 'Unknown'
      );
      $genders = array(
        'Male' => 'Male',
        'Female' => 'Female',
        'Others' => 'Other'
      );
      $data['blood_groups'] = $blood_groups;
      $data['genders'] = $genders;

        $check = DB::table('dse_students')->select('is_personal_completed')->where('dte_id', $dte_id)->get(); 
      if (DB::table('dse_students')->select('is_personal_completed')->where('dte_id', $dte_id)->exists() && $check[0]->is_personal_completed == "1")
        {

        $user1 = DB::table('dse_students')->select('dte_id', 'name_on_marksheet','first_name','middle_name','last_name','gender', 'date_of_birth', 'place_of_birth_city', 'place_of_birth_state', 'student_domicile_no', 'student_domicile_date', 'student_domicile_appl_no', 'student_domicile_appl_date', 'mother_tongue', 'nationality', 'caste_tribe', 'religion', 'blood_group', 'uid','is_personal_completed')->where('dte_id', $dte_id)->get();

            if(($user1[0]->student_domicile_no == "0" && $user1[0]->student_domicile_date == "1111-11-11")&&($user1[0]->student_domicile_appl_no == "0" && $user1[0]->student_domicile_appl_date == "1111-11-11"))
            {
                      $domicile = "na";
            }
          else if($user1[0]->student_domicile_no == "0" && $user1[0]->student_domicile_date == "1111-11-11")
          {
             $domicile = "false";
          }
          elseif($user1[0]->student_domicile_appl_no == "0" && $user1[0]->student_domicile_appl_date == "1111-11-11")
          {
            $domicile = "true";
          }
        

        }
        else
        {
        $array_object = [['dte_id' => $dte_id,'is_personal_completed'=>0 ,'name_on_marksheet' => null,'first_name' => null, 'middle_name' => null, 'last_name' => null, 'gender' => 'Male', 'date_of_birth' => null, 'place_of_birth_city' => null, 'place_of_birth_state' => null, 'student_domicile_no' => null, 'student_domicile_date' => null, 'student_domicile_appl_no' => null, 'student_domicile_appl_date' => null, 'mother_tongue' => null, 'nationality' => null, 'caste_tribe' => null, 'religion' => null, 'blood_group' => 'A+', 'uid' => null]];
        $user1 = json_decode(json_encode($array_object));
        $domicile = "true";
        }

 //routes validation and progress bar 

       $course = $request->session()->get('log_course');
      list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
       if($userprogress[0]->is_academic_completed ==0){
      return redirect('dse_academic_details');
      }
      // end routes validation and progress bar 

      $data['user1'] = $user1;
      $data['domicile'] = $domicile;
      return view('user.dse.personal_details', $data);
      }
      else
              return redirect()->route('dse_profile');
          }
      else
      {
      return redirect()->route('logout');
      }
  }

public static function insertdsePersonal(Request $request)
    {
    $dte_id=$request->session()->get('log_dte_id'); 
    $name_on_marksheet = $request->input('nameAsOnMarksheet');
    $first_name = $request->input('firstName');
    $middle_name = $request->input('middleName');
    $last_name = $request->input('lastName');
    $gender = $request->input('gender');
    $date_of_birth = $request->input('dob');
   //  return $date_of_birth;
    $if_domecile=$request->input('dom');
    $place_of_birth_city = $request->input('placeOfBirthCity');
    $place_of_birth_state = $request->input('placeOfBirthState');
    $student_domicile_no = $request->input('domicileNumber');
    $student_domicile_date = $request->input('domicileDate');
    $student_domicile_appl_no = $request->input('applicationNumber');
    $student_domicile_appl_date = $request->input('applictionDate');
    $mother_tongue = $request->input('motherTongue');
    $nationality = $request->input('nationality');
    $caste_tribe = $request->input('casteTribe');
    $religion = $request->input('religion');
    $blood_group = $request->input('bloodGroup');
    $uid = $request->input('uid');
    if($if_domecile=="yes")
    {
        $student_domicile_appl_no = "0";
         $student_domicile_appl_date = "1111-11-11";
    }
    if($if_domecile=="no")
    {
         $student_domicile_no ="0";
         $student_domicile_date = "1111-11-11";
    }
    if($if_domecile=="na")
    {
        $student_domicile_appl_no = "0";
        $student_domicile_appl_date = "1111-11-11"; 
        $student_domicile_no ="0";
        $student_domicile_date = "1111-11-11";
        
    }
    
   /* if (DB::table('dse_students')->where('dte_id', $dte_id)->exists()) 
         { 
        $dse_students  = dse_students::find($dte_id);
         }   
    $dse_students->dte_id = $dte_id;
    $dse_students->name_on_marksheet = $name_on_marksheet;
    $dse_students->first_name = $first_name;
    $dse_students->middle_name = $middle_name;
    $dse_students->last_name = $last_name;
    $dse_students->gender = $gender;
    $dse_students->date_of_birth = $date_of_birth;
    $dse_students->place_of_birth = $place_of_birth;
    $dse_students->student_domicile_no = $student_domicile_no;
    $dse_students->student_domicile_date = $student_domicile_date;
    $dse_students->student_domicile_appl_no = $student_domicile_appl_no;
    $dse_students->student_domicile_appl_date = $student_domicile_appl_date;
    $dse_students->mother_tongue = $mother_tongue;
    $dse_students->nationality = $nationality;
    $dse_students->caste_tribe = $caste_tribe;
    $dse_students->religion = $religion;
    $dse_students->blood_group = $blood_group;
    $dse_students->uid = $uid;
    $dse_students->save();
      */   

      //Prcedure
      DB::select("call insert_update_dse_personal('$dte_id','$name_on_marksheet','$gender','$date_of_birth','$place_of_birth_state','$place_of_birth_city','$mother_tongue','$nationality','$caste_tribe ','$religion','$blood_group','$uid','$student_domicile_no','$student_domicile_date','$student_domicile_appl_no','$student_domicile_appl_date','$first_name','$middle_name','$last_name')");
    return redirect('dse_guardian_details');
  }


public static function showdseAcademic(Request $request)
    {
    
     $dte_id =$request->session()->get('log_dte_id', 'null');

    if ($dte_id != 'null')
      {
          $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {
            $data = [];
             $isHsc = array(
                'Y' => 'Yes',
                'N' => 'No'
              );
              $data['isHsc'] = $isHsc;

              $isFour = array(
                'Yes' => 'Yes',
                'No' => 'No'
              );
              $data['isFour'] = $isFour;
            $months = array(
                'Jan' => 'Jan',
                'Feb' => 'Feb',
                'Mar' => 'Mar',
                'Apr' => 'Apr',
                'May' => 'May',
                'Jun' => 'Jun',
                'Jul' => 'Jul',
                'Aug' => 'Aug',
                'Sep' => 'Sep',
                'Oct' => 'Oct',
                'Nov' => 'Nov',
                'Dec' => 'Dec'
              );
             $data['months'] = $months;
             $years = array(
                '2019' => '2019',
                '2018' => '2018',
                '2017' => '2017',
                '2016' => '2016',
                '2015' => '2015',
                '2014' => '2014',
                '2013' => '2013',
                '2012' => '2012',
                '2011' => '2011',
                '2010' => '2010'
                
              );
              $data['years'] = $years;
            // $clgtype = array(
            //   'MSBT' => 'MSBT',
            //   'Autonomous' => 'Autonomous',
            //   'Other' => 'Other'
            // );
             $university_types = array(
                'Maharashtra_Board' => 'Maharashtra Board',  //changes by kartik
                'CBSE' => 'CBSE',
                'ICSE' => 'ICSE',
                'OTHER'=> 'Other'
              );

              $data['clgtype'] = $university_types;
              $check = DB::table('dse_students')->select('is_academic_completed')->where('dte_id', $dte_id)->get(); 
      if (DB::table('dse_students')->select('is_academic_completed')->where('dte_id', $dte_id)->exists() && $check[0]->is_academic_completed == "1")
        {

        $user1 = DB::table('dse_students')->select('dte_id','x_passing_month','x_passing_year','x_board_seat_no','x_board','x_max_marks','x_obtained_marks','x_percentage','x_school_name','x_school_city','x_school_state','is_hsc','xii_passing_month','xii_passing_year','xii_board','xii_board_seat_no','xii_college_name','xii_college_city','xii_college_state','xii_max_marks','xii_obtained_marks','xii_maths_max_marks','xii_maths_obtained_marks','xii_physics_max_marks','xii_physics_obtained_marks','xii_chemistry_max_marks','xii_chemistry_obtained_marks','xii_percentage','diploma_university','diploma_passing_month','diploma_passing_year','diploma_branch','diploma_college_name','diploma_college_city','diploma_college_state','diploma_seat_no','diploma_max_marks_sem1','diploma_obt_marks_sem1','diploma_max_marks_sem2','diploma_obt_marks_sem2','diploma_max_marks_sem3','diploma_obt_marks_sem3','diploma_max_marks_sem4','diploma_obt_marks_sem4','diploma_max_marks_sem5','diploma_obt_marks_sem5','diploma_max_marks_sem6','diploma_obt_marks_sem6','is_four_year','diploma_max_marks_sem7','diploma_obt_marks_sem7','diploma_max_marks_sem8','diploma_obt_marks_sem8','diploma_aggr_obt_sem6','diploma_aggr_max_sem6','diploma_aggr_percent_sem6','diploma_aggr_obt_sem8','diploma_aggr_max_sem8','diploma_aggr_percent_sem8','is_academic_completed')->where('dte_id', $dte_id)->get();

            /*if(($user1[0]->student_domicile_no == "0" && $user1[0]->student_domicile_date == "1111-11-11")&&($user1[0]->student_domicile_appl_no == "0" && $user1[0]->student_domicile_appl_date == "1111-11-11"))
            {
                      $domicile = "na";
            }
          else if($user1[0]->student_domicile_no == "0" && $user1[0]->student_domicile_date == "1111-11-11")
          {
             $domicile = "false";
          }
          elseif($user1[0]->student_domicile_appl_no == "0" && $user1[0]->student_domicile_appl_date == "1111-11-11")
          {
            $domicile = "true";
          }*/
          if(($user1[0]->xii_max_marks == 0)||($user1[0]->xii_obtained_marks == 0))
          {
                $hsc = "na";
          }

        

        }
        else
        {
        $array_object = [['dte_id' => $dte_id,'x_passing_month' => null,'x_passing_year' => null,'x_board_seat_no' => null,'x_board' => null,'x_max_marks' => null,'x_obtained_marks' => null,'x_percentage' => null,'x_school_name' => null,'x_school_city' => null,'x_school_state' => null,'is_hsc' => null,'xii_passing_month' => null,'xii_passing_year' => null,'xii_board' => null,'xii_board_seat_no' => null,'xii_college_name' => null,'xii_college_city' => null,'xii_college_state' => null,'xii_max_marks' => null,'xii_obtained_marks' => null,'xii_maths_max_marks' => null,'xii_maths_obtained_marks' => null,'xii_physics_max_marks' => null,'xii_physics_obtained_marks' => null,'xii_chemistry_max_marks' => null,'xii_chemistry_obtained_marks' => null,'xii_percentage' => null,'diploma_university' => null,'diploma_passing_month' => null,'diploma_passing_year' => null,'diploma_branch' => null,'diploma_college_name' => null,'diploma_college_city' => null,'diploma_college_state' => null,'diploma_seat_no' => null,'diploma_max_marks_sem1' => null,'diploma_obt_marks_sem1' => null,'diploma_max_marks_sem2' => null,'diploma_obt_marks_sem2' => null,'diploma_max_marks_sem3' => null,'diploma_obt_marks_sem3' => null,'diploma_max_marks_sem4' => null,'diploma_obt_marks_sem4' => null,'diploma_max_marks_sem5' => null,'diploma_obt_marks_sem5' => null,'diploma_max_marks_sem6' => null,'diploma_obt_marks_sem6' => null,'is_four_year' =>'No' ,'diploma_max_marks_sem7' => null,'diploma_obt_marks_sem7' => null,'diploma_max_marks_sem8' => null,'diploma_obt_marks_sem8' => null,'diploma_aggr_sem6' => null,'diploma_aggr_percent_sem6' => null,'diploma_aggr_obt_sem6' =>null,'diploma_aggr_max_sem6' => null,'diploma_aggr_sem8' => null,'diploma_aggr_percent_sem8' => null,'diploma_aggr_obt_sem8 ' => null,'diploma_aggr_obt_sem8'=> null,'diploma_aggr_max_sem8'=>null,'is_academic_completed' => 0]];
        $user1 = json_decode(json_encode($array_object));
        $hsc = true;
        }
      //routes validation and progress bar 

       $course = $request->session()->get('log_course');
      list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
       if($userprogress[0]->is_dte_details_completed ==0){
      return redirect('dse_dte_details');
      }
      // end routes validation and progress bar 

      $data['user1'] = $user1;
      //$data['domicile'] = $domicile;
      //return $isFour;
      return view('user.dse.academic_details', $data);
      }
      else
              return redirect()->route('dse_profile');
          }
      else
      {
      return redirect()->route('logout');
      }
    }

  public static function insertdseAcademic(Request $request)
  {
    $dte_id=$request->session()->get('log_dte_id');
    $x_passing_month =$request->input('xPassingMonth');
    $x_passing_year = $request->input('xPassingYear');
    $x_board = $request->input('xBoard');
    $x_max_marks = $request->input('xMaximumMarks');
    $x_obtained_marks = $request->input('xObtainedMarks');
    $x_percentage = $request->input('xPercentage');
    $x_school_name = $request->input('xSchoolName'); 
    $x_school_city = $request->input('xSchoolCity');
    $x_school_state = $request->input('xSchoolState');
    $x_board_seat_no = $request->input('xSeatNo');
    $is_hsc = $request->input('hsc');
      //return $is_hsc;
    $diploma_university = $request->input('diplomaBScClgUni');
    $diploma_passing_month = $request->input('diplomaPassingMonth');
    $diploma_passing_year = $request->input('diplomaPassingYear');
    $diploma_branch = $request->input('diplomaBScBranch');
    $diploma_college_name = $request->input('diplomaCollegeName');
    $diploma_college_city = $request->input('diplomaCollegeCity');
    $diploma_college_state =$request->input('diplomaCollegeState');
    $diploma_seat_no =$request->input('diplomaBScSeatNo');
    $diploma_max_marks_sem1 =$request->input('diploma_max_marks_sem1');
    $diploma_obt_marks_sem1 =$request->input('diploma_obt_marks_sem1');
    $diploma_max_marks_sem2 =$request->input('diploma_max_marks_sem2');
    $diploma_obt_marks_sem2 =$request->input('diploma_obt_marks_sem2');
    $diploma_max_marks_sem3 =$request->input('diploma_max_marks_sem3');
    $diploma_obt_marks_sem3 =$request->input('diploma_obt_marks_sem3');
    $diploma_max_marks_sem4 =$request->input('diploma_max_marks_sem4');
    $diploma_obt_marks_sem4 =$request->input('diploma_obt_marks_sem4');
    $diploma_max_marks_sem5 =$request->input('diploma_max_marks_sem5');
    $diploma_obt_marks_sem5 =$request->input('diploma_obt_marks_sem5');
    $diploma_max_marks_sem6 =$request->input('diploma_max_marks_sem6');
    $diploma_obt_marks_sem6 =$request->input('diploma_obt_marks_sem6');
    $is_four_year = $request->input('isFour');
    
    $diploma_aggr_obt_sem6 =$request->input('AggrObtainedMarksSem6');
    $diploma_aggr_max_sem6 =$request->input('AggrMaximumMarksSem6');
    $diploma_aggr_percent_sem6 =$request->input('AggrPercentageSem6');
    
       
    if( $is_hsc== "yes")
    {
         $xii_passing_month = $request->input('xiiPassingMonth');
         $xii_passing_year = $request->input('xiiPassingYear');
         $xii_board = $request->input('xiiBoard');
         
         $xii_board_seat_no = $request->input('xiiSeatNo');
         $xii_max_marks = $request->input('xiiMaximumMarks');
         $xii_obtained_marks = $request->input('xiiObtainedMarks');
         $xii_percentage = $request->input('xiiPercentage');
         $xii_college_name = $request->input('xiiCollegeName');
         $xii_college_city = $request->input('xiiCollegeCity');
         $xii_college_state = $request->input('xiiCollegeState');
       
   }
    else
    {
        $xii_passing_month = "NA";
        $xii_passing_year ="0000";
        $xii_board ="NA";
        $xii_board_seat_no = "00";
        $xii_max_marks = "00";
        $xii_obtained_marks = "00";
        $xii_percentage = "00";
        $xii_college_name = "NA";
        $xii_college_city = "NA";
        $xii_college_state = "NA";
         
    }

        if( $is_four_year=="Yes")
    {
        $diploma_max_marks_sem7 =$request->input('diploma_max_marks_sem7');
        $diploma_obt_marks_sem7 =$request->input('diploma_obt_marks_sem7');
        $diploma_max_marks_sem8 =$request->input('diploma_max_marks_sem8');
        $diploma_obt_marks_sem8 =$request->input('diploma_obt_marks_sem8');
        $diploma_aggr_obt_sem8 =$request->input('AggrObtainedMarksSem8');
        $diploma_aggr_max_sem8 =$request->input('AggrMaximumMarksSem8');
        $diploma_aggr_percent_sem8 =$request->input('AggrPercentageSem8');
 
            
   }
    if($is_four_year=="No")
    {
        $diploma_max_marks_sem7 = "00";
        $diploma_obt_marks_sem7 ="00";
        $diploma_max_marks_sem8 ="00";
        $diploma_obt_marks_sem8 = "00";
        $diploma_aggr_obt_sem8 = "00";
        $diploma_aggr_max_sem8 = "00";
        $diploma_aggr_percent_sem8 = "00";
       
    }
    
    if (DB::table('dse_students')->where('dte_id', $dte_id)->exists()) 
         { 
        
    //Prodedure
      //return $is_hsc;
     // return $diploma_obt_marks_sem2;
     DB::select("call insert_update_dse_academic('$dte_id','$x_passing_month','$x_passing_year','$x_board','$x_max_marks','$x_obtained_marks','$x_percentage','$x_school_name','$x_school_city','$x_school_state','$x_board_seat_no','$is_hsc','$xii_passing_month','$xii_passing_year','$xii_board','$xii_board_seat_no','$xii_max_marks','$xii_obtained_marks','$xii_percentage','$xii_college_name','$xii_college_city','$xii_college_state','$diploma_university','$diploma_passing_month','$diploma_passing_year','$diploma_branch','$diploma_college_name','$diploma_college_city','$diploma_college_state','$diploma_seat_no','$diploma_max_marks_sem1','$diploma_obt_marks_sem1','$diploma_max_marks_sem2','$diploma_obt_marks_sem2','$diploma_max_marks_sem3','$diploma_obt_marks_sem3','$diploma_max_marks_sem4','$diploma_obt_marks_sem4','$diploma_max_marks_sem5','$diploma_obt_marks_sem5','$diploma_max_marks_sem6','$diploma_obt_marks_sem6','$is_four_year','$diploma_max_marks_sem7','$diploma_obt_marks_sem7','$diploma_max_marks_sem8','$diploma_obt_marks_sem8','$diploma_aggr_obt_sem6','$diploma_aggr_max_sem6','$diploma_aggr_percent_sem6','$diploma_aggr_obt_sem8','$diploma_aggr_max_sem8','$diploma_aggr_percent_sem8')");
      return redirect('dse_personal_details');
   
    }
}

  
  public static function showdseProfile(Request $request)
    {
    $dte_id = $request->session()->get('log_dte_id', null);
    $course = $request->session()->get('log_course');

    DB::table('student_login')->where('dte_id', $dte_id)->update(['dte_login' => 0, 'acap_login' => 0]);
    if ($dte_id != null)
      {

          $dtes = DB::select(DB::raw("SELECT event_name, event_from_date, event_to_date, event_type FROM event WHERE event_type = 'DTE' AND course LIKE '%".$course."%'"));
          /*DB::table('event')->select('event_name', 'event_from_date', 'event_to_date','event_type')->where('event_type' , 'DTE' AND 'course' , $course)->get();*/
         $acaps = DB::select(DB::raw("SELECT event_name, event_from_date, event_to_date, event_type FROM event WHERE event_type = 'ACAP' AND course LIKE '%".$course."%'"));
         /*DB::table('event')->select('event_name', 'event_from_date', 'event_to_date','event_type')->where('event_type' , 'ACAP' AND 'course' , $course)->get();*/
    
    

        //eligibility
         if(DB::table('dte_allotments')->where('dte_id', $dte_id)->exists())
               { $eligibility=1;}
          else
               { $eligibility=0;}

        //status
        $user1 =DB::select(DB::raw("SELECT status_to from status_details where dte_id LIKE '%".$dte_id."%' AND event_to = 'DTE' ORDER BY updated_at DESC LIMIT 1"));
        if($user1==[] || $user1==null)
          {
              if($eligibility==1) 
                $status_dte='Eligible';
              else 
                $status_dte='Not Eligible';
          }
         elseif( $user1!=[])   
          {
              if($eligibility==1) 
                $status_dte=$user1[0]->status_to;
              else 
                $status_dte='Not Eligible';
          }

            //acap
        $user2 =DB::select(DB::raw("SELECT status_to from status_details where dte_id LIKE '%".$dte_id."%' AND event_to = 'ACAP' ORDER BY updated_at DESC LIMIT 1"));
        //return $user2;
        if($user2==[] || $user2==null)
          {
                $status_acap='Eligible For Acap';
          }
         elseif( $user2!=[])   
          {
                $status_acap=$user2[0]->status_to;
          }
        


        
        

      $data = [];
      $data['dtes'] = $dtes;
      $data['acaps'] = $acaps;
      $data['status_dte'] = $status_dte;  
        $data['status_acap'] = $status_acap;  
      return view('user.dse.profile', $data);
      }
      else
      {
      return redirect()->route('logout');
      }
    }
public static function showdsePaymentDetails(Request $request)
    {
         $dte_id = $request->session()->get('log_dte_id', 'null');
        if ($dte_id != 'null')
          {
              $users = DB::table('fees_transaction')->where('dte_id',$dte_id)->get();
   
   
              return view('user.dse.payment_details')->with('users',$users);
          }
          else
          {
          return redirect()->route('logout');
          }
    }
public static function submitChangePassword(Request $request)
    {
      $pass = $request->input('oldPassword');
     // return $pass;
      $password = $request->input('password');
      $cnf_password=$request->input('password_confirmation');

      if($password!=$cnf_password){
            $request->session()->flash('error','Password does not match');
            return redirect()->route('dse_change_password');
    }
    if($password==null || $pass==null || $cnf_password==null){
            $request->session()->flash('error','Please fill your password details');
            return redirect()->route('dse_change_password');
      }

      if($password==null || $pass==null){
            $request->session()->flash('error','Please fill your password details');
            return redirect()->route('dse_change_password');
      }
      $password = Hash::make($password);
      //return $password;
      $dte_id = $request->session()->get('log_dte_id');
      //return $dte_id;
      $user = DB::table('student_login')->select('stud_pwd')->where('dte_id', $dte_id)->get();
     if (Hash::check($pass, $user[0]->stud_pwd))
     {
        DB::table('student_login')->where('dte_id', $dte_id)->update(['stud_pwd' => $password]);
        return redirect()->route('profile');
        }
        else
        {
            $request->session()->flash('error','Enter correct Old Password');
             return redirect()->route('dse_change_password');
        }
      }
public static function showdseDocumentUpload(Request $request)
    {
        $dte_id = $request->session()->get('log_dte_id');
        $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          //$path =  DB::table('me_students')->select('photo_path')->where('dte_id', $dte_id)->get();
          
          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {
       if (DB::table('dse_students')->where('dte_id', $dte_id)->exists())
        {
        $user1 = DB::table('dse_students')->select('dte_id','fc_confirmation_receipt','fc_confirmation_receipt_path','dte_allotment_letter','dte_allotment_letter_path','arc_ackw_receipt','arc_ackw_receipt_path','ssc_marksheet','ssc_marksheet_path','hsc_diploma_marksheet','hsc_diploma_marksheet_path','degree_leaving_tc','degree_leaving_tc_path','first_year_marksheet','first_year_marksheet_path','second_year_marksheet','convocation_passing_certi','convocation_passing_certi_path','second_year_marksheet_path','third_year_marksheet','third_year_marksheet_path','fourth_year_marksheet','fourth_year_marksheet_path','equivalent_certi','equivalent_certi_path','migration_certi','migration_certi_path','birth_certi','nationality_certi','nationality_certi_path','birth_certi_path','domicile','domicile_path','proforma_o','proforma_o_path','retention','retention_path','minority_affidavit','minority_affidavit_path','gap_certi','gap_certi_path','community_certi','community_certi_path','caste_certi','caste_certi_path','caste_validity_certi','caste_validity_certi_path','non_creamy_layer_certi','nationality_certi','nationality_certi_path','non_creamy_layer_certi_path','income_certi','income_certi_path','anti_ragging_affidavit','anti_ragging_affidavit_path','medical_certi','medical_certi_path','photo','photo_path','signature','signature_path','is_document_completed')->where('dte_id', $dte_id)->get();
        $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        $hash = $hash[0]->hash;
       

        }
        else
        {
        $array_object = [['dte_id'=> $dte_id,'is_document_completed'=>0,'fc_confirmation_receipt' => 'No', 'fc_confirmation_receipt_path' => null, 'dte_allotment_letter' => 'No', 'dte_allotment_letter_path' => null, 'arc_ackw_receipt' => 'No', 'arc_ackw_receipt_path' => null, 'cet_result' => 'No', 'cet_result_path' => null, 'ssc_marksheet' => 'No','ssc_marksheet_path' => null,  'hsc_diploma_marksheet' => null,'hsc_diploma_marksheet_path' => null,  'degree_leaving_tc' => 'No', 'degree_leaving_tc_path' => null, 'degree_leaving_tc_path' => null,  'first_year_marksheet' => 'No', 'first_year_marksheet_path' => null, 'second_year_marksheet' => 'No', 'second_year_marksheet_path' => null, 'third_year_marksheet' => 'No', 'third_year_marksheet_path' => null,'fourth_year_marksheet' => 'No', 'fourth_year_marksheet_path' => null,'equivalent_certi' => 'No','equivalent_certi_path' => null,'convocation_passing_certi'=>'No','convocation_passing_certi_path'=>null, 'migration_certi' => 'No','nationality_certi'=>'No','nationality_certi_path'=> null,'migration_certi_path' => null, 'birth_certi' => 'No', 'birth_certi_path' => null, 'domicile' => 'No', 'domicile_path' => null, 'proforma_o' => 'No', 'proforma_o_path' => null, 'retention' => 'No','retention_path' => null,'nationality_certi'=>'No','nationality_certi_path'=> null,'minority_affidavit' => 'No', 'minority_affidavit_path' => null, 'gap_certi' => 'No', 'gap_certi_path' => null, 'community_certi' => 'No', 'community_certi_path' => null, 'caste_certi' => 'No', 'caste_certi_path' => null, 'caste_validity_certi' => 'No', 'caste_validity_certi_path' => null, 'non_creamy_layer_certi' => 'No', 'non_creamy_layer_certi_path' => null, 'proforma_a_b1_b2' => 'No', 'proforma_a_b1_b2_path' => null, 'proforma_f_f1' => 'No', 'proforma_f_f1_path' => null, 'income_certi' => 'No', 'income_certi_path' => null, 'proforma_c_d_e' => 'No', 'proforma_c_d_e_path' => null, 'anti_ragging_affidavit' => 'No', 'anti_ragging_affidavit_path' => null, 'proforma_j_k_l' => 'No', 'proforma_j_k_l_path' => null, 'medical_certi' => 'No', 'medical_certi_path' => null, 'photo' => 'No','photo_path' => null, 'signature' => 'No', 'signature_path' => null]];
        $user1 = json_decode(json_encode($array_object));
        $hash = null;
        }
      // return $user1;
        //routes validation and progress bar 

       $course = $request->session()->get('log_course');
      list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
       if($userprogress[0]->is_contact_completed ==0){
      return redirect('dse_contact_details');
      }
      // end routes validation and progress bar 

        $data=[];
        $data['user1']=$user1;
        $data['hash']=$hash;
        //$photo_path = 'storage'.$user1;
        return view('user.dse.document_upload',$data);

      }
       else
              return redirect()->route('dse_profile');   
    }
     public static function uploaddseDocumentUpload(Request $request)
      {

        
        /* $request->validate([
          'ssc_marksheet','hsc_marksheet','hsc_leaving_certi','first_year_marksheet','second_year_marksheet','third_year_marksheet','fourth_year_marksheet','convocational_certi','birth_certi','domicile_certi','proforma_o','retention_certi','minority_affidavit','gap_certi','community_certi','cast_certi','caste_validity_certi','non_creamy_layer_certi','proforma_h','proforma_a_b1_b2','proforma_f_f1','income_certi','proforma_j_k_l','medical_certi' => 'mimes:pdf|max:1024'
          ]);*/

        $dte_id=$request->session()->get('log_dte_id'); 
        $use = DB::table('student_login')->select('hash')->where('dte_id', $dte_id)->get();
        $destinationPath = $dte_id.'_'.$use[0]->hash;
        //  $abc=(int)$request->hasFile('ssc_marksheet');
          $dse_students = new dse_students;
          if(DB::table('dse_students')->where('dte_id', $dte_id)->exists()) 
            { 
            $dse_students  = dse_students::find($dte_id);
            }
            else
            {
              $dse_students->dte_id = $dte_id;
            }

            $test_photo = $request->input('photo');
        //  return $dse_students->photo_path;
          if($dse_students->photo_path == null)
          {
                    if ($test_photo=="yes") 
                    {
                        if($request->hasFile('photo'))
                        {
                              $rules = ['photo' => 'mimes:jpg,png,jpeg'];
                              $validator = Validator::make(Input::all() , $rules);
                              if ($validator->fails())
                              {
                                $request->session()->flash('photo_error', 'Please Upload Only JPG or PNG type image. File size should be less than 1 mb.');
                                return redirect()->route('dse_document_upload');
                              }
                              $extension = $request->file('photo')->getClientOriginalExtension();
                              $filenametostore = 'photo'.$dte_id.'.'.$extension;
                      
                              $path =  $request->file('photo')->storeAs($destinationPath, $filenametostore,'public_uploads');
                              $dse_students->photo_path = $filenametostore;
                              $dse_students->photo='Yes';
                              $dse_students->save();
                        }
                        else
                          {
                                $dse_students->photo='No';
                                $dse_students->save();
                          }
                  }
                    elseif ($test_photo=="no") {
                      $dse_students->photo='No';
                    }
                    elseif ($test_photo== null) {
                      $request->session()->flash('photo_error', 'Please select an option');
                        return redirect()->route('dse_document_upload');
                    }
            
          }

        $test_signature = $request->input('signature');
      //  return $test_signature;
      
      if($dse_students->signature_path == null)
          {
                    if ($test_signature=="yes") 
                    {
                          if($request->hasFile('signature'))
                          {
                                  $rules = ['signature' => 'mimes:jpg,png,jpeg'];
                                    $validator = Validator::make(Input::all() , $rules);
                                  if ($validator->fails())
                                  {
                                    $request->session()->flash('signature_error', 'Please Upload Only JPG or PNG type image. File size should be less than 1 mb.');
                                    return redirect()->route('dse_document_upload');
                                  }
                                  $extension = $request->file('signature')->getClientOriginalExtension();
                                  $filenametostore = 'signature'.$dte_id.'.'.$extension;
                                  $path = $request->file('signature')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                    $dse_students->signature_path = $filenametostore;
                                    $dse_students->signature='Yes';
                                  $dse_students->save();
                          }
                                else
                                  {
                                        $dse_students->signature='No';
                                        $dse_students->save();
                                  }
                  }
                    elseif ($test_signature=="no") {
                      $dse_students->signature='No';
                    }
                    elseif ($test_signature== null) {
                      $request->session()->flash('signature_error', 'Please select an option');
                        return redirect()->route('dse_document_upload');
                    }
          }

        $test_fc_confirmation_receipt = $request->input('fc_confirmation_receipt');
        //return $test_fc_confirmation_receipt;
        if($dse_students->fc_confirmation_receipt_path == null)
          {
        
                if ($test_fc_confirmation_receipt=="yes") 
                {
                  if($request->hasFile('fc_confirmation_receipt'))
                  { 
                if ($test_fc_confirmation_receipt=="yes") 
               
                          $rules = ['fc_confirmation_receipt' => 'mimes:pdf|max:1024'];
                            $validator = Validator::make(Input::all() , $rules);
                          if ($validator->fails())
                          {
                            $request->session()->flash('fc_confirmation_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                            return redirect()->route('dse_document_upload');
                          }
                          $extension = $request->file('fc_confirmation_receipt')->getClientOriginalExtension();
                          $filenametostore = 'fc_confirmation_receipt'.$dte_id.'.'.$extension;
                          $path = $request->file('fc_confirmation_receipt')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $dse_students->fc_confirmation_receipt_path =$filenametostore;
                            $dse_students->fc_confirmation_receipt='Yes';
                          $dse_students->save();
                  }
                    else
                      {
                            $dse_students->fc_confirmation_receipt='No';
                            $dse_students->save();
                      }
              }
              elseif ($test_fc_confirmation_receipt=="no") {
                  $dse_students->fc_confirmation_receipt='No';
                }
                elseif ($test_fc_confirmation_receipt== null) {
                  $request->session()->flash('fc_confirmation_error', 'Please select an option');
                    return redirect()->route('dse_document_upload');
                }

          }

          
        $test_dte_allotment_letter = $request->input('dte_allotment_letter');
        if($dse_students->dte_allotment_letter_path == null)
          {
                if ($test_dte_allotment_letter=="yes") 
                {
                    if($request->hasFile('dte_allotment_letter'))
                  {
                          $rules = ['dte_allotment_letter' => 'mimes:pdf|max:1024'];
                            $validator = Validator::make(Input::all() , $rules);
                          if ($validator->fails())
                          {
                            $request->session()->flash('dte_allotment_letter_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                            return redirect()->route('dse_document_upload');
                          }
                          $extension = $request->file('dte_allotment_letter')->getClientOriginalExtension();
                          $filenametostore = 'dte_allotment_letter_'.$dte_id.'.'.$extension;
                    
                          $path = $request->file('dte_allotment_letter')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                $dse_students->dte_allotment_letter_path = $filenametostore;
                                $dse_students->dte_allotment_letter='Yes';
                          $dse_students->save();
                  }
      
                else
                  {
                        $dse_students->dte_allotment_letter='No';
                        $dse_students->save();
                  }
                }
                elseif ($test_dte_allotment_letter=="no") {
                  $dse_students->dte_allotment_letter='No';
                }
                elseif ($test_dte_allotment_letter== null) {
                  $request->session()->flash('dte_allotment_letter_error', 'Please select an option');
                    return redirect()->route('dse_document_upload');
                }
          }

        $test_arc_ackw_receipt = $request->input('arc_ackw_receipt');
        
        if($dse_students->arc_ackw_receipt_path == null)
          {
                if ($test_arc_ackw_receipt=="yes") 
                {
                      if($request->hasFile('arc_ackw_receipt'))
                        {
                          $rules = ['arc_ackw_receipt' => 'mimes:pdf|max:1024'];
                            $validator = Validator::make(Input::all() , $rules);
                          if ($validator->fails())
                          {
                            $request->session()->flash('arc_ackw_receipt_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                            return redirect()->route('dse_document_upload');
                          }
                          $extension = $request->file('arc_ackw_receipt')->getClientOriginalExtension();
                          $filenametostore = 'arc_ackw_receipt_'.$dte_id.'.'.$extension;
                    
                          $path = $request->file('arc_ackw_receipt')->storeAs($destinationPath, $filenametostore,'public_uploads');
                          $dse_students->arc_ackw_receipt_path = $filenametostore;
                          $dse_students->arc_ackw_receipt='Yes';
                          $dse_students->save();
                        }
                  
                        else
                          {
                                $dse_students->arc_ackw_receipt='No';
                                $dse_students->save();
                          }
              }
              elseif ($test_arc_ackw_receipt=="no") {
                  $dse_students->arc_ackw_receipt='No';
              }
                elseif ($test_arc_ackw_receipt== null) {
                  $request->session()->flash('arc_ackw_receipt_error', 'Please select an option');
                    return redirect()->route('dse_document_upload');
                }
      }

         
        $test_ssc_marksheet = $request->input('ssc_marksheet');
        if($dse_students->ssc_marksheet_path == null)
          {
                        if ($test_ssc_marksheet=="yes") 
                        {
                              if($request->hasFile('ssc_marksheet')) 
                              {
                                $rules = ['ssc_marksheet' => 'mimes:pdf|max:1024'];
                                $validator = Validator::make(Input::all() , $rules);
                              if ($validator->fails())
                              {
                                $request->session()->flash('ssc_marksheet_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                return redirect()->route('dse_document_upload');
                              }
                        
                                //get file extension
                              $extension = $request->file('ssc_marksheet')->getClientOriginalExtension();
                              
                              //filename to store
                              $filenametostore = 'ssc_marksheet_'.$dte_id.'.'.$extension;
                              
                              //Upload File
                              $path = $request->file('ssc_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                      $dse_students->ssc_marksheet_path = $filenametostore;
                                        $dse_students->ssc_marksheet = 'Yes';
                              $dse_students->save();
                            }
                            else
                              {
                                    $dse_students->ssc_marksheet='No';
                                    $dse_students->save();
                              }
                  }
                  elseif ($test_ssc_marksheet=="no") {
                      $dse_students->ssc_marksheet='No';
                    }
                    elseif ($test_ssc_marksheet== null) {
                      $request->session()->flash('ssc_marksheet_error', 'Please select an option');
                        return redirect()->route('dse_document_upload');
                    }
          }
          
        $test_hsc_marksheet = $request->input('hsc_marksheet');
        if($dse_students->hsc_diploma_marksheet_path == null)
          {
                            if ($test_hsc_marksheet=="yes") 
                            {
                                    if($request->hasFile('hsc_marksheet')) 
                                    {
                                      $rules = ['hsc_marksheet' => 'mimes:pdf|max:1024'];
                                        $validator = Validator::make(Input::all() , $rules);
                                      if ($validator->fails())
                                      {
                                        $request->session()->flash('hsc_marksheet_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                        return redirect()->route('dse_document_upload');
                                      }
                                      $extension = $request->file('hsc_marksheet')->getClientOriginalExtension();
                                      $filenametostore = 'hsc_diploma_marksheet'.$dte_id.'.'.$extension;
                                      $path = $request->file('hsc_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                      $dse_students->hsc_diploma_marksheet_path = $filenametostore;
                                      $dse_students->hsc_diploma_marksheet='Yes';
                                      $dse_students->save();
                                    }
                                    else
                                      {
                                            $dse_students->hsc_diploma_marksheet='No';
                                            $dse_students->save();
                                      }
                      }
                      elseif ($test_hsc_marksheet=="no") {
                          $dse_students->hsc_diploma_marksheet='No';
                        }
                        elseif ($test_hsc_marksheet== null) {
                          $request->session()->flash('hsc_marksheet_error', 'Please select an option');
                            return redirect()->route('dse_document_upload');
                        }
          }           
        $test_degree_leaving_tc = $request->input('degree_leaving_tc');
        if($dse_students->degree_leaving_tc_path == null)
          {
                
                    if ($test_degree_leaving_tc=="yes") 
                    {
                        if($request->hasFile('degree_leaving_tc')) 
                        {
                          $rules = ['degree_leaving_tc' => 'mimes:pdf|max:1024'];
                            $validator = Validator::make(Input::all() , $rules);
                          if ($validator->fails())
                          {
                            $request->session()->flash('degree_leaving_tc_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                            return redirect()->route('dse_document_upload');
                          }
                          $extension = $request->file('degree_leaving_tc')->getClientOriginalExtension();
                          $filenametostore = 'degree_leaving_tc_'.$dte_id.'.'.$extension;
                          $path = $request->file('degree_leaving_tc')->storeAs($destinationPath, $filenametostore,'public_uploads');
                          $dse_students->degree_leaving_tc_path = $filenametostore;
                                $dse_students->degree_leaving_tc = 'Yes';
                          $dse_students->save();
                        }
                          else
                          {
                                $dse_students->degree_leaving_tc='No';
                                $dse_students->save();
                          }
                  }
              elseif ($test_degree_leaving_tc=="no") {
                  $dse_students->degree_leaving_tc='No';
                }
                elseif ($test_degree_leaving_tc== null) {
                  $request->session()->flash('degree_leaving_tc_error', 'Please select an option');
                    return redirect()->route('dse_document_upload');
                }
          }



          $test_equivalent_certi = $request->input('equivalent_certi');
        if($dse_students->equivalent_certi_path == null)
         {
              
                  if ($test_equivalent_certi=="yes") 
                  {
                      if($request->hasFile('equivalent_certi')) 
                      {
                        $rules = ['equivalent_certi' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('equivalent_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('dse_acap_document_upload');
                         }
                        $extension = $request->file('equivalent_certi')->getClientOriginalExtension();
                        $filenametostore = 'equivalent_certi_'.$dte_id.'.'.$extension;
                        $path = $request->file('equivalent_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $dse_students->equivalent_certi_path = $filenametostore;
                              $dse_students->equivalent_certi = 'Yes';
                        $dse_students->save();
                       }
                        else
                        {
                              $dse_students->equivalent_certi='No';
                              $dse_students->save();
                        }
                 }
             elseif ($test_equivalent_certi=="no") {
                $dse_students->equivalent_certi='No';
              }
              elseif ($test_equivalent_certi== null) {
                $request->session()->flash('equivalent_certi_error', 'Please select an option');
                  return redirect()->route('dse_acap_document_upload');
              }
         }



        $test_first_year_marksheet = $request->input('first_year_marksheet');
      if($dse_students->first_year_marksheet_path == null)
          {
                        if ($test_first_year_marksheet=="yes") 
                        {
                                if($request->hasFile('first_year_marksheet')) 
                                {
                                  $rules = ['first_year_marksheet' => 'mimes:pdf|max:1024'];
                                    $validator = Validator::make(Input::all() , $rules);
                                  if ($validator->fails())
                                  {
                                    $request->session()->flash('first_year_marksheet_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                    return redirect()->route('dse_document_upload');
                                  }
                                  $extension = $request->file('first_year_marksheet')->getClientOriginalExtension();
                                  $filenametostore = 'first_year_marksheet_'.$dte_id.'.'.$extension;
                                  $path = $request->file('first_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                  $dse_students->first_year_marksheet_path = $filenametostore;
                                    $dse_students->first_year_marksheet = 'Yes';
                                  $dse_students->save();
                                  }
                                  else
                                  {
                                        $dse_students->first_year_marksheet='No';
                                        $dse_students->save();
                                  }
                        }
              
                  elseif ($test_first_year_marksheet=="no") {
                      $dse_students->first_year_marksheet='No';
                    }
                    elseif ($test_first_year_marksheet== null) {
                      $request->session()->flash('first_year_marksheet_error', 'Please select an option');
                        return redirect()->route('dse_document_upload');
                    }
          }
        
        $test_second_year_marksheet = $request->input('second_year_marksheet');
        if($dse_students->second_year_marksheet_path == null)
          {
                    if ($test_second_year_marksheet=="yes") 
                    {
                            if($request->hasFile('second_year_marksheet')) 
                            {
                              $rules = ['second_year_marksheet' => 'mimes:pdf|max:1024'];
                                $validator = Validator::make(Input::all() , $rules);
                              if ($validator->fails())
                              {
                                $request->session()->flash('second_year_marksheet_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                return redirect()->route('dse_document_upload');
                              }
                              $extension = $request->file('second_year_marksheet')->getClientOriginalExtension();
                              $filenametostore = 'second_year_marksheet_'.$dte_id.'.'.$extension;
                              $path = $request->file('second_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                              $dse_students->second_year_marksheet_path = $filenametostore;
                                      $dse_students->second_year_marksheet='Yes';
                              $dse_students->save();
                              }
                              else
                              {
                                    $dse_students->second_year_marksheet='No';
                                    $dse_students->save();
                              }
                  }
                elseif ($test_second_year_marksheet=="no") {
                  $dse_students->second_year_marksheet='No';
                }
                elseif ($test_second_year_marksheet== null) {
                  $request->session()->flash('second_year_marksheet_error', 'Please select an option');
                    return redirect()->route('dse_document_upload');
                }
                
          }
          

        $test_third_year_marksheet = $request->input('third_year_marksheet');
          if($dse_students->third_year_marksheet_path == null)
          {
                    if ($test_third_year_marksheet=="yes") 
                    {
                        if($request->hasFile('third_year_marksheet')) 
                        {
                          $rules = ['third_year_marksheet' => 'mimes:pdf|max:1024'];
                            $validator = Validator::make(Input::all() , $rules);
                          if ($validator->fails())
                          {
                            $request->session()->flash('third_year_marksheet_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                            return redirect()->route('dse_document_upload');
                          }
                          $extension = $request->file('third_year_marksheet')->getClientOriginalExtension();
                          $filenametostore = 'third_year_marksheet_'.$dte_id.'.'.$extension;
                          $path = $request->file('third_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                          $dse_students->third_year_marksheet_path =$filenametostore;
                              $dse_students->third_year_marksheet='Yes';
                          $dse_students->save();
                          }
                          else
                          {
                                $dse_students->third_year_marksheet='No';
                                $dse_students->save();
                          }
                  }
                elseif ($test_third_year_marksheet=="no") {
                  $dse_students->third_year_marksheet='No';
                }
                elseif ($test_third_year_marksheet== null) {
                  $request->session()->flash('third_year_marksheet_error', 'Please select an option');
                    return redirect()->route('dse_document_upload');
                }

        
          }

          $test_fourth_year_marksheet = $request->input('fourth_year_marksheet');
          if($dse_students->fourth_year_marksheet_path == null)
          {
                    if ($test_fourth_year_marksheet=="yes") 
                    {
                        if($request->hasFile('fourth_year_marksheet')) 
                        {
                          $rules = ['fourth_year_marksheet' => 'mimes:pdf|max:1024'];
                            $validator = Validator::make(Input::all() , $rules);
                          if ($validator->fails())
                          {
                            $request->session()->flash('fourth_year_marksheet_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                            return redirect()->route('dse_document_upload');
                          }
                          $extension = $request->file('fourth_year_marksheet')->getClientOriginalExtension();
                          $filenametostore = 'fourth_year_marksheet_'.$dte_id.'.'.$extension;
                          $path = $request->file('fourth_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                          $dse_students->fourth_year_marksheet_path =$filenametostore;
                              $dse_students->fourth_year_marksheet='Yes';
                          $dse_students->save();
                          }
                          else
                          {
                                $dse_students->fourth_year_marksheet='No';
                                $dse_students->save();
                          }
                  }
                elseif ($test_fourth_year_marksheet=="no") {
                  $dse_students->fourth_year_marksheet='No';
                }
                elseif ($test_fourth_year_marksheet== null) {
                  $request->session()->flash('fourth_year_marksheet_error', 'Please select an option');
                    return redirect()->route('dse_document_upload');
                }

        
          }

        $test_convocation_passing_certi = $request->input('convocation_passing_certi');
        if($dse_students->convocation_passing_certi_path == null)
          {
                    if ($test_convocation_passing_certi=="yes") 
                    {
                        if($request->hasFile('convocation_passing_certi')) 
                        {
                          $rules = ['convocation_passing_certi' => 'mimes:pdf|max:1024'];
                            $validator = Validator::make(Input::all() , $rules);
                          if ($validator->fails())
                          {
                            $request->session()->flash('convocation_passing_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                            return redirect()->route('dse_document_upload');
                          }
                          $extension = $request->file('convocation_passing_certi')->getClientOriginalExtension();
                          $filenametostore = 'convocation_passing_certi_'.$dte_id.'.'.$extension;
                          $path = $request->file('convocation_passing_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                          $dse_students->convocation_passing_certi_path = $filenametostore;
                                  $dse_students->convocation_passing_certi='Yes';
                          $dse_students->save();
                        }
                        else
                          {
                                $dse_students->convocation_passing_certi='No';
                                $dse_students->save();
                          }
                  }
              elseif ($test_convocation_passing_certi=="no") {
                  $dse_students->convocation_passing_certi='No';
                }
                elseif ($test_convocation_passing_certi== null) {
                  $request->session()->flash('convocation_passing_certi_error', 'Please select an option');
                    return redirect()->route('dse_document_upload');
                }
          }

        
        $test_migration_certi = $request->input('migration_certi');
        if($dse_students->migration_certi_path == null)
          {
                        if ($test_migration_certi=="yes") 
                    {
                    if($request->hasFile('migration_certi')) 
                    {
                      $rules = ['migration_certi' => 'mimes:pdf|max:1024'];
                        $validator = Validator::make(Input::all() , $rules);
                      if ($validator->fails())
                      {
                        $request->session()->flash('migration_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                        return redirect()->route('dse_document_upload');
                      }
                      $extension = $request->file('migration_certi')->getClientOriginalExtension();
                    $filenametostore = 'migration_certi_'.$dte_id.'.'.$extension;
                      $path = $request->file('migration_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                      $dse_students->migration_certi_path = $filenametostore;
                              $dse_students->migration_certi='Yes';
                      $dse_students->save();
                    }
                    else
                      {
                            $dse_students->migration_certi='No';
                            $dse_students->save();
                      }
                  }
                  elseif ($test_migration_certi=="no") {
                      $dse_students->migration_certi='No';
                    }
                    elseif ($test_migration_certi== null) {
                      $request->session()->flash('migration_certi_error', 'Please select an option');
                        return redirect()->route('dse_document_upload');
                    }
          }

        $test_birth_certi = $request->input('birth_certi');
      if($dse_students->birth_certi_path == null)
          {
                    if ($test_birth_certi=="yes") 
                {
                        if($request->hasFile('birth_certi')) 
                        {
                          $rules = ['birth_certi' => 'mimes:pdf|max:1024'];
                            $validator = Validator::make(Input::all() , $rules);
                          if ($validator->fails())
                          {
                            $request->session()->flash('birth_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                            return redirect()->route('dse_document_upload');
                          }
                          $extension = $request->file('birth_certi')->getClientOriginalExtension();
                          $filenametostore = 'birth_certi_'.$dte_id.'.'.$extension;
                          $path = $request->file('birth_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                          $dse_students->birth_certi_path = $filenametostore;
                          $dse_students->birth_certi='Yes';
                          $dse_students->save();
                        }
                        else
                          {
                                $dse_students->birth_certi='No';
                                $dse_students->save();
                          }
              }
              elseif ($test_birth_certi=="no") {
                  $dse_students->birth_certi='No';
                }
                elseif ($test_birth_certi== null) {
                  $request->session()->flash('birth_certi_error', 'Please select an option');
                    return redirect()->route('dse_document_upload');
                }
          }
        $test_domicile = $request->input('domicile');
        if($dse_students->domicile_path == null)
          {
                    if ($test_domicile=="yes") 
                    {
                        if($request->hasFile('domicile')) 
                        {
                          $rules = ['domicile' => 'mimes:pdf|max:1024'];
                            $validator = Validator::make(Input::all() , $rules);
                          if ($validator->fails())
                          {
                            $request->session()->flash('domicile_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                            return redirect()->route('dse_document_upload');
                          }
                          $extension = $request->file('domicile')->getClientOriginalExtension();
                          $filenametostore = 'domicile_'.$dte_id.'.'.$extension;
                          $path = $request->file('domicile')->storeAs($destinationPath, $filenametostore,'public_uploads');
                          $dse_students->domicile_path =$filenametostore;
                                  $dse_students->domicile='Yes';
                          $dse_students->save();
                        }
                  
                          else
                          {
                                $dse_students->domicile='No';
                                $dse_students->save();
                          }
                  }
              elseif ($test_domicile=="no") {
                  $dse_students->domicile='No';
                }
                elseif ($test_domicile== null) {
                  $request->session()->flash('domicile_error', 'Please select an option');
                    return redirect()->route('dse_document_upload');
                }
          }
      $test_proforma_o = $request->input('proforma_o');
            if($dse_students->proforma_o_path == null)
          {
                        if ($test_proforma_o=="yes") 
                    {
                            if($request->hasFile('proforma_o')) 
                            {
                                  $rules = ['proforma_o' => 'mimes:pdf|max:1024'];
                                    $validator = Validator::make(Input::all() , $rules);
                                  if ($validator->fails())
                                  {
                                    $request->session()->flash('proforma_o_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                    return redirect()->route('dse_document_upload');
                                  }
                              $extension = $request->file('proforma_o')->getClientOriginalExtension();
                              $filenametostore = 'proforma_o_'.$dte_id.'.'.$extension;
                              $path = $request->file('proforma_o')->storeAs($destinationPath, $filenametostore,'public_uploads');
                              $dse_students->proforma_o_path = $filenametostore;
                                      $dse_students->proforma_o='Yes';
                              $dse_students->save();
                              }
                              else
                              {
                                    $dse_students->proforma_o='No';
                                    $dse_students->save();
                              }
                  }
                    elseif ($test_proforma_o=="no") {
                      $dse_students->proforma_o='No';
                    }
                    elseif ($test_proforma_o=="na") {
                      $dse_students->proforma_o='Not Applicable';
                    }
                    elseif ($test_proforma_o== null) {
                      $request->session()->flash('proforma_o_error', 'Please select an option');
                        return redirect()->route('dse_document_upload');
                    }
          }
        $test_retention = $request->input('retention');
        
        if($dse_students->retention_path == null)
          {
                        if ($test_retention=="yes") 
                    {
                            if($request->hasFile('retention')) 
                            {
                                      $rules = ['retention' => 'mimes:pdf|max:1024'];
                                        $validator = Validator::make(Input::all() , $rules);
                                      if ($validator->fails())
                                      {
                                        $request->session()->flash('retention_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                        return redirect()->route('dse_document_upload');
                                      }
                                      $extension = $request->file('retention')->getClientOriginalExtension();
                                      $filenametostore = 'retention_'.$dte_id.'.'.$extension;
                                      $path = $request->file('retention')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                      $dse_students->retention_path = $filenametostore;
                                      $dse_students->retention='Yes';
                                      $dse_students->save();
                            }
                      
                            else
                              {
                                    $dse_students->retention='No';
                                    $dse_students->save();
                              }
                  }
                  elseif ($test_retention=="no") {
                      $dse_students->retention='No';
                    }
                    elseif ($test_retention=="na") {
                      $dse_students->retention='Not Applicable';
                    }
                    elseif ($test_retention== null) {
                      $request->session()->flash('retention_error', 'Please select an option');
                        return redirect()->route('dse_document_upload');
                    }
          }

        $test_minority_affidavit = $request->input('minority_affidavit');
        if($dse_students->minority_affidavit_path == null)
          {
                    if ($test_minority_affidavit=="yes") 
                {
                if($request->hasFile('minority_affidavit')) 
                {
                          $rules = ['minority_affidavit' => 'mimes:pdf|max:1024'];
                            $validator = Validator::make(Input::all() , $rules);
                          if ($validator->fails())
                          {
                            $request->session()->flash('minority_affidavit_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                            return redirect()->route('dse_document_upload');
                          }
                          $extension = $request->file('minority_affidavit')->getClientOriginalExtension();
                          $filenametostore = 'minority_affidavit_'.$dte_id.'.'.$extension;
                          $path = $request->file('minority_affidavit')->storeAs($destinationPath, $filenametostore,'public_uploads');
                          $dse_students->minority_affidavit_path = $filenametostore;
                          $dse_students->minority_affidavit='Yes';
                          $dse_students->save();
                          }
                          else
                          {
                                $dse_students->minority_affidavit='No';
                                $dse_students->save();
                          }
                }
                elseif ($test_minority_affidavit=="no") {
                  $dse_students->minority_affidavit='No';
                }
                elseif ($test_minority_affidavit=="na") {
                  $dse_students->minority_affidavit='Not Applicable';
                }
                elseif ($test_minority_affidavit== null) {
                  $request->session()->flash('minority_affidavit_error', 'Please select an option');
                    return redirect()->route('dse_document_upload');
                }
          }

        $test_gap_certi = $request->input('gap_certi');
        if($dse_students->gap_certi_path == null)
          {
                    if ($test_gap_certi=="yes") 
                {
                            if($request->hasFile('gap_certi')) 
                            {
                                  $rules = ['gap_certi' => 'mimes:pdf|max:1024'];
                                    $validator = Validator::make(Input::all() , $rules);
                                  if ($validator->fails())
                                  {
                                    $request->session()->flash('gap_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                    return redirect()->route('dse_document_upload');
                                  }
                                  $extension = $request->file('gap_certi')->getClientOriginalExtension();
                                  $filenametostore = 'gap_certi_'.$dte_id.'.'.$extension;
                                  $path = $request->file('gap_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                  $dse_students->gap_certi_path =$filenametostore;
                                  $dse_students->gap_certi='Yes';
                                  $dse_students->save();
                              }
                                  else
                                  {
                                        $dse_students->gap_certi='No';
                                        $dse_students->save();
                                  }
              }
                elseif ($test_gap_certi=="no") {
                  $dse_students->gap_certi='No';
                }
                elseif ($test_gap_certi=="na") {
                  $dse_students->gap_certi='Not Applicable';
                }
                elseif ($test_gap_certi== null) {
                  $request->session()->flash('gap_certi_error', 'Please select an option');
                    return redirect()->route('dse_document_upload');
                }
          }
        $test_community_certi = $request->input('community_certi');
        
        if($dse_students->community_certi_path == null)
          {
                        if ($test_community_certi=="yes") 
                    {
                            if($request->hasFile('community_certi')) 
                            {
                              $rules = ['community_certi' => 'mimes:pdf|max:1024'];
                                $validator = Validator::make(Input::all() , $rules);
                              if ($validator->fails())
                              {
                                $request->session()->flash('community_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                return redirect()->route('dse_document_upload');
                              }
                              $extension = $request->file('community_certi')->getClientOriginalExtension();
                              $filenametostore = 'community_certi_'.$dte_id.'.'.$extension;
                              $path = $request->file('community_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                              $dse_students->community_certi_path = $filenametostore;
                              $dse_students->community_certi='Yes';
                              $dse_students->save();
                              }
                              else
                              {
                                    $dse_students->community_certi='No';
                                    $dse_students->save();
                              }
                    }
                    elseif ($test_community_certi=="no") {
                      $dse_students->community_certi='No';
                    }
                    elseif ($test_community_certi=="na") {
                      $dse_students->community_certi='Not Applicable';
                    }
                    elseif ($test_community_certi== null) {
                      $request->session()->flash('community_certi_error', 'Please select an option');
                        return redirect()->route('dse_document_upload');
                    } 
          }
        $test_caste_certi = $request->input('caste_certi');
        
        if($dse_students->caste_certi_path == null)
          {
                        if ($test_caste_certi=="yes") 
                    {
                            if($request->hasFile('caste_certi')) 
                            {
                              $rules = ['caste_certi' => 'mimes:pdf|max:1024'];
                                $validator = Validator::make(Input::all() , $rules);
                              if ($validator->fails())
                              {
                                $request->session()->flash('caste_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                return redirect()->route('dse_document_upload');
                              }
                              $extension = $request->file('caste_certi')->getClientOriginalExtension();
                              $filenametostore = 'caste_certi_'.$dte_id.'.'.$extension;
                              $path = $request->file('caste_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                              $dse_students->caste_certi_path =$filenametostore;
                              $dse_students->caste_certi='Yes';
                              $dse_students->save();
                            }
                              else
                              {
                                    $dse_students->caste_certi='No';
                                    $dse_students->save();
                              }
                  }
                  elseif ($test_caste_certi=="no") {
                      $dse_students->caste_certi='No';
                    }
                    elseif ($test_caste_certi=="na") {
                      $dse_students->caste_certi='Not Applicable';
                    }
                    elseif ($test_caste_certi== null) {
                      $request->session()->flash('caste_certi_error', 'Please select an option');
                        return redirect()->route('dse_document_upload');
                    }
          }

        $test_caste_validity_certi = $request->input('caste_validity_certi');
        if($dse_students->caste_validity_certi_path == null)
          {
                    if ($test_caste_validity_certi=="yes") 
                {
                        if($request->hasFile('caste_validity_certi')) 
                        {
                          $rules = ['caste_validity_certi' => 'mimes:pdf|max:1024'];
                            $validator = Validator::make(Input::all() , $rules);
                          if ($validator->fails())
                          {
                            $request->session()->flash('caste_validity_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                            return redirect()->route('dse_document_upload');
                          }
                          $extension = $request->file('caste_validity_certi')->getClientOriginalExtension();
                          $filenametostore = 'caste_validity_certi_'.$dte_id.'.'.$extension;
                          $path = $request->file('caste_validity_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                          $dse_students->caste_validity_certi_path = $filenametostore;
                          $dse_students->caste_validity_certi='Yes';
                          $dse_students->save();
                        }
                        else
                          {
                                $dse_students->caste_validity_certi='No';
                                $dse_students->save();
                          }
              }
              elseif ($test_caste_validity_certi=="no") {
                  $dse_students->caste_validity_certi='No';
                }
                elseif ($test_caste_validity_certi=="na") {
                  $dse_students->caste_validity_certi='Not Applicable';
                }
                elseif ($test_caste_validity_certi== null) {
                  $request->session()->flash('caste_validity_certi_error', 'Please select an option');
                    return redirect()->route('dse_document_upload');
                }
          }
        $test_non_creamy_layer_certi = $request->input('non_creamy_layer_certi');
        if($dse_students->non_creamy_layer_certi_path == null)
          {
                    if ($test_non_creamy_layer_certi=="yes") 
                {
                        if($request->hasFile('non_creamy_layer_certi')) 
                        {
                          $rules = ['non_creamy_layer_certi' => 'mimes:pdf|max:1024'];
                            $validator = Validator::make(Input::all() , $rules);
                          if ($validator->fails())
                          {
                            $request->session()->flash('non_creamy_layer_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                            return redirect()->route('dse_document_upload');
                          }
                          $extension = $request->file('non_creamy_layer_certi')->getClientOriginalExtension();
                          $filenametostore = 'non_creamy_layer_certi_'.$dte_id.'.'.$extension;
                          $path = $request->file('non_creamy_layer_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                          $dse_students->non_creamy_layer_certi_path = $filenametostore;
                          $dse_students->non_creamy_layer_certi='Yes';
                          $dse_students->save();
                          }
                  
                          else
                          {
                                $dse_students->non_creamy_layer_certi='No';
                                $dse_students->save();
                          }
                }
                elseif ($test_non_creamy_layer_certi=="no") {
                  $dse_students->non_creamy_layer_certi='No';
                }
                elseif ($test_non_creamy_layer_certi=="na") {
                  $dse_students->non_creamy_layer_certi='Not Applicable';
                }
                elseif ($test_non_creamy_layer_certi== null) {
                  $request->session()->flash('non_creamy_layer_certi_error', 'Please select an option');
                    return redirect()->route('dse_document_upload');
                }
          }

        
        

       
        $test_income_certi = $request->input('income_certi');
        if($dse_students->income_certi_path == null)
          {
                        if ($test_income_certi=="yes") 
                    {
                            if($request->hasFile('income_certi')) 
                            {
                              $rules = ['income_certi' => 'mimes:pdf|max:1024'];
                                $validator = Validator::make(Input::all() , $rules);
                              if ($validator->fails())
                              {
                                $request->session()->flash('income_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                return redirect()->route('dse_document_upload');
                              }
                              $extension = $request->file('income_certi')->getClientOriginalExtension();
                              $filenametostore = 'income_certi_'.$dte_id.'.'.$extension;
                              $path = $request->file('income_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                              $dse_students->income_certi_path = $filenametostore;
                              $dse_students->income_certi='Yes';
                              $dse_students->save();
                            }
                            else
                              {
                                    $dse_students->income_certi='No';
                                    $dse_students->save();
                              }
                  }
                  elseif ($test_income_certi=="no") {
                      $dse_students->income_certi='No';
                    }
                    elseif ($test_income_certi=="na") {
                      $dse_students->income_certi='Not Applicable';
                    }
                    elseif ($test_income_certi== null) {
                      $request->session()->flash('income_certi_error', 'Please select an option');
                        return redirect()->route('dse_document_upload');
                    }
          }

        

        $test_medical_certi = $request->input('medical_certi');
        if($dse_students->medical_certi_path == null)
          {
                        if ($test_medical_certi=="yes") 
                    {
                            if($request->hasFile('medical_certi')) 
                            {
                              $rules = ['medical_certi' => 'mimes:pdf|max:1024'];
                                $validator = Validator::make(Input::all() , $rules);
                              if ($validator->fails())
                              {
                                $request->session()->flash('medical_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                return redirect()->route('dse_document_upload');
                              }
                              $extension = $request->file('medical_certi')->getClientOriginalExtension();
                              $filenametostore = 'medical_certi_'.$dte_id.'.'.$extension;
                              $path = $request->file('medical_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                              $dse_students->medical_certi_path = $filenametostore;
                                      $dse_students->medical_certi='Yes';
                              $dse_students->save();
                            }
                              else
                              {
                                    $dse_students->medical_certi='No';
                                    $dse_students->save();
                              }
                  }
                  elseif ($test_medical_certi=="no") {
                      $dse_students->medical_certi='No';
                    }
                    elseif ($test_medical_certi== null) {
                      $request->session()->flash('medical_certi_error', 'Please select an option');
                        return redirect()->route('dse_document_upload');
                    }
          }

         $test_nationality_certi = $request->input('nationality_certi');
        if($dse_students->nationality_certi_path == null)
         {
                      if ($test_nationality_certi=="yes") 
                  {
                          if($request->hasFile('nationality_certi')) 
                          {
                                    $rules = ['nationality_certi' => 'mimes:pdf|max:1024'];
                                      $validator = Validator::make(Input::all() , $rules);
                                    if ($validator->fails())
                                     {
                                      $request->session()->flash('nationality_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                      return redirect()->route('dse_document_upload');
                                     }
                                    $extension = $request->file('nationality_certi')->getClientOriginalExtension();
                                    $filenametostore = 'nationality_certi_'.$dte_id.'.'.$extension;
                                    $path = $request->file('nationality_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');

                                    $dse_students->nationality_certi_path = $filenametostore;
                                    $dse_students->nationality_certi='Yes';
                                    $dse_students->save();
                          }
                    
                           else
                            {
                                  $dse_students->nationality_certi='No';
                                  $dse_students->save();
                            }
                }
                elseif ($test_nationality_certi=="no") {
                    $dse_students->nationality_certi='No';
                  }
                  elseif ($test_nationality_certi=="na") {
                    $dse_students->nationality_certi='Not Applicable';
                  }
                  elseif ($test_nationality_certi== null) {
                    $request->session()->flash('nationality_certi_error', 'Please select an option');
                      return redirect()->route('dse_document_upload');
                  }
         }


        $test_anti_ragging_affidavit = $request->input('anti_ragging_affidavit');
          if($dse_students->anti_ragging_affidavit_path == null)
          {
                    if ($test_anti_ragging_affidavit=="yes") 
                {
                        if($request->hasFile('anti_ragging_affidavit')) 
                        {
                          $rules = ['anti_ragging_affidavit' => 'mimes:pdf|max:1024'];
                            $validator = Validator::make(Input::all() , $rules);
                          if ($validator->fails())
                          {
                            $request->session()->flash('anti_ragging_affidavit_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                            return redirect()->route('dse_document_upload');
                          }
                          $extension = $request->file('anti_ragging_affidavit')->getClientOriginalExtension();
                          $filenametostore = 'anti_ragging_affidavit'.$dte_id.'.'.$extension;
                          $path = $request->file('anti_ragging_affidavit')->storeAs($destinationPath, $filenametostore,'public_uploads');
                          $dse_students->anti_ragging_affidavit_path = $filenametostore;
                                  $dse_students->anti_ragging_affidavit='Yes';
                          $dse_students->save();
                        }
                        else
                          {
                                $dse_students->anti_ragging_affidavit='No';
                                $dse_students->save();
                          }
              }
              elseif ($test_anti_ragging_affidavit=="no") {
                  $dse_students->anti_ragging_affidavit='No';
                }
                elseif ($test_anti_ragging_affidavit== null) {
                  $request->session()->flash('anti_ragging_affidavit_error', 'Please select an option');
                    return redirect()->route('dse_document_upload');
                }
          }
          
          $user1 = DB::table('dse_students')->select('dte_id','fc_confirmation_receipt','fc_confirmation_receipt_path','dte_allotment_letter','dte_allotment_letter_path','arc_ackw_receipt','nationality_certi','nationality_certi_path','arc_ackw_receipt_path','ssc_marksheet','ssc_marksheet_path','hsc_diploma_marksheet','hsc_diploma_marksheet_path','degree_leaving_tc','degree_leaving_tc_path','first_year_marksheet','first_year_marksheet_path','second_year_marksheet','second_year_marksheet_path','third_year_marksheet','third_year_marksheet_path','fourth_year_marksheet','fourth_year_marksheet_path','equivalent_certi','equivalent_certi_path','migration_certi','migration_certi_path','birth_certi','birth_certi_path','domicile','domicile_path','proforma_o','proforma_o_path','retention','retention_path','minority_affidavit','minority_affidavit_path','gap_certi','gap_certi_path','community_certi','community_certi_path','caste_certi','caste_certi_path','caste_validity_certi','caste_validity_certi_path','non_creamy_layer_certi','non_creamy_layer_certi_path','income_certi','income_certi_path','convocation_passing_certi','convocation_passing_certi_path','anti_ragging_affidavit','nationality_certi','nationality_certi_path','anti_ragging_affidavit_path','medical_certi','medical_certi_path','photo','photo_path','signature','signature_path','is_document_completed')->where('dte_id', $dte_id)->get();
          $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
          $hash = $hash[0]->hash;
          if($user1[0]->photo ==  "Yes" && $user1[0]->signature == "Yes")
          {
              $dse_students->is_document_completed =1;
              $dse_students->save();

      
          }
          elseif($user1[0]->photo ==  null || $user1[0]->signature == null)
          {
                $dse_students->is_document_completed =0;
              // return "hello";
              $dse_students->save();
          }
           //routes validation and progress bar 

       $course = $request->session()->get('log_course');
      list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
      // return $user1;
       
          $data=[];
          $data['user1']=$user1;
          $data['hash'] = $hash;
          return view('user.dse.document_upload',$data);
  }     
      
public static function showdseAcapDocumentUpload(Request $request)
    {
        $dte_id = $request->session()->get('log_dte_id');
        $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          //$path =  DB::table('me_students')->select('photo_path')->where('dte_id', $dte_id)->get();
          
          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {
       if (DB::table('dse_students')->where('dte_id', $dte_id)->exists())
        {
        $user1 = DB::table('dse_students')->select('dte_id','fc_confirmation_receipt','fc_confirmation_receipt_path','dte_allotment_letter','dte_allotment_letter_path','arc_ackw_receipt','arc_ackw_receipt_path','ssc_marksheet','ssc_marksheet_path','hsc_diploma_marksheet','hsc_diploma_marksheet_path','degree_leaving_tc','degree_leaving_tc_path','first_year_marksheet','first_year_marksheet_path','second_year_marksheet','convocation_passing_certi','convocation_passing_certi_path','second_year_marksheet_path','third_year_marksheet','third_year_marksheet_path','fourth_year_marksheet','fourth_year_marksheet_path','migration_certi','migration_certi_path','birth_certi','equivalent_certi','equivalent_certi_path','birth_certi_path','domicile','domicile_path','proforma_o','proforma_o_path','retention','retention_path','minority_affidavit','minority_affidavit_path','gap_certi','gap_certi_path','community_certi','community_certi_path','caste_certi','caste_certi_path','caste_validity_certi','caste_validity_certi_path','non_creamy_layer_certi','nationality_certi','nationality_certi_path','non_creamy_layer_certi_path','proforma_a_b1_b2','proforma_a_b1_b2_path','income_certi','income_certi_path','proforma_c_d_e','proforma_c_d_e_path','anti_ragging_affidavit','anti_ragging_affidavit_path','medical_certi','medical_certi_path','photo','photo_path','signature','signature_path','is_document_completed')->where('dte_id', $dte_id)->get();
        $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        $hash = $hash[0]->hash;
       

        }
        else
        {
        $array_object = [['dte_id'=> $dte_id,'is_document_completed'=>0,'fc_confirmation_receipt' => 'No', 'fc_confirmation_receipt_path' => null, 'dte_allotment_letter' => 'No', 'dte_allotment_letter_path' => null, 'arc_ackw_receipt' => 'No', 'arc_ackw_receipt_path' => null, 'cet_result' => 'No', 'cet_result_path' => null, 'ssc_marksheet' => 'No','ssc_marksheet_path' => null,  'hsc_diploma_marksheet' => null,'hsc_diploma_marksheet_path' => null,  'degree_leaving_tc' => 'No', 'degree_leaving_tc_path' => null, 'degree_leaving_tc_path' => null,  'first_year_marksheet' => 'No', 'first_year_marksheet_path' => null, 'second_year_marksheet' => 'No', 'second_year_marksheet_path' => null, 'third_year_marksheet' => 'No', 'third_year_marksheet_path' => null,'fourth_year_marksheet' => 'No', 'fourth_year_marksheet_path' => null,'convocation_passing_certi'=>'No','convocation_passing_certi_path'=>null, 'migration_certi' => 'No','equivalent_certi'=>'No','equivalent_certi_path'=> null,'migration_certi_path' => null, 'birth_certi' => 'No', 'birth_certi_path' => null, 'domicile' => 'No', 'domicile_path' => null, 'proforma_o' => 'No', 'proforma_o_path' => null, 'retention' => 'No','retention_path' => null,'nationality_certi'=>'No','nationality_certi_path'=> null,'minority_affidavit' => 'No', 'minority_affidavit_path' => null, 'gap_certi' => 'No', 'gap_certi_path' => null, 'community_certi' => 'No', 'community_certi_path' => null, 'caste_certi' => 'No', 'caste_certi_path' => null, 'caste_validity_certi' => 'No', 'caste_validity_certi_path' => null, 'non_creamy_layer_certi' => 'No', 'non_creamy_layer_certi_path' => null, 'proforma_a_b1_b2' => 'No', 'proforma_a_b1_b2_path' => null, 'proforma_f_f1' => 'No', 'proforma_f_f1_path' => null, 'income_certi' => 'No', 'income_certi_path' => null, 'proforma_c_d_e' => 'No', 'proforma_c_d_e_path' => null, 'anti_ragging_affidavit' => 'No', 'anti_ragging_affidavit_path' => null, 'proforma_j_k_l' => 'No', 'proforma_j_k_l_path' => null, 'medical_certi' => 'No', 'medical_certi_path' => null, 'photo' => 'No','photo_path' => null, 'signature' => 'No', 'signature_path' => null]];
        $user1 = json_decode(json_encode($array_object));
        $hash = null;
        }
      // return $user1;
          $course = $request->session()->get('log_course');
 list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
       if($userprogress[0]->is_contact_completed ==0){
      return redirect('dse_contact_details');
      } 
      $data=[];  
      if($userprogress[0]->is_document_completed==1){
          $user1['prog_val']=7;
          $data['user1']=$user1;
          // return 'done';
        }
        
        $data['user1']=$user1;
        $data['hash']=$hash;
        //$photo_path = 'storage'.$user1;
        
        return view('user.dse.acap_document_upload',$data);

      }
       else
              return redirect()->route('dse_profile');
          
    }

  public static function uploaddseAcapDocumentUpload(Request $request)
    {

      
      /* $request->validate([
        'ssc_marksheet','hsc_marksheet','hsc_leaving_certi','first_year_marksheet','second_year_marksheet','third_year_marksheet','fourth_year_marksheet','convocational_certi','birth_certi','domicile_certi','proforma_o','retention_certi','minority_affidavit','gap_certi','community_certi','cast_certi','caste_validity_certi','non_creamy_layer_certi','proforma_h','proforma_a_b1_b2','proforma_f_f1','income_certi','proforma_j_k_l','medical_certi' => 'mimes:pdf|max:1024'
        ]);*/

      $dte_id=$request->session()->get('log_dte_id'); 
      $use = DB::table('student_login')->select('hash')->where('dte_id', $dte_id)->get();
      $destinationPath = $dte_id.'_'.$use[0]->hash;
      //  $abc=(int)$request->hasFile('ssc_marksheet');
        $dse_students = new dse_students;
        if(DB::table('dse_students')->where('dte_id', $dte_id)->exists()) 
          { 
           $dse_students  = dse_students::find($dte_id);
          }
          else
          {
            $dse_students->dte_id = $dte_id;
          }

          $test_photo = $request->input('photo');
       //  return $dse_students->photo_path;
         if($dse_students->photo_path == null)
         {
                  if ($test_photo=="yes") 
                  {
                       if($request->hasFile('photo'))
                      {
                            $rules = ['photo' => 'mimes:jpg,png,jpeg'];
                             $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('photo_error', 'Please Upload Only JPG or PNG type image. File size should be less than 1 mb.');
                              return redirect()->route('dse_acap_document_upload');
                             }
                            $extension = $request->file('photo')->getClientOriginalExtension();
                            $filenametostore = 'photo'.$dte_id.'.'.$extension;
                    
                            $path =  $request->file('photo')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $dse_students->photo_path = $filenametostore;
                            $dse_students->photo='Yes';
                            $dse_students->save();
                      }
                      else
                        {
                              $dse_students->photo='No';
                              $dse_students->save();
                        }
                 }
                  elseif ($test_photo=="no") {
                    $dse_students->photo='No';
                  }
                  elseif ($test_photo== null) {
                    $request->session()->flash('photo_error', 'Please select an option');
                      return redirect()->route('dse_acap_document_upload');
                  }
          
         }

      $test_signature = $request->input('signature');
        if($dse_students->signature_path == null)
         {
                  if ($test_signature=="yes") 
                  {
                        if($request->hasFile('signature'))
                        {
                                $rules = ['signature' => 'mimes:jpg,png,jpeg'];
                                  $validator = Validator::make(Input::all() , $rules);
                                if ($validator->fails())
                                 {
                                  $request->session()->flash('signature_error', 'Please Upload Only JPG or PNG type image. File size should be less than 1 mb.');
                                  return redirect()->route('dse_acap_document_upload');
                                 }
                                $extension = $request->file('signature')->getClientOriginalExtension();
                                $filenametostore = 'signature'.$dte_id.'.'.$extension;
                                $path = $request->file('signature')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                  $dse_students->signature_path = $filenametostore;
                                   $dse_students->signature='Yes';
                                $dse_students->save();
                        }
                               else
                                {
                                      $dse_students->signature='No';
                                      $dse_students->save();
                                }
                 }
                  elseif ($test_signature=="no") {
                    $dse_students->signature='No';
                  }
                  elseif ($test_signature== null) {
                    $request->session()->flash('signature_error', 'Please select an option');
                      return redirect()->route('dse_acap_document_upload');
                  }
         }

      $test_fc_confirmation_receipt = $request->input('fc_confirmation_receipt');
        if($dse_students->fc_confirmation_receipt_path == null)
         {
      
              if ($test_fc_confirmation_receipt=="yes") 
              {
                 if($request->hasFile('fc_confirmation_receipt'))
                 { 
                        $rules = ['fc_confirmation_receipt' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('fc_confirmation_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('dse_acap_document_upload');
                         }
                        $extension = $request->file('fc_confirmation_receipt')->getClientOriginalExtension();
                        $filenametostore = 'fc_confirmation_receipt'.$dte_id.'.'.$extension;
                        $path = $request->file('fc_confirmation_receipt')->storeAs($destinationPath, $filenametostore,'public_uploads');
                          $dse_students->fc_confirmation_receipt_path =$filenametostore;
                           $dse_students->fc_confirmation_receipt='Yes';
                        $dse_students->save();
                }
                  else
                    {
                          $dse_students->fc_confirmation_receipt='No';
                          $dse_students->save();
                    }
             }
             elseif ($test_fc_confirmation_receipt=="no") {
                $dse_students->fc_confirmation_receipt='No';
              }
              elseif ($test_fc_confirmation_receipt== null) {
                $request->session()->flash('fc_confirmation_error', 'Please select an option');
                  return redirect()->route('dse_acap_document_upload');
              }

         }

      $test_ssc_marksheet = $request->input('ssc_marksheet');
        if($dse_students->ssc_marksheet_path == null)
         {
                      if ($test_ssc_marksheet=="yes") 
                      {
                            if($request->hasFile('ssc_marksheet')) 
                            {
                              $rules = ['ssc_marksheet' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('ssc_marksheet_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              return redirect()->route('dse_acap_document_upload');
                             }
                      
                               //get file extension
                            $extension = $request->file('ssc_marksheet')->getClientOriginalExtension();
                            
                            //filename to store
                            $filenametostore = 'ssc_marksheet_'.$dte_id.'.'.$extension;
                            
                            //Upload File
                            $path = $request->file('ssc_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                     $dse_students->ssc_marksheet_path = $filenametostore;
                                      $dse_students->ssc_marksheet = 'Yes';
                            $dse_students->save();
                          }
                          else
                            {
                                  $dse_students->ssc_marksheet='No';
                                  $dse_students->save();
                            }
                }
                elseif ($test_ssc_marksheet=="no") {
                    $dse_students->ssc_marksheet='No';
                  }
                  elseif ($test_ssc_marksheet== null) {
                    $request->session()->flash('ssc_marksheet_error', 'Please select an option');
                      return redirect()->route('dse_acap_document_upload');
                  }
         }
         
      $test_hsc_marksheet = $request->input('hsc_marksheet');
        if($dse_students->hsc_diploma_marksheet_path == null)
         {
                          if ($test_hsc_marksheet=="yes") 
                          {
                                  if($request->hasFile('hsc_marksheet')) 
                                  {
                                    $rules = ['hsc_marksheet' => 'mimes:pdf|max:1024'];
                                      $validator = Validator::make(Input::all() , $rules);
                                    if ($validator->fails())
                                     {
                                      $request->session()->flash('hsc_marksheet_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                      return redirect()->route('dse_acap_document_upload');
                                     }
                                    $extension = $request->file('hsc_marksheet')->getClientOriginalExtension();
                                    $filenametostore = 'hsc_diploma_marksheet'.$dte_id.'.'.$extension;
                                    $path = $request->file('hsc_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                    $dse_students->hsc_diploma_marksheet_path = $filenametostore;
                                     $dse_students->hsc_diploma_marksheet='Yes';
                                    $dse_students->save();
                                  }
                                  else
                                    {
                                          $dse_students->hsc_diploma_marksheet='No';
                                          $dse_students->save();
                                    }
                    }
                    elseif ($test_hsc_marksheet=="no") {
                        $dse_students->hsc_diploma_marksheet='No';
                      }
                      elseif ($test_hsc_marksheet== null) {
                        $request->session()->flash('hsc_marksheet_error', 'Please select an option');
                          return redirect()->route('dse_acap_document_upload');
                      }
         }           

      $test_first_year_marksheet = $request->input('first_year_marksheet');
        if($dse_students->first_year_marksheet_path == null)
         {
                      if ($test_first_year_marksheet=="yes") 
                      {
                              if($request->hasFile('first_year_marksheet')) 
                              {
                                $rules = ['first_year_marksheet' => 'mimes:pdf|max:1024'];
                                  $validator = Validator::make(Input::all() , $rules);
                                if ($validator->fails())
                                 {
                                  $request->session()->flash('first_year_marksheet_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                  return redirect()->route('dse_acap_document_upload');
                                 }
                                $extension = $request->file('first_year_marksheet')->getClientOriginalExtension();
                                $filenametostore = 'first_year_marksheet_'.$dte_id.'.'.$extension;
                                $path = $request->file('first_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                $dse_students->first_year_marksheet_path = $filenametostore;
                                   $dse_students->first_year_marksheet = 'Yes';
                                $dse_students->save();
                                }
                                else
                                {
                                      $dse_students->first_year_marksheet='No';
                                      $dse_students->save();
                                }
                       }
            
                 elseif ($test_first_year_marksheet=="no") {
                    $dse_students->first_year_marksheet='No';
                  }
                  elseif ($test_first_year_marksheet== null) {
                    $request->session()->flash('first_year_marksheet_error', 'Please select an option');
                      return redirect()->route('dse_acap_document_upload');
                  }
         }
      
      $test_second_year_marksheet = $request->input('second_year_marksheet');
        if($dse_students->second_year_marksheet_path == null)
         {
                  if ($test_second_year_marksheet=="yes") 
                  {
                          if($request->hasFile('second_year_marksheet')) 
                          {
                            $rules = ['second_year_marksheet' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('second_year_marksheet_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              return redirect()->route('dse_acap_document_upload');
                             }
                            $extension = $request->file('second_year_marksheet')->getClientOriginalExtension();
                            $filenametostore = 'second_year_marksheet_'.$dte_id.'.'.$extension;
                            $path = $request->file('second_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $dse_students->second_year_marksheet_path = $filenametostore;
                                    $dse_students->second_year_marksheet='Yes';
                            $dse_students->save();
                            }
                             else
                            {
                                  $dse_students->second_year_marksheet='No';
                                  $dse_students->save();
                            }
                }
              elseif ($test_second_year_marksheet=="no") {
                $dse_students->second_year_marksheet='No';
              }
              elseif ($test_second_year_marksheet== null) {
                $request->session()->flash('second_year_marksheet_error', 'Please select an option');
                  return redirect()->route('dse_acap_document_upload');
              }
              
         }
         
      $test_third_year_marksheet = $request->input('third_year_marksheet');
        if($dse_students->third_year_marksheet_path == null)
         {
                  if ($test_third_year_marksheet=="yes") 
                  {
                      if($request->hasFile('third_year_marksheet')) 
                      {
                        $rules = ['third_year_marksheet' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('third_year_marksheet_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('dse_acap_document_upload');
                         }
                        $extension = $request->file('third_year_marksheet')->getClientOriginalExtension();
                        $filenametostore = 'third_year_marksheet_'.$dte_id.'.'.$extension;
                        $path = $request->file('third_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $dse_students->third_year_marksheet_path =$filenametostore;
                            $dse_students->third_year_marksheet='Yes';
                        $dse_students->save();
                        }
                         else
                        {
                              $dse_students->third_year_marksheet='No';
                              $dse_students->save();
                        }
                 }
              elseif ($test_third_year_marksheet=="no") {
                $dse_students->third_year_marksheet='No';
              }
              elseif ($test_third_year_marksheet== null) {
                $request->session()->flash('third_year_marksheet_error', 'Please select an option');
                  return redirect()->route('dse_acap_document_upload');
              }

      
         }

      $test_fourth_year_marksheet = $request->input('fourth_year_marksheet');
          if($dse_students->fourth_year_marksheet_path == null)
         {
                  if ($test_fourth_year_marksheet=="yes") 
                  {
                      if($request->hasFile('fourth_year_marksheet')) 
                      {
                        $rules = ['fourth_year_marksheet' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('fourth_year_marksheet_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('dse_acap_document_upload');
                         }
                        $extension = $request->file('fourth_year_marksheet')->getClientOriginalExtension();
                        $filenametostore = 'fourth_year_marksheet_'.$dte_id.'.'.$extension;
                        $path = $request->file('fourth_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $dse_students->fourth_year_marksheet_path =$filenametostore;
                            $dse_students->fourth_year_marksheet='Yes';
                        $dse_students->save();
                        }
                         else
                        {
                              $dse_students->fourth_year_marksheet='No';
                              $dse_students->save();
                        }
                 }
              elseif ($test_fourth_year_marksheet=="no") {
                $dse_students->fourth_year_marksheet='No';
              }
              elseif ($test_third_year_marksheet== null) {
                $request->session()->flash('fourth_year_marksheet_error', 'Please select an option');
                  return redirect()->route('dse_acap_document_upload');
              }

      
         }

      $test_convocation_passing_certi = $request->input('convocation_passing_certi');
       if($dse_students->convocation_passing_certi_path == null)
         {
                  if ($test_convocation_passing_certi=="yes") 
                  {
                      if($request->hasFile('convocation_passing_certi')) 
                      {
                        $rules = ['convocation_passing_certi' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('convocation_passing_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('dse_acap_document_upload');
                         }
                        $extension = $request->file('convocation_passing_certi')->getClientOriginalExtension();
                        $filenametostore = 'convocation_passing_certi_'.$dte_id.'.'.$extension;
                        $path = $request->file('convocation_passing_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $dse_students->convocation_passing_certi_path = $filenametostore;
                                $dse_students->convocation_passing_certi='Yes';
                        $dse_students->save();
                      }
                      else
                        {
                              $dse_students->convocation_passing_certi='No';
                              $dse_students->save();
                        }
                }
            elseif ($test_convocation_passing_certi=="no") {
                $dse_students->convocation_passing_certi='No';
              }
              elseif ($test_convocation_passing_certi== null) {
                $request->session()->flash('convocation_passing_certi_error', 'Please select an option');
                  return redirect()->route('dse_acap_document_upload');
              }
         }

      $test_degree_leaving_tc = $request->input('degree_leaving_tc');
        if($dse_students->degree_leaving_tc_path == null)
         {
              
                  if ($test_degree_leaving_tc=="yes") 
                  {
                      if($request->hasFile('degree_leaving_tc')) 
                      {
                        $rules = ['degree_leaving_tc' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('degree_leaving_tc_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('dse_acap_document_upload');
                         }
                        $extension = $request->file('degree_leaving_tc')->getClientOriginalExtension();
                        $filenametostore = 'degree_leaving_tc_'.$dte_id.'.'.$extension;
                        $path = $request->file('degree_leaving_tc')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $dse_students->degree_leaving_tc_path = $filenametostore;
                              $dse_students->degree_leaving_tc = 'Yes';
                        $dse_students->save();
                       }
                        else
                        {
                              $dse_students->degree_leaving_tc='No';
                              $dse_students->save();
                        }
                 }
             elseif ($test_degree_leaving_tc=="no") {
                $dse_students->degree_leaving_tc='No';
              }
              elseif ($test_degree_leaving_tc== null) {
                $request->session()->flash('degree_leaving_tc_error', 'Please select an option');
                  return redirect()->route('dse_acap_document_upload');
              }
         }
      
       $test_equivalent_certi = $request->input('equivalent_certi');
        if($dse_students->equivalent_certi_path == null)
         {
              
                  if ($test_equivalent_certi=="yes") 
                  {
                      if($request->hasFile('equivalent_certi')) 
                      {
                        $rules = ['equivalent_certi' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('equivalent_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('dse_acap_document_upload');
                         }
                        $extension = $request->file('equivalent_certi')->getClientOriginalExtension();
                        $filenametostore = 'equivalent_certi_'.$dte_id.'.'.$extension;
                        $path = $request->file('equivalent_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $dse_students->equivalent_certi_path = $filenametostore;
                              $dse_students->equivalent_certi = 'Yes';
                        $dse_students->save();
                       }
                        else
                        {
                              $dse_students->equivalent_certi='No';
                              $dse_students->save();
                        }
                 }
             elseif ($test_equivalent_certi=="no") {
                $dse_students->equivalent_certi='No';
              }
              elseif ($test_equivalent_certi== null) {
                $request->session()->flash('equivalent_certi_error', 'Please select an option');
                  return redirect()->route('dse_acap_document_upload');
              }
         }

      $test_birth_certi = $request->input('birth_certi');
        if($dse_students->birth_certi_path == null)
         {
                  if ($test_birth_certi=="yes") 
              {
                      if($request->hasFile('birth_certi')) 
                      {
                        $rules = ['birth_certi' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('birth_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('dse_acap_document_upload');
                         }
                        $extension = $request->file('birth_certi')->getClientOriginalExtension();
                        $filenametostore = 'birth_certi_'.$dte_id.'.'.$extension;
                        $path = $request->file('birth_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $dse_students->birth_certi_path = $filenametostore;
                        $dse_students->birth_certi='Yes';
                        $dse_students->save();
                      }
                      else
                        {
                              $dse_students->birth_certi='No';
                              $dse_students->save();
                        }
             }
            elseif ($test_birth_certi=="no") {
                $dse_students->birth_certi='No';
              }
              elseif ($test_birth_certi== null) {
                $request->session()->flash('birth_certi_error', 'Please select an option');
                  return redirect()->route('dse_acap_document_upload');
              }
         }

      $test_domicile = $request->input('domicile');
        


        if($dse_students->domicile_path == null)
         {
                  if ($test_domicile=="yes") 
                  {
                      if($request->hasFile('domicile')) 
                      {
                        $rules = ['domicile' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('domicile_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('dse_acap_document_upload');
                         }
                        $extension = $request->file('domicile')->getClientOriginalExtension();
                        $filenametostore = 'domicile_'.$dte_id.'.'.$extension;
                        $path = $request->file('domicile')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $dse_students->domicile_path =$filenametostore;
                                $dse_students->domicile='Yes';
                        $dse_students->save();
                       }
                
                        else
                        {
                              $dse_students->domicile='No';
                              $dse_students->save();
                        }
                }
             elseif ($test_domicile=="no") {
                $dse_students->domicile='No';
              }
              elseif ($test_domicile== null) {
                $request->session()->flash('domicile_error', 'Please select an option');
                  return redirect()->route('dse_acap_document_upload');
              }
         }
     
     $test_proforma_o = $request->input('proforma_o');
       if($dse_students->proforma_o_path == null)
         {
                      if ($test_proforma_o=="yes") 
                  {
                          if($request->hasFile('proforma_o')) 
                          {
                                $rules = ['proforma_o' => 'mimes:pdf|max:1024'];
                                  $validator = Validator::make(Input::all() , $rules);
                                if ($validator->fails())
                                 {
                                  $request->session()->flash('proforma_o_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                  return redirect()->route('dse_acap_document_upload');
                                }
                            $extension = $request->file('proforma_o')->getClientOriginalExtension();
                            $filenametostore = 'proforma_o_'.$dte_id.'.'.$extension;
                            $path = $request->file('proforma_o')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $dse_students->proforma_o_path = $filenametostore;
                                    $dse_students->proforma_o='Yes';
                            $dse_students->save();
                            }
                            else
                            {
                                  $dse_students->proforma_o='No';
                                  $dse_students->save();
                            }
                 }
                  elseif ($test_proforma_o=="no") {
                    $dse_students->proforma_o='No';
                  }
                  elseif ($test_proforma_o=="na") {
                    $dse_students->proforma_o='Not Applicable';
                  }
                  elseif ($test_proforma_o== null) {
                    $request->session()->flash('proforma_o_error', 'Please select an option');
                      return redirect()->route('dse_acap_document_upload');
                  }
         }
       $test_retention = $request->input('retention');
       
       if($dse_students->retention_path == null)
         {
                      if ($test_retention=="yes") 
                  {
                          if($request->hasFile('retention')) 
                          {
                                    $rules = ['retention' => 'mimes:pdf|max:1024'];
                                      $validator = Validator::make(Input::all() , $rules);
                                    if ($validator->fails())
                                     {
                                      $request->session()->flash('retention_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                      return redirect()->route('dse_acap_document_upload');
                                     }
                                    $extension = $request->file('retention')->getClientOriginalExtension();
                                    $filenametostore = 'retention_'.$dte_id.'.'.$extension;
                                    $path = $request->file('retention')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                    $dse_students->retention_path = $filenametostore;
                                    $dse_students->retention='Yes';
                                    $dse_students->save();
                          }
                    
                           else
                            {
                                  $dse_students->retention='No';
                                  $dse_students->save();
                            }
                }
                elseif ($test_retention=="no") {
                    $dse_students->retention='No';
                  }
                  elseif ($test_retention=="na") {
                    $dse_students->retention='Not Applicable';
                  }
                  elseif ($test_retention== null) {
                    $request->session()->flash('retention_error', 'Please select an option');
                      return redirect()->route('dse_acap_document_upload');
                  }
         }

      $test_minority_affidavit = $request->input('minority_affidavit');
        if($dse_students->minority_affidavit_path == null)
         {
                  if ($test_minority_affidavit=="yes") 
              {
              if($request->hasFile('minority_affidavit')) 
              {
                        $rules = ['minority_affidavit' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('minority_affidavit_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('dse_acap_document_upload');
                         }
                        $extension = $request->file('minority_affidavit')->getClientOriginalExtension();
                        $filenametostore = 'minority_affidavit_'.$dte_id.'.'.$extension;
                        $path = $request->file('minority_affidavit')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $dse_students->minority_affidavit_path = $filenametostore;
                        $dse_students->minority_affidavit='Yes';
                        $dse_students->save();
                        }
                         else
                        {
                              $dse_students->minority_affidavit='No';
                              $dse_students->save();
                        }
              }
              elseif ($test_minority_affidavit=="no") {
                $dse_students->minority_affidavit='No';
              }
              elseif ($test_minority_affidavit=="na") {
                $dse_students->minority_affidavit='Not Applicable';
              }
              elseif ($test_minority_affidavit== null) {
                $request->session()->flash('minority_affidavit_error', 'Please select an option');
                  return redirect()->route('dse_acap_document_upload');
              }
         }
      
      $test_community_certi = $request->input('community_certi');
        if($dse_students->community_certi_path == null)
         {
                      if ($test_community_certi=="yes") 
                  {
                          if($request->hasFile('community_certi')) 
                          {
                            $rules = ['community_certi' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('community_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              return redirect()->route('dse_acap_document_upload');
                             }
                            $extension = $request->file('community_certi')->getClientOriginalExtension();
                            $filenametostore = 'community_certi_'.$dte_id.'.'.$extension;
                            $path = $request->file('community_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $dse_students->community_certi_path = $filenametostore;
                            $dse_students->community_certi='Yes';
                            $dse_students->save();
                            }
                             else
                            {
                                  $dse_students->community_certi='No';
                                  $dse_students->save();
                            }
                  }
                  elseif ($test_community_certi=="no") {
                    $dse_students->community_certi='No';
                  }
                  elseif ($test_community_certi=="na") {
                    $dse_students->community_certi='Not Applicable';
                  }
                  elseif ($test_community_certi== null) {
                    $request->session()->flash('community_certi_error', 'Please select an option');
                      return redirect()->route('dse_acap_document_upload');
                  } 
         }
   
      $test_retention = $request->input('retention');
        if($dse_students->retention_path == null)
         {
                      if ($test_retention=="yes") 
                  {
                          if($request->hasFile('retention')) 
                          {
                                    $rules = ['retention' => 'mimes:pdf|max:1024'];
                                      $validator = Validator::make(Input::all() , $rules);
                                    if ($validator->fails())
                                     {
                                      $request->session()->flash('retention_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                      return redirect()->route('dse_acap_document_upload');
                                     }
                                    $extension = $request->file('retention')->getClientOriginalExtension();
                                    $filenametostore = 'retention_'.$dte_id.'.'.$extension;
                                    $path = $request->file('retention')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                    $dse_students->retention_path = $filenametostore;
                                    $dse_students->retention='Yes';
                                    $dse_students->save();
                          }
                    
                           else
                            {
                                  $dse_students->retention='No';
                                  $dse_students->save();
                            }
                }
                elseif ($test_retention=="no") {
                    $dse_students->retention='No';
                  }
                  elseif ($test_retention=="na") {
                    $dse_students->retention='Not Applicable';
                  }
                  elseif ($test_retention== null) {
                    $request->session()->flash('retention_error', 'Please select an option');
                      return redirect()->route('dse_acap_document_upload');
                  }
         }

     $test_nationality_certi = $request->input('nationality_certi');
        if($dse_students->nationality_certi_path == null)
         {
                      if ($test_nationality_certi=="yes") 
                  {
                          if($request->hasFile('nationality_certi')) 
                          {
                                    $rules = ['nationality_certi' => 'mimes:pdf|max:1024'];
                                      $validator = Validator::make(Input::all() , $rules);
                                    if ($validator->fails())
                                     {
                                      $request->session()->flash('nationality_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                      return redirect()->route('dse_acap_document_upload');
                                     }
                                    $extension = $request->file('nationality_certi')->getClientOriginalExtension();
                                    $filenametostore = 'nationality_certi_'.$dte_id.'.'.$extension;
                                    $path = $request->file('nationality_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                    $dse_students->nationality_certi_path = $filenametostore;
                                    $dse_students->nationality_certi='Yes';
                                    $dse_students->save();
                          }
                    
                           else
                            {
                                  $dse_students->nationality_certi='No';
                                  $dse_students->save();
                            }
                }
                elseif ($test_nationality_certi=="no") {
                    $dse_students->nationality_certi='No';
                  }
                  elseif ($test_nationality_certi=="na") {
                    $dse_students->nationality_certi='Not Applicable';
                  }
                  elseif ($test_nationality_certi== null) {
                    $request->session()->flash('nationality_certi_error', 'Please select an option');
                      return redirect()->route('dse_acap_document_upload');
                  }
         }

      $user1 = DB::table('dse_students')->select('dte_id','fc_confirmation_receipt','fc_confirmation_receipt_path','dte_allotment_letter','dte_allotment_letter_path','arc_ackw_receipt','arc_ackw_receipt_path','ssc_marksheet','ssc_marksheet_path','hsc_diploma_marksheet','hsc_diploma_marksheet_path','degree_leaving_tc','degree_leaving_tc_path','first_year_marksheet','first_year_marksheet_path','second_year_marksheet','second_year_marksheet_path','third_year_marksheet','third_year_marksheet_path','fourth_year_marksheet','fourth_year_marksheet_path','migration_certi','migration_certi_path','birth_certi','birth_certi_path','domicile','domicile_path','proforma_o','proforma_o_path','retention','retention_path','minority_affidavit','minority_affidavit_path','gap_certi','gap_certi_path','community_certi','community_certi_path','caste_certi','caste_certi_path','caste_validity_certi','caste_validity_certi_path','equivalent_certi','equivalent_certi_path','non_creamy_layer_certi','non_creamy_layer_certi_path','proforma_a_b1_b2','proforma_a_b1_b2_path','income_certi','convocation_passing_certi','convocation_passing_certi_path','income_certi_path','proforma_c_d_e','proforma_c_d_e_path','anti_ragging_affidavit','anti_ragging_affidavit_path','medical_certi','medical_certi_path','nationality_certi','nationality_certi_path','photo','photo_path','signature','signature_path','is_document_completed')->where('dte_id', $dte_id)->get();
        $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        $hash = $hash[0]->hash;
         $course = $request->session()->get('log_course');
         list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
        if($user1[0]->photo ==  "Yes" && $user1[0]->signature == "Yes")
        {
            $dse_students->is_document_completed =1;
             $dse_students->save();
              $user1['prog_val']=7;
          $data['user1']=$user1;
          // return $user1;
    
        }
        elseif($user1[0]->photo ==  null || $user1[0]->signature == null)
        {
              $dse_students->is_document_completed =0;
             // return "hello";
             $dse_students->save();
        }

        $data=[];
        $data['user1']=$user1;
        $data['hash'] = $hash;
        return view('user.dse.acap_document_upload',$data);
    }
  

  


   public static function showdsefinalSubmit(Request $request)
    {
      $dte_id = $request->session()->get('log_dte_id',null);
        $course = $request->session()->get('log_course');
  
      if($dte_id != null)
        { $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          $prog_val = 0;
           $probar_per_count=0;

          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {
          if (DB::table('dse_students')->where('dte_id', $dte_id)->exists())
            {   $check = DB::table('dse_students')->select('is_personal_completed', 'is_guardian_completed', 'is_contact_completed', 'is_dte_details_completed', 'is_document_completed', 'is_academic_completed')->where('dte_id',$dte_id)->get();



            if(DB::table('admission')->where('dte_id', $dte_id)->exists())
            {
     list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
               $payment = DB::table('admission')->select('balance_amt')->where('dte_id',$dte_id)->get();
               
            }
           else{
            $array_object2 = [['balance_amt' => null]];
              if($dte_login[0]->dte_login == 1 ){
              list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
              if($userprogress[0]->is_payment_completed==0){
                return redirect('dse_admission_payment');
              }
            }
            if($acap_login[0]->acap_login == 1) {
              list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
              if($userprogress[0]->is_document_completed==0){
                return redirect('dse_acap_document_upload');
              }
              $user1['prog_val']=7;
            }
            $payment = json_decode(json_encode($array_object2));     
            }




          return view('user.dse.final_submit')->with('check',$check)->with('payment',$payment)->with('user1',$user1)->with('user1',$user1);

            }
          else
          {
            $array_object1 = [['is_personal_completed' => null, 'is_guardian_completed' => null, 'is_contact_completed' => null, 'is_dte_details_completed' => null, 'is_document_completed' => null, 'is_academic_completed' => null, 'is_payment_completed' => null]];
            $check = json_decode(json_encode($array_object1));
            $array_object2 = [['balance_amt' => null]];
            $payment = json_decode(json_encode($array_object2));



            return view('user.dse.final_submit')->with('check',$check)->with('payment',$payment);

          }      
        }
        else
              return redirect()->route('dse_profile');
          }
      else
          return redirect()->route('logout');  
    }

    public static function postdsefinalSubmit(Request $request)
    {
     $dte_id = $request->session()->get('log_dte_id');
     $course = $request->session()->get('log_course');
     $log_acap = $request->session()->get('log_acap');
     $log_dte = $request->session()->get('log_dte');
     if($log_acap == null)
        $event = "DTE";
      if($log_dte == null)
        $event = "ACAP";
        
      DB::select("call insert_status_details_submitted('$dte_id','$event','$course')");
      return redirect()->route('dse_profile');
    }



  public static function showfeWelcome(Request $request)
    {
    return view('user.fe.welcome');
    }

 
public static function showmcaChangePassword(Request $request)
  {
    return view('user.mca.change_password');
  }
  public static function submitmcaChangePassword(Request $request)
  {
    $pass = $request->input('oldPassword');
   // return $pass;
    $password = $request->input('password');
    $cnf_password=$request->input('password_confirmation');

      if($password!=$cnf_password){
            $request->session()->flash('error','Password does not match');
            return redirect()->route('mca_change_password'); 
    }
    if($password==null || $pass==null || $cnf_password==null){
            $request->session()->flash('error','Please fill your password details');
            return redirect()->route('mca_change_password');
      }
    $password = Hash::make($password);
    //return $password;
    $dte_id = $request->session()->get('log_dte_id');
    //return $dte_id;
    $user = DB::table('student_login')->select('stud_pwd')->where('dte_id', $dte_id)->get();
   if (Hash::check($pass, $user[0]->stud_pwd))
   {
      DB::table('student_login')->where('dte_id', $dte_id)->update(['stud_pwd' => $password]);
      return redirect()->route('mca_profile');
      }
      else
      {
          $request->session()->flash('error','Enter Correct Old Password ');
           return redirect()->route('mca_change_password');
      }
  }

   public static function showMcaAcapFormPayment(Request $request)
    {
    return view('user.mca.acap_form_payment');
    }

  public static function showmcaDocumentUpload(Request $request)
    {
        $dte_id = $request->session()->get('log_dte_id');
        $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          //$path =  DB::table('me_students')->select('photo_path')->where('dte_id', $dte_id)->get();
          
          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {
       if (DB::table('mca_students')->where('dte_id', $dte_id)->exists())
        {
        $user1 = DB::table('mca_students')->select('dte_id','fc_confirmation_receipt','fc_confirmation_receipt_path','dte_allotment_letter','dte_allotment_letter_path','arc_ackw_receipt','arc_ackw_receipt_path','cet_result','cet_result_path','ssc_marksheet','ssc_marksheet_path','hsc_diploma_marksheet','hsc_diploma_marksheet_path','degree_leaving_tc','degree_leaving_tc_path','first_year_marksheet','first_year_marksheet_path','second_year_marksheet','convocation_passing_certi','convocation_passing_certi_path','second_year_marksheet_path','third_year_marksheet','third_year_marksheet_path','migration_certi','migration_certi_path','birth_certi','birth_certi_path','domicile','domicile_path','proforma_o','proforma_o_path','retention','retention_path','minority_affidavit','minority_affidavit_path','gap_certi','gap_certi_path','community_certi','community_certi_path','caste_certi','caste_certi_path','caste_validity_certi','caste_validity_certi_path','non_creamy_layer_certi','non_creamy_layer_certi_path','proforma_a_b1_b2','proforma_a_b1_b2_path','income_certi','income_certi_path','proforma_c_d_e','proforma_c_d_e_path','proforma_v','proforma_v_path','proforma_u','proforma_u_path','anti_ragging_affidavit','anti_ragging_affidavit_path','medical_certi','medical_certi_path','photo','photo_path','signature','signature_path','is_document_completed')->where('dte_id', $dte_id)->get();
        $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        $hash = $hash[0]->hash;
       

        }
        else
        {
        $array_object = [['dte_id'=> $dte_id,'is_document_completed'=>0,'fc_confirmation_receipt' => 'No', 'fc_confirmation_receipt_path' => null, 'dte_allotment_letter' => 'No', 'dte_allotment_letter_path' => null, 'arc_ackw_receipt' => 'No', 'arc_ackw_receipt_path' => null, 'cet_result' => 'No', 'cet_result_path' => null, 'ssc_marksheet' => 'No','ssc_marksheet_path' => null,  'hsc_diploma_marksheet' => 'No','hsc_diploma_marksheet_path' => null,  'degree_leaving_tc' => 'No', 'degree_leaving_tc_path' => null, 'degree_leaving_tc_path' => null,  'first_year_marksheet' => 'No', 'first_year_marksheet_path' => null, 'second_year_marksheet' => 'No', 'second_year_marksheet_path' => null, 'third_year_marksheet' => 'No', 'third_year_marksheet_path' => null,'convocation_passing_certi'=>'No','convocation_passing_certi_path'=>null, 'migration_certi' => 'No', 'migration_certi_path' => null, 'birth_certi' => 'No', 'birth_certi_path' => null, 'domicile' => 'No', 'domicile_path' => null, 'proforma_o' => 'No', 'proforma_o_path' => null, 'retention' => 'No', 'retention_path' => null, 'minority_affidavit' => 'No', 'minority_affidavit_path' => null, 'gap_certi' => 'No', 'gap_certi_path' => null, 'community_certi' => 'No', 'community_certi_path' => null, 'caste_certi' => 'No', 'caste_certi_path' => null, 'caste_validity_certi' => 'No', 'caste_validity_certi_path' => null, 'non_creamy_layer_certi' => 'No', 'non_creamy_layer_certi_path' => null, 'proforma_a_b1_b2' => 'No', 'proforma_a_b1_b2_path' => null, 'income_certi' => 'No', 'income_certi_path' => null, 'proforma_c_d_e' => 'No', 'proforma_c_d_e_path' => null,'proforma_v'=> null,'proforma_v_path'=> null,'proforma_u'=> null,'proforma_u_path'=> null,'anti_ragging_affidavit' => 'No', 'anti_ragging_affidavit_path' => null, 'medical_certi' => 'No', 'medical_certi_path' => null, 'photo' => 'No','photo_path' => null, 'signature' => 'No', 'signature_path' => null]];
        $user1 = json_decode(json_encode($array_object));
        $hash = null;
        }
      // return $user1;
     $course = $request->session()->get('log_course');
list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
if($userprogress[0]->is_contact_completed ==0){
return redirect('mca_contact_details');
}

        $data=[];
        if ($acap_login[0]->acap_login == 1) {       
        if($userprogress[0]->is_document_completed==1){
          $user1['prog_val']=7;
          $data['user1']=$user1;
          // return 'done';
        }
      }
        $data['user1']=$user1;
        $data['hash']=$hash;
        //$photo_path = 'storage'.$user1;
        return view('user.mca.document_upload',$data);

      }
       else
              return redirect()->route('mca_profile');
          
    }






    public static function uploadmcaDocumentUpload(Request $request)
    {

      
      /* $request->validate([
        'ssc_marksheet','hsc_marksheet','hsc_leaving_certi','first_year_marksheet','second_year_marksheet','third_year_marksheet','fourth_year_marksheet','convocational_certi','birth_certi','domicile_certi','proforma_o','retention_certi','minority_affidavit','gap_certi','community_certi','cast_certi','caste_validity_certi','non_creamy_layer_certi','proforma_h','proforma_a_b1_b2','proforma_f_f1','income_certi','proforma_j_k_l','medical_certi' => 'mimes:pdf|max:1024'
        ]);*/

      $dte_id=$request->session()->get('log_dte_id'); 
      $use = DB::table('student_login')->select('hash')->where('dte_id', $dte_id)->get();
      $destinationPath = $dte_id.'_'.$use[0]->hash;
      //  $abc=(int)$request->hasFile('ssc_marksheet');
        $mca_students = new mca_students;
        if(DB::table('mca_students')->where('dte_id', $dte_id)->exists()) 
          { 
           $mca_students  = mca_students::find($dte_id);
          }
          else
          {
            $mca_students->dte_id = $dte_id;
          }

          $test_photo = $request->input('photo');
       //  return $mca_students->photo_path;
         if($mca_students->photo_path == null)
         {
                  if ($test_photo=="yes") 
                  {
                       if($request->hasFile('photo'))
                      {
                            $rules = ['photo' => 'mimes:jpg,png,jpeg'];
                             $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('photo_error', 'Please Upload Only JPG or PNG type image. File size should be less than 1 mb.');
                              return redirect()->route('mca_document_upload');
                             }
                            $extension = $request->file('photo')->getClientOriginalExtension();
                            $filenametostore = 'photo'.$dte_id.'.'.$extension;
                    
                            $path =  $request->file('photo')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $mca_students->photo_path = $filenametostore;
                            $mca_students->photo='Yes';
                            $mca_students->save();
                      }
                      else
                        {
                              $mca_students->photo='No';
                              $mca_students->save();
                        }
                 }
                  elseif ($test_photo=="no") {
                    $mca_students->photo='No';
                  }
                  elseif ($test_photo== null) {
                    $request->session()->flash('photo_error', 'Please select an option');
                      return redirect()->route('mca_document_upload');
                  }
          
         }

      $test_signature = $request->input('signature');
    //  return $test_signature;
    
    if($mca_students->signature_path == null)
         {
                  if ($test_signature=="yes") 
                  {
                        if($request->hasFile('signature'))
                        {
                                $rules = ['signature' => 'mimes:jpg,png,jpeg'];
                                  $validator = Validator::make(Input::all() , $rules);
                                if ($validator->fails())
                                 {
                                  $request->session()->flash('signature_error', 'Please Upload Only JPG or PNG type image. File size should be less than 1 mb.');
                                  return redirect()->route('mca_document_upload');
                                 }
                                $extension = $request->file('signature')->getClientOriginalExtension();
                                $filenametostore = 'signature'.$dte_id.'.'.$extension;
                                $path = $request->file('signature')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                  $mca_students->signature_path = $filenametostore;
                                   $mca_students->signature='Yes';
                                $mca_students->save();
                        }
                               else
                                {
                                      $mca_students->signature='No';
                                      $mca_students->save();
                                }
                 }
                  elseif ($test_signature=="no") {
                    $mca_students->signature='No';
                  }
                  elseif ($test_signature== null) {
                    $request->session()->flash('signature_error', 'Please select an option');
                      return redirect()->route('mca_document_upload');
                  }
         }

      $test_fc_confirmation_receipt = $request->input('fc_confirmation_receipt');
      //return $test_fc_confirmation_receipt;
       if($mca_students->fc_confirmation_receipt_path == null)
         {
      
              if ($test_fc_confirmation_receipt=="yes") 
              {
                 if($request->hasFile('fc_confirmation_receipt'))
                 { 
                        $rules = ['fc_confirmation_receipt' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('fc_confirmation_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('mca_document_upload');
                         }
                        $extension = $request->file('fc_confirmation_receipt')->getClientOriginalExtension();
                        $filenametostore = 'fc_confirmation_receipt'.$dte_id.'.'.$extension;
                        $path = $request->file('fc_confirmation_receipt')->storeAs($destinationPath, $filenametostore,'public_uploads');
                          $mca_students->fc_confirmation_receipt_path =$filenametostore;
                           $mca_students->fc_confirmation_receipt='Yes';
                        $mca_students->save();
                }
                  else
                    {
                          $mca_students->fc_confirmation_receipt='No';
                          $mca_students->save();
                    }
             }
             elseif ($test_fc_confirmation_receipt=="no") {
                $mca_students->fc_confirmation_receipt='No';
              }
              elseif ($test_fc_confirmation_receipt== null) {
                $request->session()->flash('fc_confirmation_error', 'Please select an option');
                  return redirect()->route('mca_document_upload');
              }

         }

         
      $test_dte_allotment_letter = $request->input('dte_allotment_letter');
      if($mca_students->dte_allotment_letter_path == null)
         {
              if ($test_dte_allotment_letter=="yes") 
              {
                  if($request->hasFile('dte_allotment_letter'))
                {
                        $rules = ['dte_allotment_letter' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('dte_allotment_letter_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('mca_document_upload');
                         }
                        $extension = $request->file('dte_allotment_letter')->getClientOriginalExtension();
                        $filenametostore = 'dte_allotment_letter_'.$dte_id.'.'.$extension;
                   
                        $path = $request->file('dte_allotment_letter')->storeAs($destinationPath, $filenametostore,'public_uploads');
                              $mca_students->dte_allotment_letter_path = $filenametostore;
                               $mca_students->dte_allotment_letter='Yes';
                        $mca_students->save();
                 }
    
               else
                {
                      $mca_students->dte_allotment_letter='No';
                      $mca_students->save();
                }
               }
              elseif ($test_dte_allotment_letter=="no") {
                $mca_students->dte_allotment_letter='No';
              }
              elseif ($test_dte_allotment_letter== null) {
                $request->session()->flash('dte_allotment_letter_error', 'Please select an option');
                  return redirect()->route('mca_document_upload');
              }
         }

      $test_arc_ackw_receipt = $request->input('arc_ackw_receipt');
      
      if($mca_students->arc_ackw_receipt_path == null)
         {
              if ($test_arc_ackw_receipt=="yes") 
              {
                    if($request->hasFile('arc_ackw_receipt'))
                      {
                        $rules = ['arc_ackw_receipt' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('arc_ackw_receipt_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('mca_document_upload');
                         }
                        $extension = $request->file('arc_ackw_receipt')->getClientOriginalExtension();
                        $filenametostore = 'arc_ackw_receipt_'.$dte_id.'.'.$extension;
                   
                        $path = $request->file('arc_ackw_receipt')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $mca_students->arc_ackw_receipt_path = $filenametostore;
                        $mca_students->arc_ackw_receipt='Yes';
                        $mca_students->save();
                      }
                
                       else
                        {
                              $mca_students->arc_ackw_receipt='No';
                              $mca_students->save();
                        }
             }
             elseif ($test_arc_ackw_receipt=="no") {
                 $mca_students->arc_ackw_receipt='No';
             }
              elseif ($test_arc_ackw_receipt== null) {
                $request->session()->flash('arc_ackw_receipt_error', 'Please select an option');
                  return redirect()->route('mca_document_upload');
              }
    }

        $test_cet_result = $request->input('cet_result');
        //return $test_cet_result;
        if($mca_students->cet_result_path == null)
         {
                  if ($test_cet_result=="yes") 
                  {
                      if($request->hasFile('cet_result'))
                          {
                            $rules = ['cet_result' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('cet_result_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              return redirect()->route('mca_document_upload');
                             }
                            $extension = $request->file('cet_result')->getClientOriginalExtension();
                            $filenametostore = 'cet_result_'.$dte_id.'.'.$extension;
                       
                            $path = $request->file('cet_result')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $mca_students->cet_result_path = $filenametostore;
                            $mca_students->cet_result = 'Yes';
                            $mca_students->save();
                          }
                          else
                            {
                                  $mca_students->cet_result='No';
                                  $mca_students->save();
                            }
            }
            elseif ($test_cet_result=="no") {
                $mca_students->cet_result='No';
              }
              elseif ($test_cet_result== null) {
                $request->session()->flash('cet_result_error', 'Please select an option');
                  return redirect()->route('mca_document_upload');
              }

         }
      $test_ssc_marksheet = $request->input('ssc_marksheet');
      if($mca_students->ssc_marksheet_path == null)
         {
                      if ($test_ssc_marksheet=="yes") 
                      {
                            if($request->hasFile('ssc_marksheet')) 
                            {
                              $rules = ['ssc_marksheet' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('ssc_marksheet_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              return redirect()->route('mca_document_upload');
                             }
                      
                               //get file extension
                            $extension = $request->file('ssc_marksheet')->getClientOriginalExtension();
                            
                            //filename to store
                            $filenametostore = 'ssc_marksheet_'.$dte_id.'.'.$extension;
                            
                            //Upload File
                            $path = $request->file('ssc_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                     $mca_students->ssc_marksheet_path = $filenametostore;
                                      $mca_students->ssc_marksheet = 'Yes';
                            $mca_students->save();
                          }
                          else
                            {
                                  $mca_students->ssc_marksheet='No';
                                  $mca_students->save();
                            }
                }
                elseif ($test_ssc_marksheet=="no") {
                    $mca_students->ssc_marksheet='No';
                  }
                  elseif ($test_ssc_marksheet== null) {
                    $request->session()->flash('ssc_marksheet_error', 'Please select an option');
                      return redirect()->route('mca_document_upload');
                  }
         }
         
      $test_hsc_marksheet = $request->input('hsc_marksheet');
       if($mca_students->hsc_diploma_marksheet_path == null)
         {
                          if ($test_hsc_marksheet=="yes") 
                          {
                                  if($request->hasFile('hsc_marksheet')) 
                                  {
                                    $rules = ['hsc_marksheet' => 'mimes:pdf|max:1024'];
                                      $validator = Validator::make(Input::all() , $rules);
                                    if ($validator->fails())
                                     {
                                      $request->session()->flash('hsc_marksheet_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                      return redirect()->route('mca_document_upload');
                                     }
                                    $extension = $request->file('hsc_marksheet')->getClientOriginalExtension();
                                    $filenametostore = 'hsc_diploma_marksheet'.$dte_id.'.'.$extension;
                                    $path = $request->file('hsc_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                    $mca_students->hsc_diploma_marksheet_path = $filenametostore;
                                     $mca_students->hsc_diploma_marksheet='Yes';
                                    $mca_students->save();
                                  }
                                  else
                                    {
                                          $mca_students->hsc_diploma_marksheet='No';
                                          $mca_students->save();
                                    }
                    }
                    elseif ($test_hsc_marksheet=="no") {
                        $mca_students->hsc_diploma_marksheet='No';
                      }
                      elseif ($test_hsc_marksheet== null) {
                        $request->session()->flash('hsc_marksheet_error', 'Please select an option');
                          return redirect()->route('mca_document_upload');
                      }
         }           
      $test_degree_leaving_tc = $request->input('degree_leaving_tc');
      if($mca_students->degree_leaving_tc_path == null)
         {
              
                  if ($test_degree_leaving_tc=="yes") 
                  {
                      if($request->hasFile('degree_leaving_tc')) 
                      {
                        $rules = ['degree_leaving_tc' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('degree_leaving_tc_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('mca_document_upload');
                         }
                        $extension = $request->file('degree_leaving_tc')->getClientOriginalExtension();
                        $filenametostore = 'degree_leaving_tc_'.$dte_id.'.'.$extension;
                        $path = $request->file('degree_leaving_tc')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $mca_students->degree_leaving_tc_path = $filenametostore;
                              $mca_students->degree_leaving_tc = 'Yes';
                        $mca_students->save();
                       }
                        else
                        {
                              $mca_students->degree_leaving_tc='No';
                              $mca_students->save();
                        }
                 }
             elseif ($test_degree_leaving_tc=="no") {
                $mca_students->degree_leaving_tc='No';
              }
              elseif ($test_degree_leaving_tc== null) {
                $request->session()->flash('degree_leaving_tc_error', 'Please select an option');
                  return redirect()->route('mca_document_upload');
              }
         }


      $test_first_year_marksheet = $request->input('first_year_marksheet');
     if($mca_students->first_year_marksheet_path == null)
         {
                      if ($test_first_year_marksheet=="yes") 
                      {
                              if($request->hasFile('first_year_marksheet')) 
                              {
                                $rules = ['first_year_marksheet' => 'mimes:pdf|max:1024'];
                                  $validator = Validator::make(Input::all() , $rules);
                                if ($validator->fails())
                                 {
                                  $request->session()->flash('first_year_marksheet_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                  return redirect()->route('mca_document_upload');
                                 }
                                $extension = $request->file('first_year_marksheet')->getClientOriginalExtension();
                                $filenametostore = 'first_year_marksheet_'.$dte_id.'.'.$extension;
                                $path = $request->file('first_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                $mca_students->first_year_marksheet_path = $filenametostore;
                                   $mca_students->first_year_marksheet = 'Yes';
                                $mca_students->save();
                                }
                                else
                                {
                                      $mca_students->first_year_marksheet='No';
                                      $mca_students->save();
                                }
                       }
            
                 elseif ($test_first_year_marksheet=="no") {
                    $mca_students->first_year_marksheet='No';
                  }
                  elseif ($test_first_year_marksheet== null) {
                    $request->session()->flash('first_year_marksheet_error', 'Please select an option');
                      return redirect()->route('mca_document_upload');
                  }
         }
      
      $test_second_year_marksheet = $request->input('second_year_marksheet');
      if($mca_students->second_year_marksheet_path == null)
         {
                  if ($test_second_year_marksheet=="yes") 
                  {
                          if($request->hasFile('second_year_marksheet')) 
                          {
                            $rules = ['second_year_marksheet' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('second_year_marksheet_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              return redirect()->route('mca_document_upload');
                             }
                            $extension = $request->file('second_year_marksheet')->getClientOriginalExtension();
                            $filenametostore = 'second_year_marksheet_'.$dte_id.'.'.$extension;
                            $path = $request->file('second_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $mca_students->second_year_marksheet_path = $filenametostore;
                                    $mca_students->second_year_marksheet='Yes';
                            $mca_students->save();
                            }
                             else
                            {
                                  $mca_students->second_year_marksheet='No';
                                  $mca_students->save();
                            }
                }
              elseif ($test_second_year_marksheet=="no") {
                $mca_students->second_year_marksheet='No';
              }
              elseif ($test_second_year_marksheet== null) {
                $request->session()->flash('second_year_marksheet_error', 'Please select an option');
                  return redirect()->route('mca_document_upload');
              }
              
         }
         

      $test_third_year_marksheet = $request->input('third_year_marksheet');
        if($mca_students->third_year_marksheet_path == null)
         {
                  if ($test_third_year_marksheet=="yes") 
                  {
                      if($request->hasFile('third_year_marksheet')) 
                      {
                        $rules = ['third_year_marksheet' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('third_year_marksheet_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('mca_document_upload');
                         }
                        $extension = $request->file('third_year_marksheet')->getClientOriginalExtension();
                        $filenametostore = 'third_year_marksheet_'.$dte_id.'.'.$extension;
                        $path = $request->file('third_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $mca_students->third_year_marksheet_path =$filenametostore;
                            $mca_students->third_year_marksheet='Yes';
                        $mca_students->save();
                        }
                         else
                        {
                              $mca_students->third_year_marksheet='No';
                              $mca_students->save();
                        }
                 }
              elseif ($test_third_year_marksheet=="no") {
                $mca_students->third_year_marksheet='No';
              }
              elseif ($test_third_year_marksheet== null) {
                $request->session()->flash('third_year_marksheet_error', 'Please select an option');
                  return redirect()->route('mca_document_upload');
              }

      
         }

      $test_convocation_passing_certi = $request->input('convocation_passing_certi');
       if($mca_students->convocation_passing_certi_path == null)
         {
                  if ($test_convocation_passing_certi=="yes") 
                  {
                      if($request->hasFile('convocation_passing_certi')) 
                      {
                        $rules = ['convocation_passing_certi' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('convocation_passing_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('mca_document_upload');
                         }
                        $extension = $request->file('convocation_passing_certi')->getClientOriginalExtension();
                        $filenametostore = 'convocation_passing_certi_'.$dte_id.'.'.$extension;
                        $path = $request->file('convocation_passing_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $mca_students->convocation_passing_certi_path = $filenametostore;
                                $mca_students->convocation_passing_certi='Yes';
                        $mca_students->save();
                      }
                      else
                        {
                              $mca_students->convocation_passing_certi='No';
                              $mca_students->save();
                        }
                }
            elseif ($test_convocation_passing_certi=="no") {
                $mca_students->convocation_passing_certi='No';
              }
              elseif ($test_convocation_passing_certi== null) {
                $request->session()->flash('convocation_passing_certi_error', 'Please select an option');
                  return redirect()->route('mca_document_upload');
              }
         }

      
      $test_migration_certi = $request->input('migration_certi');
      if($mca_students->migration_certi_path == null)
         {
                      if ($test_migration_certi=="yes") 
                  {
                  if($request->hasFile('migration_certi')) 
                  {
                    $rules = ['migration_certi' => 'mimes:pdf|max:1024'];
                      $validator = Validator::make(Input::all() , $rules);
                    if ($validator->fails())
                     {
                      $request->session()->flash('migration_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                      return redirect()->route('mca_document_upload');
                     }
                    $extension = $request->file('migration_certi')->getClientOriginalExtension();
                   $filenametostore = 'migration_certi_'.$dte_id.'.'.$extension;
                    $path = $request->file('migration_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                    $mca_students->migration_certi_path = $filenametostore;
                            $mca_students->migration_certi='Yes';
                    $mca_students->save();
                  }
                  else
                    {
                          $mca_students->migration_certi='No';
                          $mca_students->save();
                    }
                }
                elseif ($test_migration_certi=="no") {
                    $mca_students->migration_certi='No';
                  }
                  elseif ($test_migration_certi== null) {
                    $request->session()->flash('migration_certi_error', 'Please select an option');
                      return redirect()->route('mca_document_upload');
                  }
         }

      $test_birth_certi = $request->input('birth_certi');
     if($mca_students->birth_certi_path == null)
         {
                  if ($test_birth_certi=="yes") 
              {
                      if($request->hasFile('birth_certi')) 
                      {
                        $rules = ['birth_certi' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('birth_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('mca_document_upload');
                         }
                        $extension = $request->file('birth_certi')->getClientOriginalExtension();
                        $filenametostore = 'birth_certi_'.$dte_id.'.'.$extension;
                        $path = $request->file('birth_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $mca_students->birth_certi_path = $filenametostore;
                        $mca_students->birth_certi='Yes';
                        $mca_students->save();
                      }
                      else
                        {
                              $mca_students->birth_certi='No';
                              $mca_students->save();
                        }
             }
            elseif ($test_birth_certi=="no") {
                $mca_students->birth_certi='No';
              }
              elseif ($test_birth_certi== null) {
                $request->session()->flash('birth_certi_error', 'Please select an option');
                  return redirect()->route('mca_document_upload');
              }
         }
      $test_domicile = $request->input('domicile');
      if($mca_students->domicile_path == null)
         {
                  if ($test_domicile=="yes") 
                  {
                      if($request->hasFile('domicile')) 
                      {
                        $rules = ['domicile' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('domicile_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('mca_document_upload');
                         }
                        $extension = $request->file('domicile')->getClientOriginalExtension();
                        $filenametostore = 'domicile_'.$dte_id.'.'.$extension;
                        $path = $request->file('domicile')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $mca_students->domicile_path =$filenametostore;
                                $mca_students->domicile='Yes';
                        $mca_students->save();
                       }
                
                        else
                        {
                              $mca_students->domicile='No';
                              $mca_students->save();
                        }
                }
             elseif ($test_domicile=="no") {
                $mca_students->domicile='No';
              }
              elseif ($test_domicile== null) {
                $request->session()->flash('domicile_error', 'Please select an option');
                  return redirect()->route('mca_document_upload');
              }
         }
     $test_proforma_o = $request->input('proforma_o');
           if($mca_students->proforma_o_path == null)
         {
                      if ($test_proforma_o=="yes") 
                  {
                          if($request->hasFile('proforma_o')) 
                          {
                                $rules = ['proforma_o' => 'mimes:pdf|max:1024'];
                                  $validator = Validator::make(Input::all() , $rules);
                                if ($validator->fails())
                                 {
                                  $request->session()->flash('proforma_o_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                  return redirect()->route('mca_document_upload');
                                }
                            $extension = $request->file('proforma_o')->getClientOriginalExtension();
                            $filenametostore = 'proforma_o_'.$dte_id.'.'.$extension;
                            $path = $request->file('proforma_o')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $mca_students->proforma_o_path = $filenametostore;
                                    $mca_students->proforma_o='Yes';
                            $mca_students->save();
                            }
                            else
                            {
                                  $mca_students->proforma_o='No';
                                  $mca_students->save();
                            }
                 }
                  elseif ($test_proforma_o=="no") {
                    $mca_students->proforma_o='No';
                  }
                  elseif ($test_proforma_o=="na") {
                    $mca_students->proforma_o='Not Applicable';
                  }
                  elseif ($test_proforma_o== null) {
                    $request->session()->flash('proforma_o_error', 'Please select an option');
                      return redirect()->route('mca_document_upload');
                  }
         }
       $test_retention = $request->input('retention');
       
       if($mca_students->retention_path == null)
         {
                      if ($test_retention=="yes") 
                  {
                          if($request->hasFile('retention')) 
                          {
                                    $rules = ['retention' => 'mimes:pdf|max:1024'];
                                      $validator = Validator::make(Input::all() , $rules);
                                    if ($validator->fails())
                                     {
                                      $request->session()->flash('retention_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                      return redirect()->route('mca_document_upload');
                                     }
                                    $extension = $request->file('retention')->getClientOriginalExtension();
                                    $filenametostore = 'retention_'.$dte_id.'.'.$extension;
                                    $path = $request->file('retention')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                    $mca_students->retention_path = $filenametostore;
                                    $mca_students->retention='Yes';
                                    $mca_students->save();
                          }
                    
                           else
                            {
                                  $mca_students->retention='No';
                                  $mca_students->save();
                            }
                }
                elseif ($test_retention=="no") {
                    $mca_students->retention='No';
                  }
                  elseif ($test_retention=="na") {
                    $mca_students->retention='Not Applicable';
                  }
                  elseif ($test_retention== null) {
                    $request->session()->flash('retention_error', 'Please select an option');
                      return redirect()->route('mca_document_upload');
                  }
         }

      $test_minority_affidavit = $request->input('minority_affidavit');
      if($mca_students->minority_affidavit_path == null)
         {
                  if ($test_minority_affidavit=="yes") 
              {
              if($request->hasFile('minority_affidavit')) 
              {
                        $rules = ['minority_affidavit' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('minority_affidavit_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('mca_document_upload');
                         }
                        $extension = $request->file('minority_affidavit')->getClientOriginalExtension();
                        $filenametostore = 'minority_affidavit_'.$dte_id.'.'.$extension;
                        $path = $request->file('minority_affidavit')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $mca_students->minority_affidavit_path = $filenametostore;
                        $mca_students->minority_affidavit='Yes';
                        $mca_students->save();
                        }
                         else
                        {
                              $mca_students->minority_affidavit='No';
                              $mca_students->save();
                        }
              }
              elseif ($test_minority_affidavit=="no") {
                $mca_students->minority_affidavit='No';
              }
              elseif ($test_minority_affidavit=="na") {
                $mca_students->minority_affidavit='Not Applicable';
              }
              elseif ($test_minority_affidavit== null) {
                $request->session()->flash('minority_affidavit_error', 'Please select an option');
                  return redirect()->route('mca_document_upload');
              }
         }

      $test_gap_certi = $request->input('gap_certi');
       if($mca_students->gap_certi_path == null)
         {
                  if ($test_gap_certi=="yes") 
              {
                          if($request->hasFile('gap_certi')) 
                          {
                                $rules = ['gap_certi' => 'mimes:pdf|max:1024'];
                                  $validator = Validator::make(Input::all() , $rules);
                                if ($validator->fails())
                                 {
                                  $request->session()->flash('gap_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                  return redirect()->route('mca_document_upload');
                                 }
                                $extension = $request->file('gap_certi')->getClientOriginalExtension();
                                $filenametostore = 'gap_certi_'.$dte_id.'.'.$extension;
                                $path = $request->file('gap_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                $mca_students->gap_certi_path =$filenametostore;
                                $mca_students->gap_certi='Yes';
                                $mca_students->save();
                            }
                                else
                                {
                                      $mca_students->gap_certi='No';
                                      $mca_students->save();
                                }
            }
              elseif ($test_gap_certi=="no") {
                $mca_students->gap_certi='No';
              }
              elseif ($test_gap_certi=="na") {
                $mca_students->gap_certi='Not Applicable';
              }
              elseif ($test_gap_certi== null) {
                $request->session()->flash('gap_certi_error', 'Please select an option');
                  return redirect()->route('mca_document_upload');
              }
         }
      $test_community_certi = $request->input('community_certi');
      
      if($mca_students->community_certi_path == null)
         {
                      if ($test_community_certi=="yes") 
                  {
                          if($request->hasFile('community_certi')) 
                          {
                            $rules = ['community_certi' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('community_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              return redirect()->route('mca_document_upload');
                             }
                            $extension = $request->file('community_certi')->getClientOriginalExtension();
                            $filenametostore = 'community_certi_'.$dte_id.'.'.$extension;
                            $path = $request->file('community_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $mca_students->community_certi_path = $filenametostore;
                            $mca_students->community_certi='Yes';
                            $mca_students->save();
                            }
                             else
                            {
                                  $mca_students->community_certi='No';
                                  $mca_students->save();
                            }
                  }
                  elseif ($test_community_certi=="no") {
                    $mca_students->community_certi='No';
                  }
                  elseif ($test_community_certi=="na") {
                    $mca_students->community_certi='Not Applicable';
                  }
                  elseif ($test_community_certi== null) {
                    $request->session()->flash('community_certi_error', 'Please select an option');
                      return redirect()->route('mca_document_upload');
                  } 
         }
      $test_caste_certi = $request->input('caste_certi');
      
      if($mca_students->caste_certi_path == null)
         {
                      if ($test_caste_certi=="yes") 
                  {
                          if($request->hasFile('caste_certi')) 
                          {
                            $rules = ['caste_certi' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('caste_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              return redirect()->route('mca_document_upload');
                             }
                            $extension = $request->file('caste_certi')->getClientOriginalExtension();
                            $filenametostore = 'caste_certi_'.$dte_id.'.'.$extension;
                            $path = $request->file('caste_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $mca_students->caste_certi_path =$filenametostore;
                            $mca_students->caste_certi='Yes';
                            $mca_students->save();
                           }
                            else
                            {
                                  $mca_students->caste_certi='No';
                                  $mca_students->save();
                            }
                 }
                 elseif ($test_caste_certi=="no") {
                    $mca_students->caste_certi='No';
                  }
                  elseif ($test_caste_certi=="na") {
                    $mca_students->caste_certi='Not Applicable';
                  }
                  elseif ($test_caste_certi== null) {
                    $request->session()->flash('caste_certi_error', 'Please select an option');
                      return redirect()->route('mca_document_upload');
                  }
         }

      $test_caste_validity_certi = $request->input('caste_validity_certi');
      if($mca_students->caste_validity_certi_path == null)
         {
                  if ($test_caste_validity_certi=="yes") 
              {
                      if($request->hasFile('caste_validity_certi')) 
                      {
                        $rules = ['caste_validity_certi' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('caste_validity_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('mca_document_upload');
                         }
                        $extension = $request->file('caste_validity_certi')->getClientOriginalExtension();
                        $filenametostore = 'caste_validity_certi_'.$dte_id.'.'.$extension;
                        $path = $request->file('caste_validity_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $mca_students->caste_validity_certi_path = $filenametostore;
                        $mca_students->caste_validity_certi='Yes';
                        $mca_students->save();
                       }
                       else
                        {
                              $mca_students->caste_validity_certi='No';
                              $mca_students->save();
                        }
             }
             elseif ($test_caste_validity_certi=="no") {
                $mca_students->caste_validity_certi='No';
              }
              elseif ($test_caste_validity_certi=="na") {
                $mca_students->caste_validity_certi='Not Applicable';
              }
              elseif ($test_caste_validity_certi== null) {
                $request->session()->flash('caste_validity_certi_error', 'Please select an option');
                  return redirect()->route('mca_document_upload');
              }
         }
      $test_non_creamy_layer_certi = $request->input('non_creamy_layer_certi');
       if($mca_students->non_creamy_layer_certi_path == null)
         {
                  if ($test_non_creamy_layer_certi=="yes") 
              {
                      if($request->hasFile('non_creamy_layer_certi')) 
                      {
                        $rules = ['non_creamy_layer_certi' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('non_creamy_layer_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('mca_document_upload');
                         }
                        $extension = $request->file('non_creamy_layer_certi')->getClientOriginalExtension();
                        $filenametostore = 'non_creamy_layer_certi_'.$dte_id.'.'.$extension;
                        $path = $request->file('non_creamy_layer_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $mca_students->non_creamy_layer_certi_path = $filenametostore;
                        $mca_students->non_creamy_layer_certi='Yes';
                        $mca_students->save();
                        }
                
                         else
                        {
                              $mca_students->non_creamy_layer_certi='No';
                              $mca_students->save();
                        }
              }
              elseif ($test_non_creamy_layer_certi=="no") {
                $mca_students->non_creamy_layer_certi='No';
              }
              elseif ($test_non_creamy_layer_certi=="na") {
                $mca_students->non_creamy_layer_certi='Not Applicable';
              }
              elseif ($test_non_creamy_layer_certi== null) {
                $request->session()->flash('non_creamy_layer_certi_error', 'Please select an option');
                  return redirect()->route('mca_document_upload');
              }
         }

      
      

      $test_proforma_a_b1_b2 = $request->input('proforma_a_b1_b2');
      if($mca_students->proforma_a_b1_b2_path == null)
         {
               
                  if ($test_proforma_a_b1_b2=="yes") 
              {
                      if($request->hasFile('proforma_a_b1_b2')) 
                      {
                        $rules = ['proforma_a_b1_b2' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('proforma_a_b1_b2_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('mca_document_upload');
                         }
                        $extension = $request->file('proforma_a_b1_b2')->getClientOriginalExtension();
                       $filenametostore = 'proforma_a_b1_b2_'.$dte_id.'.'.$extension;
                       $path = $request->file('proforma_a_b1_b2')->storeAs($destinationPath, $filenametostore,'public_uploads');
                       $mca_students->proforma_a_b1_b2_path = $filenametostore;
                        $mca_students->proforma_a_b1_b2='Yes';
                        $mca_students->save();
                        }
                
                         else
                        {
                              $mca_students->proforma_a_b1_b2='No';
                              $mca_students->save();
                        }
              }
              elseif ($test_proforma_a_b1_b2=="no") {
                $mca_students->proforma_a_b1_b2='No';
              }
              elseif ($test_proforma_a_b1_b2=="na") {
                $mca_students->proforma_a_b1_b2='Not Applicable';
              }
              elseif ($test_proforma_a_b1_b2== null) {
                $request->session()->flash('proforma_a_b1_b2_error', 'Please select an option');
                  return redirect()->route('mca_document_upload');
              }
}
      
      $test_income_certi = $request->input('income_certi');
       if($mca_students->income_certi_path == null)
         {
                      if ($test_income_certi=="yes") 
                  {
                          if($request->hasFile('income_certi')) 
                          {
                            $rules = ['income_certi' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('income_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              return redirect()->route('mca_document_upload');
                             }
                            $extension = $request->file('income_certi')->getClientOriginalExtension();
                            $filenametostore = 'income_certi_'.$dte_id.'.'.$extension;
                            $path = $request->file('income_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $mca_students->income_certi_path = $filenametostore;
                            $mca_students->income_certi='Yes';
                            $mca_students->save();
                          }
                          else
                            {
                                  $mca_students->income_certi='No';
                                  $mca_students->save();
                            }
                }
                elseif ($test_income_certi=="no") {
                    $mca_students->income_certi='No';
                  }
                  elseif ($test_income_certi=="na") {
                    $mca_students->income_certi='Not Applicable';
                  }
                  elseif ($test_income_certi== null) {
                    $request->session()->flash('income_certi_error', 'Please select an option');
                      return redirect()->route('mca_document_upload');
                  }
         }

      $test_proforma_c_d_e = $request->input('proforma_c_d_e');
        if($mca_students->proforma_c_d_e_path == null)
         {
                  if ($test_proforma_c_d_e=="yes") 
              {
                      if($request->hasFile('proforma_c_d_e')) 
                      {
                        $rules = ['proforma_c_d_e' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('proforma_c_d_e_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('mca_document_upload');
                         }
                        $extension = $request->file('proforma_c_d_e')->getClientOriginalExtension();
                        $filenametostore = 'proforma_c_d_e'.$dte_id.'.'.$extension;
                        $path = $request->file('proforma_c_d_e')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $mca_students->proforma_c_d_e_path = $filenametostore;
                                $mca_students->proforma_c_d_e='Yes';
                        $mca_students->save();
                      }
                       else
                        {
                              $mca_students->proforma_c_d_e='No';
                              $mca_students->save();
                        }
            }
            elseif ($test_proforma_c_d_e=="no") {
                $mca_students->proforma_c_d_e='No';
              }
              elseif ($test_proforma_c_d_e=="na") {
                $mca_students->proforma_c_d_e='Not Applicable';
              }
              elseif ($test_proforma_c_d_e== null) {
                $request->session()->flash('proforma_c_d_e_error', 'Please select an option');
                  return redirect()->route('mca_document_upload');
              }
         }
      
      
                 $test_proforma_v = $request->input('proforma_v');
                  if($mca_students->proforma_v_path == null)
                     {
                              if ($test_proforma_v=="yes") 
                          {
                                  if($request->hasFile('proforma_v'))
                                  {
                                    $rules = ['proforma_v' => 'mimes:pdf|max:1024'];
                                      $validator = Validator::make(Input::all() , $rules);
                                    if ($validator->fails())
                                     {
                                      $request->session()->flash('proforma_v_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                      return redirect()->route('mca_document_upload');
                                     }
                                    $extension = $request->file('proforma_v')->getClientOriginalExtension();
                                    $filenametostore = 'proforma_v_'.$dte_id.'.'.$extension;
                                    $path = $request->file('proforma_v')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                    $mca_students->proforma_v_path = $filenametostore;
                                    $mca_students->proforma_v='Yes';
                                    $mca_students->save();
                                    }
                                     else
                                    {
                                          $mca_students->proforma_v='No';
                                          $mca_students->save();
                                    }
                          }
                          elseif ($test_proforma_v=="no") {
                            $mca_students->proforma_v='No';
                          }
                          elseif ($test_proforma_v=="na") {
                            $mca_students->proforma_v='Not Applicable';
                          }
                          elseif ($test_proforma_v== null) {
                            $request->session()->flash('proforma_v_error', 'Please select an option');
                              return redirect()->route('mca_document_upload');
                          }
                     }


                    $test_proforma_u = $request->input('proforma_u');
                  if($mca_students->proforma_u_path == null)
                     {
                              if ($test_proforma_u=="yes") 
                          {
                                  if($request->hasFile('proforma_u')) 
                                  {
                                    $rules = ['proforma_u' => 'mimes:pdf|max:1024'];
                                      $validator = Validator::make(Input::all() , $rules);
                                    if ($validator->fails())
                                     {
                                      $request->session()->flash('proforma_u_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                      return redirect()->route('mca_document_upload');
                                     }
                                    $extension = $request->file('proforma_u')->getClientOriginalExtension();
                                    $filenametostore = 'proforma_u_'.$dte_id.'.'.$extension;
                                    $path = $request->file('proforma_u')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                    $mca_students->proforma_u_path = $filenametostore;
                                    $mca_students->proforma_u='Yes';
                                    $mca_students->save();
                                    }
                                     else
                                    {
                                          $mca_students->proforma_u='No';
                                          $mca_students->save();
                                    }
                          }
                          elseif ($test_proforma_u=="no") {
                            $mca_students->proforma_u='No';
                          }
                          elseif ($test_proforma_u=="na") {
                            $mca_students->proforma_u='Not Applicable';
                          }
                          elseif ($test_proforma_u== null) {
                            $request->session()->flash('proforma_u_error', 'Please select an option');
                              return redirect()->route('mca_document_upload');
                          }
                     }
                     
      $test_medical_certi = $request->input('medical_certi');
       if($mca_students->medical_certi_path == null)
         {
                      if ($test_medical_certi=="yes") 
                  {
                          if($request->hasFile('medical_certi')) 
                          {
                            $rules = ['medical_certi' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('medical_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              return redirect()->route('mca_document_upload');
                             }
                            $extension = $request->file('medical_certi')->getClientOriginalExtension();
                            $filenametostore = 'medical_certi_'.$dte_id.'.'.$extension;
                            $path = $request->file('medical_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $mca_students->medical_certi_path = $filenametostore;
                                    $mca_students->medical_certi='Yes';
                            $mca_students->save();
                          }
                            else
                            {
                                  $mca_students->medical_certi='No';
                                  $mca_students->save();
                            }
                }
                elseif ($test_medical_certi=="no") {
                    $mca_students->medical_certi='No';
                  }
                  elseif ($test_medical_certi== null) {
                    $request->session()->flash('medical_certi_error', 'Please select an option');
                      return redirect()->route('mca_document_upload');
                  }
         }
      $test_anti_ragging_affidavit = $request->input('anti_ragging_affidavit');
        if($mca_students->anti_ragging_affidavit_path == null)
         {
                  if ($test_anti_ragging_affidavit=="yes") 
              {
                      if($request->hasFile('anti_ragging_affidavit')) 
                      {
                        $rules = ['anti_ragging_affidavit' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('anti_ragging_affidavit_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('mca_document_upload');
                         }
                        $extension = $request->file('anti_ragging_affidavit')->getClientOriginalExtension();
                        $filenametostore = 'anti_ragging_affidavit'.$dte_id.'.'.$extension;
                        $path = $request->file('anti_ragging_affidavit')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $mca_students->anti_ragging_affidavit_path = $filenametostore;
                                $mca_students->anti_ragging_affidavit='Yes';
                        $mca_students->save();
                      }
                       else
                        {
                              $mca_students->anti_ragging_affidavit='No';
                              $mca_students->save();
                        }
            }
            elseif ($test_anti_ragging_affidavit=="no") {
                $mca_students->anti_ragging_affidavit='No';
              }
              elseif ($test_anti_ragging_affidavit== null) {
                $request->session()->flash('anti_ragging_affidavit_error', 'Please select an option');
                  return redirect()->route('mca_document_upload');
              }
         }
         
        $user1 = DB::table('mca_students')->select('dte_id','fc_confirmation_receipt','fc_confirmation_receipt_path','dte_allotment_letter','dte_allotment_letter_path','arc_ackw_receipt','arc_ackw_receipt_path','cet_result','cet_result_path','ssc_marksheet','ssc_marksheet_path','hsc_diploma_marksheet','hsc_diploma_marksheet_path','degree_leaving_tc','degree_leaving_tc_path','first_year_marksheet','first_year_marksheet_path','second_year_marksheet','second_year_marksheet_path','third_year_marksheet','third_year_marksheet_path','migration_certi','migration_certi_path','birth_certi','birth_certi_path','domicile','domicile_path','proforma_o','proforma_o_path','retention','retention_path','minority_affidavit','minority_affidavit_path','gap_certi','gap_certi_path','community_certi','community_certi_path','caste_certi','caste_certi_path','caste_validity_certi','caste_validity_certi_path','non_creamy_layer_certi','non_creamy_layer_certi_path','proforma_a_b1_b2','proforma_a_b1_b2_path','proforma_u','proforma_u_path','proforma_v','proforma_v_path','income_certi','convocation_passing_certi','convocation_passing_certi_path','income_certi_path','proforma_c_d_e','proforma_c_d_e_path','anti_ragging_affidavit','anti_ragging_affidavit_path','medical_certi','medical_certi_path','photo','photo_path','signature','signature_path','is_document_completed')->where('dte_id', $dte_id)->get();
        $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        $hash = $hash[0]->hash;
        if($user1[0]->photo ==  "Yes" && $user1[0]->signature == "Yes")
        {
            $mca_students->is_document_completed =1;
             $mca_students->save();
    
        }
        elseif($user1[0]->photo ==  null || $user1[0]->signature == null)
        {
              $mca_students->is_document_completed =0;
             // return "hello";
             $mca_students->save();
        }
        $course = $request->session()->get('log_course');
list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);

        $data=[];
         $activeacap = $request->session()->get('log_acap');
        if( $activeacap =='yes') {
            if($userprogress[0]->is_document_completed==1){
          $user1['prog_val']=7;
          $data['user1']=$user1;
          // return 'done';
        }

        }
        $data['user1']=$user1;
        $data['hash'] = $hash;
        return view('user.mca.document_upload',$data);


  }

 public static function showmcaPaymentDetails(Request $request)
{
     $dte_id = $request->session()->get('log_dte_id', 'null');
    if ($dte_id != 'null')
      {
          $users = DB::table('fees_transaction')->where('dte_id',$dte_id)->get();
            $course = $request->session()->get('log_course');
 
          return view('user.mca.payment_details')->with('users',$users);
      }
      else
      {
      return redirect()->route('logout');
      }
}
 
 public static function showmcaAca(Request $request)
    {


    $dte_id =$request->session()->get('log_dte_id', 'null');

    if ($dte_id != 'null')
      {
          $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {


              $data = [];
              $newOrOldSystem = array(
                'N' => 'New',
                'O' => 'Old',
                'P' => 'Provisional'
              );
              $data['newOrOldSystem'] = $newOrOldSystem;
              $diplomaOrHsc = array(
                'D' => 'Diploma',
                'H' => 'HSC'
              );
              $data['diplomaOrHsc'] = $diplomaOrHsc;
              $months = array(
                'Jan' => 'Jan',
                'Feb' => 'Feb',
                'Mar' => 'Mar',
                'Apr' => 'Apr',
                'May' => 'May',
                'Jun' => 'Jun',
                'Jul' => 'Jul',
                'Aug' => 'Aug',
                'Sep' => 'Sep',
                'Oct' => 'Oct',
                'Nov' => 'Nov',
                'Dec' => 'Dec'
              );
              $data['months'] = $months;
              $university_types_grad = array(
                'OMS' => 'OMU(Other than Mumbai University)',
                'Mumbai_University' => 'Mumbai University'
              );

               $university_types = array(
                'Maharashtra_Board' => 'Maharashtra Board',
                'CBSE' => 'CBSE',
                'ICSE' => 'ICSE',
                'OTHER'=> 'Other'
              );

              $data['university_types'] = $university_types;
              $data['university_types_grad'] = $university_types_grad;
              $status = DB::table('mca_students')->select('is_academic_completed')->where('dte_id', $dte_id)->get();
              if (DB::table('mca_students')->select('is_academic_completed')->where('dte_id', $dte_id)->exists() && $status[0]->is_academic_completed == "1")
                {
                    $user1 = DB::table('mca_students')->select('dte_id', 'x_board','x_school_name', 'x_school_city','x_school_state', 'x_max_marks', 'x_obtained_marks','x_passing_month','x_passing_year', 'x_percentage', 'is_diploma', 'xii_board','xii_college_name','xii_college_city','xii_college_state','xii_passing_month','xii_passing_year','xii_max_marks','xii_maths_max_marks','xii_obtained_marks','xii_maths_obtained_marks', 'xii_percentage','diploma_college_name','diploma_college_city','diploma_college_state', 'diploma_max_marks', 'diploma_obtained_marks', 'diploma_percentage', 'diploma_branch', 'diploma_university','diploma_passing_month', 'diploma_passing_year', 'degree_university','degree_passing_month', 'degree_passing_year', 'degree_college_name','degree_name','degree_branch', 'university_type','degree_college_city','degree_college_state','degree_maths_max_marks','degree_maths_obt_marks','degree_sem_1_obt_marks','degree_sem_1_max_marks','degree_sem_2_obt_marks','degree_sem_2_max_marks','degree_sem_3_obt_marks','degree_sem_3_max_marks','degree_sem_4_obt_marks','degree_sem_4_max_marks','degree_sem_5_obt_marks','degree_sem_5_max_marks','degree_sem_6_obt_marks','degree_sem_6_max_marks','degree_percentage', 'degree_final_cgpa','is_new_or_old','degree_sem1_sgpa','degree_sem2_sgpa','degree_sem3_sgpa','degree_sem4_sgpa','degree_sem5_sgpa','degree_sem6_sgpa','degree_aggr_obt_marks','degree_aggr_max_marks','degree_name','is_academic_completed')->where('dte_id', $dte_id)->get();      
                      if($user1[0]->degree_sem1_sgpa == "ND")
                $notDeclared1 = "true";
              else
                $notDeclared1 = "false";
              if($user1[0]->degree_sem2_sgpa == "ND")
                $notDeclared2 = "true";
              else
                $notDeclared2 = "false";
              if($user1[0]->degree_sem3_sgpa == "ND")
                $notDeclared3 = "true";
              else
                $notDeclared3 = "false";
              if($user1[0]->degree_sem4_sgpa == "ND")
                $notDeclared4 = "true";
              else
                $notDeclared4 = "false";
              if($user1[0]->degree_sem5_sgpa == "ND")
                $notDeclared5 = "true";
              else
                $notDeclared5 = "false";
              if($user1[0]->degree_sem6_sgpa == "ND")
                $notDeclared6 = "true";
              else
                $notDeclared6 = "false";
               }
               else
               {
                      $array_object = [['dte_id' => $dte_id,'is_academic_completed'=>0, 'x_board' => null,'x_school_name' => null,'x_school_city' => null,'x_school_state' => null,'x_max_marks' => null, 'x_obtained_marks' => null,'x_passing_month' => null,'x_passing_year' => 0, 'x_percentage' => null, 'is_diploma' => 'D', 'xii_board' => null,'xii_college_name' => null,'xii_college_city' => null,'xii_college_state' => null,'xii_passing_month' => null,'xii_passing_year' => 0, 'xii_max_marks' => null, 'xii_obtained_marks' => null, 'xii_percentage' => null,'diploma_college_name' => null,'diploma_college_city' => null,'diploma_college_state' => null, 'diploma_max_marks' => null, 'diploma_obtained_marks' => null, 'diploma_percentage' => null, 'diploma_branch' => null, 'diploma_university' => null,'diploma_passing_month'  => null, 'diploma_passing_year'  => 0 ,'degree_name'=>null,'degree_branch'=>null,'degree_university' => null,'degree_passing_month' =>null ,'degree_passing_year' => 0, 'degree_college_name' => null, 'university_type' => 'HU' ,'degree_college_city' => null,'degree_college_state' => null,'xii_maths_max_marks'=>0,'xii_maths_obtained_marks'=>0, 'degree_sem_1_obt_marks' => null, 'degree_sem_1_max_marks' => null, 'degree_sem_2_obt_marks' => null, 'degree_sem_2_max_marks' => null, 'degree_sem_3_obt_marks' => null, 'degree_sem_3_max_marks' => null, 'degree_sem_4_obt_marks' => null, 'degree_sem_4_max_marks' => null, 'degree_sem_5_obt_marks' => null, 'degree_sem_5_max_marks' => null, 'degree_sem_6_obt_marks' => null, 'degree_sem_6_max_marks' => null, 'degree_aggr_max_marks' => null, 'degree_sem1_sgpa' => null,'degree_aggr_max_marks' => null,'degree_maths_max_marks'=>0,'degree_maths_obt_marks'=>0,'degree_aggr_obt_marks' => null, 'degree_sem2_sgpa' => null, 'degree_sem3_sgpa' => null,'old_degree_percentage'=>null, 'degree_sem4_sgpa' => null, 'degree_sem5_sgpa' => null, 'degree_sem6_sgpa' => null, 'degree_percentage' => null, 'degree_final_cgpa' => null,'is_new_or_old'=> 'N','degree_name'=>null]];
                      $user1 = json_decode(json_encode($array_object));
                      $notDeclared1 = "false";
                      $notDeclared2 = "false";
                      $notDeclared3 = "false";
                      $notDeclared4 = "false";
                      $notDeclared5 = "false";
                      $notDeclared6 = "false";
                }
$course = $request->session()->get('log_course');
list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
if($userprogress[0]->is_dte_details_completed ==0){
return redirect('mca_dte_details');
}


                  $data['user1'] = $user1;
                  //return $user1;
                   $data['notDeclared1'] = $notDeclared1;
                      $data['notDeclared2'] = $notDeclared2;
                      $data['notDeclared3'] = $notDeclared3;
                      $data['notDeclared4'] = $notDeclared4;
                      $data['notDeclared5'] = $notDeclared5;
                      $data['notDeclared6'] = $notDeclared6;
                  return view('user.mca.academic_details', $data);
          }
          else
              return redirect()->route('mca_profile');
          
      }
      
      else
      {
      return redirect()->route('logout');
      }
    }

    public static function insertmcaAca(Request $request)
      {
      $dte_id=$request->session()->get('log_dte_id');
    $x_school_name = $request->input('sscSchoolName'); 
    $x_board = $request->input('sscBoard');
    $x_school_city = $request->input('sscSchoolCity');
    $x_school_state = $request->input('sscSchoolState');
    $x_passing_year = $request->input('xPassingYear');
    $x_passing_month =$request->input('xPassingMonth');
    $x_obtained_marks = $request->input('xObtainedMarks');
    $x_max_marks = $request->input('xMaximumMarks');
    $x_percentage = $request->input('xPercentage');
    $nd1 = $request->input('nd1');
    $nd2 = $request->input('nd2');
    $nd3 = $request->input('nd3');
    $nd4 = $request->input('nd4');
    $nd5 = $request->input('nd5');
    $nd6 = $request->input('nd6');
    $nd7 = $request->input('nd7');
    $nd8 = $request->input('nd8');

//   return $request->input('newOrOld');

   
  /*    return $x_percentage;*/
     $degree_college_name = $request->input('degreeCollegeName');
    $degree_university = $request->input('degreeUniversity');
    $degree_university_type = $request->input('universityType');
    $degree_name = $request->input('degreeName');
    $degeree_college_city = $request->input('collegeCity');
    $degeree_college_state = $request->input('collegeState');
    $degree_passing_year = $request->input('degreePassingYear');
    $degree_passing_month = $request->input('degreePassingMonth');
    $obt_math_marks_first_year =$request->input('degreeMathObtainedMarks');
    $maximum_math_marks =$request->input('degreeMathMaxMarks');
    $degree_branch =$request->input('branchName'); 
     $is_diploma = $request->input('diplomaHsc');
     $is_new_or_old =$request->input('newOrOld');

    // return $degree_university;
      

    if( $is_diploma=="D")
    {
        
        $diploma_college_name = $request->input('diplomaCollegeName');
        $diploma_board =$request->input('diplomaBoard');
        $diploma_branch = $request->input('diplomaBranch');
        $diploma_college_city = $request->input('diplomaCollegeCity');
        $diploma_college_state =$request->input('diplomaCollegeState');
        $diploma_passing_year = $request->input('diplomaPassingYear');
        $diploma_passing_month = $request->input('diplomaPassingMonth');
        $diploma_obtained_marks = $request->input('diplomaObtainedMarks');
        $diploma_max_marks = $request->input('diplomaMaximumMarks');
        $diploma_percentage = $request->input('diplomaPercentage');

         $hsc_math_obtain = 0;
         $hsc_math_max = 0;


        
        //$diploma_passing_year = $request->input('diplomaBranch');
        $xii_college_name = "NA";
        $xii_board ="NA";
        $xii_college_state ="NA";
        $xii_college_city = "NA";
        $xii_passing_month = "NA";
        $xii_passing_year = "0000";
        $xii_obtained_marks = "00";
        $xii_max_marks = "00";
        $xii_percentage = "00";
   }

    if($is_diploma=="H")
    {
      
         $xii_college_name = $request->input('hscCollegeName');
         $xii_board = $request->input('hscBoard');
         $xii_college_state = $request->input('hscCollegeState');
         $xii_college_city = $request->input('hscCollegeCity');
         $xii_passing_year = $request->input('xiipassingYear');
         $xii_passing_month = $request->input('xiipassingMonth');
         $xii_obtained_marks = $request->input('xiiObtainedMarks');
         $xii_max_marks = $request->input('xiiMaximumMarks');
         $xii_percentage = $request->input('xiiPercentage');
         $hsc_math_obtain =$request->input('xiiMathObtainedMarks');
         $hsc_math_max = $request->input('xiiMathMaxMarks');
         $diploma_college_name = "NA";
         $diploma_board = "NA";
         $diploma_branch = "NA";
         $diploma_college_city = "NA";
         $diploma_college_state = "NA";
         $diploma_passing_month = "NA"; 
         $diploma_passing_year = "0000";
         $diploma_obtained_marks = "00";
         $diploma_max_marks ="00";
         $diploma_percentage ="00";
         
    }
    if($is_new_or_old == "N")
    {

        $new_aggr_obt_marks = $request->input('aggrObtainedMarks');
        $new_aggr_max_marks = $request->input('aggrMaximumMarks');
        $new_percentage = $request->input('aggrPercentage');
        $new_final_cgpa = $request->input('finalCGPA');

        if( $new_percentage == null)
          {  $new_percentage = 0;
            $new_aggr_obt_marks =0;
            $new_aggr_max_marks =0;
          }
            


        $old_sem1_obt_marks = 0;
        $old_sem1_max_marks = 0;
         $old_sem2_obt_marks = 0;
        $old_sem2_max_marks = 0;
         $old_sem3_obt_marks = 0;
        $old_sem3_max_marks = 0;
         $old_sem4_obt_marks = 0;
        $old_sem4_max_marks = 0;
         $old_sem5_obt_marks = 0;
        $old_sem5_max_marks = 0;
         $old_sem6_obt_marks = 0;
        $old_sem6_max_marks = 0;
        /* $old_sem7_obt_marks = 0;
        $old_sem7_max_marks = 0;
         $old_sem8_obt_marks = 0;
        $old_sem8_max_marks = 0;*/
        $old_aggr_obt_marks = 0;
        $old_aggr_max_marks = 0;
        $old_aggr_final_percentage = 0;


        $pro_sem1_sgpa = 0;
        $pro_sem2_sgpa = 0;
        $pro_sem3_sgpa = 0;
        $pro_sem4_sgpa = 0;
        $pro_sem5_sgpa = 0;
        $pro_sem6_sgpa = 0;
        /*$pro_sem7_sgpa = 0;
        $pro_sem8_sgpa = 0;*/


    }
    if($is_new_or_old == "O")
    {

        $old_sem1_obt_marks = $request->input('degree_1_marks_obt');
        $old_sem1_max_marks = $request->input('degree_1_marks_max');
        $old_sem2_obt_marks = $request->input('degree_2_marks_obt');
        $old_sem2_max_marks = $request->input('degree_2_marks_max');
        $old_sem3_obt_marks = $request->input('degree_3_marks_obt');
        $old_sem3_max_marks = $request->input('degree_3_marks_max');
        $old_sem4_obt_marks = $request->input('degree_4_marks_obt');
        $old_sem4_max_marks = $request->input('degree_4_marks_max');
        $old_sem5_obt_marks = $request->input('degree_5_marks_obt');
        $old_sem5_max_marks = $request->input('degree_5_marks_max');
        $old_sem6_obt_marks = $request->input('degree_6_marks_obt');
        $old_sem6_max_marks = $request->input('degree_6_marks_max');
        /*$old_sem7_obt_marks = $request->input('degree_7_marks_obt');
        $old_sem7_max_marks = $request->input('degree_7_marks_max');
        $old_sem8_obt_marks = $request->input('degree_8_marks_obt');
        $old_sem8_max_marks = $request->input('degree_8_marks_max');*/

         $new_aggr_obt_marks = $request->input('oldAggrObtainedMarks');
        $new_aggr_max_marks = $request->input('oldAggrMaximumMarks');
        $new_percentage = $request->input('oldAggrPercentage');

        $new_final_cgpa = 0;

        $pro_sem1_sgpa = 0;
        $pro_sem2_sgpa = 0;
        $pro_sem3_sgpa = 0;
        $pro_sem4_sgpa = 0;
        $pro_sem5_sgpa = 0;
        $pro_sem6_sgpa = 0;
        /*$pro_sem7_sgpa = 0;
        $pro_sem8_sgpa = 0;*/

        

    }
    if($is_new_or_old == "P" )
    {

        $pro_sem1_sgpa = $request->input('sem1Cgpa');
        $pro_sem2_sgpa = $request->input('sem2Cgpa');
        $pro_sem3_sgpa = $request->input('sem3Cgpa');
        $pro_sem4_sgpa = $request->input('sem4Cgpa');
        $pro_sem5_sgpa = $request->input('sem5Cgpa');
        $pro_sem6_sgpa = $request->input('sem6Cgpa');
       /* $pro_sem7_sgpa = $request->input('sem7Cgpa');
        $pro_sem8_sgpa = $request->input('sem8Cgpa');*/

        if($nd1 == "")
       $pro_sem1_sgpa = $request->input('sem1Cgpa');
        else if($nd1 == "Nd")
          $pro_sem1_sgpa = "ND";
        if($nd2 == "")
           $pro_sem2_sgpa = $request->input('sem2Cgpa');
        else if($nd2 == "Nd")
          $deg_sem2_sgpa = "ND";
        if($nd3 == "")
           $pro_sem3_sgpa = $request->input('sem3Cgpa');
        else if($nd3 == "Nd")
          $pro_sem3_sgpa = "ND";
        if($nd4 == "")
           $pro_sem4_sgpa = $request->input('sem4Cgpa');
        else if($nd4 == "Nd")
          $pro_sem4_sgpa = "ND";
        if($nd5 == "")
           $deg_sem5_sgpa = $request->input('sem5Cgpa');
        else if($nd5 == "Nd")
          $pro_sem5_sgpa = "ND";
        if($nd6 == "")
           $pro_sem6_sgpa = $request->input('sem6Cgpa');
        else if($nd6 == "Nd")
          $pro_sem6_sgpa = "ND";
        /*if($nd7 == "")
           $pro_sem7_sgpa = $request->input('sem7Cgpa');
        else if($nd7 == "Nd")
          $pro_sem7_sgpa = "ND";
        if($nd8 == "")
           $pro_sem8_sgpa = $request->input('sem8Cgpa');
        else if($nd8 == "Nd")
          {
            $pro_sem8_sgpa = "ND"; 
          }*/

        $new_aggr_obt_marks = 0;
        $new_aggr_max_marks = 0;
        $new_percentage = 0;
        $new_final_cgpa = 0;

        $old_sem1_obt_marks = 0;
        $old_sem1_max_marks = 0;
         $old_sem2_obt_marks = 0;
        $old_sem2_max_marks = 0;
         $old_sem3_obt_marks = 0;
        $old_sem3_max_marks = 0;
         $old_sem4_obt_marks = 0;
        $old_sem4_max_marks = 0;
         $old_sem5_obt_marks = 0;
        $old_sem5_max_marks = 0;
         $old_sem6_obt_marks = 0;
        $old_sem6_max_marks = 0;
        /* $old_sem7_obt_marks = 0;
        $old_sem7_max_marks = 0;
         $old_sem8_obt_marks = 0;*/
        $old_sem8_max_marks = 0;
        $old_aggr_obt_marks = 0;
        $old_aggr_max_marks = 0;
        $old_aggr_final_percentage = 0;



    }
  


   /* if($nd1 == "")
       $deg_sem1_sgpa = $request->input('sem1Cgpa');
    else if($nd1 == "Nd")
      $deg_sem1_sgpa = "ND";
    if($nd2 == "")
       $deg_sem2_sgpa = $request->input('sem2Cgpa');
    else if($nd2 == "Nd")
      $deg_sem2_sgpa = "ND";
    if($nd3 == "")
       $deg_sem3_sgpa = $request->input('sem3Cgpa');
    else if($nd3 == "Nd")
      $deg_sem3_sgpa = "ND";
    if($nd4 == "")
       $deg_sem4_sgpa = $request->input('sem4Cgpa');
    else if($nd4 == "Nd")
      $deg_sem4_sgpa = "ND";
    if($nd5 == "")
       $deg_sem5_sgpa = $request->input('sem5Cgpa');
    else if($nd5 == "Nd")
      $deg_sem5_sgpa = "ND";
    if($nd6 == "")
       $deg_sem6_sgpa = $request->input('sem6Cgpa');
    else if($nd6 == "Nd")
      $deg_sem6_sgpa = "ND";
    if($nd7 == "")
       $deg_sem7_sgpa = $request->input('sem7Cgpa');
    else if($nd7 == "Nd")
      $deg_sem7_sgpa = "ND";
    if($nd8 == "")
       $deg_sem8_sgpa = $request->input('sem8Cgpa');
    else if($nd8 == "Nd")
      {
        $deg_sem8_sgpa = "ND";
        
      }*/

     if (DB::table('mca_students')->where('dte_id', $dte_id)->exists()) 
         { 
        /*$me_students  = me_students::find($dte_id);
        }
    }
    $me_students->dte_id = $dte_id;
    $me_students->x_board = $x_board;
    $me_students->x_obtained_marks = $x_obtained_marks;
    $me_students->x_max_marks = $x_max_marks;
    $me_students->x_percentage = $x_percentage;
    $me_students->is_diploma = $is_diploma;
    $me_students->xii_board = $xii_board;
    $me_students->xii_obtained_marks = $xii_obtained_marks;
    $me_students->xii_max_marks = $xii_max_marks;
    $me_students->xii_percentage = $xii_percentage;
    $me_students->diploma_obtained_marks = $diploma_obtained_marks;
    $me_students->diploma_max_marks = $diploma_max_marks;
    $me_students->diploma_percentage = $diploma_percentage;
    $me_students->diploma_branch = $diploma_branch;
    $me_students->degree_university = $degree_university;
    $me_students->degree_passing_year = $degree_passing_year;
    $me_students->degree_college_name = $degree_college_name;
    $me_students->degree_1_8_obt_marks = $degree_1_8_obt_marks;
    $me_students->degree_1_8_max_marks = $degree_1_8_max_marks;
    $me_students->degree_percentage = $degree_percentage;
    $me_students->degree_final_cgpa = $degree_final_cgpa;
    $me_students->save();*/
    
    //Prodedure
 

     DB::select("call insert_update_mca_academic('$dte_id','$x_passing_month','$x_passing_year','$x_board','$x_max_marks','$x_obtained_marks','$x_percentage','$x_school_name','$x_school_city','$x_school_state','$is_diploma','$xii_passing_month','$xii_passing_year','$xii_board','$xii_max_marks','$xii_obtained_marks','$hsc_math_max','$hsc_math_obtain','$xii_percentage','$xii_college_name','$xii_college_city','$xii_college_state','$diploma_board','$diploma_passing_month','$diploma_passing_year','$diploma_max_marks','$diploma_obtained_marks','$diploma_percentage','$diploma_branch','$diploma_college_name','$diploma_college_city','$diploma_college_state','$degree_name','$degree_university','$degree_passing_month','$degree_passing_year','$degree_college_name','$degeree_college_city','$degeree_college_state','$old_sem1_max_marks','$old_sem1_obt_marks','$old_sem2_max_marks','$old_sem2_obt_marks','$old_sem3_max_marks','$old_sem3_obt_marks','$old_sem4_max_marks','$old_sem4_obt_marks','$old_sem5_max_marks','$old_sem5_obt_marks','$old_sem6_max_marks','$old_sem6_obt_marks','$maximum_math_marks','$obt_math_marks_first_year','$pro_sem1_sgpa','$pro_sem2_sgpa','$pro_sem3_sgpa','$pro_sem4_sgpa','$pro_sem5_sgpa','$pro_sem6_sgpa','$new_aggr_max_marks','$new_aggr_obt_marks','$is_new_or_old','$new_percentage','$new_final_cgpa','$degree_university_type','$degree_branch')");
      return redirect('mca_personal_details');

   
    }

}


  public static function showmcaContact(Request $request)
    {
    $dte_id = $request->session()->get('log_dte_id', 'null');
    if ($dte_id != 'null')
      {
        $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();


          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {
      $data = [];
      $residences = array(
        'Local' => 'L',
        'Outstation' => 'O'
      );
      $data['residences'] = $residences;

      $check = DB::table('mca_students')->select('is_contact_completed')->where('dte_id', $dte_id)->get(); 
      if (DB::table('mca_students')->select('is_contact_completed')->where('dte_id', $dte_id)->exists() && $check[0]->is_contact_completed == "1")
        {
        $user1 = DB::table('mca_students')->select('dte_id', 'permanent_address_line1', 'permanent_address_line2', 'permanent_city','permanent_district', 'permanent_state', 'permanent_pincode', 'permanent_nearest_rail_station', 'correspondance_address_line1', 'correspondance_address_line2', 'correspondance_city', 'correspondance_state', 'correspondance_pincode', 'correspondance_nearest_rail_station', 'resident_of', 'local_guardian_name', 'local_guardian_address_line1', 'local_guardian_address_line2', 'local_guardian_city','correspondance_district', 'local_guardian_state', 'local_guardian_pincode','is_contact_completed')->where('dte_id', $dte_id)->get();
        }
        else
        {
        $array_object = [['dte_id' => $dte_id,'is_contact_completed'=>0 ,'permanent_address_line1' => null, 'permanent_address_line2' => null, 'permanent_city' => null, 'permanent_state' => null,'permanent_district' => null, 'permanent_pincode' => null, 'permanent_nearest_rail_station' => null, 'correspondance_address_line1' => null, 'correspondance_address_line2' => null, 'correspondance_city' => null, 'correspondance_state' => null, 'correspondance_district' => null, 'correspondance_pincode' => null, 'correspondance_nearest_rail_station' => null, 'resident_of' => 'Local', 'local_guardian_name' => null, 'local_guardian_address_line1' => null, 'local_guardian_address_line2' => null, 'local_guardian_city' => null, 'local_guardian_state' => null, 'local_guardian_pincode' => null,' is_contact_completed' => 0]];
        $user1 = json_decode(json_encode($array_object));
        }


$course = $request->session()->get('log_course');
list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
if($userprogress[0]->is_guardian_completed ==0){
return redirect('mca_guardian_details');
}

      $data['user1'] = $user1;

      $data['status'] = "Not Submitted";
      if($user1[0]->correspondance_address_line1 == null)
       $data['permanent'] = "false";
      elseif($user1[0]->correspondance_address_line1 == $user1[0]->permanent_address_line1)
        $data['permanent'] = "true";
      else
        $data['permanent'] = "false";


      return view('user.mca.contact_details', $data);
      }
          else
              return redirect()->route('mca_profile');
          }
      else
      {
      return redirect()->route('logout');
      }
    }

    public static function insertmcaContact(Request $request)
  {
    $dte_id=$request->session()->get('log_dte_id');
    $permanent_address_line1 = $request->input('permanentAddressLine1');
    $permanent_address_line2 = $request->input('permanentAddressLine2');
    $permanent_city = $request->input('permanentAddressCity');
    $permanent_state = $request->input('permanentAddressState');
    $permanent_district = $request->input('permanentAddressDistrict');
    $permanent_pincode = $request->input('permanentAddressPincode');
    $permanent_nearest_rail_station = $request->input('permanentAddressNearestRailwayStation');
    

    $local_guardian_name = $request->input('localGuardianName');
    $local_guardian_address_line1 = $request->input('localGuardianAddressLine1');
    $local_guardian_address_line2 = $request->input('localGuardianAddressLine2');
    $local_guardian_city = $request->input('localGuardianAdreessCity');
    $local_guardian_state = $request->input('localGuardianAdreessState');
    $local_guardian_district = $request->input('localGuardianAdreessDristict');
    $local_guardian_pincode = $request->input('localGuardianAddressPincode');
    $is_correspon_as_permanent=$request->input('isSame');
    $is_local_or_outstation=$request->input('localOutstation');
    
  // return $is_correspon_as_permanent;

    // if($is_correspon_as_permanent=="yes")
    // {
    //     $correspondance_address_line1 =  $permanent_address_line1;
    //     $correspondance_address_line2 = $permanent_address_line2;
    //     $correspondance_city = $permanent_city;
    //     $correspondance_state = $permanent_state;
    //     $correspondance_district = $permanent_district;
    //     $correspondance_pincode =$permanent_pincode;
    //     $correspondance_nearest_rail_station =  $permanent_nearest_rail_station;

    // }
    // else
    // {
         $correspondance_address_line1 = $request->input('currentAddressLine1');
         $correspondance_address_line2 = $request->input('currentAddressLine2');
         $correspondance_city = $request->input('currentAddressCity');
         $correspondance_district =  $request->input('currentAddressDistrict'); 
         $correspondance_state = $request->input('currentAddressState');
         $correspondance_pincode = $request->input('currentAddressPincode');
         $correspondance_nearest_rail_station = $request->input('currentAddressNearestRailwayStation');
    // }


    if($is_local_or_outstation=="Local")
    {
        $local_guardian_name = "NA";
        $local_guardian_address_line1 = "NA";
        $local_guardian_address_line2 =  "NA";
        $local_guardian_city =  "NA";
         $local_guardian_district =  "NA";
        $local_guardian_state =  "NA";
        $local_guardian_pincode = "0"; 

    }
    else
    {
        $local_guardian_name = $request->input('localGuardianName');
        $local_guardian_address_line1 = $request->input('localGuardianAddressLine1');
        $local_guardian_address_line2 = $request->input('localGuardianAddressLine2');
        $local_guardian_city = $request->input('localGuardianAdreessCity');
        $local_guardian_district = $request->input('localGuardianAdreessDristict');
        $local_guardian_state = $request->input('localGuardianAdreessState');
        $local_guardian_pincode = $request->input('localGuardianAddressPincode');
    }

    if (DB::table('mca_students')->where('dte_id', $dte_id)->exists()) 
         { 
        /*$me_students  = me_students::find($dte_id);
        }
    $me_students->dte_id = $dte_id;
    $me_students->permanent_address_line1 = $permanent_address_line1;
    $me_students->permanent_address_line2 = $permanent_address_line2;
    $me_students->permanent_city = $permanent_city;
    $me_students->permanent_state = $permanent_state;
    $me_students->permanent_pincode = $permanent_pincode;
    $me_students->permanent_nearest_rail_station = $permanent_nearest_rail_station;
    $me_students->correspondance_address_line1 = $correspondance_address_line1;
    $me_students->correspondance_address_line2 = $correspondance_address_line2;
    $me_students->correspondance_city = $correspondance_city;
    $me_students->correspondance_state = $correspondance_state;
    $me_students->correspondance_pincode = $correspondance_pincode;
    $me_students->correspondance_nearest_rail_station = $correspondance_nearest_rail_station;
    $me_students->local_guardian_name = $local_guardian_name;
    $me_students->local_guardian_address_line1 = $local_guardian_address_line1;
    $me_students->local_guardian_address_line2 = $local_guardian_address_line2;
    $me_students->local_guardian_city = $local_guardian_city;
    $me_students->local_guardian_state = $local_guardian_state;
    $me_students->local_guardian_pincode = $local_guardian_pincode;
    $me_students->save();*/
    
    //Procedure
    DB::select("call insert_update_mca_contact('$dte_id','$permanent_address_line1','$permanent_address_line2','$permanent_city','$permanent_district','$permanent_state','$permanent_pincode','$permanent_nearest_rail_station','$correspondance_address_line1','$correspondance_address_line2','$correspondance_city','$correspondance_district','$correspondance_state','$correspondance_pincode','$correspondance_nearest_rail_station','$is_local_or_outstation','$local_guardian_name','$local_guardian_address_line1','$local_guardian_address_line2','$local_guardian_city','$local_guardian_district','$local_guardian_state','$local_guardian_pincode')");
       }
        return redirect()->route('mca_document_upload');
    }


  public static function showmcaDte(Request $request)
    {
         
         $dte_id = $request->session()->get('log_dte_id');
         $activedte= $request->session()->get('log_dte', 'null');
     $activeacap = $request->session()->get('log_acap');
        $course = $request->session()->get('log_course');
        
        if($activedte == "yes")
        {
          
          $event = "DTE";

        }
        else if($activeacap == "yes")
        {
          
          $event = "ACAP";
        }
    if ($dte_id != 'null')
      {
         $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {
     $data = [];
      $months = array(
        'Jan' => 'Jan',
        'Feb' => 'Feb',
        'Mar' => 'Mar',
        'Apr' => 'Apr',
        'May' => 'May',
        'Jun' => 'Jun',
        'Jul' => 'Jul',
        'Aug' => 'Aug',
        'Sep' => 'Sep',
        'Oct' => 'Oct',
        'Nov' => 'Nov',
        'Dec' => 'Dec'
      );
      if($event == "DTE")
      {
      $categories = array(
        'OPEN MU' => 'Open Mumbai University',
        'OPEN SINDHI MINORITY' => 'Open Sindhi Minority',
        'OPEN OMU' => 'OPEN Other Than Mumbai University',
        'OBC/EBC MU' => 'OBC/EBC Mumbai University',
        'OBC/EBC OMU' => 'OBC/EBC Other than Mumbei University',
        'SC/ST/VJ/DT/NT/SBC MU' => 'SC/ST/VJ/DT/NT/SBC Mumbai University',
        'SC/ST/VJ/DT/NT/SBC OMU' => 'SC/ST/VJ/DT/NT/SBC Other than Mumbai University',
        'PWD'=>'PWD',
        'OMS' => 'OMS',
        'JK' => 'JK',
        'GOI' => 'GOI',
        'NEUT' => 'NEUT'
      );
      }
     if($event == "ACAP")
     {
       $categories = array(
        'OPEN' => 'Open',
        'SINDHI' => 'Sindhi'
      );
     }
      $candidate_types = array(
        'A' => 'Type A',
        'B' => 'Type B',
        'C' => 'Type C',
        'D' => 'Type D',
        'E' => 'Type E',
        'F' => 'Type F',
        'O' => 'Type OMS',
      );
     
      $data['months'] = $months;
      // $data['categories'] = $categories;
      $data['candidate_types'] = $candidate_types;
      $opentype= DB::select(DB::raw("SELECT  GROUP_CONCAT( DISTINCT fee_category) AS fee_category FROM fees_structure WHERE course='MCA' AND type='NONMINORITY' "));          

          $minotype=DB::select(DB::raw("SELECT GROUP_CONCAT( DISTINCT fee_category) AS fee_category FROM fees_structure WHERE course='MCA' AND type='MINORITY' "));
          $reservedtype=DB::select(DB::raw("SELECT GROUP_CONCAT( DISTINCT fee_category) AS fee_category FROM fees_structure WHERE course='MCA' AND type='RESERVED' "));
$categories=array('open'=>$opentype,'minotype'=>$minotype,'reservedtype'=>$reservedtype);
        $data['open']=explode(",",$opentype[0]->fee_category);
        $data['minotype']=explode(",",$minotype[0]->fee_category);
        $data['reservedtype']=explode(",",$reservedtype[0]->fee_category);
      // return $data;
    
      $check = DB::table('mca_students')->select('is_dte_details_completed')->where('dte_id', $dte_id)->get(); 
      if ( DB::table('mca_students')->select('is_dte_details_completed')->where('dte_id', $dte_id)->exists() && $check[0]->is_dte_details_completed == "1")
        {
        $user1 = DB::table('mca_students')->select('dte_id', 'category', 'candidate_type', 'cet_score','mh_state_general_merit_no','seat_type','shift_allotted','allotted_cap_round','course_allotted','course_allotted_code','cet_month','cet_year','cet_percentile','is_dte_details_completed')->where('dte_id', $dte_id)->get();

        }
        else
        {
          
          if($activedte=='yes')
          {
             
               $user2 = DB::table('dte_allotments')->select('dte_seat_type_allotted','shift_allotted','allotted_cap_round','course_allotted','course_allotted_code')->where('dte_id', $dte_id)->get();
                 $array_object = [['dte_id' => $dte_id,'is_dte_details_completed'=>0 ,'dte_password' => null, 'category' => null, 'acap_category' => null,'candidate_type' => null, 'cet_score' => null, 'mh_state_general_merit_no' => null,'cet_percentile'=>null,'seat_type' => $user2[0]->dte_seat_type_allotted,'allotted_cap_round' =>$user2[0]->allotted_cap_round,'course_allotted' =>     $user2[0]->course_allotted,'course_allotted_code' =>     $user2[0]->course_allotted_code,'shift_allotted' =>     $user2[0]->shift_allotted,'cet_month' => null,'cet_year'=> 0]];
                $user1 = json_decode(json_encode($array_object));

             
                 
          }
          elseif($activeacap=='yes')
          {
           
            $array_object = [['dte_id' => $dte_id, 'is_dte_details_completed'=>0 ,'dte_password' => null, 'category' => null, 'reserved' => null,'candidate_type' => null, 'cet_score' => null, 'mh_state_general_merit_no' => null,'cet_percentile'=>null,'seat_type' => null,'allotted_cap_round' => null,'course_allotted' => null,'course_allotted_code' => null,'shift_allotted'=>null,'cet_month' => null,'cet_year' => 0]];
            $user1 = json_decode(json_encode($array_object));
           
        }
        
     }

      list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
   
      // return $user1;
      $data['user1'] = $user1;
      return view('user.mca.dte_details', $data);
      }

          else
              return redirect()->route('mca_profile');
          }
      else
      {
      return redirect()->route('logout');
      }

    }

    public static function insertmcaDte(Request $request)
      {
          $dte_id=$request->session()->get('log_dte_id');
         $activedte= $request->session()->get('log_dte', 'null');
     $activeacap = $request->session()->get('log_acap');
        $course = $request->session()->get('log_course');
       // echo $activedte;
       // echo $activeacap;
       // echo $course;
      //  return $dte_id;
        if($activedte == "yes")
        {
          
          $event = "DTE";

        }
        else if($activeacap == "yes")
        {
          
          $event = "ACAP";
        }
        
          /*$user = DB::table('mca_students')->where('dte_id', $dte_id)->get();
          if ($user==[])
          {
          if($log_dte=="yes")
          {
          $category = $request->input('category');
            $acap_category="NA";
          }
          elseif($log_acap=="yes")
           {
            $acap_category = $request->input('category');
            $category="NA";
          }
          }
          elseif (DB::table('mca_students')->where('dte_id', $dte_id)->exists()) {         
          
          if($log_dte=="yes")
          {
         
          $category = $request->input('category');
          if($user[0]->acap_category==null)
            $acap_category="NA";
          else
            $acap_category = $user[0]->acap_category; 
          }
          elseif($log_acap=="yes")
          {
            $acap_category = $request->input('category');
            if($user[0]->category==null)
            $category="NA";
          else
            $category = $user[0]->category; 
          }
        }*/
/*          if(log_acap==null)
          {
*/         
          //$category = $request->input('category');
          /*}
          elseif(log_dte==null)
          {
              $acap_category=$request->input('category');
          }*/
          /*if($category == "RESERVED")
          {
            $category = $request->input('reserved');
          }*/
          
          $candidate_type = $request->input('candidate_types');
          $cet_score = $request->input('cetScore');
          $mh_state_general_merit_no = $request->input('mhStateGeneralmeritNo');
          $cet_month=$request->input('cet_month');
          $cet_year=$request->input('yearOfExam');
          $cet_percentile =$request->input('cetPercentile');
          $activedte= $request->session()->get('log_dte', 'null');
          $activeacap= $request->session()->get('log_acap','null');
          //return $minority_dte_merit_no;
        //Procedure

        if($activedte=='yes')
        {
          $type='DTE';
       // return    $dte_id;    
          $user1 = DB::table('mca_students')->select('dte_id','seat_type','allotted_cap_round','course_allotted','course_allotted_code','acap_category')->where('dte_id', $dte_id)->get();
         //  return $user1;
          $seat_type =$user1[0]->seat_type;
          $allotted_cap_round =$user1[0]->allotted_cap_round;
          $course_allotted = $user1[0]->course_allotted;
          $course_allotted_code =$user1[0]->course_allotted_code;
          // $category = $request->input('category');
          $cat_Radio = $request->input('cat_Radio');
           // return $cat_Radio;
          if ($cat_Radio== "Reserverd") {
            $category = $request->input('reservedcategory');  
          }
          if ($cat_Radio=="Minority") {
            $category =  $request->input('minoritycategory');  
          }
          if ($cat_Radio== "General") {
            $category = $request->input('opencategory');  
          }
          // return $category;
          
          if($user1[0]->acap_category == null || $user1[0]->acap_category == "NA" )
             $acap_category="NA";
          else
             $acap_category=$user1[0]->acap_category;
        }
        elseif($activeacap=='yes')
        {
          $user1 = DB::table('mca_students')->select('category','seat_type')->where('dte_id', $dte_id)->get();
         // return $user1;
          $type='ACAP';
        //     if(DB::table('dte_allotments')->where('dte_id', $dte_id)->exists())
        //   {
        //       $seat_type=$user1[0]->seat_type;

        //   }
        //   else
        //   {
              $seat_type ="NA";

        //  }

//           $seat_type ="NA";
          $allotted_cap_round ="NA";
          $course_allotted = "NA";
          $course_allotted_code ="0000000";
          // $acap_category = $request->input('category');
             

                 $cat_Radio = $request->input('cat_Radio');
           // return $cat_Radio;
          if ($cat_Radio== "Reserverd") {
            $category = $request->input('reservedcategory');  
          }
          if ($cat_Radio=="Minority") {
            $category =  $request->input('minoritycategory');  
          }
          if ($cat_Radio== "General") {
            $category = $request->input('opencategory');  
          }
 $acap_category=$category;



          if($user1 == '[]' || $user1[0]->category == null || $user1[0]->category == "NA" )
             $category="NA";
          else
             $category=$user1[0]->category;

        }
       // return $category;
    DB::select("call insert_update_mca_dte('$dte_id','$category','$candidate_type','$cet_score', '$cet_month', '$cet_year','$cet_percentile','$mh_state_general_merit_no','$type','$acap_category')");
    return redirect('mca_academic_details');
                  
    }

  




  public static function showmcaGuard(Request $request)
    {
    $dte_id = $request->session()->get('log_dte_id', 'null');
    if ($dte_id != 'null')
      {
         $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {
      $data = [];
      $check = DB::table('mca_students')->select('is_guardian_completed')->where('dte_id', $dte_id)->get(); 
      if (DB::table('mca_students')->select('is_guardian_completed')->where('dte_id', $dte_id)->exists() && $check[0]->is_guardian_completed == "1")
        {
        $user1 = DB::table('mca_students')->select('dte_id', 'g_relation', 'g_first_name', 'g_middle_name', 'g_last_name', 'g_mobile', 'g_occupation', 'g_qualification', 'g_office_address','g_office_tel_no','g_annual_income', 'mother_name', 'parent_domicile_no', 'parent_domicile_date', 'parent_domicile_appl_no', 'parent_domicile_appl_date','candidate_type','is_guardian_completed')->where('dte_id', $dte_id)->get();

          if(($user1[0]->parent_domicile_no == "0" && $user1[0]->parent_domicile_date == "1111-11-11")&&($user1[0]->parent_domicile_appl_no == "0" && $user1[0]->parent_domicile_appl_date == "1111-11-11"))
          {
              $parent_domicile = "na";
          }
          else if($user1[0]->parent_domicile_no == "0" && $user1[0]->parent_domicile_date == "1111-11-11")
          {
            $parent_domicile = "false";
          }
          else if($user1[0]->parent_domicile_appl_no == "0" && $user1[0]->parent_domicile_appl_date == "1111-11-11")
          {
            $parent_domicile = "true";
          }
          

        }
        else
        {
                                      $candidate_type = DB::table('mca_students')->select('candidate_type')->where('dte_id', $dte_id)->get()[0]->candidate_type;

        $array_object = [['dte_id' => $dte_id, 'is_guardian_completed'=>0,'g_relation' => 'F', 'g_first_name' => null, 'g_middle_name' => null, 'g_last_name' => null, 'g_mobile' => null, 'g_occupation' => null, 'g_office_address'=>null ,'g_office_tel_no'=> null ,'g_qualification' => null, 'g_annual_income' => null, 'mother_name' => null, 'parent_domicile_no' => null, 'parent_domicile_date' => null, 'parent_domicile_appl_no' => null, 'parent_domicile_appl_date' => null,'candidate_type'=>$candidate_type]];
        $user1 = json_decode(json_encode($array_object));
        $parent_domicile = "na";
        }

            $relations = array(
        'Husband' => 'H',
        'Parent' => 'F',
        'Guardian' => 'G'
      );




$course = $request->session()->get('log_course');
list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
if($userprogress[0]->is_personal_completed ==0){
return redirect('mca_personal_details');
}


      $data['user1'] = $user1;
      $data['relations'] = $relations;
      $data['parent_domicile'] =$parent_domicile;
      return view('user.mca.guardian_details', $data);
      }
      else
              return redirect()->route('mca_profile');
          }
      else
      {
      return redirect()->route('logout');
      }
    }


    public static function insertmcaGaurd(Request $request)
      {
 $dte_id=$request->session()->get('log_dte_id');
    $g_relation = $request->input('relation');
    $g_first_name = $request->input('firstName');
    $g_middle_name = $request->input('middleName');
    $g_last_name = $request->input('lastName');
    $mother_name = $request->input('motherMaidenName');
    $g_mobile = $request->input('mobile');
    $g_office_address=$request->input('office_address');
    $g_office_tel_no=$request->input('office_tel_no');
    $g_occupation = $request->input('occupation');
    $g_qualification = $request->input('qualification');
    $g_annual_income = $request->input('annualIncome');
   
   
   if($g_office_tel_no == null)
        $g_office_tel_no =0; 
    
    if($g_office_address == null)
        $g_office_address= "NA";
    $if_domecile=$request->input('dom');
    //return $g_relation;
    if($if_domecile=="yes")
    {
         $parent_domicile_no = $request->input('parentDomecileNo');
        $parent_domicile_date = $request->input('dateOfParentDomecile');
       // return $parent_domicile_date;
        $parent_domicile_appl_no = "0";
         $parent_domicile_appl_date = "1111-11-11";
    }
    if($if_domecile=="no")
    {
         $parent_domicile_appl_no = $request->input('parentDomecileApplicationNo');
         $parent_domicile_appl_date = $request->input('applicationDateOfParentDomecile');
         $parent_domicile_no ="0";
         $parent_domicile_date = "1111-11-11";
    }
    if($if_domecile=="na")
    {
        $parent_domicile_appl_no = "0";
         $parent_domicile_appl_date = "1111-11-11";
         $parent_domicile_no ="0";
         $parent_domicile_date = "1111-11-11";
    }
  if (DB::table('mca_students')->where('dte_id', $dte_id)->exists()) 
         { 
        /*$me_students  = me_students::find($dte_id);
        }
    $me_students->dte_id = $dte_id;
    $me_students->g_relation = $g_relation;
    $me_students->g_first_name = $g_first_name;
    $me_students->g_middle_name = $g_middle_name;
    $me_students->g_last_name = $g_last_name;
    $me_students->mother_name = $mother_name;
    $me_students->g_mobile = $g_mobile;
    $me_students->g_occupation = $g_occupation;
    $me_students->g_qualification = $g_qualification;
    $me_students->g_annual_income = $g_annual_income;
    $me_students->parent_domicile_no = $parent_domicile_no;
    $me_students->parent_domicile_date = $parent_domicile_date;
    $me_students->parent_domicile_appl_no = $parent_domicile_appl_no;
    $me_students->parent_domicile_appl_date = $parent_domicile_appl_date;
    $me_students->save();*/
    
    
    //Procedure
     $mob=DB::table('student_login')->select('mobile')->where('dte_id', $dte_id)->get();
    if($mob[0]->mobile==$g_mobile){
         $request->session()->flash('error','Please fill different mobile number ');
        return redirect('mca_guardian_details');
    }
    DB::select("call insert_update_mca_guardian('$dte_id','$g_relation','$g_first_name','$g_middle_name','$g_last_name','$g_mobile','$g_occupation','$g_qualification','$g_office_address','$g_office_tel_no','$g_annual_income','$parent_domicile_no','$parent_domicile_date','$parent_domicile_appl_no','$parent_domicile_appl_date','$mother_name')");
    return redirect('mca_contact_details');}

    }

  public static function showmcaPersonal(Request $request)
    {
    $dte_id = $request->session()->get('log_dte_id', 'null');

    if ($dte_id != 'null')
      {
         $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {
      $data = [];
      $blood_groups = array(
        'A+' => 'A+',
        'A-' => 'A-',
        'B+' => 'B+',
        'B-' => 'B-',
        'AB+' => 'AB+',
        'AB-' => 'AB-',
        'O+' => 'O+',
        'O-' => 'O-',
        'un' => 'Unknown'
      );
      $genders = array(
        'Male' => 'Male',
        'Female' => 'Female',
        'Others' => 'Other'
      );
      $data['blood_groups'] = $blood_groups;
      $data['genders'] = $genders;

        $check = DB::table('mca_students')->select('is_personal_completed')->where('dte_id', $dte_id)->get(); 
      if (DB::table('mca_students')->select('is_personal_completed')->where('dte_id', $dte_id)->exists() && $check[0]->is_personal_completed == "1")
        {

        $user1 = DB::table('mca_students')->select('dte_id', 'name_on_marksheet','gender', 'date_of_birth', 'place_of_birth_city', 'place_of_birth_state', 'student_domicile_no', 'student_domicile_date', 'student_domicile_appl_no', 'student_domicile_appl_date', 'mother_tongue', 'nationality', 'caste_tribe', 'religion', 'blood_group', 'uid','is_personal_completed')->where('dte_id', $dte_id)->get();

            if(($user1[0]->student_domicile_no == "0" && $user1[0]->student_domicile_date == "1111-11-11")&&($user1[0]->student_domicile_appl_no == "0" && $user1[0]->student_domicile_appl_date == "1111-11-11"))
            {
                      $domicile = "na";
            }
          else if($user1[0]->student_domicile_no == "0" && $user1[0]->student_domicile_date == "1111-11-11")
          {
             $domicile = "false";
          }
          elseif($user1[0]->student_domicile_appl_no == "0" && $user1[0]->student_domicile_appl_date == "1111-11-11")
          {
            $domicile = "true";
          }
        

        }
        else
        {
        $array_object = [['dte_id' => $dte_id,'is_personal_completed'=>0 ,'name_on_marksheet' => null, 'gender' => 'Male', 'date_of_birth' => null, 'place_of_birth_city' => null, 'place_of_birth_state' => null, 'student_domicile_no' => null, 'student_domicile_date' => null, 'student_domicile_appl_no' => null, 'student_domicile_appl_date' => null, 'mother_tongue' => null, 'nationality' => null, 'caste_tribe' => null, 'religion' => null, 'blood_group' => null, 'uid' => null]];
        $user1 = json_decode(json_encode($array_object));
        $domicile = "true";
        }
$course = $request->session()->get('log_course');
list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
if($userprogress[0]->is_academic_completed ==0){
return redirect('mca_academic_details');
}
      $data['user1'] = $user1;
      $data['domicile'] = $domicile;



      return view('user.mca.personal_details', $data);
      }
      else
              return redirect()->route('mca_profile');
          }
      else
      {
      return redirect()->route('logout');
      }
    }

     public static function insertmcaPersonal(Request $request)
      {
    $dte_id=$request->session()->get('log_dte_id'); 
    $name_on_marksheet = $request->input('nameAsOnMarksheet');
    $gender = $request->input('gender');
    $date_of_birth = $request->input('dob');
   //  return $date_of_birth;
    $if_domecile=$request->input('dom');
    $place_of_birth_city = $request->input('placeOfBirthCity');
    $place_of_birth_state = $request->input('placeOfBirthState');
    $student_domicile_no = $request->input('domicileNumber');
    $student_domicile_date = $request->input('domicileDate');
    $student_domicile_appl_no = $request->input('applicationNumber');
    $student_domicile_appl_date = $request->input('applictionDate');
    $mother_tongue = $request->input('motherTongue');
    $nationality = $request->input('nationality');
    $caste_tribe = $request->input('casteTribe');
    $religion = $request->input('religion');
    $blood_group = $request->input('bloodGroup');
    $uid = $request->input('uid');
    if($if_domecile=="yes")
    {
        $student_domicile_appl_no = "0";
         $student_domicile_appl_date = "1111-11-11";
    }
    if($if_domecile=="no")
    {
         $student_domicile_no ="0";
         $student_domicile_date = "1111-11-11";
    }
    if($if_domecile=="na")
    {
        $student_domicile_appl_no = "0";
        $student_domicile_appl_date = "1111-11-11"; 
        $student_domicile_no ="0";
        $student_domicile_date = "1111-11-11";
        
    }
    
    if (DB::table('mca_students')->where('dte_id', $dte_id)->exists()) 
         { 
        /*$me_students  = me_students::find($dte_id);
        }
    $me_students->dte_id = $dte_id;
    $me_students->name_on_marksheet = $name_on_marksheet;
    $me_students->first_name = $first_name;
    $me_students->middle_name = $middle_name;
    $me_students->last_name = $last_name;
    $me_students->gender = $gender;
    $me_students->date_of_birth = $date_of_birth;
    $me_students->place_of_birth = $place_of_birth;
    $me_students->student_domicile_no = $student_domicile_no;
    $me_students->student_domicile_date = $student_domicile_date;
    $me_students->student_domicile_appl_no = $student_domicile_appl_no;
    $me_students->student_domicile_appl_date = $student_domicile_appl_date;
    $me_students->mother_tongue = $mother_tongue;
    $me_students->nationality = $nationality;
    $me_students->caste_tribe = $caste_tribe;
    $me_students->religion = $religion;
    $me_students->blood_group = $blood_group;
    $me_students->uid = $uid;
    $me_students->save();*/
    

    //Prcedure
    DB::select("call insert_update_mca_personal('$dte_id','$name_on_marksheet','$gender','$date_of_birth','$place_of_birth_state','$place_of_birth_city','$mother_tongue','$nationality','$caste_tribe ','$religion','$blood_group','$uid','$student_domicile_no','$student_domicile_date','$student_domicile_appl_no','$student_domicile_appl_date')");
    return redirect('mca_guardian_details');
  }

}
  public static function showmcaWelcome(Request $request)
    {
    return view('user.mca.welcome');
    }

  public static function showmcaProfile(Request $request)
    {
    $dte_id = $request->session()->get('log_dte_id', null);
    $course = $request->session()->get('log_course');

    DB::table('student_login')->where('dte_id', $dte_id)->update(['dte_login' => 0, 'acap_login' => 0]);
    if ($dte_id != null)
      {

          $dtes = DB::select(DB::raw("SELECT event_name, event_from_date, event_to_date, event_type FROM event WHERE event_type = 'DTE' AND course LIKE '%".$course."%'"));
          /*DB::table('event')->select('event_name', 'event_from_date', 'event_to_date','event_type')->where('event_type' , 'DTE' AND 'course' , $course)->get();*/
         $acaps = DB::select(DB::raw("SELECT event_name, event_from_date, event_to_date, event_type FROM event WHERE event_type = 'ACAP' AND course LIKE '%".$course."%'"));
         /*DB::table('event')->select('event_name', 'event_from_date', 'event_to_date','event_type')->where('event_type' , 'ACAP' AND 'course' , $course)->get();*/
        

        //eligibility
         if(DB::table('dte_allotments')->where('dte_id', $dte_id)->exists())
               { $eligibility=1;}
          else
               { $eligibility=0;}


        //status
        $user1 =DB::select(DB::raw("SELECT status_to from status_details where dte_id LIKE '%".$dte_id."%' AND event_to = 'DTE' ORDER BY updated_at DESC LIMIT 1"));

        if($user1==[] || $user1==null)
          {
              if($eligibility==1) 
                $status_dte='Eligible';
              else 
                $status_dte='Not Eligible';
          }
         elseif( $user1!=[])   
          {
              if($eligibility==1) 
                $status_dte=$user1[0]->status_to;
              else 
                $status_dte='Not Eligible';
          }

            //acap
        $user2 =DB::select(DB::raw("SELECT status_to from status_details where dte_id LIKE '%".$dte_id."%' AND event_to = 'ACAP' ORDER BY updated_at DESC LIMIT 1"));
        //return $user2;
        if($user2==[] || $user2==null)
          {
                $status_acap='Eligible For Acap';
          }
         elseif( $user2!=[])   
          {
                $status_acap=$user2[0]->status_to;
          }
        


        
        

      $data = [];
      $data['dtes'] = $dtes;
      $data['acaps'] = $acaps;
      $data['status_dte'] = $status_dte;  
        $data['status_acap'] = $status_acap;  
      return view('user.mca.profile', $data);
      }
      else
      {
      return redirect()->route('logout');
      }
    }

    public static function showmcaFeePayment()
    {
      return view('user.mca.feePayment');
    }

  // ME Module

  public static function showacapFormPayment(Request $request)
    {
       // $dte_id = $request->session()->get('log_dte_id');
       //  $course = $request->session()->get('log_course');
       //    list( $user1['prog_val'],$userprogress)= HomeController::meprogressbar($course,$dte_id);
       //    $data['user1']=$user1;
    return view('user.me.acap_form_payment');
    
    }

  public static function completeacapFormPayment(Request $request)
    {

    // return view('user.me.acap_form_payment');    //Payment Gateway

    }

  public static function showmeAca(Request $request)
    {
    $dte_id =$request->session()->get('log_dte_id', 'null');

    if ($dte_id != 'null')
      {
          $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {
                       $data = [];
              $newOrOldSystem = array(
                'N' => 'New',
                'O' => 'Old',
              );
              $data['newOrOldSystem'] = $newOrOldSystem;
              $diplomaOrHsc = array(
                'D' => 'Diploma',
                'H' => 'HSC'
              );
               $data['diplomaOrHsc'] = $diplomaOrHsc;
              $months = array(
                'Jan' => 'Jan',
                'Feb' => 'Feb',
                'Mar' => 'Mar',
                'Apr' => 'Apr',
                'May' => 'May',
                'Jun' => 'Jun',
                'Jul' => 'Jul',
                'Aug' => 'Aug',
                'Sep' => 'Sep',
                'Oct' => 'Oct',
                'Nov' => 'Nov',
                'Dec' => 'Dec'
              );
              $data['months'] = $months;
              $clg_university_types = array(
                'Mumbai_University' => 'HU(Home University)',
                 'OMS' => 'OMS(Other than Mumbai University)'
              );

                $university_types = array(
                'Maharashtra_Board' => 'Maharashtra Board',
                'CBSE' => 'CBSE',
                'ICSE' => 'ICSE',
                'OTHER'=> 'Other'
              );
              $data['university_types'] = $university_types;
              $data['clg_university_types'] = $clg_university_types;

              $data['diplomaOrHsc'] = $diplomaOrHsc;
              $status = DB::table('me_students')->select('is_academic_completed')->where('dte_id', $dte_id)->get();
              if (DB::table('me_students')->select('is_academic_completed')->where('dte_id', $dte_id)->exists() && $status[0]->is_academic_completed == "1")
                {
                    $user1 = DB::table('me_students')->select('dte_id', 'x_board','x_school_name', 'x_school_city','x_school_state', 'x_max_marks', 'x_obtained_marks','x_passing_month','x_passing_year', 'x_percentage', 'is_diploma', 'xii_board','xii_college_name','xii_college_city','xii_college_state','xii_passing_month','xii_passing_year','diploma_university', 'xii_max_marks', 'xii_obtained_marks', 'xii_percentage','diploma_college_name','diploma_college_city','diploma_college_state','university_type', 'diploma_max_marks', 'diploma_passing_month','diploma_obtained_marks', 'diploma_percentage', 'diploma_branch', 'degree_university','degree_college_state','diploma_passing_year','degree_passing_month', 'degree_passing_year', 'degree_college_name','degree_name','degree_branch','degree_sem_1_obt_marks','degree_sem_1_max_marks','degree_sem_2_obt_marks','degree_sem_2_max_marks','degree_sem_3_obt_marks','degree_sem_3_max_marks','degree_sem_4_obt_marks','degree_sem_4_max_marks','degree_sem_5_obt_marks','degree_sem_5_max_marks','degree_sem_6_obt_marks','degree_sem_6_max_marks','degree_sem_7_obt_marks','degree_sem_7_max_marks','degree_sem_8_obt_marks','degree_sem_8_max_marks', 'degree_percentage','degree_college_city', 'degree_final_cgpa','is_new_or_old','degree_aggr_obt_marks','degree_aggr_max_marks','is_academic_completed')->where('dte_id', $dte_id)->get();
                     //  return $user1[0]->degree_sem_8_max_marks;
                    if($user1[0]->degree_sem_8_obt_marks == 0 && $user1[0]->degree_sem_8_max_marks  == 0 )
                    {
                       $notDeclared1 = "true";
                    }
                    else
                     $notDeclared1 = "false";
                    // return $user1[0]->is_diploma;
              /*        
              if($user1[0]->not_declared == "ND")
                $not_declared = "true";
              else
                $not_declared = "false";*/
             
                      
               }
               else
               {
                      $array_object = [['dte_id' => $dte_id, 'x_board' => null,/*'not_declared'=>false,*/'x_school_name' => null,'x_school_city' => null,'x_school_state' => null,'x_max_marks' => null, 'x_obtained_marks' => null,'x_passing_month' => null,'x_passing_year' => 0000, 'x_percentage' => null, 'is_diploma' => 'D', 'xii_board' => null,'xii_college_name' => null,'xii_college_city' => null,'xii_college_state' => null,'xii_passing_month' => null,'xii_passing_year' => 0000, 'xii_max_marks' => null, 'xii_obtained_marks' => null, 'xii_percentage' => null,'diploma_college_name' => null,'diploma_college_city' => null,'diploma_college_state' => null, 'diploma_max_marks' => null, 'diploma_obtained_marks' => null, 'diploma_percentage' => null, 'diploma_branch' => null, 'degree_university' => null,'degree_passing_month' => null ,'degree_passing_year' => 0000, 'degree_college_name' => null,'degree_name'=>null,'degree_branch'=>null, 'degree_sem_1_obt_marks' => null, 'degree_sem_1_max_marks' => null, 'degree_sem_2_obt_marks' => null, 'degree_sem_2_max_marks' => null, 'degree_sem_3_obt_marks' => null, 'degree_sem_3_max_marks' => null, 'degree_sem_4_obt_marks' => null, 'degree_sem_4_max_marks' => null, 'degree_sem_5_obt_marks' => null, 'degree_sem_5_max_marks' => null, 'degree_sem_6_obt_marks' => null, 'degree_sem_6_max_marks' => null, 'degree_sem_7_obt_marks' => null, 'degree_sem_7_max_marks' => null, 'degree_sem_8_obt_marks' => null, 'degree_sem_8_max_marks' => null,'degree_college_city' => null,'degree_college_state' => null, 'degree_aggr_obt_marks' => null, 'degree_aggr_max_marks' => null,'diploma_university'=>null, 'degree_sem1_sgpa' => null, 'degree_sem2_sgpa' => null, 'degree_sem3_sgpa' => null, 'degree_sem4_sgpa' => null, 'degree_sem5_sgpa' => null, 'degree_sem6_sgpa' => null, 'degree_sem7_sgpa' => null, 'degree_sem8_sgpa' => null,'degree_percentage' => null,'university_type'=>'HU', 'degree_final_cgpa' => null,'diploma_passing_month'=>null,'diploma_passing_year'=>0000,'is_academic_completed'=> null,'is_new_or_old'=> 'N' ]];
                      $user1 = json_decode(json_encode($array_object));

                      $notDeclared1 = "false";
                      
                }


                  $course = $request->session()->get('log_course');

              list($user1['prog_val'],$userprogress)= HomeController::meprogressbar($course,$dte_id);
                        if ($userprogress[0]->is_dte_completed==0) {
                 // HomeController::showfeDte();
                return redirect('me_dte_details');
               }

                  $data['user1'] = $user1;
                   $data['notDeclared1'] = $notDeclared1;
/*                   $data['notDeclared1'] = $notDeclared1;
                      $data['notDeclared2'] = $notDeclared2;
                      $data['notDeclared3'] = $notDeclared3;
                      $data['notDeclared4'] = $notDeclared4;
                      $data['notDeclared5'] = $notDeclared5;
                      $data['notDeclared6'] = $notDeclared6;
                      $data['notDeclared7'] = $notDeclared7;
                      $data['notDeclared8'] = $notDeclared8;*/
                  //return $user1;
                  return view('user.me.academic_details', $data);
          }
          else
              return redirect()->route('me_profile');
          
      }
      
      else
      {
      return redirect()->route('logout');
      }
    }


  public static function showmeContact(Request $request)
    {
    $dte_id = $request->session()->get('log_dte_id', 'null');
    if ($dte_id != 'null')
      {
        $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {
      $data = [];
      $residences = array(
        'Local' => 'L',
        'Outstation' => 'O'
      );
      $data['residences'] = $residences;

      $check = DB::table('me_students')->select('is_contact_completed')->where('dte_id', $dte_id)->get(); 
      if (DB::table('me_students')->select('is_contact_completed')->where('dte_id', $dte_id)->exists() && $check[0]->is_contact_completed == "1")
        {
        $user1 = DB::table('me_students')->select('dte_id', 'permanent_address_line1', 'permanent_address_line2', 'permanent_city','permanent_district', 'permanent_state', 'permanent_pincode', 'permanent_nearest_rail_station', 'correspondance_address_line1', 'correspondance_address_line2', 'correspondance_city', 'correspondance_state', 'correspondance_pincode', 'correspondance_nearest_rail_station', 'resident_of', 'local_guardian_name', 'local_guardian_address_line1', 'local_guardian_address_line2', 'local_guardian_city','correspondance_district', 'local_guardian_state', 'local_guardian_pincode','is_contact_completed')->where('dte_id', $dte_id)->get();
        }
        else
        {
        $array_object = [['dte_id' => $dte_id,'is_contact_completed'=>0 ,'permanent_address_line1' => null, 'permanent_address_line2' => null, 'permanent_city' => null, 'permanent_state' => null,'permanent_district' => null, 'permanent_pincode' => null, 'permanent_nearest_rail_station' => null, 'correspondance_address_line1' => null, 'correspondance_address_line2' => null, 'correspondance_city' => null, 'correspondance_state' => null, 'correspondance_district' => null, 'correspondance_pincode' => null, 'correspondance_nearest_rail_station' => null, 'resident_of' => 'Local', 'local_guardian_name' => null, 'local_guardian_address_line1' => null, 'local_guardian_address_line2' => null, 'local_guardian_city' => null, 'local_guardian_state' => null, 'local_guardian_pincode' => null,' is_contact_completed' => 0]];
        $user1 = json_decode(json_encode($array_object));
        }
        $course = $request->session()->get('log_course');
list($user1['prog_val'],$userprogress)= HomeController::meprogressbar($course,$dte_id);
if($userprogress[0]->is_guardian_completed==0){
  return redirect('me_guardian_details');
}
      $data['user1'] = $user1;

      $data['status'] = "Not Submitted";
      if($user1[0]->correspondance_address_line1 == $user1[0]->permanent_address_line1 && $user1[0]->correspondance_address_line1 != null )
        $data['permanent'] = "true";
      elseif($user1[0]->correspondance_address_line1 == null)
        $data['permanent'] = "false";
      else
        $data['permanent'] = "false";
      return view('user.me.contact_details', $data);
      }
          else
              return redirect()->route('me_profile');
          }
      else
      {
      return redirect()->route('logout');
      }
    }


  public function view($id,Request $request)
    {
   // return $id;
 if ($id == 'DTE')
      {
           $course = $request->session()->get('log_course');
           date_default_timezone_set("Asia/Kolkata");
        $dte_id = $request->session()->get('log_dte_id');
        //return $course;
        if($course == "MCA")
        {
            $users1 = DB::table("mca_students")->where('dte_id',$dte_id)->get();
            $users1 = json_decode(json_encode($users1));
            // $users3 = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.dte_id  LIKE '%".$dte_id."%' "));
            // $users3 = json_decode(json_encode($users1));
        }
        if($course == "MEG")
        {
            $users1 = DB::table("me_students")->where('dte_id',$dte_id)->get();
            $users1 = json_decode(json_encode($users1));
        }
         if($course == "FEG")
        {
            $users1 = DB::table("fe_students")->where('dte_id',$dte_id)->get();
            $users1 = json_decode(json_encode($users1));
        }
         if($course == "DSE")
        {
            $users1 = DB::table("dse_students")->where('dte_id',$dte_id)->get();
            $users1 = json_decode(json_encode($users1));
        }
        $users2 = DB::table("student_login")->where('dte_id',$dte_id)->get();
        $users3 = DB::select(DB::raw("SELECT * FROM `dte_allotments` WHERE dte_id LIKE '%".$dte_id."%'"));
       $user4 = DB::select(DB::raw("SELECT * FROM `fees_transaction` WHERE dte_id LIKE '%".$dte_id."%' AND trans_status = 'SUCCESS' AND admission_type = 'DTE' ORDER BY payment_timestamp DESC LIMIT 1"));
       // return $user4[0]->payment_mode;
       if($user4[0]->payment_mode == "DEMAND DRAFT")
       {
           $user5 = DB::select(DB::raw("SELECT * FROM `dd_details` WHERE email LIKE '%".$users2[0]->email."%' ORDER BY updated_at DESC LIMIT 1")); 
           $ddno = $user5[0]->dd_no;
           $bank_name = $user5[0]->bank_name;
           $amount = $user4[0]->trans_amt;
           $Trans_id  = null;
           $ref_no = null;
       }
       else
       {
           $Trans_id = $user4[0]->trans_id;
           $ref_no =  $user4[0]->ref_no;
           $amount = $user4[0]->trans_amt;
           $ddno = null;
           $bank_name = null;
       }
       // return $users3;
        $users2 = json_decode(json_encode($users2));
        $users1['email'] = $users2[0]->email;
        $users1['mobile'] = $users2[0]->mobile;
        $users1['hash'] = $users2[0]->hash;
        $users1['last_name'] = $users2[0]->last_name;
        $users1['first_name'] = $users2[0]->first_name;
        $users1['middle_name'] = $users2[0]->middle_name;
        $users1['date'] = date("d-m-Y");
        $users1['dat']=date("d-m-Y ");
        $users1['seat_type_allotted']= $users3[0]->dte_seat_type_allotted;
        $users1['payment_mode'] = $user4[0]->payment_mode;
        $users1['dd_no'] = $ddno;
        $users1['bank_name'] = $bank_name;
        $users1['amount'] = $amount;
        $users1['trans_id'] = $Trans_id;
        $users1['ref_no'] = $ref_no;
        $users1['shift_allotted']= $users3[0]->shift_allotted;

        if($course == "MCA")
        {
            view()->share('users1',$users1);
         $users1['shift_allotted']= $users3[0]->shift_allotted;
         $users1['branch_allotted']= $users3[0]->branch;
         //return $users1;
       return view('user.mca.pdfview',$users1);
            // $pdf = PDF::loadView('user.mca.pdfview');
            // return $pdf->stream('user.mca.pdfview.pdf');
       
            
        }
        elseif($course == "MEG")
        {
        view()->share('users1',$users1);
        
        $users1['branch_allotted']= $users3[0]->branch;
        return view('user.me.pdfview') ;
           // $pdf = PDF::loadView('user.me.pdfview');
           //  return $pdf->stream('user.me.pdfview.pdf');
        }
        elseif($course == "FEG")
        {

        view()->share('users1',$users1);
        //return $users1;
        
        
            $users1['branch_allotted']= $users3[0]->branch;
        return view('user.fe.pdfview',$users1);
           // $pdf = PDF::loadView('user.fe.pdfview');
           //  return $pdf->stream('user.fe.pdfview.pdf');
        }
        elseif($course == "DSE")
        {
          //Shift alloted is required for DSE and fe
        view()->share('users1',$users1);

        

            $users1['branch_allotted']= $users3[0]->branch;
        return view('user.dse.pdfview',$users1);
           // $pdf = PDF::loadView('user.dse.pdfview');
           //  return $pdf->stream('user.dse.pdfview.pdf');
        }
       
      }
    elseif ($id == 'ACAP')
      {
          
        $course = $request->session()->get('log_course');
        $dte_id = $request->session()->get('log_dte_id');
        if($course == "MCA")
        {
            $users1 = DB::table("mca_students")->where('dte_id',$dte_id)->get();
            $users1 = json_decode(json_encode($users1));
            
        }
        if($course == "MEG")
        {
            $users1 = DB::table("me_students")->where('dte_id',$dte_id)->get();
            $users1 = json_decode(json_encode($users1));
        }

        if($course == "FEG")
        {
            $users1 = DB::table("fe_students")->where('dte_id',$dte_id)->get();
            $users1 = json_decode(json_encode($users1));
        }

        if($course == "DSE")
        {
            $users1 = DB::table("dse_students")->where('dte_id',$dte_id)->get();
            $users1 = json_decode(json_encode($users1));
        }
        
         //return $users1[0]->shfit_allotted;
            $users2 = DB::table("student_login")->where('dte_id',$dte_id)->get();
            $users2 = json_decode(json_encode($users2));
            $users1['email'] = $users2[0]->email;
            $users1['mobile'] = $users2[0]->mobile;
            $users1['hash'] = $users2[0]->hash;
            $users1['shift_allotted']= "-";
             date_default_timezone_set("Asia/Kolkata");
             $users1['date'] =  date("d-m-Y H:i:s");
        
            view()->share('users1',$users1);

            if($course == "MCA")
            {
            $pdf = PDF::loadView('user.mca.pdfview_acap_mca');
            return $pdf->stream('user.mca.pdfview_acap_mca.pdf');
              // return view('user.mca.pdfview_acap_mca',$users1);
            }
            elseif($course == "MEG")
            {
                //$pdf = PDF::loadView('user.me.pdfview_acap_me');
           // return $pdf->stream('user.me.pdfview_acap_me.pdf');
            return view('user.me.pdfview_acap_me',$users1);
            }
            elseif($course == "FEG")
            {

               $pdf = PDF::loadView('user.fe.pdfview_acap_fe');
                //return $users1;
            return $pdf->stream('user.fe.pdfview_acap_fe.pdf');
                return view('user.fe.pdfview_acap_fe',$users1);

            
            }
            elseif($course == "DSE")
            {
                $pdf = PDF::loadView('user.dse.pdfview_acap_dse');
            return $pdf->stream('user.dse.pdfview_acap_dse.pdf');
                return view('user.dse.pdfview_acap_dse',$users1);
            
            }

      }
     
    }

   public static function showmeDte(Request $request)
    {

     $activedte= $request->session()->get('log_dte', 'null');
     $activeacap= $request->session()->get('log_acap','null');

     $dte_id = $request->session()->get('log_dte_id', 'null');

    if ($dte_id != 'null')
      {
         $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {
      $data = [];
      $months = array(
        'Jan' => 'Jan',
        'Feb' => 'Feb',
        'Mar' => 'Mar',
        'Apr' => 'Apr',
        'May' => 'May',
        'Jun' => 'Jun',
        'Jul' => 'Jul',
        'Aug' => 'Aug',
        'Sep' => 'Sep',
        'Oct' => 'Oct',
        'Nov' => 'Nov',
        'Dec' => 'Dec'
      );
       if($activedte=='yes')
       {
      $categories = array(
        'OPEN MU' => 'Open Mumbai University',
        'OPEN SINDHI MINORITY' => 'Open Sindhi Minority',
        'OPEN OMU' => 'OPEN Other Than Mumbai University',
        'SC MU' => 'SC Mumbai University',
        'SC OMU' => 'SC Other than Mumbai University',
        'EWS'=>'EWS',
        'PWD'=>'PWD',
        'OMS' => 'Other than Maharashta State'
        
      );
    }
    elseif ($activeacap=='yes') {
      $categories = array(
        'OPEN' => 'Open',
        'SINDHI' => 'Sindhi Minority'
      );
    }
      $candidate_types = array(
        'A' => 'Type A',
        'B' => 'Type B',
        'C' => 'Type C',
        'D' => 'Type D',
        'E' => 'Type E',
        'F' => 'Type F'
      );
     


      $data['months'] = $months;
      $data['categories'] = $categories;
      $data['candidate_types'] = $candidate_types;
      $opentype= DB::select(DB::raw("SELECT  GROUP_CONCAT( DISTINCT fee_category) AS fee_category FROM fees_structure WHERE course='MEG' AND type='NONMINORITY' "));          

          $minotype=DB::select(DB::raw("SELECT GROUP_CONCAT( DISTINCT fee_category) AS fee_category FROM fees_structure WHERE course='MEG' AND type='MINORITY' "));
          $reservedtype=DB::select(DB::raw("SELECT GROUP_CONCAT( DISTINCT fee_category) AS fee_category FROM fees_structure WHERE course='MEG' AND type='RESERVED' "));
$categories=array('open'=>$opentype,'minotype'=>$minotype,'reservedtype'=>$reservedtype);
        $data['open']=explode(",",$opentype[0]->fee_category);
        $data['minotype']=explode(",",$minotype[0]->fee_category);
        $data['reservedtype']=explode(",",$reservedtype[0]->fee_category);
      // return $data;

      $check = DB::table('me_students')->select('is_dte_completed')->where('dte_id',$dte_id)->get() ;
     // return $check[0]->is_dte_completed ;
      if (DB::table('me_students')->where('dte_id', $dte_id)->exists() && $check[0]->is_dte_completed == 1)
        {
        $user1 = DB::table('me_students')->select('dte_id','sponsoring_company', 'category', 'candidate_type','is_sponsored','gate_score','mh_state_general_merit_no','seat_type','allotted_cap_round','course_allotted','course_allotted_code','gate_month','gate_year','gate_reg_no','gate_branch','sponsoring_company','gate_exam_paper','gate_max_marks','dte_branch')->where('dte_id',$dte_id)->get();
        //return $user1;
           if($user1[0]->is_sponsored == 0)
                $sponsored_org = "false";
              else
                $sponsored_org = "true";
        }
        else
        {
          if($activedte=='yes')
          {
             
               $user2 = DB::table('dte_allotments')->select('dte_seat_type_allotted','allotted_cap_round','course_allotted','course_allotted_code','branch')->where('dte_id', $dte_id)->get();
               //return $user2;
                 $array_object = [['dte_id' => $dte_id, 'dte_password' => null, 'category' => null,'acap_category'=>null ,'sponsoring_company'=>null,'candidate_type' => null, 'gate_score' => null, 'mh_state_general_merit_no' => null,'seat_type' => $user2[0]->dte_seat_type_allotted,'allotted_cap_round' => $user2[0]->allotted_cap_round,'course_allotted' =>$user2[0]->course_allotted,'course_allotted_code' =>$user2[0]->course_allotted_code,'gate_month' => null,'dte_branch'=>$user2[0]->branch,'gate_year' => 0,'gate_reg_no'=>null,'gate_branch'=>null,'gate_max_marks' => null,'gate_exam_paper'=>null,'sponsoring_company'=>null]];
                $user1 = json_decode(json_encode($array_object));
                $sponsored_org = "false";
                 
          }
          elseif($activeacap=='yes')
          {
            $array_object = [['dte_id' => $dte_id, 'dte_password' => null, 'category' => null, 'sponsoring_company'=>null,'candidate_type' => null, 'gate_score' => null, 'mh_state_general_merit_no' => null,'seat_type' => null,'allotted_cap_round' => null,'course_allotted' => null,'course_allotted_code' => null,'gate_month' => null,'gate_year' => 0000,'dte_branch' => null,'gate_reg_no'=>null,'gate_branch'=>null,'gate_max_marks' => null,'gate_exam_paper'=>null]];
                    $user1 = json_decode(json_encode($array_object));
                    $sponsored_org = "false";
        }
        
     }
     $course = $request->session()->get('log_course');
list($user1['prog_val'],$userprogress)= HomeController::meprogressbar($course,$dte_id);
    //return $sponsored_org;
      // return $userprogress;
      $data['user1'] = $user1;
      $data['sponsored_org'] = $sponsored_org;
      $data['activedte'] = $activedte;
      $data['activeacap'] = $activeacap;
      //return $data;
      return view('user.me.dte_details', $data);
      }

          else
              return redirect()->route('me_profile');
          }
      else
      {
      return redirect()->route('logout');
      }
    }

  public static function showmeGuard(Request $request)
    {
    $dte_id = $request->session()->get('log_dte_id', 'null');
    if ($dte_id != 'null')
      {
         $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {
      $data = [];
      $check = DB::table('me_students')->select('is_guardian_completed')->where('dte_id', $dte_id)->get(); 
      if (DB::table('me_students')->select('is_guardian_completed')->where('dte_id', $dte_id)->exists() && $check[0]->is_guardian_completed == "1")
        {
        $user1 = DB::table('me_students')->select('dte_id', 'g_relation', 'g_first_name', 'g_middle_name', 'g_last_name', 'g_mobile', 'g_occupation', 'g_qualification', 'g_office_address','g_office_tel_no','g_annual_income', 'mother_name', 'parent_domicile_no', 'parent_domicile_date', 'parent_domicile_appl_no', 'parent_domicile_appl_date','candidate_type','is_guardian_completed')->where('dte_id', $dte_id)->get();
          //return $user1[0]->candidate_type;
          
          if(($user1[0]->parent_domicile_no == "0" && $user1[0]->parent_domicile_date == "1111-11-11")&&($user1[0]->parent_domicile_appl_no == "0" && $user1[0]->parent_domicile_appl_date == "1111-11-11"))
          {
              $parent_domicile = "na";
          }
          else if($user1[0]->parent_domicile_no == "0" && $user1[0]->parent_domicile_date == "1111-11-11")
          {
            $parent_domicile = "false";
          }
          else if($user1[0]->parent_domicile_appl_no == "0" && $user1[0]->parent_domicile_appl_date == "1111-11-11")
          {
            $parent_domicile = "true";
          }
          

        }
        else
        {
                          $candidate_type = DB::table('me_students')->select('candidate_type')->where('dte_id', $dte_id)->get()[0]->candidate_type;

        $array_object = [['dte_id' => $dte_id, 'is_guardian_completed'=>0,'g_relation' => 'F', 'g_first_name' => null, 'g_middle_name' => null, 'g_last_name' => null, 'g_mobile' => null, 'g_occupation' => null, 'g_office_address'=>null ,'g_office_tel_no'=> null ,'g_qualification' => null, 'g_annual_income' => null, 'mother_name' => null, 'parent_domicile_no' => null, 'parent_domicile_date' => null, 'parent_domicile_appl_no' => null, 'parent_domicile_appl_date' => null,'candidate_type'=>$candidate_type]];
        $user1 = json_decode(json_encode($array_object));
        $parent_domicile = "na";
        }

            $relations = array(
        'Husband' => 'H',
        'Parent' => 'F',
        'Guardian' => 'G'
      );
      $course = $request->session()->get('log_course');
list($user1['prog_val'],$userprogress)= HomeController::meprogressbar($course,$dte_id);
               if ($userprogress[0]->is_personal_completed==0) {
                 // HomeController::showfeDte();
                return redirect('me_personal_details');
               }

      $data['user1'] = $user1;
      $data['relations'] = $relations;
      $data['parent_domicile'] =$parent_domicile;
      return view('user.me.guardian_details', $data);
      }
      else
              return redirect()->route('me_profile');
          }
      else
      {
      return redirect()->route('logout');
      }
    }



  public static function showmePersonal(Request $request)
    {
    $dte_id = $request->session()->get('log_dte_id', 'null');

    if ($dte_id != 'null')
      {
         $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {
      $data = [];
      $blood_groups = array(
        'A+' => 'A+',
        'A-' => 'A-',
        'B+' => 'B+',
        'B-' => 'B-',
        'AB+' => 'AB+',
        'AB-' => 'AB-',
        'O+' => 'O+',
        'O-' => 'O-',
        'un' => 'Unknown'
      );
      $genders = array(
        'Male' => 'Male',
        'Female' => 'Female',
        'Others' => 'Other'
      );
      $data['blood_groups'] = $blood_groups;
      $data['genders'] = $genders;

        $check = DB::table('me_students')->select('is_personal_completed')->where('dte_id', $dte_id)->get(); 
      if (DB::table('me_students')->select('is_personal_completed')->where('dte_id', $dte_id)->exists() && $check[0]->is_personal_completed == "1")
        {

        $user1 = DB::table('me_students')->select('dte_id', 'name_on_marksheet','gender', 'date_of_birth', 'place_of_birth_city', 'place_of_birth_state', 'student_domicile_no', 'student_domicile_date', 'student_domicile_appl_no', 'student_domicile_appl_date', 'mother_tongue', 'nationality', 'caste_tribe', 'religion', 'blood_group', 'uid','is_personal_completed')->where('dte_id', $dte_id)->get();
             // return $user1[0]->gender;
            if(($user1[0]->student_domicile_no == "0" && $user1[0]->student_domicile_date == "1111-11-11")&&($user1[0]->student_domicile_appl_no == "0" && $user1[0]->student_domicile_appl_date == "1111-11-11"))
            {
                      $domicile = "na";
            }
          else if($user1[0]->student_domicile_no == "0" && $user1[0]->student_domicile_date == "1111-11-11")
          {
             $domicile = "false";
          }
          elseif($user1[0]->student_domicile_appl_no == "0" && $user1[0]->student_domicile_appl_date == "1111-11-11")
          {
            $domicile = "true";
          }
        

        }
        else
        {
        $array_object = [['dte_id' => $dte_id,'is_personal_completed'=>0 ,'name_on_marksheet' => null, 'gender' => 'Male', 'date_of_birth' => null, 'place_of_birth_city' => null, 'place_of_birth_state' => null, 'student_domicile_no' => null, 'student_domicile_date' => null, 'student_domicile_appl_no' => null, 'student_domicile_appl_date' => null, 'mother_tongue' => null, 'nationality' => null, 'caste_tribe' => null, 'religion' => null, 'blood_group' => null, 'uid' => null]];
        $user1 = json_decode(json_encode($array_object));
        $domicile = "true";
        }

        $course = $request->session()->get('log_course');
list($user1['prog_val'],$userprogress)= HomeController::meprogressbar($course,$dte_id);
               if ($userprogress[0]->is_academic_completed==0) {
                 // HomeController::showfeDte();
                return redirect('me_academic_details');
               }

      $data['user1'] = $user1;
      $data['domicile'] = $domicile;
      return view('user.me.personal_details', $data);
      }
      else
              return redirect()->route('me_profile');
          }
      else
      {
      return redirect()->route('logout');
      }
    }
  public static function showmeProfile(Request $request)
    {

    $dte_id = $request->session()->get('log_dte_id', null);
    $course = $request->session()->get('log_course');

    DB::table('student_login')->where('dte_id', $dte_id)->update(['dte_login' => 0, 'acap_login' => 0]);
    if ($dte_id != null)
      {

          $dtes = DB::select(DB::raw("SELECT event_name, event_from_date, event_to_date, event_type FROM event WHERE event_type = 'DTE' AND course LIKE '%".$course."%'"));
          /*DB::table('event')->select('event_name', 'event_from_date', 'event_to_date','event_type')->where('event_type' , 'DTE' AND 'course' , $course)->get();*/
         $acaps = DB::select(DB::raw("SELECT event_name, event_from_date, event_to_date, event_type FROM event WHERE event_type = 'ACAP' AND course LIKE '%".$course."%'"));
         /*DB::table('event')->select('event_name', 'event_from_date', 'event_to_date','event_type')->where('event_type' , 'ACAP' AND 'course' , $course)->get();*/



        //eligibility
         if(DB::table('dte_allotments')->where('dte_id', $dte_id)->exists())
               { $eligibility=1;}
          else
               { $eligibility=0;}

        //status
        $user1 =DB::select(DB::raw("SELECT status_to from status_details where dte_id LIKE '%".$dte_id."%' AND event_to = 'DTE' ORDER BY updated_at DESC LIMIT 1"));
        if($user1==[] || $user1==null)
          {
              if($eligibility==1) 
                $status_dte='Eligible';
              else 
                $status_dte='Not Eligible';
          }
         elseif( $user1!=[])   
          {
              if($eligibility==1) 
                $status_dte=$user1[0]->status_to;
              else 
                $status_dte='Not Eligible';
          }

            //acap
        $user2 =DB::select(DB::raw("SELECT status_to from status_details where dte_id LIKE '%".$dte_id."%' AND event_to = 'ACAP' ORDER BY updated_at DESC LIMIT 1"));
        if($user2==[] || $user2==null)
          {
                $status_acap='Eligible For Acap';
          }
         elseif( $user2!=[])   
          {
                $status_acap=$user2[0]->status_to;
          }
        
        

      $data = [];
      $data['dtes'] = $dtes;
      $data['acaps'] = $acaps;
      $data['status_dte'] = $status_dte;  
        $data['status_acap'] = $status_acap;  
      return view('user.me.profile', $data);
      }
      else
      {
      return redirect()->route('logout');
      }
    }

  public static function showmeChangePassword(Request $request)
    {
       
          
    return view('user.me.change_password');
  }
   
    

  public static function submitmeChangePassword(Request $request)
    {
    $enteredPassword = $request->input('oldPassword');
    $password = $request->input('password');
    $cnf_password= $request->input('password_confirmation');
    if($password!=$cnf_password){
            $request->session()->flash('error','Password does not match');
            return redirect()->route('me_change_password');
    }
    if($password==null || $enteredPassword==null || $cnf_password==null){
            $request->session()->flash('error','Please fill your password details');
            return redirect()->route('me_change_password');
      }
    $password = Hash::make($password);
    $dte_id = $request->session()->get('log_dte_id');
    $user = DB::table('student_login')->select('stud_pwd')->where('dte_id', $dte_id)->get();

    $hashedPassword = $user[0]->stud_pwd;
     
    if (Hash::check($enteredPassword, $hashedPassword))
      {
      DB::table('student_login')->where('dte_id', $dte_id)->update(['stud_pwd' => $password]);
      return redirect()->route('me_profile');

      //  echo "password updates succesfully";

      }
      else
    {
        
          $request->session()->flash('error','Enter correct Old Password ');
           return redirect()->route('me_change_password');
    }
    }


     /*public static function submitmcaChangePassword(Request $request)
    {
    $enteredPassword = $request->input('oldPassword');
    $password = $request->input('password');
    $password = Hash::make($password);
    $dte_id = $request->session()->get('log_dte_id');
    $user = DB::table('student_login')->select('stud_pwd')->where('dte_id', $dte_id)->get();
    return $user;
    $hashedPassword = $user[0]->stud_pwd;
    if (Hash::check($enteredPassword, $hashedPassword))
      {
      DB::table('student_login')->where('dte_id', $dte_id)->update(['stud_pwd' => $password]);
      return redirect()->route('mca_profile');

      //  echo "password updates succesfully";

      }
    }
*/


  // insert me

  public static function insertmeAca(Request $request)
    {
      $dte_id=$request->session()->get('log_dte_id');
    $x_school_name = $request->input('sscSchoolName'); 
    $x_board = $request->input('sscBoard');
    $x_school_city = $request->input('sscSchoolCity');
    $x_school_state = $request->input('sscSchoolState');
    $x_passing_month = $request->input('xPassingMonth');
    $x_passing_year = $request->input('xPassingYear');
    $x_obtained_marks = $request->input('xObtainedMarks');
    $x_max_marks = $request->input('xMaximumMarks');
    $x_percentage = $request->input('xPercentage');
    
    $nd1 = $request->input('nd1');



   
     $degree_name = $request->input('degreeName');
     $degree_branch = $request->input('branchName');
     $degree_college_name = $request->input('degreeCollegeName');
    $degree_university = $request->input('degreeUniversity');
    $degeree_college_city = $request->input('collegeCity');
    $university_type =  $request->input('universityType');
    $degeree_college_state = $request->input('collegeState');
    $degree_passing_month = $request->input('degreePassingMonth'); 
    $degree_passing_year = $request->input('degreePassingYear');
     $is_diploma = $request->input('diplomaHsc');
     $is_new_or_old =$request->input('newOrOld');
     

    if( $is_diploma=="D")
    {
        
        $diploma_college_name = $request->input('diplomaCollegeName');
        $diploma_board =$request->input('diplomaBoard');
        $diploma_branch = $request->input('diplomaBranch');
        $diploma_college_city = $request->input('diplomaCollegeCity');
        $diploma_college_state =$request->input('diplomaCollegeState');
        $diploma_passing_month = $request->input('diplomaPassingMonth'); 
        $diploma_passing_year = $request->input('diplomaPassingYear');
        $diploma_obtained_marks = $request->input('diplomaObtainedMarks');
        $diploma_max_marks = $request->input('diplomaMaximumMarks');
        $diploma_percentage = $request->input('diplomaPercentage');

   


        
        //$diploma_passing_year = $request->input('diplomaBranch');
        $xii_college_name = "NA";
        $xii_board ="NA";
        $xii_college_state ="NA";
        $xii_college_city = "NA";
        $xii_passing_month = "NA";
        $xii_passing_year = "0000";
        $xii_obtained_marks = "00";
        $xii_max_marks = "00";
        $xii_percentage = "00";
   }


    if($is_diploma=="H")
    {

        
         $xii_college_name = $request->input('hscCollegeName');
         $xii_board = $request->input('hscBoard');
         $xii_college_state = $request->input('hscCollegeState');
         $xii_college_city = $request->input('hscCollegeCity');
         $xii_passing_month = $request->input('xiiPassingMonth'); 
         $xii_passing_year = $request->input('xiiPassingYear');
         $xii_obtained_marks = $request->input('xiiObtainedMarks');
         $xii_max_marks = $request->input('xiiMaximumMarks');
         $xii_percentage = $request->input('xiiPercentage');

      // return $xii_percentage;
         $diploma_college_name = "NA";
         $diploma_board = "NA";
         $diploma_branch = "NA";
         $diploma_college_city = "NA";
         $diploma_college_state = "NA";
         $diploma_passing_month = "NA";
          $diploma_passing_year = "0000";
         $diploma_obtained_marks = "00";
         $diploma_max_marks ="00";
         $diploma_percentage ="00";
         
    }


    if($is_new_or_old == "N")
    {


        $new_aggr_obt_marks = $request->input('aggrObtainedMarks');
        $new_aggr_max_marks = $request->input('aggrMaximumMarks');
        $new_percentage = $request->input('aggrPercentage');
        $new_final_cgpa = $request->input('finalCGPA');

        //            return $new_final_cgpa;



        $old_sem1_obt_marks = 0;
        $old_sem1_max_marks = 0;
         $old_sem2_obt_marks = 0;
        $old_sem2_max_marks = 0;
         $old_sem3_obt_marks = 0;
        $old_sem3_max_marks = 0;
         $old_sem4_obt_marks = 0;
        $old_sem4_max_marks = 0;
         $old_sem5_obt_marks = 0;
        $old_sem5_max_marks = 0;
         $old_sem6_obt_marks = 0;
        $old_sem6_max_marks = 0;
         $old_sem7_obt_marks = 0;
        $old_sem7_max_marks = 0;
         $old_sem8_obt_marks = 0;
        $old_sem8_max_marks = 0;
        $old_aggr_obt_marks = 0;
        $old_aggr_max_marks = 0;
        $old_aggr_final_percentage = 0;


    }

    if($is_new_or_old == "O")
    {

        $old_sem1_obt_marks = $request->input('degree_1_marks_obt');
        $old_sem1_max_marks = $request->input('degree_1_marks_max');
        $old_sem2_obt_marks = $request->input('degree_2_marks_obt');
        $old_sem2_max_marks = $request->input('degree_2_marks_max');
        $old_sem3_obt_marks = $request->input('degree_3_marks_obt');
        $old_sem3_max_marks = $request->input('degree_3_marks_max');
        $old_sem4_obt_marks = $request->input('degree_4_marks_obt');
        $old_sem4_max_marks = $request->input('degree_4_marks_max');
        $old_sem5_obt_marks = $request->input('degree_5_marks_obt');
        $old_sem5_max_marks = $request->input('degree_5_marks_max');
        $old_sem6_obt_marks = $request->input('degree_6_marks_obt');
        $old_sem6_max_marks = $request->input('degree_6_marks_max');
        $old_sem7_obt_marks = $request->input('degree_7_marks_obt');
        $old_sem7_max_marks = $request->input('degree_7_marks_max');
        $nd1= $request->input('nd1');
       
         if($nd1 == "")
       {
        $old_sem8_obt_marks = $request->input('degree_8_marks_obt');
        $old_sem8_max_marks = $request->input('degree_8_marks_max');
        // return $old_sem8_max_marks;
      }
      else
      {
        $old_sem8_obt_marks = 0;
        $old_sem8_max_marks = 0;
      }
        $new_aggr_obt_marks = $request->input('oldAggrObtainedMarks');
        $new_aggr_max_marks = $request->input('oldAggrMaximumMarks');
        $new_percentage = $request->input('oldAggrPercentage');


        
        $new_final_cgpa = 0;

    }
 


     if (DB::table('me_students')->where('dte_id', $dte_id)->exists()) 
         { 
       
   
    //Prodedure
    /*DB::select("call insert_update_me_academic('$dte_id',,'$x_passing_year','$x_board','$x_max_marks','$x_obtained_marks','$x_percentage','$x_school_name','$x_school_city','$x_school_state','$is_diploma','$xii_passing_year','$xii_board','$xii_max_marks','$xii_obtained_marks','$xii_percentage','$diploma_max_marks ','$diploma_obtained_marks','$diploma_percentage','$diploma_branch','$degree_university','$degree_passing_year','$degree_college_name','$degree_aggr_max_marks','$degree_aggr_obt_marks','$degree_percentage','$degree_final_cgpa')");
    return redirect('me_personal_details');*/

      DB::select("call insert_update_me_academic('$dte_id','$x_passing_month','$x_passing_year','$x_board','$x_max_marks','$x_obtained_marks','$x_percentage','$x_school_name','$x_school_city','$x_school_state','$is_diploma','$xii_passing_month','$xii_passing_year','$xii_board','$xii_max_marks','$xii_obtained_marks','$xii_percentage','$xii_college_name','$xii_college_city','$xii_college_state','$diploma_board','$diploma_passing_month','$diploma_passing_year','$diploma_max_marks ','$diploma_obtained_marks','$diploma_percentage','$diploma_branch','$diploma_college_name','$diploma_college_city','$diploma_college_state','$degree_name','$degree_branch','$university_type','$degree_university','$degree_passing_month','$degree_passing_year','$degree_college_name','$degeree_college_city','$degeree_college_state','$old_sem1_max_marks','$old_sem1_obt_marks','$old_sem2_max_marks','$old_sem2_obt_marks','$old_sem3_max_marks','$old_sem3_obt_marks','$old_sem4_max_marks','$old_sem4_obt_marks','$old_sem5_max_marks','$old_sem5_obt_marks','$old_sem6_max_marks','$old_sem6_obt_marks','$old_sem7_max_marks','$old_sem7_obt_marks','$old_sem8_max_marks','$old_sem8_obt_marks','$new_aggr_max_marks','$new_aggr_obt_marks','$is_new_or_old','$new_percentage','$new_final_cgpa')");
        
        return redirect('me_personal_details');
        
      


   
    }


    }

  public static function insertmeContact(Request $request)
    {
    $dte_id=$request->session()->get('log_dte_id');
        $activedte= $request->session()->get('log_dte', 'null');
     $activeacap= $request->session()->get('log_acap','null');

 
       
    $permanent_address_line1 = $request->input('permanentAddressLine1');
    $permanent_address_line2 = $request->input('permanentAddressLine2');

    $permanent_city = $request->input('permanentAddressCity');
    $permanent_state = $request->input('permanentAddressState');
    $permanent_district = $request->input('permanentAddressDistrict');
    $permanent_pincode = $request->input('permanentAddressPincode');
    $permanent_nearest_rail_station = $request->input('permanentAddressNearestRailwayStation');
    

    $local_guardian_name = $request->input('localGuardianName');
    $local_guardian_address_line1 = $request->input('localGuardianAddressLine1');
    $local_guardian_address_line2 = $request->input('localGuardianAddressLine2');
    $local_guardian_city = $request->input('localGuardianAdreessCity');
    $local_guardian_state = $request->input('localGuardianAdreessState');
    $local_guardian_district = $request->input('localGuardianAdreessDristict');
    $local_guardian_pincode = $request->input('localGuardianAddressPincode');
    $is_correspon_as_permanent=$request->input('isSame');
    $is_local_or_outstation=$request->input('localOutstation');
    
  // return $is_correspon_as_permanent;
    //return $permanent_pincode;
    //return $is_correspon_as_permanent;
    if($is_correspon_as_permanent=="yes")
    {
        //return $permanent_pincode;
        $correspondance_address_line1 =  $permanent_address_line1;
        $correspondance_address_line2 = $permanent_address_line2;
        $correspondance_city = $permanent_city;
        $correspondance_state = $permanent_state;
        $correspondance_district = $permanent_district;
        $correspondance_pincode = $permanent_pincode;
        //return $correspondance_pincode;
        $correspondance_nearest_rail_station =  $permanent_nearest_rail_station;

    }
    else
    {
         $correspondance_address_line1 = $request->input('currentAddressLine1');
         $correspondance_address_line2 = $request->input('currentAddressLine2');
         $correspondance_city = $request->input('currentAddressCity');
         $correspondance_district =  $request->input('currentAddressDistrict'); 
         $correspondance_state = $request->input('currentAddressState');
         $correspondance_pincode = $request->input('currentAddressPincode');
         $correspondance_nearest_rail_station = $request->input('currentAddressNearestRailwayStation');
    }


    if($is_local_or_outstation=="Local")
    {
        $local_guardian_name = "NA";
        $local_guardian_address_line1 = "NA";
        $local_guardian_address_line2 =  "NA";
        $local_guardian_city =  "NA";
         $local_guardian_district =  "NA";
        $local_guardian_state =  "NA";
        $local_guardian_pincode = "0"; 

    }
    else
    {
        $local_guardian_name = $request->input('localGuardianName');
        $local_guardian_address_line1 = $request->input('localGuardianAddressLine1');
        $local_guardian_address_line2 = $request->input('localGuardianAddressLine2');
        $local_guardian_city = $request->input('localGuardianAdreessCity');
        $local_guardian_district = $request->input('localGuardianAdreessDristict');
        $local_guardian_state = $request->input('localGuardianAdreessState');
        $local_guardian_pincode = $request->input('localGuardianAddressPincode');
    }

    if (DB::table('me_students')->where('dte_id', $dte_id)->exists()) 
         { 

    DB::select("call insert_update_me_contact('$dte_id','$permanent_address_line1','$permanent_address_line2','$permanent_city','$permanent_district','$permanent_state','$permanent_pincode','$permanent_nearest_rail_station','$correspondance_address_line1','$correspondance_address_line2','$correspondance_city','$correspondance_district','$correspondance_state','$correspondance_pincode','$correspondance_nearest_rail_station','$is_local_or_outstation','$local_guardian_name','$local_guardian_address_line1','$local_guardian_address_line2','$local_guardian_city','$local_guardian_district','$local_guardian_state','$local_guardian_pincode')");
       }

        if($activedte=='yes')
          return redirect()->route('me_document_upload');
        elseif ($activeacap=='yes') 
          return redirect()->route('me_acap_document_upload');
    }
  
   public static function insertmeDte(Request $request)
    {
   $dte_id=$request->session()->get('log_dte_id');

    $sponsored = $request->input('checkGate');
    
    $candidate_type = $request->input('candidate_types');
   // $dte_sponsor = $request->input('dteSponsorship');
   

    $mh_state_general_merit_no = $request->input('mhStateGeneralMeritNo');
   
     //$user = DB::select(DB::raw("SELECT * FROM `dte_allotments` WHERE dte_id  LIKE '%".$dte_id."%' "));

     if($sponsored == "Sponsorship")
     {
        $sponsored = 1;
        $sponsoring_company =$request->input('dteSponsorship');
        $gate_score = 0;
        $gate_month=0;
        $gate_year=0000;
        $gate_max_marks=0;
        $gate_reg_no = 0;
        $gate_exam_paper ="NA";
        $gate_branch="NA";
 
     }
     else
     {
        $sponsored = 0;
         $sponsoring_company = "NA";
       $gate_score = $request->input('gateScore');
       $gate_month=$request->input('gate_month');
       $gate_year=$request->input('yearOfExam');
       $gate_max_marks=$request->input('gateOutOf');
       $gate_reg_no = $request->input('gate_reg_no');
       $gate_exam_paper =$request->input('gate_exam_paper');
       $gate_branch =$request->input('gateBranch');
           }
    $activedte= $request->session()->get('log_dte', 'null');
     $activeacap= $request->session()->get('log_acap','null');
   /*  return $gate_month;*/
    //Procedure
   //return $sponsoring_company;
    if($activedte=='yes')
    {
      $user = DB::table('me_students')->where('dte_id',$dte_id)->get();
      $type=$user[0]->seat_type;
      $branch = $user[0]->gate_branch;
    // $category = $request->input('category');
      $cat_Radio = $request->input('cat_Radio');
           // return $cat_Radio;
          if ($cat_Radio== "Reserverd") {
            $category = $request->input('reservedcategory');  
          }
          if ($cat_Radio=="Minority") {
            $category =  $request->input('minoritycategory');  
          }
          if ($cat_Radio== "General") {
            $category = $request->input('opencategory');  
          }
          // return $category;
          
        if($user[0]->acap_category == null || $user[0]->acap_category == "NA")
        $acap_category ="NA";
        else
          $acap_category = $user[0]->acap_category;
    }
    elseif($activeacap=='yes')
    {
      $user = DB::table('me_students')->select('category')->where('dte_id',$dte_id)->get(); 
      $type='ACAP';
      $branch = "-";
      //changes by kartik
          $cat_Radio = $request->input('cat_Radio');
           // return $cat_Radio;
          if ($cat_Radio== "Reserverd") {
            $category = $request->input('reservedcategory');  
          }
          if ($cat_Radio=="Minority") {
            $category =  $request->input('minoritycategory');  
          }
          if ($cat_Radio== "General") {
            $category = $request->input('opencategory');  
          }



           // $acap_category = $request->input('category');
          $acap_category = $category;
       if($user == '[]' ||$user[0]->category == null || $user[0]->category == "NA")
        $category ="NA";
        else
          $category = $user[0]->category;
    }
    
    DB::select("call insert_update_me_dte('$dte_id','$category','$candidate_type','$sponsored','$gate_score','$gate_branch','$gate_month','$gate_year','$gate_max_marks','$gate_reg_no','$gate_exam_paper','$sponsoring_company','$mh_state_general_merit_no','$type','$acap_category')");
    return redirect('me_academic_details');
                  
    }

  public static function insertmeGuard(Request $request)
    {
 $dte_id=$request->session()->get('log_dte_id');
    $g_relation = $request->input('relation');
    $g_first_name = $request->input('firstName');
    $g_middle_name = $request->input('middleName');
    $g_last_name = $request->input('lastName');
    $mother_name = $request->input('motherMaidenName');
    $g_mobile = $request->input('mobile');
    $g_office_address=$request->input('office_address');
    $g_office_tel_no=$request->input('office_tel_no');
    $g_occupation = $request->input('occupation');
    $g_qualification = $request->input('qualification');
    $g_annual_income = $request->input('annualIncome');
   
   if($g_office_tel_no == null)
        $g_office_tel_no =0; 
    
    if($g_office_address == null)
        $g_office_address= "NA";
    $if_domecile=$request->input('dom');
    //return $g_relation;
    if($if_domecile=="yes")
    {
         $parent_domicile_no = $request->input('parentDomecileNo');
        $parent_domicile_date = $request->input('dateOfParentDomecile');
       // return $parent_domicile_date;
        $parent_domicile_appl_no = "0";
         $parent_domicile_appl_date = "1111-11-11";
    }
    if($if_domecile=="no")
    {
         $parent_domicile_appl_no = $request->input('parentDomecileApplicationNo');
         $parent_domicile_appl_date = $request->input('applicationDateOfParentDomecile');
         $parent_domicile_no ="0";
         $parent_domicile_date = "1111-11-11";
    }
    if($if_domecile=="na")
    {
        $parent_domicile_appl_no = "0";
         $parent_domicile_appl_date = "1111-11-11";
         $parent_domicile_no ="0";
         $parent_domicile_date = "1111-11-11";
    }
  if (DB::table('me_students')->where('dte_id', $dte_id)->exists()) 
         { 
        /*$me_students  = me_students::find($dte_id);
        }
    $me_students->dte_id = $dte_id;
    $me_students->g_relation = $g_relation;
    $me_students->g_first_name = $g_first_name;
    $me_students->g_middle_name = $g_middle_name;
    $me_students->g_last_name = $g_last_name;
    $me_students->mother_name = $mother_name;
    $me_students->g_mobile = $g_mobile;
    $me_students->g_occupation = $g_occupation;
    $me_students->g_qualification = $g_qualification;
    $me_students->g_annual_income = $g_annual_income;
    $me_students->parent_domicile_no = $parent_domicile_no;
    $me_students->parent_domicile_date = $parent_domicile_date;
    $me_students->parent_domicile_appl_no = $parent_domicile_appl_no;
    $me_students->parent_domicile_appl_date = $parent_domicile_appl_date;
    $me_students->save();*/
    
    
    //Procedure
     $mob=DB::table('student_login')->select('mobile')->where('dte_id', $dte_id)->get();
     
    if($mob[0]->mobile==$g_mobile){
 
$request->session()->flash('error','Please fill different mobile number ');
return redirect('me_guardian_details');
    }
    DB::select("call insert_update_me_guardian('$dte_id','$g_relation','$g_first_name','$g_middle_name','$g_last_name','$g_mobile','$g_occupation','$g_qualification','$g_office_address','$g_office_tel_no','$g_annual_income','$parent_domicile_no','$parent_domicile_date','$parent_domicile_appl_no','$parent_domicile_appl_date','$mother_name')");
    return redirect('me_contact_details');}

    }

  public static function insertmePersonal(Request $request)
    {
    $dte_id=$request->session()->get('log_dte_id'); 
    $name_on_marksheet = $request->input('nameAsOnMarksheet');
    $gender = $request->input('gender');
    $date_of_birth = $request->input('dob');
    $if_domecile=$request->input('dom');
    $place_of_birth_city = $request->input('placeOfBirthCity');
    $place_of_birth_state = $request->input('placeOfBirthState');
    $student_domicile_no = $request->input('domicileNumber');
    $student_domicile_date = $request->input('domicileDate');
    $student_domicile_appl_no = $request->input('applicationNumber');
    $student_domicile_appl_date = $request->input('applictionDate');
    $mother_tongue = $request->input('motherTongue');
    $nationality = $request->input('nationality');
    $caste_tribe = $request->input('casteTribe');
    $religion = $request->input('religion');
    $blood_group = $request->input('bloodGroup');
    $uid = $request->input('uid');
    if($if_domecile=="yes")
    {
        $student_domicile_appl_no = "0";
         $student_domicile_appl_date = "1111-11-11";
    }
    if($if_domecile=="no")
    {
         $student_domicile_no ="0";
         $student_domicile_date = "1111-11-11";
    }
    if($if_domecile=="na")
    {
        $student_domicile_appl_no = "0";
        $student_domicile_appl_date = "1111-11-11"; 
        $student_domicile_no ="0";
        $student_domicile_date = "1111-11-11";
        
    }
    
    if (DB::table('me_students')->where('dte_id', $dte_id)->exists()) 
         { 
        
    DB::select("call insert_update_me_personal('$dte_id','$name_on_marksheet','$gender','$date_of_birth','$place_of_birth_city','$place_of_birth_state','$mother_tongue','$nationality','$caste_tribe ','$religion','$blood_group','$uid','$student_domicile_no','$student_domicile_date','$student_domicile_appl_no','$student_domicile_appl_date')");
    return redirect('me_guardian_details');
  }

}




    public static function  showmeDocumentUpload(Request $request)
    {
        $dte_id = $request->session()->get('log_dte_id');
        $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          //$path =  DB::table('me_students')->select('photo_path')->where('dte_id', $dte_id)->get();
        // return $dte_id;

          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {
       if (DB::table('me_students')->where('dte_id', $dte_id)->exists())
        {
          $user = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        $user1 = DB::table('me_students')->select('dte_id','fc_confirmation_receipt','fc_confirmation_receipt_path','dte_allotment_letter','dte_allotment_letter_path','arc_ackw_receipt','arc_ackw_receipt_path','gate_result','gate_result_path','ssc_marksheet','ssc_marksheet_path','hsc_marksheet','hsc_marksheet_path','degree_leaving_tc','degree_leaving_tc_path','first_year_marksheet','first_year_marksheet_path','second_year_marksheet','second_year_marksheet_path','third_year_marksheet','third_year_marksheet_path','fourth_year_marksheet','fourth_year_marksheet_path','convocation_passing_certi','convocation_passing_certi_path','migration_certi','migration_certi_path','birth_certi','birth_certi_path','domicile','domicile_path','proforma_o','proforma_o_path','retention','retention_path','minority_affidavit','minority_affidavit_path','gap_certi','gap_certi_path','community_certi','community_certi_path','caste_certi','caste_certi_path','caste_validity_certi','caste_validity_certi_path','non_creamy_layer_certi','non_creamy_layer_certi_path','proforma_h','proforma_h_path','proforma_a_b1_b2','proforma_a_b1_b2_path','proforma_f_f1','proforma_f_f1_path','income_certi','income_certi_path','proforma_c_d_e','proforma_c_d_e_path','anti_ragging_affidavit','anti_ragging_affidavit_path','proforma_j_k_l','proforma_j_k_l_path','medical_certi','medical_certi_path','photo','photo_path','signature','signature_path')->where('dte_id', $dte_id)->get();
        //return $user1;
        }
        else
        {
           $user = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        $array_object = [['dte_id'=> $dte_id,'fc_confirmation_receipt' => null, 'fc_confirmation_receipt_path' => null, 'dte_allotment_letter' => null,'dte_allotment_letter_path' => null, 'arc_ackw_receipt' => null,'arc_ackw_receipt_path' => null, 'gate_result' => null,'gate_result_path' => null, 'ssc_marksheet' => null,'ssc_marksheet_path' => null,'hsc_marksheet' => null, 'hsc_marksheet_path' => null,'degree_leaving_tc' => null, 'degree_leaving_tc_path' => null,'first_year_marksheet' => null,'first_year_marksheet_path'=>null, 'second_year_marksheet' => null,'second_year_marksheet_path'=>null,'third_year_marksheet' => null,'third_year_marksheet_path' => null,'fourth_year_marksheet' => null,'fourth_year_marksheet_path' => null,'convocation_passing_certi' => null,'convocation_passing_certi_path'=>null, 'migration_certi' => null, 'migration_certi_path' => null, 'birth_certi' => null,'birth_certi_path' => null,'domicile' => null,'domicile_path' => null,'proforma_o' => null,'proforma_o_path' => null,'retention' => null,'retention_path' => null, 'minority_affidavit' => null, 'minority_affidavit_path' => null, 'gap_certi' => null, 'gap_certi_path' => null, 'community_certi' => null, 'community_certi_path' => null, 'caste_certi' => null, 'caste_certi_path' => null,'caste_validity_certi' => null,'caste_validity_certi_path' => null, 'non_creamy_layer_certi' => null, 'non_creamy_layer_certi_path' => null, 'proforma_h' => null, 'proforma_h_path' => null, 'proforma_a_b1_b2' => null, 'proforma_a_b1_b2_path' => null, 'proforma_f_f1' => null, 'proforma_f_f1_path' => null, 'income_certi' => null, 'income_certi_path' => null, 'proforma_c_d_e' => null, 'proforma_c_d_e_path' => null, 'anti_ragging_affidavit' => null, 'anti_ragging_affidavit_path' => null, 'proforma_j_k_l' => null, 'proforma_j_k_l_path' => null, 'medical_certi' => null, 'medical_certi_path' , 'photo' => null,'photo_path' => null, 'signature' => null, 'signature_path' => null]];
        $user1 = json_decode(json_encode($array_object));
        }
        //return $user[0]->hash;
        $course = $request->session()->get('log_course');
list($user1['prog_val'],$userprogress)= HomeController::meprogressbar($course,$dte_id);   
          if ($userprogress[0]->is_contact_completed==0) {
                 // HomeController::showfeDte();
                return redirect('me_contact_details');
               }

        $data=[];
        $data['hash'] = $user[0]->hash;
        $data['user1']=$user1;
        //$photo_path = 'storage'.$user1;
        return view('user.me.document_upload',$data);

      }
       else
              return redirect()->route('me_profile');
          
    }




    public static function  showmeAcapDocumentUpload(Request $request)
    {
        $dte_id = $request->session()->get('log_dte_id');
        $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          //$path =  DB::table('me_students')->select('photo_path')->where('dte_id', $dte_id)->get();
        // return $dte_id;

          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {
       if (DB::table('me_students')->where('dte_id', $dte_id)->exists())
        {
          $user = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        $user1 = DB::table('me_students')->select('dte_id','fc_confirmation_receipt','fc_confirmation_receipt_path','dte_allotment_letter','dte_allotment_letter_path','arc_ackw_receipt','arc_ackw_receipt_path','gate_result','gate_result_path','ssc_marksheet','ssc_marksheet_path','hsc_marksheet','hsc_marksheet_path','degree_leaving_tc','degree_leaving_tc_path','first_year_marksheet','first_year_marksheet_path','second_year_marksheet','second_year_marksheet_path','third_year_marksheet','third_year_marksheet_path','fourth_year_marksheet','fourth_year_marksheet_path','convocation_passing_certi','convocation_passing_certi_path','migration_certi','migration_certi_path','birth_certi','birth_certi_path','domicile','domicile_path','proforma_o','proforma_o_path','retention','retention_path','minority_affidavit','minority_affidavit_path','gap_certi','gap_certi_path','community_certi','community_certi_path','caste_certi','caste_certi_path','caste_validity_certi','caste_validity_certi_path','non_creamy_layer_certi','non_creamy_layer_certi_path','proforma_h','proforma_h_path','proforma_a_b1_b2','proforma_a_b1_b2_path','proforma_f_f1','proforma_f_f1_path','income_certi','income_certi_path','proforma_c_d_e','proforma_c_d_e_path','anti_ragging_affidavit','anti_ragging_affidavit_path','proforma_j_k_l','proforma_j_k_l_path','medical_certi','medical_certi_path','photo','photo_path','signature','signature_path')->where('dte_id', $dte_id)->get();
        //return $user1;
        }
        else
        {
           $user = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        $array_object = [['dte_id'=> $dte_id,'fc_confirmation_receipt' => null, 'fc_confirmation_receipt_path' => null, 'dte_allotment_letter' => null,'dte_allotment_letter_path' => null, 'arc_ackw_receipt' => null,'arc_ackw_receipt_path' => null, 'gate_result' => null,'gate_result_path' => null, 'ssc_marksheet' => null,'ssc_marksheet_path' => null,'hsc_marksheet' => null, 'hsc_marksheet_path' => null,'degree_leaving_tc' => null, 'degree_leaving_tc_path' => null,'first_year_marksheet' => null,'first_year_marksheet_path'=>null, 'second_year_marksheet' => null,'second_year_marksheet_path'=>null,'third_year_marksheet' => null,'third_year_marksheet_path' => null,'fourth_year_marksheet' => null,'fourth_year_marksheet_path' => null,'convocation_passing_certi' => null,'convocation_passing_certi_path'=>null, 'migration_certi' => null, 'migration_certi_path' => null, 'birth_certi' => null,'birth_certi_path' => null,'domicile' => null,'domicile_path' => null,'proforma_o' => null,'proforma_o_path' => null,'retention' => null,'retention_path' => null, 'minority_affidavit' => null, 'minority_affidavit_path' => null, 'gap_certi' => null, 'gap_certi_path' => null, 'community_certi' => null, 'community_certi_path' => null, 'caste_certi' => null, 'caste_certi_path' => null,'caste_validity_certi' => null,'caste_validity_certi_path' => null, 'non_creamy_layer_certi' => null, 'non_creamy_layer_certi_path' => null, 'proforma_h' => null, 'proforma_h_path' => null, 'proforma_a_b1_b2' => null, 'proforma_a_b1_b2_path' => null, 'proforma_f_f1' => null, 'proforma_f_f1_path' => null, 'income_certi' => null, 'income_certi_path' => null, 'proforma_c_d_e' => null, 'proforma_c_d_e_path' => null, 'anti_ragging_affidavit' => null, 'anti_ragging_affidavit_path' => null, 'proforma_j_k_l' => null, 'proforma_j_k_l_path' => null, 'medical_certi' => null, 'medical_certi_path' , 'photo' => null,'photo_path' => null, 'signature' => null, 'signature_path' => null]];
        $user1 = json_decode(json_encode($array_object));
        }
        //return $user[0]->hash;
        $course = $request->session()->get('log_course');
list($user1['prog_val'],$userprogress)= HomeController::meprogressbar($course,$dte_id);   
    if($acap_login[0]->acap_login == 1) {
            if($userprogress[0]->is_document_completed==1){
          $user1['prog_val']=7;
          $data['user1']=$user1;
          // return 'done';
        }

        }

        
        $data=[];
        $data['hash'] = $user[0]->hash;
        $data['user1']=$user1;
        //$photo_path = 'storage'.$user1;
        return view('user.me.acap_document_upload',$data);

      }
       else
              return redirect()->route('me_profile');
          
    }

/*---------------------------------------------------------------------------------------------------------------------*/

   public static function uploadmeDocumentUpload(Request $request)
    {

      //return "hello";
        $dte_id=$request->session()->get('log_dte_id'); 
        $log_dte = $request->session()->get('log_dte');
        $log_acap = $request->session()->get('log_acap');
        //return $log_acap;
      $use = DB::table('student_login')->select('hash')->where('dte_id', $dte_id)->get();
      $destinationPath = $dte_id.'_'.$use[0]->hash;
      //  $abc=(int)$request->hasFile('ssc_marksheet');
       
        //return $dte_id;
        if(DB::table('me_students')->where('dte_id', $dte_id)->exists()) 
          { 
           $me_students  = me_students::find($dte_id);
          }
          else
          {
             $me_students = new me_students;
            $me_students->dte_id = $dte_id;
          }

          $test_photo = $request->input('photo');
       //  return $me_students->photo_path;
         if($me_students->photo_path == null)
         {
                  if ($test_photo=="yes") 
                  {
                       if($request->hasFile('photo'))
                      {
                            $rules = ['photo' => 'mimes:jpg,png,jpeg'];
                             $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('photo_error', 'Please Upload Only JPG or PNG type image. File size should be less than 1 mb.');
                              return redirect()->route('me_document_upload');
                             }
                            $extension = $request->file('photo')->getClientOriginalExtension();
                            $filenametostore = 'photo'.$dte_id.'.'.$extension;
                     
                            $path =  $request->file('photo')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            // return $filenametostore;
                            $me_students->photo_path = $filenametostore;
                            $me_students->photo='Yes';
                            $me_students->save();
                      }
                      else
                        {
                              $me_students->photo='No';
                              $me_students->save();
                        }
                 }
                  elseif ($test_photo=="no") {
                    $me_students->photo='No';
                  }
                  elseif ($test_photo== null) {
                    $request->session()->flash('photo_error', 'Please select an option');
                      return redirect()->route('me_document_upload');
                  }
          
         }

      $test_signature = $request->input('signature');
    //  return $test_signature;
    
    if($me_students->signature_path == null)
         {
                  if ($test_signature=="yes") 
                  {
                        if($request->hasFile('signature'))
                        {
                                $rules = ['signature' => 'mimes:jpg,png,jpeg'];
                                  $validator = Validator::make(Input::all() , $rules);
                                if ($validator->fails())
                                 {
                                  $request->session()->flash('signature_error', 'Please Upload Only JPG or PNG type image. File size should be less than 1 mb.');
                                  return redirect()->route('me_document_upload');
                                 }
                                $extension = $request->file('signature')->getClientOriginalExtension();
                                $filenametostore = 'signature'.$dte_id.'.'.$extension;
                                $path = $request->file('signature')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                  $me_students->signature_path = $filenametostore;
                                   $me_students->signature='Yes';
                                $me_students->save();
                        }
                               else
                                {
                                      $me_students->signature='No';
                                      $me_students->save();
                                }
                 }
                  elseif ($test_signature=="no") {
                    $me_students->signature='No';
                  }
                  elseif ($test_signature== null) {
                    $request->session()->flash('signature_error', 'Please select an option');
                      return redirect()->route('me_document_upload');
                  }
         }

      $test_fc_confirmation_receipt = $request->input('fc_confirmation_receipt');
      //return $test_fc_confirmation_receipt;
       if($me_students->fc_confirmation_receipt_path == null)
         {
      
              if ($test_fc_confirmation_receipt=="yes") 
              {
                 if($request->hasFile('fc_confirmation_receipt'))
                 { 
                        $rules = ['fc_confirmation_receipt' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('fc_confirmation_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('me_document_upload');
                         }
                        $extension = $request->file('fc_confirmation_receipt')->getClientOriginalExtension();
                        $filenametostore = 'fc_confirmation_receipt'.$dte_id.'.'.$extension;
                        $path = $request->file('fc_confirmation_receipt')->storeAs($destinationPath, $filenametostore,'public_uploads');
                          $me_students->fc_confirmation_receipt_path =$filenametostore;
                           $me_students->fc_confirmation_receipt='Yes';
                        $me_students->save();
                }
                  else
                    {
                          $me_students->fc_confirmation_receipt='No';
                          $me_students->save();
                    }
             }
             elseif ($test_fc_confirmation_receipt=="no") {
                $me_students->fc_confirmation_receipt='No';
              }
              elseif ($test_fc_confirmation_receipt== null) {
                $request->session()->flash('fc_confirmation_error', 'Please select an option');
                  return redirect()->route('me_document_upload');
              }

         }

         
      $test_dte_allotment_letter = $request->input('dte_allotment_letter');
      if($me_students->dte_allotment_letter_path == null)
         {
              if ($test_dte_allotment_letter=="yes") 
              {
                  if($request->hasFile('dte_allotment_letter'))
                {
                        $rules = ['dte_allotment_letter' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('dte_allotment_letter_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('me_document_upload');
                         }
                        $extension = $request->file('dte_allotment_letter')->getClientOriginalExtension();
                        $filenametostore = 'dte_allotment_letter_'.$dte_id.'.'.$extension;
                   
                        $path = $request->file('dte_allotment_letter')->storeAs($destinationPath, $filenametostore,'public_uploads');
                              $me_students->dte_allotment_letter_path = $filenametostore;
                               $me_students->dte_allotment_letter='Yes';
                        $me_students->save();
                 }
    
               else
                {
                      $me_students->dte_allotment_letter='No';
                      $me_students->save();
                }
               }
              elseif ($test_dte_allotment_letter=="no") {
                $me_students->dte_allotment_letter='No';
              }
              elseif ($test_dte_allotment_letter== null) {
                $request->session()->flash('dte_allotment_letter_error', 'Please select an option');
                  return redirect()->route('me_document_upload');
              }
         }

      $test_arc_ackw_receipt = $request->input('arc_ackw_receipt');
      
      if($me_students->arc_ackw_receipt_path == null)
         {
              if ($test_arc_ackw_receipt=="yes") 
              {
                    if($request->hasFile('arc_ackw_receipt'))
                      {
                        $rules = ['arc_ackw_receipt' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('arc_ackw_receipt_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('me_document_upload');
                         }
                        $extension = $request->file('arc_ackw_receipt')->getClientOriginalExtension();
                        $filenametostore = 'arc_ackw_receipt_'.$dte_id.'.'.$extension;
                   
                        $path = $request->file('arc_ackw_receipt')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $me_students->arc_ackw_receipt_path = $filenametostore;
                        $me_students->arc_ackw_receipt='Yes';
                        $me_students->save();
                      }
                
                       else
                        {
                              $me_students->arc_ackw_receipt='No';
                              $me_students->save();
                        }
             }
             elseif ($test_arc_ackw_receipt=="no") {
                 $me_students->arc_ackw_receipt='No';
             }
              elseif ($test_arc_ackw_receipt== null) {
                $request->session()->flash('arc_ackw_receipt_error', 'Please select an option');
                  return redirect()->route('me_document_upload');
              }
    }

        $test_gate_result = $request->input('gate_result');
        //return $test_cet_result;
        if($me_students->gate_result_path == null)
         {
                  if ($test_gate_result=="yes") 
                  {
                      if($request->hasFile('gate_result'))
                          {
                            $rules = ['gate_result' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              return redirect()->route('me_document_upload');
                             }
                            $extension = $request->file('gate_result')->getClientOriginalExtension();
                            $filenametostore = 'gate_result_'.$dte_id.'.'.$extension;
                       
                            $path = $request->file('gate_result')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $me_students->gate_result_path = $filenametostore;
                            $me_students->gate_result = 'Yes';
                            $me_students->save();
                          }
                          else
                            {
                                  $me_students->gate_result='No';
                                  $me_students->save();
                            }
            }
            elseif ($test_gate_result=="no") {
                $me_students->gate_result='No';
              }
              elseif ($test_gate_result== null) {
                $request->session()->flash('gate_result_error', 'Please select an option');
                  return redirect()->route('me_document_upload');
              }

         }
      $test_ssc_marksheet = $request->input('ssc_marksheet');
      if($me_students->ssc_marksheet_path == null)
         {
                      if ($test_ssc_marksheet=="yes") 
                      {
                            if($request->hasFile('ssc_marksheet')) 
                            {
                              $rules = ['ssc_marksheet' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('ssc_marksheet_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              return redirect()->route('me_document_upload');
                             }
                      
                               //get file extension
                            $extension = $request->file('ssc_marksheet')->getClientOriginalExtension();
                            
                            //filename to store
                            $filenametostore = 'ssc_marksheet_'.$dte_id.'.'.$extension;
                            
                            //Upload File
                            $path = $request->file('ssc_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                     $me_students->ssc_marksheet_path = $filenametostore;
                                      $me_students->ssc_marksheet = 'Yes';
                            $me_students->save();
                          }
                          else
                            {
                                  $me_students->ssc_marksheet='No';
                                  $me_students->save();
                            }
                }
                elseif ($test_ssc_marksheet=="no") {
                    $me_students->ssc_marksheet='No';
                  }
                  elseif ($test_ssc_marksheet== null) {
                    $request->session()->flash('ssc_marksheet_error', 'Please select an option');
                      return redirect()->route('me_document_upload');
                  }
         }
         
      $test_hsc_marksheet = $request->input('hsc_marksheet');
       if($me_students->hsc_marksheet_path == null)
         {
                          if ($test_hsc_marksheet=="yes") 
                          {
                                  if($request->hasFile('hsc_marksheet')) 
                                  {
                                    $rules = ['hsc_marksheet' => 'mimes:pdf|max:1024'];
                                      $validator = Validator::make(Input::all() , $rules);
                                    if ($validator->fails())
                                     {
                                      $request->session()->flash('hsc_marksheet_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                      return redirect()->route('me_document_upload');
                                     }
                                    $extension = $request->file('hsc_marksheet')->getClientOriginalExtension();
                                    $filenametostore = 'hsc_marksheet'.$dte_id.'.'.$extension;
                                    $path = $request->file('hsc_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                    $me_students->hsc_marksheet_path = $filenametostore;
                                     $me_students->hsc_marksheet='Yes';
                                    $me_students->save();
                                  }
                                  else
                                    {
                                          $me_students->hsc_marksheet='No';
                                          $me_students->save();
                                    }
                    }
                    elseif ($test_hsc_marksheet=="no") {
                        $me_students->hsc_marksheet='No';
                      }
                      elseif ($test_hsc_marksheet== null) {
                        $request->session()->flash('hsc_marksheet_error', 'Please select an option');
                          return redirect()->route('me_document_upload');
                      }
         }           
      $test_degree_leaving_tc = $request->input('degree_leaving_tc');
      if($me_students->degree_leaving_tc_path == null)
         {
              
                  if ($test_degree_leaving_tc=="yes") 
                  {
                      if($request->hasFile('degree_leaving_tc')) 
                      {
                        $rules = ['degree_leaving_tc' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('degree_leaving_tc_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('me_document_upload');
                         }
                        $extension = $request->file('degree_leaving_tc')->getClientOriginalExtension();
                        $filenametostore = 'degree_leaving_tc_'.$dte_id.'.'.$extension;
                        $path = $request->file('degree_leaving_tc')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $me_students->degree_leaving_tc_path = $filenametostore;
                              $me_students->degree_leaving_tc = 'Yes';
                        $me_students->save();
                       }
                        else
                        {
                              $me_students->degree_leaving_tc='No';
                              $me_students->save();
                        }
                 }
             elseif ($test_degree_leaving_tc=="no") {
                $me_students->degree_leaving_tc='No';
              }
              elseif ($test_degree_leaving_tc== null) {
                $request->session()->flash('degree_leaving_tc_error', 'Please select an option');
                  return redirect()->route('me_document_upload');
              }
         }


      $test_first_year_marksheet = $request->input('first_year_marksheet');
     if($me_students->first_year_marksheet_path == null)
         {
                      if ($test_first_year_marksheet=="yes") 
                      {
                              if($request->hasFile('first_year_marksheet')) 
                              {
                                $rules = ['first_year_marksheet' => 'mimes:pdf|max:1024'];
                                  $validator = Validator::make(Input::all() , $rules);
                                if ($validator->fails())
                                 {
                                  $request->session()->flash('first_year_marksheet_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                  return redirect()->route('me_document_upload');
                                 }
                                $extension = $request->file('first_year_marksheet')->getClientOriginalExtension();
                                $filenametostore = 'first_year_marksheet_'.$dte_id.'.'.$extension;
                                $path = $request->file('first_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                $me_students->first_year_marksheet_path = $filenametostore;
                                   $me_students->first_year_marksheet = 'Yes';
                                $me_students->save();
                                }
                                else
                                {
                                      $me_students->first_year_marksheet='No';
                                      $me_students->save();
                                }
                       }
            
                 elseif ($test_first_year_marksheet=="no") {
                    $me_students->first_year_marksheet='No';
                  }
                  elseif ($test_first_year_marksheet== null) {
                    $request->session()->flash('first_year_marksheet_error', 'Please select an option');
                      return redirect()->route('me_document_upload');
                  }
         }
      
      $test_second_year_marksheet = $request->input('second_year_marksheet');
      if($me_students->second_year_marksheet_path == null)
         {
                  if ($test_second_year_marksheet=="yes") 
                  {
                          if($request->hasFile('second_year_marksheet')) 
                          {
                            $rules = ['second_year_marksheet' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('second_year_marksheet_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              return redirect()->route('me_document_upload');
                             }
                            $extension = $request->file('second_year_marksheet')->getClientOriginalExtension();
                            $filenametostore = 'second_year_marksheet_'.$dte_id.'.'.$extension;
                            $path = $request->file('second_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $me_students->second_year_marksheet_path = $filenametostore;
                                    $me_students->second_year_marksheet='Yes';
                            $me_students->save();
                            }
                             else
                            {
                                  $me_students->second_year_marksheet='No';
                                  $me_students->save();
                            }
                }
              elseif ($test_second_year_marksheet=="no") {
                $me_students->second_year_marksheet='No';
              }
              elseif ($test_second_year_marksheet== null) {
                $request->session()->flash('second_year_marksheet_error', 'Please select an option');
                  return redirect()->route('me_document_upload');
              }
              
         }
         

      $test_third_year_marksheet = $request->input('third_year_marksheet');
   //   return $test_third_year_marksheet;
        if($me_students->third_year_marksheet_path == null)
         {
                  if ($test_third_year_marksheet=="yes") 
                  {
                      if($request->hasFile('third_year_marksheet')) 
                      {
                       // return "hello";
                        $rules = ['third_year_marksheet' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('third_year_marksheet_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('me_document_upload');
                         }
                        $extension = $request->file('third_year_marksheet')->getClientOriginalExtension();
                        $filenametostore = 'third_year_marksheet_'.$dte_id.'.'.$extension;
                        $path = $request->file('third_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $me_students->third_year_marksheet_path =$filenametostore;
                            $me_students->third_year_marksheet='Yes';
                        $me_students->save();
                        }
                         else
                        {
                              $me_students->third_year_marksheet='No';
                              $me_students->save();
                        }
                 }
              elseif ($test_third_year_marksheet=="no") {
                $me_students->third_year_marksheet='No';
              }
              elseif ($test_third_year_marksheet== null) {
                $request->session()->flash('third_year_marksheet_error', 'Please select an option');
                  return redirect()->route('me_document_upload');
              }

      
         }

        $test_fourth_year_marksheet = $request->input('fourth_year_marksheet');
        if($me_students->fourth_year_marksheet_path == null)
         {
                  if ($test_fourth_year_marksheet=="yes") 
                  {
                      if($request->hasFile('fourth_year_marksheet')) 
                      {
                        $rules = ['fourth_year_marksheet' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('fourth_year_marksheet_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('me_document_upload');
                         }
                        $extension = $request->file('fourth_year_marksheet')->getClientOriginalExtension();
                        $filenametostore = 'fourth_year_marksheet_'.$dte_id.'.'.$extension;
                        $path = $request->file('fourth_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $me_students->fourth_year_marksheet_path =$filenametostore;
                            $me_students->fourth_year_marksheet='Yes';
                        $me_students->save();
                        }
                         else
                        {
                              $me_students->fourth_year_marksheet='No';
                              $me_students->save();
                        }
                 }
              elseif ($test_fourth_year_marksheet=="no") {
                $me_students->fourth_year_marksheet='No';
              }
              elseif ($test_fourth_year_marksheet== null) {
                $request->session()->flash('fourth_year_marksheet_error', 'Please select an option');
                  return redirect()->route('me_document_upload');
              }

      
         }

      $test_convocation_passing_certi = $request->input('convocation_passing_certi');
       if($me_students->convocation_passing_certi_path == null)
         {
                  if ($test_convocation_passing_certi=="yes") 
                  {
                      if($request->hasFile('convocation_passing_certi')) 
                      {
                        $rules = ['convocation_passing_certi' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('convocation_passing_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('me_document_upload');
                         }
                        $extension = $request->file('convocation_passing_certi')->getClientOriginalExtension();
                        $filenametostore = 'convocation_passing_certi_'.$dte_id.'.'.$extension;
                        $path = $request->file('convocation_passing_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $me_students->convocation_passing_certi_path = $filenametostore;
                                $me_students->convocation_passing_certi='Yes';
                        $me_students->save();
                      }
                      else
                        {
                              $me_students->convocation_passing_certi='No';
                              $me_students->save();
                        }
                }
            elseif ($test_convocation_passing_certi=="no") {
                $me_students->convocation_passing_certi='No';
              }
              elseif ($test_convocation_passing_certi== null) {
                $request->session()->flash('convocation_passing_certi_error', 'Please select an option');
                  return redirect()->route('me_document_upload');
              }
         }

      
      $test_migration_certi = $request->input('migration_certi');
      if($me_students->migration_certi_path == null)
         {
                      if ($test_migration_certi=="yes") 
                  {
                  if($request->hasFile('migration_certi')) 
                  {
                    $rules = ['migration_certi' => 'mimes:pdf|max:1024'];
                      $validator = Validator::make(Input::all() , $rules);
                    if ($validator->fails())
                     {
                      $request->session()->flash('migration_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                      return redirect()->route('me_document_upload');
                     }
                    $extension = $request->file('migration_certi')->getClientOriginalExtension();
                   $filenametostore = 'migration_certi_'.$dte_id.'.'.$extension;
                    $path = $request->file('migration_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                    $me_students->migration_certi_path = $filenametostore;
                            $me_students->migration_certi='Yes';
                    $me_students->save();
                  }
                  else
                    {
                          $me_students->migration_certi='No';
                          $me_students->save();
                    }
                }
                elseif ($test_migration_certi=="no") {
                    $me_students->migration_certi='No';
                  }
                  elseif ($test_migration_certi== null) {
                    $request->session()->flash('migration_certi_error', 'Please select an option');
                      return redirect()->route('me_document_upload');
                  }
         }

      $test_birth_certi = $request->input('birth_certi');
     if($me_students->birth_certi_path == null)
         {
                  if ($test_birth_certi=="yes") 
              {
                      if($request->hasFile('birth_certi')) 
                      {
                        $rules = ['birth_certi' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('birth_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('me_document_upload');
                         }
                        $extension = $request->file('birth_certi')->getClientOriginalExtension();
                        $filenametostore = 'birth_certi_'.$dte_id.'.'.$extension;
                        $path = $request->file('birth_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $me_students->birth_certi_path = $filenametostore;
                        $me_students->birth_certi='Yes';
                        $me_students->save();
                      }
                      else
                        {
                              $me_students->birth_certi='No';
                              $me_students->save();
                        }
             }
            elseif ($test_birth_certi=="no") {
                $me_students->birth_certi='No';
              }
              elseif ($test_birth_certi== null) {
                $request->session()->flash('birth_certi_error', 'Please select an option');
                  return redirect()->route('me_document_upload');
              }
         }
      $test_domicile = $request->input('domicile');
      if($me_students->domicile_path == null)
         {
                  if ($test_domicile=="yes") 
                  {
                      if($request->hasFile('domicile')) 
                      {
                        $rules = ['domicile' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('domicile_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('me_document_upload');
                         }
                        $extension = $request->file('domicile')->getClientOriginalExtension();
                        $filenametostore = 'domicile_'.$dte_id.'.'.$extension;
                        $path = $request->file('domicile')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $me_students->domicile_path =$filenametostore;
                                $me_students->domicile='Yes';
                        $me_students->save();
                       }
                
                        else
                        {
                              $me_students->domicile='No';
                              $me_students->save();
                        }
                }
             elseif ($test_domicile=="no") {
                $me_students->domicile='No';
              }
              elseif ($test_domicile== null) {
                $request->session()->flash('domicile_error', 'Please select an option');
                  return redirect()->route('me_document_upload');
              }
         }
     $test_proforma_o = $request->input('proforma_o');
           if($me_students->proforma_o_path == null)
         {
                      if ($test_proforma_o=="yes") 
                  {
                          if($request->hasFile('proforma_o')) 
                          {
                                $rules = ['proforma_o' => 'mimes:pdf|max:1024'];
                                  $validator = Validator::make(Input::all() , $rules);
                                if ($validator->fails())
                                 {
                                  $request->session()->flash('proforma_o_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                  return redirect()->route('me_document_upload');
                                }
                            $extension = $request->file('proforma_o')->getClientOriginalExtension();
                            $filenametostore = 'proforma_o_'.$dte_id.'.'.$extension;
                            $path = $request->file('proforma_o')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $me_students->proforma_o_path = $filenametostore;
                                    $me_students->proforma_o='Yes';
                            $me_students->save();
                            }
                            else
                            {
                                  $me_students->proforma_o='No';
                                  $me_students->save();
                            }
                 }
                  elseif ($test_proforma_o=="no") {
                    $me_students->proforma_o='No';
                  }
                  elseif ($test_proforma_o=="na") {
                    $me_students->proforma_o='Not Applicable';
                  }
                  elseif ($test_proforma_o== null) {
                    $request->session()->flash('proforma_o_error', 'Please select an option');
                      return redirect()->route('me_document_upload');
                  }
         }
       $test_retention = $request->input('retention');
       
       if($me_students->retention_path == null)
         {
                      if ($test_retention=="yes") 
                  {
                          if($request->hasFile('retention')) 
                          {
                                    $rules = ['retention' => 'mimes:pdf|max:1024'];
                                      $validator = Validator::make(Input::all() , $rules);
                                    if ($validator->fails())
                                     {
                                      $request->session()->flash('retention_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                      return redirect()->route('me_document_upload');
                                     }
                                    $extension = $request->file('retention')->getClientOriginalExtension();
                                    $filenametostore = 'retention_'.$dte_id.'.'.$extension;
                                    $path = $request->file('retention')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                    $me_students->retention_path = $filenametostore;
                                    $me_students->retention='Yes';
                                    $me_students->save();
                          }
                    
                           else
                            {
                                  $me_students->retention='No';
                                  $me_students->save();
                            }
                }
                elseif ($test_retention=="no") {
                    $me_students->retention='No';
                  }
                  elseif ($test_retention=="na") {
                    $me_students->retention='Not Applicable';
                  }
                  elseif ($test_retention== null) {
                    $request->session()->flash('retention_error', 'Please select an option');
                      return redirect()->route('me_document_upload');
                  }
         }

      $test_minority_affidavit = $request->input('minority_affidavit');
      if($me_students->minority_affidavit_path == null)
         {
                  if ($test_minority_affidavit=="yes") 
              {
              if($request->hasFile('minority_affidavit')) 
              {
                        $rules = ['minority_affidavit' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('minority_affidavit_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('me_document_upload');
                         }
                        $extension = $request->file('minority_affidavit')->getClientOriginalExtension();
                        $filenametostore = 'minority_affidavit_'.$dte_id.'.'.$extension;
                        $path = $request->file('minority_affidavit')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $me_students->minority_affidavit_path = $filenametostore;
                        $me_students->minority_affidavit='Yes';
                        $me_students->save();
                        }
                         else
                        {
                              $me_students->minority_affidavit='No';
                              $me_students->save();
                        }
              }
              elseif ($test_minority_affidavit=="no") {
                $me_students->minority_affidavit='No';
              }
              elseif ($test_minority_affidavit=="na") {
                $me_students->minority_affidavit='Not Applicable';
              }
              elseif ($test_minority_affidavit== null) {
                $request->session()->flash('minority_affidavit_error', 'Please select an option');
                  return redirect()->route('me_document_upload');
              }
         }

      $test_gap_certi = $request->input('gap_certi');
       if($me_students->gap_certi_path == null)
         {
                  if ($test_gap_certi=="yes") 
              {
                          if($request->hasFile('gap_certi')) 
                          {
                                $rules = ['gap_certi' => 'mimes:pdf|max:1024'];
                                  $validator = Validator::make(Input::all() , $rules);
                                if ($validator->fails())
                                 {
                                  $request->session()->flash('gap_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                                  return redirect()->route('me_document_upload');
                                 }
                                $extension = $request->file('gap_certi')->getClientOriginalExtension();
                                $filenametostore = 'gap_certi_'.$dte_id.'.'.$extension;
                                $path = $request->file('gap_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                                $me_students->gap_certi_path =$filenametostore;
                                $me_students->gap_certi='Yes';
                                $me_students->save();
                            }
                                else
                                {
                                      $me_students->gap_certi='No';
                                      $me_students->save();
                                }
            }
              elseif ($test_gap_certi=="no") {
                $me_students->gap_certi='No';
              }
              elseif ($test_gap_certi=="na") {
                $me_students->gap_certi='Not Applicable';
              }
              elseif ($test_gap_certi== null) {
                $request->session()->flash('gap_certi_error', 'Please select an option');
                  return redirect()->route('me_document_upload');
              }
         }
      $test_community_certi = $request->input('community_certi');
      
      if($me_students->community_certi_path == null)
         {
                      if ($test_community_certi=="yes") 
                  {
                          if($request->hasFile('community_certi')) 
                          {
                            $rules = ['community_certi' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('community_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              return redirect()->route('me_document_upload');
                             }
                            $extension = $request->file('community_certi')->getClientOriginalExtension();
                            $filenametostore = 'community_certi_'.$dte_id.'.'.$extension;
                            $path = $request->file('community_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $me_students->community_certi_path = $filenametostore;
                            $me_students->community_certi='Yes';
                            $me_students->save();
                            }
                             else
                            {
                                  $me_students->community_certi='No';
                                  $me_students->save();
                            }
                  }
                  elseif ($test_community_certi=="no") {
                    $me_students->community_certi='No';
                  }
                  elseif ($test_community_certi=="na") {
                    $me_students->community_certi='Not Applicable';
                  }
                  elseif ($test_community_certi== null) {
                    $request->session()->flash('community_certi_error', 'Please select an option');
                      return redirect()->route('me_document_upload');
                  } 
         }
      $test_caste_certi = $request->input('caste_certi');
      
      if($me_students->caste_certi_path == null)
         {
                      if ($test_caste_certi=="yes") 
                  {
                          if($request->hasFile('caste_certi')) 
                          {
                            $rules = ['caste_certi' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('caste_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              return redirect()->route('me_document_upload');
                             }
                            $extension = $request->file('caste_certi')->getClientOriginalExtension();
                            $filenametostore = 'caste_certi_'.$dte_id.'.'.$extension;
                            $path = $request->file('caste_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $me_students->caste_certi_path =$filenametostore;
                            $me_students->caste_certi='Yes';
                            $me_students->save();
                           }
                            else
                            {
                                  $me_students->caste_certi='No';
                                  $me_students->save();
                            }
                 }
                 elseif ($test_caste_certi=="no") {
                    $me_students->caste_certi='No';
                  }
                  elseif ($test_caste_certi=="na") {
                    $me_students->caste_certi='Not Applicable';
                  }
                  elseif ($test_caste_certi== null) {
                    $request->session()->flash('caste_certi_error', 'Please select an option');
                      return redirect()->route('me_document_upload');
                  }
         }

      $test_caste_validity_certi = $request->input('caste_validity_certi');
      if($me_students->caste_validity_certi_path == null)
         {
                  if ($test_caste_validity_certi=="yes") 
              {
                      if($request->hasFile('caste_validity_certi')) 
                      {
                        $rules = ['caste_validity_certi' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('caste_validity_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('me_document_upload');
                         }
                        $extension = $request->file('caste_validity_certi')->getClientOriginalExtension();
                        $filenametostore = 'caste_validity_certi_'.$dte_id.'.'.$extension;
                        $path = $request->file('caste_validity_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $me_students->caste_validity_certi_path = $filenametostore;
                        $me_students->caste_validity_certi='Yes';
                        $me_students->save();
                       }
                       else
                        {
                              $me_students->caste_validity_certi='No';
                              $me_students->save();
                        }
             }
             elseif ($test_caste_validity_certi=="no") {
                $me_students->caste_validity_certi='No';
              }
              elseif ($test_caste_validity_certi=="na") {
                $me_students->caste_validity_certi='Not Applicable';
              }
              elseif ($test_caste_validity_certi== null) {
                $request->session()->flash('caste_validity_certi_error', 'Please select an option');
                  return redirect()->route('me_document_upload');
              }
         }
      $test_non_creamy_layer_certi = $request->input('non_creamy_layer_certi');
       if($me_students->non_creamy_layer_certi_path == null)
         {
                  if ($test_non_creamy_layer_certi=="yes") 
              {
                      if($request->hasFile('non_creamy_layer_certi')) 
                      {
                        $rules = ['non_creamy_layer_certi' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('non_creamy_layer_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('me_document_upload');
                         }
                        $extension = $request->file('non_creamy_layer_certi')->getClientOriginalExtension();
                        $filenametostore = 'non_creamy_layer_certi_'.$dte_id.'.'.$extension;
                        $path = $request->file('non_creamy_layer_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $me_students->non_creamy_layer_certi_path = $filenametostore;
                        $me_students->non_creamy_layer_certi='Yes';
                        $me_students->save();
                        }
                
                         else
                        {
                              $me_students->non_creamy_layer_certi='No';
                              $me_students->save();
                        }
              }
              elseif ($test_non_creamy_layer_certi=="no") {
                $me_students->non_creamy_layer_certi='No';
              }
              elseif ($test_non_creamy_layer_certi=="na") {
                $me_students->non_creamy_layer_certi='Not Applicable';
              }
              elseif ($test_non_creamy_layer_certi== null) {
                $request->session()->flash('non_creamy_layer_certi_error', 'Please select an option');
                  return redirect()->route('me_document_upload');
              }
         }

      
      

      $test_proforma_a_b1_b2 = $request->input('proforma_a_b1_b2');
      if($me_students->proforma_a_b1_b2_path == null)
         {
               
                  if ($test_proforma_a_b1_b2=="yes") 
              {
                      if($request->hasFile('proforma_a_b1_b2')) 
                      {
                        $rules = ['proforma_a_b1_b2' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('proforma_a_b1_b2_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('me_document_upload');
                         }
                        $extension = $request->file('proforma_a_b1_b2')->getClientOriginalExtension();
                       $filenametostore = 'proforma_a_b1_b2_'.$dte_id.'.'.$extension;
                       $path = $request->file('proforma_a_b1_b2')->storeAs($destinationPath, $filenametostore,'public_uploads');
                       $me_students->proforma_a_b1_b2_path = $filenametostore;
                        $me_students->proforma_a_b1_b2='Yes';
                        $me_students->save();
                        }
                
                         else
                        {
                              $me_students->proforma_a_b1_b2='No';
                              $me_students->save();
                        }
              }
              elseif ($test_proforma_a_b1_b2=="no") {
                $me_students->proforma_a_b1_b2='No';
              }
              elseif ($test_proforma_a_b1_b2=="na") {
                $me_students->proforma_a_b1_b2='Not Applicable';
              }
              elseif ($test_proforma_a_b1_b2== null) {
                $request->session()->flash('proforma_a_b1_b2_error', 'Please select an option');
                  return redirect()->route('me_document_upload');
              }
}
      $test_proforma_f_f1 = $request->input('proforma_f_f1');
      if($me_students->proforma_f_f1_path == null)
         {
                  if ($test_proforma_f_f1=="yes") 
              {
                      if($request->hasFile('proforma_f_f1')) 
                      {
                        $rules = ['proforma_f_f1' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('proforma_f_f1_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('me_document_upload');
                         }
                        $extension = $request->file('proforma_f_f1')->getClientOriginalExtension();
                        $filenametostore = 'proforma_f_f1_'.$dte_id.'.'.$extension;
                        $path = $request->file('proforma_f_f1')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $me_students->proforma_f_f1_path = $filenametostore;
                        $me_students->proforma_f_f1='Yes';
                        $me_students->save();
                        }
                         else
                        {
                              $me_students->proforma_f_f1='No';
                              $me_students->save();
                        }
              }
              elseif ($test_proforma_f_f1=="no") {
                $me_students->proforma_f_f1='No';
              }
              elseif ($test_proforma_f_f1=="na") {
                $me_students->proforma_f_f1='Not Applicable';
              }
              elseif ($test_proforma_f_f1== null) {
                $request->session()->flash('proforma_f_f1_error', 'Please select an option');
                  return redirect()->route('me_document_upload');
              }
         }
      $test_income_certi = $request->input('income_certi');
       if($me_students->income_certi_path == null)
         {
                      if ($test_income_certi=="yes") 
                  {
                          if($request->hasFile('income_certi')) 
                          {
                            $rules = ['income_certi' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('income_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              return redirect()->route('me_document_upload');
                             }
                            $extension = $request->file('income_certi')->getClientOriginalExtension();
                            $filenametostore = 'income_certi_'.$dte_id.'.'.$extension;
                            $path = $request->file('income_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $me_students->income_certi_path = $filenametostore;
                            $me_students->income_certi='Yes';
                            $me_students->save();
                          }
                          else
                            {
                                  $me_students->income_certi='No';
                                  $me_students->save();
                            }
                }
                elseif ($test_income_certi=="no") {
                    $me_students->income_certi='No';
                  }
                  elseif ($test_income_certi=="na") {
                    $me_students->income_certi='Not Applicable';
                  }
                  elseif ($test_income_certi== null) {
                    $request->session()->flash('income_certi_error', 'Please select an option');
                      return redirect()->route('me_document_upload');
                  }
         }

      $test_proforma_c_d_e = $request->input('proforma_c_d_e');
        if($me_students->proforma_c_d_e_path == null)
         {
                  if ($test_proforma_c_d_e=="yes") 
              {
                      if($request->hasFile('proforma_c_d_e')) 
                      {
                        $rules = ['proforma_c_d_e' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('proforma_c_d_e_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('me_document_upload');
                         }
                        $extension = $request->file('proforma_c_d_e')->getClientOriginalExtension();
                        $filenametostore = 'proforma_c_d_e'.$dte_id.'.'.$extension;
                        $path = $request->file('proforma_c_d_e')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $me_students->proforma_c_d_e_path = $filenametostore;
                                $me_students->proforma_c_d_e='Yes';
                        $me_students->save();
                      }
                       else
                        {
                              $me_students->proforma_c_d_e='No';
                              $me_students->save();
                        }
            }
            elseif ($test_proforma_c_d_e=="no") {
                $me_students->proforma_c_d_e='No';
              }
              elseif ($test_proforma_c_d_e=="na") {
                $me_students->proforma_c_d_e='Not Applicable';
              }
              elseif ($test_proforma_c_d_e== null) {
                $request->session()->flash('proforma_c_d_e_error', 'Please select an option');
                  return redirect()->route('me_document_upload');
              }
         }
      $test_proforma_j_k_l = $request->input('proforma_j_k_l');
      if($me_students->proforma_j_k_l_path == null)
         {
                  if ($test_proforma_j_k_l=="yes") 
              {
                      if($request->hasFile('proforma_j_k_l')) 
                      {
                        $rules = ['proforma_j_k_l' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('proforma_j_k_l_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('me_document_upload');
                         }
                        $extension = $request->file('proforma_j_k_l')->getClientOriginalExtension();
                        $filenametostore = 'proforma_j_k_l_'.$dte_id.'.'.$extension;
                        $path = $request->file('proforma_j_k_l')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $me_students->proforma_j_k_l_path =$filenametostore;
                        $me_students->proforma_j_k_l='Yes';
                        $me_students->save();
                      }
                      else
                        {
                              $me_students->proforma_j_k_l='No';
                              $me_students->save();
                        }
            }
            elseif ($test_proforma_j_k_l=="no") {
                $me_students->proforma_j_k_l='No';
              }
              elseif ($test_proforma_j_k_l=="na") {
                $me_students->proforma_j_k_l='Not Applicable';
              }
              elseif ($test_proforma_j_k_l== null) {
                $request->session()->flash('proforma_j_k_l_error', 'Please select an option');
                  return redirect()->route('me_document_upload');
              }
         }
      $test_medical_certi = $request->input('medical_certi');
       if($me_students->medical_certi_path == null)
         {
                      if ($test_medical_certi=="yes") 
                  {
                          if($request->hasFile('medical_certi')) 
                          {
                            $rules = ['medical_certi' => 'mimes:pdf|max:1024'];
                              $validator = Validator::make(Input::all() , $rules);
                            if ($validator->fails())
                             {
                              $request->session()->flash('medical_certi_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                              return redirect()->route('me_document_upload');
                             }
                            $extension = $request->file('medical_certi')->getClientOriginalExtension();
                            $filenametostore = 'medical_certi_'.$dte_id.'.'.$extension;
                            $path = $request->file('medical_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
                            $me_students->medical_certi_path = $filenametostore;
                                    $me_students->medical_certi='Yes';
                            $me_students->save();
                          }
                            else
                            {
                                  $me_students->medical_certi='No';
                                  $me_students->save();
                            }
                }
                elseif ($test_medical_certi=="no") {
                    $me_students->medical_certi='No';
                  }
                  elseif ($test_medical_certi== null) {
                    $request->session()->flash('medical_certi_error', 'Please select an option');
                      return redirect()->route('me_document_upload');
                  }
         }
      $test_anti_ragging_affidavit = $request->input('anti_ragging_affidavit');
        if($me_students->anti_ragging_affidavit_path == null)
         {
                  if ($test_anti_ragging_affidavit=="yes") 
              {
                      if($request->hasFile('anti_ragging_affidavit')) 
                      {
                        $rules = ['anti_ragging_affidavit' => 'mimes:pdf|max:1024'];
                          $validator = Validator::make(Input::all() , $rules);
                        if ($validator->fails())
                         {
                          $request->session()->flash('anti_ragging_affidavit_error', 'Please Upload Only PDF. File size should be less than 1 mb.');
                          return redirect()->route('me_document_upload');
                         }
                        $extension = $request->file('anti_ragging_affidavit')->getClientOriginalExtension();
                        $filenametostore = 'anti_ragging_affidavit'.$dte_id.'.'.$extension;
                        $path = $request->file('anti_ragging_affidavit')->storeAs($destinationPath, $filenametostore,'public_uploads');
                        $me_students->anti_ragging_affidavit_path = $filenametostore;
                                $me_students->anti_ragging_affidavit='Yes';
                        $me_students->save();
                      }
                       else
                        {
                              $me_students->anti_ragging_affidavit='No';
                              $me_students->save();
                        }
            }
            elseif ($test_anti_ragging_affidavit=="no") {
                $me_students->anti_ragging_affidavit='No';
              }
              elseif ($test_anti_ragging_affidavit== null) {
                $request->session()->flash('anti_ragging_affidavit_error', 'Please select an option');
                  return redirect()->route('me_document_upload');
              }
         }

      

      $user = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();

        $user1 = DB::table('me_students')->select('dte_id','fc_confirmation_receipt','fc_confirmation_receipt_path','dte_allotment_letter','dte_allotment_letter_path','arc_ackw_receipt','arc_ackw_receipt_path','gate_result','gate_result_path','ssc_marksheet','ssc_marksheet_path','hsc_marksheet','hsc_marksheet_path','degree_leaving_tc','degree_leaving_tc_path','first_year_marksheet','first_year_marksheet_path','second_year_marksheet','second_year_marksheet_path','third_year_marksheet','third_year_marksheet_path','fourth_year_marksheet','fourth_year_marksheet_path','convocation_passing_certi','convocation_passing_certi_path','migration_certi','migration_certi_path','birth_certi','birth_certi_path','domicile','domicile_path','proforma_o','proforma_o_path','retention','retention_path','minority_affidavit','minority_affidavit_path','gap_certi','gap_certi_path','community_certi','community_certi_path','caste_certi','caste_certi_path','caste_validity_certi','caste_validity_certi_path','non_creamy_layer_certi','non_creamy_layer_certi_path','proforma_h','proforma_h_path','proforma_a_b1_b2','proforma_a_b1_b2_path','proforma_f_f1','proforma_f_f1_path','income_certi','income_certi_path','proforma_c_d_e','proforma_c_d_e_path','anti_ragging_affidavit','anti_ragging_affidavit_path','proforma_j_k_l','proforma_j_k_l_path','medical_certi','medical_certi_path','photo','photo_path','signature','signature_path')->where('dte_id', $dte_id)->get();
        $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        $hash = $hash[0]->hash;
        if($user1[0]->photo ==  "Yes" && $user1[0]->signature == "Yes")
        {

            $me_students->is_document_completed =1;
             $me_students->save();
    
        }
        elseif($user1[0]->photo ==  null || $user1[0]->signature == null)
        {
              $me_students->is_document_completed =0;
             
             $me_students->save();
        }
        $data=[];
         $course = $request->session()->get('log_course');
        
        list($user1['prog_val'],$userprogress)= HomeController::meprogressbar($course,$dte_id); 
        if ($userprogress[0]->is_document_completed==1) {
            $user1['prog_val']=7;
          }  
        $data['hash'] = $user[0]->hash;
        $data['user1']=$user1;
        
          
        return view('user.me.document_upload',$data);


  }



  public static function insertmeProfile(Request $request)
    {
    return view('user.me.profile');
    }



  public static function showmePaymentDetails(Request $request)
    {

     $dte_id = $request->session()->get('log_dte_id', 'null');
    if ($dte_id != 'null')
      {
          $users = DB::table('fees_transaction')->where('dte_id',$dte_id)->get();
          $course= $request->session()->get('log_course');
          
          return view('user.me.payment_details')->with('users',$users);
      }
      else
      {
      return redirect()->route('logout');
      }
    }




  public static function showadmissionPayment(Request $request)
    {
        $dte_id = $request->session()->get('log_dte_id', 'null');
        $log_dte = $request->session()->get('log_dte');
        $log_acap = $request->session()->get('log_acap');
        $course = $request->session()->get('log_course');
        //return $course;
        if($log_dte == "yes")
        {
          $admission_type = "DTE";
          $event = "DTE";

        }
        else if($log_acap == "yes")
        {
          $admission_type = "ACAP";
          $event = "ACAP";
        }
               // return $admission_type;
        //return $dte_id;
       if ($dte_id != 'null')
        {
          $board='';
         
              if(DB::table('admission')->where('dte_id',$dte_id)->exists())
              {     

                    if($course == "MCA")
                    {
                      //changes done for if dte id is not completed it gives undefined ofset zero to avoid such errors
                        $course = $request->session()->get('log_course');
                         list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
                               if($userprogress[0]->is_dte_details_completed ==0){
                              return redirect('mca_dte_details');
                              }
                        
                        if(DB::table('part_payment')->where('dte_id',$dte_id)->exists())
                        {
                            
                            $user =DB::table('part_payment')->where('dte_id',$dte_id)->get();
                            //return $user;
                            DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['granted_amt' => $user[0]->amt],['balance_amt' => $user[0]->amt]);
                        }
                        else
                        {
                            $user=DB::table('admission')->select('paid_amt')->where('dte_id',$dte_id)->get();
                              if($user[0]->paid_amt==0)
                              {
                           $user1 = DB::table('mca_students')->select('category')->where('dte_id',$dte_id)->get();
                           $board=DB::table('mca_students')->select('university_type')->where('dte_id',$dte_id)->get();
                           $board=strval( $board[0]->university_type);                  
                           $user3 = DB::table('fees_structure')->select('amt')->where('board',$board)->where('fee_category',$user1[0]->category)->where('course',$course)->get();


                           DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['granted_amt' => $user3[0]->amt]);
                             DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['balance_amt' => $user3[0]->amt]);
                               DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['total_amt' => $user3[0]->amt]);
                              DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['fees_category' => $user1[0]->category]);
                              DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['admission_category' =>$event]);
                            }
                        }
                    }

                    if($course == "FEG")
                    { 
                      //changes done for if dte id is not completed it gives undefined ofset zero to avoid such errors
                        $course = $request->session()->get('log_course');
                         list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
                               if($userprogress[0]->is_dte_details_completed ==0){
                              return redirect('fe_dte_details');
                              }
                    if(DB::table('part_payment')->where('dte_id',$dte_id)->exists())
                            {
                                $user =DB::table('part_payment')->where('dte_id',$dte_id)->get();
                                DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['granted_amt' => $user[0]->amt],['balance_amt' => $user[0]->amt]);
                            }
                            else
                            {
                              $user=DB::table('admission')->select('paid_amt')->where('dte_id',$dte_id)->get();
                              if($user[0]->paid_amt==0)
                              {
                                // return 'hello';
                                $board=DB::table('fe_students')->select('xii_board')->where('dte_id',$dte_id)->get();
                                $board=strval( $board[0]->xii_board);
                                // return$board;
                                $user1 = DB::table('fe_students')->select('category')->where('dte_id',$dte_id)->get();
                                $user3='';

                                if($board=="Maharashtra board" ||$board=="CBSE"||$board=="ICSE" ){
                                   $user3 = DB::table('fees_structure')->select('amt')->where('fee_category',$user1[0]->category)->where('board',$board)->where('course',$course)->get();
                                  // return $user3;
                            }else{
                              $board=DB::table('fe_students')->select('xii_board')->where('dte_id',$dte_id)->get();
                                $board=strval( $board[0]->xii_board);
                                $user3 = DB::table('fees_structure')->select('amt')->where('fee_category',$user1[0]->category)->where('board','OTHER')->where('course',$course)->get();
                              
                              }
                              // return $user3;
                                DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['granted_amt' => $user3[0]->amt]);
                               DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['balance_amt' => $user3[0]->amt]);
                                 DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['total_amt' => $user3[0]->amt]);
                                DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['fees_category' => $user1[0]->category]);
                                DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['admission_category' =>$event]);
                            }
                          }
                    }
                    if($course == "MEG")
                    { 
                      //changes done for if dte id is not completed it gives undefined ofset zero to avoid such errors
                        $course = $request->session()->get('log_course');
                        
                         list( $user1['prog_val'],$userprogress)= HomeController::meprogressbar($course,$dte_id);
                               if($userprogress[0]->is_dte_completed ==0){
                              return redirect('me_dte_details');
                              }

                            if(DB::table('part_payment')->where('dte_id',$dte_id)->exists())
                            {
                                $user =DB::table('part_payment')->where('dte_id',$dte_id)->get();
                                DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['granted_amt' => $user[0]->amt],['balance_amt' => $user[0]->amt]);
                            }
                            else
                            {
                              $user=DB::table('admission')->select('paid_amt')->where('dte_id',$dte_id)->get();

                              if($user[0]->paid_amt==0)
                              {

                                $user1 = DB::table('me_students')->select('category')->where('dte_id',$dte_id)->get();
                                //return $user1;
                                $board=DB::table('me_students')->select('university_type')->where('dte_id',$dte_id)->get();
                   $board=strval( $board[0]->university_type);   
                                $user3 = DB::table('fees_structure')->select('amt')->where('fee_category',$user1[0]->category)->where('board',$board)->where('course',$course)->get();
                                // return $user3;
                                DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['granted_amt' => $user3[0]->amt]);
                               DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['balance_amt' => $user3[0]->amt]);
                                 DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['total_amt' => $user3[0]->amt]);
                                DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['fees_category' => $user1[0]->category]);
                                DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['admission_category' =>$event]);
                            }
                          }
                    }
                     if($course == "DSE")
                    {
                       //changes done for if dte id is not completed it gives undefined ofset zero to avoid such errors
                        $course = $request->session()->get('log_course');
                         list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
                               if($userprogress[0]->is_dte_details_completed ==0){
                              return redirect('fe_dte_details');
                              }
                        if(DB::table('part_payment')->where('dte_id',$dte_id)->exists())
                        {
                            $user =DB::table('part_payment')->where('dte_id',$dte_id)->get();
                            DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['granted_amt' => $user[0]->amt],['balance_amt' => $user[0]->amt]);
                        }
                        else
                        {
                            $user=DB::table('admission')->select('paid_amt')->where('dte_id',$dte_id)->get();
                              if($user[0]->paid_amt==0)
                              {
                           $user1 = DB::table('dse_students')->select('category')->where('dte_id',$dte_id)->get();

                           //return $course;
                           $user3 = DB::table('fees_structure')->select('amt')->where('fee_category',$user1[0]->category)->where('course',$course)->get();
                           DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['granted_amt' => $user3[0]->amt]);
                             DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['balance_amt' => $user3[0]->amt]);
                               DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['total_amt' => $user3[0]->amt]);
                              DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['fees_category' => $user1[0]->category]);
                              DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['admission_category' =>$event]);
                            }
                        }
                    }
              
                 
              }
              else
              {


                if ($course=='FEG') {
                  
                  if($board=="Maharashtra Board" ||$board=="CBSE"||$board=="ICSE" ){
                    
                DB::select("call insert_fe_admission('$dte_id','$admission_type','$course','$board')");
              }else{
                  DB::select("call insert_fe_admission('$dte_id','$admission_type','$course','OTHER')");

              }
                }
               elseif($course=='MCA') {
                  
                   $board=DB::table('mca_students')->select('university_type')->where('dte_id',$dte_id)->get();
                   $board=strval( $board[0]->university_type);                  
                DB::select("call insert_fe_admission('$dte_id','$admission_type','$course','$board')");
              }
              elseif($course=='MEG') {
                  
                   $board=DB::table('me_students')->select('university_type')->where('dte_id',$dte_id)->get();
                   $board=strval( $board[0]->university_type);  
                   DB::select("call insert_fe_admission('$dte_id','$admission_type','$course','$board')");
                   $user1 = DB::table('me_students')->select('category')->where('dte_id',$dte_id)->get();
                   // return $user1;

                   $user3 = DB::table('fees_structure')->select('amt')->where('fee_category',$user1[0]->category)->where('course',$course)->where('board',$board)->get();
                   
                                DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['granted_amt' => $user3[0]->amt]);
                               DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['balance_amt' => $user3[0]->amt]);
                                 DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['total_amt' => $user3[0]->amt]);
                                DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['fees_category' => $user1[0]->category]);
                                DB::table('admission')->where('dte_id',$dte_id)->where('course',$course)->update(['admission_category' =>$event]);

                   // echo "$dte_id,$admission_type,$course,$board";
                   // return "after query"; 
              }       
                  else{
                    
                DB::select("call insert_admission('$dte_id','$admission_type','$course')");//FOR DSE IT DONT HAVE ANY UNIVERSITY ACCORDING TO DATA FROM ONLINE SITE 
              }
              }
            // return $board;
              $users = DB::table('admission')->select('balance_amt','paid_amt')->where('dte_id',$dte_id)->get();
              
             // return $users;
              if($course == "MEG")
              {

                   if($users == [] || $users[0]->balance_amt === null)
                 {
                
                    $partpay = DB::table('part_payment')->where('dte_id',$dte_id)->get();
 
                    if($partpay == [] || $partpay[0]->amt == null)
                    {

                      // 
                        $seat_type = DB::table('me_students')->select('category')->where('dte_id',$dte_id)->get();
                          if($seat_type == [] || $seat_type[0]->category == null)
                          {
                            $request->session()->flash('error', 'Please fill this page before moving on to payment');
                            return redirect()->route('me_dte_details');
                          }
                        else
                        {
                           $array_object = [['balance_amt' => null]];
                           $users = json_decode(json_encode($array_object));
                           $part['amt'] = null;

                           $fees = DB::table('fees_structure')->where('fee_category',$seat_type[0]->category)->get();
                           $request->session()->put('balanceAmt',$users[0]->balance_amt);
                           $request->session()->put('fees',$fees[0]->amt);
                           $request->session()->put('part',$part['amt']);
                           list( $user1['prog_val'],$userprogress)= HomeController::meprogressbar($course,$dte_id);
                    if($userprogress[0]->is_document_completed ==0){
                      return redirect('me_document_upload');
                      }
                      // return "1st";
                          return view('user.me.feePayment')->with('fees',$fees)->with('part',$part)->with('users',$users)->with('users1',$users1);

                         }
                    }

                    else
                        { 
                          // return "hello";
                           $array_object = [['balance_amt' => null]];
                             $users = json_decode(json_encode($array_object));
                          
                          $part['amt'] = $partpay[0]->amt;
                           $array_object = [['amt' => null]];
                             $fees = json_decode(json_encode($array_object));
                             if(DB::table('admission')->where('dte_id', $dte_id)->exists())
                             {
                              DB::table('admission')->where('dte_id', $dte_id)->where('admission_type',$event)->where('course',$course)->update(['granted_amt' => $partpay[0]->amt]);
                             }
                            
                              $request->session()->put('balanceAmt',$users[0]->balance_amt);
                             $request->session()->put('fees',$fees[0]->amt);
                             $request->session()->put('part',$part['amt']);
                              list( $user1['prog_val'],$userprogress)= HomeController::meprogressbar($course,$dte_id);
                    if($userprogress[0]->is_document_completed ==0){
                      return redirect('me_document_upload');
                      }
                      
                            return view('user.me.feePayment')->with('fees',$fees)->with('part',$part)->with('users',$users)->with('user1',$users1);
                          }
              }
              else
                {
                    //return $users[0]->balance_amt;
                    if($users[0]->balance_amt == 0)
                    {
                      return redirect()->route('me_final_submit');
                    }
                    else
                    {
                         $part['amt'] = null;
                         $array_object = [['amt' => null]];
                           $fees = json_decode(json_encode($array_object));
                           $request->session()->put('balanceAmt',$users[0]->balance_amt);
                           $request->session()->put('fees',$fees[0]->amt);
                          $request->session()->put('part',$part['amt']);
                          list( $user1['prog_val'],$userprogress)= HomeController::meprogressbar($course,$dte_id);
                    if($userprogress[0]->is_document_completed ==0){
                      return redirect('me_document_upload');
                      }

                           return view('user.me.feePayment')->with('fees',$fees)->with('part',$part)->with('users',$users)->with('user1',$user1);   
                    }   
               }

          }

      
      
      else if($course == "MCA")
      {
             // return $users;
               if($users == [] || $users[0]->balance_amt == 10 || $users[0]->paid_amt == 0  )
              {
                // return $users;
                
               $partpay = DB::table('part_payment')->where('dte_id',$dte_id)->get();
              
              if($partpay == '[]')
                {
                    //return "hello";
                  $seat_type = DB::table('mca_students')->select('category')->where('dte_id',$dte_id)->get();
                  if($seat_type == [] || $seat_type[0]->category == null)
                  {
                    $request->session()->flash('error', 'Please fill this page before moving on to payment');
                    return redirect()->route('mca_dte_details');
                  }
                  else
                  {
                    
                     $array_object = [['balance_amt' => null]];
                     $users = json_decode(json_encode($array_object));
                     $board=DB::table('mca_students')->select('university_type')->where('dte_id',$dte_id)->get();
                    $board=strval( $board[0]->university_type);                  
                    $part['amt'] = null;
                    $fees = DB::select(DB::raw("select amt from fees_structure where course  LIKE '%".$course."%' AND fee_category  LIKE '%".$seat_type[0]->category."%' "."AND board  LIKE '%".$board."%' "));
                   // $fees = DB::table('fees_structure')->where('fee_category',$seat_type[0]->category)->get();
                    // return $fees;
                   
                     $request->session()->put('balanceAmt',$users[0]->balance_amt);
                     $request->session()->put('fees',$fees[0]->amt);
                    $request->session()->put('part',$part['amt']);
                    //return $part;

                    list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
                    if($userprogress[0]->is_document_completed ==0){
                      return redirect('mca_document_upload');
                      }

                    return view('user.mca.feePayment')->with('fees',$fees)->with('part',$part)->with('users',$users)->with('user1',$user1);

                   }
               }
              else
                  {
                   
                       $array_object = [['balance_amt' => null]];
                       $users = json_decode(json_encode($array_object));
                   // return $dte_id;
                     $part['amt'] = $partpay[0]->amt;
                     $array_object = [['amt' => null]];
                       $fees = json_decode(json_encode($array_object));
                        if(DB::table('admission')->where('dte_id', $dte_id)->exists())
                             {
                             DB::table('admission')->where('dte_id',$dte_id)->where('admission_type',$event)->where('course',$course)->update(['granted_amt' => $partpay[0]->amt]);
                             }
                     $request->session()->put('balanceAmt',$users[0]->balance_amt);
                     $request->session()->put('fees',$fees[0]->amt);
                    $request->session()->put('part',$part['amt']);
                    list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
                    if($userprogress[0]->is_document_completed ==0){
                      return redirect('mca_document_upload');
                      }
                      return view('user.mca.feePayment')->with('fees',$fees)->with('part',$part)->with('users',$users)->with('user1',$user1);
                   }
             }
      
              else
              { 
                  
                  if($users[0]->balance_amt == 0)
                  {
                    return redirect()->route('mca_final_submit');
                  }
                  else
                  {
                  $part['amt'] = null;
                  $array_object = [['amt' => null]];
                 $fees = json_decode(json_encode($array_object));
                 
                     $request->session()->put('balanceAmt',$users[0]->balance_amt);
                     $request->session()->put('fees',$fees[0]->amt);
                    $request->session()->put('part',$part['amt']);
                   // return $part;
                    list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
                    if($userprogress[0]->is_document_completed ==0){
                      return redirect('mca_document_upload');
                      }
                 return view('user.mca.feePayment')->with('fees',$fees)->with('part',$part)->with('users',$users)->with('user1',$user1);   
                 }   
             }
       }
       else if($course == "FEG")
      {
             //return "ggg";
               if($users == '[]' || $users[0]->paid_amt == 0  )
              {
                //return $users;
                $partpay = DB::table('part_payment')->where('dte_id',$dte_id)->get();
                if($partpay == '[]')
                {
                //return "hello";
                    $seat_type = DB::table('fe_students')->select('category')->where('dte_id',$dte_id)->get();
                    if($seat_type == [] || $seat_type[0]->category == null)
                    {
                      $request->session()->flash('error', 'Please fill this page before moving on to payment');
                      return redirect()->route('fe_dte_details');
                    }
                    else
                    {
                      $array_object = [['balance_amt' => null]];
                      $users = json_decode(json_encode($array_object));
                      $part['amt'] = null;
                      //changesby kartik
                      $board=DB::table('fe_students')->select('xii_board')->where('dte_id',$dte_id)->get();
                        $board=strval( $board[0]->xii_board);
                       if($board=="Maharashtra board" ||$board=="CBSE"||$board=="ICSE" ){
                                     $fees = DB::select(DB::raw("select amt from fees_structure where course  LIKE '%".$course."%' AND fee_category = '".$seat_type[0]->category."'AND board= '".$board."'"));
                                  
                            }else{
                               $fees = DB::select(DB::raw("select amt from fees_structure where course  LIKE '%".$course."%' AND fee_category = '".$seat_type[0]->category."'AND board='OTHER'"));
                              }                   
                       // return $fees;
                     //_fe_pay_dd return $fees;
                      // $fees = DB::table('fees_structure')->where('fee_category',$seat_type[0]->category)->get();
                      $request->session()->put('balanceAmt',$users[0]->balance_amt);
                      $request->session()->put('fees',$fees[0]->amt);
                      $request->session()->put('part',$part['amt']);
                      list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
                      if($userprogress[0]->is_document_completed ==0){
                      return redirect('fe_document_upload');
                      }
                      return view('user.fe.feePayment')->with('fees',$fees)->with('part',$part)->with('users',$users)->with('user1',$user1);
                    }
                }
              else
                  {
                    
                      $array_object = [['balance_amt' => null]];
                      $users = json_decode(json_encode($array_object));
                      // return $dte_id;
                      $part['amt'] = $partpay[0]->amt;
                      $array_object = [['amt' => null]];
                      $fees = json_decode(json_encode($array_object));
                      if(DB::table('admission')->where('dte_id', $dte_id)->exists())
                      {
                          DB::table('admission')->where('dte_id',$dte_id)->where('admission_type',$event)->where('course',$course)->update(['granted_amt' => $partpay[0]->amt]);
                      }

                      $request->session()->put('balanceAmt',$users[0]->balance_amt);
                      $request->session()->put('fees',$fees[0]->amt);
                      $request->session()->put('part',$part['amt']);
                      list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
                      if($userprogress[0]->is_document_completed ==0){
                      return redirect('fe_document_upload');
                      }
                      return view('user.fe.feePayment')->with('fees',$fees)->with('part',$part)->with('users',$users)->with('user1',$user1);
                   }
             }
      
              else
              {
                  
                  if($users[0]->balance_amt == 0)
                  {
                    return redirect()->route('fe_final_submit');
                  }
                  else
                  {
                  $part['amt'] = null;
                  $array_object = [['amt' => null]];
                 $fees = json_decode(json_encode($array_object));
                 
                     $request->session()->put('balanceAmt',$users[0]->balance_amt);
                     $request->session()->put('fees',$fees[0]->amt);
                    $request->session()->put('part',$part['amt']);
                    list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
                    if($userprogress[0]->is_document_completed ==0){
                      return redirect('fe_document_upload');
                      }
                 return view('user.fe.feePayment')->with('fees',$fees)->with('part',$part)->with('users',$users)->with('user1',$user1);   
                 }   
             }
       }


        else if($course == "DSE")
      {
             // return $users;
               if($users == [] || $users[0]->balance_amt == 10 || $users[0]->paid_amt == 0  )
              {
                //return $users;
                
               $partpay = DB::table('part_payment')->where('dte_id',$dte_id)->get();
                
              if($partpay == '[]')
                {
                    //return "hello";
                  $seat_type = DB::table('dse_students')->select('category')->where('dte_id',$dte_id)->get();
                  if($seat_type == [] || $seat_type[0]->category == null)
                  {
                    $request->session()->flash('error', 'Please fill this page before moving on to payment');
                    return redirect()->route('mca_dte_details');
                  }
                  else
                  {
                     $array_object = [['balance_amt' => null]];
                     $users = json_decode(json_encode($array_object));
                    $part['amt'] = null;
                    $fees = DB::select(DB::raw("select amt from fees_structure where course  LIKE '%".$course."%' AND fee_category  LIKE '%".$seat_type[0]->category."%' "));
                   // $fees = DB::table('fees_structure')->where('fee_category',$seat_type[0]->category)->get();
                   
                     $request->session()->put('balanceAmt',$users[0]->balance_amt);
                     $request->session()->put('fees',$fees[0]->amt);
                    $request->session()->put('part',$part['amt']);
                    list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
                    if($userprogress[0]->is_document_completed ==0){
                      return redirect('dse_document_upload');
                      }
                    return view('user.dse.feePayment')->with('fees',$fees)->with('part',$part)->with('users',$users)->with('user1',$user1);

                   }
               }
              else
                  {
                    
                       $array_object = [['balance_amt' => null]];
                       $users = json_decode(json_encode($array_object));
                   
                     $part['amt'] = $partpay[0]->amt;
                     $array_object = [['amt' => null]];
                       $fees = json_decode(json_encode($array_object));
                        if(DB::table('admission')->where('dte_id', $dte_id)->exists())
                             {
                             DB::table('admission')->where('dte_id',$dte_id)->where('admission_type',$event)->where('course',$course)->update(['granted_amt' => $partpay[0]->amt]);
                             }
                     $request->session()->put('balanceAmt',$users[0]->balance_amt);
                     $request->session()->put('fees',$fees[0]->amt);
                    $request->session()->put('part',$part['amt']);
                    list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
                    if($userprogress[0]->is_document_completed ==0){
                      return redirect('dse_document_upload');
                      }
                      return view('user.dse.feePayment')->with('fees',$fees)->with('part',$part)->with('users',$users)->with('user1',$user1);
                   }
             }
      
              else
              {
                    if($users[0]->balance_amt == 0)
                    {
                      return redirect()->route('dse_final_submit');
                    }
                    else
                    {
                    $part['amt'] = null;
                    $array_object = [['amt' => null]];
                   $fees = json_decode(json_encode($array_object));
                   
                       $request->session()->put('balanceAmt',$users[0]->balance_amt);
                       $request->session()->put('fees',$fees[0]->amt);
                      $request->session()->put('part',$part['amt']);
                      list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
                    if($userprogress[0]->is_document_completed ==0){
                      return redirect('dse_document_upload');
                      }
                   return view('user.dse.feePayment')->with('fees',$fees)->with('part',$part)->with('users',$users)->with('user1',$users1);   
                   }   
             }
       }




     }

        

             else
             {  
            return redirect()->route('logout');
              }
    
    }

       /*    public static function show_mca_pay_dd(Request $request)
 {
     
     $dte_id = $request->session()->get('log_dte_id');
    $user= DB::table('student_login')->where('dte_id',$dte_id)->get();
    //return $user;
    $balance_amt= $request->session()->get('balanceAmt');
    $fees= $request->session()->get('fees');
    $part = $request->session()->put('part');
     return view('user.mca.payFeeDD')->with('fees',$fees)->with('part',$part)->with('balance_amt',$balance_amt)->with('user',$user); 
     
 }

 public static function post_mca_dd(Request $request)
 {
     $dte_id= $request->session()->get('log_dte_id',null);
     
     if($dte_id != null)
     {
         $course = $request->session()->get('log_course');
   
     $amount =$request->input('amount');
     $email = $request->input('email');
     $mobile = $request->input('mobile');
     $drawer = $request->input('drawer');
     $bank_name = $request->input('bank');
     $drawee = $request->input('drawee');
     $dddate = $request->input('dd_date');
     $ddno = $request->input('dd_no');
      date_default_timezone_set("Asia/Kolkata");

 
     $ddetails = new dd_details;
     $ddetails->amount =$amount;
     $ddetails->email = $email;
     $ddetails->mobile = $mobile;
     $ddetails->drawer_name = $drawer;
     $ddetails->drawee = $drawee;
     $ddetails->bank_name = $bank_name;
     $ddetails->dd_date = $dddate;
     $ddetails->created_at = date("Y-m-d H:i:s");
     $ddetails->updated_at = date("Y-m-d H:i:s");
     $ddetails->dd_no = $ddno;
     $ddetails->save();
     
       $users= DB::select(DB::raw("SELECT admission_id, paid_amt, balance_amt from admission where dte_id LIKE '%".$dte_id."%' AND status = 'INCOMPLETE' ORDER BY updated_at DESC LIMIT 1"));
                 
                  $Admission = admission::find($users[0]->admission_id);
                  
                  $Admission->paid_amt =  $amount;
                  $Admission->granted_amt = $amount; 
                  $Admission->balance_amt =0;
                
                  $Admission->save();
       

     $fee = new fees_transaction;
     $fee->dte_id = $dte_id;
       if($course == "MEG" )
     $fee->sub_merchant_id = 422;
     if($course == "MCA")
      $fee->sub_merchant_id = 322;
      $fee->course = $course."DTE";
      $fee->payment_mode = "DEMAND DRAFT";
      $fee->trans_status = "Success";
      $fee->trans_timestamp = date("Y-m-d h:i:s");
      $fee->trans_amt = $amount;
      $fee->init_amt = $amount;
      $fee->total_amt = $amount;
      $fee->payment_timestamp = date("Y-m-d h:i:s");
      $fee->admission_id = $users[0]->admission_id;
      $fee->response_code = "E00328";
      $fee->admission_type = "DTE";
      $fee->save();
      
     
      return redirect()->route('mca_final_submit');
 
      
     }
     else
     {
         return redirect()->route('logout');
     }
     
 }*/
 
         public static function show_pay_dd(Request $request)
         {
             $dte_id = $request->session()->get('log_dte_id');
                         // return $dte_id;
             $course = $request->session()->get('log_course');
             if($course=='FEG'||$course=='DSE'||$course=='MCA' ){
              list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
              }
            if($course=='MEG' ){
            list( $user1['prog_val'],$userprogress)= HomeController::meprogressbar($course,$dte_id);
            }

            $user= DB::table('student_login')->where('dte_id',$dte_id)->get();
            $balance_amt= $request->session()->get('balanceAmt');
            $fees= $request->session()->get('fees');
            $part = $request->session()->get('part');
            //return $user1;
            return view('user.payFeeDD')->with('user1',$user1)->with('fees',$fees)->with('part',$part)->with('balance_amt',$balance_amt)->with('user',$user); 
             
         }

         public static function post_dd(Request $request)
         {
             $dte_id= $request->session()->get('log_dte_id',null);
             
             if($dte_id != null)
             {
                 $course = $request->session()->get('log_course');
           
             $amount =$request->input('amount');
             $email = $request->input('email');
             $mobile = $request->input('mobile');
             $drawer = $request->input('drawer');
             $bank_name = $request->input('bank');
             $drawee = $request->input('drawee');
             $dddate = $request->input('dd_date');
             $ddno = $request->input('dd_no');
              date_default_timezone_set("Asia/Kolkata");

         
             $ddetails = new dd_details;
             $ddetails->amount =$amount;
             $ddetails->email = $email;
             $ddetails->mobile = $mobile;
             $ddetails->drawer_name = $drawer;
             $ddetails->drawee = $drawee;
             $ddetails->bank_name = $bank_name;
             $ddetails->dd_date = $dddate;
             $ddetails->created_at = date("Y-m-d H:i:s");
             $ddetails->updated_at = date("Y-m-d H:i:s");
             $ddetails->dd_no = $ddno;
             $ddetails->save();
             
               $users= DB::select(DB::raw("SELECT admission_id, paid_amt, balance_amt from admission where dte_id LIKE '%".$dte_id."%' AND status = 'INCOMPLETE' ORDER BY updated_at DESC LIMIT 1"));
                         
                          $Admission = admission::find($users[0]->admission_id);
                          
                          $Admission->paid_amt =  $amount;
                          $Admission->granted_amt = $amount; 
                          $Admission->balance_amt = '0';
                        
                          $Admission->save();
               

             $fee = new fees_transaction;
             $fee->dte_id = $dte_id;
               if($course == "MEG" )
             $fee->sub_merchant_id = 422;
             if($course == "MCA")
              $fee->sub_merchant_id = 322;
            if($course == "FEG")
              $fee->sub_merchant_id = 122;
             if($course == "DSE")
              $fee->sub_merchant_id = 222;
              $fee->course = $course."DTE";
              $fee->payment_mode = "DEMAND DRAFT";
              $fee->trans_status = "Success";
              $fee->trans_timestamp = date("Y-m-d h:i:s");
              $fee->trans_amt = $amount;
              $fee->init_amt = $amount;
              $fee->total_amt = $amount;
              $fee->payment_timestamp = date("Y-m-d h:i:s");
              $fee->admission_id = $users[0]->admission_id;
              $fee->response_code = "E00328";
              $fee->admission_type = "DTE";
              $fee->save();
              
              if($course=='FEG')
              return redirect()->route('fe_final_submit');
              if($course=='MCA')
              return redirect()->route('mca_final_submit');
              if($course=='MEG')
              return redirect()->route('me_final_submit');
              if($course=='DSE')
              return redirect()->route('dse_final_submit');
              
             }
             else
             {
                 return redirect()->route('logout');
             }
             
         }


         public static function show_pay_cash(Request $request)
         {
             $dte_id = $request->session()->get('log_dte_id');
                         // return $dte_id; 
             $course = $request->session()->get('log_course');
             if($course=='FEG'||$course=='DSE'||$course=='MCA' ){
              list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
              }
            if($course=='MEG' ){
            list( $user1['prog_val'],$userprogress)= HomeController::meprogressbar($course,$dte_id);
            }

            $user= DB::table('student_login')->where('dte_id',$dte_id)->get();
            $balance_amt= $request->session()->get('balanceAmt');
            $fees= $request->session()->get('fees');
            $part = $request->session()->get('part');
            //return $user1;
            return view('user.payFeeCash')->with('user1',$user1)->with('fees',$fees)->with('part',$part)->with('balance_amt',$balance_amt)->with('user',$user); 
             
         }
       

         public static function post_cash(Request $request)
         {
            //  $dte_id= $request->session()->get('log_dte_id',null);
             
            //  if($dte_id != null)
            //  {
            //      $course = $request->session()->get('log_course');
           
            //  $amount =$request->input('amount');
            //  $email = $request->input('email');
            //  $mobile = $request->input('mobile');
            //  $reciptno = $request->input('reciptno');             
            //  $reciptdate = $request->input('recipt_date');
            //  $reciptimg = $request->File('reciptimg');
            //  date_default_timezone_set("Asia/Kolkata");
            //   // return $reciptimg;
            //  $destinationPath = $dte_id.'_'.$reciptno.'_cash';
            //  if($request->hasFile('reciptimg'))
            //             {
            //               // return"hello";
            //                   $rules = ['reciptimg' => 'mimes:jpg,png,jpeg,pdf'];
            //                   $validator = Validator::make(Input::all() , $rules);
            //                   if ($validator->fails())
            //                   {
            //                     $request->session()->flash('photo_error', 'Please Upload Only JPG or PNG type image. File size should be less than 1 mb.');
            //                     return redirect()->route('fe_cash');
            //                   }
            //                   $extension = $request->file('reciptimg')->getClientOriginalExtension();
            //                   $filenametostore = '/cash/reciptimg'.$dte_id.'.'.$extension;
                      
            //                   $path =  $request->file('reciptimg')->storeAs($destinationPath, $filenametostore,'public_uploads');
            //                   $reciptimg = $filenametostore;                              
            //             }
            //             else
            //               {
            //                 return "upload an photo";
            //               }
              
            //    $users= DB::insert('insert into cash_details( amount, email, mobile, recipt_no, reciptdate, reciptimg)  values (?, ?,?,?,?,?)', [$amount,$email,$mobile,$reciptno,$reciptdate,$reciptimg]);
               
            //             $user = DB::table('admission')->where('dte_id', $dte_id)->first();

            //               $Admission = admission::find($user->admission_id);
                          
            //               $Admission->paid_amt =  $amount;
            //               $total_amt=$Admission->granted_amt ;
            //               $balance_amt=$total_amt-$amount;
            //               $Admission->balance_amt = $balance_amt;                         
                        
            //               $Admission->save();
                    

            //  $fee = new fees_transaction;
            //  $fee->dte_id = $dte_id;
            //    if($course == "MEG" )
            //  $fee->sub_merchant_id = 422;
            //  if($course == "MCA")
            //   $fee->sub_merchant_id = 322;
            // if($course == "FEG")
            //   $fee->sub_merchant_id = 122;
            //  if($course == "DSE")
            //   $fee->sub_merchant_id = 222;
            //   $fee->course = $course."DTE";
            //   $fee->payment_mode = "Cash";
            //   $user = DB::table('admission')->where('dte_id', $dte_id)->first();
            //   if ($user->balance_amt==0) {
            //   $fee->trans_status = "Success";  
            //   }
            //   else{
            //   $fee->trans_status = "Pending";
            //   }
            //   $fee->trans_timestamp = date("Y-m-d h:i:s");
            //   $fee->trans_amt = $amount;
            //   $fee->init_amt = $total_amt;
            //   $fee->total_amt = $total_amt;
            //   $fee->payment_timestamp = date("Y-m-d h:i:s");
            //   $fee->admission_id = $user->admission_id;
            //   $fee->response_code = "E00328";
            //   $fee->admission_type = "DTE";
            //   $fee->save();
              
            //   if($course=='FEG')
            //   return redirect()->route('fe_final_submit');
            //   if($course=='MCA')
            //   return redirect()->route('mca_final_submit');
            //   if($course=='MEG')
            //   return redirect()->route('me_final_submit');
            //   if($course=='DSE')
            //   return redirect()->route('dse_final_submit');
              
            //  }
            //  else
            //  {
            //      return redirect()->route('logout');
            //  }
             
         }

  public static function completePayment(Request $request)
    {

    return view('user.me.admission_payment');    //Payment Gateway

    }

  public static function showfinalSubmit(Request $request)
    {
      $dte_id = $request->session()->get('log_dte_id',null);
      if($dte_id != null)
        { $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {
          if (DB::table('me_students')->where('dte_id', $dte_id)->exists())
            {   $check = DB::table('me_students')->select('is_personal_completed', 'is_guardian_completed', 'is_contact_completed', 'is_dte_completed', 'is_document_completed', 'is_academic_completed')->where('dte_id',$dte_id)->get();
           $payment = DB::table('admission')->select('balance_amt')->where('dte_id',$dte_id)->get();

            if(DB::table('admission')->where('dte_id', $dte_id)->exists())
            {
               $payment = DB::table('admission')->select('balance_amt')->where('dte_id',$dte_id)->get();
            }
           else{

            $array_object2 = [['balance_amt' => null]];
            $payment = json_decode(json_encode($array_object2));     
            }
  $course = $request->session()->get('log_course');
  list($user1['prog_val'],$userprogress)= HomeController::meprogressbar($course,$dte_id);
    if($acap_login[0]->acap_login == 1) {
            if($userprogress[0]->is_document_completed==1){
          $user1['prog_val']=7;
          $data['user1']=$user1;
          // return 'done';
        }
        else{
              

          return redirect('me_document_upload');
        }

        }

          return view('user.me.final_submit')->with('check',$check)->with('payment',$payment)->with('user1',$user1);

            }
          else
          {
            // return'hello';
            $array_object1 = [['is_personal_completed' => null, 'is_guardian_completed' => null, 'is_contact_completed' => null, 'is_dte_completed' => null, 'is_document_completed' => null, 'is_academic_completed' => null, 'is_payment_completed' => null]];
            $check = json_decode(json_encode($array_object1));
            $array_object2 = [['balance_amt' => null]];
            $payment = json_decode(json_encode($array_object2));
              $course = $request->session()->get('log_course');
  list($user1['prog_val'],$userprogress)= HomeController::meprogressbar($course,$dte_id);
    if($acap_login[0]->acap_login == 1) {
            if($userprogress[0]->is_document_completed==1){
                $user1['prog_val']=7;
                $data['user1']=$user1;
          // return 'done';
          }
            else{
              
          return redirect('me_acap_document_upload');
        }

        }

            return view('user.me.final_submit')->with('check',$check)->with('payment',$payment)->with('user1',$user1);

          }      
        }
        else
              return redirect()->route('me_profile');
          }
      else
          return redirect()->route('logout');  
    }



     public static function showmcafinalSubmit(Request $request)
    {
      $dte_id = $request->session()->get('log_dte_id',null);
      if($dte_id != null)
        { $dte_login = DB::table('student_login')->select('dte_login')->where('dte_id', $dte_id)->get();
          $acap_login = DB::table('student_login')->select('acap_login')->where('dte_id', $dte_id)->get();
           $activeacap = $request->session()->get('log_acap');
          if ($dte_login[0]->dte_login == 1 || $acap_login[0]->acap_login == 1) 
          {
          if (DB::table('mca_students')->where('dte_id', $dte_id)->exists())
            {   $check = DB::table('mca_students')->select('is_personal_completed', 'is_guardian_completed', 'is_contact_completed', 'is_dte_details_completed', 'is_document_completed', 'is_academic_completed')->where('dte_id',$dte_id)->get();

            if(DB::table('admission')->where('dte_id', $dte_id)->exists())
            {
                 $course = $request->session()->get('log_course');
                list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
               $payment = DB::table('admission')->select('balance_amt')->where('dte_id',$dte_id)->get();
               //only for validation

               if($activeacap!='yes'){
               if($payment[0]->balance_amt !=0){
                 return redirect('mca_admission_payment');
                }   
              }
              if($activeacap=='yes'){
               if($userprogress[0]->is_document_completed ==0){
                 return redirect('mca_document_upload');
                }   
              }
            }
           else{
            $array_object2 = [['balance_amt' => null]];
              $course = $request->session()->get('log_course');
              list( $user1['prog_val'],$userprogress)= HomeController::progressbar($course,$dte_id);
               if($acap_login[0]->acap_login == 1) {
            if($userprogress[0]->is_document_completed==1){
          $user1['prog_val']=7;
          $data['user1']=$user1;
          // return 'done';
        }

        }
            $payment = json_decode(json_encode($array_object2));     
            }
            if($activeacap=='yes'){
               if($userprogress[0]->is_document_completed ==0){
                 return redirect('mca_document_upload');
                }   
              }
          return view('user.mca.final_submit')->with('check',$check)->with('payment',$payment)->with('user1',$user1);

            }
          else
          {
            $array_object1 = [['is_personal_completed' => null, 'is_guardian_completed' => null, 'is_contact_completed' => null, 'is_dte_details_completed' => null, 'is_document_completed' => null, 'is_academic_completed' => null, 'is_payment_completed' => null]];
            $check = json_decode(json_encode($array_object1));
            $array_object2 = [['balance_amt' => null]];
            $payment = json_decode(json_encode($array_object2));
            if($activeacap!='yes'){
               if($userprogress[0]->is_payment_completed ==0){
                 return redirect('mca_admission_payment');
                }   
              }
              if($activeacap=='yes'){
               if($userprogress[0]->is_document_completed ==0){
                 return redirect('mca_document_upload');
                }   
              }
            return view('user.mca.final_submit')->with('check',$check)->with('payment',$payment);

          }      
        }
        else
              return redirect()->route('mca_profile');
          }
      else
          return redirect()->route('logout');  
    }

    public static function postmcafinalSubmit(Request $request)
    {
     $dte_id = $request->session()->get('log_dte_id');
     $course = $request->session()->get('log_course');
     $log_acap = $request->session()->get('log_acap');
     $log_dte = $request->session()->get('log_dte');
     if($log_acap == null)
        $event = "DTE";
      if($log_dte == null)
        $event = "ACAP";
        
      DB::select("call insert_status_details_submitted('$dte_id','$event','$course')");
      
      return redirect()->route('mca_profile');
    }

    public static function postmefinalSubmit(Request $request)
    {
         $dte_id = $request->session()->get('log_dte_id');
     $course = $request->session()->get('log_course');
     $log_acap = $request->session()->get('log_acap');
     $log_dte = $request->session()->get('log_dte');
     if($log_acap == null)
        $event = "DTE";
      if($log_dte == null)
        $event = "ACAP";
        
      DB::select("call insert_status_details_submitted('$dte_id','$event','$course')");
        
      return redirect()->route('me_profile');
    }

    public static function logout(Request $request)
    {
      $dte_id_log = $request->session()->pull('log_dte_id');
      $dte_id_reg =$request->session()->pull('reg_dte_id');
     
      DB::table('student_login')->where('dte_id', $dte_id_log)->update(['dte_login' => 0, 'acap_login' => 0]);
      $request->session()->put('log_dte', null); 
      $request->session()->flush();
      return redirect()->route('login');
    }

   
}