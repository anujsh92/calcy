window.addEventListener("load", function(){
	
	var tabs = document.querySelectorAll("ul.nav-tabs li");

	for (var i = 0; i < tabs.length; i++) {
		tabs[i].addEventListener("click", switchTab);
	}

	function switchTab(event){
		event.preventDefault();
		document.querySelector("ul.nav-tabs li.active").classList.remove("active");
		document.querySelector(".tab-pane.active").classList.remove("active");

		var clickedTab = event.currentTarget;
		var anchor = event.target;
		var activePaneID = anchor.getAttribute("href");
		clickedTab.classList.add("active");
		document.querySelector(activePaneID).classList.add("active");
	}


    var overlay = document.getElementById('backgroundOverlay');
    document.onclick = function(e){
        if(e.target.id == 'backgroundOverlay'){
        	var rem_class =  e.target.previousElementSibling.classList[0];
        	var x = document.getElementsByClassName('price_container');
        	for (var i = 0; i < x.length; i++) {
        		x[i].classList.remove("price_ovrlay");
        	}

        	//document.getElementById('price_container').classList.remove("price_ovrlay");
            overlay.style.display = 'none';
            var infoCont = document.querySelectorAll(".info_container");
            for (var d = 0; d < infoCont.length; d++) {
            	infoCont[d].style.display = 'none';
            }
            var infoDiv = document.querySelectorAll(".info_opt");
            for (var m = 0; m < infoDiv.length; m++) {
            	infoDiv[m].style.display = 'none';
            }
            var infoDiv = document.querySelectorAll(".iconedit");
            for (var n = 0; n < infoDiv.length; n++) {
            	infoDiv[n].style.display = 'none';
            }
        }
       
    };


    /* Package Data sorting script on onclick */
	var package_list= null;
	document.getElementById('save_pack_data').onclick = function(e) { 
		var package = document.querySelectorAll(".package_field");
		package_list = {};
		for (var i = 0; i < package.length; i++) {
			var user_price_cont =  package[i].querySelectorAll('.user_price_cont');

			var pack = package[i].getElementsByTagName("input")[0].value;
			package_list[pack] = {};
			for (var j = 0; j < user_price_cont.length; j++) {
				var d = user_price_cont[j].getElementsByTagName('input');
				var user = d[1].value;
				package_list[pack][user] = {};
				package_list[pack][user].price = {};
				package_list[pack][user].price.price_us = d[0].value;
				package_list[pack][user].price.price_dis = d[2].value;
				package_list[pack][user].price.price_fix = d[3].value;
			}
		}


		document.getElementsByName("package_data")[0].value = JSON.stringify(package_list);
		
		//console.log(package_list);

	}



	/* Function and Group Data sorting script on onclick */
	
	var groupFunctionList = null;
	document.getElementById('save_fu_gr_data').onclick = function() { 
		var groupFunc = document.querySelectorAll(".group_drag_drop");
		groupFunctionList = {};
		for (var i = 0; i < groupFunc.length; i++) {
			var functionCount =  groupFunc[i].querySelectorAll('.function_container');
			var group = groupFunc[i].getElementsByTagName("input")[0].value;
			/*var deact_input = groupFunc[i].getElementsByClassName("group_deactive")[0];
			if (deact_input.checked == true) {
				var groupDeact = deact_input.value;
			}else{
				var groupDeact = "0";
			}*/
			groupFunctionList[group] = {};
			//groupFunctionList[group].groupDeactive = groupDeact;
			
			for (var j = 0; j < functionCount.length; j++) {
				var func = functionCount[j].id;
				var funcTitle = functionCount[j].getElementsByClassName('function_title')[0].value;
				var funcText = functionCount[j].getElementsByTagName('textarea')[0].value;
				var funcVideo = functionCount[j].getElementsByTagName('input')[0].value;
				/*var funInDeact = functionCount[j].getElementsByClassName('function_deactive')[0];
				if (funInDeact.checked == true) {
					var functionDeact = deact_input.value;
				}else{
					var functionDeact = "0";
				}*/
				groupFunctionList[group][func] = {};
				groupFunctionList[group][func].functionContent = {};
				groupFunctionList[group][func].functionContent.functionTile = funcTitle;				
				groupFunctionList[group][func].functionContent.functionText = funcText;				
				groupFunctionList[group][func].functionContent.functionVideo = funcVideo;				
				//groupFunctionList[group][func].functionContent.functionDeactivate = functionDeact;				
				var functionPackage = 'functionPackage' ;
				groupFunctionList[group][func][functionPackage]= {};
				var functionColCount =  functionCount[j].querySelectorAll('.function_package_col_count');
				for (var k = 0; k < functionColCount.length; k++) {
					var iconValue = functionColCount[k].getElementsByTagName('input');
					var funcPackCol = functionColCount[k].id;
					groupFunctionList[group][func][functionPackage][funcPackCol] = {};
					for (var l = 0; l < iconValue.length; l++) {
						if (iconValue[l].checked == true) {
							var iconType = 'iconType';
							groupFunctionList[group][func][functionPackage][funcPackCol][iconType] = {};
							groupFunctionList[group][func][functionPackage][funcPackCol][iconType].iconValue = iconValue[l].value;
							var iconEdit 				= iconValue[l].parentNode;
							if (iconEdit.ClassName = 'func_edit') {

								var iconTypeContent = 'iconTypeContent';
								groupFunctionList[group][func][functionPackage][funcPackCol][iconType][iconTypeContent] = {};
								var iconTypeMidContent = 'iconTypeMidContent';
								groupFunctionList[group][func][functionPackage][funcPackCol][iconType][iconTypeContent][iconTypeMidContent] = {};

								var iconEditDivCont 		= iconEdit.querySelectorAll('.iconedit_container');
								for (var m = 0; m < iconEditDivCont.length; m++) {
									var iconMidInput = iconEditDivCont[m].getElementsByTagName('input');
									var user = iconMidInput[1].value;					
									groupFunctionList[group][func][functionPackage][funcPackCol][iconType][iconTypeContent][iconTypeMidContent][user] = {};					
									groupFunctionList[group][func][functionPackage][funcPackCol][iconType][iconTypeContent][iconTypeMidContent][user].price = {};
									groupFunctionList[group][func][functionPackage][funcPackCol][iconType][iconTypeContent][iconTypeMidContent][user].price.price_us = iconMidInput[0].value;
									groupFunctionList[group][func][functionPackage][funcPackCol][iconType][iconTypeContent][iconTypeMidContent][user].price.price_dis = iconMidInput[2].value;
									groupFunctionList[group][func][functionPackage][funcPackCol][iconType][iconTypeContent][iconTypeMidContent][user].price.price_fix = iconMidInput[3].value;
								}
								var iconTypeBotContent = 'iconTypeBotContent';
								groupFunctionList[group][func][functionPackage][funcPackCol][iconType][iconTypeContent][iconTypeBotContent] = {};
								var iconEditDivContBot 		= iconEdit.getElementsByClassName('iconedit_container_bottom');
								for (var n = 0; n < iconEditDivContBot.length; n++) {
									var iconBotInput 			= iconEditDivContBot[n].getElementsByTagName('input');
									groupFunctionList[group][func][functionPackage][funcPackCol][iconType][iconTypeContent][iconTypeBotContent].MinimumPrice = iconBotInput[0].value;
									groupFunctionList[group][func][functionPackage][funcPackCol][iconType][iconTypeContent][iconTypeBotContent].MaximumPrice = iconBotInput[1].value;
								}
								


							}
						}

					}

				}
			}

		}
		document.getElementById("save_pack_data").click();
		document.getElementsByName("group_func_data")[0].value = JSON.stringify(groupFunctionList);
		//console.log(groupFunctionList);
		document.getElementById("pro_submit").click();
	}


    
	
});

