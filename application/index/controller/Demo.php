<?php
namespace app\index\controller; //项目
use think\Db;        //数据库
use think\Cache;    //缓存
use think\Config;   //读取配置文件
use think\Exception;   //队列用
use think\Queue;  //队列用

class Demo
{
    //引入extend文件夹下的类
    public function getExtend()
    {
    	$Test = new \my\Test();
        echo $Test->sayHello();
    }
    //输出XML类型文件
    public function xmlObj()
    {
        $data = ['name'=>'thinkphp','url'=>'thinkphp.cn'];
        // 指定xml数据输出
        return xml(['data'=>$data,'code'=>1,'message'=>'操作完成']);
    }
    //原生模糊查询
    public function mhcx(){
        $res = Db::query("SELECT * from ykb_article_enclosure where article_enclosure_address like concat('%',?,'%')",['a']);
        dump($res);
    }
    //获取token值
    public function getJwtToken(){
        echo loginToken();
        
    }
    //验证token值
    public function yzJwtToken(){
        $yztoken = yzToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU2MTYyMTQ2NCwiZXhwIjoxNTYxNjI1MDY0LCJqdGkiOiJlMDYwYmZmMDJkYjE3ZGI3ZGUyM2Y1Mzc2ZTdmYmZmYSJ9.h2GU9dQ9eZVfnWlWWjJIzlB68qWtHw10n-VOgBhzNzk');
        if(!$yztoken){
            echo JsonRes('1013');
            exit;
        }
        $data['newtoken'] = loginToken();
        echo JsonRes('200',$data['newtoken']);
    }
    //微信获取accessToken
    public function getWxAccessToken(){
        $jssdk=new \wx\JSSDK("wx0c8b05496023af13","ad56f98ddf34a30134fcf460b4a1bcdd");
        echo $jssdk->getAccessToken("wx0c8b05496023af13");
    }
    //微信自定义分享页
    public function getFxConfig(){
        $jssdk=new \wx\JSSDK("wx0c8b05496023af13","ad56f98ddf34a30134fcf460b4a1bcdd");
        $signPackage = $jssdk->GetSignPackage();
        echo JsonRes('200',$signPackage);
    }
    //文件下载
    public function filedownLoad(){
        $x = new \my\downLoad($dir,$name);  //dir文件路径及名称     $name 重命名
        $x->down();
    }
    //文件上传
    public function upload(){
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('image');
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->validate(['size'=>1000000,'ext'=>'jpg,png,gif'])->move(ROOT_PATH  . 'Uploads');
        if($info){
            // 成功上传后 获取上传信息
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            echo str_replace(DS,"/",$info->getSaveName());
          
        }else{
            // 上传失败获取错误信息
            echo 0;
        }
    }
    //保存base64流到本地
    public function update1(){
       $post = input();
       $filepath = "uploads/".date("Ymd")."/";
     
       echo base64($post["file"],$filepath);
       
    }
    //各种路由方式
    public function getRoute(){
        //dump(input('get.id'));
        $post = input();
        //dump(request()->get());
        //dump(request()->get('id'));
        // dump(request()->param());
        // dump(request()->param('id'));
        $get = request()->route();
        // dump(request()->route('id'));
        dump($post);
        dump($get);
        exit;
        $id = $_GET['id'];
        $name = $_GET['name'];
        echo $id.'----'.$name;

        dump($_GET);

    }
    //获取缓存内容
    public function setCache(){
        echo "ok";
        dump(Cache::set('name','adfasd')); 

    }
    //获取缓存内容
    public function getCache(){
        echo "ok";
        dump(Cache::get('name')); 

    }
    //phpinfo
    public function phpinfo(){
        phpinfo();
    }
    //二维码工具
    public function qrcode(){
         echo ewm('222ASDFASDFSADFASDFSADFSADFASDFASDFASDFASDFASDFASDFASDFASDF','Uploads/20190621154934.jpeg');
    }
    //获取 config.php配置信息
    public function configres(){
        $config = Config::get('wx');
        dump($config);
    }
    //获取微信公众号粉丝列表
    public function wxUserlist(){
        try {
            // 实例对应的接口对象
            // $user = \We::User(Config::get('wx'));
            //$user = new \WeChat\User(Config::get('wx'));
            $user = \We::WeChatUser(Config::get('wx'));
            // 调用接口对象方法
            $list = $user->getUserList();
            
            // 处理返回的结果
            echo '<pre>';
            var_export($list);
            
        } catch (Exception $e) {

            // 出错啦，处理下吧
            echo $e->getMessage() . PHP_EOL;
            
        }
    }
    //微信支付
    public function zhifu1(){
        // 创建接口实例
          $wechat = new \WeChat\Pay(Config::get('wx'));
          
          // 组装参数，可以参考官方商户文档
          $options = [
              'body'             => '测试商品',
              'out_trade_no'     => time(),
              'total_fee'        => '1',
              'openid'           => 'oTZ_y0zSZYRQ5E7sPORac5dge9ao',
              'trade_type'       => 'JSAPI',
              'notify_url'       => 'http://jason.zhiyiol.com/zhiyiapi/Home/zhifures',
              'spbill_create_ip' => '127.0.0.1',
          ];
            
        try {

            // 生成预支付码
            $result = $wechat->createOrder($options);
            
            // 创建JSAPI参数签名
            $options = $wechat->createParamsForJsApi($result['prepay_id']);
            dump($options);
            
            // @todo 把 $options 传到前端用js发起支付就可以了
            
        } catch (Exception $e) {

            // 出错啦，处理下吧
            echo $e->getMessage() . PHP_EOL;
            
        }
    }
    //微信支付返回处理订单
    public function zhifures(){
        try {
            // 3. 创建接口实例
            $wechat = new \WeChat\Pay(Config::get('wx'));
            
            // 4. 获取通知参数
            $data = $wechat->getNotify();
            if ($data['return_code'] === 'SUCCESS' && $data['result_code'] === 'SUCCESS') {
                // @todo 去更新下原订单的支付状态
                $order_no = $data['out_trade_no'];
                file_put_contents('1.txt',$order_no);
                // 返回接收成功的回复
                ob_clean();
                echo $wechat->getNotifySuccessReply();
            }

        } catch (Exception $e) {
            //file_put_contents('error.log',$e->getMessage(). PHP_EOL);
            // 出错啦，处理下吧
            echo $e->getMessage() . PHP_EOL;

        }
    }
    //支付宝电脑支付
    public function zhifubao1(){
        $config = Config::get('zhifubao');
        // 参考公共参数  https://docs.open.alipay.com/203/107090/
        $config['notify_url'] = 'http://pay.thinkadmin.top/test/alipay-notify.php';
        $config['return_url'] = 'http://pay.thinkadmin.top/test/alipay-success.php';

        try {
            
            // 实例支付对象
            $pay = \We::AliPayWeb($config);
            // $pay = new \AliPay\Web($config);
            
            // 参考链接：https://docs.open.alipay.com/api_1/alipay.trade.page.pay
            $result = $pay->apply([
                'out_trade_no' => time(), // 商户订单号
                'total_amount' => '0.01',    // 支付金额
                'subject'      => '支付订单描述', // 支付订单描述
            ]);
            
            echo $result; // 直接输出HTML（提交表单跳转)
            
        } catch (Exception $e) {

            // 异常处理
            echo $e->getMessage();
            
        }
    }
    //支付宝手机支付
    public function zhifu3(){
        $config = Config::get('zhifubao');
        // 参考公共参数  https://docs.open.alipay.com/203/107090/
        $config['notify_url'] = 'http://pay.thinkadmin.top/test/alipay-notify.php';
        $config['return_url'] = 'http://pay.thinkadmin.top/test/alipay-success.php';

        try {

            // 实例支付对象
            $pay = \We::AliPayWap($config);
            // $pay = new \AliPay\Wap($config);

            // 参考链接：https://docs.open.alipay.com/api_1/alipay.trade.wap.pay
            $result = $pay->apply([
                'out_trade_no' => time(), // 商户订单号
                'total_amount' => '1',    // 支付金额
                'subject'      => '支付订单描述', // 支付订单描述
            ]);

            echo $result; // 直接输出HTML（提交表单跳转)

        } catch (Exception $e) {

            // 异常处理
            echo $e->getMessage();

        }
    }
    
