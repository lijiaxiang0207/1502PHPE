<div id="header">
    <div class="wrapper">
        <a href="?r=index/index" class="logo">
            <img src="./home/images/logo.png" width="229" height="43" alt="拉勾招聘-专注互联网招聘"/>
        </a>
        <ul class="reset" id="navheader">
            <li class="current"><a href="?r=index/index">首页</a></li>
            <li><a href="?r=index/companylist">公司</a></li>
            <li><a href="#" target="_blank">论坛</a></li>
            <?php $session = Yii::$app->session;
            if (!empty($session['email'])) { ?>

                <?php if ($session['type'] == 0) { ?>
                    <li><a href="?r=resume/resume" rel="nofollow">我的简历</a></li>
                <?php } else { ?>
                    <li><a href="?r=create/index" rel="nofollow">发布职位</a></li>
                <?php }
            } ?>
        </ul>
        <?php
        $session = Yii::$app->session;

        if (empty($session['email'])) { ?>

            <ul class="loginTop">
                <li><a href="?r=login/index">登录</a></li>
                <li>|</li>
                <li><a href="?r=login/register">注册</a></li>
            </ul>

            <?php
        } else {

            ?>
            <dl class="collapsible_menu">
                <dt>
                    <span><?= $session['email']; ?>&nbsp;</span>
                    <span class="red dn" id="noticeDot-1"></span>
                    <i></i>
                </dt>

                <?php
                if ($session['type'] == 1) { ?>
                    <dd><a href="?r=fcreate/index">我发布的职位</a></dd>
                    <dd><a href="?r=fcompany/jianli-list">我收到的简历</a></dd>
                    <dd class="btm"><a href="?r=fcompany/index01">我的公司主页</a></dd>
                    <?php

                } else {
                    ?>

                    <dd><a href="http://localhost/sixgroup/web/index.php?r=findex/index">我要找工作</a></dd>

                    <?php
                }

                ?>
                <dd><a href="?r=login/res">帐号设置</a></dd>
                <dd class="logout"><a rel="nofollow" href="?r=login/out">退出</a></dd>
            </dl>
            <?php

        }
        ?>
    </div>
</div>