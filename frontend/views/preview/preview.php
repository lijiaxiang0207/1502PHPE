<!DOCTYPE HTML>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>简历预览-我的简历-拉勾网-最专业的互联网招聘平台</title>
    <meta content="23635710066417756375" property="qc:admins">
    <meta name="description" content="拉勾网是3W旗下的互联网领域垂直招聘网站,互联网职业机会尽在拉勾网">
    <meta name="keywords"
          content="拉勾,拉勾网,拉勾招聘,拉钩, 拉钩网 ,互联网招聘,拉勾互联网招聘, 移动互联网招聘, 垂直互联网招聘, 微信招聘, 微博招聘, 拉勾官网, 拉勾百科,跳槽, 高薪职位, 互联网圈子, IT招聘, 职场招聘, 猎头招聘,O2O招聘, LBS招聘, 社交招聘, 校园招聘, 校招,社会招聘,社招">

    <meta content="QIQ6KC1oZ6" name="baidu-site-verification">

    <!-- <div class="web_root"  style="display:none">h</div> -->
    </script>
    <
    script
    type = "text/javascript" >
    var ctx = "h";
    console.log(1);
    </script>
    <link href="./home/images/favicon.ico" rel="Shortcut Icon">
    <link href="./home/css/style.css" type="text/css" rel="stylesheet">
    <link href="./home/css/colorbox.min.css" type="text/css" rel="stylesheet">
    <link href="./home/css/popup.css" type="text/css" rel="stylesheet">

    <script type="text/javascript" src="style/js/jquery.1.10.1.min.js"></script>

    <script src="style/js/jquery.colorbox-min.js" type="text/javascript"></script>
    <script>
        $(function () {
            $("body").on("click", "a.btn_s", function () {
                $.colorbox.close();
                parent.jQuery.colorbox.close();
            });
            $(".inline").colorbox({
                inline: true
            });
        });
    </script>
    <script src="style/js/ajaxCross.json" charset="UTF-8"></script>
</head>

