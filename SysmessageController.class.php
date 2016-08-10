<?php
/**
 *
 * @authors Gemini
 * @date    2014-09-14 15:24:00
 * @version 3.0
 * annotation 系统消息
 */
namespace Admin\Controller;

class SysmessageController extends ShareController
{

    private $pageInfo = array('path_one' => '推送管理', 'path_two' => '', 'small' => '系统消息、商机推荐', 'menu' => 6);

    //发送页面
    public function sendPage()
    {
        $area = M('area');
        $this->pageInfo['path_two'] = '系统消息';
        $this->assign($this->pageInfo);
        $province = $area->where('parent_id=0')->select();
        $this->assign('province', $province);
        $this->display();
    }

    //发送系统消息
    public function send()
    {
        $this->checkUserOperating();
        // ------------------------新加字段
        $role = I('role');
        $time_limit = I('time_limit');
        $phone = I('phone');
        $cityId = I('city');
        $provinceId = I('province');
        $submitVal = I('submit_bt', 0);
        $type = I('type', 0);
        $jump_url = I('jump_url', '');


        if (empty($this->param['content'])) {
            $this->error('请填写消息内容', '', 3);
        }
        if ($type == 2 && empty($jump_url)) {
            $this->error('请填写URL', '', 3);
        } else {
            $sys = M('sys_mess');
            $area = M('area');
            //系统消息缩略图目录
            /*$path = 'sysMsg/';
            $up_result = uploadImg($path, 0, $_FILES, false);

            if( isset($up_result['success']['img']['savename']) )
            {
                $data['thumb_image'] = "/Uploads/".$up_result['success']['img']['savepath'].$up_result['success']['img']['savename'];
            }else{
                $this->error('图片上传失败','',3); die();
            }*/
            if (!empty($provinceId)) {
                $data['province_id'] = $provinceId;

            }
            if (!empty($cityId)) {
                $data['city_id'] = $cityId;

            }


            $data['content'] = $this->param['content'];

            // ------------------------新加字段
            $data['jump_url'] = $jump_url;
            $data['type'] = $type;
            $data['role'] = $role;
            $data['phone'] = $phone;
            $data['time_limit'] = $time_limit;

            //------------------------新加字段
            $data['time'] = time();

            $result = $sys->add($data);
            if ($result) {
                $this->success('消息已添加到推送列队', '', 3);
                //操作日志
                $logStr = session('USER_NAME') . ' 系统消息列表 发送系统消息 ，操作时间:' . date('Y-m-d H:i:s', time());
                $log = array(
                    'uid' => session('USER_AUTH_KEY'),
                    'type' => 2,
                    'log' => $logStr,
                    'openTime' => time(),
                );
                $this->saveManageLog($log);
                ////////////////////////////
            } else {
                $this->error('发送失败', '', 3);
            }
        }
    }


    /* 商机推送列表 */
    public function pushList()
    {
        $push = M('push');
        //分页
        $count = $push->count();
        $page = new \Think\Page($count, 20);
        $show = $page->show();

        //查询结果
        $list = $push->limit($page->firstRow . ',' . $page->listRows)->order('push_time desc')->select();

        // 查询参数
        //$Page->parameter = "key=".urlencode(value)."&";

        $this->assign("list", $list);
        $this->assign("page", $show);

        $this->pageInfo['path_two'] = '商机推送列表';
        $this->assign($this->pageInfo);

        $this->display();
    }

    /* 活动推送列表页面 */
    public function activeList()
    {
        $area = M('area');
        $province = $area->where('parent_id=0')->select();
        $this->assign('province', $province);
        $this->display();
    }

    /* 活动推送 */
    public function activePush()
    {
        $this->checkUserOperating();
        // ------------------------新加字段
        $role = I('role');
        $post_data['city'] = I('city');
        $post_data['province'] = I('province');
        $type = I('type', 0);
        $link = I('link', '');

        if (empty($this->param['content'])) {
            $this->error('请填写消息内容', '', 3);
        } else {
            $post_data['content'] = $this->param['content'];
        }

        if (empty($link)) {
            $this->error('请填写URL', '', 3);
        } else {
            $post_data['link'] = urlencode($link);
        }

        $url = "http://192.168.0.119:8080/PushAPI/push/marketLink";
        $res = $this->request_post($url, $post_data);
        echo '<pre>';
        print_r($res);

    }


