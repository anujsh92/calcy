window.addEventListener("load", function(){
    
	/* Tabs Script for package front view */
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

    /* Accrodion Script for package front view */
    var accItem = document.getElementsByClassName('accordionItem');
    var accHD = document.getElementsByClassName('accordionItemHeading');
    for (i = 0; i < accHD.length; i++) {
        accHD[i].addEventListener('click', toggleItem, false);
    }
    function toggleItem() {
        var itemClass = this.parentNode.className;
        for (i = 0; i < accItem.length; i++) {
            accItem[i].className = 'accordionItem close';
        }
        if (itemClass == 'accordionItem close') {
            this.parentNode.className = 'accordionItem open';
        }
    }

    /***** Range slider for select user *****/
    var slider = document.getElementById('userRange');
    slider.oninput = function() {
        var output = document.getElementById('valor');
        output.innerHTML = this.value;
        var sliderWidth = this.getBoundingClientRect().width;
        var outputWidth = output.getBoundingClientRect().width;
        var offset = this.value / (this.max - this.min) * sliderWidth - outputWidth / 1 ;
        //output.setAttribute('style', 'left: ' + offset + 'px');
    }

    slider.oninput();

    /***** Divide Package Container Div into Package title div*****/
	var proj_pack = document.querySelectorAll(".proj_pack_cnt .proj_pack");
    var projPackLen = proj_pack.length;
    for (var pi = 0; pi < proj_pack.length; pi++) {
        projPkParWidth = proj_pack[pi].parentNode.offsetWidth;
        var packWid = projPkParWidth/projPackLen;
        proj_pack[pi].setAttribute('style', 'width: ' + packWid + 'px');
        var funPack = document.querySelectorAll('.funcPack');
        for (var fi = 0; fi < funPack.length; fi++) {
            funPack[fi].setAttribute('style', 'width: ' + packWid + 'px');
        }
        var buttonPack = document.querySelectorAll('.pack_bottom');
        for (var bi = 0; bi < buttonPack.length; bi++) {
            buttonPack[bi].setAttribute('style', 'width: ' + packWid + 'px');
        }
        var buttonPack = document.querySelectorAll('.group_count');
        for (var bi = 0; bi < buttonPack.length; bi++) {
            buttonPack[bi].setAttribute('style', 'width: ' + packWid   + 'px');
        }
    }

    /********* hide Overlay background when click out of popup container  ****/
    var overlay = document.getElementById('backgroundOverlay');
    document.onclick = function(e){
        if(e.target.id == 'backgroundOverlay'){
            var infoCont = document.querySelectorAll(".info_container");
            for (var d = 0; d < infoCont.length; d++) {
                infoCont[d].style.display = 'none';
            }
            overlay.style.display = 'none';
            
        }
       
    };


    /************************** Add Package first value **************************/
    var proPack = document.getElementsByClassName('proj_pack');
    for (var ui = 0; ui < proPack.length; ui++) {
        //get all steps and prices from the hidden fields as object
        var proPackInp = proPack[ui].getElementsByTagName('input');
        //find the start price from the lowest step
         var lowStep = 'usr_cnt'+ proPackInp[0].value;
         var price = proPack[ui].getElementsByClassName(lowStep)[0].value;
         //console.log(price);
         proPack[ui].getElementsByClassName('base_price')[0].innerHTML = price ;
         proPack[ui].getElementsByClassName('package_user_price')[0].value = price ;
    }

    

    /******* remove one extra div from icon bottom container***/
        var icon_edit = document.querySelectorAll(".iconedit");
        for (var ei = 0; ei < icon_edit.length; ei++) {
            var icon_edit_bot = icon_edit[ei].querySelectorAll(".iconedit_container_bottom");
            for (var ii = 1; ii < icon_edit_bot.length; ii++) {
                icon_edit_bot[ii].remove();
            }
        }

    /******* Create Data pack Id ***/
    var funcCount = document.querySelectorAll(".funcPackIconCnt"); 
    for (var fc = 0; fc < funcCount.length; fc++) {
        var funcCountChild = funcCount[fc].getElementsByClassName('funcPack');
        var fcnt = 1;
        for (var cc = 0; cc < funcCountChild.length; cc++) {
             var packid = 'package' + fcnt++;
            funcCountChild[cc].setAttribute('data-pack', packid);
        }
    }

    /******* Create Data pack Id ***/
    var func = document.querySelectorAll(".calc_function_cnt");
    for (var fu = 0; fu < func.length; fu++) {
        var funcCountChild = func[fu].getElementsByClassName('funcPack');
        for (var fd = 0; fd < funcCountChild.length; fd++) {
             var packid = 'function' + fu;
            funcCountChild[fd].setAttribute('data-functionId', packid);
        }
    }
    /************* Selected function counter ******************/
    function selectFuncCounter(){

        var groupCnt = document.querySelectorAll(".accordionItem");
        for (var j = 0; j < groupCnt.length; j++) {
            /*  Get Function Container every Accodion item */
            var func = groupCnt[j].getElementsByClassName("calc_function_cnt");
            for (var i = 0; i < func.length; i++) {

                /*  Get Function Icon Container */
                var funcChild = func[i].getElementsByClassName('funcPack');
                
                for (var ch = 0; ch < funcChild.length; ch++) {

                    var funcCheckedIcon = funcChild[ch].getElementsByTagName('i')[0];
                    /*  Check condition if i tag has fa-check-circle class */
                    if (funcCheckedIcon.className == 'fa fa-check-circle') {
                        var funCheckedId = funcChild[ch].dataset.pack;
                        var packInputId = 'group_input_'+funCheckedId;
                        var packSpanId = 'gcount_'+funCheckedId;
                        /*  Add count value hidden input field and count div gcount_package */
                        var totalCnt = groupCnt[j].getElementsByClassName(packInputId)[0];
                        var countDiv = groupCnt[j].getElementsByClassName(packSpanId)[0];
                        
                        var cnt = totalCnt.value;
                        totalCnt.value = parseInt(cnt) + 1;
                        countDiv.getElementsByTagName('span')[0].innerHTML = totalCnt.value;

                    }
                    
                }
                    
            }
        }
        
    }
    
    selectFuncCounter();


});