<body>
<div id="previewWrapper">
    <div class="preview_header">
        <h1 title="jason的简历">jason的简历</h1>
        <a title="下载简历" class="inline cboxElement" href="#downloadOnlineResume">下载该简历</a>
    </div><!--end .preview_header-->

    <div class="preview_content">
        <div class="profile_box" id="basicInfo">
            <h2>基本信息</h2>
            <div class="basicShow">
                <?php if (empty($data)) { ?>
                    <span>
	                   	jason &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp; 
	                   	男 &nbsp;&nbsp;&nbsp;|    &nbsp;&nbsp;&nbsp;
	                   	大专 &nbsp;&nbsp;&nbsp;| <br>
	                   	3年工作经验&nbsp;&nbsp;<br>
	            		18644444444 &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;
	            		jason@qq.com<br>
	            		我目前已离职，可快速到岗<br>
	            		</span>
                <?php } else { ?>
                    <span>
            			<?php echo $data['re_name'] ?> &nbsp;&nbsp;&nbsp;|  &nbsp;&nbsp;&nbsp;
                        <?php echo $data['re_gender'] ?> &nbsp;&nbsp;&nbsp;|    &nbsp;&nbsp;&nbsp;
                        <?php echo $data['re_topdegree'] ?> &nbsp;&nbsp;&nbsp;| <br>工作经验：
                        <?php echo $data['re_workyear'] ?>&nbsp;&nbsp;&nbsp;<br>联系电话：
                        <?php echo $data['re_tel'] ?> &nbsp;&nbsp;&nbsp;<br>联系邮箱：
                        <?php echo $data['re_email'] ?>&nbsp;&nbsp;&nbsp;<br>简单描述：
                        <?php echo $data['re_currentState'] ?>&nbsp;&nbsp;&nbsp;<br>
            			</span>
                <?php } ?>
            </div><!--end .basicShow-->
        </div><!--end #basicInfo-->

        <div class="profile_box" id="expectJob">
            <h2>期望工作</h2>
            <div class="expectShow">
                <?php if (empty($data_wantwork)) { ?>
                    广州，全职，月薪5k-10k，产品经理
                <?php } else { ?>
                    <?php echo $data_wantwork['wantcity']; ?>,
                    <?php echo $data_wantwork['wanttype']; ?>,
                    <?php echo '月薪' . $data_wantwork['wantmoney']; ?>,
                    <?php echo $data_wantwork['wantposition']; ?>
                <?php } ?>
            </div><!--end .expectShow-->
        </div><!--end #expectJob-->

        <div class="profile_box" id="workExperience">
            <h2>工作经历</h2>
            <div class="experienceShow">
                <ul class="wlist clearfix">
                    <li class="clear">
                        <?php if (empty($data_workexperience)) { ?>
                            <span class="c9">2013.06-至今</span>
                            <div>
                                <p>高级产品经理 </p>
                                <p>上海辉硕科技有限公司</p>
                            </div>
                        <?php } else { ?>
                            <span class="c9">
           						<?php echo $data_workexperience['workstartyear'] . '.' .
                                    $data_workexperience['workstartmonth'];
                                ?>-
                                <?php
                                if ($data_workexperience['workstopyear'] == '至今') {
                                    echo $data_workexperience['workstopyear'];
                                } else {
                                    echo $data_workexperience['workstopyear'] . '.' .
                                        $data_workexperience['workstopyear'];
                                }
                                ?>
           					</span>
                            <div>
                                <p>职位： <?php echo $data_workexperience['positionname']; ?></p>
                                <p>公司： <?php echo $data_workexperience['companyname']; ?></p>
                            </div>
                        <?php } ?>
                    </li>
                </ul>
            </div><!--end .experienceShow-->
        </div><!--end #workExperience-->


        <div class="profile_box" id="projectExperience">
            <h2>项目经验</h2>
            <div class="projectShow">
                <ul class="plist clearfix">
                    <li class="noborder">
                        <div class="projectList">
                            <div class="f16 mb10">
                                <?php if (empty($data_projectexperience)) { ?>
                                    <p>项目名称：你好</p>
                                    <p>担任职位：你好</p>
                                    <p>项目描述：你好</p>
                                    <span class="c9">（2013.06-至今）</span>
                                <?php } else { ?>
                                    <p>项目名称：<?php echo $data_projectexperience['projectname'] ?></p>
                                    <p>担任职位：<?php echo $data_projectexperience['projectposition'] ?></p>
                                    <p>项目描述：<?php echo $data_projectexperience['projectdesc'] ?></p>
                                    <span class="c9">（
                                        <?php echo $data_projectexperience['projectstartyear'] . '.' .
                                            $data_projectexperience['projectstartmonth'];
                                        ?>-
                                        <?php
                                        if ($data_projectexperience['projectstopyear'] == '至今') {
                                            echo $data_projectexperience['projectstopyear'];
                                        } else {
                                            echo $data_projectexperience['projectstopyear'] . '.' .
                                                $data_projectexperience['projectstopyear'];
                                        }
                                        ?>
                                        ）</span>
                                <?php } ?>
                            </div>
                            <div class="dl1"></div>
                        </div>
                    </li>
                </ul>
            </div><!--end .projectShow-->
        </div><!--end #projectExperience-->


        <div class="profile_box" id="educationalBackground">
            <h2>教育背景</h2>
            <div class="educationalShow">
                <ul class="elist clearfix">
                    <li class="clear">
                        <?php if (empty($data_educationbackground)) { ?>
                            <span class="c9">2004-2008</span>
                            <div>
                                <h3>北京大学</h3>
                                <h4>黑客联盟，本科</h4>
                            </div>
                        <?php } else { ?>
                            <span class="c9">
        						<?php echo $data_educationbackground['schoolstartyear'] . '-' .
                                    $data_educationbackground['schoolstopyear'];
                                ?>
        					</span>
                            <div>
                                <h3><?php echo $data_educationbackground['schoolname']; ?></h3><br>
                                <p><?php echo $data_educationbackground['schoolprofessional']; ?></p>
                                <p><?php echo $data_educationbackground['schooldegree']; ?></p>
                            </div>
                        <?php } ?>
                    </li>
                </ul>
            </div><!--end .educationalShow-->
        </div><!--end #educationalBackground-->


        <div class="profile_box" id="selfDescription">
            <h2>自我描述</h2>
            <div class="descriptionShow">
                <?php if (empty($data_descriptself)) {
                    echo '黑客';
                } else {
                    echo $data_descriptself['descriptself'];
                } ?>
            </div><!--end .descriptionShow-->
        </div><!--end #selfDescription-->

        <div class="profile_box" id="worksShow">
            <h2>作品展示</h2>
            <div class="workShow">
                <ul class="slist clearfix">
                    <li class="noborder">
                        <div class="workList c7">
                            <div class="f16">网址：
                                <?php if (empty($data_workdisplay)){ ?>
                                <a target="_blank" href="http://www.weimob.com">
                                    http://www.weimob.com</a>
                            </div>
                            <p>产品 </p>
                            <?php }else{ ?>
                            <a target="_blank" href="<?php echo $data_workdisplay['worklink']; ?>">
                                <?php echo $data_workdisplay['worklink']; ?></a>
                        </div>
                        <p><?php echo $data_workdisplay['workdesc']; ?> </p>
                        <?php } ?>
            </div>
            </li>
            </ul>
        </div><!--end .workShow-->
    </div><!--end #worksShow-->


