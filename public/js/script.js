$('document').ready(function () {

    var data = [
        {
            "id": "6002997865244",
            "name": "Human sexuality",
            "audience_size": 229167530,
            // "path": [
            //     "Interests",
            //     "Additional Interests",
            //     "Human sexuality"
            // ],
            // "description": null,
            "topic": "News and entertainment"
        },
    ];
    //
    // $('#example').DataTable( {
    //     data: data,
    //     columns: [
    //         { data: 'name' },
    //         { data: 'position' },
    //         { data: 'salary' },
    //         { data: 'salary' },
    //         { data: 'office' }
    //     ]
    // } );



    function search(q) {
        $('#example').DataTable( {
            // processing: true,
            // serverSide: true,
            // info: true,
            ajax: '/api/q/' + q,
            // data: data,
            columns: [
                // { data: 'id' },
                { data: 'name' },
                { data: 'audience_size' },
                { data: 'path' },
                { data: 'description',"defaultContent": "" },
                { data: 'topic',"defaultContent": "" },
            ],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    }

    search("test");

    $("#display-btn").on('click',function () {
        $("#example").dataTable().fnDestroy();
        search($("#keyword").val());
    });

});