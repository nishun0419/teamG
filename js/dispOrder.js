function dispOrder(response, date, userid){
	// $("#order_Info").append($("<div class='col-md-10 col-md-offset-1'></div>")
	// 				.append($("<div id='orderbox'></div>")
	// 				.append($("<div class='text-left'></div>")
	// 				.text("日付：" + date))
	// 				.append($("<div class='text-left'></div>")
	// 				.text("施設名：" + response.FacName))
	// 				.append($("<div class='text-left'></div>")
	// 				.text("住所：〒" + response.PostNum + response.Address)))
	// 				);
	$("#fac_name").text(response.FacName);
	$("#address").text("〒"+ response.PostNum + "　" + response.Pref + response.Address);
	$("#order_date").text(date);
	$("#price").text("￥" + separate(response.Price));
	$("#facilityIdent").val(response.UpID);
	$("#userid").val(userid);
	$("#date").val(date);
}