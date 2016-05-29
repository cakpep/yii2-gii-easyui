/**
 * Yii EasyUI Basic Code
 *
 * @author 		Dida Nurwanda
 * @email		dida_n@ymail.com
 * @blog		didanurwanda.blogspot.com
 * @create		April 2013
 *
 * develope by Febri M Wicaksono (febrimaschut@gmail.com)
 * Mei 2016
 */

/**
 * Link to form
 */
var link_to_form;

String.prototype.addParam = function (params) {
    return this + (/\?/.test(this) ? '&' : '?') + $.param(params);
}

/**
 * Open Tabs
 *
 * @url 	link to items
 * @title	title tabs
 * @icon	icon tabs
 */
function open_tabs(url, title, icon)
{
	if ($('#content').tabs('exists',title)) {
		$('#content').tabs('select',title);
	} else {
		$('#content').tabs('add', {
			iconCls : icon,
			title : title,
			href : url,
			closable : true,
		});
	}
}

/**
 * Create or Open Dialog Create
 *
 * @dialog		identity dialog
 * @form		identity form
 * @title 		title dialog
 */
function create_data(dialog,form,title, url)
{
	$(dialog).dialog('open').dialog('setTitle',title);
	$(form).form('clear');
	link_to_form = url;
}

/**
 * Update or Open Dialog Update
 *
 * @dialog		identity dialog
 * @form		identity form
 * @title 		title dialog
 * @grid		identity grid
 */
function update_data(dialog,form,title,grid, url)
{
	var row = $(grid).datagrid('getSelected');
	if(row) {
		$(dialog).dialog('open').dialog('setTitle',title);
		$(form).form('load',row);
		link_to_form = url+ '&id=' + row.id;
	} else {
		$.messager.show({
			title: 'Error',
			msg: "Please select item will be edited",
			timeout:5000,
			style:{
				right: '',
				top: document.body.scrollTop+document.documentElement.scrollTop,
				bottom: ''
			}
		});
	}
}

/**
 * Save data
 *
 * @form		identity form
 * @dialog		identity dialog
 * @grid		identity grid
 */
function save_data(form, dialog, grid)
{
	$(form).form('submit', {
		url : link_to_form,
		onSubmit : function() {
			return $(this).form('validate');
		},
		success : function(result) {
			var result = eval('('+result+')');
			if (result.type !== 'error') {
				$(dialog).dialog('close');
				$(grid).datagrid('reload');
				$.messager.show({
					title: 'Success',
					msg: result.message,
					timeout:5000,
					style:{
						right: '',
						top: document.body.scrollTop+document.documentElement.scrollTop,
						bottom: ''
					}
				});
			} else {
				$.messager.show({
					title : 'Error',
					msg : result.message,
					timeout:10000,
					style:{
						right: '',
						top: document.body.scrollTop+document.documentElement.scrollTop,
						bottom: ''
					}
				});
			}
		}
	});
}

/**
 * Remove data
 *
 * @grid		identity grid
 */
function remove_data(grid,url){
	var row = $(grid).datagrid('getSelected');
	if (row){
		$.messager.confirm('Confirm','Are you sure you want to remove this data ?',function(r){
			if (r){
				var delete_url = url.addParam({id: row.id});
				$.post(delete_url,function(result){
					if (result.type !== 'error') {
						$(grid).datagrid('reload');
						$.messager.show({
							title: 'Success',
							msg: result.message,
							timeout:5000,
							style:{
								right: '',
								top: document.body.scrollTop+document.documentElement.scrollTop,
								bottom: ''
							}
						});
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.message,
							timeout:5000,
							style:{
								right: '',
								top: document.body.scrollTop+document.documentElement.scrollTop,
								bottom: ''
							}
						});
					}
				},'json');
			}
		});
	} else {
			$.messager.show({
			title: 'Error',
			msg: "Please select item will be deleted",
			timeout:5000,
			style:{
				right: '',
				top: document.body.scrollTop+document.documentElement.scrollTop,
				bottom: ''
			}
		});
	}
}

/**
 * Search dialog
 *
 * @dialog		identity dialog
 */
function search_dialog(dialog)
{
	$(dialog).dialog('open').dialog('setTitle','Search');
}

/**
 * Date Default for My SQL
 *
 */
function date_default(date){
	var y = date.getFullYear();
	var m = date.getMonth()+1;
	var d = date.getDate();
	return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
}
/**
 * End Of File
 */