document.addEventListener('keydown', function(e) {
  if ( e.keyCode == 13 ) {
	    document.getElementById("save_pack_data").click();
		document.getElementById("save_fu_gr_data").click();
		document.getElementById("pro_submit").click();
  	}
});

function calSaveButton(){
	document.getElementById("save_pack_data").click();
	document.getElementById("save_fu_gr_data").click();
	document.getElementById("pro_submit").click();
}

/******* Show Price Div of Package  *******/	
function showPriceClick(ev){
		var button_class = event.target.classList[2];
		//var siblingDiv_class = event.target.nextElementSibling.classList[0];
		document.getElementById('backgroundOverlay').style.display= "block";

		event.target.nextElementSibling.classList.add("price_ovrlay"); 
		//document.getElementById(siblingDiv_class).classList.add("price_ovrlay"); 
	}

/******* Create Duplicate Clone of Package  *******/	
function duplicate() {

	var o_id = 'package';
	var clone = event.target.parentNode.parentNode.cloneNode(true);
	var i = document.getElementsByName("package_count")[0].value;
    clone.id = o_id + ++i;
    document.getElementsByName("package_count")[0].value = i;
	event.target.parentNode.parentNode.parentNode.appendChild(clone);
	var pack_id = event.target.parentNode.parentNode.id;
	var group_cont =  document.querySelectorAll('.group_package_col_count');
	var func_cont =  document.querySelectorAll('.function_package_col_count');
	for (var j = 0; j < group_cont.length; j++) {
		if (group_cont[j].id == pack_id) {
			//console.log(func_group_cont);
			var group_clone = group_cont[j].cloneNode(true);
			group_clone.id = clone.id;
			group_cont[j].parentNode.appendChild(group_clone);
		}
	}

	var f_i = document.getElementsByName("func_icon_count")[0].value;
	for (var g = 0; g < func_cont.length; g++) {
		if (func_cont[g].id == pack_id) {
			//console.log(func_group_cont);
			var group_clone = func_cont[g].cloneNode(true);
			group_clone.id = clone.id;
			var d = 'function_package_type';
			var f_d = d + ++f_i;
			var inputName = group_clone.getElementsByTagName("input");
			for (var f = 0; f < 3; f++) {
				inputName[f].name = f_d;
			}
			document.getElementsByName("func_icon_count")[0].value = f_i;
			func_cont[g].parentNode.appendChild(group_clone);

		}
	}
	
}
/******* Remove Div of Package  *******/
function remove(){
	var c = event.path[2].id;
	document.getElementById(c).remove();
	var group_cont =  document.querySelectorAll('.group_package_col_count');
	var func_cont =  document.querySelectorAll('.function_package_col_count');
	for (var i = 0; i < group_cont.length; i++) {
		if (group_cont[i].id == c) {
			group_cont[i].remove();
		}
	}
	for (var i = 0; i < func_cont.length; i++) {
		if (func_cont[i].id == c) {
			func_cont[i].remove();
		}
	}
}