    /* 添加关键字 */
    public function addKey()
    {
        $this->checkUserOperating();
        $keyword = I('pushKey');
        $buyId = I('id');
        if (!is_numeric($buyId) || empty($buyId)) {
            echo json_encode(array('status' => 0, 'msg' => '参数错误'));
        } elseif (!empty($keyword)) {
            $arr = explode(',', str_replace('，', ',', $keyword));
            $data = array();
            foreach ($arr as $v) {
                $v = trim($v);
                if (empty($v)) {
                    echo json_encode(array('status' => 0, 'msg' => '关键字不能空'));
                    exit;
                }
                $checkRe = preg_match('((?=[\x21-\x7e]+)[^A-Za-z0-9])', $v);
                if ($checkRe) {
                    echo json_encode(array('status' => 0, 'msg' => '关键字不能包含特殊字符'));
                    exit;
                }
                $data[] = array('buy_id' => $buyId, 'keyword' => $v);
            }
            $buyKey = M('buy_key');
            $result = $buyKey->addAll($data);
            if ($result) {
                $buy = M('buy');
                $buy->where('buy_id=' . $buyId)->save(array('is_audit' => 0));
                echo json_encode(array('status' => 1, 'msg' => '添加成功'));
                //操作日志
                $buy = M('buy');
                $log_data = $buy->where('buy_id=' . $buyId)->find();
                $logStr = session('USER_NAME') . '采购列表 提交 ' . $log_data['title'] . ' 关键词，操作时间:' . date('Y-m-d H:i:s', time());
                $log = array(
                    'uid' => session('USER_AUTH_KEY'),
                    'type' => 5,
                    'log' => $logStr,
                    'openTime' => time(),
                );
                $this->saveManageLog($log);
                ///////////////////////////////////
            } else {
                echo json_encode(array('status' => 0, 'msg' => '添加失败'));
            }
        } else {
            echo json_encode(array('status' => 0, 'msg' => '请填写正确关键字'));
        }
    }


    //根据关键字推送
    public function pushByKey()
    {
        $this->checkUserOperating();
        $buyId = I('id');
        if (!is_numeric($buyId) || !empty($buyId)) {
            $data['buy_id'] = $buyId;
            $data['push_status'] = 2;
            $data['is_audit'] = 0;

            $buy = M('buy');
            $result = $buy->save($data);
            if ($result) {
                echo json_encode(array('status' => 1, 'msg' => '推送成功'));
                //操作日志
                $product = M('buy');
                $log_data = $product->where('buy_id=' . $buyId)->find();
                $logStr = session('USER_NAME') . '采购列表 推送采购信息 ' . $log_data['title'] . '，操作时间:' . date('Y-m-d H:i:s', time());
                $log = array(
                    'uid' => session('USER_AUTH_KEY'),
                    'type' => 5,
                    'log' => $logStr,
                    'openTime' => time(),
                );
                $this->saveManageLog($log);
                ///////////////////////////////////
            } else {
                echo json_encode(array('status' => 0, 'msg' => '推送失败'));
            }
        } else {
            echo json_encode(array('status' => 0, 'msg' => '参数错误'));
        }
    }

    //待推送信息列表
    public function pushByKeyList()
    {
        $type = I('type', 1);
        $params['type'] = $type;
        $keyType = I('keyType');
        $keyword = I('keyword');
        $audit = 0;
        $status = 0;
        $del_status = 1;
        if (!empty($keyType)) {
            if ($keyType == 1) {
                $where['b.remark'] = array('like', '%' . $keyword . '%');
            } else {
                $where['u.name'] = array('like', '%' . $keyword . '%');
            }
            $params['keyType'] = $keyType;
            $params['keyword'] = $keyword;
        }
        if ($audit !== '') {
            $where['b.is_audit'] = $audit;
            $params['audit'] = $audit;
        }
        if ($status !== '') {
            $where['b.status'] = $status;
            $params['status'] = $status;
        }
        if (!empty($del_status)) {
            $where['b.del_status'] = $del_status;
            $params['del_status'] = $del_status;
        }
        $buy = M("buy b");
        //$where['b.type'] = $type;
        $where['b.push_status'] = 1;
        $lastTime = time() - 604800;
        $where['b.alter_time'] = array('gt', $lastTime);

        //分页
        $count = $buy->where($where)->join("sb_user u ON u.user_id=b.user_id", "LEFT")->count();
        $page = new \Think\Page($count, 20);
        $page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $page->parameter = $params;
        $show = $page->show();

        //查询结果
        $list = $buy->where($where)->join("sb_user u ON u.user_id=b.user_id", "LEFT")->limit($page->firstRow . ',' . $page->listRows)->field('u.name as name,b.*')->order('b.alter_time desc')->select();


        // 查询参数
        //$Page->parameter = "key=".urlencode(value)."&";

        $this->assign("list", $list);
        $this->assign("page", $show);
        $this->params = $params;
        $this->pageInfo['path_two'] = '待推送信息列表';
        $this->assign($this->pageInfo);

        $this->display();
    }

