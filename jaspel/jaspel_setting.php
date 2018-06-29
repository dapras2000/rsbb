<!--<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>TreeGrid - jQuery EasyUI Demo</title>
    -->
	<link rel="stylesheet" type="text/css" href="./js/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="./js/themes/icon.css">
	<script type="text/javascript" src="./js/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="./js/jquery.edatagrid.js"></script>
    
	<script>
		jQuery(function(){
			var lastIndex;
			var lastCode;
			jQuery('#test').treegrid({
				title:'Setting Jaspel',
				iconCls:'icon-save',
				width:1200,
				height:400,
				nowrap: false,
				rownumbers: true,
				singleSelect:true,
				animate:true,
				collapsible:true,
				url:'<?php echo _BASE_;?>jaspel/loaderjson.php',
				saveUrl: '<?php echo _BASE_;?>jaspel/loaderjson.php?action=save',  
				updateUrl: '<?php echo _BASE_;?>jaspel/loaderjson.php?action=update',  
				destroyUrl: '<?php echo _BASE_;?>jaspel/loaderjson.php?action=remove',
				idField:'id',
				treeField:'name',
				frozenColumns:[[
	                {title:'Nama Layanan',field:'name',width:450,
		                formatter:function(value){
		                	return '<span style="color:red">'+value+'</span>';
		                }
	                }
				]],
				toolbar:[{
					text:'accept',
					iconCls:'icon-save',
					handler:function(){
						saverow(lastIndex);
					}
				},'-',{
					text:'reject',
					iconCls:'icon-undo',
					handler:function(){
						cancelrow(lastIndex);
					}
				}],
				columns:[[
					{field:'tarif',title:'Tarif',width:100,editor:'text'},
					{field:'jaspel',title:'Jasa Pelayanan',width:100,editor:'text'},
					{field:'jasrana',title:'Jasa Sarana',width:100,editor:'text'},
					{field:'dr_spesialis',title:'dr Spesialis',width:70,editor:'text'},
					{field:'dr_umum',title:'dr Umum',width:100,editor:'text'},
					{field:'manajemen_sp',title:'Manajemen Spesialis',width:100,editor:'text'},
					{field:'pendukung_sp',title:'Pendukung Sp',width:100,editor:'text'},
					{field:'asisten_sp',title:'Asisten Sp',width:100,editor:'text'},
					{field:'manajemen_um',title:'Manajemen Umum',width:100,editor:'text'},
					{field:'pendukung_um',title:'Pendukung Um',width:100,editor:'text'},
					{field:'asisten_um',title:'Asisten Um',width:100,editor:'text'},
					{field:'bidan',title:'Bidan',width:100,editor:'text'},
					{field:'manajemen_bd',title:'Manajemen Bidan',width:100,editor:'text'},
					{field:'pendukung_bd',title:'Pendukung Bidan',width:100,editor:'text'},
					{field:'asisten_bd',title:'Asisten Bidan',width:100,editor:'text'},
					{field:'drOperator',title:'dr Operator',width:100,editor:'text'},
					{field:'drAnestesi',title:'dr Anestesi',width:100,editor:'text'},
					{field:'drAnak',title:'dr Anak',width:100,editor:'text'},
					{field:'perawat_ok',title:'Perawat OK',width:100,editor:'text'},
					{field:'perawat_perina',title:'Perawat Perina',width:100,editor:'text'},
					{field:'manajemen_ok',title:'Manajemen OK',width:100,editor:'text'},
					{field:'asisten_ok',title:'Asisten OK',width:100,editor:'text'},
					{field:'pendukung_ok',title:'Pendukung OK',width:100,editor:'text'},
					{field:'drRadiologi',title:'dr Rad',width:100,editor:'text'},
					{field:'drPerujuk',title:'dr Perujuk',width:100,editor:'text'},
					{field:'perawat_rad',title:'Perawat Rad',width:100,editor:'text'},
					{field:'manajemen_rad',title:'Manajemen Rad',width:100,editor:'text'},
					{field:'pendukung_rad',title:'Pendukung Rad',width:100,editor:'text'},
					{field:'asisten_rad',title:'Asisten Rad',width:100,editor:'text'},
					{field:'drPerujuk_rad',title:'dr Perujuk Rad',width:100,editor:'text'},
					{field:'petugas_rad',title:'Petugas Rad',width:100,editor:'text'},
					{field:'drLab',title:'dr Lab',width:100,editor:'text'},
					{field:'petugas_lab',title:'Petugas Lab',width:100,editor:'text'},
					{field:'asisten_lab',title:'Asisten Lab',width:100,editor:'text'},
					{field:'manajemen_lab',title:'Manajemen Lab',width:100,editor:'text'},
					{field:'pendukung_lab',title:'Pendukung Lab',width:100,editor:'text'},
					{field:'drPerujuk_lab',title:'dr Perujuk Lab',width:100,editor:'text'}
				]],
				
				onBeforeLoad:function(row,param){
					//jQuery(this).treegrid('rejectChanges');
					if (row){
						jQuery(this).treegrid('options').url = 'jaspel/loaderjson.php?id='+row.id;
					} else {
						jQuery(this).treegrid('options').url = 'jaspel/loaderjson.php?id=0';
					}
				},
				onContextMenu: function(e,row){
					e.preventDefault();
					jQuery(this).treegrid('unselectAll');
					jQuery(this).treegrid('select', row.code);
					jQuery('#mm').menu('show', {
						left: e.pageX,
						top: e.pageY
					});
				},
				onClickRow:function(rowIndex){
					if (lastIndex != rowIndex){
						jQuery('#test').treegrid('endEdit', lastIndex);
						jQuery('#test').treegrid('beginEdit', rowIndex.id);
					}
					lastIndex = rowIndex.id;
					lastCode  = rowIndex.code;
				}
			});
		});
	
		function updateActions(){  
			var rowcount = jQuery('#test').datagrid('getRows').length;  
			for(var i=0; i<rowcount; i++){  
				jQuery('#test').datagrid('updateRow',{  
					index:i,  
					row:{action:''}  
				});  
			}  
		}  
		function editrow(index){
			jQuery('#test').treegrid('beginEdit', index);  
		}  
		function deleterow(index){  
			jQuery.messager.confirm('Confirm','Are you sure?',function(r){  
				if (r){  
					jQuery('#test').treegrid('deleteRow', index);  
				}  
			});  
		}  
		function saverow(index){
			jQuery('#test').treegrid('endEdit', index);
			jQuery.post('<?php echo _BASE_;?>jaspel/loaderjson.php?action=save',jQuery('#test').treegrid('getSelected'),function(data){
				alert(data);
			});
		}  
		function cancelrow(index){  
			jQuery('#test').treegrid('cancelEdit', index);  
		}  
		/*
		function reload(){
			var node = jQuery('#test').treegrid('getSelected');
			if (node){
				jQuery('#test').treegrid('reload', node.code);
			} else {
				jQuery('#test').treegrid('reload');
			}
		}
		
		function getChildren(){
			var node = jQuery('#test').treegrid('getSelected');
			if (node){
				var nodes = jQuery('#test').treegrid('getChildren', node.code);
			} else {
				var nodes = jQuery('#test').treegrid('getChildren');
			}
			var s = '';
			for(var i=0; i<nodes.length; i++){
				s += nodes[i].code + ',';
			}
			alert(s);
		}
		function getSelected(){
			var node = jQuery('#test').treegrid('getSelected');
			if (node){
				alert(node.code+":"+node.name);
			}
		}
		
		function collapse(){
			var node = jQuery('#test').treegrid('getSelected');
			if (node){
				jQuery('#test').treegrid('collapse', node.code);
			}
		}
		function expand(){
			var node = jQuery('#test').treegrid('getSelected');
			if (node){
				jQuery('#test').treegrid('expand', node.code);
			}
		}
		function collapseAll(){
			var node = jQuery('#test').treegrid('getSelected');
			if (node){
				jQuery('#test').treegrid('collapseAll', node.code);
			} else {
				jQuery('#test').treegrid('collapseAll');
			}
		}
		function expandAll(){
			var node = jQuery('#test').treegrid('getSelected');
			if (node){
				jQuery('#test').treegrid('expandAll', node.code);
			} else {
				jQuery('#test').treegrid('expandAll');
			}
		}
		function expandTo(){
			jQuery('#test').treegrid('expandTo', '02013');
			jQuery('#test').treegrid('select', '02013');
		}
		var codeIndex = 1000;
		function append(){
			codeIndex++;
			var data = [{
				code: 'code'+codeIndex,
				name: 'name'+codeIndex,
				addr: 'address'+codeIndex,
				col4: 'col4 data'
			}];
			var node = jQuery('#test').treegrid('getSelected');
			jQuery('#test').treegrid('append', {
				parent: (node?node.code:null),
				data: data
			});
		}
		function remove(){
			var node = jQuery('#test').treegrid('getSelected');
			if (node){
				jQuery('#test').treegrid('remove', node.code);
			}
		}*/
	</script>
    <!--
</head>
<body>
	<h2>TreeGrid</h2>
	<div class="demo-info">
		<div class="demo-tip icon-tip"></div>
		<div>Combines treeview and datagrid to represent hierarchical data.</div>
	</div>
	
	<div style="margin:10px 0;">
		<a href="#" onClick="reload()">Reload</a>
		<a href="#" onClick="getChildren()">GetChildren</a>
		<a href="#" onClick="getSelected()">GetSelected</a>
		<a href="#" onClick="collapse()">Collapse</a>
		<a href="#" onClick="expand()">Expand</a>
		<a href="#" onClick="collapseAll()">CollapseAll</a>
		<a href="#" onClick="expandAll()">ExpandAll</a>
		<a href="#" onClick="expandTo()">ExpandTo</a>
		<a href="#" onClick="append()">Append</a>
	</div>
	-->
	<table id="test"></table>
	<!--
	<div id="mm" class="easyui-menu" style="width:120px;">
		<div onClick="append()">Append</div>
		<div onClick="remove()">Remove</div>
	</div>
</body>
</html>
-->