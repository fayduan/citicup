
window.onload = function(){
    $('#choose').modal('hide');
    var teacher_count = $('#teacher_count').val();
    $('#tchinfo').hide();
    if(teacher_count>1){
        $('#addteacher').hide();
        $('#teacher').hide();
        document.getElementById("info").innerHTML= '指导老师人数已达上限。';
        $('#tchinfo').show();
    }
}
var flag=0;
function checkid(){
    var　sId = formaddm.id_num.value;
    flag=0;
    //alert(sId);
    var aCity = { 11: "北京", 12: "天津", 13: "河北", 14: "山西", 15: "内蒙古", 21: "辽宁", 22: "吉林", 23: "黑龙江 ", 31: "上海", 32: "江苏", 33: "浙江", 34: "安徽", 35: "福建", 36: "江西", 37: "山东", 41: "河南", 42: "湖北 ", 43: "湖南", 44: "广东", 45: "广西", 46: "海南", 50: "重庆", 51: "四川", 52: "贵州", 53: "云南", 54: "西藏 ", 61: "陕西", 62: "甘肃", 63: "青海", 64: "宁夏", 65: "新疆", 71: "台湾", 81: "香港", 82: "澳门", 91: "国外 " }
    var iSum = 0;
    var info = "";
    sId = sId.replace(/x$/i, "a");
    if (aCity[parseInt(sId.substr(0, 2))] == null){
        flag=1;
    }
    sBirthday = sId.substr(6, 4) + "-" + Number(sId.substr(10, 2)) + "-" + Number(sId.substr(12, 2));
    var d = new Date(sBirthday.replace(/-/g, "/"))
    if (sBirthday != (d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate())){
        flag=1;
    }
    for (var i = 17; i >= 0; i--) iSum += (Math.pow(2, i) % 11) * parseInt(sId.charAt(17 - i), 11)
    if (iSum % 11 != 1){
        flag=1;
    }
    if(flag==1){
        $('#id_info').text("身份证号有误");
        $('#id_num').focus();
        return false;
    }
    //alert(aCity[parseInt(sId.substr(0, 2))] + "," + sBirthday + "," + (sId.substr(16, 1) % 2 ? "男" : "女"));
    flag=0;
    $('#id_info').text("");
    return true;
}

function checkadd(){

    if(flag==1){
        alert('请输入正确的身份证号。');
        return false;
    }

    return true;
}