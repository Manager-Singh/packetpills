(function () {

    FTX.TransferRequests = {

        list: {

            selectors: {
                transfer_requests: $('#transfer-requests-table'),
            },

            init: function () {
                

                this.selectors.transfer_requests.dataTable({

                    processing: false,
                    serverSide: true,
                    ajax: {
                        url: this.selectors.transfer_requests.data('ajax_url'),
                        type: 'post'
                    },
                    columns: [
                        { data: 'full_name', name: 'full_name' },
                        { data: 'date_of_birth', name: 'date_of_birth' },
                        { data: 'mobile_no', name: 'mobile_no' },
                        { data: 'name', name: 'name' },
                        { data: 'formatted_address', name: 'formatted_address' },
                        { data: 'formatted_phone_number', name: 'formatted_phone_number' },
                        { data: 'fax_number', name: 'fax_number' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'status', name: 'status' },
                        //{ data: 'actions', name: 'actions', searchable: false, sortable: false }
                    ],
                    order: [[3, "asc"]],
                    searchDelay: 500,
                    "createdRow": function (row, data, dataIndex) {
                        FTX.Utils.dtAnchorToForm(row);
                    }
                });
            }
        },

        edit: {
            init: function (locale) {
                FTX.tinyMCE.init(locale);
            }
        },
    }
})();