</div><!--end .preview_content-->
</div><!--end #previewWrapper-->

<!-------------------------------------弹窗lightbox ----------------------------------------->
<div style="display:none;">
    <!-- 下载简历 -->
    <div class="popup" id="downloadOnlineResume">
        <table width="100%">
            <tbody>
            <tr>
                <td class="c5 f18">请选择下载简历格式：</td>
            </tr>
            <tr>
                <td>
                    <a class="btn_s" href="h/resume/downloadResume?key=1ccca806e13637f7b1a4560f80f08057&amp;type=1">word格式</a>
                    <a class="btn_s" href="h/resume/downloadResume?key=1ccca806e13637f7b1a4560f80f08057&amp;type=2">html格式</a>
                    <a class="btn_s" href="h/resume/downloadResume?key=1ccca806e13637f7b1a4560f80f08057&amp;type=3">pdf格式</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div><!--/#downloadOnlineResume-->
</div>
<!------------------------------------- end ----------------------------------------->


<div id="cboxOverlay" style="display: none;"></div>
<div id="colorbox" class="" role="dialog" tabindex="-1" style="display: none;">
    <div id="cboxWrapper">
        <div>
            <div id="cboxTopLeft" style="float: left;"></div>
            <div id="cboxTopCenter" style="float: left;"></div>
            <div id="cboxTopRight" style="float: left;"></div>
        </div>
        <div style="clear: left;">
            <div id="cboxMiddleLeft" style="float: left;"></div>
            <div id="cboxContent" style="float: left;">
                <div id="cboxTitle" style="float: left;"></div>
                <div id="cboxCurrent" style="float: left;"></div>
                <button type="button" id="cboxPrevious"></button>
                <button type="button" id="cboxNext"></button>
                <button id="cboxSlideshow"></button>
                <div id="cboxLoadingOverlay" style="float: left;"></div>
                <div id="cboxLoadingGraphic" style="float: left;"></div>
            </div>
            <div id="cboxMiddleRight" style="float: left;"></div>
        </div>
        <div style="clear: left;">
            <div id="cboxBottomLeft" style="float: left;"></div>
            <div id="cboxBottomCenter" style="float: left;"></div>
            <div id="cboxBottomRight" style="float: left;"></div>
        </div>
    </div>
    <div style="position: absolute; width: 9999px; visibility: hidden; display: none;"></div>
</div>
</body>
</html>