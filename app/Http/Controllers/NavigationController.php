<?php

namespace App\Http\Controllers;

use Auth;
use Storage;
use App\Model\Navigation;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function index(Request $request){
        $navigation_info = Navigation::navigation_info()
            ->whereRaw('n_type != 10 and n_type != 11 and n_type != 12 and n_type != 13')
            ->orderBy('n_weight', 'desc')
            ->paginate(15);
        $navigation_type = '';
        $navigation_name = '';
        return view('navigation.index', ['navigation_info'=>$navigation_info,'navigation_type'=>$navigation_type,'navigation_name'=>$navigation_name]);
    }

    public function add(Request $request){
        if($request->isMethod('post')){
            $navigation_info = Navigation::navigation_info()->select('n_weight')->orderBy('n_weight', 'desc')->first();
            $weight = $navigation_info['n_weight'] + 1;
            try{
                $url = $request->n_url;
                $url = trim($url,',');
                $url = explode(',', $url);
                for ($i=0; $i<count($url); $i++){
                    if($this->isDomain($url[$i])){
                        Navigation::navigation_info()->insert(['n_type'=>$request->n_type, 'n_url'=>$url[$i], 'n_time'=>date('Y-m-d H:i:s'), 'n_weight'=>$weight, 'n_remark'=>$request->n_remark]);
                    }
                }
            }catch (\Exception $e){
                return redirect()->action('NavigationController@index')->with(['edit_status' => '添加失败 !']);
            }
            return redirect()->action('NavigationController@index')->with(['edit_status' => '添加成功 !']);
        }else{
            return view('navigation.add');
        }
    }

    public function isDomain($domain)
   {
       if(preg_match('/([a-z0-9]+([a-z0-9-]*(?:[a-z0-9]+))?\.)?[a-z0-9]+([a-z0-9-]*(?:[a-z0-9]+))?(\.us|\.tv|\.org\.cn|\.org|\.net\.cn|\.net|\.mobi|\.me|\.la|\.info|\.hk|\.gov\.cn|\.edu|\.com\.cn|\.com|\.co\.jp|\.co|\.cn|\.cc|\.biz)/', $domain)){
            return true;
       }else{
           return false;
       }
   }

    public function del(Request $request){
        $id = explode(',', $request->id);
        $lenth_id = count($id);
        try {
            //删除数据
            for ($i=0; $i< $lenth_id; $i++){
                Navigation::navigation_info()->where('n_id', '=', $id[$i])->delete();
            }
        } catch(\Exception $e){
            return response()->json(['status' => 'error', 'res_desc' => '删除失败!']);
        }
        return response()->json(['status' => 'success', 'res_desc' => '删除成功!']);
    }

    public function edit(Request $request){
        $id = $request->id;
        $n_type = $request->type;
        $navigation = Navigation::navigation_info()->where('n_id', '=', $id)->first();
        return view('navigation.edit', ['navigation' => $navigation, 'n_type' => $n_type]);
    }

    public function edit_info(Request $request){
        $id = $request->n_id;
        $type = $request->n_type;
        $url = $request->n_url;
        $remark = $request->n_remark;
        
        $up_data = array(
            'n_type' => $type,
            'n_url' => $url,
            'n_remark' => $remark
        );

        try {
            Navigation::navigation_info()->where('n_id', $id)->update($up_data);
        } catch(\Exception $e){
            return redirect()->action('NavigationController@index')->with(['edit_status' => '修改失败 !']);
        }
        return redirect()->action('NavigationController@index')->with(['edit_status' => '修改成功 !']);
    }

    public function sort(Request $request){
        $type = $request->type;
        $sort = $request->data_sort;
        if($type == 1){
            $navigation_prve = Navigation::navigation_info()->where('n_weight', '>', $sort)->orderBy('n_weight', 'asc')->first();
            if(!empty($navigation_prve)){
                try {
                    Navigation::navigation_info()->where('n_id', $navigation_prve['n_id'])->update(['n_weight'=>$sort]);
                }catch (\Exception $e){
                    return response()->json(['status' => 'error', 'res_desc' => '操作失败!']);
                }
                try {
                    Navigation::navigation_info()->where('n_id', $request->id)->update(['n_weight'=>$navigation_prve['n_weight']]);
                }catch (\Exception $e){
                    return response()->json(['status' => 'error', 'res_desc' => '操作失败!']);
                }
                return response()->json(['status' => 'error', 'res_desc' => '操作成功!']);
            }else{
                return response()->json(['status' => 'error', 'res_desc' => '已是最高，无需上移!']);
            }
        }else{
            $navigation_prve = Navigation::navigation_info()->where('n_weight', '<', $sort)->orderBy('n_weight', 'desc')->first();
            if(!empty($navigation_prve)){
                try {
                    Navigation::navigation_info()->where('n_id', $navigation_prve['n_id'])->update(['n_weight'=>$sort]);
                }catch (\Exception $e){
                    return response()->json(['status' => 'error', 'res_desc' => '操作失败!']);
                }
                try {
                    Navigation::navigation_info()->where('n_id', $request->id)->update(['n_weight'=>$navigation_prve['n_weight']]);
                }catch (\Exception $e){
                    return response()->json(['status' => 'error', 'res_desc' => '操作失败!']);
                }
                return response()->json(['status' => 'error', 'res_desc' => '操作成功!']);
            }else{
                return response()->json(['status' => 'error', 'res_desc' => '已是最低，无需下移!']);
            }
        }
    }

    public function search(Request $request){
        $navigation_type = $request->navigation_type;
        $navigation_name = $request->navigation_name;
        if($navigation_type == '' && $navigation_name != ''){
            $navigation_info = Navigation::navigation_info()
                ->whereRaw('n_type != 10 and n_type != 11 and n_type != 12 and n_type != 13')
                ->where('n_url', 'like', '%'.$navigation_name.'%')
                ->orderBy('n_weight', 'desc')
                ->paginate(15);
        }elseif($navigation_type != '' && $navigation_name == ''){
            $navigation_info = Navigation::navigation_info()
                ->whereRaw('n_type != 10 and n_type != 11 and n_type != 12 and n_type != 13')
                ->where('n_type',$navigation_type)
                ->orderBy('n_weight', 'desc')
                ->paginate(15);
        }else{
            $navigation_info = Navigation::navigation_info()
                ->whereRaw('n_type != 10 and n_type != 11 and n_type != 12 and n_type != 13')
                ->where('n_url', 'like', '%'.$navigation_name.'%')
                ->orderBy('n_weight', 'desc')
                ->paginate(15);
        }
        return view('navigation.index', ['navigation_info'=>$navigation_info,'navigation_type'=>$navigation_type,'navigation_name'=>$navigation_name]);
    }

    // 域名替换（查询域名是否存在）
    public function changeUrl(Request $request){
        if($request->active == 'search'){
            $navigation_info = Navigation::navigation_info()
                ->where('n_url', $request->old_url)
                ->select('n_url')
                ->first();
            if($navigation_info != ''){
                return 'ok';
            }else{
                return 'no';
            }
        }else{
            $change_info = Navigation::navigation_info()
                ->where('n_url', $request->old_url)
                ->select('n_id')
                ->get();
            $d_id = '';
            foreach ($change_info as $val){
                $d_id .= $val->n_id.',';
            }
            $change_id = trim($d_id,',');
            $change_id = explode(',', $change_id);
            $count = count($change_id);
            try {
                for ($i=0; $i<$count; $i++){
                    Navigation::navigation_info()->where('n_id', $change_id[$i])->update(['n_url'=>$request->new_url]);
                }
            } catch(\Exception $e){
                return 'fail';
            }
            return 'success';
        }
    }

    // 备用域名
    public function spare(){
        $navigation_info = Navigation::navigation_info()
            ->whereRaw('n_type = 10')
            ->orderBy('n_weight', 'desc')
            ->paginate(15);
        $navigation_type = '';
        $navigation_name = '';
        return view('navigation.spare_index', ['navigation_info'=>$navigation_info,'navigation_type'=>$navigation_type,'navigation_name'=>$navigation_name]);
    }

    public function spare_add(Request $request){
        if($request->isMethod('post')){
            $navigation_info = Navigation::navigation_info()->select('n_weight')->orderBy('n_weight', 'desc')->first();
            $weight = $navigation_info['n_weight'] + 1;
            try{
                $url = $request->n_url;
                $url = trim($url,',');
                $url = explode(',', $url);
                for ($i=0; $i<count($url); $i++){
                    if($this->isDomain($url[$i])){
                        Navigation::navigation_info()->insert(['n_type'=>$request->n_type, 'n_url'=>$url[$i], 'n_time'=>date('Y-m-d H:i:s'), 'n_weight'=>$weight, 'n_remark'=>$request->n_remark]);
                    }
                }
            }catch (\Exception $e){
                return redirect()->action('NavigationController@index')->with(['edit_status' => '添加失败 !']);
            }
            return redirect()->action('NavigationController@index')->with(['edit_status' => '添加成功 !']);
        }else{
            return view('navigation.spare_add');
        }
    }

    public function spare_search(Request $request){
        $navigation_type = $request->navigation_type;
        $navigation_name = $request->navigation_name;
        if($navigation_type == '' && $navigation_name != ''){
            $navigation_info = Navigation::navigation_info()
                ->where('n_type', 10)
                ->where('n_url', 'like', '%'.$navigation_name.'%')
                ->orderBy('n_weight', 'desc')
                ->paginate(15);
        }elseif($navigation_type != '' && $navigation_name == ''){
            $navigation_info = Navigation::navigation_info()
                ->where('n_type', 10)
                ->where('n_type',$navigation_type)
                ->orderBy('n_weight', 'desc')
                ->paginate(15);
        }else{
            $navigation_info = Navigation::navigation_info()
                ->where('n_type', 10)
                ->where('n_url', 'like', '%'.$navigation_name.'%')
                ->orderBy('n_weight', 'desc')
                ->paginate(15);
        }
        return view('navigation.spare_index', ['navigation_info'=>$navigation_info,'navigation_type'=>$navigation_type,'navigation_name'=>$navigation_name]);
    }

    public function spare_edit(Request $request){
        $id = $request->id;
        $n_type = $request->type;
        $navigation = Navigation::navigation_info()->where('n_id', '=', $id)->first();
        return view('navigation.spare_edit', ['navigation' => $navigation, 'n_type' => $n_type]);
    }

    public function spare_edit_info(Request $request){
        $id = $request->n_id;
        $url = $request->n_url;
        $remark = $request->n_remark;

        $up_data = array(
            'n_type' => 10,
            'n_url' => $url,
            'n_remark' => $remark,
        );

        try {
            Navigation::navigation_info()->where('n_id', $id)->update($up_data);
        } catch(\Exception $e){
            return redirect()->action('NavigationController@spare')->with(['edit_status' => '修改失败 !']);
        }
        return redirect()->action('NavigationController@spare')->with(['edit_status' => '修改成功 !']);
    }


    // 标题栏链接
    public function headTitle(){
        $navigation_info = Navigation::navigation_info()
            ->whereRaw('n_type = 11')
            ->orderBy('n_weight', 'desc')
            ->paginate(5);
        $navigation_type = '';
        $navigation_name = '';
        return view('navigation.headTitle', ['navigation_info'=>$navigation_info,'navigation_type'=>$navigation_type,'navigation_name'=>$navigation_name]);
    }

    public function headTitle_edit(Request $request){
        $id = $request->id;
        $n_type = $request->type;
        $navigation = Navigation::navigation_info()->where('n_id', '=', $id)->first();
        return view('navigation.headTitle_edit', ['navigation' => $navigation, 'n_type' => $n_type]);
    }

    public function headTitle_edit_info(Request $request){
        $id = $request->n_id;
        $type = $request->n_type;
        $url = $request->n_url;
        $remark = $request->n_remark;

        $up_data = array(
            'n_type' => $type,
            'n_url' => $url,
            'n_remark' => $remark,
        );
        try {
            Navigation::navigation_info()->where('n_id', $id)->update($up_data);
        } catch(\Exception $e){
            return redirect()->action('NavigationController@spare')->with(['edit_status' => '修改失败 !']);
        }
        return redirect()->action('NavigationController@headTitle')->with(['edit_status' => '修改成功 !']);
    }

    public function headTitle_search(Request $request){
        $navigation_name = $request->navigation_name;
        $navigation_info = Navigation::navigation_info()->where('n_url', 'like', '%'.$navigation_name.'%')->where('n_type', 11)->get();
        $navigation_type = '';
        return view('navigation.headTitle', ['navigation_info'=>$navigation_info,'navigation_type'=>$navigation_type,'navigation_name'=>$navigation_name]);
    }

    // 导航首页
    public function home_index(){
        $navigation_info = Navigation::navigation_info()
            ->whereRaw('n_type = 12 or n_type = 13')
            ->paginate(15);
        $navigation_type = '';
        $navigation_name = '';
        return view('navigation.homeIndex', ['navigation_info'=>$navigation_info,'navigation_type'=>$navigation_type,'navigation_name'=>$navigation_name]);
    }

    public function home_edit(Request $request){
        $id = $request->id;
        $n_type = $request->type;
        $navigation = Navigation::navigation_info()->where('n_id', '=', $id)->first();
        return view('navigation.homeIndex_edit', ['navigation' => $navigation, 'n_type' => $n_type]);
    }

    public function home_edit_info(Request $request){
        $id = $request->n_id;
        $type = $request->n_type;
        $url = $request->n_url;
        $remark = $request->n_remark;

        $up_data = array(
            'n_type' => $type,
            'n_url' => $url,
            'n_remark' => $remark,
        );
        try {
            Navigation::navigation_info()->where('n_id', $id)->update($up_data);
        } catch(\Exception $e){
            return redirect()->action('NavigationController@spare')->with(['edit_status' => '修改失败 !']);
        }
        return redirect()->action('NavigationController@homeIndex')->with(['edit_status' => '修改成功 !']);
    }

    public function home_search(Request $request){
        $navigation_name = $request->navigation_name;
        $navigation_info = Navigation::navigation_info()->where('n_url', 'like', '%'.$navigation_name.'%')->where('n_type', 11)->get();
        $navigation_type = '';
        return view('navigation.homeIndex', ['navigation_info'=>$navigation_info,'navigation_type'=>$navigation_type,'navigation_name'=>$navigation_name]);
    }
}
