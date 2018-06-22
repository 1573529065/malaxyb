<?php
namespace app\home\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Db;
use think\Log;


class Test extends Command

{
    protected function configure(){
        $this->setName('test')->setDescription('test1');
    }

    protected function execute(Input $input,Output $output){
        $output->writeln('定时任务开始');
        // Log::info('任务开始');

        $this->test();

        $output->writeln('定时任务结束');
    }

    private function test(){
        $num = Db::table('mb_user')->field('u_id,assets,vip_static')->select();
        foreach ($num as $v) {

            if ($v['assets'] >= 1000000 && $v['vip_static'] != 1) {
                Db::table('mb_user')->where('u_id', $v['u_id'])->setField('vip_static', 1);
                Log::info('成为vip'.$v['u_id']);
            }
        }
        $user_arr = Db::table('mb_user')
            ->where('assets','<>',0)
            ->field('u_id,assets,balance')
            ->select();
        $config = Db::table('mb_config')->where('co_id',5)->value('co_config');
        if ($user_arr){
            $fileName = date('Ymd') .'.txt';
            foreach ($user_arr as $key =>$value){
                $balance = $value['assets'] * $config/1000;
                $data = [
                    'balance' => $value['balance'] + $balance,
                    'assets' => $value['assets'] - $balance
                ];
                $isOK = Db::table('mb_user')->where('u_id',$value['u_id'])->update($data);
                if ($isOK){
                    Db::table('mb_assets_order')->insert([
                        'u_id' => $value['u_id'],
                        'ao_money' => '-'.$balance,
                        'former_money' => $value['assets'],
                        'type' => 1,
                        'ao_time' => time()
                    ]);
                    Db::table('mb_balance_order')->insert([
                        'u_id' => $value['u_id'],
                        'bo_money' => $balance,
                        'former_money' => $value['balance'],
                        'type' => 1,
                        'bo_time' => time()
                    ]);
                }
                $info = $key.'--'.'u_id:'.$value['u_id'].'老积分:'.$value['assets'].'新积分:'.$data['assets'].'旧余额:'.$value['balance'].'新余额:'.$data['balance'].'是否更新成功(0:失败):'.$isOK.PHP_EOL;;
                file_put_contents($fileName,$info,FILE_APPEND);
                Log::info('积分释放'.$info);
            }
        }
    }
}