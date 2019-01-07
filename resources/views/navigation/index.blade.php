<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="Bookmark" href="/favicon.ico" >
    <link rel="Shortcut Icon" href="/favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="lib/html5shiv.js"></script>
    <script type="text/javascript" src="lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/Huiadmin/static/h-ui/css/H-ui.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/Huiadmin/static/h-ui.admin/css/H-ui.admin.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/Huiadmin/lib/Hui-iconfont/1.0.8/iconfont.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/Huiadmin/static/h-ui.admin/skin/default/skin.css') }}" id="skin" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/Huiadmin/static/h-ui.admin/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/css/page.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/css/boxImg.css') }}">
    <script type="text/javascript" src="{{ URL::asset('/Huiadmin/lib/jquery/1.9.1/jquery.min.js') }}"></script>
    <!--[if IE 6]>
    <script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <!--/meta 作为公共模版分离出去-->

    <title>活动管理</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
</head>
<body>

@if (Session::has('edit_status'))
    <script type="text/javascript">
        $(function(){
            layer.open({
                content: "{{ Session::get('edit_status') }}",
                yes: function(index, layero){
                    parent.$( "#btn-success" ).trigger( "click" );
                    layer.close(index); //如果设定了yes回调，需进行手工关闭
                    parent.$(".layui-layer-shade").remove();
                    parent.$(".layui-layer-iframe").remove();
                }
            });
        });
    </script>
@endif

<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 导航网 <span class="c-gray en">&gt;</span> 域名管理 <a class="btn btn-success radius r" id="btn-success" style="line-height:1.6em;margin-top:3px" href="javascript:void(0)" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="text-c">
        <span class="select-box inline">
            <select name="navigation_type" class="select" id="navigation_type">
                <option value="">类别</option>
                <option value="1" <?php if($navigation_type == 1){ echo "selected='selected'"; } ?>>前台</option>
                <option value="3" <?php if($navigation_type == 3){ echo "selected='selected'"; } ?>>代理</option>
                <option value="5" <?php if($navigation_type == 5){ echo "selected='selected'"; } ?>>全讯网</option>
                <option value="6" <?php if($navigation_type == 6){ echo "selected='selected'"; } ?>>导航网</option>
                <option value="4" <?php if($navigation_type == 4){ echo "selected='selected'"; } ?>>服务项目导航</option>
            </select>
        </span>
        <input type="text" name="" id="navigation_name" value="{{ $navigation_name }}" placeholder="https://" style="width:250px" class="input-text">
        <button name="" id="btn-search" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜域名</button>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l">
            <a href="javascript:;" id="delall" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
            <a class="btn btn-primary radius" data-title="添加活动" id="add" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加域名</a>
            <input type="text" name="" value="" id="old_url" style="width:250px" class="input-text">
	    替换为
	    <input type="text" name="" value="" id="new_url" style="width:250px" class="input-text">
	    <a class="btn btn-primary radius" data-title="批量替换" id="change_url" href="javascript:;">批量替換</a>
	</span>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort table-r
        esponsive dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
            <thead>
            <tr class="text-c" role="row">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="20">ID</th>
                <th width="80">域名类型</th>
                <th width="80">域名</th>
                <?php if($navigation_type == 4){ ?>
                <th width="80">标题</th>
                <?php } ?>
                <th width="120">操作</th>
            </tr>
            </thead>
            <tbody>
                @forelse ($navigation_info as $val)
                <tr class="text-c">
                    <td><input type="checkbox" value="{{ $val->n_id }}" class="ckb"></td>
                    <td>{{ $val->n_id }}</td>
                    <td>
                        @if ($val->n_type == 1)
                            前台域名
                        @elseif ($val->n_type == 3)
                            代理域名
                        @elseif ($val->n_type == 4)
                            服务项目导航
                        @elseif ($val->n_type == 5)
                            全讯网
                        @elseif ($val->n_type == 6)
                            导航网
                        @endif
                    </td>
                    <td>{{ $val->n_url }}</td>
                    <?php if($navigation_type == 4){ ?>
                    <td>{{ $val->n_remark }}</td>
                    <?php } ?>
                    <td class="f-14 td-manage">
                        <a style="text-decoration:none" href="javascript:;"  data-id="{{ $val->n_id }}" data_sort="{{ $val->n_weight }}" is_type="1" title="上移" class="move"><i class="Hui-iconfont">&#xe6dc;</i></a>&nbsp;&nbsp;
                        <a style="text-decoration:none" href="javascript:;"  data-id="{{ $val->n_id }}" data_sort="{{ $val->n_weight }}" is_type="0" title="下移" class="move"><i class="Hui-iconfont">&#xe6de;</i></a>
                        <a style="text-decoration:none" class="ml-5 edit" data-id="{{ $val->n_id }}" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
                        <a style="text-decoration:none" class="ml-5 del" data-id="{{ $val->n_id }}" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
                    </td>
                </tr>
                @empty
                <tr class="text-c">
                    <td colspan="20">No posts found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $navigation_info->appends(request()->all())->links() }}
    </div>