    /*
     * 模拟post进行url请求
     * @param string $url
     * @param string $param
     */
    function request_post($url = '', $param = '')
    {
        if (empty($url) || empty($param)) {
            return false;
        }
        $postUrl = $url;
        $curlPost = $param;
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL, $postUrl);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch);//运行curl
        curl_close($ch);

        return $data;
    }

    // 添加用户展示
    public function addUserTypePage(){
        $this->display();
    }

    /*
     * 添加用户分类
     */
    public function addUserType()
    {
        $this->checkUserOperating();
        $phone = I('phone');
        $description = htmlspecialchars(strip_tags(trim(I('description'))));
        $type = I('typeid');
        if(!preg_match("/^1[34578]{1}\d{9}$/",trim($phone))){
            $responseData = array(
                'status' => 0,
                'msg' => '手机号码格式输入有误!'
            );
            $this->ajaxReturn($responseData,'JSON');
        };
        if(empty($type)){
            $responseData = array(
                'status' => 0,
                'msg' => '请选择用户类型!'
            );
            $this->ajaxReturn($responseData,'JSON');
        };
        if(empty($description)){
            $responseData = array(
                'status' => 0,
                'msg' => '描述不能为空!'
            );
            $this->ajaxReturn($responseData,'JSON');
        };
        $userinfo = M('user')->field('user_id,device')->where(array('phone' => $phone))->find();
//        echo '<pre>';
//        print_r($userinfo);
//        echo '</pre>';
//        exit;
        if($userinfo){
            $user_id = $userinfo['user_id'];
            $device_id = $userinfo['device'];
            //查询user_type_category表有没有数据
            $res = M('user_type_category')->field('type')->where(array('user_id' => $user_id))->find();
            if ($res) {
                if(isset($device_id) && $res['type'] == '0'){
                    $this->addBlackList($device_id);
                }elseif(isset($device_id) && $res['type'] != $type){
                    $data = array(
                        'type' => $type,
                        'update_time' => date('Y-m-d H:i:S', time())
                    );
                    $result = M('user_type_category')->where(array('user_id' => $user_id))->save($data);
                    $responseData = array(
                        'status' => 1,
                        'msg' => '之前添加过，本次更新成功',
                        'data' => $result
                    );
                    $this->ajaxReturn($responseData,'JSON');
                }
            } else {
                //添加类型
                $data = array(
                    'user_id' => $user_id,
                    'phone'   => $phone,
                    'device' => $device_id,
                    'type' => $type,
                    'description' => $description,
                    'update_time' => date('Y-m-d H:i:s', time()),
                    'create_time' => date('Y-m-d H:i:s', time())
                );
                $result = M('user_type_category')->add($data);
                if($result){
                    $responseData = array(
                        'status' => 1,
                        'msg' => '添加成功',
                        'data' => $result
                    );
                    $this->ajaxReturn($responseData,'JSON');
                }
            }
        }else{
            $responseData = array(
                'status' => 0,
                'msg' => '用户尚未注册'
            );
            $this->ajaxReturn($responseData,'JSON');
        }
    }

    /*
     * 根据设备id拉黑所有的关联用户
     * @param int $device_id
     */
    public function addBlackList($device_id)
    {
        if(isset($device_id)){
            $idinfo = M('user_device')->field('user_id')->where(array('device' => $device_id))->select();
            if($idinfo){
                $ids = [];
                foreach($idinfo as $k => $v){
                    $ids[] = $v['user_id'];
                };
                $ids = array_unique($ids);
                foreach ($ids as $v) {
                    $result = $this->modifyUserTypeToBlackList($v);
                    if($result){
                        $deviceinfo = M('user_device')->field('device')->where(array('user_id' => $v))->select();
                        if($deviceinfo){
                            $devices = [];
                            foreach($deviceinfo as $k => $v){
                                $devices[] = $v['device'];
                            };
                            $devices = array_unique($devices);
                            foreach($devices as $sub_v){
                                if($sub_v != $device_id){
                                    $this->addBlackList($sub_v);
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    /*
     * 更改用户类型至黑名单
     * @param int $user_id
     */
    public function modifyUserTypeToBlackList($user_id='')
    {
        //查询user_type_category 表有没有数据
        $res = M('user_type_category')->field('type')->where(array('user_id' => $user_id))->find();
        if(!$res){
            $userinfo = M('user')->field('phone,device')->where(array('user_id' => $user_id))->find();
            $phone = $userinfo['phone'];
            $device_id = $userinfo['device'];
            //添加类型
            $data = array(
                'user_id' => $user_id,
                'phone'   => $phone,
                'device' => $device_id,
                'type' => '0',
                'description' => '移至黑名单',
                'update_time' => date('Y-m-d H:i:s', time()),
                'create_time' => date('Y-m-d H:i:s', time())
            );
            $result = M('user_type_category')->add($data);
            if($result){
                return true;
            }else{
                return false;
            }
        }elseif($res && $res['type'] != 0){
            if($res['type'] != 0){
                $data = array(
                    'type' => '0',
                    'update_time' => date('Y-m-d H:i:S', time())
                );
                $result = M('user_type_category')->where(array('user_id' => $user_id))->save($data);
                if($result){
                    return true;
                }else{
                    return false;
                }
            }
        }elseif($res && $res['type'] == '0'){
            //之前已经拉黑
            return true;
        }
    }

}
