<?php

namespace App\Http\Controllers\Index;

use App\Models\UserModel;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class UserController extends Controller
{
    public function getIndex()
    {
        $users = DB::table('user')->paginate(8);
        return view('index.user.index', ['list' => $users]);
    }

    public function postIndex()
    {
        $users = DB::table('user')->paginate(8);
        return $users;
    }


    public function getAdd()
    {
        return view('index.user.add');
    }

    public function getEdit(Requests\UserRequest $request)
    {
        $id = $request->input('id');
        if (\limx\func\Match::isInt($id) && $id > 0) {
//            $sql = "SELECT * FROM tb_user WHERE id=?";
//            $res = DB::select($sql, [$id]);
//            return view('index.user.edit', ['info' => $res[0]]);

            $res = UserModel::find($id);
            return view('index.user.edit', ['info' => $res]);

        }
        return redirect('index/user/index');
    }

    public function postSave(Requests\UserRequest $request)
    {
        $data = $request->input();
        $username = $data['username'];
        $password = md5($data['password']);
        $name = $data['name'];
        if (empty($data['id'])) {
            //新增
//            $sql = 'insert into user (username,password,name) values (?,?,?)';
//            $res = DB::insert($sql, [$username, $password, $name]);//返回是否成功
//            $res = DB::update($sql, [$username, $password, $name]);//返回影响的行数

            //MODEL 方法
            $res = new UserModel();
            $res->username = $username;
            $res->password = $password;
            $res->name = $name;
            $status = $res->save();
        } else {
            //更改
            $id = $data['id'];
//            $sql = "UPDATE tb_user SET username=?,password=?,name=? WHERE id = ?";
//            $res = DB::update($sql, [$username, $password, $name, $id]);//返回影响的行数
            DB::beginTransaction();
            $res = UserModel::find($id);
            $res->username = $username;
            $res->password = $password;
            $res->name = $name;
            $status = $res->update();
//            DB::rollback();
            DB::commit();
        }

        if ($res) {
            $ret['status'] = '1';
            $ret['msg'] = $status;
            $ret['data'] = $res;
            $ret['timestamp'] = time();
            return response()->json($ret);
        }
        $ret['status'] = '0';
        $ret['msg'] = $res;
        $ret['timestamp'] = time();
        return response()->json($ret);
    }

    public function postDel()
    {
        $id = request()->input('id');
        $match = preg_match("/^[1-9][0-9]*$/", $id);
        if ($match) {
            //第一种方式 自动事务
//            DB::transaction(function ($id) {
//                $sql = "DELETE FROM tb_user where id=?";
//                DB::delete($sql, [$id]);
//            });

            DB::beginTransaction();
            $sql = "DELETE FROM user where id=?";
            $res = DB::delete($sql, [$id]);
//            DB::rollback();
            DB::commit();

            $ret['status'] = '1';
            $ret['msg'] = $res;
            $ret['timestamp'] = time();
            return response()->json($ret);

        }

        $ret['status'] = '0';
        $ret['msg'] = 'ID 必须为正整数';
        $ret['timestamp'] = time();
        return response()->json($ret);
    }

}
