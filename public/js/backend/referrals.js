(function () {

    FTX.Referrals = {

        list: {

            selectors: {
                referrals: $('#referrals-table'),
            },

            init: function () {
                

                this.selectors.referrals.dataTable({

                    processing: false,
                    serverSide: true,
                    ajax: {
                        url: this.selectors.referrals.data('ajax_url'),
                        type: 'post'
                    },
                    columns: [
                        { data: 'name', name: 'name' },
                        { data: 'source', name: 'source' },
                        { data: 'details', name: 'details' },
                        { data: 'status', name: 'status' },
                        { data: 'created_at', name: 'created_at' },
                        // { data: 'actions', name: 'actions', searchable: false, sortable: false }
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