/******* Create Duplicate Clone of Function  *******/	
function fun_duplicate() {
	var o_id = 'func_layer';
	var clone = event.target.parentNode.parentNode.parentNode.cloneNode(true);
	var i = document.getElementsByName("func_count")[0].value;
    clone.id = o_id + ++i;
    var fp_c = clone.querySelectorAll('.function_package_col_count');
    var f_i = document.getElementsByName("func_icon_count")[0].value;
    var d = 'function_package_type';
    for (var a = 0; a < fp_c.length; a++) {
    	var f_d = d + ++f_i;
    	var fp_input = fp_c[a].getElementsByTagName("input");
    	for (var f = 0; f < 3; f++) {
    		fp_input[f].name = f_d;
    	}

    }
    document.getElementsByName("func_count")[0].value = i;
    document.getElementsByName("func_icon_count")[0].value = f_i;
	event.target.parentNode.parentNode.parentNode.parentNode.appendChild(clone);
	var countClassId = document.querySelectorAll('.group_drag_drop');
	for (var b = 0; b < countClassId.length; b++) {
		var countClasses = countClassId[b].querySelectorAll(".function_container");
		var countLength = countClasses.length;
		var allCountClass = countClassId[b].querySelectorAll(".group_package_col_count");
		for (var c = 0; c < allCountClass.length; c++) {
			allCountClass[c].childNodes[1].innerHTML = '<span>' +countLength+'</span>';
		}
		

	}
	

}

