(function () {

    FTX.Prescription = {

        list: {

            selectors: {
                prescription: $('#prescriptions-table'),
            },

            init: function () {
                

                this.selectors.prescription.dataTable({

                    processing: false,
                    serverSide: true,
                    ajax: {
                        url: this.selectors.prescription.data('ajax_url'),
                        type: 'post'
                    },
                    columns: [
                        { data: 'prescription_number', name: 'prescription_number' },
                        { data: 'medication', name: 'medication' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'status', name: 'status' },
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