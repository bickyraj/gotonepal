"use strict";
// Class definition

var url = document
  .querySelector('script[data-id="team-list-script"][data-url]')
  .getAttribute('data-url');
var KTDatatableJsonRemoteDemo = function () {
	// Private functions
	var dataTable;

	// basic demo
	var demo = function () {

		dataTable = $('.kt-datatable').KTDatatable({
			// datasource definition
			data: {
				type: 'remote',
				method: 'get',
				source: {
					read: {
						url: '/admin/teams/list',
						method: 'GET'
					}
				},
				pageSize: 10,
			},

			// layout definition
			layout: {
				scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
				footer: false // display/hide footer
			},

			// column sorting
			sortable: true,

			pagination: true,

			search: {
				input: $('#generalSearch')
			},

			// columns definition
			columns: [
				{
					field: 'id',
					title: '#',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {class: 'kt-checkbox--solid'},
					textAlign: 'center',
				},
				{
					field: 'image_url',
					title: 'Image',
					template: function(item) {
						return '\
						<img class="" style="width:50px;" src="'+item.thumbImageUrl+'" />\
						';
					}
				},
				{
					field: 'name',
					title: 'Name',
				},
                {
                    field: 'block_1',
                    title: 'Show',
                    template: function (item) {
                        return '\
						<div class="col-3">\
						  <span class="kt-switch kt-switch--sm kt-switch--icon">\
						  <label>\
						  <input type="checkbox" data-id="'+ item.id + '" ' + ((item.block_1 == 1) ? "checked" : "") + ' id="block1Switch" value="1" name="show_status">\
						  <span></span>\
						  </label>\
						  </span>\
						</div>\
					';
                    },
                },
				{
					field: 'position',
					title: 'Position'
				},
				{
					field: 'Actions',
					title: 'Actions',
					sortable: false,
					width: 110,
					autoHide: false,
					overflow: 'visible',
					template: function(item) {
						return '\
						<a href="'+url+'/admin/teams/edit/'+item.id+'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">\
							<i class="la la-edit"></i>\
						</a>\
						<button class="btn btn-sm btn-clean btn-icon btn-icon-md kt_sweetalert_delete_team" data-id="'+item.id+'" title="Delete">\
							<i class="la la-trash"></i>\
						</button>\
					';
					},
				}
			],

		});

    $('#kt_form_status').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'Status');
    });

    $('#kt_form_type').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'Type');
    });

    $('#kt_form_status,#kt_form_type').selectpicker();

	};

    $(document).on('change', '#block1Switch', function (e) {
        var id = $(this).data('id');
        var action_url = url + '/admin/teams/update-block1/' + id;
        $.ajax({
            url: action_url,
            type: "GET",
            dataType: "json",
            async: "false",
            success: function (res) {
                Toast.fire({
                    type: 'success',
                    title: res.message
                })
            }
        })
    });

	$(document).on('click', '.kt_sweetalert_delete_team', function(event) {
		var e = $(this);

		swal.fire({
		    title: 'Are you sure you want to delete this?',
		    // text: "You won't be able to revert this!",
		    type: 'warning',
		    showCancelButton: true,
		    confirmButtonText: 'Yes'
		}).then(function(result) {
		    if (result.value) {
		    	var id = e.attr('data-id');
		    	var action_url = url + '/admin/teams/delete/' + id;
		    	$.ajax({
		    		url: action_url,
		    		type: "DELETE",
		    		dataType: "json",
		    		async: "false",
		    		success: function(res) {
		    			dataTable.reload();
		    			Toast.fire({
		    			  type: 'success',
		    			  title: 'The team has been deleted.'
		    			})
		    		}
		    	})
		    }
		});
	});

	return {
		// public functions
		init: function () {
			demo();
		}
	};
}();

jQuery(document).ready(function () {
	setTimeout(function() {
		KTDatatableJsonRemoteDemo.init();
	}, 100);
});