/******* Remove Clone of Function  *******/	
function fun_remove(){
	var c = event.target.parentNode.parentNode.parentNode;
	c.remove();
	var countClassId = document.querySelectorAll('.group_drag_drop');
	for (var b = 0; b < countClassId.length; b++) {
		var countClasses = countClassId[b].querySelectorAll(".function_container");
		var countLength = countClasses.length;
		var allCountClass = countClassId[b].querySelectorAll(".group_package_col_count");
		for (var c = 0; c < allCountClass.length; c++) {
			allCountClass[c].childNodes[1].innerHTML = '<span>' +countLength+'</span>';
		}
		

	}
	//document.getElementById(c).remove();
}

/******* Create Duplicate Clone of Group  *******/	
function group_duplicate() {
	var o_id = 'group_layer';
	var clone = event.target.parentNode.parentNode.parentNode.parentNode.cloneNode(true);
	var i = document.getElementsByName("group_count")[0].value;
    clone.id = o_id + ++i;
    var fp_c = clone.querySelectorAll('.function_package_col_count');
    var f_i = document.getElementsByName("func_icon_count")[0].value;
    var d = 'function_package_type';
    for (var a = 0; a < fp_c.length; a++) {
    	var f_d = d + ++f_i;
    	var fp_input = fp_c[a].getElementsByTagName("input");
    	for (var f = 0; f < 3; f++) {
    		fp_input[f].name = f_d;
    	}

    }
    document.getElementsByName("group_count")[0].value = i;
    document.getElementsByName("func_icon_count")[0].value = f_i;
	event.target.parentNode.parentNode.parentNode.parentNode.parentNode.appendChild(clone);
	var countClassId = document.querySelectorAll('.group_drag_drop');
	for (var c = 0; c < countClassId.length; c++) {
		var countClasses = countClassId[c].querySelectorAll(".function_container");
		var countLength = countClasses.length;
		var allCountClass = countClassId[c].querySelectorAll(".group_package_col_count");
		for (var e = 0; e < allCountClass.length; e++) {
			allCountClass[e].childNodes[1].innerHTML = '<span>' +countLength+'</span>';
		}
		

	}
}

/******* Remove Clone of Group  *******/	
function group_remove(){
	var c = event.path[4].id;
	document.getElementById(c).remove();
}

/******* Create Duplicate Clone of User Price and Discount Field  *******/	
function userPrice_duplicate() {
	var o_id = 'user_price_cont';
	var clone = event.target.parentNode.parentNode.parentNode.cloneNode(true);
	var i = document.getElementsByName("user_price_cont")[0].value;
    clone.id = o_id + ++i;
    document.getElementsByName("user_price_cont")[0].value = i;
	event.target.parentNode.parentNode.parentNode.parentNode.appendChild(clone);

}
/******* Remove Clone of User Price and Discount Field  *******/	
function userPrice_remove(){
	var c = event.path[3].id;
	document.getElementById(c).remove();
}



/******* Create Duplicate Clone of Icon Edit User Price and Discount Field  *******/	
function iconeditPrice_duplicate() {
	var o_id = 'iconedit_price_cont';
	var clone = event.target.parentNode.parentNode.parentNode.cloneNode(true);
	var i = document.getElementsByName("iconedit_price_cont")[0].value;
    clone.id = o_id + ++i;
    document.getElementsByName("iconedit_price_cont")[0].value = i;
	event.target.parentNode.parentNode.parentNode.parentNode.appendChild(clone);

}
/******* Remove Clone of Icon Edit User Price and Discount Field  *******/	
function iconeditPrice_remove(){
	var c = event.path[3].id;
	document.getElementById(c).remove();
}