/***********Show function information ***********************/
function showInfo(){
    console.log(event);
    event.target.nextElementSibling.style.display = 'block';
    document.getElementById('backgroundOverlay').style.display= 'block';
}


/************************* Count value change When user add function  **********************************/

function selectFuncCounterAdd(varAdd){
    var groupCl = varAdd.target.parentNode.parentNode.parentNode.parentNode.previousElementSibling;
    var iconPackId = varAdd.target.parentNode.dataset.pack;
    var countSpanClass = 'gcount_'+iconPackId;
    var countInputClass = 'group_input_'+iconPackId;
    /*  Add count value hidden input field and count div gcount_package */
    var totalCnt = groupCl.getElementsByClassName(countInputClass)[0];
    var countDiv = groupCl.getElementsByClassName(countSpanClass)[0];
    totalCnt.value = parseInt(totalCnt.value)+1;
    countDiv.getElementsByTagName('span')[0].innerHTML = totalCnt.value; 
}


/************************* Count value change When user add function  **********************************/

function selectFuncCounterDivide(varDivide){
    var groupCl = varDivide.target.parentNode.parentNode.parentNode.parentNode.previousElementSibling;
    var iconPackId = varDivide.target.parentNode.dataset.pack;
    var countSpanClass = 'gcount_'+iconPackId;
    var countInputClass = 'group_input_'+iconPackId;
    /*  Add count value hidden input field and count div gcount_package */
    var totalCnt = groupCl.getElementsByClassName(countInputClass)[0];
    var countDiv = groupCl.getElementsByClassName(countSpanClass)[0];
    totalCnt.value = parseInt(totalCnt.value)-1;
    countDiv.getElementsByTagName('span')[0].innerHTML = totalCnt.value; 
}