</div>
<script type="text/javascript" src="{{ URL::asset('/js/boxImg.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/Huiadmin/lib/layer/2.4/layer.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/Huiadmin/static/h-ui/js/H-ui.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/Huiadmin/static/h-ui.admin/js/H-ui.admin.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/Huiadmin/static/h-ui.admin/js/H-ui.admin.page.js') }}"></script>
<script type="text/javascript">
    $(function(){
        $('#btn-success').click(function(){
            window.location.reload();
        });

	// 批量替換（检查域名操作）
        $('#change_url').bind('click', function(){
            var old_url = $('#old_url').val();
            var new_url = $('#new_url').val();
            var url = '/navigation_changeUrl';
            var data = {'old_url':old_url, 'active':'search'};
            $.post(url, data, function(xhr){ //检查域名合法性
                if(xhr == 'ok'){
                    layer.open({
                        content: '是否确定替换！'
                        ,btn: ['是的', '算了']
                        ,yes: function(index, layero){
                            data = {'old_url':old_url, 'new_url':new_url, 'active':'change'};
			    $.post(url, data, function(e){
			        layer.open({
				    content: '替换成功！'
				    ,btn: ['好的']
				    ,yes: function(index, layero){
				    	layer.close(index);
					window.location.reload();
				    }
				});
			    });
			}
                    });
                }else{
                    layer.open({
                        content: '暂无此域名，请确认需要替换的域名！'
                        ,btn: ['好的']
                        ,yes: function(index, layero){
                            layer.close(index);
                        }
                    });
                }
            });
        });

	// 域名替换
	function chageUrl(old_url,new_url){
	    var url = '/navigation_changeUrl';
	    var data = {'active':'change','old_url':old_url,'new_url':new_url};
	    $.post(url.data,function(e){
		console.log(e);
	    });
	}

        // 添加
        $('#add').click(function(){
            var url = '/navigation_add';
            var title = '添加导航域名';
            layer_show(title, url, '800', '300');
        });

        // 批量删除
        $('#delall').click(function(){
            var ids = '';
            $(".ckb").each(function () {
                if ($(this).is(':checked')) {
                    ids += ',' + $(this).val(); //逐个获取id
                }
            });
            var ids = ids.substring(1);
            var url = '/navigation_del';
            var data = {'id':ids};
            layer.open({
                content: '确认要删除？'
                ,btn: ['是的', '算了']
                ,yes: function(index, layero){
                    $.post(url, data, function(xhr){
                        layer.confirm(xhr.res_desc, {
                            btn: ['好的'] //可以无限个按钮
                            ,yes: function(index, layero){
                                window.location.reload();
                            }
                        });
                    });
                }
            });
        });

        // 删除
        $('.del').click(function(){
            var id = $(this).attr('data-id');
            var url = '/navigation_del';
            var data = {'id':id};
            layer.open({
                content: '确认要删除？'
                ,btn: ['是的', '算了']
                ,yes: function(index, layero){
                    $.post(url, data, function(xhr){
                        layer.confirm(xhr.res_desc, {
                            btn: ['好的'] //可以无限个按钮
                            ,yes: function(index, layero){
                                window.location.reload();
                            }
                        });
                    });
                }
            });
        });

        // 修改
        $('.edit').bind("click",function(){
            var url = '/navigation_edit'+'?id='+$(this).attr('data-id');
            var title = '修改导航域名';
            layer_show(title, url, '800', '300');
        });

        // 排序 上移 下移
        $('.move').click(function(){
            var id = $(this).attr('data-id');
            var type = $(this).attr('is_type');
            var data_sort = $(this).attr('data_sort');
            var url = '/navigation_move';
            var data = {'id':id,'type':type,'data_sort':data_sort};
            $.post(url, data, function(xhr){
                layer.confirm(xhr.res_desc, {
                    btn: ['好的'] //可以无限个按钮
                    ,yes: function(index, layero){
                        window.location.reload();
                    }
                });
            });
        });

        // 搜索
        $('#btn-search').click(function(){
            var navigation_type = $('#navigation_type').val();
            var navigation_name = $('#navigation_name').val();
            window.location.href = '/navigation_search?navigation_type=' + navigation_type + '&navigation_name=' + navigation_name;
        });
    })
</script>
</body>
</html>

