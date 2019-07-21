/***** Update Addons Prices according to the range Slider *****/    
function updateIconPrice(rangVal){
    var packObj = document.querySelectorAll('.proj_pack');
    var selectedFunc = {}
    
    var selectFunc = document.querySelectorAll('.func_selecled');
    var cnt = 1
    for (var fi = 0; fi < selectFunc.length; fi++) {
        var funcChecked = selectFunc[fi].querySelectorAll('.func_checked');

        for (var ci = 0; ci < funcChecked.length; ci++) {

            var funcEditCnt = funcChecked[ci].getElementsByClassName('iconedit')[0];
            var funcEditMidCnt = funcEditCnt.getElementsByClassName('iconedit_container_middel')[0]; 
            var funcEditBotCnt = funcEditCnt.getElementsByClassName('iconedit_container_bottom')[0];
            var iconMin = funcEditBotCnt.getElementsByTagName('input')[0].value;
            var iconMax = funcEditBotCnt.getElementsByTagName('input')[1].value;
            var funcIconCnt = funcEditMidCnt.getElementsByClassName('iconedit_container');
            var funcIconPack = funcChecked[ci].dataset.pack + ci;
            var packFunc = funcChecked[ci].dataset.functionid;

                selectedFunc[funcIconPack]= [];

           
            
            selectedFunc[funcIconPack][packFunc]= {};
            var packFunciconMid = 'iconpackconMid';
            var packFunciconBot = 'iconpackconBot';

            selectedFunc[funcIconPack][packFunc][packFunciconMid]= {};
            for (var ii = 0; ii < funcIconCnt.length; ii++) {
                var packFuncond = 'conditon'+ii;
                selectedFunc[funcIconPack][packFunc][packFunciconMid][packFuncond]= {};
                /* Get user Step from icon container */
                var iconUser = funcIconCnt[ii].getElementsByTagName('input')[1].value;
                /* Get price Step from icon container */
                var iconPrice = funcIconCnt[ii].getElementsByTagName('input')[0].value;

                /* Get package name from icon container */
                var iconPackId = funcIconCnt[ii].getElementsByTagName('input')[4].value;

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

                selectedFunc[funcIconPack][packFunc][packFunciconMid][packFuncond].User= iconUser;                
                selectedFunc[funcIconPack][packFunc][packFunciconMid][packFuncond].Price= iconPrice;              

            }

            selectedFunc[funcIconPack][packFunc][packFunciconBot]= {};
            selectedFunc[funcIconPack][packFunc][packFunciconBot].minimum= iconMin;
            selectedFunc[funcIconPack][packFunc][packFunciconBot].maximum= iconMax;

             if (selectedFunc.hasOwnProperty(funcIconPack)) {
              console.log(Object.values(funcIconPack));
            }
        }

    }
    console.log(selectedFunc);

}






