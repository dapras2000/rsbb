<style type="text/css">
.tableBoxOuter { width:100%; height:350px; background: #FFFFFF;}
.scrolltable td, th {font-size: 11px; table-layout: automatic;	background:none;}
.header{ background:#39C;}
.pricenull{ background:#39C;}
input.text{ color:#999; border:#999 1px solid; cursor:pointer;}
</style>

<script type="text/javascript">
/* Copyright Richard Cornford 2004 */
var finalizeMe = (function(){
	var global = this,base,safe = false,svType = (global.addEventListener && 2)||(global.attachEvent && 3)|| 0;
	function addFnc(next, f){function t(ev){if(next)next(ev);f(ev);};t.addItem = function(d){if(f != d.getFunc()){if(next){next.addItem(d);}else{next = d;}}return this;};t.remove = function(d){if(f == d){f = null;return next;}else if(next){next = next.remove(d);}return this;};t.getFunc = function(){return f;};t.finalize = function(){if(next)next = next.finalize();return (f = null);};return t;};
	function addFunction(f){if(base){base = base.addItem(addFnc(null, f));}else{base = addFnc(null, f);}};
	function ulQue(f){addFunction(f);if(!safe){switch(svType){case 2:global.addEventListener("unload", base, false);safe = true;break;case 3:global.attachEvent("onunload", base);safe = true;break;default:if(global.onunload != base){if(global.onunload)addFunction(global.onunload);global.onunload = base;}break;}}};
	ulQue.remove = function(f){if(base)base.remove(f);};
	function finalize(){if(base){base.finalize();switch(svType){case 3:global.detachEvent("onunload", base);break;case 2:global.removeEventListener("unload", base, false);break;default:global.onunload = null;break;}base = null;}safe = false;};
	ulQue(finalize);return ulQue;
})();


var InitializeMe = (function(){
	var global = this,base = null,safe = false;
	var listenerType = (global.addEventListener && 2)||(global.attachEvent && 3)|| 0;
	function getStackFunc(next, funcRef, arg1,arg2,arg3,arg4){function l(ev){funcRef((ev?ev:global.event), arg1,arg2,arg3,arg4);if(next)next = next(ev);return (funcRef = null);};l.addItem = function(d){if(next){next.addItem(d);}else{next = d;}};return l;};
	return (function(funcRef, arg1,arg2,arg3,arg4){if(base){base.addItem(getStackFunc(null, funcRef, arg1,arg2,arg3,arg4));}else{base = getStackFunc(null, funcRef, arg1,arg2,arg3,arg4);}if(!safe){switch(listenerType){case 2:global.addEventListener("load", base, false);safe = true;break;case 3:global.attachEvent("onload", base);safe = true;break;default:if(global.onload != base){if(global.onload){base.addItem(getStackFunc(null, global.onload));}global.onload = base;}break;}}});
})();
var queryStrings = (function(out){
    if(typeof location != 'undefined'){
        var temp = location.search||location.href||'';
        var nvp, ofSet;
        if((ofSet = temp.indexOf('?')) > -1){
            temp = temp.split("#")[0];
            temp = temp.substring((ofSet+1), temp.length);
            var workAr = temp.split('&');
            for(var c = workAr.length;c--;){
                nvp = workAr[c].split('=');
                if(nvp.length > 1){out[nvp[0]] = nvp[1];}
            }
        }
    }
    return out;
})({});

var TimedQue = (function(){
	var base, timer;
	var interval = 60;
	var newFncs = null;
	function addFnc(next, f){function t(){next = next&&next();if(f()){return t;}else{f = null;return next;}}t.addItem = function(d){if(next){next.addItem(d);}else{next = d;}return this;};t.finalize = function(){return ((next)&&(next = next.finalize())||(f = null));};return t;}
	function tmQue(fc){if(newFncs){newFncs = newFncs.addItem(addFnc(null, fc));}else{newFncs = addFnc(null, fc);}if(!timer){timer = setTimeout(tmQue.act, interval);}}
	tmQue.act = function(){var fn = newFncs, strt = new Date().getTime();if(fn){newFncs = null;if(base){base.addItem(fn);}else{base = fn;}}base = base&&base();if(base||newFncs){var t = interval - (new Date().getTime() - strt);timer = setTimeout(tmQue.act, ((t > 0)?t:1));}else{timer = null;}};
	tmQue.act.toString = function(){return 'TimedQue.act()';};
	tmQue.finalize = function(){timer = timer&&clearTimeout(timer);base = base&&base.finalize();newFncs = null;};
	return tmQue;
})();

var getElementWithId = (function(){if(document.getElementById){return (function(id){return document.getElementById(id);});}else if(document.all){return (function(id){return document.all[id];});}return (function(id){return null;});})();

function getSimpleExtPxIn(el){
	var temp, temp2, tick = 0, getBorders = retFalse, doCompStyle = retFalse,defaultView,objList = [];
	function retFalse(){return false;}
	retFalse.elTest = retFalse;
	retFalse.iY = retFalse.iX = retFalse.y = retFalse.x = retFalse.w = retFalse.h = retFalse.bb = retFalse.bt = retFalse.bl = retFalse.br = 0;
	function retThis(){return retThis;}
	function gCompStyleBorders(p, el){doCompStyle(p, defaultView.getComputedStyle(el, '' ));}
	function doComputedStyleFloat(p, cs){p.bt = (cs.getPropertyCSSValue('border-top-width').getFloatValue(5));p.bl = (cs.getPropertyCSSValue('border-left-width').getFloatValue(5));p.br = (cs.getPropertyCSSValue('border-right-width').getFloatValue(5));p.bb = (cs.getPropertyCSSValue('border-bottom-width').getFloatValue(5));}
	function doComputedStyleValue(p, cs){p.bt = Math.ceil(parseFloat(s.getPropertyValue('border-top-width')))|0;p.bl = Math.ceil(parseFloat(s.getPropertyValue('border-left-width')))|0;p.br = Math.ceil(parseFloat(s.getPropertyValue('border-right-width')))|0;p.bb = Math.ceil(parseFloat(s.getPropertyValue('border-bottom-width')))|0;}
	function gClientBorders(p, el){if(el.clientWidth||el.clientHeight){p.bb = (el.offsetHeight - (el.clientHeight + (p.bt = el.clientTop|0)))|0;p.br = (el.offsetWidth - (el.clientWidth + (p.bl = el.clientLeft|0)))|0;}}
	function getInterfaceObj(el){var lastTick = NaN;var offsetParent = getSimpleExtPxInFn(el.offsetParent)||retFalse;function p(doTick){if(doTick){tick = (1+tick)%0xEFFFFFFF;}if(tick != lastTick){lastTick = tick;offsetParent();getBorders(p, el);p.iY = (p.y = (offsetParent.iY + (el.offsetTop|0))) + p.bt;p.iX = (p.x = (offsetParent.iX + (el.offsetLeft|0))) + p.bl;p.w = el.offsetWidth|0;p.h = el.offsetHeight|0;}return p;}p.elTest = function(elmnt){return (elmnt == el);};p.iY = p.iX = p.w = p.h = p.y = p.x = p.bb = p.bt = p.bl = p.br = 0;return (objList[objList.length] = p);}
	function getSimpleExtPxInFn(el){if((!el)||(el == document)){return retFalse;}for(var c = objList.length;c--;){if(objList[c].elTest(el)){return objList[c];}}return getInterfaceObj(el);}
	function setSpecialObj(el){var lastTick = NaN;function p(doTick){if(doTick){tick = (1+tick)%0xEFFFFFFF;}return p;}p.elTest = function(elmnt){return (elmnt == el);};p.iY = p.iX = p.w = p.h = p.y = p.x = p.bb = p.bt = p.bl = p.br = 0;objList[objList.length] = p;}
	if((typeof el.offsetParent != 'undefined')&&(typeof el.offsetTop == 'number')&&(typeof el.offsetWidth == 'number')){if((typeof el.clientTop == 'number')&&(typeof el.clientWidth == 'number')){getBorders = gClientBorders;}else if((defaultView = document.defaultView)&&defaultView.getComputedStyle &&(temp = defaultView.getComputedStyle(el, '' ))&&(((temp.getPropertyCSSValue)&&(temp2 = temp.getPropertyCSSValue('border-top-width'))&&(temp2.getFloatValue)&&(doCompStyle = doComputedStyleFloat))||((temp.getPropertyValue)&&(doCompStyle = doComputedStyleValue)))){getBorders = gCompStyleBorders;temp2 = temp = null;}if(document.documentElement){setSpecialObj(document.documentElement);}if(document.body){setSpecialObj(document.body);}return (getSimpleExtPxIn = getSimpleExtPxInFn)(el);}else{retThis.elTest = retFalse;retThis.iY = retThis.iX = retThis.y = retThis.x = retThis.w = retThis.h = retThis.bb = retThis.bt = retThis.bl = retThis.br = NaN;return (getSimpleExtPxIn = retThis);}
}

function getNewFILCFncStac(fnc){function getNewFnc(f){var next = null;function t(a){next = next&&next(a);return (f(a))?t:next;}t.finalize = function(){next = next&&next.finalize();return (f = null);};t.addItem = function(d){if(f != d){if(next){next.addItem(d);}else{next = getNewFnc(d);}}return this;};return t;}var base = getNewFnc(fnc);fnc = function(a){base = base&&base(a);};fnc.addItem = function(d){if(base){base.addItem(d)}else{base = getNewFnc(d);}};fnc.finalize = function(){return (base = base&&base.finalize());};return fnc;}

function GlobalEventMonitor(eventName, functinRef){
	var finalize, global = this;
	var monitors = {};
	var onName = ['on',''];
	function mainMonitor(eventName, functinRef){
		var monitor = monitors[eventName];
		if(monitor){
			monitor(functinRef);
		}else{
			setEventMonitor(eventName, functinRef);
		}
	}
	function setListener(eventName, longName, fncStack){
		global.addEventListener(eventName, fncStack, false);
		return true;
	}
	function setListener_aE(eventName, longName, fncStack){
		global.attachEvent(longName, fncStack);
		return true;
	}
	function oldHandler(f){return (function(e){f(e);return true;});}
	function retFalse(){return false;}
	function setEventMonitor(eventName, functinRef){
		var fncStack, longName;
		onName[1] = eventName;
		longName = onName.join('');
		function main(funcRef){
			if(funcRef){
				fncStack.addItem(funcRef);
				globalCheck();
			}
		}
		function globalCheck(){
			if(global[longName] != fncStack){
				if(global[longName]){
					fncStack.addItem(oldHandler(global[longName]));
				}
				global[longName] = fncStack;
			}
		}
		fncStack = getNewFILCFncStac(functinRef);
		if(setListener(eventName, longName, fncStack)){
			globalCheck = retFalse;
		}else{
			globalCheck();
		}
		finalize.addItem(fncStack.finalize);
		monitors[eventName] = main;
		functinRef = null;
	}
	if(!global.addEventListener){
		if(global.attachEvent){
			setListener = setListener_aE;
		}else{
			setListener = retFalse;
		}
	}
	finalizeMe((finalize = getNewFILCFncStac(
		function(){
			finalize = monitors = null;
		})
	));
	(GlobalEventMonitor = mainMonitor)(eventName, functinRef);
	functinRef = null;
}

var tableScroll = (function(){
	var global = this, finalise, tableList = {};
	var notOnScroll = true, notAbort = true;
	var overrideStyles = {
		margin:[{keys:['margin','marginBottom','marginLeft','marginRight','marginTop'],value:'0px'}],
		padding:[{keys:['padding','paddingBottom','paddingLeft','paddingRight','paddingTop'],value:'0px'}],
		border:[
			{keys:['border','borderBottom','borderLeft','borderRight','borderTop'],value:'0px none #FFFFFF'},
			{keys:['borderWidth','borderLeftWidth','borderRightWidth','borderBottomWidth','borderTopWidth'],value:'0px'},
			{keys:['borderStyle','borderRightStyle','borderLeftStyle','borderBottomStyle','borderTopStyle'],value:'none'}
		],
		overflow:[{keys:['overflow'],value:'hidden'}],
		positionRel:[{keys:['position'],value:'relative'}],
		positionAbs:[{keys:['position'],value:'absolute'}],
		top:[{keys:['top'],value:'0px'}],
		left:[{keys:['left'],value:'0px'}],
		zIndex:[{keys:['zIndex'],value:2}]
	};
	function setStyleProps(styleObj){
		var data, dArray;
		for(var c = 1;c < arguments.length;c++){
			if((data = overrideStyles[arguments[c]])){
				for(var d = data.length;d--;){
					dArray = data[d].keys;
					for(var e = dArray.length;e--;){
						styleObj[dArray[e]] = data[d].value;
					}
				}
			}
		}
		return true;
	}
	function setClass(el,val){
		if(el.setAttribute){el.setAttribute('class',val);}
		return (el.className = val);
	}
	function retFalse(){return false;}
	function TableScroll(id){
		var midAbsDiv, parent, vHeaderAbsStyle, vHeaderRelStyle, hHeaderAbsStyle, hHeaderRelStyle;
		var midAbsDivStyle, midAbsinerDivStyle, inRelDivStyle, outRelDivDim;
		var lastScrollTop = NaN, lastScrollLeft = NaN, lastWidth = NaN, lastHeight = NaN, tableDim, table = getElementWithId(id);
		var midRelinerDivStyle, midRelinerDiv, testCellDim;
		function position(){
				var nh,nw,size,th,tw,cellWidth,celHeight,st = midAbsDiv.scrollTop, sl = midAbsDiv.scrollLeft, h = outRelDivDim(true).h, w = outRelDivDim.w;
				if((size = ((w != lastWidth)||(h != lastHeight)))||(st != lastScrollTop)||(sl != lastScrollLeft)){
					hHeaderRelStyle.left = (((cellWidth = (testCellDim().x - tableDim().iX)) + (lastScrollLeft = sl)) * -1)+'px';//position
					vHeaderRelStyle.top = (((celHeight = (testCellDim.y - tableDim.iY)) + (lastScrollTop = st)) * -1)+'px';
					if(size){
						vHeaderRelStyle.width = vHeaderAbsStyle.width = midAbsDivStyle.left = hHeaderAbsStyle.left = (cellWidth+'px');
						hHeaderRelStyle.height = hHeaderAbsStyle.height = midAbsDivStyle.top = vHeaderAbsStyle.top = (celHeight+'px');
						inRelDivStyle.left = (cellWidth * -1)+'px';
						inRelDivStyle.top = (celHeight * -1)+'px';
						midRelinerDivStyle.width = midAbsinerDivStyle.width = ((tw = tableDim.w) - cellWidth)+'px';
						midRelinerDivStyle.height = midAbsinerDivStyle.height = ((th = tableDim.h) - celHeight)+'px';
						midAbsDivStyle.height = vHeaderAbsStyle.height = (((nh = ((lastHeight = h) - celHeight)) > celHeight)?nh:celHeight)+'px';
						midAbsDivStyle.width = hHeaderAbsStyle.width = (((nw = ((lastWidth = w) - cellWidth)) > cellWidth)?nw:cellWidth)+'px';
						hHeaderRelStyle.width = inRelDivStyle.width = tw + 'px';
						vHeaderRelStyle.height = inRelDivStyle.height = th + 'px';
					}
				}
				return notOnScroll;
		}
		function onScroll(){
			notOnScroll = false;
			position();
		}
		function onSize(){
			position();
			return true;
		}
		finalise.addItem(function(){
			testCellDim = midRelinerDivStyle = midRelinerDiv = 
			midAbsinerDivStyle =  tableDim = vHeaderAbsStyle = vHeaderRelStyle = hHeaderAbsStyle = hHeaderRelStyle = inRelDivStyle = outRelDivDim = midAbsDiv = parent = table = null;
			})
		if(
			table&&
			(typeof table.scrollTop == 'number')&&
			(typeof table.offsetHeight == 'number')&&
			table.tagName&&
			table.appendChild&&
			table.cloneNode&&
			table.getAttribute&&
			table.getElementsByTagName&&
			(parent = table.parentNode)&&
			parent.insertBefore
		   ){
			InitializeMe(function(){
				var newTable, testCell;
				var vHeaderAbs, vHeaderRel, hHeaderAbs, hHeaderRel,outRelDiv, midAbsinerDiv, inRelDiv;
				if(
					(notAbort)&&
					(testCell = table.getElementsByTagName('td')[0])&&
					(newTable = table.cloneNode(true))&&
					(outRelDiv = document.createElement('DIV'))&&
					(setClass(outRelDiv, 'tableBoxOuter'))&&
					(midAbsDiv = document.createElement('DIV'))&&
					(midRelinerDiv = document.createElement('DIV'))&&
					(midAbsinerDiv = document.createElement('DIV'))&&
					(inRelDiv = document.createElement('DIV'))&&
					(vHeaderAbs = document.createElement('DIV'))&&
					(vHeaderRel = document.createElement('DIV'))&&
					(hHeaderAbs = document.createElement('DIV'))&&
					(hHeaderRel = document.createElement('DIV'))&&
					(setStyleProps(outRelDiv.style, 'positionRel', 'padding'))&&
					(midAbsDivStyle = midAbsDiv.style)&&
					(setStyleProps(midAbsDivStyle, 'positionAbs', 'padding', 'margin', 'border', 'zIndex'))&&
					(midRelinerDivStyle = midRelinerDiv.style)&&
					(setStyleProps(midRelinerDivStyle, 'positionRel', 'padding', 'margin', 'border', 'top', 'left'))&&
					(midAbsinerDivStyle = midAbsinerDiv.style)&&
					(setStyleProps(midAbsinerDivStyle, 'positionAbs', 'overflow', 'padding', 'margin', 'border', 'top', 'left'))&&
					(inRelDivStyle = inRelDiv.style)&&
					(setStyleProps(inRelDivStyle, 'positionRel', 'padding', 'margin', 'border', 'top', 'left'))&&
					(vHeaderAbsStyle = vHeaderAbs.style)&&
					(setStyleProps(vHeaderAbsStyle, 'positionAbs', 'overflow', 'padding', 'margin', 'border', 'top', 'left', 'zIndex'))&&
					(vHeaderRelStyle = vHeaderRel.style)&&
					(setStyleProps(vHeaderRelStyle, 'positionRel', 'padding', 'margin', 'border', 'top', 'left'))&&
					(hHeaderAbsStyle = hHeaderAbs.style)&&
					(setStyleProps(hHeaderAbsStyle, 'positionAbs', 'overflow', 'padding', 'margin', 'border', 'top', 'left', 'zIndex'))&&
					(hHeaderRelStyle = hHeaderRel.style)&&
					(setStyleProps(hHeaderRelStyle, 'positionRel', 'padding', 'margin', 'border', 'top', 'left'))&&
					(setStyleProps(table.style, 'margin'))&&
					(midAbsDiv.appendChild(midRelinerDiv))&&
					(midRelinerDiv.appendChild(midAbsinerDiv))&&
					(midAbsinerDiv.appendChild(inRelDiv))&&
					(outRelDiv.appendChild(midAbsDiv))&&
					(vHeaderAbs.appendChild(vHeaderRel))&&
					(hHeaderAbs.appendChild(hHeaderRel))&&
					(outRelDiv.appendChild(vHeaderAbs))&&
					(outRelDiv.appendChild(hHeaderAbs))&&
					(parent.insertBefore(outRelDiv, table))&&
					(!isNaN((outRelDivDim = getSimpleExtPxIn(outRelDiv)).w))&&
					(inRelDiv.appendChild(table))&&
					(!isNaN((testCellDim = getSimpleExtPxIn(testCell)).w))&&
					(!isNaN((tableDim = getSimpleExtPxIn(table)).w))&&
					(hHeaderRel.appendChild(newTable))&&
					(newTable = table.cloneNode(true))&&
					(vHeaderRel.appendChild(newTable))
				   ){
					midAbsDivStyle.overflow = 'scroll';
					if(midAbsDiv.addEventListener){
						midAbsDiv.addEventListener('scroll', onScroll, false);
					}else if(midAbsDiv.attachEvent){
						midAbsDiv.attachEvent('onscroll', onScroll);
					}else{
						midAbsDiv.onscroll = onScroll;
					}
					GlobalEventMonitor('resize', onSize);
					position();
					TimedQue(position);
				}else{
					notAbort = false;
				}
			});
		}else{
			notAbort = false;
		}
		return true;
	}
	function main(){
		var id;
		for(var c = 0;c < arguments.length;c++){
			id = arguments[c];
			if(notAbort&&!tableList[id]){
				tableList[id] = TableScroll(id);
			}
		}
	}
	if(
		(!global.queryStrings||!queryStrings['noTableScroll'])&&
		global.setTimeout&&
		global.document&&
		document.createElement
	){
		finalizeMe((finalise = getNewFILCFncStac(function(){
			finalise = tableList = null;
		})));
		return main;
	}else{
		return retFalse;
	}
})();

jQuery(document).ready(function(){
	jQuery('.text').focus(function(){
		var row = jQuery(this).attr('row');
		jQuery('#row_'+row+' > td > input').removeAttr('readonly').css({'color':'#000','border':'#333 1px solid','cursor':'auto'});
	}).blur(function(){
		var rows = jQuery(this).attr('row');
		var kode = jQuery('#row_'+rows).attr('svn');
		jQuery('#row_'+rows+' > td > input').css({'color':'#999','border':'#999 1px solid','cursor':'pointer'}).attr('readonly','readonly');
	}).keypress(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == '13'){
			var rows = jQuery(this).attr('row');
			var kode = jQuery('#row_'+rows).attr('svn');
			jQuery('#row_'+rows+' > td > input').css({'color':'#999','border':'#999 1px solid','cursor':'pointer'}).attr('readonly','readonly').blur();
			jQuery.post('<?php echo _BASE_;?>jaspel/jaspel_setting_update.php',jQuery('#row_'+rows+' *').serialize(),function(data){
				alert(data);
			});
		};
	});
});
</script>
<table id="mainTable" class="scrolltable" style="width:1000px;">
<thead>
<tr><!-- locked column headers go here-->
		<th class="header">Nama Akun</th>
        <th class="header">Tarif</th>
        <th class="header">J Layanan</th>
        <th class="header">J Sarana</th>
        <th class="header">dr Spesialis</th>
        <th class="header">dr Umum</th>
        <th class="header">Manajemen Sp</th>
        <th class="header">Pendukung Sp</th>
        <th class="header">Asisten Sp</th>
        <th class="header">Manajemen Um</th>
        <th class="header">Pendukung Sp</th>
        <th class="header">Asisten Sp</th>
        <th class="header">Bidan</th>
        <th class="header">Manajemen Bd</th>
        <th class="header">Pendukung Bd</th>
        <th class="header">Asisten Bd</th>
        <th class="header">dr Operator</th>
        <th class="header">dr Anastesi</th>
        <th class="header">dr Anak</th>
        <th class="header">Prwt Ok</th>
        <th class="header">Prwt Perina</th>
        <th class="header">Manajemen Ok</th>
        <th class="header">Pendukung Ok</th>
        <th class="header">Asisten Ok</th>
        <th class="header">dr Radiologi</th>
        <th class="header">dr Perujuk</th>
        <th class="header">Prwt Rad</th>
        <th class="header">Manajemen Rad</th>
        <th class="header">Pendukung Rad</th>
        <th class="header">Asisten Rad</th>
        <th class="header">dr Perujuk Rad</th>
        <th class="header">Petugas Rad</th>
        <th class="header">dr Lab</th>
        <th class="header">Petugas Lab</th>
        <th class="header">Asisten Lab</th>
        <th class="header">Manajemen Lab</th>
        <th class="header">Pendukung Lab</th>
        <th class="header">dr Perujuk Lab</th>
</tr>
</thead>

<tbody >
<?php
	require_once("m_jaspel2012.php");
	$objSetupTarif = new m_jaspel2012();
	$objSetupTarif->db_host=$hostname;
	$objSetupTarif->db_user=$username;
	$objSetupTarif->db_pass=$password;
	$objSetupTarif->db_database=$database; 	
	if(!$objSetupTarif->db_connect()) {
		echo "<h1>Sorry! Could not connect to the database server.</h1>";	
		exit();	
	}
	$allFields=$objSetupTarif->getAllFields(); 
	$i = 1;
	foreach($allFields as $data) {
		
		if($data['tarif'] == 0){
			echo '<tr class="pricenull"><th>'.$data['nama_tindakan'].'</th><td colspan="37"></td></tr>';
		}else{
		$kode_tindakan = str_replace('.','-',$data['kode_tindakan']);
												   
		echo '<tr id="row_'.$i.'" class="row" svn="'.$kode_tindakan.'">
    	<th><input type="hidden" name="kode_tindakan" id="'.$kode_tindakan.'" value="'.$data['kode_tindakan'].'"><input type="text" name="nama_tindakan" row="'.$i.'" class="nama_tindakan text row_'.$i.'" size="55" id="nm_'.$kode_tindakan.'" value="'.$data['nama_tindakan'].'" readonly="readonly"></th>
        <td><input type="text" name="tarif" row="'.$i.'" class="tarif text row_'.$i.'" size="5" id="tarif_'.$kode_tindakan.'" value="'.$data['tarif'].'" readonly="readonly"></td>
        <td><input type="text" name="jasa_pelayanan" row="'.$i.'" class="jasa_pelayanan text" size="5" id="jasa_pelayanan_'.$kode_tindakan.'" value="'.$data['jasa_pelayanan'].'" readonly="readonly"></td>
        <td><input type="text" name="jasa_sarana" row="'.$i.'" class="jasa_sarana text" size="5" id="jasa_sarana_'.$kode_tindakan.'" value="'.$data['jasa_sarana'].'" readonly="readonly"></td>
        <td><input type="text" name="dr_spesialis" row="'.$i.'" class="dr_spesialis text" size="5" id="dr_spesialis_'.$kode_tindakan.'" value="'.$data['dr_spesialis'].'" readonly="readonly"></td>
        <td><input type="text" name="dr_umum" row="'.$i.'" class="dr_umum text" size="5" id="dr_umum_'.$kode_tindakan.'" value="'.$data['dr_umum'].'" readonly="readonly"></td>
        <td><input type="text" name="manajemen_sp" row="'.$i.'" class="manajemen_sp text" size="5" id="manajemen_sp_'.$kode_tindakan.'" value="'.$data['manajemen_sp'].'" readonly="readonly"></td>
        <td><input type="text" name="pendukung_sp" row="'.$i.'" class="pendukung_sp text" size="5" id="pendukung_sp_'.$kode_tindakan.'" value="'.$data['pendukung_sp'].'" readonly="readonly"></td>
        <td><input type="text" name="asisten_sp" row="'.$i.'" class="asisten_sp text" size="5" id="asisten_sp_'.$kode_tindakan.'" value="'.$data['asisten_sp'].'" readonly="readonly"></td>
        <td><input type="text" name="manajemen_um" row="'.$i.'" class="manajemen_um text" size="5" id="manajemen_um_'.$kode_tindakan.'" value="'.$data['manajemen_um'].'" readonly="readonly"></td>
        <td><input type="text" name="pendukung_um" row="'.$i.'" class="pendukung_um text" size="5" id="pendukung_um_'.$kode_tindakan.'" value="'.$data['pendukung_um'].'" readonly="readonly"></td>
        <td><input type="text" name="asisten_um" row="'.$i.'" class="asisten_um text" size="5" id="asisten_um_'.$kode_tindakan.'" value="'.$data['asisten_um'].'" readonly="readonly"></td>
        <td><input type="text" name="bidan" row="'.$i.'" class="bidan text" size="5" id="bidan_'.$kode_tindakan.'" value="'.$data['bidan'].'" readonly="readonly"></td>
        <td><input type="text" name="manajemen_bd" row="'.$i.'" class="manajemen_bd text" size="5" id="manajemen_bd_'.$kode_tindakan.'" value="'.$data['manajemen_bd'].'" readonly="readonly"></td>
        <td><input type="text" name="pendukung_bd" row="'.$i.'" class="pendukung_bd text" size="5" id="pendukung_bd_'.$kode_tindakan.'" value="'.$data['pendukung_bd'].'" readonly="readonly"></td>
        <td><input type="text" name="asisten_bd" row="'.$i.'" class="asisten_bd text" size="5" id="asisten_bd_'.$kode_tindakan.'" value="'.$data['asisten_bd'].'" readonly="readonly"></td>
        <td><input type="text" name="drOperator" row="'.$i.'" class="drOperator text" size="5" id="drOperator_'.$kode_tindakan.'" value="'.$data['drOperator'].'" readonly="readonly"></td>
        <td><input type="text" name="drAnestesi" row="'.$i.'" class="drAnestesi text" size="5" id="drAnestesi_'.$kode_tindakan.'" value="'.$data['drAnestesi'].'" readonly="readonly"></td>
        <td><input type="text" name="drAnak" row="'.$i.'" class="drAnak text" size="5" id="drAnak_'.$kode_tindakan.'" value="'.$data['drAnak'].'" readonly="readonly"></td>
        <td><input type="text" name="perawat_ok" row="'.$i.'" class="perawat_ok text" size="5" id="perawat_ok_'.$kode_tindakan.'" value="'.$data['perawat_ok'].'" readonly="readonly"></td>
        <td><input type="text" name="perawat_perina" row="'.$i.'" class="perawat_perina text" size="5" id="perawat_perina_'.$kode_tindakan.'" value="'.$data['perawat_perina'].'" readonly="readonly"></td>
        <td><input type="text" name="manajemen_ok" row="'.$i.'" class="manajemen_ok text" size="5" id="manajemen_ok_'.$kode_tindakan.'" value="'.$data['manajemen_ok'].'" readonly="readonly"></td>
        <td><input type="text" name="asisten_ok" row="'.$i.'" class="asisten_ok text" size="5" id="asisten_ok_'.$kode_tindakan.'" value="'.$data['asisten_ok'].'" readonly="readonly"></td>
        <td><input type="text" name="pendukung_ok" row="'.$i.'" class="pendukung_ok text" size="5" id="pendukung_ok_'.$kode_tindakan.'" value="'.$data['pendukung_ok'].'" readonly="readonly"></td>
        <td><input type="text" name="drRadiologi" row="'.$i.'" class="drRadiologi text" size="5" id="drRadiologi_'.$kode_tindakan.'" value="'.$data['drRadiologi'].'" readonly="readonly"></td>
        <td><input type="text" name="drPerujuk" row="'.$i.'" class="drPerujuk text" size="5" id="drPerujuk_'.$kode_tindakan.'" value="'.$data['drPerujuk'].'" readonly="readonly"></td>
        <td><input type="text" name="perawat_rad" row="'.$i.'" class="perawat_rad text" size="5" id="perawat_rad_'.$kode_tindakan.'" value="'.$data['perawat_rad'].'" readonly="readonly"></td>
        <td><input type="text" name="manajemen_rad" row="'.$i.'" class="manajemen_rad text" size="5" id="manajemen_rad_'.$kode_tindakan.'" value="'.$data['manajemen_rad'].'" readonly="readonly"></td>
        <td><input type="text" name="pendukung_rad" row="'.$i.'" class="pendukung_rad text" size="5" id="pendukung_rad_'.$kode_tindakan.'" value="'.$data['pendukung_rad'].'" readonly="readonly"></td>
        <td><input type="text" name="asisten_rad" row="'.$i.'" class="asisten_rad text" size="5" id="asisten_rad_'.$kode_tindakan.'" value="'.$data['asisten_rad'].'" readonly="readonly"></td>
        <td><input type="text" name="drPerujuk_rad" row="'.$i.'" class="drPerujuk_rad text" size="5" id="drPerujuk_rad_'.$kode_tindakan.'" value="'.$data['drPerujuk_rad'].'" readonly="readonly"></td>
        <td><input type="text" name="petugas_rad" row="'.$i.'" class="petugas_rad text" size="5" id="petugas_rad_'.$kode_tindakan.'" value="'.$data['petugas_rad'].'" readonly="readonly"></td>
        <td><input type="text" name="drLab" row="'.$i.'" class="drLab text" size="5" id="drLab_'.$kode_tindakan.'" value="'.$data['drLab'].'" readonly="readonly"></td>
        <td><input type="text" name="petugas_lab" row="'.$i.'" class="petugas_lab text" size="5" id="petugas_lab_'.$kode_tindakan.'" value="'.$data['petugas_lab'].'" readonly="readonly"></td>
        <td><input type="text" name="asisten_lab" row="'.$i.'" class="asisten_lab text" size="5" id="asisten_lab_'.$kode_tindakan.'" value="'.$data['asisten_lab'].'" readonly="readonly"></td>
        <td><input type="text" name="manajemen_lab" row="'.$i.'" class="manajemen_lab text" size="5" id="manajemen_lab_'.$kode_tindakan.'" value="'.$data['manajemen_lab'].'" readonly="readonly"></td>
        <td><input type="text" name="pendukung_lab" row="'.$i.'" class="pendukung_lab text" size="5" id="pendukung_lab_'.$kode_tindakan.'" value="'.$data['pendukung_lab'].'" readonly="readonly"></td>
        <td><input type="text" name="drPerujuk_lab" row="'.$i.'" class="drPerujuk_lab text" size="5" id="drPerujuk_lab_'.$kode_tindakan.'" value="'.$data['drPerujuk_lab'].'" readonly="readonly"></td>
	</tr>';
	$i++;
		}
	}
	?>
</tbody>
</table></center>

<script type="text/javascript">
if(typeof tableScroll == 'function'){tableScroll('mainTable');}
</script><br /><br />
