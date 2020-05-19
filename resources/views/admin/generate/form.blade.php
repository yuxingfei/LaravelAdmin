@extends('admin.public.base')

@section('content')
@include('admin.public.content_header')

<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">

                <!-- 表单头部 -->
                <div class="box-header with-border">
                    <div class="btn-group">
                        <a class="btn flat btn-sm btn-default BackButton">
                            <i class="fa fa-arrow-left"></i>
                            返回
                        </a>
                    </div>
                </div>

                <form id="dataForm" class="form-horizontal dataForm" action="formField" method="post"
                      enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="form_name" class="col-sm-2 control-label">名称</label>
                            <div class="col-sm-10 col-md-4">
                                <input maxlength="50" id="form_name" autocomplete="off" name="form_name"
                                       class="form-control" placeholder="请输入名称">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field_name" class="col-sm-2 control-label">字段</label>
                            <div class="col-sm-10 col-md-4">
                                <input maxlength="50" id="field_name" autocomplete="off" name="field_name"
                                       class="form-control" placeholder="请输入字段">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="form_type" class="col-sm-2 control-label">类型</label>
                            <div class="col-sm-10 col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                    <select class="form-control select2 form-type-select" id="form_type"
                                            name="form_type">
                                        <option value="text">文本[text]</option>
                                        <option value="number">数字[number]</option>
                                        <option value="password">密码[password]</option>
                                        <option value="mobile">手机号[mobile]</option>
                                        <option value="email">邮箱[email]</option>
                                        <option value="id_card">身份证号[id_card]</option>
                                        <option value="url">网址[url]</option>
                                        <option value="ip">IP地址[ip]</option>
                                        <option value="textarea">文本域[textarea]</option>
                                        <option value="checkbox">复选[checkbox]</option>
                                        <option value="switch">开关[switch]</option>
                                        <option value="radio">单选[radio]</option>
                                        <option value="select">选择列表[select]</option>
                                        <option value="multi_select">多项选择列表[multi-select]</option>
                                        <option value="image">图片上传[image]</option>
                                        <option value="multi_image">多图上传[multi-image]</option>
                                        <option value="file">文件上传[file]</option>
                                        <option value="multi_file">多文件上传[multi-file]</option>
                                        <option value="date">日期[date]</option>
                                        <option value="date_range">日期范围[date-range]</option>
                                        <option value="datetime">日期时间[datetime]</option>
                                        <option value="datetime_range">日期时间范围[datetime-range]</option>
                                        <option value="year">年[year]</option>
                                        <option value="year_range">年范围[year-range]</option>
                                        <option value="year_month">年月[year-month]</option>
                                        <option value="year_month_range">年月范围[year-month-range]</option>
                                        <option value="map">地图选点[map]</option>
                                        <option value="color">颜色选择[color]</option>
                                        <option value="icon">图标选择[icon]</option>
                                        <option value="editor">富文本编辑器[editor]</option>
                                        {{--<option value="province_city_district">省市区[三级联动]</option>--}}
                                    </select>
                                </div>
                            </div>
                        </div>

                        <script>
                            $('#form_type').select2();
                        </script>

                    </div>
                    <div class="box-footer">
                        @csrf
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-10 col-md-4">
                            <div class="btn-group">
                                <button type="submit" class="btn flat btn-info dataFormSubmit">
                                    生成
                                </button>
                            </div>
                            <div class="btn-group">
                                <button type="reset" class="btn flat btn-default dataFormReset">
                                    重置
                                </button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">生成结果</h3>

                </div>
                <div class="box-body">
                    <textarea id="code" style="width: 100%" placeholder="生成结果" rows="6"></textarea>
                </div>
                <div class="box-footer">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-10 col-md-4">
                        <div class="btn-group">
                            <button class="clipboard-btn btn flat btn-info" data-clipboard-target="#code">
                                复制到剪切板
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

</section>

<script>
    // button的class的值
    var clipboardDemos = new ClipboardJS('.clipboard-btn');
    clipboardDemos.on('success', function (e) {
        e.clearSelection();
        console.info('Action:', e.action);
        console.info('Text:', e.text);
        console.info('Trigger:', e.trigger);
        layer.msg('复制成功');
    });
    clipboardDemos.on('error', function (e) {
        console.error('Action:', e.action);
        console.error('Trigger:', e.trigger);
        console.log('复制失败');
    });
</script>

<script>
    $(function () {

        /**
         * ajax表单提交
         */
        $(".dataForm").submit(function (e) {
                e.preventDefault();
                var loadT = layer.msg('正在提交，请稍候…', {icon: 16, time: 0, shade: [0.3, "#000"]});
                var form_action = $(this).attr('action');
                var form_method = $(this).attr('method');
                var form_data = new FormData($(this)[0]);
                console.log('%cajax submit start!', ';color:#333333');
                console.log('action:' + form_action);
                console.log('method:' + form_method);
                console.log('data:' + form_data);
                $.ajax({
                        url: form_action,
                        dataType: 'json',
                        type: form_method,
                        data: form_data,
                        contentType: false,
                        processData: false,
                        success: function (result) {
                            layer.close(loadT);
                            layer.msg(result.msg, {
                                icon: result.code ? 1 : 2
                            });
                            console.log('submit success!');
                            if (result.code === 1) {
                                addCode(result.data);
                                console.log('%cresult success', ';color:#00a65a');
                            } else {
                                addCode('');
                                console.log('%cresult fail', ';color:#f39c12');
                            }

                        },
                        error: function (xhr, type, errorThrown) {
                            //异常处理；
                            console.log('%csubmit fail!', ';color:#dd4b39');
                            console.log();
                            console.log("type:" + type + ",readyState:" + xhr.readyState + ",status:" + xhr.status);
                            console.log("url:" + form_action);
                            console.log("data:" + form_data);
                            layer.close(loadT);
                            layer.msg('访问错误,代码' + xhr.status, {icon: 2});
                        }
                    }
                );
                return false;
            }
        );
    });

    function addCode(code) {
        //$('#code').html(code);
        $('#code').val(code);
    }


</script>

@endsection