/***** Update Addons Prices according to the range Slider *****/    
function updateIconPrice(rangVal){

    
    var beforeCl = document.getElementById('before_package_class');

    //get all activated functions

    var selectFunc = document.querySelectorAll('.func_selecled');
    
    //loop trough each activated function
    for (var fi = 0; fi < selectFunc.length; fi++) {
       
        //get the actual function
        var funcChecked = selectFunc[fi].querySelectorAll('.func_checked');
        for (var ci = 0; ci < funcChecked.length; ci++) {
            // Get steps and prices, and min an max 
            var funcEditCnt = funcChecked[ci].getElementsByClassName('iconedit')[0];
            var funcEditMidCnt = funcEditCnt.getElementsByClassName('iconedit_container_middel')[0]; 
            var funcEditBotCnt = funcEditCnt.getElementsByClassName('iconedit_container_bottom')[0];
            var funcIconPack = funcChecked[ci].dataset.pack;
            
            var ficonMin = funcEditBotCnt.getElementsByTagName('input')[0].value;
            var ficonMax = funcEditBotCnt.getElementsByTagName('input')[1].value;
            console.log(ficonMax);
            var funcIconCnt = funcEditMidCnt.getElementsByClassName('iconedit_container'); 
            //looping through functions price steps and comparing with value from user slider
            for (var ii = 0; ii < funcIconCnt.length; ii++) {

                /* Get user Step from icon container */
                var ficonUser = funcIconCnt[ii].getElementsByTagName('input')[1].value;
                /* Get price Step from icon container */
                var ficonPrice = funcIconCnt[ii].getElementsByTagName('input')[0].value;

                /* Get package name from icon container */
                var ficonPackId = funcIconCnt[ii].getElementsByTagName('input')[4].value;

                if (rangVal <= parseInt(ficonUser)) {

                    /* Get package Html from icon container */
                    var ficonPackIdHtml = document.getElementById(ficonPackId);

                    /* Get package price div from icon container */
                    var ficonPack = ficonPackIdHtml.getElementsByClassName('crt_valu')[0];


                    /* Get package Per User Price div from icon container */
                    var ficonPackPerUser = ficonPackIdHtml.getElementsByClassName('package_user_price')[0];

                    /* Get package price div from icon container */
                    var ficonPackAddons = ficonPackIdHtml.getElementsByClassName('package_addon_price')[0];

                    //console.log(ficonPackId);

                   if(!beforeCl.classList.contains(ficonPackId)){
                        ficonPackAddons.value =0;
                        beforeCl.classList.add(funcIconPack);
                    } 
                

                    /* Get package price div from icon container */
                    var ficonPackBasic = ficonPackIdHtml.getElementsByClassName('base_price')[0];



                    var finalPrice = parseFloat((ficonPrice * rangVal).toFixed(2));
                    /* Check if final Price in greater then icon min price and less then icon max price */ 
                    if (finalPrice > ficonMin && finalPrice <= ficonMax) {
                        /* update Addons input hidden value*/
                        ficonPackAddons.value = parseFloat((parseFloat(ficonPackAddons.value) + parseFloat(ficonPrice)).toFixed(2));

                       /* Change per user price according to the function */

                        var fpackBasicPrice = parseFloat((parseFloat(ficonPackPerUser.value) + parseFloat(ficonPackAddons.value)).toFixed(2));
                        ficonPackBasic.innerHTML = fpackBasicPrice;


                        var fpackPrice = ficonPack.innerHTML;
                        console.log('test');
                        
             
          
                    }else if(finalPrice <= ficonMin){
                        fminIconPrice = parseFloat((ficonMin/rangVal).toFixed(2));
                        finalPrice = parseFloat((fminIconPrice * rangVal).toFixed(2));
                        
                        /* update Addons input hidden value*/
                        ficonPackAddons.value = parseFloat((parseFloat(ficonPackAddons.value) + parseFloat(fminIconPrice)).toFixed(2));


                       /* Change per user price according to the function */
                        var fpackBasicPrice = parseFloat((parseFloat(ficonPackPerUser.value) + parseFloat(ficonPackAddons.value)).toFixed(2));
                        ficonPackBasic.innerHTML = fpackBasicPrice;


                        
                        
      
                        
                    }else if(finalPrice > ficonMax && ficonMax != null && ficonMax != 0){
                        console.log()
                        fmaxIconPrice = parseFloat((ficonMax/rangVal).toFixed(2));
                        finalPrice = parseFloat((fmaxIconPrice * rangVal).toFixed(2));
                        
                        /* update Addons input hidden value*/
                        ficonPackAddons.value = parseFloat((parseFloat(ficonPackAddons.value) + parseFloat(fmaxIconPrice)).toFixed(2));

                       /* Change per user price according to the function */
                        var fpackBasicPrice = parseFloat((parseFloat(ficonPackPerUser.value) + parseFloat(ficonPackAddons.value)).toFixed(2));
                        ficonPackBasic.innerHTML = fpackBasicPrice;
                        
                       
        
                    }else { 

                        /* update Addons input hidden value*/
                        ficonPackAddons.value = parseFloat((parseFloat(ficonPackAddons.value) + parseFloat(ficonPrice)).toFixed(2));
                        console.log(ficonPackAddons.value);
                       /* Change per user price according to the function */

                        var fpackBasicPrice = parseFloat((parseFloat(ficonPackPerUser.value) + parseFloat(ficonPackAddons.value)).toFixed(2));
                        ficonPackBasic.innerHTML = fpackBasicPrice;


                        var fpackPrice = ficonPack.innerHTML;
                        
             
          
                    }
                break;
                }

            }
        }
    }
    //loop trough packages, take value from base_price, multiply with range and put the result in the crt_valu field of the package
    var package =  document.querySelectorAll('.proj_pack');
    for (var i = 0; i < package.length; i++) {
        var pricePerUser = package[i].getElementsByClassName('base_price')[0].innerHTML;
        var priceTotal = package[i].getElementsByClassName('crt_valu')[0];
        //console.log(pricePerUser)
        var result = parseFloat((parseFloat(pricePerUser) * rangVal).toFixed(2));
        priceTotal.innerHTML = result;
    }

} //end function


