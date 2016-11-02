<?php

namespace App\Http\Controllers\Index;

use App\Models\BookModel;
use App\Models\RoleModel;
use App\Models\TitleModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RelationController extends Controller
{
    public function getIndex()
    {
        //添加一个role
        $role = new RoleModel();
        $role->name = '开发者';
        $res = $role->save();
        echo '新建ROLE:' . $res . '<br/>';
        $role_id = $role->id;
        echo 'ROLE_ID:' . $role_id . '<br/>';

        // 添加用户
        for ($i = 0; $i < 10; $i++) {
            $user = new UserModel();
            $user->username = \limx\func\Random::str(6);
            $user->role_id = $role_id;
            $res = $user->save();
            for ($j = 0; $j < 2; $j++) {
                $book = new BookModel();
                $book->uid = $user->id;
                $book->name = \limx\func\Random::str(6);
                $rs = $book->save();
                echo '新建BOOK:' . $rs . '<br/>';
            }
            echo '新建USER:' . $res . '<br/>';
        }

        for ($i = 0; $i < 5; $i++) {
            $title = new TitleModel();
            $title->name = \limx\func\Random::str(6);
            $res = $title->save();
            echo '新建TITLE:' . $res . '<br/>';
        }

        $users = UserModel::get();
        $titles = TitleModel::get();
        $count = count($titles);
        foreach ($users as $user) {
            \DB::insert("insert into user_title(`uid`,`title_id`) values(?,?);", [$user->id, rand(1, $count)]);
        }

    }

    public function getRoleuser()
    {
        $role = new RoleModel();
        $res = $role->find(1)->users;
        dump($res);

        $res = $role->find(1)->users()->where('id', 1)->get();
        dump($res);
    }

    public function getUserrole()
    {
        $user = new UserModel();
        $res = $user->find(1)->role->first();
        dump($res);

        $res = $user->find(1)->role->name;
        dump($res);
    }

    public function getUsertitle()
    {
        $user = UserModel::find(1);
        foreach ($user->titles as $title) {
            dump($title);
        }

        dump(UserModel::find(1)->titles);

    }

    public function getTitleuser()
    {
        $title = TitleModel::find(1);
        foreach ($title->users as $user) {
            dump($user);
        }
    }

    public function getUserbook()
    {
        $book = UserModel::find(1)->book;
        dump($book);
    }

    public function getRolebook()
    {
        $book = RoleModel::find(1)->books;
        dump($book);
    }

    public function getEager()
    {
        $users = UserModel::where('id', '<', 10)->get();
        dump($users);
        foreach ($users as $user) {
            echo $user->role->name . " ";
        }
        echo "\n";
        $users2 = UserModel::with('role')->where('id', '<', 10)->get();
        dump($users2);
        foreach ($users2 as $user) {
            echo $user->role->name . " ";
        }
    }

    public function getLoad()
    {
        $user = UserModel::take(2)->get();
        $is = 0;
        foreach ($user as $i => $v) {
            if ($is++)
                $v->load('book');
            dump($v);
        }
    }
}
