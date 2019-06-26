<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    // +----------------------------------------------------------------------
    // | 应用设置
    // +----------------------------------------------------------------------

    // 应用调试模式
    'app_debug'              => true,
    // 应用Trace
    'app_trace'              => false,
    // 应用模式状态
    'app_status'             => '',
    // 是否支持多模块
    'app_multi_module'       => true,
    // 入口自动绑定模块
    'auto_bind_module'       => false,
    // 注册的根命名空间
    'root_namespace'         => [],
    // 扩展函数文件
    'extra_file_list'        => [THINK_PATH . 'helper' . EXT],
    // 默认输出类型
    'default_return_type'    => 'html',
    // 默认AJAX 数据返回格式,可选json xml ...
    'default_ajax_return'    => 'json',
    // 默认JSONP格式返回的处理方法
    'default_jsonp_handler'  => 'jsonpReturn',
    // 默认JSONP处理方法
    'var_jsonp_handler'      => 'callback',
    // 默认时区
    'default_timezone'       => 'PRC',
    // 是否开启多语言
    'lang_switch_on'         => false,
    // 默认全局过滤方法 用逗号分隔多个
    'default_filter'         => '',
    // 默认语言
    'default_lang'           => 'zh-cn',
    // 应用类库后缀
    'class_suffix'           => false,
    // 控制器类后缀
    'controller_suffix'      => false,

    // +----------------------------------------------------------------------
    // | 模块设置
    // +----------------------------------------------------------------------

    // 默认模块名
    'default_module'         => 'index',
    // 禁止访问模块
    'deny_module_list'       => ['common'],
    // 默认控制器名
    'default_controller'     => 'Index',
    // 默认操作名
    'default_action'         => 'index',
    // 默认验证器
    'default_validate'       => '',
    // 默认的空控制器名
    'empty_controller'       => 'Error',
    // 操作方法后缀
    'action_suffix'          => '',
    // 自动搜索控制器
    'controller_auto_search' => false,

    // +----------------------------------------------------------------------
    // | URL设置
    // +----------------------------------------------------------------------

    // PATHINFO变量名 用于兼容模式
    'var_pathinfo'           => 's',
    // 兼容PATH_INFO获取
    'pathinfo_fetch'         => ['ORIG_PATH_INFO', 'REDIRECT_PATH_INFO', 'REDIRECT_URL'],
    // pathinfo分隔符
    'pathinfo_depr'          => '/',
    // URL伪静态后缀
    'url_html_suffix'        => 'html',
    // URL普通方式参数 用于自动生成
    'url_common_param'       => false,
    // URL参数方式 0 按名称成对解析 1 按顺序解析
    'url_param_type'         => 0,
    // 是否开启路由
    'url_route_on'           => true,
    // 路由使用完整匹配
    'route_complete_match'   => false,
    // 路由配置文件（支持配置多个）
    'route_config_file'      => ['route'],
    // 是否开启路由解析缓存
    'route_check_cache'      => false,
    // 是否强制使用路由
    'url_route_must'         => false,
    // 域名部署
    'url_domain_deploy'      => false,
    // 域名根，如thinkphp.cn
    'url_domain_root'        => '',
    // 是否自动转换URL中的控制器和操作名
    'url_convert'            => true,
    // 默认的访问控制器层
    'url_controller_layer'   => 'controller',
    // 表单请求类型伪装变量
    'var_method'             => '_method',
    // 表单ajax伪装变量
    'var_ajax'               => '_ajax',
    // 表单pjax伪装变量
    'var_pjax'               => '_pjax',
    // 是否开启请求缓存 true自动缓存 支持设置请求缓存规则
    'request_cache'          => false,
    // 请求缓存有效期
    'request_cache_expire'   => null,
    // 全局请求缓存排除规则
    'request_cache_except'   => [],

    // +----------------------------------------------------------------------
    // | 模板设置
    // +----------------------------------------------------------------------

    'template'               => [
        // 模板引擎类型 支持 php think 支持扩展
        'type'         => 'Think',
        // 默认模板渲染规则 1 解析为小写+下划线 2 全部转换小写
        'auto_rule'    => 1,
        // 模板路径
        'view_path'    => '',
        // 模板后缀
        'view_suffix'  => 'html',
        // 模板文件名分隔符
        'view_depr'    => DS,
        // 模板引擎普通标签开始标记
        'tpl_begin'    => '{',
        // 模板引擎普通标签结束标记
        'tpl_end'      => '}',
        // 标签库标签开始标记
        'taglib_begin' => '{',
        // 标签库标签结束标记
        'taglib_end'   => '}',
    ],

    // 视图输出字符串内容替换
    'view_replace_str'       => [],
    // 默认跳转页面对应的模板文件
    'dispatch_success_tmpl'  => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',
    'dispatch_error_tmpl'    => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',

    // +----------------------------------------------------------------------
    // | 异常及错误设置
    // +----------------------------------------------------------------------

    // 异常页面的模板文件
    'exception_tmpl'         => THINK_PATH . 'tpl' . DS . 'think_exception.tpl',

    // 错误显示信息,非调试模式有效
    'error_message'          => '页面错误！请稍后再试～',
    // 显示错误信息
    'show_error_msg'         => false,
    // 异常处理handle类 留空使用 \think\exception\Handle
    'exception_handle'       => '',

    // +----------------------------------------------------------------------
    // | 日志设置
    // +----------------------------------------------------------------------

    'log'                    => [
        // 日志记录方式，内置 file socket 支持扩展
        'type'  => 'File',
        // 日志保存目录
        'path'  => LOG_PATH,
        // 日志记录级别
        'level' => [],
    ],

    // +----------------------------------------------------------------------
    // | Trace设置 开启 app_trace 后 有效
    // +----------------------------------------------------------------------
    'trace'                  => [
        // 内置Html Console 支持扩展
        'type' => 'Html',
    ],

    // +----------------------------------------------------------------------
    // | 缓存设置
    // +----------------------------------------------------------------------

    // 'cache'                  => [
    //     // 驱动方式
    //     'type'   => 'File',
    //     // 缓存保存目录
    //     'path'   => CACHE_PATH,
    //     // 缓存前缀
    //     'prefix' => '',
    //     // 缓存有效期 0表示永久缓存
    //     'expire' => 0,
    // ],
    'cache'                  => [
      'type'   => 'Redis',
      'host'   => '127.0.0.1',
      'port'   => '6379',
      'password' => '',
      'timeout'=> 3600
    ],

    // +----------------------------------------------------------------------
    // | 会话设置
    // +----------------------------------------------------------------------

    'session'                => [
        'id'             => '',
        // SESSION_ID的提交变量,解决flash上传跨域
        'var_session_id' => '',
        // SESSION 前缀
        'prefix'         => 'think',
        // 驱动方式 支持redis memcache memcached
        'type'           => '',
        // 是否自动开启 SESSION
        'auto_start'     => true,
    ],

    // +----------------------------------------------------------------------
    // | Cookie设置
    // +----------------------------------------------------------------------
    'cookie'                 => [
        // cookie 名称前缀
        'prefix'    => '',
        // cookie 保存时间
        'expire'    => 0,
        // cookie 保存路径
        'path'      => '/',
        // cookie 有效域名
        'domain'    => '',
        //  cookie 启用安全传输
        'secure'    => false,
        // httponly设置
        'httponly'  => '',
        // 是否使用 setcookie
        'setcookie' => true,
    ],

    //分页配置
    'paginate'               => [
        'type'      => 'bootstrap',
        'var_page'  => 'page',
        'list_rows' => 15,
    ],
    //微信配置
    // 'wx'  => [
    //     'url' => 'https://api.weixin.qq.com/sns/jscode2session',
    //     'appid' => 'wxe95df82a6fdea541',
    //     'secret' => '7fad3e1f04076ff6befe5aa185e5184f',
    //     'grant_type' => 'yikaobang',
    //     'mch_id'         => "1503263461",
    //     'mch_key'        => 'bdxzz2vwrtlyixn2yhqhmyyzf1vi3b3d'
    // ],
    'wx' => [
        'token'          => 'cmUs4JgNrrQgAn4yOtnMSyrZTTO3a2RR',
        'appid'          => 'wx0c8b05496023af13',
        'appsecret'      => 'ad56f98ddf34a30134fcf460b4a1bcdd',
        'encodingaeskey' => 'MdvOkUbdgdIwKduQfJJJa4bOqkkkJJh4GIIdJ4FvOJF',
        // 配置商户支付参数（可选，在使用支付功能时需要）
        'mch_id'         => "1532571781",
        'mch_key'        => '4HtafGEmXG62FhpNmU9cfVooacomRIQ4',
        // 配置商户支付双向证书目录（可选，在使用退款|打款|红包时需要）
        'ssl_key'        => __DIR__ . DIRECTORY_SEPARATOR . 'cert' . DIRECTORY_SEPARATOR . 'apiclient_key.pem',
        'ssl_cer'        => __DIR__ . DIRECTORY_SEPARATOR . 'cert' . DIRECTORY_SEPARATOR . 'apiclient_cert.pem',
        // 缓存目录配置（可选，需拥有读写权限）
        'cache_path'     => '',


    ],
    'zhifubao' => [
        // 沙箱模式
        'debug'       => true,
        // 应用ID
        'appid'       => '2016090900468879',
        // 支付宝公钥(1行填写)
        'public_key'  => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtU71NY53UDGY7JNvLYAhsNa+taTF6KthIHJmGgdio9bkqeJGhHk6ttkTKkLqFgwIfgAkHpdKiOv1uZw6gVGZ7TCu5LfHTqKrCd6Uz+N7hxhY+4IwicLgprcV1flXQLmbkJYzFMZqkXGkSgOsR2yXh4LyQZczgk9N456uuzGtRy7MoB4zQy34PLUkkxR6W1B2ftNbLRGXv6tc7p/cmDcrY6K1bSxnGmfRxFSb8lRfhe0V0UM6pKq2SGGSeovrKHN0OLp+Nn5wcULVnFgATXGCENshRlp96piPEBFwneXs19n+sX1jx60FTR7/rME3sW3AHug0fhZ9mSqW4x401WjdnwIDAQAB',
        // 支付宝私钥(1行填写)
        'private_key' => 'MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQC3pbN7esinxgjE8uxXAsccgGNKIq+PR1LteNTFOy0fsete43ObQCrzd9DO0zaUeBUzpIOnxrKxez7QoZROZMYrinttFZ/V5rbObEM9E5AR5Tv/Fr4IBywoS8ZtN16Xb+fZmibfU91yq9O2RYSvscncU2qEYmmaTenM0QlUO80ZKqPsM5JkgCNdcYZTUeHclWeyER3dSImNtlSKiSBSSTHthb11fkudjzdiUXua0NKVWyYuAOoDMcpXbD6NJmYqEA/iZ/AxtQt08pv0Mow581GPB0Uop5+qA2hCV85DpagE94a067sKcRui0rtkJzHem9k7xVL+2RoFm1fv3RnUkMwhAgMBAAECggEAAetkddzxrfc+7jgPylUIGb8pyoOUTC4Vqs/BgZI9xYAJksNT2QKRsFvHPfItNt4Ocqy8h4tnIL3GCU43C564B4p6AcjhE85GiN/O0BudPOKlfuQQ9mqExqMMHuYeQfz0cmzPDTSGMwWiv9v4KBH2pyvkCCAzNF6uG+rvawb4/NNVuiI7C8Ku/wYsamtbgjMZVOFFdScYgIw1BgA99RUU/fWBLMnTQkoyowSRb9eSmEUHjt/WQt+/QgKAT2WmuX4RhaGy0qcQLbNaJNKXdJ+PVhQrSiasINNtqYMa8GsQuuKsk3X8TCg9K6/lowivt5ruhyWcP2sx93zY/LGzIHgHcQKBgQDoZlcs9RWxTdGDdtH8kk0J/r+QtMijNzWI0a+t+ZsWOyd3rw+uM/8O4JTNP4Y98TvvxhJXewITbfiuOIbW1mxh8bnO/fcz7+RXZKgPDeoTeNo717tZFZGBEyUdH9M9Inqvht7+hjVDIMCYBDomYebdk3Xqo4mDBjLRdVNGrhGmVQKBgQDKS/MgTMK8Ktfnu1KzwCbn/FfHTOrp1a1t1wWPv9AW0rJPYeaP6lOkgIoO/1odG9qDDhdB6njqM+mKY5Yr3N94PHamHbwJUCmbkqEunCWpGzgcQZ1Q254xk9D7UKq/XUqW2WDqDq80GQeNial+fBc46yelQzokwdA+JdIFKoyinQKBgQCBems9V/rTAtkk1nFdt6EGXZEbLS3PiXXhGXo4gqV+OEzf6H/i/YMwJb2hsK+5GQrcps0XQihA7PctEb9GOMa/tu5fva0ZmaDtc94SLR1p5d4okyQFGPgtIp594HpPSEN0Qb9BrUJFeRz0VP6U3dzDPGHo7V4yyqRLgIN6EIcy1QKBgAqdh6mHPaTAHspDMyjJiYEc5cJIj/8rPkmIQft0FkhMUB0IRyAALNlyAUyeK61hW8sKvz+vPR8VEEk5xpSQp41YpuU6pDZc5YILZLfca8F+8yfQbZ/jll6Foi694efezl4yE/rUQG9cbOAJfEJt4o4TEOaEK5XoMbRBKc8pl22lAoGARTq0qOr9SStihRAy9a+8wi2WEwL4QHcmOjH7iAuJxy5b5TRDSjlk6h+0dnTItiFlTXdfpO8KhWA8EoSJVBZ1kcACQDFgMIA+VM+yXydtzMotOn21W4stfZ4I6dHFiujMsnKpNYVpQh3oCrJf4SeXiQDdiSCodqb1HlKkEc6naHQ=',
        // 支付成功通知地址
        'notify_url'  => '', // 可以应用的时候配置哦
        // 网页支付回跳地址
        'return_url'  => '', // 可以应用的时候配置哦
    ],
];