function fun_info(){
	//console.log(event);
	event.target.nextElementSibling.style.display = 'block';
}


/******* Show info option Video and Text  *******/
function infoOptFun(){
		event.preventDefault();
		var infoDiv = document.querySelectorAll(".info_opt");
        for (var m = 0; m < infoDiv.length; m++) {
        	infoDiv[m].style.display = 'none';
        }
		var infocnt = event.target.parentNode.parentNode.parentNode.nextElementSibling;
		var infoAct = infocnt.querySelectorAll(".info_cont");
		for (var i = 0; i < infoAct.length; i++) {
				infoAct[i].style.display = 'none';
		}
		var activePaneID = event.target.getAttribute("href");

		
		var db = infocnt.getElementsByClassName(activePaneID.substr(1))[0];
		document.getElementById('backgroundOverlay').style.display= "block";

		infocnt.style.display = 'block';
		db.style.display = 'block';
		document.querySelector(activePaneID).classList.add("active");
}


/******* Show Edit Info option Function Icon  *******/
function editInput(){

	console.log(event);
	event.target.nextElementSibling.nextElementSibling.style.display= "block";
	document.getElementById('backgroundOverlay').style.display= "block";

}


/******************** nuber validation for input *************************/
function inpNumValue(){
	
	if(isNaN(event.target.value)){
		alert('Enter only Number');	
		event.target.value = '';
	}else if(event.target.name == 'price_container_user'){
		var maxUser = document.getElementsByName('range_field_max')[0].value;
		var preElement =  event.target.parentNode.parentNode.parentNode.previousElementSibling;
		if (event.target.value > parseInt(maxUser)) {
			alert('Please enter the value less than Maximum User');	
			event.target.value = '';
		}
		else if(preElement.className == 'user_price_cont'){
			var preEleUserInput = preElement.getElementsByTagName('input');
			for (var i = 0; i < preEleUserInput.length; i++) {
				if (preEleUserInput[i].name == 'price_container_user'){
					if (event.target.value <= parseInt(preEleUserInput[i].value)) {
						alert('Please enter the value grater than last User Field');	
						event.target.value = '';
					}
					
				}
			}
			
		}
	}
	else if(event.target.name == 'iconedit_container_user'){
		var maxUser = document.getElementsByName('range_field_max')[0].value;
		var preElement =  event.target.parentNode.parentNode.parentNode.previousElementSibling;
		console.log(preElement);
		if (event.target.value > parseInt(maxUser)) {
			alert('Please enter the value less than Maximum User');	
			event.target.value = '';
		}
		else if(preElement.className == 'iconedit_container'){
			var preEleUserInput = preElement.getElementsByTagName('input');
			for (var i = 0; i < preEleUserInput.length; i++) {
				if (preEleUserInput[i].name == 'iconedit_container_user'){
					if (event.target.value <= parseInt(preEleUserInput[i].value)) {
						alert('Please enter the value grater than last User Field');	
						event.target.value = '';
					}
					
				}
			}
			
		}
	}
}





function groupUp(){
	console.log(event);
	var groupLayer = event.target.parentNode.parentNode.parentNode.parentNode;
	var preGroupLayer = event.target.parentNode.parentNode.parentNode.parentNode.previousElementSibling;
	if (preGroupLayer.className == 'group_drag_drop') {
		console.log(groupLayer.offsetTop);
	}
}








var sourceclip;
var targetclip;
var tmparr = [];
function allowDrop(e) {
	e.preventDefault();
}
function dragStart(e) {
	sourceclip = e.target;
	sourceclip.style.opacity = ".5";
	console.log(e.data);
}
function drop(e) {
	e.preventDefault();
	targetclip = e.target;
	tmparr[0] = e.target.id;
	tmparr[1] = e.target.innerHTML;
	targetclip.innerHTML = sourceclip.innerHTML;
	targetclip.id = sourceclip.id;
	sourceclip.id = tmparr[0];
	sourceclip.innerHTML = tmparr[1];
	sourceclip.style.opacity = "1";
}