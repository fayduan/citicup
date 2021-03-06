//弹出窗口
	function pop(){
		//将窗口居中
		//makeCenter();
		$('#choose').modal('show');
		//初始化省份列表
		initProvince();

		//默认情况下, 给第一个省份添加choosen样式
		$('[province-id="11"]').addClass('choosen');

		//初始化大学列表
		initSchool(0);
	}

	function popt(){
		//将窗口居中
		//makeCenter();
		$('#choose').modal('show');
		//初始化省份列表
		initProvincet();

		//默认情况下, 给第一个省份添加choosen样式
		$('[province-id="11"]').addClass('choosen');

		//初始化大学列表
		initSchoolt(0);
	}
	//隐藏窗口
	function hide()
	{
		//$('#choose-box-wrapper').css("display","none");
		$('#choose').modal('hide');
	}

	function initProvince()
	{
		//原先的省份列表清空
		$('#choose-a-province').html('');
		for(i=0;i<schoolList.length;i++)
		{
			$('#choose-a-province').append('<a class="province-item" item-id="'+i+'" province-id="'+schoolList[i].id+'">'+schoolList[i].name+'</a>');
		}
		//添加省份列表项的click事件
		$('.province-item').bind('click', function(){
				var item=$(this);
				var province = item.attr('item-id');
				var choosenItem = item.parent().find('.choosen');
				if(choosenItem)
					$(choosenItem).removeClass('choosen');
				item.addClass('choosen');
				//更新大学列表
				initSchool(province);
			}
		);
	}

	function initProvincet()
	{
		//原先的省份列表清空
		$('#choose-a-province').html('');
		for(i=0;i<schoolList.length;i++)
		{
			$('#choose-a-province').append('<a class="province-item" item-id="'+i+'" province-id="'+schoolList[i].id+'">'+schoolList[i].name+'</a>');
		}
		//添加省份列表项的click事件
		$('.province-item').bind('click', function(){
				var item=$(this);
				var province = item.attr('item-id');
				var choosenItem = item.parent().find('.choosen');
				if(choosenItem)
					$(choosenItem).removeClass('choosen');
				item.addClass('choosen');
				//更新大学列表
				initSchoolt(province);
			}
		);
	}

	function initSchool(provinceID)
	{
		//原先的学校列表清空
		$('#choose-a-school').html('');
		var schools = schoolList[provinceID].univs;
		for(i=0;i<schools.length;i++)
		{
			$('#choose-a-school').append('<a class="school-item" school-id="'+schools[i].id+'">'+schools[i].name+'</a>');
		}
		//添加大学列表项的click事件
		$('.school-item').bind('click', function(){
				var item=$(this);
				var school = item.attr('school-id');
				//更新选择大学文本框中的值
				$('#univ_sel').val(school);
				$('#school-name').val(item.text());
				//关闭弹窗
				hide();
			}
		);
	}

	function initSchoolt(provinceID)
	{
		//原先的学校列表清空
		$('#choose-a-school').html('');
		var schools = schoolList[provinceID].univs;
		for(i=0;i<schools.length;i++)
		{
			$('#choose-a-school').append('<a class="school-item" school-id="'+schools[i].id+'">'+schools[i].name+'</a>');
		}
		//添加大学列表项的click事件
		$('.school-item').bind('click', function(){
				var item=$(this);
				var school = item.attr('school-id');
				//更新选择大学文本框中的值
				$('#univ_selt').val(school);
				$('#school-namet').val(item.text());
				//关闭弹窗
				hide();
			}
		);
	}