    //小程序获取session_key和openid等
    public function getsession(){
        try {
            $code = '061hqPzj0xgnuo1OIlyj09WWzj0hqPz3';  //易考帮code 知易的配置--！
           
            $wechat = new \WeMini\Crypt(Config::get('wx'));
            
            
            $data = $wechat->session($code);
            dump($data);
           

        } catch (Exception $e) {
            //file_put_contents('error.log',$e->getMessage(). PHP_EOL);
            // 出错啦，处理下吧
            echo $e->getMessage() . PHP_EOL;

        }
    }
    //分页接口
    public function fy(){
        $page =input('page')?input('page'):1;
        $pageSize =input('limit')?input('limit'):1;
        $keyword = input('post.key');
          if (!empty($keyword)) {
              if(intval($keyword) == 0){
                $map['name'] = array(
                    'like',
                    '%' . $keyword . '%'
                );
              }else{
                $map['tel'] = array(
                    'like',
                    '%' . $keyword . '%'
                );
              }

          }
        $map['article_manager_uuid'] = 'C1E046DFB12C';
        // 查询状态为1的用户数据 并且每页显示10条数据
        //$pageSize =input('limit')?input('limit'):config('pageSize');
        // $pageSize = 2;
        // $page = 2;
        $list = Db::name('ykb_article_enclosure')->where($map)->paginate(array('list_rows'=>$pageSize,'page'=>$page))->toArray();
        // 把分页数据赋值给模板变量list
        // $this->assign('list', $list);
        // 渲染模板输出
        $code = '200';
        $data = $list['data'];
        $total = $list['total'];
        echo JsonRes($code,$data,$token,$total);
    }
    //队列应用
    public function addqueue(){
      
      // 1.当前任务将由哪个类来负责处理。 
      //   当轮到该任务时，系统将生成一个该类的实例，并调用其 fire 方法
      $jobHandlerClassName  =  'app\index\job\Queueserver'; 
      // 2.当前任务归属的队列名称，如果为新队列，会自动创建
      $jobQueueName       = "helloJobQueue"; 
      // 3.当前任务所需的业务数据 . 不能为 resource 类型，其他类型最终将转化为json形式的字符串
      //   ( jobData 为对象时，需要在先在此处手动序列化，否则只存储其public属性的键值对)
      $jobData            = [ 'name' => 'jason', 'secret' => time() , 'a' => 1 ] ;
      // 4.将该任务推送到消息队列，等待对应的消费者去执行
      $isPushed = Queue::push( $jobHandlerClassName , $jobData , $jobQueueName );   
      // database 驱动时，返回值为 1|false  ;   redis 驱动时，返回值为 随机字符串|false
      if( $isPushed !== false ){  
          echo date('Y-m-d H:i:s') . " a new Hello Job is Pushed to the MQ"."<br>";
      }else{
          echo 'Oops, something went wrong.';
      }
    }
    


     

}