/***** Update Addons Prices according to the range Slider *****/    
function updateIconPrice(rangVal){

    var selectFunc = document.querySelectorAll('.func_selecled');
    for (var fi = 0; fi < selectFunc.length; fi++) {
        var funcChecked = selectFunc[fi].querySelectorAll('.func_checked');
        for (var ci = 0; ci < funcChecked.length; ci++) {
            var funcEditCnt = funcChecked[ci].getElementsByClassName('iconedit')[0];
            var funcEditMidCnt = funcEditCnt.getElementsByClassName('iconedit_container_middel')[0]; 
            var funcEditBotCnt = funcEditCnt.getElementsByClassName('iconedit_container_bottom')[0];
            var ficonMin = funcEditBotCnt.getElementsByTagName('input')[0].value;
            var ficonMax = funcEditBotCnt.getElementsByTagName('input')[1].value;
            var funcIconCnt = funcEditMidCnt.getElementsByClassName('iconedit_container');
            for (var ii = 0; ii < funcIconCnt.length; ii++) {

                /* Get user Step from icon container */
                var ficonUser = funcIconCnt[ii].getElementsByTagName('input')[1].value;
                /* Get price Step from icon container */
                var ficonPrice = funcIconCnt[ii].getElementsByTagName('input')[0].value;

                /* Get package name from icon container */
                var ficonPackId = funcIconCnt[ii].getElementsByTagName('input')[4].value;

                /* Get package Html from icon container */
                var ficonPackIdHtml = document.getElementById(ficonPackId);

                /* Get package price div from icon container */
                var ficonPack = ficonPackIdHtml.getElementsByClassName('crt_valu')[0];


                /* Get package Per User Price div from icon container */
                var ficonPackPerUser = ficonPackIdHtml.getElementsByClassName('package_user_price')[0];

                /* Get package price div from icon container */
                var ficonPackAddons = ficonPackIdHtml.getElementsByClassName('package_addon_rangeslider_price')[0];
                if(fi == 0){
                    ficonPackAddons.value =0;
                }
                

                /* Get package price div from icon container */
                var ficonPackBasic = ficonPackIdHtml.getElementsByClassName('base_price')[0];

                if (rangVal <= parseInt(ficonUser)) {
                var finalPrice = parseFloat((ficonPrice * rangVal).toFixed(2));
                /* Check if final Price in greater then icon min price and less then icon max price */ 
                if (finalPrice > ficonMin && finalPrice <= ficonMax) {
                    /* update Addons input hidden value*/
                    ficonPackAddons.value = parseFloat((parseFloat(ficonPackAddons.value) + parseFloat(ficonPrice)).toFixed(2));

                   /* Change per user price according to the function */
                    var fpackBasicPrice = parseFloat((parseFloat(ficonPackPerUser.value) + parseFloat(ficonPackAddons.value)).toFixed(2));
                    ficonPackBasic.innerHTML = fpackBasicPrice;

                    var fpackPrice = ficonPack.innerHTML;
                    var fpriceMitIcon = parseFloat((parseFloat(fpackPrice) + parseFloat(ffinalPrice)).toFixed(2));
                    ficonPack.innerHTML = fpriceMitIcon;
                    
                }else if(finalPrice <= ficonMin){
                    fminIconPrice = parseFloat((ficonMin/rangVal).toFixed(2));
                    finalPrice = parseFloat((fminIconPrice * rangVal).toFixed(2));
                    
                    /* update Addons input hidden value*/
                    ficonPackAddons.value = parseFloat((parseFloat(ficonPackAddons.value) + parseFloat(fminIconPrice)).toFixed(2));


                   /* Change per user price according to the function */
                    var fpackBasicPrice = parseFloat((parseFloat(ficonPackPerUser.value) + parseFloat(ficonPackAddons.value)).toFixed(2));
                    ficonPackBasic.innerHTML = fpackBasicPrice;


                    var fpackPrice = ficonPack.innerHTML;
                    var fpriceMitIcon = parseFloat((parseFloat(fpackPrice) + parseFloat(finalPrice)).toFixed(2));
                    ficonPack.innerHTML = fpriceMitIcon;
                    
                }else if(finalPrice > ficonMax){
                    fmaxIconPrice = parseFloat((ficonMax/rangVal).toFixed(2));
                    ffinalPrice = parseFloat((fmaxIconPrice * rangVal).toFixed(2));
                    
                    /* update Addons input hidden value*/
                    ficonPackAddons.value = parseFloat((parseFloat(ficonPackAddons.value) + parseFloat(fmaxIconPrice)).toFixed(2));

                   /* Change per user price according to the function */
                    var fpackBasicPrice = parseFloat((parseFloat(ficonPackPerUser.value) + parseFloat(ficonPackAddons.value)).toFixed(2));
                    ficonPackBasic.innerHTML = fpackBasicPrice;
                    
                    var fpackPrice = ficonPack.innerHTML;
                    var fpriceMitIcon = parseFloat((parseFloat(packPrice) + parseFloat(finalPrice)).toFixed(2));
                    ficonPack.innerHTML = fpriceMitIcon;
                    
                }

                return false;
            } else{
                   
                    continue;
                } 
            }
        }

    }
}