/*********** Package Price change after Calculation script ***********************/
function userOnChange(){

    var rangValue = event.target.value; //get the value from the slider
    if (rangValue == 0) {
        event.target.value = 1;
        document.getElementById('valor').value = 1;
        rangValue =  event.target.value;
    }
    var proPack = document.getElementsByClassName('proj_pack');
    var selectFunc = document.querySelectorAll('.func_selecled');
    var funcAddon = document.querySelectorAll('.package_addon_price');
    var beforeCl = document.getElementById('before_package_class');

    /* remove all classes from before_package_class input field */
    beforeCl.clearClassList = function(elem) {
    var classList = elem.classList;
    var classListAsArray = new Array(classList.length);
    for (var i = 0, len = classList.length; i < len; i++) {
        classListAsArray[i] = classList[i];
    }
    beforeCl.removeClassList(elem, classListAsArray);
    }

    /* When you change range slider addon price reset*/
    for (var ai = 0; ai < funcAddon.length; ai++) {
        funcAddon[ai].value = 0;
    }

    if(selectFunc.length != '0'){

        
        for (var ui = 0; ui < proPack.length; ui++) {
            //get all steps and prices from the hidden fields as object
            var proPackInp = proPack[ui].getElementsByClassName('step');
            //find the start price from the lowest step
             var lowStep = 'usr_cnt'+ proPackInp[0].value;
             var price = document.getElementsByClassName(lowStep)[0].value;
            //reverse values in object 
            var proPackInp2 = Object.assign([], proPackInp).reverse();

            
            //check if slider value is smaller then a step value, and save the price, when value is higher, loop ends and the last stored price is displayed
            for (var pi = 0; pi < proPackInp2.length; pi++) {
                if(rangValue <= parseInt(proPackInp2[pi].value)){
                    var prCl = 'usr_cnt'+proPackInp2[pi].value;
                    var prClPer = 'usr_price_per'+proPackInp2[pi].value;
                    var prClFix = 'usr_price_fix'+proPackInp2[pi].value;
                    var prPerUser = proPack[ui].getElementsByClassName('package_user_price')[0];
                    var prAddons = proPack[ui].getElementsByClassName('package_addon_price')[0];
                    var priCl = proPack[ui].getElementsByClassName(prCl)[0].value;
                    var prClPerVal = proPack[ui].getElementsByClassName(prClPer)[0].value;
                    var prClFixVal = proPack[ui].getElementsByClassName(prClFix)[0].value;

                    /* Update per user Price to Hidden input*/
                    prPerUser.value = priCl;

                     

                    //Calculation of Price and Rangevalue 
                    var price = (parseFloat(prPerUser.value) + parseFloat(prAddons.value)) * rangValue;
                    //var price = priCl * rangValue;
                    
                    
                    //Calculation of Price and Percentage Discount if percentage discount added in Backend 
                    if (prClPerVal != 0) {
                        var prPer  = price*prClPerVal/100
                        var total = price - prPer;
                    }
                    //Calculation of Price and Fixed Discount if percentage discount added in Backend
                    if (prClFixVal != 0) {
                        var total = price - prClFixVal;
                    }

                    continue;
                } 
            }
            
            //this value must be shown in the green box
            proPack[ui].getElementsByClassName('crt_valu')[0].innerHTML = price;
            //proPack[ui].getElementsByClassName('total_price_cont')[0].style.display= 'block';
        }
        updateIconPrice(rangValue);

    }else{
    
        
        console.log('test');
        for (var ui = 0; ui < proPack.length; ui++) {
            //get all steps and prices from the hidden fields as object
            var proPackInp = proPack[ui].getElementsByClassName('step');
            //find the start price from the lowest step
             var lowStep = 'usr_cnt'+ proPackInp[0].value;
             var price = document.getElementsByClassName(lowStep)[0].value;
            //reverse values in object 
            var proPackInp2 = Object.assign([], proPackInp).reverse();

            
            //check if slider value is smaller then a step value, and save the price, when value is higher, loop ends and the last stored price is displayed
            for (var pi = 0; pi < proPackInp2.length; pi++) {
                if(rangValue <= parseInt(proPackInp2[pi].value)){
                    var prCl = 'usr_cnt'+proPackInp2[pi].value;
                    var prClPer = 'usr_price_per'+proPackInp2[pi].value;
                    var prClFix = 'usr_price_fix'+proPackInp2[pi].value;
                    var prPerUser = proPack[ui].getElementsByClassName('package_user_price')[0];
                    var prAddons = proPack[ui].getElementsByClassName('package_addon_price')[0];
                    var priCl = proPack[ui].getElementsByClassName(prCl)[0].value;
                    var prClPerVal = proPack[ui].getElementsByClassName(prClPer)[0].value;
                    var prClFixVal = proPack[ui].getElementsByClassName(prClFix)[0].value;

                    /* Update per user Price to Hidden input*/
                    prPerUser.value = priCl;

                    

                    /* Update base Price html to base_price class*/
                    proPack[ui].getElementsByClassName('base_price')[0].innerHTML = parseInt(prPerUser.value) + parseInt(prAddons.value);

                    //Calculation of Price and Rangevalue 
                    var price = (parseInt(prPerUser.value) + parseInt(prAddons.value)) * rangValue;
                    //var price = priCl * rangValue;

                   
                    
                    //Calculation of Price and Percentage Discount if percentage discount added in Backend 
                    if (prClPerVal != 0) {
                        var prPer  = price*prClPerVal/100
                        var total = price - prPer;
                    }
                    //Calculation of Price and Fixed Discount if percentage discount added in Backend
                    if (prClFixVal != 0) {
                        var total = price - prClFixVal;
                    }

                    continue;
                } 
            }
            
            //this value must be shown in the green box
            proPack[ui].getElementsByClassName('crt_valu')[0].innerHTML = price;
            //proPack[ui].getElementsByClassName('total_price_cont')[0].style.display= 'block';
        }
    }

}


