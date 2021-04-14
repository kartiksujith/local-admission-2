<?php
namespace  App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
class VacancyController extends Controller
{
    public static function showAcapVacancy(Request $request)
    {
         $user = DB::table('vacancy')->get();
        return view('acap_vacancy_user')->with('user',$user);
    }
    
    public static function showAcapVacancyAdmin(Request $request)
    {
        $user = DB::table('vacancy')->get();
        return view('acap_vacancy_admin')->with('user',$user);
    }
    

 public static function updatevacantseats($id,Request $request)
    {
         $user = DB::table('vacancy')->get();
         //return $user;
        if($id=="cmpn_1_plus")
        {
          $val=$user[0]->cmpn1_vac + 1;
          DB::table('vacancy')->where('id',1)->update(['cmpn1_vac'=>$val]);
        }
        elseif($id=="cmpn_1_plus_sindhi")
        {
          $val=$user[1]->cmpn1_vac + 1;
          DB::table('vacancy')->where('id',2)->update(['cmpn1_vac'=>$val]);
        }
        elseif($id=="cmpn_1_minus")
        {
            $val=$user[0]->cmpn1_vac - 1;
          DB::table('vacancy')->where('id',1)->update(['cmpn1_vac'=>$val]);
        }
        elseif($id=="cmpn_1_minus_sindhi")
        {
            $val=$user[1]->cmpn1_vac - 1;
          DB::table('vacancy')->where('id',2)->update(['cmpn1_vac'=>$val]);
        }
        elseif($id=="cmpn_2_plus")
        {
            $val=$user[0]->cmpn2_vac + 1;
          DB::table('vacancy')->where('id',1)->update(['cmpn2_vac'=>$val]);
        }
        elseif($id=="cmpn_2_plus_sindhi")
        {
            $val=$user[1]->cmpn2_vac + 1;
          DB::table('vacancy')->where('id',2)->update(['cmpn2_vac'=>$val]);
        }
        elseif($id=="cmpn_2_minus")
        {
            $val=$user[0]->cmpn2_vac - 1;
          DB::table('vacancy')->where('id',1)->update(['cmpn2_vac'=>$val]);
        }
        elseif($id=="cmpn_2_minus_sindhi")
        {
            $val=$user[1]->cmpn2_vac - 1;
          DB::table('vacancy')->where('id',2)->update(['cmpn2_vac'=>$val]);
        }
        elseif($id=="it_plus")
        {
            $val=$user[0]->it_vac + 1;
          DB::table('vacancy')->where('id',1)->update(['it_vac'=>$val]);
        }
        elseif($id=="it_plus_sindhi")
        {
            $val=$user[1]->it_vac + 1;
          DB::table('vacancy')->where('id',2)->update(['it_vac'=>$val]);
        }
        elseif($id=="it_minus")
        {
            $val=$user[0]->it_vac  - 1;
          DB::table('vacancy')->where('id',1)->update(['it_vac'=>$val]);
        }
        elseif($id=="it_minus_sindhi")
        {
            $val=$user[1]->it_vac  - 1;
          DB::table('vacancy')->where('id',2)->update(['it_vac'=>$val]);
        }
        elseif($id=="extc_plus")
        {
            $val=$user[0]->extc_vac + 1;
          DB::table('vacancy')->where('id',1)->update(['extc_vac'=>$val]);
        }
        elseif($id=="extc_plus_sindhi")
        {
            $val=$user[1]->extc_vac + 1;
          DB::table('vacancy')->where('id',2)->update(['extc_vac'=>$val]);
        }
        elseif($id=="extc_minus")
        {
            $val=$user[0]->extc_vac - 1;
          DB::table('vacancy')->where('id',1)->update(['extc_vac'=>$val]);
        }
        elseif($id=="extc_minus_sindhi")
        {
            $val=$user[1]->extc_vac - 1;
          DB::table('vacancy')->where('id',2)->update(['extc_vac'=>$val]);
        }
        elseif($id=="etrx_plus")
        {
            $val=$user[0]->etrx_vac + 1;
          DB::table('vacancy')->where('id',1)->update(['etrx_vac'=>$val]);
        }
        elseif($id=="etrx_plus_sindhi")
        {
            $val=$user[1]->etrx_vac + 1;
          DB::table('vacancy')->where('id',2)->update(['etrx_vac'=>$val]);
        }
        elseif($id=="etrx_minus")
        {
            $val=$user[0]->etrx_vac - 1;
          DB::table('vacancy')->where('id',1)->update(['etrx_vac'=>$val]);
        }
        elseif($id=="etrx_minus_sindhi")
        {
            $val=$user[1]->etrx_vac - 1;
          DB::table('vacancy')->where('id',2)->update(['etrx_vac'=>$val]);
        }
        elseif($id=="inst_plus")
        {
            $val=$user[0]->inst_vac + 1;
          DB::table('vacancy')->where('id',1)->update(['inst_vac'=>$val]);
        }
        elseif($id=="inst_plus_sindhi")
        {
            $val=$user[1]->inst_vac + 1;
          DB::table('vacancy')->where('id',2)->update(['inst_vac'=>$val]);
        }
        elseif($id=="inst_minus")
        {
            $val=$user[0]->inst_vac- 1;
          DB::table('vacancy')->where('id',1)->update(['inst_vac'=>$val]);
        }
        elseif($id=="inst_minus_sindhi")
        {
            $val=$user[1]->inst_vac- 1;
          DB::table('vacancy')->where('id',2)->update(['inst_vac'=>$val]);
        }
        $email = $request->session()->pull('email_id');
       
        DB::table('admin_login')->where('email_id', $email)->update(['login' => 0]);
        
        return redirect()->route('acapVacancyAdmin');
    }

    
}