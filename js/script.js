$( document ).ready(function() {
	var table = $('#cliente').dataTable({
			 "bProcessing": true,
			 "sAjaxSource": "json/client.php",
			  "bPaginate":true,
			  "sPaginationType":"full_numbers",
			  "iDisplayLength": 10,
			 "aoColumns": [
                { mData: 'idc' } ,
                { mData: 'nombre' },
                { mData: 'apellidos' },
                { mData: 'terminacion' }
        ]
	}); 
});