/*****************************************************/

function funcIconPrice(){
    //console.log(event);
    /* Get Range slider value from user slider */
    var rangValue = document.getElementById('userRange').value;

    /* Get Price from middle container of icon edit container */
    var iconMid = event.target.nextElementSibling.firstElementChild;

    /* Get Price condition from min max container of icon edit container */
    var iconLast = event.target.nextElementSibling.lastElementChild;
    var iconMin = iconLast.getElementsByTagName('input')[0].value;
    var iconMax = iconLast.getElementsByTagName('input')[1].value;

    /* Create object variable for get icon price and user value */
    var iconMidCont = iconMid.getElementsByClassName('iconedit_container');

    if (event.target.className == 'fas fa-plus') {
        event.target.classList.remove('fa-plus');
        event.target.classList.add('fa-check-circle');
        event.target.parentNode.parentNode.parentNode.classList.add('func_selecled');
        event.target.parentNode.classList.add('func_checked');
        selectFuncCounterAdd(event);
        for (var i = 0; i < iconMidCont.length; i++) {

            /* Get user Step from icon container */
            var iconUser = iconMidCont[i].getElementsByTagName('input')[1].value;
            /* Get price Step from icon container */
            var iconPrice = iconMidCont[i].getElementsByTagName('input')[0].value;

            /* Get package name from icon container */
            var iconPackId = iconMidCont[i].getElementsByTagName('input')[4].value;

            /* Get package Html from icon container */
            var iconPackIdHtml = document.getElementById(iconPackId);

            /* Get package price div from icon container */
            var iconPack = iconPackIdHtml.getElementsByClassName('crt_valu')[0];


            /* Get package Per User Price div from icon container */
            var iconPackPerUser = iconPackIdHtml.getElementsByClassName('package_user_price')[0];

            /* Get package price div from icon container */
            var iconPackAddons = iconPackIdHtml.getElementsByClassName('package_addon_price')[0];
            

            /* Get package price div from icon container */
            var iconPackBasic = iconPackIdHtml.getElementsByClassName('base_price')[0];

            if (rangValue <= parseInt(iconUser)) {
                var finalPrice = parseFloat((iconPrice * rangValue).toFixed(2));

                /* Check if final Price in greater then icon min price and less then icon max price */ 
                if (finalPrice > iconMin && finalPrice <= iconMax) {

                    /* update Addons input hidden value*/
                    iconPackAddons.value = parseFloat((parseFloat(iconPackAddons.value) + parseFloat(iconPrice)).toFixed(2));

                   /* Change per user price according to the function */
                    var packBasicPrice = parseFloat((parseFloat(iconPackPerUser.value) + parseFloat(iconPackAddons.value)).toFixed(2));
                    iconPackBasic.innerHTML = packBasicPrice;

                    var packPrice = iconPack.innerHTML;
                    var priceMitIcon = parseFloat((parseFloat(packPrice) + parseFloat(finalPrice)).toFixed(2));
                    iconPack.innerHTML = priceMitIcon;
                }else if(finalPrice <= iconMin){
                    minIconPrice = parseFloat((iconMin/rangValue).toFixed(2));
                    finalPrice = parseFloat((minIconPrice * rangValue).toFixed(2));

                    /* update Addons input hidden value*/
                    iconPackAddons.value = parseFloat((parseFloat(iconPackAddons.value) + parseFloat(minIconPrice)).toFixed(2));

                   /* Change per user price according to the function */
                    var packBasicPrice = parseFloat((parseFloat(iconPackPerUser.value) + parseFloat(iconPackAddons.value)).toFixed(2));
                    iconPackBasic.innerHTML = packBasicPrice;

                    var packPrice = iconPack.innerHTML;
                    var priceMitIcon = parseFloat((parseFloat(packPrice) + parseFloat(finalPrice)).toFixed(2));
                    iconPack.innerHTML = priceMitIcon;
                }else if(finalPrice > iconMax && iconMax != 0 && iconMax != null){
                    maxIconPrice = parseFloat((iconMax/rangValue).toFixed(2));
                    finalPrice = parseFloat((maxIconPrice * rangValue).toFixed(2));
                    
                    /* update Addons input hidden value*/
                    iconPackAddons.value = parseFloat((parseFloat(iconPackAddons.value) + parseFloat(maxIconPrice)).toFixed(2));

                   /* Change per user price according to the function */
                    var packBasicPrice = parseFloat((parseFloat(iconPackPerUser.value) + parseFloat(iconPackAddons.value)).toFixed(2));
                    iconPackBasic.innerHTML = packBasicPrice;
                    
                    var packPrice = iconPack.innerHTML;
                    var priceMitIcon = parseFloat((parseFloat(packPrice) + parseFloat(finalPrice)).toFixed(2));
                    iconPack.innerHTML = priceMitIcon;
                }else { 

                    /* update Addons input hidden value*/
                    iconPackAddons.value = parseFloat((parseFloat(iconPackAddons.value) + parseFloat(iconPrice)).toFixed(2));

                   /* Change per user price according to the function */
                    var packBasicPrice = parseFloat((parseFloat(iconPackPerUser.value) + parseFloat(iconPackAddons.value)).toFixed(2));
                    iconPackBasic.innerHTML = packBasicPrice;

                    var packPrice = iconPack.innerHTML;
                    var priceMitIcon = parseFloat((parseFloat(packPrice) + parseFloat(finalPrice)).toFixed(2));
                    iconPack.innerHTML = priceMitIcon;
          
                }

                return false;
            } else{
               
                continue;
            } 
        }
        

    }else if(event.target.className == 'fas fa-check-circle'){
        event.target.classList.remove('fa-check-circle');
        event.target.classList.add('fa-plus');
        event.target.parentNode.parentNode.parentNode.classList.remove('func_selecled');
        event.target.parentNode.classList.remove('func_checked');
        selectFuncCounterDivide(event);
        for (var i = 0; i < iconMidCont.length; i++) {

            /* Get user Step from icon container */
            var iconUser = iconMidCont[i].getElementsByTagName('input')[1].value;
            /* Get price Step from icon container */
            var iconPrice = iconMidCont[i].getElementsByTagName('input')[0].value;

            /* Get package name from icon container */
            var iconPackId = iconMidCont[i].getElementsByTagName('input')[4].value;

            /* Get package Html from icon container */
            var iconPackIdHtml = document.getElementById(iconPackId);

            /* Get package price div from icon container */
            var iconPack = iconPackIdHtml.getElementsByClassName('crt_valu')[0];

            /* Get package per user price  div from icon container */
            var iconPackPerUser = iconPackIdHtml.getElementsByClassName('package_user_price')[0];

            /* Get package addons price div from icon container */
            var iconPackAddons = iconPackIdHtml.getElementsByClassName('package_addon_price')[0];

            /* Get package price div from icon container */
            var iconPackBasic = iconPackIdHtml.getElementsByClassName('base_price')[0];
            
            if (rangValue <= parseInt(iconUser)) {
                var finalPrice = parseFloat((iconPrice * rangValue).toFixed(2));

                 /* Check if final Price in greater then icon min price and less then icon max price */ 
                if (finalPrice > iconMin && finalPrice <= iconMax) {

                    /* update Add-ons input hidden value*/
                    iconPackAddons.value = parseFloat((parseFloat(iconPackAddons.value) - parseFloat(iconPrice)).toFixed(2));

                   /* Change per user price according to the function */
                    var packBasicPrice = parseFloat((parseFloat(iconPackPerUser.value) + parseFloat(iconPackAddons.value)).toFixed(2));
                    iconPackBasic.innerHTML = packBasicPrice;

                    var packPrice = iconPack.innerHTML;
                    var priceMitIcon = parseFloat((parseFloat(packPrice) - parseFloat(finalPrice)).toFixed(2));
                    iconPack.innerHTML = priceMitIcon;
                }else if(finalPrice < iconMin){
                    minIconPrice = parseFloat((iconMin/rangValue).toFixed(2));
                    finalPrice = parseFloat((minIconPrice * rangValue).toFixed(2));

                    /* update Add-ons input hidden value*/
                    iconPackAddons.value =  parseFloat((parseFloat(iconPackAddons.value) - parseFloat(minIconPrice)).toFixed(2));

                   /* Change per user price according to the function */
                    var packBasicPrice =  parseFloat((parseFloat(iconPackPerUser.value) + parseFloat(iconPackAddons.value)).toFixed(2));
                    iconPackBasic.innerHTML = packBasicPrice;

                    var packPrice = iconPack.innerHTML;
                    var priceMitIcon = parseFloat((parseFloat(packPrice) - parseFloat(finalPrice)).toFixed(2));
                    iconPack.innerHTML = priceMitIcon;
                }else if(finalPrice > iconMax && iconMax != 0 && iconMax != null){
                    maxIconPrice = parseFloat((iconMax/rangValue).toFixed(2));
                    finalPrice = parseFloat((maxIconPrice * rangValue).toFixed(2));
                    
                    /* update Addons input hidden value*/
                    iconPackAddons.value = parseFloat((parseFloat(iconPackAddons.value) - parseFloat(maxIconPrice)).toFixed(2));

                   /* Change per user price according to the function */
                    var packBasicPrice = parseFloat((parseFloat(iconPackPerUser.value) + parseFloat(iconPackAddons.value)).toFixed(2));
                    iconPackBasic.innerHTML = packBasicPrice;
                    
                    var packPrice = iconPack.innerHTML;
                    var priceMitIcon =  parseFloat((parseFloat(packPrice) - parseFloat(finalPrice)).toFixed(2));
                    iconPack.innerHTML = priceMitIcon;
                }else{
                    /* update Add-ons input hidden value*/
                    iconPackAddons.value = parseFloat((parseFloat(iconPackAddons.value) - parseFloat(iconPrice)).toFixed(2));

                   /* Change per user price according to the function */
                    var packBasicPrice = parseFloat((parseFloat(iconPackPerUser.value) + parseFloat(iconPackAddons.value)).toFixed(2));
                    iconPackBasic.innerHTML = packBasicPrice;

                    var packPrice = iconPack.innerHTML;
                    var priceMitIcon = parseFloat((parseFloat(packPrice) - parseFloat(finalPrice)).toFixed(2));
                    iconPack.innerHTML = priceMitIcon;
                }

                return false;
            } else{
               
                continue;
            } 
        }
    }
}





