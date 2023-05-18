<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //このコードは、__construct メソッド内に記述されています。
    //__construct メソッドは、クラスのインスタンスが作成される際に自動的に実行される特別なメソッドです。
    //
    //$this->middleware('auth') は、auth ミドルウェアをこのコントローラーに適用することを意味しています。
    //ミドルウェアは、リクエストが特定の処理を実行する前に介入し、必要な認証や権限のチェックなどの処理を行うための仕組みです。
    //
    //具体的には、auth ミドルウェアは、このコントローラーのアクション（メソッド）が実行される前に、
    //ユーザーが認証済みであるかを確認します。つまり、このコントローラーのアクションは、
    //認証されていないユーザーからのアクセスを制限し、ログインしているユーザーのみがアクセスできるようになります。
    //
    //$this->middleware('auth') をコントローラーのコンストラクタ内に記述することで、
    //このコントローラーのすべてのアクションが認証済みのユーザーによってのみアクセス可能となります。

    public function index(Request $request)
    {
        return view('tasks.index', [
            'tasks' => $this->tasks->forUser($request->user()),
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        // タスクの作成…
        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks');
    }
    //バリデーションが失敗したかとか、リダイレクトとかを自分で行う必要さえありません。
    //指定したルールのバリデーションに失敗したら、ユーザーを自動的に直前のページヘリダイレクトし、
    //エラーも自動的にセッションへフラッシュデーターとして保存されます！

    public function destroy(Request $request,$taskId){
        $this->authorize('destroy', $task);

        // タスクの削除…
        $task->delete();

        return redirect('/tasks');
    }
}
