<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Http\Requests\CreateTask;
use Carbon\Carbon;

class TaskTest extends TestCase
{
    //テストケース毎にデータベースをリフレッシュしてマイグレーションを再実行する
    use RefreshDatabase;
    /**
     * 各テストケースごとにデータベースをリフレッシュしてマイグレーションを再実行する
     */
    use RefreshDatabase;

    /**
     * 各テストメソッドの再実行前に呼ばれる
     */
    public function setUp()
    {
        parent::setUp();

        //テストケース実行前にフォルダデータを作成する
        $this->seed('FoldersTableSeeder');
    }

    public function due_date_should_be_date()
    {
        $response = $this->post('/folders/1/tasks/create', [
            'title' => 'Sample task',
            'due_date' => 123, //不正なデータ（数値）
        ]);

        $response->assertSessionHashErrors([
            'due_date' => '期限日には日付を入力してください。',
        ]);
    }

    /**
     * 期限日が過去日付の場合はバリデーションエラー
     * @test
     */

    public function due_date_should_not_be_past()
    {
        $response = $this->post('/folders/1/tasks/create', [
            'title' => 'Sample task',
            'due_date' => Carbon::yestarday()->format('Y/m/d'), //不正なデータ（昨日の日付）
        ]);

        $response->assertSessionHasErrors([
            'due_date' => '期限日 には今日以降の日付を入力してください。',
        ]);
    }
}
