<?php
namespace  App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\admin_login;
use App\admission;
use App\status_details;
use App\dte_allotments;
use App\mca_students;
use App\me_students;
use App\fe_students;
use App\dse_students;
use App\part_payments;
use App\dd_details;
use App\latest_news;
use App\important_notice;
use App\studentLogin;
use App\fees_transaction;
use App\staff_role_history;
use PDF;
use Redirect;
use Validator;
use Illuminate\Pagination\LengthAwarePaginator;
use Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
class AdminController extends Controller

{
    public static function showadminlogin(Request $request)
    {
        return view('admin.adminLogin');
    }





public static function mailcontroler(Request $request)
    {

      if($request->session()->get('dte',null)!=null) 
                $dte_id = $request->session()->get('dte');
     elseif($request->session()->get('dte1',null)!=null)
                 $dte_id = $request->session()->get('dte1');   
      elseif($request->session()->get('dte2',null)!=null)
                 $dte_id = $request->session()->get('dte2');  
       elseif($request->session()->get('dte3',null)!=null)
                 $dte_id = $request->session()->get('dte3');     
        elseif($request->session()->pull('dte1')!=null)
            $dte_id = $request->session()->pull('dte1');
$content = $request->input('mail');
$pgname  =   $request->input('textmail');
 // return$dte_id;
// return redirect($pgname);
$stud =DB::table('student_login')->where('dte_id',$dte_id)->get();
$email=$stud[0]->email;
$name=$stud[0]->first_name ." ".$stud[0]->middle_name." ".$stud[0]->last_name;
        
    $data = array(
      'dte_id'=> $dte_id,
      'name'=> $name,
      'content' => $content
    );

    
    // return $pgname; 
    if($pgname=='adminDocumentVerifierAcap'){
      Mail::send('user.adminmail', $data, function ($message) use($email)
      {
      $message->to($email, '')->subject('Reupload Documents');
      $message->from('vesit.admission@ves.ac.in', 'Vesit Admissions');
      });
    
      $request->session()->flash('error', 'Mail Sent');

     // DB::select("call delete_document_verified('$dte_id')");
    DB::select("call delete_form_verified('$dte_id')");
      DB::select("call delete_submitted('$dte_id')");
     return redirect('adminSeizer');
   }
    
    
      if(strpos($pgname, 'adminFormView') !== false){
        // return 'done';
     // DB::select("call delete_document_verified('$dte_id')");
    // DB::select("call delete_form_verified('$dte_id')");



      Mail::send('user.adminFormmail', $data, function ($message) use($email)
      {
      $message->to($email, '')->subject('Form filling details');
      $message->from('vesit.admission@ves.ac.in', 'Vesit Admissions');
      });
    
      $request->session()->flash('error', 'Mail Sent');

      DB::select("call delete_submitted('$dte_id')");
        
      // return 'done';
     return redirect('adminVerifier ');
   }   

    if($pgname=='adminSearchDocumentVerifier'){
      Mail::send('user.adminmail', $data, function ($message) use($email)
      {
      $message->to($email, '')->subject('Reupload Documents');
      $message->from('vesit.admission@ves.ac.in', 'Vesit Admissions');
      });
    
      $request->session()->flash('error', 'Mail Sent');

     // DB::select("call delete_document_verified('$dte_id')");
    DB::select("call delete_form_verified('$dte_id')");
      DB::select("call delete_submitted('$dte_id')");
     return redirect('adminDocumentVerifier');
   }
    return redirect($pgname);
    }


    public static function checkadminlogin(Request $request)
    {
        $email_id = $request->input('emailId');
        $pass = $request->input('password');
        if (DB::table('admin_login')->where('email_id', $email_id)->exists()) {
            $user = DB::table('admin_login')->where('email_id', $email_id)->get();
           //return $user;
            // if(Hash::check($pass,$user[0]->admin_pwd))
            $privilege =$user[0]->privilege;
            if ($pass == $user[0]->admin_pwd) {
                $request->session()->put('email_id', $user[0]->email_id);
                $request->session()->put('role', $user[0]->role);
                $request->session()->put('event', $user[0]->event);
                $request->session()->put('course', $user[0]->course);
                
                $co=    $request->session()->get('course', $user[0]->course);
                if ($user[0]->role == "Admin" || $user[0]->role == "Super Admin") 
                    { //return $user[0]->role;
                      //return "Hello";
                   return redirect()->route('adminsEvent');
                   // return view('admin.adminSelector');
                    }
                else if ($privilege == "Document Verifier") {
            
                 return redirect()->route('adminVerifier');
            
                  }
        else if ($privilege == "Document Collector"){
            
            return redirect()->route('adminDocumentVerifier');  
        } 
        else if ($privilege == "Admission Seizer"){
            
            return redirect()->route('adminSeizer');  
        } 
        else if ($privilege == "Accounts") 
        {
            return redirect()->route('adminAccounts');
        }
        else if ($privilege == "Admit"){
            
            return redirect()->route('adminAdmit');  
        } 
        else if ($privilege == "Admission Cancellation"){
            
            return redirect()->route('adminCancelAdmission');  
        }
        else {
                //return $user[0]->role;
                 // return "Hello2";
                    return redirect()->route('staffRoleSelector');
            }
        }
        else {
            //return "Hello3";
            return redirect()->route('adminLogin');
        }
    }
}
  public static function aes128Encrypt($str,$key){
        $block = mcrypt_get_block_size('rijndael_128', 'ecb');
        $pad = $block - (strlen($str) % $block);
        $str .= str_repeat(chr($pad), $pad);
        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $str, MCRYPT_MODE_ECB));
    }

public static function show_pay_dd(Request $request)
         {
             $dte_id = $request->session()->get('dte');
            $user= DB::table('student_login')->where('dte_id',$dte_id)->get();

            $balance_amt= $request->session()->get('balanceAmt');
 

            $fees= $request->session()->get('fees');
            $part = $request->session()->put('part');
             return view('admin.payFeeDD')->with('fees',$fees)->with('part',$part)->with('balance_amt',$balance_amt)->with('user',$user); 
             
         }
         public static function showacapCashPayment(Request $request){

        $dte_id = $request->session()->get('dte');
        $adm = $request->session()->get('admissID');
        

        $email = $request->session()->get('email_id');
        $role =$request->session()->get('role');
        
        
        $department = DB::table('admission')->where('dte_id', 'LIKE', '%' . $dte_id . '%')->get();  
         $course=$department[0]->course;
        if($course == "MEG")
            $user = DB::table('me_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
        if($course == "MCA")
              $user = DB::table('mca_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
        if($course == "FEG")
              $user = DB::table('fe_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
         if($course == "DSE")
              $user = DB::table('dse_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
         //return $user; 
       
       if($role == "Staff")
        {
          $course = DB::table('admin_login')->select('course')->where('email_id',$email)->get();
        }
        else
        {
          $course =$request->session()->get('adminCourse',null);
          $array_object = [['course' => $course]];
          $course = json_decode(json_encode($array_object));
          
        }                 
         $array_object = [['dte_id' => $dte_id,'name_on_marksheet'=>$user[0]->name_on_marksheet]];
        $user1 = json_decode(json_encode($array_object));        
        $user= DB::table('student_login')->where('dte_id',$dte_id)->get();
        $balance_amt= $request->session()->get('balanceAmt');
        $fees= $request->session()->get('fees');
        $part = $request->session()->put('part');                 
        return view('admin.adminVerifyCash')->with('fees',$fees)->with('admission_id',$adm)->with('part',$part)->with('balance_amt',$balance_amt)->with('user',$user1)->with('course',$course);

   

//         $dte_id = $request->session()->get('dte');
//         $dte_id = $request->input('dteId');
//         $email = $request->session()->get('email_id');
//         $role =$request->session()->get('role');
       
        
//         $department = DB::table('admission')->where('dte_id', 'LIKE', '%' . $dte_id . '%')->get();  
//          $course=$department[0]->course;
//         if($course == "MEG")
//             $user = DB::table('me_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
//         if($course == "MCA")
//               $user = DB::table('mca_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
//         if($course == "FEG")
//               $user = DB::table('fe_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
//          if($course == "DSE")
//               $user = DB::table('dse_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
//          //return $user; 
       
//        if($role == "Staff")
//         {
//           $course = DB::table('admin_login')->select('course')->where('email_id',$email)->get();
//         }
//         else
//         {
//           $course =$request->session()->get('adminCourse',null);
//           $array_object = [['course' => $course]];
//           $course = json_decode(json_encode($array_object));
          
//         }
//               $array_object = [['dte_id' => $dte_id,'name_on_marksheet'=>$user[0]->name_on_marksheet]];
//               $user1 = json_decode(json_encode($array_object));
       
//                $array_object = [['granted_amt' => $department[0]->granted_amt , 'total_amt' => $department[0]->total_amt , 'balance_amt' => $department[0]->balance_amt ]];
//         $payments = json_decode(json_encode($array_object));
       
       
//         return view('admin.adminVerifyCash')->with('fees',$fees)->with('part',$part)->with('balance_amt',$balance_amt)->with('user',$user1)->with('course',$course)->with('payments',$payments);
// ;
        
    }
       

         public static function post_dd(Request $request)
         {
             $dte_id= $request->session()->get('dte',null);
             //return $dte_id;
             $role= $request->session()->get('role',null);
             
             if($dte_id != null)
             {
                 if($role =="Admin" ||$role =="Super Admin" )
                     $course = $request->session()->get('adminCourse');
                elseif($role == "Staff")
                         $course = $request->session()->get('course');
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
             

             $user = DB::select(DB::raw("SELECT * from admission where admission_type = 'ACAP' order by updated_at desc limit 1"));
             if($course == 'FEG') {
              $category = DB::table('fe_students')->select('category','acap_category')->where('dte_id',$dte_id)->get();

     //return $dte_id;
 
              }

      if($course == 'DSE') {
             $category = DB::table('dse_students')->select('category','acap_category')->where('dte_id',$dte_id)->get();

     //return $dte_id;
                         }
          if($course == 'MEG') {
         $category = DB::table('me_students')->select('category','acap_category')->where('dte_id',$dte_id)->get();

     //return $dte_id;
 
           }
          if($course == 'MCA') {
      $category = DB::table('mca_students')->select('category','acap_category')->where('dte_id',$dte_id)->get();
         }

        if($user[0]->status!='INCOMPLETE')
        {
             $adm = new admission;
              $adm->dte_id = $dte_id;
              $adm->course = $course;
              $adm->status = "INCOMPLETE";
              $adm->admission_type = "ACAP";
              $adm->total_amt = $amount;
              $adm->granted_amt = $amount;
              $adm->paid_amt = $amount;
             // $adm->count=$count+1;
              $adm->fees_category = $category[0]->category;
              $adm->shift_allotted = "-";
              $adm->balance_amt = 0;
              $adm->admission_category = "ACAP";
              $adm->created_at = date("Y-m-d H:i:s");
              $adm->save();
          }
          else if ($user[0]->status=='INCOMPLETE') {
            $users= DB::select(DB::raw("SELECT admission_id from admission where dte_id LIKE '%".$dte_id."%' AND status = 'INCOMPLETE' ORDER BY updated_at DESC LIMIT 1"));
                         
                          $Admission = admission::find($users[0]->admission_id);
                          $Admission->total_amt  = $amount;
                          $Admission->paid_amt =  $amount;
                          $Admission->granted_amt = $amount; 
                          $Admission->balance_amt = '0';                        
                          $Admission->save();
               
          }
               
          $users= DB::select(DB::raw("SELECT admission_id from admission where dte_id LIKE '%".$dte_id."%' AND status = 'INCOMPLETE' ORDER BY updated_at DESC LIMIT 1"));
            
             $fee = new fees_transaction;
             $fee->dte_id = $dte_id;
               if($course == "MEG" )
             $fee->sub_merchant_id = 412;
             if($course == "MCA")
              $fee->sub_merchant_id = 312;
            if($course == "FEG")
              $fee->sub_merchant_id = 112;
             if($course == "DSE")
              $fee->sub_merchant_id = 212;
              $fee->course = $course."ACAP";
              $fee->payment_mode = "DEMAND DRAFT";
              $fee->trans_status = "Success";
              $fee->trans_timestamp = date("Y-m-d h:i:s");
              $fee->trans_amt = $amount;
              $fee->init_amt = $amount;
              $fee->total_amt = $amount;
              $fee->payment_timestamp = date("Y-m-d h:i:s");
              $fee->admission_id = $users[0]->admission_id;
              $fee->response_code = "E00328";
              $fee->admission_type = "ACAP";
              $fee->save();
              
             $request->session()->flash('error', 'PAYMENT SUCCESSFULL');
              return redirect()->route('adminAdmit');
              
             }
             else
             {
                 return redirect()->route('adminAdmit');
             }
             
         }


 public static function payFee(Request $request)
    {
          
        $key = '1862392036201268';
      

        $dte_id =$request->session()->get('dte', 'null');
      
        if ($dte_id != 'null') 
        {
          
      $user=DB::table('student_login')->where('dte_id', $dte_id)->get();
      $email=$user[0]->email; 
      $course=$user[0]->course;
      $event=$request->session()->get('adminEvent');
      $event_type = "ACAP";
      $optn = $course."ACAP";
      $amount = $request->input('amount');
      if($course == 'FEG') {
                      $submerchantid = '112'; 
              }

      if($course == 'DSE') {
                      $submerchantid = '212'; 
                        }
          if($course == 'MEG') {
                      $submerchantid = '412'; 

           }
          if($course == 'MCA') {
                      $submerchantid = '312'; 
                  
              }
      //return $course;
             // return $submerchantid;
      $data = false;
      while(!$data)
      {
        $numbers = range(810000, 819999);
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


      if($course == 'FEG') {
              $category = DB::table('fe_students')->select('category','acap_category')->where('dte_id',$dte_id)->get();

     //return $dte_id;
 
              }

      if($course == 'DSE') {
             $category = DB::table('dse_students')->select('category','acap_category')->where('dte_id',$dte_id)->get();

     //return $dte_id;
                         }
          if($course == 'MEG') {
         $category = DB::table('me_students')->select('category','acap_category')->where('dte_id',$dte_id)->get();

     //return $dte_id;
 
           }
          if($course == 'MCA') {
      $category = DB::table('mca_students')->select('category','acap_category')->where('dte_id',$dte_id)->get();

     //return $dte_id;
                   
              }
      
      $amount1 = DB::table('fees_structure')->select('amt')->where('fee_category',$category[0]->acap_category)->where('course',$course)->get();
     //return $amount;

      //  return $user1;
      $randNo=$randno[0];
      $fees_transaction = new fees_transaction;
      $fees_transaction->ref_no= $randNo;
      $fees_transaction->dte_id=$dte_id;
      $fees_transaction->sub_merchant_id=$submerchantid;
      $fees_transaction->course=$optn;
      $fees_transaction->init_amt=$amount;
      $fees_transaction->admission_type=$event_type;
      $fees_transaction->save(); 
/*
                          $user = DB::select(DB::raw(" SELECT * from status_details where dte_id like '%".$dte_id."%' and event_to ='DTE' order by updated_at desc limit 1"));*/
            $user = DB::select(DB::raw("SELECT * from admission where admission_type = 'ACAP' order by updated_at desc limit 1"));
        if($user[0]->status!='INCOMPLETE')
        {
             $adm = new admission;

              $adm->dte_id = $dte_id;
              $adm->course = $course;
              $adm->status = "INCOMPLETE";
              $adm->admission_type = "ACAP";
              $adm->total_amt = $amount1[0]->amt;
              $adm->granted_amt = $amount1[0]->amt;
              $adm->paid_amt = 0;
             // $adm->count=$count+1;
              $adm->fees_category = $category[0]->category;
              $adm->shift_allotted = "-";
              $adm->balance_amt = $amount1[0]->amt;
              $adm->admission_category = "ACAP";
              $adm->created_at = date("Y-m-d H:i:s");
              $adm->save();
          }
      $refNo = $randNo;

      //$key = '1862392036201268';
      $paymode = '9';
      $returnurl = 'https://vesitadmissions.ves.ac.in/admissionForms/pg/index.php/pstatus';
      // https://www.vesitadmissions.ves.ac.in/admissionForms/pg/index.php/pstatus
      $newEncrypter = new \Illuminate\Encryption\Encrypter( $key,config('app.cipher'));
      /* $encrypted = $newEncrypter->encrypt($text);
      echo $encrypted;*/
      //$mandatory = 8001|1234|80|9000000001;
       $mandatory = $refNo.'|'.$submerchantid.'|'.$amount.'|'.$dte_id.'|'.$email.'|'.$optn;
       $encMandatory =(new static)->aes128Encrypt($mandatory,$key);
      // //$encOptn = (new static)->aes128Encrypt($optn,$key);
       $encRef = (new static)->aes128Encrypt($refNo,$key);
       $encSubmerchantid = (new static)->aes128Encrypt($submerchantid,$key);
       $encAmount =(new static)->aes128Encrypt($amount,$key);
       $encPaymode = (new static)->aes128Encrypt($paymode,$key);
       $encReturn =(new static)->aes128Encrypt($returnurl,$key);
      // //  return $encReturn;
      // return $encMandatory; 
      // $encMandatory = $newEncrypter->encrypt($mandatory);
      /* $encOptn = $newEncrypter->encrypt($optn);
      return $encMandatory; 
      $encRef = $newEncrypter->encrypt($refNo);
      $encSubmerchantid = $newEncrypter->encrypt($submerchantid);
      $encAmount =$newEncrypter->encrypt($amount);
      $encPaymode = $newEncrypter->encrypt($paymode);
      $encReturn = $newEncrypter->encrypt($returnurl);*/

      /* $request = 'amount='.$amount.'&Response_Code=E000&Unique_Ref_Number=121212&Service_Tax_Amount=0&Processing_Fee_Amount=0&Total_Amount=50000&Transaction_Amount=50000&Transaction_Date=07/07/2018&Payment_Mode=Card&ReferenceNo='.$refNo.'&SubMerchantId='.$submerchantid;
      $ch = curl_init('www.vesitadmissions.ves.ac.in/admissionForms/pg/index.php/resources/views/user/payReceipt.php');
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($ch);
      curl_close($ch);                                            return $response;*/
      // $url = 'https://eazypay.icicibank.com/EazyPG?merchantid=183625&mandatory fields=123|45|1|789|vickyd757@gmail.com&optional fields=computer&returnurl=https://vesitadmissions.ves.ac.in/admissionForms/pg/index.php/pstatus&Reference No=123&submerchantid=45&transaction amount=1&paymode=9';
      //$url = 'https://eazypay.icicibank.com/EazyPG?merchantid=183625&mandatoryfields=8001|1234|80|9000000001&optional fields=20|20|20|20&returnurl= https://www.vesitadmissions.ves.ac.in/admissionForm/pg/index.php/pstatus&Reference No=8001&submerchantid=1234&transaction amount=80&paymode=9';

      $url = 'https://eazypay.icicibank.com/EazyPG?merchantid=183625&mandatory fields='.$encMandatory.'&optional fields=&returnurl='.$encReturn.'&Reference No='.$encRef.'&submerchantid='.$encSubmerchantid.'&transaction amount='.$encAmount.'&paymode='.$encPaymode;
      //return $url;
       return redirect($url);

      //  return view('user.paymentGateway')->with('refNo',$refNo)->with('submerchantid',$submerchantid)->with('paymode',$paymode)->with('amount',$amount);
      /* $decrypted = $newEncrypter->decrypt( $encrypted );
      return $decrypted;
      */
        }   


    }

public static function deleteAdmin($id, Request $request)
    {
        $dte_id = $request->session()->get('dte1');
    //   return $dte_id;
           $email = $request->session()->get('email_id','null');
       $role = $request->session()->get('role');
       if($email != null){
           if($role=="Admin" || $role=="Super Admin"){
                $course = $request->session()->get('adminCourse','null');
                $event = $request->session()->get('adminEvent');
           }
           
           else if($role=="Staff"){
          $course = $request->session()->get('course');
          $event = $request->session()->get('event');

          //return $course;
        }
        
        $column_name1=$id;
        $column_name2=$id.'_path';

        if($course == "MCA")
        {
           if(DB::table('mca_students')->where('dte_id', $dte_id)->exists()) 
           { 
             DB::table('mca_students')->where('dte_id', $dte_id)->update([$column_name1 => null,$column_name2 => null]);
           }
           $users = DB::table('mca_students')->where('dte_id',$dte_id)->get();
        }
         if($course == "FEG")
        {
           if(DB::table('fe_students')->where('dte_id', $dte_id)->exists()) 
           { 
             DB::table('fe_students')->where('dte_id', $dte_id)->update([$column_name1 => null,$column_name2 => null]);
           }
           $users = DB::table('fe_students')->where('dte_id',$dte_id)->get();
        }
         if($course == "DSE")
        {
           if(DB::table('dse_students')->where('dte_id', $dte_id)->exists()) 
           { 
             DB::table('dse_students')->where('dte_id', $dte_id)->update([$column_name1 => null,$column_name2 => null]);
           }
           $users = DB::table('dse_students')->where('dte_id',$dte_id)->get();
        }
         if($course == "MEG")
        {
           if(DB::table('me_students')->where('dte_id', $dte_id)->exists()) 
           { 
             DB::table('me_students')->where('dte_id', $dte_id)->update([$column_name1 => null,$column_name2 => null]);
           }
           $users = DB::table('me_students')->where('dte_id',$dte_id)->get();
        }

        //return $users;
        $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        $hash = $hash[0]->hash;
        $data=[];
        $data['users']=$users;
        $data['hash']=$hash;
        $data['course'] = $course;
        

         if($course == "MCA")
         {
              if($event == "DTE")
               return view('admin.adminDocumentVerifier',$data);
              if($event == "ACAP")
                return view('admin.adminDocumentVerifierAcap',$data);
         } 
          if($course == "FEG")
         {
             if($event == "DTE")
               return view('admin.adminDocumentVerifierFE',$data);
              if($event == "ACAP")
                return view('admin.adminDocumentVerifierAcapFE',$data);
         } 
          if($course == "DSE")
         {
          if($event == "DTE")
               return view('admin.adminDocumentVerifierDSE',$data);
              if($event == "ACAP")
                return view('admin.adminDocumentVerifierAcapDSE',$data);
         } 
          if($course == "MEG")
         {
              if($event == "DTE")
               return view('admin.adminDocumentVerifierMEG',$data);
              if($event == "ACAP")
                return view('admin.adminDocumentVerifierAcapMEG',$data);
         } 
       }
       else{
           return redirect()->route('logout');
       }
      }
        
        public static function deleteAdminAcap($id, Request $request)
    {
        $dte_id = $request->session()->get('dte1');
     //   return $dte_id;
        $course = $request->session()->get('course','null');
        if($course == 'null')
          $course = $request->session()->get('adminCourse');
        
        $column_name1=$id;
        $column_name2=$id.'_path';
        $mca_students = new mca_students;
        if(DB::table('mca_students')->where('dte_id', $dte_id)->exists()) 
          { 
           DB::table('mca_students')->where('dte_id', $dte_id)->update([$column_name1 => null,$column_name2 => null]);
           }
        $users = DB::table('mca_students')->where('dte_id',$dte_id)->get();
        //return $users;
        $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        $hash = $hash[0]->hash;
        $data=[];
        $data['users']=$users;
        $data['hash']=$hash;
        $data['course'] = $course;
        


        return view('admin.adminDocumentVerifierAcap',$data);
          
        }
        
        
    public function showAdminsEvent(Request $request)
    {
      return view('admin.adminsEvent');
    }

    public function postAdminsEvent(Request $request)
    {
       $course = $request->input('course');
       $event = $request->input('event');
       //return $course.$event;
       $request->session()->put('adminCourse',$course);
       $request->session()->put('adminEvent',$event);
       return redirect()->route('adminDashboard');
    }

     public function pdfview1(Request $request)
    {
         $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,me.name_on_marksheet,me.course_allotted,me.gate_score,me.degree_final_cgpa FROM status_details m1 INNER JOIN me_students me ON m1.dte_id = me.dte_id AND m1.event_to = 'ACAP' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
   
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfview1');
            return $pdf->stream('admin.pdfview1.pdf');
        }
        return view('admin.pdfview1');
    }

    public function pdfviewIT1(Request $request)
    {
         $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,me.name_on_marksheet,me.course_allotted,me.gate_score,me.degree_final_cgpa FROM status_details m1 INNER JOIN me_students me ON m1.dte_id = me.dte_id AND m1.event_to = 'ACAP' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
   
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewIT1');
            return $pdf->stream('admin.pdfviewIT1.pdf');
        }
        return view('admin.pdfviewIT1');
    }

    public function pdfviewINST1(Request $request)
    {
         $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,me.name_on_marksheet,me.course_allotted,me.gate_score,me.degree_final_cgpa FROM status_details m1 INNER JOIN me_students me ON m1.dte_id = me.dte_id AND m1.event_to = 'ACAP' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
   
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewINST1');
            return $pdf->stream('admin.pdfviewINST1.pdf');
        }
        return view('admin.pdfviewINST1');
    }

    public function pdfviewEXTC1(Request $request)
    {
         $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,me.name_on_marksheet,me.course_allotted,me.gate_score,me.degree_final_cgpa FROM status_details m1 INNER JOIN me_students me ON m1.dte_id = me.dte_id AND m1.event_to = 'ACAP' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
   
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewETRX1');
            return $pdf->stream('admin.pdfviewETRX1.pdf');
        }
        return view('admin.pdfviewEXTC1');
    }

    public function pdfviewDate1(Request $request)
    {
         $dt = $request->input('s_date');
         return $dt;
         $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,me.name_on_marksheet,me.course_allotted,me.gate_score,me.degree_final_cgpa FROM status_details m1 INNER JOIN me_students me ON m1.dte_id = me.dte_id AND m1.event_to = 'ACAP' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
        $data = [];
        $data['users'] = $users;
        $data['dt'] = $dt;
        return $dt;
        view()->share('data',$data);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewDate1');
            return $pdf->stream('admin.pdfviewDate1.pdf');
        }
        return view('admin.pdfviewDate1');
    }

    public $a;
     public function random()
    {
            $a = mt_rand(1000, 9999);
            return $a;
    }

    
    public function CSVView1(Request $request)
    {
         $a1 = $this->random(); 
         $path = 'C:/xampp/htdocs/adm/public/export'.$a1.'.csv';
         $fileName = 'export'.$a1.'.csv';
   //      return $path;
         $users = DB::select(DB::raw("SELECT 'DTE ID','Status','Timestamp','Name','Course','GateScore','CGPA' Union SELECT m1.dte_id , m1.status_to, m1.updated_at, me.name_on_marksheet,me.course_allotted,me.gate_score,me.degree_final_cgpa INTO OUTFILE '".$path."' FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' FROM status_details m1 INNER JOIN me_students me ON m1.dte_id = me.dte_id AND m1.event_to = 'ACAP' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
        
         $request->session()->flash('link', $fileName);
         return redirect('adminLosAcapApplied');
    }



      public function pdfview2(Request $request)
    {
          $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,me.name_on_marksheet,me.course_allotted FROM status_details m1 INNER JOIN me_students me ON m1.dte_id = me.dte_id AND m1.event_to = 'ACAP' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
     
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfview2');
            return $pdf->stream('admin.pdfview2.pdf');
        }
        return view('admin.pdfview2');
    }
      public function pdfviewIT2(Request $request)
    {
          $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,me.name_on_marksheet,me.course_allotted FROM status_details m1 INNER JOIN me_students me ON m1.dte_id = me.dte_id AND m1.event_to = 'ACAP' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
     
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewIT2');
            return $pdf->stream('admin.pdfviewIT2.pdf');
        }
        return view('admin.pdfviewIT2');
    }
      public function pdfviewEXTC2(Request $request)
    {
          $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,me.name_on_marksheet,me.course_allotted FROM status_details m1 INNER JOIN me_students me ON m1.dte_id = me.dte_id AND m1.event_to = 'ACAP' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
     
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewETRX2');
            return $pdf->stream('admin.pdfviewETRX2.pdf');
        }
        return view('admin.pdfviewETRX2');
    }

  public function pdfviewINST2(Request $request)
    {
          $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,me.name_on_marksheet,me.course_allotted FROM status_details m1 INNER JOIN me_students me ON m1.dte_id = me.dte_id AND m1.event_to = 'ACAP' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
     
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewINST2');
            return $pdf->stream('admin.pdfviewINST2.pdf');
        }
        return view('admin.pdfviewINST2');
    }

     public function pdfviewDate2(Request $request)
    {
         $date = $request->input('s_date');
         $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,me.name_on_marksheet,me.course_allotted FROM status_details m1 INNER JOIN me_students me ON m1.dte_id = me.dte_id AND m1.event_to = 'ACAP' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
        $data = [];
        $data['users'] = $users;
        $data['date'] = $date;
        return $date;
        view()->share('data',$data);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewDate2');
            return $pdf->stream('admin.pdfviewDate2.pdf');
        }
        return view('admin.pdfviewDate2');
    }
     public function CSVView2(Request $request)
    {
         $a1 = $this->random(); 
         $path = 'C:/xampp/htdocs/adm/public/export'.$a1.'.csv';
         $fileName = 'export'.$a1.'.csv';
   //      return $path;
         $users = DB::select(DB::raw("SELECT 'DTE ID','Status','Timestamp','Name','Course' Union SELECT m1.dte_id , m1.status_to, m1.updated_at, me.name_on_marksheet , me.course_allotted INTO OUTFILE '".$path."' FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' FROM status_details m1 INNER JOIN me_students me ON m1.dte_id = me.dte_id AND m1.event_to = 'ACAP' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
        
         $request->session()->flash('link', $fileName);
         return redirect('adminLosAcapSeized');
    }


     public function pdfview3(Request $request)
    {
          $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.paid_amt, a.balance_amt, a.status, a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'ACAP' AND a.status = 'ADMITTED'"));

        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfview3');
            return $pdf->stream('admin.pdfview3.pdf');
        }
        return view('admin.pdfview3');
    }
    
     public function abc(Request $request)
    {
          $users = DB::select(DB::raw("SELECT m1.dte_id, m.name_on_marksheet,m.photo_path,l.hash FROM admission m1 INNER JOIN fe_students m ON m1.dte_id = m.dte_id AND m1.course = 'FEG' AND m1.status = 'ADMITTED' INNER JOIN student_login l ON m.dte_id = l.dte_id  LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED'"));
        //return $users;
         view()->share('users',$users);
        
            // $pdf = PDF::loadView('admin.abc');
            // return $pdf->stream('admin.abc.pdf');
        
        return view('admin.abc');
    }
      public function pdfviewIT3(Request $request)
    {
          $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.paid_amt, a.balance_amt, a.status, a.updated_at,m.course_allotted FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'ACAP' AND a.status = 'ADMITTED'"));

        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewIT3');
            return $pdf->stream('admin.pdfviewIT3.pdf');
        }
        return view('admin.pdfviewIT3');
    }

      public function pdfviewEXTC3(Request $request)
    {
          $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.paid_amt, a.balance_amt, a.status, a.updated_at,m.course_allotted FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'ACAP' AND a.status = 'ADMITTED'"));

        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewETRX3');
            return $pdf->stream('admin.pdfviewETRX3.pdf');
        }
        return view('admin.pdfviewETRX3');
    }

      public function pdfviewINST3(Request $request)
    {
          $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.paid_amt, a.balance_amt, a.status, a.updated_at,m.course_allotted FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'ACAP' AND a.status = 'ADMITTED'"));

        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewINST3');
            return $pdf->stream('admin.pdfviewINST3.pdf');
        }
        return view('admin.pdfviewINST3');
    }

      public function pdfviewDate3(Request $request)
    {
         $date = $request->input('s_date');
        
          $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.paid_amt, a.balance_amt, a.status, a.updated_at,m.course_allotted FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'ACAP' AND a.status = 'ADMITTED'"));

        $data = [];
        $data['users'] = $users;
        $data['date'] = $date;
        return $date;
        view()->share('data',$data);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewDate3');
            return $pdf->stream('admin.pdfviewDate3.pdf');
        }
        return view('admin.pdfviewDate3');
    }
      public function CSVView3(Request $request)
    {
         $a1 = $this->random(); 
         $path = 'C:/xampp/htdocs/adm/public/export'.$a1.'.csv';
         $fileName = 'export'.$a1.'.csv';
   //      return $path;
         $users = DB::select(DB::raw("SELECT 'DTE ID','Name','Branch','GrantedAmount','PaidAmount','BalanceAmount','Status','Timestamp' Union SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.paid_amt, a.balance_amt, a.status, a.updated_at INTO OUTFILE '".$path."' FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'ACAP' AND a.status = 'ADMITTED'"));
        
         $request->session()->flash('link', $fileName);
         return redirect('adminLosAcapAdmitted');
    }


     public function pdfview4(Request $request)
    {
          $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'ACAP' AND a.status = 'CANCELLED'"));

        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfview4');
            return $pdf->stream('admin.pdfview4.pdf');
        }
        return view('admin.pdfview4');
    }

     public function pdfviewIT4(Request $request)
    {
          $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'ACAP' AND a.status = 'CANCELLED'"));

        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewIT4');
            return $pdf->stream('admin.pdfviewIT4.pdf');
        }
        return view('admin.pdfview4');
    }

     public function pdfviewEXTC4(Request $request)
    {
          $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'ACAP' AND a.status = 'CANCELLED'"));

        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewETRX4');
            return $pdf->stream('admin.pdfviewETRX4.pdf');
        }
        return view('admin.pdfviewETRX4');
    }

     public function pdfviewINST4(Request $request)
    {
          $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'ACAP' AND a.status = 'CANCELLED'"));

        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewINST4');
            return $pdf->stream('admin.pdfviewINST4.pdf');
        }
        return view('admin.pdfviewINST4');
    }

     public function pdfviewDate4(Request $request)
    {
         $date = $request->input('s_date');
        
           $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'ACAP' AND a.status = 'CANCELLED'"));
        $data = [];
        $data['users'] = $users;
        $data['date'] = $date;
        return $date;
        view()->share('data',$data);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewDate4');
            return $pdf->stream('admin.pdfviewDate4.pdf');
        }
        return view('admin.pdfviewDate4');
    }

   
     public function CSVView4(Request $request)
    {
         $a1 = $this->random(); 
         $path = 'C:/xampp/htdocs/adm/public/export'.$a1.'.csv';
         $fileName = 'export'.$a1.'.csv';
   //      return $path;
         $users = DB::select(DB::raw("SELECT 'DTE ID','Name','Branch','GrantedAmount','Status','Date of Admission','Date of Cancellation' Union SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.status,a.created_at,a.updated_at INTO OUTFILE '".$path."' FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'ACAP' AND a.status = 'CANCELLED'"));
        
         $request->session()->flash('link', $fileName);
         return redirect('adminLosAcapCancelled');
    }




     public function pdfview5(Request $request)
    {
          $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.balance_amt,a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'ACAP' AND a.status = 'ADMITTED'"));

        view()->share('users',$users);
       
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfview5');
            return $pdf->stream('admin.pdfview5.pdf');
        }
        return view('admin.pdfview5');
    }

    public function pdfviewEXTC5(Request $request)
    {
          $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.balance_amt,a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'ACAP' AND a.status = 'ADMITTED'"));

        view()->share('users',$users);
       
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewETRX5');
            return $pdf->stream('admin.pdfviewEXTRX.pdf');
        }
        return view('admin.pdfviewETRX5');
    }

    public function pdfviewINST5(Request $request)
    {
          $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.balance_amt,a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'ACAP' AND a.status = 'ADMITTED'"));

        view()->share('users',$users);
       
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewINST5');
            return $pdf->stream('admin.pdfviewINST5.pdf');
        }
        return view('admin.pdfviewINST5');
    }

    public function pdfviewIT5(Request $request)
    {
          $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.balance_amt,a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'ACAP' AND a.status = 'ADMITTED'"));

        view()->share('users',$users);
       
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewIT5');
            return $pdf->stream('admin.pdfviewIT5.pdf');
        }
        return view('admin.pdfviewIT5');
    }

    public function pdfviewDate5(Request $request)
    {
         $date = $request->input('s_date');
        
          $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.balance_amt,a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'ACAP' AND a.status = 'ADMITTED'"));
        $data = [];
        $data['users'] = $users;
        $data['date'] = $date;
        return $date;
        view()->share('data',$data);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewDate5');
            return $pdf->stream('admin.pdfviewDate5.pdf');
        }
        return view('admin.pdfviewDate5');
    }

    public function CSVView5(Request $request)
    {
         $a1 = $this->random(); 
         $path = 'C:/xampp/htdocs/adm/public/export'.$a1.'.csv';
         $fileName = 'export'.$a1.'.csv';
   //      return $path;
         $users = DB::select(DB::raw("SELECT 'DTE ID','Name','Branch','GrantedAmount','BalanceAmount','TotalAmount','Status','Timestamp' Union SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.balance_amt,a.total_amt, a.status, a.updated_at INTO OUTFILE '".$path."' FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'ACAP' AND a.status = 'ADMITTED'"));
        
         $request->session()->flash('link', $fileName);
         return redirect('adminLosAcapPartPayment');
    }


    // Staff
    public function pdfview6(Request $request)
    {
       $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.paid_amt, a.balance_amt, a.status, a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED'"));
    
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfview6');
            return $pdf->stream('admin.pdfview6.pdf');
        }
        return view('admin.pdfview6');
    }

    public function pdfviewEXTC6(Request $request)
    {
       $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.paid_amt, a.balance_amt, a.status, a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED'"));
    
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewETRX6');
            return $pdf->stream('admin.pdfviewETRX6.pdf');
        }
        return view('admin.pdfviewETRX6');
    }

    public function pdfviewINST6(Request $request)
    {
       $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.paid_amt, a.balance_amt, a.status, a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED'"));
    
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewINST6');
            return $pdf->stream('admin.pdfviewINST6.pdf');
        }
        return view('admin.pdfviewINST6');
    }

    public function pdfviewIT6(Request $request)
    {
       $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.paid_amt, a.balance_amt, a.status, a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED'"));
    
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewIT6');
            return $pdf->stream('admin.pdfviewIT6.pdf');
        }
        return view('admin.pdfviewIT6');
    }

    public function pdfviewDate6(Request $request)
    {
         $date = $request->input('s_date');
        
         $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.paid_amt, a.balance_amt, a.status, a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED'"));
    
        $data = [];
        $data['users'] = $users;
        $data['date'] = $date;
        return $date;
        view()->share('data',$data);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewDate6');
            return $pdf->stream('admin.pdfviewDate6.pdf');
        }
        return view('admin.pdfviewDate6');
    }

     public function CSVView6(Request $request)
    {
         $a1 = $this->random(); 
         $path = 'C:/xampp/htdocs/adm/public/export'.$a1.'.csv';
         $fileName = 'export'.$a1.'.csv';
   //      return $path;
         $users = DB::select(DB::raw("SELECT 'DTE ID','Name','Branch','GrantedAmount','PaidAmount','BalanceAmount','Status','Timestamp' Union SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.paid_amt, a.balance_amt, a.status, a.updated_at INTO OUTFILE '".$path."' FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED'"));
        
         $request->session()->flash('link', $fileName);
         return redirect('adminLosDteAdmitted');
    }




     public function pdfview7(Request $request)
    {
          $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'DTE' AND a.status = 'CANCELLED'"));
    
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfview7');
            return $pdf->stream('admin.pdfview7.pdf');
        }
        return view('admin.pdfview7');
    }

    public function pdfviewEXTC7(Request $request)
    {
          $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'DTE' AND a.status = 'CANCELLED'"));
    
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewETRX7');
            return $pdf->stream('admin.pdfviewETRX7.pdf');
        }
        return view('admin.pdfviewETRX7');
    }

     public function pdfviewINST7(Request $request)
    {
          $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'DTE' AND a.status = 'CANCELLED'"));
    
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewINST7');
            return $pdf->stream('admin.pdfviewINST7.pdf');
        }
        return view('admin.pdfviewINST7');
    }
     public function pdfviewIT7(Request $request)
    {
          $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'DTE' AND a.status = 'CANCELLED'"));
    
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewIT7');
            return $pdf->stream('admin.pdfviewIT7.pdf');
        }
        return view('admin.pdfviewIT7');
    }

      public function pdfviewDate7(Request $request)
    {
         $date = $request->input('s_date');
        
          $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.status, a.created_at,a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'DTE' AND a.status = 'CANCELLED'"));
    
        $data = [];
        $data['users'] = $users;
        $data['date'] = $date;
        return $date;
        view()->share('data',$data);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewDate7');
            return $pdf->stream('admin.pdfviewDate7.pdf');
        }
        return view('admin.pdfviewDate7');
    }

      public function CSVView7(Request $request)
    {
         $a1 = $this->random(); 
         $path = 'C:/xampp/htdocs/adm/public/export'.$a1.'.csv';
         $fileName = 'export'.$a1.'.csv';
   //      return $path;
         $users = DB::select(DB::raw("SELECT 'DTE ID','Name','Branch','GrantedAmount','Status','Date of Admission','Date of Cancellation' Union SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.status, a.created_at,a.updated_at INTO OUTFILE '".$path."' FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n'  FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'DTE' AND a.status = 'CANCELLED' "));
        
         $request->session()->flash('link', $fileName);
         return redirect('adminLosDteCancelled');
    }
     public function pdfview8(Request $request)
    {
          $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED'"));
    
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfview8');
            return $pdf->stream('admin.pdfview8.pdf');
        }
        return view('admin.pdfview8');
    }

     public function pdfviewEXTC8(Request $request)
    {
          $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED'"));
    
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewETRX8');
            return $pdf->stream('admin.pdfviewETRX8.pdf');
        }
        return view('admin.pdfviewETRX8');
    }
     public function pdfviewINST8(Request $request)
    {
          $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED'"));
    
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewINST8');
            return $pdf->stream('admin.pdfviewINST8.pdf');
        }
        return view('admin.pdfviewINST8');
    }
     public function pdfviewIT8(Request $request)
    {
          $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED'"));
    
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewIT8');
            return $pdf->stream('admin.pdfviewIT8.pdf');
        }
        return view('admin.pdfviewIT8');
    }
    public function pdfviewDate8(Request $request)
    {
         $date = $request->input('s_date');
        
          $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED'"));
    
        $data = [];
        $data['users'] = $users;
        $data['date'] = $date;
        return $date;
        view()->share('data',$data);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewDate8');
            return $pdf->stream('admin.pdfviewDate8.pdf');
        }
        return view('admin.pdfviewDate8');
    }

     public function CSVView8(Request $request)
    {
         $a1 = $this->random(); 
         $path = 'C:/xampp/htdocs/adm/public/export'.$a1.'.csv';
         $fileName = 'export'.$a1.'.csv';
   //      return $path;
         $users = DB::select(DB::raw("SELECT 'DTE ID','Name','Branch','GrantedAmount','TotalAmount','Status','Timestamp' Union SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.total_amt, a.status, a.updated_at INTO OUTFILE '".$path."' FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n'  FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'DTE' AND a.status = 'CANCELLED' "));
        
         $request->session()->flash('link', $fileName);
         return redirect('adminLosDteCancelled');
    }

//FE PDFView
    public function pdfviewfe1(Request $request)
    {
         $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,fe.name_on_marksheet,fe.jee_seat_no,fe.jee_score,fe.jee_month,fe.jee_year,fe.cet_seat_no,fe.cet_month,fe.cet_year,fe.cet_score FROM status_details m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.event_to = 'ACAP'  AND m1.course ='FEG' AND m1.status_to='SUBMITTED' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
   
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe1');
            return $pdf->stream('admin.pdfviewfe1.pdf');
        }
        return view('admin.pdfviewfe1');
    }
    public function pdfviewfe2(Request $request)
    {
          $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,fe.name_on_marksheet,fe.dte_branch,fe.shift_allotted FROM status_details m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.event_to = 'ACAP' and m1.course= 'FEG' AND m1.status_to='SEIZED' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
         view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe2');
            return $pdf->stream('admin.pdfviewfe2.pdf');
        }
        return view('admin.pdfviewfe2');
    }

    public function pdfviewfe3(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe3');
            return $pdf->stream('admin.pdfviewfe3.pdf');
        }
        return view('admin.pdfviewfe3');
    }

    public function pdfviewfe4(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED'"));

        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe4');
            return $pdf->stream('admin.pdfviewfe4.pdf');
        }
        return view('admin.pdfviewfe4');
    }

    public function pdfviewfe5(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.total_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.granted_amt < m1.total_amt "));
         // return $users[0]->shift_allotted;
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe5');
            return $pdf->stream('admin.pdfviewfe5.pdf');
        }
        return view('admin.pdfviewfe5');
    }
    public function pdfviewfe6(Request $request)
    {
         $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED'"));
      
         view()->share('users',$users);
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe6');
            // return $pdf;
        // return view('admin.pdfviewfe6',$users); use this in local host

            return $pdf->stream('admin.pdfviewfe6.pdf');
        }
        return view('admin.pdfviewfe6');
    }
 
    public function pdfviewfe7(Request $request)
    {
          $users = DB::select(DB::raw("SELECT a.dte_id, fe.name_on_marksheet,a.branch,a.shift_allotted, a.granted_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN fe_students fe ON a.dte_id = fe.dte_id AND a.course = 'FEG' AND a.admission_type = 'DTE' AND a.status = 'CANCELLED'"));
      
         view()->share('users',$users);
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe7');
            return $pdf->stream('admin.pdfviewfe7.pdf');
        }
        return view('admin.pdfviewfe7');
    }
    public function pdfviewfe8(Request $request)
    {
       $users = DB::select(DB::raw("SELECT a.dte_id, fe.name_on_marksheet, a.branch, a.granted_amt, a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN fe_students fe ON a.dte_id = fe.dte_id AND a.course = 'FEG' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED'"));
         // return $users[0]->shift_allotted;
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe8');
            return $pdf->stream('admin.pdfviewfe8.pdf');
        }
        return view('admin.pdfviewfe8');
    }
    public function pdfviewfe3cmpnshift1(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.branch = 'CMPN' AND m1.shift_allotted = '1st-Shift' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe3cmpn');
            return $pdf->stream('admin.pdfviewfe3cmpn.pdf');
        }
        return view('admin.pdfviewfe3cmpn');
    }
    public function pdfviewfe3cmpnshift2(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.branch = 'CMPN' AND m1.shift_allotted = '2nd-Shift' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe3cmpn');
            return $pdf->stream('admin.pdfviewfe3cmpn.pdf');
        }
        return view('admin.pdfviewfe3cmpn');
    }
    public function pdfviewfe3etrx(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.branch = 'ETRX' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe3etrx');
            return $pdf->stream('admin.pdfviewfe3etrx.pdf');
        }
        return view('admin.pdfviewfe3etrx');
    }
    public function pdfviewfe3extc(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.branch = 'EXTC' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe3extc');
            return $pdf->stream('admin.pdfviewfe3extc.pdf');
        }
        return view('admin.pdfviewfe3extc');
    }
    public function pdfviewfe3inft(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.branch = 'INFT'"));

        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe3inft');
            return $pdf->stream('admin.pdfviewfe3inft.pdf');
        }
        return view('admin.pdfviewfe3inft');
    }
    public function pdfviewfe3inst(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.branch = 'INST'"));
        
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe3inst');
            return $pdf->stream('admin.pdfviewfe3inst.pdf');
        }
        return view('admin.pdfviewfe3inst');
    }


public function pdfviewfe4cmpnshift1(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND m1.branch = 'CMPN' AND m1.shift_allotted = '1st-Shift'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe4cmpn');
            return $pdf->stream('admin.pdfviewfe4cmpn.pdf');
        }
        return view('admin.pdfviewfe4cmpn');
    }
    public function pdfviewfe4cmpnshift2(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND m1.branch = 'CMPN' AND m1.shift_allotted = '2nd-Shift'"));
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe4cmpn');
            return $pdf->stream('admin.pdfviewfe4cmpn.pdf');
        }
        return view('admin.pdfviewfe4cmpn');
    }
    public function pdfviewfe4etrx(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND m1.branch = 'ETRX' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe4etrx');
            return $pdf->stream('admin.pdfviewfe4etrx.pdf');
        }
        return view('admin.pdfviewfe4etrx');
    }
    public function pdfviewfe4extc(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND m1.branch = 'EXTC' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe4extc');
            return $pdf->stream('admin.pdfviewfe4extc.pdf');
        }
        return view('admin.pdfviewfe4extc');
    }
    public function pdfviewfe4inft(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND m1.branch = 'INFT' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe4inft');
            return $pdf->stream('admin.pdfviewfe4inft.pdf');
        }
        return view('admin.pdfviewfe4inft');
    }
    public function pdfviewfe4inst(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND m1.branch = 'INST' "));
        
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe4inst');
            return $pdf->stream('admin.pdfviewfe4inst.pdf');
        }
        return view('admin.pdfviewfe4inst');
    }

    public function pdfviewfe5cmpnshift1(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.total_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.granted_amt < m1.total_amt AND m1.branch = 'CMPN' AND m1.shift_allotted = '1st-Shift'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe5cmpn');
            return $pdf->stream('admin.pdfviewfe5cmpn.pdf');
        }
        return view('admin.pdfviewfe5cmpn');
    }
    public function pdfviewfe5cmpnshift2(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.total_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.granted_amt < m1.total_amt AND m1.branch = 'CMPN' AND m1.shift_allotted = '2nd-Shift'"));
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe5cmpn');
            return $pdf->stream('admin.pdfviewfe5cmpn.pdf');
        }
        return view('admin.pdfviewfe5cmpn');
    }
    public function pdfviewfe5etrx(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.total_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.granted_amt < m1.total_amt AND m1.branch = 'ETRX' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe5etrx');
            return $pdf->stream('admin.pdfviewfe5etrx.pdf');
        }
        return view('admin.pdfviewfe5etrx');
    }
    public function pdfviewfe5extc(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.total_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.granted_amt < m1.total_amt AND m1.branch = 'EXTC' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe5extc');
            return $pdf->stream('admin.pdfviewfe5extc.pdf');
        }
        return view('admin.pdfviewfe5extc');
    }
    public function pdfviewfe5inft(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.total_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.granted_amt < m1.total_amt AND m1.branch = 'INFT' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe5inft');
            return $pdf->stream('admin.pdfviewfe5inft.pdf');
        }
        return view('admin.pdfviewfe5inft');
    }
    public function pdfviewfe5inst(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.total_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.granted_amt < m1.total_amt AND m1.branch = 'INST' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe5inst');
            return $pdf->stream('admin.pdfviewfe5inst.pdf');
        }
        return view('admin.pdfviewfe5inst');
    }

    public function pdfviewfe6cmpnshift1(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.branch = 'CMPN' AND m1.shift_allotted = '1st-Shift'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe6cmpn');
            return $pdf->stream('admin.pdfviewfe6cmpn.pdf');
        }
        return view('admin.pdfviewfe6cmpn');
    }
    public function pdfviewfe6cmpnshift2(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.branch = 'CMPN' AND m1.shift_allotted = '2nd-Shift'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe6cmpn');
            return $pdf->stream('admin.pdfviewfe6cmpn.pdf');
        }
        return view('admin.pdfviewfe6cmpn');
    }
    public function pdfviewfe6etrx(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.branch = 'ETRX'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe6etrx');
            return $pdf->stream('admin.pdfviewfe6etrx.pdf');
        }
        return view('admin.pdfviewfe6etrx');
    }
    public function pdfviewfe6extc(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.branch = 'EXTC' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe6extc');
            return $pdf->stream('admin.pdfviewfe6extc.pdf');
        }
        return view('admin.pdfviewfe6extc');
    }
    public function pdfviewfe6inft(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.branch = 'INFT'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe6inft');
            return $pdf->stream('admin.pdfviewfe6inft.pdf');
        }
        return view('admin.pdfviewfe6inft');
    }
    public function pdfviewfe6inst(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.branch = 'INST'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe6inst');
            return $pdf->stream('admin.pdfviewfe6inst.pdf');
        }
        return view('admin.pdfviewfe6inst');
    }

    public function pdfviewfe7cmpnshift1(Request $request)
    {
        $users = DB::select(DB::raw("SELECT a.dte_id, fe.name_on_marksheet,a.branch,a.shift_allotted, a.granted_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN fe_students fe ON a.dte_id = fe.dte_id AND a.course = 'FEG' AND a.admission_type = 'DTE' AND a.status = 'CANCELLED' AND a.branch = 'CMPN' AND a.shift_allotted = '1st-Shift'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe7cmpn');
            return $pdf->stream('admin.pdfviewfe7cmpn.pdf');
        }
        return view('admin.pdfviewfe7cmpn');
    }
    public function pdfviewfe7cmpnshift2(Request $request)
    {
        $users = DB::select(DB::raw("SELECT a.dte_id, fe.name_on_marksheet,a.branch,a.shift_allotted, a.granted_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN fe_students fe ON a.dte_id = fe.dte_id AND a.course = 'FEG' AND a.admission_type = 'DTE' AND a.status = 'CANCELLED' AND a.branch = 'CMPN' AND a.shift_allotted = '2nd-Shift'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe7cmpn');
            return $pdf->stream('admin.pdfviewfe7cmpn.pdf');
        }
        return view('admin.pdfviewfe7cmpn');
    }
    public function pdfviewfe7etrx(Request $request)
    {
        $users = DB::select(DB::raw("SELECT a.dte_id, fe.name_on_marksheet,a.branch,a.shift_allotted, a.granted_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN fe_students fe ON a.dte_id = fe.dte_id AND a.course = 'FEG' AND a.admission_type = 'DTE' AND a.status = 'CANCELLED' AND a.branch = 'ETRX'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe7etrx');
            return $pdf->stream('admin.pdfviewfe7etrx.pdf');
        }
        return view('admin.pdfviewfe7etrx');
    }
    public function pdfviewfe7extc(Request $request)
    {
        $users = DB::select(DB::raw("SELECT a.dte_id, fe.name_on_marksheet,a.branch,a.shift_allotted,a.branch,a.granted_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN fe_students fe ON a.dte_id = fe.dte_id AND a.course = 'FEG' AND a.admission_type = 'DTE' AND a.status = 'CANCELLED' AND a.branch = 'EXTC'"));
  
        view()->share('users',$users);
        return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe7extc');
            return $pdf->stream('admin.pdfviewfe7extc.pdf');
        }
        return view('admin.pdfviewfe7extc');
    }
    public function pdfviewfe7inft(Request $request)
    {
        $users = DB::select(DB::raw("SELECT a.dte_id, fe.name_on_marksheet,a.branch,a.shift_allotted, a.granted_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN fe_students fe ON a.dte_id = fe.dte_id AND a.course = 'FEG' AND a.admission_type = 'DTE' AND a.status = 'CANCELLED' AND a.branch = 'INFT'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe7inft');
            return $pdf->stream('admin.pdfviewfe7inft.pdf');
        }
        return view('admin.pdfviewfe7inft');
    }
    public function pdfviewfe7inst(Request $request)
    {
        $users = DB::select(DB::raw("SELECT a.dte_id, fe.name_on_marksheet,a.branch,a.shift_allotted, a.granted_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN fe_students fe ON a.dte_id = fe.dte_id AND a.course = 'FEG' AND a.admission_type = 'DTE' AND a.status = 'CANCELLED' AND a.branch = 'INST'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe7inst');
            return $pdf->stream('admin.pdfviewfe7inst.pdf');
        }
        return view('admin.pdfviewfe7inst');
    }

    public function pdfviewfe8cmpnshift1(Request $request)
    {
        $users = DB::select(DB::raw("SELECT a.dte_id, fe.name_on_marksheet, a.branch, a.granted_amt, a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN fe_students fe ON a.dte_id = fe.dte_id AND a.course = 'FEG' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED'AND a.branch = 'CMPN' AND a.shift_allotted = '1st-Shift'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe8cmpn');
            return $pdf->stream('admin.pdfviewfe8cmpn.pdf');
        }
        return view('admin.pdfviewfe8cmpn');
    }
    public function pdfviewfe8cmpnshift2(Request $request)
    {
        $users = DB::select(DB::raw("SELECT a.dte_id, fe.name_on_marksheet, a.branch, a.granted_amt, a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN fe_students fe ON a.dte_id = fe.dte_id AND a.course = 'FEG' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED'AND a.branch = 'CMPN' AND a.shift_allotted = '2nd-Shift'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe8cmpn');
            return $pdf->stream('admin.pdfviewfe8cmpn.pdf');
        }
        return view('admin.pdfviewfe8cmpn');
    }
    public function pdfviewfe8etrx(Request $request)
    {
        $users = DB::select(DB::raw("SELECT a.dte_id, fe.name_on_marksheet, a.branch, a.granted_amt, a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN fe_students fe ON a.dte_id = fe.dte_id AND a.course = 'FEG' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED'AND a.branch = 'ETRX' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe8etrx');
            return $pdf->stream('admin.pdfviewfe8etrx.pdf');
        }
        return view('admin.pdfviewfe8etrx');
    }
    public function pdfviewfe8extc(Request $request)
    {
        $users = DB::select(DB::raw("SELECT a.dte_id, fe.name_on_marksheet, a.branch, a.granted_amt, a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN fe_students fe ON a.dte_id = fe.dte_id AND a.course = 'FEG' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED'AND a.branch = 'EXTC'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe8extc');
            return $pdf->stream('admin.pdfviewfe8extc.pdf');
        }
        return view('admin.pdfviewfe8extc');
    }
    public function pdfviewfe8inft(Request $request)
    {
       $users = DB::select(DB::raw("SELECT a.dte_id, fe.name_on_marksheet, a.branch, a.granted_amt, a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN fe_students fe ON a.dte_id = fe.dte_id AND a.course = 'FEG' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED'AND a.branch = 'INFT'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe8inft');
            return $pdf->stream('admin.pdfviewfe8inft.pdf');
        }
        return view('admin.pdfviewfe8inft');
    }
    public function pdfviewfe8inst(Request $request)
    {
        $users = DB::select(DB::raw("SELECT a.dte_id, fe.name_on_marksheet, a.branch, a.granted_amt, a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN fe_students fe ON a.dte_id = fe.dte_id AND a.course = 'FEG' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED'AND a.branch = 'INST'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe8inst');
            return $pdf->stream('admin.pdfviewfe8inst.pdf');
        }
        return view('admin.pdfviewfe8inst');
    }


    public function pdfviewdse1(Request $request)
    {
         $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,dse.name_on_marksheet,m1.updated_at,dse.diploma_aggr_max_sem6,dse.diploma_aggr_obt_sem6,dse.diploma_passing_month,dse.diploma_passing_year,dse.diploma_aggr_percent_sem6 FROM status_details m1 INNER JOIN dse_students dse ON m1.dte_id = dse.dte_id AND m1.event_to = 'ACAP'  AND m1.course LIKE '%DSE%'  LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
   
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse1');
            return $pdf->stream('admin.pdfviewdse1.pdf');
        }
        return view('admin.pdfviewdse1');
    }
    public function pdfviewdse2(Request $request)
    {
          $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,dse.name_on_marksheet,dse.course_allotted FROM status_details m1 INNER JOIN dse_students dse ON m1.dte_id = dse.dte_id AND m1.event_to = 'ACAP' and m1.course= 'DSE' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
         view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse2');
            return $pdf->stream('admin.pdfviewdse2.pdf');
        }
        return view('admin.pdfviewdse2');
    }

    public function pdfviewdse3(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse3');
            return $pdf->stream('admin.pdfviewdse3.pdf');
        }
        return view('admin.pdfviewdse3');
    }

    public function pdfviewdse4(Request $request)
    {
       $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.branch,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED'"));

        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse4');
            return $pdf->stream('admin.pdfviewdse4.pdf');
        }
        return view('admin.pdfviewdse4');
    }

    public function pdfviewdse5(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.total_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.granted_amt < m1.total_amt"));
         // return $users[0]->shift_allotted;
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse5');
            return $pdf->stream('admin.pdfviewdse5.pdf');
        }
        return view('admin.pdfviewdse5');
    }
    public function pdfviewdse6(Request $request)
    {
         $users = DB::select(DB::raw("SELECT m1.dte_id,dse.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.branch,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students dse ON m1.dte_id = dse.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED'"));
      
         view()->share('users',$users);
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse6');
            return $pdf->stream('admin.pdfviewdse6.pdf');
        }
        return view('admin.pdfviewdse6');
    }

    public function pdfviewdse7(Request $request)
    {
          $users = DB::select(DB::raw("SELECT m1.dte_id,dse.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.branch,m1.paid_amt,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN dse_students dse ON m1.dte_id = dse.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED'"));
      
         view()->share('users',$users);
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse7');
            return $pdf->stream('admin.pdfviewdse7.pdf');
        }
        return view('admin.pdfviewdse7');
    }
    public function pdfviewdse8(Request $request)
    {
       $users = DB::select(DB::raw("SELECT m1.dte_id,dse.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.total_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students dse ON m1.dte_id = dse.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.granted_amt < m1.total_amt"));
         // return $users[0]->shift_allotted;
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse8');
            return $pdf->stream('admin.pdfviewdse8.pdf');
        }
        return view('admin.pdfviewdse8 ');
    }
    public function pdfviewdse3cmpnshift1(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.shift_allotted = '1st-Shift' AND m1.branch = 'CMPN'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse3cmpn');
            return $pdf->stream('admin.pdfviewdse3cmpn.pdf');
        }
        return view('admin.pdfviewdse3cmpn');
    }
    public function pdfviewdse3cmpnshift2(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.shift_allotted = '2nd-Shift' AND m1.branch = 'CMPN' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse3cmpn');
            return $pdf->stream('admin.pdfviewdse3cmpn.pdf');
        }
        return view('admin.pdfviewdse3cmpn');
    }
    public function pdfviewdse3etrx(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.branch = 'ETRX' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse3etrx');
            return $pdf->stream('admin.pdfviewdse3etrx.pdf');
        }
        return view('admin.pdfviewdse3etrx');
    }
    public function pdfviewdse3extcshift1(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.shift_allotted = '1st-Shift' AND m1.branch = 'EXTC' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse3extc');
            return $pdf->stream('admin.pdfviewdse3extc.pdf');
        }
        return view('admin.pdfviewdse3extc');
    }
    public function pdfviewdse3extcshift2(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.shift_allotted = '2nd-Shift' AND m1.branch = 'EXTC' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse3extc');
            return $pdf->stream('admin.pdfviewdse3extc.pdf');
        }
        return view('admin.pdfviewdse3extc');
    }
    public function pdfviewdse3inft(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.branch = 'INFT' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse3inft');
            return $pdf->stream('admin.pdfviewdse3inft.pdf');
        }
        return view('admin.pdfviewdse3inft');
    }
    public function pdfviewdse3inst(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND  m1.branch = 'INST'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse3inst');
            return $pdf->stream('admin.pdfviewdse3inst.pdf');
        }
        return view('admin.pdfviewdse3inst');
    }


public function pdfviewdse4cmpnshift1(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.branch,m1.created_at,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND m1.shift_allotted = '1st-Shift' AND  m1.branch = 'CMPN' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse4cmpn');
            return $pdf->stream('admin.pdfviewdse4cmpn.pdf');
        }
        return view('admin.pdfviewdse4cmpn');
    }
    public function pdfviewdse4cmpnshift2(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.branch,m1.created_at,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND m1.shift_allotted = '2nd-Shift' AND  m1.branch = 'CMPN' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse4cmpn');
            return $pdf->stream('admin.pdfviewdse4cmpn.pdf');
        }
        return view('admin.pdfviewdse4');
    }
    public function pdfviewdse4etrx(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.branch,m1.created_at,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND  m1.branch = 'ETRX' "));
        //return $users;
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse4etrx');
            return $pdf->stream('admin.pdfviewdse4etrx.pdf');
        }
        return view('admin.pdfviewdse4etrx');
    }
    public function pdfviewdse4extcshift1(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.branch,m1.created_at,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND m1.shift_allotted = '1st-Shift' AND  m1.branch = 'EXTC' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse4extc');
            return $pdf->stream('admin.pdfviewdse4extc.pdf');
        }
        return view('admin.pdfviewdse4extc');
    }
    public function pdfviewdse4extcshift2(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.branch,m1.created_at,m1.branch,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND m1.shift_allotted = '2nd-Shift' AND  m1.branch = 'EXTC' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse4extc');
            return $pdf->stream('admin.pdfviewdse4extc.pdf');
        }
        return view('admin.pdfviewdse4extc');
    }
    public function pdfviewdse4inft(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.branch,m1.created_at,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND  m1.branch = 'INFT'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse4inft');
            return $pdf->stream('admin.pdfviewdse4inft.pdf');
        }
        return view('admin.pdfviewdse4inft');
    }
    public function pdfviewdse4inst(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.branch,m1.created_at,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND  m1.branch = 'INST'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse4inst');
            return $pdf->stream('admin.pdfviewdse4inst.pdf');
        }
        return view('admin.pdfviewdse4inst');
    }

    public function pdfviewdse5cmpnshift1(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.shift_allotted = '1st-Shift' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse5cmpn');
            return $pdf->stream('admin.pdfviewdse5cmpn.pdf');
        }
        return view('admin.pdfviewdse5cmpn');
    }
    public function pdfviewdse5cmpnshift2(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.shift_allotted = '2nd-Shift' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse5cmpn');
            return $pdf->stream('admin.pdfviewdse5cmpn.pdf');
        }
        return view('admin.pdfviewdse5cmpn');
    }
    public function pdfviewdse5etrx(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse5etrx');
            return $pdf->stream('admin.pdfviewdse5etrx.pdf');
        }
        return view('admin.pdfviewdse5etrx');
    }
    public function pdfviewdse5extcshift1(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,dse.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students dse ON m1.dte_id = dse.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.shift_allotted = '1st-Shift' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse5extc');
            return $pdf->stream('admin.pdfviewdse5extc.pdf');
        }
        return view('admin.pdfviewdse5extc');
    }
    public function pdfviewdse5extcshift2(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.shift_allotted = '2nd-Shift' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse5extc');
            return $pdf->stream('admin.pdfviewdse5extc.pdf');
        }
        return view('admin.pdfviewdse5extc');
    }
    public function pdfviewdse5inft(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse5inft');
            return $pdf->stream('admin.pdfviewdse5inft.pdf');
        }
        return view('admin.pdfviewdse5inft');
    }
    public function pdfviewdse5inst(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse5inst');
            return $pdf->stream('admin.pdfviewdse5inst.pdf');
        }
        return view('admin.pdfviewdse5inst');
    }

    public function pdfviewdse6cmpnshift1(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.branch,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.branch = 'CMPN'AND  m1.shift_allotted = '1st-Shift' "));
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse6cmpn');
            return $pdf->stream('admin.pdfviewdse6cmpn.pdf');
        }
        return view('admin.pdfviewdse6cmpn');
    }
    public function pdfviewdse6cmpnshift2(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.branch,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND  m1.branch = 'CMPN' AND m1.shift_allotted = '2nd-Shift' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse6cmpn');
            return $pdf->stream('admin.pdfviewdse6cmpn.pdf');
        }
        return view('admin.pdfviewdse6cmpn');
    }
    public function pdfviewdse6etrx(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.branch,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.branch = 'ETRX'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse6etrx');
            return $pdf->stream('admin.pdfviewdse6etrx.pdf');
        }
        return view('admin.pdfviewdse6etrx');
    }
    public function pdfviewdse6extcshift1(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.branch,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.branch = 'EXTC' AND m1.status = 'ADMITTED'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse6extc');
            return $pdf->stream('admin.pdfviewdse6extc.pdf');
        }
        return view('admin.pdfviewdse6extc');
    }
    public function pdfviewdse6inft(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.branch,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.branch = 'INFT' AND m1.status = 'ADMITTED'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse6inft');
            return $pdf->stream('admin.pdfviewdse6inft.pdf');
        }
        return view('admin.pdfviewdse6inft');
    }
    public function pdfviewdse6inst(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.branch,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.branch = 'INST' AND m1.status = 'ADMITTED'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse6inst');
            return $pdf->stream('admin.pdfviewdse6inst.pdf');
        }
        return view('admin.pdfviewdse6inst');
    }

    public function pdfviewdse7cmpnshift1(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.branch,m1.balance_amt,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND m1.branch ='CMPN' AND m1.shift_allotted = '1st-Shift' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse7cmpn');
            return $pdf->stream('admin.pdfviewdse7cmpn.pdf');
        }
        return view('admin.pdfviewdse7cmpn');
    }
    public function pdfviewdse7cmpnshift2(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.branch,m1.balance_amt,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND m1.branch ='CMPN' AND m1.shift_allotted = '2nd-Shift' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse7cmpn');
            return $pdf->stream('admin.pdfviewdse7cmpn.pdf');
        }
        return view('admin.pdfviewdse7cmpn');
    }
    public function pdfviewdse7etrx(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.branch,m1.paid_amt,m1.balance_amt,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND m1.branch ='ETRX'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse7etrx');
            return $pdf->stream('admin.pdfviewdse7etrx.pdf');
        }
        return view('admin.pdfviewdse7etrx');
    }
    public function pdfviewdse7extcshift1(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.branch,m1.paid_amt,m1.balance_amt,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND m1.branch ='EXTC'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe7extc');
            return $pdf->stream('admin.pdfviewfe7extc.pdf');
        }
        return view('admin.pdfviewfe7extc');
    }
    public function pdfviewdse7extcshift2(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.branch,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND m1.branch ='EXTC'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewfe7extc');
            return $pdf->stream('admin.pdfviewfe7extc.pdf');
        }
        return view('admin.pdfviewfe7extc');
    }
    public function pdfviewdse7inft(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.branch,m1.paid_amt,m1.balance_amt,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND m1.branch ='INFT'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse7inft');
            return $pdf->stream('admin.pdfviewdse7inft.pdf');
        }
        return view('admin.pdfviewdse7inft');
    }
    public function pdfviewdse7inst(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.branch,m1.paid_amt,m1.balance_amt,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND m1.branch ='INST'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse7inst');
            return $pdf->stream('admin.pdfviewdse7inst.pdf');
        }
        return view('admin.pdfviewdse7inst');
    }

    public function pdfviewdse8cmpnshift1(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.shift_allotted = '1st-Shift' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse8cmpn');
            return $pdf->stream('admin.pdfviewdse8cmpn.pdf');
        }
        return view('admin.pdfviewdse8cmpn');
    }
    public function pdfviewdse8cmpnshift2(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.shift_allotted = '2nd-Shift' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse8cmpn');
            return $pdf->stream('admin.pdfviewdse8cmpn.pdf');
        }
        return view('admin.pdfviewdse8cmpn');
    }
    public function pdfviewdse8etrx(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse8etrx');
            return $pdf->stream('admin.pdfviewdse8etrx.pdf');
        }
        return view('admin.pdfviewdse8etrx');
    }
    public function pdfviewdse8extcshift1(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse8extc');
            return $pdf->stream('admin.pdfviewdse8extc.pdf');
        }
        return view('admin.pdfviewdse8extc');
    }
    public function pdfviewdse8inft(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse8inft');
            return $pdf->stream('admin.pdfviewdse8inft.pdf');
        }
        return view('admin.pdfviewdse8inft');
    }
    public function pdfviewdse8inst(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewdse8inst');
            return $pdf->stream('admin.pdfviewdse8inst.pdf');
        }
        return view('admin.pdfviewdse8inst');
    }




    public static function showroleselector(Request $request)
    {
        $role =$request->session()->get('role', 'null');
    if ($role != 'null' && ($role=='Admin' || $role=='Super Admin') )
        return view('admin.staffRoleSelector');
        else
            return redirect()->route('adminLogin');
    }

    public static function postroleselector(Request $request)
    {
        $role = $request->input('role');
        $email_id = $request->session()->get('email_id');
        $user = DB::table('admin_login')->select('course')->where('email_id',$email_id)->get();
       
        $course = $user[0]->course;
        DB::select("call insert_staff_role_history('$email_id','$role','$course')");
        if ($role == "Document Verifier") {
            
            return redirect()->route('adminVerifier');
            
        }
        if ($role == "Document Collector"){
            
            return redirect()->route('adminDocumentVerifier');  
        } 
        if ($role == "Admission Seizer"){
            
            return redirect()->route('adminSeizer');  
        } 
        if ($role == "Accounts") 
        {
            return redirect()->route('adminAccounts');
        }
        if ($role == "Admit"){
            
            return redirect()->route('t');  
        } 
        if ($role == "Admission Cancellation"){
            
            return redirect()->route('adminCancelAdmission');  
        } 
    }

    // Super Admin and Admin

    public static function showAdminSelector(Request $request)
    {
        $role =$request->session()->get('role', 'null');
        $email =$request->session()->get('email_id');
            if ($role != 'null' && ($role=='Admin' || $role=='Super Admin') )
            {
               $user = DB::table('admin_login')->where('email_id',$email)->get();
               //return $user;
               if($user[0]->login == 1)
               {
                    return redirect()->route('adminsEvent');
               }
               else
               {
                return view('admin.adminSelector');
               }
            }
                else
                    return redirect()->route('adminLogin');
    }

     public static function postAdminSelector(Request $request)
    {
            $event = $request->input('event');
            $course = $request->input('course');
            $email = $request->session()->get('email_id');
        //DB::table('admin_login')->where('role', "Staff")->update(['event' => $event , 'course' => $course]);
        //DB::table('admin_login')->where('role', "Admin")->update(['event' => $event , 'course' => $course]);
        DB::table('admin_login')->where('email_id',$email)->update(['login'=> 1]);
        return redirect()->route('adminsEvent');
        
    }

    public static function showAdminDashboard(Request $request)
    {
         $role =$request->session()->get('role', 'null');
         $course = $request->session()->get('adminCourse',null);
    if ($role != 'null' && ($role=='Admin' || $role=='Super Admin') )
    {
        if($course == "MEG")
        {
         $users1 = DB::select(DB::raw("select * from admission where admission_type = 'ACAP' and status = 'ADMITTED' and updated_at in (select max(updated_at) from admission group by dte_id) and branch = 'IT';"));

        $users2= DB::select(DB::raw("select * from admission where admission_type = 'ACAP' and status = 'ADMITTED' and updated_at in (select max(updated_at) from admission group by dte_id) and branch = 'ETRX';"));

        $users3 = DB::select(DB::raw("select * from admission where admission_type = 'ACAP' and status = 'ADMITTED' and updated_at in (select max(updated_at) from admission group by dte_id) and branch = 'INST';"));

        
        $users4 = DB::select(DB::raw("select * from admission where admission_type = 'DTE' and status = 'ADMITTED' and updated_at in (select max(updated_at) from admission group by dte_id) and branch = 'IT';"));

        $users5 = DB::select(DB::raw("select * from admission where admission_type = 'DTE' and status = 'ADMITTED' and updated_at in (select max(updated_at) from admission group by dte_id) and branch = 'ETRX';"));

        $users6 = DB::select(DB::raw("select * from admission where admission_type = 'DTE' and status = 'ADMITTED' and updated_at in (select max(updated_at) from admission group by dte_id) and branch = 'INST';"));

       // return $u; 
           $u1 = count($users1);
           $u2 = count($users2);
           $u3 = count($users3);
           $u4 = count($users4);
           $u5 = count($users5);
           $u6 = count($users6);
        //   return $u1;
        return view('admin.adminDashboard')->with('u1',$u1)->with('u2',$u2)->with('u3',$u3)->with('u4',$u4)->with('u5',$u5)->with('u6',$u6);
        }
         
        else if($course == "MCA")
        {
                $user1 = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN SINDHI MINORITY' )  and status = 'ADMITTED' and shift_allotted = 'Morning' and admission_type = 'DTE'"));
                $user2 = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN SINDHI MINORITY' )  and status = 'CANCELLED' and shift_allotted = 'Morning' and admission_type = 'DTE'"));
                $user3 = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category =   'SINDHI')  and status = 'ADMITTED' and shift_allotted = 'Morning' and admission_type = 'ACAP'"));
                $user4 = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category =  'SINDHI')  and status = 'CANCELLED' and shift_allotted = 'Morning' and admission_type = 'ACAP'"));
               
                $user5 = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN SINDHI MINORITY' )  and status = 'ADMITTED' and shift_allotted = 'Afternoon' and admission_type = 'DTE'"));
                $user6 = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN SINDHI MINORITY' )  and status = 'CANCELLED' and shift_allotted = 'Afternoon' and admission_type = 'DTE'"));
                $user7 = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category =  'SINDHI')  and status = 'ADMITTED' and shift_allotted = 'Afternoon' and admission_type = 'ACAP'"));
                $user8 = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category =   'SINDHI')  and status = 'CANCELLED' and shift_allotted = 'Afternoon' and admission_type = 'ACAP'"));
                
                $user9 = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN MU' OR fees_category = 'OPEN OMU'  OR fees_category = 'OBC/EBC MU' OR fees_category = 'OBC/EBC OMU' OR fees_category = 'SC/ST/VJ/DT/NT/SBC MU' OR fees_category = 'SC/ST/VJ/DT/NT/SBC OMU' OR fees_category = 'JK/GOI/NEUT' OR fees_category = 'OMS' )  and status = 'ADMITTED'  and shift_allotted = 'Morning' and admission_type = 'DTE'"));
                $user10 = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN MU' OR fees_category = 'OPEN OMU'  OR fees_category = 'OBC/EBC MU' OR fees_category = 'OBC/EBC OMU' OR fees_category = 'SC/ST/VJ/DT/NT/SBC MU' OR fees_category = 'SC/ST/VJ/DT/NT/SBC OMU' OR fees_category = 'JK/GOI/NEUT' OR fees_category = 'OMS' )  and status = 'CANCELLED'  and shift_allotted = 'Morning' and admission_type = 'DTE'"));
                $user11= DB::select(DB::raw("SELECT * FROM `admission` WHERE ( fees_category = 'OPEN' )  and status = 'ADMITTED'  and shift_allotted = 'Morning' and admission_type = 'ACAP'"));
                $user12 = DB::select(DB::raw("SELECT * FROM `admission` WHERE ( fees_category = 'OPEN' )  and status = 'CANCELLED'  and shift_allotted = 'Morning' and admission_type = 'ACAP'"));
               
               $user13 = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN MU' OR fees_category = 'OPEN OMU'  OR fees_category = 'OBC/EBC MU' OR fees_category = 'OBC/EBC OMU' OR fees_category = 'SC/ST/VJ/DT/NT/SBC MU' OR fees_category = 'SC/ST/VJ/DT/NT/SBC OMU' OR fees_category = 'JK/GOI/NEUT' OR fees_category = 'OMS' )  and status = 'ADMITTED'  and shift_allotted = 'Afternoon' and admission_type = 'DTE'"));
                $user14 = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN MU' OR fees_category = 'OPEN OMU'  OR fees_category = 'OBC/EBC MU' OR fees_category = 'OBC/EBC OMU' OR fees_category = 'SC/ST/VJ/DT/NT/SBC MU' OR fees_category = 'SC/ST/VJ/DT/NT/SBC OMU' OR fees_category = 'JK/GOI/NEUT' OR fees_category = 'OMS' )  and status = 'CANCELLED'  and shift_allotted = 'Afternoon' and admission_type = 'DTE'"));
                $user15= DB::select(DB::raw("SELECT * FROM `admission` WHERE ( fees_category = 'OPEN' )  and status = 'ADMITTED'  and shift_allotted = 'Afternoon' and admission_type = 'ACAP'"));
                $user16 = DB::select(DB::raw("SELECT * FROM `admission` WHERE ( fees_category = 'OPEN' )  and status = 'CANCELLED'  and shift_allotted = 'Afternoon' and admission_type = 'ACAP'"));
               
                $d1 = count($user1); // morning sindhi shift admitted student dte
                $d2 = count($user2); // morning sindhi shift cancelled student dte
                
                    $dms = $d1-$d2; // morning shift dte admitted sindhi 
                
                 $d3 = count($user3); // morning  shift admitted student acap sindhi
                $d4 = count($user4); // morning shift cancelled student acap sindhi
                
                 $ams = $d3-$d4; // morning shift acap admiditted Shindhi
                
                 $d9 = count($user9); //morning shift admitted student dte open
                $d10 = count($user10);  //morning shift cancelled student dte open
                
                $dmg = $d9-$d10; //morning shift admitted dte general
                
                 $d11 = count($user11);  //morning shift admitted student acap open
                $d12 = count($user12);  //morning shift admitted student acap open
                
                $amg = $d11-$d12;
                
                 $d5 = count($user5); //Afternoon  shift admitted student dte sindhi
                $d6 = count($user6); //Afternoon  shift cancelled student dte sindhi
                
                $dfs= $d5-$d6;
                
                 $d7 = count($user7); //Afternoon  shift admitted student acap sindhi
                $d8 = count($user8);// Afternoon shift cancelled student acap  sindhi
                
                $afs = $d7-$d8;
               
                 $d13 = count($user13);//Afternoon  shift admitted student dte open
                $d14 = count($user14);//Afternoon  shift cancelled student dte open
                
                $dfg =$d13-$d14;
                
                 $d15 = count($user15);//Afternoon  shift admitted student acap open
                $d16 = count($user16);// Afternoon shift cancelled student acap  open
                
                $afg =$d15-$d16;
                
                
                $rem1= 60-($dms+$ams+$dmg+$amg);
                $rem2= 60-($dfs+$afs+$dfg+$afg);

                $rem3 = $dms+$ams+$dmg+$amg;
                $rem4 = $dfs+$afs+$dfg+$afg;
                return view('admin.adminDashboard')->with('dms',$dms)->with('ams',$ams)->with('dmg',$dmg)->with('amg',$amg)->with('dfs',$dfs)->with('afs',$afs)->with('dfg',$dfg)->with('afg',$afg)->with('rem1',$rem1)->with('rem2',$rem2)->with('rem3',$rem3)->with('rem4',$rem4);
         }
         else if($course =="FEG")
         {
            // $user1=DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN SINDHI MINORITY' )  and status = 'ADMITTED' and updated_at in (select max(updated_at) from admission group by dte_id) and branch = 'CMPN'and shift_allotted = '1st-Shift' and admission_type = 'DTE'"));

            // $user2=DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN SINDHI MINORITY' )  and status = 'ADMITTED' and updated_at in (select max(updated_at) from admission group by dte_id) and branch = 'CMPN'and shift_allotted = '2nd-Shift' and admission_type = 'DTE'"));





            //CMPN For SINDHI ADMITTED DTE SHIFT 1
           $userCMPNDTESA1=DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'ADMITTED' and branch = 'CMPN' and course='FEG' and shift_allotted = '1st-Shift' and admission_type = 'DTE'"));

            //CMPN For SINDHI CANCELLED DTE SHIFT 1
           $userCMPNDTESC1=DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'CANCELLED' and branch = 'CMPN'and  course='FEG' and shift_allotted = '1st-Shift' and admission_type = 'DTE'"));

            //CMPN For SINDHI ADMITTED ACAP SHIFT 1
           $userCMPNACAPSA1=DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'ADMITTED' and branch = 'CMPN' and  course='FEG' and shift_allotted = '1st-Shift' and admission_type = 'ACAP'"));

            //CMPN For SINDHI CANCELLED ACAP SHIFT 1
           $userCMPNACAPSC1=DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'CANCELLED' and branch = 'CMPN'and  course='FEG' and shift_allotted = '1st-Shift' and admission_type = 'ACAP'"));


         //CMPN For SINDHI ADMITTED DTE SHIFT 2
           $userCMPNDTESA2=DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'ADMITTED' and branch = 'CMPN' and  course='FEG' and shift_allotted = '2nd-Shift' and admission_type = 'DTE'"));

            //CMPN For SINDHI CANCELLED DTE SHIFT 2
           $userCMPNDTESC2=DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'CANCELLED' and branch = 'CMPN'and  course='FEG' and shift_allotted = '2nd-Shift' and admission_type = 'DTE'"));

            //CMPN For SINDHI ADMITTED ACAP SHIFT 2
           $userCMPNACAPSA2=DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'ADMITTED' and branch = 'CMPN' and  course='FEG' and shift_allotted = '2nd-Shift' and admission_type = 'ACAP'"));

            //CMPN For SINDHI CANCELLED ACAP SHIFT 2
           $userCMPNACAPSC2=DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'CANCELLED' and branch = 'CMPN'and  course='FEG' and shift_allotted = '2nd-Shift' and admission_type = 'ACAP'"));



            //IT For SINDHI ADMITTED DTE
            $userITDTESA = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'ADMITTED' and branch = 'INFT' and admission_type = 'DTE'  and course='FEG'"));

            //IT For SINDHI CANCELLED DTE
            $userITDTESC = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'CANCELLED' and branch = 'INFT' and admission_type = 'DTE' and course='FEG'"));

            //IT For SINDHI ADMITTED ACAP
            $userITACAPSA = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category ='SINDHI')  and status = 'ADMITTED' and branch = 'INFT' and admission_type = 'ACAP' and course='FEG'"));

            //IT For SINDHI CANCELLED ACAP
            $userITACAPSC = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category =  'SINDHI')  and status = 'CANCELLED' and branch = 'INFT' and admission_type = 'ACAP' and course='FEG'"));




            //INST For SINDHI ADMITTED DTE
            $userINSTDTESA = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'ADMITTED' and branch = 'INST' and admission_type = 'DTE' and course='FEG'"));

            //INST For SINDHI CANCELLED DTE
            $userINSTDTESC = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'CANCELLED' and branch = 'INST' and admission_type = 'DTE' and course='FEG'"));

            //INST For SINDHI ADMITTED ACAP
            $userINSTACAPSA = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category =   'SINDHI')  and status = 'ADMITTED' and branch = 'INST' and admission_type = 'ACAP' and course='FEG'"));
            
            //INST For SINDHI CANCELLED ACAP
            $userINSTACAPSC = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category =  'SINDHI')  and status = 'CANCELLED' and branch = 'INST' and admission_type = 'ACAP' and course='FEG'"));



            //EXTC For SINDHI ADMITTED DTE
           $userEXTCDTESA = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'ADMITTED' and branch = 'EXTC' and admission_type = 'DTE' and course='FEG'"));

            //EXTC For SINDHI CANCELLED DTE
           $userEXTCDTESC = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'CANCELLED' and branch = 'EXTC' and admission_type = 'DTE' and course='FEG'"));

            //EXTC For SINDHI ADMITTED ACAP
           $userEXTCACAPSA = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category =   'SINDHI')  and status = 'ADMITTED' and branch = 'EXTC' and admission_type = 'ACAP' and course='FEG'"));

            //EXTC For SINDHI CANCELLED ACAP           
           $userEXTCACAPSC = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category =  'SINDHI')  and status = 'CANCELLED' and branch = 'EXTC' and admission_type = 'ACAP' and course='FEG'"));
               




//$userEXTCDTESA = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN SINDHI MINORITY' )  and status = 'ADMITTED' and branch = 'EXTC' and admission_type = 'DTE'"));
           //      $userEXTCDTESC = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN SINDHI MINORITY' )  and status = 'CANCELLED' and branch = 'EXTC' and admission_type = 'DTE'"));
           //      $userEXTCACAPSA = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category =   'SINDHI')  and status = 'ADMITTED' and branch = 'EXTC' and admission_type = 'ACAP'"));
           //      $userEXTCACAPSC = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category =  'SINDHI')  and status = 'CANCELLED' and branch = 'EXTC' and admission_type = 'ACAP'"));
           




            //ETRX For SINDHI ADMITTED DTE
            $userETRXDTESA = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'ADMITTED' and branch = 'ETRX' and admission_type = 'DTE' and course='FEG'"));

            //ETRX For SINDHI CANCELLED DTE
            $userETRXDTESC = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'CANCELLED' and branch = 'ETRX' and admission_type = 'DTE' and course='FEG'"));

            //ETRX For SINDHI ADMITTED ACAP
            $userETRXACAPSA = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category =   'SINDHI')  and status = 'ADMITTED' and branch = 'ETRX' and admission_type = 'ACAP' and course='FEG'"));

            //ETRX For SINDHI CANCELLED ACAP            
            $userETRXACAPSC = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category =  'SINDHI')  and status = 'CANCELLED' and branch = 'ETRX' and admission_type = 'ACAP' and course='FEG'"));
               



            //CMPN For GENERAL ADMITTED DTE SHIFT 1
            $userCMPNDTEOA1 = DB::select(DB::raw("SELECT * FROM `admission` WHERE ( fees_category = 'OPEN'  OR fees_category = 'GENERAL'  OR  fees_category = 'SBC'  OR fees_category = 'NT' OR fees_category = 'SC' OR fees_category = 'OBC' OR fees_category = 'ST' OR fees_category = 'PMSS' OR fees_category = 'JK' OR fees_category = 'GOI' OR fees_category = 'NEUT' OR fees_category = 'TFWS')  and status = 'ADMITTED'  and branch = 'CMPN' and  course='FEG'and shift_allotted = '1st-Shift' and admission_type = 'DTE'"));

            //CMPN For GENERAL CANCELLED DTE SHIFT 1
            $userCMPNDTEOC1 = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN' OR  fees_category = 'GENERAL'  OR fees_category = 'SBC'  OR fees_category = 'NT' OR fees_category = 'SC' OR fees_category = 'OBC' OR fees_category = 'ST' OR fees_category = 'PMSS' OR fees_category = 'JK' OR fees_category = 'GOI' OR fees_category = 'NEUT' OR fees_category = 'TFWS')  and status = 'CANCELLED'  and branch = 'CMPN' and  course='FEG'and shift_allotted = '1st-Shift' and admission_type = 'DTE'"));

            //CMPN For GENERAL ADMITTED ACAP SHIFT 1
             $userCMPNACAPOA1= DB::select(DB::raw("SELECT * FROM `admission` WHERE (  fees_category = 'GENERAL'  OR fees_category = 'OPEN' )  and status = 'ADMITTED'  and branch = 'CMPN' and  course='FEG' and shift_allotted = '1st-Shift' and admission_type = 'ACAP'"));

            //CMPN For GENERAL CANCELLED ACAP SHIFT 1
             $userCMPNACAPOC1 = DB::select(DB::raw("SELECT * FROM `admission` WHERE (  fees_category = 'GENERAL'  OR fees_category = 'OPEN' )  and status = 'CANCELLED'  and branch = 'CMPN' and  course='FEG' and shift_allotted = '1st-Shift' and admission_type = 'ACAP'"));
               
 


            //CMPN For GENERAL ADMITTED DTE SHIFT 2
            $userCMPNDTEOA2 = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN' OR fees_category = 'GENERAL'  OR  fees_category = 'SBC'  OR fees_category = 'NT' OR fees_category = 'SC' OR fees_category = 'OBC' OR fees_category = 'ST' OR fees_category = 'PMSS' OR fees_category = 'JK' OR fees_category = 'GOI' OR fees_category = 'NEUT' OR fees_category = 'TFWS')  and status = 'ADMITTED'  and branch = 'CMPN' and  course='FEG'and shift_allotted = '2nd-Shift' and admission_type = 'DTE'"));

            //CMPN For GENERAL CANCELLED DTE SHIFT 2
            $userCMPNDTEOC2 = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN' OR fees_category = 'SBC'  OR fees_category = 'NT' OR fees_category = 'SC' OR fees_category = 'OBC' OR fees_category = 'ST' OR fees_category = 'PMSS' OR fees_category = 'JK' OR fees_category = 'GOI' OR fees_category = 'NEUT' OR fees_category = 'TFWS')  and status = 'CANCELLED'  and branch = 'CMPN' and  course='FEG' and shift_allotted = '2nd-Shift' and admission_type = 'DTE'"));

            //CMPN For GENERAL ADMITTED ACAP SHIFT 2
             $userCMPNACAPOA2= DB::select(DB::raw("SELECT * FROM `admission` WHERE ( fees_category = 'OPEN' )  and status = 'ADMITTED'  and branch = 'CMPN' and  course='FEG' and shift_allotted = '2nd-Shift' and admission_type = 'ACAP'"));

            //CMPN For GENERAL CANCELLED ACAP SHIFT 2
             $userCMPNACAPOC2 = DB::select(DB::raw("SELECT * FROM `admission` WHERE ( fees_category = 'OPEN' )  and status = 'CANCELLED'  and branch = 'CMPN' and  course='FEG'and shift_allotted = '2nd-Shift' and admission_type = 'ACAP'"));



            //IT For GENERAL ADMITTED DTE                
            $userITDTEOA = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN' OR fees_category = 'OPEN_CI' OR fees_category = 'SBC'  OR fees_category = 'NT' OR fees_category = 'SC' OR fees_category = 'OBC' OR fees_category = 'ST' OR fees_category = 'PMSSS' OR fees_category = 'JK' OR fees_category = 'GOI' OR fees_category = 'NEUT' OR fees_category = 'TFWS')  and status = 'ADMITTED'  and branch = 'INFT' and admission_type = 'DTE' and course='FEG'"));

            //IT For GENERAL CANCELLED DTE
            $userITDTEOC = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN' OR fees_category = 'GENERAL'   OR fees_category = 'OPEN_CI' OR fees_category = 'SBC'  OR fees_category = 'NT' OR fees_category = 'SC' OR fees_category = 'OBC' OR fees_category = 'ST' OR fees_category = 'PMSSS' OR fees_category = 'JK' OR fees_category = 'GOI' OR fees_category = 'NEUT' OR fees_category = 'TFWS')  and status = 'CANCELLED'  and branch = 'INFT' and admission_type = 'DTE' and course='FEG'"));

            //IT For GENERAL ADMITTED ACAP
             $userITACAPOA= DB::select(DB::raw("SELECT * FROM `admission` WHERE (  fees_category = 'GENERAL'  OR fees_category = 'OPEN' )  and status = 'ADMITTED'  and branch = 'INFT' and admission_type = 'ACAP' and course='FEG'"));

            //IT For GENERAL CANCELLED ACAP
             $userITACAPOC = DB::select(DB::raw("SELECT * FROM `admission` WHERE ( fees_category = 'GENERAL'  OR  fees_category = 'OPEN' )  and status = 'CANCELLED'  and branch = 'INFT' and admission_type = 'ACAP' and course='FEG'"));
               



            //INST For GENERAL ADMITTED DTE                
           $userINSTDTEOA = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN' OR fees_category = 'GENERAL'  OR  fees_category = 'SBC'  OR fees_category = 'NT' OR fees_category = 'SC' OR fees_category = 'OBC' OR fees_category = 'ST' OR fees_category = 'PMSS' OR fees_category = 'JK' OR fees_category = 'GOI' OR fees_category = 'NEUT' OR fees_category = 'TFWS')  and status = 'ADMITTED'  and branch = 'INST' and admission_type = 'DTE' and course='FEG'"));

            //INST For GENERAL CANCELLED DTE                
            $userINSTDTEOC = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN' OR  fees_category = 'GENERAL'  OR fees_category = 'SBC'  OR fees_category = 'NT' OR fees_category = 'SC' OR fees_category = 'OBC' OR fees_category = 'ST' OR fees_category = 'PMSS' OR fees_category = 'JK' OR fees_category = 'GOI' OR fees_category = 'NEUT' OR fees_category = 'TFWS')  and status = 'CANCELLED'  and branch = 'INST' and admission_type = 'DTE' and course='FEG'"));

             //INST For GENERAL ADMITTED ACAP                           
            $userINSTACAPOA= DB::select(DB::raw("SELECT * FROM `admission` WHERE ( fees_category = 'GENERAL'  OR  fees_category = 'OPEN' )  and status = 'ADMITTED'  and branch = 'INST' and admission_type = 'ACAP' and course='FEG'"));

            //INST For GENERAL CANCELLED ACAP                            
            $userINSTACAPOC = DB::select(DB::raw("SELECT * FROM `admission` WHERE ( fees_category = 'GENERAL'  OR  fees_category = 'OPEN' )  and status = 'CANCELLED'  and branch = 'INST' and admission_type = 'ACAP' and course='FEG'"));



            //EXTC For GENERAL ADMITTED DTE                
           $userEXTCDTEOA = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN' OR  fees_category = 'GENERAL'  OR fees_category = 'SBC'  OR fees_category = 'NT' OR fees_category = 'SC' OR fees_category = 'OBC' OR fees_category = 'ST' OR fees_category = 'PMSS' OR fees_category = 'JK' OR fees_category = 'GOI' OR fees_category = 'NEUT' OR fees_category = 'TFWS')  and status = 'ADMITTED'  and branch = 'EXTC' and admission_type = 'DTE' and course='FEG'"));

            //EXTC For GENERAL CANCELLED DTE                
           $userEXTCDTEOC = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN' OR  fees_category = 'GENERAL'  OR fees_category = 'SBC'  OR fees_category = 'NT' OR fees_category = 'SC' OR fees_category = 'OBC' OR fees_category = 'ST' OR fees_category = 'PMSS' OR fees_category = 'JK' OR fees_category = 'GOI' OR fees_category = 'NEUT' OR fees_category = 'TFWS')  and status = 'CANCELLED'  and branch = 'EXTC' and admission_type = 'DTE' and course='FEG'"));

            //EXTC For GENERAL ADMITTED ACAP                
           $userEXTCACAPOA= DB::select(DB::raw("SELECT * FROM `admission` WHERE (  fees_category = 'GENERAL'  OR fees_category = 'OPEN' )  and status = 'ADMITTED'  and branch = 'EXTC' and admission_type = 'ACAP' and course='FEG'"));

            //EXTC For GENERAL CANCELLED ACAP                
           $userEXTCACAPOC = DB::select(DB::raw("SELECT * FROM `admission` WHERE (  fees_category = 'GENERAL'  OR fees_category = 'OPEN' )  and status = 'CANCELLED'  and branch = 'EXTC' and admission_type = 'ACAP' and course='FEG'"));
               


           //ETRX For GENERAL ADMITTED DTE                
           $userETRXDTEOA = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN' OR fees_category = 'GENERAL'  OR fees_category = 'SBC'  OR fees_category = 'NT' OR fees_category = 'SC' OR fees_category = 'OBC' OR fees_category = 'ST' OR fees_category = 'PMSS' OR fees_category = 'JK' OR fees_category = 'GOI' OR fees_category = 'NEUT' OR fees_category = 'TFWS')  and status = 'ADMITTED'  and branch = 'ETRX' and admission_type = 'DTE' and course='FEG'"));

            //ETRX For GENERAL CANCELLED DTE                
           $userETRXDTEOC = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN'  OR fees_category = 'GENERAL'  OR fees_category = 'SBC'  OR fees_category = 'NT' OR fees_category = 'SC' OR fees_category = 'OBC' OR fees_category = 'ST' OR fees_category = 'PMSS' OR fees_category = 'JK' OR fees_category = 'GOI' OR fees_category = 'NEUT' OR fees_category = 'TFWS')  and status = 'CANCELLED'  and branch = 'ETRX' and admission_type = 'DTE' and course='FEG'"));

            //ETRX For GENERAL ADMITTED ACAP                
           $userETRXACAPOA= DB::select(DB::raw("SELECT * FROM `admission` WHERE ( fees_category = 'GENERAL'  OR fees_category = 'OPEN' )  and status = 'ADMITTED'  and branch = 'ETRX' and admission_type = 'ACAP' and course='FEG'"));

            //ETRX For GENERAL CANCELLED ACAP                
           $userETRXACAPOC = DB::select(DB::raw("SELECT * FROM `admission` WHERE ( fees_category = 'GENERAL'  OR fees_category = 'OPEN' )  and status = 'CANCELLED'  and branch = 'ETRX' and admission_type = 'ACAP' and course='FEG'"));



          $d1 = count($userITDTESA); // IT sindhi  admitted  dte
          $d2 = count($userITDTESC); // IT sindhi  cancelled  dte
                
          $DITs = $d1-$d2; // IT  dte admitted sindhi 
                
          $d3 = count($userITACAPSA); // IT   admitted  acap sindhi
          $d4 = count($userITACAPSC); // IT  cancelled  acap sindhi
                
          $AITs = $d3-$d4; // IT  acap admitted Shindhi
                


          $d5 = count($userINSTDTESA); // INST sindhi admitted  dte
          $d6 = count($userINSTDTESC); // INST sindhi cancelled  dte
                
          $DINSTs = $d5-$d6; // INST dte admitted sindhi 
                
          $d7 = count($userINSTACAPSA); // INST   admitted  acap sindhi
          $d8 = count($userINSTACAPSC); // INST  cancelled  acap sindhi
                
          $AINSTs = $d7-$d8; // INST  acap admitted sindhi



          $d9 = count($userEXTCDTESA); // EXTC sindhi admitted  dte
          $d10 = count($userEXTCDTESC); // EXTC sindhi cancelled  dte
                
          $DEXTCs = $d9-$d10; // EXTC  dte admitted sindhi 
                
          $d11 = count($userEXTCACAPSA); // EXTC   admitted  acap sindhi
          $d12 = count($userEXTCACAPSC); // EXTC  cancelled  acap sindhi
                
          $AEXTCs = $d11-$d12;// EXTC  acap admitted sindhi

          

          $d13 = count($userETRXDTESA); // ETRX sindhi admitted  dte
          $d14 = count($userETRXDTESC); // ETRX sindhi cancelled  dte
                
          $DETRXs = $d13-$d14; // ETRX  dte admitted sindhi 
                
          $d15 = count($userETRXACAPSA); // ETRX   admitted acap sindhi
          $d16 = count($userETRXACAPSC); // ETRX  cancelled acap sindhi
                
          $AETRXs = $d15-$d16;// ETRX  acap admitted sindhi



          $d17 = count($userCMPNDTESA1); // CMPN sindhi shift 1 admitted  dte
          $d18 = count($userCMPNDTESC1); // CMPN sindhi shift 1 cancelled dte
                
          $DCMPN1s = $d17-$d18; // CMPN  dte admitted sindhi shift 1
                
          $d19 = count($userCMPNACAPSA1); // CMPN   admitted  shift 1 acap sindhi
          $d20 = count($userCMPNACAPSC1); // CMPN  cancelled  shift 1 acap sindhi
                
          $ACMPN1s = $d19-$d20;// CMPN  acap admitted sindhi shift 1



          $d21 = count($userITDTEOA); // IT sindhi admitted dte
          $d22 = count($userITDTEOC); // IT sindhi cancelled dte
                
          $DITo = $d21-$d22; // IT dte admitted open 
                
          $d23 = count($userITACAPOA); // IT admitted student acap sindhi
          $d24 = count($userITACAPOC); // IT cancelled student acap sindhi
                
          $AITo = $d23-$d24; // IT  acap admitted open
                


          $d25 = count($userINSTDTEOA); // INST open admitted dte
          $d26 = count($userINSTDTEOC); // INST open cancelled dte
                
          $DINSTo = $d25-$d26; // INST dte admitted open 
                
          $d27 = count($userINSTACAPOA); // INST admitted acap open
          $d28 = count($userINSTACAPOC); // INST cancelled acap open
                
          $AINSTo = $d27-$d28; // INST  acap admitted open



          $d29 = count($userEXTCDTEOA); // EXTC open admitted dte
          $d30 = count($userEXTCDTEOC); // EXTC open cancelled dte
                
          $DEXTCo = $d29-$d30; // EXTC  dte admitted open 
                
          $d31 = count($userEXTCACAPOA); // EXTC   admitted acap open
          $d32 = count($userEXTCACAPOC); // EXTC  cancelled acap open
                
          $AEXTCo = $d31-$d32;// EXTC  acap admitted open



          $d33 = count($userETRXDTEOA); // ETRX open admitted dte
          $d34 = count($userETRXDTEOC); // ETRX open cancelled dte
                
          $DETRXo = $d33-$d34; // ETRX  dte admitted open 
                
          $d35 = count($userETRXACAPOA); // ETRX   admitted acap open
          $d36 = count($userETRXACAPOC); // ETRX  cancelled acap open
                
          $AETRXo = $d35-$d36;// ETRX  acap admitted open



          $d37 = count($userCMPNDTEOA1); // CMPN open admitted dte
          $d38 = count($userCMPNDTEOC1); // CMPN open cancelled dte
                
          $DCMPN1o = $d37-$d38; // CMPN  dte admitted open 
                
          $d39 = count($userCMPNACAPOA1); // CMPN   admitted acap open
          $d40 = count($userCMPNACAPOC1); // CMPN  cancelled acap open
                
          $ACMPN1o = $d39-$d40;// CMPN  acap admitted open






          $d41 = count($userCMPNDTESA2); // CMPN sindhi shift 2 admitted  dte
          $d42 = count($userCMPNDTESC2); // CMPN sindhi shift 2 cancelled dte
                
          $DCMPN2s = $d41-$d42; // CMPN  dte admitted sindhi shift 2
                
          $d43 = count($userCMPNACAPSA2); // CMPN   admitted  shift 2 acap sindhi
          $d44 = count($userCMPNACAPSC2); // CMPN  cancelled  shift 2 acap sindhi
                
          $ACMPN2s = $d43-$d44;// CMPN  acap admitted sindhi shift 2


          $d45 = count($userCMPNDTEOA2); // CMPN open admitted shift 2 dte
          $d46 = count($userCMPNDTEOC2); // CMPN open cancelled shift 2 dte
                
          $DCMPN2o = $d45-$d46; // CMPN  dte admitted shift 2 open 
                
          $d47 = count($userCMPNACAPOA2); // CMPN   admitted acap shift 2 open
          $d48 = count($userCMPNACAPOC2); // CMPN  cancelled acap shift 2 open
                
          $ACMPN2o = $d47-$d48;// CMPN  acap admitted shift 2 open

                
                
                $remIT= 60-($DITs+$AITs+$DITo+$AITo);
                $fillIT= $DITs+$AITs+$DITo+$AITo;

                $remINST= 60-($DINSTs+$AINSTs+$DINSTo+$AINSTo);
                $fillINST= $DINSTs+$AINSTs+$DINSTo+$AINSTo;

                $remEXTC= 60-($DEXTCs+$AEXTCs+$DEXTCo+$AEXTCo);
                $fillEXTC= $DEXTCs+$AEXTCs+$DEXTCo+$AEXTCo;


                $remETRX= 60-($DETRXs+$AETRXs+$DETRXo+$AETRXo);
                $fillETRX= $DETRXs+$AETRXs+$DETRXo+$AETRXo;


                $remCMPN1= 60-($DCMPN1s+$ACMPN1s+$DCMPN1o+$ACMPN1o);
                $fillCMPN1= $DCMPN1s+$ACMPN1s+$DCMPN1o+$ACMPN1o;

                $remCMPN2= 60-($DCMPN2s+$ACMPN2s+$DCMPN2o+$ACMPN2o);
                $fillCMPN2= $DCMPN2s+$ACMPN2s+$DCMPN2o+$ACMPN2o;


                $data = [];
                $data['remIT']=$remIT;
                $data['fillIT']=$fillIT;
                $data['remINST']=$remINST;
                $data['fillINST']=$fillINST;
                $data['remEXTC']=$remEXTC;
                $data['fillEXTC']=$fillEXTC;
                $data['remETRX']=$remETRX;
                $data['fillETRX']=$fillETRX;
                $data['remCMPN1']=$remCMPN1;
                $data['fillCMPN1']=$fillCMPN1;
                $data['remCMPN2']=$remCMPN2;
                $data['fillCMPN2']=$fillCMPN2;
                $data['DITs']=$DITs;
                $data['AITs']=$AITs;
                $data['DINSTs']=$DINSTs;
                $data['AINSTs']=$AINSTs;
                $data['DEXTCs']=$DEXTCs;
                $data['AEXTCs']=$AEXTCs;
                $data['DETRXs']=$DETRXs;
                $data['AETRXs']=$AETRXs;
                $data['DCMPN1s']=$DCMPN1s;
                $data['ACMPN1s']=$ACMPN1s;
                $data['DCMPN2s']=$DCMPN2s;
                $data['ACMPN2s']=$ACMPN2s;
                $data['DITo']=$DITo;
                $data['AITo']=$AITo;
                $data['DINSTo']=$DINSTo;
                $data['AINSTo']=$AINSTo;
                $data['DEXTCo']=$DEXTCo;
                $data['AEXTCo']=$AEXTCo; 
                $data['DETRXo']=$DETRXo;
                $data['AETRXo']=$AETRXo; 
                $data['DCMPN1o']=$DCMPN1o;
                $data['ACMPN1o']=$ACMPN1o; 
                $data['DCMPN2o']=$DCMPN2o;
                $data['ACMPN2o']=$ACMPN2o; 
                //return $data;
              
                return view('admin.adminDashboard')->with('data',$data);
           
               return view('admin.adminDashboard');
         }
         else if($course =="DSE")
         {

            //CMPN For SINDHI ADMITTED DTE SHIFT 1
           $userCMPNDTESA1=DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'ADMITTED' and branch = 'CMPN' and course='DSE' and shift_allotted = '1st-Shift' and admission_type = 'DTE'"));

            //CMPN For SINDHI CANCELLED DTE SHIFT 1
           $userCMPNDTESC1=DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'CANCELLED' and branch = 'CMPN' and course='DSE' and shift_allotted = '1st-Shift' and admission_type = 'DTE'"));

            //CMPN For SINDHI ADMITTED ACAP SHIFT 1
           $userCMPNACAPSA1=DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'ADMITTED' and branch = 'CMPN' and course='DSE' and shift_allotted = '1st-Shift' and admission_type = 'ACAP'"));

            //CMPN For SINDHI CANCELLED ACAP SHIFT 1
           $userCMPNACAPSC1=DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'CANCELLED' and branch = 'CMPN' and course='DSE' and shift_allotted = '1st-Shift' and admission_type = 'ACAP'"));


         //CMPN For SINDHI ADMITTED DTE SHIFT 2
           $userCMPNDTESA2=DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'ADMITTED' and branch = 'CMPN' and course='DSE' and shift_allotted = '2nd-Shift' and admission_type = 'DTE'"));

            //CMPN For SINDHI CANCELLED DTE SHIFT 2
           $userCMPNDTESC2=DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'CANCELLED' and branch = 'CMPN'and course='DSE' and shift_allotted = '2nd-Shift' and admission_type = 'DTE'"));

            //CMPN For SINDHI ADMITTED ACAP SHIFT 2
           $userCMPNACAPSA2=DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'ADMITTED' and branch = 'CMPN' and course='DSE' and shift_allotted = '2nd-Shift' and admission_type = 'ACAP'"));

            //CMPN For SINDHI CANCELLED ACAP SHIFT 2
           $userCMPNACAPSC2=DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'CANCELLED' and branch = 'CMPN' and course='DSE' and shift_allotted = '2nd-Shift' and admission_type = 'ACAP'"));



            //IT For SINDHI ADMITTED DTE
            $userITDTESA = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'ADMITTED' and branch = 'IT' and admission_type = 'DTE' and course='DSE'"));

            //IT For SINDHI CANCELLED DTE
            $userITDTESC = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'CANCELLED' and branch = 'IT' and admission_type = 'DTE' and course='DSE'"));

            //IT For SINDHI ADMITTED ACAP
            $userITACAPSA = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category ='SINDHI')  and status = 'ADMITTED' and branch = 'IT' and admission_type = 'ACAP' and course='DSE'"));

            //IT For SINDHI CANCELLED ACAP
            $userITACAPSC = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category =  'SINDHI')  and status = 'CANCELLED' and branch = 'IT' and admission_type = 'ACAP' and course='DSE'"));




            //INST For SINDHI ADMITTED DTE
            $userINSTDTESA = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'ADMITTED' and branch = 'INST' and admission_type = 'DTE' and course='DSE'"));

            //INST For SINDHI CANCELLED DTE
            $userINSTDTESC = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'CANCELLED' and branch = 'INST' and admission_type = 'DTE' and course='DSE'"));

            //INST For SINDHI ADMITTED ACAP
            $userINSTACAPSA = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category =   'SINDHI')  and status = 'ADMITTED' and branch = 'INST' and admission_type = 'ACAP' and course='DSE'"));
            
            //INST For SINDHI CANCELLED ACAP
            $userINSTACAPSC = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category =  'SINDHI')  and status = 'CANCELLED' and branch = 'INST' and admission_type = 'ACAP' and course='DSE'"));



            //EXTC For SINDHI ADMITTED DTE
           $userEXTCDTESA = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'ADMITTED' and branch = 'EXTC' and admission_type = 'DTE' and course='DSE'"));

            //EXTC For SINDHI CANCELLED DTE
           $userEXTCDTESC = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'CANCELLED' and branch = 'EXTC' and admission_type = 'DTE' and course='DSE'"));

            //EXTC For SINDHI ADMITTED ACAP
           $userEXTCACAPSA = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category =   'SINDHI')  and status = 'ADMITTED' and branch = 'EXTC' and admission_type = 'ACAP' and course='DSE'"));

            //EXTC For SINDHI CANCELLED ACAP           
           $userEXTCACAPSC = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category =  'SINDHI')  and status = 'CANCELLED' and branch = 'EXTC' and admission_type = 'ACAP' and course='DSE'"));
               


            //ETRX For SINDHI ADMITTED DTE
            $userETRXDTESA = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'ADMITTED' and branch = 'ETRX' and admission_type = 'DTE' and course='DSE'"));

            //ETRX For SINDHI CANCELLED DTE
            $userETRXDTESC = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'SINDHI' )  and status = 'CANCELLED' and branch = 'ETRX' and admission_type = 'DTE' and course='DSE'"));

            //ETRX For SINDHI ADMITTED ACAP
            $userETRXACAPSA = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category =   'SINDHI')  and status = 'ADMITTED' and branch = 'ETRX' and admission_type = 'ACAP' and course='DSE'"));

            //ETRX For SINDHI CANCELLED ACAP            
            $userETRXACAPSC = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category =  'SINDHI')  and status = 'CANCELLED' and branch = 'ETRX' and admission_type = 'ACAP' and course='DSE'"));
               



            //CMPN For GENERAL ADMITTED DTE SHIFT 1
            $userCMPNDTEOA1 = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN' OR fees_category = 'SBC'  OR fees_category = 'NT' OR fees_category = 'SC' OR fees_category = 'OBC' OR fees_category = 'ST' OR fees_category = 'PMSS' OR fees_category = 'JK' OR fees_category = 'GOI' OR fees_category = 'NEUT' OR fees_category = 'TFWS')  and status = 'ADMITTED'  and branch = 'CMPN' and course='DSE' and shift_allotted = '1st-Shift' and admission_type = 'DTE'"));

            //CMPN For GENERAL CANCELLED DTE SHIFT 1
            $userCMPNDTEOC1 = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN' OR fees_category = 'SBC'  OR fees_category = 'NT' OR fees_category = 'SC' OR fees_category = 'OBC' OR fees_category = 'ST' OR fees_category = 'PMSS' OR fees_category = 'JK' OR fees_category = 'GOI' OR fees_category = 'NEUT' OR fees_category = 'TFWS')  and status = 'CANCELLED'  and branch = 'CMPN' and course='DSE' and shift_allotted = '1st-Shift' and admission_type = 'DTE'"));

            //CMPN For GENERAL ADMITTED ACAP SHIFT 1
             $userCMPNACAPOA1= DB::select(DB::raw("SELECT * FROM `admission` WHERE ( fees_category = 'OPEN' )  and status = 'ADMITTED'  and branch = 'CMPN' and course='DSE' and shift_allotted = '1st-Shift' and admission_type = 'ACAP'"));

            //CMPN For GENERAL CANCELLED ACAP SHIFT 1
             $userCMPNACAPOC1 = DB::select(DB::raw("SELECT * FROM `admission` WHERE ( fees_category = 'OPEN' )  and status = 'CANCELLED'  and branch = 'CMPN' and course='DSE' and shift_allotted = '1st-Shift' and admission_type = 'ACAP'"));
               



            //CMPN For GENERAL ADMITTED DTE SHIFT 2
            $userCMPNDTEOA2 = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN' OR fees_category = 'SBC'  OR fees_category = 'NT' OR fees_category = 'SC' OR fees_category = 'OBC' OR fees_category = 'ST' OR fees_category = 'PMSS' OR fees_category = 'JK' OR fees_category = 'GOI' OR fees_category = 'NEUT' OR fees_category = 'TFWS')  and status = 'ADMITTED'  and branch = 'CMPN' and course='DSE' and shift_allotted = '2nd-Shift' and admission_type = 'DTE'"));

            //CMPN For GENERAL CANCELLED DTE SHIFT 2
            $userCMPNDTEOC2 = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN' OR fees_category = 'SBC'  OR fees_category = 'NT' OR fees_category = 'SC' OR fees_category = 'OBC' OR fees_category = 'ST' OR fees_category = 'PMSS' OR fees_category = 'JK' OR fees_category = 'GOI' OR fees_category = 'NEUT' OR fees_category = 'TFWS')  and status = 'CANCELLED'  and branch = 'CMPN' and course='DSE' and shift_allotted = '2nd-Shift' and admission_type = 'DTE'"));
             //return $userCMPNDTEOC2;
            //CMPN For GENERAL ADMITTED ACAP SHIFT 2
             $userCMPNACAPOA2= DB::select(DB::raw("SELECT * FROM `admission` WHERE ( fees_category = 'OPEN' )  and status = 'ADMITTED'  and branch = 'CMPN' and course='DSE' and shift_allotted = '2nd-Shift' and admission_type = 'ACAP'"));

            //CMPN For GENERAL CANCELLED ACAP SHIFT 2
             $userCMPNACAPOC2 = DB::select(DB::raw("SELECT * FROM `admission` WHERE ( fees_category = 'OPEN' )  and status = 'CANCELLED'  and branch = 'CMPN' and course='DSE' and shift_allotted = '2nd-Shift' and admission_type = 'ACAP'"));



            //IT For GENERAL ADMITTED DTE                
            $userITDTEOA = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN' OR fees_category = 'SBC'  OR fees_category = 'NT' OR fees_category = 'SC' OR fees_category = 'OBC' OR fees_category = 'ST' OR fees_category = 'PMSS' OR fees_category = 'JK' OR fees_category = 'GOI' OR fees_category = 'NEUT' OR fees_category = 'TFWS')  and status = 'ADMITTED'  and branch = 'IT' and admission_type = 'DTE' and course='DSE'"));

            //IT For GENERAL CANCELLED DTE
            $userITDTEOC = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN' OR fees_category = 'SBC'  OR fees_category = 'NT' OR fees_category = 'SC' OR fees_category = 'OBC' OR fees_category = 'ST' OR fees_category = 'PMSS' OR fees_category = 'JK' OR fees_category = 'GOI' OR fees_category = 'NEUT' OR fees_category = 'TFWS')  and status = 'CANCELLED'  and branch = 'IT' and admission_type = 'DTE' and course='DSE'"));

            //IT For GENERAL ADMITTED ACAP
             $userITACAPOA= DB::select(DB::raw("SELECT * FROM `admission` WHERE ( fees_category = 'OPEN' )  and status = 'ADMITTED'  and branch = 'IT' and admission_type = 'ACAP' and course='DSE'"));

            //IT For GENERAL CANCELLED ACAP
             $userITACAPOC = DB::select(DB::raw("SELECT * FROM `admission` WHERE ( fees_category = 'OPEN' )  and status = 'CANCELLED'  and branch = 'IT' and admission_type = 'ACAP' and course='DSE'"));
               



            //INST For GENERAL ADMITTED DTE                
           $userINSTDTEOA = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN' OR fees_category = 'SBC'  OR fees_category = 'NT' OR fees_category = 'SC' OR fees_category = 'OBC' OR fees_category = 'ST' OR fees_category = 'PMSS' OR fees_category = 'JK' OR fees_category = 'GOI' OR fees_category = 'NEUT' OR fees_category = 'TFWS')  and status = 'ADMITTED'  and branch = 'INST' and admission_type = 'DTE' and course='DSE'"));

            //INST For GENERAL CANCELLED DTE                
            $userINSTDTEOC = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN' OR fees_category = 'SBC'  OR fees_category = 'NT' OR fees_category = 'SC' OR fees_category = 'OBC' OR fees_category = 'ST' OR fees_category = 'PMSS' OR fees_category = 'JK' OR fees_category = 'GOI' OR fees_category = 'NEUT' OR fees_category = 'TFWS')  and status = 'CANCELLED'  and branch = 'INST' and admission_type = 'DTE' and course='DSE'"));

             //INST For GENERAL ADMITTED ACAP                           
            $userINSTACAPOA= DB::select(DB::raw("SELECT * FROM `admission` WHERE ( fees_category = 'OPEN' )  and status = 'ADMITTED'  and branch = 'INST' and admission_type = 'ACAP' and course='DSE'"));

            //INST For GENERAL CANCELLED ACAP                            
            $userINSTACAPOC = DB::select(DB::raw("SELECT * FROM `admission` WHERE ( fees_category = 'OPEN' )  and status = 'CANCELLED'  and branch = 'INST' and admission_type = 'ACAP' and course='DSE'"));



            //EXTC For GENERAL ADMITTED DTE                
           $userEXTCDTEOA = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN' OR fees_category = 'SBC'  OR fees_category = 'NT' OR fees_category = 'SC' OR fees_category = 'OBC' OR fees_category = 'ST' OR fees_category = 'PMSS' OR fees_category = 'JK' OR fees_category = 'GOI' OR fees_category = 'NEUT' OR fees_category = 'TFWS')  and status = 'ADMITTED'  and branch = 'EXTC' and admission_type = 'DTE' and course='DSE'"));

            //EXTC For GENERAL CANCELLED DTE                
           $userEXTCDTEOC = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN' OR fees_category = 'SBC'  OR fees_category = 'NT' OR fees_category = 'SC' OR fees_category = 'OBC' OR fees_category = 'ST' OR fees_category = 'PMSS' OR fees_category = 'JK' OR fees_category = 'GOI' OR fees_category = 'NEUT' OR fees_category = 'TFWS')  and status = 'CANCELLED'  and branch = 'EXTC' and admission_type = 'DTE' and course='DSE'"));

            //EXTC For GENERAL ADMITTED ACAP                
           $userEXTCACAPOA= DB::select(DB::raw("SELECT * FROM `admission` WHERE ( fees_category = 'OPEN' )  and status = 'ADMITTED'  and branch = 'EXTC' and admission_type = 'ACAP' and course='DSE'"));

            //EXTC For GENERAL CANCELLED ACAP                
           $userEXTCACAPOC = DB::select(DB::raw("SELECT * FROM `admission` WHERE ( fees_category = 'OPEN' )  and status = 'CANCELLED'  and branch = 'EXTC' and admission_type = 'ACAP' and course='DSE'"));
               


           //ETRX For GENERAL ADMITTED DTE                
           $userETRXDTEOA = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN' OR fees_category = 'SBC'  OR fees_category = 'NT' OR fees_category = 'SC' OR fees_category = 'OBC' OR fees_category = 'ST' OR fees_category = 'PMSS' OR fees_category = 'JK' OR fees_category = 'GOI' OR fees_category = 'NEUT' OR fees_category = 'TFWS')  and status = 'ADMITTED'  and branch = 'ETRX' and admission_type = 'DTE' and course='DSE'"));

            //ETRX For GENERAL CANCELLED DTE                
           $userETRXDTEOC = DB::select(DB::raw("SELECT * FROM `admission` WHERE (fees_category = 'OPEN' OR fees_category = 'SBC'  OR fees_category = 'NT' OR fees_category = 'SC' OR fees_category = 'OBC' OR fees_category = 'ST' OR fees_category = 'PMSS' OR fees_category = 'JK' OR fees_category = 'GOI' OR fees_category = 'NEUT' OR fees_category = 'TFWS')  and status = 'CANCELLED'  and branch = 'ETRX' and admission_type = 'DTE' and course='DSE'"));

            //ETRX For GENERAL ADMITTED ACAP                
           $userETRXACAPOA= DB::select(DB::raw("SELECT * FROM `admission` WHERE ( fees_category = 'OPEN' )  and status = 'ADMITTED'  and branch = 'ETRX' and admission_type = 'ACAP' and course='DSE'"));

            //ETRX For GENERAL CANCELLED ACAP                
           $userETRXACAPOC = DB::select(DB::raw("SELECT * FROM `admission` WHERE ( fees_category = 'OPEN' )  and status = 'CANCELLED'  and branch = 'ETRX' and admission_type = 'ACAP' and course='DSE'"));



          $d1 = count($userITDTESA); // IT sindhi  admitted  dte
          $d2 = count($userITDTESC); // IT sindhi  cancelled  dte
                
          $DITs = $d1-$d2; // IT  dte admitted sindhi 
                
          $d3 = count($userITACAPSA); // IT   admitted  acap sindhi
          $d4 = count($userITACAPSC); // IT  cancelled  acap sindhi
                
          $AITs = $d3-$d4; // IT  acap admitted Shindhi
                


          $d5 = count($userINSTDTESA); // INST sindhi admitted  dte
          $d6 = count($userINSTDTESC); // INST sindhi cancelled  dte
                
          $DINSTs = $d5-$d6; // INST dte admitted sindhi 
                
          $d7 = count($userINSTACAPSA); // INST   admitted  acap sindhi
          $d8 = count($userINSTACAPSC); // INST  cancelled  acap sindhi
                
          $AINSTs = $d7-$d8; // INST  acap admitted sindhi



          $d9 = count($userEXTCDTESA); // EXTC sindhi admitted  dte
          $d10 = count($userEXTCDTESC); // EXTC sindhi cancelled  dte
                
          $DEXTCs = $d9-$d10; // EXTC  dte admitted sindhi 
                
          $d11 = count($userEXTCACAPSA); // EXTC   admitted  acap sindhi
          $d12 = count($userEXTCACAPSC); // EXTC  cancelled  acap sindhi
                
          $AEXTCs = $d11-$d12;// EXTC  acap admitted sindhi

          

          $d13 = count($userETRXDTESA); // ETRX sindhi admitted  dte
          $d14 = count($userETRXDTESC); // ETRX sindhi cancelled  dte
                
          $DETRXs = $d13-$d14; // ETRX  dte admitted sindhi 
                
          $d15 = count($userETRXACAPSA); // ETRX   admitted acap sindhi
          $d16 = count($userETRXACAPSC); // ETRX  cancelled acap sindhi
                
          $AETRXs = $d15-$d16;// ETRX  acap admitted sindhi



          $d17 = count($userCMPNDTESA1); // CMPN sindhi shift 1 admitted  dte
          $d18 = count($userCMPNDTESC1); // CMPN sindhi shift 1 cancelled dte
                
          $DCMPN1s = $d17-$d18; // CMPN  dte admitted sindhi shift 1
             
          $d19 = count($userCMPNACAPSA1); // CMPN   admitted  shift 1 acap sindhi
          $d20 = count($userCMPNACAPSC1); // CMPN  cancelled  shift 1 acap sindhi
                
          $ACMPN1s = $d19-$d20;// CMPN  acap admitted sindhi shift 1

          $d21 = count($userITDTEOA); // IT sindhi admitted dte
          $d22 = count($userITDTEOC); // IT sindhi cancelled dte
                
          $DITo = $d21-$d22; // IT dte admitted open 
                
          $d23 = count($userITACAPOA); // IT admitted student acap sindhi
          $d24 = count($userITACAPOC); // IT cancelled student acap sindhi
                
          $AITo = $d23-$d24; // IT  acap admitted open
                


          $d25 = count($userINSTDTEOA); // INST open admitted dte
          $d26 = count($userINSTDTEOC); // INST open cancelled dte
                
          $DINSTo = $d25-$d26; // INST dte admitted open 
                
          $d27 = count($userINSTACAPOA); // INST admitted acap open
          $d28 = count($userINSTACAPOC); // INST cancelled acap open
                
          $AINSTo = $d27-$d28; // INST  acap admitted open



          $d29 = count($userEXTCDTEOA); // EXTC open admitted dte
          $d30 = count($userEXTCDTEOC); // EXTC open cancelled dte
                
          $DEXTCo = $d29-$d30; // EXTC  dte admitted open 
                
          $d31 = count($userEXTCACAPOA); // EXTC   admitted acap open
          $d32 = count($userEXTCACAPOC); // EXTC  cancelled acap open
                
          $AEXTCo = $d31-$d32;// EXTC  acap admitted open



          $d33 = count($userETRXDTEOA); // ETRX open admitted dte
          $d34 = count($userETRXDTEOC); // ETRX open cancelled dte
                
          $DETRXo = $d33-$d34; // ETRX  dte admitted open 
                
          $d35 = count($userETRXACAPOA); // ETRX   admitted acap open
          $d36 = count($userETRXACAPOC); // ETRX  cancelled acap open
                
          $AETRXo = $d35-$d36;// ETRX  acap admitted open



          $d37 = count($userCMPNDTEOA1); // CMPN open admitted dte
          $d38 = count($userCMPNDTEOC1); // CMPN open cancelled dte
                
          $DCMPN1o = $d37-$d38; // CMPN  dte admitted open 
                
          $d39 = count($userCMPNACAPOA1); // CMPN   admitted acap open
          $d40 = count($userCMPNACAPOC1); // CMPN  cancelled acap open
                
          $ACMPN1o = $d39-$d40;// CMPN  acap admitted open



          $d41 = count($userCMPNDTESA2); // CMPN sindhi shift 2 admitted  dte
          $d42 = count($userCMPNDTESC2); // CMPN sindhi shift 2 cancelled dte
                
          $DCMPN2s = $d41-$d42; // CMPN  dte admitted sindhi shift 2
                
          $d43 = count($userCMPNACAPSA2); // CMPN   admitted  shift 2 acap sindhi
          $d44 = count($userCMPNACAPSC2); // CMPN  cancelled  shift 2 acap sindhi
                
          $ACMPN2s = $d43-$d44;// CMPN  acap admitted sindhi shift 2


          $d45 = count($userCMPNDTEOA2); // CMPN open admitted shift 2 dte
          $d46 = count($userCMPNDTEOC2); // CMPN open cancelled shift 2 dte

          $DCMPN2o = $d45-$d46; // CMPN  dte admitted shift 2 open 
                
          $d47 = count($userCMPNACAPOA2); // CMPN   admitted acap shift 2 open
          $d48 = count($userCMPNACAPOC2); // CMPN  cancelled acap shift 2 open
                
          $ACMPN2o = $d47-$d48;// CMPN  acap admitted shift 2 open

                
                
                $remIT= 6-($DITs+$AITs+$DITo+$AITo);
                $fillIT= $DITs+$AITs+$DITo+$AITo;

                $remINST= 6-($DINSTs+$AINSTs+$DINSTo+$AINSTo);
                $fillINST= $DINSTs+$AINSTs+$DINSTo+$AINSTo;

                $remEXTC= 6-($DEXTCs+$AEXTCs+$DEXTCo+$AEXTCo);
                $fillEXTC= $DEXTCs+$AEXTCs+$DEXTCo+$AEXTCo;


                $remETRX= 6-($DETRXs+$AETRXs+$DETRXo+$AETRXo);
                $fillETRX= $DETRXs+$AETRXs+$DETRXo+$AETRXo;

                $remCMPN1= 6-($DCMPN1s+$ACMPN1s+$DCMPN1o+$ACMPN1o);
                $fillCMPN1= $DCMPN1s+$ACMPN1s+$DCMPN1o+$ACMPN1o;

                $remCMPN2= 6-($DCMPN2s+$ACMPN2s+$DCMPN2o+$ACMPN2o);
                $fillCMPN2= $DCMPN2s+$ACMPN2s+$DCMPN2o+$ACMPN2o;
                //return $DCMPN2o;


                $data = [];
                $data['remIT']=$remIT;
                $data['fillIT']=$fillIT;
                $data['remINST']=$remINST;
                $data['fillINST']=$fillINST;
                $data['remEXTC']=$remEXTC;
                $data['fillEXTC']=$fillEXTC;
                $data['remETRX']=$remETRX;
                $data['fillETRX']=$fillETRX;
                $data['remCMPN1']=$remCMPN1;
                $data['fillCMPN1']=$fillCMPN1;
                $data['remCMPN2']=$remCMPN2;
                $data['fillCMPN2']=$fillCMPN2;
                $data['DITs']=$DITs;
                $data['AITs']=$AITs;
                $data['DINSTs']=$DINSTs;
                $data['AINSTs']=$AINSTs;
                $data['DEXTCs']=$DEXTCs;
                $data['AEXTCs']=$AEXTCs;
                $data['DETRXs']=$DETRXs;
                $data['AETRXs']=$AETRXs;
                $data['DCMPN1s']=$DCMPN1s;
                $data['ACMPN1s']=$ACMPN1s;
                $data['DCMPN2s']=$DCMPN2s;
                $data['ACMPN2s']=$ACMPN2s;
                $data['DITo']=$DITo;
                $data['AITo']=$AITo;
                $data['DINSTo']=$DINSTo;
                $data['AINSTo']=$AINSTo;
                $data['DEXTCo']=$DEXTCo;
                $data['AEXTCo']=$AEXTCo; 
                $data['DETRXo']=$DETRXo;
                $data['AETRXo']=$AETRXo; 
                $data['DCMPN1o']=$DCMPN1o;
                $data['ACMPN1o']=$ACMPN1o; 
                $data['DCMPN2o']=$DCMPN2o;
                $data['ACMPN2o']=$ACMPN2o; 
                //return $data;
              
                return view('admin.adminDashboard')->with('data',$data);


               return view('admin.adminDashboard');
         }
            
    }
    else
            return redirect()->route('adminLogin');
    }


    public static function showAdminStudentIntake(Request $request)
    {
         $role =$request->session()->get('role', 'null');
    if ($role != 'null' && ($role=='Admin' || $role=='Super Admin') )
        return view('admin.adminStudentIntake');
    else
            return redirect()->route('adminLogin');
    }





    public static function showAdminVerifier(Request $request)
    {
         $email =$request->session()->get('email_id', 'null');
         $role =$request->session()->get('role', 'null');

    if ($email != 'null')
       { 
           
         if($role == "Staff")
        {
          $course = DB::table('admin_login')->select('course')->where('email_id',$email)->get();
        }
        else
        {
          $course =$request->session()->get('adminCourse',null);
          $array_object = [['course' => $course]];
           $course = json_decode(json_encode($array_object));
          
        }
        
        $array_object = [['trans_id' => null, 'total_amt' => null, 'trans_amt' => null, 'payment_mode' => null, 'trans_timestamp' => null]];
        $payments = json_decode(json_encode($array_object));
         $array_object = [['dte_id' => null,'name_on_marksheet'=>null,'gender' => null, 'date_of_birth' => null, 'place_of_birth_city' => null, 'place_of_birth_state' => null, 'caste_tribe' => null, 'permanent_city' => null, 'permanent_state' => null,'shift_allotted'=>null]];
        $user = json_decode(json_encode($array_object));
        $array_object = [['branch' => null]];
        $department = json_decode(json_encode($array_object));
        $array_object = [['status_to' => null]];
        $users = json_decode(json_encode($array_object));
      
        return view('admin.adminVerifier')->with('payments', $payments)->with('users',$users)->with('department',$department)->with('user',$user)->with('course',$course);
        }else
            return redirect()->route('adminLogin');
    }

    public static function AfterSearchAdminVerifier(Request $request)
    {
        $dte_id = $request->input('dteId');
        $email = $request->session()->get('email_id');
        $role =$request->session()->get('role');
       
        //return $dte_id;
        $department = DB::table('admission')->where('dte_id', 'LIKE', '%' . $dte_id . '%')->get();   

//return $department;
        if($role == "Staff")
        {
          $course3 = DB::table('admin_login')->select('course')->where('email_id',$email)->get();
          $course = $course3[0]->course;
            $event = DB::table('admin_login')->select('event')->where('email_id',$email)->get()[0]->event;
            
        }
        else
        {
          $course =$request->session()->get('adminCourse',null);
          $event =$request->session()->get('adminEvent',null);
        }
        $course1 = $course.$event;
//return $course1;
        $payments = DB::SELECT(DB::RAW("SELECT * FROM fees_transaction WHERE (dte_id LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E000') OR (dte_id  LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E00327' )OR (dte_id  LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E00328') OR (dte_id  LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E00329')  "));
      
        if($course == "MCA")
             $user = DB::table('mca_students')->where('dte_id', 'LIKE', '%' . $dte_id . '%')->get();
        if($course == "MEG")
                 $user = DB::table('me_students')->where('dte_id', 'LIKE', '%' . $dte_id . '%')->get();
        if($course == "FEG")
                 $user = DB::table('fe_students')->where('dte_id', 'LIKE', '%' . $dte_id . '%')->get();
         if($course == "DSE")
                 $user = DB::table('dse_students')->where('dte_id', 'LIKE', '%' . $dte_id . '%')->get();

        if($course == null)
        {
       $users = DB::select(DB::raw("SELECT event_to, status_to from status_details where dte_id LIKE '%".$dte_id."%' AND event_to = 'DTE' ORDER BY updated_at DESC LIMIT 1"));
        }
        else
        {
            $users = DB::select(DB::raw("SELECT event_to, status_to from status_details where dte_id LIKE '%".$dte_id."%' AND event_to = 'DTE' AND course LIKE '%".$course."%' ORDER BY updated_at DESC LIMIT 1"));
        }
       
        $srno=1;
        if($users == [])
        {
             $request->session()->flash('error', 'STUDENT RECORD NOT FOUND');
           return redirect()->route('adminVerifier');
        }
        else if (count($user) > 0 AND $users[0]->status_to == 'SUBMITTED') 
            {
                
                $request->session()->put('dte3',$dte_id);
                $d=$request->session()->get('dte3',$dte_id);
                return view('admin.adminVerifier')->with('user', $user)->with('srno', $srno)->with('payments', $payments)->with('department',$department)->with('users',$users)->with('course',$course);
            }   
        else
        {   
            //return count($user);
             //return $user;
             if($users[0]->status_to == 'ADMITTED')
             $request->session()->flash('error', 'STUDENT ALREADY ADMITTED');
            else if($users[0]->status_to == 'FORM_VERIFIED')
             $request->session()->flash('error', 'STUDENT ALREADY VERIFIED');
            else if($users[0]->status_to == 'DOCUMENT_VERIFIED')
                $request->session()->flash('error', 'STUDENT HAS ALREADY FINISHED THIS STAGE');
            else if($users[0]->status_to == 'INITIATED')
                {   
                $request->session()->flash('error', 'STUDENT HAS NOT SUBMITTED HIS FORM');
            }

            return redirect()->route('adminVerifier');
        }
    }

    public static function postAdminVerifier(Request $request)
    {
      
        $dte_id = $request->session()->pull('dte3');
        $role =$request->session()->get('role');
        $email =$request->session()->get('email_id', 'null');
        //return $email;
       // return $dte_id;
        if($role == "Staff")
        {
          $course = DB::table('admin_login')->select('course')->where('email_id',$email)->get()[0]->course;
          //return $course;
        }
        else
        {
          $course =$request->session()->get('adminCourse',null);
        }
        
        DB::select("call insert_status_details_form_verified('$dte_id','$course')");
        $request->session()->flash('error', $dte_id.' HAS SUCCESSFULLY BEEN VERIFIED');
        return redirect('adminVerifier');
    }




    public static function showAdminSeizer(Request $request)
    {
        $email =$request->session()->get('email_id', 'null');
        $role =$request->session()->get('role');
    if ($email != 'null')
        {
        if($role == "Staff")
        {
          $course = DB::table('admin_login')->select('course')->where('email_id',$email)->get();
        }
        else
        {
          $course =$request->session()->get('adminCourse',null);
        }
        $srno = null;
        $array_object = [['dte_id' => null,'name_on_marksheet'=>null,'x_board'=>null,'x_passing_year'=>null,'x_passing_month'=>null,'x_max_marks'=>null,'x_obtained_marks'=>null,'x_percentage'=>null,'x_school_name'=>null,'x_school_city'=>null,'x_school_state'=>null,'xii_passing_year'=>null,'xii_passing_month'=>null,'xii_board'=>null,'xii_max_marks'=>null,'xii_obtained_marks'=>null,'xii_percentage'=>null,'xii_college_name'=>null,'xii_college_city'=>null,'xii_college_state'=>null,'diploma_bsc_passing_year'=>null,'diploma_bsc_passing_month'=>null,'diploma_bsc_university'=>null ,'diploma_bsc_max_marks'=>null,'diploma_bsc_obtained_marks'=>null,'diploma_bsc_percentage'=>null,'diploma_branch'=>null,'diploma_bsc_college_name'=>null,'diploma_bsc_college_city'=>null,'diploma_bsc_college_state'=>null,'diploma_passing_year'=>null,'diploma_passing_month'=>null,'diploma_university'=>null ,'diploma_max_marks'=>null,'diploma_obtained_marks'=>null
            ,'diploma_aggr_max_sem6'=>null,'diploma_aggr_obt_sem6'=>null,'diploma_aggr_percent_sem6'=>null
            ,'diploma_percentage'=>null,'diploma_branch'=>null,'diploma_college_name'=>null,'diploma_college_city'=>null,'diploma_college_state'=>null,'degree_name'=>null,'degree_university'=>null,'degree_branch'=>null,'degree_passing_month'=>null,'degree_passing_year'=>null,'degree_college_name'=>null,'degree_college_city'=>null,'degree_college_state'=>null,'degree_aggr_max_marks'=>null,'degree_aggr_obt_marks'=>null,'degree_percentage'=>null,'degree_sem_1_max_marks'=>null,'degree_sem_1_obt_marks'=>null,'degree_sem_2_max_marks'=>null,'degree_sem_2_obt_marks'=>null,'degree_sem_3_max_marks'=>null,'degree_sem_3_obt_marks'=>null,'degree_sem_4_max_marks'=>null,'degree_sem_4_obt_marks'=>null,'degree_sem_5_max_marks'=>null,'degree_sem_5_obt_marks'=>null,'degree_sem_6_max_marks'=>null,'degree_sem_6_obt_marks'=>null,'degree_sem_7_max_marks'=>null,'degree_sem_7_obt_marks'=>null,'degree_sem_8_max_marks'=>null,'degree_sem_8_obt_marks'=>null,'degree_sem1_sgpa'=>null,'degree_sem2_sgpa'=>null,'degree_sem3_sgpa'=>null,'degree_sem4_sgpa'=>null,'degree_sem5_sgpa'=>null,'degree_sem6_sgpa'=>null,'degree_sem7_sgpa'=>null,'degree_sem8_sgpa'=>null,'is_new_or_old'=>'P','degree_final_cgpa'=>null]];
        $user = json_decode(json_encode($array_object));
        $array_object = [['branch' => null]];
        $department = json_decode(json_encode($array_object));
        $array_object = [['status_to' => null]];
        $users = json_decode(json_encode($array_object));
        
        //return $course;
        return view('admin.adminSeizer')->with('user', $user)->with('srno', $srno)->with('department',$department)->with('users',$users)->with('course',$course);

        }
        
        else
            return redirect()->route('adminLogin');
    }

   public static function AfterSearchAdminSeizer(Request $request)
    {

        $dte_id = $request->input('dteId');
       
        $email = $request->session()->get('email_id');
        $role =$request->session()->get('role');
        $srno = 1;
        
        $department = DB::table('admission')->where('dte_id', 'LIKE', '%' . $dte_id . '%')->get();   

        if($role == "Staff")
        {
          $course1 = DB::table('admin_login')->select('course')->where('email_id',$email)->get();
          $course = $course1[0]->course;
        }
        else
        {
          $course =$request->session()->get('adminCourse',null);
        }
        //return $dte_id;
        if($course == "MEG")
            $user = DB::table('me_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
        if($course == "MCA")
              $user = DB::table('mca_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
        if($course == "FEG")
              $user = DB::table('fe_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
         if($course == "DSE")
              $user = DB::table('dse_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
         //return $user; 
          $request->session()->put('seizedcourse',$course);
        if($course == null)
        {
          $users = DB::select(DB::raw("SELECT event_to, status_to from status_details where dte_id LIKE '%".$dte_id."%' AND event_to = 'ACAP' ORDER BY updated_at DESC LIMIT 1"));
        }
        else
        {
            $users = DB::select(DB::raw("SELECT event_to, status_to from status_details where dte_id LIKE '%".$dte_id."%' AND event_to = 'ACAP' AND course LIKE '%".$course."%' ORDER BY updated_at DESC LIMIT 1"));
        }
       // return $user;
        if($users == [] || $user == [])
          {
            $request->session()->flash('error', 'STUDENT RECORD NOT FOUND');
             return redirect()->route('adminSeizer');
          }
        //return $users;
        else if(count($user) > 0 AND $users[0]->status_to == 'SUBMITTED')
            {
                $request->session()->put('dte',$dte_id);
                return view('admin.adminSeizer')->with('user',$user)->with('srno', $srno)->with('department',$department)->with('users',$users)->with('course',$course);
            }

        else
            {
               /* if($users == '[]')
                     $request->session()->flash('error', 'STUDENT RECORD NOT FOUND');*/
                 if($users[0]->status_to == 'ADMITTED')
                     $request->session()->flash('error', 'STUDENT ALREADY ADMITTED');
                else if($users[0]->status_to == 'SEIZED')
                     $request->session()->flash('error', 'STUDENT ALREADY SEIZED');
                else if($users[0]->status_to == 'INITIATED')
                        $request->session()->flash('error', 'STUDENT HAS NOT SUBMITTED HIS FORM');
                
                return redirect()->route('adminSeizer');
            }
    }

    public static function postAdminSeizer(Request $request)
    {
        //return $id;
        if ($request->session()->has('dte')) 
        {
            $dte_id = $request->session()->pull('dte');
            $course = $request->session()->pull('seizedcourse');
           // return $course;
            if($course == null || $dte_id == null)
            {
                $request->session()->flash('error','Some error occured');  
                
            }
            else
            { 
               // return $dte_id;
              DB::select("call insert_status_details_seized('$dte_id','$course')");
              if($course == "MCA"){
              $category = DB::table('mca_students')->select('category','acap_category','university_type')->where('dte_id',$dte_id)->get();
              $amount =  DB::table('fees_structure')->select('amt')->where('fee_category','ACAP')->where('board',$category[0]->university_type)->where('course',$course)->get();
            }
              
              if($course == "FEG"){
              $category = DB::table('fe_students')->select('category','acap_category','xii_board')->where('dte_id',$dte_id)->get(); 

                    if($category[0]->xii_board=='CBSE' || $category[0]->xii_board=='Maharashtra board' || $category[0]->xii_board=='ICSE'){
                    $amount =  DB::table('fees_structure')->select('amt')->where('fee_category','GENERAL')->where('board',$category[0]->xii_board)->where('course',$course)->get();
                    // return $category[0]->xii_board;
                    // return $amount[0]->amt;
                  }else{
                      $amount =  DB::table('fees_structure')->select('amt')->where('fee_category','GENERAL')->where('board','OTHER')->where('course',$course)->get();
                    // return $course;
                    // return $amount[0]->amt;
            }
          }

            if($course == "DSE"){
              $category = DB::table('dse_students')->select('category','acap_category')->where('dte_id',$dte_id)->get();
                $amount =  DB::table('fees_structure')->select('amt')->where('fee_category','ACAP')->where('course',$course)->get();
            }

              if($course == "MEG"){
              $category = DB::table('me_students')->select('category','acap_category','university_type')->where('dte_id',$dte_id)->get();
             $amount =  DB::table('fees_structure')->select('amt')->where('fee_category','ACAP')->where('board',$category[0]->university_type)->where('course',$course)->get();
            }

// return $category;
 // return $amount;
              if($amount == [])
                {
   $amount =  DB::table('fees_structure')->select('amt')->where('fee_category',$category[0]->acap_category)->where('course',$course)->get();
                }
// return $amount;
   // $count = DB::select(DB::raw("SELECT count from admission where dte_id LIKE '%".$dte_id."%' ORDER BY updated_at DESC LIMIT 1"));
   // //$count =$count[0]->count;
            //  return $amount;
   //return $count;
              date_default_timezone_set("Asia/Kolkata");             
              $adm = new admission;
              $adm->dte_id = $dte_id;
              $adm->course = $course;
              $adm->status = "INCOMPLETE";
              $adm->admission_type = "ACAP";
              $adm->total_amt = $amount[0]->amt;
              $adm->granted_amt = $amount[0]->amt;
              $adm->paid_amt = 0;
             // $adm->count=$count+1;
              $adm->fees_category = $category[0]->category;
              $adm->shift_allotted = "-";
              $adm->balance_amt = $amount[0]->amt;
              $adm->admission_category = "ACAP";
              $adm->created_at = date("Y-m-d H:i:s");
              $adm->save();

              $request->session()->flash('error', $dte_id.' HAS SUCCESSFULLY BEEN SEIZED');
            }
            return redirect()->route('adminSeizer');
         }
         else
         {
            return redirect()->route('adminSeizer');  
         }
    }


    public static  function showAdminDocumentVerifier(Request $request)
    {
        $email =$request->session()->get('email_id', 'null');
       $role =$request->session()->get('role');
     if ($email != 'null')
     {
        
        if($role == "Staff")
        {
          $course = DB::table('admin_login')->select('course')->where('email_id',$email)->get();
          $course1= $course[0]->course;
          
        }
        else
        {
          $course1 =$request->session()->get('adminCourse');
        }

        $array_object = [['dte_id'=> null,'fc_confirmation_receipt' => 'No', 'fc_confirmation_receipt_path' => null, 'dte_allotment_letter' => 'No', 'dte_allotment_letter_path' => null, 'arc_ackw_receipt' => 'No', 'arc_ackw_receipt_path' => null, 'cet_result' => 'No', 'cet_result_path' => null,'jee_result' => 'No', 'jee_result_path' => null,'gate_result'=>'No','gate_result_path'=>null, 'ssc_marksheet' => 'No','ssc_marksheet_path' => null,  'hsc_diploma_marksheet' => 'No','hsc_diploma_marksheet_path' => null,'hsc_marksheet' => 'No','hsc_marksheet_path' => null,'hsc_leaving_certi' => 'No','hsc_leaving_certi_path' => null,'hsc_passing_certi' => 'No','hsc_passing_certi_path' => null,'degree_leaving_tc' => 'No', 'degree_leaving_tc_path' => null, 'degree_leaving_tc_path' => null,  'first_year_marksheet' => 'No', 'first_year_marksheet_path' => null, 'second_year_marksheet' => 'No', 'second_year_marksheet_path' => null, 'third_year_marksheet' => 'No', 'third_year_marksheet_path' => null,'fourth_year_marksheet' => 'No','fourth_year_marksheet_path' => null, 'migration_certi' => 'No', 'migration_certi_path' => null, 'birth_certi' => 'No', 'birth_certi_path' => null, 'domicile' => 'No', 'domicile_path' => null, 'aadhar' => 'No', 'aadhar_path' => null,'proforma_o' => 'No', 'proforma_o_path' => null, 'retention' => 'No', 'retention_path' => null, 'minority_affidavit' => 'No', 'minority_affidavit_path' => null, 'gap_certi' => 'No', 'gap_certi_path' => null, 'community_certi' => 'No', 'community_certi_path' => null, 'caste_certi' => 'No', 'caste_certi_path' => null, 'convocation_passing_certi' => 'No', 'convocation_passing_certi_path' => null,'caste_validity_certi' => 'No', 'caste_validity_certi_path' => null, 'non_creamy_layer_certi' => 'No', 'non_creamy_layer_certi_path' => null, 'proforma_a_b1_b2' => 'No', 'proforma_a_b1_b2_path' => null, 'proforma_g1_g2' => 'No', 'proforma_g1_g2_path' => null, 'proforma_v' => 'No', 'proforma_v_path' => null, 'proforma_u' => 'No', 'proforma_u_path' => null, 'income_certi' => 'No', 'income_certi_path' => null, 'proforma_c_d_e' => 'No', 'proforma_c_d_e_path' => null, 'anti_ragging_affidavit' => 'No', 'anti_ragging_affidavit_path' => null, 'proforma_j_k_l' => 'No', 'proforma_j_k_l_path' => null, 'medical_certi' => 'No', 'medical_certi_path' => null, 'photo' => 'No','photo_path' => null, 'signature' => 'No', 'signature_path' => null]];
        $users = json_decode(json_encode($array_object));
        $hash = null;
        
      
       // return $users;
        $data=[];
        $data['users']=$users;
        $data['hash']=$hash;
        $data['course'] = $course1;
        //return $course1;
       
        if ($course1=='MCA') {
        return view('admin.adminDocumentVerifier',$data);
        }
        elseif ($course1=='FEG') {
        return view('admin.adminDocumentVerifierFE',$data);
        }
        elseif ($course1== 'DSE') {
          return view('admin.adminDocumentVerifierDSE',$data);
        }
        elseif($course1 == 'MEG'){
          return view('admin.adminDocumentVerifierMEG',$data);
      }
        else{
            return redirect()->route('adminLogin');}
    
    }
  }
    
     public static  function showAdminDocumentVerifierAcap(Request $request)
    {
   
        $role =$request->session()->get('role');
        $email =$request->session()->get('email_id');
       if($role == "Staff")
        {
          $course = DB::table('admin_login')->select('course')->where('email_id',$email)->get();
        }
        else
        {
          $course =$request->session()->get('adminCourse');
           $array_object = [['course' => $course]];
        $course = json_decode(json_encode($array_object));
        }
        
        $dte_id =$request->session()->get('dte', 'null');
        if($course[0]->course=='MCA')
                $users = DB::table('mca_students')->where('dte_id',$dte_id)->get();
        
        if($course[0]->course =='MEG')
                $users = DB::table('me_students')->where('dte_id',$dte_id)->get();

        if($course[0]->course =='FEG')
                $users = DB::table('fe_students')->where('dte_id',$dte_id)->get();
        if($course[0]->course =='DSE')
                $users = DB::table('dse_students')->where('dte_id',$dte_id)->get();
                
            $course=  $course[0]->course;

          if($course == null)
        {
          $user = DB::select(DB::raw("SELECT event_to, status_to from status_details where dte_id LIKE '%".$dte_id."%' AND event_to = 'ACAP' ORDER BY updated_at DESC LIMIT 1"));
        }
        else
        {
            $user = DB::select(DB::raw("SELECT event_to, status_to from status_details where dte_id LIKE '%".$dte_id."%' AND event_to = 'ACAP' AND course LIKE '%".$course."%' ORDER BY updated_at DESC LIMIT 1"));
        }
      


       if($users == [] || $user == [])
        {
            
            $request>session()->flash('error','Record Not Found');
            return redirect()->route('adminSeizer');
        }
        
        
         else if(count($users) > 0 AND ($user[0]->status_to == 'SUBMITTED' AND $user[0]->event_to = "ACAP" )) 
            {
                 $request->session()->put('dte1',$dte_id);
                   $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
                 $hash = $hash[0]->hash;



                 if($course=='MCA'){
               return view('admin.adminDocumentVerifierAcap')->with('hash',$hash)->with('users',$users)->with('course',$course);

               }
        
        if($course =='MEG'){
                      return view('admin.adminDocumentVerifierAcapMEG')->with('hash',$hash)->with('users',$users)->with('course',$course);

        }
        if($course =='FEG'){
                        return view('admin.adminDocumentVerifierAcapFE')->with('hash',$hash)->with('users',$users)->with('course',$course);

                            }

        if($course =='DSE'){
         // return 'hello';
                        return view('admin.adminDocumentVerifierAcapDSE')->with('hash',$hash)->with('users',$users)->with('course',$course);

                            }

        else
            {
             
                 if($user[0]->status_to == 'DOCUMENT_VERIFIED')
                     $request->session()->flash('error', 'STUDENT ALREADY VERIFIED DOCUMENT');
                 else if($user[0]->status_to == 'SUBMITTED')
                        $request->session()->flash('error', 'STUDENT HAS NOT VERIRIED  HIS FORM');
                else if($user[0]->status_to == 'INITIATED')
                        $request->session()->flash('error', 'STUDENT HAS NOT SUBMITTED HIS FORM');
                
                return redirect()->route('adminSeizer');
            }
        
        
    }
    }

    

    public static function adminSearchDocumentVerifier(Request $request)
    {
      $email =$request->session()->get('email_id', 'null');
      $role =$request->session()->get('role');

     if ($email != 'null')
     {
         
         if($role == "Staff")
        {
          $course = DB::table('admin_login')->select('course')->where('email_id',$email)->get();
          
        }
        else
        {
          $course =$request->session()->get('adminCourse');
           $array_object = [['course' => $course]];
             $course = json_decode(json_encode($array_object));
        }
        $dte_id =$request->input('dteId');
        
        
        if($course[0]->course=='MCA')
                $users = DB::table('mca_students')->where('dte_id',$dte_id)->get();
        
        if($course[0]->course =='MEG')
                $users = DB::table('me_students')->where('dte_id',$dte_id)->get();
        if($course[0]->course =='FEG')
                $users = DB::table('fe_students')->where('dte_id',$dte_id)->get();
        if($course[0]->course =='DSE')
          //return $course[0]->course;
                $users = DB::table('dse_students')->where('dte_id',$dte_id)->get();
            //return $users;       
        
        $course=$course[0]->course;
        // return $course;
          if($course == null)
        {
          $user = DB::select(DB::raw("SELECT event_to, status_to from status_details where dte_id LIKE '%".$dte_id."%' AND event_to = 'DTE' ORDER BY updated_at DESC LIMIT 1"));
        }
        else
        {
            $user = DB::select(DB::raw("SELECT event_to, status_to from status_details where dte_id LIKE '%".$dte_id."%' AND event_to = 'DTE' AND course LIKE '%".$course."%' ORDER BY updated_at DESC LIMIT 1"));
        }
 

        if($users == [] || $user == [])
        {
          
            
            $request>session()->flash('error','Record Not Found');
           // return$course[0]->course;
        if($course[0]->course=='MCA')
                 return redirect()->route('adminDocumentVerifier');        
        if($course[0]->course =='MEG')
                 return redirect()->route('adminDocumentVerifier');
        if($course[0]->course =='FEG')
                 return redirect()->route('adminDocumentVerifier');
        if($course[0]->course =='DSE')
                 return redirect()->route('adminDocumentVerifier');        
            
        }
        
        
         else if(count($users) > 0 AND ($user[0]->status_to == 'FORM_VERIFIED' AND $user[0]->event_to = "DTE" )) 
            {
                 $request->session()->put('dte1',$dte_id);
                   $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
                 $hash = $hash[0]->hash;

                 if($course=='MCA')
                 return view('admin.adminDocumentVerifier')->with('hash',$hash)->with('users',$users)->with('course',$course);        
        if($course =='MEG')
                 return view('admin.adminDocumentVerifierMEG')->with('hash',$hash)->with('users',$users)->with('course',$course);
        if($course =='FEG')
                 return view('admin.adminDocumentVerifierFE')->with('hash',$hash)->with('users',$users)->with('course',$course);
        if($course =='DSE')
                 return view('admin.adminDocumentVerifierDSE')->with('hash',$hash)->with('users',$users)->with('course',$course);


                // return view('admin.adminDocumentVerifier')->with('hash',$hash)->with('users',$users)->with('course',$course);
            }

        else
            {
              //  return $user;
                 if($user[0]->status_to == 'DOCUMENT_VERIFIED')
                     $request->session()->flash('error', 'STUDENT ALREADY VERIFIED DOCUMENT');
                 else if($user[0]->status_to == 'SUBMITTED')
                        $request->session()->flash('error', 'STUDENT HAS NOT VERIRIED  HIS FORM');
                else if($user[0]->status_to == 'INITIATED')
                        $request->session()->flash('error', 'STUDENT HAS NOT SUBMITTED HIS FORM');
                

        if($course=='MCA')
                 return redirect()->route('adminDocumentVerifier');        
        if($course =='MEG')
                 return redirect()->route('adminDocumentVerifier');
        if($course =='FEG')
                 return redirect()->route('adminDocumentVerifier');
        if($course =='DSE')
                 return redirect()->route('adminDocumentVerifier');        
        

               // return redirect()->route('adminDocumentVerifier');
            }
        
    
      }
        else
            return redirect()->route('adminLogin');
      
    }


    public static function doc_verify(Request $request)
    {
       $dte_id = $request->session()->pull('dte1');
        $role =$request->session()->get('role');
         $email =$request->session()->get('email_id', 'null');
         
     if ($email != 'null')
     {
       
         if($role == "Staff")
        {
          $course = DB::table('admin_login')->select('course')->where('email_id',$email)->get()[0]->course;
          
        }
        else
        {
          $course =$request->session()->get('adminCourse',null);
        }
      //return $course;
      //$course = $request->session()->get('adminCourse');
       
      if($course=='MCA')
            $users = DB::table('mca_students')->where('dte_id',$dte_id)->get();
        
       if($course=='MEG')
        $users = DB::table('me_students')->where('dte_id',$dte_id)->get();

      if($course=='FEG')
        $users = DB::table('fe_students')->where('dte_id',$dte_id)->get();

      if($course=='DSE')
        $users = DB::table('dse_students')->where('dte_id',$dte_id)->get();


                    if($users != '[]')
                      {
                        DB::select("call insert_status_details_document_verified('$dte_id','$course')");
                         $request->session()->flash('error', 'Document is Verified');
                         
                         return redirect()->route('adminDocumentVerifier'); 
                      }
                      else
                      {
                         return redirect()->route('adminDocumentVerifier');  
                      }
     }
     
     else
     {
         return redirect()->route('adminLogout');
     }
     
      
    }

    public static  function verifyAdminDocumentVerifierAcap(Request $request)
    {
        $email =$request->session()->get('email_id', 'null');
        $course = $request->session()->get('course','null');
       
        if($course == 'null')
          $course = $request->session()->get('adminCourse');
     if ($email != 'null')
     {
        $dte_id=$request->session()->get('dte'); 
   
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


        if($request->hasFile('photo'))
      {
         
         $rules = ['photo' => 'mimes:jpg,png,jpeg'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('photo_error', 'Please Upload Only JPG or PNG type image');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        $extension = $request->file('photo')->getClientOriginalExtension();
        $filenametostore = 'photo'.$dte_id.'.'.$extension;
        //Storage::disk('public_uploads')->put($destinationPath, $request->file('photo'));
       // $request->image->move(public_path('/uploads/').$destinationPath, $filenametostore);
        //$path = $destinationPath.'/'.$filenametostore;
       /* $image = Image::make($request->file('photo'))->fit(400, 200);
        $image->save();*/
        $path =  $request->file('photo')->storeAs($destinationPath, $filenametostore,'public_uploads');
        //return $path;
          $mca_students->photo_path = $filenametostore;
           $mca_students->photo='Yes';
        $mca_students->save();
      }

      
        if($request->hasFile('signature'))
      {
        $rules = ['signature' => 'mimes:jpg,png,jpeg'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('signature_error', 'Please Upload Only JPG or PNG type image');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        $extension = $request->file('signature')->getClientOriginalExtension();
        $filenametostore = 'signature'.$dte_id.'.'.$extension;
        $path = $request->file('signature')->storeAs($destinationPath, $filenametostore,'public_uploads');
          $mca_students->signature_path = $filenametostore;
           $mca_students->signature='Yes';
        $mca_students->save();
      }

      
        if($request->hasFile('fc_confirmation_receipt'))
      {
        $rules = ['fc_confirmation_receipt' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('fc_confirmation_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        $extension = $request->file('fc_confirmation_receipt')->getClientOriginalExtension();
        $filenametostore = 'fc_confirmation_receipt'.$dte_id.'.'.$extension;
        $path = $request->file('fc_confirmation_receipt')->storeAs($destinationPath, $filenametostore,'public_uploads');
          $mca_students->fc_confirmation_receipt_path =$filenametostore;
           $mca_students->fc_confirmation_receipt='Yes';
        $mca_students->save();
      }

      
          if($request->hasFile('dte_allotment_letter'))
      {
        $rules = ['dte_allotment_letter' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('dte_allotment_letter_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        $extension = $request->file('dte_allotment_letter')->getClientOriginalExtension();
        $filenametostore = 'dte_allotment_letter_'.$dte_id.'.'.$extension;
   
        $path = $request->file('dte_allotment_letter')->storeAs($destinationPath, $filenametostore,'public_uploads');
              $mca_students->dte_allotment_letter_path = $filenametostore;
               $mca_students->dte_allotment_letter='Yes';
        $mca_students->save();
      }

      
    if($request->hasFile('arc_ackw_receipt'))
      {
        $rules = ['arc_ackw_receipt' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('arc_ackw_receipt_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        $extension = $request->file('arc_ackw_receipt')->getClientOriginalExtension();
        $filenametostore = 'arc_ackw_receipt_'.$dte_id.'.'.$extension;
   
        $path = $request->file('arc_ackw_receipt')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $mca_students->arc_ackw_receipt_path = $filenametostore;
        $mca_students->arc_ackw_receipt='Yes';
        $mca_students->save();
      }

  
  if($request->hasFile('cet_result'))
      {
        $rules = ['cet_result' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('cet_result_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        $extension = $request->file('cet_result')->getClientOriginalExtension();
        $filenametostore = 'cet_result_'.$dte_id.'.'.$extension;
   
        $path = $request->file('cet_result')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $mca_students->cet_result_path = $filenametostore;
        $mca_students->cet_result = 'Yes';
        $mca_students->save();
      }


      
        if($request->hasFile('ssc_marksheet')) 
        {
        
          $rules = ['ssc_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('ssc_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
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
        
              //////echo $path; //
      
      }

      
      if($request->hasFile('hsc_marksheet')) 
      {
        $rules = ['hsc_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('hsc_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('hsc_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'hsc_diploma_marksheet'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('hsc_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $mca_students->hsc_diploma_marksheet_path = $filenametostore;
         $mca_students->hsc_diploma_marksheet='Yes';
        $mca_students->save();
        
      ////echo $path; //
      
      }

      
      if($request->hasFile('degree_leaving_tc')) 
      {
        $rules = ['degree_leaving_tc' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('degree_leaving_tc_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('degree_leaving_tc')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'degree_leaving_tc_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('degree_leaving_tc')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $mca_students->degree_leaving_tc_path = $filenametostore;
              $mca_students->degree_leaving_tc = 'Yes';
        $mca_students->save();
        
      ////echo $path; //
      
      }


      
      if($request->hasFile('first_year_marksheet')) 
      {
        $rules = ['first_year_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('first_year_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('first_year_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'first_year_marksheet_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('first_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $mca_students->first_year_marksheet_path = $filenametostore;
           $mca_students->first_year_marksheet = 'Yes';
        $mca_students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('second_year_marksheet')) 
      {
        $rules = ['second_year_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('second_year_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('second_year_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'second_year_marksheet_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('second_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $mca_students->second_year_marksheet_path = $filenametostore;
                $mca_students->second_year_marksheet='Yes';
        $mca_students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('third_year_marksheet')) 
      {
        $rules = ['third_year_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('third_year_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('third_year_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'third_year_marksheet_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('third_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $mca_students->third_year_marksheet_path =$filenametostore;
            $mca_students->third_year_marksheet='Yes';
        $mca_students->save();
        
      //////echo $path; //
      
      }

      
      

      
      if($request->hasFile('convocation_passing_certi')) 
      {
        $rules = ['convocation_passing_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('convocation_passing_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('convocation_passing_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'convocation_passing_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('convocation_passing_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $mca_students->convocation_passing_certi_path = $filenametostore;
                $mca_students->convocation_passing_certi='Yes';
        $mca_students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('migration_certi')) 
      {
        $rules = ['migration_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('migration_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('migration_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'migration_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('migration_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $mca_students->migration_certi_path = $filenametostore;
                $mca_students->migration_certi='Yes';
        $mca_students->save();
      //////echo $path; //
      
      }


      
      if($request->hasFile('birth_certi')) 
      {
        $rules = ['birth_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('birth_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('birth_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'birth_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('birth_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $mca_students->birth_certi_path = $filenametostore;
                $mca_students->birth_certi='Yes';
        $mca_students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('domicile')) 
      {
        $rules = ['domicile' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('domicile_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('domicile')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'domicile_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('domicile')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $mca_students->domicile_path =$filenametostore;
                $mca_students->domicile='Yes';
        $mca_students->save();
        
      //////echo $path; //
      
      }

     
      if($request->hasFile('proforma_o')) 
      {
        $rules = ['proforma_o' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('proforma_o_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('proforma_o')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'proforma_o_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('proforma_o')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $mca_students->proforma_o_path = $filenametostore;
                $mca_students->proforma_o='Yes';
        $mca_students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('retention')) 
      {
        $rules = ['retention' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('retention_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('retention')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'retention_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('retention')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $mca_students->retention_path = $filenametostore;
               $mca_students->retention='Yes';
        $mca_students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('minority_affidavit')) 
      {
        $rules = ['minority_affidavit' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('minority_affidavit_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('minority_affidavit')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'minority_affidavit_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('minority_affidavit')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $mca_students->minority_affidavit_path = $filenametostore;
                $mca_students->minority_affidavit='Yes';
        $mca_students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('gap_certi')) 
      {
        $rules = ['gap_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('gap_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('gap_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'gap_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('gap_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $mca_students->gap_certi_path =$filenametostore;
                $mca_students->gap_certi='Yes';
        $mca_students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('community_certi')) 
      {
        $rules = ['community_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('community_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('community_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'community_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('community_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $mca_students->community_certi_path = $filenametostore;
                $mca_students->community_certi='Yes';
        $mca_students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('caste_certi')) 
      {
        $rules = ['caste_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('caste_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('caste_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'caste_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('caste_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $mca_students->caste_certi_path =$filenametostore;
                $mca_students->caste_certi='Yes';
        $mca_students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('caste_validity_certi')) 
      {
        $rules = ['caste_validity_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('caste_validity_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('caste_validity_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'caste_validity_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('caste_validity_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $mca_students->caste_validity_certi_path = $filenametostore;
               $mca_students->caste_validity_certi='Yes';
        $mca_students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('non_creamy_layer_certi')) 
      {
        $rules = ['non_creamy_layer_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('non_creamy_layer_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('non_creamy_layer_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'non_creamy_layer_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('non_creamy_layer_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $mca_students->non_creamy_layer_certi_path = $filenametostore;
                $mca_students->non_creamy_layer_certi='Yes';
        $mca_students->save();
      //////echo $path; //
      
      }

      
      

      
      if($request->hasFile('proforma_a_b1_b2')) 
      {
        $rules = ['proforma_a_b1_b2' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('proforma_a_b1_b2_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('proforma_a_b1_b2')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'proforma_a_b1_b2_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('proforma_a_b1_b2')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $mca_students->proforma_a_b1_b2_path = $filenametostore;
                $mca_students->proforma_a_b1_b2='Yes';
        $mca_students->save();
      //////echo $path; //
      
      }

      
      
      
      if($request->hasFile('income_certi')) 
      {
        $rules = ['income_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('income_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('income_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'income_certi_'.$dte_id.'.'.$extension;
        
        //Upload file
        $path = $request->file('income_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
      $mca_students->income_certi_path = $filenametostore;
            $mca_students->income_certi='Yes';
        $mca_students->save();
      }

      
      if($request->hasFile('proforma_c_d_e')) 
      {
        $rules = ['proforma_c_d_e' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('proforma_c_d_e_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        $extension = $request->file('proforma_c_d_e')->getClientOriginalExtension();
        $filenametostore = 'proforma_c_d_e'.$dte_id.'.'.$extension;
        $path = $request->file('proforma_c_d_e')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $mca_students->proforma_c_d_e_path = $filenametostore;
                $mca_students->proforma_c_d_e='Yes';
        $mca_students->save();
      }

      
      if($request->hasFile('medical_certi')) 
      {
        $rules = ['medical_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('medical_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        $extension = $request->file('medical_certi')->getClientOriginalExtension();
        $filenametostore = 'medical_certi_'.$dte_id.'.'.$extension;
        $path = $request->file('medical_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $mca_students->medical_certi_path = $filenametostore;
                $mca_students->medical_certi='Yes';
        $mca_students->save();
      }

      
      if($request->hasFile('anti_ragging_affidavit')) 
      {
        $rules = ['anti_ragging_affidavit' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('anti_ragging_affidavit_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        $extension = $request->file('anti_ragging_affidavit')->getClientOriginalExtension();
        $filenametostore = 'anti_ragging_affidavit'.$dte_id.'.'.$extension;
        $path = $request->file('anti_ragging_affidavit')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $mca_students->anti_ragging_affidavit_path = $filenametostore;
                $mca_students->anti_ragging_affidavit='Yes';
        $mca_students->save();
      }

        $users = DB::table('mca_students')->select('dte_id','fc_confirmation_receipt','fc_confirmation_receipt_path','dte_allotment_letter','dte_allotment_letter_path','arc_ackw_receipt','arc_ackw_receipt_path','cet_result','cet_result_path','ssc_marksheet','ssc_marksheet_path','hsc_diploma_marksheet','hsc_diploma_marksheet_path','degree_leaving_tc','degree_leaving_tc_path','first_year_marksheet','first_year_marksheet_path','second_year_marksheet','second_year_marksheet_path','third_year_marksheet','third_year_marksheet_path','migration_certi','migration_certi_path','birth_certi','birth_certi_path','domicile','domicile_path','proforma_o','proforma_o_path','retention','retention_path','minority_affidavit','minority_affidavit_path','gap_certi','gap_certi_path','community_certi','community_certi_path','caste_certi','caste_certi_path','caste_validity_certi','caste_validity_certi_path','non_creamy_layer_certi','non_creamy_layer_certi_path','proforma_a_b1_b2','proforma_a_b1_b2_path','income_certi','convocation_passing_certi','convocation_passing_certi_path','income_certi_path','proforma_c_d_e','proforma_c_d_e_path','anti_ragging_affidavit','anti_ragging_affidavit_path','medical_certi','medical_certi_path','photo','photo_path','signature','signature_path')->where('dte_id', $dte_id)->get();
        $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        $hash = $hash[0]->hash;


        $data=[];
        $data['users']=$users;
        $data['hash'] = $hash;
        $data['course'] = $course;
      
        return view('admin.adminDocumentVerifierAcap',$data);

      }
        else
            return redirect()->route('adminLogin');
    
    }





public static  function verifyAdminDocumentVerifierAcapFE(Request $request)
    {
        $email =$request->session()->get('email_id', 'null');
        $course = $request->session()->get('course','null');
       
        if($course == null)
          $course = $request->session()->get('adminCourse');
         // return $course;
         
     if ($email != 'null')
     {
        $dte_id=$request->session()->get('dte1');
       //return $dte_id;
      $use = DB::table('student_login')->select('hash')->where('dte_id', $dte_id)->get();
      $destinationPath = $dte_id.'_'.$use[0]->hash;
      //  $abc=(int)$request->hasFile('ssc_marksheet');
       
      
      if($course == "FEG")
      {
        $students = new fe_students;
        if(DB::table('fe_students')->where('dte_id', $dte_id)->exists()) 
          { 
           $students  = fe_students::find($dte_id);
          
          }
          else
          {
            $students->dte_id = $dte_id;
          }
      }
        
      // if($course == "DSE")
      // {
      //   $students = new dse_students;
      //   if(DB::table('dse_students')->where('dte_id', $dte_id)->exists()) 
      //     { 
      //      $students  = dse_students::find($dte_id);
          
      //     }
      //     else
      //     {
      //       $students->dte_id = $dte_id;
      //     }
      // }
        



        if($request->hasFile('photo'))
      {
         
         $rules = ['photo' => 'mimes:jpg,png,jpeg'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('photo_error', 'Please Upload Only JPG or PNG type image');
          return redirect()->route('adminDocumentVerifierAcapFE');
         }
        $extension = $request->file('photo')->getClientOriginalExtension();
        $filenametostore = 'photo'.$dte_id.'.'.$extension;
        //Storage::disk('public_uploads')->put($destinationPath, $request->file('photo'));
       // $request->image->move(public_path('/uploads/').$destinationPath, $filenametostore);
        //$path = $destinationPath.'/'.$filenametostore;
       /* $image = Image::make($request->file('photo'))->fit(400, 200);
        $image->save();*/
        $path =  $request->file('photo')->storeAs($destinationPath, $filenametostore,'public_uploads');
        //return $path;
          $students->photo_path = $filenametostore;
           $students->photo='Yes';
        $students->save();
      }

      
        if($request->hasFile('signature'))
      {
        $rules = ['signature' => 'mimes:jpg,png,jpeg'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('signature_error', 'Please Upload Only JPG or PNG type image');
          return redirect()->route('adminDocumentVerifierAcapFE');
         }
        $extension = $request->file('signature')->getClientOriginalExtension();
        $filenametostore = 'signature'.$dte_id.'.'.$extension;
        $path = $request->file('signature')->storeAs($destinationPath, $filenametostore,'public_uploads');
          $students->signature_path = $filenametostore;
           $students->signature='Yes';
        $students->save();
      }

      
        if($request->hasFile('fc_confirmation_receipt'))
      {
          //return "hello";
        $rules = ['fc_confirmation_receipt' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('fc_confirmation_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapFE');
         }
        $extension = $request->file('fc_confirmation_receipt')->getClientOriginalExtension();
        $filenametostore = 'fc_confirmation_receipt'.$dte_id.'.'.$extension;
        $path = $request->file('fc_confirmation_receipt')->storeAs($destinationPath, $filenametostore,'public_uploads');
          $students->fc_confirmation_receipt_path =$filenametostore;
           $students->fc_confirmation_receipt='Yes';
        $students->save();
      }

      
          
  
  if($request->hasFile('cet_result'))
      {
        $rules = ['cet_result' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('cet_result_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapFE');
         }
        $extension = $request->file('cet_result')->getClientOriginalExtension();
        $filenametostore = 'cet_result_'.$dte_id.'.'.$extension;
   
        $path = $request->file('cet_result')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->cet_result_path = $filenametostore;
        $students->cet_result = 'Yes';
        $students->save();
      }

    if($request->hasFile('jee_result'))
      {
        $rules = ['jee_result' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('jee_result_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapFE');
         }
        $extension = $request->file('jee_result')->getClientOriginalExtension();
        $filenametostore = 'jeeresult_'.$dte_id.'.'.$extension;
   
        $path = $request->file('jee_result')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->jee_result_path = $filenametostore;
        $students->jee_result = 'Yes';
        $students->save();
      }

      
        if($request->hasFile('ssc_marksheet')) 
        {
        
          $rules = ['ssc_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('ssc_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapFE');
         }
  
           //get file extension
        $extension = $request->file('ssc_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'ssc_marksheet_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('ssc_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                 $students->ssc_marksheet_path = $filenametostore;
                  $students->ssc_marksheet = 'Yes';
        $students->save();
        
              
      
      }

      
      if($request->hasFile('hsc_marksheet')) 
      {
        $rules = ['hsc_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('hsc_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapFE');
         }
        
        
        //get file extension
        $extension = $request->file('hsc_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'hsc_marksheet'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('hsc_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->hsc_marksheet_path = $filenametostore;
         $students->hsc_marksheet='Yes';
        $students->save();
        
      ////echo $path; //
      
      }

      
      // if($request->hasFile('hsc_leaving_certi')) 
      // {
      //   $rules = ['hsc_leaving_certi' => 'mimes:pdf'];
      //     $validator = Validator::make(Input::all() , $rules);
      //   if ($validator->fails())
      //    {
      //     $request->session()->flash('hsc_leaving_certi_error', 'Please Upload Only PDF');
      //     return redirect()->route('adminDocumentVerifierAcapFE');
      //    }
        
        
      //   //get file extension
      //   $extension = $request->file('hsc_leaving_certi')->getClientOriginalExtension();
        
      //   //filename to store
      //   $filenametostore = 'hsc_leaving_certi'.$dte_id.'.'.$extension;
        
      //   //Upload File
      //   $path = $request->file('hsc_leaving_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
      //   $students->degree_leaving_tc_path = $filenametostore;
      //         $students->degree_leaving_tc = 'Yes';
      //   $students->save();
        
      // ////echo $path; //
      
      // }


      if($request->hasFile('hsc_passing_certi')) 
      {
        $rules = ['hsc_passing_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('hsc_passing_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapFE');
         }
        
        
        //get file extension
        $extension = $request->file('hsc_passing_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'hsc_passing_certi'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('hsc_passing_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->hsc_passing_certi_path = $filenametostore;
              $students->hsc_passing_certi = 'Yes';
        $students->save();
        
      ////echo $path; //
      
      }

      
      // if($request->hasFile('migration_certi')) 
      // {
      //   $rules = ['migration_certi' => 'mimes:pdf'];
      //     $validator = Validator::make(Input::all() , $rules);
      //   if ($validator->fails())
      //    {
      //     $request->session()->flash('migration_certi_error', 'Please Upload Only PDF');
      //     return redirect()->route('adminDocumentVerifierAcapFE');
      //    }
        
        
      //   //get file extension
      //   $extension = $request->file('migration_certi')->getClientOriginalExtension();
        
      //   //filename to store
      //   $filenametostore = 'migration_certi_'.$dte_id.'.'.$extension;
        
      //   //Upload File
      //   $path = $request->file('migration_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
      //   $students->migration_certi_path = $filenametostore;
      //           $students->migration_certi='Yes';
      //   $students->save();
      // //////echo $path; //
      
      // }


      
      if($request->hasFile('birth_certi')) 
      {
        $rules = ['birth_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('birth_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapFE');
         }
        
        
        //get file extension
        $extension = $request->file('birth_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'birth_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('birth_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $students->birth_certi_path = $filenametostore;
                $students->birth_certi='Yes';
        $students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('domicile')) 
      {
        $rules = ['domicile' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('domicile_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapFE');
         }
        
        
        //get file extension
        $extension = $request->file('domicile')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'domicile_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('domicile')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->domicile_path =$filenametostore;
                $students->domicile='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

    
      if($request->hasFile('proforma_o')) 
      {
        $rules = ['proforma_o' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('proforma_o_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapFE');
         }
        
        
        //get file extension
        $extension = $request->file('proforma_o')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'proforma_o_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('proforma_o')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->proforma_o_path = $filenametostore;
                $students->proforma_o='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      
      
      if($request->hasFile('minority_affidavit')) 
      {
        $rules = ['minority_affidavit' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('minority_affidavit_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapFE');
         }
        
        
        //get file extension
        $extension = $request->file('minority_affidavit')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'minority_affidavit_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('minority_affidavit')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->minority_affidavit_path = $filenametostore;
                $students->minority_affidavit='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('gap_certi')) 
      {
        $rules = ['gap_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('gap_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapFE');
         }
        
        
        //get file extension
        $extension = $request->file('gap_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'gap_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('gap_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->gap_certi_path =$filenametostore;
                $students->gap_certi='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('community_certi')) 
      {
        $rules = ['community_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('community_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapFE');
         }
        
        
        //get file extension
        $extension = $request->file('community_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'community_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('community_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->community_certi_path = $filenametostore;
                $students->community_certi='Yes';
        $students->save();
        
      //////echo $path; //
      
      }


      if($request->hasFile('medical_certi')) 
      {
        $rules = ['medical_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('medical_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapFE');
         }
        $extension = $request->file('medical_certi')->getClientOriginalExtension();
        $filenametostore = 'medical_certi_'.$dte_id.'.'.$extension;
        $path = $request->file('medical_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->medical_certi_path = $filenametostore;
                $students->medical_certi='Yes';
        $students->save();
      }

      
      if($request->hasFile('anti_ragging_affidavit')) 
      {
        $rules = ['anti_ragging_affidavit' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('anti_ragging_affidavit_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapFE');
         }
        $extension = $request->file('anti_ragging_affidavit')->getClientOriginalExtension();
        $filenametostore = 'anti_ragging_affidavit'.$dte_id.'.'.$extension;
        $path = $request->file('anti_ragging_affidavit')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->anti_ragging_affidavit_path = $filenametostore;
                $students->anti_ragging_affidavit='Yes';
        $students->save();
      }
      //return $course;
      if($course =="FEG")
      {

        $users = DB::table('fe_students')->select('dte_id','fc_confirmation_receipt','fc_confirmation_receipt_path','cet_result','cet_result_path','jee_result','jee_result_path','ssc_marksheet','ssc_marksheet_path','hsc_marksheet','hsc_marksheet_path','hsc_passing_certi','hsc_passing_certi_path','birth_certi','birth_certi_path','domicile','domicile_path','aadhar','aadhar_path','proforma_o','proforma_o_path','minority_affidavit','minority_affidavit_path','gap_certi','gap_certi_path','community_certi','community_certi_path','anti_ragging_affidavit','anti_ragging_affidavit_path','medical_certi','medical_certi_path','photo','photo_path','signature','signature_path')->where('dte_id', $dte_id)->get();
      }
     
     // return $course;
        $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        $hash = $hash[0]->hash;


        $data=[];
        $data['users']=$users;
        $data['hash'] = $hash;
        $data['course'] = $course;
      
        return view('admin.adminDocumentVerifierAcapFE',$data);

      }
        else
            return redirect()->route('adminLogin');
    
    }








public static  function verifyAdminDocumentVerifierAcapDSE(Request $request)
    {
        $email =$request->session()->get('email_id', 'null');
        $course = $request->session()->get('course','null');
       
        if($course == null)
          $course = $request->session()->get('adminCourse');
          
         
     if ($email != 'null')
     {
        $dte_id=$request->session()->get('dte1');
       //return $dte_id;
      $use = DB::table('student_login')->select('hash')->where('dte_id', $dte_id)->get();
      $destinationPath = $dte_id.'_'.$use[0]->hash;
      //  $abc=(int)$request->hasFile('ssc_marksheet');
       
        
      if($course == "DSE")
      {
        $students = new dse_students;
        if(DB::table('dse_students')->where('dte_id', $dte_id)->exists()) 
          { 
           $students  = dse_students::find($dte_id);
          
          }
          else
          {
            $students->dte_id = $dte_id;
          }
      }
        



        if($request->hasFile('photo'))
      {
         
         $rules = ['photo' => 'mimes:jpg,png,jpeg'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('photo_error', 'Please Upload Only JPG or PNG type image');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        $extension = $request->file('photo')->getClientOriginalExtension();
        $filenametostore = 'photo'.$dte_id.'.'.$extension;
        //Storage::disk('public_uploads')->put($destinationPath, $request->file('photo'));
       // $request->image->move(public_path('/uploads/').$destinationPath, $filenametostore);
        //$path = $destinationPath.'/'.$filenametostore;
       /* $image = Image::make($request->file('photo'))->fit(400, 200);
        $image->save();*/
        $path =  $request->file('photo')->storeAs($destinationPath, $filenametostore,'public_uploads');
        //return $path;
          $students->photo_path = $filenametostore;
           $students->photo='Yes';
        $students->save();
      }

      
        if($request->hasFile('signature'))
      {
        $rules = ['signature' => 'mimes:jpg,png,jpeg'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('signature_error', 'Please Upload Only JPG or PNG type image');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        $extension = $request->file('signature')->getClientOriginalExtension();
        $filenametostore = 'signature'.$dte_id.'.'.$extension;
        $path = $request->file('signature')->storeAs($destinationPath, $filenametostore,'public_uploads');
          $students->signature_path = $filenametostore;
           $students->signature='Yes';
        $students->save();
      }

      
        if($request->hasFile('fc_confirmation_receipt'))
      {
          //return "hello";
        $rules = ['fc_confirmation_receipt' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('fc_confirmation_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        $extension = $request->file('fc_confirmation_receipt')->getClientOriginalExtension();
        $filenametostore = 'fc_confirmation_receipt'.$dte_id.'.'.$extension;
        $path = $request->file('fc_confirmation_receipt')->storeAs($destinationPath, $filenametostore,'public_uploads');
          $students->fc_confirmation_receipt_path =$filenametostore;
           $students->fc_confirmation_receipt='Yes';
        $students->save();
      }

      
          if($request->hasFile('dte_allotment_letter'))
      {
        $rules = ['dte_allotment_letter' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('dte_allotment_letter_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        $extension = $request->file('dte_allotment_letter')->getClientOriginalExtension();
        $filenametostore = 'dte_allotment_letter_'.$dte_id.'.'.$extension;
   
        $path = $request->file('dte_allotment_letter')->storeAs($destinationPath, $filenametostore,'public_uploads');
              $students->dte_allotment_letter_path = $filenametostore;
               $students->dte_allotment_letter='Yes';
        $students->save();
      }

      
    if($request->hasFile('arc_ackw_receipt'))
      {
        $rules = ['arc_ackw_receipt' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('arc_ackw_receipt_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        $extension = $request->file('arc_ackw_receipt')->getClientOriginalExtension();
        $filenametostore = 'arc_ackw_receipt_'.$dte_id.'.'.$extension;
   
        $path = $request->file('arc_ackw_receipt')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->arc_ackw_receipt_path = $filenametostore;
        $students->arc_ackw_receipt='Yes';
        $students->save();
      }

  
  
      
        if($request->hasFile('ssc_marksheet')) 
        {
        
          $rules = ['ssc_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('ssc_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
  
           //get file extension
        $extension = $request->file('ssc_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'ssc_marksheet_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('ssc_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                 $students->ssc_marksheet_path = $filenametostore;
                  $students->ssc_marksheet = 'Yes';
        $students->save();
        
              //////echo $path; //
      
      }

      
      if($request->hasFile('hsc_marksheet')) 
      {
        $rules = ['hsc_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('hsc_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('hsc_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'hsc_diploma_marksheet'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('hsc_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->hsc_diploma_marksheet_path = $filenametostore;
         $students->hsc_diploma_marksheet='Yes';
        $students->save();
        
      ////echo $path; //
      
      }

      
      // if($request->hasFile('degree_leaving_tc')) 
      // {
      //   $rules = ['degree_leaving_tc' => 'mimes:pdf'];
      //     $validator = Validator::make(Input::all() , $rules);
      //   if ($validator->fails())
      //    {
      //     $request->session()->flash('degree_leaving_tc_error', 'Please Upload Only PDF');
      //     return redirect()->route('adminDocumentVerifierAcap');
      //    }
        
        
      //   //get file extension
      //   $extension = $request->file('degree_leaving_tc')->getClientOriginalExtension();
        
      //   //filename to store
      //   $filenametostore = 'degree_leaving_tc_'.$dte_id.'.'.$extension;
        
      //   //Upload File
      //   $path = $request->file('degree_leaving_tc')->storeAs($destinationPath, $filenametostore,'public_uploads');
      //   $students->degree_leaving_tc_path = $filenametostore;
      //         $students->degree_leaving_tc = 'Yes';
      //   $students->save();
        
      // ////echo $path; //
      
      // }

if($request->hasFile('hsc_passing_certi')) 
      {
        $rules = ['hsc_passing_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('hsc_passing_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('hsc_passing_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'hsc_passing_certi'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('hsc_passing_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->convocation_passing_certi_path = $filenametostore;
              $students->convocation_passing_certi = 'Yes';
        $students->save();
        
      ////echo $path; //
      
      }

      
      
      if($request->hasFile('first_year_marksheet')) 
      {
        $rules = ['first_year_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('first_year_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('first_year_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'first_year_marksheet_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('first_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->first_year_marksheet_path = $filenametostore;
           $students->first_year_marksheet = 'Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('second_year_marksheet')) 
      {
        $rules = ['second_year_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('second_year_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('second_year_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'second_year_marksheet_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('second_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->second_year_marksheet_path = $filenametostore;
                $students->second_year_marksheet='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('third_year_marksheet')) 
      {
        $rules = ['third_year_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('third_year_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('third_year_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'third_year_marksheet_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('third_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->third_year_marksheet_path =$filenametostore;
            $students->third_year_marksheet='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('fourth_year_marksheet')) 
      {
        $rules = ['fourth_year_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('fourth_year_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierDSE');
         }
        
        
        //get file extension
        $extension = $request->file('fourth_year_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'fourth_year_marksheet'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('fourth_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->fourth_year_marksheet_path =$filenametostore;
            $students->fourth_year_marksheet='Yes';
        $students->save();
        
      //////echo $path; //
      
      }


      
      // if($request->hasFile('convocation_passing_certi')) 
      // {
      //   $rules = ['convocation_passing_certi' => 'mimes:pdf'];
      //     $validator = Validator::make(Input::all() , $rules);
      //   if ($validator->fails())
      //    {
      //     $request->session()->flash('convocation_passing_certi_error', 'Please Upload Only PDF');
      //     return redirect()->route('adminDocumentVerifierAcap');
      //    }
        
        
      //   //get file extension
      //   $extension = $request->file('convocation_passing_certi')->getClientOriginalExtension();
        
      //   //filename to store
      //   $filenametostore = 'convocation_passing_certi_'.$dte_id.'.'.$extension;
        
      //   //Upload File
      //   $path = $request->file('convocation_passing_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
      //   $students->convocation_passing_certi_path = $filenametostore;
      //           $students->convocation_passing_certi='Yes';
      //   $students->save();
      // //////echo $path; //
      
      // }

      
      if($request->hasFile('migration_certi')) 
      {
        $rules = ['migration_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('migration_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('migration_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'migration_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('migration_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->migration_certi_path = $filenametostore;
                $students->migration_certi='Yes';
        $students->save();
      //////echo $path; //
      
      }


      
      if($request->hasFile('birth_certi')) 
      {
        $rules = ['birth_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('birth_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('birth_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'birth_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('birth_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $students->birth_certi_path = $filenametostore;
                $students->birth_certi='Yes';
        $students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('domicile')) 
      {
        $rules = ['domicile' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('domicile_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('domicile')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'domicile_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('domicile')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->domicile_path =$filenametostore;
                $students->domicile='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

     
      if($request->hasFile('proforma_o')) 
      {
        $rules = ['proforma_o' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('proforma_o_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('proforma_o')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'proforma_o_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('proforma_o')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->proforma_o_path = $filenametostore;
                $students->proforma_o='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('retention')) 
      {
        $rules = ['retention' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('retention_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('retention')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'retention_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('retention')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $students->retention_path = $filenametostore;
               $students->retention='Yes';
        $students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('minority_affidavit')) 
      {
        $rules = ['minority_affidavit' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('minority_affidavit_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('minority_affidavit')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'minority_affidavit_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('minority_affidavit')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->minority_affidavit_path = $filenametostore;
                $students->minority_affidavit='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('gap_certi')) 
      {
        $rules = ['gap_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('gap_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('gap_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'gap_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('gap_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->gap_certi_path =$filenametostore;
                $students->gap_certi='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('community_certi')) 
      {
        $rules = ['community_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('community_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('community_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'community_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('community_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->community_certi_path = $filenametostore;
                $students->community_certi='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('caste_certi')) 
      {
        $rules = ['caste_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('caste_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('caste_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'caste_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('caste_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $students->caste_certi_path =$filenametostore;
                $students->caste_certi='Yes';
        $students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('caste_validity_certi')) 
      {
        $rules = ['caste_validity_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('caste_validity_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('caste_validity_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'caste_validity_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('caste_validity_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $students->caste_validity_certi_path = $filenametostore;
               $students->caste_validity_certi='Yes';
        $students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('non_creamy_layer_certi')) 
      {
        $rules = ['non_creamy_layer_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('non_creamy_layer_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('non_creamy_layer_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'non_creamy_layer_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('non_creamy_layer_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $students->non_creamy_layer_certi_path = $filenametostore;
                $students->non_creamy_layer_certi='Yes';
        $students->save();
      //////echo $path; //
      
      }

      
      

      
    
      
      if($request->hasFile('income_certi')) 
      {
        $rules = ['income_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('income_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        
        
        //get file extension
        $extension = $request->file('income_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'income_certi_'.$dte_id.'.'.$extension;
        
        //Upload file
        $path = $request->file('income_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
      $students->income_certi_path = $filenametostore;
            $students->income_certi='Yes';
        $students->save();
      }

    
      
      if($request->hasFile('medical_certi')) 
      {
        $rules = ['medical_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('medical_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        $extension = $request->file('medical_certi')->getClientOriginalExtension();
        $filenametostore = 'medical_certi_'.$dte_id.'.'.$extension;
        $path = $request->file('medical_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->medical_certi_path = $filenametostore;
                $students->medical_certi='Yes';
        $students->save();
      }

      
      if($request->hasFile('anti_ragging_affidavit')) 
      {
        $rules = ['anti_ragging_affidavit' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('anti_ragging_affidavit_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcap');
         }
        $extension = $request->file('anti_ragging_affidavit')->getClientOriginalExtension();
        $filenametostore = 'anti_ragging_affidavit'.$dte_id.'.'.$extension;
        $path = $request->file('anti_ragging_affidavit')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->anti_ragging_affidavit_path = $filenametostore;
                $students->anti_ragging_affidavit='Yes';
        $students->save();
      }

      if($course =="DSE")
      {

        $users = DB::table('dse_students')->select('dte_id','fc_confirmation_receipt','fc_confirmation_receipt_path','dte_allotment_letter','dte_allotment_letter_path','arc_ackw_receipt','arc_ackw_receipt_path','ssc_marksheet','ssc_marksheet_path','hsc_diploma_marksheet','hsc_diploma_marksheet_path','first_year_marksheet','first_year_marksheet_path','second_year_marksheet','second_year_marksheet_path','third_year_marksheet','third_year_marksheet_path','fourth_year_marksheet','fourth_year_marksheet_path','migration_certi','migration_certi_path','birth_certi','birth_certi_path','domicile','domicile_path','proforma_o','proforma_o_path','retention','retention_path','minority_affidavit','minority_affidavit_path','gap_certi','gap_certi_path','convocation_passing_certi','convocation_passing_certi_path','community_certi','community_certi_path','caste_certi','caste_certi_path','caste_validity_certi','caste_validity_certi_path','non_creamy_layer_certi','non_creamy_layer_certi_path','income_certi','income_certi_path','anti_ragging_affidavit','anti_ragging_affidavit_path','medical_certi','medical_certi_path','photo','photo_path','signature','signature_path')->where('dte_id', $dte_id)->get();
      }
     
        $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        $hash = $hash[0]->hash;


        $data=[];
        $data['users']=$users;
        $data['hash'] = $hash;
        $data['course'] = $course;
    //  return 'hello';
        return view('admin.adminDocumentVerifierAcapDSE',$data);

      }
        else
            return redirect()->route('adminLogin');
    
    }























public static  function verifyAdminDocumentVerifierFE(Request $request)
    {
        $email =$request->session()->get('email_id', 'null');
        $course = $request->session()->get('course','null');
       
        if($course == null)
          $course = $request->session()->get('adminCourse');
          
         
     if ($email != 'null')
     {
        $dte_id=$request->session()->get('dte1');
       //return $dte_id;
      $use = DB::table('student_login')->select('hash')->where('dte_id', $dte_id)->get();
      $destinationPath = $dte_id.'_'.$use[0]->hash;
      //  $abc=(int)$request->hasFile('ssc_marksheet');
       
      
      if($course == "FEG")
      {
        $students = new fe_students;
        if(DB::table('fe_students')->where('dte_id', $dte_id)->exists()) 
          { 
           $students  = fe_students::find($dte_id);
          
          }
          else
          {
            $students->dte_id = $dte_id;
          }
      }
        
      // if($course == "DSE")
      // {
      //   $students = new dse_students;
      //   if(DB::table('dse_students')->where('dte_id', $dte_id)->exists()) 
      //     { 
      //      $students  = dse_students::find($dte_id);
          
      //     }
      //     else
      //     {
      //       $students->dte_id = $dte_id;
      //     }
      // }
        



        if($request->hasFile('photo'))
      {
         
         $rules = ['photo' => 'mimes:jpg,png,jpeg'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('photo_error', 'Please Upload Only JPG or PNG type image');
          return redirect()->route('adminDocumentVerifierFE');
         }
        $extension = $request->file('photo')->getClientOriginalExtension();
        $filenametostore = 'photo'.$dte_id.'.'.$extension;
        //Storage::disk('public_uploads')->put($destinationPath, $request->file('photo'));
       // $request->image->move(public_path('/uploads/').$destinationPath, $filenametostore);
        //$path = $destinationPath.'/'.$filenametostore;
       /* $image = Image::make($request->file('photo'))->fit(400, 200);
        $image->save();*/
        $path =  $request->file('photo')->storeAs($destinationPath, $filenametostore,'public_uploads');
        //return $path;
          $students->photo_path = $filenametostore;
           $students->photo='Yes';
        $students->save();
      }

      
        if($request->hasFile('signature'))
      {
        $rules = ['signature' => 'mimes:jpg,png,jpeg'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('signature_error', 'Please Upload Only JPG or PNG type image');
          return redirect()->route('adminDocumentVerifierFE');
         }
        $extension = $request->file('signature')->getClientOriginalExtension();
        $filenametostore = 'signature'.$dte_id.'.'.$extension;
        $path = $request->file('signature')->storeAs($destinationPath, $filenametostore,'public_uploads');
          $students->signature_path = $filenametostore;
           $students->signature='Yes';
        $students->save();
      }

      
        if($request->hasFile('fc_confirmation_receipt'))
      {
          //return "hello";
        $rules = ['fc_confirmation_receipt' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('fc_confirmation_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
        $extension = $request->file('fc_confirmation_receipt')->getClientOriginalExtension();
        $filenametostore = 'fc_confirmation_receipt'.$dte_id.'.'.$extension;
        $path = $request->file('fc_confirmation_receipt')->storeAs($destinationPath, $filenametostore,'public_uploads');
          $students->fc_confirmation_receipt_path =$filenametostore;
           $students->fc_confirmation_receipt='Yes';
        $students->save();
      }

      
          if($request->hasFile('dte_allotment_letter'))
      {
        $rules = ['dte_allotment_letter' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('dte_allotment_letter_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
        $extension = $request->file('dte_allotment_letter')->getClientOriginalExtension();
        $filenametostore = 'dte_allotment_letter_'.$dte_id.'.'.$extension;
   
        $path = $request->file('dte_allotment_letter')->storeAs($destinationPath, $filenametostore,'public_uploads');
              $students->dte_allotment_letter_path = $filenametostore;
               $students->dte_allotment_letter='Yes';
        $students->save();
      }

      
    if($request->hasFile('arc_ackw_receipt'))
      {
        $rules = ['arc_ackw_receipt' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('arc_ackw_receipt_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
        $extension = $request->file('arc_ackw_receipt')->getClientOriginalExtension();
        $filenametostore = 'arc_ackw_receipt_'.$dte_id.'.'.$extension;
   
        $path = $request->file('arc_ackw_receipt')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->arc_ackw_receipt_path = $filenametostore;
        $students->arc_ackw_receipt='Yes';
        $students->save();
      }

  
  if($request->hasFile('cet_result'))
      {
        $rules = ['cet_result' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('cet_result_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
        $extension = $request->file('cet_result')->getClientOriginalExtension();
        $filenametostore = 'cet_result_'.$dte_id.'.'.$extension;
   
        $path = $request->file('cet_result')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->cet_result_path = $filenametostore;
        $students->cet_result = 'Yes';
        $students->save();
      }

    if($request->hasFile('jee_result'))
      {
        $rules = ['jee_result' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('jee_result_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
        $extension = $request->file('jee_result')->getClientOriginalExtension();
        $filenametostore = 'jeeresult_'.$dte_id.'.'.$extension;
   
        $path = $request->file('jee_result')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->jee_result_path = $filenametostore;
        $students->jee_result = 'Yes';
        $students->save();
      }

      
        if($request->hasFile('ssc_marksheet')) 
        {
        
          $rules = ['ssc_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('ssc_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
  
           //get file extension
        $extension = $request->file('ssc_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'ssc_marksheet_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('ssc_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                 $students->ssc_marksheet_path = $filenametostore;
                  $students->ssc_marksheet = 'Yes';
        $students->save();
        
              //////echo $path; //
      
      }

      
      if($request->hasFile('hsc_marksheet')) 
      {
        $rules = ['hsc_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('hsc_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
        
        
        //get file extension
        $extension = $request->file('hsc_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'hsc_marksheet'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('hsc_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->hsc_marksheet_path = $filenametostore;
         $students->hsc_marksheet='Yes';
        $students->save();
        
      ////echo $path; //
      
      }

      
      if($request->hasFile('degree_leaving_tc')) 
      {
        $rules = ['degree_leaving_tc' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('hsc_leaving_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
        
        
        //get file extension
        $extension = $request->file('degree_leaving_tc')->getClientOriginalExtension();
        //return $extension;
        //filename to store
        $filenametostore = 'hsc_leaving_certi'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('degree_leaving_tc')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->hsc_leaving_certi_path = $filenametostore;
              $students->hsc_leaving_certi = 'Yes';
        $students->save();
        
      ////echo $path; //
      
      }


      if($request->hasFile('convocation_passing_certi')) 
      {
        $rules = ['convocation_passing_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('hsc_passing_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
        
        
        //get file extension
        $extension = $request->file('convocation_passing_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'hsc_passing_certi'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('convocation_passing_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->hsc_passing_certi_path = $filenametostore;
              $students->hsc_passing_certi = 'Yes';
        $students->save();
        
      ////echo $path; //
      
      }

      
      if($request->hasFile('migration_certi')) 
      {
        $rules = ['migration_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('migration_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
        
        
        //get file extension
        $extension = $request->file('migration_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'migration_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('migration_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->migration_certi_path = $filenametostore;
                $students->migration_certi='Yes';
        $students->save();
      //////echo $path; //
      
      }


      
      if($request->hasFile('birth_certi')) 
      {
        $rules = ['birth_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('birth_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
        
        
        //get file extension
        $extension = $request->file('birth_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'birth_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('birth_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $students->birth_certi_path = $filenametostore;
                $students->birth_certi='Yes';
        $students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('domicile')) 
      {
        $rules = ['domicile' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('domicile_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
        
        
        //get file extension
        $extension = $request->file('domicile')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'domicile_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('domicile')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->domicile_path =$filenametostore;
                $students->domicile='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

    if($request->hasFile('aadhar')) 
      {
        $rules = ['aadhar' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('aadhar', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
        
        
        //get file extension
        $extension = $request->file('aadhar')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'aadhar_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('aadhar')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->aadhar_path =$filenametostore;
                $students->aadhar='Yes';
        $students->save();
        
      //////echo $path; //
      
      }


      if($request->hasFile('proforma_o')) 
      {
        $rules = ['proforma_o' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('proforma_o_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
        
        
        //get file extension
        $extension = $request->file('proforma_o')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'proforma_o_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('proforma_o')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->proforma_o_path = $filenametostore;
                $students->proforma_o='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('retention')) 
      {
        $rules = ['retention' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('retention_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
        
        
        //get file extension
        $extension = $request->file('retention')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'retention_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('retention')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $students->retention_path = $filenametostore;
               $students->retention='Yes';
        $students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('minority_affidavit')) 
      {
        $rules = ['minority_affidavit' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('minority_affidavit_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
        
        
        //get file extension
        $extension = $request->file('minority_affidavit')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'minority_affidavit_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('minority_affidavit')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->minority_affidavit_path = $filenametostore;
                $students->minority_affidavit='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('gap_certi')) 
      {
        $rules = ['gap_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('gap_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
        
        
        //get file extension
        $extension = $request->file('gap_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'gap_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('gap_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->gap_certi_path =$filenametostore;
                $students->gap_certi='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('community_certi')) 
      {
        $rules = ['community_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('community_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
        
        
        //get file extension
        $extension = $request->file('community_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'community_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('community_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->community_certi_path = $filenametostore;
                $students->community_certi='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('caste_certi')) 
      {
        $rules = ['caste_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('caste_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
        
        
        //get file extension
        $extension = $request->file('caste_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'caste_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('caste_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $students->caste_certi_path =$filenametostore;
                $students->caste_certi='Yes';
        $students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('caste_validity_certi')) 
      {
        $rules = ['caste_validity_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('caste_validity_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
        
        
        //get file extension
        $extension = $request->file('caste_validity_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'caste_validity_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('caste_validity_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $students->caste_validity_certi_path = $filenametostore;
               $students->caste_validity_certi='Yes';
        $students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('non_creamy_layer_certi')) 
      {
        $rules = ['non_creamy_layer_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('non_creamy_layer_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
        
        
        //get file extension
        $extension = $request->file('non_creamy_layer_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'non_creamy_layer_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('non_creamy_layer_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $students->non_creamy_layer_certi_path = $filenametostore;
                $students->non_creamy_layer_certi='Yes';
        $students->save();
      //////echo $path; //
      
      }

      
      

      
      if($request->hasFile('proforma_a_b1_b2')) 
      {
        $rules = ['proforma_a_b1_b2' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('proforma_a_b1_b2_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
        
        
        //get file extension
        $extension = $request->file('proforma_a_b1_b2')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'proforma_a_b1_b2_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('proforma_a_b1_b2')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $students->proforma_a_b1_b2_path = $filenametostore;
                $students->proforma_a_b1_b2='Yes';
        $students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('proforma_f_f1')) 
      {
        $rules = ['proforma_f_f1' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('proforma_f_f1_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
        
        
        //get file extension
        $extension = $request->file('proforma_f_f1')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'proforma_f_f1_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('proforma_f_f1')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->proforma_f_f1_path = $filenametostore;
                $students->proforma_f_f1='Yes';

        $students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('income_certi')) 
      {
        $rules = ['income_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('income_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
        
        
        //get file extension
        $extension = $request->file('income_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'income_certi_'.$dte_id.'.'.$extension;
        
        //Upload file
        $path = $request->file('income_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
      $students->income_certi_path = $filenametostore;
            $students->income_certi='Yes';
        $students->save();
      }

      
      if($request->hasFile('proforma_c_d_e')) 
      {
        $rules = ['proforma_c_d_e' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('proforma_c_d_e_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
        $extension = $request->file('proforma_c_d_e')->getClientOriginalExtension();
        $filenametostore = 'proforma_c_d_e'.$dte_id.'.'.$extension;
        $path = $request->file('proforma_c_d_e')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->proforma_c_d_e_path = $filenametostore;
                $students->proforma_c_d_e='Yes';
        $students->save();
      }

      
      if($request->hasFile('proforma_j_k_l')) 
      {
        $rules = ['proforma_j_k_l' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('proforma_j_k_l_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
        $extension = $request->file('proforma_j_k_l')->getClientOriginalExtension();
        $filenametostore = 'proforma_j_k_l_'.$dte_id.'.'.$extension;
        $path = $request->file('proforma_j_k_l')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->proforma_j_k_l_path =$filenametostore;
                $students->proforma_j_k_l='Yes';
        $students->save();
      }

      
      if($request->hasFile('medical_certi')) 
      {
        $rules = ['medical_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('medical_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
        $extension = $request->file('medical_certi')->getClientOriginalExtension();
        $filenametostore = 'medical_certi_'.$dte_id.'.'.$extension;
        $path = $request->file('medical_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->medical_certi_path = $filenametostore;
                $students->medical_certi='Yes';
        $students->save();
      }

      
      if($request->hasFile('anti_ragging_affidavit')) 
      {
        $rules = ['anti_ragging_affidavit' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('anti_ragging_affidavit_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierFE');
         }
        $extension = $request->file('anti_ragging_affidavit')->getClientOriginalExtension();
        $filenametostore = 'anti_ragging_affidavit'.$dte_id.'.'.$extension;
        $path = $request->file('anti_ragging_affidavit')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->anti_ragging_affidavit_path = $filenametostore;
                $students->anti_ragging_affidavit='Yes';
        $students->save();
      }

      if($course =="FEG")
      {

        $users = DB::table('fe_students')->select('dte_id','fc_confirmation_receipt','fc_confirmation_receipt_path','dte_allotment_letter','dte_allotment_letter_path','arc_ackw_receipt','arc_ackw_receipt_path','cet_result','cet_result_path','jee_result','jee_result_path','ssc_marksheet','ssc_marksheet_path','hsc_marksheet','hsc_marksheet_path','hsc_leaving_certi','hsc_leaving_certi_path','hsc_passing_certi','hsc_passing_certi_path','migration_certi','migration_certi_path','birth_certi','birth_certi_path','domicile','domicile_path','aadhar','aadhar_path','proforma_o','proforma_o_path','retention','retention_path','minority_affidavit','minority_affidavit_path','gap_certi','gap_certi_path','community_certi','community_certi_path','caste_certi','caste_certi_path','caste_validity_certi','caste_validity_certi_path','non_creamy_layer_certi','non_creamy_layer_certi_path','proforma_a_b1_b2','proforma_a_b1_b2_path','proforma_g1_g2','proforma_g1_g2_path','proforma_u','proforma_u_path','proforma_v','proforma_v_path','income_certi','income_certi_path','proforma_c_d_e','proforma_c_d_e_path','anti_ragging_affidavit','anti_ragging_affidavit_path','proforma_j_k_l','proforma_j_k_l_path','medical_certi','medical_certi_path','photo','photo_path','signature','signature_path')->where('dte_id', $dte_id)->get();
      }
     

        $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        $hash = $hash[0]->hash;


        $data=[];
        $data['users']=$users;
        $data['hash'] = $hash;
        $data['course'] = $course;
      
        return view('admin.adminDocumentVerifierFE',$data);

      }
        else
            return redirect()->route('adminLogin');
    
    }


public static  function verifyAdminDocumentVerifierDSE(Request $request)
    {
        $email =$request->session()->get('email_id', 'null');
        $course = $request->session()->get('course','null');
      // return $course;
        if($course == null)
          $course = $request->session()->get('adminCourse');
          
         
     if ($email != 'null')
     {
        $dte_id=$request->session()->get('dte1');
       //return $dte_id;
      $use = DB::table('student_login')->select('hash')->where('dte_id', $dte_id)->get();
      $destinationPath = $dte_id.'_'.$use[0]->hash;
      //  $abc=(int)$request->hasFile('ssc_marksheet');
       
        //return $course;
      if($course == "DSE")
      {
          
        $students = new dse_students;
        if(DB::table('dse_students')->where('dte_id', $dte_id)->exists()) 
          { 
           $students  = dse_students::find($dte_id);
          
          }
          else
          {
            $students->dte_id = $dte_id;
          }
      }
        



        if($request->hasFile('photo'))
      {
         
         $rules = ['photo' => 'mimes:jpg,png,jpeg'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('photo_error', 'Please Upload Only JPG or PNG type image');
          return redirect()->route('adminDocumentVerifierDSE');
         }
        $extension = $request->file('photo')->getClientOriginalExtension();
        $filenametostore = 'photo'.$dte_id.'.'.$extension;
        //Storage::disk('public_uploads')->put($destinationPath, $request->file('photo'));
       // $request->image->move(public_path('/uploads/').$destinationPath, $filenametostore);
        //$path = $destinationPath.'/'.$filenametostore;
       /* $image = Image::make($request->file('photo'))->fit(400, 200);
        $image->save();*/
        $path =  $request->file('photo')->storeAs($destinationPath, $filenametostore,'public_uploads');
        //return $path;
          $students->photo_path = $filenametostore;
           $students->photo='Yes';
        $students->save();
      }

      
        if($request->hasFile('signature'))
      {
        $rules = ['signature' => 'mimes:jpg,png,jpeg'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('signature_error', 'Please Upload Only JPG or PNG type image');
          return redirect()->route('adminDocumentVerifierDSE');
         }
        $extension = $request->file('signature')->getClientOriginalExtension();
        $filenametostore = 'signature'.$dte_id.'.'.$extension;
        $path = $request->file('signature')->storeAs($destinationPath, $filenametostore,'public_uploads');
          $students->signature_path = $filenametostore;
           $students->signature='Yes';
        $students->save();
      }

      
        if($request->hasFile('fc_confirmation_receipt'))
      {
          //return "hello";
        $rules = ['fc_confirmation_receipt' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('fc_confirmation_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierDSE');
         }
        $extension = $request->file('fc_confirmation_receipt')->getClientOriginalExtension();
        $filenametostore = 'fc_confirmation_receipt'.$dte_id.'.'.$extension;
        $path = $request->file('fc_confirmation_receipt')->storeAs($destinationPath, $filenametostore,'public_uploads');
          $students->fc_confirmation_receipt_path =$filenametostore;
           $students->fc_confirmation_receipt='Yes';
        $students->save();
      }

      
          if($request->hasFile('dte_allotment_letter'))
      {
        $rules = ['dte_allotment_letter' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('dte_allotment_letter_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierDSE');
         }
        $extension = $request->file('dte_allotment_letter')->getClientOriginalExtension();
        $filenametostore = 'dte_allotment_letter_'.$dte_id.'.'.$extension;
   
        $path = $request->file('dte_allotment_letter')->storeAs($destinationPath, $filenametostore,'public_uploads');
              $students->dte_allotment_letter_path = $filenametostore;
               $students->dte_allotment_letter='Yes';
        $students->save();
      }

      
    if($request->hasFile('arc_ackw_receipt'))
      {
        $rules = ['arc_ackw_receipt' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('arc_ackw_receipt_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierDSE');
         }
        $extension = $request->file('arc_ackw_receipt')->getClientOriginalExtension();
        $filenametostore = 'arc_ackw_receipt_'.$dte_id.'.'.$extension;
   
        $path = $request->file('arc_ackw_receipt')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->arc_ackw_receipt_path = $filenametostore;
        $students->arc_ackw_receipt='Yes';
        $students->save();
      }

  
  
      
        if($request->hasFile('ssc_marksheet')) 
        {
        
          $rules = ['ssc_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('ssc_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierDSE');
         }
  
           //get file extension
        $extension = $request->file('ssc_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'ssc_marksheet_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('ssc_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                 $students->ssc_marksheet_path = $filenametostore;
                  $students->ssc_marksheet = 'Yes';
        $students->save();
        
              //////echo $path; //
      
      }

      
      if($request->hasFile('hsc_marksheet')) 
      {
        $rules = ['hsc_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('hsc_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierDSE');
         }
        
        
        //get file extension
        $extension = $request->file('hsc_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'hsc_diploma_marksheet'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('hsc_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->hsc_diploma_marksheet_path = $filenametostore;
         $students->hsc_diploma_marksheet='Yes';
        $students->save();
        
      ////echo $path; //
      
      }

      
      // if($request->hasFile('degree_leaving_tc')) 
      // {
      //   $rules = ['degree_leaving_tc' => 'mimes:pdf'];
      //     $validator = Validator::make(Input::all() , $rules);
      //   if ($validator->fails())
      //    {
      //     $request->session()->flash('degree_leaving_tc_error', 'Please Upload Only PDF');
      //     return redirect()->route('adminDocumentVerifierDSE');
      //    }
        
        
      //   //get file extension
      //   $extension = $request->file('degree_leaving_tc')->getClientOriginalExtension();
        
      //   //filename to store
      //   $filenametostore = 'degree_leaving_tc_'.$dte_id.'.'.$extension;
        
      //   //Upload File
      //   $path = $request->file('degree_leaving_tc')->storeAs($destinationPath, $filenametostore,'public_uploads');
      //   $students->degree_leaving_tc_path = $filenametostore;
      //         $students->degree_leaving_tc = 'Yes';
      //   $students->save();
        
      // ////echo $path; //
      
      // }

if($request->hasFile('hsc_passing_certi')) 
      {
        $rules = ['hsc_passing_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('hsc_passing_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierDSE');
         }
        
        
        //get file extension
        $extension = $request->file('hsc_passing_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'hsc_passing_certi'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('hsc_passing_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $students->convocation_passing_certi_path = $filenametostore;
              $students->convocation_passing_certi = 'Yes';
        $students->save();
        
      ////echo $path; //
      
      }

      
      
      if($request->hasFile('first_year_marksheet')) 
      {
        $rules = ['first_year_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('first_year_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierDSE');
         }
        
        
        //get file extension
        $extension = $request->file('first_year_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'first_year_marksheet_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('first_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->first_year_marksheet_path = $filenametostore;
           $students->first_year_marksheet = 'Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('second_year_marksheet')) 
      {
        $rules = ['second_year_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('second_year_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierDSE');
         }
        
        
        //get file extension
        $extension = $request->file('second_year_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'second_year_marksheet_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('second_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->second_year_marksheet_path = $filenametostore;
                $students->second_year_marksheet='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('third_year_marksheet')) 
      {
        $rules = ['third_year_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('third_year_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierDSE');
         }
        
        
        //get file extension
        $extension = $request->file('third_year_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'third_year_marksheet_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('third_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->third_year_marksheet_path =$filenametostore;
            $students->third_year_marksheet='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      
      if($request->hasFile('fourth_year_marksheet')) 
      {
        $rules = ['fourth_year_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('fourth_year_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierDSE');
         }
        
        
        //get file extension
        $extension = $request->file('fourth_year_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'fourth_year_marksheet'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('fourth_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->fourth_year_marksheet_path =$filenametostore;
            $students->fourth_year_marksheet='Yes';
        $students->save();
        
      //////echo $path; //
      
      }


      
      // if($request->hasFile('convocation_passing_certi')) 
      // {
      //   $rules = ['convocation_passing_certi' => 'mimes:pdf'];
      //     $validator = Validator::make(Input::all() , $rules);
      //   if ($validator->fails())
      //    {
      //     $request->session()->flash('convocation_passing_certi_error', 'Please Upload Only PDF');
      //     return redirect()->route('adminDocumentVerifierDSE');
      //    }
        
        
      //   //get file extension
      //   $extension = $request->file('convocation_passing_certi')->getClientOriginalExtension();
        
      //   //filename to store
      //   $filenametostore = 'convocation_passing_certi_'.$dte_id.'.'.$extension;
        
      //   //Upload File
      //   $path = $request->file('convocation_passing_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
      //   $students->convocation_passing_certi_path = $filenametostore;
      //           $students->convocation_passing_certi='Yes';
      //   $students->save();
      // //////echo $path; //
      
      // }

      
      if($request->hasFile('migration_certi')) 
      {
        $rules = ['migration_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('migration_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierDSE');
         }
        
        
        //get file extension
        $extension = $request->file('migration_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'migration_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('migration_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->migration_certi_path = $filenametostore;
                $students->migration_certi='Yes';
        $students->save();
      //////echo $path; //
      
      }


      
      if($request->hasFile('birth_certi')) 
      {
        $rules = ['birth_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('birth_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierDSE');
         }
        
        
        //get file extension
        $extension = $request->file('birth_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'birth_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('birth_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $students->birth_certi_path = $filenametostore;
                $students->birth_certi='Yes';
        $students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('domicile')) 
      {
        $rules = ['domicile' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('domicile_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierDSE');
         }
        
        
        //get file extension
        $extension = $request->file('domicile')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'domicile_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('domicile')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->domicile_path =$filenametostore;
                $students->domicile='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

     
      if($request->hasFile('proforma_o')) 
      {
        $rules = ['proforma_o' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('proforma_o_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierDSE');
         }
        
        
        //get file extension
        $extension = $request->file('proforma_o')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'proforma_o_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('proforma_o')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->proforma_o_path = $filenametostore;
                $students->proforma_o='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('retention')) 
      {
        $rules = ['retention' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('retention_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierDSE');
         }
        
        
        //get file extension
        $extension = $request->file('retention')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'retention_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('retention')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $students->retention_path = $filenametostore;
               $students->retention='Yes';
        $students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('minority_affidavit')) 
      {
        $rules = ['minority_affidavit' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('minority_affidavit_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierDSE');
         }
        
        
        //get file extension
        $extension = $request->file('minority_affidavit')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'minority_affidavit_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('minority_affidavit')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->minority_affidavit_path = $filenametostore;
                $students->minority_affidavit='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('gap_certi')) 
      {
        $rules = ['gap_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('gap_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierDSE');
         }
        
        
        //get file extension
        $extension = $request->file('gap_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'gap_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('gap_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->gap_certi_path =$filenametostore;
                $students->gap_certi='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('community_certi')) 
      {
        $rules = ['community_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('community_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierDSE');
         }
        
        
        //get file extension
        $extension = $request->file('community_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'community_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        //return $filenametostore;
        $path = $request->file('community_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
               // return $students;

        $students->community_certi_path = $filenametostore;
                $students->community_certi='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('caste_certi')) 
      {
        $rules = ['caste_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('caste_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierDSE');
         }
        
        
        //get file extension
        $extension = $request->file('caste_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'caste_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('caste_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $students->caste_certi_path =$filenametostore;
                $students->caste_certi='Yes';
        $students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('caste_validity_certi')) 
      {
        $rules = ['caste_validity_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('caste_validity_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierDSE');
         }
        
        
        //get file extension
        $extension = $request->file('caste_validity_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'caste_validity_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('caste_validity_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $students->caste_validity_certi_path = $filenametostore;
               $students->caste_validity_certi='Yes';
        $students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('non_creamy_layer_certi')) 
      {
        $rules = ['non_creamy_layer_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('non_creamy_layer_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierDSE');
         }
        
        
        //get file extension
        $extension = $request->file('non_creamy_layer_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'non_creamy_layer_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('non_creamy_layer_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $students->non_creamy_layer_certi_path = $filenametostore;
                $students->non_creamy_layer_certi='Yes';
        $students->save();
      //////echo $path; //
      
      }

      
      

      
    
      
      if($request->hasFile('income_certi')) 
      {
        $rules = ['income_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('income_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierDSE');
         }
        
        
        //get file extension
        $extension = $request->file('income_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'income_certi_'.$dte_id.'.'.$extension;
        
        //Upload file
        $path = $request->file('income_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
      $students->income_certi_path = $filenametostore;
            $students->income_certi='Yes';
        $students->save();
      }

    
      
      if($request->hasFile('medical_certi')) 
      {
        $rules = ['medical_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('medical_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierDSE');
         }
        $extension = $request->file('medical_certi')->getClientOriginalExtension();
        $filenametostore = 'medical_certi_'.$dte_id.'.'.$extension;
        $path = $request->file('medical_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->medical_certi_path = $filenametostore;
                $students->medical_certi='Yes';
        $students->save();
      }

      
      if($request->hasFile('anti_ragging_affidavit')) 
      {
        $rules = ['anti_ragging_affidavit' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('anti_ragging_affidavit_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierDSE');
         }
        $extension = $request->file('anti_ragging_affidavit')->getClientOriginalExtension();
        $filenametostore = 'anti_ragging_affidavit'.$dte_id.'.'.$extension;
        $path = $request->file('anti_ragging_affidavit')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->anti_ragging_affidavit_path = $filenametostore;
                $students->anti_ragging_affidavit='Yes';
        $students->save();
      }

      if($course =="DSE")
      {

        $users = DB::table('dse_students')->select('dte_id','fc_confirmation_receipt','fc_confirmation_receipt_path','dte_allotment_letter','dte_allotment_letter_path','arc_ackw_receipt','arc_ackw_receipt_path','ssc_marksheet','ssc_marksheet_path','hsc_diploma_marksheet','hsc_diploma_marksheet_path','first_year_marksheet','first_year_marksheet_path','second_year_marksheet','second_year_marksheet_path','third_year_marksheet','third_year_marksheet_path','fourth_year_marksheet','fourth_year_marksheet_path','migration_certi','migration_certi_path','birth_certi','birth_certi_path','domicile','domicile_path','proforma_o','proforma_o_path','retention','retention_path','minority_affidavit','minority_affidavit_path','gap_certi','gap_certi_path','convocation_passing_certi','convocation_passing_certi_path','community_certi','community_certi_path','caste_certi','caste_certi_path','caste_validity_certi','caste_validity_certi_path','non_creamy_layer_certi','non_creamy_layer_certi_path','income_certi','income_certi_path','anti_ragging_affidavit','anti_ragging_affidavit_path','medical_certi','medical_certi_path','photo','photo_path','signature','signature_path')->where('dte_id', $dte_id)->get();
      }
     
        $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        $hash = $hash[0]->hash;


        $data=[];
        $data['users']=$users;
        $data['hash'] = $hash;
        $data['course'] = $course;
      
        return view('admin.adminDocumentVerifierDSE',$data);

      }
        else
            return redirect()->route('adminLogin');
    
    }



public static  function verifyadminDocumentVerifierMEG(Request $request)
    {
        $email =$request->session()->get('email_id', 'null');
        $course = $request->session()->get('course','null');
       
        if($course == null)
          $course = $request->session()->get('adminCourse');
          
         
     if ($email != 'null')
     {
        $dte_id=$request->session()->get('dte1');
       //return $dte_id;
      $use = DB::table('student_login')->select('hash')->where('dte_id', $dte_id)->get();
      $destinationPath = $dte_id.'_'.$use[0]->hash;
      //  $abc=(int)$request->hasFile('ssc_marksheet');
        $me_students = new me_students;
        if(DB::table('me_students')->where('dte_id', $dte_id)->exists()) 
          { 
           $me_students  = me_students::find($dte_id);
          // return $me_students;
          }
          else
          {
            $me_students->dte_id = $dte_id;
          }
    
        

        if($request->hasFile('photo'))
      {
         
         $rules = ['photo' => 'mimes:jpg,png,jpeg'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('photo_error', 'Please Upload Only JPG or PNG type image');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        $extension = $request->file('photo')->getClientOriginalExtension();
        $filenametostore = 'photo'.$dte_id.'.'.$extension;
        //Storage::disk('public_uploads')->put($destinationPath, $request->file('photo'));
       // $request->image->move(public_path('/uploads/').$destinationPath, $filenametostore);
        //$path = $destinationPath.'/'.$filenametostore;
       /* $image = Image::make($request->file('photo'))->fit(400, 200);
        $image->save();*/
        $path =  $request->file('photo')->storeAs($destinationPath, $filenametostore,'public_uploads');
        //return $path;
          $me_students->photo_path = $filenametostore;
           $me_students->photo='Yes';
        $me_students->save();
      }

      
        if($request->hasFile('signature'))
      {
        $rules = ['signature' => 'mimes:jpg,png,jpeg'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('signature_error', 'Please Upload Only JPG or PNG type image');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        $extension = $request->file('signature')->getClientOriginalExtension();
        $filenametostore = 'signature'.$dte_id.'.'.$extension;
        $path = $request->file('signature')->storeAs($destinationPath, $filenametostore,'public_uploads');
          $me_students->signature_path = $filenametostore;
           $me_students->signature='Yes';
        $me_students->save();
      }

      
        if($request->hasFile('fc_confirmation_receipt'))
      {
          //return "hello";
        $rules = ['fc_confirmation_receipt' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('fc_confirmation_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        $extension = $request->file('fc_confirmation_receipt')->getClientOriginalExtension();
        $filenametostore = 'fc_confirmation_receipt'.$dte_id.'.'.$extension;
        $path = $request->file('fc_confirmation_receipt')->storeAs($destinationPath, $filenametostore,'public_uploads');
          $me_students->fc_confirmation_receipt_path =$filenametostore;
           $me_students->fc_confirmation_receipt='Yes';
        $me_students->save();
      }

      
          if($request->hasFile('dte_allotment_letter'))
      {
        $rules = ['dte_allotment_letter' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('dte_allotment_letter_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        $extension = $request->file('dte_allotment_letter')->getClientOriginalExtension();
        $filenametostore = 'dte_allotment_letter_'.$dte_id.'.'.$extension;
   
        $path = $request->file('dte_allotment_letter')->storeAs($destinationPath, $filenametostore,'public_uploads');
              $me_students->dte_allotment_letter_path = $filenametostore;
               $me_students->dte_allotment_letter='Yes';
        $me_students->save();
      }

      
    if($request->hasFile('arc_ackw_receipt'))
      {
        $rules = ['arc_ackw_receipt' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('arc_ackw_receipt_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        $extension = $request->file('arc_ackw_receipt')->getClientOriginalExtension();
        $filenametostore = 'arc_ackw_receipt_'.$dte_id.'.'.$extension;
   
        $path = $request->file('arc_ackw_receipt')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->arc_ackw_receipt_path = $filenametostore;
        $me_students->arc_ackw_receipt='Yes';
        $me_students->save();
      }

  
  if($request->hasFile('gate_result'))
      {
        $rules = ['gate_result' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('gate_result_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        $extension = $request->file('gate_result')->getClientOriginalExtension();
        
        $filenametostore = 'gate_result_'.$dte_id.'.'.$extension;
   
        $path = $request->file('gate_result')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->gate_result_path = $filenametostore;
        $me_students->gate_result = 'Yes';
        $me_students->save();
      }


      
 

      
        if($request->hasFile('ssc_marksheet')) 
        {
        
          $rules = ['ssc_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('ssc_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
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
        
              //////echo $path; //
      
      }

      
      if($request->hasFile('hsc_marksheet')) 
      {
        $rules = ['hsc_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('hsc_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        
        
        //get file extension
        $extension = $request->file('hsc_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'hsc_diploma_marksheet'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('hsc_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->hsc_diploma_marksheet_path = $filenametostore;
         $me_students->hsc_diploma_marksheet='Yes';
        $me_students->save();
        
      ////echo $path; //
      
      }

      
      if($request->hasFile('degree_leaving_tc')) 
      {
        $rules = ['degree_leaving_tc' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('degree_leaving_tc_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        
        
        //get file extension
        $extension = $request->file('degree_leaving_tc')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'degree_leaving_tc_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('degree_leaving_tc')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->degree_leaving_tc_path = $filenametostore;
              $me_students->degree_leaving_tc = 'Yes';
        $me_students->save();
        
      ////echo $path; //
      
      }


      
      if($request->hasFile('first_year_marksheet')) 
      {
        $rules = ['first_year_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('first_year_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        
        
        //get file extension
        $extension = $request->file('first_year_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'first_year_marksheet_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('first_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->first_year_marksheet_path = $filenametostore;
           $me_students->first_year_marksheet = 'Yes';
        $me_students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('second_year_marksheet')) 
      {
        $rules = ['second_year_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('second_year_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        
        
        //get file extension
        $extension = $request->file('second_year_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'second_year_marksheet_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('second_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->second_year_marksheet_path = $filenametostore;
                $me_students->second_year_marksheet='Yes';
        $me_students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('third_year_marksheet')) 
      {
        $rules = ['third_year_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('third_year_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        
        
        //get file extension
        $extension = $request->file('third_year_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'third_year_marksheet_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('third_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->third_year_marksheet_path =$filenametostore;
            $me_students->third_year_marksheet='Yes';
        $me_students->save();
        
      //////echo $path; //
      
      }
        if($request->hasFile('fourth_year_marksheet')) 
      {
        $rules = ['fourth_year_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('fourth_year_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        
        
        //get file extension
        $extension = $request->file('fourth_year_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'fourth_year_marksheet_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('fourth_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->fourth_year_marksheet_path =$filenametostore;
            $me_students->fourth_year_marksheet='Yes';
        $me_students->save();
        
      //////echo $path; //
      
      }
      
      

      
      if($request->hasFile('convocation_passing_certi')) 
      {
        $rules = ['convocation_passing_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('convocation_passing_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        
        
        //get file extension
        $extension = $request->file('convocation_passing_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'convocation_passing_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('convocation_passing_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->convocation_passing_certi_path = $filenametostore;
                $me_students->convocation_passing_certi='Yes';
        $me_students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('migration_certi')) 
      {
        $rules = ['migration_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('migration_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        
        
        //get file extension
        $extension = $request->file('migration_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'migration_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('migration_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->migration_certi_path = $filenametostore;
                $me_students->migration_certi='Yes';
        $me_students->save();
      //////echo $path; //
      
      }


      
      if($request->hasFile('birth_certi')) 
      {
        $rules = ['birth_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('birth_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        
        
        //get file extension
        $extension = $request->file('birth_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'birth_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('birth_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $me_students->birth_certi_path = $filenametostore;
                $me_students->birth_certi='Yes';
        $me_students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('domicile')) 
      {
        $rules = ['domicile' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('domicile_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        
        
        //get file extension
        $extension = $request->file('domicile')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'domicile_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('domicile')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->domicile_path =$filenametostore;
                $me_students->domicile='Yes';
        $me_students->save();
        
      //////echo $path; //
      
      }

     
      if($request->hasFile('proforma_o')) 
      {
        $rules = ['proforma_o' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('proforma_o_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        
        
        //get file extension
        $extension = $request->file('proforma_o')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'proforma_o_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('proforma_o')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->proforma_o_path = $filenametostore;
                $me_students->proforma_o='Yes';
        $me_students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('retention')) 
      {
        $rules = ['retention' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('retention_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        
        
        //get file extension
        $extension = $request->file('retention')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'retention_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('retention')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $me_students->retention_path = $filenametostore;
               $me_students->retention='Yes';
        $me_students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('minority_affidavit')) 
      {
        $rules = ['minority_affidavit' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('minority_affidavit_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        
        
        //get file extension
        $extension = $request->file('minority_affidavit')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'minority_affidavit_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('minority_affidavit')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->minority_affidavit_path = $filenametostore;
                $me_students->minority_affidavit='Yes';
        $me_students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('gap_certi')) 
      {
        $rules = ['gap_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('gap_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        
        
        //get file extension
        $extension = $request->file('gap_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'gap_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('gap_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->gap_certi_path =$filenametostore;
                $me_students->gap_certi='Yes';
        $me_students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('community_certi')) 
      {
        $rules = ['community_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('community_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        
        
        //get file extension
        $extension = $request->file('community_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'community_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('community_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->community_certi_path = $filenametostore;
                $me_students->community_certi='Yes';
        $me_students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('caste_certi')) 
      {
        $rules = ['caste_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('caste_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        
        
        //get file extension
        $extension = $request->file('caste_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'caste_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('caste_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $me_students->caste_certi_path =$filenametostore;
                $me_students->caste_certi='Yes';
        $me_students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('caste_validity_certi')) 
      {
        $rules = ['caste_validity_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('caste_validity_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        
        
        //get file extension
        $extension = $request->file('caste_validity_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'caste_validity_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('caste_validity_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $me_students->caste_validity_certi_path = $filenametostore;
               $me_students->caste_validity_certi='Yes';
        $me_students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('non_creamy_layer_certi')) 
      {
        $rules = ['non_creamy_layer_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('non_creamy_layer_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        
        
        //get file extension
        $extension = $request->file('non_creamy_layer_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'non_creamy_layer_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('non_creamy_layer_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $me_students->non_creamy_layer_certi_path = $filenametostore;
                $me_students->non_creamy_layer_certi='Yes';
        $me_students->save();
      //////echo $path; //
      
      }

      
      

      
      if($request->hasFile('proforma_a_b1_b2')) 
      {
        $rules = ['proforma_a_b1_b2' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('proforma_a_b1_b2_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        
        
        //get file extension
        $extension = $request->file('proforma_a_b1_b2')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'proforma_a_b1_b2_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('proforma_a_b1_b2')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $me_students->proforma_a_b1_b2_path = $filenametostore;
                $me_students->proforma_a_b1_b2='Yes';
        $me_students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('proforma_f_f1')) 
      {
        $rules = ['proforma_f_f1' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('proforma_f_f1_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        
        
        //get file extension
        $extension = $request->file('proforma_f_f1')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'proforma_f_f1_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('proforma_f_f1')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->proforma_f_f1_path = $filenametostore;
                $me_students->proforma_f_f1='Yes';

        $me_students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('income_certi')) 
      {
        $rules = ['income_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('income_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        
        
        //get file extension
        $extension = $request->file('income_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'income_certi_'.$dte_id.'.'.$extension;
        
        //Upload file
        $path = $request->file('income_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
      $me_students->income_certi_path = $filenametostore;
            $me_students->income_certi='Yes';
        $me_students->save();
      }

      
      if($request->hasFile('proforma_c_d_e')) 
      {
        $rules = ['proforma_c_d_e' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('proforma_c_d_e_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        $extension = $request->file('proforma_c_d_e')->getClientOriginalExtension();
        $filenametostore = 'proforma_c_d_e'.$dte_id.'.'.$extension;
        $path = $request->file('proforma_c_d_e')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->proforma_c_d_e_path = $filenametostore;
                $me_students->proforma_c_d_e='Yes';
        $me_students->save();
      }

      
      if($request->hasFile('proforma_j_k_l')) 
      {
        $rules = ['proforma_j_k_l' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('proforma_j_k_l_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        $extension = $request->file('proforma_j_k_l')->getClientOriginalExtension();
        $filenametostore = 'proforma_j_k_l_'.$dte_id.'.'.$extension;
        $path = $request->file('proforma_j_k_l')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->proforma_j_k_l_path =$filenametostore;
                $me_students->proforma_j_k_l='Yes';
        $me_students->save();
      }

      
      if($request->hasFile('medical_certi')) 
      {
        $rules = ['medical_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('medical_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        $extension = $request->file('medical_certi')->getClientOriginalExtension();
        $filenametostore = 'medical_certi_'.$dte_id.'.'.$extension;
        $path = $request->file('medical_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->medical_certi_path = $filenametostore;
                $me_students->medical_certi='Yes';
        $me_students->save();
      }

      
      if($request->hasFile('anti_ragging_affidavit')) 
      {
        $rules = ['anti_ragging_affidavit' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('anti_ragging_affidavit_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierMEG');
         }
        $extension = $request->file('anti_ragging_affidavit')->getClientOriginalExtension();
        $filenametostore = 'anti_ragging_affidavit'.$dte_id.'.'.$extension;
        $path = $request->file('anti_ragging_affidavit')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->anti_ragging_affidavit_path = $filenametostore;
                $me_students->anti_ragging_affidavit='Yes';
        $me_students->save();
      }

        $users = DB::table('me_students')->where('dte_id', $dte_id)->get();
        $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        $hash = $hash[0]->hash;


        $data=[];
        $data['users']=$users;
        $data['hash'] = $hash;
        $data['course'] = $course;
      
        return view('admin.adminDocumentVerifierMEG',$data);

      }
        else
            return redirect()->route('adminLogin');
    
    }







public static  function verifyAdminDocumentVerifier(Request $request)
    {
        $email =$request->session()->get('email_id', 'null');
        $course = $request->session()->get('course','null');
       
        if($course == null)
          $course = $request->session()->get('adminCourse');
          
         
     if ($email != 'null')
     {
        $dte_id=$request->session()->get('dte1');
       //return $dte_id;
      $use = DB::table('student_login')->select('hash')->where('dte_id', $dte_id)->get();
      $destinationPath = $dte_id.'_'.$use[0]->hash;
      //  $abc=(int)$request->hasFile('ssc_marksheet');
       
      if($course == "MCA")
      {
        $students = new mca_students;
        if(DB::table('mca_students')->where('dte_id', $dte_id)->exists()) 
          { 
           $students  = mca_students::find($dte_id);
          // return $mca_students;
          }
          else
          {
            $students->dte_id = $dte_id;
          }
      }
        

      // if($course == "FEG")
      // {
      //   $students = new fe_students;
      //   if(DB::table('fe_students')->where('dte_id', $dte_id)->exists()) 
      //     { 
      //      $students  = fe_students::find($dte_id);
          
      //     }
      //     else
      //     {
      //       $students->dte_id = $dte_id;
      //     }
      // }
        
      // if($course == "DSE")
      // {
      //   $students = new dse_students;
      //   if(DB::table('dse_students')->where('dte_id', $dte_id)->exists()) 
      //     { 
      //      $students  = dse_students::find($dte_id);
          
      //     }
      //     else
      //     {
      //       $students->dte_id = $dte_id;
      //     }
      // }
        



        if($request->hasFile('photo'))
      {
         
         $rules = ['photo' => 'mimes:jpg,png,jpeg'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('photo_error', 'Please Upload Only JPG or PNG type image');
          return redirect()->route('adminDocumentVerifier');
         }
        $extension = $request->file('photo')->getClientOriginalExtension();
        $filenametostore = 'photo'.$dte_id.'.'.$extension;
        //Storage::disk('public_uploads')->put($destinationPath, $request->file('photo'));
       // $request->image->move(public_path('/uploads/').$destinationPath, $filenametostore);
        //$path = $destinationPath.'/'.$filenametostore;
       /* $image = Image::make($request->file('photo'))->fit(400, 200);
        $image->save();*/
        $path =  $request->file('photo')->storeAs($destinationPath, $filenametostore,'public_uploads');
        //return $path;
          $students->photo_path = $filenametostore;
           $students->photo='Yes';
        $students->save();
      }

      
        if($request->hasFile('signature'))
      {
        $rules = ['signature' => 'mimes:jpg,png,jpeg'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('signature_error', 'Please Upload Only JPG or PNG type image');
          return redirect()->route('adminDocumentVerifier');
         }
        $extension = $request->file('signature')->getClientOriginalExtension();
        $filenametostore = 'signature'.$dte_id.'.'.$extension;
        $path = $request->file('signature')->storeAs($destinationPath, $filenametostore,'public_uploads');
          $students->signature_path = $filenametostore;
           $students->signature='Yes';
        $students->save();
      }

      
        if($request->hasFile('fc_confirmation_receipt'))
      {
          //return "hello";
        $rules = ['fc_confirmation_receipt' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('fc_confirmation_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        $extension = $request->file('fc_confirmation_receipt')->getClientOriginalExtension();
        $filenametostore = 'fc_confirmation_receipt'.$dte_id.'.'.$extension;
        $path = $request->file('fc_confirmation_receipt')->storeAs($destinationPath, $filenametostore,'public_uploads');
          $students->fc_confirmation_receipt_path =$filenametostore;
           $students->fc_confirmation_receipt='Yes';
        $students->save();
      }

      
          if($request->hasFile('dte_allotment_letter'))
      {
        $rules = ['dte_allotment_letter' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('dte_allotment_letter_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        $extension = $request->file('dte_allotment_letter')->getClientOriginalExtension();
        $filenametostore = 'dte_allotment_letter_'.$dte_id.'.'.$extension;
   
        $path = $request->file('dte_allotment_letter')->storeAs($destinationPath, $filenametostore,'public_uploads');
              $students->dte_allotment_letter_path = $filenametostore;
               $students->dte_allotment_letter='Yes';
        $students->save();
      }

      
    if($request->hasFile('arc_ackw_receipt'))
      {
        $rules = ['arc_ackw_receipt' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('arc_ackw_receipt_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        $extension = $request->file('arc_ackw_receipt')->getClientOriginalExtension();
        $filenametostore = 'arc_ackw_receipt_'.$dte_id.'.'.$extension;
   
        $path = $request->file('arc_ackw_receipt')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->arc_ackw_receipt_path = $filenametostore;
        $students->arc_ackw_receipt='Yes';
        $students->save();
      }

  
  if($request->hasFile('cet_result'))
      {
        $rules = ['cet_result' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('cet_result_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        $extension = $request->file('cet_result')->getClientOriginalExtension();
        $filenametostore = 'cet_result_'.$dte_id.'.'.$extension;
   
        $path = $request->file('cet_result')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->cet_result_path = $filenametostore;
        $students->cet_result = 'Yes';
        $students->save();
      }


      
        if($request->hasFile('ssc_marksheet')) 
        {
        
          $rules = ['ssc_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('ssc_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
  
           //get file extension
        $extension = $request->file('ssc_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'ssc_marksheet_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('ssc_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
                 $students->ssc_marksheet_path = $filenametostore;
                  $students->ssc_marksheet = 'Yes';
        $students->save();
        
              //////echo $path; //
      
      }

      
      if($request->hasFile('hsc_marksheet')) 
      {
        $rules = ['hsc_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('hsc_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        
        
        //get file extension
        $extension = $request->file('hsc_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'hsc_diploma_marksheet'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('hsc_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->hsc_diploma_marksheet_path = $filenametostore;
         $students->hsc_diploma_marksheet='Yes';
        $students->save();
        
      ////echo $path; //
      
      }

      
      if($request->hasFile('degree_leaving_tc')) 
      {
        $rules = ['degree_leaving_tc' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('degree_leaving_tc_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        
        
        //get file extension
        $extension = $request->file('degree_leaving_tc')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'degree_leaving_tc_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('degree_leaving_tc')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->degree_leaving_tc_path = $filenametostore;
              $students->degree_leaving_tc = 'Yes';
        $students->save();
        
      ////echo $path; //
      
      }


      
      if($request->hasFile('first_year_marksheet')) 
      {
        $rules = ['first_year_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('first_year_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        
        
        //get file extension
        $extension = $request->file('first_year_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'first_year_marksheet_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('first_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->first_year_marksheet_path = $filenametostore;
           $students->first_year_marksheet = 'Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('second_year_marksheet')) 
      {
        $rules = ['second_year_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('second_year_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        
        
        //get file extension
        $extension = $request->file('second_year_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'second_year_marksheet_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('second_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->second_year_marksheet_path = $filenametostore;
                $students->second_year_marksheet='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('third_year_marksheet')) 
      {
        $rules = ['third_year_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('third_year_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        
        
        //get file extension
        $extension = $request->file('third_year_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'third_year_marksheet_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('third_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->third_year_marksheet_path =$filenametostore;
            $students->third_year_marksheet='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      

      
      if($request->hasFile('convocation_passing_certi')) 
      {
        $rules = ['convocation_passing_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('convocation_passing_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        
        
        //get file extension
        $extension = $request->file('convocation_passing_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'convocation_passing_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('convocation_passing_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->convocation_passing_certi_path = $filenametostore;
                $students->convocation_passing_certi='Yes';
        $students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('migration_certi')) 
      {
        $rules = ['migration_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('migration_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        
        
        //get file extension
        $extension = $request->file('migration_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'migration_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('migration_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->migration_certi_path = $filenametostore;
                $students->migration_certi='Yes';
        $students->save();
      //////echo $path; //
      
      }


      
      if($request->hasFile('birth_certi')) 
      {
        $rules = ['birth_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('birth_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        
        
        //get file extension
        $extension = $request->file('birth_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'birth_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('birth_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $students->birth_certi_path = $filenametostore;
                $students->birth_certi='Yes';
        $students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('domicile')) 
      {
        $rules = ['domicile' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('domicile_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        
        
        //get file extension
        $extension = $request->file('domicile')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'domicile_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('domicile')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->domicile_path =$filenametostore;
                $students->domicile='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

     
      if($request->hasFile('proforma_o')) 
      {
        $rules = ['proforma_o' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('proforma_o_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        
        
        //get file extension
        $extension = $request->file('proforma_o')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'proforma_o_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('proforma_o')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->proforma_o_path = $filenametostore;
                $students->proforma_o='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('retention')) 
      {
        $rules = ['retention' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('retention_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        
        
        //get file extension
        $extension = $request->file('retention')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'retention_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('retention')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $students->retention_path = $filenametostore;
               $students->retention='Yes';
        $students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('minority_affidavit')) 
      {
        $rules = ['minority_affidavit' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('minority_affidavit_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        
        
        //get file extension
        $extension = $request->file('minority_affidavit')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'minority_affidavit_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('minority_affidavit')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->minority_affidavit_path = $filenametostore;
                $students->minority_affidavit='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('gap_certi')) 
      {
        $rules = ['gap_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('gap_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        
        
        //get file extension
        $extension = $request->file('gap_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'gap_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('gap_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->gap_certi_path =$filenametostore;
                $students->gap_certi='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('community_certi')) 
      {
        $rules = ['community_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('community_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        
        
        //get file extension
        $extension = $request->file('community_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'community_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('community_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->community_certi_path = $filenametostore;
                $students->community_certi='Yes';
        $students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('caste_certi')) 
      {
        $rules = ['caste_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('caste_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        
        
        //get file extension
        $extension = $request->file('caste_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'caste_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('caste_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $students->caste_certi_path =$filenametostore;
                $students->caste_certi='Yes';
        $students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('caste_validity_certi')) 
      {
        $rules = ['caste_validity_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('caste_validity_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        
        
        //get file extension
        $extension = $request->file('caste_validity_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'caste_validity_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('caste_validity_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $students->caste_validity_certi_path = $filenametostore;
               $students->caste_validity_certi='Yes';
        $students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('non_creamy_layer_certi')) 
      {
        $rules = ['non_creamy_layer_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('non_creamy_layer_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        
        
        //get file extension
        $extension = $request->file('non_creamy_layer_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'non_creamy_layer_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('non_creamy_layer_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $students->non_creamy_layer_certi_path = $filenametostore;
                $students->non_creamy_layer_certi='Yes';
        $students->save();
      //////echo $path; //
      
      }

      
      

      
      if($request->hasFile('proforma_a_b1_b2')) 
      {
        $rules = ['proforma_a_b1_b2' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('proforma_a_b1_b2_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        
        
        //get file extension
        $extension = $request->file('proforma_a_b1_b2')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'proforma_a_b1_b2_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('proforma_a_b1_b2')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $students->proforma_a_b1_b2_path = $filenametostore;
                $students->proforma_a_b1_b2='Yes';
        $students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('proforma_f_f1')) 
      {
        $rules = ['proforma_f_f1' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('proforma_f_f1_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        
        
        //get file extension
        $extension = $request->file('proforma_f_f1')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'proforma_f_f1_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('proforma_f_f1')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->proforma_f_f1_path = $filenametostore;
                $students->proforma_f_f1='Yes';

        $students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('income_certi')) 
      {
        $rules = ['income_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('income_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        
        
        //get file extension
        $extension = $request->file('income_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'income_certi_'.$dte_id.'.'.$extension;
        
        //Upload file
        $path = $request->file('income_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
      $students->income_certi_path = $filenametostore;
            $students->income_certi='Yes';
        $students->save();
      }

      
      if($request->hasFile('proforma_c_d_e')) 
      {
        $rules = ['proforma_c_d_e' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('proforma_c_d_e_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        $extension = $request->file('proforma_c_d_e')->getClientOriginalExtension();
        $filenametostore = 'proforma_c_d_e'.$dte_id.'.'.$extension;
        $path = $request->file('proforma_c_d_e')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->proforma_c_d_e_path = $filenametostore;
                $students->proforma_c_d_e='Yes';
        $students->save();
      }

      
      if($request->hasFile('proforma_j_k_l')) 
      {
        $rules = ['proforma_j_k_l' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('proforma_j_k_l_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        $extension = $request->file('proforma_j_k_l')->getClientOriginalExtension();
        $filenametostore = 'proforma_j_k_l_'.$dte_id.'.'.$extension;
        $path = $request->file('proforma_j_k_l')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->proforma_j_k_l_path =$filenametostore;
                $students->proforma_j_k_l='Yes';
        $students->save();
      }

      
      if($request->hasFile('medical_certi')) 
      {
        $rules = ['medical_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('medical_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        $extension = $request->file('medical_certi')->getClientOriginalExtension();
        $filenametostore = 'medical_certi_'.$dte_id.'.'.$extension;
        $path = $request->file('medical_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->medical_certi_path = $filenametostore;
                $students->medical_certi='Yes';
        $students->save();
      }

      
      if($request->hasFile('anti_ragging_affidavit')) 
      {
        $rules = ['anti_ragging_affidavit' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('anti_ragging_affidavit_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifier');
         }
        $extension = $request->file('anti_ragging_affidavit')->getClientOriginalExtension();
        $filenametostore = 'anti_ragging_affidavit'.$dte_id.'.'.$extension;
        $path = $request->file('anti_ragging_affidavit')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $students->anti_ragging_affidavit_path = $filenametostore;
                $students->anti_ragging_affidavit='Yes';
        $students->save();
      }

      if($course =="MCA")
      {

        $users = DB::table('mca_students')->select('dte_id','fc_confirmation_receipt','fc_confirmation_receipt_path','dte_allotment_letter','dte_allotment_letter_path','arc_ackw_receipt','arc_ackw_receipt_path','cet_result','cet_result_path','ssc_marksheet','ssc_marksheet_path','hsc_diploma_marksheet','hsc_diploma_marksheet_path','degree_leaving_tc','degree_leaving_tc_path','first_year_marksheet','first_year_marksheet_path','second_year_marksheet','second_year_marksheet_path','third_year_marksheet','third_year_marksheet_path','migration_certi','migration_certi_path','birth_certi','birth_certi_path','domicile','domicile_path','proforma_o','proforma_o_path','retention','retention_path','minority_affidavit','minority_affidavit_path','gap_certi','gap_certi_path','community_certi','community_certi_path','caste_certi','caste_certi_path','caste_validity_certi','caste_validity_certi_path','non_creamy_layer_certi','non_creamy_layer_certi_path','proforma_a_b1_b2','proforma_a_b1_b2_path','income_certi','convocation_passing_certi','convocation_passing_certi_path','income_certi_path','proforma_c_d_e','proforma_c_d_e_path','anti_ragging_affidavit','anti_ragging_affidavit_path','medical_certi','medical_certi_path','photo','photo_path','signature','signature_path')->where('dte_id', $dte_id)->get();
      }
     /* if($course == "FEG")
      {
        $users = DB::table('fe_students')->where('dte_id',$dte_id)->get();
      }
      if($course == "DSE")
      {
        $users = DB::table('dse_students')->where('dte_id',$dte_id)->get();
      }*/


        $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        $hash = $hash[0]->hash;


        $data=[];
        $data['users']=$users;
        $data['hash'] = $hash;
        $data['course'] = $course;
      
        return view('admin.adminDocumentVerifier',$data);

      }
        else
            return redirect()->route('adminLogin');
    
    }


    public static  function showalldocumentsAcap(Request $request)
    {
        $email =$request->session()->get('email_id', 'null');
    if ($email != 'null')
        {
          $dte_id = $request->session()->get('dte');
          //return $dte_id;
          $user1 = DB::table('mca_students')->select('dte_id','fc_confirmation_receipt','fc_confirmation_receipt_path','dte_allotment_letter','dte_allotment_letter_path','arc_ackw_receipt','arc_ackw_receipt_path','cet_result','cet_result_path','ssc_marksheet','ssc_marksheet_path','hsc_diploma_marksheet','hsc_diploma_marksheet_path','degree_leaving_tc','degree_leaving_tc_path','first_year_marksheet','first_year_marksheet_path','second_year_marksheet','convocation_passing_certi','convocation_passing_certi_path','second_year_marksheet_path','third_year_marksheet','third_year_marksheet_path','migration_certi','migration_certi_path','birth_certi','birth_certi_path','domicile','domicile_path','proforma_o','proforma_o_path','retention','retention_path','minority_affidavit','minority_affidavit_path','gap_certi','gap_certi_path','community_certi','community_certi_path','caste_certi','caste_certi_path','caste_validity_certi','caste_validity_certi_path','non_creamy_layer_certi','non_creamy_layer_certi_path','proforma_a_b1_b2','income_certi','income_certi_path','proforma_c_d_e','proforma_c_d_e_path','anti_ragging_affidavit','anti_ragging_affidavit_path','medical_certi','medical_certi_path','photo','photo_path','signature','signature_path')->where('dte_id', $dte_id)->get();
        $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        //return $hash;
        $hash = $hash[0]->hash;
        $data=[];
        $data['user1']=$user1;
        $data['hash']=$hash;
        //return $user1;
          return view('admin.adminViewAllDocuments',$data);
        }

        else
            return redirect()->route('adminLogin');
    }    



    public static  function showalldocuments(Request $request)
    {
        $email =$request->session()->get('email_id', 'null');
    if ($email != 'null')
        {
          $dte_id = $request->session()->get('dte1');
          //return $dte_id;
          $user1 = DB::table('mca_students')->select('dte_id','fc_confirmation_receipt','fc_confirmation_receipt_path','dte_allotment_letter','dte_allotment_letter_path','arc_ackw_receipt','arc_ackw_receipt_path','cet_result','cet_result_path','ssc_marksheet','ssc_marksheet_path','hsc_diploma_marksheet','hsc_diploma_marksheet_path','degree_leaving_tc','degree_leaving_tc_path','first_year_marksheet','first_year_marksheet_path','second_year_marksheet','convocation_passing_certi','convocation_passing_certi_path','second_year_marksheet_path','third_year_marksheet','third_year_marksheet_path','migration_certi','migration_certi_path','birth_certi','birth_certi_path','domicile','domicile_path','proforma_o','proforma_o_path','retention','retention_path','minority_affidavit','minority_affidavit_path','gap_certi','gap_certi_path','community_certi','community_certi_path','caste_certi','caste_certi_path','caste_validity_certi','caste_validity_certi_path','non_creamy_layer_certi','non_creamy_layer_certi_path','proforma_a_b1_b2','proforma_a_b1_b2_path','income_certi','income_certi_path','proforma_c_d_e','proforma_c_d_e_path','anti_ragging_affidavit','anti_ragging_affidavit_path','proforma_j_k_l','proforma_j_k_l_path','medical_certi','medical_certi_path','photo','photo_path','signature','signature_path')->where('dte_id', $dte_id)->get();
        $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        //return $hash;
        $hash = $hash[0]->hash;
        $data=[];
        $data['user1']=$user1;
        $data['hash']=$hash;
        //return $user1;
          return view('admin.adminViewAllDocuments',$data);
        }

        else
            return redirect()->route('adminLogin');
    }    

     public static  function showalldocumentsFE(Request $request)
    {
        $email =$request->session()->get('email_id', 'null');
    if ($email != 'null')
        {
          $dte_id = $request->session()->get('dte1');
          //return $dte_id;
          $user1 = DB::table('fe_students')->where('dte_id', $dte_id)->get();
        $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        //return $hash;
        $hash = $hash[0]->hash;
        $data=[];
        $data['user1']=$user1;
        $data['hash']=$hash;
        //return $user1;
          return view('admin.adminViewAllDocumentsFE',$data);
        }

        else
            return redirect()->route('adminLogin');
    }    

     public static  function showalldocumentsDSE(Request $request)
    {
        $email =$request->session()->get('email_id', 'null');
    if ($email != 'null')
        {
          $dte_id = $request->session()->get('dte1');
          //return $dte_id;
          $user1 = DB::table('dse_students')->where('dte_id', $dte_id)->get();
        $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        //return $hash;
        $hash = $hash[0]->hash;
        $data=[];
        $data['user1']=$user1;
        $data['hash']=$hash;
        //return $user1;
          return view('admin.adminViewAllDocumentsDSE',$data);
        }

        else
            return redirect()->route('adminLogin');
    }    


public static  function showalldocumentsAcapFE(Request $request)
    {
        $email =$request->session()->get('email_id', 'null');
    if ($email != 'null')
        {
          $dte_id = $request->session()->get('dte1');
          //return $dte_id;
          $user1 = DB::table('fe_students')->where('dte_id', $dte_id)->get();
        $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        //return $hash;
        $hash = $hash[0]->hash;
        $data=[];
        $data['user1']=$user1;
        $data['hash']=$hash;
        //return $user1;
          return view('admin.adminViewAllDocumentsFE',$data);
        }

        else
            return redirect()->route('adminLogin');
    }    

public static  function showalldocumentsAcapDSE(Request $request)
    {
        $email =$request->session()->get('email_id', 'null');
    if ($email != 'null')
        {
          $dte_id = $request->session()->get('dte1');
          //return $dte_id;
          $user1 = DB::table('dse_students')->where('dte_id', $dte_id)->get();
        $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        //return $hash;
        $hash = $hash[0]->hash;
        $data=[];
        $data['user1']=$user1;
        $data['hash']=$hash;
        //return $user1;
          return view('admin.adminViewAllDocumentsDSE',$data);
        }

        else
            return redirect()->route('adminLogin');
    }    

    public static function showAdminAdmit(Request $request)
    {
        $email =$request->session()->get('email_id', 'null');
        $role = $request->session()->get('role');
      if ($email != 'null')
        {
        if($role == "Staff")
        {
          $course = DB::table('admin_login')->select('course')->where('email_id',$email)->get();
           $event = DB::table('admin_login')->select('event')->where('email_id',$email)->get();
        }
        else
        {
          $course =$request->session()->get('adminCourse',null);
          $event =$request->session()->get('adminEvent',null);
        }
             $srno = null;
        
        $array_object = [['dte_id' => null,'name_on_marksheet'=>null,'shift_allotted'=>null]];
        $user = json_decode(json_encode($array_object));
        $array_object = [['branch' => null,'admission_type'=>null]];
        $department = json_decode(json_encode($array_object));
        $array_object = [['status_to' => null]];
        $users = json_decode(json_encode($array_object));
        $array_object = [['payment_mode' => null,'trans_timestamp'=>null,'trans_status'=>null,'trans_amt'=>null,'admission_type'=>null]];
         $payment =  json_decode(json_encode($array_object));
        $array_object = [['balance_amt' => null]];
         $user4 = json_decode(json_encode($array_object));
        $array_object = [['amt' => null]];
        
          $fees = json_decode(json_encode($array_object));
          $part['amt'] = null;

 
     return view('admin.adminAdmit')->with('user',$user)->with('department',$department)->with('users',$users)->with('payment',$payment)->with('course',$course)->with('event',$event)->with('fees',$fees)->with('part',$part)->with('user4',$user4);
    }
        else
            return redirect()->route('adminLogin');
    }

public static function AfterSearchAdminPartPayment(Request $request)
    {
         $dte_id = $request->input('dteId');
         $request->session()->put('dte_id',$dte_id);
         $email =$request->session()->get('email_id', 'null');
         $course =$request->session()->get('adminCourse');
         
        if($course == "MEG")
        {
             if(DB::table('me_students')->where('dte_id','LIKE','%'.$dte_id.'%')->exists())
            $user = DB::table('me_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
            else
                {
                     $array_object = [['dte_id' => $dte_id,'name_on_marksheet'=>'---','category'=>'---']];
                            $user= json_decode(json_encode($array_object));
                }
             if(DB::table('part_payment')->where('dte_id','LIKE','%'.$dte_id.'%')->exists())
                  $upload = DB::table('part_payment')->where('dte_id','LIKE','%'.$dte_id.'%')->get();   
            else
            {
            $array_object = [['partPayment_path' => null]];
            $upload = json_decode(json_encode($array_object));
            }
            
              if(DB::table('admission')->where('dte_id', $dte_id)->exists()) 
                 { 
                      $admission = DB::table('admission')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
                  }
                   else
                   {
                                
                          $array_object = [['branch' => '---','total_amt' => '---','shift_allotted'=> '---','balance_amt'=> '---']];
                           $admission = json_decode(json_encode($array_object));
                    }
                    
    
        return view('admin.adminPartPayment')->with('user',$user)->with('admission',$admission)->with('upload',$upload);
        }
        else if($course == "MCA")
        {
                //if(DB::table('mca_students')->where('dte_id','LIKE','%'.$dte_id.'%')->exists())
                if(DB::table('mca_students')->where('dte_id','LIKE','%'.$dte_id.'%')->exists())
                            $user = DB::table('mca_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
                
                else
                {
                     $array_object = [['dte_id' => $dte_id,'name_on_marksheet'=>'---','category'=>'---']];
                            $user = json_decode(json_encode($array_object));
                }
            
                if(DB::table('part_payment')->where('dte_id','LIKE','%'.$dte_id.'%')->exists())
                    $upload = DB::table('part_payment')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
                
                else
                {
                            $array_object = [['partPayment_path' => null]];
                            $upload = json_decode(json_encode($array_object));
                }
                
        
                if(DB::table('admission')->where('dte_id', $dte_id)->exists()) 
                 { 
                      $admission = DB::table('admission')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
                  }
                   else
                   {
                                
                          $array_object = [['branch' => '---','total_amt' => '---','shift_allotted'=> '---','balance_amt'=> '---']];
                           $admission = json_decode(json_encode($array_object));
                    }
              
             
    
         return view('admin.adminPartPayment')->with('user',$user)->with('admission',$admission)->with('upload',$upload);
        }

        else if($course == "FEG")
        {
              
                if(DB::table('fe_students')->where('dte_id','LIKE','%'.$dte_id.'%')->exists())
                            $user = DB::table('fe_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
                
                else
                {
                     $array_object = [['dte_id' => $dte_id,'name_on_marksheet'=>'---','category'=>'---']];
                            $user = json_decode(json_encode($array_object));
                }
            
                if(DB::table('part_payment')->where('dte_id','LIKE','%'.$dte_id.'%')->exists())
                    $upload = DB::table('part_payment')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
                
                else
                {
                            $array_object = [['partPayment_path' => null]];
                            $upload = json_decode(json_encode($array_object));
                }
                
        
                if(DB::table('admission')->where('dte_id', $dte_id)->exists()) 
                 { 
                      $admission = DB::table('admission')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
                  }
                   else
                   {
                                
                          $array_object = [['branch' => '---','total_amt' => '---','shift_allotted'=> '---','balance_amt'=> '---']];
                           $admission = json_decode(json_encode($array_object));
                    }
              
             
    
         return view('admin.adminPartPayment')->with('user',$user)->with('admission',$admission)->with('upload',$upload);
        }

         else if($course == "DSE")
        {
              
                if(DB::table('dse_students')->where('dte_id','LIKE','%'.$dte_id.'%')->exists())
                            $user = DB::table('dse_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
                
                else
                {
                     $array_object = [['dte_id' => $dte_id,'name_on_marksheet'=>'---','category'=>'---']];
                            $user = json_decode(json_encode($array_object));
                }
                 
                if(DB::table('part_payment')->where('dte_id','LIKE','%'.$dte_id.'%')->exists())
                    $upload = DB::table('part_payment')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
                
                else
                {
                            $array_object = [['partPayment_path' => null]];
                            $upload = json_decode(json_encode($array_object));
                }
                
        
                if(DB::table('admission')->where('dte_id', $dte_id)->exists()) 
                 { 
                      $admission = DB::table('admission')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
                  }
                   else
                   {
                                
                          $array_object = [['branch' => '---','total_amt' => '---','shift_allotted'=> '---','balance_amt'=> '---']];
                           $admission = json_decode(json_encode($array_object));
                    }
              
             
    
         return view('admin.adminPartPayment')->with('user',$user)->with('admission',$admission)->with('upload',$upload);
        }
    }

 public static function AfterSearchAdminPartPaymentreturn(Request $request)
    {
        
        $dte_id =$request->session()->get('dte_id');
      //  return $dte_id;
         $email =$request->session()->get('email_id', 'null');
         $course =$request->session()->get('adminCourse');
        // $course = DB::table('admin_login')->select('course')->where('email_id',$email)->get();
        // return $course;
        if($course == "MEG")
        {
             if(DB::table('me_students')->where('dte_id','LIKE','%'.$dte_id.'%')->exists())
            $user = DB::table('me_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
            if(DB::table('part_payment')->where('dte_id','LIKE','%'.$dte_id.'%')->exists())
                       $upload = DB::table('part_payment')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
            else
                {
                     $array_object = [['dte_id' => $dte_id,'name_on_marksheet'=>'---','category'=>'---']];
                            $user= json_decode(json_encode($array_object));
                }
        }
        else if($course == "MCA")
        {
                //if(DB::table('mca_students')->where('dte_id','LIKE','%'.$dte_id.'%')->exists())
                if(DB::table('mca_students')->where('dte_id','LIKE','%'.$dte_id.'%')->exists())
                            $user = DB::table('mca_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
                
                else
                {
                     $array_object = [['dte_id' => $dte_id,'name_on_marksheet'=>'---','category'=>'---']];
                            $user = json_decode(json_encode($array_object));
                }
        }
        else
            {
                     $array_object = [['dte_id' => $dte_id,'name_on_marksheet'=>'---','category'=>'---']];
                            $user = json_decode(json_encode($array_object));
            }
                
       // return $user;
   
                if(DB::table('admission')->where('dte_id', $dte_id)->exists()) 
                 { 
                      $admission = DB::table('admission')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
                  }
                   else
                   {
                                
                          $array_object = [['branch' => '---','total_amt' => '---','shift_allotted'=> '---','balance_amt'=> '---']];
                           $admission = json_decode(json_encode($array_object));
                    }
                    
        if(DB::table('part_payment')->where('dte_id','LIKE','%'.$dte_id.'%')->exists())
            $upload = DB::table('part_payment')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
            else
            {
            $array_object = [['partPayment_path' => null]];
            $upload = json_decode(json_encode($array_object));
            }

        return view('admin.adminPartPayment')->with('user',$user)->with('admission',$admission)->with('upload',$upload);
    }
    
    public static function AdminPartPaymentUpload(Request $request)
    {
        $dte_id=$request->session()->get('dte_id');
        $destinationPath = '/Part payments';
        $part_payment = new part_payments;
        if(DB::table('part_payment')->where('dte_id', $dte_id)->exists()) 
          { 
           $ex = DB::table('part_payment')->select('part_payment_id')->where('dte_id',$dte_id)->get();
           $part_payment  = part_payments::find($ex[0]->part_payment_id
           );
          }
          else
          {
            $part_payment->dte_id = $dte_id;
          }
        $part_payment->partPayment_path = null;
        if($request->hasFile('partPayment'))
          {
          $rules = ['partPayment' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('partPayment_error', 'Please Upload Only PDF');
          return redirect()->route('adminPartPayment');
         }
        $extension = $request->file('partPayment')->getClientOriginalExtension();
        $filenametostore = $dte_id.'.'.$extension;
        $path =  $request->file('partPayment')->storeAs($destinationPath, $filenametostore,'part_uploads');
        $part_payment->partPayment_path = $filenametostore;
        $part_payment->verified='No';
        $part_payment->save();
        return redirect()->route('adminPartPaymentSearchreturn'); 
      }
      else
      {     
         $user= (new static)->AfterSearchAdminPartPaymentreturn($request);
          
             
      }
    }
    
    
    
    
    
    public static function AfterSearchAdminUsersStudent(Request $request)
    {
         $dte_id = $request->input('dteId');
         $request->session()->put('dte_id',$dte_id);
         $email =$request->session()->get('email_id', 'null');
         $course =$request->session()->get('adminCourse');
    
        // $course = DB::table('admin_login')->select('course')->where('email_id',$email)->get();
        // return $course;
        
          if(DB::table('admission')->where('dte_id','LIKE','%'.$dte_id.'%')->exists())
          { 
              $aduser = DB::table('admission')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
          }
          else
          {
               $array_object = [['branch' => 'No Entry','shift_allotted' => 'No Entry']];
               $aduser = json_decode(json_encode($array_object));
          }
           // return $aduser;
         if($course == 'MEG')
                    $user = DB::table('me_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
         elseif($course=='MCA')
                    $user = DB::table('mca_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
          elseif($course=='FEG')
                    $user = DB::table('fe_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
          elseif($course=='DSE')
                    $user = DB::table('dse_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();


         if(DB::table('status_details')->where('dte_id','LIKE','%'.$dte_id.'%')->exists())
          { 
              $status = DB::table('status_details')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
          }
          else
          {
               $array_object = [['status_to' => 'No Entry']];
               $status = json_decode(json_encode($array_object));
          }
           
        return view('admin.adminUsersStudent')->with('user',$user)->with('aduser',$aduser)->with('status',$status);
    }

   
        public static function AfterSearchAdminAdmit(Request $request)
   {
         $dte_id = $request->input('dteId');
         $email = $request->session()->get('email_id');
         $role =$request->session()->get('role');
        
        if($role == 'Staff')
        {
              $course1 = DB::table('admin_login')->select('course')->where('email_id',$email)->get();
              $course = $course1[0]->course;
              $event1 = DB::table('admin_login')->select('event')->where('email_id',$email)->get(); 
              $event=$event1[0]->event;
              $users = DB::select(DB::raw("SELECT event_to, status_to,course from status_details where dte_id LIKE '%".$dte_id."%' AND event_to LIKE '%".$event1[0]->event."%' AND course LIKE '%".$course."%'  ORDER BY updated_at DESC LIMIT 1"));
        }
        else
        {
            $course =$request->session()->get('adminCourse',null);
            $event =$request->session()->get('adminEvent',null);
             $array_object = [['event' => $event]];
            $event1 = json_decode(json_encode($array_object));
            if($event == "ACAP" || $event == "DTE")
            {
               $users = DB::select(DB::raw("SELECT event_to, status_to,course from status_details where dte_id LIKE '%".$dte_id."%' AND event_to LIKE '%".$event."%' AND course LIKE '%".$course."%'  ORDER BY updated_at DESC LIMIT 1"));

            }
            else
            {
              $request->session()->flash('error','Please set your desired Course');
               return redirect()->route('adminAdmit'); 

            }
        }
        
         $course1 = $course.$event1[0]->event;
        // return $course1;
         // return$event;
       
       if($course == "MEG")
        {
            $user = DB::table('me_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
            if($event == 'DTE')
              $payment = DB::SELECT(DB::RAW("SELECT * FROM fees_transaction WHERE dte_id LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E000' and sub_merchant_id = '422' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E00327'and sub_merchant_id = '422' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E00328' and sub_merchant_id = '422' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E00329' and sub_merchant_id = '422'  "));
              //return $payment;

             if($event == 'ACAP')
            $payment = DB::SELECT(DB::RAW("SELECT * FROM fees_transaction WHERE dte_id LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E000' and sub_merchant_id = '412' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E00327'  and sub_merchant_id = '412' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E00328'  and sub_merchant_id = '412' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E00329'  and sub_merchant_id = '412' "));
           // return $payment;
        }
        else if($course == "MCA")
        {//return $event;
            $user = DB::table('mca_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
             if($event == 'DTE')
              $payment = DB::SELECT(DB::RAW("SELECT * FROM fees_transaction WHERE dte_id LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E000' and sub_merchant_id = '322' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E00327'and sub_merchant_id = '322' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E00328' and sub_merchant_id = '322' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E00329' and sub_merchant_id = '322'  "));
             if($event == 'ACAP')
            $payment = DB::SELECT(DB::RAW("SELECT * FROM fees_transaction WHERE dte_id LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E000' and sub_merchant_id = '312' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E00327'  and sub_merchant_id = '312' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E00328'  and sub_merchant_id = '312' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E00329'  and sub_merchant_id = '312' "));
      // return $payment;
        }
        else if($course == "FEG")
        {// before running this method check the response code and submerchentid for the feg course

            $user = DB::table('fe_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();

             if($event == 'DTE')
              $payment = DB::SELECT(DB::RAW("SELECT * FROM fees_transaction WHERE dte_id LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E000' and sub_merchant_id = '122' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E00327'and sub_merchant_id = '122' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E00328' and sub_merchant_id = '122' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E00329' and sub_merchant_id = '122'  "));
             if($event == 'ACAP')
            $payment = DB::SELECT(DB::RAW("SELECT * FROM fees_transaction WHERE dte_id LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E000' and sub_merchant_id = '112' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E00327'  and sub_merchant_id = '112' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E00328'  and sub_merchant_id = '112' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E00329'  and sub_merchant_id = '112' "));
           // return $payment;
        }


        else if($course == "DSE")
        {// before running this method check the response code and submerchentid for the dse course
            $user = DB::table('dse_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
             if($event == 'DTE')
              $payment = DB::SELECT(DB::RAW("SELECT * FROM fees_transaction WHERE dte_id LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E000' and sub_merchant_id = '222' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E00327'and sub_merchant_id = '222' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E00328' and sub_merchant_id = '222' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E00329' and sub_merchant_id = '222'  "));
             if($event == 'ACAP')
            $payment = DB::SELECT(DB::RAW("SELECT * FROM fees_transaction WHERE dte_id LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E000' and sub_merchant_id = '212' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E00327'  and sub_merchant_id = '212' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E00328'  and sub_merchant_id = '212' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E00329'  and sub_merchant_id = '212' "));
          // return $course1;
        }
       
       // return $payment;
        // $department = DB::select(DB::raw("SELECT * from admission where dte_id LIKE '%".$dte_id."%' AND course LIKE '%".$course."%' AND admission_type LIKE '%".$event."%' order by updated_at desc limit 1"));
        // this change need to be disscussed
          $department = DB::select(DB::raw("SELECT * from admission where dte_id LIKE '%".$dte_id."%' AND course LIKE '%".$course."%' order by updated_at desc limit 1"));
      
     //return  $department;
      //  return $event1[0]->event;
     // return $user;
        if( $users == '[]' || count($users) == 0)
        {    
            
             $request->session()->flash('error', $dte_id.' RECORD NOT FOUND');
              return redirect()->route('adminAdmit'); 

        }
        else if (count($user) > 0 AND $event1[0]->event == 'ACAP')
        {
          //  
            if($users[0]->status_to == 'SEIZED')
            {
               
               if($payment == [])
               {
                
                    $user3 = DB::table('admission')->select('balance_amt')->where('dte_id',$dte_id)->get();
              
             // return $user3[0]->balance_amt; 
                              if($course == "MEG")
                              {// return $user3;
                                   if($user3 == '[]' || $user3[0]->balance_amt == null)
                                 {
                                    //return $users;
                                    $partpay = DB::table('part_payment')->where('dte_id',$dte_id)->get();
                                    if($partpay == '[]' || $partpay[0]->amt == null)
                                    {
                                      $seat_type = DB::table('me_students')->select('acap_category')->where('dte_id',$dte_id)->get();
                                      if($seat_type == '[]' || $seat_type[0]->acap_category == null)
                                      {
                                        $request->session()->flash('error', 'Please fill this page before moving on to payment');
                                        return redirect()->route('me_dte_details');
                                      }
                                      else
                                      {
                                         $array_object = [['balance_amt' => null]];
                                         $user4 = json_decode(json_encode($array_object));
                                        $part['amt'] = null;
                                         $request->session()->put('dte',$dte_id);

                  $request->session()->put('admissID',$department[0]->admission_id);
                  $fees = DB::table('fees_structure')->where('fee_category',$seat_type[0]->acap_category)->where('course',$course)->get();
                  // return $seat_type[0]->acap_category;
                 
                 $request->session()->put('balanceAmt',$user4[0]->balance_amt);
                     $request->session()->put('fees',$fees[0]->amt);
                    $request->session()->put('part',$part['amt']);

                return view('admin.adminAdmit')->with('user',$user)->with('department',$department)->with('users',$users)->with('payment',$payment)->with('course',$course)->with('fees',$fees)->with('part',$part)->with('user4',$user4);                                      
                
                                       }
                                      }

                                  else{

                                          
                                           $array_object = [['balance_amt' => null]];
                                             $user4 = json_decode(json_encode($array_object));
                                          
                                          $part['amt'] = $partpay[0]->amt;
                                           $array_object = [['amt' => null]];
                                             $fees = json_decode(json_encode($array_object));
                                             if(DB::table('admission')->where('dte_id', $dte_id)->exists())
                                             {
                                             DB::table('admission')->where(['dte_id', $dte_id],['admission_type',$event],['course',$course])->update(['granted_amt' => $partpay[0]->amt]);
                                             }
                                            
                                          $request->session()->put('dte',$dte_id);
                                          $request->session()->put('admissID',$department[0]->admission_id);
                                        
                                        $request->session()->put('balanceAmt',$user4[0]->balance_amt);
                             $request->session()->put('fees',$fees[0]->amt);
                            $request->session()->put('part',$part['amt']);

                                        return view('admin.adminAdmit')->with('user',$user)->with('department',$department)->with('users',$users)->with('payment',$payment)->with('course',$course)->with('fees',$fees)->with('part',$part)->with('user4',$user4);
                                             
                                      }
                                    }
                             
                
                                  }
                      
                      
                      else if($course == "MCA")
                      {
                              
                              $partpay = DB::table('part_payment')->where('dte_id',$dte_id)->get();
                              
                                    if($partpay == '[]' )
                                    {
                                        
                                      $seat_type = DB::table('mca_students')->select('acap_category','university_type')->where('dte_id',$dte_id)->get();
                                      
                                      if($seat_type == '[]' || $seat_type[0]->acap_category == null)
                                      {

                                        $request->session()->flash('error', 'Please fill the form');
                                        return redirect()->route('adminAdmit');
                                      }
                                      else
                                      {
                                         $array_object = [['balance_amt' => null]];
                                         $user4 = json_decode(json_encode($array_object));
                                        $part['amt'] = null;
                                         $request->session()->put('dte',$dte_id);
                  $request->session()->put('admissID',$department[0]->admission_id);
                  // $fees = DB::table('fees_structure')->where([['fee_category',$seat_type[0]->acap_category],['course',$course]])->get();
                  $fees = DB::table('fees_structure')->where([['fee_category','ACAP'],['course',$course],['board',$seat_type[0]->university_type]])->get();
                  //  return $fees;
                  $request->session()->put('balanceAmt',$user4[0]->balance_amt);
                     $request->session()->put('fees',$fees[0]->amt);
                    $request->session()->put('part',$part['amt']);
                return view('admin.adminAdmit')->with('user',$user)->with('department',$department)->with('users',$users)->with('payment',$payment)->with('course',$course)->with('fees',$fees)->with('part',$part)->with('user4',$user4)->with('event',$event);
                   
                                        
                                        
                                       
                
                                       }
                                     }
                                      else
                                        {
                                          
                                           $array_object = [['balance_amt' => null]];
                                             $user4 = json_decode(json_encode($array_object));
                                          
                                          $part['amt'] = $partpay[0]->amt;
                                           $array_object = [['amt' => null]];
                                             $fees = json_decode(json_encode($array_object));
                                             if(DB::table('admission')->where('dte_id', $dte_id)->exists())
                                             {
                                             DB::table('admission')->where('dte_id', $dte_id)->where('admission_type',$event)->where('course',$course)->update(['granted_amt' => $partpay[0]->amt]);
                                               DB::table('admission')->where('dte_id', $dte_id)->where('admission_type',$event)->where('course',$course)->update(['balance_amt' => $partpay[0]->amt]);
                                             }
                                            
                                          $request->session()->put('dte',$dte_id);
                                          $request->session()->put('admissID',$department[0]->admission_id);
                                          $request->session()->put('balanceAmt',$user4[0]->balance_amt);
                     $request->session()->put('fees',$fees[0]->amt);
                    $request->session()->put('part',$part['amt']);
                                        return view('admin.adminAdmit')->with('user',$user)->with('department',$department)->with('users',$users)->with('payment',$payment)->with('course',$course)->with('fees',$fees)->with('part',$part)->with('user4',$user4);
                                             
                                          }
                              }


                
               }
               else
               {
                 $request->session()->put('dte',$dte_id);
                // return $department[0]->admission_id;
                  $request->session()->put('admissID',$department[0]->admission_id);
                return view('admin.adminAdmit')->with('user',$user)->with('department',$department)->with('users',$users)->with('payment',$payment)->with('course',$course)->with('event',$event);;
               }
            }



              //=============================================================
              // this will check feg-dse for seized and for cancelled admission   

   if($users[0]->status_to == 'SEIZED')
            {
               if($payment == [])
               {
                            

                    $user3 = DB::table('admission')->select('balance_amt')->where('dte_id',$dte_id)->get();
              
             // return $user3[0]->balance_amt;
                     if($course == "FEG")
                      {
                          // return $department;

                              $partpay = DB::table('part_payment')->where('dte_id',$dte_id)->get();
                              
                                    if($partpay == '[]' )
                                    {
                                        
                                      $seat_type = DB::table('fe_students')->select('acap_category','xii_board')->where('dte_id',$dte_id)->get();
                                      // return $seat_type;
                                      if($seat_type == '[]' || $seat_type[0]->acap_category == null)
                                      {
                                        $request->session()->flash('error', 'Please fill the form');
                                        return redirect()->route('adminAdmit');
                                      }
                                      else
                                      {
                                         $array_object = [['balance_amt' => null]];
                                         $user4 = json_decode(json_encode($array_object));
                                        $part['amt'] = null;
                                         $request->session()->put('dte',$dte_id);
                                    // return $department[0]->admission_id;
                  $request->session()->put('admissID',$department[0]->admission_id);
                  // $fees = DB::table('fees_structure')->where([['fee_category',$seat_type[0]->acap_category],['course',$course],['board',$board]])->get();
                  $fees = DB::table('fees_structure')->where([['fee_category','ACAP'],['course',$course],['board',$seat_type[0]->xii_board]])->get();
                 // return $seat_type[0]->acap_category;
                  //return $payment;
                  // return $fees;
                  
                                        $request->session()->put('balanceAmt',$user4[0]->balance_amt);
                     $request->session()->put('fees',$fees[0]->amt);
                    $request->session()->put('part',$part['amt']);
                return view('admin.adminAdmit')->with('user',$user)->with('department',$department)->with('users',$users)->with('payment',$payment)->with('course',$course)->with('fees',$fees)->with('part',$part)->with('user4',$user4)->with('event',$event);
                   
                                        
                                        
                                       
                
                                       }
                                     }
                                      else
                                        {
                                          
                                           $array_object = [['balance_amt' => null]];
                                             $user4 = json_decode(json_encode($array_object));
                                          
                                          $part['amt'] = $partpay[0]->amt;
                                           $array_object = [['amt' => null]];
                                             $fees = json_decode(json_encode($array_object));
                                            // return $fees;
                                             if(DB::table('admission')->where('dte_id', $dte_id)->exists())
                                             {
                                             DB::table('admission')->where('dte_id', $dte_id)->where('admission_type',$event)->where('course',$course)->update(['granted_amt' => $partpay[0]->amt]);
                                               DB::table('admission')->where('dte_id', $dte_id)->where('admission_type',$event)->where('course',$course)->update(['balance_amt' => $partpay[0]->amt]);
                                             }

                                          $request->session()->put('dte',$dte_id);
                                          $request->session()->put('admissID',$department[0]->admission_id);
                                          //return $fees;
                                          $request->session()->put('balanceAmt',$user4[0]->balance_amt);
                     $request->session()->put('fees',$fees[0]->amt);
                    $request->session()->put('part',$part['amt']);
                                        return view('admin.adminAdmit')->with('user',$user)->with('department',$department)->with('users',$users)->with('payment',$payment)->with('course',$course)->with('fees',$fees)->with('part',$part)->with('user4',$user4);
                                             
                                          }
                              }



                     else if($course == "DSE")
                      {
                              
                              $partpay = DB::table('part_payment')->where('dte_id',$dte_id)->get();
                              
                                    if($partpay == '[]' )
                                    {
                                        
                                      $seat_type = DB::table('dse_students')->select('acap_category')->where('dte_id',$dte_id)->get();
                                     
                                      if($seat_type == '[]' || $seat_type[0]->acap_category == null)
                                      {
                                        $request->session()->flash('error', 'Please fill the form');
                                        return redirect()->route('adminAdmit');
                                      }
                                      else
                                      {
                                         $array_object = [['balance_amt' => null]];
                                         $user4 = json_decode(json_encode($array_object));
                                        $part['amt'] = null;
                                         $request->session()->put('dte',$dte_id);
                                        // return $dte_id;
                  $request->session()->put('admissID',$department[0]->admission_id);
                  $fees = DB::table('fees_structure')->where([['fee_category','ACAP'],['course',$course]])->get();
                  //return $fees;
                  
                  $request->session()->put('balanceAmt',$user4[0]->balance_amt);
                     $request->session()->put('fees',$fees[0]->amt);
                    $request->session()->put('part',$part['amt']);
                return view('admin.adminAdmit')->with('user',$user)->with('department',$department)->with('users',$users)->with('payment',$payment)->with('course',$course)->with('fees',$fees)->with('part',$part)->with('user4',$user4)->with('event',$event);
                   
                                        
                                        
                                       
                
                                       }
                                     }
                                      else
                                        {
                                          
                                           $array_object = [['balance_amt' => null]];
                                             $user4 = json_decode(json_encode($array_object));
                                          
                                          $part['amt'] = $partpay[0]->amt;
                                           $array_object = [['amt' => null]];
                                             $fees = json_decode(json_encode($array_object));
                                             if(DB::table('admission')->where('dte_id', $dte_id)->exists())
                                             {

                                             DB::table('admission')->where('dte_id', $dte_id)->where('admission_type',$event)->where('course',$course)->update(['granted_amt' => $partpay[0]->amt]);
                                               DB::table('admission')->where('dte_id', $dte_id)->where('admission_type',$event)->where('course',$course)->update(['balance_amt' => $partpay[0]->amt]);
                                             }
                                            
                                          $request->session()->put('dte',$dte_id);
                                          $request->session()->put('admissID',$department[0]->admission_id);
                                          $request->session()->put('balanceAmt',$user4[0]->balance_amt);
                                          $request->session()->put('fees',$fees[0]->amt);
                                          $request->session()->put('part',$part['amt']);
                                        return view('admin.adminAdmit')->with('user',$user)->with('department',$department)->with('users',$users)->with('payment',$payment)->with('course',$course)->with('fees',$fees)->with('part',$part)->with('user4',$user4);
                                             
                                          }
                              }
                
               }
               else
               {
              // return $department;
               // when payment is done this else executes
                 $request->session()->put('dte',$dte_id);
                // return $department[0]->admission_id;
                  $request->session()->put('admissID',$department[0]->admission_id);
                return view('admin.adminAdmit')->with('user',$user)->with('department',$department)->with('users',$users)->with('payment',$payment)->with('course',$course)->with('event',$event);;
               }
            }

            $latest_status = DB::select(DB::raw("SELECT * FROM admission WHERE dte_id like '%".$dte_id."%' ORDER BY `updated_at` DESC LIMIT 1;"));
            $c=$latest_status[0]->count;
            //return $latest_status[0]->count;
            // return $latest_status[0]->status;
            
            if($users[0]->status_to == 'CANCELLED' && $latest_status[0]->status == 'INCOMPLETE')
            {
                //return $payment;
               if($payment != [])
               {
                //return $course;
               //  return $department;
               // when payment is done this else executes
                 $request->session()->put('dte',$dte_id);
                // return $department[0]->admission_id;
                  $request->session()->put('admissID',$department[0]->admission_id);
                return view('admin.adminAdmit')->with('user',$user)->with('department',$department)->with('users',$users)->with('payment',$payment)->with('course',$course)->with('event',$event);;
              

                
               }
             }
             else if($users[0]->status_to == 'CANCELLED' && $latest_status[0]->status != 'INCOMPLETE')
               { 
                
                    $user3 = DB::table('admission')->select('balance_amt')->where('dte_id',$dte_id)->get();
              
             
                     if($course == "FEG")
                      {
                        if ($c<8) {
                  // return $department;

                              $partpay = DB::table('part_payment')->where('dte_id',$dte_id)->get();
                             
                                    if($partpay == '[]' )
                                    {
                                      //return $partpay;
                                        
                                      $seat_type = DB::table('fe_students')->select('acap_category')->where('dte_id',$dte_id)->get();
                                      //return $seat_type;
                                     
                                      if($seat_type == '[]' || $seat_type[0]->acap_category == null)
                                      {
                                        $request->session()->flash('error', 'Please fill the form');
                                        return redirect()->route('adminAdmit');
                                      }
                                      else
                                      {
                                         $array_object = [['balance_amt' => null]];
                                         $user4 = json_decode(json_encode($array_object));
                                        $part['amt'] = null;
                                         $request->session()->put('dte',$dte_id);
                                    // return $department[0]->admission_id;
                  $request->session()->put('admissID',$department[0]->admission_id);
                  $fees = DB::table('fees_structure')->where('fee_category',$seat_type[0]->acap_category)->where('course','FEG')->get();
                 $request->session()->put('balanceAmt',$user4[0]->balance_amt);
                     $request->session()->put('fees',$fees[0]->amt);
                    $request->session()->put('part',$part['amt']);
        
              //return $fees;
                  $payment=[];
                 // return $seat_type[0]->acap_category;
                 // return  $payment;
                  
                return view('admin.adminAdmit')->with('user',$user)->with('department',$department)->with('users',$users)->with('payment',$payment)->with('course',$course)->with('fees',$fees)->with('part',$part)->with('user4',$user4)->with('event',$event);
                   
                                        
                                        
                                       
                
                                       }
                                     }
                                      else
                                        {

                                          
                                           $array_object = [['balance_amt' => null]];
                                             $user4 = json_decode(json_encode($array_object));
                                          
                                          $part['amt'] = $partpay[0]->amt;
                                           $array_object = [['amt' => null]];
                                             $fees = json_decode(json_encode($array_object));
                                            // return $fees;
                                             if(DB::table('admission')->where('dte_id', $dte_id)->exists())
                                             {
                                             DB::table('admission')->where('dte_id', $dte_id)->where('admission_type',$event)->where('course',$course)->update(['granted_amt' => $partpay[0]->amt]);
                                               DB::table('admission')->where('dte_id', $dte_id)->where('admission_type',$event)->where('course',$course)->update(['balance_amt' => $partpay[0]->amt]);
                                             }

                                          $request->session()->put('dte',$dte_id);
                                          $request->session()->put('admissID',$department[0]->admission_id);

                                         //return $users;
                                        $request->session()->put('balanceAmt',$users[0]->balance_amt);
                     $request->session()->put('fees',$fees[0]->amt);
                    $request->session()->put('part',$part['amt']);
                                        return view('admin.adminAdmit')->with('user',$user)->with('department',$department)->with('users',$users)->with('payment',$payment)->with('course',$course)->with('fees',$fees)->with('part',$part)->with('user4',$user4);
                                             
                                          }
                                        }
                            else {
                              $request->session()->flash('error', $dte_id. ' STUDENT HAS REACHED THE LIMIT OF ADMITTING ');
                                    return redirect()->route('adminAdmit');

                                 }
                              }

                     else if($course == "DSE")
                      {
                              
                              $partpay = DB::table('part_payment')->where('dte_id',$dte_id)->get();
                              
                                    if($partpay == '[]' )
                                    {
                                        
                                      $seat_type = DB::table('dse_students')->select('acap_category')->where('dte_id',$dte_id)->get();
                                     
                                      if($seat_type == '[]' || $seat_type[0]->acap_category == null)
                                      {
                                        $request->session()->flash('error', 'Please fill the form');
                                        return redirect()->route('adminAdmit');
                                      }
                                      else
                                      {
                                         $array_object = [['balance_amt' => null]];
                                         $user4 = json_decode(json_encode($array_object));
                                        $part['amt'] = null;
                                         $request->session()->put('dte',$dte_id);
                  $request->session()->put('admissID',$department[0]->admission_id);
                  $fees = DB::table('fees_structure')->where('fee_category',$seat_type[0]->acap_category)->get();
                return view('admin.adminAdmit')->with('user',$user)->with('department',$department)->with('users',$users)->with('payment',$payment)->with('course',$course)->with('fees',$fees)->with('part',$part)->with('user4',$user4)->with('event',$event);
                   
                                        
                                        
                                       
                
                                       }
                                     }
                                      else
                                        {
                                          
                                           $array_object = [['balance_amt' => null]];
                                             $user4 = json_decode(json_encode($array_object));
                                          
                                          $part['amt'] = $partpay[0]->amt;
                                           $array_object = [['amt' => null]];
                                             $fees = json_decode(json_encode($array_object));
                                             if(DB::table('admission')->where('dte_id', $dte_id)->exists())
                                             {
                                             DB::table('admission')->where('dte_id', $dte_id)->where('admission_type',$event)->where('course',$course)->update(['granted_amt' => $partpay[0]->amt]);
                                               DB::table('admission')->where('dte_id', $dte_id)->where('admission_type',$event)->where('course',$course)->update(['balance_amt' => $partpay[0]->amt]);
                                             }
                                            
                                          $request->session()->put('dte',$dte_id);
                                          $request->session()->put('admissID',$department[0]->admission_id);
                                        return view('admin.adminAdmit')->with('user',$user)->with('department',$department)->with('users',$users)->with('payment',$payment)->with('course',$course)->with('fees',$fees)->with('part',$part)->with('user4',$user4);
                                             
                                          }
                              }

               }

             // this else is common for both feg-dte and meg-mca

            else
            {
                if($users[0]->status_to == 'INITIATED')
                  $request->session()->flash('error', $dte_id. ' STUDENT HAS NOT SUBMITTED HIS FORM ');
                else if($users[0]->status_to == 'SUBMITTED')
                 $request->session()->flash('error', $dte_id. ' STUDENT HAS NOT SEIZED HIS FORM ');
                else if($users[0]->status_to == 'ADMITTED')
                 $request->session()->flash('error', $dte_id. ' STUDENT HAS ALREADY ADMITTED ');
                else
                   $request->session()->flash('error', $dte_id.' RECORD NOT FOUND');
               
                return redirect()->route('adminAdmit'); 

            }
        } 
        else if(count($user) > 0 AND $event1[0]->event == 'DTE')
        {
            if($users[0]->status_to == 'DOCUMENT_VERIFIED')
            {
                $request->session()->put('dte',$dte_id);
               // return $dte_id;
                 $request->session()->put('admissID',$department[0]->admission_id);
               //return $payment;
              // RETURN $user;
                return view('admin.adminAdmit')->with('user',$user)->with('department',$department)->with('users',$users)->with('payment',$payment)->with('course',$course)->with('event',$event);
            }
            else
            {
                if($users[0]->status_to == 'INITIATED')
                  $request->session()->flash('error', $dte_id.' STUDENT HAS NOT SUBMITTED HIS FORM ');
                else if($users[0]->status_to == 'SUBMITTED')
                 $request->session()->flash('error', $dte_id.' STUDENT HAS NOT SEIZED HIS FORM ');
                else if($users[0]->status_to == 'ADMITTED')
                 $request->session()->flash('error', $dte_id.' STUDENT HAS ALREADY ADMITTED ');
                else
                   $request->session()->flash('error', $dte_id.' RECORD NOT FOUND');  

                return redirect()->route('adminAdmit'); 

            }

        }
        else if(count($user) > 0)
        {
             if($users[0]->status_to == 'SEIZED' || $users[0]->status_to == 'DOCUMENT_VERIFIED')
            {
                 $request->session()->put('dte',$dte_id);
                 //return $department;
                  $request->session()->put('admissID',$department[0]->admission_id);
                return view('admin.adminAdmit')->with('user',$user)->with('department',$department)->with('users',$users)->with('payment',$payment)->with('course',$course);
            }
            else
            {
                if($users[0]->status_to == 'INITIATED')
                  $request->session()->flash('error', $dte_id. ' STUDENT HAS NOT SUBMITTED HIS FORM ');
                else if($users[0]->status_to == 'SUBMITTED')
                 $request->session()->flash('error', $dte_id. ' STUDENT HAS NOT SEIZED HIS FORM ');
                else if($users[0]->status_to == 'ADMITTED')
                 $request->session()->flash('error', $dte_id. ' STUDENT HAS ALREADY ADMITTED ');
                else
                   $request->session()->flash('error', $dte_id.' RECORD NOT FOUND');
               
                return redirect()->route('adminAdmit'); 

            }
        }
        else
        {

             $request->session()->flash('error', $dte_id.' ERROR FETCHING RECORD');
             return redirect()->route('adminAdmit');
        }
        
    }

    
    public static function showSeizerPrintForm(Request $request)
    {
        return view('admin.seizerPrintForm');
    }
    
        public static function postSeizerPrintForm(Request $request)
    {
        $email = $request->session()->get('email_id','null');
          $role = $request->session()->get('role');
      
           if($role=="Admin" || $role=="Super Admin"){
                $course = $request->session()->get('adminCourse','null');
                $event = $request->session()->get('adminEvent');
           }
           
           else if($role=="Staff"){
          $course = $request->session()->get('course');
          $event = $request->session()->get('event');

          //return $course;
        }
        $dte_id=$request->input('dteId');
        
        $user =  DB::select(DB::raw("SELECT event_to, status_to from status_details where dte_id LIKE '%".$dte_id."%' AND event_to LIKE '%".$event."%' ORDER BY updated_at DESC LIMIT 1"));
                //return $user;
        if(($user[0]->status_to == "SUBMITTED" || $user[0]->status_to == "SEIZED") AND $user[0]->event_to == "ACAP" )
        {
            
            if($course == "FEG")
            {
                    $users1 = DB::table("fe_students")->where('dte_id',$dte_id)->get();
                    $users1 = json_decode(json_encode($users1));
                       $users2 = DB::table("student_login")->where('dte_id',$dte_id)->get();
                
                  $users1['email'] = $users2[0]->email;
                  $users1['mobile'] = $users2[0]->mobile;
                  $users1['last_name'] = $users2[0]->last_name;
                  $users1['first_name'] = $users2[0]->first_name;
                  $users1['middle_name'] = $users2[0]->middle_name;
                  $users1['hash'] = $users2[0]->hash;
                  //  $users1['date'] = date("d-m-Y H:i:s");
                  $users1['date']=date("d-m-Y ");
                  //return $users1;
                    view()->share('users1',$users1);
                    $pdf = PDF::loadView('user.fe.pdfview_acap_fe');
                    return $pdf->stream('user.fe.pdfview_acap_fe.pdf');
             
            }
            else if($course =="DSE")
            {
                $users1 = DB::table("dse_students")->where('dte_id',$dte_id)->get();
                $users1 = json_decode(json_encode($users1));
                       $users2 = DB::table("student_login")->where('dte_id',$dte_id)->get();
                
                  $users1['email'] = $users2[0]->email;
                  $users1['mobile'] = $users2[0]->mobile;
                  $users1['last_name'] = $users2[0]->last_name;
                  $users1['first_name'] = $users2[0]->first_name;
                  $users1['middle_name'] = $users2[0]->middle_name;
                  $users1['hash'] = $users2[0]->hash;
                  //  $users1['date'] = date("d-m-Y H:i:s");
                  $users1['date']=date("d-m-Y ");
                
                view()->share('users1',$users1);
                    $pdf = PDF::loadView('user.dse.pdfview_acap_dse');
                    return $pdf->stream('user.dse.pdfview_acap_dse.pdf');
             
                
            }
        
            else if($course =="MCA")
            {
                $users1 = DB::table("mca_students")->where('dte_id',$dte_id)->get();
                $users1 = json_decode(json_encode($users1));
                       $users2 = DB::table("student_login")->where('dte_id',$dte_id)->get();
                
                  $users1['email'] = $users2[0]->email;
                  $users1['mobile'] = $users2[0]->mobile;
                  $users1['last_name'] = $users2[0]->last_name;
                  $users1['first_name'] = $users2[0]->first_name;
                  $users1['middle_name'] = $users2[0]->middle_name;
                  $users1['hash'] = $users2[0]->hash;
                  //  $users1['date'] = date("d-m-Y H:i:s");
                  $users1['date']=date("d-m-Y ");
                
                view()->share('users1',$users1);
                    $pdf = PDF::loadView('user.mca.pdfview_acap_mca');
                    return $pdf->stream('user.mca.pdfview_acap_mca.pdf');
             
                
            }
            
            else if($course =="MEG")
            {
                $users1 = DB::table("me_students")->where('dte_id',$dte_id)->get();
                $users1 = json_decode(json_encode($users1));
                       $users2 = DB::table("student_login")->where('dte_id',$dte_id)->get();
                
                  $users1['email'] = $users2[0]->email;
                  $users1['mobile'] = $users2[0]->mobile;
                  $users1['last_name'] = $users2[0]->last_name;
                  $users1['first_name'] = $users2[0]->first_name;
                  $users1['middle_name'] = $users2[0]->middle_name;
                  $users1['hash'] = $users2[0]->hash;
                  //  $users1['date'] = date("d-m-Y H:i:s");
                  $users1['date']=date("d-m-Y ");
                
                view()->share('users1',$users1);
                    $pdf = PDF::loadView('user.me.pdfview_acap_me');
                    return $pdf->stream('user.me.pdfview_acap_me.pdf');
             
                    
            }
                
        }
        else
        {
             $request->session()->flash('error','THE RECORD NOT FOUND');
                  return redirect()->route('seizerPrintForm');
             
        }
    
        //return view('admin.se
    }
    
    

    public static function showAdminPrintForm(Request $request)
    {
        return view('admin.adminPrintForm');
    }



     public static function postAdminPrintForm(Request $request)
    {
          $email = $request->session()->get('email_id','null');
          $role = $request->session()->get('role');
      
           if($role=="Admin" || $role=="Super Admin"){
                $course = $request->session()->get('adminCourse','null');
                $event = $request->session()->get('adminEvent');
           }
           
           else if($role=="Staff"){
          $course = $request->session()->get('course');
          $event = $request->session()->get('event');

          //return $course;
        }
        $dte_id=$request->input('dteId');
        
        $user = DB::select(DB::raw(" SELECT * from admission where dte_id like '%".$dte_id."%' and status='ADMITTED' order by updated_at desc limit 1"));
    //return $user;
        //if($user[0]->status=='ADMITTED' and $user[0]->balance_amt==0)
        //return $user;
        if($user[0]->status=='ADMITTED')
        {
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
                      //return $users1;
                      $users1 = json_decode(json_encode($users1));
                  }
                  $users2 = DB::table("student_login")->where('dte_id',$dte_id)->get();
                 // return $user;
                  //return $users2;
                  if($event=='DTE')
                  {
                    $users3 = DB::select(DB::raw("SELECT * FROM `dte_allotments` WHERE dte_id LIKE '%".$dte_id."%'"));
                  }

                    $user4 = DB::select(DB::raw("SELECT * FROM `fees_transaction` WHERE dte_id LIKE '%".$dte_id."%' AND trans_status = 'SUCCESS' AND admission_type = '".$event."' ORDER BY payment_timestamp DESC LIMIT 1"));
               //  return $user4;
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

                 if($user4[0]->payment_mode == "CASH")
                 {
                     $user5 = DB::select(DB::raw("SELECT * FROM `cash_details` WHERE email LIKE '%".$users2[0]->email."%' ORDER BY updated_at DESC LIMIT 1")); 
                     $ddno = $user5[0]->recipt_no;
                     $bank_name =null;
                     $amount = $user4[0]->amount;
                     $Trans_id  = null;
                     $ref_no = null;
                 }
                


                 // return $users3;
                 //return $users2[0]->last_name;
                  $users2 = json_decode(json_encode($users2));
                  $users1['email'] = $users2[0]->email;
                  $users1['mobile'] = $users2[0]->mobile;
                  $users1['last_name'] = $users2[0]->last_name;
                  $users1['first_name'] = $users2[0]->first_name;
                  $users1['middle_name'] = $users2[0]->middle_name;
                  $users1['hash'] = $users2[0]->hash;
                  $users1['date'] = date("d-m-Y H:i:s");
                  $users1['dat']=date("d-m-Y ");
                  
                  $users1['payment_mode'] = $user4[0]->payment_mode;
                  $users1['dd_no'] = $ddno;
                  $users1['bank_name'] = $bank_name;
                  $users1['amount'] = $amount;
                  $users1['trans_id'] = $Trans_id;
                  $users1['ref_no'] = $ref_no;
                 // return $user;
                  if($event=='DTE')
                  {
                    $users1['seat_type_allotted']= $users3[0]->dte_seat_type_allotted;
                    $users1['shift_allotted']= $users3[0]->shift_allotted;
                    $users1['branch_allotted']= $users3[0]->branch;
                  }
                  
                  if($event=='ACAP')
                  {
                    $users1['seat_type_alloted']=$user[0]->fees_category;
                    $users1['shift_allotted']=$user[0]->shift_allotted;
                    $users1['branch_allotted']= $user[0]->branch;
                  }
                
                
                  if($course == "MCA")
                  {
                      view()->share('users1',$users1);
                      //return $users1;
                    if($event=='DTE')
                    {
                      return view('user.mca.pdfview',$users1);

                      //  $pdf = PDF::loadView('user.mca.pdfview');
                      // return $pdf->stream('user.mca.pdfview.pdf');
                    }
                    else
                    {
                      return view('user.mca.pdfview',$users1);
                      // $pdf = PDF::loadView('user.mca.pdfview2');
                      // return $pdf->stream('user.mca.pdfview2.pdf'); 
                    }
                     
                  }
                  elseif($course == "MEG")
                  {
                  view()->share('users1',$users1);
                    if($event=='DTE')
                    {
                      return view('user.me.pdfview',$users1);
                      // $pdf = PDF::loadView('user.me.pdfview');
                      // return $pdf->stream('user.me.pdfview.pdf');
                    }
                    else
                    {
                      return view('user.me.pdfview',$users1);
                      // $pdf = PDF::loadView('user.me.pdfview');
                      // return $pdf->stream('user.me.pdfview.pdf');
                    }
                     
                  }
                  elseif($course == "FEG")
                  {

                    view()->share('users1',$users1);
                    if($event=='DTE')
                    {
                      return view('user.fe.pdfview',$users1);
                       // $pdf = PDF::loadView('user.fe.pdfview');
                       // return $pdf->stream('user.fe.pdfview.pdf');
                    }  
                    else
                    {
                       return view('user.fe.pdfview2',$users1);
                        // $pdf = PDF::loadView('user.fe.pdfview2');
                        // return $pdf->stream('user.fe.pdfview2.pdf');
                    }
                  
                  }
                  elseif($course == "DSE")
                  {
                    //Shift alloted is required for DSE and fe
                        view()->share('users1',$users1);
                        if($event=='DTE')
                        {
                         return view('user.dse.pdfview',$users1);  
                         // $pdf = PDF::loadView('user.dse.pdfview');
                         //  return $pdf->stream('user.dse.pdfview.pdf');
                        }
                        else
                        {
                          return view('user.dse.pdfview2',$users1);  
                         // $pdf = PDF::loadView('user.dse.pdfview2');
                         //  return $pdf->stream('user.dse.pdfview2.pdf');
                        }
                    
                  }
                 
                

              }
              else
              {
                  $request->session()->flash('error','THE RECORD NOT FOUND');
                  return redirect()->route('adminPrintForm');
              }

              

        
    }

    public static function postAdminUnseize(Request $request)
    {


         $dte_id = $request->session()->get('dte_id5');
    //return $dte_id;
        $request->session()->put('dte_id',$dte_id);
            $user = DB::select(DB::raw(" SELECT * from status_details where dte_id like '%".$dte_id."%' order by updated_at desc limit 1"));
            $event_from = $user[0]->event_from;
            $event_to = $user[0]->event_to;
            $status_from = $user[0]->status_to;
            $status_to = $user[0]->status_from;
            $course = $user[0]->course;

              date_default_timezone_set("Asia/Kolkata");

             $created_at = date("Y-m-d H:i:s");
             $updated_at = date("Y-m-d H:i:s");

            DB::table('status_details')->insert(
                                      ['dte_id' => $dte_id, 'event_from' => $event_from, 'event_to' => $event_to, 'status_from' => $status_from, 'status_to' => $status_to, 'course' => $course , 'created_at' => $created_at, 'updated_at' => $updated_at]
                                  );
            $request->session()->flash('error','Candidate unseized');
            return redirect()->route('adminTransactionDetails');
        
    }

    public static function showAdminPayment(Request $request)
    {
        return view('admin.adminPayment');
    }

    public static function postAdminAdmit(Request $request)
    {
        //return $id;
        if ($request->session()->has('dte')) 
        {
            $dte_id = $request->session()->pull('dte');
            $request->session()->pull('dte3');
            //return $dte_id;
            $admissionId = $request->session()->get('admissID');
            //return $admissionId;
            $course = $request->session()->get('adminCourse');
            
            //return $course;
            $role =$request->session()->get('role');
            $email =$request->session()->get('email_id');
            
               date_default_timezone_set("Asia/Kolkata");

            //return $email;
            if($role == 'Staff')
             { 
              $staff = DB::table('admin_login')->select('event','course')->where('email_id',$email)->get();
              $event = $staff[0]->event;
              $course = $staff[0]->course;
               }
            else
            {

              $event =$request->session()->get('adminEvent',null);
              $course =$request->session()->get('adminCourse',null);
            }
           // return $course;
             if($course == "MEG")
             {
                 $branch_acap = $request->input('branch');
                $department = DB::table('me_students')->where('dte_id', 'LIKE', '%' . $dte_id . '%')->get();
                 if($event == "DTE")
                    {
                        $users1 = DB::table('me_students')->where('dte_id',$dte_id)->get();
                        $shift =$users1[0]->dte_branch;
                        
                        DB::select("call update_admission_status('$admissionId','$shift','$course','$dte_id')");
                          $user = DB::select(DB::raw(" SELECT * from status_details where dte_id like '%".$dte_id."%' and event_to ='DTE' order by updated_at desc limit 1"));
                        
                
                        if($user[0]->status_to == "DOCUMENT_VERIFIED")
                        {
                       $status = new status_details;
                       $status->dte_id =$dte_id;
                       $status->event_from = $user[0]->event_to;
                       $status->status_from = $user[0]->status_to;
                       $status->event_to ="DTE";
                       $status->status_to ="ADMITTED";
                       $status->course = $user[0]->course;
                       $status->created_at = date("Y-m-d H:i:s");
                       $status->updated_at= date("Y-m-d H:i:s");
                       $status->save();
                      
                              date_default_timezone_set("Asia/Kolkata");
                   
                        $users2 = DB::table("student_login")->where('dte_id',$dte_id)->get();
                        
                        $users1['email'] = $users2[0]->email;
                        $users1['mobile'] = $users2[0]->mobile;
                        $users1['hash'] = $users2[0]->hash;
                        $users1['shift_allotted'] = $shift;
                         $users1['date'] = date("Y-m-d ");
                         
                           $users3 = DB::select(DB::raw("SELECT * FROM `dte_allotments` WHERE dte_id LIKE '%".$dte_id."%'"));
                          // return $users3;
       $user4 = DB::select(DB::raw("SELECT * FROM `fees_transaction` WHERE dte_id LIKE '%".$dte_id."%' AND trans_status = 'SUCCESS' AND admission_type = 'DTE'  ORDER BY payment_timestamp DESC LIMIT 1"));
        //return $user4;

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
        $users1['seat_type_allotted']= $users3[0]->dte_seat_type_allotted;
        $users1['payment_mode'] = $user4[0]->payment_mode;
        $users1['dd_no'] = $ddno;
        $users1['bank_name'] = $bank_name;
        $users1['amount'] = $amount;
        $users1['trans_id'] = $Trans_id;
        $users1['ref_no'] = $ref_no;
        
        //return $users1;
                        //This needs to be uncommented to generate pdf view 

                        // view()->share('users1',$users1);
                        // $pdf = PDF::loadView('user.me.pdfview');
                        //     return $pdf->stream('user.me.pdfview.pdf');

                        return redirect()->route('adminAdmit');
                                               
                       }
                       
                          
                    }            
                    else if($event == "ACAP")
                    {
                      $users1 = DB::table('me_students')->where('dte_id',$dte_id)->get();
                        
                      DB::select("call update_admission_status('$admissionId','$branch_acap','$course','$dte_id')");
                     $user = DB::select(DB::raw("SELECT * FROM `admission` WHERE `dte_id` like '%".$dte_id."%' and status = 'ADMITTED' and `admission_type` ='ACAP' "));
                     $shift = $user[0]->shift_allotted;
                     
                        date_default_timezone_set("Asia/Kolkata");
                   
                        $users2 = DB::table("student_login")->where('dte_id',$dte_id)->get();
                        $users1['email'] = $users2[0]->email;
                        $users1['mobile'] = $users2[0]->mobile;
                        $users1['hash'] = $users2[0]->hash;
                        $users1['shift_allotted'] = $shift;
                         $users1['date'] = date("Y-m-d H:i:s");

                         //This needs to be uncommented to generate pdf view

                        // view()->share('users1',$users1);
                        // $pdf = PDF::loadView('user.me.pdfview2');
                        //     return $pdf->download('user.me.pdfview2.pdf');
                      
                    }
                     else
                        {
                             $request->session()->flash('error', 'ERROR');
                            return redirect()->route('adminAdmit');
                        }

                    return redirect()->route('adminAdmit');
             }


             else if($course == "FEG")
             {   
                  //return "ello";
                 $branch_acap = $request->input('branch');
                $department = DB::table('fe_students')->where('dte_id', 'LIKE', '%' . $dte_id . '%')->get();
              //  return $event;
                 if($event == "DTE")
                    {
                  //return "h";
                      $count = DB::select(DB::raw("SELECT * FROM admission WHERE dte_id like '%".$dte_id."%' ORDER BY `updated_at` DESC LIMIT 1;"));
                       
                       if ($count[0]->count<8 AND $count[0]->status=='INCOMPLETE') { 
                          if($count[0]->count==0){

                                  $users1 = DB::table('fe_students')->where('dte_id',$dte_id)->get();
                                  $shift =$users1[0]->dte_branch;
                                  //return $shift;
                               //   return $shift;
                                 DB::select("call update_admission_status('$admissionId','$shift','$course','$dte_id')");
                                DB::select("call check_status('$dte_id','$admissionId')");
                                    $user = DB::select(DB::raw(" SELECT * from status_details where dte_id like '%".$dte_id."%' and event_to ='DTE' order by updated_at desc limit 1"));
                                  
                                  // return $user;
                                                if($user[0]->status_to == "DOCUMENT_VERIFIED")
                                                {
                                                   // return "h";
                                               $status = new status_details;
                                               $status->dte_id =$dte_id;
                                               $status->event_from = $user[0]->event_to;
                                               $status->status_from = $user[0]->status_to;
                                               $status->event_to ="DTE";
                                               $status->status_to ="ADMITTED";
                                               $status->course = $user[0]->course;
                                               $status->created_at = date("Y-m-d H:i:s");
                                               $status->updated_at= date("Y-m-d H:i:s");
                                               $status->save();
                                              
                                                      date_default_timezone_set("Asia/Kolkata");
                                           
                                                $users2 = DB::table("student_login")->where('dte_id',$dte_id)->get();
                                                
                                                $users1['email'] = $users2[0]->email;
                                                $users1['mobile'] = $users2[0]->mobile;
                                                $users1['hash'] = $users2[0]->hash;
                                                $users1['shift_allotted'] = $shift;
                                                 $users1['date'] = date("Y-m-d ");
                                                 
                                                   $users3 = DB::select(DB::raw("SELECT * FROM `dte_allotments` WHERE dte_id LIKE '%".$dte_id."%'"));
                                                  // return $users3;
                               $user4 = DB::select(DB::raw("SELECT * FROM `fees_transaction` WHERE dte_id LIKE '%".$dte_id."%' AND trans_status = 'SUCCESS' AND admission_type = 'DTE'  ORDER BY payment_timestamp DESC LIMIT 1"));
                                //return $user4;

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
                                $users1['seat_type_allotted']= $users3[0]->dte_seat_type_allotted;
                                $users1['payment_mode'] = $user4[0]->payment_mode;
                                $users1['dd_no'] = $ddno;
                                $users1['bank_name'] = $bank_name;
                                $users1['amount'] = $amount;
                                $users1['trans_id'] = $Trans_id;
                                $users1['ref_no'] = $ref_no;
                                
                                //return $users1;
                                                //This needs to be uncommented to generate pdf view 

                                                // view()->share('users1',$users1);
                                                // $pdf = PDF::loadView('user.fe.pdfview');
                                                //     return $pdf->stream('user.fe.pdfview.pdf');
                                                return redirect()->route('adminAdmit');
                                                                       
                       }
                       
                      }
                    }

                    }            
                    else if($event == "ACAP")
                    {
                      if ($branch_acap == "CMPN1") {
                                $sh="1st-Shift";
                                $branch_acap="CMPN";
                             }
                             else if($branch_acap == "CMPN2"){
                                $sh="2nd-Shift";
                                $branch_acap="CMPN";
                             }
                             else{
                              $sh="-";
                             }

                       // return "hell";
                        $users1 = DB::table('fe_students')->where('dte_id',$dte_id)->get();
                       // return $users1;
                        $count = DB::select(DB::raw("SELECT * FROM admission WHERE dte_id='".$dte_id."'"));
                        $u1 = count($count);
                   // return $u1;
                      if($u1==1)
                      {
                           $count = DB::select(DB::raw("SELECT * FROM admission WHERE dte_id like '%".$dte_id."%' ORDER BY `updated_at` DESC LIMIT 1;"));
                         // return $count;
                          //return $count[0]->status;
                          //return $count[0]->count;
                          if ($count[0]->count<8 AND ($count[0]->status=='INCOMPLETE' AND $count[0]->admission_type=='ACAP')) {
                             

                            if($count[0]->count==0){

                               $adm =admission::find($admissionId);
                     
                               //return $adm;
                               $adm->count=1;
                               $adm->shift_allotted=$sh;
                               $adm->save();

                                  //return $shift;
                                 //
                                  DB::select("call update_admission_status('$admissionId','$branch_acap','$course','$dte_id')");
                                                    }
                                                   }
                   }
                  else {
                      $count = DB::select(DB::raw("SELECT * FROM admission WHERE dte_id like '%".$dte_id."%' ORDER BY `updated_at` DESC LIMIT 2;"));
                     // return $count;
                       // return $count[1]->count;
                        //return $count[1]->status;
                      $prev_count=$count[1]->count;
                      $prev_status=$count[1]->status;
                    //return $count;
                      if ($prev_count<8 AND $prev_status=='CANCELLED') {
                   if($prev_count==2 || $prev_count==4 || $prev_count==6){

                    $adm =admission::find($admissionId);
                     
                     //return $adm;
                     $adm->count=$prev_count+1;
                     $adm->shift_allotted=$sh;
                     $adm->save();


                      DB::select("call update_admission_status('$admissionId','$branch_acap','$course','$dte_id')");
                      //DB::select("call check_status('$dte_id','$admissionId')");
                      
                       }
                     $user = DB::select(DB::raw("SELECT * FROM `admission` WHERE `dte_id` like '%".$dte_id."%' and status = 'ADMITTED' and `admission_type` ='ACAP' "));
                     $shift = $user[0]->shift_allotted;
                     
                        date_default_timezone_set("Asia/Kolkata");
                   
                        $users2 = DB::table("student_login")->where('dte_id',$dte_id)->get();
                        $users1['email'] = $users2[0]->email;
                        $users1['mobile'] = $users2[0]->mobile;
                        $users1['hash'] = $users2[0]->hash;
                        $users1['shift_allotted'] = $shift;
                         $users1['date'] = date("Y-m-d H:i:s");

                         //This needs to be uncommented to generate pdf view

                        // view()->share('users1',$users1);
                        // $pdf = PDF::loadView('user.fe.pdfview2');
                        //     return $pdf->download('user.fe.pdfview2.pdf');
                      
                    


                        }

                         }
                       }
                      
                         else
                        {
                             $request->session()->flash('error', 'ERROR');
                            return redirect()->route('adminAdmit');
                        }


                    return redirect()->route('adminAdmit');
            
           }
             else if($course == "DSE")
             {
                 $branch_acap = $request->input('branch');
                $department = DB::table('dse_students')->where('dte_id', 'LIKE', '%' . $dte_id . '%')->get();
                 if($event == "DTE")
                    {
                        $users1 = DB::table('dse_students')->where('dte_id',$dte_id)->get();
                        $shift =$users1[0]->dte_branch;
                        
                        DB::select("call update_admission_status('$admissionId','$shift','$course','$dte_id')");
                          $user = DB::select(DB::raw(" SELECT * from status_details where dte_id like '%".$dte_id."%' and event_to ='DTE' order by updated_at desc limit 1"));
                        
                
                        if($user[0]->status_to == "DOCUMENT_VERIFIED")
                        {
                       $status = new status_details;
                       $status->dte_id =$dte_id;
                       $status->event_from = $user[0]->event_to;
                       $status->status_from = $user[0]->status_to;
                       $status->event_to ="DTE";
                       $status->status_to ="ADMITTED";
                       $status->course = $user[0]->course;
                       $status->created_at = date("Y-m-d H:i:s");
                       $status->updated_at= date("Y-m-d H:i:s");
                       $status->save();
                      
                              date_default_timezone_set("Asia/Kolkata");
                   
                        $users2 = DB::table("student_login")->where('dte_id',$dte_id)->get();
                        
                        $users1['email'] = $users2[0]->email;
                        $users1['mobile'] = $users2[0]->mobile;
                        $users1['hash'] = $users2[0]->hash;
                        $users1['shift_allotted'] = $shift;
                         $users1['date'] = date("Y-m-d ");
                         
                           $users3 = DB::select(DB::raw("SELECT * FROM `dte_allotments` WHERE dte_id LIKE '%".$dte_id."%'"));
                          // return $users3;
       $user4 = DB::select(DB::raw("SELECT * FROM `fees_transaction` WHERE dte_id LIKE '%".$dte_id."%' AND trans_status = 'SUCCESS' AND admission_type = 'DTE'  ORDER BY payment_timestamp DESC LIMIT 1"));
        //return $user4;

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
 $users1['seat_type_allotted']= $users3[0]->dte_seat_type_allotted;
        $users1['payment_mode'] = $user4[0]->payment_mode;
        $users1['dd_no'] = $ddno;
        $users1['bank_name'] = $bank_name;
        $users1['amount'] = $amount;
        $users1['trans_id'] = $Trans_id;
        $users1['ref_no'] = $ref_no;
        
        //return $users1;
                        //This needs to be uncommented to generate pdf view 

                        // view()->share('users1',$users1);
                        // $pdf = PDF::loadView('user.dse.pdfview');
                        //     return $pdf->stream('user.dse.pdfview.pdf');

                        return redirect()->route('adminAdmit');
                                               
                       }
                       
                          
                    }            
                    else if($event == "ACAP")
                    {
                      $users1 = DB::table('dse_students')->where('dte_id',$dte_id)->get();
                        
                        if ($branch_acap == "CMPN1") {
                                $sh="1st-Shift";
                                $branch_acap="CMPN";
                             }
                             else if($branch_acap == "CMPN2"){
                                $sh="2nd-Shift";
                                $branch_acap="CMPN";
                             }
                             else{
                              $sh="-";
                             }
                     //return $sh;
                      $adm =admission::find($admissionId);
                     
                               //return $adm;
                               $adm->shift_allotted=$sh;
                               $adm->save();

                      DB::select("call update_admission_status('$admissionId','$branch_acap','$course','$dte_id')");
                     $user = DB::select(DB::raw("SELECT * FROM `admission` WHERE `dte_id` like '%".$dte_id."%' and status = 'ADMITTED' and `admission_type` ='ACAP' "));
                     $shift = $user[0]->shift_allotted;
                     
                        date_default_timezone_set("Asia/Kolkata");
                   
                        $users2 = DB::table("student_login")->where('dte_id',$dte_id)->get();
                        $users1['email'] = $users2[0]->email;
                        $users1['mobile'] = $users2[0]->mobile;
                        $users1['hash'] = $users2[0]->hash;
                        $users1['shift_allotted'] = $shift;
                         $users1['date'] = date("Y-m-d H:i:s");

                         //This needs to be uncommented to generate pdf view

                        // view()->share('users1',$users1);
                        // $pdf = PDF::loadView('user.dse.pdfview2');
                        //     return $pdf->download('user.dse.pdfview2.pdf');
                      
                    }
                     else
                        {
                             $request->session()->flash('error', 'ERROR');
                            return redirect()->route('adminAdmit');
                        }

                    return redirect()->route('adminAdmit');
             }
            else if($course == "MCA")
            {
                     $branch_acap = $request->input('shift');
                   // $department = DB::table('mca_students')->where('dte_id', 'LIKE', '%' . $dte_id . '%')->get();
                         if($event == "DTE")
                    {
                        $users1 = DB::table('mca_students')->where('dte_id',$dte_id)->get();
                        
                        $shift =$users1[0]->shift_allotted;
                       // return $shift;
                      DB::select("call update_admission_status('$admissionId','$shift','$course','$dte_id')");
                      //return $shift
                      $user = DB::select(DB::raw(" SELECT * from status_details where dte_id like '%".$dte_id."%' and event_to ='DTE' order by updated_at desc limit 1"));
                        if($user[0]->status_to == "DOCUMENT_VERIFIED")
                        {
                       $status = new status_details;
                       $status->dte_id =$dte_id;
                       $status->event_from = $user[0]->event_to;
                       $status->status_from = $user[0]->status_to;
                       $status->event_to ="DTE";
                       $status->status_to ="ADMITTED";
                       $status->course = $user[0]->course;
                       $status->created_at = date("Y-m-d H:i:s");
                       $status->updated_at= date("Y-m-d H:i:s");
                       $status->save();
                       
                       
                        date_default_timezone_set("Asia/Kolkata");
                   
                        $users2 = DB::table("student_login")->where('dte_id',$dte_id)->get();
                        $users1['email'] = $users2[0]->email;
                        $users1['mobile'] = $users2[0]->mobile;
                        $users1['hash'] = $users2[0]->hash;
                        $users1['shift_allotted'] = $shift;
                         $users1['date'] = date("Y-m-d H:i:s");
                         
                           $users3 = DB::select(DB::raw("SELECT * FROM `dte_allotments` WHERE dte_id LIKE '%".$dte_id."%'"));
       $user4 = DB::select(DB::raw("SELECT * FROM `fees_transaction` WHERE dte_id LIKE '%".$dte_id."%' AND trans_status = 'SUCCESS' AND admission_type = 'DTE' ORDER BY payment_timestamp DESC LIMIT 1"));
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
 $users1['seat_type_allotted']= $users3[0]->dte_seat_type_allotted;
        $users1['payment_mode'] = $user4[0]->payment_mode;
        $users1['dd_no'] = $ddno;
        $users1['bank_name'] = $bank_name;
        $users1['amount'] = $amount;
        $users1['trans_id'] = $Trans_id;
        $users1['ref_no'] = $ref_no;
                        // view()->share('users1',$users1);
                        // $pdf = PDF::loadView('user.mca.pdfview');
                        //     return $pdf->stream('user.mca.pdfview.pdf');
                        }
                    }            
                    else if($event == "ACAP")
                    {
                         $users1 = DB::table('mca_students')->where('dte_id',$dte_id)->get();
                        
                      DB::select("call update_admission_status('$admissionId','$branch_acap','$course','$dte_id')");
                     $user = DB::select(DB::raw("SELECT * FROM `admission` WHERE `dte_id` like '%".$dte_id."%' and status = 'ADMITTED' and `admission_type` ='ACAP' "));
                     $shift = $user[0]->shift_allotted;
                     
                        date_default_timezone_set("Asia/Kolkata");
                   
                        $users2 = DB::table("student_login")->where('dte_id',$dte_id)->get();
                        $users1['email'] = $users2[0]->email;
                        $users1['mobile'] = $users2[0]->mobile;
                        $users1['hash'] = $users2[0]->hash;
                        $users1['shift_allotted'] = $shift;
                         $users1['date'] = date("Y-m-d H:i:s");
                        // view()->share('users1',$users1);
                        // $pdf = PDF::loadView('user.mca.pdfview2');
                        //     return $pdf->download('user.mca.pdfview2.pdf');
                       
                    }   
           
            else
            { 

                 //return "Hello";
                 $request->session()->flash('error', 'ERROR');
                return redirect()->route('adminAdmit');
            }
            
         }
           else
         {
            return redirect()->route('adminAdmit');  
         }

         $request->session()->flash('error', $dte_id.' HAS SUCCESSFULLY BEEN ADMITTED');
            return redirect()->route('adminAdmit');
       
    }
}
    public static function showAdminCancelAdmission(Request $request)
    {
        $email =$request->session()->get('email_id', 'null');
        $role =$request->session()->get('role');
    if ($email != 'null')
    {
         if($role == 'Staff')
        {
          $course = DB::table('admin_login')->select('course')->where('email_id',$email)->get();  
       
        }
        else
        {
             $course =$request->session()->get('adminCourse',null);
            
        }
             $srno = null;
        $array_object = [['dte_id' => null,'name_on_marksheet'=>null]];
        $user = json_decode(json_encode($array_object));
        $array_object = [['branch' => null,'admission_type'=>null,'shift_allotted'=>null]];
        $department = json_decode(json_encode($array_object));
        $array_object = [['status_to' => null]];
        $users = json_decode(json_encode($array_object));
        $array_object = [['payment_mode' => null,'trans_timestamp'=>null,'trans_status'=>null,'trans_amt'=>null]];
         $payment =  json_decode(json_encode($array_object));

     return view('admin.adminCancelAdmission')->with('user',$user)->with('department',$department)->with('users',$users)->with('payment',$payment)->with('course',$course);
    }
        else
            return redirect()->route('adminLogin');
    }

    public static function AfterSearchAdminCancelAdmission(Request $request)
    {
         $dte_id = $request->input('dteId');
         $email = $request->session()->get('email_id');
         $role =$request->session()->get('role');
        
         if ($email != 'null')
        {
         if($role == 'Staff')
        {
          $data = DB::table('admin_login')->select('course','event')->where('email_id',$email)->get();
          $course=$data[0]->course;
          $event=$data[0]->event;
       
        }
        else
        {
             $course =$request->session()->get('adminCourse',null);
             $event= $request->session()->get('adminEvent',null);
            
        }  
        //return $event;
         $srno = 1;
        $course1 = $course.$event;
        // $user = DB::table('me_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
        // $department = DB::table('admission')->where('dte_id', 'LIKE', '%' . $dte_id . '%')->get(); 

         $department = DB::select(DB::raw("SELECT *  from admission where dte_id LIKE '%".$dte_id."%'  ORDER BY updated_at DESC LIMIT 1"));   

         $event1 =DB::table('admin_login')->where('email_id', 'LIKE', '%' . $email . '%')->get();
         $payment = DB::table('fees_transaction')->where('dte_id', 'LIKE', '%' . $dte_id . '%')->get();  
          //  return $role;
         //return $department;

        if($role == 'Staff')
        {
          //$course = DB::table('admin_login')->select('course')->where('email_id',$email)->get();  
        $users = DB::select(DB::raw("SELECT event_to, status_to from status_details where dte_id LIKE '%".$dte_id."%' and status_to='ADMITTED' AND event_to LIKE '%".$event."%' AND status_to='ADMITTED' ORDER BY updated_at DESC LIMIT 1"));
        }
        else
        {
             //$course =$request->session()->get('adminCourse',null);
            $users = DB::select(DB::raw("SELECT event_to, status_to from status_details where dte_id LIKE '%".$dte_id."%' and status_to='ADMITTED'  ORDER BY updated_at DESC LIMIT 1"));
        }
       // return $course;
          if($course == "MEG")
        {
            $user = DB::table('me_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
            if($event == 'DTE')
              $payment = DB::SELECT(DB::RAW("SELECT * FROM fees_transaction WHERE dte_id LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E000' and sub_merchant_id = '422' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E00327'and sub_merchant_id = '422' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E00328' and sub_merchant_id = '422' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E00329' and sub_merchant_id = '422'  "));
            //return $payment;

             if($event == 'ACAP')
            $payment = DB::SELECT(DB::RAW("SELECT * FROM fees_transaction WHERE dte_id LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E000' and sub_merchant_id = '412' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E00327'  and sub_merchant_id = '412' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E00328'  and sub_merchant_id = '412' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E00329'  and sub_merchant_id = '412' "));
       
            //return $payment;
        }
        else if($course == "MCA")
        {
            $user = DB::table('mca_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
             if($event == 'DTE')
              $payment = DB::SELECT(DB::RAW("SELECT * FROM fees_transaction WHERE dte_id LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E000' and sub_merchant_id = '322' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E00327'and sub_merchant_id = '322' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E00328' and sub_merchant_id = '322' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E00329' and sub_merchant_id = '322'  "));
   // return $payment;
             if($event == 'ACAP')
            $payment = DB::SELECT(DB::RAW("SELECT * FROM fees_transaction WHERE dte_id LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E000' and sub_merchant_id = '312' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E00327'  and sub_merchant_id = '312' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E00328'  and sub_merchant_id = '312' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E00329'  and sub_merchant_id = '312' "));
        }

        else if($course == "FEG")
        {
            $user = DB::table('fe_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
             if($event == 'DTE')
              $payment = DB::SELECT(DB::RAW("SELECT * FROM fees_transaction WHERE dte_id LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E000' and sub_merchant_id = '122' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E00327'and sub_merchant_id = '122' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E00328' and sub_merchant_id = '122' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E00329' and sub_merchant_id = '122'  "));
             if($event == 'ACAP')
            $payment = DB::SELECT(DB::RAW("SELECT * FROM fees_transaction WHERE dte_id LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E000' and sub_merchant_id = '112' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E00327'  and sub_merchant_id = '112' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E00328'  and sub_merchant_id = '112' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E00329'  and sub_merchant_id = '112' "));
        }
        
        else if($course == "DSE")
        {
            $user = DB::table('dse_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
             if($event == 'DTE')
              $payment = DB::SELECT(DB::RAW("SELECT * FROM fees_transaction WHERE dte_id LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E000' and sub_merchant_id = '222' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E00327'and sub_merchant_id = '222' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E00328' and sub_merchant_id = '222' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'DTE' and course LIKE '%".$course1."%' and response_code = 'E00329' and sub_merchant_id = '222'  "));
             if($event == 'ACAP')
            $payment = DB::SELECT(DB::RAW("SELECT * FROM fees_transaction WHERE dte_id LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E000' and sub_merchant_id = '212' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E00327'  and sub_merchant_id = '212' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E00328'  and sub_merchant_id = '212' OR dte_id  LIKE '%".$dte_id."%' and admission_type = 'ACAP' and course LIKE '%".$course1."%' and response_code = 'E00329'  and sub_merchant_id = '212' "));
        }
      //return $department;
       // return $users;
       // return $event1[0]->event;
        if($user == '[]' || $users == '[]')
        {
            $request->session()->flash('error', $dte_id.' ERROR FETCHING RECORD');
            return redirect()->route('adminCancelAdmission');
        }
        
    
        else if (count($users) > 0 AND $event1[0]->event == 'ACAP')
        {
                 // return $users;

            if($users[0]->status_to == 'ADMITTED')
            {
                 $request->session()->put('dte',$dte_id);

                  $request->session()->put('admissType',$department[0]->admission_type);
                return view('admin.adminCancelAdmission')->with('user',$user)->with('department',$department)->with('users',$users)->with('payment',$payment)->with('course',$course);
            }
            else
            {
                if($users[0]->status_to == 'INITIATED')
                  $request->session()->flash('error', $dte_id. ' STUDENT HAS NOT SUBMITTED HIS FORM ');
                else if($users[0]->status_to == 'SUBMITTED')
                 $request->session()->flash('error', $dte_id. ' STUDENT HAS NOT SEIZED HIS FORM ');
                else if($users[0]->status_to == 'CANCELLED')
                 $request->session()->flash('error', $dte_id. ' STUDENT HAS ALREADY CANCELLED ');
                else
                   $request->session()->flash('error', $dte_id.' RECORD NOT FOUND');
               
                return redirect()->route('adminCancelAdmission'); 

            }
        } 
        else if(count($users) > 0 AND $event1[0]->event == 'DTE')
        {
            // return $users[0]->status_to;

            if($users[0]->status_to == 'ADMITTED')
            { 
                $request->session()->put('dte',$dte_id);
                // return $department[0]->admission_type;

                 $request->session()->put('admissType',$department[0]->admission_type);
                return view('admin.adminCancelAdmission')->with('user',$user)->with('department',$department)->with('users',$users)->with('payment',$payment)->with('course',$course);
            }
            else
            {
                if($users[0]->status_to == 'INITIATED')
                  $request->session()->flash('error', $dte_id.' STUDENT HAS NOT SUBMITTED HIS FORM ');
                else if($users[0]->status_to == 'SUBMITTED')
                 $request->session()->flash('error', $dte_id.' STUDENT HAS NOT SEIZED HIS FORM ');
                else if($users[0]->status_to == 'CANCELLED')
                 $request->session()->flash('error', $dte_id.' STUDENT HAS ALREADY CANCELLED ');
                else
                   $request->session()->flash('error', $dte_id.' RECORD NOT FOUND');  

                return redirect()->route('adminCancelAdmission'); 

            }

        }
        else if(count($user) > 0)
        { 

             if($users[0]->status_to == 'ADMITTED' )
            {
                  $request->session()->put('dte',$dte_id);
                  $request->session()->put('admissType',$department[0]->admission_type);
                return view('admin.adminCancelAdmission')->with('user',$user)->with('department',$department)->with('users',$users)->with('payment',$payment)->with('course',$course);
            }
            else
            {
                if($users[0]->status_to == 'INITIATED')
                  $request->session()->flash('error', $dte_id. ' STUDENT HAS NOT SUBMITTED HIS FORM ');
                else if($users[0]->status_to == 'SUBMITTED')
                 $request->session()->flash('error', $dte_id. ' STUDENT HAS NOT SEIZED HIS FORM ');
                else if($users[0]->status_to == 'CANCELLED')
                 $request->session()->flash('error', $dte_id. ' STUDENT HAS ALREADY CANCELLED ');
                else
                   $request->session()->flash('error', $dte_id.' RECORD NOT FOUND');
               
                return redirect()->route('adminCancelAdmission'); 

            }
        }
        else
        {

             $request->session()->flash('error', $dte_id.' ERROR FETCHING RECORD');
             return redirect()->route('adminCancelAdmission');
        }
        }
        else{
            return redirect()->route('logout');
        }
        
    }

     public static function postAdminCancelAdmission(Request $request)
    {
        //return $id;
        if ($request->session()->has('dte')) 
        {
          
            $dte_id = $request->session()->pull('dte');
             //return $dte_id;
            $admissionType = $request->session()->pull('admissType');
 
           $admissionId= DB::table('admission')->select('admission_id')->where('dte_id','LIKE','%'.$dte_id.'%')->get()[0]->admission_id;

            //return $admissionId;
            //return $admissionType;
            DB::select("call insert_admission_cancelled('$dte_id','$admissionType')");
           // DB::select("call check_status('$dte_id','$admissionId')");
            $request->session()->flash('error', $dte_id.' HAS SUCCESSFULLY BEEN CANCELLED');
            return redirect()->route('adminCancelAdmission');
         }
         else
         {
            return redirect()->route('adminCancelAdmission');  
         }
    }


    public static function postAdminPartPayment(Request $request)
    {
  
        
        if ($request->session()->has('dte_id')) 
        {
           
             $grantAmt  = $request->input('partFees');
            $dte_id = $request->session()->pull('dte_id');
             DB::table('part_payment')->where('dte_id',$dte_id)->update(['amt' => $grantAmt,'verified' => 'Yes']);
             $request->session()->flash('error','Process successfully ');
              return redirect()->route('adminPartPayment');  
         
         }
         else
         {
            return redirect()->route('adminPartPayment');  
         }
    }




  //   public static  function showAdminUploadAllotmentList(Request $request)
  //   {
  //       $email =$request->session()->get('email_id', 'null');
  //   if ($email != 'null')
  //       return view('admin.adminUploadAllotmentList');
  //       else
  //           return redirect()->route('adminLogin');
  //   }

  //   public static function postAdminUploadAllotmentList(Request $request)
  //   {
  //      $destinationPath = "allotments";
  //      $filenametostore = "dte_allotments.csv";
  //       if($request->hasFile('fileup'))
  //       {
  // $file = $request->file('fileup')->storeAs($destinationPath, $filenametostore,'dte_allotment_uploads');
        
  //       if (($handle = fopen ( public_path () . '/allotments/dte_allotments.csv', 'r' )) !== FALSE) {
  //       while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {
  //           $dte_allotments = new dte_allotments;
  //           $dte_allotments ->dte_id = $data [0];
  //           $dte_allotments ->branch = $data [1];
  //           $dte_allotments ->shift_allotted = $data [2];
  //           $dte_allotments ->course_allotted = $data [3];
  //           $dte_allotments ->allotted_cap_round = $data [4];
  //   $dte_allotments ->dte_seat_type_allotted = $data [5];
  //   $dte_allotments ->choice_code_allotted = $data [6];
  //   $dte_allotments ->course_allotted_code = $data [7];
  //           $dte_allotments ->save ();
  //       }
  //       fclose ( $handle );
  //     }
  //     return redirect()->route('adminUploadAllotmentList');
  // }
    
  //   }


//changes by kartik
    public static  function showAdminUploadAllotmentList(Request $request)
    {
        $email =$request->session()->get('email_id', 'null');
    if ($email != 'null')
        return view('admin.adminUploadAllotmentList');
        else
            return redirect()->route('adminLogin');
    }

    public static function postAdminUploadAllotmentList(Request $request)
    {
       $destinationPath = "allotments";
       $filenametostore = "dte_allotments.csv";
        if($request->hasFile('fileup'))
        {
  $file = $request->file('fileup')->storeAs($destinationPath, $filenametostore,'dte_allotment_uploads');
        
        if (($handle = fopen ( public_path () . '/allotments/dte_allotments.csv', 'r' )) !== FALSE) {
        while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {
            $dte_allotments = new dte_allotments;
            $user = dte_allotments::where('dte_id', '=', $data[0])->first();
            
            $dte_allotments ->dte_id = $data [0];
            $dte_allotments ->branch = $data [1];
            $dte_allotments ->shift_allotted = $data [2];
            $dte_allotments ->course_allotted = $data [3];
            $dte_allotments ->allotted_cap_round = $data [4];
    $dte_allotments ->dte_seat_type_allotted = $data [5];
    $dte_allotments ->choice_code_allotted = $data [6];
    $dte_allotments ->course_allotted_code = $data [7];

            if($user=="")
            {            
            $dte_allotments ->save ();              
        }
        else{
          $user->delete();
          $dte_allotments->save();

          // return $dte_allotments;

        }
      }
        fclose ( $handle );
      }
      // return "done";
      return redirect()->route('adminUploadAllotmentList');
  }
    
    }
    //changes by kartik
    public static function showAdminPartPayment(Request $request)
    {
        $email =$request->session()->get('email_id', 'null');
         if ($email != 'null')
         {
        $array_object = [['dte_id'=> null,'name_on_marksheet' => null, 'category' => null]];
        $user = json_decode(json_encode($array_object));
        $array_object = [['branch'=> null,'total_amt' => null,'shift_allotted'=> null,'balance_amt'=>null]];
        $admission = json_decode(json_encode($array_object));
        $array_object = [['partPayment_path' => null]];
        $upload = json_decode(json_encode($array_object));
        return view('admin.adminPartPayment')->with('admission',$admission)->with('user',$user)->with('upload',$upload);
        
         }
         else
            return redirect()->route('adminLogin');
    }

   
   
    public static function showAdminLosAcapApplied(Request $request)
    {
         $role =$request->session()->get('role', 'null');
         //value to be taken from session;

    if ($role != 'null' && ($role=='Admin' || $role=='Super Admin') )
        {

            $course = $request->session()->get('adminCourse','null');
            $event = $request->session()->get('adminEvent','null');

            if($course == 'null' || $event == 'null' || $course == "...Select Your Course" || $event == "...Select Your event")
              {
                 $request->session()->flash('error', 'Please select Course and Event');
                   
                  return redirect()->route('adminsEvent');
              }
            else
            {
              if($course =="MEG")
               { 
                  $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,me.name_on_marksheet,me.course_allotted,me.gate_score,me.gate_month,me.gate_year,me.gate_max_marks,me.degree_final_cgpa,me.sponsoring_company FROM status_details m1 INNER JOIN me_students me ON m1.dte_id = me.dte_id AND m1.event_to = 'ACAP'  AND m1.course LIKE '%".$course."%'  LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
                               // Get current page form url e.x. &page=1
                    $currentPage = LengthAwarePaginator::resolveCurrentPage();
             
                    // Create a new Laravel collection from the array data
                    $itemCollection = collect($users);
             
                    // Define how many items we want to be visible in each page
                    $perPage = 10;
             
                    // Slice the collection to get the items to display in current page
                    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
             
                    // Create our paginator and pass it to the view
                    $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
             
                    // set url path for generted links
                    $paginatedItems->setPath($request->url());
                    if($users == [] || $users == null)
                      $links = "No";
                    else
                      $links = "Yes";   
                }
                if($course == "MCA")
                {
                  $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,mca.name_on_marksheet,mca.course_allotted,mca.cet_score,mca.cet_month,mca.cet_year,mca.cet_percentile,mca.degree_final_cgpa FROM status_details m1 INNER JOIN mca_students mca ON m1.dte_id = mca.dte_id AND m1.event_to = 'ACAP'  AND m1.course LIKE '%".$course."%'  LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
                               // Get current page form url e.x. &page=1
                    $currentPage = LengthAwarePaginator::resolveCurrentPage();
             
                    // Create a new Laravel collection from the array data
                    $itemCollection = collect($users);
             
                    // Define how many items we want to be visible in each page
                    $perPage = 10;
             
                    // Slice the collection to get the items to display in current page
                    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
             
                    // Create our paginator and pass it to the view
                    $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
             
                    // set url path for generted links
                    $paginatedItems->setPath($request->url());
                    if($users == [] || $users == null)
                      $links = "No";
                    else
                      $links = "Yes";
                }
                if($course == "FEG")
                {
                  $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,fe.name_on_marksheet,fe.jee_seat_no,fe.jee_score,fe.jee_month,fe.jee_year,fe.cet_seat_no,fe.cet_month,fe.cet_year,fe.cet_score FROM status_details m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.event_to = 'ACAP'  AND m1.course LIKE '%".$course."%'  LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
                  //return $users;
                               // Get current page form url e.x. &page=1
                    $currentPage = LengthAwarePaginator::resolveCurrentPage();
             
                    // Create a new Laravel collection from the array data
                    $itemCollection = collect($users);
             
                    // Define how many items we want to be visible in each page
                    $perPage = 10;
             
                    // Slice the collection to get the items to display in current page
                    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
             
                    // Create our paginator and pass it to the view
                    $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
             
                    // set url path for generted links
                    $paginatedItems->setPath($request->url());
                    if($users == [] || $users == null)
                      $links = "No";
                    else
                      $links = "Yes";
                }
                if($course == "DSE")
                {
                  // ,dse.diploma_aggr_obt_sem6 this was part of code

                  $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,dse.name_on_marksheet,m1.updated_at,dse.diploma_aggr_max_sem6,dse.diploma_aggr_obt_sem6,dse.diploma_passing_month,dse.diploma_passing_year,dse.diploma_aggr_percent_sem6 FROM status_details m1 INNER JOIN dse_students dse ON m1.dte_id = dse.dte_id AND m1.event_to = 'ACAP'  AND m1.course LIKE '%".$course."%'  LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
                               // Get current page form url e.x. &page=1
                    $currentPage = LengthAwarePaginator::resolveCurrentPage();
             
                    // Create a new Laravel collection from the array data
                    $itemCollection = collect($users);
             
                    // Define how many items we want to be visible in each page
                    $perPage = 10;
             
                    // Slice the collection to get the items to display in current page
                    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
             
                    // Create our paginator and pass it to the view
                    $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
             
                    // set url path for generted links
                    $paginatedItems->setPath($request->url());
                    if($users == [] || $users == null)
                      $links = "No";
                    else
                      $links = "Yes";
                }

             return view('admin.adminLosAcapApplied',['users' => $paginatedItems])->with('course',$course)->with('links',$links);
           }
        }   
    else
            return redirect()->route('adminLogin');
    }

    public function pdfviewMca1(Request $request)
    {
         $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,mca.name_on_marksheet,mca.cet_score,mca.cet_month,mca.cet_year,mca.cet_percentile,mca.degree_final_cgpa FROM status_details m1 INNER JOIN mca_students mca ON m1.dte_id = mca.dte_id AND m1.event_to = 'ACAP'  AND m1.course ='MCA' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
   
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewMCA1');
            return $pdf->stream('admin.pdfviewMCA1.pdf');
        }
        return view('admin.pdfviewMCA1');
    }

    public function CSVViewMca1(Request $request)
    {
      //  return "Hello";
         $a1 = $this->random(); 
         $path = 'C:/xampp/htdocs/Admission_mca/public/MCA_ACAP_Applied_export'.$a1.'.csv';
         $fileName = 'MCA_ACAP_Applied_export'.$a1.'.csv';
       //  return $path;
         $users = DB::select(DB::raw("SELECT 'DTE ID','Status','Timestamp','Name','CETScore','CETMonth','CETYear','CETPercentile','CGPA' Union SELECT m1.dte_id,m1.status_to,m1.updated_at,mca.name_on_marksheet,mca.cet_score,mca.cet_month,mca.cet_year,mca.cet_percentile,mca.degree_final_cgpa INTO OUTFILE '".$path."' FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' FROM status_details m1 INNER JOIN mca_students mca ON m1.dte_id = mca.dte_id AND m1.event_to = 'ACAP'  AND m1.course ='MCA' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
        
         $request->session()->flash('link', $fileName);
         return redirect('adminLosAcapApplied');
    }


    public function pdfviewMca2(Request $request)
    {
          $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,mca.name_on_marksheet,mca.course_allotted FROM status_details m1 INNER JOIN mca_students mca ON m1.dte_id = mca.dte_id AND m1.event_to = 'ACAP' and m1.course= 'MCA' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
         view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewMCA2');
            return $pdf->stream('admin.pdfviewMCA2.pdf');
        }
        return view('admin.pdfviewMCA2');
    }

    public function CSVViewMca2(Request $request)
    {
         $a1 = $this->random(); 
          $path = 'C:/xampp/htdocs/Admission_mca/public/MCA_Seized_export'.$a1.'.csv';
         $fileName = 'MCA_Seized_export'.$a1.'.csv';
   //      return $path;
         $users = DB::select(DB::raw("SELECT 'DTE ID','Status','Timestamp','Name' Union SELECT m1.dte_id,m1.status_to,m1.updated_at,mca.name_on_marksheet INTO OUTFILE '".$path."' FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n'FROM status_details m1 INNER JOIN mca_students mca ON m1.dte_id = mca.dte_id AND m1.event_to = 'ACAP' and m1.course= 'MCA' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
        
         $request->session()->flash('link', $fileName);
         return redirect('adminLosAcapSeized');
    }


      public function pdfviewMca3(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewMCA3');
            return $pdf->stream('admin.pdfviewMCA3.pdf');
        }
        return view('admin.pdfviewMCA3');
    }


      public function pdfviewMca3Shift1(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.shift_allotted = 'Morning' "));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewMCA3');
            return $pdf->stream('admin.pdfviewMCA3.pdf');
        }
        return view('admin.pdfviewMCA3');
    }

      public function pdfviewMca3Shift2(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.shift_allotted = 'Afternoon'"));
  
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewMCA3');
            return $pdf->stream('admin.pdfviewMCA3.pdf');
        }
        return view('admin.pdfviewMCA3');
    }



    public function CSVViewMca3(Request $request)
    {
         $a1 = $this->random(); 
          $path = 'C:/xampp/htdocs/Admission_mca/public/MCA_Admitted_export'.$a1.'.csv';
         $fileName = 'MCA_Admitted_export'.$a1.'.csv';
   //      return $path;
         $users = DB::select(DB::raw("SELECT 'DTE ID','Name','Shift','GrantedAmount','PaidAmount','BalanceAmount','Status','Timestamp'  Union SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at INTO OUTFILE '".$path."' FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n'FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED'"));
        
         $request->session()->flash('link', $fileName);
         return redirect('adminLosAcapSeized');
    }


    public function pdfviewMca4(Request $request)
    {
       $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED'"));

        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewMCA4');
            return $pdf->stream('admin.pdfviewMCA4.pdf');
        }
        return view('admin.pdfviewMCA4');
    }
    public function pdfviewMca4Shift1(Request $request)
    {
       $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND m1.shift_allotted = 'Morning'"));

        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewMCA4');
            return $pdf->stream('admin.pdfviewMCA4.pdf');
        }
        return view('admin.pdfviewMCA4');
    }
     public function pdfviewMca4Shift2(Request $request)
    {
       $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND m1.shift_allotted = 'Afternoon'"));

        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewMCA4');
            return $pdf->stream('admin.pdfviewMCA4.pdf');
        }
        return view('admin.pdfviewMCA4');
    }

     public function CSVViewMca4(Request $request)
    {
         $a1 = $this->random(); 
          $path = 'C:/xampp/htdocs/Admission_mca/public/MCA_Cancelled_export'.$a1.'.csv';
         $fileName = 'MCA_Cancelled_export'.$a1.'.csv';
   //     return $path;
         $users = DB::select(DB::raw("SELECT 'DTE ID','Name','Shift','GrantedAmount','Status','DateOfAdmission','DateofCancel'  Union SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.status,m1.created_at,m1.updated_at INTO OUTFILE '".$path."' FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' "));
        
         $request->session()->flash('link', $fileName);
         return redirect('adminLosAcapCancelled');
    }


      public function pdfviewMca5(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.total_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.granted_amt < m1.total_amt"));
         // return $users[0]->shift_allotted;
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewMCA5');
            return $pdf->stream('admin.pdfviewMCA5.pdf');
        }
        return view('admin.pdfviewMCA5');
    }

    public function pdfviewMca5Shift1(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.shift_allotted = 'Morning' AND m1.granted_amt < m1.total_amt"));
         // return $users[0]->shift_allotted;
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewMCA5');
            return $pdf->stream('admin.pdfviewMCA5.pdf');
        }
        return view('admin.pdfviewMCA5');
    }

     public function pdfviewMca5Shift2(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.shift_allotted = 'Afternoon' AND m1.granted_amt < m1.total_amt"));
         // return $users[0]->shift_allotted;
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewMCA5');
            return $pdf->stream('admin.pdfviewMCA5.pdf');
        }
        return view('admin.pdfviewMCA5');
    }

     public function CSVViewMca5(Request $request)
    {
         $a1 = $this->random(); 
          $path = 'C:/xampp/htdocs/Admission_mca/public/MCA_Part_payment_export'.$a1.'.csv';
         $fileName = 'MCA_Part_payment_export'.$a1.'.csv';
   //      return $path;
         $users = DB::select(DB::raw("SELECT 'DTE ID','Name','Shift','GrantedAmount','PaidAmount','TotalAmount','BalanceAmount','Status','Timestamp'  Union SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.total_amt,m1.balance_amt,m1.status,m1.updated_at INTO OUTFILE '".$path."' FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n'FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.granted_amt < m1.total_amt"));
        
         $request->session()->flash('link', $fileName);
         return redirect('adminLosAcapPartPayment');
    }

 
       public function pdfviewMca6(Request $request)
    {
         $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED'"));
      
         view()->share('users',$users);
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewMCA6');
            return $pdf->stream('admin.pdfviewMCA6.pdf');
        }
        return view('admin.pdfviewMCA6');
    }

    public function pdfviewMca6Shift1(Request $request)
    {
         $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.shift_allotted = 'Morning'"));
      
         view()->share('users',$users);
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewMCA6');
            return $pdf->stream('admin.pdfviewMCA6.pdf');
        }
        return view('admin.pdfviewMCA6');
    }

     public function pdfviewMca6Shift2(Request $request)
    {
         $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.shift_allotted = 'Afternoon'"));
      
         view()->share('users',$users);
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewMCA6');
            return $pdf->stream('admin.pdfviewMCA6.pdf');
        }
        return view('admin.pdfviewMCA6');
    }


     public function CSVViewMca6(Request $request)
    {
         $a1 = $this->random(); 
          $path = 'C:/xampp/htdocs/admission_2019-20-master/admission_2019-20-master/public/MCA_dte_admitted_export'.$a1.'.csv';
         $fileName = 'MCA_dte_admitted_export'.$a1.'.csv';
  //  return $path;
         $users = DB::select(DB::raw("SELECT 'DTE ID','Name','Shift','GrantedAmount','PaidAmount','BalanceAmount','Status','Timestamp'  Union SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at INTO OUTFILE '".$path."' FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n'FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED'"));
        // return $fileName;
         $request->session()->flash('link', $fileName);
         return redirect('adminLosDteAdmitted');
    }

     public function pdfviewMca7(Request $request)
    {
          $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED'"));
      
         view()->share('users',$users);
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewMCA7');
            return $pdf->stream('admin.pdfviewMCA7.pdf');
        }
        return view('admin.pdfviewMCA7');
    }

     public function pdfviewMca7Shift1(Request $request)
    {
          $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND m1.shift_allotted = 'Morning'"));
      
         view()->share('users',$users);
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewMCA7');
            return $pdf->stream('admin.pdfviewMCA7.pdf');
        }
        return view('admin.pdfviewMCA7');
    }

    public function pdfviewMca7Shift2(Request $request)
    {
          $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND m1.shift_allotted = 'Afternoon'"));
      
         view()->share('users',$users);
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewMCA7');
            return $pdf->stream('admin.pdfviewMCA7.pdf');
        }
        return view('admin.pdfviewMCA7');
    }


    public function CSVViewMca7(Request $request)
    {
         $a1 = $this->random(); 
          $path = 'C:/xampp/htdocs/Admission_mca/public/MCA_dte_cancelled_export'.$a1.'.csv';
         $fileName = 'MCA_dte_cancelled_export'.$a1.'.csv';
  //   return $path;
         $users = DB::select(DB::raw("SELECT 'DTE ID','Name','Shift','GrantedAmount','Status','DateOfAdmission','DateofCancel'  Union SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.status,m1.created_at,m1.updated_at INTO OUTFILE '".$path."' FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED'"));
        
         $request->session()->flash('link', $fileName);
         return redirect('adminLosDteAdmitted');
    }

    public function pdfviewMca8(Request $request)
    {
       $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.total_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.granted_amt < m1.total_amt"));
         // return $users[0]->shift_allotted;
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewMCA5');
            return $pdf->stream('admin.pdfviewMCA5.pdf');
        }
        return view('admin.pdfviewMCA5');
    }

    public function pdfviewMca8Shift1(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.shift_allotted = 'Morning' AND m1.granted_amt < m1.total_amt "));
         // return $users[0]->shift_allotted;
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewMCA5');
            return $pdf->stream('admin.pdfviewMCA5.pdf');
        }
        return view('admin.pdfviewMCA5');
    }

     public function pdfviewMca8Shift2(Request $request)
    {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.shift_allotted = 'Afternoon' AND m1.granted_amt < m1.total_amt"));
         // return $users[0]->shift_allotted;
        view()->share('users',$users);
        //return $users;
        if($request->has('download')){
            $pdf = PDF::loadView('admin.pdfviewMCA5');
            return $pdf->stream('admin.pdfviewMCA5.pdf');
        }
        return view('admin.pdfviewMCA5');
    }

     public function CSVViewMca8(Request $request)
    {
         $a1 = $this->random(); 
          $path = 'C:/xampp/htdocs/Admission_mca/public/MCA_Part_payment_export'.$a1.'.csv';
         $fileName = 'MCA_Part_payment_export'.$a1.'.csv';
   //      return $path;
         $users = DB::select(DB::raw("SELECT 'DTE ID','Name','Shift','GrantedAmount','PaidAmount','TotalAmount','BalanceAmount','Status','Timestamp'  Union SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.total_amt,m1.balance_amt,m1.status,m1.updated_at INTO OUTFILE '".$path."' FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n'FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.granted_amt < m1.total_amt"));
        
         $request->session()->flash('link', $fileName);
         return redirect('adminLosAcapPartPayment');
    }



    public static function searchAdminLosAcapApplied(Request $request)
    {
        $dte_id = $request->input('dteId');
        $course = $request->session()->get('adminCourse');
        //return $course;
            $event = $request->session()->get('adminEvent');
            if($course =="MEG")
            {
              $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet,m.course_allotted, a.status_to, a.updated_at,m.gate_score,m.gate_month,m.gate_year,m.gate_max_marks,m.sponsoring_company,m.degree_final_cgpa FROM status_details a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.event_to = 'ACAP' AND a.updated_at IN(SELECT MAX(updated_at) FROM status_details WHERE dte_id LIKE '%".$dte_id."%' )"));
              $links = "No";
            }

            else if($course == "MCA")
            {
              $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet,m.course_allotted, a.status_to, a.updated_at,m.cet_score,m.cet_month,m.cet_year,m.cet_percentile,m.degree_final_cgpa FROM status_details a INNER JOIN mca_students m ON a.dte_id = m.dte_id AND a.event_to = 'ACAP' AND a.updated_at IN(SELECT MAX(updated_at) FROM status_details WHERE dte_id LIKE '%".$dte_id."%' )"));
              $links = "No";
              //return 'HRll';
            }
            else if($course == "FEG")
            {
              $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet,m.course_allotted,a.status_to, a.updated_at,m.cet_score,m.cet_month,m.cet_year,m.cet_seat_no,m.jee_score,m.jee_month,m.jee_year,m.jee_seat_no FROM status_details a INNER JOIN fe_students m ON a.dte_id = m.dte_id AND a.event_to = 'ACAP' AND a.updated_at IN(SELECT MAX(updated_at) FROM status_details WHERE dte_id LIKE '%".$dte_id."%' )"));
              $links = "No";
              //return $users;
            }
            else if($course == "DSE")
            {
              $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet,m.course_allotted,m.diploma_aggr_percent_sem6, a.status_to, a.updated_at,m.diploma_passing_month,m.diploma_passing_year,m.diploma_aggr_max_sem6,m.diploma_aggr_obt_sem6 FROM status_details a INNER JOIN dse_students m ON a.dte_id = m.dte_id AND a.event_to = 'ACAP' AND a.updated_at IN(SELECT MAX(updated_at) FROM status_details WHERE dte_id LIKE '%".$dte_id."%' )"));
              $links = "No";
            }    
         
        if($users == [])
        {
             $request->session()->flash('error', 'RECORD NOT FOUND');  
             return redirect()->route('adminLosAcapApplied');   
        }
        else
        {        
            if($users[0]->status_to == 'SUBMITTED')
             return view('admin.adminLosAcapApplied')->with("users",$users)->with("course",$course)->with('links',$links);
             else
            {
                 if($users[0]->status_to == 'ADMITTED')
                    $request->session()->flash('error', 'STUDENT ALREADY ADMITTED');
                 else if($users[0]->status_to == 'SEIZED')
                     $request->session()->flash('error', 'STUDENT DATA HAS BEEN SEIZED ALREADY');
                 else if($users[0]->status_to == 'INITIATED')
                     $request->session()->flash('error', 'STUDENT HAS NOT SUBMITTED HIS FORM');
                        
                return redirect()->route('adminLosAcapApplied');
            }
        }
    }

    public static function date($id,Request $request)
    {
      $request->session()->put('id',$id);
      return view('admin.date');  
    }

    public static function postDateWise(Request $request)
    {
      $date = $request->input('date');
 //value to be taken from session
      //return $date;
      $course= $request->session()->get('adminCourse');
      $id= $request->session()->get('id');
      if($course == "MEG")
      {
            if($id ==1)
            {
                 $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,me.name_on_marksheet,me.course_allotted,me.gate_score,me.degree_final_cgpa FROM status_details m1 INNER JOIN me_students me ON m1.dte_id = me.dte_id AND m1.event_to = 'ACAP' AND m1.course LIKE '%".$course."%' AND m1.updated_at LIKE '%".$date."%'  LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
                 view()->share('users',$users);
                 $pdf = PDF::loadView('admin.pdfview1');
                 return $pdf->stream('admin.pdfview1.pdf');
            }
            if($id ==2)
            {
                $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,me.name_on_marksheet,me.course_allotted FROM status_details m1 INNER JOIN me_students me ON m1.dte_id = me.dte_id AND m1.event_to = 'ACAP' AND m1.course LIKE '%".$course."%' AND m1.updated_at LIKE '%".$date."%' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
                 view()->share('users',$users);
                 $pdf = PDF::loadView('admin.pdfview2');
                 return $pdf->stream('admin.pdfview2.pdf');
            }
            if($id ==3)
            {
                $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.paid_amt, a.balance_amt, a.status, a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'ACAP' AND a.status = 'ADMITTED' AND a.course LIKE '%".$course."%' AND a.updated_at LIKE '%".$date."%'"));
                 view()->share('users',$users);
                 $pdf = PDF::loadView('admin.pdfview3');
                 return $pdf->stream('admin.pdfview3.pdf');
            }
            if($id ==4)
            {
                 $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'ACAP' AND a.status = 'CANCELLED' AND a.course LIKE '%".$course."%' AND a.updated_at LIKE '%".$date."%'"));
                 view()->share('users',$users);
                 $pdf = PDF::loadView('admin.pdfview4');
                 return $pdf->stream('admin.pdfview4.pdf');
            }
            if($id ==5)
            {
                 $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.balance_amt,a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'ACAP' AND a.status = 'ADMITTED' AND a.course LIKE '%".$course."%' AND a.updated_at LIKE '%".$date."%'"));
                 view()->share('users',$users);
                 $pdf = PDF::loadView('admin.pdfview5');
                 return $pdf->stream('admin.pdfview5.pdf');
            }
            if($id ==6)
            {
                 $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.paid_amt, a.balance_amt, a.status, a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED' AND a.course LIKE '%".$course."%' AND a.updated_at LIKE '%".$date."%'"));
                 view()->share('users',$users);
                 $pdf = PDF::loadView('admin.pdfview6');
                 return $pdf->stream('admin.pdfview6.pdf');
            }
            if($id ==7)
            {
                $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.paid_amt, a.balance_amt, a.status, a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'DTE' AND a.status = 'CANCELLED' AND a.course LIKE '%".$course."%' AND a.updated_at LIKE '%".$date."%'"));
                 view()->share('users',$users);
                 view()->share('users',$users);
                 $pdf = PDF::loadView('admin.pdfview7');
                 return $pdf->stream('admin.pdfview7.pdf');
            }
            if($id ==8)
            {
                  $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED' AND a.course LIKE '%".$course."%' AND a.updated_at LIKE '%".$date."%'"));
                 view()->share('users',$users);
                 $pdf = PDF::loadView('admin.pdfview8');
                 return $pdf->stream('admin.pdfview8.pdf');
            }
      }
      if($course == "MCA")
      {

          if($id == 1)
          {
           $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,mca.name_on_marksheet,mca.cet_score,mca.cet_month,mca.cet_year,mca.cet_percentile,mca.degree_final_cgpa FROM status_details m1 INNER JOIN mca_students mca ON m1.dte_id = mca.dte_id AND m1.event_to = 'ACAP'  AND m1.course ='MCA'  AND m1.updated_at LIKE '%".$date."%'  LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));

            view()->share('users',$users);
            $pdf = PDF::loadView('admin.pdfviewMCA1');
            return $pdf->stream('admin.pdfviewMCA1.pdf');
          }

          if($id == 2)
          {
            $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,mca.name_on_marksheet,mca.course_allotted FROM status_details m1 INNER JOIN mca_students mca ON m1.dte_id = mca.dte_id AND m1.event_to = 'ACAP' and m1.course= 'MCA' and m1.updated_at LIKE '%".$date."%' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));

            view()->share('users',$users);
            $pdf = PDF::loadView('admin.pdfviewMCA2');
            return $pdf->stream('admin.pdfviewMCA2.pdf');
          }
          if ($id == 3)
          {
               $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED'  m1.updated_at LIKE '%".$date."%'  "));


              view()->share('users',$users);
            $pdf = PDF::loadView('admin.pdfviewMCA3');
            return $pdf->stream('admin.pdfviewMCA3.pdf');

          }
          if($id == 4)
          {

               $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' m1.updated_at LIKE '%".$date."%' "));

                view()->share('users',$users);
                 $pdf = PDF::loadView('admin.pdfviewMCA4');
                 return $pdf->stream('admin.pdfviewMCA4.pdf');

          }
          if($id == 5)
          {
            $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.total_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.granted_amt < m1.total_amt "));
             view()->share('users',$users);
                 $pdf = PDF::loadView('admin.pdfviewMCA5');
                 return $pdf->stream('admin.pdfviewMCA5.pdf');
          }
          if($id ==6)
          {


           $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND   m1.updated_at LIKE '%".$date."%'"));
          // return $users;
            view()->share('users',$users);
                 $pdf = PDF::loadView('admin.pdfviewMCA6');
                 return $pdf->stream('admin.pdfviewMCA6.pdf');
          }
          if($id == 7)
          {
            $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND  m1.updated_at LIKE '%".$date."%'"));

             view()->share('users',$users);
                 $pdf = PDF::loadView('admin.pdfviewMCA7');
                 return $pdf->stream('admin.pdfviewMCA7.pdf');
          }
          
          if($id == 8)
          {
             $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.total_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.granted_amt < m1.total_amt "));
             view()->share('users',$users);
                 $pdf = PDF::loadView('admin.pdfviewMCA8');
                 return $pdf->stream('admin.pdfviewMCA8.pdf');
            
         }
      }
      if($course == "FEG")
      {
        if($id == 1)
        {
          $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,fe.name_on_marksheet,fe.jee_seat_no,fe.jee_score,fe.jee_month,fe.jee_year,fe.jee_score,fe.cet_score,fe.cet_seat_no,fe.cet_month,fe.cet_year,fe.cet_percentile FROM status_details m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.event_to = 'ACAP' AND m1.course ='FEG'  AND m1.updated_at LIKE '%".$date."%'  LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
          view()->share('users',$users);
          $pdf = PDF::loadView('admin.pdfviewfe1');
          return $pdf->stream('admin.pdfviewfe1.pdf');
        }

        if($id == 2)
        {
          $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,fe.name_on_marksheet,fe.course_allotted,fe.dte_branch,fe.shift_allotted FROM status_details m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.event_to = 'ACAP' and m1.course= 'FEG' and m1.updated_at LIKE '%".$date."%' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
          //return $users;
          view()->share('users',$users);
          $pdf = PDF::loadView('admin.pdfviewfe2');
          return $pdf->stream('admin.pdfviewfe2.pdf');
        }
        if ($id == 3)
        {
          $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.branch,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.updated_at LIKE '%".$date."%'"));
          view()->share('users',$users);
          $pdf = PDF::loadView('admin.pdfviewfe3');
          return $pdf->stream('admin.pdfviewfe3.pdf');
        }
        if($id == 4)
        {
          $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.status,m1.created_at,m1.branch,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND m1.updated_at LIKE '%".$date."%' "));

          view()->share('users',$users);
          $pdf = PDF::loadView('admin.pdfviewfe4');
          return $pdf->stream('admin.pdfviewfe4.pdf');

        }
        if($id == 5)
        {
          $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.total_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.granted_amt < m1.total_amt "));
          view()->share('users',$users);
          $pdf = PDF::loadView('admin.pdfviewfe5');
          return $pdf->stream('admin.pdfviewfe5.pdf');
        }
        if($id ==6)
        {
          $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.branch,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND   m1.updated_at LIKE '%".$date."%'"));
          // return $users;
          view()->share('users',$users);
          $pdf = PDF::loadView('admin.pdfviewfe6');
          return $pdf->stream('admin.pdfviewfe6.pdf');
        }
        if($id == 7)
        {
          $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND  m1.updated_at LIKE '%".$date."%'"));

          view()->share('users',$users);
          $pdf = PDF::loadView('admin.pdfviewfe7');
          return $pdf->stream('admin.pdfviewfe7.pdf');
        }

        if($id == 8)
        {
          $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.total_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.granted_amt < m1.total_amt "));
          view()->share('users',$users);
          $pdf = PDF::loadView('admin.pdfviewfe8');
          return $pdf->stream('admin.pdfviewfe8.pdf');
        }
      }
      if($course == "DSE")
      {
        if($id == 1)
        {
          $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,dse.name_on_marksheet,dse.diploma_aggr_max_sem6,dse.diploma_aggr_obt_sem6,dse.diploma_passing_month,dse.diploma_passing_year,dse.diploma_aggr_percent_sem6 FROM status_details m1 INNER JOIN dse_students dse ON m1.dte_id = dse.dte_id AND m1.event_to = 'ACAP'  AND m1.course ='DSE'  AND m1.updated_at LIKE '%".$date."%'  LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
          view()->share('users',$users);
          $pdf = PDF::loadView('admin.pdfviewdse1');
          return $pdf->stream('admin.pdfviewdse1.pdf');
        }
        if($id == 2)
        {
          $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,mca.name_on_marksheet,mca.course_allotted FROM status_details m1 INNER JOIN dse_students mca ON m1.dte_id = mca.dte_id AND m1.event_to = 'ACAP' and m1.course= 'DSE' and m1.updated_at LIKE '%".$date."%' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
          view()->share('users',$users);
          $pdf = PDF::loadView('admin.pdfviewdse2');
          return $pdf->stream('admin.pdfviewdse2.pdf');
        }
        if ($id == 3)
        {
          $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND  m1.updated_at LIKE '%".$date."%'  "));
          view()->share('users',$users);
          $pdf = PDF::loadView('admin.pdfviewdse3');
          return $pdf->stream('admin.pdfviewdse3.pdf');
        }
        if($id == 4)
        {
          $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.branch,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND m1.updated_at LIKE '%".$date."%' "));
          //return $users;
          view()->share('users',$users);
          $pdf = PDF::loadView('admin.pdfviewdse4');
          return $pdf->stream('admin.pdfviewdse4.pdf');
        }
        if($id == 5)
        {
        $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.total_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.granted_amt < m1.total_amt "));
        view()->share('users',$users);
         $pdf = PDF::loadView('admin.pdfviewdse5');
         return $pdf->stream('admin.pdfviewdse5.pdf');
        }
        if($id ==6)
        {
          $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.branch,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND   m1.updated_at LIKE '%".$date."%'"));
          // return $users;
          view()->share('users',$users);
          $pdf = PDF::loadView('admin.pdfviewdse6');
          return $pdf->stream('admin.pdfviewdse6.pdf');
        }
        if($id == 7)
        {
          $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.branch,m1.paid_amt,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED' AND  m1.updated_at LIKE '%".$date."%'"));
          view()->share('users',$users);
          $pdf = PDF::loadView('admin.pdfviewdse7');
          return $pdf->stream('admin.pdfviewdse7.pdf');
        }
        if($id == 8)
        {
          $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.total_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.granted_amt < m1.total_amt "));
          view()->share('users',$users);
          $pdf = PDF::loadView('admin.pdfviewdse8');
          return $pdf->stream('admin.pdfviewdse8.pdf');
        }
      }


    }

     public static function backToLos(Request $request)
    {
         $id =$request->session()->get('id'); 
         if($id ==1)
         {
            return redirect()->route('adminLosAcapApplied');
         }
         if($id ==2)
         {
            return redirect()->route('adminLosAcapSeized');
         }
         if($id ==3)
         {
            return redirect()->route('adminLosAcapAdmitted');
         }
         if($id ==4)
         {
            return redirect()->route('adminLosAcapCancelled');
         }
         if($id ==5)
         {
            return redirect()->route('adminLosAcapPartPayment');
         }
         if($id ==6)
         {
            return redirect()->route('adminLosDteAdmitted');
         }
         if($id ==7)
         {
            return redirect()->route('adminLosDteCancelled');
         }
         if($id ==8)
         {
            return redirect()->route('adminLosDtePartPayment');
         }
    }


 public static function showAdminLosAcapSeized(Request $request)
  {
         $role =$request->session()->get('role', 'null');
      if ($role != 'null' && ($role=='Admin' || $role=='Super Admin') )
      {
           $course = $request->session()->get('adminCourse','null');
            $event = $request->session()->get('adminEvent','null');

            if($course == 'null' || $event == 'null' || $course == "...Select Your Course" || $event == "...Select Your event")
              {
                 $request->session()->flash('error', 'Please select Course and Event');
                   
                  return redirect()->route('adminsEvent');
              }
              if($course =="MEG")
               { 
                     $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,me.name_on_marksheet,me.dte_branch,me.course_allotted FROM status_details m1 INNER JOIN me_students me ON m1.dte_id = me.dte_id AND m1.event_to = 'ACAP' and m1.course= 'MEG' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
                        $srno = 1;
                            // Get current page form url e.x. &page=1
                    $currentPage = LengthAwarePaginator::resolveCurrentPage();
             
                    // Create a new Laravel collection from the array data
                    $itemCollection = collect($users);
             
                    // Define how many items we want to be visible in each page
                    $perPage = 10;
             
                    // Slice the collection to get the items to display in current page
                    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
             
                    // Create our paginator and pass it to the view
                    $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
             
                    // set url path for generted links
                    $paginatedItems->setPath($request->url());
                    if($users == [] || $users == null)
                      {$links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                      }
                    else
                      $links = "Yes";
              }
              if($course == "MCA")
              {
                $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,mca.name_on_marksheet,mca.course_allotted,mca.shift_allotted FROM status_details m1 INNER JOIN mca_students mca ON m1.dte_id = mca.dte_id AND m1.event_to = 'ACAP' and m1.course= 'MCA'LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
                        $srno = 1;
                            // Get current page form url e.x. &page=1
                    $currentPage = LengthAwarePaginator::resolveCurrentPage();
             
                    // Create a new Laravel collection from the array data
                    $itemCollection = collect($users);
             
                    // Define how many items we want to be visible in each page
                    $perPage = 10;
             
                    // Slice the collection to get the items to display in current page
                    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
             
                    // Create our paginator and pass it to the view
                    $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
             
                    // set url path for generted links
                    $paginatedItems->setPath($request->url());
                    if($users == [] || $users == null)
                      {$links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                      }
                    else
                      $links = "Yes";
                  }
                  if($course == "FEG")
                  {
                  $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,fe.name_on_marksheet,fe.dte_branch,fe.shift_allotted FROM status_details m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.event_to = 'ACAP' and m1.course= 'FEG'LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
                          $srno = 1;
                              // Get current page form url e.x. &page=1
                      $currentPage = LengthAwarePaginator::resolveCurrentPage();
               
                      // Create a new Laravel collection from the array data
                      $itemCollection = collect($users);
               
                      // Define how many items we want to be visible in each page
                      $perPage = 10;
               
                      // Slice the collection to get the items to display in current page
                      $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
               
                      // Create our paginator and pass it to the view
                      $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
               
                      // set url path for generted links
                      $paginatedItems->setPath($request->url());
                      if($users == [] || $users == null)
                        {$links = "No";
                          $request->session()->flash('error', 'NO RECORDS FOUND');  
                        }
                      else
                        $links = "Yes";
                    }
                    if($course == "DSE")
                {
                  $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,dse.name_on_marksheet,dse.dte_branch,dse.shift_allotted FROM status_details m1 INNER JOIN dse_students dse ON m1.dte_id = dse.dte_id AND m1.event_to = 'ACAP' and m1.course= 'DSE'LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL"));
                          $srno = 1;
                              // Get current page form url e.x. &page=1
                      $currentPage = LengthAwarePaginator::resolveCurrentPage();
               
                      // Create a new Laravel collection from the array data
                      $itemCollection = collect($users);
               
                      // Define how many items we want to be visible in each page
                      $perPage = 10;
               
                      // Slice the collection to get the items to display in current page
                      $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
               
                      // Create our paginator and pass it to the view
                      $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
               
                      // set url path for generted links
                      $paginatedItems->setPath($request->url());
                      if($users == [] || $users == null)
                        {$links = "No";
                          $request->session()->flash('error', 'NO RECORDS FOUND');  
                        }
                      else
                        $links = "Yes";
                    }
                
                      return view('admin.adminLosAcapSeized',['users' => $paginatedItems])->with('srno',$srno)->with('course',$course)->with('links',$links);
      }
      else
          return redirect()->route('adminLogin');

  }

  public static function searchAdminLosAcapSeized(Request $request)
    {
        $dte_id = $request->input('dteId');
        $course = $request->session()->get('adminCourse');
            $event = $request->session()->get('adminEvent');
            if($course =="MEG")
            {
                $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,me.name_on_marksheet,me.dte_branch,me.course_allotted FROM status_details m1 INNER JOIN me_students me ON m1.dte_id = me.dte_id AND m1.event_to = 'ACAP' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.dte_id LIKE '%".$dte_id."%'"));
                $srno = 1;
                $links = "No";
            }
            else if($course == "MCA")
            {
              $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,me.name_on_marksheet,me.course_allotted,me.shift_allotted FROM status_details m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.event_to = 'ACAP' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.dte_id LIKE '%".$dte_id."%'"));
              $srno = 1;
              $links = "No"; 
            }

            else if($course == "FEG")
            {
              $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,me.name_on_marksheet,me.dte_branch,me.shift_allotted FROM status_details m1 INNER JOIN fe_students me ON m1.dte_id = me.dte_id AND m1.event_to = 'ACAP' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.dte_id LIKE '%".$dte_id."%'"));
              $srno = 1;
              $links = "No"; 

             
            }
            else if($course == "DSE")
            {
              $users = DB::select(DB::raw("SELECT m1.dte_id,m1.status_to,m1.updated_at,me.name_on_marksheet,me.course_allotted FROM status_details m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.event_to = 'ACAP' LEFT JOIN status_details m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.dte_id LIKE '%".$dte_id."%'"));
              $srno = 1;
              $links = "No"; 
            }
                     //    return $users;

         if($users == [])
        {
             $request->session()->flash('error', 'RECORD NOT FOUND');  
             return redirect()->route('adminLosAcapSeized');   
        }
        else
        {     
         // return $users;
              if($users[0]->status_to == 'SEIZED')
                 return view('admin.adminLosAcapSeized')->with("users",$users)->with('srno',$srno)->with('course',$course)->with('links',$links);
              else
             {

                if($users[0]->status_to == 'ADMITTED')
                    $request->session()->flash('error', 'STUDENT ALREADY ADMITTED');
                else if($users[0]->status_to == 'INITIATED')
                    $request->session()->flash('error', 'STUDENT HAS NOT SUBMITTED HIS FORM');
                        
                return redirect()->route('adminLosAcapSeized');
            }

        }

        $request->session()->flash('error', 'AN ERROR OCCURED');  
        return redirect()->route('adminLosAcapSeized');
    }

    public static function showAdminLosAcapAdmitted(Request $request)
    {
         $role =$request->session()->get('role', 'null');
      if ($role != 'null' && ($role=='Admin' || $role=='Super Admin') )
      {
           $course = $request->session()->get('adminCourse','null');
            $event = $request->session()->get('adminEvent','null');

            if($course == 'null' || $event == 'null' || $course == "...Select Your Course" || $event == "...Select Your event")
              {
                 $request->session()->flash('error', 'Please select Course and Event');
                   
                  return redirect()->route('adminsEvent');
              }
              if($course =="MEG")
               { 
                      
           $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.branch,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN me_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED'"));
            $srno = 1;
            // Get current page form url e.x. &page=1
                $currentPage = LengthAwarePaginator::resolveCurrentPage();
         
                // Create a new Laravel collection from the array data
                $itemCollection = collect($users);
         
                // Define how many items we want to be visible in each page
                $perPage = 10;
         
                // Slice the collection to get the items to display in current page
                $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
         
                // Create our paginator and pass it to the view
                $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
         
                // set url path for generted links
                $paginatedItems->setPath($request->url());
                 if($users == [] || $users == null)
                 {$links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                      }
                    else
                      $links = "Yes";
            }
            if($course == "MCA")
            {

           $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED'"));
            $srno = 1;
            // Get current page form url e.x. &page=1
                $currentPage = LengthAwarePaginator::resolveCurrentPage();
         
                // Create a new Laravel collection from the array data
                $itemCollection = collect($users);
         
                // Define how many items we want to be visible in each page
                $perPage = 10;
         
                // Slice the collection to get the items to display in current page
                $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
         
                // Create our paginator and pass it to the view
                $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
         
                // set url path for generted links
                $paginatedItems->setPath($request->url());   
                 if($users == [] || $users == null)
                 {$links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                      }
                    else
                      $links = "Yes";
            }
            if($course == "FEG")
            {

            $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED'"));
            $srno = 1;
            // Get current page form url e.x. &page=1
                $currentPage = LengthAwarePaginator::resolveCurrentPage();
         
                // Create a new Laravel collection from the array data
                $itemCollection = collect($users);
         
                // Define how many items we want to be visible in each page
                $perPage = 10;
         
                // Slice the collection to get the items to display in current page
                $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
         
                // Create our paginator and pass it to the view
                $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
         
                // set url path for generted links
                $paginatedItems->setPath($request->url());   
                 if($users == [] || $users == null)
                 {$links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                      }
                    else
                      $links = "Yes";
            }
            if($course == "DSE")
            {

           $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.branch,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED'"));
            $srno = 1;
            // Get current page form url e.x. &page=1
                $currentPage = LengthAwarePaginator::resolveCurrentPage();
         
                // Create a new Laravel collection from the array data
                $itemCollection = collect($users);
         
                // Define how many items we want to be visible in each page
                $perPage = 10;
         
                // Slice the collection to get the items to display in current page
                $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
         
                // Create our paginator and pass it to the view
                $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
         
                // set url path for generted links
                $paginatedItems->setPath($request->url());   
                 if($users == [] || $users == null)
                 {$links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                      }
                    else
                      $links = "Yes";
            }
            //return $users;
            return view('admin.adminLosAcapAdmitted',['users' => $paginatedItems])->with('srno',$srno)->with('course',$course)->with('links',$links);
        }
    else
            return redirect()->route('adminLogin');
    }

    public static function searchAdminLosAcapAdmitted(Request $request)
    {
        $dte_id = $request->input('dteId');
        $course = $request->session()->get('adminCourse');
            $event = $request->session()->get('adminEvent');
            if($course == "MEG")
            {
                $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN me_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.dte_id LIKE '%".$dte_id."%'" ));
                $srno = 1;
                $links = "No";
               // return $users;
            }
           else if($course == "MCA")
            {
                $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.dte_id LIKE '%".$dte_id."%'" ));
                $srno = 1;
                $links = "No";   
            }   

            else if($course == "FEG")
            {
                $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.dte_id LIKE '%".$dte_id."%'" ));
                $srno = 1;
                $links = "No";   

            }
            else if($course == "DSE")
            {
              {
                $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.dte_id LIKE '%".$dte_id."%'" ));
                $srno = 1;
                $links = "No";   
            } 
            } 

        //return $users;
        if($users == [])
        {
              $request->session()->flash('error', 'RECORD NOT FOUND'); 
              return redirect()->route('adminLosAcapAdmitted');
        }
        else
        {
                return view('admin.adminLosAcapAdmitted')->with('users',$users)->with('srno',$srno)->with('course',$course)->with('links',$links);
        }
    }

    public static function showAdminLosAcapCancelled(Request $request)
    {
         $role =$request->session()->get('role', 'null');
      if ($role != 'null' && ($role=='Admin' || $role=='Super Admin') )
      {
           $course = $request->session()->get('adminCourse','null');
            $event = $request->session()->get('adminEvent','null');

            if($course == 'null' || $event == 'null' || $course == "...Select Your Course" || $event == "...Select Your event")
              {
                 $request->session()->flash('error', 'Please select Course and Event');
                   
                  return redirect()->route('adminsEvent');
              }
              if($course =="MEG")
               { 
         
                //checking from admission table
                $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'ACAP' AND a.status = 'CANCELLED'"));
                // Get current page form url e.x. &page=1
                $currentPage = LengthAwarePaginator::resolveCurrentPage();
         
                // Create a new Laravel collection from the array data
                $itemCollection = collect($users);
         
                // Define how many items we want to be visible in each page
                $perPage = 10;
         
                // Slice the collection to get the items to display in current page
                $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
         
                // Create our paginator and pass it to the view
                $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
         
                // set url path for generted links
                $paginatedItems->setPath($request->url());

                $srno = 1;
                 if($users == [] || $users == null)
                 {$links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                      }
                    else
                      $links = "Yes";

            }
            if($course == "MCA")
            {

                //checking from admission table
                $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED'"));
                // Get current page form url e.x. &page=1
                $currentPage = LengthAwarePaginator::resolveCurrentPage();
         
                // Create a new Laravel collection from the array data
                $itemCollection = collect($users);
         
                // Define how many items we want to be visible in each page
                $perPage = 10;
         
                // Slice the collection to get the items to display in current page
                $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
         
                // Create our paginator and pass it to the view
                $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
         
                // set url path for generted links
                $paginatedItems->setPath($request->url());

                $srno = 1;
                 if($users == [] || $users == null)
                 {$links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                      }
                    else
                      $links = "Yes";
            }
            if($course == "FEG")
            {

                //checking from admission table
                $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED'"));
                // Get current page form url e.x. &page=1
                $currentPage = LengthAwarePaginator::resolveCurrentPage();
         
                // Create a new Laravel collection from the array data
                $itemCollection = collect($users);
         
                // Define how many items we want to be visible in each page
                $perPage = 10;
         
                // Slice the collection to get the items to display in current page
                $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
         
                // Create our paginator and pass it to the view
                $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
         
                // set url path for generted links
                $paginatedItems->setPath($request->url());

                $srno = 1;
                 if($users == [] || $users == null)
                 {$links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                      }
                    else
                      $links = "Yes";
            }
            if($course == "DSE")
            {

                //checking from admission table
                $users = DB::select(DB::raw("SELECT m1.dte_id,dse.name_on_marksheet,m1.shift_allotted,m1.branch,m1.granted_amt,m1.status,m1.created_at,m1.updated_at FROM admission m1 INNER JOIN dse_students dse ON m1.dte_id = dse.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'CANCELLED'"));
                // Get current page form url e.x. &page=1
                $currentPage = LengthAwarePaginator::resolveCurrentPage();
         
                // Create a new Laravel collection from the array data
                $itemCollection = collect($users);
         
                // Define how many items we want to be visible in each page
                $perPage = 10;
         
                // Slice the collection to get the items to display in current page
                $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
         
                // Create our paginator and pass it to the view
                $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
         
                // set url path for generted links
                $paginatedItems->setPath($request->url());

                $srno = 1;
                 if($users == [] || $users == null)
                 {$links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                      }
                    else
                      $links = "Yes";
            }
            //return $course;
        return view('admin.adminLosAcapCancelled',['users' => $paginatedItems])->with('srno',$srno)->with('course',$course)->with('links',$links);    

        }
    else
            return redirect()->route('adminLogin');
    }




    public static function searchAdminLosAcapCancelled(Request $request)
    {
       $dte_id = $request->input('dteId');
        $course = $request->session()->get('adminCourse');
            $event = $request->session()->get('adminEvent');
            if($course == "MEG")
            {
                 $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.paid_amt, a.balance_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'ACAP' AND a.status = 'CANCELLED' WHERE m.dte_id LIKE '%".$dte_id."%'" ));
                $srno = 1;
                $links = "No";
            }
           else if($course == "MCA")
            {
                $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet,m.shift_allotted, a.branch, a.granted_amt, a.paid_amt, a.balance_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN mca_students m ON a.dte_id = m.dte_id AND a.course = 'MCA' AND a.admission_type = 'ACAP' AND a.status = 'CANCELLED' WHERE m.dte_id LIKE '%".$dte_id."%'" ));
                $srno = 1;
                $links = "No";   
            }

            else if($course == "FEG")
            {
                $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch,a.shift_allotted, a.granted_amt, a.paid_amt, a.balance_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN fe_students m ON a.dte_id = m.dte_id AND a.course = 'FEG' AND a.admission_type = 'ACAP' AND a.status = 'CANCELLED' WHERE m.dte_id LIKE '%".$dte_id."%'" ));
                $srno = 1;
                $links = "No";   
            }

            else if($course == "DSE")
            {
                $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.paid_amt, a.balance_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN dse_students m ON a.dte_id = m.dte_id AND a.course = 'DSE' AND a.admission_type = 'ACAP' AND a.status = 'CANCELLED' WHERE m.dte_id LIKE '%".$dte_id."%'" ));
                $srno = 1;
                $links = "No";   
            }

         if($users == [])
        {
             $request->session()->flash('error', 'RECORD NOT FOUND');  
             return redirect()->route('adminLosAcapCancelled');   
        }
        else
        {
            if($users[0]->status== 'CANCELLED')
                 return view('admin.adminLosAcapCancelled')->with('users',$users)->with('srno',$srno)->with('course',$course)->with('links',$links);
             else
            {
              $request->session()->flash('error', 'STUDENT HAS NOT CANCELLED SEAT');  
                 return redirect()->route('adminLosAcapCancelled');  
            }
        }

       

    }

   


    public static function showAdminLosDteAdmitted(Request $request)
    {  

  
      $role =$request->session()->get('role', 'null');
      if ($role != 'null' && ($role=='Admin' || $role=='Super Admin') )
      {
           $course = $request->session()->get('adminCourse','null');
            $event = $request->session()->get('adminEvent','null');

            if($course == 'null' || $event == 'null' || $course == "...Select Your Course" || $event == "...Select Your event")
              {
                 $request->session()->flash('error', 'Please select Course and Event');
                   
                  return redirect()->route('adminsEvent');
              }
              //return $course;
              if($course =="MEG")
               {  

                    $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.paid_amt, a.balance_amt, a.status, a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED'"));
                        // Get current page form url e.x. &page=1
                    $currentPage = LengthAwarePaginator::resolveCurrentPage();
             
                    // Create a new Laravel collection from the array data
                    $itemCollection = collect($users);
             
                    // Define how many items we want to be visible in each page
                    $perPage = 10;
             
                    // Slice the collection to get the items to display in current page
                    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
             
                    // Create our paginator and pass it to the view
                    $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
             
                    // set url path for generted links
                    $paginatedItems->setPath($request->url());
                    $srno = 1;
                    if($users == [] || $users == null)
                    {   $links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                    }
                    else
                      $links = "Yes";
               }
               if($course == "MCA") 
               {
                    $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED'"));
                        // Get current page form url e.x. &page=1
                    $currentPage = LengthAwarePaginator::resolveCurrentPage();
             
                    // Create a new Laravel collection from the array data
                    $itemCollection = collect($users);
             
                    // Define how many items we want to be visible in each page
                    $perPage = 10;
             
                    // Slice the collection to get the items to display in current page
                    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
             
                    // Create our paginator and pass it to the view
                    $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
             
                    // set url path for generted links
                    $paginatedItems->setPath($request->url());
                    $srno = 1;
                    if($users == [] || $users == null)
                    {   $links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                    }
                    else
                      $links = "Yes";
               }      
              if($course == "FEG") 
               {
                    $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED'"));
                        // Get current page form url e.x. &page=1
                    $currentPage = LengthAwarePaginator::resolveCurrentPage();
                     //return $users;
                    // Create a new Laravel collection from the array data
                    $itemCollection = collect($users);
             
                    // Define how many items we want to be visible in each page
                    $perPage = 10;
             
                    // Slice the collection to get the items to display in current page
                    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
             
                    // Create our paginator and pass it to the view
                    $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
             
                    // set url path for generted links
                    $paginatedItems->setPath($request->url());
                    $srno = 1;
                    if($users == [] || $users == null)
                    {   $links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                    }
                    else
                      $links = "Yes";
               }      
            if($course == "DSE") 
               {
                    $users = DB::select(DB::raw("SELECT m1.dte_id,dse.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students dse ON m1.dte_id = dse.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED'"));
                        // Get current page form url e.x. &page=1
                    $currentPage = LengthAwarePaginator::resolveCurrentPage();
             
                    // Create a new Laravel collection from the array data
                    $itemCollection = collect($users);
             
                    // Define how many items we want to be visible in each page
                    $perPage = 10;
             
                    // Slice the collection to get the items to display in current page
                    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
             
                    // Create our paginator and pass it to the view
                    $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
             
                    // set url path for generted links
                    $paginatedItems->setPath($request->url());
                    $srno = 1;
                    if($users == [] || $users == null)
                    {   $links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                    }
                    else
                      $links = "Yes";
               }      
            
            return view('admin.adminLosDteAdmitted',['users' => $paginatedItems])->with('srno',$srno)->with('course',$course)->with('links',$links);
            
    }
    else
        return redirect()->route('adminLogin');

    }

    public static function searchAdminLosDteAdmitted(Request $request)
    {
        $dte_id = $request->input('dteId');
        $course = $request->session()->get('adminCourse');
            $event = $request->session()->get('adminEvent');
            if($course == "MEG")
            {
                $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.paid_amt, a.balance_amt, a.status, a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED' WHERE m.dte_id LIKE '%".$dte_id."%'" ));
                $srno = 1;
                $links = "No";
            }
            if($course == "MCA")
            {
                $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.dte_id LIKE '%".$dte_id."%'" ));
                $srno = 1;
                $links = "No";
            } 

            if($course == "FEG")
            {
                $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.dte_id LIKE '%".$dte_id."%'" ));
                $srno = 1;
                $links = "No";
            } 

           if($course == "DSE")
            {
                $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN dse_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'DTE' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.dte_id LIKE '%".$dte_id."%'" ));
                $srno = 1;
                $links = "No";
            } 

        if($users == [])
        {

             $request->session()->flash('error', 'RECORD NOT FOUND'); 
             return redirect()->route('adminLosDteAdmitted');
        }
        else
        {

            if($users[0]->status=='ADMITTED')
            {
             return view('admin.adminLosDteAdmitted')->with('users',$users)->with('srno',$srno)->with('course',$course)->with('links',$links);
            }
            else
            {
                    $request->session()->flash('error', 'STUDENT NOT ADMITTED'); 
                     return redirect()->route('adminLosDteAdmitted');
            }
        }
    
    }


     public static function showAdminLosAcapPartPayment(Request $request)
    {
          $role =$request->session()->get('role', 'null');
      if ($role != 'null' && ($role=='Admin' || $role=='Super Admin') )
      {
           $course = $request->session()->get('adminCourse','null');
            $event = $request->session()->get('adminEvent','null');

            if($course == 'null' || $event == 'null' || $course == "...Select Your Course" || $event == "...Select Your event")
              {
                 $request->session()->flash('error', 'Please select Course and Event');
                   
                  return redirect()->route('adminsEvent');
              }
              if($course =="MEG")
               {
                    $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.balance_amt,a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'ACAP' AND a.status = 'ADMITTED'"));
                     // Get current page form url e.x. &page=1
                      $currentPage = LengthAwarePaginator::resolveCurrentPage();
               
                      // Create a new Laravel collection from the array data
                      $itemCollection = collect($users);
               
                      // Define how many items we want to be visible in each page
                      $perPage = 10;
               
                      // Slice the collection to get the items to display in current page
                      $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
               
                      // Create our paginator and pass it to the view
                      $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
               
                      // set url path for generted links
                      $paginatedItems->setPath($request->url());
                    $srno = 1;
                    if($users == [] || $users == null)
                 {$links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                      }
                    else
                      $links = "Yes";

              }
              if($course == "MCA")
              {
                $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.total_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.granted_amt < m1.total_amt"));
                     // Get current page form url e.x. &page=1
                      $currentPage = LengthAwarePaginator::resolveCurrentPage();
               
                      // Create a new Laravel collection from the array data
                      $itemCollection = collect($users);
               
                      // Define how many items we want to be visible in each page
                      $perPage = 10;
               
                      // Slice the collection to get the items to display in current page
                      $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
               
                      // Create our paginator and pass it to the view
                      $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
               
                      // set url path for generted links
                      $paginatedItems->setPath($request->url());
                    $srno = 1;
                    if($users == [] || $users == null)
                 {$links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                      }
                    else
                      $links = "Yes";
              }
              if($course == "FEG")
              {
                $users = DB::select(DB::raw("SELECT m1.dte_id,fe.name_on_marksheet,m1.branch,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.total_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN fe_students fe ON m1.dte_id = fe.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.granted_amt < m1.total_amt"));
                     // Get current page form url e.x. &page=1
                      $currentPage = LengthAwarePaginator::resolveCurrentPage();
               
                      // Create a new Laravel collection from the array data
                      $itemCollection = collect($users);
               
                      // Define how many items we want to be visible in each page
                      $perPage = 10;
               
                      // Slice the collection to get the items to display in current page
                      $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
               
                      // Create our paginator and pass it to the view
                      $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
               
                      // set url path for generted links
                      $paginatedItems->setPath($request->url());
                    $srno = 1;
                    if($users == [] || $users == null)
                 {$links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                      }
                    else
                      $links = "Yes";
              }
              if($course == "DSE")
              {
                $users = DB::select(DB::raw("SELECT m1.dte_id,me.name_on_marksheet,m1.shift_allotted,m1.granted_amt,m1.paid_amt,m1.total_amt,m1.balance_amt,m1.status,m1.updated_at FROM admission m1 INNER JOIN mca_students me ON m1.dte_id = me.dte_id AND m1.admission_type = 'ACAP' LEFT JOIN admission m2  ON (m1.dte_id = m2.dte_id AND m1.updated_at < m2.updated_at) WHERE m2.dte_id IS NULL AND m1.status = 'ADMITTED' AND m1.granted_amt < m1.total_amt"));
                     // Get current page form url e.x. &page=1
                      $currentPage = LengthAwarePaginator::resolveCurrentPage();
               
                      // Create a new Laravel collection from the array data
                      $itemCollection = collect($users);
               
                      // Define how many items we want to be visible in each page
                      $perPage = 10;
               
                      // Slice the collection to get the items to display in current page
                      $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
               
                      // Create our paginator and pass it to the view
                      $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
               
                      // set url path for generted links
                      $paginatedItems->setPath($request->url());
                    $srno = 1;
                    if($users == [] || $users == null)
                 {$links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                      }
                    else
                      $links = "Yes";
              }
              
                
                  if($users == [])
                  {
                      $array_object = [['dte_id' => null, 'name_on_marksheet' => null, 'branch' => null, 'granted_amt' => null, 'total_amt' => null, 'status' => null, 'updated_at' => null]];
                       $users = json_decode(json_encode($array_object));
                       $srno=null;
                       // Get current page form url e.x. &page=1
                          $currentPage = LengthAwarePaginator::resolveCurrentPage();
                   
                          // Create a new Laravel collection from the array data
                          $itemCollection = collect($users);
                   
                          // Define how many items we want to be visible in each page
                          $perPage = 10;
                   
                          // Slice the collection to get the items to display in current page
                          $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
                   
                          // Create our paginator and pass it to the view
                          $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
                   
                          // set url path for generted links
                          $paginatedItems->setPath($request->url());
                       $request->session()->flash('error', 'NO ENTRY FOUND');
                       $links = "No";
                  } 
                 return view('admin.adminLosAcapPartPayment',['users' => $paginatedItems])->with('srno',$srno)->with('course',$course)->with('links',$links); 
                  
              
          }
        else
              return redirect()->route('adminLogin');
    }


    public static  function searchAdminLosAcapPartPayment(Request $request)
    {
        $dte_id = $request->input('dteId');
        $course = $request->session()->get('adminCourse');
            $event = $request->session()->get('adminEvent');
            if($course == "MEG")
            {
               $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.total_amt, a.balance_amt, a.status, a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'ACAP' AND a.status = 'ADMITTED' AND a.updated_at WHERE m.dte_id LIKE '%".$dte_id."%'" ));
                $srno = 1;
                $links = "No";
            }
            else if($course == "MCA")
            {
              $users = DB::select(DB::raw("SELECT a.dte_id,m.shift_allotted, m.name_on_marksheet, a.branch, a.granted_amt, a.total_amt, a.balance_amt, a.status, a.updated_at FROM admission a INNER JOIN mca_students m ON a.dte_id = m.dte_id AND a.course = 'MCA' AND a.admission_type = 'ACAP' AND a.status = 'ADMITTED' AND a.updated_at WHERE m.dte_id LIKE '%".$dte_id."%'" ));
                $srno = 1;
                $links = "No";
            }

            else if($course == "FEG")
            {
              $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.total_amt, a.balance_amt, a.status, a.updated_at FROM admission a INNER JOIN fe_students m ON a.dte_id = m.dte_id AND a.course = 'FEG' AND a.admission_type = 'ACAP' AND a.status = 'ADMITTED' AND a.updated_at WHERE m.dte_id LIKE '%".$dte_id."%'" ));
                $srno = 1;
                $links = "No";
            }

            else if($course == "DSE")
            {
              $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.total_amt, a.balance_amt, a.status, a.updated_at FROM admission a INNER JOIN dse_students m ON a.dte_id = m.dte_id AND a.course = 'DSE' AND a.admission_type = 'ACAP' AND a.status = 'ADMITTED' AND a.updated_at WHERE m.dte_id LIKE '%".$dte_id."%'" ));
                $srno = 1;
                $links = "No";
            }
        //return "hello";
        if($users == [])
        {
                 $request->session()->flash('error', 'NO ENTRY FOUND');
                 return redirect()->route('adminLosAcapPartPayment');

        }
        else
        {
                 return view('admin.adminLosAcapPartPayment')->with('users',$users)->with('srno',$srno)->with('course',$course)->with('links',$links);; 
        }
    }


    public static function showAdminLosDtePartPayment(Request $request)
    {
               $role =$request->session()->get('role', 'null');
      if ($role != 'null' && ($role=='Admin' || $role=='Super Admin') )
      {
           $course = $request->session()->get('adminCourse','null');
            $event = $request->session()->get('adminEvent','null');

            if($course == 'null' || $event == 'null' || $course == "...Select Your Course" || $event == "...Select Your event")
              {
                 $request->session()->flash('error', 'Please select Course and Event');
                   
                  return redirect()->route('adminsEvent');
              }
              if($course =="MEG")
               {  
                    $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt,a.paid_amt, a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED'"));
                    $srno = 1;
                    // Get current page form url e.x. &page=1
                    $currentPage = LengthAwarePaginator::resolveCurrentPage();
             
                    // Create a new Laravel collection from the array data
                    $itemCollection = collect($users);
             
                    // Define how many items we want to be visible in each page
                    $perPage = 10;
             
                    // Slice the collection to get the items to display in current page
                    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
             
                    // Create our paginator and pass it to the view
                    $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
             
                    // set url path for generted links
                    $paginatedItems->setPath($request->url());
                    
                    if($users == [] || $users == null)
                    {   $links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                    }
                    else
                      $links = "Yes";
              }
              if($course == "MCA")
              {
                    $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet,m.shift_allotted, a.branch, a.granted_amt, a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN mca_students m ON a.dte_id = m.dte_id AND a.course = 'MCA' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED'"));
                    $srno = 1;
                    // Get current page form url e.x. &page=1
                    $currentPage = LengthAwarePaginator::resolveCurrentPage();
             
                    // Create a new Laravel collection from the array data
                    $itemCollection = collect($users);
             
                    // Define how many items we want to be visible in each page
                    $perPage = 10;
             
                    // Slice the collection to get the items to display in current page
                    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
             
                    // Create our paginator and pass it to the view
                    $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
             
                    // set url path for generted links
                    $paginatedItems->setPath($request->url());
                    
                    if($users == [] || $users == null)
                    {   $links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                    }
                    else
                      $links = "Yes";
              }
              if($course == "FEG")
              {
                    $users = DB::select(DB::raw("SELECT a.dte_id, fe.name_on_marksheet, a.branch, a.granted_amt, a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN fe_students fe ON a.dte_id = fe.dte_id AND a.course = 'FEG' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED'"));
                    $srno = 1;
                    // Get current page form url e.x. &page=1
                    $currentPage = LengthAwarePaginator::resolveCurrentPage();
             
                    // Create a new Laravel collection from the array data
                    $itemCollection = collect($users);
             
                    // Define how many items we want to be visible in each page
                    $perPage = 10;
             
                    // Slice the collection to get the items to display in current page
                    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
             
                    // Create our paginator and pass it to the view
                    $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
             
                    // set url path for generted links
                    $paginatedItems->setPath($request->url());
                    
                    if($users == [] || $users == null)
                    {   $links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                    }
                    else
                      $links = "Yes";
              }
              if($course == "DSE")
              {
                    $users = DB::select(DB::raw("SELECT a.dte_id, dse.name_on_marksheet, a.branch, a.granted_amt, a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN dse_students dse ON a.dte_id = dse.dte_id AND a.course = 'DSE' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED'"));
                    $srno = 1;
                    // Get current page form url e.x. &page=1
                    $currentPage = LengthAwarePaginator::resolveCurrentPage();
             
                    // Create a new Laravel collection from the array data
                    $itemCollection = collect($users);
             
                    // Define how many items we want to be visible in each page
                    $perPage = 10;
             
                    // Slice the collection to get the items to display in current page
                    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
             
                    // Create our paginator and pass it to the view
                    $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
             
                    // set url path for generted links
                    $paginatedItems->setPath($request->url());
                    
                    if($users == [] || $users == null)
                    {   $links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                    }
                    else
                      $links = "Yes";
              }
              if($users==[])
              {
                    $array_object = [['dte_id' => null, 'name_on_marksheet' => null, 'branch' => null, 'granted_amt' => null, 'total_amt' => null, 'status' => null, 'updated_at' => null]];
                       $users = json_decode(json_encode($array_object));
                       $srno=null;
                       $request->session()->flash('error', 'NO ENTRY FOUND'); 

                             // Get current page form url e.x. &page=1
                    $currentPage = LengthAwarePaginator::resolveCurrentPage();
             
                    // Create a new Laravel collection from the array data
                    $itemCollection = collect($users);
             
                    // Define how many items we want to be visible in each page
                    $perPage = 10;
             
                    // Slice the collection to get the items to display in current page
                    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
             
                    // Create our paginator and pass it to the view
                    $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
             
                    // set url path for generted links
                    $paginatedItems->setPath($request->url());
                 $request->session()->flash('error', 'NO ENTRY FOUND');
                 $links = "No";
              }
                  
            return view('admin.adminLosDtePartPayment',['users' => $paginatedItems])->with('srno',$srno)->with('course',$course)->with('links',$links);
              

         }
         else
              return redirect()->route('adminLogin');
    }

    public static function searchAdminLosDtePartPayment(Request $request)
    {
       $dte_id = $request->input('dteId');
        $course = $request->session()->get('adminCourse');
            $event = $request->session()->get('adminEvent');
            if($course == "MEG")
            {
              $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt,a.paid_amt,a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED' WHERE m.dte_id LIKE '%".$dte_id."%'" ));
               $srno = 1;
               $links = "No";
            }
            else if($course == "MCA")
            {
              $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet,m.shift_allotted, a.branch, a.granted_amt,a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN mca_students m ON a.dte_id = m.dte_id AND a.course = 'MCA' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED' WHERE m.dte_id LIKE '%".$dte_id."%'" ));
               $srno = 1;
               $links = "No"; 
            }

            else if($course == "FEG")
            {
              $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch,a.shift_allotted, a.paid_amt, a.granted_amt,a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN fe_students m ON a.dte_id = m.dte_id AND a.course = 'FEG' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED' WHERE m.dte_id LIKE '%".$dte_id."%'" ));
               $srno = 1;
               $links = "No"; 
            }

            else if($course == "DSE")
            {
              $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt,a.total_amt, a.status, a.updated_at FROM admission a INNER JOIN dse_students m ON a.dte_id = m.dte_id AND a.course = 'DSE' AND a.admission_type = 'DTE' AND a.status = 'ADMITTED' WHERE m.dte_id LIKE '%".$dte_id."%'" ));
               $srno = 1;
               $links = "No"; 
            }   
        if($users == [])
        {
                 $request->session()->flash('error', 'NO ENTRY FOUND');
                 return redirect()->route('adminLosDtePartPayment');

        }
        else
        {
             return view('admin.adminLosDtePartPayment')->with('users',$users)->with('srno',$srno)->with('links',$links)->with('course',$course);
        }

    
    }

    public static function showAdminLosDteCancelled(Request $request)
    {
        $role =$request->session()->get('role', 'null');
      if ($role != 'null' && ($role=='Admin' || $role=='Super Admin') )
      {
           $course = $request->session()->get('adminCourse','null');
            $event = $request->session()->get('adminEvent','null');

            if($course == 'null' || $event == 'null' || $course == "...Select Your Course" || $event == "...Select Your event")
              {
                 $request->session()->flash('error', 'Please select Course and Event');
                   
                  return redirect()->route('adminsEvent');
              }
              if($course =="MEG")
               {  
                    $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.paid_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'DTE' AND a.status = 'CANCELLED'"));
                    $srno = 1;
                    // Get current page form url e.x. &page=1
                    $currentPage = LengthAwarePaginator::resolveCurrentPage();
             
                    // Create a new Laravel collection from the array data
                    $itemCollection = collect($users);
             
                    // Define how many items we want to be visible in each page
                    $perPage = 10;
             
                    // Slice the collection to get the items to display in current page
                    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
             
                    // Create our paginator and pass it to the view
                    $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
             
                    // set url path for generted links
                    $paginatedItems->setPath($request->url());
                      if($users == [] || $users == null)
                    {   $links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                    }
                    else
                      $links = "Yes";
                }
                if($course == "MCA")
                {
                    $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet,m.shift_allotted, a.paid_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN mca_students m ON a.dte_id = m.dte_id AND a.course = 'MCA' AND a.admission_type = 'DTE' AND a.status = 'CANCELLED'"));
                    $srno = 1;
                    // Get current page form url e.x. &page=1
                    $currentPage = LengthAwarePaginator::resolveCurrentPage();
             
                    // Create a new Laravel collection from the array data
                    $itemCollection = collect($users);
             
                    // Define how many items we want to be visible in each page
                    $perPage = 10;
             
                    // Slice the collection to get the items to display in current page
                    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
             
                    // Create our paginator and pass it to the view
                    $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
             
                    // set url path for generted links
                    $paginatedItems->setPath($request->url());
                      if($users == [] || $users == null)
                    {   $links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                    }
                    else
                      $links = "Yes";   
                }
                if($course == "FEG")
                {
                    $users = DB::select(DB::raw("SELECT a.dte_id, fe.name_on_marksheet,a.branch,a.shift_allotted, a.paid_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN fe_students fe ON a.dte_id = fe.dte_id AND a.course = 'FEG' AND a.admission_type = 'DTE' AND a.status = 'CANCELLED'"));
                    $srno = 1;
                    // Get current page form url e.x. &page=1
                    $currentPage = LengthAwarePaginator::resolveCurrentPage();
             
                    // Create a new Laravel collection from the array data
                    $itemCollection = collect($users);
             
                    // Define how many items we want to be visible in each page
                    $perPage = 10;
             
                    // Slice the collection to get the items to display in current page
                    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
             
                    // Create our paginator and pass it to the view
                    $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
                    // return $users;
                    // set url path for generted links
                    $paginatedItems->setPath($request->url());
                      if($users == [] || $users == null)
                    {   $links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                    }
                    else
                      $links = "Yes";   
                }
                if($course == "DSE")
                {
                    $users = DB::select(DB::raw("SELECT a.dte_id, dse.name_on_marksheet,a.shift_allotted, a.paid_amt, a.status, a.branch,a.updated_at,a.created_at FROM admission a INNER JOIN dse_students dse ON a.dte_id = dse.dte_id AND a.course = 'DSE' AND a.admission_type = 'DTE' AND a.status = 'CANCELLED'"));
                    $srno = 1;
                    // Get current page form url e.x. &page=1
                    $currentPage = LengthAwarePaginator::resolveCurrentPage();
             
                    // Create a new Laravel collection from the array data
                    $itemCollection = collect($users);
             
                    // Define how many items we want to be visible in each page
                    $perPage = 10;
             
                    // Slice the collection to get the items to display in current page
                    $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
             
                    // Create our paginator and pass it to the view
                    $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
             
                    // set url path for generted links
                    $paginatedItems->setPath($request->url());
                      if($users == [] || $users == null)
                    {   $links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                    }
                    else
                      $links = "Yes";   
                }
           
           
           
                return view('admin.adminLosDteCancelled',['users' => $paginatedItems])->with('srno',$srno)->with('course',$course)->with('links',$links);
        }
    else
            return redirect()->route('adminLogin');
    }

    public static function searchAdminLosDteCancelled(Request $request)
    {
       $dte_id = $request->input('dteId');
        $course = $request->session()->get('adminCourse');
            $event = $request->session()->get('adminEvent');
            if($course == "MEG")
            {
                 $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt,a.paid_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN me_students m ON a.dte_id = m.dte_id AND a.course = 'MEG' AND a.admission_type = 'DTE' AND a.status = 'CANCELLED' WHERE m.dte_id LIKE '%".$dte_id."%'" ));
                $srno = 1;
                $links = "No";
            }
            else if($course == "MCA")
            {
                $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, m.shift_allotted,a.branch, a.paid_amt,a.granted_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN mca_students m ON a.dte_id = m.dte_id AND a.course = 'MCA' AND a.admission_type = 'DTE' AND a.status = 'CANCELLED' WHERE m.dte_id LIKE '%".$dte_id."%'" ));
                $srno = 1;
                $links = "No";   
            }

            else if($course == "FEG")
            {
                $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet,a.branch,a.shift_allotted, a.paid_amt,a.granted_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN fe_students m ON a.dte_id = m.dte_id AND a.course = 'FEG' AND a.admission_type = 'DTE' AND a.status = 'CANCELLED' WHERE m.dte_id LIKE '%".$dte_id."%'" ));
                $srno = 1;
                $links = "No";   
            }

            else if($course == "DSE")
            {
                $users = DB::select(DB::raw("SELECT a.dte_id, m.name_on_marksheet, a.branch, a.granted_amt, a.status, a.updated_at,a.created_at FROM admission a INNER JOIN dse_students m ON a.dte_id = m.dte_id AND a.course = 'DSE' AND a.admission_type = 'DTE' AND a.status = 'CANCELLED' WHERE m.dte_id LIKE '%".$dte_id."%'" ));
                $srno = 1;
                $links = "No";   
            }    
        if($users == [])
        {

             $request->session()->flash('error', 'RECORD NOT FOUND'); 
             return redirect()->route('adminLosDteCancelled');
        }
        else
        {
             if($users[0]->status=='CANCELLED')
            {
             return view('admin.adminLosDteCancelled')->with('users',$users)->with('srno',$srno)->with('course',$course)->with('links',$links);
            }
            else
            {
                $request->session()->flash('error', 'STUDENT NOT CANCELLED'); 
                     return redirect()->route('adminLosDteCancelled');   
            }
        }
    }

    public static  function showAdminUsersStaff(Request $request)
    {
         $role =$request->session()->get('role', 'null');
    if ($role != 'null' && ($role=='Admin' || $role=='Super Admin') )
       { $staffs = DB::select(DB::raw("select email_id,admin_staff_name,role,privilege from admin_login where role !='Admin' AND role !='Super Admin'"));

     //$staffs = DB::select(DB::raw("select s.email_id,s.admin_staff_name,t.role from admin_login s INNER JOIN staff_role_history t ON s.email_id = t.email_id"));
        return view('admin.adminUsersStaff')->with('staffs', $staffs);
        }else
            return redirect()->route('adminLogin');
    }

    public static function adminUserStaffRole(Request $request)
    {
        $email =$request->input('adminEmail');
        $course=$request->input('adminCourse');
        $event = $request->input('adminEvent');
        $privilege = $request->input('adminPrivilege');
        date_default_timezone_set("Asia/Kolkata");
      
        
        DB::table('admin_login')->where('email_id', $email)->update(['course' => $course,'event' =>$event,'privilege' => $privilege]);
        $staff = new staff_role_history();
        $staff->email_id = $email;
        $staff->role = "Staff";
        $staff->privilege=$privilege;
        $staff->course = $course;
        $staff->created_at = date("Y-m-d h:i:s");
        $staff->save();
        return redirect()->route('adminUsersStaff');
    }

    public static function addAdminUsersStaff(Request $request)
    {
        $staff_name = $request->input('staffName');
        $email = $request->input('staffEmail');
        $staff_password = $request->input('staffPassword');
        $staff_course = $request->input('staffCourse');
        $staff_event = $request->input('staffEvent');
        $staff_privilege = $request->input('staffPrivilege');

         DB::select("call insert_staff_login('$email','$staff_password','$staff_name','$staff_course','$staff_event','Staff','$staff_privilege')");

        return redirect()->route('adminUsersStaff');
    }

    public static function showAdminUsersAdmin(Request $request)
    {
         $role =$request->session()->get('role', 'null');
    if ($role != 'null' && ($role=='Admin' || $role=='Super Admin') )
        {
            $admins = DB::table('admin_login')->where('role','Admin')->get();
            return view('admin.adminUsersAdmin')->with('admins',$admins);
        }
    else
            return redirect()->route('adminLogin');
    }

    public static function addAdminUsersAdmin(Request $request)
    {
        $admin_name = $request->input('adminName');
        $email = $request->input('adminEmail');
        $admin_password = $request->input('adminPassword');

         DB::select("call insert_admin_login('$email','$admin_password','$admin_name','Admin','MCA','All')");
            return redirect()->route('adminUsersAdmin');
    }




    public static function showAdminUsersStudent(Request $request)
    {
         $role =$request->session()->get('role', 'null');
    if ($role != 'null' && ($role=='Admin' || $role=='Super Admin') )
    {
        $array_object = [['dte_id'=> null,'name_on_marksheet' => null]];
        $user = json_decode(json_encode($array_object));
        $array_object = [['branch' => 'No Entry','shift_allotted' => 'No Entry']];
        $aduser = json_decode(json_encode($array_object));
        $array_object = [['status_to' => 'No Entry']];
        $status = json_decode(json_encode($array_object));
        return view('admin.adminUsersStudent')->with('user',$user)->with('aduser',$aduser)->with('status',$status);
        
    }
    else
            return redirect()->route('adminLogin');
    }




 public static function showAdminTransactionDetails(Request $request)
    {
         $role =$request->session()->get('role', 'null');
         $course = $request->session()->get('adminCourse');
    if ($role != 'null' && ($role=='Admin' || $role=='Super Admin') )
    {
        $array_object = [['dte_id' => null, 'name_on_marksheet' => null,'course' => null,'event_from'=>null,'status_to'=>null,'status_from'=>null,'event_to'=>null,'event_from'=>null,'updated_at'=>null]];
        $user = json_decode(json_encode($array_object));
        $array_object = [['dte_id' => null, 'course' => null,'branch' => null,'shift_allotted'=>null,'status'=>null,'admission_type'=>null,'updated_at'=>null]];
        $user3 = json_decode(json_encode($array_object));
         $array_object = [['event' => null, 'status' => null]];
        $user5 = json_decode(json_encode($array_object));
         $array_object = [['event' => null, 'status' => null]];
        $user6 = json_decode(json_encode($array_object));
       // return $user1;
        return view('admin.adminTransactionDetails')->with('user',$user)->with('course',$course)->with('user3',$user3)->with('user5',$user5)->with('user6',$user6);
    }
    else
            return redirect()->route('adminLogin');
    }


 public static function addAdminTransactionDetails(Request $request)
    {
        $dte_id = $request->input('dteId');
        $request->session()->put('dte_id5',$dte_id);
         $course = $request->session()->get('adminCourse');
        //return $course;
        $user5 = DB::select(DB::raw("SELECT event_to as event,status_to as status  from status_details where dte_id LIKE '%".$dte_id."%' AND event_to = 'DTE' order by updated_at desc limit 1"));
         $user6 = DB::select(DB::raw("SELECT event_to as event,status_to as status  from status_details where dte_id LIKE '%".$dte_id."%' AND event_to = 'ACAP' order by updated_at desc limit 1"));
        //return $user5;
         if ($course=='FEG') {
            $user = DB::select(DB::raw("select s.dte_id,s.name_on_marksheet,t.course,t.event_from,t.status_from,t.event_to,t.status_to,t.updated_at from fe_students s INNER JOIN status_details t ON s.dte_id = t.dte_id where s.dte_id LIKE '%".$dte_id."%' "));
         }

        if ($course=='DSE') {
            $user = DB::select(DB::raw("select s.dte_id,s.name_on_marksheet,t.course,t.event_from,t.status_from,t.event_to,t.status_to,t.updated_at from dse_students s INNER JOIN status_details t ON s.dte_id = t.dte_id where s.dte_id LIKE '%".$dte_id."%' "));
         }

         if ($course=='MEG') {
            $user = DB::select(DB::raw("select s.dte_id,s.name_on_marksheet,t.course,t.event_from,t.status_from,t.event_to,t.status_to,t.updated_at from me_students s INNER JOIN status_details t ON s.dte_id = t.dte_id where s.dte_id LIKE '%".$dte_id."%' "));
         }

         if ($course=='MCA') {
            $user = DB::select(DB::raw("select s.dte_id,s.name_on_marksheet,t.course,t.event_from,t.status_from,t.event_to,t.status_to,t.updated_at from mca_students s INNER JOIN status_details t ON s.dte_id = t.dte_id where s.dte_id LIKE '%".$dte_id."%' "));
         }
        
        $user3 = DB::select(DB::raw("SELECT * FROM `admission` where `dte_id` LIKE '%".$dte_id."%' "));
       // return $user6;
     // return $user;
      //  return $user3;
      if($user5 == [])
      {   
          $array_object = [['event' => null,'status'=>null]];
                $user5 = json_decode(json_encode($array_object));
          return view('admin.adminTransactionDetails')->with('user',$user)->with('user3',$user3)->with('course',$course)->with('user5',$user5)->with('user6',$user6);
      }
      else if($user6 == [])
      {   

          $array_object = [['event' => null,'status'=>null]];
                $user6 = json_decode(json_encode($array_object));
          return view('admin.adminTransactionDetails')->with('user',$user)->with('user3',$user3)->with('course',$course)->with('user5',$user5)->with('user6',$user6);
      }
      else if($user == [] || $user5 == [] ||$user6 == [])
       {
           $request->session()->flash('error','Student Record Not Found');
           return redirect()->route('adminTransactionDetails');
        
       }
      else
       {
           return view('admin.adminTransactionDetails')->with('user',$user)->with('user3',$user3)->with('course',$course)->with('user5',$user5)->with('user6',$user6);
       }
    }
   

public static function showAdminStaffRoleHistory(Request $request)
    {
         $role =$request->session()->get('role', 'null');
    if ($role != 'null' && ($role=='Admin' || $role=='Super Admin') )
    {
        $array_object = [['email_id' => null, 'role' => null,'course' => null,'updated_at'=>null,'admin_staff_name'=>null]];
        $user = json_decode(json_encode($array_object));
       
        return view('admin.adminStaffRoleHistory')->with('user',$user);
    }
    else
            return redirect()->route('adminLogin');
    }
    
  public static function addAdminStaffRoleHistory(Request $request)
    {
         $role =$request->session()->get('role', 'null');
         $email_id = $request->input('dteId');
        $user= DB::select(DB::raw("SELECT m1.email_id,m1.role,m1.course,m1.updated_at,m2.admin_staff_name from  staff_role_history m1 inner JOIN  admin_login m2 on m1.email_id = m2.email_id where m1.email_id LIKE '%".$email_id."%' "));     
    
        return view('admin.adminStaffRoleHistory')->with('user',$user);
    }
    

    
    public static function adminUnSubmit(Request $request)
    {
        $dte_id =$request->session()->pull('dte_id5');
        $course = $request->session()->get('adminCourse');
          date_default_timezone_set("Asia/Kolkata");

 
         $user5 = DB::select(DB::raw("SELECT event_to as event,status_to as status  from status_details where dte_id LIKE '%".$dte_id."%' order by updated_at desc limit 1"));
        $event = $user5[0]->event;
         $status = $user5[0]->status;
         if(($event == "ACAP" || $event == "DTE" ) && ($status == "SUBMITTED"))
         {
             $status = new status_details;
             $status->dte_id =$dte_id;
             $status->event_from = $event;
             $status->status_from  = "SUBMITTED";
             $status->event_to =$event;
             $status->status_to = "INITIATED";
             $status->course =$course;
             $status->created_at = date("Y-m-d H:i:s");
             $status->updated_at = date("Y-m-d H:i:s");
             $status->save();
         }
        return redirect()->route('adminTransactionDetails');    
    }


    public static function adminUnSeized(Request $request)
    {
         $dte_id =$request->session()->pull('dte_id5');
     //   return $dte_id;
        $course = $request->session()->get('adminCourse');
          date_default_timezone_set("Asia/Kolkata");
        //  return $dte_id;SELECT event_to as event,status_to as status  from status_details where dte_id LIKE '%".$dte_id."%' order by updated_at desc limit 1
          $user5 = DB::select(DB::raw("SELECT event_to as event ,status_to as status from status_details where dte_id LIKE '%".$dte_id."%' AND event_to ='ACAP' order by updated_at desc limit 1"));
         //return $user;
         $event = $user5[0]->event;
         $status = $user5[0]->status;
         if(( $event== "ACAP") && ($status == "SEIZED"))
         {
            // return $user5;
             $status = new status_details;
             $status->dte_id =$dte_id;
             $status->event_from = $event;
             $status->status_from  = "SEIZED";
             $status->event_to = $event;
             $status->status_to = "SUBMITTED";
             $status->course =$course;
             $status->created_at = date("Y-m-d  H:i:s ");
             $status->updated_at = date("Y-m-d  H:i:s ");
             $status->save();
         }
        return redirect()->route('adminTransactionDetails'); 
    }
    
     public static function adminUnFormVerified(Request $request)
    {
         $dte_id =$request->session()->pull('dte_id5');
        $course = $request->session()->get('adminCourse');
          date_default_timezone_set("Asia/Kolkata");
          
          $user5 = DB::select(DB::raw("SELECT event_to as event,status_to as status  from status_details where dte_id LIKE '%".$dte_id."%' AND event_to ='DTE' order by updated_at desc limit 1"));
         $event = $user5[0]->event;
         $status = $user5[0]->status;
         if($event == "DTE"  && $status == "FORM_VERIFIED")
         {
             $status = new status_details;
             $status->dte_id =$dte_id;
             $status->event_from = $event;
             $status->status_from  = "FORM_VERIFIED";
             $status->event_to =$event;
             $status->status_to = "SUBMITTED";
             $status->course =$course;
             $status->created_at = date("Y-m-d H:i:s");
             $status->updated_at = date("Y-m-d H:i:s");
             $status->save();
         }
        return redirect()->route('adminTransactionDetails'); 
    }
    
     public static function adminUnDocumentVerified(Request $request)
    {
         $dte_id =$request->session()->pull('dte_id5');
        $course = $request->session()->get('adminCourse');
          date_default_timezone_set("Asia/Kolkata");
          
          $user5 = DB::select(DB::raw("SELECT event_to as event,status_to as status  from status_details where dte_id LIKE '%".$dte_id."%' AND event_to ='DTE' order by updated_at desc limit 1"));
         if( $user5[0]->event == "DTE"  && $user5[0]->status == "DOCUMENT_VERIFIED")
         {
             $status = new status_details;
             $status->dte_id =$dte_id;
             $status->event_from = $user5[0]->event;
             $status->status_from  = "DOCUMENT_VERIFIED";
             $status->event_to =$user5[0]->event;
             $status->status_to = "FORM_VERIFIED";
             $status->course =$course;
             $status->created_at = date("Y-m-d H:i:s");
             $status->updated_at = date("Y-m-d H:i:s");
             $status->save();
         }
        return redirect()->route('adminTransactionDetails'); 
    }
    
    public static function showAdminAccounts(Request $request)
    {
         $email =$request->session()->get('email_id', 'null');
    if ($email != 'null')
        {
           
            $users = DB::table('fees_transaction')->get();
            // Get current page form url e.x. &page=1
                $currentPage = LengthAwarePaginator::resolveCurrentPage();
         
                // Create a new Laravel collection from the array data
                $itemCollection = collect($users);
         
                // Define how many items we want to be visible in each page
                $perPage = 10;
         
                // Slice the collection to get the items to display in current page
                $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
         
                // Create our paginator and pass it to the view
                $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
         
                // set url path for generted links
                $paginatedItems->setPath($request->url());   
                 if($users == [] || $users == null)
                 {$links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                      }
                    else
                      $links = "Yes";
            return view('admin.adminAccounts',['users' => $paginatedItems])->with('links',$links);
        }
    else
            return redirect()->route('adminLogin');
    }
    
    public static function searchAdminAccounts(Request $request)
    {
        $dte_id = $request->input('dteId');
        $users = DB::table('fees_transaction')->where('dte_id',$dte_id)->get();
        $links = "No";
            return view('admin.adminAccounts')->with('users',$users)->with('links',$links);
        
    }

    public static function showAdminsuggestion(Request $request)
    {
         $role =$request->session()->get('role', 'null');
    if ($role != 'null' && ($role=='Admin' || $role=='Super Admin') )
        {$suggestion = DB::table('suggestion')->get();
      // return $suggestion;
       // Get current page form url e.x. &page=1
                $currentPage = LengthAwarePaginator::resolveCurrentPage();
         
                // Create a new Laravel collection from the array data
                $itemCollection = collect($suggestion);
         
                // Define how many items we want to be visible in each page
                $perPage = 10;
         
                // Slice the collection to get the items to display in current page
                $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
                // return$currentPageItems;
         
                // Create our paginator and pass it to the view
                $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
         
                // set url path for generted links
                $paginatedItems->setPath($request->url());   
                 if($suggestion == [] || $suggestion == null)
                 {$links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                      }
                    else
                      $links = "Yes";
        return view('admin.adminsuggestion',['users' => $paginatedItems])->with('suggestion', $suggestion)->with('links',$links);
        }else
            return redirect()->route('adminLogin');
    }
 public static function showAdmingrevience(Request $request)
    {
         $role =$request->session()->get('role', 'null');
    if ($role != 'null' && ($role=='Admin' || $role=='Super Admin') )
        {$grevience = DB::table('grievance')->get();
      // return $grevience;
       // Get current page form url e.x. &page=1
                $currentPage = LengthAwarePaginator::resolveCurrentPage();
         
                // Create a new Laravel collection from the array data
                $itemCollection = collect($grevience);
         
                // Define how many items we want to be visible in each page
                $perPage = 10;
         
                // Slice the collection to get the items to display in current page
                $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
                // return$currentPageItems;
         
                // Create our paginator and pass it to the view
                $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
         
                // set url path for generted links
                $paginatedItems->setPath($request->url());   
                 if($grevience == [] || $grevience == null)
                 {$links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                      }
                    else
                      $links = "Yes";
        return view('admin.adminGrevience',['users' => $paginatedItems])->with('grevience', $grevience)->with('links',$links);
        }else
            return redirect()->route('adminLogin');
    }
     public static function showAdminfeedback(Request $request)
    {
         $role =$request->session()->get('role', 'null');
    if ($role != 'null' && ($role=='Admin' || $role=='Super Admin') )
        {$feedback = DB::table('feedback')->get();
      // return $feedback;
       // Get current page form url e.x. &page=1
                $currentPage = LengthAwarePaginator::resolveCurrentPage();
         
                // Create a new Laravel collection from the array data
                $itemCollection = collect($feedback);
         
                // Define how many items we want to be visible in each page
                $perPage = 10;
         
                // Slice the collection to get the items to display in current page
                $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
                // return$currentPageItems;
         
                // Create our paginator and pass it to the view
                $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
         
                // set url path for generted links
                $paginatedItems->setPath($request->url());   
                 if($feedback == [] || $feedback == null)
                 {$links = "No";
                        $request->session()->flash('error', 'NO RECORDS FOUND');  
                      }
                    else
                      $links = "Yes";
        return view('admin.adminFeedback',['users' => $paginatedItems])->with('feedback', $feedback)->with('links',$links);
        }else
            return redirect()->route('adminLogin');
    }


    public static function showAdminEvents(Request $request)
    {
         $role =$request->session()->get('role', 'null');
    if ($role != 'null' && ($role=='Admin' || $role=='Super Admin') )
        {$events = DB::table('event')->get();
        return view('admin.adminEvents')->with('events', $events);
        }else
            return redirect()->route('adminLogin');
    }

    public static function addAdminEvents(Request $request)
    {
        $course = $request->input('course');
        $event_name = $request->input('eventName');
        $from_date = $request->input('fromDate');
        $to_date = $request->input('toDate');
        $event_type = $request->input('type');

        DB::select("call insert_event('$event_name','$event_type','$from_date','$to_date','$course')");

        return redirect()->route('adminEvents');
    }

    public static function showChangeAdminPassword(Request $request)
    {
        return view('admin.changeAdminPassword');
    }

    public static function changeAdminPassword(Request $request)
    {
            $enteredPassword = $request->input('oldPassword');
            $password = $request->input('password');
            $password = Hash::make($password);
            $role = $request->session()->get('role');
            $email_id = $request->session()->get('email_id');
            $user = DB::table('admin_login')->select('admin_pwd')->where('email_id', $email_id)->get();
            $hashedPassword = $user[0]->admin_pwd;
            if (Hash::check($enteredPassword, $hashedPassword))
              {
              DB::table('admin_login')->where('email_id', $email_id)->update(['admin_pwd' => $password]);
              if($role == "Staff")
                 return view('admin.staffRoleSelector');
               else if($role == "Admin" || $role == "Super Admin")
                      return view('admin.adminSelector');
              else
                    return view('admin.changeAdminPassword');    
              }
             else    
                return view('admin.changeAdminPassword');
    }

     public static function showChangeStaffPassword(Request $request)
    {
        return view('admin.changeStaffPassword');
    }

    public static function changeStaffPassword(Request $request)
    {
            $enteredPassword = $request->input('oldPassword');
            $password = $request->input('password');
            $password = Hash::make($password);
            $role = $request->session()->get('role');
            $email_id = $request->session()->get('email_id');
            $user = DB::table('admin_login')->select('admin_pwd')->where('email_id', $email_id)->get();
            $hashedPassword = $user[0]->admin_pwd;
            if (Hash::check($enteredPassword, $hashedPassword))
              {
              DB::table('admin_login')->where('email_id', $email_id)->update(['admin_pwd' => $password]);
              if($role == "Staff")
                 return view('admin.staffRoleSelector');
               else if($role == "Admin" || $role == "Super Admin")
                      return view('admin.adminSelector');
              else
                    return view('admin.changeStaffPassword');    
              }
             else    
                return view('admin.changeStaffPassword');
    }



public function updatefeacademic(Request $request)
{
     
      if($request->session()->get('dte',null)!=null)
                $dte_id = $request->session()->get('dte');
     elseif($request->session()->get('dte1',null)!=null)
                 $dte_id = $request->session()->get('dte1');   
      elseif($request->session()->get('dte2',null)!=null)
                 $dte_id = $request->session()->get('dte2');  
       elseif($request->session()->get('dte3',null)!=null)
                 $dte_id = $request->session()->get('dte3');            
        
        $is=DB::table('fe_students')->select('is_cet','is_jee')->where('dte_id',$dte_id)->get();
       $is_cet = $is[0]->is_cet;
       $is_jee = $is[0]->is_jee;
    
                 
        $x_school_name = $request->input('sscSchool'); 
        $x_board = $request->input('sscBoard');
        $x_school_city = $request->input('sscCity');
        $x_school_state = $request->input('sscState');
        $x_passing_year = $request->input('xPassingYear');
        $x_passing_month =$request->input('xPassingMonth');
        $x_obtained_marks = $request->input('xObtainedMarks');
        $x_max_marks = $request->input('xMaximumMarks');
        $x_percentage = $request->input('xPercentage');
        $x_board_seat_no=$request->input('sscBoardNumber');

         // HSC details
         $xii_college_name = $request->input('hscCollege');
         $xii_board = $request->input('hscBoard');
         $xii_college_state = $request->input('hscState');
         $xii_college_city = $request->input('hscCity');
         $xii_passing_year = $request->input('xiiPassingYear');
         $xii_passing_month = $request->input('xiipassingMonth');
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


         $xii_board_seat_no=$request->input('hscBoardNumber');
      // return $is_cet;
         // CET details
         
         if ($is_cet==0) {
         $cet_seat_no='NA';
         $cet_score=0;
         $cet_month=null;
         $cet_year=0;
         $cet_maths=0;
         $cet_physics=0;
         $cet_chemistry=0;

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
        
         if ($is_jee==0) {
           
         $is_jee =0;  
         $jee_seat_no='NA';
         $jee_score=0;
         $jee_month=null;
         $jee_year="0";
         $jee_maths=0;
         $jee_physics=0;
         $jee_chemistry=0;

         }
         else{
         $is_jee =1;
         $jee_seat_no=$request->input('jeeSeatNumber');
         $jee_score=$request->input('jeeScore');
         $jee_month=$request->input('jeeMonth');
         $jee_year=$request->input('jeeYear');
         $jee_maths=$request->input('jeeMathsScore');
         $jee_physics=$request->input('jeePhysicsScore');
         $jee_chemistry=$request->input('jeeChemistryScore');
}
     if (DB::table('fe_students')->where('dte_id', $dte_id)->exists()) 
         { 
        
    //Prodedure
 

     DB::statement("update fe_students set x_passing_month = '".$x_passing_month."', x_passing_year = '".$x_passing_year."' ,x_board = '".$x_board."' ,x_max_marks = '".$x_max_marks."',x_obtained_marks = '".$x_obtained_marks."',x_percentage = '".$x_percentage."',x_school_name = '".$x_school_name."',x_school_city = '".$x_school_city."',x_school_state = '".$x_school_state."',x_board_seat_no = '".$x_board_seat_no."',xii_passing_month = '".$xii_passing_month."',xii_passing_year = '".$xii_passing_year."',xii_board = '".$xii_board."',xii_max_marks = '".$xii_max_marks."',xii_obtained_marks = '".$xii_obtained_marks."',xii_maths_max_marks = '".$xii_math_max."',xii_maths_obtained_marks = '".$xii_math_obtain."', xii_physics_max_marks = '".$xii_physics_max."',xii_physics_obtained_marks = '".$xii_physics_obtain."',xii_chemistry_max_marks = '".$xii_chemistry_max."',xii_chemistry_obtained_marks = '".$xii_chemistry_obtain."', xii_vocational_subject1 = '".$xii_vocational_subject1."',xii_vocational_subject1_code = '".$xii_vocational_subject1_code."',xii_vocational_subject1_max_marks = '".$xii_vocational_subject1_max_marks."',xii_vocational_subject1_obtained_marks = '".$xii_vocational_subject1_obtained_marks."',xii_board_seat_no = '".$xii_board_seat_no."',xii_aggregate_marks = '".$xii_aggregate_marks."',xii_percentage = '".$xii_percentage."',xii_college_name = '".$xii_college_name."',xii_college_city = '".$xii_college_city."',xii_college_state = '".$xii_college_state."',is_cet = '".$is_cet."',cet_seat_no = '".$cet_seat_no."',cet_score = '".$cet_score."',cet_month = '".$cet_month."',cet_year = '".$cet_year."',cet_maths = '".$cet_maths."',cet_physics = '".$cet_physics."',cet_chemistry = '".$cet_chemistry."',is_jee = '".$is_jee."',jee_seat_no = '".$jee_seat_no."',jee_score = '".$jee_score."',jee_month = '".$jee_month."',jee_year = '".$jee_year."',jee_maths_score = '".$jee_maths."',jee_physics_score = '".$jee_physics."',jee_chemistry_score = '".$jee_chemistry."',is_academic_completed = 1,created_at = CURRENT_TIMESTAMP  where dte_id = '".$dte_id."' ");  
    }


      return redirect()->route('adminFormViewFE');
}



     public function updatefedte(Request $request)
{
        if($request->session()->get('dte',null)!=null)
                $dte_id = $request->session()->get('dte');
       // return $dte_id;
     elseif($request->session()->get('dte1',null)!=null)
                 $dte_id = $request->session()->get('dte1');   
      elseif($request->session()->get('dte2',null)!=null)
                 $dte_id = $request->session()->get('dte2');  
       elseif($request->session()->get('dte3',null)!=null)
                 $dte_id = $request->session()->get('dte3');            
            
          $acap=DB::table('fe_students')->select('acap_category')->where('dte_id',$dte_id)->get()[0]->acap_category;
          //$acap_category=$acap[0]->acap_category;
          //return $acap;
          $mh_state_general_merit_no = $request->input('mhStateGeneralmeritNo');
          $category = $request->input('category');
          $candidate_type = $request->input('candidate_types');
          $type=$request->input('seatType');
        //  return $type;
          
          DB::select("call insert_update_fe_dte('$dte_id','$category','$candidate_type','$mh_state_general_merit_no','$type','$acap')");
      return redirect()->route('adminFormViewFE');        
}

public function updatefepersonal(Request $request)
{

      if($request->session()->get('dte',null)!=null)
                $dte_id = $request->session()->get('dte');
     elseif($request->session()->get('dte1',null)!=null)
                 $dte_id = $request->session()->get('dte1');   
      elseif($request->session()->get('dte2',null)!=null)
                 $dte_id = $request->session()->get('dte2');  
       elseif($request->session()->get('dte3',null)!=null)
                 $dte_id = $request->session()->get('dte3');            
                 
    $name_on_marksheet = $request->input('nameAsOnMarksheet');
    $gender = $request->input('gender');
    $date_of_birth = $request->input('dob');
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
   // return $dte_id;
    if(DB::table('fe_students')->where('dte_id',$dte_id)->exists()){
      $user=studentLogin::where('dte_id',$dte_id)->take(1)->get();
      $fn=$user[0]->first_name;
      $mn=$user[0]->middle_name;
      $ln=$user[0]->last_name;

    }

    DB::select("call insert_update_fe_personal('$dte_id','$name_on_marksheet','$gender','$date_of_birth','$place_of_birth_state','$place_of_birth_city','$mother_tongue','$nationality','$caste_tribe ','$religion','$blood_group','$uid','$student_domicile_no','$student_domicile_date','$student_domicile_appl_no','$student_domicile_appl_date','$fn','$mn','$ln')");
       return redirect()->route('adminFormViewFE');
}

public function updatefecontact(Request $request)
{
      if($request->session()->get('dte',null)!=null)
                $dte_id = $request->session()->get('dte');
     elseif($request->session()->get('dte1',null)!=null)
                 $dte_id = $request->session()->get('dte1');   
      elseif($request->session()->get('dte2',null)!=null)
                 $dte_id = $request->session()->get('dte2');  
       elseif($request->session()->get('dte3',null)!=null)
                 $dte_id = $request->session()->get('dte3');    
                 
                 
                 
      $is=DB::table('fe_students')->select('resident_of')->where('dte_id',$dte_id)->get();
     //  $is_correspon_as_permanent = $is[0]->is_correspon_as_permanent;
       $is_local_or_outstation = $is[0]->resident_of;
     
     
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
    $local_guardian_state = $request->input('localGuardianAddressState');
    $local_guardian_district = $request->input('localGuardianAdreessDristict');
    $local_guardian_pincode = $request->input('localGuardianAddressPincode');

    /*if($is_correspon_as_permanent=="yes")
    {
        $correspondance_address_line1 =  $permanent_address_line1;
        $correspondance_address_line2 = $permanent_address_line2;
        $correspondance_city = $permanent_city;
        $correspondance_state = $permanent_state;
        $correspondance_district = $permanent_district;
        $correspondance_pincode =$permanent_pincode;
        $correspondance_nearest_rail_station =  $permanent_nearest_rail_station;
    }
    else
    {*/
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
        $local_nearest_rail_station="NA";
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
        $local_nearest_rail_station=$request->input('localNearestRailwayStation');
    }

    DB::select("call insert_update_fe_contact('$dte_id','$permanent_address_line1','$permanent_address_line2','$permanent_city','$permanent_district','$permanent_state','$permanent_pincode','$permanent_nearest_rail_station','$correspondance_address_line1','$correspondance_address_line2','$correspondance_city','$correspondance_district','$correspondance_state','$correspondance_pincode','$correspondance_nearest_rail_station',' $is_local_or_outstation','$local_guardian_name','$local_guardian_address_line1','$local_guardian_address_line2','$local_guardian_city','$local_guardian_district','$local_guardian_state','$local_guardian_pincode','$local_nearest_rail_station')");
      
      return redirect()->route('adminFormViewFE');
}


public function updatefeguardian(Request $request)
{
     
     if($request->session()->get('dte',null)!=null)
                $dte_id = $request->session()->get('dte');
     elseif($request->session()->get('dte1',null)!=null)
                 $dte_id = $request->session()->get('dte1');   
      elseif($request->session()->get('dte2',null)!=null)
                 $dte_id = $request->session()->get('dte2');  
       elseif($request->session()->get('dte3',null)!=null)
                 $dte_id = $request->session()->get('dte3');            
                 
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
    $parent_domicile_no = $request->input('parentDomecileNo');
    $parent_domicile_date = $request->input('dateOfParentDomecile');
    $parent_domicile_appl_no = $request->input('parentDomecileApplicationNo');
    $parent_domicile_appl_date = $request->input('applicationDateOfParentDomecile');
  //  DB::table('mca_sstudents')->where('dte_id',$dte_id)->update(['dte_id'=> $dte_id]);
    DB::select("call insert_update_fe_guardian('$dte_id','$g_relation','$g_first_name','$g_middle_name','$g_last_name','$g_mobile','$g_occupation','$g_qualification','$g_office_address','$g_office_tel_no','$g_annual_income','$parent_domicile_no','$parent_domicile_date','$parent_domicile_appl_no','$parent_domicile_appl_date','$mother_name')");  
    return redirect()->route('adminFormViewFE');

}

public static function showadminFormViewFE(Request $request)
    {
        $email =$request->session()->get('email_id', 'null');
        $role =$request->session()->get('role');
      //  return $role;
    if ($email != 'null')
        {
             if($role == "Staff")
            {
              $course = DB::table('admin_login')->select('course','event')->where('email_id',$email)->get();
              $event = $course[0]->event;
            }
            else
            {
              $course =$request->session()->get('adminCourse',null);
                $event = $request->session()->get('adminEvent');
            }
      
            
        
        
        if($event == "ACAP")
        {
            $dte_id = $request->session()->get('dte');
        }
        elseif($event == "DTE")
        {
            if($request->session()->get('dte',null)!=null)
                      $dte_id = $request->session()->get('dte');
             elseif($request->session()->get('dte3',null)!=null)
                       $dte_id = $request->session()->get('dte3');        
         }
            //return $dte_id
    /*  if($request->session()->get('dte',null)!=null)
                $dte_id = $request->session()->get('dte');
     elseif($request->session()->get('dte1',null)!=null)
                 $dte_id = $request->session()->get('dte1');   
      elseif($request->session()->get('dte2',null)!=null)
                 $dte_id = $request->session()->get('dte2');
       else
       if($request->session()->get('dte3',null)!=null)
                 $dte_id = $request->session()->get('dte3');  */
        //  return $dte_id;
          /* if (substr($dte_id, 0, 1) == 'D') 
            {
                   $user1=DB::table('dse_students')->where('dte_id',$dte_id)->get();
             }
           elseif (substr($dte_id, 0, 1) == 'E') 
             {
                       $user1=DB::table('fe_students')->where('dte_id',$dte_id)->get();
             }
           else*//*if (substr($dte_id, 0, 2) == "MC") 
            {*/
                     $user1=DB::table('fe_students')->where('dte_id',$dte_id)->get();
                     $course="FEG";
           /*}
           elseif (substr($dte_id, 0, 2) == "ME") 
            {
                       $user1=DB::table('me_students')->where('dte_id',$dte_id)->get();
                     $course="ME";
            }*/

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
              'EM'=>'Electrical Machine',
              'EMT'=>'Electrical Maintenance',
              'PD'=>'Physical Education',
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
      $candidate_types = array(
        'A' => 'Type A',
        'B' => 'Type B',
        'C' => 'Type C',
        'D' => 'Type D',
        'E' => 'Type E',
        'F' => 'Type F',
        'O'=>  'Type OMS'
      );
      $blood_groups = array(
        'A+' => 'A+',
        'A-' => 'A-',
        'B+' => 'B+',
        'B-' => 'B-',
        'AB+' => 'AB+',
        'AB-' => 'AB-',
        'O+' => 'O+',
        'O-' => 'O-'
      );
      $genders = array(
        'Male' => 'Male',
        'Female' => 'Female',
        'Transgender' => 'Transgender'
      );
         $relations = array(
       'Husband' => 'H',
        'Parent' => 'F',
        'Guardian' => 'G',
      );

          $residences = array(
        'Local' => 'L',
        'Outstation' => 'O'
      );
      $data['residences'] = $residences;
      $data['blood_groups'] = $blood_groups;
      $data['genders'] = $genders;
 if($user1[0]->correspondance_address_line1 != null)
        $data['permanent'] = "true";
      else
        $data['permanent'] = "false";
 $data['relations'] = $relations;   
      $data['months'] = $months;
      $data['categories'] = $categories;
      $data['candidate_types'] = $candidate_types;
                 $data['user1'] = $user1;
          return view('admin.adminFormViewFE',$data);  
        }
        else{
            return redirect()->route('logout');
        }
    }
    
    public static function checkadminFormViewFE(Request $request)
    {
    return view('admin.adminFormViewFE'); 
    }


       public function updatedsedte(Request $request)
    {

      if($request->session()->get('dte',null)!=null)
                $dte_id = $request->session()->get('dte');
     elseif($request->session()->get('dte1',null)!=null)
                 $dte_id = $request->session()->get('dte1');   
      elseif($request->session()->get('dte2',null)!=null)
                 $dte_id = $request->session()->get('dte2');  
       elseif($request->session()->get('dte3',null)!=null)
                 $dte_id = $request->session()->get('dte3');  
    
      $data =DB::table('dse_students')->select('acap_category')->where('dte_id',$dte_id)->get();                     
      $acap=$data[0]->acap_category;

          $mh_state_general_merit_no = $request->input('mhStateGeneralmeritNo');
          $category = $request->input('category');
          $candidate_type = $request->input('candidate_types');
          $seat_type=$request->input('seatType');


      DB::select("call insert_update_dse_dte('$dte_id','$category','$candidate_type','$mh_state_general_merit_no','$seat_type','$acap')");
         return redirect()->route('adminFormViewDSE');
    }

    public function updatedseacademic(Request $request)
    {

      if($request->session()->get('dte',null)!=null)
                $dte_id = $request->session()->get('dte');
     elseif($request->session()->get('dte1',null)!=null)
                 $dte_id = $request->session()->get('dte1');   
      elseif($request->session()->get('dte2',null)!=null)
                 $dte_id = $request->session()->get('dte2');  
       elseif($request->session()->get('dte3',null)!=null)
                 $dte_id = $request->session()->get('dte3');  
             
                 $is=DB::table('dse_students')->select('is_hsc','is_four_year')->where('dte_id',$dte_id)->get();
       $is_hsc = $is[0]->is_hsc;
       $is_four_year = $is[0]->is_four_year;        
                 
    
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

    $diploma_university = $request->input('diplomaBScClgUni');
    $diploma_passing_month = $request->input('diplomaPassingMonth');
    $diploma_passing_year = $request->input('diplomaPassingYear');
    $diploma_branch = $request->input('diplomaBranch');
    $diploma_college_name = $request->input('diplomaCollegeName');
    $diploma_college_city = $request->input('diplomaCollegeCity');
    $diploma_college_state =$request->input('diplomaCollegeState');
    $diploma_seat_no =$request->input('diplomaSeatNo');
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

    if( $is_four_year=="yes")
    {
        $diploma_max_marks_sem7 =$request->input('diploma_max_marks_sem7');
        $diploma_obt_marks_sem7 =$request->input('diploma_obt_marks_sem7');
        $diploma_max_marks_sem8 =$request->input('diploma_max_marks_sem8');
        $diploma_obt_marks_sem8 =$request->input('diploma_obt_marks_sem8');
        $diploma_aggr_obt_sem8 =$request->input('AggrObtainedMarksSem8');
        $diploma_aggr_max_sem8 =$request->input('AggrMaximumMarksSem8');
        $diploma_aggr_percent_sem8 =$request->input('AggrPercentageSem8');
 
            
   }
    else
    {
        $diploma_max_marks_sem7 = "00";
        $diploma_obt_marks_sem7 ="00";
        $diploma_max_marks_sem8 ="00";
        $diploma_obt_marks_sem8 = "00";
        $diploma_aggr_obt_sem8 = "00";
        $diploma_aggr_max_sem8 = "00";
        $diploma_aggr_percent_sem8 = "00";
       
    }
    

      DB::select("call insert_update_dse_academic('$dte_id','$x_passing_month','$x_passing_year','$x_board','$x_max_marks','$x_obtained_marks','$x_percentage','$x_school_name','$x_school_city','$x_school_state','$x_board_seat_no','$is_hsc','$xii_passing_month','$xii_passing_year','$xii_board','$xii_board_seat_no','$xii_max_marks','$xii_obtained_marks','$xii_percentage','$xii_college_name','$xii_college_city','$xii_college_state','$diploma_university','$diploma_passing_month','$diploma_passing_year','$diploma_branch','$diploma_college_name','$diploma_college_city','$diploma_college_state','$diploma_seat_no','$diploma_max_marks_sem1','$diploma_obt_marks_sem1','$diploma_max_marks_sem2','$diploma_obt_marks_sem2','$diploma_max_marks_sem3','$diploma_obt_marks_sem3','$diploma_max_marks_sem4','$diploma_obt_marks_sem4','$diploma_max_marks_sem5','$diploma_obt_marks_sem5','$diploma_max_marks_sem6','$diploma_obt_marks_sem6','$is_four_year','$diploma_max_marks_sem7','$diploma_obt_marks_sem7','$diploma_max_marks_sem8','$diploma_obt_marks_sem8','$diploma_aggr_obt_sem6','$diploma_aggr_max_sem6','$diploma_aggr_percent_sem6','$diploma_aggr_obt_sem8','$diploma_aggr_max_sem8','$diploma_aggr_percent_sem8')");
         return redirect()->route('adminFormViewDSE');
    }
/*
    public function updatedsedte(Request $request)
      {
       if($request->session()->get('dte',null)!=null)
                $dte_id = $request->session()->get('dte');
     elseif($request->session()->get('dte1',null)!=null)
                 $dte_id = $request->session()->get('dte1');   
      elseif($request->session()->get('dte2',null)!=null)
                 $dte_id = $request->session()->get('dte2');  
       elseif($request->session()->get('dte3',null)!=null)
                 $dte_id = $request->session()->get('dte3');          
                 $dte_id = "DSE19123456";      
          
          $mh_state_general_merit_no = $request->input('mhStateGeneralmeritNo');
          $all_india_merit_no =$request->input('aiGeneralmeritNo');
          $minority_dte_merit_no = $request->input('minorityDtemeritNo');
          $category = $request->input('category');
          $candidate_type = $request->input('candidate_types');
          $seat_type=$request->input('seatType');
          $acap_category=$request->input('acap_category');
          
          DB::select("call insert_update_dse_dte('$dte_id','$category','$candidate_type','$all_india_merit_no','$mh_state_general_merit_no','$minority_dte_merit_no','$seat_type','$acap_category')");    
      return redirect()->route('adminFormViewDSE');
}*/


    public function updatedsepersonal(Request $request)
    {

      if($request->session()->get('dte',null)!=null)
                $dte_id = $request->session()->get('dte');
     elseif($request->session()->get('dte1',null)!=null)
                 $dte_id = $request->session()->get('dte1');   
      elseif($request->session()->get('dte2',null)!=null)
                 $dte_id = $request->session()->get('dte2');  
       elseif($request->session()->get('dte3',null)!=null)
                 $dte_id = $request->session()->get('dte3');  
                        
                 
      $name_on_marksheet = $request->input('nameAsOnMarksheet');
       $first_name = $request->input('firstName');
        $middle_name = $request->input('middleName');
        $last_name = $request->input('lastName');
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
     //return $middle_name;
      DB::select("call insert_update_dse_personal('$dte_id','$name_on_marksheet','$gender','$date_of_birth','$place_of_birth_state','$place_of_birth_city','$mother_tongue','$nationality','$caste_tribe','$religion','$blood_group','$uid','$student_domicile_no','$student_domicile_date','$student_domicile_appl_no','$student_domicile_appl_date','$first_name','$middle_name','$last_name')");
         return redirect()->route('adminFormViewDSE');
    }

    public function updatedseguardian(Request $request)
    {
     
     if($request->session()->get('dte',null)!=null)
                $dte_id = $request->session()->get('dte');
     elseif($request->session()->get('dte1',null)!=null)
                 $dte_id = $request->session()->get('dte1');   
      elseif($request->session()->get('dte2',null)!=null)
                 $dte_id = $request->session()->get('dte2');  
       elseif($request->session()->get('dte3',null)!=null)
                 $dte_id = $request->session()->get('dte3');            
                         
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
      $parent_domicile_no = $request->input('parentDomecileNo');
      $parent_domicile_date = $request->input('dateOfParentDomecile');
      $parent_domicile_appl_no = $request->input('parentDomecileApplicationNo');
      $parent_domicile_appl_date = $request->input('applicationDateOfParentDomecile');
      //  DB::table('dse_sstudents')->where('dte_id',$dte_id)->update(['dte_id'=> $dte_id]);
      DB::select("call insert_update_dse_guardian('$dte_id','$g_relation','$g_first_name','$g_middle_name','$g_last_name','$g_mobile','$g_occupation','$g_qualification','$g_office_address','$g_office_tel_no','$g_annual_income','$parent_domicile_no','$parent_domicile_date','$parent_domicile_appl_no','$parent_domicile_appl_date','$mother_name')");  
      return redirect()->route('adminFormViewDSE');

    }

    public function updatedsecontact(Request $request)
      {
      if($request->session()->get('dte',null)!=null)
                $dte_id = $request->session()->get('dte');
     elseif($request->session()->get('dte1',null)!=null)
                 $dte_id = $request->session()->get('dte1');   
      elseif($request->session()->get('dte2',null)!=null)
                 $dte_id = $request->session()->get('dte2');  
       elseif($request->session()->get('dte3',null)!=null)
                 $dte_id = $request->session()->get('dte3');    
                 
          
                 
      $is=DB::table('dse_students')->select('resident_of')->where('dte_id',$dte_id)->get();
     //  $is_correspon_as_permanent = $is[0]->is_correspon_as_permanent;
       $is_local_or_outstation = $is[0]->resident_of;
     
     
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
          $local_guardian_state = $request->input('localGuardianAddressState');
          $local_guardian_district = $request->input('localGuardianAdreessDristict');
          $local_guardian_pincode = $request->input('localGuardianAddressPincode');

        /*if($is_correspon_as_permanent=="yes")
        {
            $correspondance_address_line1 =  $permanent_address_line1;
            $correspondance_address_line2 = $permanent_address_line2;
            $correspondance_city = $permanent_city;
            $correspondance_state = $permanent_state;
            $correspondance_district = $permanent_district;
            $correspondance_pincode =$permanent_pincode;
            $correspondance_nearest_rail_station =  $permanent_nearest_rail_station;
        }
        else
        {*/
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
              $local_guardian_nearest_rail_station = "NA";

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
              $local_guardian_nearest_rail_station = $request->input('localNearestRailwayStation');
          }

          DB::select("call insert_update_dse_contact('$dte_id','$permanent_address_line1','$permanent_address_line2','$permanent_city','$permanent_district','$permanent_state','$permanent_pincode','$permanent_nearest_rail_station','$correspondance_address_line1','$correspondance_address_line2','$correspondance_city','$correspondance_district','$correspondance_state','$correspondance_pincode','$correspondance_nearest_rail_station',' $is_local_or_outstation','$local_guardian_name','$local_guardian_address_line1','$local_guardian_address_line2','$local_guardian_city','$local_guardian_district','$local_guardian_state','$local_guardian_pincode','$local_guardian_nearest_rail_station')");
            
            return redirect()->route('adminFormViewDSE');
      }

    public static function showadminFormViewDSE(Request $request)
    {
        
                $email =$request->session()->get('email_id', 'null');
        $role =$request->session()->get('role');
      //  return $role;
        if ($email != 'null')
        {
             if($role == "Staff")
            {
              $course = DB::table('admin_login')->select('course','event')->where('email_id',$email)->get();
              $event = $course[0]->event;
            }
            else
            {
              $course =$request->session()->get('adminCourse',null);
                $event = $request->session()->get('adminEvent');
            }
      
        if($event == "ACAP")
        {
            $dte_id = $request->session()->get('dte');
        }
        elseif($event == "DTE")
        {
             if($request->session()->get('dte',null)!=null)
                      $dte_id = $request->session()->get('dte');
             elseif($request->session()->get('dte3',null)!=null)
                       $dte_id = $request->session()->get('dte3');  
           
           // $dte_id = $request->session()->get('dte3');
        }
           /* if($request->session()->get('dte',null)!=null)
                      $dte_id = $request->session()->get('dte');
           elseif($request->session()->get('dte1',null)!=null)
                       $dte_id = $request->session()->get('dte1');   
            elseif($request->session()->get('dte2',null)!=null)
                       $dte_id = $request->session()->get('dte2');
             else
             if($request->session()->get('dte3',null)!=null)
                       $dte_id = $request->session()->get('dte3');  
             */
       //  return $dte_id;
               $user1=DB::table('dse_students')->where('dte_id',$dte_id)->get();
              // return $user1;
               /*if (DB::table('dse_students')->where('dte_id', $dte_id)->exists()) {
               
             }
          if (substr($dte_id, 0, 1) == 'D') 
            {
                   $user1=DB::table('dse_students')->where('dte_id',$dte_id)->get();
             }
           elseif (substr($dte_id, 0, 1) == 'E') 
             {
                       $user1=DB::table('fe_students')->where('dte_id',$dte_id)->get();
                        $course="FEG";
             }
           elseif (substr($dte_id, 0, 2) == "MC") 
            {
                     $user1=DB::table('mca_students')->where('dte_id',$dte_id)->get();
                     $course="MCA";
           }
           elseif (substr($dte_id, 0, 2) == "ME") 
            {
                       $user1=DB::table('me_students')->where('dte_id',$dte_id)->get();
                     $course="ME";
            }*/

            $data = [];
               $isHsc = array(
                'Y' => 'Yes',
                'N' => 'No'
              );
              $data['isHsc'] = $isHsc;

              $isFour = array(
                'y' => 'Yes',
                'n' => 'No'
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
              'F' => 'Type F'
            );
            $blood_groups = array(
              'A+' => 'A+',
              'A-' => 'A-',
              'B+' => 'B+',
              'B-' => 'B-',
              'AB+' => 'AB+',
              'AB-' => 'AB-',
              'O+' => 'O+',
              'O-' => 'O-'
            );
            $genders = array(
              'Male' => 'Male',
              'Female' => 'Female',
              'Transgender' => 'Transgender'
            );
               $relations = array(
              'Husband' => 'H',
              'Father' => 'F'
            );

                $residences = array(
              'Local' => 'L',
              'Outstation' => 'O'
            );
            $data['residences'] = $residences;
            $data['blood_groups'] = $blood_groups;
            $data['genders'] = $genders;
            $years = array(
                      '2019' => '2019',
                      '2018' => '2018',
                      '2017' => '2017',
                      '2016' => '2016',
                      '2015' => '2015',
                      '2014' => '2014',
                      '2013' => '2013',
                      '2012' => '2012',
                      '2011' => '2011'
                      
                    );
                    $data['years'] = $years;
       if($user1[0]->correspondance_address_line1 != null)
              $data['permanent'] = "true";
            else
              $data['permanent'] = "false";
              $data['relations'] = $relations;   
            
            $data['categories'] = $categories;
            $data['candidate_types'] = $candidate_types;
                       $data['user1'] = $user1;
                      // return $data;
                return view('admin.adminFormViewDSE',$data);  
        }
        else {
            return redirect()->route('logout');
        }
    }

     public static function checkadminFormViewDSE(Request $request)
        {
          return view('admin.adminFormViewDSE'); 
        }

    public function updatemcadte(Request $request)
{
        if($request->session()->get('dte',null)!=null)
                $dte_id = $request->session()->get('dte');
     elseif($request->session()->get('dte1',null)!=null)
                 $dte_id = $request->session()->get('dte1');   
      elseif($request->session()->get('dte2',null)!=null)
                 $dte_id = $request->session()->get('dte2');  
       elseif($request->session()->get('dte3',null)!=null)
                 $dte_id = $request->session()->get('dte3'); 
                 
                 
           $acap=DB::table('mca_students')->select('acap_category')->where('dte_id',$dte_id)->get()[0]->acap_category;
          //$acap_category=$acap[0]->acap_category;
          //return $acap;
          $cet_score = $request->input('cetScore');
          $cet_percentile =$request->input('cetPercentile');
          $cet_month=$request->input('cet_month');
          $cet_year=$request->input('yearOfExam');  
          $mh_state_general_merit_no = $request->input('mhStateGeneralmeritNo');
          $category = $request->input('category');
          $candidate_type = $request->input('candidate_types');
          $type=$request->input('seatType');
          
          DB::select("call insert_update_mca_dte('$dte_id','$category','$candidate_type','$cet_score', '$cet_month', '$cet_year','$cet_percentile','$mh_state_general_merit_no','$type','$acap')");    
      return redirect()->route('adminFormView');        
}


public function updatemcapersonal(Request $request)
{

      if($request->session()->get('dte',null)!=null)
                $dte_id = $request->session()->get('dte');
     elseif($request->session()->get('dte1',null)!=null)
                 $dte_id = $request->session()->get('dte1');   
      elseif($request->session()->get('dte2',null)!=null)
                 $dte_id = $request->session()->get('dte2');  
       elseif($request->session()->get('dte3',null)!=null)
                 $dte_id = $request->session()->get('dte3');            
                 
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

    DB::select("call insert_update_mca_personal('$dte_id','$name_on_marksheet','$gender','$date_of_birth','$place_of_birth_state','$place_of_birth_city','$mother_tongue','$nationality','$caste_tribe ','$religion','$blood_group','$uid','$student_domicile_no','$student_domicile_date','$student_domicile_appl_no','$student_domicile_appl_date')");
       return redirect()->route('adminFormView');
}

public function updatemcacontact(Request $request)
{
      if($request->session()->get('dte',null)!=null)
                $dte_id = $request->session()->get('dte');
     elseif($request->session()->get('dte1',null)!=null)
                 $dte_id = $request->session()->get('dte1');   
      elseif($request->session()->get('dte2',null)!=null)
                 $dte_id = $request->session()->get('dte2');  
       elseif($request->session()->get('dte3',null)!=null)
                 $dte_id = $request->session()->get('dte3');    
                 
                 
                 
      $is=DB::table('mca_students')->select('resident_of')->where('dte_id',$dte_id)->get();
     //  $is_correspon_as_permanent = $is[0]->is_correspon_as_permanent;
       $is_local_or_outstation = $is[0]->resident_of;
     
     
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
    $local_guardian_state = $request->input('localGuardianAddressState');
    $local_guardian_district = $request->input('localGuardianAdreessDristict');
    $local_guardian_pincode = $request->input('localGuardianAddressPincode');

    /*if($is_correspon_as_permanent=="yes")
    {
        $correspondance_address_line1 =  $permanent_address_line1;
        $correspondance_address_line2 = $permanent_address_line2;
        $correspondance_city = $permanent_city;
        $correspondance_state = $permanent_state;
        $correspondance_district = $permanent_district;
        $correspondance_pincode =$permanent_pincode;
        $correspondance_nearest_rail_station =  $permanent_nearest_rail_station;
    }
    else
    {*/
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
        $local_guardian_state = $request->input('localGuardianAddressState');
        $local_guardian_pincode = $request->input('localGuardianAddressPincode');
    }

    DB::select("call insert_update_mca_contact('$dte_id','$permanent_address_line1','$permanent_address_line2','$permanent_city','$permanent_district','$permanent_state','$permanent_pincode','$permanent_nearest_rail_station','$correspondance_address_line1','$correspondance_address_line2','$correspondance_city','$correspondance_district','$correspondance_state','$correspondance_pincode','$correspondance_nearest_rail_station',' $is_local_or_outstation','$local_guardian_name','$local_guardian_address_line1','$local_guardian_address_line2','$local_guardian_city','$local_guardian_district','$local_guardian_state','$local_guardian_pincode')");
      
      return redirect()->route('adminFormView');
}

public function updatemcaacademic(Request $request)
{
     
      if($request->session()->get('dte',null)!=null)
                $dte_id = $request->session()->get('dte');
     elseif($request->session()->get('dte1',null)!=null)
                 $dte_id = $request->session()->get('dte1');   
      elseif($request->session()->get('dte2',null)!=null)
                 $dte_id = $request->session()->get('dte2');  
       elseif($request->session()->get('dte3',null)!=null)
                 $dte_id = $request->session()->get('dte3');            
                 
                 
    $is=DB::table('mca_students')->select('is_diploma','is_new_or_old')->where('dte_id',$dte_id)->get();
       $is_diploma = $is[0]->is_diploma;
       $is_new_or_old = $is[0]->is_new_or_old;
     
     //return $is_new_or_old;
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
     $university_type = $request->input('university_type');
    $degree_university = $request->input('degreeUniversity');
    $degeree_college_city = $request->input('collegeCity');
    $degeree_college_state = $request->input('collegeState');
    $degree_passing_year = $request->input('degreePassingYear');
    $degree_passing_month = $request->input('degreePassingMonth');
    $obt_math_marks_first_year =$request->input('degreeMathObtainedMarks');
    $maximum_math_marks =$request->input('degreeMathMaxMarks');
    $degree_branch =$request->input('degreeBranch'); 
    


    //    return $is_diploma;
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
         $diploma_passing_month="NA";
          $diploma_passing_year = "0000";
         $diploma_obtained_marks = "00";
         $diploma_max_marks ="00";
         $diploma_percentage ="00";
         
    }
    //return $is_new_or_old;
    if($is_new_or_old == 'N')
    {
    //return "Hello";
        $new_aggr_obt_marks = $request->input('aggrObtainedMarks');
        $new_aggr_max_marks = $request->input('aggrMaximumMarks');
        $new_percentage = $request->input('aggrPercentage');
        $new_final_cgpa = $request->input('finalCGPA');
      // return $new_aggr_obt_marks;
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

      
     DB::select("call insert_update_mca_academic('$dte_id','$x_passing_month','$x_passing_year','$x_board','$x_max_marks','$x_obtained_marks','$x_percentage','$x_school_name','$x_school_city','$x_school_state','$is_diploma','$xii_passing_month','$xii_passing_year','$xii_board','$xii_max_marks','$xii_obtained_marks','$hsc_math_max','$hsc_math_obtain','$xii_percentage','$xii_college_name','$xii_college_city','$xii_college_state','$diploma_board','$diploma_passing_month','$diploma_passing_year','$diploma_max_marks','$diploma_obtained_marks','$diploma_percentage','$diploma_branch','$diploma_college_name','$diploma_college_city','$diploma_college_state','$degree_branch','$degree_university','$degree_passing_month','$degree_passing_year','$degree_college_name','$degeree_college_city','$degeree_college_state','$old_sem1_max_marks','$old_sem1_obt_marks','$old_sem2_max_marks','$old_sem2_obt_marks','$old_sem3_max_marks','$old_sem3_obt_marks','$old_sem4_max_marks','$old_sem4_obt_marks','$old_sem5_max_marks','$old_sem5_obt_marks','$old_sem6_max_marks','$old_sem6_obt_marks','$maximum_math_marks','$obt_math_marks_first_year','$pro_sem1_sgpa','$pro_sem2_sgpa','$pro_sem3_sgpa','$pro_sem4_sgpa','$pro_sem5_sgpa','$pro_sem6_sgpa','$new_aggr_max_marks','$new_aggr_obt_marks','$is_new_or_old','$new_percentage','$new_final_cgpa','$university_type','$degree_branch')");
      return redirect()->route('adminFormView');
}

public function updatemcaguardian(Request $request)
{
     
     if($request->session()->get('dte',null)!=null)
                $dte_id = $request->session()->get('dte');
     elseif($request->session()->get('dte1',null)!=null)
                 $dte_id = $request->session()->get('dte1');   
      elseif($request->session()->get('dte2',null)!=null)
                 $dte_id = $request->session()->get('dte2');  
       elseif($request->session()->get('dte3',null)!=null)
                 $dte_id = $request->session()->get('dte3');            
                 
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
    $parent_domicile_no = $request->input('parentDomecileNo');
    $parent_domicile_date = $request->input('dateOfParentDomecile');
    $parent_domicile_appl_no = $request->input('parentDomecileApplicationNo');
    $parent_domicile_appl_date = $request->input('applicationDateOfParentDomecile');
  //  DB::table('mca_sstudents')->where('dte_id',$dte_id)->update(['dte_id'=> $dte_id]);
    DB::select("call insert_update_mca_guardian('$dte_id','$g_relation','$g_first_name','$g_middle_name','$g_last_name','$g_mobile','$g_occupation','$g_qualification','$g_office_address','$g_office_tel_no','$g_annual_income','$parent_domicile_no','$parent_domicile_date','$parent_domicile_appl_no','$parent_domicile_appl_date','$mother_name')");  
    return redirect()->route('adminFormView');

}


public static function showadminFormView(Request $request)
    {
        $email =$request->session()->get('email_id', 'null');
        $role =$request->session()->get('role');
      //  return $role;
        if ($email != 'null')
        {
             if($role == "Staff")
            {
              $course = DB::table('admin_login')->select('course','event')->where('email_id',$email)->get();
              $event = $course[0]->event;
            }
            else
            {
              $course =$request->session()->get('adminCourse',null);
                $event = $request->session()->get('adminEvent');
            }        
        if($event == "ACAP")
        {
            $dte_id = $request->session()->get('dte');
        }
        elseif($event == "DTE")
        {
            if($request->session()->get('dte',null)!=null)
                      $dte_id = $request->session()->get('dte');
             elseif($request->session()->get('dte3',null)!=null)
                       $dte_id = $request->session()->get('dte3');  
        }
      /*if($request->session()->get('dte',null)!=null)
                $dte_id = $request->session()->get('dte');
     elseif($request->session()->get('dte1',null)!=null)
                 $dte_id = $request->session()->get('dte1');   
      elseif($request->session()->get('dte2',null)!=null)
                 $dte_id = $request->session()->get('dte2');
       else
       if($request->session()->get('dte3',null)!=null)
                 $dte_id = $request->session()->get('dte3');*/  
        //  return $dte_id;
           // if (substr($dte_id, 0, 1) == 'D') 
           //  {
           //         $user1=DB::table('dse_students')->where('dte_id',$dte_id)->get();
           //         $course="DSE";
           //   }
           // elseif (substr($dte_id, 0, 1) == 'E') 
           //   {
           //             $user1=DB::table('fe_students')->where('dte_id',$dte_id)->get();
           //              $course="FEG";
           //   }
           // elseif (substr($dte_id, 0, 2) == "MC") 
           //  {
                     $user1=DB::table('mca_students')->where('dte_id',$dte_id)->get();
                     $course="MCA";
           // }
           // elseif (substr($dte_id, 0, 2) == "ME") 
           //  {
           //             $user1=DB::table('me_students')->where('dte_id',$dte_id)->get();
           //           $course="ME";
           //  }

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
      
      $categories = array(
        'OPEN' => 'OPEN',
        'SC' => 'SC',
        'ST' => 'ST',
        'OBC' => 'OBC',
        'NT' => 'NT',
        'PH' => 'PH',
        'PWD'=>'PWD',
        'DEFENCE' => 'DEFENCE',
        'LINGUSTIC MINORITY' => 'LINGUSTIC MINORITY',
        'RELIGIOUS MINORITY' => 'RELIGIOUS MINORITY',
        'OTHERS' => 'OTHERS'
      );
      $candidate_types = array(
        'A' => 'Type A',
        'B' => 'Type B',
        'C' => 'Type C',
        'D' => 'Type D',
        'E' => 'Type E',
        'F' => 'Type F'
      );
      $blood_groups = array(
        'A+' => 'A+',
        'A-' => 'A-',
        'B+' => 'B+',
        'B-' => 'B-',
        'AB+' => 'AB+',
        'AB-' => 'AB-',
        'O+' => 'O+',
        'O-' => 'O-'
      );
      $genders = array(
        'Male' => 'Male',
        'Female' => 'Female',
        'Transgender' => 'Transgender'
      );
         $relations = array(
         'Husband' => 'H',
        'Parent' => 'F',
        'Guardian' => 'G',
      );

          $residences = array(
        'Local' => 'L',
        'Outstation' => 'O'
      );
      $data['residences'] = $residences;
      $data['blood_groups'] = $blood_groups;
      $data['genders'] = $genders;
 if($user1[0]->correspondance_address_line1 != null)
        $data['permanent'] = "true";
      else
        $data['permanent'] = "false";
 $data['relations'] = $relations;   
      $data['months'] = $months;
      $data['categories'] = $categories;
      $data['candidate_types'] = $candidate_types;
                 $data['user1'] = $user1;

                     return view('admin.adminFormView',$data);
          
            
    }
    else{
        return redirect()->route('logout');
    }
    }
    
    public static function checkadminFormView(Request $request)
    {
    return view('admin.adminFormView'); 
    }


   public function saveid($pageid,Request $request)
    {
      
      $email =$request->session()->get('email_id', 'null');
      $role =$request->session()->get('role');
   
         
         if($role == "Staff")
        {
          $course = DB::table('admin_login')->select('course')->where('email_id',$email)->get();
            $course = $course[0]->course;
        }
        else
        {
                  $course = $request->session()->get('adminCourse');
        }
      //seize = 1 , verif = 2 , admit = 3
      

      if($request->session()->get('dte',null)!=null)
                $dte_id = $request->session()->get('dte');
     elseif($request->session()->get('dte1',null)!=null)
                 $dte_id = $request->session()->get('dte1');   
      elseif($request->session()->get('dte2',null)!=null)
                 $dte_id = $request->session()->get('dte2');  
       elseif($request->session()->get('dte3',null)!=null)
                 $dte_id1 = $request->session()->get('dte3');

    //return $dte_id1;;
      if($pageid==1)
            $request->session()->put('pageid','seize');
      elseif($pageid==2)
            $request->session()->put('pageid','verifiy');
      elseif($pageid==3)
            $request->session()->put('pageid','admit');
            


         // $course=DB::table('dte_allotments')->select('course_allotted')->where('dte_id',$dte_id)->get()[0]->course_allotted;
       
      if($course=="MCA") {
        //return 'true';
        return redirect()->route('adminFormView');}
      elseif ($course=="FEG"){
          
        return redirect()->route('adminFormViewFE');}
        elseif ($course=="DSE"){
        return redirect()->route('adminFormViewDSE');}
          elseif ($course=="MEG"){
        return redirect()->route('adminFormViewMEG');}

    }


    public function backtopage(Request $request)
    {
      //seize = 1 , verif = 2 , admit = 3
      $pageid= $request->session()->get('pageid');
      if($pageid=='seize')
            return redirect()->route('adminSeizer');
      elseif($pageid=='verifiy')
            return redirect()->route('adminVerifier');
      elseif($pageid=='admit')
            return redirect()->route('adminAdmit');
    }


    public static function adminLogout(Request $request)
    {
        $email = $request->session()->pull('email_id');
        DB::table('admin_login')->where('email_id', $email)->update(['login' => 0]);
        $request->session()->flush();
        return view('admin.adminLogin');
    }



 public function updatemedte(Request $request)
{
        if($request->session()->get('dte',null)!=null)
                $dte_id = $request->session()->get('dte');
     elseif($request->session()->get('dte1',null)!=null)
                 $dte_id = $request->session()->get('dte1');   
      elseif($request->session()->get('dte2',null)!=null)
                 $dte_id = $request->session()->get('dte2');  
       elseif($request->session()->get('dte3',null)!=null)
                 $dte_id = $request->session()->get('dte3');            
                 
          $sponsoring_company = $request->input('dteSponsorship');
          $gate_score = $request->input('gateScore');
          $gate_branch = $request->input('gateBranch');
          $gate_max_marks =$request->input('gateOutOf');
          $gate_month=$request->input('gate_month');
          $gate_year=$request->input('yearOfExam');  
          $gate_exam_paper=$request->input('gate_exam_paper');
          $gate_reg_no = $request->input('gate_reg_no');
          $mh_state_general_merit_no = $request->input('mhStateGeneralMeritNo');
     //   return $dte_id;
          $category = $request->input('category');
          $candidate_type = $request->input('candidate_types');
          $user = DB::table('me_students')->select('is_sponsored','seat_type','acap_category')->where('dte_id',$dte_id)->get();
            $is_sponsored = $user[0]->is_sponsored;
            $type = $user[0]->seat_type;
            $acap_category = $user[0]->acap_category;
          DB::select("call insert_update_me_dte('$dte_id','$category','$candidate_type','$is_sponsored','$gate_score','$gate_branch','$gate_month','$gate_year','$gate_max_marks','$gate_reg_no','$gate_exam_paper','$sponsoring_company','$mh_state_general_merit_no','$type','$acap_category')");    
      return redirect()->route('adminFormViewMEG');        
}


public function updatemepersonal(Request $request)
{

      if($request->session()->get('dte',null)!=null)
                $dte_id = $request->session()->get('dte');
     elseif($request->session()->get('dte1',null)!=null)
                 $dte_id = $request->session()->get('dte1');   
      elseif($request->session()->get('dte2',null)!=null)
                 $dte_id = $request->session()->get('dte2');  
       elseif($request->session()->get('dte3',null)!=null)
                 $dte_id = $request->session()->get('dte3');            
                 
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
    DB::select("call insert_update_me_personal('$dte_id','$name_on_marksheet','$gender','$date_of_birth','$place_of_birth_city','$place_of_birth_state','$mother_tongue','$nationality','$caste_tribe','$religion','$blood_group','$uid','$student_domicile_no','$student_domicile_date','$student_domicile_appl_no','$student_domicile_appl_date')");
       return redirect()->route('adminFormViewMEG');
}


public function updatemeacademic(Request $request)
{
     
      if($request->session()->get('dte',null)!=null)
                $dte_id = $request->session()->get('dte');
     elseif($request->session()->get('dte1',null)!=null)
                 $dte_id = $request->session()->get('dte1');   
      elseif($request->session()->get('dte2',null)!=null)
                 $dte_id = $request->session()->get('dte2');  
       elseif($request->session()->get('dte3',null)!=null)
                 $dte_id = $request->session()->get('dte3');            
                 
                 
    $is=DB::table('me_students')->select('is_diploma','is_new_or_old')->where('dte_id',$dte_id)->get();
       $is_diploma = $is[0]->is_diploma;
       $is_new_or_old = $is[0]->is_new_or_old;
     
     //return $is_new_or_old;
  $x_school_name = $request->input('sscSchoolName'); 
    $x_board = $request->input('sscBoard');
    $x_school_city = $request->input('sscSchoolCity');
    $x_school_state = $request->input('sscSchoolState');
    $x_passing_year = $request->input('xPassingYear');
    $x_passing_month =$request->input('xPassingMonth');
    $x_obtained_marks = $request->input('xObtainedMarks');
    $x_max_marks = $request->input('xMaximumMarks');
    $x_percentage = $request->input('xPercentage');
     $degree_college_name = $request->input('degreeCollegeName');
     $university_type = $request->input('university_type');
    $degree_university = $request->input('degreeUniversity');
    $degeree_college_city = $request->input('collegeCity');
    $degeree_college_state = $request->input('collegeState');
    $degree_passing_year = $request->input('degreePassingYear');
    $degree_passing_month = $request->input('degreePassingMonth');
    $degree_name = $request->input('degreeName');
    $degree_branch =$request->input('degreeBranch'); 
    //return $degree_name;


    //    return $is_diploma;
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
         
         $diploma_college_name = "NA";
         $diploma_board = "NA";
         $diploma_branch = "NA";
         $diploma_college_city = "NA";
         $diploma_college_state = "NA";
         $diploma_passing_month="NA";
          $diploma_passing_year = "NA";
         $diploma_obtained_marks = "00";
         $diploma_max_marks ="00";
         $diploma_percentage ="00";
         
    }

    if($is_new_or_old == 'N')
    {
    //return "Hello";
        $new_aggr_obt_marks = $request->input('aggrObtainedMarks');
        $new_aggr_max_marks = $request->input('aggrMaximumMarks');
        $new_percentage = $request->input('aggrPercentage');
        $new_final_cgpa = $request->input('finalCGPA');

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
        $old_sem8_obt_marks = $request->input('degree_8_marks_obt');
        $old_sem8_max_marks = $request->input('degree_8_marks_max');

         $new_aggr_obt_marks = $request->input('oldAggrObtainedMarks');
        $new_aggr_max_marks = $request->input('oldAggrMaximumMarks');
        $new_percentage = $request->input('oldAggrPercentage');

        $new_final_cgpa = 0;

        

    }
  
      
     DB::select("call insert_update_me_academic('$dte_id','$x_passing_month','$x_passing_year','$x_board','$x_max_marks','$x_obtained_marks','$x_percentage','$x_school_name','$x_school_city','$x_school_state','$is_diploma','$xii_passing_month','$xii_passing_year','$xii_board','$xii_max_marks','$xii_obtained_marks','$xii_percentage','$xii_college_name','$xii_college_city','$xii_college_state','$diploma_board','$diploma_passing_month','$diploma_passing_year','$diploma_max_marks','$diploma_obtained_marks','$diploma_percentage','$diploma_branch','$diploma_college_name','$diploma_college_city','$diploma_college_state','$degree_name','$degree_branch','$university_type','$degree_university','$degree_passing_month','$degree_passing_year','$degree_college_name','$degeree_college_city','$degeree_college_state','$old_sem1_max_marks','$old_sem1_obt_marks','$old_sem2_max_marks','$old_sem2_obt_marks','$old_sem3_max_marks','$old_sem3_obt_marks','$old_sem4_max_marks','$old_sem4_obt_marks','$old_sem5_max_marks','$old_sem5_obt_marks','$old_sem6_max_marks','$old_sem6_obt_marks','$old_sem7_max_marks','$old_sem7_obt_marks','$old_sem8_max_marks','$old_sem8_obt_marks','$new_aggr_max_marks','$new_aggr_obt_marks','$is_new_or_old','$new_percentage','$new_final_cgpa')");
      return redirect()->route('adminFormViewMEG');
}


public function updatemeguardian(Request $request)
{
     
     if($request->session()->get('dte',null)!=null)
                $dte_id = $request->session()->get('dte');
     elseif($request->session()->get('dte1',null)!=null)
                 $dte_id = $request->session()->get('dte1');   
      elseif($request->session()->get('dte2',null)!=null)
                 $dte_id = $request->session()->get('dte2');  
       elseif($request->session()->get('dte3',null)!=null)
                 $dte_id = $request->session()->get('dte3');            
                 
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
    $parent_domicile_no = $request->input('parentDomecileNo');
    $parent_domicile_date = $request->input('dateOfParentDomecile');
    $parent_domicile_appl_no = $request->input('parentDomecileApplicationNo');
    $parent_domicile_appl_date = $request->input('applicationDateOfParentDomecile');
  //  DB::table('mca_sstudents')->where('dte_id',$dte_id)->update(['dte_id'=> $dte_id]);
    DB::select("call insert_update_me_guardian('$dte_id','$g_relation','$g_first_name','$g_middle_name','$g_last_name','$g_mobile','$g_occupation','$g_qualification','$g_office_address','$g_office_tel_no','$g_annual_income','$parent_domicile_no','$parent_domicile_date','$parent_domicile_appl_no','$parent_domicile_appl_date','$mother_name')");  
    return redirect()->route('adminFormViewMEG');

}


public function updatemecontact(Request $request)
{
      if($request->session()->get('dte',null)!=null)
                $dte_id = $request->session()->get('dte');
     elseif($request->session()->get('dte1',null)!=null)
                 $dte_id = $request->session()->get('dte1');   
      elseif($request->session()->get('dte2',null)!=null)
                 $dte_id = $request->session()->get('dte2');  
       elseif($request->session()->get('dte3',null)!=null)
                 $dte_id = $request->session()->get('dte3');    
                 
                 
                 
      $is=DB::table('me_students')->select('resident_of')->where('dte_id',$dte_id)->get();
     //  $is_correspon_as_permanent = $is[0]->is_correspon_as_permanent;
       $is_local_or_outstation = $is[0]->resident_of;
     
     
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
    $local_guardian_state = $request->input('localGuardianAddressState');
    $local_guardian_district = $request->input('localGuardianAdreessDristict');
    $local_guardian_pincode = $request->input('localGuardianAddressPincode');

    /*if($is_correspon_as_permanent=="yes")
    {
        $correspondance_address_line1 =  $permanent_address_line1;
        $correspondance_address_line2 = $permanent_address_line2;
        $correspondance_city = $permanent_city;
        $correspondance_state = $permanent_state;
        $correspondance_district = $permanent_district;
        $correspondance_pincode =$permanent_pincode;
        $correspondance_nearest_rail_station =  $permanent_nearest_rail_station;
    }
    else
    {*/
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
        $local_guardian_state = $request->input('localGuardianAddressState');
        $local_guardian_pincode = $request->input('localGuardianAddressPincode');
    }

    DB::select("call insert_update_me_contact('$dte_id','$permanent_address_line1','$permanent_address_line2','$permanent_city','$permanent_district','$permanent_state','$permanent_pincode','$permanent_nearest_rail_station','$correspondance_address_line1','$correspondance_address_line2','$correspondance_city','$correspondance_district','$correspondance_state','$correspondance_pincode','$correspondance_nearest_rail_station',' $is_local_or_outstation','$local_guardian_name','$local_guardian_address_line1','$local_guardian_address_line2','$local_guardian_city','$local_guardian_district','$local_guardian_state','$local_guardian_pincode')");
      
      return redirect()->route('adminFormViewMEG');
}



public static function showadminFormViewMEG(Request $request)
    {
     $email =$request->session()->get('email_id', 'null');
        $role =$request->session()->get('role');
      //  return $role;
    if ($email != 'null')
        {
             if($role == "Staff")
            {
              $course1 = DB::table('admin_login')->select('course','event')->where('email_id',$email)->get();
              $course=$course1[0]->course;
              $event = $course1[0]->event;
            }
            else
            {
              $course =$request->session()->get('adminCourse',null);
                $event = $request->session()->get('adminEvent');
            }
        
        
        if($event == "ACAP")
        {
            $dte_id = $request->session()->get('dte');
        }
        elseif($event == "DTE")
        {
           if($request->session()->get('dte3',null)!=null){
            $dte_id = $request->session()->get('dte3');
            }
           else if($request->session()->get('dte',null)!=null)
                $dte_id = $request->session()->get('dte');
            
        }
            
           // return $course;
                      if($course == "MCA")
                  {
                     $user1=DB::table('mca_students')->where('dte_id',$dte_id)->get();
                     $course="MCA";
                    }
                  elseif ($course == "MEG") {
                    $user1=DB::table('me_students')->where('dte_id',$dte_id)->get();
                     $course="MEG";
                      if($user1[0]->is_sponsored == 0)
                        $sponsored_org = "false";
                       else
                        $sponsored_org = "true";
                      //return $sponsored_org ;
                  }
           
      //return $user1;
        $data = [];
        $data['course']=$course;
             if($course == "MCA")
        {
            $data['course']=$course;
                  $newOrOldSystem = array(
                    'N' => 'New',
                    'O' => 'Old',
                    'P' => 'Pro'
                  );
                  $data['newOrOldSystem'] = $newOrOldSystem;
          }
          elseif($course == "MEG")
          {


            $data['course']=$course;
                  $newOrOldSystem = array(
                    'N' => 'New',
                    'O' => 'Old',
                  );
                  $data['newOrOldSystem'] = $newOrOldSystem;
          }
              
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
      $categories = array(
        'OPEN' => 'OPEN',
        'SC' => 'SC',
        'ST' => 'ST',
        'OBC' => 'OBC',
        'NT' => 'NT',
        'PH' => 'PH',
        'PWD'=>'PWD',
        'DEFENCE' => 'DEFENCE',
        'LINGUSTIC MINORITY' => 'LINGUSTIC MINORITY',
        'RELIGIOUS MINORITY' => 'RELIGIOUS MINORITY',
        'OTHERS' => 'OTHERS'
      );
      $candidate_types = array(
        'A' => 'Type A',
        'B' => 'Type B',
        'C' => 'Type C',
        'D' => 'Type D',
        'E' => 'Type E',
        'F' => 'Type F'
      );
      $blood_groups = array(
        'A+' => 'A+',
        'A-' => 'A-',
        'B+' => 'B+',
        'B-' => 'B-',
        'AB+' => 'AB+',
        'AB-' => 'AB-',
        'O+' => 'O+',
        'O-' => 'O-'
      );
      $genders = array(
        'Male' => 'Male',
        'Female' => 'Female',
        'Transgender' => 'Transgender'
      );
         $relations = array(
        'Husband' => 'H',
        'Father' => 'F'
      );

          $residences = array(
        'Local' => 'L',
        'Outstation' => 'O'
      );
      $data['residences'] = $residences;
      $data['blood_groups'] = $blood_groups;
      $data['genders'] = $genders;
        if($course == "MEG")
      {
        $data['sponsored_org'] = $sponsored_org;
      }
 if($user1[0]->correspondance_address_line1 != null)
        $data['permanent'] = "true";
      else
        $data['permanent'] = "false";
 $data['relations'] = $relations;   
      $data['months'] = $months;
      $data['categories'] = $categories;
      $data['candidate_types'] = $candidate_types;
                 $data['user1'] = $user1;
          return view('admin.adminFormViewMEG',$data);  
    }

    }
    public static function checkadminFormViewMEG(Request $request)
    {
    return view('admin.adminFormViewMEG'); 
    }


 public static  function verifyAdminDocumentVerifierAcapMEG(Request $request)
    {
//ret
        $email =$request->session()->get('email_id', 'null');
        $course = $request->session()->get('course','null');
       // return $course;
        if($course == 'null')
          $course = $request->session()->get('adminCourse');
     if ($email != 'null')
     {
        $dte_id=$request->session()->get('dte'); 
    //    return $dte_id;
      $use = DB::table('student_login')->select('hash')->where('dte_id', $dte_id)->get();
      $destinationPath = $dte_id.'_'.$use[0]->hash;
      //  $abc=(int)$request->hasFile('ssc_marksheet');
        $me_students = new me_students;
        if(DB::table('me_students')->where('dte_id', $dte_id)->exists()) 
          { 
           $me_students  = me_students::find($dte_id);
          }
          else
          {
            $me_students->dte_id = $dte_id;
          }


        if($request->hasFile('photo'))
      {
         
         $rules = ['photo' => 'mimes:jpg,png,jpeg'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('photo_error', 'Please Upload Only JPG or PNG type image');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        $extension = $request->file('photo')->getClientOriginalExtension();
        $filenametostore = 'photo'.$dte_id.'.'.$extension;
        //Storage::disk('public_uploads')->put($destinationPath, $request->file('photo'));
       // $request->image->move(public_path('/uploads/').$destinationPath, $filenametostore);
        //$path = $destinationPath.'/'.$filenametostore;
       /* $image = Image::make($request->file('photo'))->fit(400, 200);
        $image->save();*/
        $path =  $request->file('photo')->storeAs($destinationPath, $filenametostore,'public_uploads');
        //return $path;
          $me_students->photo_path = $filenametostore;
           $me_students->photo='Yes';
        $me_students->save();
      }

      
        if($request->hasFile('signature'))
      {
        $rules = ['signature' => 'mimes:jpg,png,jpeg'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('signature_error', 'Please Upload Only JPG or PNG type image');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        $extension = $request->file('signature')->getClientOriginalExtension();
        $filenametostore = 'signature'.$dte_id.'.'.$extension;
        $path = $request->file('signature')->storeAs($destinationPath, $filenametostore,'public_uploads');
          $me_students->signature_path = $filenametostore;
           $me_students->signature='Yes';
        $me_students->save();
      }

      
        if($request->hasFile('fc_confirmation_receipt'))
      {
        $rules = ['fc_confirmation_receipt' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('fc_confirmation_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        $extension = $request->file('fc_confirmation_receipt')->getClientOriginalExtension();
        $filenametostore = 'fc_confirmation_receipt'.$dte_id.'.'.$extension;
        $path = $request->file('fc_confirmation_receipt')->storeAs($destinationPath, $filenametostore,'public_uploads');
          $me_students->fc_confirmation_receipt_path =$filenametostore;
           $me_students->fc_confirmation_receipt='Yes';
        $me_students->save();
      }

      
          if($request->hasFile('dte_allotment_letter'))
      {
        $rules = ['dte_allotment_letter' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('dte_allotment_letter_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        $extension = $request->file('dte_allotment_letter')->getClientOriginalExtension();
        $filenametostore = 'dte_allotment_letter_'.$dte_id.'.'.$extension;
   
        $path = $request->file('dte_allotment_letter')->storeAs($destinationPath, $filenametostore,'public_uploads');
              $me_students->dte_allotment_letter_path = $filenametostore;
               $me_students->dte_allotment_letter='Yes';
        $me_students->save();
      }

      
    if($request->hasFile('arc_ackw_receipt'))
      {
        $rules = ['arc_ackw_receipt' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('arc_ackw_receipt_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        $extension = $request->file('arc_ackw_receipt')->getClientOriginalExtension();
        $filenametostore = 'arc_ackw_receipt_'.$dte_id.'.'.$extension;
   
        $path = $request->file('arc_ackw_receipt')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->arc_ackw_receipt_path = $filenametostore;
        $me_students->arc_ackw_receipt='Yes';
        $me_students->save();
      }

  
  if($request->hasFile('gate_result'))
      {
        $rules = ['gate_result' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('gate_result_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        $extension = $request->file('gate_result')->getClientOriginalExtension();
        $filenametostore = 'gate_result_'.$dte_id.'.'.$extension;
   
        $path = $request->file('gate_result')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->gate_result_path = $filenametostore;
        $me_students->gate_result = 'Yes';
        $me_students->save();
      }


      
        if($request->hasFile('ssc_marksheet')) 
        {
        
          $rules = ['ssc_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('ssc_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
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
        
              //////echo $path; //
      
      }

      
      if($request->hasFile('hsc_marksheet')) 
      {
        $rules = ['hsc_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('hsc_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        
        
        //get file extension
        $extension = $request->file('hsc_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'hsc_diploma_marksheet'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('hsc_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->hsc_diploma_marksheet_path = $filenametostore;
         $me_students->hsc_diploma_marksheet='Yes';
        $me_students->save();
        
      ////echo $path; //
      
      }

      
      if($request->hasFile('degree_leaving_tc')) 
      {
        $rules = ['degree_leaving_tc' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('degree_leaving_tc_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        
        
        //get file extension
        $extension = $request->file('degree_leaving_tc')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'degree_leaving_tc_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('degree_leaving_tc')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->degree_leaving_tc_path = $filenametostore;
              $me_students->degree_leaving_tc = 'Yes';
        $me_students->save();
        
      ////echo $path; //
      
      }


      
      if($request->hasFile('first_year_marksheet')) 
      {
        $rules = ['first_year_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('first_year_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        
        
        //get file extension
        $extension = $request->file('first_year_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'first_year_marksheet_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('first_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->first_year_marksheet_path = $filenametostore;
           $me_students->first_year_marksheet = 'Yes';
        $me_students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('second_year_marksheet')) 
      {
        $rules = ['second_year_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('second_year_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        
        
        //get file extension
        $extension = $request->file('second_year_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'second_year_marksheet_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('second_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->second_year_marksheet_path = $filenametostore;
                $me_students->second_year_marksheet='Yes';
        $me_students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('third_year_marksheet')) 
      {
        $rules = ['third_year_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('third_year_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        
        
        //get file extension
        $extension = $request->file('third_year_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'third_year_marksheet_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('third_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->third_year_marksheet_path =$filenametostore;
            $me_students->third_year_marksheet='Yes';
        $me_students->save();
        
      //////echo $path; //
      
      }
       if($request->hasFile('fourth_year_marksheet')) 
      {
        $rules = ['fourth_year_marksheet' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('fourth_year_marksheet_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        
        
        //get file extension
        $extension = $request->file('fourth_year_marksheet')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'fourth_year_marksheet_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('fourth_year_marksheet')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->fourth_year_marksheet_path =$filenametostore;
            $me_students->fourth_year_marksheet='Yes';
        $me_students->save();
        
      //////echo $path; //
      
      }

      
      

      
      if($request->hasFile('convocation_passing_certi')) 
      {
        $rules = ['convocation_passing_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('convocation_passing_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        
        
        //get file extension
        $extension = $request->file('convocation_passing_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'convocation_passing_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('convocation_passing_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->convocation_passing_certi_path = $filenametostore;
                $me_students->convocation_passing_certi='Yes';
        $me_students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('migration_certi')) 
      {
        $rules = ['migration_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('migration_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        
        
        //get file extension
        $extension = $request->file('migration_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'migration_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('migration_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->migration_certi_path = $filenametostore;
                $me_students->migration_certi='Yes';
        $me_students->save();
      //////echo $path; //
      
      }


      
      if($request->hasFile('birth_certi')) 
      {
        $rules = ['birth_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('birth_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        
        
        //get file extension
        $extension = $request->file('birth_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'birth_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('birth_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $me_students->birth_certi_path = $filenametostore;
                $me_students->birth_certi='Yes';
        $me_students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('domicile')) 
      {
        $rules = ['domicile' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('domicile_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        
        
        //get file extension
        $extension = $request->file('domicile')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'domicile_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('domicile')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->domicile_path =$filenametostore;
                $me_students->domicile='Yes';
        $me_students->save();
        
      //////echo $path; //
      
      }

     
      if($request->hasFile('proforma_o')) 
      {
        $rules = ['proforma_o' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('proforma_o_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        
        
        //get file extension
        $extension = $request->file('proforma_o')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'proforma_o_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('proforma_o')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->proforma_o_path = $filenametostore;
                $me_students->proforma_o='Yes';
        $me_students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('retention')) 
      {
        $rules = ['retention' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('retention_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        
        
        //get file extension
        $extension = $request->file('retention')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'retention_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('retention')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $me_students->retention_path = $filenametostore;
               $me_students->retention='Yes';
        $me_students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('minority_affidavit')) 
      {
        $rules = ['minority_affidavit' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('minority_affidavit_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        
        
        //get file extension
        $extension = $request->file('minority_affidavit')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'minority_affidavit_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('minority_affidavit')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->minority_affidavit_path = $filenametostore;
                $me_students->minority_affidavit='Yes';
        $me_students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('gap_certi')) 
      {
        $rules = ['gap_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('gap_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        
        
        //get file extension
        $extension = $request->file('gap_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'gap_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('gap_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->gap_certi_path =$filenametostore;
                $me_students->gap_certi='Yes';
        $me_students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('community_certi')) 
      {
        $rules = ['community_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('community_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        
        
        //get file extension
        $extension = $request->file('community_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'community_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('community_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->community_certi_path = $filenametostore;
                $me_students->community_certi='Yes';
        $me_students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('caste_certi')) 
      {
        $rules = ['caste_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('caste_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        
        
        //get file extension
        $extension = $request->file('caste_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'caste_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('caste_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $me_students->caste_certi_path =$filenametostore;
                $me_students->caste_certi='Yes';
        $me_students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('caste_validity_certi')) 
      {
        $rules = ['caste_validity_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('caste_validity_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        
        
        //get file extension
        $extension = $request->file('caste_validity_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'caste_validity_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('caste_validity_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $me_students->caste_validity_certi_path = $filenametostore;
               $me_students->caste_validity_certi='Yes';
        $me_students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('non_creamy_layer_certi')) 
      {
        $rules = ['non_creamy_layer_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('non_creamy_layer_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        
        
        //get file extension
        $extension = $request->file('non_creamy_layer_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'non_creamy_layer_certi_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('non_creamy_layer_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $me_students->non_creamy_layer_certi_path = $filenametostore;
                $me_students->non_creamy_layer_certi='Yes';
        $me_students->save();
      //////echo $path; //
      
      }

      
      

      
      if($request->hasFile('proforma_a_b1_b2')) 
      {
        $rules = ['proforma_a_b1_b2' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('proforma_a_b1_b2_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        
        
        //get file extension
        $extension = $request->file('proforma_a_b1_b2')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'proforma_a_b1_b2_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('proforma_a_b1_b2')->storeAs($destinationPath, $filenametostore,'public_uploads');
        
        $me_students->proforma_a_b1_b2_path = $filenametostore;
                $me_students->proforma_a_b1_b2='Yes';
        $me_students->save();
      //////echo $path; //
      
      }

      
      if($request->hasFile('proforma_f_f1')) 
      {
        $rules = ['proforma_f_f1' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('proforma_f_f1_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        
        
        //get file extension
        $extension = $request->file('proforma_f_f1')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'proforma_f_f1_'.$dte_id.'.'.$extension;
        
        //Upload File
        $path = $request->file('proforma_f_f1')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->proforma_f_f1_path = $filenametostore;
                $me_students->proforma_f_f1='Yes';

        $me_students->save();
        
      //////echo $path; //
      
      }

      
      if($request->hasFile('income_certi')) 
      {
        $rules = ['income_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('income_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        
        
        //get file extension
        $extension = $request->file('income_certi')->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = 'income_certi_'.$dte_id.'.'.$extension;
        
        //Upload file
        $path = $request->file('income_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
      $me_students->income_certi_path = $filenametostore;
            $me_students->income_certi='Yes';
        $me_students->save();
      }

      
      if($request->hasFile('proforma_c_d_e')) 
      {
        $rules = ['proforma_c_d_e' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('proforma_c_d_e_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        $extension = $request->file('proforma_c_d_e')->getClientOriginalExtension();
        $filenametostore = 'proforma_c_d_e'.$dte_id.'.'.$extension;
        $path = $request->file('proforma_c_d_e')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->proforma_c_d_e_path = $filenametostore;
                $me_students->proforma_c_d_e='Yes';
        $me_students->save();
      }

      
      if($request->hasFile('proforma_j_k_l')) 
      {
        $rules = ['proforma_j_k_l' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('proforma_j_k_l_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        $extension = $request->file('proforma_j_k_l')->getClientOriginalExtension();
        $filenametostore = 'proforma_j_k_l_'.$dte_id.'.'.$extension;
        $path = $request->file('proforma_j_k_l')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->proforma_j_k_l_path =$filenametostore;
                $me_students->proforma_j_k_l='Yes';
        $me_students->save();
      }

      
      if($request->hasFile('medical_certi')) 
      {
        $rules = ['medical_certi' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('medical_certi_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        $extension = $request->file('medical_certi')->getClientOriginalExtension();
        $filenametostore = 'medical_certi_'.$dte_id.'.'.$extension;
        $path = $request->file('medical_certi')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->medical_certi_path = $filenametostore;
                $me_students->medical_certi='Yes';
        $me_students->save();
      }

      
      if($request->hasFile('anti_ragging_affidavit')) 
      {
        $rules = ['anti_ragging_affidavit' => 'mimes:pdf'];
          $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
         {
          $request->session()->flash('anti_ragging_affidavit_error', 'Please Upload Only PDF');
          return redirect()->route('adminDocumentVerifierAcapMEG');
         }
        $extension = $request->file('anti_ragging_affidavit')->getClientOriginalExtension();
        $filenametostore = 'anti_ragging_affidavit'.$dte_id.'.'.$extension;
        $path = $request->file('anti_ragging_affidavit')->storeAs($destinationPath, $filenametostore,'public_uploads');
        $me_students->anti_ragging_affidavit_path = $filenametostore;
                $me_students->anti_ragging_affidavit='Yes';
        $me_students->save();
      }

        $users = DB::table('me_students')->select('dte_id','fc_confirmation_receipt','fc_confirmation_receipt_path','dte_allotment_letter','dte_allotment_letter_path','arc_ackw_receipt','arc_ackw_receipt_path','cet_result','cet_result_path','ssc_marksheet','ssc_marksheet_path','hsc_diploma_marksheet','hsc_diploma_marksheet_path','degree_leaving_tc','degree_leaving_tc_path','first_year_marksheet','first_year_marksheet_path','second_year_marksheet','second_year_marksheet_path','third_year_marksheet','third_year_marksheet_path','migration_certi','migration_certi_path','birth_certi','birth_certi_path','domicile','domicile_path','proforma_o','proforma_o_path','retention','retention_path','minority_affidavit','minority_affidavit_path','gap_certi','gap_certi_path','community_certi','community_certi_path','caste_certi','caste_certi_path','caste_validity_certi','caste_validity_certi_path','non_creamy_layer_certi','non_creamy_layer_certi_path','proforma_a_b1_b2','proforma_a_b1_b2_path','proforma_f_f1','proforma_f_f1_path','income_certi','convocation_passing_certi','convocation_passing_certi_path','income_certi_path','proforma_c_d_e','proforma_c_d_e_path','anti_ragging_affidavit','anti_ragging_affidavit_path','proforma_j_k_l','proforma_j_k_l_path','medical_certi','medical_certi_path','photo','photo_path','signature','signature_path')->where('dte_id', $dte_id)->get();
        $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        $hash = $hash[0]->hash;


        $data=[];
        $data['users']=$users;
        $data['hash'] = $hash;
        $data['course'] = $course;
      
        return view('admin.adminDocumentVerifierAcapMEG',$data);

      }
        else
            return redirect()->route('adminLogin');
    
    }







 public static  function showalldocumentsAcapMEG(Request $request)
    {
        $email =$request->session()->get('email_id', 'null');
        $course = $request->session()->get('adminCourse');
    if ($email != 'null')
        {
          $dte_id = $request->session()->get('dte');
          //return $dte_id;
          if($course == "MCA")
          $user1 = DB::table('mca_students')->select('dte_id','fc_confirmation_receipt','fc_confirmation_receipt_path','dte_allotment_letter','dte_allotment_letter_path','arc_ackw_receipt','arc_ackw_receipt_path','cet_result','cet_result_path','ssc_marksheet','ssc_marksheet_path','hsc_diploma_marksheet','hsc_diploma_marksheet_path','degree_leaving_tc','degree_leaving_tc_path','first_year_marksheet','first_year_marksheet_path','second_year_marksheet','convocation_passing_certi','convocation_passing_certi_path','second_year_marksheet_path','third_year_marksheet','third_year_marksheet_path','migration_certi','migration_certi_path','birth_certi','birth_certi_path','domicile','domicile_path','proforma_o','proforma_o_path','retention','retention_path','minority_affidavit','minority_affidavit_path','gap_certi','gap_certi_path','community_certi','community_certi_path','caste_certi','caste_certi_path','caste_validity_certi','caste_validity_certi_path','non_creamy_layer_certi','non_creamy_layer_certi_path','proforma_a_b1_b2','proforma_a_b1_b2_path','proforma_f_f1','proforma_f_f1_path','income_certi','income_certi_path','proforma_c_d_e','proforma_c_d_e_path','anti_ragging_affidavit','anti_ragging_affidavit_path','proforma_j_k_l','proforma_j_k_l_path','medical_certi','medical_certi_path','photo','photo_path','signature','signature_path')->where('dte_id', $dte_id)->get();
            elseif($course == "MEG")
            $user1 = DB::table('me_students')->where('dte_id',$dte_id)->get();    
        $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        //return $hash;
        $hash = $hash[0]->hash;
        $data=[];
        $data['user1']=$user1;
        $data['hash']=$hash;
        //return $user1;
          return view('admin.adminViewAllDocumentsMEG',$data);
        }

        else
            return redirect()->route('adminLogin');
    }    



    public static  function showalldocumentsMEG(Request $request)
    {
        $email =$request->session()->get('email_id', 'null');
    if ($email != 'null')
        {
          $dte_id = $request->session()->get('dte1');
          //return $dte_id;
          $user1 = DB::table('me_students')->where('dte_id', $dte_id)->get();
        $hash = DB::table('student_login')->select('hash')->where('dte_id',$dte_id)->get();
        //return $hash;
        $hash = $hash[0]->hash;
        $data=[];
        $data['user1']=$user1;
        $data['hash']=$hash;
        //return $user1;
          return view('admin.adminViewAllDocumentsMEG',$data);
        }

        else
            return redirect()->route('adminLogin');
    }    




    public static function showLatestNews(Request $request)
    {
     
    $role =$request->session()->get('role', 'null');
    if ($role != 'null' && ($role=='Admin' || $role=='Super Admin') )
       { 
         $news=DB::select(DB::raw("SELECT * from latest_news ORDER BY created_at DESC"));
         //return $news;

   	 	return view('admin.adminLatestNews')->with('news',$news);
           
       }
      
     else
            return redirect()->route('adminLogin');
    }


    public static function postLatestNews(Request $request)
    {
    	 $msg=$request->input('message');

    	 $latest_news=new latest_news();
    	 $latest_news->message=$msg;
    	 $latest_news->save();


   	 	return redirect()->route('adminLatestNews');
    }



    public static function deleteNews($id,Request $request)
    {
        
    $role =$request->session()->get('role', 'null');
    if ($role != 'null' && ($role=='Admin' || $role=='Super Admin') )
       { 
         //$nid=$id;
         //return $nid;
        
        $news=DB::delete(DB::raw("DELETE from latest_news where id = '$id' "));

        return redirect()->route('adminLatestNews');
           
       }
      
     else
            return redirect()->route('adminLogin');
    }


    public static function admission(Request $request)
    {  

         $news=DB::select(DB::raw("SELECT * from latest_news ORDER BY created_at DESC"));

         $ugnotice=DB::select(DB::raw("SELECT * from important_notice WHERE course = 'UG' ORDER BY created_at DESC"));

         $pgnotice=DB::select(DB::raw("SELECT * from important_notice WHERE course = 'PG' ORDER BY created_at DESC"));
         //return $pgnotice;

     return view('admin.admission')->with('news',$news)->with('ugnotice',$ugnotice)->with('pgnotice',$pgnotice);
    } 

    public static function showPdfs(Request $request)
    {
     $role =$request->session()->get('role', 'null');
      if ($role != 'null' && ($role=='Admin' || $role=='Super Admin') )
       { 
         //$nid=$id;
         //return $nid;
        
        $notice=DB::select(DB::raw("SELECT * from important_notice ORDER BY updated_at DESC"));
        //return $news;

        return view('admin.adminUploadPdf')->with('notice',$notice);
       }
      
     else
            return redirect()->route('adminLogin');
    }
     

    public static function postPdfs(Request $request)
    {    
        // $destinationPath = $dte_id.'_'.$use[0]->hash;

         $msg=$request->input('message');
         $course=$request->input('course');
                     
         //return $request->input('pdf');
         if($request->hasFile("pdf"))
         {   //return "Hell";
                $rules = ['notice' => 'mimes:pdf|max:1024'];
                  $validator = Validator::make(Input::all() , $rules);
                if ($validator->fails())
                 {
                  $request->session()->flash('notice', 'Please Upload Only PDF. File size should be less than 1 mb.');
                  return redirect()->route('admin.adminUploadPdf');
                 }
                $extension = $request->file('pdf')->getClientOriginalExtension();
                //return $extension;
                $filenametostore = $msg.'.'.$extension;
                $path = $request->file('pdf')->storeAs("/", $filenametostore,'public_notice');
                  
         $important_notice=new important_notice();
         $important_notice->message=$msg;
         $important_notice->course=$course;
         $important_notice->pdf_location =$filenametostore;
         $important_notice->save();  
        }
         

        return redirect()->route('adminPdfNotice');
    }

    public static function deleteNotice($id,Request $request)
    {
        
        
        $role =$request->session()->get('role', 'null');
      if ($role != 'null' && ($role=='Admin' || $role=='Super Admin') )
       { 
         // $nid=$id;
         // return $nid;
        
        $news=DB::delete(DB::raw("DELETE from important_notice where id = '$id' "));

        return redirect()->route('adminPdfNotice');
       }
      
     else
            return redirect()->route('adminLogin');
    }

     
public static function showCashPayment(Request $request){
         $email =$request->session()->get('email_id', 'null');
         $role =$request->session()->get('role', 'null');

    if ($email != 'null')
       { 
           
         if($role == "Staff")
        {
          $course = DB::table('admin_login')->select('course')->where('email_id',$email)->get();
        }
        else
        {
          $course =$request->session()->get('adminCourse',null);
          $array_object = [['course' => $course]];
          $course = json_decode(json_encode($array_object));
          
        }
        
        $array_object = [['granted_amt' => null, 'total_amt' => null, 'balance_amt' => null]];
        $payments = json_decode(json_encode($array_object));
         $array_object = [['dte_id' => null,'name_on_marksheet'=>null]];
        $user = json_decode(json_encode($array_object));
       
        return view('admin.adminVerifyCash')->with('payments',$payments)->with('user',$user)->with('course',$course);
        }else
            return redirect()->route('adminLogin');
    }

        
public static function SearchCashPayment(Request $request){
        $dte_id = $request->input('dteId');
        $email = $request->session()->get('email_id');
        $role =$request->session()->get('role');
       
        
        $department = DB::table('admission')->where('dte_id', 'LIKE', '%' . $dte_id . '%')->get();  
         $course=$department[0]->course;
        if($course == "MEG")
            $user = DB::table('me_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
        if($course == "MCA")
              $user = DB::table('mca_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
        if($course == "FEG")
              $user = DB::table('fe_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
         if($course == "DSE")
              $user = DB::table('dse_students')->where('dte_id','LIKE','%'.$dte_id.'%')->get();
         //return $user; 
       
       if($role == "Staff")
        {
          $course = DB::table('admin_login')->select('course')->where('email_id',$email)->get();
        }
        else
        {
          $course =$request->session()->get('adminCourse',null);
          $array_object = [['course' => $course]];
          $course = json_decode(json_encode($array_object));
          
        }
        
        $array_object = [['granted_amt' => $department[0]->granted_amt , 'total_amt' => $department[0]->total_amt , 'balance_amt' => $department[0]->balance_amt ]];
        $payments = json_decode(json_encode($array_object));
         $array_object = [['dte_id' => $dte_id,'name_on_marksheet'=>$user[0]->name_on_marksheet]];
        $user1 = json_decode(json_encode($array_object));
       
        return view('admin.adminVerifyCash')->with('payments',$payments)->with('user',$user1)->with('course',$course);

    }


public static function PostCashPayment(Request $request){
  
             $dte_id = $request->input('dte_id');
             $admission_id = $request->input('admission_id');
             // return $admission_id;
             $course = $request->session()->get('log_course');
                       
             $reciptno = $request->input('reciptno');
             $reciptamnt=$request->input('reciptamnt');
             $reciptdate = $request->input('recipt_date');
             $reciptimg = $request->File('reciptimg');     
             $admissiontype = $request->input('admissiontype');     
                     
             date_default_timezone_set("Asia/Kolkata");
              // return $reciptimg;
             $destinationPath = $dte_id.'_'.$reciptno.'_cash';
             if($request->hasFile('reciptimg'))
                        {
                          // return"hello";
                              $rules = ['reciptimg' => 'mimes:jpg,png,jpeg,pdf'];
                              $validator = Validator::make(Input::all() , $rules);
                              if ($validator->fails())
                              {
                                $request->session()->flash('photo_error', 'Please Upload Only JPG or PNG type image. File size should be less than 1 mb.');
                                return redirect()->route('fe_cash');
                              }
                              $extension = $request->file('reciptimg')->getClientOriginalExtension();
                              $filenametostore = '/cash/reciptimg'.$dte_id.'.'.$extension;
                      
                              $path =  $request->file('reciptimg')->storeAs($destinationPath, $filenametostore,'public_uploads');
                              $reciptimg = $filenametostore;                              
                        }
                        else
                          {
                            return "upload an photo";
                          }
              
               $users= DB::insert('insert into cash_details( amount, dte_id,  recipt_no, reciptdate, reciptimg)  values ( ?,?,?,?,?)', [$reciptamnt,$dte_id,$reciptno,$reciptdate,$reciptimg]);
               
                        
                        // return $user;//admkartik
                          $Admission = admission::find($admission_id);
                          if($Admission->balance_amt>0){                          
                          $Admission->paid_amt =  $reciptamnt;    
                          $balance_amt=$Admission->balance_amt-$reciptamnt;                         
                          $Admission->balance_amt = $balance_amt;                       
                          $Admission->save();
                        }
                    

             $fee = new fees_transaction;
             $fee->dte_id = $dte_id;
             $course= $Admission->course;
             // return $course;
               if($course == "MEG" )
             $fee->sub_merchant_id = 412;
             if($course == "MCA")
              $fee->sub_merchant_id = 312;
            if($course == "FEG")
              $fee->sub_merchant_id = 112;
             if($course == "DSE")
              $fee->sub_merchant_id = 212;

              $fee->course = $course."ACAP";
              $fee->payment_mode = "CASH";
              $user = DB::table('admission')->where('admission_id', $admission_id)->get();
              // return $user[0]->balance_amt;
              if ($user[0]->balance_amt =='0') {
              $fee->trans_status = "SUCCESS";  
              }
              else{
              $fee->trans_status = "PENDING";
              }
              $fee->trans_timestamp = date("Y-m-d h:i:s");
              $fee->trans_amt = $reciptamnt;
              $fee->init_amt = $Admission->total_amt;
              $fee->total_amt =$Admission->total_amt;
              $fee->payment_timestamp = date("Y-m-d h:i:s");
              $fee->admission_id = $user[0]->admission_id;
              $fee->response_code = "E00328";
              $fee->admission_type = $admissiontype;
              $fee->save();              
              $request->session()->flash('error', 'PAYMENT SUCCESSFULL');
              return redirect()->route('adminAdmit');
             
            


}

}

