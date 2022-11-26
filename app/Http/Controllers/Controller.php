<?php

namespace App\Http\Controllers;

use App\Models\NewUser;
use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\ExportUser;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response as FacadeResponse;
use Illuminate\Support\Facades\File;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function CheckSum(NewUser $user){
        $newUsersData = $user->get();
        return response()->json(['UsersData'=>$newUsersData,'status'=>'OK'],200);
    }

    public function dataFromView(){

        $data = DB::table('OrdersData')->select('*')->get();
        return $data;
    }

    public function getPost(Post $post,Request $req){
        $limit = ($req->limit) ? $req->limit : 20;
        $page = $req->page && $req->page > 0 ? $req->page : 1;
        $skip = ($page - 1) * $limit;
        $newUsersData = $post->slice($skip,$limit);
        return response()->json(['info'=>$req->all(),'UsersData'=>$newUsersData,'status'=>'OK'],200);
    }

    public function storePost(Request $req)
    {
        try{
            $validation = Validator::make($req->all(),
                [
                    'user_id'=>'required',
                    'post_title'=>'required',
                ],
             );
             if($validation->fails()){
                return response()->json($validation->errors(),400);
             }else{
                $insertPost = Post::create($req->all());
                if($insertPost){
                    return response()->json(['message'=>'Post has been inserted','status'=>'OK'],200);
                }else{
                    return response()->json(['message'=>'Something went wrong','status'=>'failed'],500);
                }
             }
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
    public function deletePost(Request $req)
    {
        try{
            $validation = Validator::make($req->all(),['post_id'=>"required|exists:posts,id"]);
            if($validation->fails()){
                return response()->json($validation->errors());
            }else{
                $deletePost = Post::whereid($req->post_id)->first()->delete();
                if($deletePost){
                    return response()->json(['message'=>'Post has been deleted','status'=>'OK'],200);
                }else{
                    return response()->json(['message'=>'Something Went wrong ! Please try again','status'=>'failed'],500);
                }
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
public function fd()
{
    DB::beginTransaction();
    try{
        $csv = " S.No., User Name, User Mobile, User Age, User Salary \n";//Column headers
        $query = User::get();
        if ($query) {
            foreach ($query as $key => $value)
            {
                    $sno = $key+1;
                    $user_name = $value->user_name;
                    $user_mobile = $value->user_mobile;
                    $user_age = $value->user_age;
                    $user_salary = $value->user_salary;
                    $csv.= $sno.','.$user_name.','.$user_mobile.','.$user_age.','.$user_salary."\n";

                }
               // printf($csv);
            //file_put_contents(public_path()."/data-transfer/usersExcel".rand(0,9).".csv",$csv);
            $CsvName = date('Y-m-d').'UsersData.csv';
            $FILE_PATH = public_path()."/data-transfer/";
            //$FILE_PATH = config('app.FILE_PATH');
            $csv_handler = fopen($FILE_PATH.$CsvName,'w');
            fwrite ($csv_handler,$csv);
            fclose ($csv_handler);
            //unlink($FILE_PATH.$CsvName);
        }else{
            return 'query failed';
        }

    }catch(Exception $e){
        DB::rollBack();
        return $e->getMessage();
    }catch(\Illuminate\Database\QueryException $e){
        DB::rollBack();
        return $e->getMessage();
    }
}

public function ExportUsers()
{
    // creating files
    $data = [
        'users' => User::all()->toArray(),
        'posts' => Post::all()->toArray(),
        //and the next model
     ];
     //$data = json_encode($data);
    //  file_put_contents(public_path()."/data-transfer/output.txt", json_encode($data));
    //  file_put_contents(storage_path()."/myfiles/output.txt", json_encode($data));
    //  return 'hello';

    // feching files data
    $filename =public_path()."/data-transfer/output.txt";

    //   $content = json_decode(Files::get($filename));
    //$content = json_decode(file_get_contents($filename)); // same sa file
      //echo "<pre>";
    //   return $content;
    //   foreach($content as $cont)
    //   {
    //     echo $cont."<br/>";
    //   }
 // downloading files
    $path = public_path().'/data-transfer/';
    //return Excel::download(new ExportUser(2),'users.xlsx');
    $filePath = storage_path($filename);
    return FacadeResponse::download($filename);
}
 public function EditFiles(Request $req)
 {
    try{
    # code... Create New File
        // $data = 'Name'.','.'Class'.','.'Subject'.','.'Roll_no'."\n";
        // $data .="Rajeev".','.'MCA'.','.'Computer Science'.','.'10001'."\n";
        // $data .="Amit".','.'BCA'.','.'Computer Science'.','.'50002'."\n";
        // $data .="Nester".','.'B.Tech'.','.'MBA IT'.','.'600581'."\n";
        // $createFile = File::put(public_path()."/data-transfer/exp1.txt",$data);
        // $getFile = File::get(public_path()."/data-transfer/exp1.txt");
        // return $getFile;
        ## End New file


        ## download file from url Start
            // $imgUrl = $req->get('imageUrl');
            // $fileUrlToArray = explode(DIRECTORY_SEPARATOR, $imgUrl);
            // $filename = $fileUrlToArray[count($fileUrlToArray)-1];
            // $image = file_get_contents($imgUrl);
            // $destinationPath = base_path() . '/public/uploads/image/' . $filename;
            // file_put_contents($destinationPath, $image);
            // return 'file uploaded';
        ##End

        ## upload from http/ user form
            // $file = $req->file('image');
            // $path = public_path() . '/uploads/images/';
            // $file->move($path, $file->getClientOriginalName());
            // return response()->json(compact('path'));
        ## End File upload

        ## upload from base64 encoded string to file
            $data="data:image/jpeg;base64,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";

            ## $data = 'data:image/png;base64,AAAFBfj42Pj4'; base 64 encode file type
            ##         'type:fileType;encodingAlgo,ActualEncodedFile
            ##          'application/pdf;en
            list($typeArray, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data); //getting string break in two parts
            $data = base64_decode($data);
            list(,$type) = explode("/",$typeArray);
            file_put_contents(public_path().'/uploads/image/abcd.'.$type, $data);
            return 'File uploaded';
        ## End Conversion
    }catch(Exception $e){
        return $e->getMessage();
    }

 }

}
