(function () {

    FTX.Allorder = {

        list: {

            selectors: {
                order_table: $('#orders-table'),
            },

            init: function () {
                

                this.selectors.order_table.dataTable({

                    processing: false,
                    serverSide: true,
                    ajax: {
                        url: this.selectors.order_table.data('ajax_url'),
                        type: 'post'
                    },
                    columns: [
                        { data: 'order_number', name: 'order_number' },
                        { data: 'total_amount', name: 'total_amount' },
                        { data: 'order_status', name: 'order_status' },
                        { data: 'payment_status', name: 'payment_status' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'actions', name: 'actions', searchable: false, sortable: false }
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