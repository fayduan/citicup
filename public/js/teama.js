window.onload=function(){
	$("#btn_upload").bind("click",function(){
        $("#upload_modal").show();
    });

    var bar = $('.bar');
    var percent = $('.percent');
    var progress = $(".progress");
    var files = $(".files");
    var btn = $(".btn span");
    var freq = $('#freq').val();
    var state = $('#state');


    files.bind('DOMNodeInserted', function(e) { 
        var content = $(e.target).text();
        var len = (content.toString()).length;
        if(len>500){
            //files.html("请刷新页面重试");
        }
    }); 
    $("#fileupload").change(function(){
        $("#myupload").ajaxSubmit({
            dataType:  'json',
            beforeSend: function() {
                progress.show();
                var percentVal = '0%';
                bar.width(percentVal);
                percent.html(percentVal);
                btn.html("上传中...");
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.width(percentVal);
                percent.html(percentVal);
            },
            success: function(data) {
                files.html("<b>上传成功："+data.name+"("+data.size+"KB)</b>");
                btn.html("选择图片");
            },
            error:function(xhr){
                btn.html("上传失败");
                bar.width('0');
                files.html(xhr.responseText);
            }
        });
    });
}
var tag=1;

function check(){
	var type=formchange.upload.value.match(/^(.*)(\.)(.{1,8})$/)[3];
	type=type.toUpperCase();
	if(type=="JPG" || type=="JPEG" || type=="PNG"){
	   return true;
	}
	else{
	   alert("请选择jpg,jpeg,png类型图片");
	   return false;
	}
}

function delconfirm(){
	if(confirm( '确认删除？ ')==false){
		return false;
	}
	return true;
}

function hideupload(){
	$("#upload_modal").hide();
	//self.location.reload();
	n = Math.random(100);
	var id = $("#team_id").val();
	$("#logo").attr("src","/admin/logo/"+id+"/"+n);
}