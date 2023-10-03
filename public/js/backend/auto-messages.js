(function () {

    FTX.AutoMessages = {

        list: {

            selectors: {
                email_table: $('#auto-messages-table'),
            },

            init: function () {

                this.selectors.email_table.dataTable({

                    processing: false,
                    serverSide: true,
                    ajax: {
                        url: this.selectors.email_table.data('ajax_url'),
                        type: 'post'
                    },
                    columns: [
                        { data: 'preciption_type', name: 'preciption_type' },
                        { data: 'status', name: 'status' },
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