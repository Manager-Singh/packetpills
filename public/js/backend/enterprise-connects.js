(function () {

    FTX.EnterpriseConnect = {

        list: {

            selectors: {
                enterprise: $('#enterprise-connect-table'),
            },

            init: function () {
                

                this.selectors.enterprise.dataTable({

                    processing: false,
                    serverSide: true,
                    ajax: {
                        url: this.selectors.enterprise.data('ajax_url'),
                        type: 'post'
                    },
                    columns: [
                        { data: 'full_name', name: 'full_name' },
                        { data: 'company', name: 'company' },
                        { data: 'job_title', name: 'job_title' },
                        { data: 'email', name: 'email' },
                        { data: 'phone_no', name: 'phone_no' },
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